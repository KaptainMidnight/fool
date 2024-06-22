<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Repositories\Contracts\GambleContract;
use App\Domain\ValueObjects\Card;
use App\Infrastructure\Persistence\Eloquent\Game;
use App\Domain\Entities\Game as GameEntity;
use Illuminate\Database\Eloquent\Model;

class GameRepository implements GambleContract
{
    public function findByPK(int $id): ?GameEntity
    {
        $game = Game::query()->findOrFail($id);

        if (!$game->exists()) {
            return null;
        }

        return $this->mapToDomainEntity($game);
    }

    private function mapToDomainEntity(Game|Model $game): GameEntity
    {
        $players = $game->players;
        $deck = array_map(fn($card) => new Card(suit: $card['suit'], rank: $card['rank']), $game->deck);
        $table = array_map(fn($card) => new Card(suit: $card['suit'], rank: $card['rank']), $game->table);

        $hands = [];
        foreach ($game->hands as $player => $hand) {
            $hands[$player] = array_map(fn($card) => new Card(suit: $card['suit'], rank: $card['rank']), $hand);
        }
        $status = $game->status;
        $trumpCardData = $game->trump_card;
        $trumpCard = new Card(suit: $trumpCardData['suit'], rank: $trumpCardData['rank']);
        $currentPlayerIndex = $game->current_player_index;

        return new GameEntity(
            id: $game->id,
            players: $players,
            deck: $deck,
            table: $table,
            hands: $hands,
            status: $status,
            trumpCard: $trumpCard,
            currentPlayerIndex: $currentPlayerIndex
        );
    }

    public function save(GameEntity $game): void
    {
        $eloquentGame = Game::query()->find($game->getId());

        if ($eloquentGame->exists()) {
            $game->setID($eloquentGame->id);

            return;
        }

        $eloquentGame = Game::query()->create([
            'players' => $game->getPlayers(),
            'deck' => $game->getDeck(),
            'table' => $game->getTable(),
            'hands' => $game->getHands(),
            'status' => $game->getStatus(),
            'trump_card' => [
                'suit' => $game->getTrumpCard()->getSuit(),
                'rank' => $game->getTrumpCard()->getRank(),
            ],
            'current_player_index' => $game->getCurrentPlayerIndex()
        ]);

        $game->setID($eloquentGame->id);

    }
}
