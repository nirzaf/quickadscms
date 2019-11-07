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
INSERT INTO `<<prefix>>subadmin1` VALUES (8,'AE.07','AE','Umm al Qaywayn','Umm al Qaywayn',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (9,'AE.05','AE','Raʼs al Khaymah','Ra\'s al Khaymah',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (10,'AE.03','AE','Dubai','Dubai',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (11,'AE.06','AE','Ash Shāriqah','Ash Shariqah',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (12,'AE.04','AE','Al Fujayrah','Al Fujayrah',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (13,'AE.02','AE','Ajman','Ajman',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (14,'AE.01','AE','Abu Dhabi','Abu Dhabi',1);
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
INSERT INTO `<<prefix>>cities` VALUES (290594,'AE','Umm al Qaywayn','Umm al Qaywayn',25.5647,55.5552,'P','PPLA','AE.07',NULL,44411,'Asia/Dubai',1,'2014-10-06 23:00:00','2014-10-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (291074,'AE','Ras al-Khaimah','Ras al-Khaimah',25.7895,55.9432,'P','PPLA','AE.05',NULL,115949,'Asia/Dubai',1,'2015-12-04 23:00:00','2015-12-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (291279,'AE','Muzayri‘','Muzayri`',23.1436,53.7881,'P','PPL','AE.01',NULL,10000,'Asia/Dubai',1,'2013-10-23 23:00:00','2013-10-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (291696,'AE','Khawr Fakkān','Khawr Fakkan',25.3313,56.342,'P','PPL','AE.06',NULL,33575,'Asia/Dubai',1,'2013-10-24 23:00:00','2013-10-24 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (292223,'AE','Dubai','Dubai',25.0657,55.1713,'P','PPLA','AE.03',NULL,1137347,'Asia/Dubai',1,'2014-12-01 23:00:00','2014-12-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (292231,'AE','Dibba Al-Fujairah','Dibba Al-Fujairah',25.5925,56.2618,'P','PPL','AE.04',NULL,30000,'Asia/Dubai',1,'2014-08-11 23:00:00','2014-08-11 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (292239,'AE','Dibba Al-Hisn','Dibba Al-Hisn',25.6196,56.2729,'P','PPL','AE.04',NULL,26395,'Asia/Dubai',1,'2014-04-20 23:00:00','2014-04-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (292672,'AE','Sharjah','Sharjah',25.3374,55.4121,'P','PPLA','AE.06',NULL,543733,'Asia/Dubai',1,'2013-03-04 23:00:00','2013-03-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (292688,'AE','Ar Ruways','Ar Ruways',24.1103,52.7306,'P','PPL','AE.01',NULL,16000,'Asia/Dubai',1,'2012-11-02 23:00:00','2012-11-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (292878,'AE','Al Fujayrah','Al Fujayrah',25.1164,56.3414,'P','PPLA','AE.04',NULL,62415,'Asia/Dubai',1,'2016-12-17 23:00:00','2016-12-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (292913,'AE','Al Ain','Al Ain',24.1917,55.7606,'P','PPL','AE.01',NULL,408733,'Asia/Dubai',1,'2013-03-16 23:00:00','2013-03-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (292932,'AE','Ajman','Ajman',25.4111,55.435,'P','PPLA','AE.02',NULL,226172,'Asia/Dubai',1,'2013-03-23 23:00:00','2013-03-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (292953,'AE','Adh Dhayd','Adh Dhayd',25.2881,55.8816,'P','PPL','AE.06',NULL,24716,'Asia/Dubai',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (292968,'AE','Abu Dhabi','Abu Dhabi',24.4667,54.3667,'P','PPLC','AE.01',NULL,603492,'Asia/Dubai',1,'2016-06-02 23:00:00','2016-06-02 23:00:00');
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
