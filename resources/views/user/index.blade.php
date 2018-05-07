@extends('layout.default')
@section('title', '会员列表')

@section('content')

    <form class="navbar-form navbar-left" method="get">
        <div class="form-group">
            <input type="text" name="keywords" class="form-control" placeholder="搜索...">
        </div>
        <button type="submit" class="btn btn-default">查询店铺名</button>
    </form>
    <table class="table table-bordered table-responsive" id="member">
        <tr>
            <th>ID</th>
            <th>会员姓名</th>
            <th>会员电话</th>
            <th>账号状态</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr data-id="{{ $user->id }}">
                <td>{{$user->id}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->tel}}</td>
                <td>
                    @if($user->is_status == 1)正常
                        @elseif($user->is_status != 1)封禁
                        @endif
                </td>
                <td>
                     @if($user->is_status == 1)
                        <a href="{{ route('user_fj',['user'=>$user])}}" class="btn btn-danger btn-sm">封禁账号</a>
                    @endif
                         @if($user->is_status == 0)
                             <a href="{{ route('user_jf',['user'=>$user]) }}" class="btn btn-danger btn-sm">解封账号</a>
                         @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->appends(compact('keywords'))->links() }}
@stop