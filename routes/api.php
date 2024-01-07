<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\RegistrationController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/events', [EventController::class, 'getEvents']);
Route::get('/organizers/{organizer_slug}/events/{event_slug}', [EventController::class, 'detailEvent']);

Route::post('/login', [AttendeeController::class, 'login']);
Route::post('/logout', [AttendeeController::class, 'logout']);

Route::post('/organizers/{organizer_slug}/events/{event_slug}/registration', [RegistrationController::class, 'registration']);
Route::get('/registrations', [RegistrationController::class, 'show']);


