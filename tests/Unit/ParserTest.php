<?php

namespace agoalofalife\Tests;

use agoalofalife\postman\Contract\Mode;
use agoalofalife\postman\Models\SheduleEmail;
use agoalofalife\postman\Models\Status;
use agoalofalife\postman\Parser;
use Carbon\Carbon;

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
        $this->artisan('postman:seed');
        factory(SheduleEmail::class, 10)->create([
            'date' => Carbon::now()->subDays(10),
            'mode_id' => 1,
            'status_id' => Status::inProcess(),
        ]);
        $mock = $this->mock('alias:agoalofalife\postman\FactoryMode');
        $mockMode = $this->mock(Mode::class);

        $mock->shouldReceive('get')->andReturn($mockMode);
        $mockMode->shouldReceive('postEmail');
        (new Parser())->parse();
    }
}