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
INSERT INTO `<<prefix>>subadmin1` VALUES (2809,'RS.VO','RS','Vojvodina','Vojvodina',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (2810,'RS.SE','RS','Central Serbia','Central Serbia',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin2` VALUES (33968,'RS.SE.14','RS','RS.SE','Bor','Bor',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33969,'RS.SE.11','RS','RS.SE','Branicevo','Branicevo',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33970,'RS.SE.23','RS','RS.SE','Jablanica','Jablanica',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33971,'RS.VO.6','RS','RS.VO','South Bačka','South Backa',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33972,'RS.VO.4','RS','RS.VO','South Banat','South Banat',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33973,'RS.SE.9','RS','RS.SE','Kolubara','Kolubara',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33974,'RS.SE.8','RS','RS.SE','Mačva','Macva',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33975,'RS.SE.17','RS','RS.SE','Morava','Morava',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33976,'RS.SE.20','RS','RS.SE','Nišava','Nisava',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33977,'RS.SE.24','RS','RS.SE','Pčinja','Pcinja',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33978,'RS.SE.22','RS','RS.SE','Pirot','Pirot',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33979,'RS.SE.10','RS','RS.SE','Podunavlje District','Podunavlje District',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33980,'RS.SE.13','RS','RS.SE','Pomoravlje','Pomoravlje',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33981,'RS.SE.19','RS','RS.SE','Rasina','Rasina',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33982,'RS.SE.18','RS','RS.SE','Raška','Raska',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33983,'RS.VO.1','RS','RS.VO','North Bačka','North Backa',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33984,'RS.VO.3','RS','RS.VO','North Banat','North Banat',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33985,'RS.VO.2','RS','RS.VO','Central Banat','Central Banat',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33986,'RS.VO.7','RS','RS.VO','Srem','Srem',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33987,'RS.SE.12','RS','RS.SE','Šumadija','Sumadija',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33988,'RS.SE.21','RS','RS.SE','Toplica','Toplica',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33989,'RS.SE.15','RS','RS.SE','Zaječar','Zajecar',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33990,'RS.VO.5','RS','RS.VO','West Bačka','West Backa',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33991,'RS.SE.16','RS','RS.SE','Zlatibor','Zlatibor',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (33992,'RS.SE.0','RS','RS.SE','Belgrade','Belgrade',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (783768,'RS','Zvečka','Zvecka',44.6403,20.1643,'P','PPL','RS.SE','RS.SE.0',5321,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (783814,'RS','Zrenjanin','Zrenjanin',45.3836,20.3819,'P','PPLA2','RS.VO','RS.VO.2',79773,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (783920,'RS','Zemun','Zemun',44.8431,20.4011,'P','PPLA3','RS.SE','RS.SE.0',155591,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (784024,'RS','Zaječar','Zajecar',43.9036,22.264,'P','PPLA2','RS.SE','RS.SE.15',49800,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (784068,'RS','Žabalj','Zabalj',45.3722,20.0639,'P','PPLA3','RS.VO','RS.VO.6',8503,'Europe/Belgrade',1,'2012-04-11 23:00:00','2012-04-11 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (784136,'RS','Vršac','Vrsac',45.1167,21.3036,'P','PPLA3','RS.VO','RS.VO.4',36300,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (784141,'RS','Vrnjačka Banja','Vrnjacka Banja',43.6273,20.8963,'P','PPLA3','RS.SE','RS.SE.18',10207,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (784227,'RS','Vranje','Vranje',42.5514,21.9003,'P','PPLA2','RS.SE','RS.SE.24',56199,'Europe/Belgrade',1,'2012-04-16 23:00:00','2012-04-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (784352,'RS','Vladimirovac','Vladimirovac',45.0312,20.8657,'P','PPL','RS.VO','RS.VO.4',5106,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (784764,'RS','Umka','Umka',44.6781,20.3047,'P','PPL','RS.SE','RS.SE.0',5618,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (784873,'RS','Trstenik','Trstenik',43.6169,21.0025,'P','PPLA3','RS.SE','RS.SE.19',49043,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (785062,'RS','Titel','Titel',45.2061,20.2944,'P','PPLA3','RS.VO','RS.VO.6',6227,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (785288,'RS','Surčin','Surcin',44.7931,20.2803,'P','PPLA3','RS.SE','RS.SE.0',12575,'Europe/Belgrade',1,'2012-04-13 23:00:00','2012-04-13 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (785559,'RS','Stara Pazova','Stara Pazova',44.985,20.1608,'P','PPLA3','RS.VO','RS.VO.7',16217,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (785603,'RS','Srpska Crnja','Srpska Crnja',45.7254,20.6901,'P','PPL','RS.VO','RS.VO.2',5467,'Europe/Belgrade',1,'2016-10-13 23:00:00','2016-10-13 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (785615,'RS','Sremčica','Sremcica',44.6765,20.3923,'P','PPL','RS.SE','RS.SE.0',23000,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (785753,'RS','Smederevska Palanka','Smederevska Palanka',44.3655,20.9589,'P','PPLA3','RS.SE','RS.SE.10',27000,'Europe/Belgrade',1,'2012-04-16 23:00:00','2012-04-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (785756,'RS','Smederevo','Smederevo',44.6628,20.93,'P','PPLA2','RS.SE','RS.SE.10',62000,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (785965,'RS','Senta','Senta',45.9275,20.0772,'P','PPLA3','RS.VO','RS.VO.3',20302,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (786690,'RS','Prokuplje','Prokuplje',43.2342,21.5881,'P','PPLA2','RS.SE','RS.SE.21',27673,'Europe/Belgrade',1,'2012-04-16 23:00:00','2012-04-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (786827,'RS','Požarevac','Pozarevac',44.6213,21.1878,'P','PPLA2','RS.SE','RS.SE.11',41736,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787050,'RS','Pirot','Pirot',43.1531,22.5861,'P','PPLA2','RS.SE','RS.SE.22',40678,'Europe/Belgrade',1,'2012-04-16 23:00:00','2012-04-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787215,'RS','Paraćin','Paracin',43.8608,21.4078,'P','PPLA3','RS.SE','RS.SE.13',6000,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787237,'RS','Pančevo','Pancevo',44.8708,20.6403,'P','PPLA2','RS.VO','RS.VO.4',76654,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787271,'RS','Padina','Padina',45.1199,20.7286,'P','PPL','RS.VO','RS.VO.4',6367,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787516,'RS','Obrenovac','Obrenovac',44.6549,20.2002,'P','PPLA3','RS.SE','RS.SE.0',16821,'Europe/Belgrade',1,'2012-04-13 23:00:00','2012-04-13 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787584,'RS','Novo Miloševo','Novo Milosevo',45.7192,20.3036,'P','PPL','RS.VO','RS.VO.2',7805,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787595,'RS','Novi Pazar','Novi Pazar',43.1367,20.5122,'P','PPLA3','RS.SE','RS.SE.18',85996,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787600,'RS','Novi Kneževac','Novi Knezevac',46.05,20.1,'P','PPLA3','RS.VO','RS.VO.3',8166,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787615,'RS','Nova Pazova','Nova Pazova',44.9437,20.2193,'P','PPL','RS.VO','RS.VO.7',15488,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787657,'RS','Niš','Nis',43.3247,21.9033,'P','PPLA2','RS.SE','RS.SE.20',250000,'Europe/Belgrade',1,'2016-12-04 23:00:00','2016-12-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787718,'RS','Negotin','Negotin',44.2264,22.5308,'P','PPLA3','RS.SE','RS.SE.14',17612,'Europe/Belgrade',1,'2012-04-15 23:00:00','2012-04-15 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787855,'RS','Mol','Mol',45.7646,20.1329,'P','PPL','RS.VO','RS.VO.3',7950,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (787857,'RS','Mokrin','Mokrin',45.9336,20.4121,'P','PPL','RS.VO','RS.VO.3',6567,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (788040,'RS','Melenci','Melenci',45.5168,20.3196,'P','PPL','RS.VO','RS.VO.2',7685,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (788357,'RS','Majdanpek','Majdanpek',44.4277,21.946,'P','PPLA3','RS.SE','RS.SE.14',10071,'Europe/Belgrade',1,'2012-04-15 23:00:00','2012-04-15 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (788709,'RS','Leskovac','Leskovac',42.9981,21.9461,'P','PPLA2','RS.SE','RS.SE.23',94758,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (788771,'RS','Lazarevac','Lazarevac',44.3853,20.2557,'P','PPLA3','RS.SE','RS.SE.0',23551,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (788792,'RS','Lapovo','Lapovo',44.1842,21.0973,'P','PPLA3','RS.SE','RS.SE.12',7422,'Europe/Belgrade',1,'2012-04-15 23:00:00','2012-04-15 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (788975,'RS','Kruševac','Krusevac',43.58,21.3339,'P','PPLA2','RS.SE','RS.SE.19',75256,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (789107,'RS','Kraljevo','Kraljevo',43.7258,20.6894,'P','PPLA2','RS.SE','RS.SE.18',82846,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (789128,'RS','Kragujevac','Kragujevac',44.0167,20.9167,'P','PPLA2','RS.SE','RS.SE.12',147473,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (789168,'RS','Kovin','Kovin',44.7475,20.9761,'P','PPLA3','RS.VO','RS.VO.4',14250,'Europe/Belgrade',1,'2012-04-11 23:00:00','2012-04-11 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (789170,'RS','Kovilj','Kovilj',45.2342,20.0233,'P','PPL','RS.VO','RS.VO.6',5279,'Europe/Belgrade',1,'2012-08-20 23:00:00','2012-08-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (789178,'RS','Kovačica','Kovacica',45.1117,20.6214,'P','PPLA3','RS.VO','RS.VO.4',7357,'Europe/Belgrade',1,'2012-04-11 23:00:00','2012-04-11 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (789518,'RS','Kikinda','Kikinda',45.8297,20.4653,'P','PPLA2','RS.VO','RS.VO.3',41935,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (789600,'RS','Kanjiža','Kanjiza',46.0667,20.05,'P','PPLA3','RS.VO','RS.VO.3',10200,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (789923,'RS','Jagodina','Jagodina',43.9771,21.2612,'P','PPLA2','RS.SE','RS.SE.13',35589,'Europe/Belgrade',1,'2013-10-20 23:00:00','2013-10-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (790015,'RS','Inđija','Ingija',45.0482,20.0816,'P','PPL','RS.VO','RS.VO.7',26247,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (790367,'RS','Gornji Milanovac','Gornji Milanovac',44.026,20.4615,'P','PPLA3','RS.SE','RS.SE.17',23982,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (790847,'RS','Ečka','Ecka',45.3233,20.4429,'P','PPL','RS.VO','RS.VO.2',5293,'Europe/Belgrade',1,'2016-10-20 23:00:00','2016-10-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (791471,'RS','Dobanovci','Dobanovci',44.8263,20.2249,'P','PPL','RS.SE','RS.SE.0',7592,'Europe/Belgrade',1,'2016-10-20 23:00:00','2016-10-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (791589,'RS','Debeljača','Debeljaca',45.0707,20.6015,'P','PPL','RS.VO','RS.VO.4',6413,'Europe/Belgrade',1,'2016-10-20 23:00:00','2016-10-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (791672,'RS','Čurug','Curug',45.4722,20.0686,'P','PPL','RS.VO','RS.VO.6',9231,'Europe/Belgrade',1,'2016-10-20 23:00:00','2016-10-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (791678,'RS','Ćuprija','Cuprija',43.9275,21.37,'P','PPLA3','RS.SE','RS.SE.13',20585,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (791887,'RS','Crepaja','Crepaja',45.0098,20.637,'P','PPL','RS.VO','RS.VO.4',5369,'Europe/Belgrade',1,'2016-10-20 23:00:00','2016-10-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (791900,'RS','Čoka','Coka',45.9425,20.1433,'P','PPLA3','RS.VO','RS.VO.3',5414,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (792078,'RS','Čačak','Cacak',43.8914,20.3497,'P','PPLA2','RS.SE','RS.SE.17',117072,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (792456,'RS','Bor','Bor',44.0749,22.0959,'P','PPLA2','RS.SE','RS.SE.14',39387,'Europe/Belgrade',1,'2012-04-15 23:00:00','2012-04-15 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (792651,'RS','Beška','Beska',45.1309,20.067,'P','PPL','RS.VO','RS.VO.7',6377,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (792680,'RS','Belgrade','Belgrade',44.804,20.4651,'P','PPLC','RS.SE','RS.SE.0',1273651,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (792794,'RS','Bela Crkva','Bela Crkva',44.8975,21.4172,'P','PPLA3','RS.VO','RS.VO.4',10675,'Europe/Belgrade',1,'2012-04-11 23:00:00','2012-04-11 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (792814,'RS','Bečej','Becej',45.6163,20.0333,'P','PPLA3','RS.VO','RS.VO.6',25774,'Europe/Belgrade',1,'2012-04-11 23:00:00','2012-04-11 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (792866,'RS','Barič','Baric',44.6507,20.2594,'P','PPL','RS.SE','RS.SE.0',5033,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (792945,'RS','Banatski Karlovac','Banatski Karlovac',45.0499,21.018,'P','PPL','RS.VO','RS.VO.4',6319,'Europe/Belgrade',1,'2016-10-20 23:00:00','2016-10-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (793014,'RS','Bačko Petrovo Selo','Backo Petrovo Selo',45.7068,20.0793,'P','PPL','RS.VO','RS.VO.6',8959,'Europe/Belgrade',1,'2016-10-20 23:00:00','2016-10-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (793015,'RS','Bačko Gradište','Backo Gradiste',45.5327,20.0308,'P','PPL','RS.VO','RS.VO.6',5764,'Europe/Belgrade',1,'2016-10-20 23:00:00','2016-10-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (793093,'RS','Arilje','Arilje',43.7531,20.0956,'P','PPLA3','RS.SE','RS.SE.16',6762,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (793111,'RS','Aranđelovac','Arangelovac',44.3069,20.56,'P','PPLA3','RS.SE','RS.SE.12',24309,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3187297,'RS','Vrbas','Vrbas',45.5714,19.6408,'P','PPLA3','RS.VO','RS.VO.6',25907,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3187829,'RS','Veternik','Veternik',45.2545,19.7588,'P','PPL','RS.VO','RS.VO.6',10226,'Europe/Belgrade',1,'2016-10-23 23:00:00','2016-10-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3188402,'RS','Valjevo','Valjevo',44.2751,19.8982,'P','PPLA2','RS.SE','RS.SE.9',61035,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3188434,'RS','Užice','Uzice',43.8586,19.8488,'P','PPLA2','RS.SE','RS.SE.16',63577,'Europe/Belgrade',1,'2017-01-18 23:00:00','2017-01-18 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3189595,'RS','Subotica','Subotica',46.1,19.6667,'P','PPLA2','RS.VO','RS.VO.1',100000,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3190042,'RS','Stanišić','Stanisic',45.9389,19.1671,'P','PPL','RS.VO','RS.VO.5',5476,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3190101,'RS','Sremski Karlovci','Sremski Karlovci',45.2025,19.9344,'P','PPLA3','RS.VO','RS.VO.6',8839,'Europe/Belgrade',1,'2012-04-11 23:00:00','2012-04-11 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3190103,'RS','Sremska Mitrovica','Sremska Mitrovica',44.9764,19.6122,'P','PPLA2','RS.VO','RS.VO.7',39084,'Europe/Belgrade',1,'2014-10-19 23:00:00','2014-10-19 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3190335,'RS','Sonta','Sonta',45.5943,19.0972,'P','PPL','RS.VO','RS.VO.5',5991,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3190342,'RS','Sombor','Sombor',45.7742,19.1122,'P','PPLA2','RS.VO','RS.VO.5',48454,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3191376,'RS','Šabac','Sabac',44.7467,19.69,'P','PPLA2','RS.SE','RS.SE.8',55114,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3191429,'RS','Ruma','Ruma',45.0081,19.8222,'P','PPLA3','RS.VO','RS.VO.7',32229,'Europe/Belgrade',1,'2014-10-19 23:00:00','2014-10-19 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3192420,'RS','Prigrevica','Prigrevica',45.6764,19.0881,'P','PPL','RS.VO','RS.VO.5',5026,'Europe/Belgrade',1,'2016-10-23 23:00:00','2016-10-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3193406,'RS','Petrovaradin','Petrovaradin',45.2467,19.8794,'P','PPLA3','RS.VO','RS.VO.6',13917,'Europe/Belgrade',1,'2015-11-12 23:00:00','2015-11-12 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3194360,'RS','Novi Sad','Novi Sad',45.2517,19.8369,'P','PPLA','RS.VO','RS.VO.6',215400,'Europe/Belgrade',1,'2016-05-17 23:00:00','2016-05-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3202798,'RS','Čelarevo','Celarevo',45.27,19.5248,'P','PPL','RS.VO','RS.VO.6',5017,'Europe/Belgrade',1,'2016-10-23 23:00:00','2016-10-23 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3203840,'RS','Bogatić','Bogatic',44.8375,19.4806,'P','PPLA3','RS.SE','RS.SE.8',7225,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3204623,'RS','Bajina Bašta','Bajina Basta',43.9708,19.5675,'P','PPLA3','RS.SE','RS.SE.16',8533,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3204635,'RS','Badovinci','Badovinci',44.7853,19.3715,'P','PPL','RS.SE','RS.SE.8',5879,'Europe/Belgrade',1,'2017-11-16 23:00:00','2017-11-16 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3204665,'RS','Bački Petrovac','Backi Petrovac',45.3606,19.5917,'P','PPLA3','RS.VO','RS.VO.6',7229,'Europe/Belgrade',1,'2012-04-11 23:00:00','2012-04-11 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3204672,'RS','Bačka Topola','Backa Topola',45.8152,19.6318,'P','PPLA3','RS.VO','RS.VO.1',16154,'Europe/Belgrade',1,'2012-04-14 23:00:00','2012-04-14 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3204674,'RS','Bačka Palanka','Backa Palanka',45.2508,19.3919,'P','PPLA3','RS.VO','RS.VO.6',29449,'Europe/Belgrade',1,'2012-04-11 23:00:00','2012-04-11 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (3204793,'RS','Apatin','Apatin',45.6711,18.9847,'P','PPLA3','RS.VO','RS.VO.5',18320,'Europe/Belgrade',1,'2012-04-11 23:00:00','2012-04-11 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (6619277,'RS','Knjazevac','Knjazevac',43.5663,22.257,'P','PPLA3','RS.SE','RS.SE.15',25000,'Europe/Belgrade',1,'2012-04-15 23:00:00','2012-04-15 23:00:00');
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
