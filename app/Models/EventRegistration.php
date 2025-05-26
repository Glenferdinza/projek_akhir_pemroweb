<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'registration_status',
        'registered_at',
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

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeConfirmed($query)
    {
        return $query->where('registration_status', 'confirmed');
    }

    public function scopePending($query)
    {
        return $query->where('registration_status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', true);
    }
}