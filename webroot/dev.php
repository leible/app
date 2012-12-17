<?php
require_once '../init.inc.php';

Common::checkSession();

$id = isset($_REQUEST['id']) && $_REQUEST ? $_REQUEST['id'] : 0;
$dev_name = isset($_REQUEST['dev_name']) && $_REQUEST['dev_name'] ? $_REQUEST['dev_name'] : '';
$sn = isset($_REQUEST['sn']) && $_REQUEST['sn'] ? $_REQUEST['sn'] : '';
$type_id = isset($_REQUEST['type_id']) && $_REQUEST['type_id'] ? $_REQUEST['type_id'] : 0;
$buyer = isset($_REQUEST['buyer']) && $_REQUEST['buyer'] ? $_REQUEST['buyer'] : '';
$status = isset($_REQUEST['status']) && $_REQUEST['status'] ? $_REQUEST['status'] : 1;
$price = isset($_REQUEST['price']) && $_REQUEST['price'] ? $_REQUEST['price'] : 0.00;
$time = isset($_REQUEST['time']) && $_REQUEST['time'] ? strtotime($_REQUEST['time']) : time();
$contract_sn = isset($_REQUEST['contract_sn']) && $_REQUEST['contract_sn'] ? $_REQUEST['contract_sn'] : '';
$remark = isset($_REQUEST['remark']) && $_REQUEST['remark'] ? $_REQUEST['remark'] : '';
$config_info = isset($_REQUEST['config_info']) && $_REQUEST['config_info'] ? $_REQUEST['config_info'] : '';
$store_place = isset($_REQUEST['store_place']) && $_REQUEST['store_place'] ? $_REQUEST['store_place'] : '';

$searchName = isset($_REQUEST['searchName']) && $_REQUEST['searchName'] ? $_REQUEST['searchName'] : '';
$keyWord = isset($_REQUEST['keyWord']) && $_REQUEST['keyWord'] ? $_REQUEST['keyWord'] : '';

$roleList = Role::getAllRoleList();
$userList = User::getAllUserList();
$typeList = Type::getNormaTypeList();

$module = Common::getModule();

switch ($action) {
    case 'list':
        $title = '设备列表';
        $devList = Dev::getAllDevList();
        break;
    case 'add':
        $title = '添加设备';
        break;
    case 'insert':
        try {
            Dev::addDev($dev_name, $sn, $type_id, $price, $time, $contract_sn, $remark, $config_info, $buyer, $store_place, $status);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'dev.php');
        break;
    case 'update':
        try {
            Dev::updateDev($id, $dev_name, $sn, $type_id, $price, $time, $contract_sn, $remark, $config_info, $buyer, $store_place, $status);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'dev.php');
        break;
    case 'del':
        try {
            Dev::delDev($id);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'dev.php');
        break;
    //报废设备
    case 'scrap':
        try {
            Dev::scrapDev($id);
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        Common::returnMsg($code, $msg, 'dev.php');
        break;
    case 'modify':
        $title = '更新设备';
        $info = Dev::getInfoById($id);
        break;
    case 'search':
        $title = '设备搜索';
        try {
            $searchList = Dev::searchDev($searchName, $type_id, $keyWord, $status);
            //echo Mysql::getLastSQL();
        } catch (Exception $exc) {
            $code = $exc->getCode();
            $msg = $exc->getMessage();
        }
        break;
    case 'info':
        $devInfo = Dev::getInfoById($id);
        break;

}
$tpl->assign('module', $module);
$tpl->assign('title',$title);
$tpl->assign('action', $action);
$tpl->assign('devList', $devList);
$tpl->assign('info', $info);
$tpl->assign('searchList', $searchList);
//$tpl->assign('lastSQL', $lastSQL);
$tpl->assign('roleList', $roleList);
$tpl->assign('userList', $userList);
$tpl->assign('typeList', $typeList);
$tpl->assign('devInfo', $devInfo);
$tpl->display('dev.tpl');