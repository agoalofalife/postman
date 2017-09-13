<?php

namespace Tests;

use Mockery;
use Faker\Factory;
use Faker\Generator;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
    protected function faker(): Generator
    {
        return Factory::create();
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