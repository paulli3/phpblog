-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014-06-30 12:30:14
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `7433datacenter`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_daylog`
--

CREATE TABLE IF NOT EXISTS `tbl_daylog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` int(10) unsigned NOT NULL,
  `value` text NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `remotetime` int(10) unsigned NOT NULL,
  `platID` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `platID` (`platID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='日志信息记录' AUTO_INCREMENT=755 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_links`
--

CREATE TABLE IF NOT EXISTS `tbl_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `sid` int(5) NOT NULL,
  `link` varchar(255) NOT NULL,
  `pid` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`,`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_pay`
--

CREATE TABLE IF NOT EXISTS `tbl_pay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `linkid` int(10) unsigned NOT NULL COMMENT '从哪个页面进来的',
  `username` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `gameid` int(11) NOT NULL,
  `serverid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `remotetime` int(11) NOT NULL COMMENT '服务器成功实践',
  `orderid` varchar(30) NOT NULL,
  `paytype` int(11) NOT NULL,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_userlogin`
--

CREATE TABLE IF NOT EXISTS `tbl_userlogin` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `linkid` int(10) unsigned NOT NULL COMMENT '通过哪个linkid来的',
  `remoteTime` int(11) NOT NULL,
  `registerTime` int(11) NOT NULL,
  `registerIP` varchar(20) NOT NULL COMMENT '注册ip',
  `loginIP` varchar(20) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `linkid` (`linkid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1584993 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
