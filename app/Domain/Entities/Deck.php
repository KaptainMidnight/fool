<?php

namespace App\Domain\Entities;

class Deck
{
    public function __construct(
        private array $cards,
    )
    {
        $this->initializeDeck();
    }

    public function startGame(array $players)
    {

    }

    protected function initializeDeck(): void
    {

    }
}
