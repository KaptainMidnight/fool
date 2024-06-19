<?php

namespace App\Application\UseCases;

use App\Application\DTOs\UserDTO;
use App\Infrastructure\Persistence\Eloquent\User;

final readonly class CreateUser
{
    public function __construct(
        private array $data
    ) {
    }

    public function execute(): UserDTO
    {
        $user = User::query()->create($this->data)->toArray();

        return UserDTO::fromArray($user);
    }
}
