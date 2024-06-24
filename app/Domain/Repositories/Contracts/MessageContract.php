<?php

namespace App\Domain\Repositories\Contracts;

use App\Application\DTOs\MessageDTO;

interface MessageContract
{
    public function findByPK(int $id): MessageDTO;

    public function findManyByGame(int $gameID): array;

    public function save(array $message): MessageDTO;
}
