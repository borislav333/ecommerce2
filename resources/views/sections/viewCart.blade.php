@extends('index')
@section('center')

    {{--{{dd($cart->items[91]['product'])}}--}}

        <form action="{{route('orderIndex')}}" method="post">
            @csrf
            <div class="container mb-4">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col"> </th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Single Price</th>
                                    <th scope="col" class="text-center">Quantity</th>
                                    <th scope="col" class="text-right">Price</th>
                                    <th> </th>
                                </tr>
                                </thead>
                                <tbody>
                                <div id="app">
                                    <example-component></example-component>
                                </div>

                                @foreach($cart->items as $item)
                                    <input type="hidden" name="productId[]" value="{{ $item['product']->id }}">
                                    <tr>
                                        <td><img src="{{asset('images/head_img/'.$item['product']->head_image)}}" height="50"/> </td>
                                        <td>{{$item['product']->name}}</td>
                                        <td>$ <span id="singlePrice">{{$item['product']->newprice}}</span></td>

                                        <td><input class="form-control productsQuantity" type="number" value="{{$item['productsQuantity']}}"
                                            min="1" max="{{$item['product']->quantity}}" step="1" name="quantity[]"/></td>
                                        <td class="text-right" ><b>$ </b><b class="productsPrice">{{$item['productsPrice']}}</b></td>
                                        <td class="text-right"><button class="btn btn-sm btn-danger"
                                             formaction="{{route('removeFromCart',$item['product']->id)}}"><i class="fa fa-trash"></i> </button> </td>
                                    </tr>
                                @endforeach

                                {{-- <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Sub-Total</td>
                                    <td class="text-right">255,90 €</td>
                                </tr>--}}
                                {{--<tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Shipping</td>
                                    <td class="text-right">6,90 €</td>
                                </tr>--}}
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td class="text-right"><strong>$ </strong><strong id="totalPrice">{{$cart->totalPrice}}</strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col mb-2">
                        <div class="row">
                            <div class="col-sm-12  col-md-6">
                                <a class="btn btn-block btn-primary" href="/">Continue Shopping</a>
                            </div>
                            <div class="col-sm-12 col-md-6 text-right">
                                <button class="btn btn-lg btn-block btn-success text-uppercase" >Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    <script type="text/javascript">
        document.onreadystatechange = function () {
            $('.productsQuantity').on('keyup change',function () {
                let singlePrice=parseFloat($(this).parent().prev().children('#singlePrice').text()).toFixed(2);

                $(this).parent().next().children('.productsPrice').text(parseFloat(singlePrice*$(this).val()).toFixed(2));
                let as=[];
                $('.productsPrice').each(function () {
                    as.push($(this).text())
                })
                let sum=0;
                as.forEach(function (value) {

                    sum+=parseFloat(value);
                })
                $('#totalPrice').text(parseFloat(sum).toFixed(2))
            })


               /* $.ajax({
                    type:'post',
                    url:'/checkout/post',
                    data:{},
                })*/


        }
    </script>
    @endsection