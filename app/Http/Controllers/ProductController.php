<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

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

    public function getCurrentProduct(string $categorySlug,string $productSlug){
        $categoryId=Category::where('slug',$categorySlug)->firstOrFail()->id;

        $product=Product::where(['slug'=>$productSlug,'category_id'=>$categoryId])->firstOrFail();


        return view('layouts.viewproduct',['product'=>$product]);
    }

    public function viewCart(){

        if(Session::get('cart')){
            $cart=Session::get('cart');
            return view('sections.viewCart',['cart'=>$cart]);
        }
        return redirect()->route('index');
    }
    public function addToCart(Request $request,int $prodId){
        /*session_destroy();
        dd();*/
        $session=Session::get('cart');
        $product=Product::find($prodId);

        $cart=new Cart($session);
        $cart->addItemToCart($product,(int)$request->post('addProdQuantity'));
        Session::put('cart',$cart);
        return redirect()->back();
    }

    public function removeFromCart(int $prodId){
        $cart=session()->get('cart');
        if(array_key_exists($prodId,$cart->items)){
            /*$cart->totalQuantity-=$cart->items[$prodId]['productsQuantity'];*/
            $cart->totalQuantity--;
            $cart->totalPrice-=$cart->items[$prodId]['productsPrice'];
            unset($cart->items[$prodId]);
            \session()->put('cart',$cart);
        }
        return redirect()->back();
    }
}
