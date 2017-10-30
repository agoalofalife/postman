<?php
use Faker\Generator as Faker;

$factory->define(agoalofalife\postman\Models\Status::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'color_rgb' => $faker->hexcolor,
        agoalofalife\postman\Models\Status::COLUMN_UNIQUE_NAME => agoalofalife\postman\Models\Status::IN_PROCESS,
    ];
});
