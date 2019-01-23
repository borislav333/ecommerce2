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
        $orders=Order::latest()->paginate(10)->items();

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
    public function viewOrder($orderId){
        $order=Order::where('id',$orderId)->first();
        dd($order);
    }
}