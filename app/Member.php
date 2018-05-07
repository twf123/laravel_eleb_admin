<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    public $timestamps=false;
    protected $fillable = [
        'name', 'email', 'password','status','shop_id'
    ];

    public function member_info(){
        return $this->belongsTo(Member_info::class,'shop_id');
    }

//    public function category(){
//        return $this->belongsTo(Member_info::class,'shop_id');
//    }
  public static function email($email,$name)
  {
      ////测试发送邮件
      \Illuminate\Support\Facades\Mail::send(
          'mail',//邮件视图模板
          ['name' => $name],
          function ($message)use($email)  {
              $message->to($email)->subject('订单确认');
          }

      );
      return '邮件发送成功';
  }

}
