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
INSERT INTO `<<prefix>>subadmin1` VALUES (1706,'LI.11','LI','Vaduz','Vaduz',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1707,'LI.10','LI','Triesenberg','Triesenberg',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1708,'LI.09','LI','Triesen','Triesen',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1709,'LI.08','LI','Schellenberg','Schellenberg',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1710,'LI.07','LI','Schaan','Schaan',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1711,'LI.06','LI','Ruggell','Ruggell',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1712,'LI.05','LI','Planken','Planken',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1713,'LI.04','LI','Mauren','Mauren',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1714,'LI.03','LI','Gamprin','Gamprin',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1715,'LI.02','LI','Eschen','Eschen',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1716,'LI.01','LI','Balzers','Balzers',1);
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
INSERT INTO `<<prefix>>cities` VALUES (3042030,'LI','Vaduz','Vaduz',47.1415,9.52154,'P','PPLC','LI.11',NULL,5197,'Europe/Vaduz',1,'2013-04-01 23:00:00','2013-04-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3042033,'LI','Triesenberg','Triesenberg',47.1181,9.54197,'P','PPLA','LI.10',NULL,2689,'Europe/Vaduz',1,'2013-04-01 23:00:00','2013-04-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3042035,'LI','Triesen','Triesen',47.1075,9.52815,'P','PPLA','LI.09',NULL,4701,'Europe/Vaduz',1,'2013-10-12 23:00:00','2013-10-12 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3042037,'LI','Schellenberg','Schellenberg',47.2312,9.54678,'P','PPLA','LI.08',NULL,1004,'Europe/Vaduz',1,'2013-04-01 23:00:00','2013-04-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3042041,'LI','Schaan','Schaan',47.165,9.50867,'P','PPLA','LI.07',NULL,5748,'Europe/Vaduz',1,'2013-10-12 23:00:00','2013-10-12 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3042046,'LI','Ruggell','Ruggell',47.238,9.5254,'P','PPLA','LI.06',NULL,1862,'Europe/Vaduz',1,'2013-04-01 23:00:00','2013-04-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3042049,'LI','Planken','Planken',47.1852,9.54437,'P','PPLA','LI.05',NULL,377,'Europe/Vaduz',1,'2013-04-01 23:00:00','2013-04-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3042055,'LI','Mauren','Mauren',47.218,9.5442,'P','PPLA','LI.04',NULL,3626,'Europe/Vaduz',1,'2017-12-20 23:00:00','2017-12-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3042062,'LI','Gamprin','Gamprin',47.2204,9.50935,'P','PPLA','LI.03',NULL,1268,'Europe/Vaduz',1,'2013-04-01 23:00:00','2013-04-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3042068,'LI','Eschen','Eschen',47.2107,9.52223,'P','PPLA','LI.02',NULL,4008,'Europe/Vaduz',1,'2013-04-01 23:00:00','2013-04-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3042073,'LI','Balzers','Balzers',47.0667,9.50251,'P','PPLA','LI.01',NULL,4447,'Europe/Vaduz',1,'2015-08-06 23:00:00','2015-08-06 23:00:00');
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
