<?php
namespace agoalofalife\postman\Http\Controllers;

use Illuminate\View\View;

class HomeController
{
    public function index() : View
    {
        return view('postman::app');
    }
}