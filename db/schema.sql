-- MySQL dump 10.13  Distrib 5.7.35, for Linux (x86_64)
--
-- Host: localhost    Database: eweigh_core
-- ------------------------------------------------------
-- Server version	5.7.35-0ubuntu0.18.04.1

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
-- Table structure for table `aauth_group_to_group`
--

DROP TABLE IF EXISTS `aauth_group_to_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aauth_group_to_group` (
  `group_id` int(11) unsigned NOT NULL,
  `subgroup_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`subgroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aauth_group_to_group`
--

LOCK TABLES `aauth_group_to_group` WRITE;
/*!40000 ALTER TABLE `aauth_group_to_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_group_to_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aauth_groups`
--

DROP TABLE IF EXISTS `aauth_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aauth_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aauth_groups`
--

LOCK TABLES `aauth_groups` WRITE;
/*!40000 ALTER TABLE `aauth_groups` DISABLE KEYS */;
INSERT INTO `aauth_groups` VALUES (1,'Admin','Super Admin Group'),(2,'Manager','Manager Access Group'),(3,'Reporter','Reporter Access Group');
/*!40000 ALTER TABLE `aauth_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aauth_login_attempts`
--

DROP TABLE IF EXISTS `aauth_login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aauth_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aauth_login_attempts`
--

LOCK TABLES `aauth_login_attempts` WRITE;
/*!40000 ALTER TABLE `aauth_login_attempts` DISABLE KEYS */;
INSERT INTO `aauth_login_attempts` VALUES (4,'::1','2018-11-15 16:01:42',2);
/*!40000 ALTER TABLE `aauth_login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aauth_perm_to_group`
--

DROP TABLE IF EXISTS `aauth_perm_to_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`perm_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aauth_perm_to_group`
--

LOCK TABLES `aauth_perm_to_group` WRITE;
/*!40000 ALTER TABLE `aauth_perm_to_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_perm_to_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aauth_perm_to_user`
--

DROP TABLE IF EXISTS `aauth_perm_to_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`perm_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aauth_perm_to_user`
--

LOCK TABLES `aauth_perm_to_user` WRITE;
/*!40000 ALTER TABLE `aauth_perm_to_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_perm_to_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aauth_perms`
--

DROP TABLE IF EXISTS `aauth_perms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aauth_perms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aauth_perms`
--

LOCK TABLES `aauth_perms` WRITE;
/*!40000 ALTER TABLE `aauth_perms` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_perms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aauth_pms`
--

DROP TABLE IF EXISTS `aauth_pms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aauth_pms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) unsigned NOT NULL,
  `receiver_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aauth_pms`
--

LOCK TABLES `aauth_pms` WRITE;
/*!40000 ALTER TABLE `aauth_pms` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_pms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aauth_user_to_group`
--

DROP TABLE IF EXISTS `aauth_user_to_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aauth_user_to_group`
--

LOCK TABLES `aauth_user_to_group` WRITE;
/*!40000 ALTER TABLE `aauth_user_to_group` DISABLE KEYS */;
INSERT INTO `aauth_user_to_group` VALUES (1,1),(2,1),(3,1),(4,1),(5,1);
/*!40000 ALTER TABLE `aauth_user_to_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aauth_user_variables`
--

DROP TABLE IF EXISTS `aauth_user_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aauth_user_variables` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aauth_user_variables`
--

LOCK TABLES `aauth_user_variables` WRITE;
/*!40000 ALTER TABLE `aauth_user_variables` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_user_variables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aauth_users`
--

DROP TABLE IF EXISTS `aauth_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aauth_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `mobile` varchar(32) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aauth_users`
--

LOCK TABLES `aauth_users` WRITE;
/*!40000 ALTER TABLE `aauth_users` DISABLE KEYS */;
INSERT INTO `aauth_users` VALUES (1,'admin@example.com','5711aa2253ac62088bf34f79f8ccd82e41bdbcf32e7670772d2a1e1746a9be9b','admin','Admin User','000000000',0,'2021-10-14 12:15:19','2021-10-14 12:15:19','2018-11-15 16:15:30',NULL,'2021-11-13 00:00:00','UFpunJZaziN1xfH7',NULL,NULL,'197.232.121.10');
/*!40000 ALTER TABLE `aauth_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `il_breeds`
--

DROP TABLE IF EXISTS `il_breeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `il_breeds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `breed` varchar(64) NOT NULL,
  `matureweight` double NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `lasteditedon` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lasteditedby` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `il_breeds`
--

LOCK TABLES `il_breeds` WRITE;
/*!40000 ALTER TABLE `il_breeds` DISABLE KEYS */;
INSERT INTO `il_breeds` VALUES (1,'Freisian',550,'2019-10-23 09:09:43',3,'2019-11-28 07:05:29',3),(2,'Shorthorn',480,'2019-10-23 09:09:43',1,'2019-10-23 09:09:43',NULL),(3,'Jersey',420,'2019-10-23 09:09:43',1,'2019-10-23 09:09:43',NULL),(4,'Borana',500,'2019-10-23 09:09:43',1,'2019-10-23 09:09:43',NULL),(5,'Ayrshire',450,'2019-11-03 09:02:37',3,'2019-11-03 09:02:37',3),(6,'Guernsey',475,'2019-11-03 09:03:19',3,'2019-11-03 09:03:19',3),(7,'FreisianXBoran',520,'2019-11-28 07:05:18',3,'2019-11-28 07:05:18',3),(8,'JersyXBoran',460,'2019-11-28 07:05:47',3,'2019-11-28 07:05:47',3),(9,'ShorthornXBoran',490,'2019-11-28 07:06:01',3,'2019-11-28 07:06:01',3);
/*!40000 ALTER TABLE `il_breeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `il_cattle`
--

DROP TABLE IF EXISTS `il_cattle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `il_cattle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `breedid` int(11) NOT NULL,
  `tag` varchar(32) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `deleted` enum('1','0') NOT NULL DEFAULT '0',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `il_chemicalagents`
--

DROP TABLE IF EXISTS `il_chemicalagents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `il_chemicalagents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agent` varchar(192) NOT NULL,
  `applicationmode` varchar(64) DEFAULT NULL,
  `proprietaryname` varchar(192) DEFAULT NULL,
  `dosagebasis` varchar(16) NOT NULL DEFAULT 'ratio',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `lasteditedon` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lasteditedby` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `il_chemicalagents`
--

LOCK TABLES `il_chemicalagents` WRITE;
/*!40000 ALTER TABLE `il_chemicalagents` DISABLE KEYS */;
INSERT INTO `il_chemicalagents` VALUES (1,'Albendazole','Drench','Albendazole 10%','weight','2019-10-17 20:21:13',3,'2019-11-27 10:04:39',3),(2,'Fenbendazole','Drench','Curafluke','weight','2019-10-17 20:21:13',1,'2019-11-27 10:04:39',NULL),(3,'Deltamethrin','Pouron','Deltaguard','weight','2019-10-17 20:21:13',1,'2019-11-27 10:04:39',NULL),(4,'Levamisole Hydrochloride BP plusOxyclozamide','Drench','D-Worm Gold','weight','2019-10-17 20:21:13',3,'2019-11-27 10:04:39',3),(5,'Albendazole','Drench','Tramazole 10%','weight','2019-11-27 08:31:57',3,'2019-11-27 10:04:39',3),(6,'Vermofas','Drench','Levamisole Hydrochloride BP plusOxyclozamide','weight','2019-11-27 08:39:39',3,'2019-11-27 10:04:39',3),(7,'Mostraz','Spray','Amitraz 12.5%','ratio','2019-11-27 08:52:00',3,'2019-11-27 10:05:29',3),(8,'Bimatix','Spray','Alphacypermethrin 10% EC','ratio','2019-11-27 08:52:18',3,'2019-11-27 10:05:29',3),(9,'Cyperguard','Spray','Cypermethrin (high-Cis). 100g/L ','ratio','2019-11-27 08:52:35',3,'2019-11-27 10:05:29',3);
/*!40000 ALTER TABLE `il_chemicalagents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `il_diseases`
--

DROP TABLE IF EXISTS `il_diseases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `il_diseases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(192) NOT NULL,
  `description` text,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `lasteditedon` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lasteditedby` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `il_diseases`
--

LOCK TABLES `il_diseases` WRITE;
/*!40000 ALTER TABLE `il_diseases` DISABLE KEYS */;
INSERT INTO `il_diseases` VALUES (1,'Roundworm',NULL,'2019-10-17 20:18:31',1,'2019-10-17 20:18:31',NULL),(2,'Lungworm',NULL,'2019-10-17 20:18:31',1,'2019-10-17 20:18:31',NULL),(3,'Tapeworm',NULL,'2019-10-17 20:18:31',1,'2019-10-17 20:18:31',NULL),(4,'Stomach Worm',NULL,'2019-10-17 20:18:31',1,'2019-10-17 20:18:31',NULL),(5,'Liver Fluke',NULL,'2019-10-17 20:18:31',1,'2019-10-17 20:18:31',NULL),(6,'Ticks, Lice',NULL,'2019-10-17 20:18:31',1,'2019-10-17 20:18:31',NULL);
/*!40000 ALTER TABLE `il_diseases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `il_dosages`
--

DROP TABLE IF EXISTS `il_dosages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `il_dosages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `disease` int(11) NOT NULL,
  `agent` int(11) NOT NULL,
  `dosage` double NOT NULL COMMENT 'Dosage applied as ml/kg of body weight',
  `county` int(11) DEFAULT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `lasteditedon` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lasteditedby` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `il_dosages`
--

LOCK TABLES `il_dosages` WRITE;
/*!40000 ALTER TABLE `il_dosages` DISABLE KEYS */;
INSERT INTO `il_dosages` VALUES (1,1,1,0.075,NULL,'2019-10-17 20:25:06',1,'2019-10-17 20:25:06',NULL),(2,2,1,0.075,NULL,'2019-10-17 20:25:06',1,'2019-10-17 20:25:06',NULL),(3,3,1,0.075,NULL,'2019-10-17 20:25:06',1,'2019-10-17 20:25:06',NULL),(4,5,1,0.1,NULL,'2019-10-17 20:25:06',1,'2019-10-17 20:25:06',NULL),(5,2,2,0.23,NULL,'2019-10-17 20:27:03',1,'2019-10-17 20:27:03',NULL),(6,3,2,0.23,NULL,'2019-10-17 20:27:03',1,'2019-10-17 20:27:03',NULL),(7,4,2,0.23,NULL,'2019-10-17 20:27:03',1,'2019-10-17 20:27:03',NULL),(8,4,2,0.23,NULL,'2019-10-17 20:27:03',1,'2019-10-17 20:27:03',NULL),(9,6,3,0.1,NULL,'2019-10-17 20:28:02',1,'2019-10-17 20:28:02',NULL),(10,1,4,0.25,NULL,'2019-10-17 20:30:24',1,'2019-10-17 20:30:24',NULL),(11,2,4,0.26,NULL,'2019-10-17 20:30:24',1,'2019-10-17 20:30:24',NULL),(12,3,4,0.27,NULL,'2019-10-17 20:30:24',1,'2019-10-17 20:30:24',NULL),(13,4,4,0.28,NULL,'2019-10-17 20:30:24',1,'2019-10-17 20:30:24',NULL),(14,5,4,0.29,NULL,'2019-10-17 20:30:24',1,'2019-10-17 20:30:24',NULL),(15,6,7,20,NULL,'2019-11-27 10:56:37',3,'2019-11-27 10:56:37',3),(16,6,8,5,NULL,'2019-11-27 10:56:59',3,'2019-11-27 10:56:59',3),(17,6,9,10,NULL,'2019-11-27 10:57:16',3,'2019-11-27 10:57:16',3);
/*!40000 ALTER TABLE `il_dosages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `il_farmers`
--

DROP TABLE IF EXISTS `il_farmers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `il_farmers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `ref` varchar(64) NOT NULL,
  `tag` varchar(32) NOT NULL COMMENT 'A user friendly identifier for the farmers',
  `address` varchar(192) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `language` varchar(32) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lasteditedby` int(11) DEFAULT NULL,
  `lasteditedon` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `il_farms`
--

DROP TABLE IF EXISTS `il_farms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `il_farms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `location` varchar(96) DEFAULT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `il_farms`
--

LOCK TABLES `il_farms` WRITE;
/*!40000 ALTER TABLE `il_farms` DISABLE KEYS */;
/*!40000 ALTER TABLE `il_farms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `il_feed_records`
--

DROP TABLE IF EXISTS `il_feed_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `il_feed_records` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cattleid` int(11) DEFAULT NULL,
  `lw` double NOT NULL COMMENT 'Live weight of cattle in question',
  `mer` double NOT NULL COMMENT 'Minimum Energy Requirement: Amount of energy required for basic metabolic functions',
  `feedstyle` varchar(32) NOT NULL COMMENT 'Stall-fed, Grazed locally, Grazed extensively',
  `feedfor` varchar(16) NOT NULL COMMENT 'Feeding purpose: milk or weight-gain',
  `energy` varchar(45) NOT NULL COMMENT 'Energy required for either milk production or weight-gain',
  `endweight` double DEFAULT NULL COMMENT 'The amount of weight to be gained',
  `endweightday` datetime DEFAULT NULL COMMENT 'The no. of days for the weight to be gained in',
  `weightdays` int(11) DEFAULT NULL,
  `med` double NOT NULL COMMENT 'Minimum energy density requirement',
  `edforage` double NOT NULL COMMENT 'Energy density of chosen forage',
  `edconcentrate` double NOT NULL COMMENT 'Energy density of chosen concentrate',
  `rationconcentrate` double NOT NULL COMMENT 'Concentrate in Ration',
  `rationforage` varchar(45) NOT NULL COMMENT 'Forage in Ration',
  `forage` double NOT NULL COMMENT 'Forage weight in KG',
  `concentrate` double NOT NULL COMMENT 'Concentrate weight in KG',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `il_feed_records`
--

LOCK TABLES `il_feed_records` WRITE;
/*!40000 ALTER TABLE `il_feed_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `il_feed_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `il_feeds`
--

DROP TABLE IF EXISTS `il_feeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `il_feeds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `feed` varchar(192) NOT NULL,
  `description` text,
  `feedtype` varchar(32) NOT NULL,
  `drymatter` double NOT NULL,
  `energy` double NOT NULL,
  `protein` double NOT NULL,
  `ndf` double NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `lasteditedon` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lasteditedby` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `il_feeds`
--

LOCK TABLES `il_feeds` WRITE;
/*!40000 ALTER TABLE `il_feeds` DISABLE KEYS */;
INSERT INTO `il_feeds` VALUES (1,'Napier Grass',NULL,'forage',0.214,9,7.9,59,'2019-10-02 06:44:13',1,'2019-10-02 06:44:13',NULL),(2,'Rhodes Grass',NULL,'forage',0.25,8.8,9,65,'2019-10-02 06:44:13',1,'2019-10-02 06:44:13',NULL),(3,'Brachiaria',NULL,'forage',0.26,8.7,8,68,'2019-10-02 06:44:13',1,'2019-10-02 06:44:13',NULL),(4,'Maize Stover',NULL,'forage',0.35,6.5,4,80,'2019-10-02 06:44:13',1,'2019-10-02 06:44:13',NULL),(5,'Dairy Meal',NULL,'concentrate',0.87,12.5,15.4,22.8,'2019-10-02 06:44:13',1,'2019-10-02 06:44:13',NULL),(6,'Wheat Bran',NULL,'concentrate',0.87,11.8,7.4,35.2,'2019-10-02 06:44:13',1,'2019-10-02 06:44:13',NULL),(7,'SBM',NULL,'concentrate',0.88,12.6,51.8,13.7,'2019-10-02 06:44:13',1,'2019-10-02 06:44:13',NULL),(8,'Cassava Meal',NULL,'concentrate',0.75,11,8,35,'2019-10-02 06:44:13',1,'2019-10-02 06:44:13',NULL),(9,'Sweet Potato Vine Silage',NULL,'concentrate',0.24,9.7,17.1,42.7,'2019-10-02 06:44:13',1,'2019-10-02 06:44:13',NULL),(10,'Cotton Seed ',NULL,'concentrate',0.91,12,21.8,48.6,'2019-10-02 06:44:13',1,'2019-10-02 06:44:13',NULL),(11,'Hay (Rhodes Grass)','','forage',0.87,8.8,9,65,'2019-11-28 07:13:10',3,'2019-11-28 07:13:10',NULL),(12,'Guatemala grass','','forage',0.22,8.4,8.8,72,'2019-11-28 07:14:07',3,'2019-11-28 07:14:07',NULL),(13,'Maize Germ','','concentrate',0.96,13.1,25.6,45,'2019-11-28 07:16:17',3,'2019-11-28 07:16:17',NULL),(14,'Wheat Pollard','','concentrate',0.88,12,17,36,'2019-11-28 07:16:46',3,'2019-11-28 07:16:46',NULL);
/*!40000 ALTER TABLE `il_feeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `il_hglw_records`
--

DROP TABLE IF EXISTS `il_hglw_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `il_hglw_records` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `cattleid` int(11) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `hg` double NOT NULL,
  `lw` double NOT NULL,
  `useragent` varchar(192) DEFAULT NULL,
  `useragenttype` varchar(32) DEFAULT NULL,
  `ipaddress` varchar(32) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `il_users`
--

DROP TABLE IF EXISTS `il_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `il_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `idno` varchar(16) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `county` varchar(64) DEFAULT NULL,
  `fcm_token` varchar(64) DEFAULT NULL,
  `verification_code` varchar(32) DEFAULT NULL,
  `forgot_hash` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `useragent` varchar(192) DEFAULT NULL,
  `useragenttype` varchar(32) DEFAULT NULL,
  `ipaddress` varchar(32) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lasteditedby` int(11) DEFAULT NULL,
  `lasteditedon` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_counties`
--

DROP TABLE IF EXISTS `sys_counties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_counties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `county` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_counties`
--

LOCK TABLES `sys_counties` WRITE;
/*!40000 ALTER TABLE `sys_counties` DISABLE KEYS */;
INSERT INTO `sys_counties` VALUES (1,'Mombasa'),(2,'Kwale'),(3,'Kilifi'),(4,'Tana River'),(5,'Lamu'),(6,'Taita-Taveta'),(7,'Garissa'),(8,'wajir'),(9,'Mandera'),(10,'Marsabit'),(11,'Isiolo'),(12,'Meru'),(13,'Tharaka-Nithi'),(14,'Embu'),(15,'Kitui'),(16,'Machakos'),(17,'Makueni'),(18,'Nyandarua'),(19,'Nyeri'),(20,'Kirinyaga'),(21,'Muranga'),(22,'Kiambu'),(23,'Turkana'),(24,'West Pokot'),(25,'Samburu'),(26,'Trans Nzoia'),(27,'Uasin Gishu'),(28,'Elgeyo-Marakwet'),(29,'Nandi'),(30,'Baringo'),(31,'Laikipia'),(32,'Nakuru'),(33,'Narok'),(34,'Kajiado'),(35,'Kericho'),(36,'Bomet'),(37,'Kakamega'),(38,'Vihiga'),(39,'Bungoma'),(40,'Busia'),(41,'Siaya'),(42,'Kisumu'),(43,'Homa Bay'),(44,'Migori'),(45,'Kisii'),(46,'Nyamira'),(47,'Nairobi City');
/*!40000 ALTER TABLE `sys_counties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_countries`
--

DROP TABLE IF EXISTS `sys_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_countries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL COMMENT 'Nationality',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_countries`
--

LOCK TABLES `sys_countries` WRITE;
/*!40000 ALTER TABLE `sys_countries` DISABLE KEYS */;
INSERT INTO `sys_countries` VALUES (1,'Aruba'),(2,'Afghanistan'),(3,'Angola'),(4,'Anguilla'),(5,'Åland Islands'),(6,'Albania'),(7,'Andorra'),(8,'United Arab Emirates'),(9,'Argentina'),(10,'Armenia'),(11,'American Samoa'),(12,'Antarctica'),(13,'French Southern and Antarctic Lands'),(14,'Antigua and Barbuda'),(15,'Australia'),(16,'Austria'),(17,'Azerbaijan'),(18,'Burundi'),(19,'Belgium'),(20,'Benin'),(21,'Burkina Faso'),(22,'Bangladesh'),(23,'Bulgaria'),(24,'Bahrain'),(25,'Bahamas'),(26,'Bosnia and Herzegovina'),(27,'Saint Barthélemy'),(28,'Belarus'),(29,'Belize'),(30,'Bermuda'),(31,'Bolivia'),(32,'Brazil'),(33,'Barbados'),(34,'Brunei'),(35,'Bhutan'),(36,'Bouvet Island'),(37,'Botswana'),(38,'Central African Republic'),(39,'Canada'),(40,'Cocos (Keeling) Islands'),(41,'Switzerland'),(42,'Chile'),(43,'China'),(44,'Ivory Coast'),(45,'Cameroon'),(46,'DR Congo'),(47,'Republic of the Congo'),(48,'Cook Islands'),(49,'Colombia'),(50,'Comoros'),(51,'Cape Verde'),(52,'Costa Rica'),(53,'Cuba'),(54,'Curaçao'),(55,'Christmas Island'),(56,'Cayman Islands'),(57,'Cyprus'),(58,'Czechia'),(59,'Germany'),(60,'Djibouti'),(61,'Dominica'),(62,'Denmark'),(63,'Dominican Republic'),(64,'Algeria'),(65,'Ecuador'),(66,'Egypt'),(67,'Eritrea'),(68,'Western Sahara'),(69,'Spain'),(70,'Estonia'),(71,'Ethiopia'),(72,'Finland'),(73,'Fiji'),(74,'Falkland Islands'),(75,'France'),(76,'Faroe Islands'),(77,'Micronesia'),(78,'Gabon'),(79,'United Kingdom'),(80,'Georgia'),(81,'Guernsey'),(82,'Ghana'),(83,'Gibraltar'),(84,'Guinea'),(85,'Guadeloupe'),(86,'Gambia'),(87,'Guinea-Bissau'),(88,'Equatorial Guinea'),(89,'Greece'),(90,'Grenada'),(91,'Greenland'),(92,'Guatemala'),(93,'French Guiana'),(94,'Guam'),(95,'Guyana'),(96,'Hong Kong'),(97,'Heard Island and McDonald Islands'),(98,'Honduras'),(99,'Croatia'),(100,'Haiti'),(101,'Hungary'),(102,'Indonesia'),(103,'Isle of Man'),(104,'India'),(105,'British Indian Ocean Territory'),(106,'Ireland'),(107,'Iran'),(108,'Iraq'),(109,'Iceland'),(110,'Israel'),(111,'Italy'),(112,'Jamaica'),(113,'Jersey'),(114,'Jordan'),(115,'Japan'),(116,'Kazakhstan'),(117,'Kenya'),(118,'Kyrgyzstan'),(119,'Cambodia'),(120,'Kiribati'),(121,'Saint Kitts and Nevis'),(122,'South Korea'),(123,'Kosovo'),(124,'Kuwait'),(125,'Laos'),(126,'Lebanon'),(127,'Liberia'),(128,'Libya'),(129,'Saint Lucia'),(130,'Liechtenstein'),(131,'Sri Lanka'),(132,'Lesotho'),(133,'Lithuania'),(134,'Luxembourg'),(135,'Latvia'),(136,'Macau'),(137,'Saint Martin'),(138,'Morocco'),(139,'Monaco'),(140,'Moldova'),(141,'Madagascar'),(142,'Maldives'),(143,'Mexico'),(144,'Marshall Islands'),(145,'Macedonia'),(146,'Mali'),(147,'Malta'),(148,'Myanmar'),(149,'Montenegro'),(150,'Mongolia'),(151,'Northern Mariana Islands'),(152,'Mozambique'),(153,'Mauritania'),(154,'Montserrat'),(155,'Martinique'),(156,'Mauritius'),(157,'Malawi'),(158,'Malaysia'),(159,'Mayotte'),(160,'Namibia'),(161,'New Caledonia'),(162,'Niger'),(163,'Norfolk Island'),(164,'Nigeria'),(165,'Nicaragua'),(166,'Niue'),(167,'Netherlands'),(168,'Norway'),(169,'Nepal'),(170,'Nauru'),(171,'New Zealand'),(172,'Oman'),(173,'Pakistan'),(174,'Panama'),(175,'Pitcairn Islands'),(176,'Peru'),(177,'Philippines'),(178,'Palau'),(179,'Papua New Guinea'),(180,'Poland'),(181,'Puerto Rico'),(182,'North Korea'),(183,'Portugal'),(184,'Paraguay'),(185,'Palestine'),(186,'French Polynesia'),(187,'Qatar'),(188,'Réunion'),(189,'Romania'),(190,'Russia'),(191,'Rwanda'),(192,'Saudi Arabia'),(193,'Sudan'),(194,'Senegal'),(195,'Singapore'),(196,'South Georgia'),(197,'Svalbard and Jan Mayen'),(198,'Solomon Islands'),(199,'Sierra Leone'),(200,'El Salvador'),(201,'San Marino'),(202,'Somalia'),(203,'Saint Pierre and Miquelon'),(204,'Serbia'),(205,'South Sudan'),(206,'São Tomé and Príncipe'),(207,'Suriname'),(208,'Slovakia'),(209,'Slovenia'),(210,'Sweden'),(211,'Swaziland'),(212,'Sint Maarten'),(213,'Seychelles'),(214,'Syria'),(215,'Turks and Caicos Islands'),(216,'Chad'),(217,'Togo'),(218,'Thailand'),(219,'Tajikistan'),(220,'Tokelau'),(221,'Turkmenistan'),(222,'Timor-Leste'),(223,'Tonga'),(224,'Trinidad and Tobago'),(225,'Tunisia'),(226,'Turkey'),(227,'Tuvalu'),(228,'Taiwan'),(229,'Tanzania'),(230,'Uganda'),(231,'Ukraine'),(232,'United States Minor Outlying Islands'),(233,'Uruguay'),(234,'United States'),(235,'Uzbekistan'),(236,'Vatican City'),(237,'Saint Vincent and the Grenadines'),(238,'Venezuela'),(239,'British Virgin Islands'),(240,'United States Virgin Islands'),(241,'Vietnam'),(242,'Vanuatu'),(243,'Wallis and Futuna'),(244,'Samoa'),(245,'Yemen'),(246,'South Africa'),(247,'Zambia'),(248,'Zimbabwe');
/*!40000 ALTER TABLE `sys_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_languages`
--

DROP TABLE IF EXISTS `sys_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_languages`
--

LOCK TABLES `sys_languages` WRITE;
/*!40000 ALTER TABLE `sys_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_languages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-15 11:09:10
