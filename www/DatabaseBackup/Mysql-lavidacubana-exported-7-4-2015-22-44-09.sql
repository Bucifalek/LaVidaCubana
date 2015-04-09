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
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `team` int(10) DEFAULT NULL,
  `score` int(10) DEFAULT NULL,
  `score_avg` float(10,0) DEFAULT NULL,
  `index` int(1) DEFAULT NULL,
  `matches` int(10) DEFAULT NULL,
  `games` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

INSERT INTO bowling_players VALUES ('2', 'Felčír David', '1', '1508', '188', '1', '2', '8');
INSERT INTO bowling_players VALUES ('3', 'Vá?a Tonda', '1', '8168', '186', '0', '11', '44');
INSERT INTO bowling_players VALUES ('4', 'Rešetko Martin', '1', '8754', '182', '1', '12', '48');
INSERT INTO bowling_players VALUES ('5', 'Gartus Zden?k', '1', '2180', '182', '-1', '3', '12');
INSERT INTO bowling_players VALUES ('6', 'Heitel Lukáš', '1', '6358', '177', '-1', '9', '36');
INSERT INTO bowling_players VALUES ('7', 'Folta Franta', '1', '5638', '176', '1', '8', '32');
INSERT INTO bowling_players VALUES ('8', 'Mikliš Petr', '1', '3522', '176', '0', '5', '20');
INSERT INTO bowling_players VALUES ('9', 'Fojtík F.', '1', '3857', '175', '0', '6', '22');
INSERT INTO bowling_players VALUES ('10', 'Skalka Roman', '1', '2795', '175', '0', '4', '16');
INSERT INTO bowling_players VALUES ('11', 'Orságová Romana', '1', '1390', '174', '0', '2', '8');
INSERT INTO bowling_players VALUES ('12', 'Novosad Robert', '1', '3807', '173', '-1', '6', '22');
INSERT INTO bowling_players VALUES ('13', 'Ševe?ek Petr', '1', '6229', '173', '-1', '9', '36');
INSERT INTO bowling_players VALUES ('14', 'Pavela Jirka', '1', '2752', '172', '1', '4', '16');
INSERT INTO bowling_players VALUES ('15', 'Fojtíková Ivana', '1', '8930', '172', '1', '13', '52');
INSERT INTO bowling_players VALUES ('16', 'Topi? Zde?a', '1', '6868', '172', '1', '10', '40');
INSERT INTO bowling_players VALUES ('17', 'Mi?olová Martina', '1', '2402', '172', '1', '4', '14');
INSERT INTO bowling_players VALUES ('18', 'Klímová Pavla', '1', '5476', '171', '1', '8', '32');
INSERT INTO bowling_players VALUES ('19', 'Masnota Karel', '1', '6799', '170', '-1', '10', '40');
INSERT INTO bowling_players VALUES ('20', 'Capil Radek', '1', '8155', '170', '1', '12', '48');
INSERT INTO bowling_players VALUES ('21', 'Petrnek Libor', '1', '9443', '169', '1', '14', '56');
INSERT INTO bowling_players VALUES ('22', 'Bílý P?ema', '1', '6724', '168', '1', '10', '40');
INSERT INTO bowling_players VALUES ('23', 'Šobora Radek ©', '1', '9376', '167', '1', '14', '56');
INSERT INTO bowling_players VALUES ('24', 'Dobias Pepa', '1', '8698', '167', '0', '13', '52');
INSERT INTO bowling_players VALUES ('25', 'Žmolík Jirka', '1', '5349', '167', '0', '8', '32');
INSERT INTO bowling_players VALUES ('26', 'Adámek Lá?a', '1', '7981', '166', '1', '12', '48');
INSERT INTO bowling_players VALUES ('27', 'Konvi?ný Ros?a', '1', '8583', '165', '0', '13', '52');
INSERT INTO bowling_players VALUES ('28', 'Št?pánek Michal', '1', '2638', '165', '0', '4', '16');
INSERT INTO bowling_players VALUES ('29', 'Kamas Pepa', '1', '5920', '164', '1', '9', '36');
INSERT INTO bowling_players VALUES ('30', 'Hermanová Maruška', '1', '8529', '164', '-1', '13', '52');
INSERT INTO bowling_players VALUES ('31', 'Kostka Lá?a', '1', '5574', '164', '0', '9', '34');
INSERT INTO bowling_players VALUES ('32', 'St?ít?zský Radomír', '1', '3932', '164', '1', '6', '24');
INSERT INTO bowling_players VALUES ('33', 'Kolá?ek Honza', '1', '2621', '164', '0', '4', '16');


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
  `score` int(10) DEFAULT NULL,
  `score_avg` float(10,1) DEFAULT NULL,
  `index` int(1) DEFAULT NULL,
  `matches` int(10) DEFAULT NULL,
  `helpers` int(10) DEFAULT NULL,
  `points` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO bowling_teams VALUES ('1', 'Drahop', '40760', '10.7', '1', '15', '141', '26');
INSERT INTO bowling_teams VALUES ('2', 'A je dem', '40760', '1', '0', '14', '102', '20');
INSERT INTO bowling_teams VALUES ('3', 'No name', '40760', '1', '0', '14', '98', '18');
INSERT INTO bowling_teams VALUES ('4', 'Kulový blesk', '40760', '0', '0', '14', '84', '14');
INSERT INTO bowling_teams VALUES ('5', 'Crazy frog', '40760', '6', '-1', '14', '76', '14');
INSERT INTO bowling_teams VALUES ('6', 'Kuchtíci', '40760', '9', '-1', '13', '74', '12');
INSERT INTO bowling_teams VALUES ('7', 'Glass school', '40760', '6', '0', '10', '72', '12');
INSERT INTO bowling_teams VALUES ('8', 'For Fun', '40760', '4', '0', '11', '65', '8');
INSERT INTO bowling_teams VALUES ('9', 'Misáci', '40760', '7', '1', '9', '31', '0');


DROP TABLE IF EXISTS branches;

CREATE TABLE `branches` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO branches VALUES ('1', 'Úvodní stránka', '/');
INSERT INTO branches VALUES ('2', 'Kavárna Rožnov pod Radhoštěm', '/kavarna/roznov-pod-radhostem/');
INSERT INTO branches VALUES ('3', 'Kavárna Valašské Meziříčí', '/kavarna/valasske-mezirici/');
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
INSERT INTO main_news VALUES ('valasske-mezirici', 'Mznosti!', 'Detaily aktuality', 'y7wwkrqla9ly5efvz63ent737ta4ui.png', '1');


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

INSERT INTO users VALUES ('4', 'nugatulavida', 'Cpnoyvlf7gibN3joSECd6puNIMBrMK', '$2y$10$RHkZu9Q9NYkbILFFS0mX6OrAa597jblmQ1xwZv5mM3BEdYV0lxQb6', 'Jan', 'Kotrba', 'jan.kotrbaa@gmail.com', '2', '0', '1428439449', '0', '0');
INSERT INTO users VALUES ('12', 'bucifalek', '', '$2y$10$dH9BSKIiuXj85XHNJAU/zeNzn/hu7qkDDWBe7lQE/dUc8gfMZo.be', 'Jan', 'Barton', 'janbartonn@gmail.com', '6', '0', '142427226', '0', '0');
INSERT INTO users VALUES ('14', 'malcik', '', '$2y$10$AeJoX97v2VioMs92mHuoAufdv0apFeckdfaMeFxescjVBG1AYlK3.', 'David', 'Janík', 'contact.janik@seznam.cz', '2', '0', '1428429495', '0', '0');


