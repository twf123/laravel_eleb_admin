@extends('layout.default')
@section('title','查看菜品销量')
@section('content')
    <table class="table table-responsive">
        <tr>
            <th style="text-align: center" colspan="2">菜品销量</th>
        </tr>
        <tr><td colspan="2">
                <form action="" method="get">
                    <input type="date" name="star_time">
                    <input type="date" name="end_time">
                    <input type="submit" value="查询" class="btn btn-primary btn-sm">
                </form>
            </td>
        </tr>
        <tr>
            <th>菜品名</th>
            <th>销量</th>
            <th>商铺名</th>
        </tr>
        @foreach($rows as $row)
            <tr>
                <td>{{$row->goods_name}}</td>
                <td>{{$row->counts}}</td>
                <td>{{ $row->shop_name }}</td>
            </tr>
        @endforeach
        <tr>
            <td>总销量</td><td>{{$sum}}条</td>

        </tr>
        <tr>
            <td>月订单</td><td>{{$count1}}条</td>
        </tr>
        <tr>
            <td>日订单</td><td>{{$count2}}条</td>
        </tr>
    </table>

@stop
