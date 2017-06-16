<?php
namespace Admin\Model;
class GoodsModel extends \Think\Model\RelationModel{
	protected $_link = [
		'brand'=>[
			'mapping_type' => self::BELONGS_TO,
			'class_name'   => 'Brand',
			'foreign_key'  => 'brand_id',
		],
		'category'=>[
			'mapping_type' => self::BELONGS_TO,
			'class_name'   => 'Category',
			'foreign_key'  => 'category_id',
		],
		'goods_img'=>[
			'mapping_type' => self::HAS_MANY,
			'foreign_key'  => 'goods_id',
		],
		'goods_spec'=>[
			'mapping_type' => self::HAS_MANY,
		],
		'goods_desc'=>[
			'mapping_type' => self::HAS_ONE,
		],
	];
	protected $_validate = [
				['goods_name','require','商品名称不能为空'],
				['goods_name','goods_name','商品名称不能重复',1,'unique'],
				['goods_name','0,60','商品名称不能超过60个字符',1,'length'],
				['brand_id','require','请选择商品品牌'],
				['category_id','require','请选择商品分类'],
				['shop_price','require','本店价格不能为空'],
				['shop_price','currency','本店价格必须为数字'],
				['market_price','require','市场价格不能为空'],
				['market_price','currency','市场价格必须为数字'],
				['content','require','商品详情不能为空'],
				['image','require','请上传主图'],
			];
	public function goods_edit(){}

}





