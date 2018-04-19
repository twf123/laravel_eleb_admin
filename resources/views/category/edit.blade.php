@extends('layout.default')
@section('title', '修改分类')

@section('content')
    {{--action传参有两个--}}
    <form method="POST" action="{{ route('category.update',['category'=>$category]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="name">商品分类名：</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
        </div>

        {{--<div class="form-group">--}}
        {{--<label for="password">密码：</label>--}}
        {{--<input type="password" name="password" class="form-control" value="{{ old('password') }}">--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
        {{--<label for="password_confirmation">确认密码：</label>--}}
        {{--<input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">--}}
        {{--</div>--}}
        <div class="form-group">
            <label>原头像：</label>
            <img src="@if($category->logo){{ $category->logo }}@endif" class="img img-rounded" style="width: 50px">
        </div>

        <div class="form-group">
            <label>新头像上传:</label>
            <input type="file" name="logo">
        </div>
        <button type="submit" class="btn btn-primary">确认修改</button>
    </form>
@stop