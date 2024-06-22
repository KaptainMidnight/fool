<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Card;

final class Game
{
    public function __construct(
        private ?int $id,
        private readonly array $players,
        private array $deck,
        private array $table,
        private array $hands,
        private string $status,
        private Card $trumpCard,
        private int $currentPlayerIndex,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function getDeck(): array
    {
        return $this->deck;
    }

    public function getTable(): array
    {
        return $this->table;
    }

    public function getHands(): array
    {
        return $this->hands;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTrumpCard(): Card
    {
        return $this->trumpCard;
    }

    public function getCurrentPlayerIndex(): int
    {
        return $this->currentPlayerIndex;
    }

    public function setID(int $id): void
    {
        $this->id = $id;
    }

    public function setDeck(array $deck): void
    {
        $this->deck = $deck;
    }

    public function setTable(array $table): void
    {
        $this->table = $table;
    }

    public function setHands(array $hands): void
    {
        $this->hands = $hands;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setTrumpCard(Card $card): void
    {
        $this->trumpCard = $card;
    }

    public function setCurrentPlayerIndex(int $currentPlayerIndex): void
    {
        $this->currentPlayerIndex = $currentPlayerIndex;
    }
}
