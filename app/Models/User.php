<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'preferences',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'preferences' => 'array',
    ];

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function competitionEntries()
    {
        return $this->hasMany(CompetitionEntry::class);
    }

    public function registeredEvents()
    {
        return $this->belongsToMany(Event::class, 'event_registrations')
                    ->withPivot('status', 'registered_at', 'attended_at')
                    ->withTimestamps();
    }

    public function attendedEventsCount(): int
    {
        return $this->eventRegistrations()
                    ->where('status', 'attended')
                    ->count();
    }
}