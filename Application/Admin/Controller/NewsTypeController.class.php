<?php
namespace Admin\Controller;
class NewsTypeController extends BaseController
{
	public function index(){
		$map = [];

		if(!empty(I('get.keywords'))){
			$keywords = I('get.keywords');
			$map['cate_name'] = ['like',"%{$keywords}%"];
		}
		
		
		
		$list = M('news_class')->order('id asc')->where($map)->select();
		
		$tree = cate_tree($list);
		
		$this -> assign('list',$tree);

		$this ->display();
	}
	public function add(){
		if(IS_POST){
			$validate = [
				['c_name','require','分类名称不能为空'],
			];
		$res = M('news_class')->validate($validate)->create();
			if($res === false){
				return $this->error(M('news_class')->getError());
			}
		$id = M('news_class')->add();
		if(empty($id)){
			return $this->error('添加失败');
		}
			return $this->success('添加成功',U('index'));
		}


		$this ->display();
	}
	public function edit(){
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
		if(IS_POST){
			$validate = [
				['c_name','require','分类名称不能为空'],
			];
			$res = M('news_class')->validate($validate)->create();
			if(empty($res)){
				return $this->error(M('news_class')->getError());
			}
			$id = M('news_class')->where(['id'=>I('get.id')])->save();
			if(empty($id)){
				return $this->error('没有修改数据');
			}
			return $this->success('修改成功',U('index'));
		}

		//查询要修改的数据
		$data = M('news_class')->field('id,c_name')->find(I('get.id'));
		$this -> assign('info',$data);
		$this ->display('add');
	}
	public function del(){
		if(empty(I('id'))){
			return $this->error('参数错误');
		}
		$isnews = M('news')->field('id')->where(['class_id'=>I('id')])->find();
		if(!empty($isnews)){
			return $this->error('请先把该分类的新闻删除，再执行该操作');
		}
		
		$row = M('news_class')-> delete(I('get.id'));
		if(empty($row)){
			return $this -> error('删除失败');
		}
			return $this -> success('删除成功',U('index'));
	}
}