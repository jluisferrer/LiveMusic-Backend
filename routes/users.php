<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//USERS
Route::get('/users', [UserController::class, 'getAllUsers'])->middleware('auth:sanctum')->middleware('super_admin');
Route::put('/users/update/{id}', [UserController::class, 'userAdminUpdate'])->middleware('auth:sanctum', 'super_admin');
Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->middleware('auth:sanctum', 'super_admin');
Route::get('/users/profile/', [UserController::class, 'getUserProfile'])->middleware('auth:sanctum');
Route::put('/users/update/', [UserController::class, 'updateUser'])->middleware('auth:sanctum');
Route::put('users/addToGroup', [UserController::class, 'addToGroup'])->middleware('auth:sanctum');
