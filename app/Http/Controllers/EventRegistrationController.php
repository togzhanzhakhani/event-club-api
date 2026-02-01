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
        $alreadyRegistered = EventRegistration::where('user_id', $user->id)
            ->where('event_id', $event->id)->exists();
        if ($alreadyRegistered) {
            return response()->json([
                'message' => 'You are already registered for this event'
            ], 409);
        }
        if ($event->max_participants !== null) {
            $registeredCount = EventRegistration::where('event_id', $event->id)->count();
            if ($registeredCount >= $event->max_participants) {
                return response()->json([
                    'message' => 'No available slots for this event'
                ], 422);
            }
        }
        EventRegistration::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);
        return response()->json(['message' => 'SUCCESS'], 201);
    }
}