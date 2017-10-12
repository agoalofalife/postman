<?php
namespace agoalofalife\Tests\Console;

use Illuminate\Support\Facades\Schema;
use agoalofalife\Tests\TestCase;
use agoalofalife\postman\Console\InstallCommand;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 * This up separate process for alias mock
 * More @link https://laracasts.com/discuss/channels/testing/mocking-a-class-persists-over-tests
 */
class ParseCommandTest extends TestCase
{
    public function testHandle() : void
    {
         $parser = $this->mock('alias:agoalofalife\postman\Parser');
         $parser->shouldReceive('parse')->once();
         $this->artisan('postman:parse');
    }
}