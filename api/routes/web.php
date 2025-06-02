<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

// apenas para fases de testes com ngrok
Route::get('redirect_test', function() {
    $url = env('REDIRECT_URL', '/');

    return redirect($url);
});
// fim das fases de testes
