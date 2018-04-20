@extends('layout.default')
@section('title','添加商家分类')
@section('content')
    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">商家分类名：</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="name">商家分类图片：</label>
            <input type="file" name="logo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">添加</button>
    </form>
    @stop