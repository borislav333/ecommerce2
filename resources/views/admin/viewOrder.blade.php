@extends('admin.orders')
@section('display')
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-3 col-sm-push-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            Client information
        </div>
        <div class="panel-body" >
            <div class="text-center">
                <div>
                    <b>Name: </b> <span>{{$order->first_name}} {{$order->last_name}}</span>
                </div>
                <hr style="margin-top:3px;margin-bottom:3px;">
                <div>
                    <b>Address option: </b> <span>{{($order->address_options===1) ? 'Office of Econt' : 'Personal address'}}</span>
                </div>
                <hr style="margin-top:3px;margin-bottom:3px;">
                <div>
                    <b>Address: </b> <span>{{$order->address}}</span>
                </div>
                <hr style="margin-top:3px;margin-bottom:3px;">
                <div>
                    <b>City: </b> <span>{{$order->city}}</span>
                </div>
                <hr style="margin-top:3px;margin-bottom:3px;">
                <div>
                    <b>State: </b> <span>{{$order->state}}</span>
                </div>
                <hr style="margin-top:3px;margin-bottom:3px;">
                <div>
                    <b>Phone number: </b> <span>{{$order->phone_number}}</span>
                </div>
                <hr style="margin-top:3px;margin-bottom:3px;">
                <div>
                    <b>Email: </b> <span>{{($order->email_address) ?? 'None'}}</span>
                </div>
            </div>
        </div>
        <div class="panel-heading">
            Ordered products
        </div>
        <div class="panel-body ">
            @foreach($order->products()->get() as $item)
                @if($loop->iteration!==1)
                    <div class="form-group"><hr /></div>
                @endif
                <div class="form-group ">
                    <div class="col-sm-3 col-xs-3">
                        <img class="img-responsive" src="{{asset('images/head_img/'.$item->head_image)}}" />
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <div class="col-xs-12"><strong>{{$item->name}}</strong></div>
                        <div class="col-xs-12"><small>Quantity:<span>{{$item->productsQuantity}}</span></small></div>
                    </div>
                    <div class="col-sm-3 col-xs-3 text-right">
                        <h6><span>$</span>{{$item->pivot->product_price}}</h6>
                    </div>
                </div>

            @endforeach

            <div class="form-group"><hr /></div>
            <div class="form-group">
                <div class="col-xs-12">
                    <strong>Subtotal</strong>
                    <div class="pull-right"><span></span><span>CLIENT PAY</span></div>
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
                    <div class="pull-right"><strong>$</strong><strong>{{number_format($order->totalPrice,2)}}</strong></div>
                </div>
            </div>
        </div>
        <div class="panel-heading">
        </div>
        <div class="panel-body text-center">
            <form method="post" action="{{route('dispatchOrder')}}">
                @csrf
                @if($order->dispatched==0)
                    <input name="order" value="{{$order->id}}" type="hidden">
                    <input name="dispatch" value="1" type="hidden">
                    <td><button class="btn btn-primary" >Dispatch</button>
                        @else
                            <input name="order" value="{{$order->id}}" type="hidden">
                            <input name="dispatch" value="0" type="hidden">
                    <td><button class="btn btn-dark">Dispatched</button></td>
                @endif
            </form>
        </div>
    </div>
    </div>
    @endsection