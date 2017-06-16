<?php
/*
*获取数组的排列组合
*@param array $arr 分类数组
*/
function get_array_group($arr){
	$group = [];
	foreach ($arr as $value) {
		if(empty($group)){
			foreach ($value as $val) {
				$group[] = [$val];
			}
		}else{
			$tmp = [];
			foreach ($group as $g) {
				foreach ($value as $val) {
					if(!is_array($g)){
						$tmp[] = [$g,$val];
					}else{
						$g[] = $val;
						$tmp[] = $g;
						array_pop($g);
					}
				}
			}
			$group = $tmp;
		}
	}
	return $group;
}

/*
*无极分类
*@param array $cateArr 分类数组
*@param int   $pid  	父级id
*@param int   $level   等级
*/
function cate_tree($cateArr,$pid=0,$level=1){
	$data=[];
	
	foreach($cateArr as $key=>$value){
		
		if($value['pid'] == $pid){
			$value['level'] = $level;
			$data[]=$value;
			$tmp = cate_tree($cateArr,$value['id'],$level+1);
			
			unset($cateArr[$key]);
			if(!empty($tmp)){
				//合并数组
				$data = array_merge($data,$tmp);
			}
		}
	}
	
	return $data;	
}