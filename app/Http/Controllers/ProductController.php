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


        $lastProducts=Category::where('id',$catId)->first()->products()->orderBy('created_at','DESC')->get();
        //dd($lastProducts);


        return view('ajax_view.homeprod',['products'=>$lastProducts]);
    }

    public function getCurrentProduct($categorySlug,$productSlug){
        $categoryId=Category::where('slug',$categorySlug)->firstOrFail()->id;

        $product=Product::where(['slug'=>$productSlug,'category_id'=>$categoryId])->firstOrFail();


        return view('layouts.viewproduct',['product'=>$product]);
    }

}
