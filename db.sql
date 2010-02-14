-- MySQL dump 10.13  Distrib 5.1.37, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: jainfoundation
-- ------------------------------------------------------
-- Server version	5.1.37-1ubuntu5.1

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
-- Table structure for table `abstract`
--

DROP TABLE IF EXISTS `abstract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abstract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_key` varchar(255) DEFAULT NULL,
  `picture_mimetype` varchar(255) DEFAULT NULL,
  `picture_data` mediumblob,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state_province` varchar(255) DEFAULT NULL,
  `zip_postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `author_status` varchar(255) DEFAULT NULL,
  `degree_year` varchar(255) DEFAULT NULL,
  `abstract_category` varchar(255) DEFAULT NULL,
  `abstract_category_other` varchar(255) DEFAULT NULL,
  `presentation_type` varchar(255) DEFAULT NULL,
  `abstract_title` varchar(255) DEFAULT NULL,
  `abstract_body` text,
  `affiliation_1` varchar(255) DEFAULT NULL,
  `affiliation_2` varchar(255) DEFAULT NULL,
  `affiliation_3` varchar(255) DEFAULT NULL,
  `affiliation_4` varchar(255) DEFAULT NULL,
  `affiliation_5` varchar(255) DEFAULT NULL,
  `affiliation_6` varchar(255) DEFAULT NULL,
  `affiliation_7` varchar(255) DEFAULT NULL,
  `affiliation_8` varchar(255) DEFAULT NULL,
  `author_1_firstname` varchar(255) DEFAULT NULL,
  `author_1_middlename` varchar(255) DEFAULT NULL,
  `author_1_lastname` varchar(255) DEFAULT NULL,
  `author_1_affiliation` varchar(255) DEFAULT NULL,
  `author_2_firstname` varchar(255) DEFAULT NULL,
  `author_2_middlename` varchar(255) DEFAULT NULL,
  `author_2_lastname` varchar(255) DEFAULT NULL,
  `author_2_affiliation` varchar(255) DEFAULT NULL,
  `author_3_firstname` varchar(255) DEFAULT NULL,
  `author_3_middlename` varchar(255) DEFAULT NULL,
  `author_3_lastname` varchar(255) DEFAULT NULL,
  `author_3_affiliation` varchar(255) DEFAULT NULL,
  `author_4_firstname` varchar(255) DEFAULT NULL,
  `author_4_middlename` varchar(255) DEFAULT NULL,
  `author_4_lastname` varchar(255) DEFAULT NULL,
  `author_4_affiliation` varchar(255) DEFAULT NULL,
  `author_5_firstname` varchar(255) DEFAULT NULL,
  `author_5_middlename` varchar(255) DEFAULT NULL,
  `author_5_lastname` varchar(255) DEFAULT NULL,
  `author_5_affiliation` varchar(255) DEFAULT NULL,
  `author_6_firstname` varchar(255) DEFAULT NULL,
  `author_6_middlename` varchar(255) DEFAULT NULL,
  `author_6_lastname` varchar(255) DEFAULT NULL,
  `author_6_affiliation` varchar(255) DEFAULT NULL,
  `author_7_firstname` varchar(255) DEFAULT NULL,
  `author_7_middlename` varchar(255) DEFAULT NULL,
  `author_7_lastname` varchar(255) DEFAULT NULL,
  `author_7_affiliation` varchar(255) DEFAULT NULL,
  `author_8_firstname` varchar(255) DEFAULT NULL,
  `author_8_middlename` varchar(255) DEFAULT NULL,
  `author_8_lastname` varchar(255) DEFAULT NULL,
  `author_8_affiliation` varchar(255) DEFAULT NULL,
  `final` tinyint(1) DEFAULT NULL,
  `author_status_other` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-02-13 22:41:53
