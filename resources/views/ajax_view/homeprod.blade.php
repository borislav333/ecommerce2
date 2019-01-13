@foreach($products as $prod)
    @if($loop->iteration>4)
        @break;
    @endif
    <!-- product -->
    <div class="product" style="">
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
            <h3 class="product-name">
                <a href="{{route('getCurrentProduct',['category'=>$prod->category->slug,'product'=>$prod->slug])}}">
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
            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
        </div>
    </div>
@endforeach