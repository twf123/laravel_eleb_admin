@extends('layout.default')
@section('title','添加活动')
@section('content')
    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">活动标题：</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
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
            <label for="name">活动报名开始时间：</label>
            <input type="date" name="signup_start" class="form-control">
        </div>

        <div class="form-group">
            <label for="name">活动报名结束时间：</label>
            <input type="date" name="signup_end" class="form-control">
        </div>


        <div class="form-group">
            <label for="name">开奖时间：</label>
            <input type="date" name="prize_date" class="form-control">
        </div>


        <div class="form-group">
            <label for="name">报名人数限制：</label>
            <input type="text" name="signup_num" class="form-control" value="{{ old('signup_num') }}">
        </div>
        <button type="submit" class="btn btn-primary">添加</button>
    </form>
@stop
