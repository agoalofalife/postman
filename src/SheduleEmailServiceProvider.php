<?php

namespace Agoalofalife\SheduleEmail;

use Illuminate\Support\ServiceProvider;

/**
 * Class SheduleEmailServiceProvider
 *
 * @package Laravel\Passport
 */
class SheduleEmailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'shedule-email-migration');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

}