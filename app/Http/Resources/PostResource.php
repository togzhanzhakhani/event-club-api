<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'title'    => $this->title,
            'content'  => $this->content,
            'image'    => url(Storage::url($this->image)),
            'category' => $this->category->name,
            'views'    => $this->views,
            'created_at' => $this->created_at->format('d M, Y'),
        ];
    }
}
