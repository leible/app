<?php
//require_once  './lib/Mysql.class.php';
class Type {
    const TABLE_NAME = 'pre_type';

    public static function addType($name) {
        self::_checkName($name);
        $info = self::getInfoByName($name);
        if (is_array($info) && (count($info) > 0)) {
            throw new Exception('角色名称已存在！', 1);
        }
        $data = array(
            'type_name' => $name,
        );
        $res = Mysql::insert(self::TABLE_NAME, $data);
        if (!$res) throw new Exception('插入数据库失败！', 1);
    }

    public static function getAllTypeList(){
        return Mysql::select(self::TABLE_NAME);
    }

    //获取没有禁用的类型
    public static function getNormaTypeList(){
        $where = array(
            'status' => 1
        );
        return Mysql::select(self::TABLE_NAME, $where);
    }

    private static function _checkName($name) {
        $name = $name ? trim($name) : '';
        if (!$name) throw new Exception('请输入类型名称！', 1);

    }

    public static function getInfoById($id) {
        $id = $id > 0 ? (int)$id : 0;
        if (!$id) {
            throw new Exception('请选择一个操作对象', 1);
        }
        return Mysql::selectOne(self::TABLE_NAME, array('id' => $id));
    }

    public static function getInfoByName($name) {
        $where = array(
            'type_name' => $name,
        );
       return Mysql::selectOne(self::TABLE_NAME, $where);
    }

    public static function delType($id){
        $id = $id > 0 ? (int)$id : 0;
        if (!$id) {
            throw new Exception('请选择一个操作对象', 1);
        }
        $where = array( 'id' => $id);
        $res = Mysql::delete(self::TABLE_NAME, $where);
        if (!$res) {
            throw new Exception('删除失败', 1);
        }
    }

    public static function updateType($id, $name, $status){
        self::_checkName($name);
        $id = $id > 0 ? (int)$id : 0;
        if (!$id) {
            throw new Exception('请选择一个操作对象', 1);
        }
        $status = $status > 0 ? 1 : -1;

        $info = self::getInfoByName($name);
        if (is_array($info) && (count($info) > 0) && ($info['id'] != $id)) {
            throw new Exception('类型名已经存在', 1);
        }

        $where = array( 'id' => $id);
        $data = array(
            'type_name' => $name,
            'status' => $status
        );
        $res = Mysql::update(self::TABLE_NAME, $data, $where);
        if (!$res) {
            throw new Exception('更新失败', 1);
        }
    }
    //禁用设备类型
    public static function forbiddenType($id){
        $id = $id > 0 ? (int)$id : 0;
        if (!$id) {
            throw new Exception('请选择一个操作对象', 1);
        }
        $where = array(
            'id' => $id
        );
        $data = array(
            'status' => -1
        );
        $res = Mysql::update(self::TABLE_NAME, $data, $where);
        if (!$res) {
            throw new Exception('禁用失败', 1);
        }
    }


    public function __call($name, $arguments) {
        echo '您请求的方法'.$name.'不存在';
    }
}

?>
