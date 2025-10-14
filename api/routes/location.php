<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::prefix('locations')
    ->controller(LocationController::class)
    ->group(function () {

        Route::get('', 'index');
        Route::get('{location}', 'show');

        Route::middleware(['auth:sanctum', 'ability:user-admin'])
            ->group(function() {

                Route::post('', 'store');
                Route::put('{location}', 'update');
                Route::delete('{location}', 'destroy');
                Route::post('/locations/{location}/services', 'attachServices');

            });

    });
