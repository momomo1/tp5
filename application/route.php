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
Route::any('login', 'admin/public/login');
//退出路由
Route::get('logout', 'admin/public/logout');

Route::group('admin',function(){
	//分类新增
	Route::any('category/add', 'admin/category/add');
	//分类回显
	Route::get('category/index', 'admin/category/index');
	//分类更新
	Route::any('category/upd', 'admin/category/upd');
	//分类ajax无刷新删除
	Route::get('category/ajaxDel', 'admin/category/ajaxDel');


	//文章新增
	Route::any('article/add', 'admin/article/add');
	//文章回显
	Route::get('articele/index', 'admin/article/index');
});
  








//练习
Route::get('text','admin/text/index');
Route::get('text1/[:id]', 'admin/text/index1');
Route::any('text2', 'admin/text/index2');
Route::get('text3','admin/text/index3');
Route::any('text4','admin/text/index4');
Route::any('text5','admin/text/index5');
Route::any('text6','admin/text/index6');
Route::any('text7','admin/text/index7');
Route::any('text8','admin/text/index8');
Route::any('text9','admin/text/index9');
Route::any('text10','admin/text/index10');