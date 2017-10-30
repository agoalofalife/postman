<?php

use agoalofalife\postman\Models\Status;
use Illuminate\Database\Seeder;

/**
 * Class StatusesSeeder
 */
class StatusesSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run() : void
    {
        foreach (trans('postman::statuses') as $status) {
            Status::firstOrCreate([
                'name' => $status['name'],
                'description' => $status['description'],
                'color_rgb' => $status['color_rgb'],
            ]);
        }
    }
}
