<?php

use Faker\Generator as Faker;

$factory->define(agoalofalife\postman\Models\Email::class, function (Faker $faker) {
    return [
        'theme' => $faker->name,
        'text' => $faker->text,
    ];
});

