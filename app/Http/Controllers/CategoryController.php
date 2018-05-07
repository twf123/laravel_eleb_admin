<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\App;
use OSS\Core\OssException;

class CategoryController extends Controller
{

    //权限
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]
        ]);
    }
    //添加商户分类
    public function create(){
        return view('category.create');
    }


    //保存商户分类
    public function store(Request $request)
    {
//        验证分类
        $this->validate($request,
            [
                'name'=>'required|',
                'logo'=>'required|',
            ],
            [
                'name.required'=>'用户名不能为空!',
                'logo.required'=>'图片不能为空!',

            ]);
        //保存商户
        Category::create(
            [
                'name'=>$request->name,
                'logo'=>'https://tanzong-eleb-shop.oss-cn-beijing.aliyuncs.com/'.$request->logo,
            ]
        );
        session()->flash('success', '添加成功');
        return redirect()->route('category.index');
    }

    //显示分类
    public function index(){
        $categorys =  Category::all();
        return view('category.index',compact('categorys'));
    }


    //修改商户分类
    public function edit(Category $category)
    {
        return view('category.edit',compact('category'));
    }


    //更新数据
    public function update(Request $request,ImageUploadHandler $handler,Category $category)
    {
        //验证用户
        $this->validate($request,
            [
                'name'=>'required|',
            ],
            [
                'name.required'=>'用户名不能为空!',
            ]);

//        保存分类
        $result  = $handler->save($request->logo,'category/logo',0);
        if($result){
            $fileName = url($result['path']);
        }else{
            $fileName = '';
        }
        $category->update(
            [
                'name'=>$request->name,
                'logo'=>'https://tanzong-eleb-shop.oss-cn-beijing.aliyuncs.com/'.$request->logo,
            ]
        );
        session()->flash('success', '修改成功~');
        return redirect()->route('category.index',compact('category'));
    }


    //删除分类
    public function destroy(Category $category)
    {
        $category->delete();
        echo 'success';
    }
}
