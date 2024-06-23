<?php

namespace App\Application\UseCases;

use App\Domain\Entities\Game;
use App\Domain\Services\Contracts\GameContract;

final readonly class StartGame
{
    public function __construct(
        private GameContract $contract
    ) {}

    public function execute(array $players): Game
    {
        return $this->contract->startGame($players);
    }
}
