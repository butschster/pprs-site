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
        'banner' => 'page/banners/banner.jpg',
        'section_image' => 'page/images/banner.jpg',
        'section_title' => $faker->sentence,
        'section_text' => $faker->paragraph,
        'text' => $faker->text(10000),
    ];
});

$factory->state(Page::class, 'banner', function ($faker) {
    return [
        'banner' => 'page/banners/' . $faker->image(storage_path('app/public/page/banners'), 800, 300, null, false),
    ];
});

$factory->state(Page::class, 'section_image', function ($faker) {
    return [
        'section_image' => 'page/images/' . $faker->image(storage_path('app/public/page/images'), 600, 200, null, false),
    ];
});