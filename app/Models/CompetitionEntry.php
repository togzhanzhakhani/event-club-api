<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_id',
        'user_id',
        'status',
        'participated_at',
    ];

    protected $casts = [
        'participated_at' => 'datetime',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}