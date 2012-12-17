<?php
include_once '../init.inc.php';
$action = isset($_REQUEST['action']) && $_REQUEST['action'] ? $_REQUEST['action'] : 'main';

Common::checkSession();
$module = Common::getModule();
$tpl->assign('module', $module);
$tpl->assign('action', $action);
$tpl->display('main.tpl');
