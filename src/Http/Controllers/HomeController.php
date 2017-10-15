<?php
namespace agoalofalife\postman\Http\Controllers;

use Illuminate\View\View;

class HomeController
{
    public function __construct()
    {
        if (class_exists(config('postman.middleware'))) {
            $this->middleware(config('postman.middleware'));
        }
    }

    public function index() : View
    {
        return view('postman::app');
    }
}