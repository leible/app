<?php

//require_once  './lib/Mysql.class.php';
class Role {

    const TABLE_NAME = 'pre_role';

    public static function addRole($name) {
        self::_checkName($name);
        $info = self::getInfoByName($name);
        if (is_array($info) && (count($info) > 0)) {
            throw new Exception('角色名称已存在！', 1);
        }
        $data = array(
            'role_name' => $name,
        );
        $res = Mysql::insert(self::TABLE_NAME, $data);
        if (!$res)
            throw new Exception('插入数据库失败！', 1);
    }

    public static function getAllRoleList() {
        return Mysql::select(self::TABLE_NAME);
    }

    private static function _checkName($name) {
        $name = $name ? trim($name) : '';
        if (!$name)
            throw new Exception('请输入角色名称！', 1);
    }


    //权限验证
    public static function auth($action) {
        $model = explode('.', trim($_SERVER['SCRIPT_NAME'], '/'));
        //过滤不用验证的模块
        $c = $GLOBALS["CONFIG"];
//        var_dump($c);
//        var_dump($model);
//        echo $model[0];//模块名
        if (in_array($model[0], $c['NOT_LOGIN'])) {
            return;
        }
        //开始验证登录
        Common::checkSession();

        if (in_array($model[0], $c['NOT_AUTH'])) {
            return;
        }

        //查询角色
        $role = Role::getInfoById($_SESSION['role_id']);
        //获取节点id

        $access = $role['node_ids'];
//        echo '<pre>';
//        var_dump($access);
//        echo '</pre>';

        $where = array(
            'id' => array(
                'opt' => 'in',
                'val' => $access
            ),
            'status' => 1
        );
        //查询当前用户节点信息
        $node = Mysql::select('pre_node', $where);
//        echo '<pre>';
//        var_dump($node);
//        echo '</pre>';


        //处理数据
        $auth = array();
        foreach ($node as $key => $value) {
            if ($value['pid'] == 0) {
                $auth[$value['id']] = array('node_name' => $value['node_name']);
            } else {
                $auth[$value['pid']][] = array('node_name' => $value['node_name']);
            }
        }
//        echo '<pre>';
//        var_dump($auth);
//        echo '</pre>';
        $list = array();
        foreach ($auth as $key => $value) {

            foreach ($value as $k => $v) {
                if (is_array($v)) {
                    $list[$value['node_name']][ $v['node_name']] = $v['node_name'];
                }
            }
        }
//        echo '<pre>';
//        var_dump($list);
//        echo '</pre>';

        //管理员的权限为all 如果是all就跨过权限
        if (isset($list[ucfirst($model[0])][$action]) || $access == 'all') {
            //echo $model . '我有权限额！';
        } else {
            exit('对不起，你没有此权限额！') ;
        }
    }

    //



    public static function getInfoById($id) {
        $id = $id > 0 ? (int) $id : 0;
        if (!$id) {
            throw new Exception('请选择一个操作对象', 1);
        }
        return Mysql::selectOne(self::TABLE_NAME, array('id' => $id));
    }

    public static function getInfoByName($name) {
        $where = array(
            'role_name' => $name,
        );
        return Mysql::selectOne(self::TABLE_NAME, $where);
    }

    //删除角色
    public static function delRole($id) {
        $id = $id > 0 ? (int) $id : 0;
        if (!$id) {
            throw new Exception('请选择一个操作对象', 1);
        }
        $where = array('id' => $id);
        $res = Mysql::delete(self::TABLE_NAME, $where);
        if (!$res) {
            throw new Exception('删除失败', 1);
        }
    }

    //更新角色
    public static function updateRole($name, $id) {
        self::_checkName($name);
        $id = $id > 0 ? (int) $id : 0;
        if (!$id) {
            throw new Exception('请选择一个操作对象', 1);
        }
        $info = self::getInfoByName($name);
        //var_dump($info);
        if (is_array($info) && (count($info) > 0) && ($info['id'] != $id)) {
            throw new Exception('角色名已经存在', 1);
        }

        $where = array('id' => $id);
        $data = array(
            'role_name' => $name
        );
        $res = Mysql::update(self::TABLE_NAME, $data, $where);
        if (!$res) {
            throw new Exception('更新失败', 1);
        }
    }

    public function __call($name, $arguments) {
        echo '您请求的方法' . $name . '不存在';
    }

}

?>
