<?php

namespace agoalofalife\postman\Http\Controllers;

use agoalofalife\postman\Models\ModePostEmail;
use agoalofalife\postman\Models\SheduleEmail;
use App\User;
use Illuminate\Http\Request;

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
     * Get list modes
     * @return \Illuminate\Http\JsonResponse
     */
    public function listMode()
    {
        return response()->json(ModePostEmail::all());
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
     * Base this is text for form
     * @return \Illuminate\Http\JsonResponse
     */
    public function formColumn()
    {
        $forms = [
           'date' =>  [
                'label' => trans('postman::dashboard.date'),
                'rule' => [
                    'required'=> true, 'message'=> 'Please input Activity name', 'trigger'=> 'blur',
                ]
            ],
            'theme' => [
                'label' => trans('postman::dashboard.email.theme'),
            ],
            'text' => [
                'label' => trans('postman::dashboard.email.text'),
            ],
            'type' => [
                'label' => trans('postman::dashboard.mode.name'),
                'placeholder' => trans('postman::dashboard.mode.name'),
            ],
            'button' => [
                'success' => trans('postman::dashboard.form.button.success'),
                'cancel' => trans('postman::dashboard.form.button.cancel'),
            ],
            'popup' => [
              'question' => trans('postman::dashboard.popup.question'),
              'title' => trans('postman::dashboard.popup.title'),
              'confirmButtonText' => trans('postman::dashboard.popup.confirmButtonText'),
              'cancelButtonText' => trans('postman::dashboard.popup.cancelButtonText'),
              'success.message' => trans('postman::dashboard.popup.success.message'),
              'info.message' => trans('postman::dashboard.popup.info.message'),
            ],
        ];
        return response()->json($forms);
    }

    public function createTask(Request $request)
    {
        dd($request->all());
    }

    public function updateTask(Request $request)
    {
        dd($request->all());
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function remove($id)
    {
        SheduleEmail::destroy($id);
        return response()->json(true);
    }
}