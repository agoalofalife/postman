<?php

use Faker\Generator as Faker;

$factory->define(agoalofalife\postman\Models\Email::class, function (Faker $faker) {
    dd($faker->word);
    return [
        'theme' => $faker->text,
        'text' => $faker->text,
    ];
});

