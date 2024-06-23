<?php

namespace App\Domain\Services\Contracts;

interface GameContract
{
    public function startGame(array $players): void;

    public function initializeDeck(): array;

    public function dealCards(array $players, array &$deck): array;
}
