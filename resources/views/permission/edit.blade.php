@extends('layout.default')
@section('title','修改权限')
@section('content')
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="container col-lg-9" style="background-color: #eceeee">
            <br/>
            <form  method="post" action="{{ route('permission.update',['permission'=>$permission]) }}" enctype="multipart/form-data">

                <div class="form-group">
                    <label>权限名</label>
                    <input type="text" class="form-control" name="name" placeholder="权限名" value="{{ $permission->name }}">
                </div>


                <div class="form-group">
                    <label>显示名</label>
                    <input type="text" class="form-control" name="display_name" placeholder="权限名" value="{{ $permission->display_name }}">
                </div>


                <div class="form-group">
                    <label>描述</label>
                    <input type="text" class="form-control" name="description" placeholder="权限名" value="{{ $permission->description }}">
                </div>

                <button type="submit" class="btn btn-primary btn-success"> 确认修改</button>
                {{csrf_field()}}
                {{method_field('PUT')}}
            </form>
        </div>
    </div>
@stop
