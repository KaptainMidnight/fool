<?php

namespace App\Interfaces\Http\Controllers\Game;

use App\Application\UseCases\StartGame;
use App\Interfaces\Http\Requests\StartGameRequest;
use App\Interfaces\WebSocket\Events\GameStarted;
use phpcent\Client;

readonly class CreateGameController
{
    public function __construct(
        private StartGame $startGame,
        private Client $client
    ) {}

    public function __invoke(StartGameRequest $request): void
    {
        $players = $request->input('players');
        $game = $this->startGame->execute($players);

        event(new GameStarted(
            client: $this->client,
            entity: $game
        ));
    }
}
