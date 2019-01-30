<?php
/**
 * Created by PhpStorm.
 * User: Borislav
 * Date: 23.1.2019 г.
 * Time: 11:24 ч.
 */

namespace App\Http\Controllers\Admin;


use App\Order;
use Illuminate\Http\Request;

class AdminOrdersController
{
    public function index(){
        $orders=Order::latest()->paginate(10);

        return view('admin.orders',['orders'=>$orders]);
    }
    public function searchUserOrders(Request $request){
        if($request->ajax()){
            $orders=Order::latest()->where('first_name','LIKE','%'.$request->search)->get();
            return $orders;
        }
    }
    public function dispatchOrder(Request $request){

        $order=Order::where('id',(int)$request->order)->first();
        $order->dispatched=(int)$request->dispatch;
        $order->save();
        return redirect()->back();
    }
    public function viewOrder(){
        $order=Order::where('id',36)->first();
        /*dd($order->products()->get()[0]->pivot->product_price);*/
        return view('admin.viewOrder',['order'=>$order]);
    }
}