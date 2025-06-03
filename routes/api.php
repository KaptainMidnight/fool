<?php

use App\Http\Controllers\Auth\TelegramAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth/telegram')->group(function () {
    Route::post('login', [TelegramAuthController::class, 'login']);
});
