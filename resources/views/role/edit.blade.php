@extends('layout.default')
@section('title','修改角色')
@section('content')
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="container col-lg-9" style="background-color: #eceeee">
            <br/>
            <form  method="post" action="{{ route('role.update',['role'=>$role]) }}" enctype="multipart/form-data">

                <div class="form-group">
                    <label>角色名</label>
                    <input type="text" class="form-control" name="name" placeholder="角色名" value="{{ $role->name }}">
                </div>


                <div class="form-group">
                    <label>显示角色名</label>
                    <input type="text" class="form-control" name="display_name" placeholder="显示角色" value="{{ $role->display_name }}">
                </div>


                <div class="form-group">
                    <label>描述角色名</label>
                    <input type="text" class="form-control" name="description" placeholder="角色描述" value="{{ $role->description }}">
                </div>


                <div class="form-group">
                    @foreach($permissions as $permission)
                        <label class="checkbox-inline" >
                            <input type="checkbox" id="inlineCheckbox1" {{ $role->hasPermission($permission->name)?'checked':'' }} name="permission_id[]" value="{{ $permission->id }}">{{ $permission->name }}
                        </label>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary btn-success"> 确认修改</button>
                {{csrf_field()}}
                {{method_field('PUT')}}
            </form>
        </div>
    </div>
@stop
