    <{include file="header.tpl"}>
    <{if $action eq 'remark'}>
    <pre>
项目介绍
本项目是一个简单设备管理系统，实现了设备的增删改查，自定义设备类型，统计该设备类型下面的设备数目，
按设备属性，类型，状态 搜索设备，报废设备，用户管理，角色-权限控制。

    webroot为本项目的根目录，这样做的好处是访问访问者只能通过webroot来访问网站的内容
    不能通过别的方式，访问项目webroot这上的目录大大增加了网站的安全性，既然这样，那么自己
    的css也不能放在网站模板目录下面了。所以只能放在webroot下面。

       数据库设计
       user表role_id和角色表关联
       role角色表node_ids和节点表关联
       node存放网站module和它的action 用pid关联
       type设备类型
       dev设备表type_id和设备类型表关联

       网站编码方式：类下的方法全部写成静态，这样调用效率较高
       网站内容增删改查用class目录里面的相应的类来操作

       网站权限用每一个操作的action的值来和该用户role_id所在mode_ids来验证是否有效
       验证的位置在init.inc.php  Role::role_auth()方法下面

       网站权限的机制基本实现，是在数据库中手动添加实现的，角色的权限的增删改没有来得急做

       admin拥有所有的权限
       其他账号的密码都是admin

    感谢阅读
														2012-10-7
														郑中山
														电话15910537407

    </pre>
    <{else}>
    <div style="width:800px; height:550px; background:#fff;margin:10px 0;">
        <pre>
设备管理系统项目需求
一、	需求概述
某公司拥有很多种设备，主要有服务器，交换机，路由器等。以前都是手工用电子表格管理，
记录设备的名称，固定资产编码，购买价格，购买时间，合同编号，设备描述，设备配置明细信息，
采购者，设备存放位置等。随着公司业务的增加，设备已经有上万台，手工管理数据分散在excel表
格中，管理和查询及设备盘点都很不方便。因此需要开发一套系统来管理公司的各类设备。
二、功能需求
1)	能够按设备类型来添加设备。支持自定义设备类型。
2)	能够按设备类型统计设备数据。
3)	按设备属性查询设备，可以查看设备详细信息。
4)	可以报废设备。
5）根据用户的级别不同，需要不同的权限管理，设备管理员拥有最大权限，而且查询人员只能有查询权限。
三、实现要求
a)	根据需求，设计出需要的数据表。（提示：至少需要设备类型表，设备表，用户表）
b)	由于是原型系统，界面可以简陋一点。
c)	至少要实现以下几个模块
1)	用户登录，可以没有权限管理，但需要考虑此需求，实现更好
2)	添加设备
3)	设备列表（含查询功能）

其他不作要求，用户数据可以直接在数据库手工造些数据。
四、代码要求
1）	系统源代码要求自己独立完成。提交源代码的时候需要带上数据库设计。
2）	由于是考查项目，不允许使用PHP框架。但js允许使用框架。
3）	可以使用smarty把PHP代码与html分离。
        </pre>

    </div>
    <{/if}>
    <{include file="footer.tpl"}>