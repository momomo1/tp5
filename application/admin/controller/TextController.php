<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\admin\model\Category;

class TextController extends Controller{

	public function index(Request $request){
		return $this->fetch();
	}



	public function index1($id=null){

		$name  = '你是是不是四十三比';
		$email = '153286042@qq.com';

		$user = [
			['username' => "叶儿子", 'age' => 22],
			['username' => "叶孩子", 'age' => 21],
			['username' => "叶狗子", 'age' => 20],
			['username' => "叶孙子", 'age' => 19],
			['username' => "小叶子", 'age' => 18],
		];

		return $this->fetch('',[
			"name"  => $name,
			"email" => $email,
			'user'  => $user,
		]);
	}


	public function index2(){
		// $request = request();			 第二种
		// $request = request::Instance();   第一种
		// dump($request->domain());//当前域名
		// dump($request->url());//当前URL地址
		// dump($request->controller()); //获取当前控制器
		// dump($request->action());//获取当前操作名称

		// dump(input('id'));
		// dump(input('get'));

		dump( input('username') );
		dump( input('password') );
		dump( input('ids/a') ); //接收数组参数/a
		dump( input('post.','','strtolower') );
	}

	public function index3(){
		dump( Db::table("tp_category")->select() );
	}

	public function index4(){
		$catModel = Model('Category');
		dump( $catModel->get(2) );
	}

	//新增
	public function index5(){
		//实例化模型
		$catModel = new category();
		$data = [
			['cat_name' => '语文','pid' => '1'],
			['cat_name' => '历史','pid' => '1'],
			['cat_name' => 'PHP','pid' => '1']
		];
		dump( $catModel->saveAll($data) );

	}

	//更新
	public function index6(){
		//实例化模型
		$catModel = new Category();

		$data = [
			'cat_name' => '全栈',
			'pid' => '1',
			'cat_id' => '6',
		];

		dump( $catModel->update($data) );
	}
}