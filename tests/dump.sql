
SET foreign_key_checks = 0;

DROP DATABASE IF EXISTS `tests`;
CREATE DATABASE `tests` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tests`;

DROP TABLE IF EXISTS `postcode_outward`;
CREATE TABLE `postcode_outward` (
  `postcode_outward` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `postcode_area` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `outward_part` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eastings` int(6) unsigned DEFAULT NULL,
  `northings` int(6) unsigned DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_string` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`postcode_outward`),
  KEY `town` (`town`),
  KEY `IDX_D55EC245392633D6` (`postcode_area`),
  CONSTRAINT `postcode_outward_ibfk_1` FOREIGN KEY (`postcode_area`) REFERENCES `postcode_area` (`postcode_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `postcode_outward` (`postcode_outward`, `postcode_area`, `outward_part`, `eastings`, `northings`, `latitude`, `longitude`, `town`, `region`, `country_code`, `country_string`) VALUES
('AB10',	'AB',	'10',	392900,	804900,	57.1351,	-2.1173,	'Aberdeen',	'Aberdeen City',	'SCT',	'Scotland');
