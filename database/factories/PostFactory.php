<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 3),
        'category_id' => rand(1, 4),
        'title' => $faker->sentence(),
        'slug' => Str::slug($faker->sentence()),
        'body' => $faker->paragraph('100')
    ];
});
