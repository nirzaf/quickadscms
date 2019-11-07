-- MySQL dump 10.13  Distrib 5.6.35, for osx10.9 (x86_64)
--
-- Host: localhost    Database: Quickadclassified
-- ------------------------------------------------------
-- Server version	5.6.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `<<prefix>>subadmin1`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin1` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin1` VALUES (1159,'HK.NYL','HK','Yuen Long','Yuen Long',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1160,'HK.NTW','HK','Tsuen Wan','Tsuen Wan',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1161,'HK.NTP','HK','Tai Po','Tai Po',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1162,'HK.NSK','HK','Sai Kung','Sai Kung',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1163,'HK.NIS','HK','Islands','Islands',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1164,'HK.HCW','HK','Central and Western','Central and Western',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1165,'HK.HWC','HK','Wanchai','Wanchai',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1166,'HK.HEA','HK','Eastern','Eastern',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1167,'HK.HSO','HK','Southern','Southern',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1168,'HK.KYT','HK','Yau Tsim Mong','Yau Tsim Mong',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1169,'HK.KSS','HK','Sham Shui Po','Sham Shui Po',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1170,'HK.KKC','HK','Kowloon City','Kowloon City',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1171,'HK.KWT','HK','Wong Tai Sin','Wong Tai Sin',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1172,'HK.KKT','HK','Kwun Tong','Kwun Tong',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1173,'HK.NKT','HK','Kwai Tsing','Kwai Tsing',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1174,'HK.NTM','HK','Tuen Mun','Tuen Mun',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1175,'HK.NNO','HK','North','North',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1176,'HK.NST','HK','Sha Tin','Sha Tin',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (1818209,'HK','Tsuen Wan','Tsuen Wan',22.3707,114.105,'P','PPLA','HK.NTW',NULL,288728,'Asia/Hong_Kong',1,'2013-07-06 23:00:00','2013-07-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1818211,'HK','Yung Shue Wan','Yung Shue Wan',22.2262,114.112,'P','PPL','HK.00',NULL,6000,'Asia/Hong_Kong',1,'2014-11-04 23:00:00','2014-11-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1818223,'HK','Yuen Long Kau Hui','Yuen Long Kau Hui',22.45,114.033,'P','PPLA','HK.NYL',NULL,141900,'Asia/Hong_Kong',1,'2013-08-10 23:00:00','2013-08-10 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1818304,'HK','Wong Tai Sin','Wong Tai Sin',22.35,114.183,'P','PPLA','HK.KWT',NULL,0,'Asia/Hong_Kong',1,'2013-08-07 23:00:00','2013-08-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1818379,'HK','Wan Chai','Wan Chai',22.2814,114.173,'P','PPLA','HK.HWC',NULL,0,'Asia/Hong_Kong',1,'2013-07-06 23:00:00','2013-07-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1818446,'HK','Tuen Mun','Tuen Mun',22.3918,113.972,'P','PPLA','HK.NTM',NULL,16940,'Asia/Hong_Kong',1,'2013-08-08 23:00:00','2013-08-08 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1818673,'HK','Tai Po','Tai Po',22.4501,114.169,'P','PPLA','HK.NTP',NULL,16302,'Asia/Hong_Kong',1,'2015-02-06 23:00:00','2015-02-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1818920,'HK','Sha Tin','Sha Tin',22.3833,114.183,'P','PPLA','HK.NST',NULL,21559,'Asia/Hong_Kong',1,'2013-08-08 23:00:00','2013-08-08 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1818953,'HK','Sham Shui Po','Sham Shui Po',22.3302,114.159,'P','PPLA','HK.KSS',NULL,0,'Asia/Hong_Kong',1,'2013-07-06 23:00:00','2013-07-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1819050,'HK','Sai Kung','Sai Kung',22.3833,114.267,'P','PPLA','HK.NSK',NULL,11927,'Asia/Hong_Kong',1,'2013-08-07 23:00:00','2013-08-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1819609,'HK','Kowloon','Kowloon',22.3167,114.183,'P','PPLA','HK.KKC',NULL,2019533,'Asia/Hong_Kong',1,'2013-07-06 23:00:00','2013-07-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1819729,'HK','Hong Kong','Hong Kong',22.2783,114.175,'P','PPLC','HK.HCW',NULL,7012738,'Asia/Hong_Kong',1,'2017-05-22 23:00:00','2017-05-22 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (8223932,'HK','Central','Central',22.283,114.158,'P','PPLA','HK.HCW',NULL,0,'Asia/Hong_Kong',1,'2017-05-22 23:00:00','2017-05-22 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (11101593,'HK','Tung Chung','Tung Chung',22.2878,113.942,'P','PPL','HK.NIS',NULL,45000,'Asia/Hong_Kong',1,'2016-03-26 23:00:00','2016-03-26 23:00:00');
/*!40000 ALTER TABLE `<<prefix>>cities` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
