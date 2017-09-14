<?php
namespace agoalofalife\postman\Modes;

use agoalofalife\postman\Contract\Mode;

use Illuminate\Support\Facades\Mail;
use agoalofalife\postman\Models\SheduleEmail;

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
    public function postEmail(SheduleEmail $tasks)
    {
         Mail::raw($tasks->email->text, function ($message) use ($tasks) {
            $message->subject($tasks->email->theme);
            $message->from(config('mail.from.address'));
            $message->to(config('mail.from.address'));

            $tasks->email->users->each(function ($value) use ($message) {
                $message->bcc($value->email);
            });
         });

        // if to reached the sender
        if (empty(Mail::failures())) {
            $tasks->status_action = 1;
            $tasks->save();
        }
    }
}