<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'name',
        'capacity',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}