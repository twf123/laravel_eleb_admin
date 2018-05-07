<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //查看所有会员
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]
        ]);
    }
    public function index(Request $request){
//        是否有keywords参数,有,需要搜索,没有 不需要搜索
        $keywords = $request->keywords;
        if ($keywords) {
            $users = User::where("username","{$keywords}")->paginate(3);
        } else {
            $users = User::paginate(10);
        }
        return view('user.index', compact('users', 'keywords'));
    }


    //封禁账号
    public function fj(User $user){


                $user->update([
            'is_status'=>0
        ]);
        session()->flash('success', '封禁成功~');
        return redirect()->route('user.index');
    }



    //解封账号
    public function jf(User $user){
        $user->update([
            'is_status'=>1
        ]);
        session()->flash('success', '解封成功~');
        return redirect()->route('user.index');



    }
}
