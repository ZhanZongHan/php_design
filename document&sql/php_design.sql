/*
Navicat MySQL Data Transfer

Source Server         : syh
Source Server Version : 50096
Source Host           : localhost:3306
Source Database       : php_design

Target Server Type    : MYSQL
Target Server Version : 50096
File Encoding         : 65001

Date: 2018-12-27 13:36:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL auto_increment COMMENT '管理员id',
  `admin_name` varchar(20) collate utf8_unicode_ci NOT NULL COMMENT '管理员名称',
  `password` varchar(16) collate utf8_unicode_ci NOT NULL COMMENT '管理员密码',
  `email` varchar(20) collate utf8_unicode_ci NOT NULL COMMENT '管理员邮箱',
  `register_time` date NOT NULL COMMENT '注册时间',
  `latest_login_time` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP COMMENT '最近登录时间',
  PRIMARY KEY  (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin
-- ----------------------------

-- ----------------------------
-- Table structure for `cart`
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL auto_increment COMMENT '购物车id',
  `total_price` int(11) NOT NULL default '0' COMMENT '购物车商品总价',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY  (`cart_id`),
  KEY `user_id_cart_fk` (`user_id`),
  CONSTRAINT `user_id_cart_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cart
-- ----------------------------

-- ----------------------------
-- Table structure for `cart_item`
-- ----------------------------
DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE `cart_item` (
  `cart_item_id` int(11) NOT NULL auto_increment COMMENT '购物车项id',
  `buy_num` int(7) NOT NULL default '0' COMMENT '购买量',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `cart_id` int(11) NOT NULL COMMENT '购物车id',
  PRIMARY KEY  (`cart_item_id`),
  KEY `fk_goods_id` (`goods_id`),
  KEY `fk_cart_id` (`cart_id`),
  CONSTRAINT `fk_cart_id` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`),
  CONSTRAINT `fk_goods_id` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cart_item
-- ----------------------------

-- ----------------------------
-- Table structure for `favorite`
-- ----------------------------
DROP TABLE IF EXISTS `favorite`;
CREATE TABLE `favorite` (
  `favorite_id` int(11) NOT NULL auto_increment COMMENT '收藏夹id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY  (`favorite_id`),
  KEY `user_id_favorite_fk` (`user_id`),
  CONSTRAINT `user_id_favorite_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of favorite
-- ----------------------------

-- ----------------------------
-- Table structure for `favorite_item`
-- ----------------------------
DROP TABLE IF EXISTS `favorite_item`;
CREATE TABLE `favorite_item` (
  `favorite_item_id` int(11) NOT NULL auto_increment COMMENT '收藏夹项id',
  `favorite_id` int(11) NOT NULL COMMENT '收藏夹id',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  PRIMARY KEY  (`favorite_item_id`),
  KEY `favorite_id_favorite_item_fk` (`favorite_id`),
  KEY `goods_id_favorite_id_favorite_item_fk` (`goods_id`),
  CONSTRAINT `favorite_id_favorite_item_fk` FOREIGN KEY (`favorite_id`) REFERENCES `favorite` (`favorite_id`),
  CONSTRAINT `goods_id_favorite_id_favorite_item_fk` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of favorite_item
-- ----------------------------

-- ----------------------------
-- Table structure for `goods`
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `goods_id` int(11) NOT NULL auto_increment COMMENT '商品id',
  `goods_name` varchar(20) collate utf8_unicode_ci NOT NULL COMMENT '商品名',
  `goods_stock` int(7) NOT NULL default '0' COMMENT '商品库存',
  `goods_price` int(7) NOT NULL default '0' COMMENT '商品单价',
  `goods_description` text collate utf8_unicode_ci COMMENT '商品描述',
  `goods_class_id` int(11) NOT NULL COMMENT '商品类别id',
  PRIMARY KEY  (`goods_id`),
  KEY `goods_class_id_goods_fk` (`goods_class_id`),
  CONSTRAINT `goods_class_id_goods_fk` FOREIGN KEY (`goods_class_id`) REFERENCES `goods_class` (`goods_class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of goods
-- ----------------------------

-- ----------------------------
-- Table structure for `goods_class`
-- ----------------------------
DROP TABLE IF EXISTS `goods_class`;
CREATE TABLE `goods_class` (
  `goods_class_id` int(11) NOT NULL auto_increment COMMENT '商品类别id',
  `goods_class_name` varchar(20) collate utf8_unicode_ci NOT NULL COMMENT '商品类别名',
  PRIMARY KEY  (`goods_class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of goods_class
-- ----------------------------

-- ----------------------------
-- Table structure for `goods_img`
-- ----------------------------
DROP TABLE IF EXISTS `goods_img`;
CREATE TABLE `goods_img` (
  `goods_img_id` int(11) NOT NULL auto_increment COMMENT '商品图片id',
  `goods_img_url` text collate utf8_unicode_ci NOT NULL COMMENT '商品图片地址',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  PRIMARY KEY  (`goods_img_id`),
  KEY `goods_id_goods_img_fk` (`goods_id`),
  CONSTRAINT `goods_id_goods_img_fk` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of goods_img
-- ----------------------------

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL auto_increment COMMENT '订单id',
  `order_code` char(13) collate utf8_unicode_ci NOT NULL COMMENT '订单编码',
  `total_price` int(11) NOT NULL default '0' COMMENT '订单商品总价',
  `user_addr` varchar(50) collate utf8_unicode_ci NOT NULL COMMENT '用户地址',
  `user_phone` char(11) collate utf8_unicode_ci NOT NULL COMMENT '用户电话',
  `postcode` char(6) collate utf8_unicode_ci NOT NULL COMMENT '邮政编码',
  `order_state` enum('已收货','配送中','已发货','未发货') collate utf8_unicode_ci NOT NULL default '未发货' COMMENT '订单状态',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY  (`order_id`),
  KEY `user_id_order_fk` (`user_id`),
  CONSTRAINT `user_id_order_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for `order_item`
-- ----------------------------
DROP TABLE IF EXISTS `order_item`;
CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL auto_increment COMMENT '订单项id',
  `buy_num` int(7) NOT NULL default '0' COMMENT '购买量',
  `order_id` int(11) NOT NULL COMMENT '订单id',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  PRIMARY KEY  (`order_item_id`),
  KEY `order_id_order_item_fk` (`order_id`),
  KEY `goods_id_order_item_fk` (`goods_id`),
  CONSTRAINT `goods_id_order_item_fk` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`goods_id`),
  CONSTRAINT `order_id_order_item_fk` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order_item
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL auto_increment COMMENT '用户id',
  `username` varchar(20) collate utf8_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(16) collate utf8_unicode_ci NOT NULL COMMENT '用户密码',
  `telephone` char(11) collate utf8_unicode_ci NOT NULL COMMENT '电话号码',
  `address` varchar(50) collate utf8_unicode_ci NOT NULL COMMENT '用户地址',
  `email` varchar(20) collate utf8_unicode_ci NOT NULL COMMENT '用户邮箱',
  `head_icon` text collate utf8_unicode_ci NOT NULL COMMENT '头像图标地址',
  `register_time` date NOT NULL COMMENT '注册时间',
  `latest_login_time` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP COMMENT '最近登录时间',
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
