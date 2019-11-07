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
INSERT INTO `<<prefix>>subadmin1` VALUES (461,'BZ.06','BZ','Toledo','Toledo',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (462,'BZ.05','BZ','Stann Creek','Stann Creek',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (463,'BZ.04','BZ','Orange Walk','Orange Walk',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (464,'BZ.03','BZ','Corozal','Corozal',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (465,'BZ.02','BZ','Cayo','Cayo',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (466,'BZ.01','BZ','Belize','Belize',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin2` VALUES (8476,'BZ.04.6942862','BZ','BZ.04','Hopelchén','Hopelchen',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (8477,'BZ.05.9252696','BZ','BZ.05','Dangriga','Dangriga',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (8478,'BZ.05.9257719','BZ','BZ.05','Danriga District','Danriga District',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (3581164,'BZ','San Pedro','San Pedro',17.916,-87.9659,'P','PPL','BZ.01',NULL,8418,'America/Belize',1,'2014-02-07 23:00:00','2014-02-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3581194,'BZ','San Ignacio','San Ignacio',17.1588,-89.0696,'P','PPL','BZ.02',NULL,16812,'America/Belize',1,'2016-10-15 23:00:00','2016-10-15 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3581398,'BZ','Punta Gorda','Punta Gorda',16.0984,-88.8097,'P','PPLA','BZ.06',NULL,5205,'America/Belize',1,'2013-06-26 23:00:00','2013-06-26 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3581514,'BZ','Orange Walk','Orange Walk',18.0812,-88.5633,'P','PPLA','BZ.04',NULL,15298,'America/Belize',1,'2017-12-24 23:00:00','2017-12-24 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3582228,'BZ','Dangriga','Dangriga',16.9697,-88.2331,'P','PPLA','BZ.05','BZ.05.9252696',10750,'America/Belize',1,'2014-08-02 23:00:00','2014-08-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3582305,'BZ','Corozal','Corozal',18.3937,-88.3885,'P','PPLA','BZ.03',NULL,9871,'America/Belize',1,'2013-06-26 23:00:00','2013-06-26 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3582662,'BZ','Benque Viejo el Carmen','Benque Viejo el Carmen',17.075,-89.1392,'P','PPL','BZ.02',NULL,7092,'America/Belize',1,'2017-08-01 23:00:00','2017-08-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3582672,'BZ','Belmopan','Belmopan',17.25,-88.7667,'P','PPLC','BZ.02',NULL,13381,'America/Belize',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3582677,'BZ','Belize City','Belize City',17.4995,-88.1976,'P','PPLA','BZ.01',NULL,61461,'America/Belize',1,'2013-09-26 23:00:00','2013-09-26 23:00:00');
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
