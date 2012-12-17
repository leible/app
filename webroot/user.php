<?php

require_once '../init.inc.php';

Common::checkSession();

$user_name = isset($_REQUEST['user_name']) && $_REQUEST['user_name'] ? trim($_REQUEST['user_name']) : '';
$password = isset($_REQUEST['password']) && $_REQUEST['password'] ? md5(trim($_REQUEST['password'])) : '';
//这是role_id的缩写，写上role_id会导致两个变量重名。导致session['role_id']失效
$rid = isset($_REQUEST['role_id']) && $_REQUEST['role_id'] ? trim($_REQUEST['role_id']) : 0;
$id = isset($_REQUEST['id']) && $_REQUEST['id'] ? trim($_REQUEST['id']) : 0;

//获取所有角色
$roleList = Role::getAllRoleList();
switch ($action){
    case 'list':
        $title = '用户列表';
        $userList = User::getAllUserList();
        break;
    case 'add':
        $title = '用户添加';
        break;
    case 'insert':
        try{
            User::addUser($user_name, $password, $rid);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'user.php');
        break;
    case 'del':
        try{
            User::delUser($id);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'user.php');
        break;
    case 'modify':
        $title = '用户更新';
        $info = User::getInfoById($id);
        break;
    case 'update':
        try{
            User::updateUser($user_name, $password, $rid, $id);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'user.php');
        break;
}

$module = Common::getModule();
$tpl->assign('module', $module);
$tpl->assign('title', $title);
$tpl->assign('info', $info);
$tpl->assign('action', $action);
$tpl->assign('userList', $userList);
$tpl->assign('roleList', $roleList);
$tpl->display('user.tpl');