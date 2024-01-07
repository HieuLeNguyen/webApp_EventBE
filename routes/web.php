<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\EventTicketController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::post('/login',[OrganizerController::class,'login']);
Route::get('/logout',[OrganizerController::class,'logout']);


Route::get('/events', [EventController::class, 'index']);

Route::get('/events/{slug}/detail', [EventController::class, 'show']);


Route::get('/events/create', [EventController::class, 'create']);
Route::post('/events/create', [EventController::class, 'store']);

Route::get('/rooms/{slug}/create', [RoomController::class, 'create']);
Route::post('/rooms/{slug}/create', [RoomController::class, 'store']);

Route::get('/sessions/{slug}/create', function () {
    return view('sessions.create');
});

Route::get('/sessions/{slug}/edit', function () {
    return view('sessions.edit');
});

Route::get('/tickets/{slug}/create', function () {
    return view('tickets.create');
});

Route::get('/reports/{slug}', [RoomController::class, 'show']);




