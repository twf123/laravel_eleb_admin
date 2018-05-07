<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//分类
Route::resource('category','CategoryController');

//商家注册
Route::resource('member','MemberController');// member.index
Route::get('member/{member}/status','MemberController@status')->name('status');


//管理员
Route::resource('admin','AdminController');

//登录
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');



//上传图片路由
Route::post('/upload','UploaderController@upload');

////活动路由
Route::resource('activity','ActivityController');


//会员管理
Route::resource('user','UserController');
//封禁账号
Route::get('fj/{user}','UserController@fj')->name('user_fj');
//解封账号
Route::get('jf/{user}','UserController@jf')->name('user_jf');




//店铺排名
Route::get('xl','StoresController@xl')->name('stores_xl');



//权限CRUD
Route::resource('permission','PermissionController');


//添加角色
Route::resource('role','RoleController');


//修改管理员角色
Route::get('js/{admin}' ,'AdminController@js')->name('js');
Route::post('js_save/{admin}' ,'AdminController@js_save')->name('js_save');


//导航栏
Route::resource('menu','MenuController');



//抽奖活动管理
Route::resource('events','EventsController');

//奖品管理
Route::resource('event_prize','Event_prizeController');

//抽奖
Route::get('give/{event}','EventsController@give')->name('give');

Route::get('events/{event}/result','EventsController@result')->name('events.result');















////测试发送邮件
//Route::get('/mail',function(){
//    \Illuminate\Support\Facades\Mail::send(
//        'mail',//邮件视图模板
//        ['name'=>'张三'],
//        function ($message){
//            $message->to('252674363@qq.com')->subject('订单确认');
//        }
//    );
//    return '邮件发送成功';
//});


//发送邮件
Route::get('/yj','MailController@yj')->name('yj');