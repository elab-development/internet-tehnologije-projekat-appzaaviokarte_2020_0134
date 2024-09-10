<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
//use App\Http\Controllers\AdminController;
// use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\BookingController;


Route::apiResource('users', UserController::class);
//Route::apiResource('admins', AdminController::class);
Route::apiResource('flights', FlightController::class);
// Route::apiResource('airports', AirportController::class);
Route::apiResource('bookings', BookingController::class);


Route::get('/flights', [FlightController::class, 'index']);
Route::get('/flights/{flight_id}', [FlightController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/flights', [FlightController::class, 'store']);
    Route::put('/flights/{flight_id}', [FlightController::class, 'update']);
    Route::delete('/flights/{flight_id}', [FlightController::class, 'destroy']);
    Route::get('/flights/check-flight/{id}', [FlightController::class, 'checkFlight']);
    Route::get('/flights/{flight_id}/capacity', [FlightController::class, 'getFlightCapacity']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::get('/bookingsall', [BookingController::class, 'allData']);
    Route::get('/bookingsall/{userId}', [BookingController::class, 'allDataUser']);
    Route::get('/bookings/{booking_id}', [BookingController::class, 'show']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::put('/bookings/{booking_id}', [BookingController::class, 'update']);
    Route::delete('/bookings/{booking_id}', [BookingController::class, 'destroy']);
    Route::get('/bookings/check-booking/{id}', [BookingController::class, 'checkBooking']);
    Route::put('/flights/{flight_id}/capacity', [FlightController::class, 'updateCapacity']);
});

// Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
//     Route::get('/users', [UserController::class, 'index']);
//     Route::get('/users/{user_id}', [UserController::class, 'show']);
//     Route::post('/users', [UserController::class, 'store']);
//     Route::put('/users/{user_id}', [UserController::class, 'update']);
//     Route::delete('/users/{user_id}', [UserController::class, 'destroy']);
// });
Route::middleware(['auth:sanctum', 'check_admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user_id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user_id}', [UserController::class, 'update']);
    Route::delete('/users/{user_id}', [UserController::class, 'destroy']);
});

//proveri
Route::get('/users', [UserController::class, 'index']);
Route::get('users/check-name/{name}', [UserController::class, 'checkName']);
Route::get('users/check-email/{email}', [UserController::class, 'checkEmail']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::options('{any}', function () {
    return response()->json([], 200);
})->where('any', '.*');
