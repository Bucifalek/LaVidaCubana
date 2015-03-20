/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : lavidacubana

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-03-20 18:54:31
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
`score_avg`  float(10,1) NULL DEFAULT NULL ,
`index`  int(1) NULL DEFAULT NULL ,
`matches`  int(10) NULL DEFAULT NULL ,
`games`  int(10) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=34

;

-- ----------------------------
-- Records of bowling_players
-- ----------------------------
BEGIN;
INSERT INTO `bowling_players` VALUES ('2', 'Fel?ír David', '1', '1508', '188.5', '1', '2', '8'), ('3', 'Vá?a Tonda', '1', '8168', '185.6', '0', '11', '44'), ('4', 'Rešetko Martin', '1', '8754', '182.4', '1', '12', '48'), ('5', 'Gartus Zden?k', '1', '2180', '181.7', '-1', '3', '12'), ('6', 'Heitel Lukáš', '1', '6358', '176.6', '-1', '9', '36'), ('7', 'Folta Franta', '1', '5638', '176.2', '1', '8', '32'), ('8', 'Mikliš Petr', '1', '3522', '176.1', '0', '5', '20'), ('9', 'Fojtík F.', '1', '3857', '175.3', '0', '6', '22'), ('10', 'Skalka Roman', '1', '2795', '174.7', '0', '4', '16'), ('11', 'Orságová Romana', '1', '1390', '173.8', '0', '2', '8'), ('12', 'Novosad Robert', '1', '3807', '173.0', '-1', '6', '22'), ('13', 'Ševe?ek Petr', '1', '6229', '173.0', '-1', '9', '36'), ('14', 'Pavela Jirka', '1', '2752', '172.0', '1', '4', '16'), ('15', 'Fojtíková Ivana', '1', '8930', '171.7', '1', '13', '52'), ('16', 'Topi? Zde?a', '1', '6868', '171.7', '1', '10', '40'), ('17', 'Mi?olová Martina', '1', '2402', '171.6', '1', '4', '14'), ('18', 'Klímová Pavla', '1', '5476', '171.1', '1', '8', '32'), ('19', 'Masnota Karel', '1', '6799', '170.0', '-1', '10', '40'), ('20', 'Capil Radek', '1', '8155', '169.9', '1', '12', '48'), ('21', 'Petrnek Libor', '1', '9443', '168.6', '1', '14', '56'), ('22', 'Bílý P?ema', '1', '6724', '168.1', '1', '10', '40'), ('23', 'Šobora Radek ©', '1', '9376', '167.4', '1', '14', '56'), ('24', 'Dobias Pepa', '1', '8698', '167.3', '0', '13', '52'), ('25', 'Žmolík Jirka', '1', '5349', '167.2', '0', '8', '32'), ('26', 'Adámek Lá?a', '1', '7981', '166.3', '1', '12', '48'), ('27', 'Konvi?ný Ros?a', '1', '8583', '165.1', '0', '13', '52'), ('28', 'Št?pánek Michal', '1', '2638', '164.9', '0', '4', '16'), ('29', 'Kamas Pepa', '1', '5920', '164.4', '1', '9', '36'), ('30', 'Hermanová Maruška', '1', '8529', '164.0', '-1', '13', '52'), ('31', 'Kostka Lá?a', '1', '5574', '163.9', '0', '9', '34'), ('32', 'St?ít?zský Radomír', '1', '3932', '163.8', '1', '6', '24'), ('33', 'Kolá?ek Honza', '1', '2621', '163.8', '0', '4', '16');
COMMIT;

-- ----------------------------
-- Table structure for bowling_teams
-- ----------------------------
DROP TABLE IF EXISTS `bowling_teams`;
CREATE TABLE `bowling_teams` (
`id`  int(10) NOT NULL AUTO_INCREMENT ,
`team_name`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
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
AUTO_INCREMENT=2

;

-- ----------------------------
-- Records of bowling_teams
-- ----------------------------
BEGIN;
INSERT INTO `bowling_teams` VALUES ('1', 'testovaci tym', '10', '10', '0', '1', '0', '0');
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
INSERT INTO `branches` VALUES ('1', 'Úvodní stránka', '/'), ('2', 'Kavárna Rožnov pod Radhoštěm', '/kavarna/roznov-pod-radhostem/'), ('3', 'Kavárna Valašské Meziříčí', '/kavarna/valasske-mezirici/'), ('4', 'Bowling', '/bowling');
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
INSERT INTO `main_news` VALUES ('bowling', null, null, null, null), ('roznov-pod-radhostem', 'Mame pro vas kafe!', null, null, '0'), ('valasske-mezirici', 'Mame pro vas pejska!', 'Todle je Fergie, a moc hodna!', 'yj15sk05y5jv3v4fvfp27t210cgqx4.jpg', '1');
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
INSERT INTO `users` VALUES ('4', 'nugatu', '$2y$10$iIJdUZdYsHV3gtmDYqhYLeL4rDvLnJLUQXKWPzi9BC3mVYxWCQRhy', 'Jan', 'Kotrba', 'jan.kotrbaa@gmail.com', '2', '0', '1426874024', '0', null), ('12', 'bucifalek', '$2y$10$dH9BSKIiuXj85XHNJAU/zeNzn/hu7qkDDWBe7lQE/dUc8gfMZo.be', 'Jan', 'Barton', 'janbartonn@gmail.com', '6', '0', '142427226', '0', null);
COMMIT;

-- ----------------------------
-- Auto increment value for bowling_players
-- ----------------------------
ALTER TABLE `bowling_players` AUTO_INCREMENT=34;

-- ----------------------------
-- Auto increment value for bowling_teams
-- ----------------------------
ALTER TABLE `bowling_teams` AUTO_INCREMENT=2;

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
