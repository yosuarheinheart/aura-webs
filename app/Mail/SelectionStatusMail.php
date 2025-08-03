<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SelectionStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $event_type; // 'ancient' atau 'artopia'

    /**
     * Create a new message instance.
     */
    public function __construct($registration, $event_type = 'ancient')
    {
        $this->registration = $registration;
        $this->event_type = $event_type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $eventName = $this->event_type === 'artopia' ? 'Artopia Creative Market' : 'Ancient Academy';
        
        // Tentukan subject berdasarkan status dan event
        $subject = $this->getSubject($eventName);
        
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Tentukan template berdasarkan event type
        $view = $this->event_type === 'artopia' ?
            'emails.artopia_status' :
            'emails.selection_status';

        return new Content(
            view: $view,
            // Tambahkan baris ini untuk meneruskan data ke view
            with: ['data' => $this->registration],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Get email subject based on status and event
     */
    private function getSubject($eventName)
    {
        switch ($this->registration->status_seleksi) {
            case 'pending':
                return "Konfirmasi Pendaftaran {$eventName} - Pendaftaran Berhasil Diterima";
            case 'lolos':
                return "🎉 Selamat! Anda Lolos Seleksi {$eventName}";
            case 'gagal':
                return "Hasil Seleksi {$eventName} - Terima Kasih Atas Partisipasi Anda";
            default:
                return "Update Status Pendaftaran {$eventName}";
        }
    }
}