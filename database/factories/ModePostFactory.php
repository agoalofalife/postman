<?php
use Faker\Generator as Faker;

$factory->define(agoalofalife\postman\Models\ModePostEmail::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'owner' => collect(config('postman.modes'))->random()
    ];
});
