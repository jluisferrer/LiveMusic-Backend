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
            $events = Event::with('groups')->get();

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

    public function getEventById($id)
    {
        try {
            $event = Event::find($id);
            if (!$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'Event not found'
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'Event retrieved successfully',
                'data' => $event
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Event cant be retrieved',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function updateEvent(Request $request, $id)
    {
        try {
            $event = Event::find($id);
            if (!$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'Event not found'
                ], 404);
            }
            $request->validate([
                'eventName' => 'required',
                'eventDate' => 'required|date',
                'location' => 'required',
                'eventImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $event->eventName = $request->eventName;
            $event->eventDate = $request->eventDate;
            $event->location = $request->location;
            $event->eventImage = $request->eventImage ?? null;

            $event->save();

            return response()->json([
                'success' => true,
                'message' => 'Event updated successfully',
                'data' => $event
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Event cant be updated',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    
    public function DeleteEvent($id)
    {
        try {
            $event = Event::find($id);
            if (!$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'Event not found'
                ], 404);
            }
            $event->delete();

            return response()->json([
                'success' => true,
                'message' => 'Event deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Event cant be deleted',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
