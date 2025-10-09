<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('services')
    ->controller(ServiceController::class)
    ->group(function () {

        Route::middleware(['auth:sanctum', 'ability:user-admin'])
            ->group(function () {

                Route::post('', 'store');
                Route::get('', 'index');
                Route::put('{service}', 'update');
                Route::delete('{service}', 'destroy');
             // Route::post('location/{location}', 'store');

            });
    });
