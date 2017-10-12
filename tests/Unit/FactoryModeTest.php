<?php

namespace agoalofalife\Tests;

use agoalofalife\postman\FactoryMode;
use agoalofalife\postman\Modes\Each;
use agoalofalife\postman\Modes\OneToAll;

class FactoryModeTest extends TestCase
{
    public function testGetOneToAll() : void
    {
        $this->assertInstanceOf(OneToAll::class, FactoryMode::get(1));
    }

    public function testGetOneToEach() : void
    {
        $this->assertInstanceOf(Each::class, FactoryMode::get(2));
    }

    /**
     * @expectedException    \Exception
     * @expectedExceptionMessage Mode not defined
     */
    public function testExpectedException() : void
    {
        FactoryMode::get(3);
    }
}