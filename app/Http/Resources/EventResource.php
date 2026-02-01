<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'starts_at' => $this->starts_at
                ? $this->starts_at->translatedFormat('d F, Y') : null,
            'starts_time' => $this->starts_at
                ? $this->starts_at->format('H:i') : null,
            'price' => $this->price,
            'category' => $this->category->name,
            'image' => url(Storage::url($this->image)),
            'capacity' => $this->max_participants,
            'registered_count' => $this->registrations()->count(),
        ];
    }
}
