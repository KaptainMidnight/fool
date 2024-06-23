<?php

namespace App\Domain\Services\Contracts;

use App\Domain\Entities\Game;

interface GameContract
{
    public function startGame(array $players): Game;

    public function initializeDeck(): array;

    public function dealCards(array $players, array &$deck): array;
}
