<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\CategoryProduct;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $products=Product::paginate(10);
        return view('admin.display',['products'=>$products]);
    }

    public function createProductView(){
        $categories=Category::orderBy('name','DESC')->get();
        return view('admin.createproduct',['categories'=>$categories]);
    }
    public function addNewProduct(Request $request){

        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:products|min:2|max:255',
            'descr' => 'required|string|min:10',
            'price'=>'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'quantity'=>'required|integer',
            'discount'=>'required|integer',
            'category_id'=>'required|integer',
            'head_image' => 'required|image|mimes:jpeg,png,jpg|max:5048',
            'productimg.*' => 'required|image|mimes:jpeg,png,jpg|max:5048'

        ]);

        if ($validator->fails()) {
            return redirect('/createProduct')
                ->withErrors($validator)
                ->withInput();
        };
          //dd($request->productimg[0]->getClientOriginalName());

        DB::beginTransaction();

        try {
            $nameImg=null;
            if($request->hasFile('head_image')){
                $img=$request->file('head_image');
                $nameImg=(string)str_random(5).$img->getClientOriginalName();
                $img->move(public_path().'/images/head_img/', $nameImg);
            }
            $newProduct = new Product(['name' => $request->name,'slug'=>str_slug($request->name), 'descr' => $request->descr, 'price' => $request->price,
                'quantity' => $request->quantity, 'discount' => $request->discount,'head_image'=>$nameImg,
                'category_id' => $request->category_id, 'user_id' => auth()->id()]);
            $newProduct->save();

            $checkIfPivotExists=CategoryProduct::where('category_id',$newProduct->category_id)->where('product_id',$newProduct->id)->exists();
           // dd($checkIfPivotExists);

            $newCategoryProduct=new CategoryProduct(['category_id'=>$newProduct->category_id,'product_id'=>$newProduct->id]);

            $newCategoryProduct->save();

            if($request->hasfile('productimg'))
            {

                foreach($request->file('productimg') as $key=>$img)
                {
                    $name=str_random(5).$img->getClientOriginalName();
                    $img->move(public_path().'/images/other_img/', $name);
                    //$data[] = $name;
                    $newImage[$key] = new Image(['source' => $name, 'position' => 0, 'product_id' => $newProduct->id]);
                    $newImage[$key]->save();
                }
            }
            DB::commit();
            return redirect()->back()->with('addedProd','Your product has been addded!');
        }
        catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();

        }

    }

    public function editProduct(){

    }

}
