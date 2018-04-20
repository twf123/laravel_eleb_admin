<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $timestamps = false;//不用时间搓

    protected $fillable = [
        'name','logo',
    ];
}
