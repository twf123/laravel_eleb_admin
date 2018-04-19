@extends('layout.default')
@section('title', '分类列表')

@section('content')

    {{--<form class="navbar-form navbar-left" method="get">--}}
        {{--<div class="form-group">--}}
            {{--<input type="text" name="name" class="form-control" placeholder="搜索...">--}}
        {{--</div>--}}
        {{--<button type="submit" class="btn btn-default">查询</button>--}}
    {{--</form>--}}
    <table class="table table-bordered table-responsive" id="category">
        <tr>
            <th>商家分类名</th>
            <th>商家分类图</th>
            <th>操作</th>
        </tr>
        @foreach($categorys as $category)
            <tr data-id="{{ $category->id }}">
                <td><p class="text-muted">{{$category->name}}</p></td>
                <td><img src="@if($category->logo){{ $category->logo }}@endif" style="width: 50px" height="50px" class="img-circle"></td>
                <td><a href="{{ route('category.edit',['category'=>$category]) }}" class="btn btn-warning btn-sm">编辑</a>
                    <button class="btn btn-danger btn-sm">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{--{{ $categorys->appends(['name'=>$name])->links() }}--}}
@stop
@section('js')
    <script>
        $("#category .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'category/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>
@stop