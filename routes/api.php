<?php

use App\Http\Controllers\DonationReportController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::apiResource('donations', DonationController::class);

    Route::apiResource('donors', DonorController::class);
    Route::apiResource('donations-reports', DonationReportController::class);

    Route::apiResource('warehouses', WarehouseController::class);

    Route::apiResource('inventory-items', InventoryItemController::class);
});

