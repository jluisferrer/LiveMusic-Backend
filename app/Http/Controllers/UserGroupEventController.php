<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Group;
use App\Models\User;
use App\Models\UserGroupEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserGroupEventController extends Controller
{
    public function createGroupEvent(Request $request)
    {
        try {
            $request->validate([
                'groupName' => 'required',
                'groupDescription' => 'required',
                'groupImage' => 'nullable|url',
                'eventName' => 'required',
                'eventDate' => 'required|date',
                'location' => 'required',
                'eventImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $group = new Group();
            $group->groupName = $request->groupName;
            $group->groupDescription = $request->groupDescription;
            $group->groupImage = $request->groupImage ?? null;

            $group->save();

            $event = new Event();
            $event->eventName = $request->eventName;
            $event->eventDate = $request->eventDate;
            $event->location = $request->location;
            $event->eventImage = $request->eventImage ?? null;

            $event->save();

            return response()->json([
                'success' => true,
                'message' => 'Group and Event created successfully',
                'data' => [
                    'group' => $group,
                    'event' => $event
                ]
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Group and Event cant be created',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function joinUserEvent(Request $request, $eventId)
    {
        try {
            $user = $request->user();
            $event = Event::findOrfail($eventId);

            if (!$user || !$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'User or Event not found',
                ], 404);
            }

            UserGroupEvent::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'User joined event successfully',
                'event' => $event,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'User cant join event',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function getUserEvents(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }

            $events = $user->events()->with('groups')->get();

            return response()->json([
                'success' => true,
                'message' => 'User events retrieved successfully',
                'data' => $events
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'User events cant be retrieved',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function joinGroupEvent($groupId, $eventId)
    {
        try {
            // Buscar el grupo y el evento por sus IDs
            $group = Group::findOrFail($groupId);
            $event = Event::findOrFail($eventId);
    
            if (!$group || !$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group or event not found',
                ], 404);
            }
    
            // Comprobar si el grupo ya está añadido al eventoooo
            $existingEntry = UserGroupEvent::where('group_id', $groupId)->where('event_id', $eventId)->first();
            if ($existingEntry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group is already added to the event',
                ], 409);
            }
    
            // Añadir el grupo al evento
            UserGroupEvent::create([
                'group_id' => $group->id,
                'event_id' => $event->id,
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Group joined the event successfully',
                'event' => $event,
            ], 200);
                
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Could not add group to event',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    
    

    public function getGroupEvents($groupId)
    {
        try {
            $group = Group::findOrfail($groupId);

            if (!$group) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group not found',
                ], 404);
            }

            $events = $group->events;

            return response()->json([
                'success' => true,
                'message' => 'Group events retrieved successfully',
                'data' => $events
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Group events cant be retrieved',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function deleteUserEvent(Request $request, $eventId)
    {
        try {
            $user = $request->user();
            $event = Event::findOrfail($eventId);

            if (!$user || !$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'User or Event not found',
                ], 404);
            }

            DB::table('usergroupevent')
                ->where('user_id', $user->id)
                ->where('event_id', $event->id)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted from event successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'User cant be deleted from event',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function deleteGroupEvent ($groupId, $eventId)
    {
        try {
            $group = Group::findOrfail($groupId);
            $event = Event::findOrfail($eventId);

            if (!$group || !$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group or Event not found',
                ], 404);
            }

            DB::table('usergroupevent')
                ->where('group_id', $group->id)
                ->where('event_id', $event->id)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Group deleted from event successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Group cant be deleted from event',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
