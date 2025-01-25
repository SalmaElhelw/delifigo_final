<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;


Route::middleware('api')->group(function () {

Route::get('restaurants', [RestaurantController::class, 'index']);
Route::get('restaurants/{id}', [RestaurantController::class, 'show']);
Route::post('restaurants', [RestaurantController::class, 'store']);
Route::put('restaurants/{id}', [RestaurantController::class, 'update']);
Route::delete('restaurants/{id}', [RestaurantController::class, 'destroy']);

Route::post('meals', [MealController::class, 'store']);
Route::get('meals/{id}', [MealController::class, 'show']);
Route::put('meals/{id}', [MealController::class, 'update']);
Route::delete('meals/{id}', [MealController::class, 'destroy']);

Route::get('orders', [OrderController::class, 'index']);
Route::post('orders', [OrderController::class, 'store']);
Route::get('orders/{id}', [OrderController::class, 'show']);
Route::put('orders/{id}', [OrderController::class, 'update']);
Route::delete('orders/{id}', [OrderController::class, 'destroy']);

Route::post('users/register', [UserController::class, 'register']);
Route::post('users/login', [UserController::class, 'login']);
Route::get('users/profile', [UserController::class, 'profile'])->middleware('auth:api');
Route::put('users/update', [UserController::class, 'update'])->middleware('auth:api');

Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'profile']);
Route::middleware('auth:sanctum')->put('/update', [UserController::class, 'update']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

});