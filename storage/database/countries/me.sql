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
INSERT INTO `<<prefix>>subadmin1` VALUES (1964,'ME.17','ME','Opština Rožaje','Opstina Rozaje',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1965,'ME.21','ME','Opština Žabljak','Opstina Zabljak',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1966,'ME.20','ME','Ulcinj','Ulcinj',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1967,'ME.19','ME','Tivat','Tivat',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1968,'ME.16','ME','Podgorica','Podgorica',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1969,'ME.18','ME','Opština Šavnik','Opstina Savnik',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1970,'ME.15','ME','Opština Plužine','Opstina Pluzine',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1971,'ME.14','ME','Pljevlja','Pljevlja',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1972,'ME.13','ME','Opština Plav','Opstina Plav',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1973,'ME.12','ME','Opština Nikšić','Opstina Niksic',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1974,'ME.11','ME','Mojkovac','Mojkovac',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1975,'ME.10','ME','Kotor','Kotor',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1976,'ME.09','ME','Opština Kolašin','Opstina Kolasin',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1977,'ME.03','ME','Berane','Berane',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1978,'ME.08','ME','Herceg Novi','Herceg Novi',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1979,'ME.07','ME','Danilovgrad','Danilovgrad',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1980,'ME.06','ME','Cetinje','Cetinje',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1981,'ME.05','ME','Budva','Budva',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1982,'ME.04','ME','Bijelo Polje','Bijelo Polje',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1983,'ME.02','ME','Bar','Bar',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1984,'ME.01','ME','Andrijevica','Andrijevica',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1985,'ME.22','ME','Gusinje','Gusinje',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1986,'ME.23','ME','Petnjica','Petnjica',1);
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
INSERT INTO `<<prefix>>cities` VALUES (786234,'ME','Rožaje','Rozaje',42.833,20.1665,'P','PPLA','ME.17',NULL,9121,'Europe/Podgorica',1,'2013-06-27 23:00:00','2013-06-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3186999,'ME','Žabljak','Zabljak',43.1542,19.1232,'P','PPLA','ME.21',NULL,1937,'Europe/Podgorica',1,'2013-06-27 23:00:00','2013-06-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3188516,'ME','Ulcinj','Ulcinj',41.9294,19.2244,'P','PPLA','ME.20',NULL,10828,'Europe/Podgorica',1,'2013-06-27 23:00:00','2013-06-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3189073,'ME','Tivat','Tivat',42.4364,18.6961,'P','PPLA','ME.19',NULL,6280,'Europe/Podgorica',1,'2014-08-18 23:00:00','2014-08-18 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3191222,'ME','Šavnik','Savnik',42.9564,19.0967,'P','PPLA','ME.18',NULL,633,'Europe/Podgorica',1,'2013-07-05 23:00:00','2013-07-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3193044,'ME','Podgorica','Podgorica',42.4411,19.2636,'P','PPLC','ME.16',NULL,136473,'Europe/Podgorica',1,'2016-05-07 23:00:00','2016-05-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3193131,'ME','Plužine','Pluzine',43.1528,18.8394,'P','PPLA','ME.15',NULL,1494,'Europe/Podgorica',1,'2013-07-05 23:00:00','2013-07-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3193161,'ME','Pljevlja','Pljevlja',43.3567,19.3584,'P','PPLA','ME.14',NULL,19489,'Europe/Podgorica',1,'2013-06-27 23:00:00','2013-06-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3193228,'ME','Plav','Plav',42.5969,19.9456,'P','PPLA','ME.13',NULL,3615,'Europe/Podgorica',1,'2013-07-05 23:00:00','2013-07-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3194494,'ME','Nikšić','Niksic',42.7731,18.9445,'P','PPLA','ME.12',NULL,58212,'Europe/Podgorica',1,'2013-06-27 23:00:00','2013-06-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3194926,'ME','Mojkovac','Mojkovac',42.9604,19.5833,'P','PPLA','ME.11',NULL,4120,'Europe/Podgorica',1,'2013-06-27 23:00:00','2013-06-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3197538,'ME','Kotor','Kotor',42.4207,18.7682,'P','PPLA','ME.10',NULL,5345,'Europe/Podgorica',1,'2013-06-27 23:00:00','2013-06-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3197896,'ME','Kolašin','Kolasin',42.8223,19.5165,'P','PPLA','ME.09',NULL,2989,'Europe/Podgorica',1,'2013-06-27 23:00:00','2013-06-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3199071,'ME','Berane','Berane',42.8425,19.8733,'P','PPLA','ME.03',NULL,11073,'Europe/Podgorica',1,'2013-07-05 23:00:00','2013-07-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3199394,'ME','Herceg-Novi','Herceg-Novi',42.4531,18.5375,'P','PPLA','ME.08',NULL,19536,'Europe/Podgorica',1,'2013-07-05 23:00:00','2013-07-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3201903,'ME','Dobrota','Dobrota',42.4542,18.7683,'P','PPLL','ME.00',NULL,5435,'Europe/Podgorica',1,'2012-01-18 23:00:00','2012-01-18 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3202194,'ME','Danilovgrad','Danilovgrad',42.5538,19.1461,'P','PPLA','ME.07',NULL,5208,'Europe/Podgorica',1,'2013-07-02 23:00:00','2013-07-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3202641,'ME','Cetinje','Cetinje',42.3906,18.9142,'P','PPLA','ME.06',NULL,15137,'Europe/Podgorica',1,'2014-05-10 23:00:00','2014-05-10 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3203106,'ME','Budva','Budva',42.2864,18.84,'P','PPLA','ME.05',NULL,18000,'Europe/Podgorica',1,'2013-07-05 23:00:00','2013-07-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3204176,'ME','Bijelo Polje','Bijelo Polje',43.0383,19.7476,'P','PPLA','ME.04',NULL,15400,'Europe/Podgorica',1,'2013-06-27 23:00:00','2013-06-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3204509,'ME','Bar','Bar',42.0931,19.1003,'P','PPLA','ME.02',NULL,17727,'Europe/Podgorica',1,'2013-07-05 23:00:00','2013-07-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3204816,'ME','Andrijevica','Andrijevica',42.7339,19.7919,'P','PPLA','ME.01',NULL,1073,'Europe/Podgorica',1,'2013-07-05 23:00:00','2013-07-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3220594,'ME','Petnjica','Petnjica',42.9089,19.9644,'P','PPLA','ME.23',NULL,0,'Europe/Podgorica',1,'2017-04-08 23:00:00','2017-04-08 23:00:00');
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
