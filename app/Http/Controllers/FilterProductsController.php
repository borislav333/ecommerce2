<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class FilterProductsController extends Controller
{
    private $categorySlug=null;
    private $request;
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
        $this->request=$request;
        $products=Product::whereHas('categories',function ($q){
            if((int)$this->request->parent_cat){
                $q->where('category_id',(int)$this->request->parent_cat);
            }

        });
        if((int)$request->sub_cat){
            $products->where('category_id',(int)$request->sub_cat);
        }
        if($request->price_min && $request->price_max){
            $products->whereBetween('price',[(float)$request->price_min,(float)$request->price_max]);
        }

        $brands=[];
        /*if($request->brands){
            foreach ($request['brands'] as $k=>$val){
                $arr[$k]=(int)$val;
                $products->where('brand_id',(int)$val);
            }
        }
        if($request->parent_cat){

        }*/

        $html='';
        $request['brands']=$brands;


       /* $html.='   foreach($products as $prod)
                        <div class="product">
                            <div class="product-img text-center" >
                                <img src="{{asset(\'images/head_img/\'.$prod->head_image)}}" alt="" height="200" >
                                <div class="product-label">
                                    @if($prod->discount>0)
                                        <span class="sale">-{{$prod->discount}}%</span>
                                    @endif

                                    <span class="new">NEW</span>
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{$prod->category->name}}</p>
                                <h3 class="product-name " style="height: 40px;">
                                    <a href="{{route(\'getCurrentProduct\',[\'category\'=>$prod->category->slug,\'product\'=>$prod->slug])}}"
                                       class="product-name-alink " style="">
                                        {{$prod->name}}
                                    </a>
                                </h3>
                                <h4 class="product-price">${{$prod->newprice}}
                                    @if($prod->discount>0)
                                        <del class="product-old-price">${{$prod->price}}</del></h4>
                                @endif
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product-btns">
                                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                </div>
                            </div>
                            <div class="add-to-cart" >
                                <form action="{{route(\'addToCart\',[\'prodId\'=>$prod->id])}}" method="post">
                                    @method(\'post\')
                                    @csrf
                                    <span style="color:white;margin-right: 6px;display: none;">Quantity:</span>
                                    <input type="hidden" min="1" max="{{$prod->quantity}}" value="1" name="addProdQuantity">
                                    <div style="height: 8px"></div>
                                    <button class="add-to-cart-btn" type="submit"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                </form>

                            </div>
                        </div>
                    @endforeach';*/

       /* return $request->all();*/
        return $products->get();
    }
}
