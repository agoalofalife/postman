<?php
namespace agoalofalife\Tests;

use agoalofalife\postman\Models\Email;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParserTest extends TestCase
{
    use DatabaseMigrations;

    public function testS()
    {
        dd(Email::all());
        dd(factory(Email::class)->create());
    }
}