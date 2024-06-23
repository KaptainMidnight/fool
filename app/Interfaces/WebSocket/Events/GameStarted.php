<?php

namespace App\Interfaces\WebSocket\Events;

use App\Domain\Entities\Game;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use phpcent\Client;

class GameStarted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly Client $client,
        public readonly Game $entity
    ) {}
}
