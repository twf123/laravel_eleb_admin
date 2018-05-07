<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_prize extends Model
{
    //
    protected $fillable = [
        'events_id','prize_name','description','member_id'
    ];
    public function event(){
        return $this->belongsTo(Events::class,'events_id');
    }
}
