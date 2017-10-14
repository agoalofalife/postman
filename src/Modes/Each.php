<?php
namespace agoalofalife\postman\Modes;

use agoalofalife\postman\Contract\Mode;
use agoalofalife\postman\Models\SheduleEmail;
use Illuminate\Support\Facades\Mail;

class Each implements Mode
{
    /**
     * @param SheduleEmail $tasks
     * @return mixed|void
     */
    public function postEmail(SheduleEmail $tasks)
    {
        Mail::raw($tasks->email->text, function ($message) use ($tasks) {
        $message->subject($tasks->email->theme);
        $message->from(config('mail.from.address'));
        $message->to($tasks->email->users->map(function($value){ return $value->email;})->toArray());
    });

        // if to reached the sender
        if (empty(Mail::failures())) {
            $tasks->status_action = 1;
            $tasks->save();
        }
    }

    /**
     *  Get name mode
     * @return string
     */
    public function getName(): string
    {
        return trans('postman::mode.two.name');
    }

    /**
     * Get full description
     * @return string
     */
    public function getDescription(): string
    {
        return trans('postman::mode.two.name');
    }
}