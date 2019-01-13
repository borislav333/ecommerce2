@extends('admin.admin')
@section('display')

        <fieldset>

            <!-- Form Name -->
            <legend>Create new product</legend>

            <!-- Text input-->

            <!-- Text input-->
            @if(\Illuminate\Support\Facades\Session::has('addedProd'))
                <div class="alert alert-success" role="alert">
                    {{\Illuminate\Support\Facades\Session::get('addedProd')}}
                </div>
                @endif
            <form class="form-horizontal" method="post" action="{{route('addNewProduct')}}" enctype="multipart/form-data">
                @csrf
            <div class="form-group">

                <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>
                <div class="col-md-4">
                    <input id="name" name="name" placeholder="PRODUCT NAME" class="form-control input-md" required="" type="text" value="{{old('name')}}">

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
                            <option value="{{$category->id}}" class="">
                                {{($category->parent_id) ? $category->parent()->get()[0]->name.' \ ' : ''}}{{$category->name}}
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
                           class="form-control input-md" required="" type="number" step="0.01" value="{{old('price')}}">

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
                           class="form-control input-md" required="" type="number" value="{{old('quantity')}}">

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
                    <textarea class="form-control" name="descr" id="descr">{{old('descr')}}</textarea>
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
                           class="form-control input-md" required="" type="number" value="{{old('discount')}}">

                </div>

            </div>
                @if($errors->has('discount'))
                    <div class="alert alert-danger text-center" role="alert">
                        {{$errors->first('discount')}}
                    </div>
            @endif
                    <!-- File Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="filebutton">Head Image</label>
                        <div class="col-md-4">
                            <input id="filebutton" name="head_image" class="input-file" type="file">
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
                                <input type="file" name="productimg[]" class="productimg form-control">
                                {{--<div class="input-group-btn">
                                    <button class="removeimg btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                </div>--}}

                            </div>

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
                            <button id="addprod" name="singlebutton" class="btn btn-primary">Submit</button>
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
                    "                        <button class=\"removeimg btn btn-danger\" type=\"button\"><i class=\"glyphicon glyphicon-remove\"></i> Remove</button>\n" +
                    "                    </div>\n" +
                    "\n" +
                    "                </div>");

            });

            $(document).on('click', '.removeimg', function(){

                $(this).parent().parent().remove();
            })

            /*$('#addprod').click(function () {
                let dataobj={
                    name:$('#name').val(),
                    descr:$('#descr').val(),
                    price:$('#price').val(),
                    quantity:$('#quantity').val(),
                    category:$('#category').find(":selected").val(),
                }
                console.log(dataobj);

                $.ajax({
                    method:'POST',
                    url:'/createProduct/add',
                    data:dataobj,
                    success:(res)=>{
                        console.log(res)
                    },
                    error:(err)=>{
                        console.log(err)
                    }

                })
            })*/


        });

    </script>
    @endsection