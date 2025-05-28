<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category_id',
        'status',
        'start_date',
        'end_date',
        'event_date',
        'event_time',
        'location',
        'organizer',
        'contact_email',
        'contact_phone',
        'max_participants',
        'current_participants',
        'registration_fee',
        'price',
        'image',
        'image_url',
        'requirements',
        'additional_info',
        'is_featured',
        'is_free',
        'registration_deadline',
        'event_type',
        'slug',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'event_date' => 'date',
        'event_time' => 'datetime',
        'registration_deadline' => 'datetime',
        'requirements' => 'array',
        'additional_info' => 'array',
        'registration_fee' => 'decimal:2',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_free' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_registrations')
                    ->withPivot(['registration_status', 'registered_at', 'payment_status', 'registration_date', 'status'])
                    ->withTimestamps();
    }

    public function registeredUsers()
    {
        return $this->belongsToMany(User::class, 'event_registrations')
                    ->withPivot('registration_status', 'registered_at', 'payment_status', 'registration_date', 'status')
                    ->withTimestamps();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        // Support both date formats
        return $query->where(function($q) {
            $q->where('start_date', '>', now())
              ->orWhere('event_date', '>=', now());
        });
    }

    public function scopeByCategory($query, $category)
    {
        if (is_numeric($category)) {
            return $query->where('category_id', $category);
        }
        return $query->where('category', $category);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeFree($query)
    {
        return $query->where('is_free', true)
                    ->orWhere('registration_fee', 0)
                    ->orWhere('price', 0);
    }

    // Accessors & Mutators
    public function getIsUpcomingAttribute()
    {
        return ($this->start_date && $this->start_date > now()) || 
               ($this->event_date && $this->event_date >= now());
    }

    public function getIsOngoingAttribute()
    {
        if ($this->start_date && $this->end_date) {
            return $this->start_date <= now() && $this->end_date >= now();
        }
        return false;
    }

    public function getIsCompletedAttribute()
    {
        return ($this->end_date && $this->end_date < now()) || 
               ($this->event_date && $this->event_date < now());
    }

    public function getAvailableSlotsAttribute()
    {
        if (!$this->max_participants) return null;
        
        $confirmedRegistrations = $this->registrations()
            ->where(function($query) {
                $query->where('registration_status', 'confirmed')
                      ->orWhere('status', 'confirmed');
            })
            ->count();
            
        return $this->max_participants - $confirmedRegistrations;
    }

    public function getAvailableSpotsAttribute()
    {
        return $this->getAvailableSlotsAttribute();
    }

    public function getIsFullAttribute()
    {
        if (!$this->max_participants) return false;
        
        $confirmedRegistrations = $this->registrations()
            ->where(function($query) {
                $query->where('registration_status', 'confirmed')
                      ->orWhere('status', 'confirmed');
            })
            ->count();
            
        return $confirmedRegistrations >= $this->max_participants;
    }

    public function getFormattedPriceAttribute()
    {
        if ($this->is_free || $this->registration_fee == 0 || $this->price == 0) {
            return 'Gratis';
        }
        
        $price = $this->registration_fee ?? $this->price ?? 0;
        return 'Rp ' . number_format($price, 0, ',', '.');
    }

    public function getFormattedRegistrationFeeAttribute()
    {
        return $this->getFormattedPriceAttribute();
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'active' => 'success',
            'cancelled' => 'danger',
            'completed' => 'secondary',
            'draft' => 'warning',
            default => 'primary'
        };
    }

    // Methods (both versions)
    public function isFull()
    {
        return $this->getIsFullAttribute();
    }

    public function getIsFull()
    {
        return $this->getIsFullAttribute();
    }

    public function incrementParticipants()
    {
        $this->increment('current_participants');
    }

    public function decrementParticipants()
    {
        if ($this->current_participants > 0) {
            $this->decrement('current_participants');
        }
    }

    public function updateParticipantCount()
    {
        $confirmedCount = $this->registrations()
            ->where(function($query) {
                $query->where('registration_status', 'confirmed')
                      ->orWhere('status', 'confirmed');
            })
            ->count();
            
        $this->update(['current_participants' => $confirmedCount]);
    }

    // Helper methods
    public function canRegister()
    {
        if ($this->status !== 'active') return false;
        if ($this->is_full) return false;
        if ($this->registration_deadline && $this->registration_deadline < now()) return false;
        
        // Check both date formats
        $eventStarted = ($this->start_date && $this->start_date <= now()) || 
                       ($this->event_date && $this->event_date < now());
        
        if ($eventStarted) return false;
        
        return true;
    }
}