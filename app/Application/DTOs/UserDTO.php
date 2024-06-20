<?php

namespace App\Application\DTOs;

final readonly class UserDTO
{
    public function __construct(
        private int $id,
        private int $telegramID,
        private string $username,
        private int $cash,
        private int $coins
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

    public static function fromArray(array $data): UserDTO
    {
        return new self(
            id: $data['id'],
            telegramID: $data['telegram_id'],
            username: $data['username'],
            cash: $data['cash'],
            coins: $data['coins']
        );
    }
}
