<?php
namespace app\index\controller;

use think\Controller;
use think\View;
use think\Request;
use think\Db;
use app\index\models\Jotter as jotters;
class Jotter extends Controller{
	//展示
	public function index(){
		$data = DB::table('jotter')->paginate(3);
		//$this->assign('data',$data);
		return $this->fetch('index',['data'=>$data]);
	}
	//添加
	public function add(){
		return view();
	}
	public function insert(){
		$request = Request::instance();
		$data = $request->post();
		$file = request()->file('image');
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		$data['img'] = './uploads/'.$info->getSaveName();
		//var_dump($data);die;
		//实例化model
		$jotter = new jotters;
		$result = $jotter->insertData($data);
		if($result){
			$this->success('新增成功','Jotter/index');
		}else{
			$this->error('新增失败');
		}
	}
	//删除
	public function delete(){
		$request = Request::instance();
		$id = $request->get('id');
		$jotter = new jotters;
		$result = $jotter->deleteData($id);
		if($result){
			$this->success('删除成功','Jotter/index');
		}else{
			$this->error('删除失败');
		}
	}
	//修改页面
	public function updata(){
		$request = Request::instance();
		$id = $request->get('id');
		$jotter = new jotters;
		$result = $jotter->findData($id);
		return view('updata',['res'=>$result]);
	}
	//修改数据
	public function save(){
		$id = $_POST['id'];
		$request = Request::instance();
		$data = $request->post();
		$jotter = new jotters;
		$result = $jotter->updateData($data,$id);
		if($result){
			$this->success('修改成功','Jotter/index');
		}else{
			$this->error('修改失败');
		}
	}
}
?>