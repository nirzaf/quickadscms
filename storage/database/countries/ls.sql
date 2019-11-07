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
INSERT INTO `<<prefix>>subadmin1` VALUES (1741,'LS.19','LS','Thaba-Tseka','Thaba-Tseka',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1742,'LS.18','LS','Quthing','Quthing',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1743,'LS.17','LS','Qachaʼs Nek','Qacha\'s Nek',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1744,'LS.16','LS','Mokhotlong','Mokhotlong',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1745,'LS.15','LS','Mohaleʼs Hoek','Mohale\'s Hoek District',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1746,'LS.14','LS','Maseru','Maseru',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1747,'LS.13','LS','Mafeteng','Mafeteng',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1748,'LS.12','LS','Leribe','Leribe',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1749,'LS.11','LS','Butha-Buthe','Butha-Buthe',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1750,'LS.10','LS','Berea','Berea',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin2` VALUES (21284,'LS.12.7303922','LS','LS.12','Khomokhoana Community','Khomokhoana Community',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21285,'LS.14.7522489','LS','LS.14','Makhaleng Constituency','Makhaleng Constituency',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21286,'LS.12.7670780','LS','LS.12','Urban','Urban',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21287,'LS.12.7670807','LS','LS.12','Hleoheng','Hleoheng',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21288,'LS.10.7670808','LS','LS.10','Mokomahatsi','Mokomahatsi',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21289,'LS.10.7670809','LS','LS.10','Mokhachane','Mokhachane',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21290,'LS.10.7670811','LS','LS.10','Mapoteng','Mapoteng',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21291,'LS.10.7670815','LS','LS.10','Makhoroana','Makhoroana',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21292,'LS.10.7670819','LS','LS.10','Urban','Urban',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21293,'LS.10.7670820','LS','LS.10','Mamathe','Mamathe',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21294,'LS.14.11256888','LS','LS.14','Rothe','Rothe',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21295,'LS.11.11258465','LS','LS.11','Motete','Motete',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21296,'LS.11.11280716','LS','LS.11','Qalo','Qalo',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (21297,'LS.14.11428652','LS','LS.14','Maseru Central','Maseru Central',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (932035,'LS','Teyateyaneng','Teyateyaneng',-29.1472,27.7489,'P','PPLA','LS.10',NULL,5115,'Africa/Maseru',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (932183,'LS','Quthing','Quthing',-30.4,27.7003,'P','PPLA','LS.18',NULL,24130,'Africa/Maseru',1,'2010-06-24 23:00:00','2010-06-24 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (932218,'LS','Qacha’s Nek','Qacha\'s Nek',-30.1154,28.6894,'P','PPLA','LS.17',NULL,25573,'Africa/Maseru',1,'2017-08-31 23:00:00','2017-08-31 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (932320,'LS','Nako','Nako',-29.6167,27.7667,'P','PPL','LS.14',NULL,13146,'Africa/Maseru',1,'2013-08-17 23:00:00','2013-08-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (932416,'LS','Mokhotlong','Mokhotlong',-29.2894,29.0675,'P','PPLA','LS.16',NULL,8809,'Africa/Maseru',1,'2010-05-23 23:00:00','2010-05-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (932438,'LS','Mohale’s Hoek','Mohale\'s Hoek',-30.1514,27.4769,'P','PPLA','LS.15',NULL,28310,'Africa/Maseru',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (932505,'LS','Maseru','Maseru',-29.3167,27.4833,'P','PPLC','LS.14',NULL,118355,'Africa/Maseru',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (932521,'LS','Maputsoe','Maputsoe',-28.8866,27.8992,'P','PPL','LS.12',NULL,32117,'Africa/Maseru',1,'2012-04-04 23:00:00','2012-04-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (932614,'LS','Mafeteng','Mafeteng',-29.823,27.2374,'P','PPLA','LS.13',NULL,57059,'Africa/Maseru',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (932698,'LS','Leribe','Leribe',-28.8718,28.045,'P','PPLA','LS.12',NULL,47675,'Africa/Maseru',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (932886,'LS','Butha-Buthe','Butha-Buthe',-28.7666,28.2494,'P','PPLA','LS.11',NULL,16330,'Africa/Maseru',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1106835,'LS','Thaba-Tseka','Thaba-Tseka',-29.522,28.6084,'P','PPLA','LS.19',NULL,5423,'Africa/Maseru',1,'2012-01-19 23:00:00','2012-01-19 23:00:00');
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
