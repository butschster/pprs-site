<?php

use App\Models\Banner;
use Faker\Generator as Faker;

$factory->define(Banner::class, function (Faker $faker) {
    return [
        'image_uuid' => function () {
            return factory(\App\Models\Image::class)->create()->uuid;
        },
        'content' => $faker->paragraph,
    ];
});
