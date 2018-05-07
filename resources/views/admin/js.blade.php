@extends('layout.default')
@section('title','修改超级管理员密码')
@section('content')
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="container col-lg-9" style="background-color: #eceeee">
            <br/>
            <form  method="post" action="{{ route('js_save',['admin'=>$admin]) }}" enctype="multipart/form-data">


                <div class="form-group">
                    @foreach($roles as $role)
                        <label class="checkbox-inline" >
                            <input type="checkbox" id="inlineCheckbox1"  name="role_id[]" value="{{ $role->id }}">{{ $role->name }}
                        </label>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary btn-success"> 确认修改</button>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@stop