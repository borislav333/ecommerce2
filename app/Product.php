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

    public function getNewPriceAttribute(){
        return $this->price*((100-$this->discount)/100);
    }
    public function images(){
        $this->hasMany(Image::class);
    }
}
