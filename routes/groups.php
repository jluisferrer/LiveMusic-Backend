<?php

use App\Http\Controllers\GroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// GROUPS
Route::post('/groups', [GroupController::class, 'createGroup'])->middleware('auth:sanctum', 'super_admin');
Route::get('/groups', [GroupController::class, 'getAllGroups'])->middleware('auth:sanctum');
Route::get('/groups/{id}', [GroupController::class, 'getGroupById'])->middleware('auth:sanctum');
Route::put('/groups/{id}', [GroupController::class, 'updateGroup'])->middleware('auth:sanctum', 'super_admin');
Route::delete('/groups/{id}', [GroupController::class, 'deleteGroup'])->middleware('auth:sanctum', 'super_admin');
