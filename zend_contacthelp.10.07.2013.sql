/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50531
Source Host           : localhost:3306
Source Database       : zend_contacthelp

Target Server Type    : MYSQL
Target Server Version : 50531
File Encoding         : 65001

Date: 2013-07-11 11:26:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'Heal', null, 'Hello how are you, this goes the category');
INSERT INTO `categories` VALUES ('2', 'Care', null, 'Care');
INSERT INTO `categories` VALUES ('3', 'test on 3 by prem', null, 'test on 3');
INSERT INTO `categories` VALUES ('4', 'test', null, 'test');
INSERT INTO `categories` VALUES ('5', 'tte', null, 'st');
INSERT INTO `categories` VALUES ('6', 'Here Goest ', null, 'Category Management');
INSERT INTO `categories` VALUES ('7', 'tesat111', null, 'test');
INSERT INTO `categories` VALUES ('8', 'hello ', '1', 'how are you');
INSERT INTO `categories` VALUES ('9', 'Subcat 2', '1', 'Here goes the test');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'Books', 'Books should be collected by the users', null);
INSERT INTO `category` VALUES ('2', 'Health', 'Everybody should be health conscious', null);
INSERT INTO `category` VALUES ('3', 'Physics', 'Here goes the physics ', '1');
INSERT INTO `category` VALUES ('4', 'Chemistry', 'Chemistry is mystry. I never like the chemistry.', '1');

-- ----------------------------
-- Table structure for `cms_page`
-- ----------------------------
DROP TABLE IF EXISTS `cms_page`;
CREATE TABLE `cms_page` (
  `page_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Page ID',
  `title` varchar(255) DEFAULT NULL COMMENT 'Page Title',
  `identifier` varchar(255) NOT NULL COMMENT 'Page String Identifier',
  `meta_keywords` varchar(255) DEFAULT NULL COMMENT 'Page Meta Keywords',
  `meta_description` varchar(255) DEFAULT NULL COMMENT 'Page Meta Description',
  `content` text COMMENT 'Page Content',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Page Creation Time',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Page Modification Time',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Is Page Active',
  `sort_order` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT 'Page Sort Order',
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CMS Page Table';

-- ----------------------------
-- Records of cms_page
-- ----------------------------

-- ----------------------------
-- Table structure for `cms_page_block`
-- ----------------------------
DROP TABLE IF EXISTS `cms_page_block`;
CREATE TABLE `cms_page_block` (
  `block_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Block ID',
  `title` varchar(255) DEFAULT NULL COMMENT 'Block Title',
  `identifier` varchar(255) NOT NULL COMMENT 'Block String Identifier',
  `content` text COMMENT 'Block Content',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Block Creation Time',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Block Modification Time',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Is Block Active',
  PRIMARY KEY (`block_id`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CMS Block Table';

-- ----------------------------
-- Records of cms_page_block
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'admin@test.com', null, 'password', '1');
