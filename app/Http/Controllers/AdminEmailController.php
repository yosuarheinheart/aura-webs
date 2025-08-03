<?php
// =====================================
// AdminEmailController (app/Http/Controllers/AdminEmailController.php)
// =====================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtopiaData;
use App\Models\AncientData;
use App\Models\EmailLog;
use App\Models\BulkEmailBatch;
use App\Models\EmailTemplate; // <-- Tambahkan ini
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendBulkEmailJob;


class AdminEmailController extends Controller
{
    public function index()
    {
        $batches = BulkEmailBatch::with('admin')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.email-templates.index', compact('batches'));
    }

    public function compose($program)
    {
        if (!in_array($program, ['artopia', 'ancient'])) {
            abort(404);
        }

        // Get recipients count
        $recipientsCount = $program === 'artopia' 
            ? ArtopiaData::where('status_seleksi', 'lolos')->count()
            : AncientData::where('status_seleksi', 'lolos')->count();

        // Get sample recipients for preview
        $sampleRecipients = $program === 'artopia'
            ? ArtopiaData::where('status_seleksi', 'lolos')->limit(5)->get(['nama_lengkap', 'email'])
            : AncientData::where('status_seleksi', 'lolos')->limit(5)->get(['nama_lengkap', 'email']);

        return view('admin.email.compose', compact('program', 'recipientsCount', 'sampleRecipients'));
    }

    public function sendBulk(Request $request)
    {
        $request->validate([
            'program' => 'required|in:artopia,ancient',
            'status_seleksi' => 'required|in:lolos,gagal,semua',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240'
        ]);

        $program = $request->program;
        $statusInput = $request->status_seleksi;

        $statusesToProcess = ($statusInput === 'semua') ? ['lolos', 'gagal'] : [$statusInput];
        $emailSentCount = 0;

        foreach ($statusesToProcess as $status) {
            $statusType = ($status === 'lolos') ? 'accepted' : 'rejected';

            // 1. Ambil template dari database
            $template = EmailTemplate::where('program', $program)
                ->where('status_type', $statusType)
                ->where('is_active', 1)
                ->first();

            if (!$template) {
                continue;
            }

            // 2. Ambil penerima berdasarkan program dan status
            $model = ($program === 'artopia') ? new ArtopiaData() : new AncientData();
            $recipients = $model->where('status_seleksi', $status)->get(['nama_lengkap', 'email']);

            if ($recipients->isEmpty()) {
                continue;
            }

            $emailSentCount += $recipients->count();
            
            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('email_attachments', 'public');
            }

            // 3. Buat record batch
            $batch = BulkEmailBatch::create([
                'name' => "{$program} - {$status}",
                'subject' => $template->subject,
                'body' => $template->body,
                'status' => 'processing',
                'total_recipients' => $recipients->count(),
                'filter_status' => $status,
                'created_by' => Auth::guard('admin')->id(),
                // Sesuaikan 'program_type' dengan nama kolom di tabel Anda, contoh:
                // 'program' => $program, 
            ]);

            // 4. Dispatch job
            SendBulkEmailJob::dispatch($batch->id);
        }

        if ($emailSentCount === 0) {
            return back()->with('error', 'Tidak ada template aktif atau penerima yang cocok dengan kriteria.');
        }

        return redirect()
            ->route('admin.email.index')
            ->with('success', "{$emailSentCount} email telah dimasukkan ke dalam antrian pengiriman. Anda dapat memantau progressnya di halaman ini.");
    }

    public function showBatch($id)
    {
        $batch = BulkEmailBatch::with('admin')->findOrFail($id);
        
        $logs = EmailLog::where('program_type', $batch->program_type)
            ->where('subject', $batch->subject)
            ->where('sent_at', '>=', $batch->created_at)
            ->orderBy('sent_at', 'desc')
            ->paginate(20);

        return view('admin.email.batch', compact('batch', 'logs'));
    }

    public function logs(Request $request)
    {
        $query = EmailLog::query();

        // Filter by program
        if ($request->filled('program') && $request->program !== 'all') {
            $query->where('program_type', $request->program);
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search by email or name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('recipient_email', 'like', "%{$search}%")
                  ->orWhere('recipient_name', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $logs = $query->orderBy('sent_at', 'desc')->paginate(20);

        // Statistics
        $stats = [
            'total' => EmailLog::count(),
            'sent' => EmailLog::where('status', 'sent')->count(),
            'failed' => EmailLog::where('status', 'failed')->count(),
            'artopia' => EmailLog::where('program_type', 'artopia')->count(),
            'ancient' => EmailLog::where('program_type', 'ancient')->count(),
        ];

        return view('admin.email.logs', compact('logs', 'stats'));
    }
}