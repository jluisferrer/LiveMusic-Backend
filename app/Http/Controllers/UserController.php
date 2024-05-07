<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function getAllUsers()
    {
        try {
            $users = User::all();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Users retrieved succesfully",
                    'data' => $users
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success' => false,
                    'message' => "Users cant be retrieved",
                    'error' => $th->getMessage()
                ],
                500
            );
        }
    }

    public function getUserProfile()
    {
        try {
            $user = auth()->user();

            return response()->json([
                'success' => true,
                'message' => 'User profile obtained successfully',
                'data' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success' => false,
                    'message' => "Users profile cant be retrieved",
                    'error' => $th->getMessage()
                ],
                500
            );
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->role === 'super_admin') {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to remove a super_admin'
                ], 403);
            };
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Successfully deleted user'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Could not delete user',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function updateUser(Request $request)
    {
        try {
            $user = auth()->user();

            $user->name = $request->input('name', $user->name);
            $user->email = $request->input('email', $user->email);
            if ($request->filled('password')) {
                $user->password = bcrypt($request->input('password'));
            }

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Could not update user',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function addToGroup(Request $request)
    {
        try {
          // Buscar el usuario y el grupo por sus nombres
        $user = User::where('name', $request->input('userName'))->first();
        $group = Group::where('groupName', $request->input('groupName'))->first();

        if (!$user || !$group) {
            return response()->json([
                'success' => false,
                'message' => 'User or group not found',
            ], 404);
        }
            // Crear una nueva entrada en la tabla usergroupevent
            DB::table('usergroupevent')->insert([
                'user_id' => $user->id,
                'group_id' => $group->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User added to group successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Could not add user to group',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
