<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\ProfileResource;
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

    public function show(Request $request)
    {
        return new ProfileResource($request->user());
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $user->update($request->validated());
        return new ProfileResource($user);
    }
}
