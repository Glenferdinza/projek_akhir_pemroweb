<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'institution', 
        'student_id',
        'profile_image',
        'bio',
        'is_active',
        'email_verified_at',
        'role',
        'last_login_at',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'is_active' => 'boolean',
            'password' => 'hashed',
        ];
    }

    // Relationships

    /**
     * Get the events created by this user.
     */
    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    /**
     * Get the events organized by this user.
     */
    public function organizedEvents()
    {
        return $this->hasMany(Event::class, 'user_id');
    }

    /**
     * Get the event registrations for this user.
     */
    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    /**
     * Get the events this user is registered for.
     */
    public function registeredEvents()
    {
        return $this->belongsToMany(Event::class, 'event_registrations')
                    ->withPivot(['registration_status', 'registered_at', 'payment_status', 'status', 'amount_paid'])
                    ->withTimestamps();
    }

    // Accessors & Mutators

    /**
     * Get the profile image URL.
     */
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/profile_images/' . $this->profile_image);
        }
        return asset('images/default-avatar.png');
    }

    /**
     * Get the user's full name with institution if available.
     */
    public function getFullNameAttribute()
    {
        if ($this->institution) {
            return $this->name . ' (' . $this->institution . ')';
        }
        return $this->name;
    }

    /**
     * Get the user's initials for avatar.
     */
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);
        $initials = '';
        
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
            if (strlen($initials) >= 2) break;
        }
        
        return $initials ?: strtoupper(substr($this->name, 0, 2));
    }

    // Scopes

    /**
     * Scope to get only active users.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get only verified users.
     */
    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    /**
     * Scope to filter users by role.
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    // Event-related Methods

    /**
     * Check if user is registered for a specific event.
     */
    public function isRegisteredForEvent($eventId)
    {
        return $this->eventRegistrations()
                    ->where('event_id', $eventId)
                    ->exists();
    }

    /**
     * Get registration status for a specific event.
     */
    public function getEventRegistrationStatus($eventId)
    {
        $registration = $this->eventRegistrations()
                             ->where('event_id', $eventId)
                             ->first();
        
        return $registration ? $registration->registration_status : null;
    }

    /**
     * Get registration details for a specific event.
     */
    public function getEventRegistration($eventId)
    {
        return $this->eventRegistrations()
                    ->where('event_id', $eventId)
                    ->first();
    }

    /**
     * Check if user can register for an event.
     */
    public function canRegisterForEvent($event)
    {
        if (!$this->isActive()) return false;
        if ($this->isRegisteredForEvent($event->id)) return false;
        
        return $event->canRegister();
    }

    // General Methods

    /**
     * Update the user's last login timestamp.
     */
    public function updateLastLogin()
    {
        $this->update(['last_login_at' => now()]);
    }

    /**
     * Check if user has completed their profile.
     */
    public function hasCompleteProfile()
    {
        return !empty($this->name) && 
               !empty($this->email) && 
               !empty($this->phone);
    }

    /**
     * Check if user is active.
     */
    public function isActive()
    {
        return $this->is_active === true;
    }

    /**
     * Activate the user account.
     */
    public function activate()
    {
        $this->update(['is_active' => true]);
    }

    /**
     * Deactivate the user account.
     */
    public function deactivate()
    {
        $this->update(['is_active' => false]);
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Check if user is an organizer.
     */
    public function isOrganizer()
    {
        return $this->role === 'organizer' || $this->role === 'admin';
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Get user's upcoming registered events.
     */
    public function getUpcomingEventsAttribute()
    {
        return $this->registeredEvents()
                    ->where('start_date', '>', now())
                    ->where('registration_status', 'confirmed')
                    ->get();
    }

    /**
     * Get count of user's confirmed event registrations.
     */
    public function getConfirmedRegistrationsCountAttribute()
    {
        return $this->eventRegistrations()
                    ->where('registration_status', 'confirmed')
                    ->count();
    }
}