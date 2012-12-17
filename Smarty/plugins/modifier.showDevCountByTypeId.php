<?php

function smarty_modifier_showDevCountByTypeId($type_id) {
    $type_id = $type_id > 0 ? (int)$type_id : 0;
    if (!$type_id)
        return '未知';
    // error_log(print_r($id, true), 3, 'c:/ee.txt');
    // count \r or \n characters
    $info = Dev::getCountByTypeId($type_id);
    if (!empty($info)) {
        return $info;
    } else {
        echo '0';
    }
}

/* vim: set expandtab: */
?>
