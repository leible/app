<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>用户登陆</title>
        <link rel="stylesheet" href="/css/loyout.css" type="text/css" />
    </head>
    <body>
        <br /><br /><br /><br /><br /><br />
        <form action="<{$smarty.const.URL}>/login.php" method="post">

        <table border="1" width="400" height="100" cellpadding="10" cellspacing="0" align="center">

            <tr bgcolor="e6e6e6">
                <th colspan="2">设备管理系统入口</th>
            </tr>
            <tr>
                <td align="right">用户名</td>
                <td><input type="text" name="user_name" value="" size="15"></td>
            </tr>
            <tr>
                <td align="right">密码</td>
                <td><input type="password" name="password" value="" size="16"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="action" value="login" /></td>
                <td><input type="submit" value="登陆"></td>
            </tr>

        </table>
        </form>

    </body>
</html>