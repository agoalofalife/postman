<?php
namespace agoalofalife\postman;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'postman');
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'postman-migration');

        $this->publishes([
            __DIR__.'/../config/postman.php' => config_path('postman.php'),
        ], 'postman-migration');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/postman'),
        ], 'postman-migration');


        $this->registerRoutes();
        $this->commands([
            Console\InstallCommand::class,
            Console\SeederCommand::class,
            Console\ParseCommand::class,
        ]);
        $this->loadViews();

        Request::macro('datePostman', function (Request $request) {
            $request-> date =  Carbon::parse($request->date)->toDateTimeString();
        });
    }

    /**
     * Register the postman routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group([
            'prefix' => 'postman',
            'namespace' => 'agoalofalife\postman\Http\Controllers',
            'middleware' => 'web',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'postman');
    }
}