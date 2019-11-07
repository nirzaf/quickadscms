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
INSERT INTO `<<prefix>>subadmin1` VALUES (977,'FJ.05','FJ','Western','Western',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (978,'FJ.03','FJ','Northern','Northern',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (979,'FJ.01','FJ','Central','Central',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (980,'FJ.02','FJ','Eastern','Eastern',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (981,'FJ.04','FJ','Rotuma','Rotuma',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin2` VALUES (12923,'FJ.03.2197820','FJ','FJ.03','Cakaudrove Province','Cakaudrove Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12924,'FJ.01.2198131','FJ','FJ.01','Tailevu Province','Tailevu Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12925,'FJ.01.2198411','FJ','FJ.01','Serua Province','Serua Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12926,'FJ.01.2198876','FJ','FJ.01','Rewa Province','Rewa Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12927,'FJ.05.2198946','FJ','FJ.05','Ra Province','Ra Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12928,'FJ.05.2201984','FJ','FJ.05','Nandronga and Navosa Province','Nandronga and Navosa Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12929,'FJ.01.2202182','FJ','FJ.01','Namosi Province','Namosi Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12930,'FJ.01.2203150','FJ','FJ.01','Naitasiri Province','Naitasiri Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12931,'FJ.03.2203651','FJ','FJ.03','Bua Province','Bua Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12932,'FJ.05.2203798','FJ','FJ.05','Ba Province','Ba Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12933,'FJ.03.2203875','FJ','FJ.03','Macuata Province','Macuata Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12934,'FJ.02.2204318','FJ','FJ.02','Lomaiviti Province','Lomaiviti Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12935,'FJ.02.4036132','FJ','FJ.02','Lau Province','Lau Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12936,'FJ.02.8617786','FJ','FJ.02','Kadavu Province','Kadavu Province',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12937,'FJ.04.10049406','FJ','FJ.04','Malhaha','Malhaha',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12938,'FJ.04.10049432','FJ','FJ.04','Pepjei','Pepjei',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12939,'FJ.04.11102238','FJ','FJ.04','Noa\'tau','Noa\'tau',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12940,'FJ.04.11102239','FJ','FJ.04','Oinafa','Oinafa',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12941,'FJ.04.11102240','FJ','FJ.04','Itu\'ti\'u','Itu\'ti\'u',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12942,'FJ.04.11102241','FJ','FJ.04','Juju','Juju',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (12943,'FJ.04.11102242','FJ','FJ.04','Itu\'muta','Itu\'muta',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (2198148,'FJ','Suva','Suva',-18.1416,178.441,'P','PPLC','FJ.01',NULL,77366,'Pacific/Fiji',1,'2010-05-29 23:00:00','2010-05-29 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2202064,'FJ','Nadi','Nadi',-17.8031,177.416,'P','PPL','FJ.05','FJ.05.2203798',42284,'Pacific/Fiji',1,'2017-09-10 23:00:00','2017-09-10 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2204417,'FJ','Levuka','Levuka',-18.0667,179.317,'P','PPLA','FJ.02',NULL,8360,'Pacific/Fiji',1,'2013-08-15 23:00:00','2013-08-15 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2204506,'FJ','Lautoka','Lautoka',-17.6169,177.45,'P','PPLA','FJ.05',NULL,52500,'Pacific/Fiji',1,'2016-07-16 23:00:00','2016-07-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2204582,'FJ','Labasa','Labasa',-16.4332,179.365,'P','PPLA','FJ.03',NULL,27949,'Pacific/Fiji',1,'2016-04-16 23:00:00','2016-04-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2205310,'FJ','Ahau','Ahau',-12.5,177.05,'P','PPLA','FJ.04',NULL,0,'Pacific/Fiji',1,'2013-06-26 23:00:00','2013-06-26 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (8335413,'FJ','Ba','Ba',-17.5343,177.674,'P','PPLA2','FJ.05','FJ.05.2203798',14596,'Pacific/Fiji',1,'2016-11-17 23:00:00','2016-11-17 23:00:00');
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
