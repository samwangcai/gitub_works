-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2002 年 01 月 02 日 00:09
-- 服务器版本: 5.0.45
-- PHP 版本: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `song`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `yl_admin`
-- 

CREATE TABLE `yl_admin` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `yl_admin`
-- 

INSERT INTO `yl_admin` VALUES (1, 'sam', 'sam121');

-- --------------------------------------------------------

-- 
-- 表的结构 `yl_class`
-- 

CREATE TABLE `yl_class` (
  `id` int(10) NOT NULL auto_increment,
  `en_name` varchar(255) default NULL,
  `zh_name` varchar(255) default NULL,
  `father_class_id` int(10) default '0',
  `oid` int(10) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `yl_class`
-- 

INSERT INTO `yl_class` VALUES (1, 'products', '产品介绍', 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `yl_contents`
-- 

CREATE TABLE `yl_contents` (
  `id` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL default '0',
  `title` varchar(200) NOT NULL,
  `en_content` text,
  `zh_content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `yl_contents`
-- 

