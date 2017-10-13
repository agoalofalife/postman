<?php
namespace agoalofalife\Tests\Feature\Http\Controllers;

use agoalofalife\Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testIndex() : void
    {
        $this->get('/postman/');
    }
}