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
INSERT INTO `<<prefix>>subadmin1` VALUES (3360,'TF.02','TF','Crozet','Crozet',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3361,'TF.03','TF','Kerguelen','Kerguelen',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3362,'TF.01','TF','Saint-Paul-et-Amsterdam','Saint-Paul-et-Amsterdam',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3363,'TF.05','TF','Îles Éparses','Iles Eparses',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3364,'TF.04','TF','Terre-Adélie','Terre-Adelie',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin2` VALUES (36427,'TF.05.TE','TF','TF.05','Tromelin Island','Tromelin Island',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36428,'TF.05.EU','TF','TF.05','Europa Island','Europa Island',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36429,'TF.05.BS','TF','TF.05','Bassas da India','Bassas da India',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36430,'TF.05.JU','TF','TF.05','Juan de Nova Island','Juan de Nova Island',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36431,'TF.05.GO','TF','TF.05','Glorioso Islands','Glorioso Islands',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (1546102,'TF','Port-aux-Français','Port-aux-Francais',-49.35,70.2167,'P','PPLC','TF.03',NULL,45,'Indian/Kerguelen',1,'2017-12-06 23:00:00','2017-12-06 23:00:00');
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
