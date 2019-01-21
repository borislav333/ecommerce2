@extends('index')
@section('center')
    {{--{{dd($cart->items[91]['product'])}}--}}

        <form action="/home" method="post">
            @csrf
            <div id="app">
                <example-component :cart="{{ json_encode($cart) }}"></example-component>
            </div>
        </form>


        <script src="{{asset('js/app.js')}}"></script>

    @endsection