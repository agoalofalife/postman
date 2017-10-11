<?php

namespace agoalofalife\postman\Http\Controllers;

use agoalofalife\postman\Models\Email;
use agoalofalife\postman\Models\EmailUser;
use agoalofalife\postman\Models\ModePostEmail;
use agoalofalife\postman\Models\SheduleEmail;
use agoalofalife\postman\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DashboardController
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[] | void
     */
    public function index() : Collection
    {
        return SheduleEmail::with(['email.users', 'mode'])->get();
    }

    /**
     * Get list modes
     * @return JsonResponse
     */
    public function listMode() : JsonResponse
    {
        return response()->json(ModePostEmail::all());
    }

    /**
     * @return JsonResponse
     */
    public function users() : JsonResponse
    {
        return response()->json(User::all());
    }

    /**
     * Get table column
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableColumn() : JsonResponse
    {
        $response = [];

        foreach (config('postman.ui.table') as $column => $size) {
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createTask(Request $request)
    {
        $request->datePostman($request);

        $email = Email::create([
            'theme' => $request->theme,
            'text' => $request->text,
        ]);
        array_map(function($user_id) use($email) {
            EmailUser::create([
                'user_id' => $user_id,
                'email_id' => $email->id,
            ]);
        }, $request->users);

        $email->tasks()->create([
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
        $request->datePostman($request);
        $task = SheduleEmail::find($request->id);
        $task->update([
            'mode_id' => $request->mode,
            'date' => $request->date,
        ]);
        $task->email->update([
            'theme' => $request->theme,
            'text' => $request->text,
        ]);

        $goalList = EmailUser::where('email_id', $task->email->id);
        $removal  = $goalList->get()->pluck('user_id')->diff($request->users)->values();
        $goalList->whereIn('user_id', $removal)->delete();

        collect($request->users)->each(function($user_id) use($task, &$usersToEmail) {
            EmailUser::firstOrCreate(['email_id' => $task->email->id, 'user_id' => $user_id]);
        });
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