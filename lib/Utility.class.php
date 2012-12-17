<?php

class Utility {

    //跳转到指定地址
    public static function relocation($url) {
        header("location: $url");
        exit;
    }


    //获取当前用户IP
    public static function getRemoteIp() {
        $ip = explode(',', getenv('HTTP_X_FORWARDED_FOR') . ',' . getenv('REMOTE_ADDR') . ',' . getenv('HTTP_CLIENT_IP'));
        foreach ($ip as $v) {
            if (preg_match('/\d+\.\d+\.\d+\.\d+/', $v, $matches)) {
                return $matches[0];
            }
        }
        return '127.0.0.1';
    }

}
