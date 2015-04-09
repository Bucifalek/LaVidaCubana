DROP TABLE IF EXISTS bowling_opentime;

CREATE TABLE `bowling_opentime` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `day` varchar(10) DEFAULT NULL,
  `open` int(15) DEFAULT NULL,
  `close` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO bowling_opentime VALUES ('1', 'Pondělí', '', '');
INSERT INTO bowling_opentime VALUES ('3', 'Úterý', '', '');
INSERT INTO bowling_opentime VALUES ('4', 'Středa', '', '');
INSERT INTO bowling_opentime VALUES ('5', 'Čtvrtek', '', '');
INSERT INTO bowling_opentime VALUES ('6', 'Pátek', '', '');
INSERT INTO bowling_opentime VALUES ('7', 'Sobota', '', '');
INSERT INTO bowling_opentime VALUES ('8', 'Neděle', '', '');


DROP TABLE IF EXISTS bowling_players;

CREATE TABLE `bowling_players` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `team` int(10) DEFAULT NULL,
  `score` int(10) DEFAULT '0',
  `score_avg` float(10,0) DEFAULT '0',
  `index` int(1) DEFAULT '0',
  `matches` int(10) DEFAULT '0',
  `games` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

INSERT INTO bowling_players VALUES ('3', 'Vá?a Tonda', '2', '8168', '186', '0', '11', '44');
INSERT INTO bowling_players VALUES ('4', 'Rešetko Martin', '3', '8754', '182', '1', '12', '48');
INSERT INTO bowling_players VALUES ('5', 'Gartus Zden?k', '4', '2180', '182', '-1', '3', '12');
INSERT INTO bowling_players VALUES ('6', 'Heitel Lukáš', '3', '6358', '177', '-1', '9', '36');
INSERT INTO bowling_players VALUES ('7', 'Folta Franta', '2', '5638', '176', '1', '8', '32');
INSERT INTO bowling_players VALUES ('8', 'Mikliš Petr', '1', '3522', '176', '0', '5', '20');
INSERT INTO bowling_players VALUES ('9', 'Fojtík F.', '2', '3857', '175', '0', '6', '22');
INSERT INTO bowling_players VALUES ('10', 'Skalka Roman', '3', '2795', '175', '0', '4', '16');
INSERT INTO bowling_players VALUES ('12', 'Novosad Robert', '4', '3807', '173', '-1', '6', '22');
INSERT INTO bowling_players VALUES ('13', 'Ševe?ek Petr', '3', '6229', '173', '-1', '9', '36');
INSERT INTO bowling_players VALUES ('14', 'Pavela Jirka', '2', '2752', '172', '1', '4', '16');
INSERT INTO bowling_players VALUES ('15', 'Fojtíková Ivana', '1', '8930', '172', '1', '13', '52');
INSERT INTO bowling_players VALUES ('16', 'Topi? Zde?a', '2', '6868', '172', '1', '10', '40');
INSERT INTO bowling_players VALUES ('17', 'Mi?olová Martina', '3', '2402', '172', '1', '4', '14');
INSERT INTO bowling_players VALUES ('18', 'Klímová Pavla', '4', '5476', '171', '1', '8', '32');
INSERT INTO bowling_players VALUES ('19', 'Masnota Karel', '5', '6799', '170', '-1', '10', '40');
INSERT INTO bowling_players VALUES ('20', 'Capil Radek', '6', '8155', '170', '1', '12', '48');
INSERT INTO bowling_players VALUES ('21', 'Petrnek Libor', '7', '9443', '169', '1', '14', '56');
INSERT INTO bowling_players VALUES ('22', 'Bílý P?ema', '7', '6724', '168', '1', '10', '40');
INSERT INTO bowling_players VALUES ('23', 'Šobora Radek ©', '7', '9376', '167', '1', '14', '56');
INSERT INTO bowling_players VALUES ('24', 'Dobias Pepa', '6', '8698', '167', '0', '13', '52');
INSERT INTO bowling_players VALUES ('25', 'Žmolík Jirka', '6', '5349', '167', '0', '8', '32');
INSERT INTO bowling_players VALUES ('26', 'Adámek Lá?a', '5', '7981', '166', '1', '12', '48');
INSERT INTO bowling_players VALUES ('27', 'Konvi?ný Ros?a', '5', '8583', '165', '0', '13', '52');
INSERT INTO bowling_players VALUES ('28', 'Št?pánek Michal', '5', '2638', '165', '0', '4', '16');
INSERT INTO bowling_players VALUES ('29', 'Kamas Pepa', '4', '5920', '164', '1', '9', '36');
INSERT INTO bowling_players VALUES ('30', 'Hermanová Maruška', '4', '8529', '164', '-1', '13', '52');
INSERT INTO bowling_players VALUES ('31', 'Kostka Lá?a', '4', '5574', '164', '0', '9', '34');
INSERT INTO bowling_players VALUES ('32', 'St?ít?zský Radomír', '3', '3932', '164', '1', '6', '24');
INSERT INTO bowling_players VALUES ('33', 'Kolá?ek Honza', '0', '2621', '164', '0', '4', '16');
INSERT INTO bowling_players VALUES ('34', 'tgtg2tgg', '0', '0', '0', '0', '0', '0');


DROP TABLE IF EXISTS bowling_price;

CREATE TABLE `bowling_price` (
  `id` int(11) NOT NULL,
  `key` varchar(50) DEFAULT NULL,
  `timezone_1_price` int(5) DEFAULT NULL,
  `timezone_1_range` varchar(150) DEFAULT NULL,
  `timezone_2_price` int(5) DEFAULT NULL,
  `timezone_2_range` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS bowling_teams;

CREATE TABLE `bowling_teams` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `score` int(10) DEFAULT '0',
  `score_avg` float(10,1) DEFAULT '0.0',
  `index` int(1) DEFAULT '0',
  `matches` int(10) DEFAULT '0',
  `helpers` int(10) DEFAULT '0',
  `points` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO bowling_teams VALUES ('1', 'Drahop', '40760', '10.7', '1', '15', '141', '26');
INSERT INTO bowling_teams VALUES ('2', 'A je dem', '40760', '1', '0', '14', '102', '20');
INSERT INTO bowling_teams VALUES ('3', 'No name', '40760', '1', '0', '14', '98', '18');
INSERT INTO bowling_teams VALUES ('4', 'Kulový blesk', '40760', '0', '0', '14', '84', '14');
INSERT INTO bowling_teams VALUES ('5', 'Crazy frog', '40760', '6', '-1', '14', '76', '14');
INSERT INTO bowling_teams VALUES ('6', 'Kuchtíci', '40760', '9', '-1', '13', '74', '12');
INSERT INTO bowling_teams VALUES ('7', 'Glass school', '40760', '6', '0', '10', '72', '12');
INSERT INTO bowling_teams VALUES ('8', 'For Fun', '40760', '4', '0', '11', '65', '8');


DROP TABLE IF EXISTS branches;

CREATE TABLE `branches` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO branches VALUES ('1', 'Úvodní stránka', '/');
INSERT INTO branches VALUES ('2', 'Kavárna Rožnov pod Radhoštěm', '/roznov-pod-radhostem/');
INSERT INTO branches VALUES ('3', 'Kavárna Valašské Meziříčí', '/valasske-mezirici/');
INSERT INTO branches VALUES ('4', 'Bowling', '/bowling');


DROP TABLE IF EXISTS main_news;

CREATE TABLE `main_news` (
  `key` varchar(50) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `img_uploaded` varchar(255) DEFAULT NULL,
  `redirect` int(1) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO main_news VALUES ('bowling', '', 't', '0', '0');
INSERT INTO main_news VALUES ('roznov-pod-radhostem', '', 't', '0', '0');
INSERT INTO main_news VALUES ('valasske-mezirici', '', '', '0', '0');


DROP TABLE IF EXISTS pages;

CREATE TABLE `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `url` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO pages VALUES ('1', '1', 'Uvodní stránka celého webu', 'uvodni-stranka-celeho-webu', '/');


DROP TABLE IF EXISTS pages_content;

CREATE TABLE `pages_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) DEFAULT NULL,
  `key` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `data` text CHARACTER SET latin1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `password_pure` text,
  `password` text,
  `real_firstname` varchar(50) DEFAULT NULL,
  `real_lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `avatar` int(2) DEFAULT NULL,
  `banned` int(1) DEFAULT NULL,
  `activetime` int(10) DEFAULT NULL,
  `bantime` int(10) DEFAULT '0',
  `role` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO users VALUES ('4', 'nugatulavida', 'Cpnoyvlf7gibN3joSECd6puNIMBrMK', '$2y$10$RHkZu9Q9NYkbILFFS0mX6OrAa597jblmQ1xwZv5mM3BEdYV0lxQb6', 'Jan', 'Kotrba', 'jan.kotrbaa@gmail.com', '9', '0', '1428608939', '0', '0');
INSERT INTO users VALUES ('12', 'bucifalek', '', '$2y$10$dH9BSKIiuXj85XHNJAU/zeNzn/hu7qkDDWBe7lQE/dUc8gfMZo.be', 'Jan', 'Barton', 'janbartonn@gmail.com', '6', '0', '142427226', '0', '0');
INSERT INTO users VALUES ('14', 'malcik', 'tZUzauhpXnX5aXS9mO6bQluuyi7KnE', '$2y$10$2CSZz6ixlq3EK4mMy3L5Ru9ySmJfcCpoMMOZW6VwcW0wjR4RoqsNW', 'David', 'Janík', 'contact.janik@seznam.cz', '2', '0', '1428429495', '0', '0');


DROP TABLE IF EXISTS visitors;

CREATE TABLE `visitors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `session` varchar(150) COLLATE utf8_czech_ci DEFAULT NULL,
  `url` text COLLATE utf8_czech_ci,
  `route` text COLLATE utf8_czech_ci,
  `timestamp` int(10) DEFAULT NULL,
  `section` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO visitors VALUES ('17', '::1', 'avgp6j550vmk7glc2emngimik7', 'http://localhost/LaVidaCubana/www/bowling/chci-si-zahrat', 'Web:Bowling:play', '1428594091', '4');
INSERT INTO visitors VALUES ('18', '::1', 'avgp6j550vmk7glc2emngimik7', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1428594185', '4');
INSERT INTO visitors VALUES ('19', '::1', 'avgp6j550vmk7glc2emngimik7', 'http://localhost/LaVidaCubana/www/bowling/pravidla', 'Web:Bowling:rules', '1428564185', '4');
INSERT INTO visitors VALUES ('20', '::1', 'avgp6j550vmk7glc2emngimik7', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1428608358', '1');
INSERT INTO visitors VALUES ('21', '::1', 'avgp6j550vmk7glc2emngimik7', 'http://localhost/LaVidaCubana/www/roznov-pod-radhostem/', 'Web:Roznov:default', '1428608360', '4');
INSERT INTO visitors VALUES ('22', '::1', 'avgp6j550vmk7glc2emngimik7', 'http://localhost/LaVidaCubana/www/valasske-mezirici/', 'Web:Valmez:default', '1428608888', '');


