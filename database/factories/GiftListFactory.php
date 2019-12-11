<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\GiftList;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(GiftList::class, function (Faker $faker) {

    $information = rand(0, 1) ? $faker->realtext(100, 4) : null;
    $commentCheck = rand(0, 1) ? true : false;
    return [
        'user_id' => rand(1, 5),
        'domain' => $faker->word,
        'title' => $faker->words(rand(2, 4), true),
        'background_image' => $faker->imageUrl(640, 480),
        'information' => $information,
        'date' => Carbon::now()->addDays(rand(2, 15))->toDateString(),
        'comment_opt' => $commentCheck,
    ];
});
