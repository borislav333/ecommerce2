@extends('index')
@section('center')
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{asset('img/shop01.png')}}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Laptop<br>Collection</h3>
                        <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{asset('img/shop03.png')}}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Accessories<br>Collection</h3>
                        <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{asset('img/shop02.png')}}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Cameras<br>Collection</h3>
                        <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            {{--<li class="active" id="lilink"><a data-toggle="tab" id="alink" href="/?cat=laptops">Laptops</a></li>
                            <li><a data-toggle="tab" href="?category=laptops">Smartphones</a></li>
                            <li><a data-toggle="tab" href="{{url('/?aa=a')}}">Cameras</a></li>
                            <li><a data-toggle="tab" href="#tab1">Accessories</a></li>--}}

                            @foreach($p_categories as $p_category)
                                <li id="li-cat-{{$p_category->id}}"><a data-toggle="tab" href="" id="cat-{{$p_category->id}}">{{$p_category->name}}</a></li>
                                @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row text-center" id="prod-holder" >

                        <!-- tab -->

                        {{--<div id="tab1" class="tab-pane active">
                            <div class="" data-nav="#slick-nav-1" >--}}

                            @foreach($products as $prod)
                                @if($loop->iteration>4)
                                    @break;
                                    @endif
                                <!-- product -->
                                    <div class="product">
                                        <div class="product-img text-center" >
                                            <img src="{{asset('images/head_img/'.$prod->head_image)}}" alt="" height="200" >
                                            <div class="product-label">
                                                @if($prod->discount>0)
                                                    <span class="sale">-{{$prod->discount}}%</span>
                                                    @endif

                                                <span class="new">NEW</span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$prod->category->name}}</p>
                                            <h3 class="product-name " style="height: 40px;">
                                                <a href="{{route('getCurrentProduct',['category'=>$prod->category->slug,'product'=>$prod->slug])}}"
                                                class="product-name-alink " style="">
                                                    {{$prod->name}}
                                                </a>
                                            </h3>
                                            <h4 class="product-price">${{$prod->newprice}}
                                                @if($prod->discount>0)
                                                <del class="product-old-price">${{$prod->price}}</del></h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <form action="{{route('addToCart',['prodId'=>$prod->id])}}" method="post">
                                                @method('post')
                                                @csrf
                                                <span style="color:white;margin-right: 6px;">Quantity:</span>
                                                <input type="number" min="1" max="{{$prod->quantity}}" value="1" name="addProdQuantity">
                                                <div style="height: 8px"></div>
                                                <button class="add-to-cart-btn" type="submit"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                            </form>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        {{--</div>--}}
                        <!-- /tab -->
                    </div>
               {{-- </div>
            </div>--}}
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <ul class="hot-deal-countdown">
                        <li>
                            <div>
                                <h3>02</h3>
                                <span>Days</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>10</h3>
                                <span>Hours</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>34</h3>
                                <span>Mins</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>60</h3>
                                <span>Secs</span>
                            </div>
                        </li>
                    </ul>
                    <h2 class="text-uppercase">hot deal this week</h2>
                    <p>New Collection Up to 50% OFF</p>
                    <a class="primary-btn cta-btn" href="#">Shop now</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Top selling</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            @foreach(\App\Category::where('parent_id',null)->orderBy('name')->get() as $catt)
                                    <input type="hidden" value="{{$catt->id}}" id="topsell-catid">
                                    <li class=""><a data-toggle="tab" href="" class="topsell-cat">{{$catt->name}}</a></li>


                                @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs" >
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active" >
                            <div class="products-slick" data-nav="#slick-nav-2" id="topSellProdDiv">
                                <!-- product -->
                                @foreach(\App\Product::withCount('orders')->orderBy('orders_count','DESC')->take(10)->get() as $prod)
                                    <div class="product">
                                        <div class="product-img text-center" >
                                            <img src="{{asset('images/head_img/'.$prod->head_image)}}" alt="" height="200" >
                                            <div class="product-label">
                                                @if($prod->discount>0)
                                                    <span class="sale">-{{$prod->discount}}%</span>
                                                @endif

                                                <span class="new">NEW</span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$prod->category->name}}</p>
                                            <h3 class="product-name " style="height: 40px;">
                                                <a href="{{route('getCurrentProduct',['category'=>$prod->category->slug,'product'=>$prod->slug])}}"
                                                   class="product-name-alink " style="">
                                                    {{$prod->name}}
                                                </a>
                                            </h3>
                                            <h4 class="product-price">${{$prod->newprice}}
                                                @if($prod->discount>0)
                                                    <del class="product-old-price">${{$prod->price}}</del></h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart" >
                                            <form action="{{route('addToCart',['prodId'=>$prod->id])}}" method="post">
                                                @method('post')
                                                @csrf
                                                <span style="color:white;margin-right: 6px;">Quantity:</span>
                                                <input type="number" min="1" max="{{$prod->quantity}}" value="1" name="addProdQuantity">
                                                <div style="height: 8px"></div>
                                                <button class="add-to-cart-btn" type="submit"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                            </form>

                                        </div>
                                    </div>
                                    @endforeach

                                <!-- /product -->


                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">

    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
<script>
    function homeProductsBy() {
        @foreach(\App\Category::where('parent_id',null)->orderBy('name','DESC')->get() as $cat)
        $("#li-cat-{{$cat->id}}").on('click',function () {
            $.ajax({
                type:'GET',
                url:'/homeprod/{cat}',
                data:{cat:"{{$cat->id}}"},
                success:function (res) {
                    $('#prod-holder').html(res);
                    //console.log(res)
                },
                error:function (err) {
                    console.log(err)
                }
            })
        })
        @endforeach
        $('.topsell-cat').click(function () {

            let catid=$(this).parent().prev('#topsell-catid').val();
            console.log(catid);
            $.ajax({
                type:'GET',
                url:'/homeprodtopsell',
                data:{catid:catid},
                dataType:'html',
                success:function (res) {
                   $('#topSellProdDiv').html(res);

                },
                error:function (err) {
                    console.log(err)
                }
            })
        })

    }

    window.addEventListener("load", homeProductsBy, false);
</script>
@endsection