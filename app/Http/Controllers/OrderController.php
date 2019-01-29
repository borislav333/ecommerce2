<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request){
        if(session()->get('cart'))
        {
            $cart=session()->get('cart');

           /* $count=count($request->productId);*/

            $cart->totalPrice=0;
            foreach ($request->productId as $key=>$val){
                $val=(int)$val;
                $cart->items[$val]['productsQuantity']=(int)$request->quantity[$key];
                $cart->items[$val]['productsPrice']=$cart->items[$val]['productsQuantity']*$cart->items[$val]['product']->newprice;
                $cart->totalPrice+=$cart->items[$val]['productsPrice'];

            }
            session()->put('cart',$cart);

            return view('sections.checkout',['cart'=>$cart]);
        }
        else{

            return redirect()->route('index');
        }
    }

    public function index2(){
            if(session()->get('cart'))
            {
                $cart=session()->get('cart');
                return view('sections.checkout',['cart'=>$cart]);
            }
            else{
                return redirect()->route('index');
            }



    }

    public function validateOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'address_options'=>'integer',
            'address' => 'required|string|min:5',
            'city' => 'required|string|min:2',
            'state' => 'string|min:2',
            'phone_number' => 'required|string|min:5',
            'email_address' => 'nullable|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }

        $order=new Order();
        $order->first_name=$request->first_name;
        $order->last_name=$request->last_name;
        $order->address_options=$request->address_options;
        $order->address=$request->address;
        $order->city=$request->city;
        $order->state=$request->state;
        $order->phone_number=$request->phone_number;
        $order->email_address=$request->email_address;

        $cart=session()->get('cart');
        $order->totalPrice=(double)$cart->totalPrice;

        $order->save();
        foreach ($cart->items as $item){
            $order->products()->attach($item['product']->id,['product_price'=>$item['productsPrice']]);
            $product=Product::where('id',$item['product']->id)->first();
            $product->quantity-=$item['productsQuantity'];
            $product->save();

        }

        return response()->json($order);

    }

    public function removeCartItems(){
        session()->forget('cart');
    }

}
