<?php
namespace agoalofalife\Tests;

use agoalofalife\postman\Models\Email;

class ParserTest extends TestCase
{
    public function testS()
    {
//        $this->loadLaravelMigrations(['--database' => 'testbench']);
        dd(factory(Email::class)->create());
    }
}