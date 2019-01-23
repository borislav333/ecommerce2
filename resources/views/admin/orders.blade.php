@extends('admin.admin')
@section('display')
    <style>
        .filterable {
            margin-top: 15px;
        }
        .filterable .panel-heading .pull-right {
            margin-top: -20px;
        }
        .filterable .filters input[disabled] {
            background-color: transparent;
            border: none;
            cursor: auto;
            box-shadow: none;
            padding: 0;
            height: auto;
        }
        .filterable .filters input[disabled]::-webkit-input-placeholder {
            color: #333;
        }
        .filterable .filters input[disabled]::-moz-placeholder {
            color: #333;
        }
        .filterable .filters input[disabled]:-ms-input-placeholder {
            color: #333;
        }
    </style>
    <div class="container">

        <div class="row">
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">Orders</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="#" disabled></th>
                        <th><input type="text" class="form-control" placeholder="First Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Last Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Username" name="username" id="username" disabled></th>
                    </tr>
                    <tr >
                        <th><b>Id</b></th>
                        <th><b>First name</b></th>
                        <th><b>Last name</b></th>{{--
                        <th><b>Address option</b></th>
                        <th><b>Address</b></th>
                        <th><b>City</b></th>
                        <th><b>State</b></th>
                        <th><b>Phone Number</b></th>
                        <th><b>Last name</b></th>--}}
                        <th><b>Email</b></th>
                        <th><b>User</b></th>
                        <th><b>Date</b></th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->first_name}}</td>
                            <td>{{$order->last_name}}</td>
                            <td>{{($order->email) ?? 'None'}}</td>
                            <td>{{($order->user_id) ?? 'Guest'}}</td>
                            <td><b>{{$order->created_at}}</b></td>
                            <form action="{{route('viewOrder',['orderId'=>$order->id])}}">
                                <td><button class="btn btn-primary">View</button></td>
                            </form>

                            <form method="post" action="{{route('dispatchOrder')}}">
                                @csrf
                                @if($order->dispatched==0)
                                    <input name="order" value="{{$order->id}}" type="hidden">
                                    <input name="dispatch" value="1" type="hidden">
                                    <td><button class="btn btn-primary" >Dispatch</button>
                                @else
                                            <input name="order" value="{{$order->id}}" type="hidden">
                                            <input name="dispatch" value="0" type="hidden">
                                    <td><button class="btn btn-dark">Dispatched</button></td>
                                @endif
                            </form>
                        </tr>
                        @endforeach

                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td><button class="btn btn-primary">View</button></td>
                        <td><button class="btn btn-primary">Dispatch</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.filterable .btn-filter').click(function(){
                var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');
                if ($filters.prop('disabled') == true) {
                    $filters.prop('disabled', false);
                    $filters.first().focus();
                } else {
                    $filters.val('').prop('disabled', true);
                    $tbody.find('.no-result').remove();
                    $tbody.find('tr').show();
                }
            });

            /*$('.filterable .filters input').keyup(function(e){
                /!* Ignore tab key *!/
                var code = e.keyCode || e.which;
                if (code == '9') return;
                /!* Useful DOM data and selectors *!/
                var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
                /!* Dirtiest filter function ever ;) *!/
                var $filteredRows = $rows.filter(function(){
                    var value = $(this).find('td').eq(column).text().toLowerCase();
                    return value.indexOf(inputContent) === -1;
                });
                /!* Clean previous no-result if exist *!/
                $table.find('tbody .no-result').remove();
                /!* Show all rows, hide filtered ones (never do that outside of a demo ! xD) *!/
                $rows.show();
                $filteredRows.hide();
                /!* Prepend no-result row if all rows are filtered *!/
                if ($filteredRows.length === $rows.length) {
                    $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
                }
            });*/
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#username').keyup(function () {
                console.log($(this).val());
                $.ajax({
                    type:'get',
                    url:'/admin/orders/search/',
                    data:{'search':$(this).val()},
                    success:function (res) {
                        console.log(res)
                    },
                    error:function (err) {
                        console.log(err)
                    }

                })
            })
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        })
    </script>
    @endsection