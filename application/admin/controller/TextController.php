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

	//删除
	public function index7(){
		//实例化模型
		// $catModel = new Category()::get(1);
		// dump( $category->delete() );

		dump( Category::destroy('11,12') );
	}

	//查询
	public function index8(){
		$catModel = new Category();

		// dump($category = Category::get(5));
		// $category = $catModel->find();
		// dump(Category::all("1,2,3"));

		// $data = Category::select();
		// dump($data);

		//表达式查询条件
		// $data = $catModel->field("cat_id")
		// 				 ->order("cat_id desc")
		// 				 ->where("cat_id",">","1")
		// 				 ->select();

		// dump($data);
	}

	public function index9(){
		$catModel = new Category();

		//取出cat_name字段,根据pid进行分组,求总数
		// $data = $catModel->field("cat_name,pid,count('cat_id') count")->group('pid')->select()->toArray();

		// $data = $catModel->limit(2,2)->select()->toArray();

		$data = $catModel
				->field("t1.*,t2.cat_name as p_name")
				->alias('t1')
				->join("tp_category t2",'t1.pid = t2.cat_id','left')
				->select()
				->toArray();

		dump($data);
	}

	public function index10(){
		// $catModel = new Category;
		// echo '<br>'.$catModel->max('cat_id');
		// echo '<br>'.$catModel->avg('cat_id');
		// echo '<br>'.$catModel->sum('cat_id');

		echo md5("123456".config('password_salt'));die;
	}
}