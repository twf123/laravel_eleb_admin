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
Route::resource('member','MemberController');
Route::get('member/{member}/status','MemberController@status')->name('status');


//管理员
Route::resource('admin','AdminController');

//登录
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');





//oss测试
Route::get('/oss', function()
{
    $client = App::make('aliyun-oss');
    $client->putObject("tanzong-eleb-shop", "1.txt", "傻逼");
    $result = $client->getObject("tanzong-eleb-shop", "1.txt");
    echo $result;
});