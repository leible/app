<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>设备管理系统</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <link rel="stylesheet" href="/css/layout.css" type="text/css" />

    </head>
    <body class="top">
        <div class="Content">
            <div class="title">设备管理系统</div>
            <div class="tab">
                <a href="<{$smarty.const.URL}>/menu.php?action=app" target="menu">功能</a>
                <a href="<{$smarty.const.URL}>/menu.php?action=remark" target="menu">介绍</a>
                <a href="<{$smarty.const.URL}>/login.php?action=loginout" target="_parent">退出</a>
                <span class="uname">亲爱的 <font color="red"><{$uname}></font> ，欢迎登录 ^_^ | uid:<{$uid}> | role_id: <{$role_id}></span>
            </div>

        </div>
    </body>
</html>