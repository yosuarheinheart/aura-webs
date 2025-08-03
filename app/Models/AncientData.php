<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\SelectionStatusMail;
use Illuminate\Support\Facades\Log;

class AncientData extends Model
{
    use HasFactory;
    protected $table = 'ancient_data';
    public $incrementing = false; 
    protected $keyType = 'int';   
    
    protected $fillable = [
        'id',
        'nama_lengkap',
        'nim',
        'angkatan',
        'email',
        'id_line',
        'instagram',
        'lokasi_pilihan',
        'dokumen_esai',
        'status_seleksi',
        'catatan_admin',
        'status_kirim'
    ];

     protected $attributes = [
        'status_seleksi' => 'pending',
        'status_kirim' => 'Belum Dikirim'
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Override timestamps sesuai struktur tabel
    const CREATED_AT = 'timestamp';
    const UPDATED_AT = 'updated_at';

    const STATUS_PENDING = 'pending';
    const STATUS_LOLOS = 'lolos';
    const STATUS_GAGAL = 'gagal';
    
    const KIRIM_BELUM = 'Belum Dikirim';
    const KIRIM_TERKIRIM = 'Terkirim';

    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        // Event saat data baru dibuat (submit form)
        static::created(function ($registration) {
            // Hanya kirim email jika status pending (pendaftaran baru)
            if ($registration->status_seleksi === 'pending') {
                try {
                    Log::info('MODEL EVENT: Attempting to send registration confirmation email to: ' . $registration->email);
                    
                    Mail::to($registration->email)->send(
                        new SelectionStatusMail($registration, 'ancient')
                    );
                    
                    Log::info('MODEL EVENT: Registration confirmation email queued successfully for: ' . $registration->email);
                } catch (\Throwable $e) {
                    Log::error('MODEL EVENT: Failed to queue registration confirmation email for ' . $registration->email . ': ' . $e->getMessage());
                }
            }
        });
    }

    // Helper method untuk mendapatkan status dalam bahasa Indonesia
    public function getStatusIndonesian()
    {
        $statusMap = [
            'pending' => 'Menunggu Review',
            'lolos' => 'Lolos Seleksi',
            'gagal' => 'Tidak Lolos'
        ];

        return $statusMap[$this->status_seleksi] ?? $this->status_seleksi;
    }

    public function getStatusClassAttribute()
    {
        return match($this->status_seleksi) {
            'pending' => 'warning',
            'lolos' => 'success',
            'gagal' => 'danger',
            default => 'secondary'
        };
    }

    // Helper method untuk mendapatkan warna status
    public function getStatusColor()
    {
        $colorMap = [
            'pending' => '#ffc107',
            'lolos' => '#28a745',
            'tidak_lolos' => '#dc3545'
        ];

        return $colorMap[$this->status_seleksi] ?? '#6c757d';
    }
        // Scopes
    public function scopePending($query)
    {
        return $query->where('status_seleksi', self::STATUS_PENDING);
    }

    public function scopeLolos($query)
    {
        return $query->where('status_seleksi', self::STATUS_LOLOS);
    }

    public function scopeGagal($query)
    {
        return $query->where('status_seleksi', self::STATUS_GAGAL);
    }

    public function scopeBelumKirim($query)
    {
        return $query->where('status_kirim', self::KIRIM_BELUM);
    }

    public function scopeSudahKirim($query)
    {
        return $query->where('status_kirim', self::KIRIM_TERKIRIM);
    }

    // Helper methods
    public function isPending()
    {
        return $this->status_seleksi === self::STATUS_PENDING;
    }

    public function isLolos()
    {
        return $this->status_seleksi === self::STATUS_LOLOS;
    }

    public function isGagal()
    {
        return $this->status_seleksi === self::STATUS_GAGAL;
    }

    public function isSudahKirim()
    {
        return $this->status_kirim === self::KIRIM_TERKIRIM;
    }

    public function canSendEmail()
    {
        return in_array($this->status_seleksi, [self::STATUS_LOLOS, self::STATUS_GAGAL]);
    }

    public function canEditStatus()
    {
        return $this->status_seleksi === self::STATUS_PENDING;
    }
}