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
INSERT INTO `<<prefix>>subadmin1` VALUES (3468,'TM.02','TM','Balkan','Balkan',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3469,'TM.01','TM','Ahal','Ahal',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3470,'TM.S','TM','Ashgabat','Ashgabat',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3471,'TM.03','TM','Daşoguz','Dasoguz',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3472,'TM.05','TM','Mary','Mary',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3473,'TM.04','TM','Lebap','Lebap',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin2` VALUES (37531,'TM.05.1218305','TM','TM.05','Tagtabazar Etrap','Tagtabazar Etrap',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (37532,'TM.05.1218742','TM','TM.05','Guşgy Etrap','Gusgy Etrap',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (37533,'TM.01.11189155','TM','TM.01','Baharly District','Baharly District',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (161616,'TM','Balkanabat','Balkanabat',39.5107,54.3671,'P','PPLA','TM.02',NULL,87822,'Asia/Ashgabat',1,'2013-11-27 23:00:00','2013-11-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (161901,'TM','Kaka','Kaka',37.3482,59.6143,'P','PPL','TM.01',NULL,18545,'Asia/Ashgabat',1,'2014-03-05 23:00:00','2014-03-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (161931,'TM','Serdar','Serdar',38.9764,56.2757,'P','PPL','TM.02',NULL,12000,'Asia/Ashgabat',1,'2014-03-05 23:00:00','2014-03-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (161943,'TM','Gumdag','Gumdag',39.2061,54.5906,'P','PPL','TM.02',NULL,24312,'Asia/Ashgabat',1,'2012-01-16 23:00:00','2012-01-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (161974,'TM','Gazanjyk','Gazanjyk',39.2446,55.5154,'P','PPL','TM.02',NULL,21090,'Asia/Ashgabat',1,'2012-01-16 23:00:00','2012-01-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (162099,'TM','Abadan','Abadan',38.0541,58.1972,'P','PPL','TM.01',NULL,39481,'Asia/Ashgabat',1,'2014-10-14 23:00:00','2014-10-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (162158,'TM','Baharly','Baharly',38.4362,57.4316,'P','PPL','TM.01',NULL,22991,'Asia/Ashgabat',1,'2014-07-07 23:00:00','2014-07-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (162183,'TM','Ashgabat','Ashgabat',37.95,58.3833,'P','PPLC','TM.01',NULL,727700,'Asia/Ashgabat',1,'2017-06-21 23:00:00','2017-06-21 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (162199,'TM','Annau','Annau',37.8875,58.516,'P','PPLA','TM.01',NULL,27526,'Asia/Ashgabat',1,'2017-07-31 23:00:00','2017-07-31 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (601432,'TM','Yylanly','Yylanly',41.8333,59.65,'P','PPL','TM.03',NULL,26901,'Asia/Ashgabat',1,'2013-10-28 23:00:00','2013-10-28 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (601475,'TM','Tagta','Tagta',41.6504,59.9164,'P','PPL','TM.03',NULL,16635,'Asia/Ashgabat',1,'2013-10-29 23:00:00','2013-10-29 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (601551,'TM','Akdepe','Akdepe',42.0551,59.3788,'P','PPL','TM.00',NULL,14177,'Asia/Ashgabat',1,'2012-01-16 23:00:00','2012-01-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (601594,'TM','Türkmenbaşy','Turkmenbasy',40.0222,52.9552,'P','PPL','TM.02',NULL,68292,'Asia/Ashgabat',1,'2017-01-19 23:00:00','2017-01-19 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (601608,'TM','Köneürgench','Koeneuergench',42.3277,59.1544,'P','PPL','TM.03',NULL,30000,'Asia/Ashgabat',1,'2013-08-17 23:00:00','2013-08-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (601661,'TM','Boldumsaz','Boldumsaz',42.1282,59.671,'P','PPL','TM.03',NULL,21159,'Asia/Ashgabat',1,'2013-10-29 23:00:00','2013-10-29 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (601734,'TM','Daşoguz','Dasoguz',41.8363,59.9666,'P','PPLA','TM.03',NULL,166500,'Asia/Ashgabat',1,'2015-03-06 23:00:00','2015-03-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1218021,'TM','Yolöten','Yoloeten',37.2989,62.3597,'P','PPL','TM.05',NULL,37705,'Asia/Ashgabat',1,'2013-10-28 23:00:00','2013-10-28 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1218239,'TM','Tejen','Tejen',37.3834,60.5055,'P','PPL','TM.01',NULL,67294,'Asia/Ashgabat',1,'2012-01-16 23:00:00','2012-01-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1218420,'TM','Seydi','Seydi',39.4816,62.9137,'P','PPL','TM.05',NULL,17762,'Asia/Ashgabat',1,'2013-10-29 23:00:00','2013-10-29 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1218436,'TM','Saýat','Sayat',38.7839,63.8803,'P','PPL','TM.04',NULL,17762,'Asia/Ashgabat',1,'2012-01-16 23:00:00','2012-01-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1218612,'TM','Murgab','Murgab',37.4966,61.9714,'P','PPL','TM.00',NULL,13199,'Asia/Ashgabat',1,'2012-01-16 23:00:00','2012-01-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1218667,'TM','Mary','Mary',37.5938,61.8303,'P','PPLA','TM.05',NULL,114680,'Asia/Ashgabat',1,'2012-01-16 23:00:00','2012-01-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1219002,'TM','Atamyrat','Atamyrat',37.8357,65.2106,'P','PPL','TM.04',NULL,33242,'Asia/Ashgabat',1,'2012-01-16 23:00:00','2012-01-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1219377,'TM','Serhetabat','Serhetabat',35.2799,62.3438,'P','PPL','TM.05',NULL,5200,'Asia/Ashgabat',1,'2014-04-05 23:00:00','2014-04-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1219392,'TM','Gowurdak','Gowurdak',37.8124,66.0466,'P','PPL','TM.04',NULL,34745,'Asia/Ashgabat',1,'2012-01-16 23:00:00','2012-01-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1219431,'TM','Farap','Farap',39.1704,63.6116,'P','PPL','TM.04',NULL,14503,'Asia/Ashgabat',1,'2012-01-16 23:00:00','2012-01-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1219649,'TM','Türkmenabat','Turkmenabat',39.0733,63.5786,'P','PPLA','TM.04',NULL,234817,'Asia/Ashgabat',1,'2014-08-18 23:00:00','2014-08-18 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1219762,'TM','Bayramaly','Bayramaly',37.6185,62.1671,'P','PPL','TM.05',NULL,75797,'Asia/Ashgabat',1,'2016-04-03 23:00:00','2016-04-03 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1514792,'TM','Gazojak','Gazojak',41.1875,61.4036,'P','PPL','TM.04',NULL,21021,'Asia/Ashgabat',1,'2014-01-19 23:00:00','2014-01-19 23:00:00');
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
