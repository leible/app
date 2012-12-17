<?php

include '../init.inc.php';

Common::checkSession();

$tpl->assign('uname',$_SESSION['uname']);
$tpl->assign('uid', $_SESSION['uid']);
$tpl->assign('role_id', $_SESSION['role_id']);


$tpl->display('top.tpl');