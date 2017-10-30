<?php
namespace agoalofalife\Tests\Feature\Http\Controllers;

use agoalofalife\Tests\TestCase;
use Illuminate\Routing\Console\MiddlewareMakeCommand;

class HomeControllerTest extends TestCase
{
    public function testClassExistMiddleware() : void
    {
        app('config')->set('postman.middleware', MiddlewareMakeCommand::class);
        $this->get('/postman/');
    }
    public function testIndex() : void
    {
        $this->get('/postman/');
    }
}