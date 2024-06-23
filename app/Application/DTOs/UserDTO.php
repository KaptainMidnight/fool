<?php

namespace App\Application\DTOs;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Arrayable;

final readonly class UserDTO implements Arrayable
{
    public function __construct(
        private int $id,
        private int $telegramID,
        private string $username,
        private int $cash,
        private int $coins,
        private ?array $achievements,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getTelegramID(): int
    {
        return $this->telegramID;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getCash(): int
    {
        return $this->cash;
    }

    public function getCoins(): int
    {
        return $this->coins;
    }

    public function getAchievements(): ?array
    {
        return $this->achievements;
    }

    public static function fromArray(array|Authenticatable $data): self
    {
        return new self(
            id: $data['id'],
            telegramID: $data['telegram_id'],
            username: $data['username'],
            cash: $data['cash'],
            coins: $data['coins'],
            achievements: null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'telegram_id' => $this->telegramID,
            'username' => $this->username,
            'cash' => $this->cash ?? 0,
            'coins' => $this->coins ?? 1000,
            'achievements' => $this->achievements,
        ];
    }
}
