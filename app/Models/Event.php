<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_type',
        'starts_at',
        'ends_at',
        'venue_id',
        'hall_id',
        'category_id',
        'is_paid',
        'price',
        'status',
        'image',
        'max_participants',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_paid' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('starts_at', '>', now())
                    ->where('status', 'published')
                    ->orderBy('starts_at');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function isUserRegistered($userId): bool
    {
        return $this->registrations()
                    ->where('user_id', $userId)
                    ->where('status', 'registered')
                    ->exists();
    }

    public function availableSlots(): int
    {
        if (!$this->max_participants) {
            return 9999;
        }
        
        $registered = $this->registrations()
                          ->where('status', 'registered')
                          ->count();
        
        return max(0, $this->max_participants - $registered);
    }
}