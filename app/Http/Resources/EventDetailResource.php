<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EventDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = $request->user();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'starts_at' => $this->starts_at
                ? $this->starts_at->translatedFormat('d F, Y') : null,
            'starts_time' => $this->starts_at
                ? $this->starts_at->format('H:i') : null,
            'price' => $this->price,
            'image' => url(Storage::url($this->image)),
            'full_address' => implode(', ', array_filter([
                $this->venue->name,
                $this->venue->address,
                $this->venue->city->name,
            ])),
            'hall' => $this->hall->name,
            'category' => $this->category->name,
            'is_user_registered' => $user
                ? $this->isUserRegistered($user->id) : false,
            'capacity' => $this->max_participants,
            'registered_count' => $this->registrations(),
        ];
    }
}