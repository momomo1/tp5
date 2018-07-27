<?php
namespace app\admin\model;
use think\Model;

class Category extends Model{
	// 设置当前模型对应的完整数据表名称
    // protected $table = 'tp_category';

	//指定当前模型表的主键字段
	protected $pk = "cat_id";
	//时间戳自动维护
	protected $autoWriteTimestamp = true;
	//当时间字段不为create_time和update_time，通过以下属性指定
	protected $createTime = "create_time";
	//protected $updateTime = "create_at";


	public function getSonsCat($data,$pid=0,$live=0){
		//静态数组,后面递归调用的时候只会初始化一次
		static $result = [];
		foreach($data as $v){
			//第一次循环一定先找到pid=0的顶级
			// dump($v) ;
			if($v['pid'] == $pid){
				//加一个层级关系
				$v['live'] = $live;
				//存放在$result
				$result[] = $v; 
				//递归调用找子孙分类
				$this->getSonsCat($data,$v['cat_id'],$live+1);
			}
		}
		//返回递归处理好的数据
		return $result;
	}
}