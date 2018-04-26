<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $timestamps = false;//不用时间搓

    protected $fillable = [
        'title','content','star_time','end_time',
    ];
}
