<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Gift;
use Faker\Generator as Faker;

$factory->define(Gift::class, function (Faker $faker) {

    return [
        'gift_list_id' => rand(1, 10),
        'name' => $faker->words(rand(1, 3), true),
    ];
});
