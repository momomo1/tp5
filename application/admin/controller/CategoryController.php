<?php
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Article;
use think\Validate;

class CategoryController extends CommonController{
	//渲染视图
	public function index(){
		$catModel = new Category();
		$data = $catModel
			  ->field('t1.*,t2.cat_name as p_name')
			  ->alias('t1')
			  ->join('tp_category t2', 't1.pid=t2.cat_id', 'left')
			  ->select();

		//进行无限极分类处理 
		$cats = $catModel->getSonsCat($data);
		//输出模板视图
		return $this->fetch('',['cats'=>$cats]);

	}
	//添加
	public function add(){
		$catModel = new Category();

		//判断post参数
		if(request()->isPost()){
			$postData = input('post.');
			//使用单独的验证器进行验证
			//第一个参数:数据  第二个:验证器名或验证规则  第三个:提示信息留空就好 第四个:是否批量验证
			$result = $this->validate($postData,'Category.add',[],true);
			if($result !== true){
				//提示错误信息
				$this->error( implode(',', $result) );
			}

			//验证通过之后进行数据入库
			if($catModel->save($postData)){
				$this->success('入库成功',url('admin/category/index'));
			}else{
				$this->error('入库失败');
			}

		}

		//取出所有的分类,  分配到模板中
		$data = $catModel->select()->toArray();
		//对分类数据进递归处理(含有层级的缩进关系)
		$cats = $catModel->getSonsCat($data);

		return $this->fetch('',['cats'=>$cats]);
	}

	//更新
	public function upd(){
		$catModel = new Category();

		//判断是否是post 请求
		if(request()->isPost()){
			//接收参数
			$postData = input('post.');
			//验证数据
			$result = $this->validate($postData,"Category.upd",[],true);
			if($result !== true){
				$this-> error( implode(',',$result) );
			}

			if( $catModel->update($postData) ){
				$this->success('编辑成功',url('admin/category/index'));
			}else{
				$this->error('编辑失败');
			}
		}

		//接收参数cat_id ,取出当前分类的数据
		$cat_id = input('cat_id');
		$catData = $catModel->find($cat_id);

		$data = $catModel->select();
		//无限极分类处理
		$cats = $catModel->getSonsCat($data);

		return $this->fetch('',[
			'cats' => $cats,
			'catData' => $catData
		]);
	}

	//无刷新删除
	public function ajaxDel(){
		if(request()->isAjax()){
			//接收参数cat_id
			$cat_id = input('cat_id');
			//判断分类下面是否有子分类
			$where = [
				//'pid' => ['=',$cat_id]
				'pid' => $cat_id,
			];
			$result1 = Category::where($where)->find();
			if($result1){
				//说明有子分类
				$response = ['code'=>-1,'message'=>'分类下面有子分类,无法删除'];
				//等价于 echo json_encode($response);
				return json($response);die;
			}
			//判断分类下面是否有文章
			$result2 = Article::where(["cat_id"=>$cat_id])->find();
			if($result2){
				//说明有子分类
				$response = ['code'=>-2,'message'=>'分类下面有文章,无法删除'];
				return json($response);die;
			}

			//只要上面两个条件都满足之后才可删除分类
			if(Category::destroy($cat_id)){
				$response = ['code'=>200, 'message' => '删除成功'];
				return json($response);die;
			}else{
				$response = ['code'=>-3, 'message' => '删除失败'];
				return json($response);die;
			}
		}
	}
}
