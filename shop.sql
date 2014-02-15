-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 02 月 15 日 14:24
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='品牌表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `hd_g_brand`
--

INSERT INTO `hd_g_brand` (`bid`, `bname`, `logo`) VALUES
(4, 'nike', 'uploads/brand/f3_brand_1.png'),
(5, 'adidas', 'uploads/brand/f3_brand_2.png'),
(6, 'canon', 'uploads/brand/f6_brand_9.png'),
(7, 'sony', 'uploads/brand/f6_brand_2.png');

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
(5, 9),
(5, 10),
(5, 19),
(6, 17),
(7, 12),
(7, 17),
(7, 19);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品栏目表' AUTO_INCREMENT=22 ;

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
(17, '安卓', 12, '', '', 1, '个', 5, 3),
(19, 'htc', 13, 'htc的确定', 'htc的的', 1, '个', 5, 3);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `hd_g_goods`
--

INSERT INTO `hd_g_goods` (`gid`, `gname`, `price`, `stock`, `goods_sn`, `keywords`, `description`, `body`, `service`, `click`, `addtime`, `flag`, `pic`, `index_pic`, `list_pic`, `cid`, `brand_bid`, `admin_aid`) VALUES
(20, '学生西装', 100.00, 1000, '', '', '', '', '', 100, 1392364280, '推荐,置顶', NULL, NULL, NULL, 14, 0, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品属性表' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `hd_g_goods_attr`
--

INSERT INTO `hd_g_goods_attr` (`ga_id`, `attr_value`, `category_cid`, `goods_gid`, `attr_value_av_id`) VALUES
(14, '郑州', 14, 20, 82),
(13, '长款', 14, 20, 83),
(12, '少年', 14, 20, 85),
(11, '中年', 14, 20, 86),
(10, '青年', 14, 20, 87),
(9, '秋季', 14, 20, 90);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `hd_g_settings`
--

INSERT INTO `hd_g_settings` (`id`, `title`, `name`, `value`, `conf`, `show_type`) VALUES
(1, '网站标题', 'hdsop', 'hehesss', '', 1),
(2, '网站开关', 'is_open', '0', '0:关闭,1:开启', 2),
(4, ' 首页缩略图宽度', 'index_thumb_width', '200', '', 1),
(5, ' 首页缩略图高度', 'index_thumb_height', '200', '', 1),
(6, '列表页缩略图宽度', 'list_thumb_width', '150', '', 1),
(7, '列表页缩略图高度', 'list_thumb_height', '150', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
