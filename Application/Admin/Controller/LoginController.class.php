<?php
namespace Admin\Controller;

class LoginController extends \Think\Controller{
	public function index(){
		if(IS_POST){
			
			$user_name = I('user_name');
			$password = I('password');
			$code = I('code');
			
			if(empty($user_name)){
				return $this->error('用户名不能为空');
			}
			if(empty($password)){
				return $this->error('密码不能为空');
			}
			if(empty($code)){
				return $this->error('验证码不能为空');
			}
			$verify = new \Think\Verify;
			if( ! $verify->check($code)){
				return $this->error('验证码错误');
			}
			//查询用户
			$user = M('admin')->where(['user_name'=>$user_name])->find();
			if(empty($user)){
				return $this->error('用户名不存在');
			}
			//比对密码
			if( md5($password) != $user['password'] ){
				return ('密码错误');
			}
			unset($user['password']);
			//保存登录信息
			session('users',$user);
			//跳转页面
			return $this->success('登录成功',U('Index/index'));
		}
		
		
		$this->display();
	}
	public function verify(){
		$verify = new \Think\Verify;
		$verify->imageW=100;
		$verify->imageH=50;
		$verify->length=1;
		
		$verify->entry();
	}
}
