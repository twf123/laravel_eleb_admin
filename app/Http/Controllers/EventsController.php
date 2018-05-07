<?php

namespace App\Http\Controllers;

use App\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prophecy\Argument\Token\ExactValueToken;

class EventsController extends Controller
{

    //权限
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]
        ]);
    }
    //添加一个新的活动
    public function create(){
     return view('events.create');
    }


    public function store(Request $request){
//验证
        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'signup_start'=>'required|after:today',
                'signup_end'=>'required|after:signup_start',
                'prize_date'=>'required|after:signup_end',
            ],
            [
                'title.required'=>'活动标题不能为空!',
                'content.required'=>'活动内容不能为空!',
                'signup_start.required'=>'抽奖报名开始时间不能为空!',
                'signup_start.after'=>'抽奖报名开始时间必须从下一天开始',
                'signup_end.required'=>'抽奖报名结束时间不能为空!',
                'signup_end.after'=>'抽奖报名结束时间不能在抽奖报名开始时间之前!',
                'prize_date.after'=>'开奖时间时间不能在抽奖报名结束时间之前!',
            ]);
            Events::create([
               'title' =>$request->title,
                'content'=>$request->content,
                'signup_start'=>$request->signup_start,
                'signup_end'=>$request->signup_end,
                'prize_date'=>$request->prize_date,
                'signup_num'=>$request->signup_num
            ]);

        session()->flash('success', '添加成功');
        return redirect()->route('events.create');


    }




    //显示活动
    public function index(Request $request){
        $keywords = $request->keywords;
        if ($keywords) {
            $events = Events::where("title","{$keywords}")->paginate(3);
        } else {
            $events = Events::paginate(3);
        }
        return view('events.index',compact('events'));
    }




    //修改活动
     public function edit(Events $event){
        return view('events.edit',compact('event'));
     }


     //保存修改的活动
    public function update(Request $request ,Events $event){
        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'signup_start'=>'required|after:today',
                'signup_end'=>'required|after:signup_start',
                'prize_date'=>'required|after:signup_end',
            ],
            [
                'title.required'=>'活动标题不能为空!',
                'content.required'=>'活动内容不能为空!',
                'signup_start.required'=>'抽奖报名开始时间不能为空!',
                'signup_start.after'=>'抽奖报名开始时间必须从下一天开始',
                'signup_end.required'=>'抽奖报名结束时间不能为空!',
                'signup_end.after'=>'抽奖报名结束时间不能在抽奖报名开始时间之前!',
                'prize_date.after'=>'开奖时间时间不能在抽奖报名结束时间之前!',
            ]);
        $event->update([
            'title' =>$request->title,
            'content'=>$request->content,
            'signup_start'=>$request->signup_start,
            'signup_end'=>$request->signup_end,
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num
        ]);

        session()->flash('success', '修改成功');
        return redirect()->route('events.index');


    }


    public function destroy(Events $event)
    {
      $event->delete();
        echo 'success';
    }


    public function show(Events $event){
        $prizes=DB::table('event_prizes')->where('events_id',$event->id)->get();
//        dd($prizes);
        return view('events.show',compact('event','prizes'));
    }

    public function give(Events $event)
    {
//        dd($event->id);
//        return 11;
//        dd($event);
        //获取所有报名抽奖的人
        $member_ids=DB::table('event_members')
            ->where('events_id',$event->id)
            ->pluck('member_id');
        //获取活动奖品
        $prize_ids=DB::table('event_prizes')
            ->where('events_id',$event->id)
            ->pluck('id');
//        dd($prize_ids);
        //打乱抽奖人数
        $members=$member_ids->shuffle();
        //打乱活动奖品
        $prizes=$prize_ids->shuffle();
        //配对
        $res=[];
        foreach($members as $member_id){
            $prize_id=$prizes->pop();
            //奖品抽完
            if ($prize_id == null)break;
            $res[$prize_id]=$member_id;
        }
        //开启事务
        DB::transaction(function () use ($res,$event) {
            //保存数据库
            foreach ($res as $prize_id=>$member_id){
                DB::table('event_prizes')
                    ->where('id',$prize_id)
                    ->update(['member_id'=>$member_id]);
            }
            //修改活动状态
            $event->is_prize=1;
            $event->save();
        });

        //抽奖完成
        session()->flash('success','抽奖成功!');
        return redirect()->route('events.index');
    }
    //查看抽奖结果
    public function result(Events $event)
    {
        $results=DB::table('event_prizes')
            ->join('members','event_prizes.member_id','=','members.id')
            ->where('events_id',$event->id)
            ->get();
        return view('events.result',compact('results','event'));
    }
}
