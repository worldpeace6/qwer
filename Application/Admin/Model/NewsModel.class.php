<?php
namespace Admin\Model;
class NewsModel extends \Think\Model\RelationModel
{
	protected $_link = [
		'news_class' => [
			'mapping_type' => self::BELONGS_TO,
			'foreign_key'  => 'class_id',
		],
		'news_img' => [
			'mapping_type' => self::HAS_MANY,
		],
		'news_desc' => [
			'mapping_type' => self::HAS_ONE,
		],
	];

	protected $validate = [
			['name','require','新闻标题不能为空'],
			['name','name','新闻已存在',1,'unique'],
			['name','0,255','新闻标题不能超过255个字符',1,'length'],
			['class_id','require','请选择新闻分类'],
		];
	public function news_edit(){
		
	}

}
