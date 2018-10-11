<?php
namespace app\index\models;
use think\Model;
use think\Db;
class Jotter extends Model{
	protected $table = 'jotter';
	//查询全部
	function show(){
		return Db::table($this->table)->select();
	}
	//查询单条
	function findData($id){
		return Db::table($this->table)->where('id','=',$id)->find();
	}
	//删除
	public function deleteData($id){
		// $user = User::get('$id');
		// return $user->delete();
		return Db::table($this->table)->where('id','=',$id)->delete();
	}
	//新增
	public function insertData($data){
		return Db::table($this->table)->insertGetId($data);
	}
	//修改
	function updateData($data,$id){
		return Db::table($this->table)->where('id','=',$id)->update($data);
	}
}

?>