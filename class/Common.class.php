<?php
class Common {
    const TABLE_NAME = 'pre_user';
    //验证登录账号
    public static function checkLogin ($user_name, $password) {

        self::_checkUserName($user_name);
        self::_checkPassWord($password);
        $info = self::getInfoByUserName($user_name);
        //var_dump($info);
        if (is_array($info) && ($info['user_name'] == $user_name) && ($info['password'] == $password)) {
            $_SESSION['uname'] = $info['user_name'];
            $_SESSION['uid'] = $info['id'];
            $_SESSION['role_id'] = $info['role_id'];
        } else {
            throw new Exception('用户名和密码不匹配', 1);
            Utility::relocation(URL.'/index.php');
        }
    }

    private static function _checkUserName($user_name) {
        $user_name = isset($user_name) ? trim($user_name) : '';
        if (!$user_name) throw new Exception('请填写用户名', 1);
    }

    private static function _checkPassWord($password) {
        $password = isset($password) ? trim($password) : '';
        if (!$password) throw new Exception('请填写密码', 1);
    }

    public static function getInfoByUserName($user_name) {
        $where = array(
            'user_name' => $user_name
        );
        return Mysql::selectOne(self::TABLE_NAME, $where);
    }

    public static function getInfoByPassWord($password) {
        $where = array(
            'password' => $password
        );
        return Mysql::selectOne(self::TABLE_NAME, $where);
    }

    public static function loginOut(){
        unset($_SESSION);
        session_destroy();
        //Utility::relocation(URL.'/index.php');

    }

    //判断session
    public static function checkSession() {
        if ($_SESSION['uid'] == 0) {
            Utility::relocation(URL . '/login.php');
        }
    }

    //获取模块名
    public static function getModule() {
        $module = explode('.', trim($_SERVER['SCRIPT_NAME'], '/'));
        $m = $module[0];

        //在这里直接写，不请求数据库了
        $name = array(
            'user' => '用户模块',
            'dev' => '设备模块',
            'type' => '设备类型模块',
            'role' => '角色模块',
            'node' => '节点模块',
            'common' => '公共模块'
        );

        if($m == 'dev'){
            return $name['dev'];
        } elseif ($m == 'type') {
            return $name['type'];
        } elseif ($m == 'user') {
            return $name['user'];
        } elseif ($m == 'role') {
            return $name['role'];
        } elseif ($m == 'node') {
            return $name['node'];
        } elseif ($m == 'common') {
            return $name['common'];
        } else {
            return '未知';
        }

    }

    /*
     * $code    错误号
     * $msg     错误信息
     * $url     定向地址
     */
    public static function returnMsg($code,$msg,$url='index.php'){
        
        echo '<script>';
        if ($code) {
            echo 'alert("'.$msg.'")';
        } else {
            echo 'window.location.href="'.URL.'/'.$url.'"';
        }
        echo '</script>';


    }

}