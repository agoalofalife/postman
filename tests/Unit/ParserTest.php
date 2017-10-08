<?php
namespace agoalofalife\Tests;


class ParserTest extends TestCase
{
    public function testS()
    {
        dd(factory(agoalofalife\postman\Models\Email::class, 3)->make());
    }
}