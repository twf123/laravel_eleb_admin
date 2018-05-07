@extends('layout.default')
@section('title','添加角色')
@section('content')
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="container col-lg-9" style="background-color: #eceeee">
            <br/>
            <form  method="post" action="{{ route('role.store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label>角色名称</label>
                    <input type="text" class="form-control" placeholder="权限名" name="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label>显示角色名称</label>
                    <input type="text" class="form-control" placeholder="显示名" name="display_name" value="{{ old('display_name') }}">
                </div>

                <div class="form-group">
                    <label>角色描述</label>
                    <input type="text" class="form-control" placeholder="描述" name="description" value="{{ old('description') }}">
                </div>


                <div class="form-group">
                    @foreach($permissions as $permission)
                    <label class="checkbox-inline" >
                        <input type="checkbox" id="inlineCheckbox1" name="permission_id[]" value="{{ $permission->id }}">{{ $permission->name }}
                    </label>
                        @endforeach
                </div>

                <button type="submit" class="btn btn-primary btn-success"> 添加角色</button>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@stop