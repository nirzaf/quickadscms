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
INSERT INTO `<<prefix>>subadmin1` VALUES (2702,'PS.GZ','PS','Gaza Strip','Gaza Strip',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (2703,'PS.WE','PS','West Bank','West Bank',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin2` VALUES (30460,'PS.WE.7828733','PS','PS.WE','Jenin','Jenin',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30461,'PS.GZ.7870260','PS','PS.GZ','Rafah','Rafah',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30462,'PS.GZ.7870263','PS','PS.GZ','North Gaza','North Gaza',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30463,'PS.GZ.7870268','PS','PS.GZ','Deir Al Balah','Deir Al Balah',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30464,'PS.WE.7870463','PS','PS.WE','Bethlehem','Bethlehem',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30465,'PS.WE.7870555','PS','PS.WE','Nablus','Nablus',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30466,'PS.WE.7870644','PS','PS.WE','Tulkarm','Tulkarm',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30467,'PS.WE.7870648','PS','PS.WE','Tubas','Tubas',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30468,'PS.WE.7870649','PS','PS.WE','Qalqilya','Qalqilya',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30469,'PS.WE.7870652','PS','PS.WE','Salfit','Salfit',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30470,'PS.WE.7870653','PS','PS.WE','Jericho','Jericho',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30471,'PS.WE.7870654','PS','PS.WE','Al Quds','Al Quds',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30472,'PS.WE.7870657','PS','PS.WE','Ramallah','Ramallah',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30473,'PS.WE.7870658','PS','PS.WE','Al Khalil','Al Khalil',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30474,'PS.GZ.7871092','PS','PS.GZ','Khan Yunis Governorate','Khan Yunis Governorate',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (30475,'PS.GZ.11184609','PS','PS.GZ','Gaza','Gaza',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (281093,'PS','Shūkat aş Şūfī','Shukat as Sufi',31.26,34.2826,'P','PPL','PS.GZ',NULL,10566,'Asia/Gaza',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281102,'PS','Rafaḩ','Rafah',31.2972,34.2436,'P','PPL','PS.GZ',NULL,126305,'Asia/Gaza',1,'2017-11-09 23:00:00','2017-11-09 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281109,'PS','An Nuşayrāt','An Nusayrat',31.4486,34.3925,'P','PPL','PS.GZ',NULL,36123,'Asia/Gaza',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281119,'PS','Khuzā‘ah','Khuza`ah',31.3067,34.3611,'P','PPL','PS.GZ',NULL,9023,'Asia/Gaza',1,'2012-02-01 23:00:00','2012-02-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281124,'PS','Khān Yūnis','Khan Yunis',31.3402,34.3063,'P','PPL','PS.GZ',NULL,173183,'Asia/Gaza',1,'2011-05-07 23:00:00','2011-05-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281129,'PS','Jabālyā','Jabalya',31.5272,34.4835,'P','PPL','PS.GZ','PS.GZ.7870263',168568,'Asia/Gaza',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281133,'PS','Gaza','Gaza',31.5016,34.4667,'P','PPLA','PS.GZ',NULL,410000,'Asia/Gaza',1,'2017-11-09 23:00:00','2017-11-09 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281141,'PS','Dayr al Balaḩ','Dayr al Balah',31.4178,34.3503,'P','PPLA2','PS.GZ','PS.GZ.7870268',59504,'Asia/Gaza',1,'2017-09-06 23:00:00','2017-09-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281145,'PS','Bayt Lāhyā','Bayt Lahya',31.5464,34.4951,'P','PPL','PS.GZ','PS.GZ.7870263',56919,'Asia/Gaza',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281146,'PS','Bayt Ḩānūn','Bayt Hanun',31.5353,34.5358,'P','PPL','PS.GZ','PS.GZ.7870263',37392,'Asia/Gaza',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281148,'PS','Banī Suhaylā','Bani Suhayla',31.3434,34.3234,'P','PPL','PS.GZ','PS.GZ.7871092',31272,'Asia/Gaza',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281160,'PS','Al Fukhkhārī','Al Fukhkhari',31.2928,34.3306,'P','PPL','PS.GZ',NULL,5464,'Asia/Gaza',1,'2012-02-01 23:00:00','2012-02-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281161,'PS','Al Burayj','Al Burayj',31.4394,34.4031,'P','PPL','PS.GZ',NULL,34951,'Asia/Gaza',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281165,'PS','‘Abasān al Kabīrah','`Abasan al Kabirah',31.3191,34.34,'P','PPL','PS.GZ',NULL,18163,'Asia/Gaza',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281240,'PS','Za‘tarah','Za`tarah',31.6736,35.2566,'P','PPL','PS.WE',NULL,6210,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281292,'PS','Yuta','Yuta',31.4459,35.0944,'P','PPL','PS.WE',NULL,41425,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281318,'PS','Ya‘bad','Ya`bad',32.4457,35.1682,'P','PPL','PS.WE',NULL,13477,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281577,'PS','Ţūlkarm','Tulkarm',32.3104,35.0286,'P','PPL','PS.WE','PS.WE.7870644',44169,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281581,'PS','Ţūbās','Tubas',32.3209,35.3699,'P','PPL','PS.WE','PS.WE.7870648',15591,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281637,'PS','Tarqūmyā','Tarqumya',31.5755,35.0122,'P','PPL','PS.WE',NULL,14202,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281657,'PS','Ţammūn','Tammun',32.2835,35.3837,'P','PPL','PS.WE','PS.WE.7870648',10119,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281690,'PS','Taffūḩ','Taffuh',31.5385,35.0497,'P','PPL','PS.WE',NULL,9480,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281715,'PS','Şūrīf','Surif',31.6508,35.0644,'P','PPL','PS.WE',NULL,12992,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281778,'PS','Sinjil','Sinjil',32.0333,35.2654,'P','PPL','PS.WE',NULL,5371,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281789,'PS','Silwād','Silwad',31.9762,35.2613,'P','PPL','PS.WE',NULL,7006,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281790,'PS','Sīlat az̧ Z̧ahr','Silat az Zahr',32.3193,35.1842,'P','PPL','PS.WE',NULL,6079,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281791,'PS','Sīlat al Ḩārithīyah','Silat al Harithiyah',32.5085,35.2275,'P','PPL','PS.WE',NULL,9557,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (281793,'PS','Sa‘īr','Sa`ir',31.5786,35.1402,'P','PPL','PS.WE',NULL,17775,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (282039,'PS','Salfīt','Salfit',32.0837,35.1808,'P','PPL','PS.WE','PS.WE.7870652',9452,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (282239,'PS','Ramallah','Ramallah',31.8996,35.2042,'P','PPL','PS.WE','PS.WE.7870657',24599,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (282376,'PS','Qaţanah','Qatanah',31.8337,35.1189,'P','PPL','PS.WE',NULL,7274,'Asia/Hebron',1,'2013-05-07 23:00:00','2013-05-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (282457,'PS','Qalqīlyah','Qalqilyah',32.1897,34.9706,'P','PPL','PS.WE','PS.WE.7870649',43212,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (282463,'PS','Qaffīn','Qaffin',32.4327,35.0827,'P','PPL','PS.WE','PS.WE.7870644',8489,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (282476,'PS','Qabāţīyah','Qabatiyah',32.4104,35.2809,'P','PPL','PS.WE',NULL,19127,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (282477,'PS','Qabalān','Qabalan',32.1018,35.2894,'P','PPL','PS.WE','PS.WE.7870555',7043,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (282593,'PS','Naḩḩālīn','Nahhalin',31.6856,35.1208,'P','PPL','PS.WE',NULL,6215,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (282615,'PS','Nablus','Nablus',32.2211,35.2544,'P','PPL','PS.WE',NULL,130326,'Asia/Hebron',1,'2010-01-28 23:00:00','2010-01-28 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (282783,'PS','Banī Zayd ash Shārqīyah','Bani Zayd ash Sharqiyah',32.0494,35.1659,'P','PPL','PS.WE',NULL,5015,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (282793,'PS','Maythalūn','Maythalun',32.348,35.2745,'P','PPL','PS.WE',NULL,6804,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283129,'PS','Bayt ‘Awwā','Bayt `Awwa',31.5091,34.9494,'P','PPL','PS.WE',NULL,7943,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283133,'PS','Jannātah','Jannatah',31.6696,35.2196,'P','PPL','PS.WE',NULL,5348,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283157,'PS','Kharbathā al Mişbāḩ','Kharbatha al Misbah',31.8855,35.0718,'P','PPL','PS.WE','PS.WE.7870657',5141,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283246,'PS','Khārās','Kharas',31.6148,35.0417,'P','PPL','PS.WE',NULL,6885,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283361,'PS','Kafr Rā‘ī','Kafr Ra`i',32.374,35.1545,'P','PPL','PS.WE',NULL,7276,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283506,'PS','Janīn','Janin',32.4594,35.3009,'P','PPL','PS.WE','PS.WE.7828733',34730,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283521,'PS','Jammā‘īn','Jamma`in',32.1316,35.204,'P','PPL','PS.WE',NULL,6158,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283570,'PS','Jaba‘','Jaba`',32.3241,35.2213,'P','PPL','PS.WE',NULL,8391,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283612,'PS','‘Illār','`Illar',32.3702,35.1071,'P','PPL','PS.WE','PS.WE.7870644',6681,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283621,'PS','Idhnā','Idhna',31.5587,34.9744,'P','PPL','PS.WE',NULL,18727,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283636,'PS','Ḩuwwārah','Huwwarah',32.1522,35.2567,'P','PPL','PS.WE',NULL,5633,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283643,'PS','Ḩūsān','Husan',31.7093,35.1348,'P','PPL','PS.WE','PS.WE.7870463',5535,'Asia/Hebron',1,'2017-09-05 23:00:00','2017-09-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283676,'PS','Ḩizmā','Hizma',31.8334,35.2631,'P','PPL','PS.WE',NULL,5916,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283806,'PS','Ḩalḩūl','Halhul',31.5803,35.1018,'P','PPL','PS.WE',NULL,21076,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (283843,'PS','Ḩablah','Hablah',32.1652,34.9775,'P','PPL','PS.WE','PS.WE.7870649',5945,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284011,'PS','Dūrā','Dura',31.5078,35.0293,'P','PPL','PS.WE','PS.WE.7870658',20835,'Asia/Hebron',1,'2017-09-05 23:00:00','2017-09-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284046,'PS','Dhannābah','Dhannabah',32.3134,35.0414,'P','PPL','PS.WE','PS.WE.7870644',8193,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284078,'PS','Dayr Dibwān','Dayr Dibwan',31.9111,35.2666,'P','PPL','PS.WE','PS.WE.7870657',6692,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284100,'PS','Dayr al Ghuşūn','Dayr al Ghusun',32.3524,35.0769,'P','PPL','PS.WE','PS.WE.7870644',9187,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284105,'PS','Dayr Abū Ḑa‘īf','Dayr Abu Da`if',32.456,35.3616,'P','PPL','PS.WE',NULL,5506,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284194,'PS','Birqīn','Birqin',32.4546,35.2608,'P','PPL','PS.WE',NULL,5730,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284237,'PS','Bīr Zayt','Bir Zayt',31.9696,35.1941,'P','PPL','PS.WE',NULL,6398,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284270,'PS','Biddū','Biddu',31.8348,35.1495,'P','PPL','PS.WE',NULL,6180,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284271,'PS','Bidyā','Bidya',32.1146,35.0803,'P','PPL','PS.WE','PS.WE.7870652',8065,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284294,'PS','Baytūnyā','Baytunya',31.8966,35.1705,'P','PPL','PS.WE','PS.WE.7870657',12822,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284304,'PS','Bayt Sāḩūr','Bayt Sahur',31.701,35.2263,'P','PPL','PS.WE','PS.WE.7870463',14921,'Asia/Hebron',1,'2017-09-05 23:00:00','2017-09-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284312,'PS','Bayt Liqyā','Bayt Liqya',31.8696,35.0654,'P','PPL','PS.WE','PS.WE.7870657',7795,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284313,'PS','Bayt Līd','Bayt Lid',32.2609,35.1317,'P','PPL','PS.WE','PS.WE.7870644',5740,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284315,'PS','Bethlehem','Bethlehem',31.7049,35.2038,'P','PPL','PS.WE','PS.WE.7870463',29019,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284320,'PS','Bayt Kāḩil','Bayt Kahil',31.5701,35.065,'P','PPL','PS.WE',NULL,5663,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284324,'PS','Bayt Jālā','Bayt Jala',31.7155,35.1879,'P','PPL','PS.WE','PS.WE.7870463',16183,'Asia/Hebron',1,'2017-09-05 23:00:00','2017-09-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284329,'PS','Bayt Ūmmar','Bayt Ummar',31.6233,35.1045,'P','PPL','PS.WE',NULL,12238,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284339,'PS','Bayt Fūrīk','Bayt Furik',32.1769,35.3354,'P','PPL','PS.WE','PS.WE.7870555',10108,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284341,'PS','Bayt Fajjār','Bayt Fajjar',31.6244,35.1546,'P','PPL','PS.WE','PS.WE.7870463',10579,'Asia/Hebron',1,'2017-09-05 23:00:00','2017-09-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284347,'PS','Bayt Ūlā','Bayt Ula',31.5962,35.0296,'P','PPL','PS.WE',NULL,9159,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284362,'PS','Baytā al Fawqā','Bayta al Fawqa',32.1426,35.2877,'P','PPL','PS.WE',NULL,8535,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284431,'PS','Banī Na‘īm','Bani Na`im',31.5159,35.1642,'P','PPL','PS.WE',NULL,19783,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284446,'PS','Balāţah','Balatah',32.2121,35.2856,'P','PPL','PS.WE','PS.WE.7870555',17146,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284461,'PS','Bal‘ā','Bal`a',32.3339,35.1116,'P','PPL','PS.WE','PS.WE.7870644',6545,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284480,'PS','‘Azzūn','`Azzun',32.175,35.0575,'P','PPL','PS.WE','PS.WE.7870649',7727,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284486,'PS','Az̧ Z̧āhirīyah','Az Zahiriyah',31.4097,34.9733,'P','PPL','PS.WE',NULL,27616,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284547,'PS','‘Awartā','`Awarta',32.1611,35.2839,'P','PPL','PS.WE','PS.WE.7870555',5563,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284557,'PS','‘Attīl','`Attil',32.3694,35.0719,'P','PPL','PS.WE','PS.WE.7870644',10100,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284572,'PS','Kalandia','Kalandia',31.8667,35.2167,'P','PPL','PS.WE',NULL,25595,'Asia/Hebron',1,'2017-12-13 23:00:00','2017-12-13 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284583,'PS','As Samū‘','As Samu`',31.3967,35.0661,'P','PPL','PS.WE',NULL,19355,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284593,'PS','‘Aşīrah ash Shamālīyah','`Asirah ash Shamaliyah',32.2512,35.2672,'P','PPL','PS.WE',NULL,7475,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284597,'PS','Ash Shuyūkh','Ash Shuyukh',31.57,35.1561,'P','PPL','PS.WE',NULL,8151,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284890,'PS','Ar Rām wa Ḑāḩiyat al Barīd','Ar Ram wa Dahiyat al Barid',31.8494,35.2342,'P','PPL','PS.WE',NULL,24838,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284893,'PS','‘Arrābah','`Arrabah',32.4052,35.2019,'P','PPL','PS.WE',NULL,9703,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284899,'PS','Jericho','Jericho',31.8667,35.45,'P','PPLA','PS.WE',NULL,19783,'Asia/Hebron',1,'2007-07-15 23:00:00','2007-07-15 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284922,'PS','‘Aqrabā','`Aqraba',32.125,35.3455,'P','PPL','PS.WE','PS.WE.7870555',7707,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284973,'PS','‘Anātā','`Anata',31.8092,35.259,'P','PPL','PS.WE',NULL,11946,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284976,'PS','‘Anabtā','`Anabta',32.3079,35.1169,'P','PPL','PS.WE','PS.WE.7870644',7106,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (284999,'PS','Al Yāmūn','Al Yamun',32.4856,35.2301,'P','PPL','PS.WE',NULL,16164,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285034,'PS','Az Zaytūnīyah','Az Zaytuniyah',31.954,35.1624,'P','PPL','PS.WE',NULL,6107,'Asia/Hebron',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285061,'PS','Al Khaḑir','Al Khadir',31.694,35.1669,'P','PPL','PS.WE','PS.WE.7870463',9003,'Asia/Hebron',1,'2017-09-05 23:00:00','2017-09-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285066,'PS','Hebron','Hebron',31.5294,35.0938,'P','PPL','PS.WE',NULL,160470,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285108,'PS','Al Bīrah','Al Birah',31.91,35.2164,'P','PPL','PS.WE',NULL,38192,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285111,'PS','Al ‘Ayzarīyah','Al `Ayzariyah',31.7708,35.2692,'P','PPL','PS.WE','PS.WE.7870654',17455,'Asia/Hebron',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (285279,'PS','Abū Dīs','Abu Dis',31.7621,35.2617,'P','PPL','PS.WE',NULL,11753,'Asia/Hebron',1,'2012-02-27 23:00:00','2012-02-27 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (6945291,'PS','Old City','Old City',31.7767,35.2342,'P','PPLX','PS.WE',NULL,36000,'Asia/Hebron',1,'2016-02-21 23:00:00','2016-02-21 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (6967857,'PS','An Naşr','An Nasr',31.2814,34.3025,'P','PPL','PS.GZ','PS.GZ.7870260',6211,'Asia/Gaza',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (6967863,'PS','‘Abasān al Jadīdah','`Abasan al Jadidah',31.3416,34.3459,'P','PPL','PS.00',NULL,5984,'Asia/Gaza',1,'2012-01-19 23:00:00','2012-01-19 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (6967865,'PS','Al Qarārah','Al Qararah',31.3739,34.3409,'P','PPL','PS.GZ',NULL,19500,'Asia/Gaza',1,'2013-10-29 23:00:00','2013-10-29 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (6967990,'PS','Az Zuwāydah','Az Zuwaydah',31.4395,34.3805,'P','PPL','PS.GZ',NULL,16688,'Asia/Gaza',1,'2013-11-07 23:00:00','2013-11-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (6968063,'PS','Al Mughrāqah','Al Mughraqah',31.4659,34.4121,'P','PPL','PS.GZ','PS.GZ.11184609',6448,'Asia/Gaza',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (7303419,'PS','East Jerusalem','East Jerusalem',31.7834,35.2339,'P','PPLX','PS.WE',NULL,428304,'Asia/Hebron',1,'2016-02-21 23:00:00','2016-02-21 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (7889665,'PS','Banī Zayd','Bani Zayd',32.0392,35.1032,'P','PPL','PS.00',NULL,5441,'Asia/Hebron',1,'2012-01-20 23:00:00','2012-01-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (7890350,'PS','Al ‘Ubaydīyah','Al `Ubaydiyah',31.717,35.2901,'P','PPL','PS.00',NULL,10618,'Asia/Hebron',1,'2012-01-20 23:00:00','2012-01-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (7890368,'PS','Ad Dawḩah','Ad Dawhah',31.6995,35.1805,'P','PPL','PS.WE','PS.WE.7870463',9631,'Asia/Hebron',1,'2017-09-05 23:00:00','2017-09-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (7890847,'PS','Dayr Sāmit','Dayr Samit',31.5206,34.9744,'P','PPL','PS.00',NULL,6144,'Asia/Hebron',1,'2012-01-20 23:00:00','2012-01-20 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (8199386,'PS','Givat Zeev','Givat Zeev',31.8615,35.1686,'P','PPL','PS.WE',NULL,11764,'Asia/Jerusalem',1,'2016-09-12 23:00:00','2016-09-12 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (8199420,'PS','Oranit','Oranit',32.1316,34.9909,'P','PPL','PS.WE',NULL,6205,'Asia/Jerusalem',1,'2016-09-12 23:00:00','2016-09-12 23:00:00');
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
