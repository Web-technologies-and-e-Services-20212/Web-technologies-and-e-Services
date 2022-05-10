-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for business_service
CREATE DATABASE IF NOT EXISTS `business_service` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `business_service`;

-- Dumping structure for table business_service.biz_categories
CREATE TABLE IF NOT EXISTS `biz_categories` (
  `Business_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Category_ID` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`Business_ID`,`Category_ID`),
  KEY `FK_biz_categories_categories` (`Category_ID`),
  CONSTRAINT `FK_biz_categories_businesses` FOREIGN KEY (`Business_ID`) REFERENCES `businesses` (`Business_ID`),
  CONSTRAINT `FK_biz_categories_categories` FOREIGN KEY (`Category_ID`) REFERENCES `categories` (`Category_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table business_service.biz_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `biz_categories` DISABLE KEYS */;
INSERT INTO `biz_categories` (`Business_ID`, `Category_ID`) VALUES
	(1, 'RT');
/*!40000 ALTER TABLE `biz_categories` ENABLE KEYS */;

-- Dumping structure for table business_service.businesses
CREATE TABLE IF NOT EXISTS `businesses` (
  `Business_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `Address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `City` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `Telephone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `URL` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`Business_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table business_service.businesses: ~0 rows (approximately)
/*!40000 ALTER TABLE `businesses` DISABLE KEYS */;
INSERT INTO `businesses` (`Business_ID`, `Name`, `Address`, `City`, `Telephone`, `URL`) VALUES
	(1, 'Vinhomes retail', '72A Đ. Nguyễn Trãi, Thượng Đình, Thanh Xuân, Hà Nội', 'Hà Nội', '0986807938', 'https://sangiaodichvinhomes.com/');
/*!40000 ALTER TABLE `businesses` ENABLE KEYS */;

-- Dumping structure for table business_service.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `Category_ID` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AUTO_INCREMENT',
  `Title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `Description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`Category_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table business_service.categories: ~3 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`Category_ID`, `Title`, `Description`) VALUES
	('FF', 'Distributor (Finished Goods)', 'Includes Wholesalers, Distributors, Brokers, Importer and Exporters of branded products'),
	('HP', 'Health Practitioner', 'ok'),
	('MF', 'Manufacturer', 'Manufactures finished products that are ready for an end consumer.'),
	('RT', 'Retailer', 'Owns or works for a retail store (this includes online stores)');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
