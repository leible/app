<?php
require_once '../init.inc.php';

Common::checkSession();

$name = isset($_REQUEST['role_name']) && $_REQUEST['role_name'] ? trim($_REQUEST['role_name']) : '';
$id = isset($_REQUEST['id']) && ($_REQUEST['id'] > 0) ? (int) $_REQUEST['id'] : 0;

switch ($action) {
    case 'list':
        $title = '角色列表';
        $list = Role::getAllRoleList();
        //$nodeName = Node::getNodeNameById();
        break;
    case 'add':
        $title = '角色添加';
        break;
    case 'insert':
        try {
            Role::addRole($name);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'role.php');
        break;
    case 'del':
        try {
            Role::delRole($id);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'role.php');
        break;
    case 'modify':
        $title = '角色更新';
        $info = Role::getInfoById($id);
        break;
    case 'update':
        try {
            Role::updateRole($name, $id);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'role.php');
        break;
}
$module = Common::getModule();
$tpl->assign('module', $module);
$tpl->assign('title', $title);
$tpl->assign('info', $info);
$tpl->assign('action', $action);
$tpl->assign('list', $list);
//$tpl->assign('nodeName', $nodeName);
$tpl->display('role.tpl');