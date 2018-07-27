<?php 
namespace app\admin\model;
use think\Model;

class User extends Model{

	public function checkUser($username, $password){
		$where = [
			'username' => $username,
			'password' => md5($password.config('password_salt')),
		];

		//$userInfo是一个数据对象
		$userInfo = $this->where($where)->find();
		if($userInfo){
			//用户信息存储到session中
			session('user_id', $userInfo['user_id']);
			session('username', $userInfo['username']);
			return true;
		}else{
			return false;
		}
	}
}