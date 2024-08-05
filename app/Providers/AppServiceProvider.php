<?php

namespace App\Providers;

use App\Services\PetStoreApiManager;
use App\Services\PetStoreManagerInterface;
use Dropelikeit\LaravelJmsSerializer\Http\Responses\ResponseFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PetStoreManagerInterface::class,
            PetStoreApiManager::class
        );

        $this->app->singleton(PetStoreApiManager::class, function (Application $app) {
            return new PetStoreApiManager(
                $app->get(ResponseFactory::class),
                config('services.petstore.url'),
                config('services.petstore.api-key')
            );
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
