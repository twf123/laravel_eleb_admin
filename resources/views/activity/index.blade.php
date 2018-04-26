@extends('layout.default')
@section('title', '活动列表')

@section('content')

    <form class="navbar-form navbar-left" method="get">
    <div class="form-group">
    <input type="text" name="title" class="form-control" placeholder="搜索...">
    </div>
    <button type="submit" class="btn btn-default">查询</button>
    </form>
    <table class="table table-bordered table-responsive" id="activity">
        <tr>
            <th>活动标题</th>
            <th>活动内容</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($activitys as $activity)
            <tr data-id="{{ $activity->id }}">
                <td>{{$activity->title}}</td>
                <td>{!! $activity->content !!}</td>
                <td>{{ date('Ymd',$activity->star_time)}}</td>
                <td>{{ date('Ymd',$activity->end_time) }}</td>
                <td><a href="{{ route('activity.edit',['activity'=>$activity]) }}" class="btn btn-warning btn-sm">编辑</a>
                    <button class="btn btn-danger btn-sm">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $activitys->appends(compact('keywords'))->links() }}
@stop