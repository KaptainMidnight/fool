<?php

namespace App\Domain\Services;

use App\Domain\Entities\Game;
use App\Domain\Repositories\Contracts\GambleContract;
use App\Domain\Services\Contracts\GameContract;
use App\Domain\ValueObjects\Card;

final readonly class GameService implements GameContract
{
    public function __construct(
        private GambleContract $contract
    ) {}

    public function startGame(array $players): Game
    {
        $deck = $this->initializeDeck();
        $hands = $this->dealCards($players, $deck);
        $trumpCard = array_pop($deck);
        $currentPlayerIndex = 0;

        $game = new Game(
            id: null,
            players: $players,
            deck: $deck,
            table: [],
            hands: $hands,
            status: 'start',
            trumpCard: $trumpCard,
            currentPlayerIndex: $currentPlayerIndex
        );

        $this->contract->save($game);

        return $game;
    }

    public function initializeDeck(): array
    {
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        $ranks = ['6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

        $deck = [];
        foreach ($suits as $suit) {
            foreach ($ranks as $rank) {
                $deck[] = new Card(suit: $suit, rank: $rank);
            }
        }
        shuffle($deck);

        return $deck;
    }

    public function dealCards(array $players, array &$deck): array
    {
        $hands = [];

        foreach ($players as $player) {
            $hands[$player] = array_splice($deck, 0, 6);
        }

        return $hands;
    }
}
