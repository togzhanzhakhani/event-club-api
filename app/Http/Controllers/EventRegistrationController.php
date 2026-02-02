<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $user = $request->user();
        if ($event->isUserRegistered($user->id)) {
            return response()->json([
                'message' => 'You are already registered for this event'
            ], 409);
        }
        if (! $event->hasFreeSlots()) {
            return response()->json([
                'message' => 'No available slots for this event'
            ], 422);
        }
        $event->registrations()->create([
            'user_id' => $user->id,
        ]);
        return response()->json(['message' => 'SUCCESS'], 201);
    }
}