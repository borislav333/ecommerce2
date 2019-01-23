@extends('index')
@section('center')

    <!------ Include the above in your HEAD tag ---------->

    <div class="container wrapper" id="checkout-container">
        <div class="row cart-head">
            <div class="container">
                <div class="row">
                    <p></p>
                </div>
                {{--<div class="row">
                    <div style="display: table; margin: auto;">
                        <span class="step step_complete"> <a href="#" class="check-bc">Cart</a> <span class="step_line step_complete"> </span> <span class="step_line backline"> </span> </span>
                        <span class="step step_complete"> <a href="#" class="check-bc">Checkout</a> <span class="step_line "> </span> <span class="step_line step_complete"> </span> </span>
                        <span class="step_thankyou check-bc step_complete">Thank you</span>
                    </div>
                </div>--}}
                <div class="row">
                    <p></p>
                </div>
            </div>
        </div>
        <div class="row cart-body">
            <div class="form-horizontal" {{--action="{{route('orderValidate')}}"--}}>

                @csrf
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Review Order <div class="pull-right"><small><a class="afix-1" href="{{route('viewCart')}}">Edit Cart</a></small></div>
                        </div>
                        <div class="panel-body">
                            @foreach($cart->items as $item)
                                @if($loop->iteration!==1)
                            <div class="form-group"><hr /></div>
                                @endif
                            <div class="form-group">
                                <div class="col-sm-3 col-xs-3">
                                    <img class="img-responsive" src="{{asset('images/head_img/'.$item['product']->head_image)}}" />
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="col-xs-12"><strong>{{$item['product']->name}}</strong></div>
                                    <div class="col-xs-12"><small>Quantity:<span>{{$item['productsQuantity']}}</span></small></div>
                                </div>
                                <div class="col-sm-3 col-xs-3 text-right">
                                    <h6><span>$</span>{{$item['productsPrice']}}</h6>
                                </div>
                            </div>

                            @endforeach

                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Subtotal</strong>
                                    <div class="pull-right"><span></span><span>YOU PAY</span></div>
                                </div>
                                <div class="col-xs-12">
                                    <small>Shipping</small>
                                    <div class="pull-right"><span>-</span></div>
                                </div>
                            </div>
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Order Total</strong>
                                    <div class="pull-right"><strong>$</strong><strong>{{number_format($cart->totalPrice,2)}}</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-heading">
                            Finish Order <div class="pull-right"></div>
                        </div>
                        <div class="panel-body text-center">
                            <button type="submit" class="btn btn-success" id="checkout"><strong>Place Order</strong></button>
                        </div>
                    </div>
                    <!--REVIEW ORDER END-->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading ">Address</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Shipping Address</h4>
                                </div>
                            </div>
                            {{--<div class="form-group">
                                <div class="col-md-12"><strong>Country:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="country" value="" />
                                </div>
                            </div>--}}
                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>First Name:</strong>
                                    <input type="text" name="first_name" id="first_name" class="form-control" value="" />
                                </div>
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>Last Name:</strong>
                                    <input type="text" name="last_name" id="last_name" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 col-xs-12">
                                    <strong>Econt's shipping options:</strong>
                                    <select name="addressOptions" id="addressOptions" class="form-control">
                                        <option value="1" class="">Office of Econt</option>
                                        <option value="2" class="">My personal address</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong class="address-label">Office of Econt - name or address:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address" class="form-control" value="" id="address"
                                    placeholder="Example: street Car Simeon Veliki 34 ,st. 3, ap."/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>City:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="city" class="form-control" value="" id="city"
                                    placeholder="Example: Sliven"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>State:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="state" class="form-control" value="" id="state"
                                    placeholder="Example: Stara Zagora"/>
                                </div>
                            </div>
                            {{--<div class="form-group">
                                <div class="col-md-12"><strong>Zip / Postal Code:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="zip_code" class="form-control" value="" />
                                </div>
                            </div>--}}
                            <div class="form-group">
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value=""
                                    placeholder="Example: +359 899999999" id="phone_number"/></div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12"><input type="email" name="email_address" class="form-control" value=""
                                    placeholder="For the order information." id="email_address"/></div>
                            </div>
                        </div>

                    </div>
                    <!--SHIPPING METHOD END-->

                </div>

           </div>
        </div>
        <div class="row cart-footer">

        </div>

    </div>

    <script>
        window.onload=function(){
        $('#addressOptions').change(function () {
                if($(this).val()==1){
                    $('.address-label').text('Office of Econt - name or address:')
                }
                else if($(this).val()==2){
                    $('.address-label').text('Your full personal address:')
                }
            })
            $('#checkout').click(function () {
                let datas={
                    first_name:($('#first_name').val()).toString(),
                    last_name:($('#last_name').val()).toString(),
                    address_options:parseInt($('#addressOptions').val()),
                    address:($('#address').val()).toString(),
                    city:($('#city').val()).toString(),
                    state:($('#state').val()).toString(),
                    phone_number:($('#phone_number').val()).toString(),
                    email_address:($('#email_address').val()).toString(),
                    _token:'{{csrf_token()}}'
                }
                $.ajax({
                    type:'post',
                    url:'/checkout/process',
                    data:datas,
                    /*dataType:'JSON',*/
                    success:function (res) {
                        if(res.errors){
                            $('.alert-danger').remove();
                            if(res.errors.first_name){
                                $('#first_name').after('<div class="alert alert-danger mt-0 mb-0" role="alert">' +
                                    res.errors.first_name+'</div>')
                            }
                            if(res.errors.last_name){
                                $('#last_name').after('<div class="alert alert-danger mt-0 mb-0" role="alert">' +
                                    res.errors.last_name+'</div>')
                            }
                            if(res.errors.address_options){
                                $('#addressOptions').after('<div class="alert alert-danger mt-0 mb-0" role="alert">' +
                                    res.errors.address_options+'</div>')
                            }
                            if(res.errors.address){
                                $('#address').after('<div class="alert alert-danger mt-0 mb-0" role="alert">' +
                                    res.errors.address+'</div>')
                            }
                            if(res.errors.city){
                                $('#city').after('<div class="alert alert-danger mt-0 mb-0" role="alert">' +
                                    res.errors.city+'</div>')
                            }
                            if(res.errors.state){
                                $('#state').after('<div class="alert alert-danger mt-0 mb-0" role="alert">' +
                                    res.errors.state+'</div>')
                            }
                            if(res.errors.phone_number){
                                $('#phone_number').after('<div class="alert alert-danger mt-0 mb-0" role="alert">' +
                                    res.errors.phone_number+'</div>')
                            }
                            if(res.errors.email_address){
                                $('#email_address').after('<div class="alert alert-danger mt-0 mb-0" role="alert">' +
                                    res.errors.email_address+'</div>')
                            }
                        }
                        else{
                            console.log(res)
                            $('#checkout-container').empty();
                           $('#checkout-container').append('<div style="height: 20px;"></div>\n' +
                               '        <div class="alert alert-success alert-dismissible text-center">\n' +
                               '            <strong>Success!</strong> Your order was placed.Check your email for notification if is added and wait for phone call to confirm! Thanks!<br>\n' +
                               '            Return back to the home page - <a href="{{route('index')}}">Home page</a>\n' +
                               '        </div>')
                            $.ajax({
                                type:'post',
                                url:'/checkout/removeCart',
                                data:{_token:'{{csrf_token()}}'},
                                success:function (res) {
                                    console.log(res)
                                },
                                error:function (err) {
                                    console.log(err)
                                }
                            })
                        }
                    },
                    error:function (err) {
                        console.log(err)
                    }
                })
            })
        }
    </script>
    @endsection