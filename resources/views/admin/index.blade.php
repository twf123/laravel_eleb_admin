@extends('layout.default')
@section('title', '管理员列表')

@section('content')

    <form class="navbar-form navbar-left" method="get">
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="搜索...">
        </div>
        <button type="submit" class="btn btn-default">查询</button>
    </form>
    <table class="table table-bordered table-responsive" id="admin">
        <tr>
            <th>管理员名</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr data-id="{{ $admin->id }}">
                <td>{{$admin->name}}</td>
                <td><a href="{{ route('admin.edit',['admin'=>$admin]) }}" class="btn btn-warning btn-sm">修改密码</a>
                <a href="{{ route('js',['admin'=>$admin]) }}" class="btn btn-warning btn-sm">修改角色</a>
                    <button class="btn btn-danger btn-sm">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $admins->appends(compact('keywords'))->links() }}
@stop
@section('js')
    <script>
        $("#admin .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'admin/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>
@stop