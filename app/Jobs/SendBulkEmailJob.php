<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\BulkEmailBatch;
use App\Models\ArtopiaData;
use App\Models\AncientData;
use App\Models\EmailLog;
use App\Mail\BulkNotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendBulkEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $batchId;

    public function __construct($batchId)
    {
        $this->batchId = $batchId;
    }

    public function handle(): void
    {
        $batch = BulkEmailBatch::find($this->batchId);
        if (!$batch) {
            Log::error("BulkEmailBatch dengan ID {$this->batchId} tidak ditemukan.");
            return;
        }

        $batch->update(['status' => 'processing']);
        
        // Sesuaikan 'program_type' dengan nama kolom di tabel Anda, contoh: 'program'
        $model = ($batch->program === 'artopia') ? new ArtopiaData() : new AncientData();
        $recipients = $model->where('status_seleksi', $batch->filter_status)->get();

        $sentCount = 0;
        $failedCount = 0;

        foreach ($recipients as $recipient) {
            try {
                $body = str_replace('{{name}}', $recipient->nama_lengkap, $batch->body);
                $body = str_replace('{{email}}', $recipient->email, $body);

                Mail::to($recipient->email)->send(new BulkNotificationMail($batch->subject, $body));
                
                EmailLog::create([
                    'batch_id' => $this->batchId,
                    'recipient_email' => $recipient->email,
                    'recipient_name' => $recipient->nama_lengkap,
                    'subject' => $batch->subject,
                    'body' => $body,
                    'status' => 'sent',
                    'sent_at' => now(),
                ]);
                $sentCount++;

            } catch (\Exception $e) {
                $failedCount++;
                Log::error("Gagal mengirim email ke {$recipient->email} untuk batch ID {$this->batchId}: " . $e->getMessage());
                
                EmailLog::create([
                     'batch_id' => $this->batchId,
                    'recipient_email' => $recipient->email,
                    'recipient_name' => $recipient->nama_lengkap,
                    'subject' => $batch->subject,
                    'body' => $body,
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                    'sent_at' => now(),
                ]);
            }
        }

        $batch->update([
            'status' => 'completed',
            'sent_count' => $sentCount,
            'failed_count' => $failedCount,
        ]);
    }
}