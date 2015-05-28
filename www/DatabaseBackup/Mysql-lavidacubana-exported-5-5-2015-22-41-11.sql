DROP TABLE IF EXISTS bowling_ignored_players;

CREATE TABLE `bowling_ignored_players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) DEFAULT NULL,
  `team` int(11) DEFAULT NULL,
  `player` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;



DROP TABLE IF EXISTS bowling_news;

CREATE TABLE `bowling_news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_czech_ci DEFAULT NULL,
  `text` text COLLATE utf8_czech_ci,
  `timestamp` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;



DROP TABLE IF EXISTS bowling_opentime;

CREATE TABLE `bowling_opentime` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `day` varchar(10) DEFAULT NULL,
  `open` varchar(10) DEFAULT NULL,
  `close` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO bowling_opentime VALUES ('1', 'Pondělí', '10:00', '22:00');
INSERT INTO bowling_opentime VALUES ('2', 'Úterý', '10:00', '22:00');
INSERT INTO bowling_opentime VALUES ('3', 'Středa', '10:00', '22:00');
INSERT INTO bowling_opentime VALUES ('4', 'Čtvrtek', '10:00', '22:00');
INSERT INTO bowling_opentime VALUES ('5', 'Pátek', '10:00', '23:00');
INSERT INTO bowling_opentime VALUES ('6', 'Sobota', '10:00', '23:00');
INSERT INTO bowling_opentime VALUES ('7', 'Neděle', '13:00', '20:00');


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
  `helpers` int(10) DEFAULT NULL,
  `games_fall` int(10) DEFAULT NULL,
  `games_winter` int(10) DEFAULT NULL,
  `games_autumn` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

INSERT INTO bowling_players VALUES ('1', 'Váňa Tonda', '5', '13491', '0', '1', '18', '72', '0', '28', '20', '24');
INSERT INTO bowling_players VALUES ('2', 'Pavela Jirka', '1', '7377', '0', '-1', '10', '40', '0', '4', '12', '24');
INSERT INTO bowling_players VALUES ('3', 'Gartus Zdeněk', '2', '4389', '0', '1', '6', '24', '0', '0', '16', '8');
INSERT INTO bowling_players VALUES ('4', 'Rešetko Martin', '4', '13759', '0', '0', '19', '76', '0', '32', '20', '24');
INSERT INTO bowling_players VALUES ('5', 'Skalka Roman', '2', '5782', '0', '0', '8', '32', '0', '12', '8', '12');
INSERT INTO bowling_players VALUES ('6', 'Heitel Lukáš', '1', '9275', '0', '1', '13', '52', '0', '20', '20', '12');
INSERT INTO bowling_players VALUES ('7', 'Fojtík František', '3', '7456', '0', '-1', '11', '42', '0', '8', '14', '20');
INSERT INTO bowling_players VALUES ('8', 'Mikliš Petr', '1', '4944', '0', '0', '7', '28', '0', '12', '8', '8');
INSERT INTO bowling_players VALUES ('9', 'Ševeček Petr', '6', '9870', '0', '0', '14', '56', '0', '16', '20', '20');
INSERT INTO bowling_players VALUES ('10', 'Folta Franta', '2', '7728', '0', '0', '11', '44', '0', '8', '24', '12');
INSERT INTO bowling_players VALUES ('11', 'Orságová Romana', '1', '1390', '0', '0', '2', '8', '0', '4', '4', '0');
INSERT INTO bowling_players VALUES ('12', 'Topič Zdeňa', '6', '12506', '0', '1', '18', '72', '0', '20', '28', '24');
INSERT INTO bowling_players VALUES ('13', 'Masnota Karel', '1', '9699', '0', '0', '14', '56', '0', '24', '20', '12');
INSERT INTO bowling_players VALUES ('14', 'Fojtíková Ivana', '3', '15892', '0', '-1', '23', '92', '0', '28', '32', '32');
INSERT INTO bowling_players VALUES ('15', 'Capil Radek', '3', '13688', '0', '0', '20', '80', '0', '24', '32', '24');
INSERT INTO bowling_players VALUES ('16', 'Koláček Honza', '1', '4789', '0', '0', '7', '28', '0', '8', '8', '12');
INSERT INTO bowling_players VALUES ('17', 'Kostka Láďa', '2', '10924', '0', '0', '17', '64', '0', '14', '28', '22');
INSERT INTO bowling_players VALUES ('18', 'Šobora Radek ©', '1', '15004', '0', '1', '22', '88', '0', '32', '28', '28');
INSERT INTO bowling_players VALUES ('19', 'Mičolová Martina', '2', '5112', '0', '0', '8', '30', '0', '6', '12', '12');
INSERT INTO bowling_players VALUES ('20', 'Štěpánek Michal', '3', '6134', '0', '0', '9', '36', '0', '12', '12', '12');
INSERT INTO bowling_players VALUES ('21', 'Střítězský Radomír', '8', '7465', '0', '0', '11', '44', '0', '12', '20', '12');
INSERT INTO bowling_players VALUES ('22', 'Klímová Pavla', '2', '9456', '0', '0', '14', '56', '0', '24', '12', '20');
INSERT INTO bowling_players VALUES ('23', 'Bílý Přema', '6', '10106', '0', '0', '15', '60', '0', '20', '24', '16');
INSERT INTO bowling_players VALUES ('24', 'Zetek Martin', '4', '4041', '0', '0', '6', '24', '0', '0', '8', '16');
INSERT INTO bowling_players VALUES ('25', 'Irglová Jana', '5', '12122', '0', '1', '18', '72', '0', '8', '32', '32');
INSERT INTO bowling_players VALUES ('26', 'Novosad Robert', '9', '8388', '0', '0', '13', '50', '0', '8', '22', '20');
INSERT INTO bowling_players VALUES ('27', 'Petrnek Libor', '2', '14735', '0', '-1', '22', '88', '0', '28', '36', '24');
INSERT INTO bowling_players VALUES ('28', 'Dobias Pepa', '4', '15396', '0', '0', '23', '92', '0', '32', '28', '32');
INSERT INTO bowling_players VALUES ('29', 'Cahlík Jindra', '2', '3343', '0', '1', '5', '20', '0', '8', '0', '12');
INSERT INTO bowling_players VALUES ('30', 'Felčír David', '1', '4663', '0', '-1', '7', '28', '0', '0', '8', '20');
INSERT INTO bowling_players VALUES ('31', 'Stromšík Roman', '3', '665', '0', '0', '1', '4', '0', '0', '0', '4');
INSERT INTO bowling_players VALUES ('32', 'Kamas Pepa', '1', '8633', '0', '0', '13', '52', '0', '24', '16', '12');
INSERT INTO bowling_players VALUES ('33', 'Stromšíková Anička', '3', '11948', '0', '1', '18', '72', '0', '24', '24', '24');
INSERT INTO bowling_players VALUES ('34', 'Adámek Láďa', '7', '14591', '0', '-1', '22', '88', '0', '24', '32', '32');
INSERT INTO bowling_players VALUES ('35', 'Hermanová Maruška', '5', '9944', '0', '0', '15', '60', '0', '28', '32', '0');
INSERT INTO bowling_players VALUES ('36', 'Petrnek Ivan ©', '7', '15862', '0', '1', '24', '96', '0', '32', '32', '32');
INSERT INTO bowling_players VALUES ('37', 'Konvičný Rosťa', '9', '12518', '0', '1', '19', '76', '0', '28', '24', '24');
INSERT INTO bowling_players VALUES ('38', 'Žmolík Jirka', '8', '7900', '0', '0', '12', '48', '0', '16', '20', '12');
INSERT INTO bowling_players VALUES ('39', 'Bazalka Mira', '4', '7560', '0', '0', '12', '46', '0', '10', '20', '16');
INSERT INTO bowling_players VALUES ('40', 'Irgl Marek', '5', '7876', '0', '0', '12', '48', '0', '12', '8', '28');
INSERT INTO bowling_players VALUES ('41', 'Machanec Staňa ©', '4', '9795', '0', '0', '15', '60', '0', '28', '4', '28');
INSERT INTO bowling_players VALUES ('42', 'Bělohlávek M.', '3', '651', '0', '0', '1', '4', '0', '4', '0', '0');
INSERT INTO bowling_players VALUES ('43', 'Smeta Dan', '8', '3249', '0', '0', '5', '20', '0', '16', '4', '0');
INSERT INTO bowling_players VALUES ('44', 'Bobek Zdeňa ©', '6', '10307', '0', '-1', '16', '64', '0', '20', '20', '24');
INSERT INTO bowling_players VALUES ('45', 'Váňová Inka ©', '5', '12862', '0', '1', '20', '80', '0', '28', '20', '32');
INSERT INTO bowling_players VALUES ('46', 'Drda Pavel', '4', '643', '0', '0', '1', '4', '0', '0', '4', '0');
INSERT INTO bowling_players VALUES ('47', 'Ottopal Robert', '6', '6429', '0', '1', '10', '40', '0', '12', '16', '12');
INSERT INTO bowling_players VALUES ('48', 'Pernický Roman', '6', '3852', '0', '0', '6', '24', '0', '4', '8', '12');
INSERT INTO bowling_players VALUES ('49', 'Orság Radek', '3', '6017', '0', '1', '10', '38', '0', '16', '14', '8');
INSERT INTO bowling_players VALUES ('50', 'Petrnek Ivo', '7', '12634', '0', '-1', '20', '80', '0', '24', '28', '28');
INSERT INTO bowling_players VALUES ('51', 'Žamboch Jan ©', '9', '6307', '0', '1', '10', '40', '0', '8', '16', '16');
INSERT INTO bowling_players VALUES ('52', 'Martínková Míša', '6', '8095', '0', '1', '13', '52', '0', '20', '12', '20');
INSERT INTO bowling_players VALUES ('53', 'Chocholatý Miroslav', '8', '6212', '0', '0', '10', '40', '0', '20', '16', '4');
INSERT INTO bowling_players VALUES ('54', 'Mohyla Pavel', '9', '7138', '0', '0', '12', '46', '0', '24', '10', '12');
INSERT INTO bowling_players VALUES ('55', 'Konvičný Martin', '9', '8030', '0', '1', '13', '52', '0', '0', '20', '32');
INSERT INTO bowling_players VALUES ('56', 'Folta Radim', '4', '10153', '0', '0', '17', '66', '0', '26', '28', '12');
INSERT INTO bowling_players VALUES ('57', 'Nohavica Karel', '8', '6756', '0', '0', '11', '44', '0', '12', '16', '16');
INSERT INTO bowling_players VALUES ('58', 'Matochová Radka', '7', '6114', '0', '0', '10', '40', '0', '16', '12', '12');
INSERT INTO bowling_players VALUES ('59', 'Matyšťák Oliver', '8', '5465', '0', '0', '9', '36', '0', '8', '12', '16');
INSERT INTO bowling_players VALUES ('60', 'Helešic Tomáš', '8', '5440', '0', '-1', '9', '36', '0', '16', '8', '12');
INSERT INTO bowling_players VALUES ('61', 'Tobola Evžen', '2', '2409', '0', '0', '4', '16', '0', '8', '8', '0');
INSERT INTO bowling_players VALUES ('62', 'Polách Pavel', '8', '5869', '0', '1', '10', '40', '0', '12', '12', '16');
INSERT INTO bowling_players VALUES ('63', 'Grycová Katka', '5', '2916', '0', '0', '5', '20', '0', '20', '0', '0');
INSERT INTO bowling_players VALUES ('64', 'Číp Luděk', '9', '5809', '0', '0', '10', '40', '0', '20', '20', '0');
INSERT INTO bowling_players VALUES ('65', 'Rada Zdeněk', '5', '4011', '0', '1', '7', '28', '0', '0', '16', '12');
INSERT INTO bowling_players VALUES ('66', 'Fiala Tomáš', '8', '3978', '0', '1', '7', '28', '0', '0', '8', '20');
INSERT INTO bowling_players VALUES ('67', 'Bauer Eda', '7', '10645', '0', '-1', '19', '76', '0', '28', '24', '24');
INSERT INTO bowling_players VALUES ('68', 'Kortyš Jiří', '8', '6624', '0', '1', '12', '48', '0', '16', '12', '20');
INSERT INTO bowling_players VALUES ('69', 'Konvičná Květa', '9', '8267', '0', '1', '15', '60', '0', '28', '12', '20');
INSERT INTO bowling_players VALUES ('70', 'Pospíšil Igor', '3', '543', '0', '0', '1', '4', '0', '0', '0', '4');
INSERT INTO bowling_players VALUES ('71', 'Gartus Daniel', '2', '1304', '0', '1', '3', '10', '0', '4', '0', '6');
INSERT INTO bowling_players VALUES ('72', 'Petružela', '3', '1040', '0', '0', '2', '8', '0', '8', '0', '0');
INSERT INTO bowling_players VALUES ('73', 'Miškařiková Lucie', '7', '520', '0', '0', '1', '4', '0', '4', '0', '0');
INSERT INTO bowling_players VALUES ('74', 'Šobora Petr', '1', '514', '0', '0', '1', '4', '0', '0', '4', '0');
INSERT INTO bowling_players VALUES ('75', 'Slováková M.', '3', '495', '0', '0', '1', '4', '0', '4', '0', '0');
INSERT INTO bowling_players VALUES ('76', 'Frkal', '9', '1427', '0', '0', '3', '12', '0', '8', '0', '4');
INSERT INTO bowling_players VALUES ('77', 'Brouwerová', '5', '428', '0', '0', '1', '4', '0', '4', '0', '0');
INSERT INTO bowling_players VALUES ('78', 'Pavlištíková', '9', '420', '0', '0', '1', '4', '0', '4', '0', '0');
INSERT INTO bowling_players VALUES ('79', 'Bil Miroslav', '9', '386', '0', '0', '1', '4', '0', '0', '4', '0');


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

INSERT INTO bowling_price VALUES ('1', 'Pondělí', '180', '10:00 - 17:00', '200', '17:00 - 23:00');
INSERT INTO bowling_price VALUES ('2', 'Úterý', '180', '10:00 - 17:00', '200', '17:00 - 23:00');
INSERT INTO bowling_price VALUES ('3', 'Středa', '180', '10:00 - 17:00', '200', '17:00 - 23:00');
INSERT INTO bowling_price VALUES ('4', 'Čtvrtek', '180', '10:00 - 17:00', '200', '17:00 - 23:00');
INSERT INTO bowling_price VALUES ('5', 'Pátek', '180', '10:00 - 17:00', '200', '17:00 - 23:00');
INSERT INTO bowling_price VALUES ('6', 'Sobota', '200', '10:00 - 17:00', '220', '17:00 - 23:00');
INSERT INTO bowling_price VALUES ('7', 'Neděle', '220', '10:00 - 17:00', '220', '17:00 - 23:00');


DROP TABLE IF EXISTS bowling_round_days;

CREATE TABLE `bowling_round_days` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `round` int(10) DEFAULT NULL,
  `date` varchar(25) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO bowling_round_days VALUES ('1', '1', '5.5.2015');


DROP TABLE IF EXISTS bowling_round_times;

CREATE TABLE `bowling_round_times` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `day` int(10) DEFAULT NULL,
  `time` varchar(25) COLLATE utf8_czech_ci DEFAULT NULL,
  `played` int(1) DEFAULT NULL,
  `alternative` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `team_a` int(5) DEFAULT NULL,
  `team_b` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO bowling_round_times VALUES ('1', '1', '21:52', '0', '0', '3', '5');
INSERT INTO bowling_round_times VALUES ('2', '1', '22:30', '0', '0', '4', '8');


DROP TABLE IF EXISTS bowling_rounds;

CREATE TABLE `bowling_rounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `season` varchar(10) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO bowling_rounds VALUES ('1', 'Podzim');


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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO bowling_teams VALUES ('1', 'Drahop', '66288', '172.6', '1', '24', '228', '43');
INSERT INTO bowling_teams VALUES ('2', 'A je dem', '65182', '169.7', '-1', '24', '178', '35');
INSERT INTO bowling_teams VALUES ('3', 'No name', '64529', '168', '1', '24', '190', '32');
INSERT INTO bowling_teams VALUES ('4', 'Crazy frog', '61348', '159.8', '-1', '24', '167', '28');
INSERT INTO bowling_teams VALUES ('5', 'Kulový blesk', '63650', '165.8', '1', '24', '144', '25');
INSERT INTO bowling_teams VALUES ('6', 'Kuchtíci', '61169', '159.3', '1', '24', '153', '24');
INSERT INTO bowling_teams VALUES ('7', 'Glass school', '60366', '157.2', '-1', '24', '121', '17');
INSERT INTO bowling_teams VALUES ('8', 'For Fun', '58960', '153.5', '-1', '24', '65', '10');
INSERT INTO bowling_teams VALUES ('9', 'Misáci', '58696', '152.9', '1', '24', '50', '2');


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

INSERT INTO main_news VALUES ('bowling', '', '', '0', '0');
INSERT INTO main_news VALUES ('roznov-pod-radhostem', '', '', '0', '0');
INSERT INTO main_news VALUES ('valasske-mezirici', '', '', '0', '0');


DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` text,
  `real_firstname` varchar(50) DEFAULT NULL,
  `real_lastname` varchar(50) DEFAULT NULL,
  `avatar` int(2) DEFAULT NULL,
  `banned` int(1) DEFAULT NULL,
  `activetime` int(10) DEFAULT NULL,
  `bantime` int(10) DEFAULT '0',
  `role` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO users VALUES ('4', 'jan.kotrbaa@gmail.com', '$2y$10$w5xOYqw4l.34h5wCSvT4gOev.FIyqBZHOIl1LUZC.SCSLyqfdHwdm', 'Jan', 'Kotrba', '2', '0', '1430315397', '0', '0');
INSERT INTO users VALUES ('12', 'janbartonn@gmail.com', '$2y$10$wMrzf/FN1qjtqTG820gGtevnNx.uTjbulEVh/cP9HJdOYaFD8Xn8O', 'Jan', 'Barton', '6', '0', '142427226', '1429126194', '0');
INSERT INTO users VALUES ('14', 'contact.janik@seznam.cz', '$2y$10$2CSZz6ixlq3EK4mMy3L5Ru9ySmJfcCpoMMOZW6VwcW0wjR4RoqsNW', 'David', 'Janík', '2', '0', '1428429495', '0', '0');


DROP TABLE IF EXISTS users_recovery_tokens;

CREATE TABLE `users_recovery_tokens` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` int(5) DEFAULT NULL,
  `token` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `timestamp` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;



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
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO visitors VALUES ('17', '::1', 'avgp6j550vmk7glc2emngimik7', 'http://localhost/LaVidaCubana/www/bowling/chci-si-zahrat', 'Web:Bowling:play', '1428594091', '4');
INSERT INTO visitors VALUES ('18', '::1', 'avgp6j550vmk7glc2emngimik7', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1428594185', '4');
INSERT INTO visitors VALUES ('19', '::1', 'avgp6j550vmk7glc2emngimik7', 'http://localhost/LaVidaCubana/www/bowling/pravidla', 'Web:Bowling:rules', '1428564185', '4');
INSERT INTO visitors VALUES ('20', '::1', 'avgp6j550vmk7glc2emngimik7', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1428608358', '1');
INSERT INTO visitors VALUES ('21', '::1', 'avgp6j550vmk7glc2emngimik7', 'http://localhost/LaVidaCubana/www/roznov-pod-radhostem/', 'Web:Roznov:default', '1428608360', '4');
INSERT INTO visitors VALUES ('22', '::1', 'avgp6j550vmk7glc2emngimik7', 'http://localhost/LaVidaCubana/www/valasske-mezirici/', 'Web:Valmez:default', '1428608888', '');
INSERT INTO visitors VALUES ('23', '::1', '458ab50ula56t14qf0jhgtsmn3', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1428955015', '');
INSERT INTO visitors VALUES ('24', '::1', '458ab50ula56t14qf0jhgtsmn3', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1428955017', '');
INSERT INTO visitors VALUES ('25', '::1', '4plg4mkdi0diurgj64esgoub20', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429020962', '');
INSERT INTO visitors VALUES ('26', '::1', '4plg4mkdi0diurgj64esgoub20', 'http://localhost/LaVidaCubana/www/roznov-pod-radhostem/', 'Web:Roznov:default', '1429020966', '');
INSERT INTO visitors VALUES ('27', '::1', '4plg4mkdi0diurgj64esgoub20', 'http://localhost/LaVidaCubana/www/valasske-mezirici/', 'Web:Valmez:default', '1429020971', '');
INSERT INTO visitors VALUES ('28', '::1', '4plg4mkdi0diurgj64esgoub20', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1429021080', '');
INSERT INTO visitors VALUES ('29', '::1', '4plg4mkdi0diurgj64esgoub20', 'http://localhost/LaVidaCubana/www/bowling/rozpis', 'Web:Bowling:draft', '1429021098', '');
INSERT INTO visitors VALUES ('30', '::1', '4plg4mkdi0diurgj64esgoub20', 'http://localhost/LaVidaCubana/www/bowling/top-3', 'Web:Bowling:top', '1429021200', '');
INSERT INTO visitors VALUES ('31', '::1', '4plg4mkdi0diurgj64esgoub20', 'http://localhost/LaVidaCubana/www/bowling/chci-si-zahrat', 'Web:Bowling:play', '1429027358', '');
INSERT INTO visitors VALUES ('32', '::1', '4plg4mkdi0diurgj64esgoub20', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-liga', 'Web:Bowling:league', '1429046540', '');
INSERT INTO visitors VALUES ('33', '::1', '4plg4mkdi0diurgj64esgoub20', 'http://localhost/LaVidaCubana/www/bowling/aktualne', 'Web:Bowling:news', '1429084006', '');
INSERT INTO visitors VALUES ('34', '127.0.0.1', '4plg4mkdi0diurgj64esgoub20', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429102658', '');
INSERT INTO visitors VALUES ('35', '::1', 'k5rq45hjul6vl9ckspj429kse7', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429214157', '');
INSERT INTO visitors VALUES ('36', '::1', 'k5rq45hjul6vl9ckspj429kse7', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1429531984', '');
INSERT INTO visitors VALUES ('37', '127.0.0.1', 'k5rq45hjul6vl9ckspj429kse7', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429538806', '');
INSERT INTO visitors VALUES ('38', '::1', 'rek2p666p9ek8kik3h0ogut1v7', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429122947', '');
INSERT INTO visitors VALUES ('39', '::1', 'rek2p666p9ek8kik3h0ogut1v7', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1429122950', '');
INSERT INTO visitors VALUES ('40', '::1', 'rek2p666p9ek8kik3h0ogut1v7', 'http://localhost/LaVidaCubana/www/bowling/pravidla', 'Web:Bowling:rules', '1429122953', '');
INSERT INTO visitors VALUES ('41', '::1', 'rek2p666p9ek8kik3h0ogut1v7', 'http://localhost/LaVidaCubana/www/bowling/rozpis', 'Web:Bowling:draft', '1429122957', '');
INSERT INTO visitors VALUES ('42', '::1', 'rek2p666p9ek8kik3h0ogut1v7', 'http://localhost/LaVidaCubana/www/bowling/aktualne', 'Web:Bowling:news', '1429122960', '');
INSERT INTO visitors VALUES ('43', '::1', 'rek2p666p9ek8kik3h0ogut1v7', 'http://localhost/LaVidaCubana/www/bowling/chci-si-zahrat', 'Web:Bowling:play', '1429122965', '');
INSERT INTO visitors VALUES ('44', '::1', '', 'http://localhost/LaVidaCubana/www/bowling/chci-si-zahrat', 'Web:Bowling:play', '1429123054', '');
INSERT INTO visitors VALUES ('45', '::1', '', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1429123104', '');
INSERT INTO visitors VALUES ('46', '::1', '', 'http://localhost/LaVidaCubana/www/bowling/pravidla', 'Web:Bowling:rules', '1429123115', '');
INSERT INTO visitors VALUES ('47', '127.0.0.1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429189093', '');
INSERT INTO visitors VALUES ('48', '127.0.0.1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1429189096', '');
INSERT INTO visitors VALUES ('49', '::1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429629359', '');
INSERT INTO visitors VALUES ('50', '::1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1429629362', '');
INSERT INTO visitors VALUES ('51', '::1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/bowling/chci-si-zahrat', 'Web:Bowling:play', '1429629370', '');
INSERT INTO visitors VALUES ('52', '::1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-liga', 'Web:Bowling:league', '1429632329', '');
INSERT INTO visitors VALUES ('53', '::1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-liga/strana/4', 'Web:Bowling:league', '1429646127', '');
INSERT INTO visitors VALUES ('54', '::1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-liga/strana', 'Web:Bowling:league', '1429646142', '');
INSERT INTO visitors VALUES ('55', '::1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-liga/strana/2', 'Web:Bowling:league', '1429646501', '');
INSERT INTO visitors VALUES ('56', '::1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-liga/strana/3', 'Web:Bowling:league', '1429646852', '');
INSERT INTO visitors VALUES ('57', '::1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-ligastrana/4', 'Web:Bowling:league', '1429646944', '');
INSERT INTO visitors VALUES ('58', '::1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-liga?page=4', 'Web:Bowling:league', '1429649968', '');
INSERT INTO visitors VALUES ('59', '::1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-liga?page=3', 'Web:Bowling:league', '1429649970', '');
INSERT INTO visitors VALUES ('60', '::1', '2tnnsfv9vnrffpv3rnj0pg8p32', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-liga?page=1', 'Web:Bowling:league', '1429650031', '');
INSERT INTO visitors VALUES ('61', '127.0.0.1', '4kqgehfeq9rmn3rrpt5jaeq962', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429709597', '');
INSERT INTO visitors VALUES ('62', '127.0.0.1', '4kqgehfeq9rmn3rrpt5jaeq962', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1429710216', '');
INSERT INTO visitors VALUES ('63', '::1', 'dbitc053juo761qi5hsh4e1592', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429712487', '');
INSERT INTO visitors VALUES ('64', '::1', 'dbitc053juo761qi5hsh4e1592', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1429712490', '');
INSERT INTO visitors VALUES ('65', '::1', 'j8qtlfjd74d23s5kbsgbqmu6d1', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429719293', '');
INSERT INTO visitors VALUES ('66', '::1', '8pv9l0nkp3bgn2pbdtbfs2kk25', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429719370', '');
INSERT INTO visitors VALUES ('67', '::1', '8pv9l0nkp3bgn2pbdtbfs2kk25', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1429719433', '');
INSERT INTO visitors VALUES ('68', '::1', '8pv9l0nkp3bgn2pbdtbfs2kk25', 'http://localhost/LaVidaCubana/www/bowling/chci-si-zahrat', 'Web:Bowling:play', '1429723424', '');
INSERT INTO visitors VALUES ('69', '::1', '8pv9l0nkp3bgn2pbdtbfs2kk25', 'http://localhost/LaVidaCubana/www/bowling/top-3', 'Web:Bowling:top', '1429723501', '');
INSERT INTO visitors VALUES ('70', '::1', '8pv9l0nkp3bgn2pbdtbfs2kk25', 'http://localhost/LaVidaCubana/www/bowling/aktualne', 'Web:Bowling:news', '1429723504', '');
INSERT INTO visitors VALUES ('71', '::1', '8pv9l0nkp3bgn2pbdtbfs2kk25', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-liga', 'Web:Bowling:league', '1429723512', '');
INSERT INTO visitors VALUES ('72', '::1', '8pv9l0nkp3bgn2pbdtbfs2kk25', 'http://localhost/LaVidaCubana/www/bowling/pravidla', 'Web:Bowling:rules', '1429724428', '');
INSERT INTO visitors VALUES ('73', '::1', '', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429733689', '');
INSERT INTO visitors VALUES ('74', '::1', 'r9crkumaboiqt4gr7dc5sdhu43', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1429772044', '');
INSERT INTO visitors VALUES ('75', '::1', '2p9vcvcnblrbvu7lck2tigl8g5', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429792984', '');
INSERT INTO visitors VALUES ('76', '::1', '2p9vcvcnblrbvu7lck2tigl8g5', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1429792987', '');
INSERT INTO visitors VALUES ('77', '::1', '147mdn8ieh1g0bs8p9s048rgn1', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429793429', '');
INSERT INTO visitors VALUES ('78', '::1', '147mdn8ieh1g0bs8p9s048rgn1', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1429793490', '');
INSERT INTO visitors VALUES ('79', '::1', '147mdn8ieh1g0bs8p9s048rgn1', 'http://localhost/LaVidaCubana/www/bowling/chci-si-zahrat', 'Web:Bowling:play', '1429793492', '');
INSERT INTO visitors VALUES ('80', '::1', '147mdn8ieh1g0bs8p9s048rgn1', 'http://localhost/LaVidaCubana/www/bowling/aktualne', 'Web:Bowling:news', '1429793513', '');
INSERT INTO visitors VALUES ('81', '::1', '147mdn8ieh1g0bs8p9s048rgn1', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-liga', 'Web:Bowling:league', '1429793583', '');
INSERT INTO visitors VALUES ('82', '::1', '147mdn8ieh1g0bs8p9s048rgn1', 'http://localhost/LaVidaCubana/www/bowling/rozpis', 'Web:Bowling:draft', '1429793584', '');
INSERT INTO visitors VALUES ('83', '::1', '5ng7828r0kglmovhb22gh290p2', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429811172', '');
INSERT INTO visitors VALUES ('84', '::1', 'copejo3gasn8hul5mgm4ck1t13', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429814958', '');
INSERT INTO visitors VALUES ('85', '::1', 'uojd4gv1sqdtl1jee3716ueor3', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429814996', '');
INSERT INTO visitors VALUES ('86', '::1', 'g9b6ko5gsnl16d00d2n09ot5k4', 'http://localhost/LaVidaCubana/www/valasske-mezirici/', 'Web:Valmez:default', '1429815000', '');
INSERT INTO visitors VALUES ('87', '::1', 'g9b6ko5gsnl16d00d2n09ot5k4', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429815005', '');
INSERT INTO visitors VALUES ('88', '::1', 'g9b6ko5gsnl16d00d2n09ot5k4', 'http://localhost/LaVidaCubana/www/roznov-pod-radhostem/', 'Web:Roznov:default', '1429815007', '');
INSERT INTO visitors VALUES ('89', '::1', '2mmdd24hh3t0844f2jlfjkem42', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1429857322', '');
INSERT INTO visitors VALUES ('90', '::1', 'k0kqnshqlvudm2g7gfgvl0gcl3', 'http://localhost/LaVidaCubana/www/', 'Web:Homepage:default', '1430771361', '');
INSERT INTO visitors VALUES ('91', '::1', 'k0kqnshqlvudm2g7gfgvl0gcl3', 'http://localhost/LaVidaCubana/www/bowling/', 'Web:Bowling:default', '1430771485', '');
INSERT INTO visitors VALUES ('92', '::1', 'k0kqnshqlvudm2g7gfgvl0gcl3', 'http://localhost/LaVidaCubana/www/bowling/bowlingova-liga', 'Web:Bowling:league', '1430771540', '');
INSERT INTO visitors VALUES ('93', '::1', 'k0kqnshqlvudm2g7gfgvl0gcl3', 'http://localhost/LaVidaCubana/www/bowling/rozpis', 'Web:Bowling:draft', '1430771608', '');
INSERT INTO visitors VALUES ('94', '::1', 'k0kqnshqlvudm2g7gfgvl0gcl3', 'http://localhost/LaVidaCubana/www/bowling/chci-si-zahrat', 'Web:Bowling:play', '1430771661', '');
INSERT INTO visitors VALUES ('95', '::1', 'k0kqnshqlvudm2g7gfgvl0gcl3', 'http://localhost/LaVidaCubana/www/bowling/top-3', 'Web:Bowling:top', '1430771721', '');
INSERT INTO visitors VALUES ('96', '::1', 'k0kqnshqlvudm2g7gfgvl0gcl3', 'http://localhost/LaVidaCubana/www/bowling/aktualne', 'Web:Bowling:news', '1430771723', '');


