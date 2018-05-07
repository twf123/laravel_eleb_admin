<?php

namespace App\Http\Controllers;

use App\Event_prize;
use App\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Event_prizeController extends Controller
{

    //权限
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]
        ]);
    }
    public function create(){


    $events = Events::all();


        return view('event_prize.create',compact('events'));
    }


    public function store(Request $request){


    Event_prize::create(
        [
            'events_id'=>$request->events_id,
            'prize_name'=>$request->prize_name,
            'description'=>$request->description,
            'member_id'=>0
        ]

    );

        session()->flash('success', '添加成功~');
        return redirect()->route('event_prize.create');

    }


    public function index(Request $request){
        $keywords = $request->keywords;
        if ($keywords) {
            $event_prizes = Event_prize::where("prize_name","{$keywords}")->paginate(3);
        } else {
            $event_prizes = Event_prize::paginate(3);
        }




        return view('event_prize.index',compact('event_prizes'));
    }


    //修改
    public function edit(Event_prize $event_prize){
        $events = Events::all();

     return view('event_prize.edit',compact('event_prize','events'));
    }

    //修改的保存
    public function update(Event_prize $event_prize){

        $event_prize->update([
           'events_id'=>$event_prize->events_id,
            'prize_name'=>$event_prize->prize_name,
            'description'=>$event_prize->description,



        ]);

        session()->flash('success', '修改成功~');
        return redirect()->route('event_prize.index');
    }



    public function destroy(Event_prize $event_prize)
    {
        $event_prize->delete();
        echo 'success';
    }

}
