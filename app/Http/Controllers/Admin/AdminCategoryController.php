<?php
/**
 * Created by PhpStorm.
 * User: Borislav
 * Date: 25.1.2019 г.
 * Time: 17:20 ч.
 */

namespace App\Http\Controllers\Admin;


use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController
{
    public function index(){
        $categories=Category::latest()->orderBy('parent_id')->get();
        /*dd($categories);*/
        /*dd($categories->find(1)->children->first());*/
        return view('admin.category',['categories'=>$categories]);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:products|min:2|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        };

            $category=new Category();
            $category->name=$request->name;
            $category->slug=str_slug($request->name);
            $category->parent_id=$request->parent_id;
            $category->save();

            return redirect()->back();


    }
    public function edit($catSlug,Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:products|min:2|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        };
        $category=Category::where('slug',$catSlug);
        $category->update(['name'=>$request->name,'slug'=>str_slug($request->name),'parent_id'=>$request->parent_id,'updated_at'=>Carbon::now()]);
        return redirect()->back();

    }

    public function destroy($catSlug,Request $request){
        $defaultCat=Category::where('slug','default')->first();
       $category=Category::where('slug',$catSlug)->first();
        $products=Product::where('category_id',$category->id)->get();
        $category->products()->detach();
        foreach ($products as $prod){
            $prod->category_id=$defaultCat->id;
            $prod->save();
        }

        $category->delete();
        return redirect()->back();
    }
}