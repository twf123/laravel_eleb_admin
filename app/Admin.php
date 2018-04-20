<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //
    public $timestamps = false;//不用时间搓

    protected $fillable = [
        'name','password',
    ];
}
