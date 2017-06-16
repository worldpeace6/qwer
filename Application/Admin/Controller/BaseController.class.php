<?php
namespace Admin\Controller;

class BaseController extends \Think\Controller{
	
	public function _initialize(){
		$this->checkLogin();
	}
	protected function checkLogin(){
		if(!session('?users')){
			$this->error('请登录',U('Login/index'));
		}
	}
}

