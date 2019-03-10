<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
      'title' => $faker->sentence,
      'content' => $faker->paragraphs(rand(3, 10), true),
      'published' => $faker->boolean,
    ];
});
