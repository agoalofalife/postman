<?php
use Faker\Generator as Faker;

$factory->define(agoalofalife\postman\Models\SheduleEmail::class, function (Faker $faker) {
    return [
        'date' => $faker->date('Y-m-d'),
        'email_id' => factory(agoalofalife\postman\Models\Email::class)->create()->id,
        'mode_id' => factory(agoalofalife\postman\Models\ModePostEmail::class)->create()->id,
        'status_id' => factory(agoalofalife\postman\Models\Status::class)->create()->id,
    ];
});
