<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //添加权限
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]
        ]);
    }
    public function create(){



     return view('permission.create');
    }


    //保存权限
    public function store(Request $request){
        Permission::create(
            [
                'name'=>$request->name,
                'display_name'=>$request->display_name,
                'description'=>$request->description
            ]
        );
        session()->flash('success', '添加成功');
        return redirect()->route('permission.create');
    }


    //显示权限
    public function index(Request $request)
    {

//检查是否有keywords参数,有,需要搜索,没有 不需要搜索
        $keywords = $request->keywords;
        if ($keywords) {
            $permissions = Permission::where("name","{$keywords}")->paginate(3);
        } else {
            $permissions = Permission::paginate(3);
        }
        return view('permission.index', compact('permissions', 'keywords'));
    }


    //修改权限

    public function edit(Permission $permission){
        return view('permission.edit',compact('permission'));
    }


    //保存修改的权限
    public function update(Request $request,Permission $permission){

        $permission->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description
        ]);





        session()->flash('success', '修改成功~');
        return redirect()->route('permission.index');
    }



        //删除权限
    public function destroy(Permission $permission)
    {
        $permission->delete();
        echo 'success';
    }

}
