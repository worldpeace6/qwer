<?php
namespace Admin\Controller;
class AdminController extends BaseController{
	public function index(){
		$map = [];
		if(!empty(I('get.keywords'))){
			$keywords = I('get.keywords');
			$map['user_name'] = ['like',"%{$keywords}%"];
		}
		$count = M('admin')->where($map)->count();
		
		$showpage = 2;
		
		$page = new \Think\Page($count,$showpage);
		
		$show = $page -> show();
		
		$this ->assign('page',$show);
		
		$list = M('admin')->order('id asc')->where($map)->page(I('p',1),$showpage)->select();
		
		$this->assign('list',$list);
		
		$this->display();
	}
	
	public function add(){
		if(IS_POST){
			$validate = [
				['user_name','require','用户名不能为空'],
				['user_name','user_name','用户名已存在',1,'unique'],
				['user_name','6,18','用户名6-18位',1,'length'],
				['password','require','密码不能为空'],
				['password','password2','密码与确认密码不一致',1,'confirm'],
				['password','6,18','密码6-18位',1,'length'],
			];
			
			$res = M('admin')->validate($validate)->create();
			if($res === false){
				return $this->error(M('admin')->getError());
			}
			$res['password'] = md5($res['password']);
			$id = M('admin')->add($res);
			if(empty($id)){
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
		//验证规则
		$validate = [
			['password','require','密码不能为空'],
			['password','password2','密码与确认密码不一致',1,'confirm'],
			['password','6,18','密码6-18位',1,'length'],
		];
		//验证规则并加载数据
		$res = M('admin')->validate($validate)->create();
		if(empty($res)){
			return $this->error(M('admin')->getError());
		}
		//加密
		$res['password'] = md5($res['password']);
		$id = M('admin')->where(['id'=>I('get.id')])->save($res);
		if(empty($id)){
			return $this->error('没有修改数据');
		}
			return $this->success('修改成功',U('index'));
			
		}	
		//查出要修改的数据
		$user = M('admin')->find(I('get.id'));
		//分配变量到视图
		$this -> assign('user',$user);
		
		$this->display('add');
	}
	public function del(){
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}
		$res = M('admin')-> delete(I('get.id'));
		if(empty($res)){
			return $this->error('删除失败');
		}
			return $this->success('删除成功');
	}
}