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
INSERT INTO `<<prefix>>subadmin1` VALUES (3607,'TW.01','TW','Fukien','Fukien',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3608,'TW.02','TW','Takao','Takao',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3609,'TW.03','TW','Taipei','Taipei',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3610,'TW.04','TW','Taiwan','Taiwan',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin2` VALUES (38757,'TW.03.TPQ','TW','TW.03','Taipei','Taipei',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38758,'TW.04.YUN','TW','TW.04','Yunlin','Yunlin',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38759,'TW.04.TAO','TW','TW.04','Taoyuan','Taoyuan',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38760,'TW.04.TTT','TW','TW.04','Taitung','Taitung',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38761,'TW.04.TPE','TW','TW.04','Taipei City','Taipei City',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38762,'TW.04.TNN','TW','TW.04','Tainan','Tainan',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38763,'TW.04.PIF','TW','TW.04','Pingtung','Pingtung',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38764,'TW.04.PEN','TW','TW.04','Penghu','Penghu',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38765,'TW.04.NAN','TW','TW.04','Nantou','Nantou',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38766,'TW.04.MIA','TW','TW.04','Miaoli','Miaoli',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38767,'TW.04.ILA','TW','TW.04','Yilan','Yilan',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38768,'TW.04.HUA','TW','TW.04','Hualien','Hualien',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38769,'TW.04.HSQ','TW','TW.04','Hsinchu','Hsinchu',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38770,'TW.04.HSZ','TW','TW.04','Hsinchu County','Hsinchu County',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38771,'TW.01.KIN','TW','TW.01','Kinmen County','Kinmen County',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38772,'TW.04.CYI','TW','TW.04','Chiayi','Chiayi',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38773,'TW.04.CYQ','TW','TW.04','Chiayi County','Chiayi County',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38774,'TW.04.CHA','TW','TW.04','Changhua','Changhua',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38775,'TW.04.KEE','TW','TW.04','Keelung','Keelung',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38776,'TW.01.LIE','TW','TW.01','Lienchiang','Lienchiang',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38777,'TW.02.KHH','TW','TW.02','Kaohsiung','Kaohsiung',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (38778,'TW.04.TXG','TW','TW.04','Taichung City','Taichung City',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (1665196,'TW','Douliu','Douliu',23.7094,120.543,'P','PPLA2','TW.04','TW.04.YUN',104723,'Asia/Taipei',1,'2017-09-26 23:00:00','2017-09-26 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1665357,'TW','Yujing','Yujing',23.1249,120.461,'P','PPL','TW.04','TW.04.TNN',16597,'Asia/Taipei',1,'2017-09-23 23:00:00','2017-09-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1665443,'TW','Yuanlin','Yuanlin',23.9611,120.572,'P','PPL','TW.04','TW.04.CHA',124725,'Asia/Taipei',1,'2017-09-26 23:00:00','2017-09-26 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1666596,'TW','Donggang','Donggang',22.4652,120.449,'P','PPL','TW.04','TW.04.PIF',48100,'Asia/Taipei',1,'2017-09-23 23:00:00','2017-09-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1668341,'TW','Taipei','Taipei',25.0478,121.532,'P','PPLC','TW.04','TW.04.TPE',7871900,'Asia/Taipei',1,'2017-09-25 23:00:00','2017-09-25 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1668355,'TW','Tainan','Tainan',22.9908,120.213,'P','PPLA2','TW.04','TW.04.TNN',771235,'Asia/Taipei',1,'2017-09-25 23:00:00','2017-09-25 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1668399,'TW','Taichung','Taichung',24.1469,120.684,'P','PPLA2','TW.04','TW.04.TXG',1040725,'Asia/Taipei',1,'2017-09-25 23:00:00','2017-09-25 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1668467,'TW','Daxi','Daxi',24.8837,121.29,'P','PPL','TW.04','TW.04.TAO',84549,'Asia/Taipei',1,'2017-09-23 23:00:00','2017-09-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1670029,'TW','Banqiao','Banqiao',25.0143,121.467,'P','PPLA2','TW.03','TW.03.TPQ',543342,'Asia/Taipei',1,'2017-09-28 23:00:00','2017-09-28 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1670310,'TW','Puli','Puli',23.9664,120.97,'P','PPL','TW.04','TW.04.NAN',86406,'Asia/Taipei',1,'2017-09-23 23:00:00','2017-09-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1671566,'TW','Nantou','Nantou',23.9157,120.664,'P','PPLA2','TW.04','TW.04.NAN',105682,'Asia/Taipei',1,'2017-09-26 23:00:00','2017-09-26 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1672228,'TW','Magong','Magong',23.5654,119.586,'P','PPLA2','TW.04','TW.04.PEN',56435,'Asia/Taipei',1,'2017-09-26 23:00:00','2017-09-26 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1672551,'TW','Lugu','Lugu',23.7464,120.753,'P','PPL','TW.04','TW.04.NAN',19599,'Asia/Taipei',1,'2017-09-23 23:00:00','2017-09-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1673820,'TW','Kaohsiung','Kaohsiung',22.6163,120.313,'P','PPLA','TW.02','TW.02.KHH',1519711,'Asia/Taipei',1,'2017-09-25 23:00:00','2017-09-25 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1674199,'TW','Yilan','Yilan',24.757,121.753,'P','PPLA2','TW.04','TW.04.ILA',94188,'Asia/Taipei',1,'2017-09-28 23:00:00','2017-09-28 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1674504,'TW','Hualien City','Hualien City',23.9769,121.604,'P','PPLA2','TW.04','TW.04.HUA',350468,'Asia/Taipei',1,'2017-09-25 23:00:00','2017-09-25 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1675151,'TW','Hsinchu','Hsinchu',24.8036,120.969,'P','PPLA2','TW.04','TW.04.HSQ',404109,'Asia/Taipei',1,'2017-09-25 23:00:00','2017-09-25 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1676242,'TW','Hengchun','Hengchun',22.0042,120.744,'P','PPLA3','TW.04','TW.04.PIF',31288,'Asia/Taipei',1,'2017-09-26 23:00:00','2017-09-26 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1678008,'TW','Jincheng','Jincheng',24.4342,118.317,'P','PPLA','TW.01','TW.01.KIN',37507,'Asia/Taipei',1,'2017-11-06 23:00:00','2017-11-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (1678228,'TW','Keelung','Keelung',25.1283,121.742,'P','PPLA2','TW.04','TW.04.KEE',397515,'Asia/Taipei',1,'2017-09-25 23:00:00','2017-09-25 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (6696918,'TW','Taoyuan City','Taoyuan City',24.9937,121.297,'P','PPLA2','TW.04','TW.04.TAO',402014,'Asia/Taipei',1,'2017-09-25 23:00:00','2017-09-25 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (6949678,'TW','Taitung City','Taitung City',22.7583,121.144,'P','PPLA2','TW.04','TW.04.TTT',109584,'Asia/Taipei',1,'2017-09-26 23:00:00','2017-09-26 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (7601921,'TW','Zhongxing New Village','Zhongxing New Village',23.9591,120.685,'P','PPLA','TW.04','TW.04.NAN',25549,'Asia/Taipei',1,'2017-09-23 23:00:00','2017-09-23 23:00:00');
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
