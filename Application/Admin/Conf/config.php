<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_PARSE_STRING'  =>array(
    '__PUBLIC__' => '/Public/Admin', // 更改默认的/Public 替换规则
     
    '__UPLOAD__' => '/Uploads', // 增加新的上传路径替换规则
),
    'LAYOUT_ON'=>true, //开启模板布局
    'LAYOUT_NAME'=>'Layout/index', //布局模板名称

);