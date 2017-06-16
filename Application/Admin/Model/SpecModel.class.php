<?php
namespace Admin\Model;
class SpecModel extends \Think\Model\RelationModel{
	protected $_link = [
		'spec_items' => [
		'mapping_type'  => self::HAS_MANY,
		'foreign_key'   => 'spec_id',
		'mapping_fields'=> 'id,item',
		],
		'goods_type' => [
			'mapping_type'  => self::BELONGS_TO,
			'foreign_key'   => 'type_id',
		],
	];
	protected $_validate = [
		['spec_name','require','规格名称不能为空'],
		['spec_name','spec_name','规格名称不能重复',1,'unique'],
		['type_id','require','所属商品不能为空'],

	];

	public function spec_add(){
		
		$res = $this ->create();
		
		if(empty($res)){
			return $this ->getError();
		}
		//规格选项
		$items = I('post.item');
		$itemsArr = explode("\r\n",$items);
		//去除两边空格
		$itemsArr = array_map('trim',$itemsArr);
					
		//去除重复
		$itemsArr = array_unique($itemsArr);
		
		$tmp = [];
		foreach($itemsArr as $key => $value){
			$t = trim($value);
			if(!empty($t)){
			$tmp[] = ['item' => $value];
			}
		}

		if(empty($tmp)){
			return '规格选项不能为空';
		}
		$res['spec_items']=$tmp;
		
		$id = $this ->relation(true)->add($res);
		if(empty($id)){
			return '添加失败';
		}
		return (int)$id;
	}
	public function spec_edit(){
		
		if(empty(I('post.item'))){
			return '规格选项不能为空';
		}
		$res = $this -> create();
		
		if($res === false){
			return $this -> getError(); 
		}
		 //规格选项
		$items = I('post.item');
		
		//把字符串转换成数组
		$itemsArr = explode("\r\n",$items);
		
		//去除两边空格
		$itemsArr = array_map('trim',$itemsArr);
		
		
		//去除重复
		$itemsArr = array_unique($itemsArr);
		
		//已存在的规格选项
		$old = M('spec_items') -> where(['spec_id' => $res['id']]) ->getField('id,item');
		
		//需要删除的数据
		$del = array_diff($old,$itemsArr);
		
		//需要增加的数据
		$add = array_diff($itemsArr,$old);

		$new = [];

		foreach ($add as $value){
			if(!empty($value)){
		   $new[] = ['item' => $value];	
			}
		}

		if(!empty($new)){
			$res['spec_items'] = $new;
		}
		
		
		//先删除需要删除的规格选项
		if(! empty($del)){ //当有数据要删除的时候
		    M('spec_items')->where([
				'spec_id' => $res['id'],
				'item' => ['in',$del],
			])->delete();
		}
		
		$row = $this ->relation('spec_items')-> save($res);
		
		if(empty($row)&&empty($del)&&empty($new)){
			return '修改失败';
		}
		
		return $row;
		
	}

	
	public function spec_del(){
		$row = $this -> relation(true) -> delete(I('get.id'));
		if(empty($row)){
			return false;
		}
		return true;
	}
}