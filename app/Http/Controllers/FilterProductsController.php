<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class FilterProductsController extends Controller
{
    public function index(){
        return view('sections.filterproducts');
    }
    public function getProducts(Request $request){
        if($request->select_category!==null){
            $products=Product::where('category_id',$request->select_category)->where('name','like','%'.$request->search_product.'%')->take(5)->get();
        }
        else{
            $products=Product::where('name','like','%'.$request->search_product.'%')->take(5)->get();
        }

        $html='';


        foreach ($products as $prod){
            if($request->search_product !== $prod->name) {
                $html .= '<option data-value="' . $prod->id . '" data-image="' . asset('images/head_img/' . $prod->head_image) . '">' . $prod->name . '</option>';
            }
        }
        return $html;
    }
    public function liveSearch(Request $request){
        dd($request->all());
    }
}
