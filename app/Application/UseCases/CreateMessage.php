<?php

namespace App\Application\UseCases;

use App\Infrastructure\Persistence\Eloquent\Game;
use Illuminate\Database\Eloquent\Model;

final readonly class CreateMessage
{
    public function execute(Game $game, string $message): Model
    {
        return $game->messages()->create(['text' => $message, 'game_id' => $game->id, 'user_id' => auth()->id()]);
    }
}
