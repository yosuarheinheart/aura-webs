<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailLog extends Model
{
    protected $table = 'email_logs';

    protected $fillable = [
        'recipient_email',
        'recipient_name',
        'subject',
        'body',
        'status',
        'type',
        'batch_id',
        'error_message',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /**
     * Relasi ke batch (jika ada).
     */
    public function batch(): BelongsTo
    {
        return $this->belongsTo(BulkEmailBatch::class, 'batch_id');
    }
}
