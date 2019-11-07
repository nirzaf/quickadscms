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
INSERT INTO `<<prefix>>subadmin1` VALUES (2758,'QA.08','QA','Madīnat ash Shamāl','Madinat ash Shamal',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (2759,'QA.04','QA','Al Khawr','Al Khawr',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (2760,'QA.09','QA','Baladīyat Umm Şalāl','Baladiyat Umm Salal',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (2761,'QA.06','QA','Baladīyat ar Rayyān','Baladiyat ar Rayyan',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (2762,'QA.01','QA','Baladīyat ad Dawḩah','Baladiyat ad Dawhah',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (2763,'QA.10','QA','Al Wakrah','Al Wakrah',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (2764,'QA.13','QA','Baladīyat az̧ Z̧a‘āyin','Baladiyat az Za`ayin',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (2765,'QA.14','QA','Al-Shahaniya','Al-Shahaniya',1);
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
INSERT INTO `<<prefix>>cities` VALUES (289523,'QA','Umm Şalāl Muḩammad','Umm Salal Muhammad',25.4152,51.4065,'P','PPL','QA.09',NULL,29391,'Asia/Qatar',1,'2016-08-02 23:00:00','2016-08-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (289524,'QA','Umm Şalāl ‘Alī','Umm Salal `Ali',25.4697,51.3975,'P','PPLA','QA.09',NULL,0,'Asia/Qatar',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (289525,'QA','Musay‘īd','Musay`id',24.9923,51.5507,'P','PPL','QA.10',NULL,5769,'Asia/Qatar',1,'2016-08-02 23:00:00','2016-08-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (289739,'QA','Madīnat ash Shamāl','Madinat ash Shamal',26.1293,51.2009,'P','PPLA','QA.08',NULL,5267,'Asia/Qatar',1,'2013-08-09 23:00:00','2013-08-09 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (289813,'QA','Dukhān','Dukhan',25.4249,50.7823,'P','PPL','QA.14',NULL,7250,'Asia/Qatar',1,'2017-12-06 23:00:00','2017-12-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (289847,'QA','Az̧ Z̧a‘āyin','Az Za`ayin',25.5774,51.4831,'P','PPLA','QA.13',NULL,0,'Asia/Qatar',1,'2012-02-01 23:00:00','2012-02-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (289877,'QA','Ash Shīḩānīyah','Ash Shihaniyah',25.3709,51.2226,'P','PPLA','QA.14',NULL,8380,'Asia/Qatar',1,'2017-12-06 23:00:00','2017-12-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (289888,'QA','Ar Rayyān','Ar Rayyan',25.2919,51.4244,'P','PPLA','QA.06',NULL,272465,'Asia/Qatar',1,'2014-07-22 23:00:00','2014-07-22 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (289913,'QA','Al Wukayr','Al Wukayr',25.1511,51.5372,'P','PPL','QA.10',NULL,5146,'Asia/Qatar',1,'2016-08-02 23:00:00','2016-08-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (289915,'QA','Al Wakrah','Al Wakrah',25.1715,51.6034,'P','PPLA','QA.10',NULL,26436,'Asia/Qatar',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (289962,'QA','Al Khawr','Al Khawr',25.6839,51.5058,'P','PPLA','QA.04',NULL,18923,'Asia/Qatar',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (290030,'QA','Doha','Doha',25.2854,51.531,'P','PPLC','QA.01',NULL,344939,'Asia/Qatar',1,'2017-08-22 23:00:00','2017-08-22 23:00:00');
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
