<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function createEvent(Request $request)
    {
        try {
            $request->validate([
                'eventName' => 'required',
                'eventDate' => 'required|date',
                'location' => 'required',
                'eventImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $event = new Event();
            $event->eventName = $request->eventName;
            $event->eventDate = $request->eventDate;
            $event->location = $request->location;
            $event->eventImage = $request->eventImage ?? null;

            $event->save();

            return response()->json([
                'success' => true,
                'message' => 'Event created successfully',
                'data' => $event
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Event cant be created',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function getAllEvents()
    {
        try {
            $events = Event::all();

            return response()->json([
                'success' => true,
                'message' => 'Events retrieved successfully',
                'data' => $events
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Events cant be retrieved',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
