<?php
namespace agoalofalife\Tests\Console;

use Illuminate\Support\Facades\Schema;
use agoalofalife\Tests\TestCase;
use agoalofalife\postman\Console\InstallCommand;
use Symfony\Component\Console\Tester\CommandTester;

class InstallCommandTest extends TestCase
{

    public function testCommand() : void
    {
        $this->artisan('postman:install');
    }
}