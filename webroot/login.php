<?php
include '../init.inc.php';


$user_name = isset($_REQUEST['user_name']) && $_REQUEST['user_name'] ? trim($_REQUEST['user_name']) : '';
$password = isset($_REQUEST['password']) && $_REQUEST['password'] ? md5(trim($_REQUEST['password'])) : '';


switch ($action){
    case 'login':
        try {
            Common::checkLogin($user_name, $password);
            //$code = 0;
            //$msg = '登陆成功';
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg);
        break;

    case 'loginout':
        try {
            Common::loginOut();
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg);
        break;
}

$tpl->assign('action', $action);


$tpl->display('login.tpl');