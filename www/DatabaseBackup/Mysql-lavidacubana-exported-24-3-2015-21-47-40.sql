DROP TABLE IF EXISTS bowling_players;

CREATE TABLE `bowling_players` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `team` int(10) DEFAULT NULL,
  `score` int(10) DEFAULT NULL,
  `score_avg` float(10,1) DEFAULT NULL,
  `index` int(1) DEFAULT NULL,
  `matches` int(10) DEFAULT NULL,
  `games` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

INSERT INTO bowling_players VALUES ('2', 'Fel?ír David', '1', '1508', '188.5', '1', '2', '8');
INSERT INTO bowling_players VALUES ('3', 'Vá?a Tonda', '1', '8168', '185.6', '0', '11', '44');
INSERT INTO bowling_players VALUES ('4', 'Rešetko Martin', '1', '8754', '182.4', '1', '12', '48');
INSERT INTO bowling_players VALUES ('5', 'Gartus Zden?k', '1', '2180', '181.7', '-1', '3', '12');
INSERT INTO bowling_players VALUES ('6', 'Heitel Lukáš', '1', '6358', '176.6', '-1', '9', '36');
INSERT INTO bowling_players VALUES ('7', 'Folta Franta', '1', '5638', '176.2', '1', '8', '32');
INSERT INTO bowling_players VALUES ('8', 'Mikliš Petr', '1', '3522', '176.1', '0', '5', '20');
INSERT INTO bowling_players VALUES ('9', 'Fojtík F.', '1', '3857', '175.3', '0', '6', '22');
INSERT INTO bowling_players VALUES ('10', 'Skalka Roman', '1', '2795', '174.7', '0', '4', '16');
INSERT INTO bowling_players VALUES ('11', 'Orságová Romana', '1', '1390', '173.8', '0', '2', '8');
INSERT INTO bowling_players VALUES ('12', 'Novosad Robert', '1', '3807', '173', '-1', '6', '22');
INSERT INTO bowling_players VALUES ('13', 'Ševe?ek Petr', '1', '6229', '173', '-1', '9', '36');
INSERT INTO bowling_players VALUES ('14', 'Pavela Jirka', '1', '2752', '172', '1', '4', '16');
INSERT INTO bowling_players VALUES ('15', 'Fojtíková Ivana', '1', '8930', '171.7', '1', '13', '52');
INSERT INTO bowling_players VALUES ('16', 'Topi? Zde?a', '1', '6868', '171.7', '1', '10', '40');
INSERT INTO bowling_players VALUES ('17', 'Mi?olová Martina', '1', '2402', '171.6', '1', '4', '14');
INSERT INTO bowling_players VALUES ('18', 'Klímová Pavla', '1', '5476', '171.1', '1', '8', '32');
INSERT INTO bowling_players VALUES ('19', 'Masnota Karel', '1', '6799', '170', '-1', '10', '40');
INSERT INTO bowling_players VALUES ('20', 'Capil Radek', '1', '8155', '169.9', '1', '12', '48');
INSERT INTO bowling_players VALUES ('21', 'Petrnek Libor', '1', '9443', '168.6', '1', '14', '56');
INSERT INTO bowling_players VALUES ('22', 'Bílý P?ema', '1', '6724', '168.1', '1', '10', '40');
INSERT INTO bowling_players VALUES ('23', 'Šobora Radek ©', '1', '9376', '167.4', '1', '14', '56');
INSERT INTO bowling_players VALUES ('24', 'Dobias Pepa', '1', '8698', '167.3', '0', '13', '52');
INSERT INTO bowling_players VALUES ('25', 'Žmolík Jirka', '1', '5349', '167.2', '0', '8', '32');
INSERT INTO bowling_players VALUES ('26', 'Adámek Lá?a', '1', '7981', '166.3', '1', '12', '48');
INSERT INTO bowling_players VALUES ('27', 'Konvi?ný Ros?a', '1', '8583', '165.1', '0', '13', '52');
INSERT INTO bowling_players VALUES ('28', 'Št?pánek Michal', '1', '2638', '164.9', '0', '4', '16');
INSERT INTO bowling_players VALUES ('29', 'Kamas Pepa', '1', '5920', '164.4', '1', '9', '36');
INSERT INTO bowling_players VALUES ('30', 'Hermanová Maruška', '1', '8529', '164', '-1', '13', '52');
INSERT INTO bowling_players VALUES ('31', 'Kostka Lá?a', '1', '5574', '163.9', '0', '9', '34');
INSERT INTO bowling_players VALUES ('32', 'St?ít?zský Radomír', '1', '3932', '163.8', '1', '6', '24');
INSERT INTO bowling_players VALUES ('33', 'Kolá?ek Honza', '1', '2621', '163.8', '0', '4', '16');


DROP TABLE IF EXISTS bowling_teams;

CREATE TABLE `bowling_teams` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(255) DEFAULT NULL,
  `score` int(10) DEFAULT NULL,
  `score_avg` float(10,0) DEFAULT NULL,
  `index` int(1) DEFAULT NULL,
  `matches` int(10) DEFAULT NULL,
  `helpers` int(10) DEFAULT NULL,
  `points` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO bowling_teams VALUES ('1', 'testovaci tym', '10', '10', '0', '1', '0', '0');


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO main_news VALUES ('bowling', '', '', '', '');
INSERT INTO main_news VALUES ('roznov-pod-radhostem', 'Mame pro vas kafe!', '', '', '0');
INSERT INTO main_news VALUES ('valasske-mezirici', 'Mame pro vas pejska!', 'Todle je Fergie, a moc hodna!', 'yj15sk05y5jv3v4fvfp27t210cgqx4.jpg', '1');


DROP TABLE IF EXISTS pages;

CREATE TABLE `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `url` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO pages VALUES ('1', '1', 'Uvodní stránka celeho webu', 'uvodni-stranka-celeho-webu', '/');


DROP TABLE IF EXISTS pages_content;

CREATE TABLE `pages_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO users VALUES ('4', 'nugatu', '$2y$10$iIJdUZdYsHV3gtmDYqhYLeL4rDvLnJLUQXKWPzi9BC3mVYxWCQRhy', 'Jan', 'Kotrba', 'jan.kotrbaa@gmail.com', '2', '0', '1427230060', '0', '');
INSERT INTO users VALUES ('12', 'bucifalek', '$2y$10$dH9BSKIiuXj85XHNJAU/zeNzn/hu7qkDDWBe7lQE/dUc8gfMZo.be', 'Jan', 'Barton', 'janbartonn@gmail.com', '6', '0', '142427226', '0', '');
INSERT INTO users VALUES ('14', 'malcik', '$2y$10$AeJoX97v2VioMs92mHuoAufdv0apFeckdfaMeFxescjVBG1AYlK3.', 'David', 'Janík', 'contact.janik@seznam.cz', '', '0', '', '0', '');


