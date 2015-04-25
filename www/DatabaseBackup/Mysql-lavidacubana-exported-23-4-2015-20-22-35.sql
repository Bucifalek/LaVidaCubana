DROP TABLE IF EXISTS bowling_draft;

CREATE TABLE `bowling_draft` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `season` varchar(10) COLLATE utf8_czech_ci DEFAULT NULL,
  `date` int(10) DEFAULT NULL,
  `round_num` int(3) DEFAULT NULL,
  `day_num` int(1) DEFAULT NULL,
  `first_match_time` varchar(10) COLLATE utf8_czech_ci DEFAULT NULL,
  `first_match_team_1` int(5) DEFAULT NULL,
  `first_match_team_2` int(5) DEFAULT NULL,
  `second_match_time` varchar(10) COLLATE utf8_czech_ci DEFAULT NULL,
  `second_match_team_1` int(5) DEFAULT NULL,
  `second_match_team_2` int(5) DEFAULT NULL,
  `played` int(1) DEFAULT NULL,
  `alternative_date` varchar(10) COLLATE utf8_czech_ci DEFAULT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO bowling_players VALUES ('3', 'Váša Tonda', '7', '8168', '186', '0', '11', '44', '0');
INSERT INTO bowling_players VALUES ('4', 'Rešetko Martin', '3', '8754', '182', '1', '12', '48', '0');
INSERT INTO bowling_players VALUES ('5', 'Gartus Zden?k', '4', '2180', '182', '-1', '3', '12', '0');
INSERT INTO bowling_players VALUES ('6', 'Heitel Lukáš', '3', '6358', '177', '-1', '9', '36', '0');
INSERT INTO bowling_players VALUES ('7', 'Folta Franta', '2', '5638', '176', '1', '8', '32', '0');
INSERT INTO bowling_players VALUES ('8', 'Mikliš Petr', '1', '3522', '176', '0', '5', '20', '0');
INSERT INTO bowling_players VALUES ('9', 'Fojtík F.', '2', '3857', '175', '0', '6', '22', '0');
INSERT INTO bowling_players VALUES ('10', 'Skalka Roman', '3', '2795', '175', '0', '4', '16', '0');
INSERT INTO bowling_players VALUES ('12', 'Novosad Robert', '4', '3807', '173', '-1', '6', '22', '0');
INSERT INTO bowling_players VALUES ('13', 'Ševe?ek Petr', '3', '6229', '173', '-1', '9', '36', '0');
INSERT INTO bowling_players VALUES ('14', 'Pavela Jirka', '2', '2752', '172', '1', '4', '16', '0');
INSERT INTO bowling_players VALUES ('15', 'Fojtíková Ivana', '1', '8930', '172', '1', '13', '52', '0');
INSERT INTO bowling_players VALUES ('16', 'Topi? Zde?a', '2', '6868', '172', '1', '10', '40', '0');
INSERT INTO bowling_players VALUES ('17', 'Mi?olová Martina', '3', '2402', '172', '1', '4', '14', '0');
INSERT INTO bowling_players VALUES ('18', 'Klímová Pavla', '4', '5476', '171', '1', '8', '32', '0');
INSERT INTO bowling_players VALUES ('19', 'Masnota Karel', '5', '6799', '170', '-1', '10', '40', '0');
INSERT INTO bowling_players VALUES ('20', 'Capil Radek', '6', '8155', '170', '1', '12', '48', '0');
INSERT INTO bowling_players VALUES ('21', 'Petrnek Libor', '7', '9443', '169', '1', '14', '56', '0');
INSERT INTO bowling_players VALUES ('22', 'Bílý P?ema', '7', '6724', '168', '1', '10', '40', '0');
INSERT INTO bowling_players VALUES ('23', 'Šobora Radek ©', '7', '9376', '167', '1', '14', '56', '0');
INSERT INTO bowling_players VALUES ('24', 'Dobias Pepa', '6', '8698', '167', '0', '13', '52', '0');
INSERT INTO bowling_players VALUES ('25', 'Žmolík Jirka', '6', '5349', '167', '0', '8', '32', '0');
INSERT INTO bowling_players VALUES ('26', 'Adámek Lá?a', '5', '7981', '166', '1', '12', '48', '0');
INSERT INTO bowling_players VALUES ('27', 'Konvi?ný Ros?a', '5', '8583', '165', '0', '13', '52', '0');
INSERT INTO bowling_players VALUES ('28', 'Št?pánek Michal', '5', '2638', '165', '0', '4', '16', '0');
INSERT INTO bowling_players VALUES ('29', 'Kamas Pepa', '4', '5920', '164', '1', '9', '36', '0');
INSERT INTO bowling_players VALUES ('30', 'Hermanová Maruška', '4', '8529', '164', '-1', '13', '52', '0');
INSERT INTO bowling_players VALUES ('31', 'Kostka Lá?a', '4', '5574', '164', '0', '9', '34', '0');
INSERT INTO bowling_players VALUES ('32', 'St?ít?zský Radomír', '3', '3932', '164', '1', '6', '24', '0');
INSERT INTO bowling_players VALUES ('33', 'Kolá?ek Honza', '0', '2621', '164', '0', '4', '16', '0');
INSERT INTO bowling_players VALUES ('34', 'jeje', '8', '0', '0', '0', '0', '0', '0');
INSERT INTO bowling_players VALUES ('35', 'Jan Kotrba', '10', '0', '0', '0', '0', '0', '0');
INSERT INTO bowling_players VALUES ('36', 'David Janík', '0', '0', '0', '0', '0', '0', '0');


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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO bowling_teams VALUES ('1', 'Drahop', '40760', '10.7', '1', '15', '141', '26');
INSERT INTO bowling_teams VALUES ('2', 'A je dem', '40760', '1', '0', '14', '102', '20');
INSERT INTO bowling_teams VALUES ('3', 'No name', '40760', '1', '0', '14', '98', '18');
INSERT INTO bowling_teams VALUES ('4', 'Kulový blesk', '40760', '0', '0', '14', '84', '14');
INSERT INTO bowling_teams VALUES ('5', 'Crazy frog', '40760', '6', '-1', '14', '76', '14');
INSERT INTO bowling_teams VALUES ('6', 'Kuchtíci', '40760', '9', '-1', '13', '74', '12');
INSERT INTO bowling_teams VALUES ('7', 'Glass school', '40760', '6', '0', '10', '72', '12');
INSERT INTO bowling_teams VALUES ('8', 'For Fun', '40760', '4', '0', '11', '65', '8');
INSERT INTO bowling_teams VALUES ('10', 'KotysLAB', '0', '0', '0', '0', '0', '0');


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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO users VALUES ('4', 'jan.kotrbaa@gmail.com', '$2y$10$j43LfpoLgTBSScZcjDNN1.CJejqkmrHIGDiv6Gz4s2wLmwjVwUWla', 'Jan', 'Kotrba', '2', '0', '1429813355', '0', '0');
INSERT INTO users VALUES ('12', 'janbartonn@gmail.com', '$2y$10$wMrzf/FN1qjtqTG820gGtevnNx.uTjbulEVh/cP9HJdOYaFD8Xn8O', 'Jan', 'Barton', '6', '0', '142427226', '1429126194', '0');
INSERT INTO users VALUES ('14', 'contact.janik@seznam.cz', '$2y$10$2CSZz6ixlq3EK4mMy3L5Ru9ySmJfcCpoMMOZW6VwcW0wjR4RoqsNW', 'David', 'Janík', '2', '0', '1428429495', '0', '0');


DROP TABLE IF EXISTS users_recovery_tokens;

CREATE TABLE `users_recovery_tokens` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` int(5) DEFAULT NULL,
  `token` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `timestamp` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;



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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

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


