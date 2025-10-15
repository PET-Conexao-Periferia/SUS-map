<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

Route::prefix('services')
    ->controller(ServiceController::class)
    ->group(function () {

        Route::middleware(['auth:sanctum', 'ability:user-admin'])
            ->group(function () {

                Route::post('', 'store');
                Route::get('', 'index');
                Route::put('{service}', 'update');
                Route::delete('{service}', 'destroy');
                // Route::post('/locations/{location}/services', [LocationController::class, 'attachServices']);

            });
    });
