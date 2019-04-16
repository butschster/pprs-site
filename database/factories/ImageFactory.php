<?php

use App\Models\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'disk' => 'public',
        'mime' => 'image/jpeg',
        'size' => 1024*60,
        'file_path' => 'images/' . $faker->image(storage_path('app/public/images'), 800, 300, null, false),
    ];
});
