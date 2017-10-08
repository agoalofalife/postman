<?php
namespace agoalofalife\Tests;

use Faker\Generator as FakerGenerator;
use agoalofalife\postman\Models\Email;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class ParserTest extends TestCase
{
    public function setUp()
    {
        app()->singleton(EloquentFactory::class, function ($app){
            return EloquentFactory::construct($app->make(FakerGenerator::class), __DIR__.'/../../database/factories/');
        });
    }
    public function testS()
    {
        dd(factory(Email::class, 3)->make());
    }
}