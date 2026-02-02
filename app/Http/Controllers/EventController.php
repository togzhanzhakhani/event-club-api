<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Http\Resources\EventDetailResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return EventResource::collection(
            Event::active()->with(['venue', 'hall', 'category'])
                ->orderBy('starts_at')->get()
        );
    }

    public function show(Event $event)
    {
        $event->load([
            'venue.city', 'hall',
            'category', 'registrations',
        ]);
        return new EventDetailResource($event);
    }
}