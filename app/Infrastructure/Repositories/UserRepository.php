<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Auth\Entities\User;
use App\Domain\Auth\Repositories\UserRepositoryContract;
use App\Infrastructure\Persistence\Database\UserStorage;

readonly class UserRepository implements UserRepositoryContract
{
    public function __construct(
        private UserStorage $userStorage,
    ) {}

    public function findByTelegramId(int $telegramId): ?User
    {
        return $this->userStorage->findByTelegramId($telegramId);
    }

    public function save(User $user): void
    {
        $this->userStorage->save($user);
    }
}
