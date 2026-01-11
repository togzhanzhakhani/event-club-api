<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'name',
        'address',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function halls()
    {
        return $this->hasMany(Hall::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}