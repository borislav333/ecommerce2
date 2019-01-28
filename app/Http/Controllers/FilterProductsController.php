<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class FilterProductsController extends Controller
{
    private $categorySlug=null;
    public function index(){
        return view('sections.filterproducts');
    }
    public function getProducts(Request $request){
        if($request->select_category!==null){
            $products=Product::where('category_id',$request->select_category)->where('slug','like','%'.str_slug($request->search_product).'%')->take(5)->get();
        }
        else{
            $products=Product::where('slug','like','%'.str_slug($request->search_product).'%')->take(5)->get();
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
        /*$categorySlug='';*/
        function categorySlug($request){
            return Category::where('id',(int)$request->select_category)->firstOrFail()->slug;
        }


        if($request->select_category===null && $request->search_product===null){
            return redirect()->route('liveSearchAll');
        }
        elseif ($request->select_category!==null && $request->search_product===null){

            return redirect()->route('liveSearchCategory',['categorySlug'=>categorySlug($request)]);
        }
        elseif($request->select_category===null && $request->search_product!==null){
            return redirect()->route('liveSearchProduct',['productSlug'=>str_slug($request->search_product)]);
        }
        else{
            return redirect()->route('liveSearchCategoryProduct',
                ['categorySlug'=>categorySlug($request),'productSlug'=>str_slug($request->search_product)]);
        }
    }
    public function liveSearchAll(){
        $products=Product::latest()->get();

        return view('sections.filterproducts',['products'=>$products]);
    }
    public function liveSearchCategory($categorySlug){
        $this->categorySlug=$categorySlug;

        $products=Product::latest()->whereHas('category',function($q){
            $q->where('slug',$this->categorySlug);
        })->get();
        return view('sections.filterproducts',['products'=>$products]);
    }
    public function liveSearchProduct($productSlug){
        $products=Product::latest()->where('slug','like','%'.$productSlug.'%')->get();
        return view('sections.filterproducts',['products'=>$products]);
    }
    public function liveSearchCategoryProduct($categorySlug,$productSlug){
        $this->categorySlug=$categorySlug;
        $products=Product::latest()->whereHas('category',function ($q){
            $q->where('slug',$this->categorySlug);
        })->where('slug','like','%'.$productSlug.'%')->get();

        return view('sections.filterproducts',['products'=>$products]);
    }


    //Filter products
    public function filterProducts(Request $request){

        return $request->all();
    }
}
