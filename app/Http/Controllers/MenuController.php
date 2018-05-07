<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Permission;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]
        ]);
    }
    //添加导航栏
    public function create(){
      $permissions = Permission::all();
     $menus = Menu::all();
        return view('menu.create',compact('menus','permissions'));
    }
    //保存添加
    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required|min:2|max:30',
                'routing'=>'required',
            ],
            [
                'name.required'=>'菜单名不能为空!',
                'name.min'=>'菜单名不能低于2位!',
                'routing.required'=>'路由名不能为空!',


            ]);

                Menu::create(
            [
                'name'=>$request->name,
                'parent_id'=>$request->parent_id,
                'routing'=>$request->routing,
                'sorting'=>$request->sorting,
            ]
        );
        session()->flash('success', '添加成功');
        return redirect()->route('menu.index');

    }
    //显示nav
    public function index(Request $request){

        $keywords = $request->keywords;
        if ($keywords) {
            $menus = Menu::where("shop_name","{$keywords}")->paginate(3);
        } else {
            $menus = Menu::paginate(3);
        }
        return view('menu.index', compact('menus', 'keywords'));
    }

    public function edit(Menu $menu){

    $menus = Menu::all();
    return view('menu.edit',compact('menus','menu'));
    }


    public function update(Request $request,Menu $menu){
        $menu->update(
          [
              'name'=>$request->name,
              'parent_id'=>$request->parent_id,
              'routing'=>$request->routing,
              'sorting'=>$request->sorting,
          ]

        );



        session()->flash('success', '修改成功');
        return redirect()->route('menu.index');

    }




    //删除
    public function destroy(Menu $menu)
    {
        $menu->delete();
        echo 'success';
    }
}
