@foreach($products as $prod)

    <!-- product -->
    <div class="product" style="">
        <div class="product-img text-center" >
            <img src="{{asset('images'.$prod->head_image)}}" alt="" height="200"  >
            <div class="product-label">
                @if($prod->discount>0)
                    <span class="sale">-{{$prod->discount}}%</span>
                @endif

                <span class="new">NEW</span>
            </div>
        </div>
        <div class="product-body">
            <p class="product-category">{{$prod->category()->get()[0]->name}}</p>
            <h3 class="product-name"><a href="#">{{$prod->name}}</a></h3>
            <h4 class="product-price">${{$prod->newprice}} <del class="product-old-price">${{$prod->price}}</del></h4>
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