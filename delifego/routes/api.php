<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;

// User routes
Route::post('users/register', [UserController::class, 'register']);
Route::post('users/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('users/logout', [UserController::class, 'logout']);
    Route::get('users/profile', [UserController::class, 'profile']);
    Route::put('users/update', [UserController::class, 'update']);
});

// Restaurant routes
Route::get('restaurants', [RestaurantController::class, 'index']);
Route::get('restaurants/{id}', [RestaurantController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('restaurants', [RestaurantController::class, 'store']);
    Route::put('restaurants/{id}', [RestaurantController::class, 'update']);
    Route::delete('restaurants/{id}', [RestaurantController::class, 'destroy']);
});

// Meal routes
Route::get('meals/{id}', [MealController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('meals', [MealController::class, 'store']);
    Route::put('meals/{id}', [MealController::class, 'update']);
    Route::delete('meals/{id}', [MealController::class, 'destroy']);
});

// Order routes
Route::get('orders', [OrderController::class, 'index']);
Route::post('orders', [OrderController::class, 'store']);
Route::get('orders/{id}', [OrderController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::put('orders/{id}', [OrderController::class, 'update']);
    Route::delete('orders/{id}', [OrderController::class, 'destroy']);
});
