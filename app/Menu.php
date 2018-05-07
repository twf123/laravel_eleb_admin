<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    //




    protected $fillable = [
        'parent_id', 'name', 'routing','sorting',
    ];


    static public function getMenu()
    {
//        $menus = self::where('parent_id','0')->orderBy('sorting')->get();
//        foreach ($menus as $row){
//            $row->child = self::where('parent_id',$row->id)->orderBy('sorting')->get();
//        }
////        dd($menus);
//        return $menus;
        $html = '';
        $menus = self::where('parent_id',0)->get();
        foreach ($menus as $menu){
            $children_html = '';
            $children = self::where('parent_id',$menu->id)->get();
            foreach ($children as $child){
                if(Auth::user()->can($child->rote)) // route:user/add  permission:user.create
                    $children_html .= '<li><a href="'.route($child->rote).'">'.$child->name.'</a></li>';
            }
            //如果没有子菜单,当前菜单组隐藏
            if($children_html == ''){
                continue;
            }

            $html .= '<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$menu->name.' <span class="caret"></span></a>
                <ul class="dropdown-menu">';


            $html .= $children_html;
            $html .= '</ul> </li>';

        }
        return $html;

    }

}
