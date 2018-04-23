<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{


    //权限控制
//    public function __construct()
//    {
//        $this->middleware('auth',[
//            'except'=>['']
//        ]);
//    }



    //添加超级管理员
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
        return view('admin.edit',compact('admin'));

    }


    //保存密码
    public function update(Request $request ,Admin $admin){
        $this->validate($request,[
            'name'=>['required','min:2','max:10',Rule::unique('users')->ignore($admin->id)],
            'password'=>'required|min:3|max:16',
        ]);
        if (Auth::attempt(['name'=>$request->name,'password'=>$request->password])){
            $admin->update(['password'=>bcrypt($request->newpassword),'name'=>$request->name]);
            //保存成功,提示并跳转
            session()->flash('success','管理员信息修改成功!请重新登录');
            //清除登录信息,重新登录
            Auth::logout();
            return redirect()->route('login');
        }else{
            //保存失败,提示并跳转
            session()->flash('warning','原密码或新密码填写错误!');
            return back()->withInput();
        }
    }

}
