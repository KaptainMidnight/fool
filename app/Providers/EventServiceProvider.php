<?php

namespace App\Providers;

use App\Interfaces\WebSocket\Events\GameStarted;
use App\Interfaces\WebSocket\Listeners\DealCards;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Event::listen(GameStarted::class, DealCards::class);
    }
}
