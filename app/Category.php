<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id');
    }
    public function children(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
   /* public function products(){
        return $this->hasMany(Product::class);
    }*/
    public function products(){
        return $this->belongsToMany(Product::class,'category_product','category_id','product_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
