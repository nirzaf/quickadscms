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
INSERT INTO `<<prefix>>subadmin1` VALUES (3216,'SL.04','SL','Western Area','Western Area',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3217,'SL.03','SL','Southern Province','Southern Province',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3218,'SL.02','SL','Northern Province','Northern Province',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (3219,'SL.01','SL','Eastern Province','Eastern Province',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin2` VALUES (36052,'SL.02.2403287','SL','SL.02','Tonkolili District','Tonkolili District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36053,'SL.03.2404399','SL','SL.03','Pujehun District','Pujehun District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36054,'SL.02.2404431','SL','SL.02','Port Loko District','Port Loko District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36055,'SL.03.2405008','SL','SL.03','Moyamba District','Moyamba District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36056,'SL.01.2407469','SL','SL.01','Kono District','Kono District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36057,'SL.02.2407650','SL','SL.02','Koinadugu District','Koinadugu District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36058,'SL.01.2407781','SL','SL.01','Kenema District','Kenema District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36059,'SL.02.2408083','SL','SL.02','Kambia District','Kambia District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36060,'SL.01.2408249','SL','SL.01','Kailahun District','Kailahun District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36061,'SL.03.2409913','SL','SL.03','Bonthe District','Bonthe District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36062,'SL.02.2409983','SL','SL.02','Bombali District','Bombali District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36063,'SL.03.2410021','SL','SL.03','Bo District','Bo District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36064,'SL.04.9179949','SL','SL.04','Western Area Urban','Western Area Urban',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (36065,'SL.04.9179950','SL','SL.04','Western Area Rural','Western Area Rural',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (2402816,'SL','Yengema','Yengema',8.71441,-11.1706,'P','PPL','SL.01',NULL,11221,'Africa/Freetown',1,'2015-02-05 23:00:00','2015-02-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2403094,'SL','Waterloo','Waterloo',8.3389,-13.0709,'P','PPL','SL.04',NULL,19750,'Africa/Freetown',1,'2014-11-04 23:00:00','2014-11-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2403324,'SL','Tombodu','Tombodu',8.13526,-10.6196,'P','PPL','SL.01',NULL,5985,'Africa/Freetown',1,'2015-01-06 23:00:00','2015-01-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2403407,'SL','Tintafor','Tintafor',8.62667,-13.215,'P','PPL','SL.02',NULL,5460,'Africa/Freetown',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2403698,'SL','Sumbuya','Sumbuya',7.64789,-11.9606,'P','PPL','SL.03',NULL,7074,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2404041,'SL','Segbwema','Segbwema',7.99471,-10.9502,'P','PPL','SL.01',NULL,16532,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2404303,'SL','Rokupr','Rokupr',8.67121,-12.385,'P','PPL','SL.02',NULL,12504,'Africa/Freetown',1,'2015-03-07 23:00:00','2015-03-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2404433,'SL','Port Loko','Port Loko',8.76609,-12.787,'P','PPL','SL.02',NULL,21308,'Africa/Freetown',1,'2015-02-05 23:00:00','2015-02-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2404614,'SL','Pendembu','Pendembu',8.09807,-10.6943,'P','PPL','SL.01',NULL,8780,'Africa/Freetown',1,'2015-01-06 23:00:00','2015-01-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2404663,'SL','Panguma','Panguma',8.18507,-11.1329,'P','PPL','SL.01',NULL,7965,'Africa/Freetown',1,'2015-01-06 23:00:00','2015-01-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2405013,'SL','Moyamba','Moyamba',8.15898,-12.4317,'P','PPL','SL.03',NULL,6700,'Africa/Freetown',1,'2015-01-06 23:00:00','2015-01-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2405038,'SL','Motema','Motema',8.61427,-11.0125,'P','PPL','SL.01',NULL,5474,'Africa/Freetown',1,'2015-02-05 23:00:00','2015-02-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2405729,'SL','Masingbi','Masingbi',8.78197,-11.9517,'P','PPL','SL.02',NULL,5644,'Africa/Freetown',1,'2015-02-05 23:00:00','2015-02-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2406142,'SL','Mamboma','Mamboma',8.08742,-11.6884,'P','PPL','SL.03',NULL,5201,'Africa/Freetown',1,'2015-01-06 23:00:00','2015-01-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2406145,'SL','Mambolo','Mambolo',8.9186,-13.0367,'P','PPL','SL.02',NULL,6624,'Africa/Freetown',1,'2015-02-05 23:00:00','2015-02-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2406407,'SL','Makeni','Makeni',8.88605,-12.0442,'P','PPLA','SL.02',NULL,87679,'Africa/Freetown',1,'2015-03-07 23:00:00','2015-03-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2406576,'SL','Magburaka','Magburaka',8.72306,-11.9488,'P','PPL','SL.02',NULL,14915,'Africa/Freetown',1,'2015-02-05 23:00:00','2015-02-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2406916,'SL','Lunsar','Lunsar',8.68439,-12.535,'P','PPL','SL.02',NULL,22461,'Africa/Freetown',1,'2015-02-05 23:00:00','2015-02-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2407262,'SL','Kukuna','Kukuna',9.39841,-12.6648,'P','PPL','SL.02',NULL,7676,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2407656,'SL','Koidu','Koidu',8.64387,-10.9714,'P','PPL','SL.01',NULL,88000,'Africa/Freetown',1,'2015-02-05 23:00:00','2015-02-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2407790,'SL','Kenema','Kenema',7.87687,-11.1903,'P','PPLA','SL.01',NULL,143137,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2407899,'SL','Kassiri','Kassiri',8.93814,-13.1154,'P','PPL','SL.02',NULL,5161,'Africa/Freetown',1,'2015-02-05 23:00:00','2015-02-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2408088,'SL','Kambia','Kambia',9.12504,-12.9182,'P','PPL','SL.02',NULL,11520,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2408154,'SL','Kamakwie','Kamakwie',9.49689,-12.2406,'P','PPL','SL.02',NULL,8098,'Africa/Freetown',1,'2013-03-06 23:00:00','2013-03-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2408250,'SL','Kailahun','Kailahun',8.2789,-10.573,'P','PPL','SL.01',NULL,14085,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2408329,'SL','Kabala','Kabala',9.58893,-11.5526,'P','PPL','SL.02',NULL,17948,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2408582,'SL','Hastings','Hastings',8.37994,-13.1369,'P','PPL','SL.04',NULL,5121,'Africa/Freetown',1,'2014-11-04 23:00:00','2014-11-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2408585,'SL','Hangha','Hangha',7.93974,-11.1413,'P','PPL','SL.01',NULL,5007,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2408770,'SL','Freetown','Freetown',8.43194,-13.2897,'P','PPL','SL.04',NULL,13768,'Africa/Freetown',1,'2010-01-28 23:00:00','2010-01-28 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2409214,'SL','Gandorhun','Gandorhun',7.55502,-11.6926,'P','PPL','SL.03',NULL,12288,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2409215,'SL','Gandorhun','Gandorhun',7.49431,-11.8306,'P','PPL','SL.03',NULL,10678,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2409306,'SL','Freetown','Freetown',8.484,-13.2299,'P','PPLC','SL.04',NULL,802639,'Africa/Freetown',1,'2010-05-29 23:00:00','2010-05-29 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2409382,'SL','Foindu','Foindu',7.40906,-11.5433,'P','PPL','SL.03',NULL,5868,'Africa/Freetown',1,'2015-01-06 23:00:00','2015-01-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2409663,'SL','Daru','Daru',7.98976,-10.8422,'P','PPL','SL.01',NULL,5958,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2409751,'SL','Buedu','Buedu',8.2796,-10.3714,'P','PPL','SL.01',NULL,5412,'Africa/Freetown',1,'2015-01-06 23:00:00','2015-01-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2409783,'SL','Bunumbu','Bunumbu',8.17421,-10.8643,'P','PPL','SL.01',NULL,7355,'Africa/Freetown',1,'2015-01-06 23:00:00','2015-01-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2409823,'SL','Bumpe','Bumpe',7.89209,-11.9054,'P','PPL','SL.03',NULL,13580,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2409914,'SL','Bonthe','Bonthe',7.52639,-12.505,'P','PPL','SL.03',NULL,9647,'Africa/Freetown',1,'2014-08-18 23:00:00','2014-08-18 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2409970,'SL','Bomi','Bomi',7.24611,-11.5258,'P','PPL','SL.03',NULL,5463,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2410040,'SL','Boajibu','Boajibu',8.18763,-11.3403,'P','PPL','SL.01',NULL,7384,'Africa/Freetown',1,'2015-01-06 23:00:00','2015-01-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2410048,'SL','Bo','Bo',7.96472,-11.7383,'P','PPLA','SL.03',NULL,174354,'Africa/Freetown',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2410065,'SL','Blama','Blama',7.87481,-11.3455,'P','PPL','SL.01',NULL,8146,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2410090,'SL','Binkolo','Binkolo',8.95225,-11.9803,'P','PPL','SL.02',NULL,13867,'Africa/Freetown',1,'2015-02-05 23:00:00','2015-02-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2410312,'SL','Barma','Barma',8.34959,-11.3306,'P','PPL','SL.01',NULL,7529,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2410380,'SL','Baoma','Baoma',7.99344,-11.7147,'P','PPL','SL.03',NULL,7044,'Africa/Freetown',1,'2014-12-02 23:00:00','2014-12-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (2571039,'SL','Pujehun','Pujehun',7.35806,-11.7208,'P','PPL','SL.03',NULL,7926,'Africa/Freetown',1,'2012-01-18 23:00:00','2012-01-18 23:00:00');
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
