<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{{--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>--}}
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                Brand
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left" method="GET" role="search">
                <div class="form-group">
                    <input type="text" name="q" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route('index')}}" target="_blank">Visit Site</a></li>
                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Account
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">SETTINGS</li>
                        <li class=""><a href="#">Other Link</a></li>
                        <li class=""><a href="#">Other Link</a></li>
                        <li class=""><a href="#">Other Link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid main-container">
    <div class="col-md-2 sidebar">
        <ul class="nav nav-pills nav-stacked">
            <li class="{{ (\Illuminate\Support\Facades\Request::is('admin')) ? 'active' : '' }}">
                <a href="{{route('adminIndex')}}">Home</a>
            </li>
            <li class="{{ (\Illuminate\Support\Facades\Request::is('admin/categories')) ? 'active' : '' }}">
                <a href="{{route('categoryIndex')}}">Categories/subcategories</a>
            </li>
            <li class="{{ (\Illuminate\Support\Facades\Request::is('createProduct')) ? 'active' : '' }}">
                <a href="{{route('createProductView')}}">Create new product</a>
            </li>
            <li class="{{ (\Illuminate\Support\Facades\Request::is('admin/orders')) ? 'active' : '' }}">
                <a href="{{route('getOrders')}}">Orders <span style="background-color: red;border-radius: 5px;padding: 2px;color: white;">
                        {{(\App\Order::where('dispatched',0)->count())}}</span>
                </a>
            </li>
            <li class="">
                <a href="#">Link</a>
            </li>

        </ul>
    </div>
    <div class="col-md-10 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                Dashboard
            </div>
            {{--<div class="panel-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>--}}
            @yield('display')
        </div>
    </div>
    <footer class="pull-left footer">
        <p class="col-md-12">
        <hr class="divider">
        </p>
    </footer>
</div>
<script src="{{ asset('js/echo.js') }}"></script>

<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>
    let pusher = new Pusher('74741c4390df76a839af', {
        encrypted: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    let channel = pusher.subscribe('ordered');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\newOrderNotification', function(data) {
        // this is called when the event notification is received...
        console.log('qqqqqqqqqwwwwwwwwwwww')
    });
</script>