@extends('layout.default')
@section('title', '角色管理')

@section('content')

    <form class="navbar-form navbar-left" method="get">
    <div class="form-group">
    <input type="text" name="title" class="form-control" placeholder="搜索...">
    </div>
    <button type="submit" class="btn btn-default">查询</button>
    </form>
    <table class="table table-bordered table-responsive" id="role">
        <tr>
            <th>角色名</th>
            <th>显示名</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr data-id="{{ $role->id }}">
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->description}}</td>
                <td><a href="{{ route('role.edit',['role'=>$role]) }}" class="btn btn-warning btn-sm">编辑</a>
                    <button class="btn btn-danger btn-sm">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $roles->appends(compact('keywords'))->links() }}
@stop
@section('js')
    <script>
        $("#role .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'role/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>
@stop