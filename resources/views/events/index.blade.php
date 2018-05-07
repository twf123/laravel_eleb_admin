@extends('layout.default')
@section('title', '活动列表')

@section('content')

    <form class="navbar-form navbar-left" method="get">
    <div class="form-group">
    <input type="text" name="title" class="form-control" placeholder="搜索...">
    </div>
    <button type="submit" class="btn btn-default">查询</button>
    </form>
    <table class="table table-bordered table-responsive" id="events">
        <tr>
            <th>活动标题</th>
            <th>活动内容</th>
            <th>参加人数限制</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr data-id="{{ $event->id }}">
                <td>{{$event->title}}</td>
                <td>{!! $event->content !!}</td>
                <td>{{ $event->signup_num}}</td>
                <td>{{ $event->signup_start}}</td>
                <td>{{ $event->signup_end }}</td>
                <td><a href="{{ route('events.edit',['event'=>$event]) }}" class="btn btn-warning btn-sm">编辑</a>
              <a href="{{ route('events.show',['event'=>$event]) }}" class="btn btn-warning btn-sm">查看详情</a>
              <a href="{{ route('events.result',['event'=>$event]) }}" class="btn btn-warning btn-sm">中奖名单</a>
                    <button class="btn btn-danger btn-sm">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $events->appends(compact('keywords'))->links() }}
@stop
@section('js')
    <script>
        $("#events .btn-danger").click(function () {
            //确认删除 进入点击事件
//                console.log("ok");
            if(confirm('删除后不能恢复!')){
                var tr = $(this).closest('tr');
                var id=tr.data('id');
                $.ajax({
                    type:"DELETE",
                    url:'events/'+id,
                    data:'_token={{ csrf_token() }}',
                    success: function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        });
    </script>
@stop