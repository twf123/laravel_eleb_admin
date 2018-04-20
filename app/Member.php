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

}
