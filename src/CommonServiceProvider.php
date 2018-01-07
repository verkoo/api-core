<?php
namespace Verkoo\Common;

use Verkoo\Common\Contracts\CalendarInterface;
use Verkoo\Common\Services\GoogleCalendar;
use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'verkooCommon');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/verkooCommon'),
        ]);
        $this->app->bind(CalendarInterface::class, GoogleCalendar::class);

    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}