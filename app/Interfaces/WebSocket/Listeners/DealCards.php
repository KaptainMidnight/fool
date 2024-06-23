<?php

namespace App\Interfaces\WebSocket\Listeners;

use App\Interfaces\WebSocket\Events\GameStarted;

class DealCards
{
    public function __construct()
    {
        //
    }

    public function handle(GameStarted $event): void
    {

    }
}
