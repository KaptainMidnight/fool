<?php

namespace App\Domain\Repositories\Contracts;

use App\Application\DTOs\UserDTO;

interface UserableContract
{
    public function findByPK(int $id): UserDTO;

    public function save(array $data): UserDTO;

    public function findByTelegram(int $id): UserDTO;
}
