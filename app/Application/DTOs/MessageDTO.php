<?php

namespace App\Application\DTOs;

use Illuminate\Contracts\Support\Arrayable;

final readonly class MessageDTO implements Arrayable
{
    public function __construct(
        private int $id,
        private string $message,
        private int $gameID,
        private UserDTO $user,
    ) {}

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getGameID(): int
    {
        return $this->gameID;
    }

    public function getUser(): UserDTO
    {
        return $this->user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function fromArray(array $message): self
    {
        return new self(
            id: $message['id'],
            message: $message['text'],
            gameID: $message['game_id'],
            user: UserDTO::fromArray($message['user'])
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'game_id' => $this->gameID,
            'user' => $this->user,
        ];
    }
}
