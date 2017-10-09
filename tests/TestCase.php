<?php
namespace agoalofalife\Tests;

use Mockery;
use Faker\Factory;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Factory @var
     */
    protected $factory;

    /**
     * @var
     */
    protected $app;

    public function setUp()
    {
        $this->factory = Factory::create();
        $app = require __DIR__.'/bootstrap/autoload.php';

        /**
         * Init factory model eloquent
         */
        $app->singleton(EloquentFactory::class, function ($app){
            return EloquentFactory::construct($this->factory, __DIR__.'/../database/factories/');
        });

        $app->loadEnvironmentFrom('.env.testing');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @param string $class
     *
     * @return \Mockery\Mock|mixed
     */
    protected function mock(string $class)
    {
        return Mockery::mock($class);
    }

    /**
     * @param array $keys
     * @param array $source
     */
    public function assertArrayHasKeys(array $keys, array $source) : void
    {
        array_map(function ($key) use ($source) {
            $this->assertArrayHasKey($key, $source);
        }, $keys);
    }

}