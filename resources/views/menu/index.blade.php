@extends('layout.default')
@section('title', '审核状态')

@section('content')

    <form class="navbar-form navbar-left" method="get">
        <div class="form-group">
            <input type="text" name="keywords" class="form-control" placeholder="搜索...">
        </div>
        <button type="submit" class="btn btn-default">查询</button>
    </form>
    <table class="table table-bordered table-responsive" id="menu">
        <tr>
            <th>菜单名</th>
            <th>路由</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr data-id="{{ $menu->id }}">
                <td>{{$menu->name}}</td>
                <td>{{ $menu->routing }}</td>
                <td>
                    <a href="{{ route('menu.edit',['menu'=>$menu]) }}" class="btn btn-primary btn-sm">修改</a>
                    <button class="btn btn-danger btn-sm">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $menus->appends(compact('keywords'))->links() }}
@stop
@section('js')
    <script>
        $("#menu .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'menu/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>
@stop