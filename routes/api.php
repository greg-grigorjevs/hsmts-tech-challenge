<?php

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('property', PropertyController::class);

Route::group(['prefix' => 'room'], function () {
    Route::get('/', [RoomController::class, 'index']);
    Route::get('/{property}', [RoomController::class, 'indexByProperty']);
    Route::post('/', [RoomController::class, 'store']);
    Route::put('/{room}', [RoomController::class, 'update']);
    Route::delete('/{room}', [RoomController::class, 'destroy']);
});
