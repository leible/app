<?php

session_start();
include '../config/config.inc.php';
//error_reporting(E_ALL); 打开这个,网站装不能浏览  报数据库相关错误
error_reporting(0);

//自动加载
function __autoload($className) {

    if ($className == 'Mysql' || $className == 'Utility') {
        include('../lib/' . ucfirst($className) . '.class.php');
    } elseif ($className == 'Smarty') {
        include('../Smarty/' . ucfirst($className) . '.class.php');
    } else {
        include('../class/' . ucfirst($className) . '.class.php');
    }
}

//从这里开始验证权限（各个模块的action名）
$action = isset($_REQUEST['action']) && $_REQUEST['action'] ? trim($_REQUEST['action']) : 'list';
Role::auth($action);


$tpl = new Smarty;

$tpl->template_dir = "../template";
$tpl->compile_dir = "../compiled";
$tpl->left_delimiter = '<{';
$tpl->right_delimiter = '}>';