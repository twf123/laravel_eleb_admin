<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class MailController extends Controller
{
    //发送邮件
    public function yj(){
        //查出所有的商户
        $shop = Member::all();
        dd($shop);



//        \Illuminate\Support\Facades\Mail::send(
//            'mail',//邮件视图模板
//            ['name'=>'张三'],
//            function ($message){
//                $message->to('252674363@qq.com')->subject('订单确认');
//            }
//        );







    }
}
