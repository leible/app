<?php
include '../init.inc.php';

Common::checkSession();

$action = $_REQUEST['action'] ? $_REQUEST['action'] : 'app';

$tpl->assign('action', $action);

$tpl->display('menu.tpl');
