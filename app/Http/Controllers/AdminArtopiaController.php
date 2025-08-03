<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtopiaData;
use App\Mail\SelectionStatusMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Exports\ArtopiaExport;

class AdminArtopiaController extends Controller
{
    public function index(Request $request)
    {
        // Kode yang ada tidak perlu diubah...
        $query = ArtopiaData::query();

        // Filter
        if ($request->filled('status')) {
            $query->where('status_seleksi', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nama_booth', 'like', "%{$search}%")
                    ->orWhere('nama_kelompok', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sort = $request->input('sort', 'terbaru');
        switch ($sort) {
            case 'nama_asc':
                $query->orderBy('nama_lengkap', 'asc');
                break;
            case 'nama_desc':
                $query->orderBy('nama_lengkap', 'desc');
                break;
            default:
                $query->orderBy('timestamp', 'desc');
                break;
        }

        $data = $query->paginate(15);
        
        $totalCount = ArtopiaData::count();
        $pendingCount = ArtopiaData::where('status_seleksi', 'pending')->count();
        $lolosCount = ArtopiaData::where('status_seleksi', 'lolos')->count();
        $gagalCount = ArtopiaData::where('status_seleksi', 'gagal')->count();

        $stats = [
            'total' => $totalCount,
            'pending' => $pendingCount,
            'lolos' => $lolosCount,
            'gagal' => $gagalCount,
        ];

        return view('admin.artopia.index', compact('data', 'stats'));
    }

    public function show($id)
    {
        $data = ArtopiaData::findOrFail($id);
        if (!empty($data->nama_kelompok)) {
            $data->anggota = ArtopiaData::where('nama_kelompok', $data->nama_kelompok)
                ->where('id', '!=', $data->id)
                ->get();
        }
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_seleksi' => 'required|in:lolos,gagal',
            'catatan_admin' => 'nullable|string|max:1000'
        ]);

        try {
            $data = ArtopiaData::findOrFail($id);

            if (in_array($data->status_seleksi, ['lolos', 'gagal'])) {
                return redirect()->back()->with('error', 'Status sudah final dan tidak dapat diubah lagi.');
            }

            $updateData = [
                'status_seleksi' => $request->status_seleksi,
                'catatan_admin' => $request->catatan_admin,
            ];

            // Update ketua/individu
            $data->update($updateData);

            // Jika ini adalah kelompok, update juga status dan catatan semua anggotanya
            if (!empty($data->nama_kelompok)) {
                ArtopiaData::where('nama_kelompok', $data->nama_kelompok)
                    ->update($updateData);
            }

            return redirect()->back()->with('success', 'Status berhasil diupdate. Email notifikasi dapat dikirim.');
        } catch (\Exception $e) {
            Log::error("Artopia Update Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    // --- MODIFIKASI PADA METHOD KIRIM EMAIL TUNGGAL ---
    public function sendSingleStatusEmail($id)
    {
        try {
            $registration = ArtopiaData::findOrFail($id);

            if (!in_array($registration->status_seleksi, ['lolos', 'gagal'])) {
                return redirect()->back()->with('error', 'Email tidak dapat dikirim karena status masih pending.');
            }
            if ($registration->status_kirim === 'Terkirim') {
                return redirect()->back()->with('warning', 'Email notifikasi untuk pendaftar ini sudah pernah dikirim.');
            }
            if (empty($registration->email) || str_contains($registration->email, '_member')) {
                return redirect()->back()->with('error', 'Pendaftar ini tidak memiliki email yang valid untuk dikirimi notifikasi.');
            }

            Mail::to($registration->email)->send(new SelectionStatusMail($registration, 'artopia'));

            // Update status kirim untuk ketua/individu
            $registration->update(['status_kirim' => 'Terkirim']);

            // --- TAMBAHAN: Update status kirim untuk semua anggota kelompok ---
            if (!empty($registration->nama_kelompok)) {
                ArtopiaData::where('nama_kelompok', $registration->nama_kelompok)
                             ->update(['status_kirim' => 'Terkirim']);
            }

            Log::info("Successfully sent single status email to {$registration->email}");
            return redirect()->back()->with('success', 'Email notifikasi berhasil dikirim ke ' . $registration->nama_lengkap . ' dan status anggota grup telah diperbarui.');

        } catch (\Exception $e) {
            Log::error("Artopia Send Single Email Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    // --- MODIFIKASI PADA METHOD KIRIM EMAIL MASSAL ---
    public function sendBulkStatusEmail(Request $request)
    {
        $request->validate([
            'status_type' => 'required|in:lolos,gagal,all',
        ]);

        try {
            $statuses = [];
            if ($request->status_type === 'lolos') $statuses = ['lolos'];
            if ($request->status_type === 'gagal') $statuses = ['gagal'];
            if ($request->status_type === 'all') $statuses = ['lolos', 'gagal'];

            $recipients = ArtopiaData::whereIn('status_seleksi', $statuses)
                                     ->where('status_kirim', 'Belum Dikirim')
                                     ->whereNotNull('email')
                                     ->where('email', 'not like', '%_member%')
                                     ->get();

            if ($recipients->isEmpty()) {
                return redirect()->back()->with('warning', 'Tidak ada penerima baru yang ditemukan untuk kriteria yang dipilih.');
            }
            
            $sentCount = 0;
            foreach ($recipients as $recipient) {
                try {
                    Mail::to($recipient->email)->send(new SelectionStatusMail($recipient, 'artopia'));
                    $sentCount++;
                } catch (\Exception $e) {
                    Log::error("Failed to send bulk email to {$recipient->email}: " . $e->getMessage());
                }
            }

            // --- TAMBAHAN: Update status_kirim untuk semua anggota kelompok terkait ---
            // 1. Ambil ID ketua yang berhasil dikirimi email
            $recipientIds = $recipients->pluck('id');
            
            // 2. Ambil nama kelompok unik dari para ketua tersebut
            $groupNames = $recipients->whereNotNull('nama_kelompok')->pluck('nama_kelompok')->unique();

            // 3. Update status_kirim untuk semua ketua/individu
            ArtopiaData::whereIn('id', $recipientIds)->update(['status_kirim' => 'Terkirim']);

            // 4. Update status_kirim untuk semua anggota dari kelompok yang relevan
            if ($groupNames->isNotEmpty()) {
                ArtopiaData::whereIn('nama_kelompok', $groupNames)->update(['status_kirim' => 'Terkirim']);
            }

            return redirect()->back()->with('success', "Proses pengiriman email massal selesai. {$sentCount} dari " . $recipients->count() . " email berhasil dikirim dan status kelompok telah diperbarui.");

        } catch (\Exception $e) {
            Log::error("Artopia Send Bulk Email Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat proses pengiriman email massal: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $data = ArtopiaData::findOrFail($id);
            if (!empty($data->nama_kelompok)) {
                ArtopiaData::where('nama_kelompok', $data->nama_kelompok)->delete();
            } else {
                $data->delete();
            }
            return redirect()->back()->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        try {
            $status = $request->get('status', 'all');
            return (new ArtopiaExport($status))->download('artopia_data.xlsx');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengekspor data: ' . $e->getMessage());
        }
    }
}