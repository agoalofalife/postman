<?php

namespace agoalofalife\postman\Http\Controllers;

use agoalofalife\postman\Models\SheduleEmail;
use App\User;

class DashboardController
{
    protected $nameColumns = [
        'date' => 170,
        'theme' => 180,
        'text' => 400,
        'mode' => 130,
        'status' => 120,
        'updateAt' => 120
    ];

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

    /**
     * Get table column
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableColumn()
    {
        $response = [];
        foreach ($this->nameColumns as $column => $size) {
            $response['columns'][] = [
                'prop' => $column,
                'size' => $size,
                'label' => trans("postman::dashboard.{$column}")
            ];
        }
        $response['button'] = [
            'edit' => trans('postman::dashboard.button.edit'),
            'remove' => trans('postman::dashboard.button.remove'),
        ];
        return response()->json($response);
    }
    public function listUsers()
    {
        return User::all()->toJson();
    }
}