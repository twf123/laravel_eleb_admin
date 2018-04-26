<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass;

class ActivityController extends Controller
{
    //添加活动
    public function create(){
        return view('activity.create');
    }


    //保存活动
    public function store(Request $request){
        $this->validate($request,
            [
                'title'=>'required|min:5|max:10',
                'content'=>'required|',
                'star_time'=>'required|',
                'end_time'=>'required|',
            ],
            [
                'name.required'=>'用户名不能为空!',
                'content.required'=>'内容能为空!',
                'title.min'=>'标题不能低于5位!',
                'title.max'=>'标题不能大于10位!',
                'star_time.required'=>'开始时间不能为空',
                'end_time.required'=>'结束不能为空',
            ]);
        $star_time = time($request->star_time);
        $end_time = time($request->end_time);
        Activity::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'star_time'=>$star_time,
            'end_time'=>$end_time,
        ]);
        session()->flash('success', '添加成功');
        return redirect()->route('activity.create');
    }


    //修改活动
    public function edit(Activity $activity){
        return view('activity.edit',compact('activity'));
    }

    public function update(Request $request ,Activity $activity){
        $this->validate($request,
            [
                'title'=>'required|min:5|max:10',
                'content'=>'required|',
                'star_time'=>'required|',
                'end_time'=>'required|',
            ],
            [
                'name.required'=>'用户名不能为空!',
                'content.required'=>'内容能为空!',
                'title.min'=>'标题不能低于5位!',
                'title.max'=>'标题不能大于10位!',
                'star_time.required'=>'开始时间不能为空',
                'end_time.required'=>'结束不能为空',
            ]);
        $star_time = time($request->star_time);
        $end_time = time($request->end_time);
        $activity->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'star_time'=>$star_time,
            'end_time'=>$end_time,
        ]);
        session()->flash('success', '修改成功');
        return redirect()->route('activity.index');
    }



    //保存修改




    //显示活动
    public function index(Request $request){
//        $acs = Activity::all();
        $keywords = $request->keywords;
        if ($keywords) {
            $activitys = Activity::where("title","{$keywords}")->paginate(3);
        } else {
            $activitys = Activity::paginate(3);
        }
        return view('activity.index', compact('activitys', 'keywords'));
    }


    //删除活动
    public function destroy(Activity $activity)
    {
        $activity->delete();
        echo 'success';
    }

}
