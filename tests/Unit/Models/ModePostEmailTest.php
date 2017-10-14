<?php
namespace agoalofalife\Tests\Modes;

use agoalofalife\postman\Models\ModePostEmail;
use agoalofalife\Tests\TestCase;

class ModePostEmailTest extends TestCase
{
    public function testAttributeOwner() : void
    {
        $mode = factory(ModePostEmail::class)->create([
            'owner' => 'error'
        ]);
        $this->expectException(\Exception::class);
        $mode->owner;
    }
}