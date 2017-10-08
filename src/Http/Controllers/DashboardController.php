<?php

namespace agoalofalife\postman\Http\Controllers;

use agoalofalife\postman\Models\Email;
use agoalofalife\postman\Models\ModePostEmail;
use agoalofalife\postman\Models\SheduleEmail;
use agoalofalife\postman\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController
{
    /**
     * Size column ui
     * @var array
     */
    protected $nameColumns;

    public function __construct()
    {   // set sizes column in table
        $this->nameColumns = config('postman.ui.table');
    }

    public function index()
    {
        return SheduleEmail::with('email.users')->with('mode')->get();
    }

    /**
     * Get list modes
     * @return \Illuminate\Http\JsonResponse
     */
    public function listMode()
    {
        return response()->json(ModePostEmail::all());
    }

    public function users()
    {
        return User::all();
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
                'placeholder' => trans('postman::dashboard.mode.placeholder'),
            ],
            'users' => [
                'label' => trans('postman::dashboard.users.name'),
                'placeholder' => trans('postman::dashboard.users.placeholder'),
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
        $request->date = Carbon::parse($request->date)->toDateTimeString();

         Email::create([
            'theme' => $request->theme,
            'text' => $request->text,
        ])->tasks()->create([
            'date' => $request->date,
            'mode_id' => $request->mode,
            'status_action' => 0
        ]);
        return response()->json(['status' => true]);
    }

    /**
     * Update task
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTask(Request $request)
    {
        $request->date = Carbon::parse($request->date)->toDateTimeString();
        $task = SheduleEmail::find($request->id);
        $task->update([
            'mode_id' => $request->mode,
            'date' => $request->date,
        ]);
        $task->email->update([
            'theme' => $request->theme,
            'text' => $request->text,
        ]);
        return response()->json(['status' => true]);
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