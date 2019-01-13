<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


            factory(\App\Category::class,4)->create();

        factory(\App\Category::class, 6)->states('child')->create();
        factory(App\User::class, 3)->create();
            for ($i=0;$i<10;$i++){
                $p1=factory(App\Product::class)->create();
                DB::table('category_product')->insert([
                    'category_id' => $p1->category_id,
                    'product_id' => $p1->id
                ]);
            }


        //factory(App\Product::class,10);
        factory(\App\CategoryProduct::class,60)->create();

        /*
        factory(App\Product::class, 20)->create();

        factory(\App\CategoryProduct::class,60)->create();
        factory(App\Image::class, 100)->create();*/

    }
}
