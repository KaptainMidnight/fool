<?php

namespace App\Application\Services;

use App\Domain\Auth\Entities\User;
use App\Domain\Auth\Exceptions\AuthException;
use App\Domain\Auth\Repositories\UserRepositoryContract;

readonly class TelegramAuthService
{
    private string $botToken;
    public function __construct(
        private UserRepositoryContract $userRepository,
    ) {
        $this->botToken = config('telegram.bot_token');
    }

    public function verify(array $data): bool
    {
        $checkString = collect($data)
            ->except('hash')
            ->sortKeys()
            ->map(fn ($value, $key) => "{$key}={$value}")
            ->implode("\n");

        $secretKey = hash('sha256', $this->botToken, true);
        $hash = hash_hmac('sha256', $checkString, $secretKey);

        return hash_equals($hash, $data['hash']) && (time() - $data['auth_date']) < 86400;
    }

    /**
     * @throws AuthException
     */
    public function authenticate(array $data): User
    {
        if (!$this->verify($data)) {
            throw AuthException::invalidTelegramData();
        }

        $user = $this->userRepository->findByTelegramId($data['id']);
        if (!$user) {
            $user = new User(
                name: $data['first_name'],
                surname: $data['last_name'],
                telegramId: $data['id'],
                username: $data['username'],
            );

            $this->userRepository->save($user);
        }

        return $user;
    }
}
