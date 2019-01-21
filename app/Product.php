<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //protected $fillable=['name','descr','head_image','quantity','category_id','discount'];
    protected $guarded=[];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'category_product','product_id','category_id');
    }
    public function getNewPriceAttribute(){
        return round(( $this->price*((100-$this->discount)/100) ) , 2 );
    }
    public function images(){
        return $this->hasMany(Image::class,'product_id','id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
