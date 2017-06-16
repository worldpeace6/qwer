<?php
namespace Admin\Controller;
class GoodsController extends BaseController{
	
	public function index(){
		
		$count = M('goods') -> count();
		$showpage = 1;
		$page = new \Think\Page($count,$showpage);
		$show = $page->show();
		$this -> assign('page',$show);
		
		$goodslist = D('Goods') 
				-> page(I('p',1),$showpage) 
				-> relation(['brand','category'])
				->select();
		//dump($goodslist);		
		$this -> assign('goodslist',$goodslist);
		$this->display();
	}
	public function add(){
		if(IS_POST){
			$validate = [
				['goods_name','require','商品名称不能为空'],
				['goods_name','goods_name','商品名称不能重复',1,'unique'],
				['goods_name','0,60','商品名称不能超过60个字符',1,'length'],
				['brand_id','require','请选择商品品牌'],
				['category_id','require','请选择商品分类'],
				['shop_price','require','本店价格不能为空'],
				['shop_price','currency','本店价格必须为数字'],
				['market_price','require','市场价格不能为空'],
				['market_price','currency','市场价格必须为数字'],
				['image','require','请上传主图'],
			];
			//判断用户是否选择主图
			if(empty(I('image')) && ! empty(I('pic'))){
				$_POST['image'] = $_POST['pic'][0];
				unset($_POST['pic'][0]);
			}
			//开启事务
			M()->startTrans();
			//收集商品信息
			$res = M('goods')->validate($validate)->create();
			// dump($res);
			// return;
			if($res === false){
				return $this->error(M('goods')->getError());
			}
			//添加商品信息
			$goods_id = M('goods')->add();
			if(empty($goods_id)){
				M()->rollback();
				return $this -> error('商品信息添加失败');
			}
			
			//收集商品详情
			$descRules = [
				['content','require','商品详情不能为空'],
			];
			$descRes = M('goods_desc') -> validate($descRules) -> create();
			if($descRes === false){
				return $this -> error(M('goods_desc')->getError());
			}
			//商品主键
			$descRes['goods_id'] = $goods_id;
			//添加商品详情
			$desc_row = M('goods_desc') -> add($descRes);
			if(empty($desc_row)){
				M()->rollback();
				return $this->error('商品详情添加失败');
			}
			
			//相册
			if(!empty(I('pic'))){
				$pic = I('pic');
				$photo = [];
				foreach($pic as $value){
					$photo[] = [
						'goods_id' => $goods_id,
					    'photo' => $value
					];
				
				}
				$id = M('goods_img')->addAll($photo);
				//dump($id);
				//return;
				if(empty($id)){
					M()->rollback();
					return $this -> error('商品相册添加失败');
				}
			}
			
			//套餐
			
			if(!empty(I('spec_price'))){
				$spec_price = I('spec_price');
				$spec = [];
				foreach($spec_price as $key => $value){
					if(!empty(trim($value))){
					$spec[] = [
						'goods_id' => $goods_id,
						'spec_price' => is_numeric($value) ? $value : 0,
						'spec_key' => $key,
					];
					}
				}
				
				if(!empty($spec)){
					$spec_id = M('goods_spec') -> addAll($spec);
					
					if(empty($spec_id)){
						M()->rollback();
						return $this->error('商品规格添加失败');
					}
				}
			}
			M()->commit();
			return $this -> success('商品添加成功',U('index'));
		}
		
		
		//查出所有商品品牌
		$brand = M('brand') ->field('id,brand_name') -> select();
		$this -> assign('brand',$brand);
		
		//查出所有商品分类
		$cate = M('category') -> select();
		$c = cate_tree($cate);
		$this -> assign('c',$c);
		
		
		$this->display();
	}
	
	
	public function edit(){
		
		$id = I('get.id');
		if(empty($id)){
			return $this -> error('非法操作');
		}	
		
		if(IS_POST){
			
			$validate = [
				['goods_name','require','商品名称不能为空'],
				['goods_name','goods_name','商品名称不能重复',1,'unique'],
				['goods_name','0,60','商品名称不能超过60个字符',1,'length'],
				['brand_id','require','请选择商品品牌'],
				['category_id','require','请选择商品分类'],
				['shop_price','require','本店价格不能为空'],
				['shop_price','currency','本店价格必须为数字'],
				['market_price','require','市场价格不能为空'],
				['market_price','currency','市场价格必须为数字'],
				['image','require','请上传主图',1],
			];
		//收集商品信息
		
		$_POST['id']= $id;
		
		$res = M('goods') -> validate($validate) ->create();
			if($res === false){
				return $this->error(M('goods') -> getError());
			}
		
		//默认修改失败
		$flag = false;
		
		//开始修改
		//开启事务
		M()->startTrans();
		$map = ['goods_id'=>$id];
		
		//修改商品
		$row = M('goods') -> save();
		//dump($row);return;
		if(!empty($row)){
			$flag = true;
		}
		
		
		//修改详情
		$desc_res = M('goods_desc')
				->validate([['content','require','商品详情不能为空',1]])
				->create();
				
		if($desc_res === false){
			return $this -> error(M('goods_desc') -> getError());
		}
		$desc_row = M('goods_desc') -> where($map)-> save();
	
		if(!empty($desc_row)){
			$flag = true;
		}
		
		
		//修改相册
		//先删除该商品的全部相册

		$img_row = M('goods_img') -> where($map) -> delete();
		
		
		if(!empty($img_row)){
			$flag = true;
		}
		
		//重新添加相册
		if(!empty(I('pic'))){
		
			$pic = [];
			foreach(I('pic') as $value){
				$pic[] = [
					'photo' => $value,
					'goods_id' => $id,
				];
			}
			
			$img_id =  M('goods_img')-> addAll($pic);
		   
			if(!empty($img_id)){
				$flag = true;
			}
		}
		
		//修改套餐
		//先删除该商品的全部套餐
		$spec_row = M('goods_spec')-> where($map) -> delete();
		if(!empty($spec_row)){
			$flag = true;
		}
		//重新添加套餐
		if(!empty(I('spec_price'))){
			$group = [];
			foreach(I('spec_price') as $key => $value){
				$group[] = [
					'goods_id' => $id,
					'spec_price' => $value,
					'spec_key' => $key,
				];
			}
			
			$spec_id = M('goods_spec')->addAll($group);
			if(!empty($spec_id)){
				$flag = true;
			}
		}
		
		if($flag === false){
			M()->rollback();
			return $this -> error('修改失败');
		}
		M()->commit();
		return $this -> success('修改成功',U('index'));
			
		}
		
		
		//查询商品信息
		$goods = D('Goods') ->relation(true) ->find($id);
		
		// dump($goods);
		if(empty($goods)){
			return $this -> error('商品不存在');
		}

		$this -> assign('goods',$goods);
		
		$spec_id = [];
		$spec_price = [];
		foreach($goods['goods_spec'] as $key => $value){
			$spec_key = explode(',',$value['spec_key']);
			$spec_id = array_merge($spec_id,$spec_key);
			$spec_price[$value['spec_key']] = $value['spec_price'];
		}

		$spec_id = array_unique($spec_id);

		
		$spec_group = $this -> handel_group($spec_id,$spec_price);

		$this -> assign('group',$spec_group);
	
		//查询商品品牌
		$brand = M('brand') -> field('id,brand_name') -> select();
		$this -> assign('brand',$brand);

		//查询商品分类
		$cate = M('category')-> select();
		$c = cate_tree($cate);

		//dump($c);
		$this -> assign('c',$c);
		$this -> display('add');

	}
	
	public function del(){
		$id = I('id');
		if(empty($id)){
			return $this -> error('非法操作');
		}
		//查询商品信息
		$goods = M('goods') -> find($id);
		if(empty($goods)){
			return $this -> error('该商品不存在！');
		}
		//开启事务
		M()->startTrans();
		$map = ['goods_id'=>$id];
		//删除商品详情
		$desc_row = M('goods_desc')->where($map)->delete();
		if(empty($desc_row)){
			M()->rollback();
			return $this -> error('删除失败');
		}
		//删除商品相册
		if(M('goods_img')->where($map)->count() > 0){
			$img_row = M('goods_img')->where($map)->delete();
			if(empty($img_row)){
				M()->rollback();
				return $this -> error('删除失败');
			}
		}
		//删除商品套餐
		if(M('goods_spec')->where($map)->count() > 0){
			$spec_row = M('goods_spec')->where($map)->delete();
			if(empty($spec_row)){
				M()->rollback();
				return $this -> error('删除失败');
			}
		}
		//删除商品评论
		if(M('comment')->where($map)->count() > 0){
			$comment = M('comment')->where($map)->delete();
			if(empty($comment)){
				M()->rollback();
				return $this -> error('删除失败');
			}
		}
		//删除商品
		$goods = M('goods') -> delete($id);
		if(empty($goods)){
			M()->rollback();
			return $this -> error('删除失败');
		}
		M()->commit();
		return $this -> success('删除成功');
		
	}
	
	
	public function handel_group($spec_id=[],$spec_price=[]){
		//通过规格选项id到数据库查询选项内容
		$id = IS_AJAX ? I('id') : $spec_id;
		//dump(I('id'));
		// return;
		$items = D('SpecItems')-> where(['id'=>['in',$id]]) ->select();
		$item_id = [];
		$spec_items = [];
		foreach ($items as $key => $value) {
			$item_id[$value['spec_id']][] = $value['id'];
			$spec_items[$value['id']] = & $items[$key];
		}
		
		//获取商品的套餐选项
		$group = get_array_group($item_id);

		//取出所有的规格id
		$spec_id = array_keys($item_id);
		//查询规格数据
		$spec = M('spec') -> where(['id'=>['in',$spec_id]]) -> select();

		$html = '<table>';
		//组合标题
		$th = '';
		   foreach ($spec as $key => $value) {
		   		$th .= '<th>' . $value['spec_name'] . '</th>';
		   }
		   
		   $th .='<th style="text-align:left;">价格</th></tr>';
		$html .= $th;
		$td ='<tr>';
		foreach ($group as $key => $value) {
			foreach ($value as $i) {
				$td .='<td>' . $spec_items[$i]['item']. '</td>';
			}
			
			//对套餐的id做升序
			asort($value);
			
			$item_id_str = implode(',',$value);
			
			//dump($item_id_str);
			$price = '';
			if(isset($spec_price[$item_id_str])){
				$price = $spec_price[$item_id_str];
			}
			
			$td .='<td><input value="'.$price.'" type="text" name="spec_price['.$item_id_str.']"></td></tr>';
		}
		$html .=$td;
 	 	$html .= '</table>';

		if(IS_AJAX){
			die($html);
		}
		return $html;
	}
	public function add_spec(){
	

		$goods_type = M('goods_type') ->select();

		foreach ($goods_type as $key => $value) {
			$goods_type[$key]['spec'] = D('spec')->where(['type_id'=>$value['id']]) -> relation('spec_items') -> select();
		}

		$this->assign('goods_type',$goods_type);

		$this->display();
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