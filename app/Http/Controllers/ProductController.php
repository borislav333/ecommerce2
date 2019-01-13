<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    public function index(){

        $lastProducts=Product::orderBy('created_at','DESC')->get();
        $p_categories=Category::where('parent_id',null)->orderBy('name','DESC')->get();

        /*if(Input::get('cat')==='laptops'){
            $lastProducts=$lastProducts->where('id',2);
        }*/

        return view('layouts.products',['products'=>$lastProducts,'p_categories'=>$p_categories]);
    }
    public function getNewProdsByCategory(){

        $catId=Input::get('cat');
        $lastProducts=[];
        $catt=Category::where('id',$catId)->get()[0]->children()->latest()->get();
        foreach ($catt as $cat){
            foreach ($cat->products()->get() as $prod){
                $lastProducts[]=$prod;
            }
        }


        usort($lastProducts,function ($a,$b){
            return $b->created_at <=> $a->created_at;
        });

        //dd($lastProducts[0]->created_at);
        //dd($lastProducts);

        return view('ajax_view.homeprod',['products'=>$lastProducts]);
    }


}
