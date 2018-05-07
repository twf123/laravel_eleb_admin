<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;


class Admin extends \Illuminate\Foundation\Auth\User
{
    use LaratrustUserTrait;
    public $timestamps = false;//不用时间搓

    protected $fillable = [
        'name','password',
    ];
}
