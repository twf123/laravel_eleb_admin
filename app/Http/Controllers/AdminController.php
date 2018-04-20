<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //添加超级管理员
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['']
        ]);
    }
    public function create(){

    return view('admin.create');
    }

    //保存超级管理员
    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required|min:2|max:30',
                'password'=>'required|min:6|confirmed',
                'captcha'=>'required|captcha'
            ],
            [
                'name.required'=>'用户名不能为空!',
                'password.required'=>'密码不能为空!',
                'name.min'=>'用户名不能低于2位!',
                'password.min'=>'密码不能低于6位!',
                'password.confirmed'=>'前后两次密码输入不一致!',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请输入正确的验证码',

            ]);
        Admin::create(
            [
                'name'=>$request->name,
                'password'=>bcrypt($request->password),
            ]
        );
        session()->flash('success', '添加成功');
        return redirect()->route('member.index');
    }


    //修改密码
    public function edit(Admin $admin){
        return view('admin.edit');
    }

}
