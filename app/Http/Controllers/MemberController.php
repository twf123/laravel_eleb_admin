<?php

namespace App\Http\Controllers;
use App\Handlers\ImageUploadHandler;
use App\Member;
use App\Member_info;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use OSS\Core\OssException;

class MemberController extends Controller
{
    //添加商户信息
//    public function __construct()
//    {
//        $this->middleware('auth',[
//            'except'=>[]
//        ]);
//    }
    public function create(){
        $cats  =  Category::all();
        return view('member.create',compact('cats'));
    }

    //保存商户信息
    public function store(Request $request,ImageUploadHandler $handler){
//        验证用户

      $this->validate($request,
            [
                'name'=>'required|min:2|max:30',
                'email'=>'required|email',
                'password'=>'required|min:6|confirmed',
                'captcha'=>'required|captcha'
            ],
            [
                'name.required'=>'用户名不能为空!',
                'email.required'=>'邮箱不能为空!',
                'password.required'=>'密码不能为空!',
                'name.min'=>'用户名不能低于2位!',
                'password.min'=>'密码不能低于6位!',
                'email.email'=>'邮箱填写不合法!',
                'email.unique'=>'该邮箱已存在!',
                'password.confirmed'=>'前后两次密码输入不一致!',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请输入正确的验证码',

            ]);

        //文件上传的保存
        //保存商品店主信息
        DB::transaction(function () use ($request) {

            $member_infos = Member_info::create(
                [
                    'shop_name'=>$request->shop_name,
                    'shop_img'=>'https://tanzong-eleb-shop.oss-cn-beijing.aliyuncs.com/'.$request->shop_img,
                    'brand'=>$request->brand,
                    'on_time'=>$request->on_time,
                    'fengniao'=>$request->fengniao,
                    'bao'=>$request->bao,
                    'piao'=>$request->piao,
                    'zhun'=>$request->zhun,
                    'start_send'=>$request->start_send,
                    'send_cost'=>$request->send_cost,
                    'notice'=>$request->notice,
                    'discount'=>$request->discount,
                    'distance'=>$request->distance,
                    'estimate_time'=>$request->estimate_time,
                    'categories_id'=>$request->categories_id
                ]
            );

            Member::create(
                [
                    'name'=>$request->name,
                    'password'=>bcrypt($request->password),
                    'status'=>'1',
                    'email'=>$request->email,
                    'shop_id'=>$member_infos->id,
                ]
            );
        });
        session()->flash('success', '注册成功~');
        return redirect()->route('member.create');
    }

    //查看所有商户的信息
    public function index(Request $request)
    {
        $members = Member::all();
//检查是否有keywords参数,有,需要搜索,没有 不需要搜索
        $keywords = $request->keywords;
        if ($keywords) {
            $members = Member::where("shop_name","{$keywords}")->paginate(3);
        } else {
            $members = Member::paginate(3);
        }
        return view('member.index', compact('members', 'keywords'));
    }

    //商户的详情页
    public function show(Member $member){

        return view('member.show',compact('member'));
    }

    //商户的修改
    public function edit(Member $member){
        $cats  =  Category::all();
        return view('member.edit',compact('member','cats'));
    }



    //删除商户
    public function destroy(Member $member)
    {
        $member->delete();
        echo 'success';
    }





    //保存商户的信息
    public function update(Request $request,ImageUploadHandler $handler,Member $member ,Member_info $member_info){
        $this->validate($request,
            [
                'name'=>'required|min:2|max:30',
                'email'=>'required|email',
                'captcha'=>'required|captcha'
            ],
            [
                'name.required'=>'用户名不能为空!',
                'email.required'=>'邮箱不能为空!',
                'name.min'=>'用户名不能低于2位!',
                'email.email'=>'邮箱填写不合法!',
                'email.unique'=>'该邮箱已存在!',
                'password.confirmed'=>'前后两次密码输入不一致!',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'请输入正确的验证码',

            ]);

        //文件上传的保存
        $result = $handler->save($request->shop_img,'shop',0);
        if ($result){
                    $fileName = $result['path'];
        }else{
            $fileName = '';
        }
        $client = App::make('aliyun-oss');
        try{
            $client->uploadFile('tanzong-eleb-shop','public'.$fileName,public_path($fileName));
        }catch (OssException $e){
            printf($e->getMessage() . "\n");
        }
        //保存商品店主信息
        DB::transaction(function () use ($request,$fileName ,$member_info ,$member) {

            $member_info->update(
                [
                    'shop_name'=>$request->shop_name,
                    'shop_img'=>'https://tanzong-eleb-shop.oss-cn-beijing.aliyuncs.com/public'.$fileName,
                    'brand'=>$request->brand,
                    'on_time'=>$request->on_time,
                    'fengniao'=>$request->fengniao,
                    'bao'=>$request->bao,
                    'piao'=>$request->piao,
                    'zhun'=>$request->zhun,
                    'start_send'=>$request->start_send,
                    'send_cost'=>$request->send_cost,
                    'notice'=>$request->notice,
                    'discount'=>$request->discount,
                    'distance'=>$request->distance,
                    'estimate_time'=>$request->estimate_time,
                    'categories_id'=>$request->categories_id
                ]
            );

            $member->update(
                [
                    'name'=>$request->name,
                    'status'=>'1',
                    'email'=>$request->email,


                ]
            );
        });
        session()->flash('success', '修改成功~');
        return redirect()->route('member.index');
    }



//修改商户的状态
    public function status(Member $member){
        if ($member->status == 1){
            $member->update(
                [
                    'status'=>'0'
                ]
            );
        }else{
            $member->update(
                [
                    'status'=>'1'
                ]
            );
        }
        session()->flash('success', '修改成功~');
        return redirect()->route('member.index');
    }
}
