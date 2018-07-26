<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];

use think\Route;

//定义网站根目录路由
Route::get('/','admin/index/index');
//后台首页路由
Route::get('left','admin/index/left');
Route::get('top','admin/index/top');
Route::get('main','admin/index/main');

//登录界面路由
Route::get('login', 'admin/public/login');



//练习
Route::get('text','admin/text/index');
Route::get('text1/[:id]', 'admin/text/index1');
Route::any('text2', 'admin/text/index2');
Route::get('text3','admin/text/index3');
Route::any('text4','admin/text/index4');
Route::any('text5','admin/text/index5');
Route::any('text6','admin/text/index6');