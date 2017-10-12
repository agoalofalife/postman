<?php

namespace agoalofalife\postman\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        // TODO check request to xhr in middleware
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'date' => 'required|date_format:"Y-m-d H:i:s"',
            'theme' => 'required',
            'text' => 'required',
            'mode' => 'required|exists:mode_post_emails,id',
            'users' => 'required|array',
            'users.*' => 'required|exists:users,id'
        ];
    }

    public function messages() : array
    {
        return [
            'date.required' => trans('postman::requestMessage.createTask.date.required'),
            'date.date_format' => trans('postman::requestMessage.createTask.date.date_format'),
            'theme.required' => trans('postman::requestMessage.createTask.theme.required'),
            'text.required' => trans('postman::requestMessage.createTask.text.required'),
            'mode.required' => trans('postman::requestMessage.createTask.mode.required'),
            'mode.exists' => trans('postman::requestMessage.createTask.mode.exists'),
            'users.required' => trans('postman::requestMessage.createTask.mode.exists'),
            'users.array' => trans('postman::requestMessage.createTask.users.array'),
            'users.*.required' => trans('postman::requestMessage.createTask.users.*.required'),
            'users.*.exists' => trans('postman::requestMessage.createTask.users.*.exists')
        ];
    }
}
