<?php

namespace App\Domain\Repositories\Contracts;

use App\Domain\Entities\Game;

interface GambleContract
{
    public function findByPK(int $id): ?Game;

    public function save(Game $game): void;
}
