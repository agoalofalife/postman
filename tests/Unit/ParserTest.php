<?php
namespace agoalofalife\Tests;

use Faker\Generator as FakerGenerator;
use agoalofalife\postman\Models\Email;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Faker\Factory;

class ParserTest extends TestCase
{
    public function testS()
    {
        dd(factory(Email::class, 3)->make());
    }
}