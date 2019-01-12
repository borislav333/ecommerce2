<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getNewPriceAttribute(){
        return $this->price*((100-$this->discount)/100);
    }
}
