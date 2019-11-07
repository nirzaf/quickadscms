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
INSERT INTO `<<prefix>>subadmin1` VALUES (1284,'IL.06','IL','Jerusalem','Jerusalem',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1285,'IL.05','IL','Tel Aviv','Tel Aviv',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1286,'IL.04','IL','Haifa','Haifa',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1287,'IL.03','IL','Northern District','Northern District',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1288,'IL.02','IL','Central District','Central District',1);
INSERT INTO `<<prefix>>subadmin1` VALUES (1289,'IL.01','IL','Southern District','Southern District',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin1` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>subadmin2`
--

/*!40000 ALTER TABLE `<<prefix>>subadmin2` DISABLE KEYS */;
INSERT INTO `<<prefix>>subadmin2` VALUES (15846,'IL.04.294798','IL','IL.04','Nefat H̱efa','Nefat Hefa',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (15847,'IL.01.295618','IL','IL.01','Nefat Ashqelon','Nefat Ashqelon',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (15848,'IL.03.295719','IL','IL.03','Nefat ‘Akko','Nefat `Akko',1);
INSERT INTO `<<prefix>>subadmin2` VALUES (15849,'IL.01.7870269','IL','IL.01','Gaza','Gaza',1);
/*!40000 ALTER TABLE `<<prefix>>subadmin2` ENABLE KEYS */;

--
-- Dumping data for table `<<prefix>>cities`
--

/*!40000 ALTER TABLE `<<prefix>>cities` DISABLE KEYS */;
INSERT INTO `<<prefix>>cities` VALUES (281184,'IL','Jerusalem','Jerusalem',31.769,35.2163,'P','PPLA','IL.06',NULL,801000,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (282926,'IL','Modi‘in Makkabbim Re‘ut','Modi\'in Makkabbim Re\'ut',31.8939,35.015,'P','PPL','IL.02',NULL,88749,'Asia/Hebron',1,'2017-07-02 23:00:00','2017-07-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293100,'IL','Safed','Safed',32.9646,35.496,'P','PPL','IL.03',NULL,27816,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293203,'IL','Yeroẖam','Yeroham',30.9882,34.9318,'P','PPL','IL.01',NULL,8631,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293207,'IL','Yehud','Yehud',32.0332,34.8909,'P','PPL','IL.02',NULL,25600,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293222,'IL','Yavné','Yavne',31.8781,34.7398,'P','PPL','IL.02',NULL,31774,'Asia/Jerusalem',1,'2017-11-09 23:00:00','2017-11-09 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293253,'IL','Jaffa','Jaffa',32.0504,34.7522,'P','PPLX','IL.05',NULL,100000,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293286,'IL','Umm el Faḥm','Umm el Fahm',32.5173,35.1535,'P','PPL','IL.04',NULL,41030,'Asia/Jerusalem',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293308,'IL','Tirat Karmel','Tirat Karmel',32.7602,34.9718,'P','PPL','IL.04',NULL,18993,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293322,'IL','Tiberias','Tiberias',32.7922,35.5312,'P','PPL','IL.03',NULL,39790,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293354,'IL','Tel Mond','Tel Mond',32.25,34.9174,'P','PPL','IL.02',NULL,8725,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293397,'IL','Tel Aviv','Tel Aviv',32.0809,34.7806,'P','PPLA','IL.05',NULL,432892,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293420,'IL','maalot Tarshīhā','maalot Tarshiha',33.0167,35.2667,'P','PPL','IL.03',NULL,21400,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293426,'IL','Tamra','Tamra',32.853,35.1987,'P','PPL','IL.03',NULL,25917,'Asia/Jerusalem',1,'2012-05-05 23:00:00','2012-05-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293522,'IL','Shelomi','Shelomi',33.0722,35.1445,'P','PPL','IL.03',NULL,5608,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293619,'IL','Sederot','Sederot',31.525,34.5969,'P','PPL','IL.01',NULL,20228,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293655,'IL','Sakhnīn','Sakhnin',32.8642,35.2971,'P','PPL','IL.03',NULL,24596,'Asia/Jerusalem',1,'2014-09-30 23:00:00','2014-09-30 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293690,'IL','Rosh Ha‘Ayin','Rosh Ha\'Ayin',32.0956,34.9566,'P','PPL','IL.02',NULL,39215,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293703,'IL','Rishon LeẔiyyon','Rishon LeZiyyon',31.971,34.7894,'P','PPL','IL.02',NULL,220492,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293721,'IL','Rekhasim','Rekhasim',32.7491,35.099,'P','PPL','IL.04',NULL,10682,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293725,'IL','Reẖovot','Rehovot',31.8942,34.812,'P','PPL','IL.02',NULL,132671,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293768,'IL','Ramla','Ramla',31.9292,34.8656,'P','PPLA','IL.02',NULL,63860,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293773,'IL','Ramat Yishay','Ramat Yishay',32.7044,35.1707,'P','PPL','IL.03',NULL,5431,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293783,'IL','Ramat HaSharon','Ramat HaSharon',32.1461,34.8394,'P','PPL','IL.05',NULL,36137,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293788,'IL','Ramat Gan','Ramat Gan',32.0823,34.8106,'P','PPL','IL.05',NULL,128095,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293807,'IL','Ra\'anana','Ra\'anana',32.1836,34.8739,'P','PPL','IL.02',NULL,80000,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293822,'IL','Qiryat Yam','Qiryat Yam',32.8497,35.0697,'P','PPL','IL.04',NULL,39273,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293825,'IL','Qiryat Shemona','Qiryat Shemona',33.2073,35.5721,'P','PPL','IL.03',NULL,22035,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293831,'IL','Qiryat Moẕqin','Qiryat Mozqin',32.8371,35.0776,'P','PPL','IL.04',NULL,39404,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293842,'IL','Qiryat Gat','Qiryat Gat',31.61,34.7642,'P','PPL','IL.01',NULL,47450,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293844,'IL','Qiryat Bialik','Qiryat Bialik',32.8275,35.0858,'P','PPL','IL.04',NULL,36551,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293845,'IL','Qiryat Ata','Qiryat Ata',32.8115,35.1132,'P','PPL','IL.04',NULL,48966,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293896,'IL','Qalansuwa','Qalansuwa',32.2849,34.9811,'P','PPL','IL.02',NULL,16898,'Asia/Jerusalem',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293918,'IL','Petaẖ Tiqwa','Petah Tiqwa',32.0871,34.8875,'P','PPL','IL.02',NULL,200000,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293942,'IL','Pardesiyya','Pardesiyya',32.3058,34.9091,'P','PPL','IL.02',NULL,6254,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293962,'IL','Or Yehuda','Or Yehuda',32.0292,34.8579,'P','PPL','IL.05',NULL,30802,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (293992,'IL','Ofaqim','Ofaqim',31.3141,34.6203,'P','PPL','IL.01',NULL,24311,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294068,'IL','Netivot','Netivot',31.423,34.5891,'P','PPL','IL.01',NULL,24564,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294071,'IL','Netanya','Netanya',32.3329,34.8599,'P','PPL','IL.02',NULL,171676,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294074,'IL','Ness Ziona','Ness Ziona',31.9293,34.7987,'P','PPL','IL.02',NULL,38700,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294078,'IL','Nesher','Nesher',32.7662,35.0443,'P','PPL','IL.04',NULL,21245,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294098,'IL','Nazareth','Nazareth',32.6992,35.3048,'P','PPLA','IL.03',NULL,64800,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294114,'IL','Naḥf','Nahf',32.9344,35.3168,'P','PPL','IL.03',NULL,10105,'Asia/Jerusalem',1,'2015-09-05 23:00:00','2015-09-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294117,'IL','Nahariyya','Nahariyya',33.0089,35.0981,'P','PPL','IL.03',NULL,51200,'Asia/Jerusalem',1,'2017-09-04 23:00:00','2017-09-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294210,'IL','Migdal Ha‘Emeq','Migdal Ha`Emeq',32.676,35.2399,'P','PPL','IL.03',NULL,24800,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294245,'IL','Mevasseret Ẕiyyon','Mevasseret Ziyyon',31.8019,35.1507,'P','PPL','IL.06',NULL,24409,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294303,'IL','Mazkeret Batya','Mazkeret Batya',31.8536,34.8465,'P','PPL','IL.02',NULL,8034,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294387,'IL','Maghār','Maghar',32.8898,35.407,'P','PPL','IL.03',NULL,18915,'Asia/Jerusalem',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294421,'IL','Lod','Lod',31.9467,34.8903,'P','PPL','IL.02',NULL,66589,'Asia/Jerusalem',1,'2017-08-28 23:00:00','2017-08-28 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294492,'IL','Kefar Yona','Kefar Yona',32.3167,34.9351,'P','PPL','IL.02',NULL,21611,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294514,'IL','Kfar Saba','Kfar Saba',32.175,34.9069,'P','PPL','IL.02',NULL,80773,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294577,'IL','Karmi’el','Karmi\'el',32.9171,35.305,'P','PPL','IL.03',NULL,44382,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294600,'IL','Kafir Yasif','Kafir Yasif',32.9545,35.1623,'P','PPL','IL.03',NULL,8308,'Asia/Jerusalem',1,'2014-07-07 23:00:00','2014-07-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294604,'IL','Kafr Qāsim','Kafr Qasim',32.1141,34.9762,'P','PPL','IL.02',NULL,17303,'Asia/Jerusalem',1,'2012-12-04 23:00:00','2012-12-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294608,'IL','Kafr Mandā','Kafr Manda',32.8103,35.2601,'P','PPL','IL.03',NULL,15014,'Asia/Jerusalem',1,'2012-05-05 23:00:00','2012-05-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294610,'IL','Kafr Kannā','Kafr Kanna',32.7466,35.3424,'P','PPL','IL.03',NULL,17606,'Asia/Jerusalem',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294615,'IL','Kābūl','Kabul',32.8686,35.2117,'P','PPL','IL.03',NULL,9497,'Asia/Jerusalem',1,'2012-05-05 23:00:00','2012-05-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294622,'IL','Judeida Makr','Judeida Makr',32.9282,35.1571,'P','PPL','IL.03',NULL,17530,'Asia/Jerusalem',1,'2014-09-30 23:00:00','2014-09-30 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294634,'IL','Jaljūlya','Jaljulya',32.1547,34.9537,'P','PPL','IL.02',NULL,7505,'Asia/Jerusalem',1,'2012-12-04 23:00:00','2012-12-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294658,'IL','Iksāl','Iksal',32.6816,35.3237,'P','PPL','IL.03',NULL,11398,'Asia/Jerusalem',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294666,'IL','Ḥurfeish','Hurfeish',33.0171,35.3484,'P','PPL','IL.03',NULL,5308,'Asia/Jerusalem',1,'2015-09-05 23:00:00','2015-09-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294751,'IL','H̱olon','Holon',32.0103,34.7792,'P','PPL','IL.05',NULL,165787,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294760,'IL','Hod HaSharon','Hod HaSharon',32.1593,34.8932,'P','PPL','IL.02',NULL,43185,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294778,'IL','Herzliya','Herzliya',32.1663,34.8254,'P','PPL','IL.05',NULL,83600,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294801,'IL','Haifa','Haifa',32.8184,34.9885,'P','PPLA','IL.04',NULL,267300,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294946,'IL','Hadera','Hadera',32.4419,34.9039,'P','PPL','IL.04',NULL,75854,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294981,'IL','Giv\'at Shmuel','Giv\'at Shmuel',32.0782,34.8486,'P','PPL','IL.05',NULL,18500,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (294999,'IL','Givatayim','Givatayim',32.0723,34.8125,'P','PPL','IL.05',NULL,48000,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295064,'IL','Gedera','Gedera',31.8146,34.78,'P','PPL','IL.02',NULL,26217,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295080,'IL','Gan Yavne','Gan Yavne',31.7874,34.7066,'P','PPL','IL.02',NULL,22453,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295089,'IL','Ganei Tikva','Ganei Tikva',32.0597,34.8732,'P','PPL','IL.02',NULL,16053,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295122,'IL','Even Yehuda','Even Yehuda',32.2696,34.8876,'P','PPL','IL.02',NULL,15221,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295127,'IL','Tirah','Tirah',32.2341,34.9502,'P','PPL','IL.02',NULL,20786,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295130,'IL','Eṭ Ṭaiyiba','Et Taiyiba',32.2662,35.0089,'P','PPL','IL.02',NULL,32978,'Asia/Jerusalem',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295174,'IL','Er Reina','Er Reina',32.7234,35.3162,'P','PPL','IL.03',NULL,15621,'Asia/Jerusalem',1,'2012-05-05 23:00:00','2012-05-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295269,'IL','El Fureidīs','El Fureidis',32.5981,34.9515,'P','PPL','IL.04',NULL,9999,'Asia/Jerusalem',1,'2015-09-05 23:00:00','2015-09-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295277,'IL','Eilat','Eilat',29.5581,34.9482,'P','PPL','IL.01',NULL,45588,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295328,'IL','Dimona','Dimona',31.0708,35.0327,'P','PPL','IL.01',NULL,33558,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295339,'IL','Deir Ḥannā','Deir Hanna',32.862,35.3637,'P','PPL','IL.03',NULL,8417,'Asia/Jerusalem',1,'2015-09-05 23:00:00','2015-09-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295365,'IL','Daliyat al Karmel','Daliyat al Karmel',32.6938,35.0469,'P','PPL','IL.04',NULL,25000,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295370,'IL','Dabbūrīya','Dabburiya',32.6926,35.3712,'P','PPL','IL.03',NULL,8305,'Asia/Jerusalem',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295379,'IL','Buqei‘a','Buqei`a',32.9775,35.3335,'P','PPL','IL.03',NULL,5200,'Asia/Jerusalem',1,'2014-07-07 23:00:00','2014-07-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295380,'IL','Bu‘eina','Bu`eina',32.8064,35.3649,'P','PPL','IL.03',NULL,7900,'Asia/Jerusalem',1,'2012-01-17 23:00:00','2012-01-17 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295404,'IL','Bīr el Maksūr','Bir el Maksur',32.7773,35.2207,'P','PPL','IL.03',NULL,7106,'Asia/Jerusalem',1,'2012-05-05 23:00:00','2012-05-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295432,'IL','Bet Shemesh','Bet Shemesh',31.7307,34.9929,'P','PPL','IL.06',NULL,67100,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295435,'IL','Bet She’an','Bet She\'an',32.4973,35.4963,'P','PPL','IL.03',NULL,16800,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295475,'IL','Bet Dagan','Bet Dagan',32.0019,34.8298,'P','PPL','IL.02',NULL,7099,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295514,'IL','Bnei Brak','Bnei Brak',32.0807,34.8338,'P','PPL','IL.05',NULL,154400,'Asia/Jerusalem',1,'2017-07-02 23:00:00','2017-07-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295515,'IL','Bnei Ayish','Bnei Ayish',31.7833,34.75,'P','PPL','IL.02',NULL,7920,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295523,'IL','Beit Jann','Beit Jann',32.9646,35.3815,'P','PPL','IL.03',NULL,10002,'Asia/Jerusalem',1,'2014-07-07 23:00:00','2014-07-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295530,'IL','Beersheba','Beersheba',31.2518,34.7913,'P','PPLA','IL.01',NULL,186600,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295548,'IL','Bat Yam','Bat Yam',32.0238,34.7519,'P','PPL','IL.05',NULL,128979,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295553,'IL','Basmat Ṭab‘ūn','Basmat Tab`un',32.739,35.1572,'P','PPL','IL.03',NULL,6300,'Asia/Jerusalem',1,'2015-02-06 23:00:00','2015-02-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295584,'IL','Azor','Azor',32.0243,34.8063,'P','PPL','IL.05',NULL,16201,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295620,'IL','Ashkelon','Ashkelon',31.6693,34.5715,'P','PPL','IL.01',NULL,105995,'Asia/Jerusalem',1,'2017-11-09 23:00:00','2017-11-09 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295629,'IL','Ashdod','Ashdod',31.7921,34.6497,'P','PPL','IL.01',NULL,224656,'Asia/Jerusalem',1,'2017-07-04 23:00:00','2017-07-04 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295657,'IL','Arad','Arad',31.2588,35.2128,'P','PPL','IL.01',NULL,23700,'Asia/Jerusalem',1,'2017-07-02 23:00:00','2017-07-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295721,'IL','Acre','Acre',32.9281,35.0765,'P','PPL','IL.03',NULL,45603,'Asia/Jerusalem',1,'2017-07-02 23:00:00','2017-07-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295740,'IL','Afula','Afula',32.6091,35.2892,'P','PPL','IL.03',NULL,44930,'Asia/Jerusalem',1,'2017-07-02 23:00:00','2017-07-02 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (295772,'IL','Abū Ghaush','Abu Ghaush',31.8059,35.1093,'P','PPL','IL.06',NULL,5707,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (386445,'IL','Kefar Weradim','Kefar Weradim',32.9939,35.2779,'P','PPL','IL.03',NULL,5608,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (6693244,'IL','Lehavim','Lehavim',31.3728,34.8162,'P','PPL','IL.01',NULL,6000,'Asia/Jerusalem',1,'2017-07-01 23:00:00','2017-07-01 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (7498240,'IL','West Jerusalem','West Jerusalem',31.782,35.2196,'P','PPLX','IL.06',NULL,400000,'Asia/Jerusalem',1,'2012-02-29 23:00:00','2012-02-29 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (8184212,'IL','Rahat','Rahat',31.3955,34.757,'P','PPL','IL.01',NULL,19586,'Asia/Jerusalem',1,'2017-12-05 23:00:00','2017-12-05 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (8199378,'IL','Modiin Ilit','Modiin Ilit',31.9322,35.0442,'P','PPL','IL.06',NULL,64179,'Asia/Jerusalem',1,'2017-07-03 23:00:00','2017-07-03 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (8199394,'IL','Ariel','Ariel',32.1065,35.1845,'P','PPL','IL.06',NULL,17668,'Asia/Jerusalem',1,'2013-11-07 23:00:00','2013-11-07 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (8428283,'IL','Shoham','Shoham',31.9987,34.9456,'P','PPL','IL.02',NULL,20740,'Asia/Jerusalem',1,'2017-12-12 23:00:00','2017-12-12 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (8478264,'IL','Herzliya Pituah','Herzliya Pituah',32.1741,34.8028,'P','PPLX','IL.05',NULL,10000,'Asia/Jerusalem',1,'2013-03-06 23:00:00','2013-03-06 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (10227184,'IL','Yehud-Monosson','Yehud-Monosson',32.0284,34.8796,'P','PPL','IL.05',NULL,29312,'Asia/Jerusalem',1,'2017-12-13 23:00:00','2017-12-13 23:00:00');
INSERT INTO `<<prefix>>cities` VALUES (11049562,'IL','Kiryat Ono','Kiryat Ono',32.055,34.8579,'P','PPLX','IL.05',NULL,37791,'Asia/Jerusalem',1,'2017-07-02 23:00:00','2017-07-02 23:00:00');
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
