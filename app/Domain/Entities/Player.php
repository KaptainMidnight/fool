<?php

namespace App\Domain\Entities;

final class Player
{
    public function __construct(
        private readonly int $id,
        private array $hand,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getHand(): array
    {
        return $this->hand;
    }

    public function setHand(array $hand): void
    {
        $this->hand = $hand;
    }
}
