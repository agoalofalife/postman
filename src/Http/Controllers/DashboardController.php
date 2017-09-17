<?php

namespace agoalofalife\postman\Http\Controllers;

use agoalofalife\postman\Models\SheduleEmail;
use App\User;

class DashboardController
{
    public function index()
    {

//        $data['tasks'] =  SheduleEmail::all()->prepend([
//            trans('postman::dashboard.date'),
//            trans('postman::dashboard.theme'),
//            trans('postman::dashboard.text'),
//            trans('postman::dashboard.mode'),
//            trans('postman::dashboard.status'),
//        ]);
//
//        $data['users'] = User::all()->prepend([
//            trans('postman::dashboard.name'),
//            trans('postman::dashboard.email'),
//        ]);
//
//        return response($data);
    }

    public function listUsers()
    {
        return User::all()->toJson();
    }
}