<?php
define('URL', 'http://app.com');
//define('ROOT', dirname(__FILE__) . '/../');

$MYSQL_CONFIG = array(
	'db_host' => '127.0.0.1',
	'db_user' => 'root',
	'db_passwd' => '123456',
	'db_name' => 'mianshi'
);

//权限配置
$CONFIG = array(
	//不用登录验证的模块
	
    'NOT_LOGIN' => array('login'),
    //登录后不验证的
    'NOT_AUTH' => array('index','menu','main','top'),
);