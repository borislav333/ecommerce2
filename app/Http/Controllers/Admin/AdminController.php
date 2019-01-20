<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\CategoryProduct;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $products=Product::latest()->paginate(10);
        return view('admin.display',['products'=>$products]);
    }

    public function createProductView(){
        $categories=Category::orderBy('name','DESC')->get();
        return view('admin.createproduct',['categories'=>$categories]);
    }
    public function addNewProduct(Request $request){

        //dd($request->all());

          //dd($request->productimg[0]->getClientOriginalName());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:products|min:2|max:255',
            'descr' => 'required|string|min:10',
            'price'=>'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'quantity'=>'required|integer',
            'discount'=>'required|integer',
            'category_id'=>'required|integer',
            'head_image' => 'required|image|mimes:jpeg,png,jpg|max:5048',
            'productimg.*' => 'image|mimes:jpeg,png,jpg|max:5048'

        ]);

        if ($validator->fails()) {
            return redirect('/createProduct')
                ->withErrors($validator)
                ->withInput();
        };
        DB::beginTransaction();

        try {
            $nameImg=null;
            if($request->hasFile('head_image')){
                $img=$request->file('head_image');
                $nameImg=(string)str_random(5).$img->getClientOriginalName();
                //$ext=$img->getClientOriginalExtension();
                //Storage::disk('local')->put('public/images/head_img/',$nameImg,$img,'public');
                //$img->storeAs('images/head_img', $nameImg);
                $img->move(public_path().'/images/head_img/', $nameImg);
            }
            $newProduct = new Product(['name' => $request->name,'slug'=>str_slug($request->name), 'descr' => $request->descr, 'price' => $request->price,
                'quantity' => $request->quantity, 'discount' => $request->discount,'head_image'=>$nameImg,
                'category_id' => $request->category_id, 'user_id' => auth()->id()]);
            $newProduct->save();

            //$checkIfPivotExists=CategoryProduct::where('category_id',$newProduct->category_id)->where('product_id',$newProduct->id)->exists();
           // dd($checkIfPivotExists);

            $newCategoryProduct=new CategoryProduct(['category_id'=>$newProduct->category_id,'product_id'=>$newProduct->id]);

            $newCategoryProduct->save();
            $parentCat=$newProduct->category->parent;

            if($parentCat !== null && $parentCat->count()){
                    $newCategoryProduct=new CategoryProduct(['category_id'=>$parentCat->id,'product_id'=>$newProduct->id]);
                    $newCategoryProduct->save();
                    $parentCat=$parentCat->parent;

                     if($parentCat!==null && $parentCat->count()){
                    $newCategoryProduct=new CategoryProduct(['category_id'=>$parentCat->id,'product_id'=>$newProduct->id]);
                    $newCategoryProduct->save();

                     }
            }

            if($request->hasfile('productimg'))
            {

                foreach($request->file('productimg') as $key=>$img)
                {
                    $name=str_random(5).$img->getClientOriginalName();
                    //$ext=$img->getClientOriginalExtension();
                    //Storage::disk('local')->put('images/other_img/',$img.$ext,$img);
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

    public function editProductView(string $catSlug,string $prodSlug){
        //$product=Product::where('slug',$slug)->get();
        $product=Product::where('slug',$prodSlug)->firstOrFail();
        //dd($product->images()->get());
        $categories=Category::all();

        return view('admin.editproduct',['product'=>$product,'categories'=>$categories]);
    }

    public function updateProduct(Request $request,string $catSlug,string $prodSlug){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'descr' => 'required|string|min:10',
            'price'=>'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'quantity'=>'required|integer',
            'discount'=>'required|integer',
            'category_id'=>'required|integer',
            'head_image' => 'image|mimes:jpeg,png,jpg|max:5048',
            'productimg.*' => 'image|mimes:jpeg,png,jpg|max:5048'

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        };

        DB::beginTransaction();
        try {
            $product = Product::where('slug', $prodSlug)->first();

            $product->name = $request->name;
            $product->slug = str_slug($request->name);
            $product->descr = $request->descr;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->discount = $request->discount;
            $product->category_id = $request->category_id;
            if ($request->hasFile('head_image')) {
                $path = public_path() . '\images\head_img\\' . $product->head_image;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $img = $request->file('head_image');

                $nameImg = (string)str_random(5) . $img->getClientOriginalName();
                $img->move(public_path() . '/images/head_img/',$nameImg);
                $product->head_image = $nameImg;
            }
            $product->save();
            if ($request->hasFile('productimg')) {
                foreach ($request->file('productimg') as $img) {
                    $nameImg = (string)str_random(5) . $img->getClientOriginalName();
                    $img->move(public_path() . '/images/other_img/',$nameImg);
                    $image=new Image(['source'=>$nameImg,'position'=>0,'product_id'=>$product->id]);
                    $image->save();
                }
            }
            DB::commit();
            return redirect()->back();
        }
        catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }
    public function updatePosition(int $imgid,int $position){
        $image=Image::find($imgid);
        $image->position=$position;
        $image->save();
        return redirect()->back()->with('success-position','The position is changed successfuly!');
    }

    public function removeCurrentImage(int $imgId){
        $image=Image::where('id',$imgId)->firstOrFail();

        $path=public_path().'\images\other_img\\'.$image->source;

        if(File::exists($path)){
            File::delete($path);
        }
        $image->delete();

        return redirect()->back();
    }

    public function deleteProduct(string $productslug){
        $product=Product::where('slug',$productslug)->first();
        $path=public_path().'\images\head_img\\'.$product->head_image;
        if(File::exists($path)){
            File::delete($path);
        }
        foreach ($product->images as $img){
            $path=public_path().'\images\other_img\\'.$img->source;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $product->delete();

        return redirect()->back()->with('deletedProduct','Successfuly deleted product!');
        //Product::find($prodId)->delete();

    }
}
