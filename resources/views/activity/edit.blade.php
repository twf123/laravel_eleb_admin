@extends('layout.default')
@section('title', '修改活动')

@section('content')
    {{--action传参有两个--}}
    <form method="POST" action="{{ route('activity.update',['activity'=>$activity]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="title">活动标题：</label>
            <input type="text" name="title" class="form-control" value="{{ $activity->title }}">
        </div>

        <div class="form-group">
            <label for="name">活动内容：</label>
            <div class="form-group">
    <textarea name="content" id="container">
        {{ old('content') }}
    </textarea>
                <!-- 配置文件 -->
                <script type="text/javascript" src="/utf8-php/ueditor.config.js"></script>
                <!-- 编辑器源码文件 -->
                <script type="text/javascript" src="/utf8-php/ueditor.all.js"></script>
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('container');
                </script>
            </div>
        </div>

        <div class="form-group">
            <label for="name">活动开始时间：</label>
            <input type="date" name="star_time" class="form-control">
        </div>

        <div class="form-group">
            <label for="name">活动结束时间：</label>
            <input type="date" name="end_time" class="form-control" >
        </div>>



        <button type="submit" class="btn btn-primary">确认修改</button>
    </form>
@stop