<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        return view('admin.display');
    }

    public function createProduct(){
        $categories=Category::orderBy('name','DESC')->get();
        return view('admin.createproduct',['categories'=>$categories]);
    }
    public function addNewProduct(){

    }
}
