<?php

namespace agoalofalife\Tests;

use agoalofalife\postman\Models\SheduleEmail;
use agoalofalife\postman\Parser;

class ParserTest extends TestCase
{
    public function testParse() : void
    {
        $tasks  = factory(SheduleEmail::class, 10)->create([
            'status_action' => 0,
        ]);
        (new Parser())->parse();

    }
}