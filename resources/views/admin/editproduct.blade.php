@extends('admin.admin')
@section('display')
    <fieldset>
        <!-- Form Name -->
        <legend>Edit product</legend>

        <!-- Text input-->

        <!-- Text input-->
        @if(\Illuminate\Support\Facades\Session::has('addedProd'))
            <div class="alert alert-success" role="alert">
                {{\Illuminate\Support\Facades\Session::get('addedProd')}}
            </div>
        @endif
        @if(\Illuminate\Support\Facades\Session::has('success-position'))
            <div class="alert alert-success" role="alert">
                {{\Illuminate\Support\Facades\Session::get('success-position')}}
            </div>
        @endif
        <form class="form-horizontal" method="post"  id="myform"
              action="{{route('updateProduct',['catSlug'=>$product->category->slug,'prodSlug'=>$product->slug])}}" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="form-group">

                <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>
                <div class="col-md-4">
                    <input id="name" name="name" placeholder="PRODUCT NAME" class="form-control input-md" required="" type="text" value="{{$product->name}}">

                </div>

            </div>
            @if($errors->has('name'))
                <div class="alert alert-danger text-center" role="alert">
                    {{$errors->first('name')}}
                </div>
            @endif
        <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label font-weight-bold" for="product_categorie">PRODUCT CATEGORY</label>
                <div class="col-md-4">

                    <select id="category" name="category_id" class="form-control">
                        @foreach($categories as $category)
                            {{$category->parent_id}}
                            <option value="{{$category->id}}" class="" {{($category->id===$product->category->id) ? 'selected' : ''}}>
                                {{($category->parent_id) ? $category->parent->name.' \ ' : ''}}{{$category->name}}
                            </option>
                        @endforeach

                    </select>
                </div>

            </div>
            @if($errors->has('category_id'))
                <div class="alert alert-danger text-center" role="alert">
                    {{$errors->first('category_id')}}
                </div>
            @endif
            <div class="form-group">
                <label class="col-md-4 control-label" for="price">PRICE</label>
                <div class="col-md-4">
                    <input id="price" name="price" placeholder="PRICE"
                           class="form-control input-md" required="" type="number" step="0.01" value="{{$product->price}}">

                </div>

            </div>
            @if($errors->has('price'))
                <div class="alert alert-danger text-center" role="alert">
                    {{$errors->first('price')}}
                </div>
            @endif
        <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="available_quantity">AVAILABLE QUANTITY</label>
                <div class="col-md-4">
                    <input id="quantity" name="quantity" placeholder="AVAILABLE QUANTITY"
                           class="form-control input-md" required="" type="number" value="{{$product->quantity}}">

                </div>

            </div>
            @if($errors->has('quantity'))
                <div class="alert alert-danger text-center" role="alert">
                    {{$errors->first('quantity')}}
                </div>
            @endif
            <div class="form-group">
                <label class="col-md-4 control-label" for="product_description">PRODUCT DESCRIPTION</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="descr" id="descr">{{$product->descr}}</textarea>
                </div>

            </div>
            @if($errors->has('descr'))
                <div class="alert alert-danger text-center" role="alert">
                    {{$errors->first('descr')}}
                </div>
            @endif
            <div class="form-group">
                <label class="col-md-4 control-label" for="percentage_discount">PERCENTAGE DISCOUNT</label>
                <div class="col-md-4">
                    <input id="percentage_discount" name="discount" placeholder="PERCENTAGE DISCOUNT"
                           class="form-control input-md" required="" type="number" value="{{$product->discount}}">

                </div>

            </div>
            @if($errors->has('discount'))
                <div class="alert alert-danger text-center" role="alert">
                    {{$errors->first('discount')}}
                </div>
            @endif
        <!-- File Button -->
            <div class="form-group">
                <div class="col-4 text-center">
                    <img src="{{url('/images/head_img/'.$product->head_image)}}" alt="" height="100">
                </div>
                <label class="col-md-4 control-label" for="filebutton">Head Image</label>

                <div class="col-md-4" >
                    <input id="filebutton" name="head_image" class="input-file" type="file" >
                </div>

            </div>
            @if($errors->has('head_image'))
                <div class="alert alert-danger text-center" role="alert">
                    {{$errors->first('head_image')}}
                </div>
        @endif

        <!-- File Button -->
            <div class="form-group" >
                <label class="col-md-4 control-label" for="filebutton">Other product images</label>

                <div class="addfile" style="width: 400px; margin:0 auto;" >
                    {{--<img src="{{($product->images()->get()->first() !== null) ?
                    url('/images/other_img/'.$product->images()->get()->first()->source) : ''}}" alt="" height="100">
                    <input type="file" name="productimg[]" class="productimg form-control">
                    <div class="input-group-btn">
                        <button class="removeimg2 btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                    <label for="">Position of image:</label>
                    <select name="position[]" id="">
                        @foreach($product->images()->get() as $image)
                            <option value="{{$loop->index}}">{{$loop->iteration}}</option>
                            @endforeach
                    </select>--}}
                </div>
                @foreach($product->images()->get() as $img)
                        <div class="addfile" style="width: 400px; margin:0 auto;" >
                            <img src="{{url('/images/other_img/'.$img->source)}}" alt="" height="100">
                            {{--<input type="file" name="productimgOld[]" class="productimg form-control">--}}
                            <div class="input-group-btn">

                                <button class="removeimg btn btn-danger" type="submit" name="removeimg"
                                   formaction="{{route('removeCurrentImage',['imgid'=>$img->id])}}">
                                    <i class="glyphicon glyphicon-remove"></i> Remove</button>
                            </div>-
                            <label for="">Position of image:</label>
                            <select name="position[]" id="select-img-{{$loop->index}}">
                                @foreach($product->images()->get() as $v)
                                    <option value="{{$loop->index}}" {{($img->position===$loop->index) ? 'selected' : ''}}>{{$loop->iteration}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary positionbtn" id="position-btn-{{$loop->iteration}}"
                                    >Save position</button>
                        </div>

                    @endforeach

                @if($errors->has('productimg.*'))
                    <div class="alert alert-danger text-center" role="alert">
                        {{$errors->first('productimg.*')}}

                    </div>
                @endif

                <button class="btn btn-success center-block" type="button" id="addimg"><i class="glyphicon glyphicon-plus"></i>Add</button>
            </div>



            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton">{{--Single Button--}}</label>
                <div class="col-md-4">
                    <button id="addprod" name="singlebutton" class="btn btn-primary">SAVE</button>
                </div>
            </div>
        </form>
        <div class="clone hide">

        </div>
    </fieldset>

    <script type="text/javascript">

        $(document).ready(function() {

            $("#addimg").click(function(){
                $(".addfile:last").append("" +
                    "<div class=\"addfile\" style=\"width: 400px; margin:0 auto;\">\n" +

                    "                    <input type=\"file\" name=\"productimg[]\" class=\"productimg form-control\">\n" +
                    "                    <div class=\"input-group-btn\">\n" +
                    "                        <button class=\"removeimg2 btn btn-danger\" type=\"button\"><i class=\"glyphicon glyphicon-remove\"></i> Remove</button>\n" +
                    "                    </div>\n" +
                    "                     </div>");

            });

            $(window).on('click', '.removeimg', function(){

                $(this).parent().parent().remove();
            })
            $(document).on('click', '.removeimg2', function(){

                $(this).parent().parent().remove();
            })
            /*$('#select-img-0').change(function() {
                console.log($(this).val())
            });
            let b=$("#select-img-0 option:selected").val();
            alert(b);*/
            let selectedImg=[];
            let currentElement=null;
            let url=null;
            @foreach($product->images()->get() as $img)
                currentElement=$("#select-img-{{$loop->index}} option:selected" ).val();
            $('#select-img-{{$loop->index}}').change(function() {
                currentElement = $(this).val();
                console.log(currentElement);
                $('#position-btn-{{$loop->iteration}}').attr('formaction', "/positionupdate/{{$img->id}}/" + currentElement);


            })

            @endforeach


        });

    </script>
@endsection
