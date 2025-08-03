<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BulkEmailBatch extends Model
{
    protected $table = 'bulk_email_batches';

    protected $fillable = [
        'name',
        'subject',
        'body',
        'status',
        'total_recipients',
        'sent_count',
        'failed_count',
        'filter_status',
        'created_by',
    ];

    /**
     * Relasi ke admin pembuat batch.
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    /**
     * Relasi ke email log yang terkait dengan batch ini.
     */
    public function emailLogs(): HasMany
    {
        return $this->hasMany(EmailLog::class, 'batch_id');
    }
}
