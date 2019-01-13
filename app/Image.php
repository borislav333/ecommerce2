<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps=false;

    //protected $fillable=['source','position'];
    protected $guarded=[];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
