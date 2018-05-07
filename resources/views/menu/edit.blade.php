@extends('layout.default')
@section('title','添加导航栏')
@section('content')
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="container col-lg-9" style="background-color: #eceeee">
            <br/>
            <form  method="post" action="{{ route('menu.update',['menu'=>$menu]) }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label>菜单名称</label>
                    <input type="text" class="form-control" placeholder="菜单名称" name="name" value="{{ $menu->name }}">
                </div>


                <div class="form-group">
                    <label>上级菜单:</label>
                    <select class="form-control" name="parent_id">
                        <option value="">--选择上级分类--</option>
                        <option value="0">--顶级分类--</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>选择路由</label>
                    <input type="text" class="form-control" placeholder="路由" name="routing" value="{{ $menu->routing }}">
                </div>

                <div class="form-group">
                    <label>选择排序</label>
                    <input type="text" class="form-control" placeholder="排序" name="sorting" value="{{ $menu->sorting }}">
                </div>


                <button type="submit" class="btn btn-primary btn-success"> 确认修改</button>
                {{csrf_field()}}
                {{method_field('PUT')}}
            </form>
        </div>
    </div>
@stop