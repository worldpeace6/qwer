<?php
namespace Admin\Controller;
class BrandController extends BaseController{
	public function index(){
		$keywords = I('keywords');
		$map = [];
		if(!empty($keywords)){
			$map['brand_name'] = ['like',"%{$keywords}%"]; 
		}
		
		$totalRows = M('brand') ->where($map) -> count();  //总的记录数
		$listRows = 2;  //每页显示记录数
		
		//实例化分页
		$page = new \Think\Page($totalRows,$listRows);
		$this->assign('page',$page->show());
		
		$list = M('brand')->field('id,brand_name')->where($map) -> page(I('p',1),$listRows)->select();
		
		$this->assign('list',$list);
		$this->display();
	}
	public function add(){
		if(IS_POST){
			$validate = [
				['brand_name','require','品牌名称不能为空'],
				['brand_name','brand_name','品牌已存在',1,'unique'],
				['class_id','require','请选择商品分类'],
			];
		$M = M('brand');
		$res = $M -> validate($validate)->create();
		if($res===false){
			return $this->error($M->getError());
		}
		$add = $M -> add();
		if(empty($add)){
			return $this->error('添加失败');
		}
		    return $this->success('添加成功',U('index'));
		}
		
		$this->display();
	}
	public function edit(){
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
		if(IS_POST){
			$validate =[
				['brand_name','require','品牌名称不能为空'],
				['brand_name','brand_name','品牌已存在',1,'unique'],
			];
			
			$_POST['id'] = I('get.id');
			
			$res = M('brand')->validate($validate)->create();
			if($res === false){
				return $this->error(M('brand')->getError());
			}
			$row = M('brand')->where(['id'=>I('get.id')])->save();
			if(empty($row)){
				return $this->error('没有修改数据');
			}
				return $this->success('修改成功',U('index'));
		}
		
		
		//查出要修改的数据
		$brand = M('brand')->where(['id'=> I('get.id')])->find();
		$this->assign('brand',$brand);
		
		$this->display('add');
	}
	public function del(){
		if(empty(I('id'))){
			return $this->error('参数错误');
		}
		$isGoods = M('goods')->field('id')->where(['brand_id'=>I('id')])->find();
		if(!empty($isGoods)){
			return $this->error('请先把该品牌的商品删除，再执行该操作');
		}
		
		$row = M('brand')-> delete(I('get.id'));
		if(empty($row)){
			return $this -> error('删除失败');
		}
			return $this -> success('删除成功',U('index'));
	}
	
	
	
	
}