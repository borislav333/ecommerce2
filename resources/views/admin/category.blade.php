@extends('admin.orders')
@section('display')
    <div class="container">

        <div class="panel">
            <div class="panel-heading">
                <h4>Add a category</h4>
                <form action="{{route('createCategory')}}" method="post">
                    @csrf
                    <b>Name: </b><input type="text" name="name">
                    <b>Parent category:</b>
                    <select name="parent_id" id="">
                        <option value="">Choose option (none)</option>
                        @foreach($categories  as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
            <div class="panel-body">
                <h4 class="">All categories</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th><th>Name</th><th>Parent category</th><th>Last edit</th><th></th><th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <form action="{{route('editCategory',['categorySlug'=>$category->slug])}}" method="post">
                                    @method('patch')
                                    @csrf
                                <td>{{$category->id}}</td>
                                <td><input type="text" value="{{$category->name}}" class="w-25" name="name"></td>
                                <td>

                                    <select name="parent_id" id="">
                                        <option value="">Choose option (none)</option>
                                        @foreach($categories  as $cat)
                                        <option value="{{$cat->id}}"
                                        {{ ($category->parent && $category->parent->id===$cat->id) ? 'selected' : '' }}>{{$cat->name}}</option>
                                        @endforeach

                                    </select>

                                </td>
                                <td>{{$category->updated_at->diffForHumans()}}</td>

                                <td>

                                        <button class="btn btn-primary" type="submit">Change</button>


                                </td>
                                </form>
                                <td><form method="post"
                                          action="{{route('deleteCategory',['categorySlug'=>$category->slug])}}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger" onclick="confirm('Do you want to' +
                                                ' delete this product named {{$category->name}}?')">Delete</button></form></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                <div class="text-center">
                   {{-- {{$categories->links()}}--}}
                </div>

            </div>
        </div>
    </div>
    @endsection