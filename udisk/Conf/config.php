<?php
return array(
		//'配置项'=>'配置值'
		'LANG_SWITCH_ON' => true,
        'DEFAULT_LANG' => 'zh-cn', // 默认语言
        'LANG_AUTO_DETECT' => true, // 自动侦测语言
        'LANG_LIST'=>'en-us,zh-cn',//必须写可允许的语言列表
		'DEFAULT_THEME'  => @include_once 'tpl.php',//模版
		
		'SHOW_PAGE_TRACE' => true,
		'URL_HTML_SUFFIX'=>'do',//页面为page.do形式
		'URL_MODEL'          => '1', //URL模式
		'URL_CASE_INSENSITIVE' =>true,//兼容URL小写，开启
		'LOAD_EXT_FILE'=>'functions',
		'STORE_PATH'=>'./store/',//请以/结尾
		
		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_HOST'   => 'localhost', // 服务器地址
		'DB_NAME'   => 'upan', // 数据库名
		'DB_USER'   => 'root', // 用户名
		'DB_PWD'    => 'lijun', // 密码
		'DB_PORT'   => 3306, // 端口
		'DB_PREFIX' => 'up_', // 数据库表前缀，请勿改动
		
		'ROOT_PATH'			=>getcwd().'/',//项目根目录，必须开启
		'WWW_PATH'			=>preg_replace('/[\w|.]*$/i', '', $_SERVER['SCRIPT_NAME']),//网站根目录，必须开启
);
?>