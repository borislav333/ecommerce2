<?php

use Faker\Generator as Faker;

$factory->define(\App\CategoryProduct::class, function (Faker $faker) {

    $catid=\App\Category::where('parent_id','>',0)->get()->random()->id;
    $prodid=\App\Product::where('parent_id','>',0)->get()->random()->id;
    $check= (\App\CategoryProduct::where('category_id',$catid)->where('product_id',$prodid)->exists()) ? true : false;
    if($check){
        return $check;
    }
    return [
        'category_id'=>$catid,
        'product_id'=>$prodid
    ];

});
