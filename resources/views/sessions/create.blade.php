@extends('layout.default')
@section('title','用户登录')
    @section('content')
        <form method="post" action="{{ route('login') }}">
            <div class="form-group">
                <label for="username">用户名</label>
                <input type="text" name="name" class="form-control" id="username" placeholder="用户名" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="密码">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="rememberMe" @if(old('rememberMe')) checked @endif> 记住我
                </label>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">验证码</label>
                <input id="captcha" class="form-control" name="captcha" >
                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-default">登录</button>
        </form>

    @stop

