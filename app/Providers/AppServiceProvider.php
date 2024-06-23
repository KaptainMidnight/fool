<?php

namespace App\Providers;

use App\Domain\Repositories\Contracts\GambleContract;
use App\Domain\Repositories\Contracts\UserableContract;
use App\Domain\Services\Contracts\GameContract;
use App\Domain\Services\GameService;
use App\Infrastructure\Persistence\Repositories\GameRepository;
use App\Infrastructure\Persistence\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use phpcent\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserableContract::class, UserRepository::class);
        $this->app->bind(GambleContract::class, GameRepository::class);

        $this->app->bind(GameContract::class, GameService::class);

        $this->app->bind(Client::class, function (Application $application) {
            $client = new Client($application['config']['centrifugo']['host']);
            $client->setApiKey($application['config']['centrifugo']['api_key']);
            $client->setSecret($application['config']['centrifugo']['secret']);

            return $client;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
