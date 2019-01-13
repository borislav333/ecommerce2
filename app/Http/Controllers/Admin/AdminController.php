<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        return view('admin.display');
    }

    public function createProduct(){
        $categories=Category::orderBy('name','DESC')->get();
        return view('admin.createproduct',['categories'=>$categories]);
    }
    public function addNewProduct(Request $request){

        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
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
        $newProduct = new Product(['name' => $request->name, 'descr' => $request->descr, 'price' => $request->price,
            'quantity' => $request->quantity, 'discount' => $request->discount,'head_image'=>$request->head_image->getClientOriginalName(),
            'category_id' => $request->category_id, 'user_id' => auth()->id()]);

        foreach ($request->productimg as $img){
            $newImage[] = new Image(['source' => $request->productimg[0]->getClientOriginalName(), 'position' => 0, 'product_id' => $newProduct->id]);
        }
        DB::beginTransaction();

        try {
            $newProduct = new Product(['name' => $request->name, 'descr' => $request->descr, 'price' => $request->price,
                'quantity' => $request->quantity, 'discount' => $request->discount,'head_image'=>$request->head_image->getClientOriginalName(),
                'category_id' => $request->category_id, 'user_id' => auth()->id()]);
            $newProduct->save();
            foreach ($request->productimg as $key=>$img){
                $newImage[$key] = new Image(['source' => $request->productimg[0]->getClientOriginalName(), 'position' => 0, 'product_id' => $newProduct->id]);
                $newImage[$key]->save();
            }


            DB::commit();
        }
        catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();

        }

    /*    DB::transaction(function()
        {


/*
            $images = User::create([
                'username' => Input::get('username'),
                'account_id' => $newAcct->id,
            ]);

            if(!$newProduct){
                throw new \Exception('I can\'t add new product,error happened! ');
            }
            if(!$images){
                throw new \Exception('I can\'t add new images,error happened! ');
            }*/

    }
}
