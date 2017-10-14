<?php
namespace agoalofalife\postman;

use agoalofalife\postman\Models\SheduleEmail;
use Carbon\Carbon;

/**
 * Class Parser
 *
 * @package agoalofalife\postman
 */
class Parser
{
    public static function parse() : void
    {
         SheduleEmail::whereRaw('CAST(date AS Datetime) <= ? AND status_action = ?', [Carbon::now(), 0])->get()
                    ->each(function ($value) {
                        $value->mode->owner->postEmail($value);
                    });
    }
}
