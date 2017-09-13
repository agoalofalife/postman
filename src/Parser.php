<?php

namespace agoalofalife\postman;

use agoalofalife\postman\Models\SheduleEmail;
use Carbon\Carbon;

class Parser
{
    public function parse()
    {
        $now = Carbon::now();
        SheduleEmail::all()->each(function ($value, $key) use ($now) {
            if ($value->date > $now) {
                $mode = FactoryMode::get($value->mode);
            }
        });
    }
}