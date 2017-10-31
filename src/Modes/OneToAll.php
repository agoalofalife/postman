<?php
namespace agoalofalife\postman\Modes;

use agoalofalife\postman\Contract\Mode;

use Illuminate\Support\Facades\Mail;
use agoalofalife\postman\Models\SheduleEmail;
use agoalofalife\postman\Models\Status;

/**
 * Class OneToAll
 * POST `BCC EMAIL
 * @package agoalofalife\postman\Modes
 */
class OneToAll implements Mode
{
    /**
     * @param SheduleEmail $tasks
     */
    public function postEmail(SheduleEmail $tasks) : void
    {
        Mail::send('postman::email', ['html' => $tasks->email->text], function($message)  use ($tasks) {
            $message->subject($tasks->email->theme);
            $message->from(config('mail.from.address'));
            $message->to(config('mail.from.address'));
            $tasks->email->users->each(function ($value) use ($message) {
                $message->bcc($value->email);
            });
         });

        // if to reached the sender
        if (empty(Mail::failures())) {
            $tasks->status_id = Status::done();
            $tasks->save();
        }
    }

    /**
     *  Get name mode
     * @return string
     */
    public function getName(): string
    {
        return trans('postman::mode.one.name');
    }

    /**
     * Get full description
     * @return string
     */
    public function getDescription(): string
    {
        return trans('postman::mode.one.description');
    }
}