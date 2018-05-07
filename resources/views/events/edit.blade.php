@extends('layout.default')
@section('title', '修改活动')

@section('content')
    {{--action传参有两个--}}
    <form method="POST" action="{{ route('events.update',['event'=>$event]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        {{ method_field('PUT') }}
            <div class="form-group">
                <label for="name">活动标题：</label>
                <input type="text" name="title" class="form-control" value="{{ $event->title }}">
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



        <button type="submit" class="btn btn-primary">确认修改</button>
    </form>
@stop