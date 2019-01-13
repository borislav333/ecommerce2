<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->state(\App\Category::class,'child', function (Faker $faker) {
    $name=$faker->name;
    return [
         'name' => $name,
        'slug'=>str_slug($name),
        'parent_id' => \App\Category::all()->random()->id,
    ];
});
