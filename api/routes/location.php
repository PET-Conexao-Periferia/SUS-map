<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::prefix('locations')
    ->controller(LocationController::class)
    ->group(function () {

        Route::get('', 'index');

    });
