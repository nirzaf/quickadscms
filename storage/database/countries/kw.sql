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
INSERT INTO `<<prefix>>subadmin1` VALUES (1641,'KW.08','KW','Hawalli','Hawalli',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1642,'KW.02','KW','Al Asimah','Al Asimah',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1643,'KW.05','KW','Al Jahrāʼ','Muhafazat al Jahra\'',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1644,'KW.07','KW','Al Farwaniyah','Al Farwaniyah',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1645,'KW.04','KW','Al Aḩmadī','Al Ahmadi',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1646,'KW.09','KW','Mubārak al Kabīr','Mubarak al Kabir',1);
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
INSERT INTO `<<prefix>>cities` VALUES (285603,'KW','Janūb as Surrah','Janub as Surrah',29.2692,47.9781,'P','PPL','KW.07',NULL,18496,'Asia/Kuwait',1,'2015-01-03 23:00:00','2015-01-03 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285629,'KW','Ḩawallī','Hawalli',29.3328,48.0286,'P','PPLA','KW.08',NULL,164212,'Asia/Kuwait',1,'2013-08-03 23:00:00','2013-08-03 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285663,'KW','Bayān','Bayan',29.3032,48.0488,'P','PPLX','KW.08',NULL,30635,'Asia/Kuwait',1,'2016-09-12 23:00:00','2016-09-12 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285673,'KW','Az Zawr','Az Zawr',29.4425,48.2747,'P','PPL','KW.02',NULL,5750,'Asia/Kuwait',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285704,'KW','As Sālimīyah','As Salimiyah',29.3339,48.0761,'P','PPLX','KW.08',NULL,147649,'Asia/Kuwait',1,'2016-06-03 23:00:00','2016-06-03 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285721,'KW','Ash Shāmīyah','Ash Shamiyah',29.3472,47.9617,'P','PPLX','KW.02',NULL,13762,'Asia/Kuwait',1,'2013-03-01 23:00:00','2013-03-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285726,'KW','Ar Rumaythīyah','Ar Rumaythiyah',29.3117,48.0742,'P','PPLX','KW.08',NULL,58135,'Asia/Kuwait',1,'2013-07-18 23:00:00','2013-07-18 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285728,'KW','Ar Riqqah','Ar Riqqah',29.1458,48.0947,'P','PPL','KW.04',NULL,52068,'Asia/Kuwait',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285760,'KW','Al Wafrah','Al Wafrah',28.6392,47.9306,'P','PPL','KW.04',NULL,10017,'Asia/Kuwait',1,'2013-05-03 23:00:00','2013-05-03 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285778,'KW','Al Manqaf','Al Manqaf',29.0961,48.1328,'P','PPL','KW.04',NULL,39025,'Asia/Kuwait',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285782,'KW','Al Mahbūlah','Al Mahbulah',29.145,48.1303,'P','PPL','KW.04',NULL,18178,'Asia/Kuwait',1,'2012-12-05 23:00:00','2012-12-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285787,'KW','Kuwait City','Kuwait City',29.3697,47.9783,'P','PPLC','KW.02',NULL,60064,'Asia/Kuwait',1,'2017-06-21 23:00:00','2017-06-21 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285799,'KW','Al Jahrā’','Al Jahra\'',29.3375,47.6581,'P','PPLA','KW.05',NULL,24281,'Asia/Kuwait',1,'2013-05-04 23:00:00','2013-05-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285811,'KW','Al Faḩāḩīl','Al Fahahil',29.0825,48.1303,'P','PPL','KW.04',NULL,68290,'Asia/Kuwait',1,'2012-10-18 23:00:00','2012-10-18 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285812,'KW','Al Finţās','Al Fintas',29.1739,48.1211,'P','PPL','KW.04',NULL,23071,'Asia/Kuwait',1,'2016-06-03 23:00:00','2016-06-03 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285815,'KW','Al Farwānīyah','Al Farwaniyah',29.2775,47.9586,'P','PPLA','KW.07',NULL,86525,'Asia/Kuwait',1,'2013-05-04 23:00:00','2013-05-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285839,'KW','Al Aḩmadī','Al Ahmadi',29.0769,48.0839,'P','PPLA','KW.04',NULL,637411,'Asia/Kuwait',1,'2014-01-03 23:00:00','2014-01-03 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285856,'KW','Ad Dasmah','Ad Dasmah',29.365,48.0014,'P','PPL','KW.02',NULL,17585,'Asia/Kuwait',1,'2015-01-03 23:00:00','2015-01-03 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (387958,'KW','Salwá','Salwa',29.2958,48.0786,'P','PPLX','KW.08',NULL,40945,'Asia/Kuwait',1,'2012-10-18 23:00:00','2012-10-18 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (388065,'KW','Ar Rābiyah','Ar Rabiyah',29.295,47.9331,'P','PPLX','KW.02',NULL,36447,'Asia/Kuwait',1,'2012-10-18 23:00:00','2012-10-18 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (412800,'KW','Şabāḩ as Sālim','Sabah as Salim',29.2572,48.0572,'P','PPL','KW.09',NULL,139163,'Asia/Kuwait',1,'2017-06-21 23:00:00','2017-06-21 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (7329411,'KW','Mubārak al Kabīr','Mubarak al Kabir',29.1898,48.0872,'P','PPLA','KW.09',NULL,0,'Asia/Kuwait',1,'2013-07-02 23:00:00','2013-07-02 23:00:00');
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
