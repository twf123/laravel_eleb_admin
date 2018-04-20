@extends('layout.default')
@section('title', '商家列表')

@section('content')

    <form class="navbar-form navbar-left" method="get">
        <div class="form-group">
            <input type="text" name="keywords" class="form-control" placeholder="搜索...">
        </div>
        <button type="submit" class="btn btn-default">查询店铺名</button>
    </form>
    <table class="table table-bordered table-responsive" id="member">
        <tr>
            <th>ID</th>
            <th>商家姓名</th>
            <th>店铺名</th>
            <th>商店LOGO</th>
            <th>审核状态</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr data-id="{{ $member->id }}">
                <td>{{$member->id}}</td>
                <td>{{$member->name}}</td>
                <td>{{$member->member_info->shop_name}}</td>
                <td><img src="@if($member->member_info->shop_img){{ $member->member_info->shop_img }}@endif" style="width: 50px" height="50px"></td>
                <td>{{$member->status==1?"通过":"未通过"}}</td>
                <td>
                    <a href="{{ route('member.show',['member'=>$member]) }}" class="btn btn-warning btn-sm">查看</a>
                    <button class="btn btn-danger btn-sm">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $members->appends(compact('keywords'))->links() }}
@stop
@section('js')
    <script>
        $("#member .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'member/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>
@stop