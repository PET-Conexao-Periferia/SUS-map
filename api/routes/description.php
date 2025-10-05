<?php

use App\Http\Controllers\DescriptionController;
use Illuminate\Support\Facades\Route;

Route::prefix('descriptions')
    ->controller(DescriptionController::class)
    ->group(function () {

        Route::middleware(['auth:sanctum', 'ability:user-admin'])
            ->group(function () {

                Route::post('location/{location}', 'store');

                Route::put('{description}', 'update');
                Route::delete('{description}', 'destroy');
            });
    });
