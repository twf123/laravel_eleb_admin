@extends('layout.default')
@section('title',$member->name)

@section('content')
    <p style="color:#c8c8cf;font-size: 24px">店铺详情</p>
    <dl class="dl-horizontal col-xs-7">
        <dt>店铺名称</dt>
        <dd>{{$member->member_info->shop_name}}</dd>
        <dt>店铺图片</dt>
        <dd><img src="{{$member->member_info->shop_img}}" alt="未上传" width="200"></dd>
        {{--<dt>店铺所属分类</dt>--}}
        {{--@foreach($category as $item)--}}
            {{--<dd>{{$item->name}}</dd>--}}
        {{--@endforeach--}}
        <dt>店铺是否为品牌</dt>
        <dd>{{$member->member_info->brand==1?'是':'否'}}</dd>
        <dt>店铺是否准时达</dt>
        <dd>{{$member->member_info->on_time==1?'是':'否'}}</dd>
        <dt>店铺是否蜂鸟配送</dt>
        <dd>{{$member->member_info->humming==1?'是':'否'}}</dd>
        <dt>店铺是否晚到必赔</dt>
        <dd>{{$member->member_info->promise==1?'是':'否'}}</dd>
        <dt>店铺是否开具发票</dt>
        <dd>{{$member->member_info->invoice==1?'是':'否'}}</dd>
        <dt>起送价</dt>
        <dd>{{$member->member_info->start_send}}元</dd>
        <dt>配送费</dt>
        <dd>{{$member->member_info->send_cost}}元</dd>
        <dt>预约时间</dt>
        <dd>{{empty($member->member_info->estimate_time)?'未设置':$member->member_info->estimate_time}}</dd>
        <dt>店铺公告</dt>
        <dd>{{empty($member->member_info->notice)?'未设置':$member->member_info->notice}}</dd>
        <dt>店铺优惠</dt>
        <dd>{{empty($member->member_info->discount)?'未设置':$member->member_info->discount}}</dd>
        <dt>审核状态</dt>
        <dd>{{$member->status==0?'未通过':'通过'}}</dd>
        <dt></dt><dd></dd>
        <dt></dt>
        <dd><a href="{{route('member.edit',['member'=>$member])}}" class="btn btn-warning">修改店铺信息</a></dd>
        <dd><a href="{{route('status',['member'=>$member])}}" class="btn btn-danger">修改审核状态</a></dd>
    </dl>
    <img src="" alt="" class="col-xs-1">
@stop
