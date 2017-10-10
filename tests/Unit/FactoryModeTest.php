<?php

namespace agoalofalife\Tests;

use agoalofalife\postman\FactoryMode;
use agoalofalife\postman\Modes\Each;
use agoalofalife\postman\Modes\OneToAll;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 * This up separate process for alias mock
 * More @link https://laracasts.com/discuss/channels/testing/mocking-a-class-persists-over-tests
 */
class FactoryModeTest extends TestCase
{
    public function testGetOneToAll() : void
    {
        $mock = $this->mock('alias:agoalofalife\postman\FactoryMode');
        $mockMode = $this->mock(OneToAll::class);
        $mock->shouldReceive('get')->andReturn($mockMode);

        FactoryMode::get(1);
    }

    public function testGetOneToEach() : void
    {
        $mock = $this->mock('alias:agoalofalife\postman\FactoryMode');
        $mockMode = $this->mock(Each::class);
        $mock->shouldReceive('get')->andReturn($mockMode);

        FactoryMode::get(2);
    }
}