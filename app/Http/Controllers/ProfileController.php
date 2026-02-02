<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function events(Request $request)
    {
        $user = $request->user();
        $events = $user->registeredEvents()
            ->with(['venue.city', 'category'])
            ->orderBy('starts_at')->get();
        return EventResource::collection($events);
    }
}
