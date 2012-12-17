<?php

function smarty_modifier_showRoleNameById($id) {
    $id = $id > 0 ? (int) $id : 0;
    if (!$id)
        return '未知';
    // error_log(print_r($id, true), 3, 'c:/ee.txt');
    // count \r or \n characters
    $info = Role::getInfoById($id);
    if (is_array($info) && count($info)) {
        return $info['role_name'];
    } else {
        return '未知';
    }
}

/* vim: set expandtab: */
?>
