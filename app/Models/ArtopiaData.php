<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\SelectionStatusMail;

class ArtopiaData extends Model
{
    use HasFactory;

    protected $table = 'artopia_data';
    public $incrementing = false; 
    protected $keyType = 'int'; 
    
    // --- PERUBAHAN 1: Tambahkan 'status_kirim' ke $fillable ---
    protected $fillable = [
        'id',
        'nama_kelompok',
        'nama_lengkap',
        'nim',
        'angkatan',
        'email',
        'id_line',
        'instagram',
        'nama_booth',
        'deskripsi_booth',
        'tanggal_booth',
        'dokumen_pendukung',
        'status_seleksi',
        'catatan_admin',
        'status_kirim' // Ditambahkan
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'updated_at' => 'datetime',
    ];

    const CREATED_AT = 'timestamp';
    const UPDATED_AT = 'updated_at';

    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        // Event saat data baru dibuat (submit form)
        // INI BOLEH TETAP ADA untuk mengirim email konfirmasi pendaftaran awal
        static::created(function ($registration) {
            Log::info('Artopia Registration - Created event triggered for: ' . $registration->email);
            // Hanya kirim email untuk pendaftar utama (bukan member dengan email placeholder/null)
            if ($registration->status_seleksi === 'pending' && !empty($registration->email) && !str_contains($registration->email, '_member')) {
                try {
                    Log::info('Artopia Registration - Attempting to send initial confirmation email to: ' . $registration->email);
                    Mail::to($registration->email)->send(
                        new SelectionStatusMail($registration, 'artopia')
                    );
                    Log::info('Artopia Registration - Initial email sent successfully to: ' . $registration->email);
                    // Tandai email pendaftaran terkirim
                    $registration->status_kirim = 'Terkirim (Pendaftaran)';
                    $registration->saveQuietly(); // Simpan tanpa mentrigger event lagi
                } catch (\Exception $e) {
                    Log::error('Artopia Registration - Failed to send initial email: ' . $e->getMessage());
                }
            }
        });
    }
}