<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    //添加角色
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]
        ]);
    }
    public function create(){
        //查看所有的权限
         $permissions = Permission::all();
        return view('role.create',compact('permissions'));
    }


    //角色权限
    public function store(Request $request){
        $admin=new Role();
        $admin->name         = $request->name;
        $admin->display_name = $request->display_name; // optional
        $admin->description  = $request->description; // optional
        $admin->save();

        //分配权限
        $admin->attachPermissions($request->permission_id);

        session()->flash('success', '添加成功');
        return redirect()->route('role.index');
    }


    //角色权限
    public function index(Request $request)
    {

//检查是否有keywords参数,有,需要搜索,没有 不需要搜索
        $keywords = $request->keywords;
        if ($keywords) {
            $roles = Role::where("name","{$keywords}")->paginate(3);
        } else {
            $roles = Role::paginate(3);
        }
        return view('role.index', compact('roles', 'keywords'));
    }


    //修改角色

    public function edit(Role $role){
        $permissions = Permission::all();
        return view('role.edit',compact('role','permissions'));
    }


    //保存修改的角色
    public function update(Request $request,Role $role){

        $role->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description
        ]);
        $role->syncPermissions($request->permission_id);
        session()->flash('success', '修改成功~');
        return redirect()->route('role.index');
    }



    //删除角色
    public function destroy(Role $role)
    {
        $role->syncPermissions([]);
        $role->delete();
        echo 'success';
    }
}
