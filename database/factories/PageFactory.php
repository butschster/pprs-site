<?php

use App\Models\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'slug' => $faker->slug,
        'meta_title' => $faker->sentence,
        'meta_description' => $faker->sentence,
        'meta_keywords' => implode(', ', $faker->words()),
        'color' => $faker->hexColor,
        'banner_id' => function () {
            return factory(\App\Models\Banner::class)->create()->id;
        },
        'section_image_uuid' => function () {
            return factory(\App\Models\Image::class)->create()->uuid;
        },
        'section_title' => $faker->sentence,
        'section_text' => $faker->paragraph,
        'text' => $faker->text(10000),
    ];
});

$factory->state(Page::class, 'banner', function ($faker) {
    return [];
});

$factory->state(Page::class, 'section_image', function ($faker) {
    return [];
});