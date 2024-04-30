<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

    public function deleteUser($id){
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
}
