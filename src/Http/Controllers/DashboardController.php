<?php

namespace agoalofalife\postman\Http\Controllers;

use agoalofalife\postman\Models\SheduleEmail;
use agoalofalife\postman\Transformers\SheduleEmailTranformer;
use App\User;

class DashboardController
{
    public function index()
    {
        $data['tasks'] = SheduleEmailTranformer::transform(SheduleEmail::all());

        return response($data);
    }

    public function listUsers()
    {
        return User::all()->toJson();
    }
}