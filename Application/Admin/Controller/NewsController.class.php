<?php
namespace Admin\Controller;
class NewsController extends BaseController
{
	public function index(){
		$count = M('news') -> count();
		$showpage = 1;
		$page = new \Think\Page($count,$showpage);
		$show = $page->show();
		$this -> assign('page',$show);
		
		$newslist = D('News') 
				-> page(I('p',1),$showpage) 
				-> relation('news_class')
				->select();
		//dump($newslist);		
		$this -> assign('newslist',$newslist);
		$this->display();
	}

	public function add(){
		if(IS_POST){
			$validate = [
				['name','require','新闻标题不能为空'],
				['name','name','新闻已存在',1,'unique'],
				['name','0,255','新闻标题不能超过255个字符',1,'length'],
				['class_id','require','请选择新闻分类'],
			];
			//开启事务
			M()->startTrans();

			$res = M('news')->validate($validate)->create();
			// dump($res);
			// return;
			if($res === false){
				return $this->error(M('news')->getError());
			}
			//添加信息
			$news_id = M('news')->add();

			//dump($news_id);
			if(empty($news_id)){
				M()->rollback();
				return $this -> error('新闻信息添加失败');
			}
			
			//收集详情
			$descRules = [
				['content','require','新闻详情不能为空'],
			];
			$descRes = M('news_desc') -> validate($descRules) -> create();
			if($descRes === false){
				return $this -> error(M('news_desc')->getError());
			}
			//主键
			$descRes['news_id'] = $news_id;
			//添加详情
			$desc_row = M('news_desc') -> add($descRes);
			if(empty($desc_row)){
				M()->rollback();
				return $this->error('新闻详情添加失败');
			}
			
			//图片
			//dump(I('pic'));
			if(!empty(I('pic'))){
				$pic = I('pic');
				$photo = [
						'news_id' => $news_id,
					    'photo' => $pic
					];
				
				
				$id = M('news_img')->add($photo);
				// dump($id);
				// return;
				if(empty($id)){
					M()->rollback();
					return $this -> error('新闻图片添加失败');
				}
				M()->commit();
				return $this -> success('新闻添加成功',U('index'));
			}

	    }

	    //查询新闻分类
	    $c = M('news_class') -> select();
	    $this -> assign('c',$c);

		$this -> display();

}
	public function edit(){
		$id = I('get.id');


		//查询要修改的数据
		$news = D('News') -> relation(['news_img','news_desc']) -> find($id);
		//dump($news);
		//查询新闻分类
		$c = M('news_class')-> select();
		$this -> assign('c',$c);
		$this -> assign('news',$news);

		$this -> display('add');
	}
	public function del(){
		$id = I('id');
		if(empty($id)){
			return $this -> error('非法操作');
		}
		//查询信息
		$news = M('news') -> find($id);
		if(empty($news)){
			return $this -> error('该新闻不存在！');
		}
		
		$row = D('News') -> relation(['news_img','news_desc'])->delete($id);
		if(empty($row)){
			return $this -> error('删除失败');
		}
		return $this -> success('删除成功',U('index'));

	}
	public function upload($filename='pic'){
	
		//echo "upload";
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =      'Public/Uploads/'; // 设置附件上传根目录
		
		//判断根目录是否存在
		if(!is_dir($upload->rootPath)){
			mkdir($upload->rootPath);
		}
		//上传文件 
		$info   =   $upload->uploadOne($_FILES[$filename]);
		
		if($info === false){
			die(json_encode(['error'=>1,'msg'=>$upload -> getError()]));
		}
		//print_r($info);
		$path = $upload->rootPath . $info['savepath'] . $info['savename'];
		die(json_encode(['code'=>0,'path'=>$path]));
	
    }

}