<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'my_shop_db',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
		'TMPL_PARSE_STRING'  =>array(
    '__PUBLIC__' => '/Public/Home/', // 更改默认的/Public 替换规则
     
    //'__UPLOAD__' => '/Uploads', // 增加新的上传路径替换规则
),
    'LAYOUT_ON'=>true, //开启模板布局
    'LAYOUT_NAME'=>'Layout/index', //布局模板名称
);