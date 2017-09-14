<?php
namespace agoalofalife\postman\Contract;

use agoalofalife\postman\Models\SheduleEmail;

/**
 * Interface Mode
 *
 * @package agoalofalife\postman\Contract
 */
interface Mode
{
    public function postEmail(SheduleEmail $shedule);
}