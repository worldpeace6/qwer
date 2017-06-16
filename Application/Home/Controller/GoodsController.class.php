<?php
namespace Home\Controller;
class GoodsController extends \Think\Controller
{
	public function index(){
		
		if(I('get.id')){
			$cid = I('get.id',0);
		}
		$c = M('category')->where(['pid'=>0])->select();
		
		//查询商品分类数据
		
		$count = M('goods') -> where() -> count();
		$showCount = 8;
		$page = new \Think\Page($count,$showCount);
		
		$goods = M('goods')
			->where(['category_id' => $cid])
			->field('id,goods_name,shop_price,image,category_id') 
			->page(I('get.p'),$showCount)
			->fetchsql(false)
			->select();
			
		dump($goods);
		$this -> assign('goods',$goods);
		$this -> assign('page',$page->show());
		$this -> assign('c',$c);
		$this -> display();
	}
	
	public function info(){
		$id = I('id',0);
		if(empty($id)){
		   return $this -> error('非法操作');
		}
		
		//商品主体信息
		$goods = M('goods') 
				-> field('id,goods_name,shop_price,market_price,image')
				->find($id);
		$this -> assign('goods',$goods);
		
		//商品相册
		$img = M('goods_img')
			->where(['goods_id' => $id])
			->field('id,photo')
			->select();
		$this -> assign('img',$img);
		
		//商品详情
		$desc = M('goods_desc')
				->field('content')
				->find();
		$this -> assign('desc',$desc);
		
		//商品规格
		$spec = M('goods_spec')
				->where(['goods_id' => $id])
				->field('spec_key,spec_price')
				->select();
		//dump($spec);
		$spec_key = [];
		foreach($spec as $value){
			$s_key = explode(',',$value['spec_key']);
			$spec_key = array_merge($spec_key,$s_key);
		}
		//去除重复
		$spec_key = array_unique($spec_key);
		//dump($spec_key);
		//规格信息
		$item = M('spec_items')
				->field('item,spec_id')
				->where(['id'=>['in',$spec_key]])
				->select();
		//dump($item);
		$group = [];
		$spec_name = [];
		foreach($item as $key => $value){
			if(empty($spec_name[$value['spec_id']])){
				$spec_name[$value['spec_id']] = M('spec')
											-> where(['id'=>$value['spec_id']])
											->getField('spec_name');
			}
			$group[$spec_name[$value['spec_id']]][] = & $item[$key];
		}
		dump($group);
		$this -> assign('group',$group);
		$this -> display();
	}
}