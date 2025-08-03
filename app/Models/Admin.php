<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Automatically hash password when setting
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Check if admin is active
     */
    public function isActive()
    {
        return $this->is_active ?? true; // Default true jika kolom belum ada
    }

    /**
     * Check if admin has specific role
     */
    public function hasRole($role)
    {
        return ($this->role ?? 'admin') === $role;
    }

    /**
     * Get admin's display name
     */
    public function getDisplayNameAttribute()
    {
        return $this->name;
    }

    /**
     * Get admin role with default
     */
    public function getRoleAttribute($value)
    {
        return $value ?? 'admin';
    }

    /**
     * Get is_active with default
     */
    public function getIsActiveAttribute($value)
    {
        return $value ?? true;
    }

    /**
     * Scope for active admins
     */
    public function scopeActive($query)
    {
        // Cek apakah kolom is_active ada
        try {
            if (Schema::hasColumn('admins', 'is_active')) {
                return $query->where('is_active', true);
            }
        } catch (\Exception $e) {
            // Jika ada error checking schema, return query biasa
        }
        return $query; // Return semua jika kolom tidak ada
    }

    /**
     * Scope for specific role
     */
    public function scopeRole($query, $role)
    {
        // Cek apakah kolom role ada
        try {
            if (Schema::hasColumn('admins', 'role')) {
                return $query->where('role', $role);
            }
        } catch (\Exception $e) {
            // Jika ada error checking schema, return query biasa
        }
        return $query; // Return semua jika kolom tidak ada
    }
}