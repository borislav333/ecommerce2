@extends('admin.admin')
@section('display')
    <table class="table">
        <thead>
        <tr>
            <th>ID</th><th></th><th>Name</th><th>Quantity</th><th>Category</th><th></th><th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $prod)
            <tr>
            <th>{{$prod->id}}</th><th><img src="{{url('/images/head_img/'.$prod->head_image)}}" alt="" height="60"></th><th>{{$prod->name}}</th>
                <th>{{$prod->quantity}}</th><th>{{$prod->category->name}}</th><th><a href="" class="btn btn-primary">Edit</a></th><th><a
                        href="" class="btn btn-danger">Delete</a></th>
            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="text-center">
        {{$products->links()}}
    </div>
    @endsection