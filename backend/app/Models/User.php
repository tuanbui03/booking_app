<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Thêm import này

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens; // Thêm HasApiTokens trait

    protected $fillable = [
        'firstname',
        'lastname',
        'phone_number',
        'dob',
        'email',
        'password',
        'role_id'
    ];

    protected $hidden = ['password'];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'dob' => 'date',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Scope a query to only include users with specific role.
     */
    public function scopeWithRole($query, $roleId)
    {
        return $query->where('role_id', $roleId);
    }
}
