<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return EventResource::collection(
            Event::where('status', 'published')
                ->with(['venue', 'hall', 'category'])
                ->orderBy('starts_at')->get()
        );
    }
}