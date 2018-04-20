<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member_info extends Model
{
    public $timestamps=false;
    //
    protected $fillable = [
        'shop_name','categories_id','shop_img','brand','shop_rating','on_time',
        'fengniao','bao','piao','zhun','start_send','send_cost','distance','estimate_time'
        ,'notice','discount',
    ];
}
