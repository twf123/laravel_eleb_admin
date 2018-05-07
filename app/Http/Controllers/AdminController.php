<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Permission;
use App\Role;
use App\User;
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
    public function create(Request $request){
        if (!Auth::user()->can('admins.create')){
            return 403;
        }
        $roles = Role::all();
    return view('admin.create',compact('roles'));
    }

    //保存超级管理员
    public function store(Request $request){
        if (!Auth::user()->can('admins.store')){
            return 403;
        }
        $this->validate($request,
            [
                'name'=>'required|min:2|max:30|unique:admins',
                'password'=>'required|min:6|confirmed',
                'captcha'=>'required|captcha'
            ],
            [
                'name.required'=>'用户名不能为空!',
                'name.unique'=>'用户名已存在',
                'password.required'=>'密码不能为空!',
                'name.min'=>'用户名不能低于2位!',
                'password.min'=>'密码不能低于6位!',
                'password.confirmed'=>'前后两次密码输入不一致!',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请输入正确的验证码',

            ]);
        $a = Admin::create(
            [
                'name'=>$request->name,
                'password'=>bcrypt($request->password),
            ]
        );
        $a->attachRoles($request->role_id);
        session()->flash('success', '添加成功');
        return redirect('admin');//->route('member.index');
    }


    //修改密码
    public function edit(Admin $admin){
        if (!Auth::user()->can('admins.edit')){
            return 403;
        }
        return view('admin.edit',compact('admin'));
    }

    //保存密码
    public function update(Request $request ,Admin $admin){
        if (!Auth::user()->can('admins.update')){
            return 403;
        }



        $this->validate($request,[
            'name'=>['required','min:2','max:10',Rule::unique('admins')->ignore($admin->id)],
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







    //修改角色
    public function js(Request $request, Admin $admin){

        if (!Auth::user()->can('admins.js')){
            return 403;
        }
    $roles = Role::all();
    return view('admin.js',compact('roles','admin'));
    }
  //保存修改的角色
    public function js_save(Request $request ,Admin $admin){

        if (!Auth::user()->can('admins.js_save')){
            return 403;
        }

        $admin->syncRoles($request->role_id);
        session()->flash('success', '修改成功~');
        return redirect()->route('admin.index');

    }







    //显示所有的管理员信息
     public function index(Request $request){
         if (!Auth::user()->can('admins.index')){
             return 403;
         }

         $keywords = $request->keywords;
         if ($keywords) {
             $admins = Admin::where("name","{$keywords}")->paginate(3);
         } else {
             $admins = Admin::paginate(3);
         }
         return view('admin.index', compact('admins', 'keywords'));
     }


    //删除管理员
    public function destroy(Admin $admin)
    {

        if (!Auth::user()->can('admins.destroy')){
            return 403;
        }

        $admin->syncRoles([]);
        $admin->delete();
        echo 'success';
    }
}
