<?php
namespace app\admin\model;
use think\Model;

class Category extends Model{

	// 设置当前模型对应的完整数据表名称
    // protected $table = 'tp_category';

	//指定当前模型表的主键字段
	protected $pk = "cat_id";
}