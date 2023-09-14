<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoomController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Properties
Route::resource('property', PropertyController::class)->only(['index', 'create', 'edit']);

// Rooms
Route::resource('room', RoomController::class)->only(['edit']);
Route::get('room/create/{property}', [RoomController::class, 'create'])->name('room.create');
Route::get('room/{property}', [RoomController::class, 'indexByProperty'])->name('room.indexByProperty');



