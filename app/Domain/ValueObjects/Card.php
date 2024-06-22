<?php

namespace App\Domain\ValueObjects;

final class Card
{
    public function __construct(
        private string $suit, // Масть карты
        private string $rank,
        private bool $isTrump = false // Козырь
    ) {}

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getRank(): string
    {
        return $this->rank;
    }

    public function isTrump(): bool
    {
        return $this->isTrump;
    }

    public function setSuit(string $suit): self
    {
        $this->suit = $suit;

        return $this;
    }

    public function setRank(string $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function setIsTrump(bool $isTrump): self
    {
        $this->isTrump = $isTrump;

        return $this;
    }
}
