<?php

namespace App\Domain\ValueObjects;

final readonly class Card
{
    public function __construct(
        private string $suit, // Масть карты
        private string $rank,
    ) {}

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getRank(): string
    {
        return $this->rank;
    }
}
