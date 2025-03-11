<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CombinationController;

Route::get('/', [CombinationController::class, 'index']);
Route::post('/generate', [CombinationController::class, 'generate'])->name('generate.combination');

// force HTTPS
//URL::forceScheme('https');

