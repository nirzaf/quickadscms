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
INSERT INTO `<<prefix>>subadmin1` VALUES (439,'BW.10','BW','Ngwaketsi','Ngwaketsi',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (440,'BW.09','BW','South-East','South-East',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (441,'BW.08','BW','North-East','North-East',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (442,'BW.11','BW','North-West','North-West',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (443,'BW.06','BW','Kweneng','Kweneng',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (444,'BW.05','BW','Kgatleng','Kgatleng',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (445,'BW.04','BW','Kgalagadi','Kgalagadi',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (446,'BW.03','BW','Ghanzi','Ghanzi',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (447,'BW.01','BW','Central','Central',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (448,'BW.13','BW','City of Francistown','City of Francistown',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (449,'BW.14','BW','Gaborone','Gaborone',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (450,'BW.15','BW','Jwaneng','Jwaneng',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (451,'BW.16','BW','Lobatse','Lobatse',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (452,'BW.17','BW','Selibe Phikwe','Selibe Phikwe',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (453,'BW.18','BW','Sowa Town','Sowa Town',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin2` VALUES (8312,'BW.09.7670702','BW','BW.09','Gaborone','Gaborone',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (8313,'BW.05.7670705','BW','BW.05','Kgatleng','Kgatleng',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (8314,'BW.01.7670706','BW','BW.01','Mahalapye','Mahalapye',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (8315,'BW.01.7670708','BW','BW.01','Machaneng','Machaneng',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (8316,'BW.01.7670709','BW','BW.01','Serowe','Serowe',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (8317,'BW.01.7670710','BW','BW.01','Palapye','Palapye',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (932987,'BW','Tshabong','Tshabong',-26.05,22.45,'P','PPLA','BW.04',NULL,6591,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933000,'BW','Tonota','Tonota',-21.4424,27.4615,'P','PPL','BW.01',NULL,17759,'Africa/Gaborone',1,'2012-04-09 23:00:00','2012-04-09 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933018,'BW','Thamaga','Thamaga',-24.6701,25.5397,'P','PPL','BW.06',NULL,20756,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933077,'BW','Shakawe','Shakawe',-18.3654,21.8422,'P','PPL','BW.11',NULL,5651,'Africa/Gaborone',1,'2013-06-09 23:00:00','2013-06-09 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933088,'BW','Serowe','Serowe',-22.3875,26.7108,'P','PPLA','BW.01',NULL,47419,'Africa/Gaborone',1,'2012-04-09 23:00:00','2012-04-09 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933099,'BW','Selebi-Phikwe','Selebi-Phikwe',-21.979,27.843,'P','PPL','BW.17',NULL,53727,'Africa/Gaborone',1,'2018-01-23 23:00:00','2018-01-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933141,'BW','Ramotswa','Ramotswa',-24.8716,25.8699,'P','PPLA','BW.09',NULL,21450,'Africa/Gaborone',1,'2014-04-05 23:00:00','2014-04-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933151,'BW','Rakops','Rakops',-21.0226,24.3605,'P','PPL','BW.01',NULL,5222,'Africa/Gaborone',1,'2013-08-05 23:00:00','2013-08-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933182,'BW','Palapye','Palapye',-22.546,27.1251,'P','PPL','BW.01',NULL,30650,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933184,'BW','Otse','Otse',-25.0167,25.7333,'P','PPL','BW.09',NULL,6275,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933186,'BW','Orapa','Orapa',-21.3115,25.3764,'P','PPL','BW.01',NULL,9189,'Africa/Gaborone',1,'2013-08-05 23:00:00','2013-08-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933271,'BW','Mosopa','Mosopa',-24.7718,25.4216,'P','PPL','BW.10',NULL,19561,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933305,'BW','Molepolole','Molepolole',-24.4066,25.4951,'P','PPLA','BW.06',NULL,63248,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933331,'BW','Mogoditshane','Mogoditshane',-24.6269,25.8656,'P','PPL','BW.06',NULL,43394,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933340,'BW','Mochudi','Mochudi',-24.4167,26.15,'P','PPLA','BW.05',NULL,36962,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933366,'BW','Maun','Maun',-19.9833,23.4167,'P','PPLA','BW.11',NULL,49945,'Africa/Gaborone',1,'2014-07-20 23:00:00','2014-07-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933471,'BW','Mahalapye','Mahalapye',-23.1041,26.8142,'P','PPL','BW.01',NULL,44471,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933521,'BW','Lobatse','Lobatse',-25.2243,25.6773,'P','PPL','BW.16',NULL,30883,'Africa/Gaborone',1,'2018-01-23 23:00:00','2018-01-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933534,'BW','Letlhakeng','Letlhakeng',-24.0944,25.0298,'P','PPL','BW.06',NULL,6781,'Africa/Gaborone',1,'2013-06-05 23:00:00','2013-06-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933535,'BW','Letlhakane','Letlhakane',-21.4149,25.5926,'P','PPL','BW.01',NULL,18136,'Africa/Gaborone',1,'2013-08-05 23:00:00','2013-08-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933596,'BW','Kopong','Kopong',-24.4833,25.8833,'P','PPL','BW.09',NULL,6895,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933677,'BW','Kasane','Kasane',-17.8167,25.15,'P','PPL','BW.11',NULL,9250,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933685,'BW','Kanye','Kanye',-24.9667,25.3327,'P','PPLA','BW.10',NULL,44716,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933719,'BW','Janeng','Janeng',-25.4167,25.55,'P','PPL','BW.09',NULL,16853,'Africa/Gaborone',1,'2013-06-05 23:00:00','2013-06-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933759,'BW','Ghanzi','Ghanzi',-21.6978,21.6458,'P','PPLA','BW.03',NULL,9934,'Africa/Gaborone',1,'2016-03-30 23:00:00','2016-03-30 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933773,'BW','Gaborone','Gaborone',-24.6545,25.9086,'P','PPLC','BW.14',NULL,208411,'Africa/Gaborone',1,'2017-12-26 23:00:00','2017-12-26 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933777,'BW','Gabane','Gabane',-24.6667,25.7822,'P','PPL','BW.06',NULL,12884,'Africa/Gaborone',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (933778,'BW','Francistown','Francistown',-21.17,27.5078,'P','PPLA','BW.13',NULL,89979,'Africa/Gaborone',1,'2018-01-09 23:00:00','2018-01-09 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1106206,'BW','Metsemotlhaba','Metsemotlhaba',-24.5514,25.8031,'P','PPL','BW.06',NULL,5544,'Africa/Gaborone',1,'2006-01-26 23:00:00','2006-01-26 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (8308627,'BW','Jwaneng','Jwaneng',-24.6017,24.7281,'P','PPLA','BW.15',NULL,0,'Africa/Gaborone',1,'2018-01-10 23:00:00','2018-01-10 23:00:00');
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
