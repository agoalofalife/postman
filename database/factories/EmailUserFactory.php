<?php
use Faker\Generator as Faker;

$factory->define(agoalofalife\postman\Models\EmailUser::class, function (Faker $faker) {
    return [
        'email_id' => factory(agoalofalife\postman\Models\Email::class)->create()->id,
        'user_id' => factory(agoalofalife\postman\Models\User::class)->create()->id,
    ];
});
