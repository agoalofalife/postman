<?php

use agoalofalife\postman\Models\ModePostEmail;
use Illuminate\Database\Seeder;

/**
 * Class ModePostEmailSeeder
 */
class ModePostEmailSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        ModePostEmail::firstOrCreate([
            'name' => trans('postman::mode.one.name'),
            'description' => trans('postman::mode.one.description'),
        ]);

        ModePostEmail::firstOrCreate([
            'name' => trans('postman::mode.two.name'),
            'description' => trans('postman::mode.two.description'),
        ]);
    }
}
