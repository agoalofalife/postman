<?php

namespace agoalofalife\postman\Http\Controllers;

use agoalofalife\postman\Models\SheduleEmail;
use App\Models\User;

class HomeController
{
    public function index()
    {
        $data['tasks'] = SheduleEmail::all();
        return view('postman::index', $data);
    }

    public function listUsers()
    {
        return User::all()->toJson();
    }
}