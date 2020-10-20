<?php

namespace App\Providers;

use App\Contrato;
use App\Observers\ContratoObserver;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Contrato::observe(ContratoObserver::class);
    }
}
