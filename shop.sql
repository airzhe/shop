-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 02 月 20 日 16:58
-- 服务器版本: 5.5.35
-- PHP 版本: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `shop`
--

-- --------------------------------------------------------

--
-- 表的结构 `hd_g_attr`
--

CREATE TABLE IF NOT EXISTS `hd_g_attr` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(45) NOT NULL DEFAULT '' COMMENT '属性名称',
  `show_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '显示\n1 文本框\n2 下拉列表框',
  `is_spec` tinyint(4) NOT NULL COMMENT '是否为规格属性\n1 是\n2 不是（普通属性）',
  `tid` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`aid`),
  KEY `fk_hd_g_attr_class_hd_g_goods_type_idx` (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='属性分类表' AUTO_INCREMENT=32 ;

--
-- 转存表中的数据 `hd_g_attr`
--

INSERT INTO `hd_g_attr` (`aid`, `attr_name`, `show_type`, `is_spec`, `tid`) VALUES
(25, '操作系统', 2, 0, 3),
(24, '屏幕', 1, 0, 3),
(23, '适应季节', 2, 0, 1),
(22, '适应人群', 3, 0, 1),
(21, '款式', 4, 0, 1),
(31, '尺寸', 3, 1, 1),
(30, '颜色', 3, 1, 1),
(20, '产地', 1, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `hd_g_attr_value`
--

CREATE TABLE IF NOT EXISTS `hd_g_attr_value` (
  `av_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attr_value` char(30) NOT NULL DEFAULT '' COMMENT '属性值',
  `aid` int(11) NOT NULL COMMENT '与属性类型表的关联字段',
  PRIMARY KEY (`av_id`,`aid`),
  KEY `fk_hd_g_attr_value_hd_g_attr_class1_idx` (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='属性值' AUTO_INCREMENT=117 ;

--
-- 转存表中的数据 `hd_g_attr_value`
--

INSERT INTO `hd_g_attr_value` (`av_id`, `attr_value`, `aid`) VALUES
(116, '北京', 20),
(115, 'XXXL', 31),
(114, 'XXX', 31),
(113, 'XX', 31),
(112, 'X', 31),
(111, '蓝', 30),
(110, '绿', 30),
(95, 'win8', 25),
(94, 'ios', 25),
(93, '安卓', 25),
(92, '4.0', 24),
(91, '冬季', 23),
(90, '秋季', 23),
(89, '夏季', 23),
(88, '春季', 23),
(87, '青年', 22),
(86, '中年', 22),
(85, '少年', 22),
(84, '短款', 21),
(83, '长款', 21),
(109, '红', 30);

-- --------------------------------------------------------

--
-- 表的结构 `hd_g_brand`
--

CREATE TABLE IF NOT EXISTS `hd_g_brand` (
  `bid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bname` varchar(45) DEFAULT NULL COMMENT '品牌名称',
  `logo` varchar(255) DEFAULT NULL COMMENT '品牌标志',
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='品牌表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `hd_g_brand`
--

INSERT INTO `hd_g_brand` (`bid`, `bname`, `logo`) VALUES
(4, 'nike', 'uploads/brand/f3_brand_1.png'),
(5, 'adidas', 'uploads/brand/f3_brand_2.png'),
(6, 'canon', 'uploads/brand/f6_brand_9.png'),
(7, 'sony', 'uploads/brand/f6_brand_2.png'),
(8, 'apple', 'uploads/brand/images.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `hd_g_brand_category`
--

CREATE TABLE IF NOT EXISTS `hd_g_brand_category` (
  `bid` int(10) unsigned NOT NULL COMMENT '品牌关联字段',
  `cid` smallint(5) unsigned NOT NULL COMMENT '栏目关联字段',
  PRIMARY KEY (`bid`,`cid`),
  KEY `fk_hd_g_brand_has_hd_g_category_hd_g_category2_idx` (`cid`),
  KEY `fk_hd_g_brand_has_hd_g_category_hd_g_brand2_idx` (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='品牌栏目关联表';

--
-- 转存表中的数据 `hd_g_brand_category`
--

INSERT INTO `hd_g_brand_category` (`bid`, `cid`) VALUES
(4, 9),
(4, 10),
(4, 23),
(5, 9),
(5, 10),
(5, 19),
(5, 23),
(6, 19),
(7, 12),
(7, 17),
(7, 19),
(8, 22);

-- --------------------------------------------------------

--
-- 表的结构 `hd_g_category`
--

CREATE TABLE IF NOT EXISTS `hd_g_category` (
  `cid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cname` char(45) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父级栏目',
  `keywords` varchar(80) DEFAULT NULL COMMENT '栏目关键字',
  `description` varchar(255) DEFAULT NULL COMMENT '栏目描述',
  `cat_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '栏目类型 1 普通栏目（可以添加商品中）2 封面栏目（不能添加商品）',
  `unit` varchar(45) NOT NULL DEFAULT '' COMMENT '单位',
  `price_range` tinyint(4) NOT NULL DEFAULT '0' COMMENT '价格区间数',
  `tid` smallint(5) unsigned NOT NULL COMMENT '与商品类型表关联的外键',
  PRIMARY KEY (`cid`),
  KEY `fk_hd_g_category_hd_g_goods_type1_idx` (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品栏目表' AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `hd_g_category`
--

INSERT INTO `hd_g_category` (`cid`, `cname`, `pid`, `keywords`, `description`, `cat_type`, `unit`, `price_range`, `tid`) VALUES
(10, '西装', 9, '', '', 2, '件', 5, 1),
(9, '服装', 0, '', '', 2, '个', 5, 1),
(11, '韩版西装', 0, '', '', 2, '套', 5, 1),
(12, '手机', 0, '', '', 1, '个', 5, 2),
(13, '老人手机', 12, '', '', 1, '个', 5, 1),
(14, '韩版西装', 9, '呵呵', '', 1, '套', 7, 1),
(23, '运动服', 9, '', '', 1, '个', 5, 1),
(17, '安卓', 12, '', '', 1, '个', 5, 3),
(19, 'htc', 13, 'htc的确定', 'htc的的', 1, '个', 5, 3),
(22, 'iphone', 12, '', '', 1, '个', 5, 3);

-- --------------------------------------------------------

--
-- 表的结构 `hd_g_goods`
--

CREATE TABLE IF NOT EXISTS `hd_g_goods` (
  `gid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gname` char(100) NOT NULL DEFAULT '' COMMENT '商品的名称',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `stock` mediumint(9) NOT NULL DEFAULT '0' COMMENT '总库存',
  `goods_sn` varchar(45) NOT NULL DEFAULT '' COMMENT '商品货号(买家不可见）',
  `keywords` varchar(80) DEFAULT NULL COMMENT '商品关键字(seo)',
  `description` varchar(255) DEFAULT NULL COMMENT '商品描述',
  `body` text COMMENT '商品内容介绍',
  `service` text COMMENT '售后服务',
  `click` int(11) NOT NULL DEFAULT '0' COMMENT '查看次数',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '上架时间',
  `flag` set('推荐','置顶') DEFAULT NULL COMMENT '商品属性',
  `pic` varchar(255) DEFAULT NULL COMMENT '原始图片 ',
  `index_pic` varchar(255) DEFAULT NULL COMMENT '首页展示图片 ',
  `list_pic` varchar(255) DEFAULT NULL COMMENT '列表页展示图片 ',
  `cid` smallint(5) unsigned NOT NULL COMMENT '商品所在栏目的cid',
  `brand_bid` int(10) unsigned NOT NULL COMMENT '品牌id',
  `admin_aid` int(10) unsigned NOT NULL COMMENT '管理员aid',
  PRIMARY KEY (`gid`),
  KEY `fk_hd_g_goods_hd_g_category1_idx` (`cid`),
  KEY `fk_hd_g_goods_hd_g_brand1_idx` (`brand_bid`),
  KEY `fk_hd_g_goods_hd_g_admin1_idx` (`admin_aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `hd_g_goods`
--

INSERT INTO `hd_g_goods` (`gid`, `gname`, `price`, `stock`, `goods_sn`, `keywords`, `description`, `body`, `service`, `click`, `addtime`, `flag`, `pic`, `index_pic`, `list_pic`, `cid`, `brand_bid`, `admin_aid`) VALUES
(2, 'iphone 5', 50000.00, 0, '', '', '', '', '', 1000, 0, '推荐', 'images/201402/source_img/d915b1103ac5ac67c83d6472cf5f5f6b.jpg', 'images/201402/index_thumb/d915b1103ac5ac67c83d6472cf5f5f6b.jpg', 'images/201402/list_thumb/d915b1103ac5ac67c83d6472cf5f5f6b.jpg', 22, 0, 0),
(3, '运动服', 100.00, 1000, '', '', '', '', '', 100, 0, '推荐', NULL, NULL, NULL, 0, 0, 0),
(4, 'iphone 5', 0.00, 0, '', '', '', '', '', 100, 1392465460, '推荐', NULL, NULL, NULL, 11, 0, 0),
(5, '学生西装', 0.00, 0, '', '', '', '', '', 100, 1392466613, '推荐', NULL, NULL, NULL, 11, 0, 0),
(6, '学生西装', 0.00, 0, '', '', '', '', '', 100, 1392466929, '推荐', NULL, NULL, NULL, 11, 0, 0),
(7, '学生西装', 0.00, 0, '', '', '', '', '', 100, 1392466929, '推荐', NULL, NULL, NULL, 11, 0, 0),
(8, '学生西装', 0.00, 0, '', '', '', '', '', 100, 1392467755, '推荐', NULL, NULL, NULL, 11, 0, 0),
(9, '学生西装', 0.00, 0, '', '', '', '', '', 100, 1392469121, '推荐', NULL, NULL, NULL, 11, 0, 0),
(10, '学生西装', 0.00, 0, '', '', '', '', '', 100, 1392469121, '推荐', NULL, NULL, NULL, 11, 0, 0),
(11, '学生西装', 0.00, 0, '', '', '', '', '', 100, 1392469121, '推荐', NULL, NULL, NULL, 11, 0, 0),
(12, '学生西装', 0.00, 0, '', '', '', '', '', 100, 1392469121, '推荐', NULL, NULL, NULL, 11, 0, 0),
(13, '学生西装', 0.00, 0, '', '', '', '', '', 100, 1392469263, '推荐', NULL, NULL, NULL, 11, 0, 0),
(14, '学生西装', 0.00, 0, '', '', '', '', '', 100, 1392469534, '推荐', NULL, NULL, NULL, 11, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `hd_g_goods_attr`
--

CREATE TABLE IF NOT EXISTS `hd_g_goods_attr` (
  `ga_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attr_value` varchar(45) NOT NULL DEFAULT '' COMMENT '属性值',
  `category_cid` smallint(5) unsigned NOT NULL COMMENT '栏目id',
  `goods_gid` int(10) unsigned NOT NULL COMMENT '商品gid',
  `attr_value_av_id` int(10) unsigned NOT NULL COMMENT '属性值id',
  PRIMARY KEY (`ga_id`),
  KEY `fk_hd_g_goods_attr_hd_g_category1_idx` (`category_cid`),
  KEY `fk_hd_g_goods_attr_hd_g_goods1_idx` (`goods_gid`),
  KEY `fk_hd_g_goods_attr_hd_g_attr_value1_idx` (`attr_value_av_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品属性表' AUTO_INCREMENT=77 ;

--
-- 转存表中的数据 `hd_g_goods_attr`
--

INSERT INTO `hd_g_goods_attr` (`ga_id`, `attr_value`, `category_cid`, `goods_gid`, `attr_value_av_id`) VALUES
(29, '短款', 11, 7, 84),
(28, '北京', 11, 6, 116),
(27, '短款', 11, 6, 84),
(26, '北京', 11, 5, 116),
(25, '短款', 11, 5, 84),
(24, '北京', 11, 4, 116),
(23, '短款', 11, 4, 84),
(22, '北京', 11, 3, 116),
(21, '短款', 11, 3, 84),
(30, '北京', 11, 7, 116),
(31, '短款', 11, 8, 84),
(32, '北京', 11, 8, 116),
(33, '短款', 11, 9, 84),
(34, '北京', 11, 9, 116),
(35, '短款', 11, 10, 84),
(36, '北京', 11, 10, 116),
(37, '短款', 11, 11, 84),
(38, '北京', 11, 11, 116),
(39, '短款', 11, 12, 84),
(40, '北京', 11, 12, 116),
(41, '短款', 11, 13, 84),
(42, '北京', 11, 13, 116),
(43, '短款', 11, 14, 84),
(44, '北京', 11, 14, 116),
(45, '4.0', 17, 2, 92),
(46, '4.0', 19, 2, 92),
(47, '4.0', 17, 2, 92),
(48, '短款', 23, 3, 84),
(49, '北京', 23, 3, 116),
(50, '短款', 0, 3, 84),
(51, '北京', 0, 3, 116),
(52, '4.0', 0, 2, 92),
(53, '4.0', 22, 2, 92),
(54, '4.0', 0, 2, 92),
(55, '安卓', 22, 2, 93),
(56, '4.0', 22, 2, 92),
(57, '4.0', 0, 2, 92),
(58, '4.0', 23, 2, 92),
(59, '短款', 22, 2, 84),
(60, '北京', 22, 2, 116),
(61, '4.0', 22, 2, 92),
(62, '4.0', 22, 2, 92),
(63, '4.0', 22, 2, 92),
(64, '4.0', 22, 2, 92),
(65, '4.0', 22, 2, 92),
(66, '4.0', 22, 2, 92),
(67, '4.0', 22, 2, 92),
(68, '4.0', 22, 2, 92),
(69, '4.0', 22, 2, 92),
(70, '4.0', 22, 2, 92),
(71, '4.0', 22, 2, 92),
(72, '4.0', 22, 2, 92),
(73, '4.0', 22, 2, 92),
(74, '4.0', 22, 2, 92),
(75, '4.0', 22, 2, 92),
(76, '4.0', 22, 2, 92);

-- --------------------------------------------------------

--
-- 表的结构 `hd_g_goods_pic`
--

CREATE TABLE IF NOT EXISTS `hd_g_goods_pic` (
  `pic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `big` varchar(255) DEFAULT NULL COMMENT '大图',
  `medium` varchar(255) DEFAULT NULL COMMENT '中图',
  `small` varchar(255) DEFAULT NULL COMMENT '小图',
  `goods_gid` int(10) unsigned NOT NULL COMMENT '商品的gid(与商品表关联)',
  PRIMARY KEY (`pic_id`),
  KEY `fk_hd_g_goods_pic_hd_g_goods1_idx` (`goods_gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='内容页展示图片（局部放大的图片3张图)' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `hd_g_goods_pic`
--

INSERT INTO `hd_g_goods_pic` (`pic_id`, `big`, `medium`, `small`, `goods_gid`) VALUES
(1, 'images/201402/goods_big/4adf6e2e4815b89070af61c169357b9c.jpg', 'images/201402/goods_medium/4adf6e2e4815b89070af61c169357b9c.jpg', 'images/201402/goods_small/4adf6e2e4815b89070af61c169357b9c.jpg', 2),
(2, 'images/201402/goods_big/747d518d6809b4c7db56e06b5b1c394b.jpg', 'images/201402/goods_medium/747d518d6809b4c7db56e06b5b1c394b.jpg', 'images/201402/goods_small/747d518d6809b4c7db56e06b5b1c394b.jpg', 2);

-- --------------------------------------------------------

--
-- 表的结构 `hd_g_goods_type`
--

CREATE TABLE IF NOT EXISTS `hd_g_goods_type` (
  `tid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `gtname` char(45) NOT NULL COMMENT '商品类型ID',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品类型表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `hd_g_goods_type`
--

INSERT INTO `hd_g_goods_type` (`tid`, `gtname`) VALUES
(1, '服装'),
(2, '家电'),
(3, '手机'),
(4, '电脑');

-- --------------------------------------------------------

--
-- 表的结构 `hd_g_settings`
--

CREATE TABLE IF NOT EXISTS `hd_g_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL,
  `name` char(100) NOT NULL,
  `value` char(255) NOT NULL,
  `conf` char(50) NOT NULL,
  `show_type` tinyint(1) NOT NULL COMMENT '1、input 2、radio',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `hd_g_settings`
--

INSERT INTO `hd_g_settings` (`id`, `title`, `name`, `value`, `conf`, `show_type`) VALUES
(1, '网站标题', 'hdsop', 'hehesss', '', 1),
(2, '网站开关', 'is_open', '0', '0:关闭,1:开启', 2),
(4, ' 首页缩略图宽度', 'index_thumb_width', '200', '', 1),
(5, ' 首页缩略图高度', 'index_thumb_height', '200', '', 1),
(6, '列表页缩略图宽度', 'list_thumb_width', '150', '', 1),
(7, '列表页缩略图高度', 'list_thumb_height', '150', '', 1),
(8, '产品大图宽度', 'goods_big_width', '800', '', 1),
(9, '产品大图高度', 'goods_big_height', '800', '', 1),
(10, '产品中图宽度', 'goods_medium_width', '350', '', 1),
(11, '产品中图高度', 'goods_medium_height', '350', '', 1),
(12, '产品小图宽度', 'goods_small_width', '50', '', 1),
(13, '产品小图高度', 'goods_small_height', '50', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `hd_g_stock`
--

CREATE TABLE IF NOT EXISTS `hd_g_stock` (
  `st_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `stock` mediumint(9) DEFAULT NULL COMMENT '库存数量',
  `goods_sn` varchar(45) DEFAULT NULL COMMENT '商品货号',
  `goods_gid` int(10) unsigned NOT NULL COMMENT '商品gid(与商品表关联）',
  PRIMARY KEY (`st_id`),
  KEY `fk_hd_g_stock_hd_g_goods1_idx` (`goods_gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品库存表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `hd_g_stock`
--

INSERT INTO `hd_g_stock` (`st_id`, `price`, `stock`, `goods_sn`, `goods_gid`) VALUES
(1, 2.00, 1, '3', 14),
(2, 5.00, 4, '6', 14),
(3, 0.00, 0, '', 3),
(4, 0.00, 0, '', 3),
(5, 0.00, 0, '', 2);

-- --------------------------------------------------------

--
-- 表的结构 `hd_g_stock_attr`
--

CREATE TABLE IF NOT EXISTS `hd_g_stock_attr` (
  `sa_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_cid` smallint(5) unsigned NOT NULL COMMENT '栏目cid',
  `goods_gid` int(10) unsigned NOT NULL COMMENT '商品gid',
  `attr_value_av_id` int(10) unsigned NOT NULL COMMENT '属性值av_id',
  `stock_st_id` int(10) unsigned NOT NULL COMMENT '库存id',
  PRIMARY KEY (`sa_id`),
  KEY `fk_hd_g_stock_attr_hd_g_category1_idx` (`category_cid`),
  KEY `fk_hd_g_stock_attr_hd_g_goods1_idx` (`goods_gid`),
  KEY `fk_hd_g_stock_attr_hd_g_attr_value1_idx` (`attr_value_av_id`),
  KEY `fk_hd_g_stock_attr_hd_g_stock1_idx` (`stock_st_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='库存属性关联表' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `hd_g_stock_attr`
--

INSERT INTO `hd_g_stock_attr` (`sa_id`, `category_cid`, `goods_gid`, `attr_value_av_id`, `stock_st_id`) VALUES
(1, 11, 14, 113, 1),
(2, 11, 14, 110, 1),
(3, 11, 14, 112, 2),
(4, 11, 14, 109, 2),
(5, 23, 3, 115, 3),
(6, 23, 3, 111, 3),
(7, 0, 3, 115, 4),
(8, 0, 3, 111, 4),
(9, 22, 2, 115, 5),
(10, 22, 2, 111, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
