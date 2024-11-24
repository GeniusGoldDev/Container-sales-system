<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
        // if (config('app.env') !== 'local') {
        //     URL::forceScheme('https');
        // } else{
        //     Schema::defaultStringLength(191);
        // }
        Schema::defaultStringLength(191);
        // URL::forceScheme('https');
    }
}
