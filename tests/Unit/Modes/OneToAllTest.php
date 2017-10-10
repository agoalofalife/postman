<?php
namespace agoalofalife\Tests\Modes;

use agoalofalife\postman\Models\SheduleEmail;
use agoalofalife\postman\Modes\OneToAll;
use agoalofalife\Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class OneToAllTest extends TestCase
{
    public function testPostEmail() : void
    {
        factory(SheduleEmail::class, 10)->create();
        $shedule = SheduleEmail::all()->random();
        Mail::shouldReceive('raw')->once()->with($shedule->email->text, \Mockery::type('callable'));
        Mail::shouldReceive('failures')->once()->andReturn([]);

        (new OneToAll)->postEmail($shedule);

        $this->assertEquals(1, SheduleEmail::find($shedule->id)->getOriginal()['status_action']);
    }
}