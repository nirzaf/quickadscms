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
INSERT INTO `<<prefix>>subadmin1` VALUES (1,'AD.06','AD','Sant Julià de Loria','Sant Julia de Loria',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (2,'AD.05','AD','Ordino','Ordino',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3,'AD.04','AD','La Massana','La Massana',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (4,'AD.03','AD','Encamp','Encamp',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (5,'AD.02','AD','Canillo','Canillo',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (6,'AD.07','AD','Andorra la Vella','Andorra la Vella',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (7,'AD.08','AD','Escaldes-Engordany','Escaldes-Engordany',1);
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
INSERT INTO `<<prefix>>cities` VALUES (3039163,'AD','Sant Julià de Lòria','Sant Julia de Loria',42.4637,1.49129,'P','PPLA','AD.06',NULL,8022,'Europe/Andorra',1,'2013-11-22 23:00:00','2013-11-22 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3039678,'AD','Ordino','Ordino',42.5562,1.53319,'P','PPLA','AD.05',NULL,3066,'Europe/Andorra',1,'2009-12-10 23:00:00','2009-12-10 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3040051,'AD','les Escaldes','les Escaldes',42.5073,1.53414,'P','PPLA','AD.08',NULL,15853,'Europe/Andorra',1,'2008-10-14 23:00:00','2008-10-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3040132,'AD','la Massana','la Massana',42.545,1.51483,'P','PPLA','AD.04',NULL,7211,'Europe/Andorra',1,'2008-10-14 23:00:00','2008-10-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3040686,'AD','Encamp','Encamp',42.5347,1.58014,'P','PPLA','AD.03',NULL,11223,'Europe/Andorra',1,'2012-04-12 23:00:00','2012-04-12 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3041204,'AD','Canillo','Canillo',42.5676,1.59756,'P','PPLA','AD.02',NULL,3292,'Europe/Andorra',1,'2012-12-23 23:00:00','2012-12-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3041563,'AD','Andorra la Vella','Andorra la Vella',42.5078,1.52109,'P','PPLC','AD.07',NULL,20430,'Europe/Andorra',1,'2010-05-29 23:00:00','2010-05-29 23:00:00');
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
