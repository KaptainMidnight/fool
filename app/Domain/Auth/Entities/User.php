<?php

namespace App\Domain\Auth\Entities;

class User
{
    public function __construct(
        private readonly string $name,
        private readonly string $surname,
        private readonly int $telegramId,
        private readonly string $username,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getTelegramId(): int
    {
        return $this->telegramId;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}
