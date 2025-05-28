<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class EventCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    protected $dates = ['deleted_at'];

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            if (!$category->slug) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && !$category->isDirty('slug')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Relationships
    public function events()
    {
        return $this->hasMany(Event::class, 'category', 'slug');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
    }

    // Accessors
    public function getEventsCountAttribute()
    {
        return $this->events()->count();
    }

    public function getActiveEventsCountAttribute()
    {
        return $this->events()->active()->count();
    }

    public function getUpcomingEventsCountAttribute()
    {
        return $this->events()->active()->upcoming()->count();
    }

    // Methods
    public function hasEvents()
    {
        return $this->events()->exists();
    }

    public function hasActiveEvents()
    {
        return $this->events()->active()->exists();
    }

    // Static methods
    public static function getActiveCategories()
    {
        return static::active()->ordered()->get();
    }

    public static function getCategoriesWithEventCount()
    {
        return static::active()
            ->ordered()
            ->withCount(['events', 'events as active_events_count' => function ($query) {
                $query->active();
            }])
            ->get();
    }
}