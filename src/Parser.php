<?php
namespace agoalofalife\postman;

use agoalofalife\postman\Models\SheduleEmail;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;

/**
 * Class Parser
 *
 * @package agoalofalife\postman
 */
class Parser
{
    public static function parse()
    {
        $now = Carbon::now();

         SheduleEmail::whereRaw('CAST(date AS Datetime) <= ? AND status_action = ?', [$now, 0])->get()
                    ->each(function ($value) {
                        $mode = FactoryMode::get($value->mode_id);

                        $mode->postEmail($value);
                        unset($mode);
                    });
    }
}
