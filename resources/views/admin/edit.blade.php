@extends('layout.default')
@section('title','修改超级管理员密码')
@section('content')
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="container col-lg-9" style="background-color: #eceeee">
            <br/>
            <form  method="post" action="{{ route('admin.update',['admin'=>\Illuminate\Support\Facades\Auth::user()]) }}" enctype="multipart/form-data">


                <div class="form-group">
                <label>旧密码</label>
                <input type="password" class="form-control" name="password" placeholder="密码">
                </div>
                <div class="form-group">
                <label>新密码</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="确认密码">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">验证码</label>
                    <input id="captcha" class="form-control" name="captcha" >
                    <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                </div>
                <button type="submit" class="btn btn-primary btn-success"> 修改商户</button>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@stop
