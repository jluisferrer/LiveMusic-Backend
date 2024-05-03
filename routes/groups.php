<?php

use App\Http\Controllers\GroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// GROUPS
Route::post('/groups', [GroupController::class, 'createGroup'])->middleware('auth:sanctum', 'super_admin');
Route::get('/groups', [GroupController::class, 'getAllGroups'])->middleware('auth:sanctum');
Route::get('/groups/{id}', [GroupController::class, 'getGroupById'])->middleware('auth:sanctum');
