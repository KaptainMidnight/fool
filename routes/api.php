<?php

use App\Interfaces\Http\Controllers\AuthController;
use App\Interfaces\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::post('authorization', AuthController::class)->name('authorization');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', UserProfileController::class)->name('profile');
});
