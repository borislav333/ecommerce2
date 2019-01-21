{{--{{session()->forget('cart')}}--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Electro - HTML Ecommerce Template</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/slick.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/slick-theme.css')}}"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/nouislider.min.css')}}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <![endif]-->

</head>
<body>
<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
            </ul>
            <ul class="header-links pull-right">

                <li><a href="#"><i class="fa fa-dollar"></i>USD</a></li>
                <li><a href="{{route('home')}}"><i class="fa fa-user-o"></i> My Account</a></li>
                <a href="{{route('adminIndex')}}" class="btn btn-danger ">ADMIN PANEL</a>
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <img src="{{asset('img/logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <select class="input-select">
                                <option value="0">All Categories</option>
                                <option value="1">Category 01</option>
                                <option value="1">Category 02</option>
                            </select>
                            <input class="input" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                <span>Your Wishlist</span>
                                <div class="qty">2</div>
                            </a>
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                @if((session()->get('cart') && session()->get('cart')->totalQuantity>0))
                                <div class="qty">{{session()->get('cart')->getTotalQuantity()}}</div>
                                    @endif
                            </a>
                            @if(session()->get('cart') && session()->get('cart')->totalQuantity>0)
                            <div class="cart-dropdown">

                                <div class="cart-list">


                                        @foreach(session()->get('cart')->items as $item)
                                        <div class="product-widget" style=";">
                                            {{--<div id="cart">
                                                <app-cart :item="{{json_encode($item)}}"></app-cart>--}}
                                                <div class="product-img" >
                                                    <img src="{{asset('images/head_img/'.$item['product']->head_image)}}" class="shop-cart-img" alt="" style="width: 60px;height: 60px">
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-name" ><a href="#" class="text-wrap product-name-alink" >{{$item['product']->name}}</a></h3>
                                                    <h4 class="product-price"><span class="qty">{{$item['productsQuantity']}}x</span>${{$item['product']->newprice}}</h4>
                                                </div>


                                            <form action="{{route('removeFromCart',['prodId'=>$item['product']->id])}}" method="post">
                                                @method('post')
                                                @csrf
                                                <button class="delete" type="submit"><i class="fa fa-close"></i></button>
                                            </form>

                                        </div>
                                        @endforeach

                                </div>
                                <div class="cart-summary">

                                    <small><b>{{session()->get('cart')->totalQuantity}}  {{str_plural('Item',session()->get('cart')->totalQuantity)}}</b>
                                         selected</small>
                                    <h5>SUBTOTAL: ${{session()->get('cart')->totalPrice}}</h5>

                                </div>

                                <div class="cart-btns">
                                    <a href="{{route('viewCart')}}">View Cart</a>
                                    <a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->
<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Hot Deals</a></li>
                <li><a href="#">Categories</a></li>
                <li><a href="#">Laptops</a></li>
                <li><a href="#">Smartphones</a></li>
                <li><a href="#">Cameras</a></li>
                <li><a href="#">Accessories</a></li>
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->

{!! (session()->has('wrongQuantity')) ?
html_entity_decode('<div class="alert alert-danger text-center" role="alert">
  '.session()->get('wrongQuantity').'
</div>')
:'' !!}