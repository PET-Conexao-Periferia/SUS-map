<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/users', function (Request $request) {
    return $request->user();
});

require __DIR__.'/auth.php';
