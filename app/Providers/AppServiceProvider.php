<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\Contracts\ImageServiceInterface',
            'App\Services\ImageService'
        );

        $this->app->bind(
            'App\Services\Contracts\InspectionServiceInterface',
            'App\Services\InspectionService'
        );

        $this->app->bind(
            'App\Services\Contracts\MediaServiceInterface',
            'App\Services\MediaService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
