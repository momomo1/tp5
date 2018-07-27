<?php
namespace app\admin\controller;
//引入模型
use app\admin\model\Category;
use app\admin\model\Article;

class ArticleController extends CommonController{

	//文章回显
	public function index(){
		//获取所有的分类(无限极处理)
		$catModel = new Category();
		$artModel = new Article();
		$cats = $artModel
			  ->field('t1.*,t2.cat_name as p_name')
			  ->alias('t1')
			  ->join('tp_category t2', 't1.cat_id=t2.cat_id', 'left')
			  ->select();
		return $this->fetch('',['cats' => $cats]);
	}



	//添加文章
	public function add(){
		//获取所有的分类(无限极处理)
		$catModel = new Category();
		$artModel = new Article();

		//判断是否是post请求
		if(request()->isPost()){
			//接收post参数
			$postData = input('post.');
			//单独验证器验证一下
			$result = $this->validate($postData,'Article.add',[],true);
			if($result !== true){
				//提示错误信息
				$this->error( implode(',',$result) );
			}

			//判断是否有文件上传
			if($file = request()->file('img')){
				//定义上传文件的目录相对于入口文件
				$uploadDir = "./upload/";
				//定义文件上传的验证规则
				$condition = [
					'size' => 1024*1024*2,
					'ext'  => 'png,jpg,gif,jpeg'
				];

				//上传验证并进行上传文件
				$info = $file->validate($condition)->move($uploadDir);
				//判断是否上传成功
				if($info){
					//成功.获取上传的目录文件信息,用于存储在数据库中    $info->getSaveName是上长图片的地址
					$postData['ori_img'] = $info->getSaveName();
				}else{
				$this->error( $file->getError());
				}
			}

			//判断是否入库成功
			if($artModel->save($postData)){
				$this->success('入库成功',url('admin/article/index'));
			}else{
				$this->error('入库失败');
			}
		}

		$cats = $catModel->getSonsCat($catModel->select());
		return $this->fetch('', ['cats' => $cats]);
	}
}
