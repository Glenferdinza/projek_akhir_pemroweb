<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventRegistration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_id',
        'user_id',
        'registration_status', // menggunakan nama dari kode asli Anda
        'registered_at', // menggunakan nama dari kode asli Anda  
        'additional_data',
        'notes',
        'payment_status',
        'payment_method',
        'amount_paid'
    ];

    protected $casts = [
        'registered_at' => 'datetime',
        'additional_data' => 'array',
        'payment_status' => 'boolean',
        'amount_paid' => 'decimal:2'
    ];

    /**
     * Get the event that owns the registration.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the user that owns the registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for confirmed registrations
     */
    public function scopeConfirmed($query)
    {
        return $query->where('registration_status', 'confirmed');
    }

    /**
     * Scope for active registrations (alias for confirmed)
     */
    public function scopeActive($query)
    {
        return $query->where('registration_status', 'confirmed');
    }

    /**
     * Scope for pending registrations
     */
    public function scopePending($query)
    {
        return $query->where('registration_status', 'pending');
    }

    /**
     * Scope for paid registrations
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', true);
    }
}