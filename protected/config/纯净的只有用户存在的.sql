-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014-06-24 04:43:31
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `user`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) NOT NULL,
  `passWd` varchar(255) NOT NULL,
  `roleID` int(11) NOT NULL,
  `isEnable` tinyint(4) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `UserName_2` (`UserName`),
  KEY `UserName` (`UserName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tbl_admin`
--

INSERT INTO `tbl_admin` (`uid`, `UserName`, `passWd`, `roleID`, `isEnable`) VALUES
(1, 'admin', 'ea30NSYZ9cng+6ohwLbtRkwTa3nGEG+PJBQX76uhFugi4p1o5hU', 5, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_right`
--

CREATE TABLE IF NOT EXISTS `tbl_right` (
  `rightID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rightName` varchar(255) NOT NULL,
  `rightCode` varchar(255) NOT NULL,
  PRIMARY KEY (`rightID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='权限表' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `tbl_right`
--

INSERT INTO `tbl_right` (`rightID`, `rightName`, `rightCode`) VALUES
(2, '查看用户权限', 'user.list'),
(3, '删除用户权限', 'user.del'),
(4, '用户编辑权限', 'user.edit'),
(5, '权限列表查看权限', 'user.rightlist');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_right_role_relation`
--

CREATE TABLE IF NOT EXISTS `tbl_right_role_relation` (
  `roleID` int(10) unsigned NOT NULL,
  `rightID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`roleID`,`rightID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_role`
--

CREATE TABLE IF NOT EXISTS `tbl_role` (
  `roleID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `roleName` varchar(255) NOT NULL,
  `roleCode` varchar(255) NOT NULL COMMENT '权限代码综合版本',
  PRIMARY KEY (`roleID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tbl_role`
--

INSERT INTO `tbl_role` (`roleID`, `roleName`, `roleCode`) VALUES
(5, '管理员', '2'),
(2, '超级管理员', '2,3,4,5');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
