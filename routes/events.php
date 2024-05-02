<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/events', [EventController::class, 'createEvent'])->middleware('auth:sanctum', 'super_admin');