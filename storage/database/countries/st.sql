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
INSERT INTO `<<prefix>>subadmin1` VALUES (3303,'ST.02','ST','São Tomé Island','Sao Tome Island',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3304,'ST.01','ST','Príncipe','Principe',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin2` VALUES (36235,'ST.02.8299560','ST','ST.02','Lemba District','Lemba District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36236,'ST.02.8299561','ST','ST.02','Lobata District','Lobata District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36237,'ST.02.11203894','ST','ST.02','Mé-Zóchi District','Me-Zochi District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36238,'ST.02.11203920','ST','ST.02','Água Grande District','Agua Grande District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36239,'ST.02.11204213','ST','ST.02','Cantagalo District','Cantagalo District',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (2410763,'ST','São Tomé','Sao Tome',0.33654,6.72732,'P','PPLC','ST.02',NULL,53300,'Africa/Sao_Tome',1,'2017-07-02 23:00:00','2017-07-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2410805,'ST','Santo António','Santo Antonio',1.63943,7.41951,'P','PPLA','ST.01',NULL,1156,'Africa/Sao_Tome',1,'2018-01-22 23:00:00','2018-01-22 23:00:00');
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
