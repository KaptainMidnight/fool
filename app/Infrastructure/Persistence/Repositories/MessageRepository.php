<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Application\DTOs\MessageDTO;
use App\Domain\Repositories\Contracts\MessageContract;
use App\Infrastructure\Persistence\Eloquent\Game;
use App\Infrastructure\Persistence\Eloquent\Message;

class MessageRepository implements MessageContract
{
    public function findByPK(int $id): MessageDTO
    {
        $message = Message::query()->findOrFail($id);

        return MessageDTO::fromArray($message->toArray());
    }

    public function findManyByGame(int $gameID): array
    {
        $messages = Game::query()->findOrFail($gameID)->messages;

        return array_map(fn (Message $message) => MessageDTO::fromArray($message->toArray()), $messages);
    }

    public function save(array $message): MessageDTO
    {
        $message = Message::query()->create($message)->toArray();

        return MessageDTO::fromArray($message);
    }
}
