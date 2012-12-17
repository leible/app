-- phpMyAdmin SQL Dump
-- version 3.1.0
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 10 月 07 日 05:24
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mianshi`
--

-- --------------------------------------------------------

--
-- 表的结构 `pre_dev`
--

CREATE TABLE IF NOT EXISTS `pre_dev` (
  `id` int(11) NOT NULL auto_increment,
  `dev_name` varchar(50) NOT NULL COMMENT '设备名',
  `sn` varchar(50) NOT NULL COMMENT '固定资产编码',
  `type_id` tinyint(3) NOT NULL COMMENT '设备类型',
  `price` decimal(8,0) NOT NULL COMMENT '价格',
  `time` int(10) NOT NULL COMMENT '购买时间',
  `contract_sn` varchar(30) NOT NULL COMMENT '合同编号',
  `remark` varchar(255) NOT NULL COMMENT '设备描述',
  `config_info` varchar(255) NOT NULL COMMENT '设备配置明细信息',
  `buyer` varchar(50) NOT NULL COMMENT '采购者',
  `store_place` varchar(100) NOT NULL COMMENT '存放位置',
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 导出表中的数据 `pre_dev`
--

INSERT INTO `pre_dev` (`id`, `dev_name`, `sn`, `type_id`, `price`, `time`, `contract_sn`, `remark`, `config_info`, `buyer`, `store_place`, `status`) VALUES
(1, 'dell R610啊', '12312312111', 1, 18000, 1423231234, '2147483647', 'remark', 'config -u', '啊实打实倒萨', '仓库', -1),
(3, '惠普服务器1', 'fds3213', 1, 0, 1349583659, '', '', '', '456456', '', 1),
(4, 'lenovo g450', 'eb2131324', 1, 0, 1349459398, '', '', '', 'bill', '', 1),
(5, '阿萨德', '大s', 3, 0, 1349459389, '', '', '', '刚刚个人', '', 1),
(6, '有机会', '需要', 1, 0, 0, '0', '', '', '需要', '', 1),
(7, '枯顶替', '123', 3, 3245, 1349459372, '', '', '', '需要', '', 1),
(8, 'dell 服务器', 'sn-1200931', 1, 0, 0, '0', '', '', '张三', '', 1),
(9, '塔顶', 'db-12341324', 3, 0, 0, '0', '', '', '李四', '', 1),
(10, '华为S5700-24TP-SI(AC)', 'wc-123123412', 4, 0, 0, '0', '', '', 'NoName', '', 1),
(11, 'fsdfs', 'fdssdf', 3, 0, 0, '0', '', '', 'fdsfds', '', 1),
(12, '三韭菜籽', 'fsd312312', 7, 0, 0, '0', '', '', 'licy', '', 1),
(13, '大黄蜂', '9527', 4, 1573, 1349459043, '0', '机器人', '配置发生的', '哈哈', '猫猫肯', 1),
(14, 'ThinkCenter data', 'jw-9527', 3, 15880, 1349584936, 'dsf234324', '下大雨枯', '枯二压下', '土土', '水库', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pre_node`
--

CREATE TABLE IF NOT EXISTS `pre_node` (
  `id` int(5) NOT NULL auto_increment,
  `node_name` varchar(50) NOT NULL,
  `title` varchar(30) NOT NULL,
  `pid` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- 导出表中的数据 `pre_node`
--

INSERT INTO `pre_node` (`id`, `node_name`, `title`, `pid`, `status`) VALUES
(1, 'Common', '公共模块', 0, 1),
(2, 'Role', '角色模块', 0, 1),
(3, 'User', '用户模块', 0, 1),
(4, 'Type', '设备类型模块', 0, 1),
(5, 'Dev', '设备模块', 0, 1),
(6, 'list', '角色列表', 2, 1),
(7, 'add', '添加角色', 2, 1),
(8, 'del', '角色删除', 2, 1),
(9, 'modify', '角色更新', 2, 1),
(10, 'add', '添加用户', 3, 1),
(11, 'del', '用户删除', 3, 1),
(12, 'modify', '用户更新', 3, 1),
(13, 'list', '用户列表', 3, 1),
(14, 'add', '设备类型添加', 4, 1),
(15, 'del', '设备类型删除', 4, 1),
(16, 'modify', '设备类型更新', 4, 1),
(17, 'list', '设备类型列表', 4, 1),
(18, 'add', '设备添加', 5, 1),
(19, 'del', '设备删除', 5, 1),
(20, 'modify', '设备更新', 5, 1),
(21, 'list', '设备列表', 5, 1),
(22, 'scrap', '报废设备', 5, 1),
(23, 'Node', '节点模块', 0, 1),
(24, 'add', '节点增加', 23, 1),
(25, 'list', '节点列表', 23, 1),
(26, 'del', '节点删除', 23, 1),
(27, 'modify', '节点更新', 23, 1),
(28, 'search', '设备搜索', 5, 1),
(29, 'info', '查看详情', 5, 1),
(30, 'insert', 'insert', 2, 1),
(31, 'insert', 'insert', 3, 1),
(32, 'insert', 'insert', 4, 1),
(33, 'insert', 'insert', 5, 1),
(34, 'insert', 'insert', 6, 1),
(35, 'update', 'update', 2, 1),
(36, 'update', 'update', 3, 1),
(37, 'update', 'update', 4, 1),
(38, 'update', 'update', 5, 1),
(39, 'update', 'update', 6, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pre_role`
--

CREATE TABLE IF NOT EXISTS `pre_role` (
  `id` int(11) NOT NULL auto_increment,
  `role_name` varchar(90) NOT NULL,
  `node_ids` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=23 ;

--
-- 导出表中的数据 `pre_role`
--

INSERT INTO `pre_role` (`id`, `role_name`, `node_ids`) VALUES
(1, '管理员', 'all'),
(12, '用户管理', '1,3,10,11,12,13,31,36'),
(11, '设备类型管理', '1,4,14,15,16,17,32,37'),
(13, '设备管理', '1,5,18,19,20,21,22,28,29,33,38'),
(22, '用户&角色', '1,2,3,4,6,8,9,10,11,12,13,14,17,31,36,30,35'),
(21, '程序员', ''),
(19, '只能查看', '1,2,3,4,5,6,13,17,21,25');

-- --------------------------------------------------------

--
-- 表的结构 `pre_type`
--

CREATE TABLE IF NOT EXISTS `pre_type` (
  `id` int(10) NOT NULL auto_increment,
  `type_name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `pre_type`
--

INSERT INTO `pre_type` (`id`, `type_name`, `status`) VALUES
(1, '服务器', 1),
(3, '路由器', 1),
(4, '交换机', 1),
(7, '笔记本', -1);

-- --------------------------------------------------------

--
-- 表的结构 `pre_user`
--

CREATE TABLE IF NOT EXISTS `pre_user` (
  `id` int(10) NOT NULL auto_increment,
  `user_name` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `role_id` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 导出表中的数据 `pre_user`
--

INSERT INTO `pre_user` (`id`, `user_name`, `password`, `role_id`, `status`) VALUES
(1, '测试', '77e2edcc9b40441200e31dc57dbb8829', 21, 1),
(2, '孤独', '21232f297a57a5a743894a0e4a801fc3', 12, 0),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 0),
(4, '波波', 'c3284d0f94606de1fd2af172aba15bf3', 11, 0),
(6, 'comwhy', '21232f297a57a5a743894a0e4a801fc3', 12, 0),
(5, 'test', '21232f297a57a5a743894a0e4a801fc3', 22, 0),
(7, 'XXXX', 'c3284d0f94606de1fd2af172aba15bf3', 21, 0),
(8, 'ggga', 'c3284d0f94606de1fd2af172aba15bf3', 12, 0),
(9, 'admin5', 'c3284d0f94606de1fd2af172aba15bf3', 12, 0),
(10, 'testhhh', '4c14a808735abb4b205d1c8cb54ec845', 11, 0),
(11, 'testggpp', '30e937abd2e8c736ea802a7b28e9bccf', 13, 0),
(12, 'dasad', '63373b41cf913e9f9b3226b4a0452737', 12, 0),
(13, 'aaaaaaad', 'f000d24f3d158a3fc5c3cd1b43fb3555', 22, 0),
(14, 'back', '21232f297a57a5a743894a0e4a801fc3', 13, 0),
(15, 'water', '9460370bb0ca1c98a779b1bcc6861c2c', 22, 0),
(16, 'fds', '838ece1033bf7c7468e873e79ba2a3ec', 12, 0),
(17, 'user', '21232f297a57a5a743894a0e4a801fc3', 13, 0),
(18, '查看的人', '21232f297a57a5a743894a0e4a801fc3', 19, 0);
