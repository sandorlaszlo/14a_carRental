<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;
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

// Route::get('/cars', [CarController::class, 'index']);
// Route::get('/rentals', [RentalController::class, 'index']);

Route::apiResource('rentals', RentalController::class);
Route::get('/rentals/date/{date}', [RentalController::class, 'rentalsByDate']);

Route::post('/rentals', [RentalController::class, 'store']);
