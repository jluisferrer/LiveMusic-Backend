<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ROUTES

require __DIR__ . '/users.php';
require __DIR__ . '/groups.php';
require __DIR__ . '/events.php';
require __DIR__ . '/usergroupevent.php';
require __DIR__ . '/auth.php';