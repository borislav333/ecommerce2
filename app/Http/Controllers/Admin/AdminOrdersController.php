<?php
/**
 * Created by PhpStorm.
 * User: Borislav
 * Date: 23.1.2019 г.
 * Time: 11:24 ч.
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class AdminOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','is_admin']);
    }

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
    public function viewOrder(int $orderId){
        $order=Order::where('id',$orderId)->first();
        /*dd($order->products()->get()[0]->pivot->product_price);*/
        return view('admin.viewOrder',['order'=>$order]);
    }
}