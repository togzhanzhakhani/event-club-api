<?php

namespace App\Http\Resources;

use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => $this->email,
            'preferences' => [
                'city_id'    => data_get($this->preferences, 'city_id'),
                'categories' => EventCategory::whereIn(
                    'id',
                    data_get($this->preferences, 'categories', [])
                )->get(['name']),
            ]
        ];
    }
}
