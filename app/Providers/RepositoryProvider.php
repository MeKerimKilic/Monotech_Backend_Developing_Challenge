<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\PromotionCodeInterface::class,
            \App\Repositories\PromotionCodeRepository::class
        );
        $this->app->singleton(
            \App\Repositories\UserInterface::class,
            \App\Repositories\UserRepository::class
        );
        $this->app->singleton(
            \App\Repositories\WalletPromotionCodesHistoryInterface::class,
            \App\Repositories\WalletPromotionCodesHistoryRepository::class
        );
        $this->app->singleton(
            \App\Repositories\WalletInterface::class,
            \App\Repositories\WalletRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
