<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
use think\Validate;

class PublicController extends Controller{
	public function login(){
		//判断是不是post请求
		if(request()->isPost()){

			//接收参数
			$postData = input('post.');

			//验证数据是不是合发
			//1.验证规则
			$rule = [
				//表单name名称=>验证规则
				'username' => 'require|max:16',
				'password' => 'require',
				'captcha'  => 'require|captcha',
			];
			//2错误信息
			$msg = [
				"username.require" => '用户名必须要填写',
				"username.max"     => '用户名不能超过16位',
				"password.require" => '密码必须要填写',
				'captcha.require'  => '验证码必填',
				'captcha.captcha'  => '验证码错误',
			];
			//3实例化验证器对象,开始验证
			$validate = new Validate($rule,$msg);
			//4判断是否验证成功  加入batch就是验证所有规则
			$result = $validate->batch()->check($postData);
				// dump($validate->getError());
			//成功 true  失败 false
			if(!$result){
				//提示错误信息     implode 把数组元素组合为字符串：
				// dump($this);
				$this->error( implode(',',$validate->getError()) );
			}

			$userModel =new User();
			//调用模型的方法,检测用户名 和密码是否匹配
			$flag = $userModel->checkUser($postData['username'],$postData['password']);
			if($flag){
				//直接重定向到后台首页

				$this->redirect('admin/index/index');
			}else {
				$this->error('用户名或密码不正确');
			}

		}
		return $this->fetch();
	}

	public function logout(){
		//清除session
		session(null);
		$this->redirect('/login');
	}
}
