<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'color', 'icon'];

    public function events()
    {
        return $this->hasMany(Event::class, 'category_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}