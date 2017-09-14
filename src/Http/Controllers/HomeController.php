<?php

namespace agoalofalife\postman\Http\Controllers;

class HomeController
{
    public function index()
    {
        return view('postman::index');
    }
}