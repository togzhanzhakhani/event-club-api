<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_id',
        'starts_at',
        'ends_at',
        'reward_description',
        'status',
        'image',
        'winners_count',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function entries()
    {
        return $this->hasMany(CompetitionEntry::class);
    }

    public function winners()
    {
        return $this->hasMany(CompetitionEntry::class)
                    ->where('status', 'winner');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('starts_at', '<=', now())
                    ->where('ends_at', '>', now());
    }

    public function isUserParticipated($userId): bool
    {
        return $this->entries()
                    ->where('user_id', $userId)
                    ->exists();
    }
}