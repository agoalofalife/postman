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
    public function run() : void
    {
        foreach (config('postman.modes') as $mode) {
            $object = (new $mode);
            ModePostEmail::firstOrCreate([
                'name' => $object->getName(),
                'description' => $object->getDescription(),
                'owner' => get_class($object)
            ]);
        }
    }
}
