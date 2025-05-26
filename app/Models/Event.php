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
        'title',
        'description',
        'category',
        'status',
        'start_date',
        'end_date',
        'location',
        'organizer',
        'contact_email',
        'contact_phone',
        'max_participants',
        'current_participants',
        'registration_fee',
        'image_url',
        'requirements',
        'additional_info',
        'is_featured',
        'created_by',
        'image',
        'user_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'requirements' => 'array',
        'registration_fee' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_registrations')
                    ->withPivot(['registration_status', 'registered_at', 'payment_status'])
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
        return $query->where('start_date', '>', now());
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Accessors
    public function getIsUpcomingAttribute()
    {
        return $this->start_date > now();
    }

    public function getIsOngoingAttribute()
    {
        return $this->start_date <= now() && $this->end_date >= now();
    }

    public function getIsCompletedAttribute()
    {
        return $this->end_date < now();
    }

    public function getAvailableSlotsAttribute()
    {
        if (!$this->max_participants) return null;
        return $this->max_participants - $this->current_participants;
    }

    public function getIsFull()
    {
        if (!$this->max_participants) return false;
        return $this->current_participants >= $this->max_participants;
    }

    // Methods
    public function incrementParticipants()
    {
        $this->increment('current_participants');
    }

    public function decrementParticipants()
    {
        $this->decrement('current_participants');
    }
}