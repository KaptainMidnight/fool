<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Application\DTOs\UserDTO;
use App\Domain\Repositories\Contracts\UserableContract;
use App\Infrastructure\Persistence\Eloquent\User;

class UserRepository implements UserableContract
{
    public function findByPK(int $id): UserDTO
    {
        $user = User::query()->findOrFail($id);

        return UserDTO::fromArray($user);
    }

    public function save(array $data): UserDTO
    {
        $user = User::query()->create($data)->toArray();

        return UserDTO::fromArray($user);
    }

    public function findByTelegram(int $id): UserDTO
    {
        $user = User::query()->where('telegram_id', $id)->firstOrFail()->toArray();

        return UserDTO::fromArray($user);
    }
}
