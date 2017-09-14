<?php
namespace agoalofalife\postman;

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
        ], 'postman-migration');

        $this->publishes([
            __DIR__.'/../config/shedulemail.php' => config_path('shedulemail.php'),
        ]);

        $this->commands([
            Console\InstallCommand::class,
            Console\SeederCommand::class,
            Console\ParseCommand::class,
        ]);
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