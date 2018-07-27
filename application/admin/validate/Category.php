<?php 
namespace app\admin\validate;
use think\Validate;

class Category extends Validate{
	//定义验证规则
	protected $rule = [
		'cat_name' => "require|unique:category",
		'pid'      => "require",
	];

	//定义验证规则不通过的提示信息
	protected $message = [
		'cat_name.require' => "分类名称必填",
		'cat_name.unique'  => "分类名称重复",
		'pid.require'      => "必须选择一个分类"
	];

	//定义验证的场景
	protected $scene = [
		//场景名=>['规则name 的名称'=>'规则|规则2']
		//在add场景验证cat_name  和pid  的元素的所有的规则
		'add' => ['cat_name','pid'],
		//在upd 场景验证只cat_name和require规则和验证pid 元素所有的规则
		'upd' => ['cat_name','pid']
	];
}