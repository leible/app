<?php

function smarty_modifier_showNodeNameById($ids) {
    //ids是个字符串
    if (!$ids) {
        return '没有';
    } elseif($ids == 'all') {
        return '所有权限';
    } elseif ($ids !== 'all'){

        $where = array(
            'id' => array(
                'opt' => 'in',
                'val' => $ids
            ),
            'status' => 1
        );
        //查询当前用户节点信息
        $info = Mysql::select('pre_node', $where);

        $auth = array();
        foreach ($info as $key => $value) {

            $auth[] = $value['title'];
            $authName = implode(',', $auth);

        }
        return $authName;
//        echo '<pre>';
//        var_dump($auth);
//        echo '</pre>';

    }
//    echo '<pre>';
//    var_dump($info);
//    echo '</pre>';
//    if (is_array($info) && count($info)) {
//        //return $info['node_name'];
//        return 1;
//    } else {
//        return '未知';
//    }
}

/* vim: set expandtab: */
?>
