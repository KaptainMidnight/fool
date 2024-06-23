<?php

namespace App\Providers;

use App\Domain\Repositories\Contracts\GambleContract;
use App\Domain\Repositories\Contracts\UserableContract;
use App\Domain\Services\Contracts\GameContract;
use App\Domain\Services\GameService;
use App\Infrastructure\Persistence\Repositories\GameRepository;
use App\Infrastructure\Persistence\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
