<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Events\newOrderNotification;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    private $order;
    public function index(Request $request){
        try {
            if (session()->get('cart')) {
                $cart = session()->get('cart');

                /* $count=count($request->productId);*/


                $cart->totalPrice = 0;
                foreach ($request->productId as $key => $val) {
                    if (Product::where('id', $val)->first()->quantity < $cart->items[$val]['productsQuantity']) {
                        throw new \Exception('Quantity not match!');
                    }
                    $val = (int)$val;
                    $cart->items[$val]['productsQuantity'] = (int)$request->quantity[$key];
                    $cart->items[$val]['productsPrice'] = $cart->items[$val]['productsQuantity'] * $cart->items[$val]['product']->newprice;
                    $cart->totalPrice += $cart->items[$val]['productsPrice'];

                }
                session()->put('cart', $cart);

                return view('sections.checkout', ['cart' => $cart]);
            } else {

                return redirect()->route('index');
            }
        }
        catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function checkoutView(){

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
        DB::beginTransaction();
        try {
            $order = new Order();
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->address_options = $request->address_options;
            $order->address = $request->address;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->phone_number = $request->phone_number;
            $order->email_address = $request->email_address;
            if(auth()->user()){
                $order->user_id=auth()->user()->id;
            }
            $cart = session()->get('cart');
            $order->totalPrice = (double)$cart->totalPrice;

            $order->save();
            foreach ($cart->items as $item) {
                $order->products()->attach($item['product']->id, ['product_price' => $item['productsPrice'],'product_quantity'=>$item['productsQuantity']]);
                $product = Product::where('id', $item['product']->id)->first();
                $product->quantity -= $item['productsQuantity'];
                $product->save();

            }
            if ($order->email_address) {
                $this->order = $order;
                Mail::send('mail', [], function ($message) {
                    $message->to($this->order->email_address, $this->order->first_name.' '.$this->order->last_name)->subject('Ecommerce Order.');
                    $message->from('testqkimov@yahoo.com', 'Support Ecommerce');
                });
            }
            event(new newOrderNotification($order));

            DB::commit();
        }
        catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        return response()->json($order);

    }

    public function removeCartItems(){
        session()->forget('cart');
    }

    public function broadcast(){
        Input::get('message');
        $user=User::where('id',1)->first();
        event(new ChatEvent($user,'event'));

    }
}
