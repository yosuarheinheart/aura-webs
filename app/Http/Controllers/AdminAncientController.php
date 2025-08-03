<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AncientData;
use App\Models\EmailTemplate;
use App\Models\BulkEmailBatch;
use App\Exports\AncientExport;
use App\Jobs\SendBulkEmailJob;
use App\Mail\SelectionStatusMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Mail\Mailable;

class AdminAncientController extends Controller
{
    public function index(Request $request)
    {
        $query = AncientData::query();
        
        // Apply filters
        if ($request->filled('status')) {
            $query->where('status_seleksi', $request->status);
        }
        
        if ($request->filled('lokasi')) {
            $query->where('lokasi_pilihan', $request->lokasi);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $data = $query->orderBy('timestamp', 'desc')->paginate(15);
        
        $stats = [
            'total' => AncientData::count(),
            'pending' => AncientData::where('status_seleksi', 'pending')->count(),
            'accepted' => AncientData::where('status_seleksi', 'lolos')->count(), // Ubah dari 'lolos' ke 'accepted'
            'rejected' => AncientData::where('status_seleksi', 'gagal')->count(),  // Ubah dari 'gagal' ke 'rejected'
        ];
        
        // Panggi email template untuk program ancient
        $emailTemplates = EmailTemplate::forProgram('ancient')->first();
        
        return view('admin.ancient.index', compact('data', 'stats', 'emailTemplates'));
    }

    public function show($id)
    {
        $data = AncientData::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = AncientData::findOrFail($id);

            // Hanya izinkan update jika status saat ini adalah 'pending'
            if ($data->status_seleksi !== 'pending') {
                return redirect()->back()->with('error', 'Status tidak dapat diubah lagi karena sudah difinalisasi.');
            }

            $request->validate([
                'status_seleksi' => 'required|in:lolos,gagal', // Hanya bisa diubah ke lolos atau gagal
                'catatan_admin' => 'nullable|string|max:1000'
            ]);

            $data->update([
                'status_seleksi' => $request->status_seleksi,
                'catatan_admin' => $request->catatan_admin,
            ]);

            return redirect()->back()->with('success', 'Status pendaftar berhasil diupdate!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update data: ' . $e->getMessage());
        }
    }

    public function sendSingleEmail($id)
    {
        try {
            $registration = AncientData::findOrFail($id);
            
            Log::info("Attempting to send email for registration ID: {$id}", [
                'current_status_seleksi' => $registration->status_seleksi,
                'current_status_kirim' => $registration->status_kirim,
                'email' => $registration->email
            ]);

            // Validasi status - kirim email hanya jika status lolos atau gagal
            if (!$registration->canSendEmail()) {
                $message = 'Email tidak dapat dikirim untuk status ' . $registration->status_indonesian . '. Hanya status Lolos atau Gagal yang dapat dikirim email.';
                
                if (request()->expectsJson() || request()->ajax()) {
                    return response()->json([
                        'success' => false, 
                        'message' => $message
                    ], 422);
                }
                return redirect()->back()->with('error', $message);
            }

            // Kirim email
            try {
                Mail::to($registration->email)->send(new SelectionStatusMail($registration, 'ancient'));
                
                // Update status pengiriman email dengan logging
                $oldStatusKirim = $registration->status_kirim;
                $updated = $registration->update(['status_kirim' => AncientData::KIRIM_TERKIRIM]);
                
                // Refresh model untuk memastikan data terbaru
                $registration->refresh();
                
                Log::info("Email sent and status updated", [
                    'registration_id' => $id,
                    'email' => $registration->email,
                    'old_status_kirim' => $oldStatusKirim,
                    'new_status_kirim' => $registration->status_kirim,
                    'update_result' => $updated
                ]);
                
                // Return JSON response for AJAX requests
                if (request()->expectsJson() || request()->ajax()) {
                    return response()->json([
                        'success' => true, 
                        'message' => 'Email berhasil dikirim ke ' . $registration->email,
                        'status_kirim' => $registration->status_kirim,
                        'registration_id' => $id
                    ]);
                }
                
                // Return redirect for regular requests
                return redirect()->back()->with('success', 'Email berhasil dikirim ke ' . $registration->email);
                
            } catch (\Exception $mailException) {
                Log::error("Mail sending failed for ID {$id}: " . $mailException->getMessage());
                
                if (request()->expectsJson() || request()->ajax()) {
                    return response()->json([
                        'success' => false, 
                        'message' => 'Gagal mengirim email: ' . $mailException->getMessage()
                    ], 500);
                }
                return redirect()->back()->with('error', 'Gagal mengirim email: ' . $mailException->getMessage());
            }

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("Registration not found: ID {$id}");
            
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Data pendaftar tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Data pendaftar tidak ditemukan.');
            
        } catch (\Exception $e) {
            Log::error("Failed to send single email to ID {$id}: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $data = AncientData::findOrFail($id);
            $name = $data->nama_lengkap; // Simpan nama untuk log
            $data->delete();
            
            Log::info("Ancient registration deleted: {$name} (ID: {$id})");
            return redirect()->back()->with('success', "Data {$name} berhasil dihapus!");
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
            
        } catch (\Exception $e) {
            Log::error("Failed to delete ancient registration ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        try {
            $status = $request->get('status', 'all');
            $export = new AncientExport($status);
            return $export->download();
        } catch (\Exception $e) {
            Log::error("Ancient export failed: " . $e->getMessage());
            return redirect()->back()->with('error', 'Export failed: ' . $e->getMessage());
        }
    }

    public function sendBulkStatusEmail(Request $request)
    {
        // [PERBAIKAN 1 - KRITIS] Validasi input 'status_type' dengan nilai 'all', 'lolos', 'gagal'.
        $request->validate([
            'status_type' => 'required|in:lolos,gagal,all',
        ]);

        try {
            $statusesToSend = [];
            // [PERBAIKAN 2 - KRITIS] Gunakan $request->status_type dan cek nilai 'all'.
            if ($request->status_type === 'all') {
                $statusesToSend = ['lolos', 'gagal'];
            } else {
                $statusesToSend = [$request->status_type];
            }

            // [PERBAIKAN 3 - LOGIKA] Sederhanakan query untuk mencari yang statusnya 'Belum Dikirim'.
            $recipients = AncientData::whereIn('status_seleksi', $statusesToSend)
                                      ->where('status_kirim', AncientData::KIRIM_BELUM)
                                      ->get();

            if ($recipients->isEmpty()) {
                return redirect()->back()->with('warning', 'Tidak ada pendaftar baru yang perlu dikirimi email untuk kriteria yang dipilih.');
            }
            
            $sentCount = 0;
            $failedCount = 0;
            
            foreach ($recipients as $recipient) {
                try {
                    Mail::to($recipient->email)->send(new SelectionStatusMail($recipient, 'ancient'));
                    
                    // Ini sudah benar: Langsung update status_kirim setelah email berhasil dikirim.
                    $recipient->update(['status_kirim' => AncientData::KIRIM_TERKIRIM]);
                    
                    $sentCount++;
                    Log::info("Successfully sent bulk status email to {$recipient->email} (ID: {$recipient->id})");

                } catch (\Exception $e) {
                    $failedCount++;
                    Log::error("Failed to send bulk email to {$recipient->email} (ID: {$recipient->id}): " . $e->getMessage());
                }
            }

            $message = "Proses pengiriman email massal selesai. {$sentCount} email berhasil dikirim.";
            if ($failedCount > 0) {
                $message .= " {$failedCount} email gagal dikirim (cek log untuk detail).";
            }

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            Log::error("Ancient Send Bulk Email General Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem saat proses pengiriman email massal.');
        }
    }

    public function sendBulkEmail(Request $request)
    {
        $request->validate([
            'recipient_type' => 'required|in:pending,lolos,gagal,all',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);

        try {
            // Get recipients based on type
            $query = AncientData::query();
            
            if ($request->recipient_type !== 'all') {
                $query->where('status_seleksi', $request->recipient_type);
            }
            
            $recipients = $query->select('nama_lengkap', 'email', 'status_seleksi', 'lokasi_pilihan')
                               ->get()
                               ->toArray();

            if (empty($recipients)) {
                return redirect()->back()->with('error', 'Tidak ada penerima yang ditemukan untuk kriteria yang dipilih.');
            }

            // Handle file upload
            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')
                                         ->store('email-attachments', 'public');
            }

            // Create batch record
            $batch = BulkEmailBatch::create([
                'program_type' => 'ancient',
                'recipient_type' => $request->recipient_type,
                'subject' => $request->subject,
                'message' => $request->message,
                'attachment_path' => $attachmentPath,
                'total_recipients' => count($recipients),
                'status' => 'pending'
            ]);

            // Dispatch job
            SendBulkEmailJob::dispatch($batch, $recipients);

            Log::info("Bulk email queued for ancient program. Batch ID: {$batch->id}, Recipients: " . count($recipients));

            return redirect()->back()->with('success', 
                'Email massal berhasil dimasukkan ke antrian! ' . count($recipients) . ' email akan dikirim.');

        } catch (\Exception $e) {
            Log::error("Failed to queue bulk email for ancient program: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengirim email massal: ' . $e->getMessage());
        }
    }
}