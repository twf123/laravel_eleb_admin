@extends('layout.default')
@section('title','添加奖品')
@section('content')
    <form method="POST" action="{{ route('event_prize.store') }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">奖品名称：</label>
            <input type="text" name="prize_name" class="form-control" value="{{ old('prize_name') }}">
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

        <button type="submit" class="btn btn-primary">添加</button>
    </form>
@stop
