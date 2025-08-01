<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[AuthController::class,'register']);
Route::delete('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('/login',[AuthController::class,'login']);

Route::apiResource('donations',DonationController::class);