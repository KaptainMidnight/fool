<?php

namespace App\Interfaces\Http\Controllers;

use App\Domain\Repositories\Contracts\UserableContract;
use App\Infrastructure\Persistence\Eloquent\User;
use App\Interfaces\Http\Requests\AuthorizeUserRequest;

class AuthController
{
    public function __invoke(AuthorizeUserRequest $request, UserableContract $contract): array
    {
        $data = decrypt($request->hash);
        $user = User::query()->firstOrCreate(['id' => $data['id']], [
            'username' => $data['username'],
            'telegram_id' => $data['id'],
        ]);

        $token = $user->createToken($request->ip())?->plainTextToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }
}
