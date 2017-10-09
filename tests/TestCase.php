<?php
namespace agoalofalife\Tests;

use agoalofalife\postman\SheduleEmailServiceProvider;
use Mockery;
use Orchestra\Testbench\TestCase as Testbench;

abstract class TestCase extends Testbench
{
    public function setUp()
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->withFactories(__DIR__.'/../database/factories');
    }

    protected function getPackageProviders($app) : array
    {
        return [SheduleEmailServiceProvider::class];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app) : void
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
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
    protected function mock(string $class) : Mockery
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