<?php
include '../init.inc.php';

Common::checkSession();

$name = isset($_REQUEST['type_name']) && $_REQUEST['type_name'] ? $_REQUEST['type_name'] : '';
$id = isset($_REQUEST['id']) && $_REQUEST['id'] ? (int)$_REQUEST['id'] : 0;
$status = isset($_REQUEST['status']) && $_REQUEST['status'] ? $_REQUEST['status'] : 1;

switch ($action) {
    case 'list':
        $title = '设备类型列表';
        $list = Type::getAllTypeList();
        $devCount = Dev::getCountByTypeId($type_id);
        break;
    case 'add':
        $title = '自定义设备类型';
        break;
    case 'insert':
        try{
            Type::addType($name);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'type.php');
        break;

    case 'modify':
        $title = '更新设备类型';
        $info = Type::getInfoById($id);
        break;
    case 'forbidden':
        try {
            Type::forbiddenType($id);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'type.php');
        break;
    case 'update':
        try{
            Type::updateType($id, $name, $status);
            echo Mysql::getLastSQL();
        }catch(Exception $exc){
            $exc->getCode();
            $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'type.php');
        break;
    case 'del':
        try {
            Type::delType($id);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'type.php');
        break;
}

$module = Common::getModule();
$tpl->assign('module', $module);
$tpl->assign('title', $title);
$tpl->assign('info', $info);
$tpl->assign('action', $action);
$tpl->assign('list', $list);
$tpl->assign('devCount'. $devCount);
$tpl->display('type.tpl');