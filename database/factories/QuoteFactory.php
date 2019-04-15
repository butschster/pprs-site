<?php

use App\Models\Quote;
use Faker\Generator as Faker;

$factory->define(Quote::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'text' => $faker->text,
        'image_uuid' => function () {
            return factory(\App\Models\Image::class)->create()->uuid;
        },
    ];
});

$factory->state(Quote::class, 'image', function ($faker) {
    return [];
});