@extends('layout.default')
@section('title', '活动列表')

@section('content')

    <form class="navbar-form navbar-left" method="get">
    <div class="form-group">
    <input type="text" name="title" class="form-control" placeholder="搜索...">
    </div>
    <button type="submit" class="btn btn-default">查询</button>
    </form>
    <table class="table table-bordered table-responsive" id="permission">
        <tr>
            <th>权限名</th>
            <th>显示名</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach($permissions as $permission)
            <tr data-id="{{ $permission->id }}">
                <td>{{$permission->name}}</td>
                <td>{{$permission->display_name}}</td>
                <td>{{$permission->description}}</td>
                <td><a href="{{ route('permission.edit',['permission'=>$permission]) }}" class="btn btn-warning btn-sm">编辑</a>
                    <button class="btn btn-danger btn-sm">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $permissions->appends(compact('keywords'))->links() }}
@stop
@section('js')
    <script>
        $("#permission .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'permission/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>
@stop