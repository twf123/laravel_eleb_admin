<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-book"></span></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="/">首页 <span class="sr-only">(current)</span></a></li>
                {{--<li><a href="{{ route('help') }}">帮助</a></li>--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">注册商家<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('member.create') }}">添加商家</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('member.index') }}">查看商家列表</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家分类<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('category.create') }}">添加商家分类</a></li>
                        <li><a href="{{ route('category.index') }}">查看商家分类</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">添加活动<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('activity.create') }}">添加活动</a></li>
                        <li><a href="{{ route('activity.index') }}">查看活动</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">抽奖管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('events.index') }}">显示所有的抽奖活动</a></li>
                        <li><a href="{{ route('events.create') }}">添加抽奖活动</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">奖品管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('event_prize.index') }}">查看所有的奖品</a></li>
                        <li><a href="{{ route('event_prize.create') }}">添加奖品</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">查看所有会员<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('user.index') }}">查看所有会员</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品销量<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('stores_xl') }}">查看销量</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">权限管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('permission.create') }}">添加权限</a></li>
                        <li><a href="{{route('permission.index') }}">查看权限</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">角色管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('role.create') }}">添加角色</a></li>
                        <li><a href="{{route('role.index') }}">查看角色</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">添加管理员<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.create') }}">添加管理员</a></li>
                        <li><a href="{{route('admin.index') }}">查看所有管理员</a></li>
                    </ul>
                </li>
                <ul class="nav navbar-nav">
                    {!! \App\Menu::getMenu() !!}
                    {{--@foreach(\App\Menu::getMenu() as $row)--}}
                        {{--<li class="dropdown">--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $row->name }} <span class="caret"></span></a>--}}
                            {{--<ul class="dropdown-menu">--}}
                                {{--@foreach($row->child as $val)--}}
                                    {{--@if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->can($val->routing))--}}
                                    {{--<li><a href="{{route($val->routing)}}">{{ $val->name }}</a></li>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--@endforeach--}}
                </ul>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{ route('login') }}">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ \Illuminate\Support\Facades\Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.edit',['admin'=>\Illuminate\Support\Facades\Auth::user()]) }}">修改密码</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form method="post" action="{{ route('logout') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-link">注销</button>
                            </form>

                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

