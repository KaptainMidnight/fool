<?php

namespace App\Http\Controllers\Auth;

use App\Application\Services\TelegramAuthService;
use App\Domain\Auth\Exceptions\AuthException;
use App\Http\Controllers\Controller;
use App\Http\Requests\TelegramLoginRequest;
use App\Models\User as UserModel;

class TelegramAuthController extends Controller
{
    public function login(TelegramLoginRequest $request, TelegramAuthService $authService)
    {
        try {
            $user = $authService->authenticate($request->validated());
            $token = $user->getTelegramId() ?
                UserModel::query()
                    ->where('telegram_id', $user->getTelegramId())
                    ->first()
                    ->createToken('telegram')
                    ->plainTextToken : null;

            return response()->json(['token' => $token]);
        } catch (AuthException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
