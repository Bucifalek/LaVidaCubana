/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : lavidacubana

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-03-19 21:54:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bowling_players
-- ----------------------------
DROP TABLE IF EXISTS `bowling_players`;
CREATE TABLE `bowling_players` (
`id`  int(10) NOT NULL AUTO_INCREMENT ,
`name`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`team`  int(10) NULL DEFAULT NULL ,
`score`  int(10) NULL DEFAULT NULL ,
`score_avg`  float(10,0) NULL DEFAULT NULL ,
`index`  int(1) NULL DEFAULT NULL ,
`matches`  int(10) NULL DEFAULT NULL ,
`games`  int(10) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of bowling_players
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for bowling_teams
-- ----------------------------
DROP TABLE IF EXISTS `bowling_teams`;
CREATE TABLE `bowling_teams` (
`id`  int(10) NOT NULL AUTO_INCREMENT ,
`name`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`score`  int(10) NULL DEFAULT NULL ,
`score_avg`  float(10,0) NULL DEFAULT NULL ,
`index`  int(1) NULL DEFAULT NULL ,
`matches`  int(10) NULL DEFAULT NULL ,
`helpers`  int(10) NULL DEFAULT NULL ,
`points`  int(10) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of bowling_teams
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for branches
-- ----------------------------
DROP TABLE IF EXISTS `branches`;
CREATE TABLE `branches` (
`id`  int(10) NOT NULL AUTO_INCREMENT ,
`name`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`url`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=5

;

-- ----------------------------
-- Records of branches
-- ----------------------------
BEGIN;
INSERT INTO `branches` VALUES ('1', 'Úvodní stránka', '/');
INSERT INTO `branches` VALUES ('2', 'Kavárna Rožnov pod Radhoštěm', '/kavarna/roznov-pod-radhostem/');
INSERT INTO `branches` VALUES ('3', 'Kavárna Valašské Meziříčí', '/kavarna/valasske-mezirici/');
INSERT INTO `branches` VALUES ('4', 'Bowling', '/bowling');
COMMIT;

-- ----------------------------
-- Table structure for main_news
-- ----------------------------
DROP TABLE IF EXISTS `main_news`;
CREATE TABLE `main_news` (
`key`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`title`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`text`  text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
`img_uploaded`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`redirect`  int(1) NULL DEFAULT NULL ,
PRIMARY KEY (`key`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci

;

-- ----------------------------
-- Records of main_news
-- ----------------------------
BEGIN;
INSERT INTO `main_news` VALUES ('bowling', null, null, null, null);
INSERT INTO `main_news` VALUES ('roznov-pod-radhostem', 'Mame pro vas kafe!', null, null, '0');
INSERT INTO `main_news` VALUES ('valasske-mezirici', 'Mame pro vas pejska!', 'Todle je Fergie, a moc hodna!', 'yj15sk05y5jv3v4fvfp27t210cgqx4.jpg', '1');
COMMIT;

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
`id`  int(10) NOT NULL AUTO_INCREMENT ,
`branch_id`  int(10) NULL DEFAULT NULL ,
`name`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`key`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`url`  text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=2

;

-- ----------------------------
-- Records of pages
-- ----------------------------
BEGIN;
INSERT INTO `pages` VALUES ('1', '1', 'Uvodní stránka celeho webu', 'uvodni-stranka-celeho-webu', '/');
COMMIT;

-- ----------------------------
-- Table structure for pages_content
-- ----------------------------
DROP TABLE IF EXISTS `pages_content`;
CREATE TABLE `pages_content` (
`id`  int(10) NOT NULL AUTO_INCREMENT ,
`branch_id`  int(10) NULL DEFAULT NULL ,
`key`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`data`  text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of pages_content
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`id`  int(10) NOT NULL AUTO_INCREMENT ,
`user`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`password`  text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
`real_firstname`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`real_lastname`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`email`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`avatar`  int(2) NULL DEFAULT NULL ,
`banned`  int(1) NULL DEFAULT NULL ,
`activetime`  int(10) NULL DEFAULT NULL ,
`bantime`  int(10) NULL DEFAULT 0 ,
`role`  int(5) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=13

;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('4', 'nugatu', '$2y$10$iIJdUZdYsHV3gtmDYqhYLeL4rDvLnJLUQXKWPzi9BC3mVYxWCQRhy', 'Jan', 'Kotrba', 'jan.kotrbaa@gmail.com', '2', '0', '1426798246', '0', null);
INSERT INTO `users` VALUES ('12', 'bucifalek', '$2y$10$dH9BSKIiuXj85XHNJAU/zeNzn/hu7qkDDWBe7lQE/dUc8gfMZo.be', 'Jan', 'Barton', 'janbartonn@gmail.com', '6', '0', '142427226', '0', null);
COMMIT;

-- ----------------------------
-- Auto increment value for bowling_players
-- ----------------------------
ALTER TABLE `bowling_players` AUTO_INCREMENT=1;

-- ----------------------------
-- Auto increment value for bowling_teams
-- ----------------------------
ALTER TABLE `bowling_teams` AUTO_INCREMENT=1;

-- ----------------------------
-- Auto increment value for branches
-- ----------------------------
ALTER TABLE `branches` AUTO_INCREMENT=5;

-- ----------------------------
-- Auto increment value for pages
-- ----------------------------
ALTER TABLE `pages` AUTO_INCREMENT=2;

-- ----------------------------
-- Auto increment value for pages_content
-- ----------------------------
ALTER TABLE `pages_content` AUTO_INCREMENT=1;

-- ----------------------------
-- Auto increment value for users
-- ----------------------------
ALTER TABLE `users` AUTO_INCREMENT=13;
