<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DemoController::class, 'index']);
Route::get('/demo', [DemoController::class, 'demo']);
Route::get('/commands', [DemoController::class, 'commands']);
Route::get('/config', [DemoController::class, 'config']);
Route::get('/json-demo', [DemoController::class, 'jsonDemo']);
