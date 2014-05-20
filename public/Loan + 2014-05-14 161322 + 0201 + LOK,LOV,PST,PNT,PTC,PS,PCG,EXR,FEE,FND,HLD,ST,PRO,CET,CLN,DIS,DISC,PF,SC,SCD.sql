-- Microfis SQL Backup/Restore 
-- Version 2.0 
-- Generation Time: 2014-May-14 04:13:22 PM
-- Database: Loan
-- Branch Office: 0201
-- Tables Type: LOK, LOV, PST, PNT, PTC, PS, PCG, EXR, FEE, FND, HLD, ST, PRO, CET, CLN, DIS, DISC, PF, SC, SCD 
-- Developed by: Battambang IT Team. 
 
-- --------------------------------------------------------;

--
-- Backup Table: ln_lookup
--;

CREATE TABLE IF NOT EXISTS `ln_lookup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ln_lookup_name_unique` (`name`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_lookup ;
 INSERT INTO ln_lookup VALUES('1','AccType','Account Type','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('2','RepayType','Repay Frequency','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('3','Holiday','Holiday Rule','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('4','IntType','Interest Type','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('5','LAType','Loan Amount Type','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('6','FeeType','Fee Type','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('7','FeeCalType','Fee Calculate Type','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('8','FeePerOf','Fee Percentage Of','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('9','PenalType','Penalty Type','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('10','PenalCalType','Penalty Calculate Type','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('11','PenalPerOf','Penalty Percentage Of','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('12','MeetingW','Meeting Weekly','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('13','MeetingM','Meeting Monthly','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('14','ID','ID Type','Super','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('15','Gender','Gender','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('16','MStatus','Marital Status','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('17','Education','Education','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('18','Title','Title','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('19','Nation','Nationality','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('20','Bussiness','Business','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('21','PStatus','Poverty Status','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('22','Handicap','Handicap','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('23','ConType','Contact Type','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('24','Geo','Geography','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('25','History','History','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('26','Purp','Purpose','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('27','Activity','Activity','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('28','CollType','Collateral Type','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup VALUES('29','Secur','Security','Admin','2014-01-01 00:00:00','0000-00-00 00:00:00');

--
-- Backup Table: ln_lookup_value
--;

CREATE TABLE IF NOT EXISTS `ln_lookup_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ln_lookup_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ln_lookup_value_ln_lookup_id_foreign` (`ln_lookup_id`) USING BTREE,
  CONSTRAINT `ln_lookup_value_ibfk_1` FOREIGN KEY (`ln_lookup_id`) REFERENCES `ln_lookup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

 DELETE FROM ln_lookup_value ;
 INSERT INTO ln_lookup_value VALUES('1','S','Single','1','2014-01-01 02:04:00','2014-03-21 11:29:17');
 INSERT INTO ln_lookup_value VALUES('2','G','Group','1','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('3','W','Weekly','2','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('4','M','Monthly','2','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('5','SWD','Same Work Day','3','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('6','NWD','Next Work Day','3','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('7','PWD','Previous Work Day','3','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('8','DB','Declining Balance','4','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('9','FL','Flate','4','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('10','NO','None','5','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('11','SL','The Same For Loan','5','2014-01-01 02:04:00','2014-02-14 09:47:24');
 INSERT INTO ln_lookup_value VALUES('12','LD','Loan Disbursment','6','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('13','FR','First Repayment','6','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('14','PA','Installment Pricipal Amount','6','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('15','A','Amount','7','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('16','P','Percentage','7','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('17','LA','Loan Amount','8','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('18','LI','Loan Amount and Interest','8','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('19','IT','Interest','8','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('20','D','Daily','9','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('21','W','Weekly','9','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('22','M','Monthly','9','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('23','A','Amount','10','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('24','P','Percentage','10','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('25','OP','Overdue Print','11','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('26','OI','Overdue Print and Interest','11','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('27','1','Mon','12','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('28','2','Tue','12','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('29','3','Wed','12','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('30','4','Thu','12','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('31','5','Fri','12','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('32','6','Sat','12','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('33','1','1','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('34','2','2','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('35','3','3','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('36','4','4','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('37','5','5','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('38','6','6','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('39','7','7','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('40','8','8','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('41','9','9','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('42','10','10','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('43','11','11','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('44','12','12','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('45','13','13','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('46','14','14','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('47','15','15','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('48','16','16','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('49','17','17','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('50','18','18','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('51','19','19','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('52','20','20','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('53','21','21','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('54','22','22','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('55','23','23','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('56','24','24','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('57','25','25','13','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('58','N','National ID','14','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('59','F','Family Book','14','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('60','P','Passport','14','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('61','D','Driver License','14','2014-01-01 02:04:00','2014-03-21 11:26:15');
 INSERT INTO ln_lookup_value VALUES('62','G','Government Issue ID','14','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('63','B','B-Birth Certificate','14','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('64','V','Voter Reg Card','14','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('65','T','Tax Number','14','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('66','R','Residence Book','14','2014-01-01 02:04:00','2014-03-21 09:55:18');
 INSERT INTO ln_lookup_value VALUES('67','M','Male','15','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('68','F','Female','15','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('69','S','Single','16','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('70','M','Married','16','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('71','D','Divorced','16','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('72','NA','Non Applicable','17','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('73','PS','Primary School','17','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('74','HS','High School','17','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('75','BS','Bachelor Degree','17','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('76','MS','Master Degree','17','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('77','DD','Doctor Degree','17','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('78','LO','Loan Officer','18','2014-01-01 02:04:00','2014-03-21 11:06:24');
 INSERT INTO ln_lookup_value VALUES('79','KH','Khmer','19','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('80','AG','Agriculture','20','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('81','TC','Trade And Commerce','20','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('82','SV','Service','20','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('83','TS','Transportation','20','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('84','CS','Construction','20','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('85','OC','Other Category','20','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('86','V','Very Poor','21','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('87','P','Poor','21','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('88','A','Average','21','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('89','R','Rich','21','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('90','Yes','Yes','22','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('91','No','No','22','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('92','M','Mobile','23','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('93','O','Office','23','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('94','H','Home','23','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('95','UB','Urban','24','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('96','SU','Sub Urban','24','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('97','RA','Rural Area','24','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('98','NO','None','25','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('99','GO','Good','25','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('100','VG','Very Good','25','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('101','AG','Agriculture','26','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('102','TC','Trade And Commerce','26','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('103','SV','Service','26','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('104','TS','Transportation','26','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('105','CS','Construction','26','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('106','OC','Other Category','26','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('107','New','New','27','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('108','Exp','Expansion','27','2014-01-01 02:04:00','2014-03-21 09:58:22');
 INSERT INTO ln_lookup_value VALUES('109','No','None','28','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('110','LT','Land Title','28','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('111','TO','Ownership Title-Land/Buildings','28','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('112','MV','Motor Vehicle','28','2014-01-01 02:04:00','2014-03-21 11:22:50');
 INSERT INTO ln_lookup_value VALUES('113','IN','Inventory','28','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('114','OT','Other','28','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('115','VG','Very Good','29','2014-01-01 02:04:00','2014-03-21 11:35:46');
 INSERT INTO ln_lookup_value VALUES('116','GO','Good','29','2014-01-01 02:04:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('117','NG','Not Good','29','2014-01-01 02:04:00','2014-03-21 11:34:51');
 INSERT INTO ln_lookup_value VALUES('118','None','-- None --','12','2014-02-14 09:40:24','2014-02-14 09:40:24');
 INSERT INTO ln_lookup_value VALUES('119','26','26','13','2014-02-14 09:39:18','2014-02-14 09:39:18');
 INSERT INTO ln_lookup_value VALUES('123','27','27','13','0000-00-00 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('124','18','28','13','0000-00-00 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('125','None','-- None --','13','0000-00-00 00:00:00','0000-00-00 00:00:00');
 INSERT INTO ln_lookup_value VALUES('126','nog','Not Good','25','2014-03-21 09:56:34','2014-03-21 09:59:20');
 INSERT INTO ln_lookup_value VALUES('127','Buy','Buying','27','2014-03-21 09:56:34','2014-03-21 09:56:34');

--
-- Backup Table: ln_payment_status
--;

CREATE TABLE IF NOT EXISTS `ln_payment_status` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `f_num_day` smallint(6) DEFAULT NULL,
  `t_num_day` smallint(6) DEFAULT NULL,
  `activated_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ln_provission_name_unique` (`name`) USING BTREE,
  UNIQUE KEY `ln_provission_short_name_unique` (`code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

 DELETE FROM ln_payment_status ;
 INSERT INTO ln_payment_status VALUES('1','SDL','Standard Loan','1','30','2014-01-01','2014-01-01 15:05:23','0000-00-00 00:00:00');
 INSERT INTO ln_payment_status VALUES('2','SSL','Sub Standard Loan','31','180','2014-01-01','2014-01-01 15:08:13','0000-00-00 00:00:00');
 INSERT INTO ln_payment_status VALUES('3','DFL','Doubtful Loan','181','360','2014-01-01','2014-01-01 15:08:13','0000-00-00 00:00:00');
 INSERT INTO ln_payment_status VALUES('4','LOL','Loss Loan','361','736','2014-01-01','2014-01-01 15:15:07','0000-00-00 00:00:00');

--
-- Backup Table: ln_penalty
--;

CREATE TABLE IF NOT EXISTS `ln_penalty` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ln_lv_penalty_type` int(10) unsigned NOT NULL COMMENT 'Daily, Weekly, Monthly',
  `grace_period` tinyint(4) DEFAULT NULL,
  `ln_lv_calculate_type` int(10) unsigned NOT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `ln_lv_percentage_of` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ln_penalty_name_unique` (`name`),
  KEY `ln_penalty_calculate_type_foreign` (`ln_lv_calculate_type`),
  KEY `ln_penalty_penalty_type_foreign` (`ln_lv_penalty_type`),
  KEY `ln_lv_percentage_of` (`ln_lv_percentage_of`),
  CONSTRAINT `ln_penalty_calculate_type_foreign` FOREIGN KEY (`ln_lv_calculate_type`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_penalty_ibfk_1` FOREIGN KEY (`ln_lv_percentage_of`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_penalty_penalty_type_foreign` FOREIGN KEY (`ln_lv_penalty_type`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_penalty ;
 INSERT INTO ln_penalty VALUES('1','Daily, Grace: 7, Amount: 1%','20','7','24','1.00','26','2014-01-01 11:04:07','0000-00-00 00:00:00');
 INSERT INTO ln_penalty VALUES('2','Daily, Grace: 0, Amount: 0.5%','20','0','24','0.50','26','2014-01-01 11:05:09','0000-00-00 00:00:00');

--
-- Backup Table: ln_penalty_closing
--;

CREATE TABLE IF NOT EXISTS `ln_penalty_closing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `percentage_installment` decimal(12,2) DEFAULT NULL,
  `percentage_interest_remainder` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ln_penalty_closing_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_penalty_closing ;
 INSERT INTO ln_penalty_closing VALUES('1','Before 50% (20% Interest)','50.00','20.00','2014-01-01 08:40:13','0000-00-00 00:00:00');
 INSERT INTO ln_penalty_closing VALUES('2','Before 30% (10% Interest)','30.00','10.00','2014-01-01 08:40:46','0000-00-00 00:00:00');

--
-- Backup Table: ln_product_status
--;

CREATE TABLE IF NOT EXISTS `ln_product_status` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `f_num_day` smallint(6) DEFAULT NULL,
  `t_num_day` smallint(6) DEFAULT NULL,
  `activated_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ln_provission_name_unique` (`name`),
  UNIQUE KEY `ln_provission_short_name_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_product_status ;
 INSERT INTO ln_product_status VALUES('1','SDL','Standard Loan','1','30','2014-01-01','2014-01-01 15:05:23','0000-00-00 00:00:00');
 INSERT INTO ln_product_status VALUES('2','SSL','Sub Standard Loan','31','180','2014-01-01','2014-01-01 15:08:13','0000-00-00 00:00:00');
 INSERT INTO ln_product_status VALUES('3','DFL','Doubtful Loan','181','360','2014-01-01','2014-01-01 15:08:13','0000-00-00 00:00:00');
 INSERT INTO ln_product_status VALUES('4','LOL','Loss Loan','361','736','2014-01-01','2014-01-01 15:15:07','0000-00-00 00:00:00');
 INSERT INTO ln_product_status VALUES('5','WOL','Write-Off Loan','737','10000','2014-01-01','0000-00-00 00:00:00','0000-00-00 00:00:00');

--
-- Backup Table: ln_category
--;

CREATE TABLE IF NOT EXISTS `ln_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ln_category_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_category ;
 INSERT INTO ln_category VALUES('1','General','General','2014-02-04 11:15:49','2014-02-06 08:19:55');

--
-- Backup Table: ln_exchange
--;

CREATE TABLE IF NOT EXISTS `ln_exchange` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `exchange_at` date DEFAULT NULL,
  `khr_usd` decimal(12,2) DEFAULT NULL,
  `usd` decimal(12,2) DEFAULT NULL,
  `khr_thb` decimal(12,2) DEFAULT NULL,
  `thb` decimal(12,2) DEFAULT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ln_exchange_exchange_at_unique` (`exchange_at`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_exchange ;
 INSERT INTO ln_exchange VALUES('2','2014-02-28','4000.00','1.00','130.00','1.00','NBC','2014-01-01 15:51:07','0000-00-00 00:00:00');
 INSERT INTO ln_exchange VALUES('3','2014-03-31','4000.00','1.00','130.00','1.00','NBC','2014-01-01 15:51:01','0000-00-00 00:00:00');
 INSERT INTO ln_exchange VALUES('4','2014-04-30','4000.00','1.00','130.00','1.00','NBC','2014-01-01 15:50:53','0000-00-00 00:00:00');
 INSERT INTO ln_exchange VALUES('5','2014-05-31','4000.00','1.00','130.00','1.00','NBC','2014-01-01 15:50:48','0000-00-00 00:00:00');
 INSERT INTO ln_exchange VALUES('6','2014-06-30','4000.00','1.00','130.00','1.00','NBC','2014-01-01 15:51:43','0000-00-00 00:00:00');
 INSERT INTO ln_exchange VALUES('7','2014-07-31','4000.00','1.00','130.00','1.00','NBC','2014-01-01 15:52:58','0000-00-00 00:00:00');
 INSERT INTO ln_exchange VALUES('8','2014-08-30','4000.00','1.00','130.00','1.00','NBC','2014-01-01 15:53:43','0000-00-00 00:00:00');
 INSERT INTO ln_exchange VALUES('9','2014-09-30','4000.00','1.00','130.00','1.00','NBC','2014-01-01 15:54:11','0000-00-00 00:00:00');
 INSERT INTO ln_exchange VALUES('10','2014-10-31','4000.00','1.00','130.00','1.00','NBC','2014-01-01 15:55:14','0000-00-00 00:00:00');
 INSERT INTO ln_exchange VALUES('11','2014-11-30','4000.00','1.00','130.00','1.00','NBC','2014-01-01 15:55:50','0000-00-00 00:00:00');
 INSERT INTO ln_exchange VALUES('12','2014-12-31','4000.00','1.00','130.00','1.00','NBC','2014-01-01 15:56:23','0000-00-00 00:00:00');

--
-- Backup Table: ln_fee
--;

CREATE TABLE IF NOT EXISTS `ln_fee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ln_lv_fee_type` int(10) unsigned NOT NULL,
  `ln_lv_calculate_type` int(10) unsigned NOT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `ln_lv_percentage_of` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ln_fee_name_unique` (`name`),
  KEY `ln_fee_calculate_type_foreign` (`ln_lv_calculate_type`),
  KEY `ln_fee_fee_type_foreign` (`ln_lv_fee_type`),
  KEY `ln_fee_percentage_of_foreign` (`ln_lv_percentage_of`),
  CONSTRAINT `ln_fee_calculate_type_foreign` FOREIGN KEY (`ln_lv_calculate_type`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_fee_fee_type_foreign` FOREIGN KEY (`ln_lv_fee_type`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_fee_percentage_of_foreign` FOREIGN KEY (`ln_lv_percentage_of`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_fee ;
 INSERT INTO ln_fee VALUES('1','At Disbursement (0.5%)','12','16','0.50','17','2014-01-01 11:01:29','0000-00-00 00:00:00');
 INSERT INTO ln_fee VALUES('2','At Disbursement (1%)','12','16','1.00','17','2014-01-01 11:02:09','0000-00-00 00:00:00');
 INSERT INTO ln_fee VALUES('3','None','12','15','0.00','17','2014-02-18 07:50:17','2014-03-24 14:47:18');

--
-- Backup Table: ln_fund
--;

CREATE TABLE IF NOT EXISTS `ln_fund` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `register_at` date DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ln_fund_name_unique` (`name`),
  UNIQUE KEY `ln_fund_short_name_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_fund ;
 INSERT INTO ln_fund VALUES('1','BIT','Battambang IT Team','2013-12-31','Battambang','092531653','chum.phalkun@gamil.com','bit.com.kh','2014-01-01 09:03:58','2014-02-08 15:32:49');
 INSERT INTO ln_fund VALUES('2','ABC','ABC Campany','2014-01-01','USA','','','','2014-01-01 09:05:45','0000-00-00 00:00:00');

--
-- Backup Table: ln_holiday
--;

CREATE TABLE IF NOT EXISTS `ln_holiday` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `holiday_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ln_holiday_holiday_id_unique` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_holiday ;
 INSERT INTO ln_holiday VALUES('1','ចូលឆ្នាំសកល','2014-01-01','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('2','ទិវាជ័យជំនះលើរបបប្រស័យពូជសាសន៍','2014-01-07','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('3','ពិធីបុណ្យមាឃបូជា','2014-02-14','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('4','ទិវានារីអន្តរជាតិ','2014-03-10','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('5','បុណ្យចូលឆ្នាំខ្មែរ','2014-04-14','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('6','បុណ្យចូលឆ្នាំខ្មែរ','2014-04-15','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('7','បុណ្យចូលឆ្នាំខ្មែរ','2014-04-16','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('8','ទិវាពលកម្មអន្តរជាតិ','2014-05-01','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('9','ព្រះរាជពិធីបុណ្យចម្រើនព្រះជនករុណាព្រះបាទសម្តេច ព្រះបរមនាថ នរោត្តម សីហមុនី','2014-05-13','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('10','ព្រះរាជពិធីបុណ្យចម្រើនព្រះជនករុណាព្រះបាទសម្តេច ព្រះបរមនាថ នរោត្តម សីហមុនី','2014-05-14','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('11','ព្រះរាជពិធីបុណ្យចម្រើនព្រះជនករុណាព្រះបាទសម្តេច ព្រះបរមនាថ នរោត្តម សីហមុនី','2014-05-15','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('12','ព្រះរាជពិធីច្រត់ព្រះនង្គ័ល','2014-05-19','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('13','ទិវាពលកម្មអន្តរជាតិ','2014-06-02','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('14','ព្រះរាជពិធីចម្រើនព្រះជន្ម សម្តេចម៉ែ នរោត្តម មុនិនាថ សីហនុ','2014-06-18','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('15','ពិធីបុណ្យភ្ជុំបិណ្ឌ','2014-09-22','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('16','ពិធីបុណ្យភ្ជុំបិណ្ឌ','2014-09-23','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('17','ពិធីបុណ្យភ្ជុំបិណ្ឌ','2014-09-24','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('18','ពិធីប្ររព្ធពិធីគោរពវិញ្ញាណក្ខន្ធ ព្រះបាទសម្តេចព្រះនរត្តម សីហនុ ព្រះមហាវីរៈក្សត្យ','2014-10-15','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('19','ទិវារំលឹកខួបនៃកិច្ចព្រងព្រៀងសន្តិភាពទីក្រុងប៉ារីស','2014-10-23','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('20','ព្រះរាជពិធីគ្រប់គ្រងរាជសម្បត្តិរបស់ ព្រះករុណាព្រះបាទសម្តេចព្រះបរមនាថ នរត្តម សីហមុនី','2014-10-29','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('21','ពិធីបុណ្យអុំទូកបណ្តែតប្រទីប អកអំបុក សំពះព្រះខែ','2014-11-05','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('22','ពិធីបុណ្យអុំទូកបណ្តែតប្រទីប អកអំបុក សំពះព្រះខែ','2014-11-06','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('23','ពិធីបុណ្យអុំទូកបណ្តែតប្រទីប អកអំបុក សំពះព្រះខែ','2014-11-07','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('24','ពិធីបុណ្យអុំទូកបណ្តែតប្រទីប អកអំបុក សំពះព្រះខែ','2014-11-10','2014-01-01 09:12:17','0000-00-00 00:00:00');
 INSERT INTO ln_holiday VALUES('25','ពិធីបុណ្យអុំទូកបណ្តែតប្រទីប អកអំបុក សំពះព្រះខែ','2014-12-10','2014-01-01 09:12:17','0000-00-00 00:00:00');

--
-- Backup Table: ln_staff
--;

CREATE TABLE IF NOT EXISTS `ln_staff` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `en_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `en_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kh_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kh_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ln_lv_gender` int(10) unsigned NOT NULL,
  `dob` date DEFAULT NULL,
  `ln_lv_marital_status` int(10) unsigned NOT NULL,
  `ln_lv_education` int(10) unsigned NOT NULL,
  `education_des` text COLLATE utf8_unicode_ci,
  `ln_lv_id_type` int(10) unsigned NOT NULL,
  `id_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `ln_lv_title` int(10) unsigned NOT NULL,
  `joining_date` date DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp_office_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `attach_photo` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ln_staff_education_foreign` (`ln_lv_education`),
  KEY `ln_staff_gender_foreign` (`ln_lv_gender`),
  KEY `ln_staff_it_type_foreign` (`ln_lv_id_type`),
  KEY `ln_staff_marital_status_foreign` (`ln_lv_marital_status`),
  KEY `ln_staff_title_foreign` (`ln_lv_title`),
  KEY `cp_office_id` (`cp_office_id`),
  CONSTRAINT `ln_staff_ibfk_1` FOREIGN KEY (`cp_office_id`) REFERENCES `cp_office` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_staff_ibfk_2` FOREIGN KEY (`ln_lv_gender`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_staff_ibfk_3` FOREIGN KEY (`ln_lv_marital_status`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_staff_ibfk_4` FOREIGN KEY (`ln_lv_education`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_staff_ibfk_5` FOREIGN KEY (`ln_lv_id_type`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_staff_ibfk_6` FOREIGN KEY (`ln_lv_title`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_staff  WHERE cp_office_id LIKE '0201%';
 INSERT INTO ln_staff VALUES('0002','Pheara','Han','ភារ៉ា','ហាន','67','1988-08-08','69','75','','58','212335465','2016-11-24','78','2011-07-13','BMC','0968883883','yuom.theara@gmail.com','0201','http://localhost/battambang/public/packages/battambang/loan/staff_photo/imgres.jpg','2014-01-01 08:47:10','2014-04-17 10:40:11');
 INSERT INTO ln_staff VALUES('0003','fasd','fasdf','asdfsda','dsfda','67','1980-02-05','70','74','','59','','0000-00-00','78','2014-05-13','bb','012','','0201','http://localhost/battambang/public/packages/battambang/cpanel/img/cp_noimage.jpg','2014-05-14 14:16:29','2014-05-14 14:17:14');

--
-- Backup Table: ln_product
--;

CREATE TABLE IF NOT EXISTS `ln_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ln_category_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des` text COLLATE utf8_unicode_ci,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `ln_lv_account_type_arr` text COLLATE utf8_unicode_ci,
  `cp_currency_id_arr` text COLLATE utf8_unicode_ci COMMENT 'array (get from ln_currency)',
  `ln_lv_repay_frequency` int(10) unsigned NOT NULL,
  `min_installment` tinyint(4) unsigned DEFAULT NULL,
  `max_installment` tinyint(4) unsigned DEFAULT NULL,
  `default_installment` tinyint(4) DEFAULT NULL,
  `ln_lv_holiday_rule` int(10) unsigned NOT NULL,
  `ln_lv_interest_type` int(10) unsigned NOT NULL,
  `min_interest` decimal(12,2) DEFAULT NULL,
  `max_interest` decimal(12,2) DEFAULT NULL,
  `default_interest` decimal(12,2) DEFAULT NULL,
  `ln_lv_loan_amount_type` int(10) unsigned NOT NULL,
  `min_amount` decimal(12,2) DEFAULT NULL,
  `max_amount` decimal(12,2) DEFAULT NULL,
  `default_amount` decimal(12,2) DEFAULT NULL,
  `ln_exchange_id` int(10) unsigned DEFAULT NULL,
  `ln_fee_id` int(10) unsigned NOT NULL,
  `ln_penalty_id` int(10) unsigned NOT NULL,
  `ln_penalty_closing_id` int(10) unsigned NOT NULL,
  `ln_fund_id_arr` text COLLATE utf8_unicode_ci COMMENT 'array (get fromln_fund)',
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ln_product_name_unique` (`name`) USING BTREE,
  KEY `ln_product_ln_category_id_foreign` (`ln_category_id`) USING BTREE,
  KEY `ln_product_ln_fee_id_foreign` (`ln_fee_id`) USING BTREE,
  KEY `ln_product_ln_penalty_id_foreign` (`ln_penalty_id`) USING BTREE,
  KEY `ln_product_ln_penalty_closing_id_foreign` (`ln_penalty_closing_id`) USING BTREE,
  KEY `ln_product_holiday_rule_foreign` (`ln_lv_holiday_rule`) USING BTREE,
  KEY `ln_product_interest_type_foreign` (`ln_lv_interest_type`) USING BTREE,
  KEY `ln_product_repay_frequency_foreign` (`ln_lv_repay_frequency`) USING BTREE,
  KEY `ln_lv_loan_amount_type` (`ln_lv_loan_amount_type`) USING BTREE,
  KEY `ln_exchange_id` (`ln_exchange_id`) USING BTREE,
  CONSTRAINT `ln_product_ibfk_1` FOREIGN KEY (`ln_lv_holiday_rule`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_product_ibfk_2` FOREIGN KEY (`ln_lv_loan_amount_type`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_product_ibfk_3` FOREIGN KEY (`ln_lv_interest_type`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_product_ibfk_4` FOREIGN KEY (`ln_category_id`) REFERENCES `ln_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_product_ibfk_5` FOREIGN KEY (`ln_fee_id`) REFERENCES `ln_fee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_product_ibfk_6` FOREIGN KEY (`ln_penalty_closing_id`) REFERENCES `ln_penalty_closing` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_product_ibfk_7` FOREIGN KEY (`ln_penalty_id`) REFERENCES `ln_penalty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_product_ibfk_8` FOREIGN KEY (`ln_lv_repay_frequency`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_product_ibfk_9` FOREIGN KEY (`ln_exchange_id`) REFERENCES `ln_exchange` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

 DELETE FROM ln_product ;
 INSERT INTO ln_product VALUES('4','1','Moto','test','2014-03-21','2025-01-31','["1","2"]','["1","2"]','3','1','20','10','7','8','2.00','3.00','2.50','10','1000.00','5000.00','1000.00','2','1','1','1','["1"]','2014-03-21 16:54:38','2014-03-21 16:54:38');
 INSERT INTO ln_product VALUES('5','1','Car','test','2014-03-24','2024-12-31','["1","2"]','["1","2","3"]','4','1','20','10','7','8','2.00','3.00','2.50','10','1000.00','5000.00','1000.00','2','2','1','1','["1"]','2014-03-24 10:11:13','2014-03-24 10:11:13');
 INSERT INTO ln_product VALUES('6','1','Educations','test','2014-03-25','2027-07-22','["1","2"]','["2"]','3','1','200','10','7','8','2.00','3.00','2.50','10','1000.00','5000.00','1000.00','2','3','1','1','["2"]','2014-03-25 13:46:31','2014-03-27 16:01:47');

--
-- Backup Table: ln_center
--;

CREATE TABLE IF NOT EXISTS `ln_center` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meeting_weekly` int(10) unsigned NOT NULL,
  `meeting_monthly` int(10) unsigned NOT NULL,
  `joining_date` date DEFAULT NULL,
  `ln_lv_geography` int(10) unsigned NOT NULL,
  `cp_location_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `des` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ln_staff_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cp_office_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ln_center_name_unique` (`name`),
  KEY `ln_center_geography_foreign` (`ln_lv_geography`),
  KEY `cp_office_id` (`cp_office_id`),
  KEY `ln_staff_id` (`ln_staff_id`),
  KEY `meeting_weekly` (`meeting_weekly`),
  KEY `meeting_monthly` (`meeting_monthly`),
  KEY `cp_location_id` (`cp_location_id`),
  CONSTRAINT `ln_center_geography_foreign` FOREIGN KEY (`ln_lv_geography`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_center_ibfk_2` FOREIGN KEY (`cp_office_id`) REFERENCES `cp_office` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_center_ibfk_3` FOREIGN KEY (`ln_staff_id`) REFERENCES `ln_staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_center_ibfk_4` FOREIGN KEY (`meeting_weekly`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_center_ibfk_5` FOREIGN KEY (`meeting_monthly`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_center_ibfk_6` FOREIGN KEY (`cp_location_id`) REFERENCES `cp_location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_center  WHERE id LIKE '0201%';
 INSERT INTO ln_center VALUES('0201-001','Hello','29','39','2014-02-04','95','02010101','sdgfsafsa','','0002','0201','2014-02-04 16:55:55','2014-04-04 08:24:22');
 INSERT INTO ln_center VALUES('0201-002','BB','27','57','2014-04-18','95','02030904','BB','','0001','0201','2014-04-18 11:38:56','2014-04-18 11:38:56');

--
-- Backup Table: ln_client
--;

CREATE TABLE IF NOT EXISTS `ln_client` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `en_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `en_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `en_nick_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kh_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kh_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kh_nick_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ln_lv_gender` int(10) unsigned NOT NULL,
  `dob` date DEFAULT NULL,
  `place_birth` text COLLATE utf8_unicode_ci,
  `ln_lv_nationality` int(10) unsigned NOT NULL,
  `attach_photo` text COLLATE utf8_unicode_ci,
  `cp_office_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `gender` (`ln_lv_gender`),
  KEY `nationality` (`ln_lv_nationality`),
  KEY `cp_office_id` (`cp_office_id`),
  CONSTRAINT `ln_client_ibfk_3` FOREIGN KEY (`cp_office_id`) REFERENCES `cp_office` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_client_ibfk_4` FOREIGN KEY (`ln_lv_gender`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_client_ibfk_5` FOREIGN KEY (`ln_lv_nationality`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_client  WHERE id LIKE '0201%';
 INSERT INTO ln_client VALUES('0201-0001','Kok','Sok','','កុក','សុខ','','67','1990-04-04','','79','http://localhost/battambang/public/packages/battambang/cpanel/img/cp_noimage.jpg','0201','2014-04-24 08:48:37','2014-04-24 08:48:37');
 INSERT INTO ln_client VALUES('0201-0002','Pheara','Han','','ភារ៉ា','ហាន','','68','1989-02-07','','79','http://localhost/battambang/public/packages/battambang/cpanel/img/cp_noimage.jpg','0201','2014-04-24 08:49:42','2014-04-24 08:49:42');

--
-- Backup Table: ln_disburse
--;

CREATE TABLE IF NOT EXISTS `ln_disburse` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ln_center_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ln_lv_meeting_schedule` int(10) unsigned NOT NULL,
  `ln_staff_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ln_product_id` int(10) unsigned NOT NULL,
  `disburse_date` date DEFAULT NULL,
  `ln_lv_account_type` int(10) unsigned NOT NULL,
  `cp_currency_id` tinyint(4) unsigned NOT NULL,
  `num_installment` tinyint(4) DEFAULT NULL,
  `installment_frequency` tinyint(4) DEFAULT NULL,
  `num_payment` tinyint(4) DEFAULT NULL,
  `installment_principal_frequency` tinyint(4) DEFAULT NULL,
  `installment_principal_percentage` decimal(12,2) DEFAULT NULL,
  `interest_rate` decimal(12,2) DEFAULT NULL,
  `ln_fund_id` int(10) unsigned NOT NULL,
  `attach_file` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ln_disburse_ln_product_id_foreign` (`ln_product_id`),
  KEY `ln_disburse_ln_fund_id_foreign` (`ln_fund_id`),
  KEY `ln_disburse_ibfk_1` (`cp_currency_id`),
  KEY `ln_staff_id` (`ln_staff_id`),
  KEY `ln_center_id` (`ln_center_id`),
  KEY `ln_disburse_applicant_type_foreign` (`ln_lv_account_type`) USING BTREE,
  KEY `meeting_schedule` (`ln_lv_meeting_schedule`),
  CONSTRAINT `ln_disburse_applicant_type_foreign` FOREIGN KEY (`ln_lv_account_type`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_disburse_ibfk_2` FOREIGN KEY (`ln_staff_id`) REFERENCES `ln_staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_disburse_ibfk_3` FOREIGN KEY (`ln_center_id`) REFERENCES `ln_center` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_disburse_ibfk_4` FOREIGN KEY (`cp_currency_id`) REFERENCES `cp_currency` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_disburse_ibfk_5` FOREIGN KEY (`ln_lv_meeting_schedule`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_disburse_ln_fund_id_foreign` FOREIGN KEY (`ln_fund_id`) REFERENCES `ln_fund` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_disburse_ln_product_id_foreign` FOREIGN KEY (`ln_product_id`) REFERENCES `ln_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_disburse  WHERE id LIKE '0201%';
 INSERT INTO ln_disburse VALUES('0201-000001','0201-001','29','0002','6','2014-04-24','2','2','10','1','10','1','100.00','2.50','2','','2014-04-24 09:04:23','2014-04-24 09:04:23');
 INSERT INTO ln_disburse VALUES('0201-000002','0201-001','29','0002','4','2014-04-24','1','1','10','1','10','1','100.00','2.50','1','','2014-04-24 11:38:03','2014-04-24 11:38:03');

--
-- Backup Table: ln_disburse_client
--;

CREATE TABLE IF NOT EXISTS `ln_disburse_client` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ln_disburse_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `voucher_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cycle` tinyint(4) unsigned DEFAULT NULL,
  `ln_lv_history` int(10) unsigned NOT NULL,
  `ln_lv_purpose` int(10) unsigned NOT NULL,
  `purpose_des` text COLLATE utf8_unicode_ci,
  `ln_lv_activity` int(10) unsigned NOT NULL,
  `ln_lv_collateral_type` int(10) unsigned NOT NULL,
  `collateral_des` text COLLATE utf8_unicode_ci,
  `ln_lv_security` int(10) unsigned NOT NULL,
  `ln_client_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ln_lv_id_type` int(10) unsigned NOT NULL,
  `id_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `ln_lv_marital_status` int(10) unsigned NOT NULL,
  `family_member` tinyint(4) unsigned DEFAULT NULL,
  `num_dependent` tinyint(4) unsigned DEFAULT NULL,
  `ln_lv_education` int(10) unsigned NOT NULL,
  `ln_lv_business` int(10) unsigned NOT NULL,
  `ln_lv_poverty_status` int(10) unsigned NOT NULL,
  `income_amount` decimal(12,2) DEFAULT NULL COMMENT 'USD',
  `ln_lv_handicap` int(10) unsigned NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `ln_lv_contact_type` int(10) unsigned NOT NULL,
  `contact_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ln_diburse_client_activity_foreign` (`ln_lv_activity`),
  KEY `ln_diburse_client_business_foreign` (`ln_lv_business`),
  KEY `ln_diburse_client_collateral_type_foreign` (`ln_lv_collateral_type`),
  KEY `ln_diburse_client_contact_type_foreign` (`ln_lv_contact_type`),
  KEY `ln_diburse_client_education_foreign` (`ln_lv_education`),
  KEY `ln_diburse_client_handecuped_foreign` (`ln_lv_handicap`),
  KEY `ln_diburse_client_history_foreign` (`ln_lv_history`),
  KEY `ln_diburse_client_id_type_foreign` (`ln_lv_id_type`),
  KEY `ln_diburse_client_poverty_status_foreign` (`ln_lv_poverty_status`),
  KEY `ln_diburse_client_purpose_foreign` (`ln_lv_purpose`),
  KEY `ln_diburse_client_security_foreign` (`ln_lv_security`),
  KEY `ln_disburse_id` (`ln_disburse_id`),
  KEY `ln_client_id` (`ln_client_id`),
  KEY `ln_diburse_client_marital_status_foreign` (`ln_lv_marital_status`) USING BTREE,
  CONSTRAINT `ln_diburse_client_activity_foreign` FOREIGN KEY (`ln_lv_activity`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_diburse_client_business_foreign` FOREIGN KEY (`ln_lv_business`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_diburse_client_collateral_type_foreign` FOREIGN KEY (`ln_lv_collateral_type`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_diburse_client_contact_type_foreign` FOREIGN KEY (`ln_lv_contact_type`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_diburse_client_education_foreign` FOREIGN KEY (`ln_lv_education`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_diburse_client_handecuped_foreign` FOREIGN KEY (`ln_lv_handicap`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_diburse_client_history_foreign` FOREIGN KEY (`ln_lv_history`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_diburse_client_id_type_foreign` FOREIGN KEY (`ln_lv_id_type`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_diburse_client_marital_status_foreign` FOREIGN KEY (`ln_lv_marital_status`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_diburse_client_poverty_status_foreign` FOREIGN KEY (`ln_lv_poverty_status`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_diburse_client_purpose_foreign` FOREIGN KEY (`ln_lv_purpose`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_diburse_client_security_foreign` FOREIGN KEY (`ln_lv_security`) REFERENCES `ln_lookup_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_disburse_client_ibfk_1` FOREIGN KEY (`ln_disburse_id`) REFERENCES `ln_disburse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ln_disburse_client_ibfk_2` FOREIGN KEY (`ln_client_id`) REFERENCES `ln_client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_disburse_client  WHERE id LIKE '0201%';
 INSERT INTO ln_disburse_client VALUES('0201-000001-0001','0201-000001','1000.00','0201-2014-2-123456','1','98','101','asdf','107','109','asdf','116','0201-0001','59','','0000-00-00','70','5','2','72','80','88','500.00','91','sdf','92','012154','','2014-04-24 09:16:41','2014-05-14 14:28:21');
 INSERT INTO ln_disburse_client VALUES('0201-000002-0001','0201-000002','4000000.00','0201-2014-1-234567','2','99','101','rrr','108','110','ttt','116','0201-0001','59','123456789','0000-00-00','70','5','2','72','80','88','500.00','91','sdf','92','012154','','2014-04-24 11:38:35','2014-04-24 11:38:35');

--
-- Backup Table: ln_perform
--;

CREATE TABLE IF NOT EXISTS `ln_perform` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ln_disburse_client_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `activated_at` date DEFAULT NULL,
  `activated_num_installment` int(10) DEFAULT NULL,
  `perform_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_interest` decimal(10,2) DEFAULT NULL,
  `num_borrowing_day` smallint(6) DEFAULT NULL,
  `maturity_date` date DEFAULT NULL,
  `num_installment_can_closing` tinyint(4) DEFAULT NULL,
  `last_arrears_date` date DEFAULT NULL,
  `last_arrears_num_day` smallint(6) DEFAULT NULL,
  `last_arrears_num_installment` tinyint(4) DEFAULT NULL,
  `last_arrears_principal` decimal(10,2) DEFAULT NULL,
  `last_arrears_interest` decimal(10,2) DEFAULT NULL,
  `last_arrears_fee` decimal(10,2) DEFAULT NULL,
  `last_arrears_penalty` decimal(10,2) DEFAULT NULL,
  `new_due_date` date DEFAULT NULL,
  `new_due_num_day` smallint(6) DEFAULT NULL,
  `new_due_product_status` tinyint(4) DEFAULT NULL,
  `new_due_product_status_date` date DEFAULT NULL,
  `new_due_num_installment` tinyint(4) DEFAULT NULL,
  `new_due_principal` decimal(10,2) DEFAULT NULL,
  `new_due_interest` decimal(10,2) DEFAULT NULL,
  `new_due_fee` decimal(10,2) DEFAULT NULL,
  `new_due_penalty` decimal(10,2) DEFAULT NULL,
  `new_due_interest_closing` decimal(10,2) DEFAULT NULL,
  `new_due_principal_closing` decimal(10,2) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `due_num_day` int(10) DEFAULT NULL,
  `due_principal` decimal(10,2) DEFAULT NULL,
  `due_interest` decimal(10,2) DEFAULT NULL,
  `due_fee` decimal(10,2) DEFAULT NULL,
  `due_penalty` decimal(10,2) DEFAULT NULL,
  `next_due_date` date DEFAULT NULL,
  `next_due_principal` decimal(10,2) DEFAULT NULL,
  `next_due_interest` decimal(10,2) DEFAULT NULL,
  `next_due_fee` decimal(10,2) DEFAULT NULL,
  `next_due_penalty` decimal(10,2) DEFAULT NULL,
  `repayment_date` date DEFAULT NULL,
  `repayment_voucher_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `repayment_status` smallint(6) DEFAULT NULL,
  `repayment_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `repayment_principal` decimal(10,2) DEFAULT NULL,
  `repayment_interest` decimal(10,2) DEFAULT NULL,
  `repayment_fee` decimal(10,2) DEFAULT NULL,
  `repayment_penalty` decimal(10,2) DEFAULT NULL,
  `last_repayment_date` date DEFAULT NULL,
  `last_repayment_voucher_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_repayment_status` smallint(6) DEFAULT NULL,
  `last_repayment_principal` decimal(10,2) DEFAULT NULL,
  `last_repayment_interest` decimal(10,2) DEFAULT NULL,
  `last_repayment_fee` decimal(10,2) DEFAULT NULL,
  `last_repayment_penalty` decimal(10,2) DEFAULT NULL,
  `last_repayment_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arrears_date` date DEFAULT NULL,
  `arrears_num_day` smallint(6) DEFAULT NULL,
  `arrears_num_installment` tinyint(4) DEFAULT NULL,
  `arrears_principal` decimal(10,2) DEFAULT NULL,
  `arrears_interest` decimal(10,2) DEFAULT NULL,
  `arrears_fee` decimal(10,2) DEFAULT NULL,
  `arrears_penalty` decimal(10,2) DEFAULT NULL,
  `current_product_status` tinyint(4) DEFAULT NULL,
  `current_product_status_date` date DEFAULT NULL,
  `current_product_status_principal` decimal(10,2) DEFAULT NULL,
  `balance_principal` decimal(10,2) DEFAULT NULL,
  `balance_interest` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ln_disburse_client_id` (`ln_disburse_client_id`) USING BTREE,
  CONSTRAINT `ln_perform_ibfk_1` FOREIGN KEY (`ln_disburse_client_id`) REFERENCES `ln_disburse_client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

 DELETE FROM ln_perform  WHERE id LIKE '0201%';
 INSERT INTO ln_perform VALUES('0201-0000000002','0201-000002-0001','2014-04-24','0','disburse','531400.00','69','2014-07-02','5','0000-00-00','0','0','0.00','0.00','0.00','0.00','0000-00-00','0','1','2014-04-24','0','0.00','0.00','0.00','0.00','0.00','0.00','2014-04-24','0','0.00','0.00','0.00','0.00','2014-04-30','400000.00','85700.00','0.00','0.00','0000-00-00','','1','','0.00','0.00','0.00','0.00','0000-00-00','','1','0.00','0.00','0.00','0.00','','0000-00-00','0','0','0.00','0.00','0.00','0.00','1','2014-04-24','4000000.00','4000000.00','531400.00','2014-04-24 11:38:36','2014-04-24 11:38:36');
 INSERT INTO ln_perform VALUES('0201-0000000003','0201-000001-0001','2014-04-24','0','disburse','132.86','69','2014-07-02','5','0000-00-00','0','0','0.00','0.00','0.00','0.00','0000-00-00','0','1','2014-04-24','0','0.00','0.00','0.00','0.00','0.00','0.00','2014-04-24','0','0.00','0.00','0.00','0.00','2014-04-30','100.00','21.43','0.00','0.00','0000-00-00','','1','','0.00','0.00','0.00','0.00','0000-00-00','','1','0.00','0.00','0.00','0.00','','0000-00-00','0','0','0.00','0.00','0.00','0.00','1','2014-04-24','1000.00','1000.00','132.86','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_perform VALUES('0201-0000000004','0201-000002-0001','2014-05-14','3','repayment','531400.00','69','2014-07-02','5','0000-00-00','0','0','0.00','0.00','0.00','0.00','2014-04-30','23','1','2014-04-22','1','1200000.00','232800.00','0.00','111400.00','59700.00','2800000.00','2014-05-12','2','400000.00','57100.00','0.00','0.00','2014-05-21','400000.00','90000.00','0.00','0.00','2014-05-14','0201-2014-1-000001','1','normal','1167200.00','232800.00','0.00','0.00','0000-00-00','','1','0.00','0.00','0.00','0.00','','2014-05-12','2','3','32800.00','0.00','0.00','111400.00','1','2014-05-13','2832800.00','2832800.00','298600.00','2014-05-14 15:57:45','2014-05-14 15:57:45');
 INSERT INTO ln_perform VALUES('0201-0000000005','0201-000002-0001','2014-05-16','3','repayment','531400.00','69','2014-07-02','5','2014-05-12','2','3','32800.00','0.00','0.00','111400.00','2014-04-30','23','1','2014-04-22','1','1200000.00','232800.00','0.00','111400.00','59700.00','2800000.00','2014-05-12','2','400000.00','57100.00','0.00','0.00','2014-05-21','400000.00','90000.00','0.00','0.00','2014-05-16','0201-2014-1-000002','1','normal','32800.00','0.00','0.00','0.00','2014-05-14','0201-2014-1-000001','1','1167200.00','232800.00','0.00','0.00','normal','0000-00-00','0','1','0.00','0.00','0.00','111400.00','1','2014-05-13','2800000.00','2800000.00','298600.00','2014-05-14 15:58:10','2014-05-14 15:58:10');

--
-- Backup Table: ln_schedule
--;

CREATE TABLE IF NOT EXISTS `ln_schedule` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `index` tinyint(4) unsigned DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `num_day` smallint(6) DEFAULT NULL,
  `ln_disburse_client_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ln_schedule_ibfk_1` (`ln_disburse_client_id`),
  CONSTRAINT `ln_schedule_ibfk_1` FOREIGN KEY (`ln_disburse_client_id`) REFERENCES `ln_disburse_client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_schedule  WHERE id LIKE '0201%';
 INSERT INTO ln_schedule VALUES('0201-0000000012','0','2014-04-24','0','0201-000002-0001','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule VALUES('0201-0000000013','1','2014-04-30','6','0201-000002-0001','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule VALUES('0201-0000000014','2','2014-05-07','7','0201-000002-0001','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule VALUES('0201-0000000015','3','2014-05-12','5','0201-000002-0001','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule VALUES('0201-0000000016','4','2014-05-21','9','0201-000002-0001','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule VALUES('0201-0000000017','5','2014-05-28','7','0201-000002-0001','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule VALUES('0201-0000000018','6','2014-06-04','7','0201-000002-0001','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule VALUES('0201-0000000019','7','2014-06-11','7','0201-000002-0001','2014-04-24 11:38:36','2014-04-24 11:38:36');
 INSERT INTO ln_schedule VALUES('0201-0000000020','8','2014-06-17','6','0201-000002-0001','2014-04-24 11:38:36','2014-04-24 11:38:36');
 INSERT INTO ln_schedule VALUES('0201-0000000021','9','2014-06-25','8','0201-000002-0001','2014-04-24 11:38:36','2014-04-24 11:38:36');
 INSERT INTO ln_schedule VALUES('0201-0000000022','10','2014-07-02','7','0201-000002-0001','2014-04-24 11:38:36','2014-04-24 11:38:36');
 INSERT INTO ln_schedule VALUES('0201-0000000023','0','2014-04-24','0','0201-000001-0001','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule VALUES('0201-0000000024','1','2014-04-30','6','0201-000001-0001','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule VALUES('0201-0000000025','2','2014-05-07','7','0201-000001-0001','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule VALUES('0201-0000000026','3','2014-05-12','5','0201-000001-0001','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule VALUES('0201-0000000027','4','2014-05-21','9','0201-000001-0001','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule VALUES('0201-0000000028','5','2014-05-28','7','0201-000001-0001','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule VALUES('0201-0000000029','6','2014-06-04','7','0201-000001-0001','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule VALUES('0201-0000000030','7','2014-06-11','7','0201-000001-0001','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule VALUES('0201-0000000031','8','2014-06-17','6','0201-000001-0001','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule VALUES('0201-0000000032','9','2014-06-25','8','0201-000001-0001','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule VALUES('0201-0000000033','10','2014-07-02','7','0201-000001-0001','2014-05-14 14:28:21','2014-05-14 14:28:21');

--
-- Backup Table: ln_schedule_dt
--;

CREATE TABLE IF NOT EXISTS `ln_schedule_dt` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `activated_at` date DEFAULT NULL,
  `principal` decimal(12,2) DEFAULT NULL,
  `interest` decimal(12,2) DEFAULT NULL,
  `fee` decimal(12,2) DEFAULT NULL,
  `balance` decimal(12,2) DEFAULT NULL,
  `ln_schedule_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ln_schedule_id` (`ln_schedule_id`),
  CONSTRAINT `ln_schedule_dt_ibfk_1` FOREIGN KEY (`ln_schedule_id`) REFERENCES `ln_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

 DELETE FROM ln_schedule_dt  WHERE id LIKE '0201%';
 INSERT INTO ln_schedule_dt VALUES('0201-0000000012','2014-04-24','0.00','0.00','20000.00','4000000.00','0201-0000000012','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000013','2014-04-24','400000.00','85700.00','0.00','3600000.00','0201-0000000013','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000014','2014-04-24','400000.00','90000.00','0.00','3200000.00','0201-0000000014','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000015','2014-04-24','400000.00','57100.00','0.00','2800000.00','0201-0000000015','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000016','2014-04-24','400000.00','90000.00','0.00','2400000.00','0201-0000000016','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000017','2014-04-24','400000.00','60000.00','0.00','2000000.00','0201-0000000017','2014-04-24 11:38:35','2014-04-24 11:38:35');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000018','2014-04-24','400000.00','50000.00','0.00','1600000.00','0201-0000000018','2014-04-24 11:38:36','2014-04-24 11:38:36');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000019','2014-04-24','400000.00','40000.00','0.00','1200000.00','0201-0000000019','2014-04-24 11:38:36','2014-04-24 11:38:36');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000020','2014-04-24','400000.00','25700.00','0.00','800000.00','0201-0000000020','2014-04-24 11:38:36','2014-04-24 11:38:36');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000021','2014-04-24','400000.00','22900.00','0.00','400000.00','0201-0000000021','2014-04-24 11:38:36','2014-04-24 11:38:36');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000022','2014-04-24','400000.00','10000.00','0.00','0.00','0201-0000000022','2014-04-24 11:38:36','2014-04-24 11:38:36');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000023','2014-04-24','0.00','0.00','0.00','1000.00','0201-0000000023','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000024','2014-04-24','100.00','21.43','0.00','900.00','0201-0000000024','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000025','2014-04-24','100.00','22.50','0.00','800.00','0201-0000000025','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000026','2014-04-24','100.00','14.29','0.00','700.00','0201-0000000026','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000027','2014-04-24','100.00','22.50','0.00','600.00','0201-0000000027','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000028','2014-04-24','100.00','15.00','0.00','500.00','0201-0000000028','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000029','2014-04-24','100.00','12.50','0.00','400.00','0201-0000000029','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000030','2014-04-24','100.00','10.00','0.00','300.00','0201-0000000030','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000031','2014-04-24','100.00','6.43','0.00','200.00','0201-0000000031','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000032','2014-04-24','100.00','5.71','0.00','100.00','0201-0000000032','2014-05-14 14:28:21','2014-05-14 14:28:21');
 INSERT INTO ln_schedule_dt VALUES('0201-0000000033','2014-04-24','100.00','2.50','0.00','0.00','0201-0000000033','2014-05-14 14:28:21','2014-05-14 14:28:21');