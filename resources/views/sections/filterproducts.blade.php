@extends('index')
@section('center')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">All Categories</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li class="active">Headphones (227,490 Results)</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section filter-section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Categories</h3>

                        @foreach(\App\Category::where('parent_id',null)->get() as $parent)
                            <div>

                        <div class="checkbox-filter">
                            <input type="radio" id="parent_cat" name="parent_cat" value="{{$parent->id}}" class="hidden">
                            <label for="category-{{$loop->iteration}}" class="parent-label">
                                <span></span>
                                {{$parent->name}}
                                <small>({{$parent->products->count()}})</small>
                            </label>

                        </div>
                                <div style="font-size: 13px;margin-left:30px;display: none;"  class="subcat-div">
                            @foreach($parent->children as $cat)
                                <div>
                                    <input type="radio" name="sub_cat" id="sub_cat" value="{{$cat->id}}" class="subcat-radio hidden" autocomplete="off">
                                    <span class="subcat_name">{{$cat->name}}</span>
                                </div>


                            @endforeach
                                </div>
                            </div>
                        @endforeach


                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Price</h3>
                    <div class="price-filter">
                        <div id="price-slider"></div>

                        <div class="input-number price-min">
                            <input id="price-min" type="number">
                            <span class="qty-up">+</span>
                            <span class="qty-down">-</span>
                        </div>
                        <span>-</span>
                        <div class="input-number price-max">
                            <input id="price-max" type="number">
                            <span class="qty-up">+</span>
                            <span class="qty-down">-</span>
                        </div>
                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Brand</h3>
                    <div class="checkbox-filter">
                        @foreach(\App\Brand::all() as $brand)
                                <div>
                                    <input type="checkbox" class="brands" value="{{$brand->id}}" name="brands[]">
                                    <label for="">
                                        <span id="brand_name">{{$brand->name}}</span>

                                        <small>({{$brand->products->count()}})</small>
                                    </label>
                                </div>


                            @endforeach


                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Top selling</h3>
                    <div class="product-widget">
                        <div class="product-img">
                            <img src="./img/product01.png" alt="" style="width:70px;">
                        </div>
                        <div class="product-body">
                            <p class="product-category">Category</p>
                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                            <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                        </div>
                    </div>

                    <div class="product-widget">
                        <div class="product-img">
                            <img src="./img/product02.png" alt="">
                        </div>
                        <div class="product-body">
                            <p class="product-category">Category</p>
                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                            <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                        </div>
                    </div>

                    <div class="product-widget">
                        <div class="product-img">
                            <img src="./img/product03.png" alt="">
                        </div>
                        <div class="product-body">
                            <p class="product-category">Category</p>
                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                            <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                        </div>
                    </div>
                </div>
                <!-- /aside Widget -->
            </div>
            <!-- /ASIDE -->

            <!-- STORE -->
            <div id="store" class="col-md-9">
                <!-- store top filter -->
                <div class="store-filter clearfix">
                    <div class="store-sort">
                        <label>
                            Sort By:
                            <select class="input-select">
                                <option value="0">Popular</option>
                                <option value="1">Position</option>
                            </select>
                        </label>

                        <label>
                            Show:
                            <select class="input-select">
                                <option value="0">20</option>
                                <option value="1">50</option>
                            </select>
                        </label>
                    </div>
                    <ul class="store-grid">
                        <li class="active"><i class="fa fa-th"></i></li>
                        <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                    </ul>
                </div>
                <!-- /store top filter -->

                <!-- store products -->
                <div class="row" id="ajaxFilteredProducts">
                    <!-- product -->
                    @foreach($products as $prod)
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
                                    <span style="color:white;margin-right: 6px;display: none;">Quantity:</span>
                                    <input type="hidden" min="1" max="{{$prod->quantity}}" value="1" name="addProdQuantity">
                                    <div style="height: 8px"></div>
                                    <button class="add-to-cart-btn" type="submit"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                </form>

                            </div>
                        </div>
                    @endforeach
                    <!-- /product -->


                </div>
                <!-- /store products -->

                <!-- store bottom filter -->
                <div class="store-filter clearfix">
                    <span class="store-qty">Showing 20-100 products</span>
                    <ul class="store-pagination">
                        <li class="active">1</li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
<script>
    function filterProducts() {
        let parentCat=null;
        let sub_cat=null;
        let price_min=$('#price-min').val();
        let price_max=$('#price-max').val();
        let brands=null;
        function ajaxFilter(){
            $.ajax({
                type:'post',
                url:'/filter',
                data:{parent_cat:parentCat,sub_cat:sub_cat,price_min:price_min,price_max:price_max,
                    brands:brands,_token:'{{csrf_token()}}'},
                dataType:'html',
                success:function (res) {
                    $('#ajaxFilteredProducts').html(res);
                },
                error:function (err) {
                    console.log(err)
                }
            })
        }
        $('.parent-label').each(function () {

            $(this).click(function () {

                $('.subcat-radio').prop('checked',false);
                sub_cat=null;
                let parentDiv=$(this).parent().parent();
                parentDiv.find('#parent_cat').prop('checked',true);
                $('.subcat-div').hide();
                parentDiv.find('.subcat-div').show();
                parentCat=parentDiv.find('#parent_cat').val();


               /* $('.subcat_name').click(function () {
                    console.log($(this).prev('#sub_cat'))
                    parentCat=null;
                    $(this).prev('#sub_cat').prop('checked',true);
                    parentDiv.find('#parent_cat').prop('checked',true);
                    sub_cat=parentDiv.find('#sub_cat:checked').val();
                    ajaxFilter()
                })*/
                ajaxFilter()
            })
        })
        $('.subcat_name').click(function () {
            console.log($(this).prev('#sub_cat'))
            parentCat=null;
            $(this).prev('#sub_cat').prop('checked',true);
            $(this).parent().parent().find('#parent_cat').prop('checked',true);
            sub_cat=$(this).parent().parent().find('#sub_cat:checked').val();
            ajaxFilter()
        })
        $('#price-min,#price-max').on('change keyup input',function () {
            price_min=$('#price-min').val();
            price_max=$('#price-max').val();

            ajaxFilter()
        })


        $('.brands').click(function () {
            brands=[];
            $('.brands:checkbox:checked').each(function () {
                brands.push(parseInt($(this).val()))

            });
            ajaxFilter()
        });

        $('.noUi-handle-lower,.noUi-handle-upper,#price-slider,.noUi-origin,.filter-section').on('click',function () {
            price_min=$('#price-min').val();
            price_max=$('#price-max').val();
            ajaxFilter()
        })

    }
    window.addEventListener("load", filterProducts, false);
</script>
    @endsection