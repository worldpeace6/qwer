<?php
namespace Admin\Controller;
//类代表控制器 ，控制器里的一个方法代表一个页面
class IndexController extends BaseController {
    public function index(){
		$this->display('index');
    }
}


