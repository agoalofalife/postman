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
    /**
     * Implementation Mode in method
     * @param SheduleEmail $shedule
     * @return mixed
     */
    public function postEmail(SheduleEmail $shedule);

    /**
     *  Get name mode
     * @return string
     */
    public function getName() : string;

    /**
     * Get full description
     * @return string
     */
    public function getDescription() : string;

}