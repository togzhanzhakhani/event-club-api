<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'starts_at' => $this->starts_at,
            'is_paid' => $this->is_paid,
            'price' => $this->price,
            'category' => $this->category->name,
            'venue' => $this->venue->name,
            'hall' => $this->hall->name,
        ];
    }
}
