@extends('admin.admin')
@section('display')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        @csrf
        <fieldset>

            <!-- Form Name -->
            <legend>Create new product</legend>

            <!-- Text input-->

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>
                <div class="col-md-4">
                    <input id="product_name" name="name" placeholder="PRODUCT NAME" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label font-weight-bold" for="product_categorie">PRODUCT CATEGORY</label>
                <div class="col-md-4">

                    <select id="product_categorie" name="prod_category" class="form-control">
                        @foreach($categories as $category)
                            {{$category->parent_id}}
                            <option value="{{$category->id}}" class="">
                                {{($category->parent_id) ? $category->parent()->get()[0]->name.' \ ' : ''}}{{$category->name}}
                            </option>
                            @endforeach

                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="available_quantity">AVAILABLE QUANTITY</label>
                <div class="col-md-4">
                    <input id="available_quantity" name="quantity" placeholder="AVAILABLE QUANTITY" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="product_description">PRODUCT DESCRIPTION</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="body" name="descr"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="percentage_discount">PERCENTAGE DISCOUNT</label>
                <div class="col-md-4">
                    <input id="percentage_discount" name="percentage_discount" placeholder="PERCENTAGE DISCOUNT" class="form-control input-md" required="" type="text">

                </div>
            </div>

                    <!-- File Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="filebutton">Head Image</label>
                        <div class="col-md-4">
                            <input id="filebutton" name="headimg" class="input-file" type="file">
                        </div>
                    </div>
                    <!-- File Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="filebutton">Other product images</label>
                        <div class="col-md-4">
                            <input type="file" name="productimg[]" class="input-file">
                            {{--<input id="filebutton" name="filebutton" class="input-file" type="file">--}}
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="singlebutton">{{--Single Button--}}</label>
                        <div class="col-md-4">
                            <button id="singlebutton" name="singlebutton" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

        </fieldset>
    </form>
    @endsection