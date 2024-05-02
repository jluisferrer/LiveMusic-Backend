<?php

use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//EVENTS
Route::post('/events', [EventController::class, 'createEvent'])->middleware('auth:sanctum', 'super_admin');
Route::get('/events', [EventController::class, 'getAllEvents'])->middleware('auth:sanctum');
Route::get('/events/{id}', [EventController::class, 'getEventById'])->middleware('auth:sanctum');
Route::put('/events/{id}', [EventController::class, 'updateEvent'])->middleware('auth:sanctum', 'super_admin');
Route::delete('/events/{id}', [EventController::class, 'deleteEvent'])->middleware('auth:sanctum', 'super_admin');