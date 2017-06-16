<?php
namespace Admin\Controller;
class SpecController extends BaseController{
	public function index(){
		$keywords = I('get.keywords');
		$map = [];
		if(!empty($keywords)){
			$map['spec_name'] = ['like',"%{$keywords}%"];
		}
		//总数据量
		$count = D('Spec') -> where($map) -> count();
		//显示的页码数
		$showpage = 2;
		$page = new \Think\Page($count,$showpage);

		$this -> assign('page',$page->show());

		//查询数据
		$list = D('Spec')->page(I('p',1),$showpage)-> relation('goods_type')->where($map)->select();
		//分配变量到视图
		$this -> assign('list',$list);
		$this->display();
	}
	public function add(){
		
		if(IS_POST){
			//return;
			$res = D('Spec') -> spec_add();
			
			if(is_string($res)){
				return $this->error($res);
			}
			return $this -> success('添加成功',U('index'));
		}
		//找出所有商品模型
		$goodstype = M('goods_type')->select();
		
		$this -> assign('goodstype',$goodstype);
		
		$this->display();
	}

	public function edit(){
		$_POST['id'] = I('get.id');
		if(IS_POST){
		$res = D('Spec')-> spec_edit();
		
		//dump($res);
		//return;
		//return;
			if(!is_int($res)){
				return $this -> error($res);
			}
			return $this -> success('修改成功',U('index'));
		}
		
		
		
		
		//查询规格模型
		$goodstype = M('goods_type') -> select();
		//分配到视图
		$this -> assign('goodstype',$goodstype);
		//查出要修改的数据
		$spec = D('Spec')-> relation('spec_items') -> where(['id' => I('get.id')]) -> find();
		$items = M('spec_items') -> where(['spec_id' => I('get.id')]) -> getField('id,item');
		$spec['items'] = implode("\r\n",$items);
		//dump($spec); 
		//分配变量到视图
		$this -> assign('spec',$spec);

		$this->display('add');
	}
	public function del(){
		$res = D('Spec') -> spec_del();
		if(!$res){
			return $this->error('删除失败');
		}
		return $this -> success('删除成功',u('index'));
	}
}