@extends('layout.default')
@section('title','添加权限')
@section('content')
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="container col-lg-9" style="background-color: #eceeee">
            <br/>
            <form  method="post" action="{{ route('permission.store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label>权限名称</label>
                    <input type="text" class="form-control" placeholder="权限名" name="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label>显示名称</label>
                    <input type="text" class="form-control" placeholder="显示名" name="display_name" value="{{ old('display_name') }}">
                </div>

                <div class="form-group">
                    <label>描述</label>
                    <input type="text" class="form-control" placeholder="描述" name="description" value="{{ old('description') }}">
                </div>

                <button type="submit" class="btn btn-primary btn-success"> 添加权限</button>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@stop