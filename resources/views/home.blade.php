@extends('index')

@section('center')
    <style class="cp-pen-styles">


        .product {
            width: 610px;
            height: 250px;
            display: flex;
            margin: 1em 0;
            border-radius: 5px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0px 0px 21px 3px rgba(0, 0, 0, 0.15);
            transition: all .1s ease-in-out;
        }
        .product:hover {
            box-shadow: 0px 0px 21px 3px rgba(0, 0, 0, 0.11);
        }
        .product .img-container {
            flex: 2;
        }
        .product .img-container img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
        .product .product-info {
            background: #fff;
            flex: 3;
        }
         .product .product-info .product-content {
            padding: .2em 0 .2em 1em;
        }
         .product .product-info .product-content h1 {
            font-size: 1.5em;
        }
         .product .product-info .product-content p {
            color: #636363;
            font-size: .9em;
            font-weight: bold;
            width: 90%;
        }
         .product .product-info .product-content ul li {
            color: #636363;
            font-size: .9em;
            margin-left: 0;
        }
         .product .product-info .product-content .buttons {
            padding-top: .4em;
        }
        .product .product-info .product-content .buttons .button {
            text-decoration: none;
            color: #5e5e5e;
            font-weight: bold;
            padding: .3em .65em;
            border-radius: 2.3px;
            transition: all .1s ease-in-out;
        }
        .product .product-info .product-content .buttons .add {
            border: 1px #5e5e5e solid;
        }
        .product .product-info .product-content .buttons .add:hover {
            border-color: #6997b6;
            color: #6997b6;
        }
         .product .product-info .product-content .buttons .buy {
            border: 1px #5e5e5e solid;
        }
         .product .product-info .product-content .buttons .buy:hover {
            border-color: #6997b6;
            color: #6997b6;
        }
        .product .product-info .product-content .buttons #price {
            margin-left: 4em;
            color: #5e5e5e;
            font-weight: bold;
            border: 1px solid rgba(137, 137, 137, 0.2);
            background: rgba(137, 137, 137, 0.04);
        }
    </style>
    <div class="">



                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                        <div class="container mb-4">
                            <div class="row col-md-10">
                                <div class="col-10">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                           <h3>My orders</h3>

                                            @foreach(auth()->user()->orders as $order)
                                            <tr>
                                                <td class="text-right"><h4>Order {{$loop->iteration}}</h4> </td>
                                                <td></td>
                                                <td>{{$order->created_at->diffForHumans()}}</td>
                                                <td class="text-right"><b>$ {{$order->totalPrice}}</b></td>

                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th>{{str_plural('Product',$order->products->count())}}</th>
                                                <th>{{$order->products->count()}}</th>

                                                <th class="text-right"></th>

                                            </tr>
                                            @foreach($order->products as $product)
                                                <tr>
                                                    <td><img src="{{asset('images/head_img/'.$product->head_image)}}" height="40"/> </td>
                                                    <td>Products Dada</td>
                                                    <td>{{$product->pivot->product_quantity}} pcs</td>
                                                    <td class="text-right">${{$product->pivot->product_price}}</td>
                                                </tr>

                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="bg-info"><b>STATUS:{!! ($order->dispatched) ? '  <b class="text-success">SENDED<b>' : '  <b class="text-danger">NOT SENDED YET<b>'!!}</b></td>
                                                    <td class="text-right bg-info"></td>
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
    </div>


@endsection
