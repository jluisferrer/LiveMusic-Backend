<?php

use App\Http\Controllers\GroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// GROUPS
Route::post('/groups', [GroupController::class, 'createGroup'])->middleware('auth:sanctum', 'super_admin');
