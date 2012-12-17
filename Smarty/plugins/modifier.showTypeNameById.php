<?php

function smarty_modifier_showTypeNameById($id) {
    $id = $id > 0 ? (int) $id : 0;
    if (!$id)
        return '未知';
     error_log(print_r($id, true), 3, 'c:/ee.txt');
    // count \r or \n characters
    $info = Type::getInfoById($id);
    if (is_array($info) && count($info)) {
        return $info['type_name'];
    } else {
        return '未知';
    }
}

/* vim: set expandtab: */
?>
