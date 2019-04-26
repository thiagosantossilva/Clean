<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Dusk\DuskServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
		Carbon::setLocale(env('LOCALE', 'pt_BR'));
		setlocale(LC_TIME, 'pt_BR');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        /**
         * Added missing method for package to work
         */
        \Illuminate\Support\Collection::macro('lists', function ($a, $b = null) {
            return collect($this->items)->pluck($a, $b);
        });
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }

    }
}
