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

        $this->registerRoutes();
        $this->commands([
            Console\InstallCommand::class,
            Console\SeederCommand::class,
            Console\ParseCommand::class,
            Console\AssetsConsole::class,
        ]);
        $this->loadViews();

        Request::macro('datePostman', function (Request $request) {
            $request-> date =  Carbon::parse($request->date)->toDateTimeString();
        });
        $this->mergeConfigFrom(__DIR__.'/../config/postman.php', 'postman');
        $this->publishesAll();
    }

    public function register()
    {
        if (! defined('POSTMAN_PATH')) {
            define('POSTMAN_PATH', realpath(__DIR__.'/../'));
        }
    }
    public function publishesAll() : void
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'postman-migration');

        $this->publishes([
            __DIR__.'/../config/postman.php' => config_path('postman.php'),
        ], 'postman-migration');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/postman'),
        ], 'postman-migration');
        $this->publishes([
            POSTMAN_PATH.'/public' => public_path('vendor/horizon'),
        ], 'postman-assets');

        $this->publishes([
            __DIR__.'/../database/seeds' => database_path('seeds'),
        ], 'postman-migration');

        $this->publishes([
            __DIR__.'/../resources/assets/js/components' => base_path('resources/assets/js/components/postman'),
        ], 'postman-components');
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