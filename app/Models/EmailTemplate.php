<?php

// app/Models/EmailTemplate.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'program', 
        'status_type', 
        'subject', 
        'body', 
        'type', 
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public static function getTemplate($name)
    {
        return self::where('name', $name)->where('is_active', true)->first();
    }

    public function renderSubject($variables = [])
    {
        $subject = $this->subject;
        foreach ($variables as $key => $value) {
            $subject = str_replace('{{' . $key . '}}', $value, $subject);
        }
        return $subject;
    }

    public function renderBody($variables = [])
    {
        $body = $this->body;
        foreach ($variables as $key => $value) {
            $body = str_replace('{{' . $key . '}}', $value, $body);
        }
        return $body;
    }

     public function scopeForProgram($query, $program)
    {
        return $query->where('program', $program);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status_type', $status);
    }
}