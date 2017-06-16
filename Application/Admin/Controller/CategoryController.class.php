<?php
namespace Admin\Controller;
class CategoryController extends BaseController{
	public function index(){
		//$keywords = I('get.keywords');
		$map = [];

		if(!empty(I('get.keywords'))){
			$keywords = I('get.keywords');
			$map['cate_name'] = ['like',"%{$keywords}%"];
		}
		
		
		
		$list = M('category')->order('id asc')->where($map)->select();
		
		$tree = cate_tree($list);
		
		$this -> assign('list',$tree);
		
		$this->display();

	}
	public function add(){
		if(IS_POST){
			$validate = [
				['cate_name','require','分类名称不能为空'],
			];
		$res = M('category')->validate($validate)->create();
			if($res === false){
				return $this->error(M('category')->getError());
			}
		$id = M('category')->add();
		if(empty($id)){
			return $this->error('添加失败');
		}
			return $this->success('添加成功',U('index'));
		}

		//找出所有分类
		$cate = M('category')-> select();
		
		
		$data = cate_tree($cate);
		
		//分配变量到视图
		$this ->assign('cate',$data);
		
		$this->display();
	}
	public function edit(){
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
		if(IS_POST){
			$validate = [
				['cate_name','require','分类名称不能为空'],
			];
			$res = M('category')->validate($validate)->create();
			if(empty($res)){
				return $this->error(M('category')->getError());
			}
			$id = M('category')->where(['id'=>I('get.id')])->save();
			if(empty($id)){
				return $this->error('没有修改数据');
			}
			return $this->success('修改成功',U('index'));
		}
		//查出要修改的数据
		$data = M('category')->field('id,cate_name,pid')->find(I('get.id'));
		//查出所有分类
		$cate = M('category')->select();
		
		$tree = cate_tree($cate);
		$level = 0;
		foreach($tree as $key => $value){
			if($value['id'] == I('get.id')){
				$level = $value['level'];
				unset($tree[$key]);
				continue;
			}
			if($level>0){
				if($level < $value['level']){
					unset($tree[$key]);
				}else{
				break;
				}
			}
		}
		
		$this->assign('cate',$tree);
		$this->assign('info',$data);
		$this->display('add');
	}
	public function del(){
		if(empty(I('id'))){
			return $this->error('参数错误');
		}
		$isGoods = M('goods')->field('id')->where(['category_id'=>I('id')])->find();
		if(!empty($isGoods)){
			return $this->error('请先把该分类的商品删除，再执行该操作');
		}
		
		$row = M('category')-> delete(I('get.id'));
		if(empty($row)){
			return $this -> error('删除失败');
		}
			return $this -> success('删除成功',U('index'));
	}
}
