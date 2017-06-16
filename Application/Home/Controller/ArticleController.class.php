<?php
namespace Home\Controller;
//类代表控制器 ，控制器里的一个方法代表一个页面
class ArticleController extends \think\Controller {
    public function Index(){
       echo "string";

}
    public function Abc(){
      echo "11";
    }
}
  //添加一条数据
    // $res = M('class')->add([
    // 	'name'=>'111'
    // 	]);

    // dump($res);

  //更新
  // $res = M('class') -> where('id=14') -> save(['name'=>'222']);
  // dump($res);
   //M('class')->where('id=15')->delete();







