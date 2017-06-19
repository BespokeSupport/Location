
SET foreign_key_checks = 0;

USE `test`;

CREATE TABLE IF NOT EXISTS `postcode_areas` (
  `postcode_area` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `population` int(10) unsigned DEFAULT NULL,
PRIMARY KEY (`postcode_area`),
KEY `region` (`region`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `postcode_outwards` (
  `postcode_outward` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode_area` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outward_part` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,5) DEFAULT NULL,
  `longitude` decimal(10,5) DEFAULT NULL,
  `town` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_string` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `geo` point DEFAULT NULL,
  PRIMARY KEY (`postcode_outward`),
  KEY `town` (`town`(191)),
  KEY `postcode_area` (`postcode_area`),
  CONSTRAINT `postcode_outwards_ibfk_2` FOREIGN KEY (`postcode_area`) REFERENCES `postcode_areas` (`postcode_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO postcode_areas (postcode_area, city, region) VALUES ('AB', 'Aberdeen', 'Scotland');

INSERT INTO `postcode_outwards` (`postcode_outward`, `postcode_area`, `outward_part`, `latitude`, `longitude`) VALUES
('AB10',	'AB',	'10',	57.1351,	-2.1173);
