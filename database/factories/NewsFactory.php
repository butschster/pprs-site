<?php

use App\Models\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->text(200),
        'text' => $faker->text(300),
        'meta_title' => $faker->sentence,
        'meta_description' => $faker->sentence,
        'meta_keywords' => implode(', ', $faker->words()),
    ];
});
