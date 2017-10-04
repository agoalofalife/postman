<?php

namespace agoalofalife\postman\Http\Controllers;

use agoalofalife\postman\Models\SheduleEmail;
use App\User;

class DashboardController
{
    protected $nameColumns = [
        'id' => 40,
        'date' => 180,
        'email.theme' => 180,
        'email.text' => 400,
        'mode.name' => 130,
        'status_action' => 210,
        'updated_at' => 120,
    ];

    public function index()
    {
        return SheduleEmail::with('email')->with('mode')->get();
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

    /**
     * @param $id
     */
    public function remove()
    {

    }
}