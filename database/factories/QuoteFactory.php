<?php

use App\Models\Quote;
use Faker\Generator as Faker;

$factory->define(Quote::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'text' => $faker->text,
        'image' => 'quote/image.jpg',
    ];
});

$factory->state(Quote::class, 'image', function ($faker) {
    return [
        'image' => 'quote/' . $faker->image(storage_path('app/public/quote'), 300, 300, null, false),
    ];
});