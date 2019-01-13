<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(\App\Category::class, 10)->create();
        factory(\App\Category::class, 5)->states('child')->create();
        factory(App\User::class, 3)->create();
        factory(App\Product::class, 20)->create();
        factory(App\Image::class, 100)->create();


    }
}
