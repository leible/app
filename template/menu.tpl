<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>设备管理系统</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <link rel="stylesheet" href="/css/layout.css" type="text/css" />

    </head>

    <body class="menu">
        <div>
        <{if $action eq 'app'}>
        <ul>
            <li>
                <h3>用户管理</h3>
                <ul>
                    <li><a class="ulul" href="<{$smarty.const.URL}>/user.php" target="main">用户列表</a></li>
                    <li><a class="ulul" href="<{$smarty.const.URL}>/user.php?action=add" target="main">增加用户</a></li>
                </ul>
            </li>
            <li>
                <h3>角色管理</h3>
                <ul>
                    <li><a class="ulul" href="<{$smarty.const.URL}>/role.php" target="main">角色列表</a></li>
                    <li><a class="ulul" href="<{$smarty.const.URL}>/role.php?action=add" target="main">增加角色</a></li>
                </ul>
            </li>
            <li>
                <h3>设备类型管理</h3>
                <ul>
                    <li><a class="ulul" href="<{$smarty.const.URL}>/type.php" target="main">设备类型列表</a></li>
                    <li><a class="ulul" href="<{$smarty.const.URL}>/type.php?action=add" target="main">自定义设备类型</a></li>
                </ul>
            </li>
            <li>
                <h3>设备管理</h3>
                <ul>
                    <li><a class="ulul" href="<{$smarty.const.URL}>/dev.php" target="main">设备列表</a></li>
                    <li><a class="ulul" href="<{$smarty.const.URL}>/dev.php?action=add" target="main">增加设备</a></li>
                </ul>
            </li>

        </ul>
        <{else}>
        <ul>
            <li>
                <h3>项目需求</h3>
                <ul>
                    <li><a class="ulul" href="<{$smarty.const.URL}>/main.php" target="main">项目需求</a></li>
                    <li><a class="ulul" href="<{$smarty.const.URL}>/main.php?action=remark" target="main">项目描述</a></li>
                </ul>
            </li>
        </ul>
        <{/if}>
        </div>

    </body>
</html>
