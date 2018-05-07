@extends('layout.default')
@section('title', '修改奖品')

@section('content')
    {{--action传参有两个--}}
    <form method="POST" action="{{ route('event_prize.update',['event_prize'=>$event_prize]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="name">奖品名称：</label>
            <input type="text" name="prize_name" class="form-control" value="{{ $event_prize->prize_name }}">
        </div>



        <div class="form-group">
            <label>属于那个活动</label>
            <select class="form-control" name="events_id">
                <option value="">--选择分类--</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">奖品详情：</label>
            <input type="text" name="description" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">确认修改</button>
    </form>
@stop