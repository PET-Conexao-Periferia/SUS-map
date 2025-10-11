<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;

Route::prefix('campaigns')->group(function () {
    Route::get('/', [App\Http\Controllers\CampaignController::class, 'index']);
    Route::get('/{campaign}', [App\Http\Controllers\CampaignController::class, 'show']);
    Route::post('/', [App\Http\Controllers\CampaignController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/{campaign}', [App\Http\Controllers\CampaignController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/{campaign}', [App\Http\Controllers\CampaignController::class, 'destroy'])->middleware('auth:sanctum');
});
