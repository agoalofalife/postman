<?php

namespace agoalofalife\Tests;

use agoalofalife\postman\Contract\Mode;
use agoalofalife\postman\Models\SheduleEmail;
use agoalofalife\postman\Parser;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 * This up separate process for alias mock
 * More @link https://laracasts.com/discuss/channels/testing/mocking-a-class-persists-over-tests
 */
class ParserTest extends TestCase
{

    public function testParse() : void
    {
        factory(SheduleEmail::class, 10)->create([
            'status_action' => 0,
            'mode_id' => 1
        ]);
        $mock = $this->mock('alias:agoalofalife\postman\FactoryMode');
        $mockMode = $this->mock(Mode::class);

        $mock->shouldReceive('get')->andReturn($mockMode);
        $mockMode->shouldReceive('postEmail');
        (new Parser())->parse();
    }

    public function testExpectedException() : void
    {
        factory(SheduleEmail::class, 10)->create([
            'status_action' => 0,
            'mode_id' => 20
        ]);

        $this->expectException(\Exception::class);
        (new Parser())->parse();
    }
}