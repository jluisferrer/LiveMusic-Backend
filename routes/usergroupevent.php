<?php

use App\Http\Controllers\UserGroupEventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// USERGROUPSEVENTS
Route::post('/usergroupevents', [UserGroupEventController::class, 'createGroupEvent'])->middleware('auth:sanctum'); //futura implementacion
Route::post('/usergroupevents/{eventId}', [UserGroupEventController::class, 'joinUserEvent'])->middleware('auth:sanctum');
Route::post('/usergroupevents/{groupId}/{eventId}', [UserGroupEventController::class, 'joinGroupEvent'])->middleware('auth:sanctum', 'super_admin');
Route::get('/usergroupevents/', [UserGroupEventController::class, 'getUserEvents'])->middleware('auth:sanctum');
Route::get('/usergroupevents/{groupId}', [UserGroupEventController::class, 'getGroupEvents'])->middleware('auth:sanctum');
Route::delete('/usergroupevents/{eventId}', [UserGroupEventController::class, 'deleteUserEvent'])->middleware('auth:sanctum');
Route::delete('/usergroupevents/{groupId}/{eventId}', [UserGroupEventController::class, 'deleteGroupEvent'])->middleware('auth:sanctum');