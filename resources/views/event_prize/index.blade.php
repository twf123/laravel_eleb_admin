@extends('layout.default')
@section('title', '奖品管理')

@section('content')

    <form class="navbar-form navbar-left" method="get">
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="搜索...">
        </div>
        <button type="submit" class="btn btn-default">查询</button>
    </form>
    <table class="table table-bordered table-responsive" id="event_prize">
        <tr>
            <th>奖品名</th>
            <th>奖品详情</th>
            <th>操作</th>
        </tr>
        @foreach($event_prizes as $event_prize)
            <tr data-id="{{ $event_prize->id }}">
                <td>{{$event_prize->prize_name}}</td>
                <td>{!! $event_prize->description !!}</td>
                <td><a href="{{ route('event_prize.edit',['event_prize'=>$event_prize]) }}" class="btn btn-warning btn-sm">编辑</a>
                    <button class="btn btn-danger btn-sm">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $event_prizes->appends(compact('keywords'))->links() }}
@stop
@section('js')
    <script>
        $("#event_prize .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'event_prize/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>
@stop