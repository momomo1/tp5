<?php
namespace app\admin\validate;
use think\Validate;

class Article extends Validate{
	//定义验证规则
	protected $rule = [
		'title'   => "require|unique:article",
		'cat_id'  => "require",
	];

	//定义验证规则不通过的提示信息
	protected $message = [
		'title.require'   => "标题不能为空",
		'title.unique'    => "标题名重复",
		'cat_id.require'  => "必须选择一个所属文章分类"
	];

	//定义验证的场景
	protected $scene = [
		//场景名=>['规则name 的名称'=>'规则|规则2']
		//在add场景验证cat_name  和pid  的元素的所有的规则
		'add' => ['title','cat_id'],
		//在upd 场景验证只cat_name和require规则和验证pid 元素所有的规则
		'upd' => ['title','cat_id']
	];
}