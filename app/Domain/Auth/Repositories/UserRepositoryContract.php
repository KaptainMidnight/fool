<?php

namespace App\Domain\Auth\Repositories;

use App\Domain\Auth\Entities\User;

interface UserRepositoryContract
{
    public function findByTelegramId(int $telegramId): ?User;
    public function save(User $user): void;
}
