<?php
/**
 * Created by PhpStorm.
 * User: Borislav
 * Date: 20.1.2019 г.
 * Time: 16:17 ч.
 */

namespace App;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class Cart
{
    public $items=[];
    public $totalQuantity=0;
    public $totalPrice=0;

    public function __construct($session)
    {
        if ($session !== null){
            $this->items=$session->items;
            $this->totalQuantity=(int)$session->totalQuantity;
            $this->totalPrice=$session->totalPrice;
        }
    }

    public function addItemToCart($product,int $quantity){
        try {
            if ($quantity > $product->quantity) {
                throw new \Exception('The max amount of quantity is '.$product->quantity.'!');
        }
            if ($quantity < 1) {
                throw new \Exception('The min amount of quantity is 1!');
            }

            if (!array_key_exists($product->id, $this->items)) {
                $this->items[$product->id]['product'] = $product;
                $this->items[$product->id]['product']['newprice'] = $product->newprice;
                $this->items[$product->id]['productsPrice'] = 0;
                $this->items[$product->id]['productsQuantity'] = (int)0;
                $this->totalQuantity++;
            }
            $this->items[$product->id]['productsQuantity'] += $quantity;
            $this->items[$product->id]['productsPrice'] = $this->items[$product->id]['productsQuantity'] * $product->newprice;
            $this->totalPrice += $quantity * $product->newprice;
        }
        catch (\Exception $e){
            \session()->flash('wrongQuantity',$e->getMessage());
        }
    }


    public function getTotalQuantity():int{
        return $this->totalQuantity;
    }
    public function getTotalPrice() {
        return $this->totalPrice;
    }

}