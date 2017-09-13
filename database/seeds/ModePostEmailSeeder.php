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
            'name' => 'One email at all',
            'description' => 'All copies of the same email',
        ]);

        ModePostEmail::firstOrCreate([
            'name' => 'Each',
            'description' => 'A email is sent to all',
        ]);
    }
}
