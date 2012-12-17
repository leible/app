<?php

class User {
    const TABLE_NAME = 'pre_user';
    //增加用户
    public static function addUser($user_name, $password, $rid){
        self::_checkName($user_name);
        self::_checkPassWord($password);
        $info = self::getInfoByName($user_name);
        if (is_array($info) && count($info) > 0) {
            throw new Exception('您输入的名已经存在', 1);
        }
        $data = array(
            'user_name' => $user_name,
            'password' => $password,
            'role_id' => $rid
        );
        $res = Mysql::insert(self::TABLE_NAME, $data);
        if (!$res) {
            throw new Exception('插入数据库失败', 1);
        }
    }

    public static function getAllUserList(){
        return Mysql::select(self::TABLE_NAME);
    }

    private static function _checkName($user_name) {
        $user_name = isset($user_name) ? trim($user_name) : '';
        if (!$user_name) throw new Exception('请输入用户名称！', 1);
    }

    private static function _checkPassWord($password) {
        $password = isset($password)  ? $password : '';
        if (!$password) throw new Exception('请输入密码！', 1);
    }

    public static function getInfoById($id) {
        $id = $id > 0 ? (int)$id : 0;
        if (!$id)
            throw new Exception('请选择一个操作对象', 1);

        $where = array(
            'id' => $id
        );
        return Mysql::selectOne(self::TABLE_NAME, $where);
    }

    //查找当前用户是否存在
    public static function getInfoByName($user_name) {
        $where = array(
            'user_name' => $user_name,
        );
       return Mysql::selectOne(self::TABLE_NAME, $where);
    }

    //删除用户
    public static function delUser($id){
        $id = $id > 0 ? (int)$id : 0;
        if (!$id)
            throw new Exception('请选择一个操作对象', 1);

        $where = array( 'id' => $id);
        $res = Mysql::delete(self::TABLE_NAME, $where);
        if (!$res) {
            throw new Exception('删除失败', 1);
        }
    }

    public static function updateUser($user_name, $password, $rid, $id){
        //检查用户名是否存在
        self::_checkName($user_name);
        self::_checkPassWord($password);
        $id = $id > 0 ? (int)$id : 0;
        $rid = $rid > 0 ? (int)$rid :0;
        if (!$id)
            throw new Exception('请选择一个操作对象', 1);

        if (!$rid)
            throw new Exception('请给该用户选择一个角色', 1);

        $info = self::getInfoByName($user_name);
        if (is_array($info) && (count($info) > 0) && ($info['id'] != $id)) {
            throw new Exception('用户名已经存在', 1);
            Utility::relocation('/user.php');
        }

        $where = array( 'id' => $id);
        $data = array(
            'role_id' => $rid,
            'user_name' => $user_name,
            'password' => $password
        );
        $res = Mysql::update(self::TABLE_NAME, $data, $where);
        if (!$res) {
            throw new Exception('更新失败', 1);
        }
    }

}