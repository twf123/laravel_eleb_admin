<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class SessionsController extends Controller
{
    //登录

    public function create()
    {
        //如果用户已登录,则跳转至首页
        if(Auth::user()){
            return redirect('member.index');
        }
        //var_dump($user);exit;
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        //$rememberMe = $request->rememberMe;
        //var_dump($request->has('rememberMe'));exit;
        //验证
        $this->validate($request,
            [
                'name'=>'required',
                'password'=>'required',
                'captcha'=>'required|captcha'
            ],
            [
                'name.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请输入正确的验证码',
            ]
        );
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password],$request->has('rememberMe'))) {
            // 该用户存在于数据库，且邮箱和密码相符合
            //echo '认证通过';
            session()->flash('success','登录成功');
            return redirect()->route('member.index');
        }else{
            //echo '认证失败';
            session()->flash('danger','登录失败,用户名或密码不正确');
            return redirect()->back()->withInput();
        }
    }
    //注销
    public function destroy()
    {
        Auth::logout();
        session()->flash('success','注销成功');
        return redirect()->route('login');
    }
}
