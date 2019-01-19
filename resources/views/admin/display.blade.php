@extends('admin.admin')
@section('display')
    @if(\Illuminate\Support\Facades\Session::has('deletedProduct'))
        <div class="alert alert-success" role="alert">
            {{\Illuminate\Support\Facades\Session::get('deletedProduct')}}
        </div>
    @endif
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
                <th>{{$prod->quantity}}</th><th>{{$prod->category->name}}</th><th>
                    <a href="{{route('editProduct',['category'=>$prod->category->slug,'product'=>$prod->slug])}}"
                       class="btn btn-primary">Edit</a></th><th><form method="post"
                            action="{{route('deleteProduct',['productslug'=>$prod->slug])}}">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button></form></th>
            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="text-center">
        {{$products->links()}}
    </div>
    @endsection