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

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'descr' => $faker->text,
        'price'=>$faker->randomFloat(8,2,2),
        'head_image'=>/*'img'.$faker->randomNumber(2)*/'head_img/1.jpg',
        'quantity'=>$faker->randomNumber(3),
        'category_id'=>\App\Category::all()->random()->id,
        'user_id'=>\App\User::all()->random()->id,
        'discount'=>$faker->randomDigit
    ];
});
