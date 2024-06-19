<?php

use App\Interfaces\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/authorization', AuthController::class)->name('authorization');
