<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome'); // ou toute autre vue
});

Route::resource('ecs', ECController::class);
Route::get('/suivi', [ECController::class, 'suiviGlobal'])->name('suivi.global');

