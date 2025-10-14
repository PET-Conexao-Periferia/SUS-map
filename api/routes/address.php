<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

Route::prefix('addresses')
    ->controller(AddressController::class)
    ->group(function () {

        Route::middleware(['auth:sanctum', 'ability:user-admin'])
            ->group(function () {

                Route::post('description/{description}', 'store');

                Route::put('{address}', 'update');
                Route::delete('{address}', 'destroy');
            });
    });
