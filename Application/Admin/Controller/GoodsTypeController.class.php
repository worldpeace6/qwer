<?php
namespace Admin\Controller;
class GoodsTypeController extends BaseController{
	public function index(){
		$keywords = I('keywords');
		$map = [];
		if(!empty(I('keywords'))){
			$map['type_name'] = ['like',"%{$keywords}%"];
		}
		$count = M('goods_type')->where($map)->count();
		$showpage = 2;
		$page = new \Think\Page($count,$showpage);
		$this->assign('page',$page->show());
		
		
		//查询数据
		$list = M('goods_type')->order('id asc')->where($map)->page(I('p',1),$showpage)->select();
		$this -> assign('list',$list);
		
		$this->display();
	}
	public function add(){
		if(IS_POST){
			$validate = [
				['type_name','require','规格名称不能为空'],
				['type_name','type_name','规格名称已存在',1,'unique'],
			];
			$res = M('goods_type')->validate($validate)->create();
			if(empty($res)){
				return $this->error(M('goods_type')->getError());
			}
			$id = M('goods_type')->add();
			if(empty($id)){
				return $this->error('添加失败');
			}
			return $this->success('添加成功',U('index'));
		}
		
		$this->display();
	}
	public function edit(){
		if(empty(I('get.id'))){
			return $this -> error('参数错误');
		}
		if(IS_POST){
			$validate = [
				['type_name','require','规格名称不能为空'],
				['type_name','type_name','规格名称已存在',1,'unique'],
			];
			$_POST['id'] = I('get.id');
			$res = M('goods_type')->validate($validate)->create();
			if(empty($res)){
				return $this->error(M('goods_type')->getError());
			}
			
			$id = M('goods_type')->where(['id'=>I('get.id')])->save();
			if(empty($id)){
				return $this->error('没有修改数据');
			}
			return $this->success('修改成功',U('index'));
		}
		
		$goodstype = M('goods_type')->where(['id'=>I('get.id')])->find();
		
		$this -> assign('goodstype',$goodstype);
		
		$this -> display('add');
	}
	public function del(){
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
		$row = M('goods_type')->delete(I('get.id'));
		if(empty($row)){
			return $this->error('删除失败');
		}
		return $this->success('删除成功',U('index'));
	}
}








