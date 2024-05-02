<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function createGroup(Request $request)
    {
        try {
            $request->validate([
                'groupName' => 'required',
                'groupDescription' => 'required',
                'groupImage'=>'nullable|url',
            ]);
            $group = new Group();
            $group->groupName = $request->groupName;
            $group->groupDescription = $request->groupDescription;
            $group->groupImage = $request->groupImage ?? null;

            $group->save();

            return response()->json([
                'success' => true,
                'message' => 'Group created successfully',
                'data' => $group
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Group cant be created',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
