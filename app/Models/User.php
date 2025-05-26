<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'institution',
        'student_id',
        'profile_image',
        'bio',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

    // Relationships
    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function registeredEvents()
    {
        return $this->belongsToMany(Event::class, 'event_registrations')
                    ->withPivot(['registration_status', 'registered_at', 'payment_status'])
                    ->withTimestamps();
    }

    // Accessors & Mutators
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/profile_images/' . $this->profile_image);
        }
        return asset('images/default-avatar.png');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    // Methods
    public function updateLastLogin()
    {
        $this->update(['last_login_at' => now()]);
    }
}