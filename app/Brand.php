<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps=null;

    public function products(){
        return $this->hasMany(Product::class);
    }
}
