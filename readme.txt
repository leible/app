运行本系统必须搭建一个虚拟主机，方法如下
httpd.conf最后加上：
<VirtualHost 127.0.0.88:80>
#document一定要是webroot目录，不是app目录，要不然不能访问
DocumentRoot “D:/AppServ/www/app/webroot”
ServerName app.com
#ErrorLog “logs/dummy-host.x-error.log”
#CustomLog “logs/dummy-host.x-access.log” common
</VirtualHost>

用host文件做解析
找到C:/Windows/System32/drivers/etc/hosts
在结尾加上：
127.0.0.88 app.com


mysql必须开启pdo