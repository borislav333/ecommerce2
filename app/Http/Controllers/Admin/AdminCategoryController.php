<?php
/**
 * Created by PhpStorm.
 * User: Borislav
 * Date: 25.1.2019 г.
 * Time: 17:20 ч.
 */

namespace App\Http\Controllers\Admin;


use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminCategoryController
{
    public function index(){
        $categories=Category::latest()->orderBy('parent_id')->get();
        /*dd($categories);*/
        /*dd($categories->find(1)->children->first());*/
        return view('admin.category',['categories'=>$categories]);
    }
    public function create(Request $request){
        if($request->name){
            $category=new Category();
            $category->name=$request->name;
            $category->slug=str_slug($request->name);
            $category->parent_id=$request->parent_id;
            $category->save();


        }

    }
    public function edit($catSlug,Request $request){

        $category=Category::where('slug',$catSlug);
        $category->update(['name'=>$request->name,'slug'=>str_slug($request->name),'parent_id'=>$request->parent_id,'updated_at'=>Carbon::now()]);
        return redirect()->back();

    }

    public function destroy($catSlug,Request $request){
        $category=Category::where('slug',$catSlug);
        $category->delete();
        return redirect()->back();
    }
}