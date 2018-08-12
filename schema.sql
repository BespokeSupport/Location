
CREATE DATABASE IF NOT EXISTS test;

SET foreign_key_checks = 0;

CREATE TABLE IF NOT EXISTS  `postcode_areas` (
  `postcode_area` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`postcode_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `postcode_outwards` (
  `postcode_outward` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode_area` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outward_part` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,5) DEFAULT NULL,
  `longitude` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`postcode_outward`),
  KEY `postcode_area` (`postcode_area`),
  CONSTRAINT `postcode_outwards_ibfk_2` FOREIGN KEY (`postcode_area`) REFERENCES `postcode_areas` (`postcode_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `postcodes` (
  `postcode` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,5) unsigned DEFAULT NULL,
  `longitude` decimal(10,5) DEFAULT NULL,
  `postcode_area` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode_outward` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  UNIQUE KEY `postcode` (`postcode`),
  KEY `latitude_longitude` (`latitude`,`longitude`),
  KEY `postcode_area` (`postcode_area`),
  KEY `postcode_outward` (`postcode_outward`),
  CONSTRAINT `postcodes_ibfk_1` FOREIGN KEY (`postcode_area`) REFERENCES `postcode_areas` (`postcode_area`),
  CONSTRAINT `postcodes_ibfk_2` FOREIGN KEY (`postcode_outward`) REFERENCES `postcode_outwards` (`postcode_outward`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET foreign_key_checks = 1;
