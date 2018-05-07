<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoresController extends Controller
{
    //查询店铺的销量排行
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]
        ]);
    }
    public function xl(Request $request){
            $count1 = DB::table('orders')->where('order_status','<>','-1')->count();
            $start = date('Y-m-01');
            $end = date('Y-m-t 23:59:59');
            $count2 = DB::table('orders')->where([
                ['order_status','<>','-1'],
                ['order_birth_tim','>=',$start],
                ['order_birth_tim','<=',$end],
                //['shop_id',$shop_id] //根据商家ID进行统计
            ])->count();
            $start = date('Y-m-d');
            $end = date('Y-m-d 23:59:59');
            $count3 = DB::table('orders')->where([
                ['order_status','<>','-1'],
                ['order_birth_tim','>=',$start],
                ['order_birth_tim','<=',$end]
            ])->count();
            $rows = DB::table('order_goods')
                ->join('orders','order_goods.order_id','=','orders.id')
                ->join('member_infos','member_infos.id','=','orders.shop_id')
                ->select('member_infos.shop_name','order_goods.goods_name',DB::raw('sum(order_goods.count) as counts'))
                ->groupBy('order_goods.goods_name','member_infos.shop_name')
                ->orderBy('counts','desc')
                //根据订单时间和商家id统计
                /*->where([
                    ['orders.created_at','>=',$start],
                    ['orders.created_at','<=',$end],
                    ['orders.shop_id',$shop_id]
                ])*/
                ->get();

            //dd($rows);
        $sum = 0;
            foreach ($rows as $row){
                $sum += $row->counts;
            }
        return view('stores.index',compact('rows','sum','count1','count2','count3'));
        }


}
