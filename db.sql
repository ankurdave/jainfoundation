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
  `final` tinyint(1) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `author_status` varchar(255) DEFAULT NULL,
  `author_status_other` varchar(255) DEFAULT NULL,
  `degree_year` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state_province` varchar(255) DEFAULT NULL,
  `zip_postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `picture_mimetype` varchar(255) DEFAULT NULL,
  `picture_data` mediumblob,
  `abstract_category` varchar(255) DEFAULT NULL,
  `abstract_category_other` varchar(255) DEFAULT NULL,
  `presentation_type` varchar(255) DEFAULT NULL,
  `abstract_title` varchar(255) DEFAULT NULL,
  `abstract_body` text,
  `comments` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `abstract_affiliation`
--

DROP TABLE IF EXISTS `abstract_affiliation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abstract_affiliation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abstract_id` int(11) NOT NULL,
  `affiliation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `abstract_author`
--

DROP TABLE IF EXISTS `abstract_author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abstract_author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abstract_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `affiliations` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `logname` varchar(50) NOT NULL DEFAULT '',
  `logpassword` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`login_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `address` varchar(80) NOT NULL DEFAULT '',
  `city_state_zip` varchar(60) NOT NULL DEFAULT '',
  `country` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `gender` varchar(30) NOT NULL DEFAULT '',
  `age` int(2) NOT NULL DEFAULT '0',
  `diagnosis_age` int(2) NOT NULL DEFAULT '0',
  `diagnosis_examination` varchar(10) NOT NULL DEFAULT '',
  `diagnosis_ck_level` varchar(10) NOT NULL DEFAULT '',
  `diagnosis_ck_level_number` varchar(10) NOT NULL DEFAULT '',
  `diagonsis_muscle_biopsy` varchar(10) NOT NULL DEFAULT '',
  `diagnosis_blood_cell_test` varchar(10) NOT NULL DEFAULT '',
  `diagnosis_mutational` varchar(10) NOT NULL DEFAULT '',
  `submission_date` varchar(20) NOT NULL DEFAULT '',
  `mom_disease` varchar(3) NOT NULL DEFAULT '',
  `dad_disease` varchar(3) NOT NULL DEFAULT '',
  `relatives_name1` varchar(30) NOT NULL DEFAULT '',
  `relatives_age1` int(3) NOT NULL DEFAULT '0',
  `relatives_lgmd2b1` varchar(3) NOT NULL DEFAULT '',
  `relatives_name2` varchar(30) NOT NULL DEFAULT '',
  `relatives_age2` int(3) NOT NULL DEFAULT '0',
  `relatives_lgmd2b2` varchar(3) NOT NULL DEFAULT '',
  `relatives_name3` varchar(30) NOT NULL DEFAULT '',
  `relatives_age3` int(3) NOT NULL DEFAULT '0',
  `relatives_lgmd2b3` varchar(3) NOT NULL DEFAULT '',
  `relatives_name4` varchar(30) NOT NULL DEFAULT '',
  `relatives_age4` int(3) NOT NULL DEFAULT '0',
  `relatives_lgmd2b4` varchar(3) NOT NULL DEFAULT '',
  `children_name1` varchar(30) NOT NULL DEFAULT '',
  `children_age1` int(3) NOT NULL DEFAULT '0',
  `children_lgmd2b1` varchar(3) NOT NULL DEFAULT '',
  `children_name2` varchar(30) NOT NULL DEFAULT '',
  `children_age2` int(3) NOT NULL DEFAULT '0',
  `children_lgmd2b2` varchar(3) NOT NULL DEFAULT '',
  `children_name3` varchar(30) NOT NULL DEFAULT '',
  `children_age3` int(3) NOT NULL DEFAULT '0',
  `children_lgmd2b3` varchar(3) NOT NULL DEFAULT '',
  `children_name4` varchar(30) NOT NULL DEFAULT '',
  `children_age4` int(3) NOT NULL DEFAULT '0',
  `children_lgmd2b4` varchar(3) NOT NULL DEFAULT '',
  `sibling_name1` varchar(30) NOT NULL DEFAULT '',
  `sibling_age1` int(3) NOT NULL DEFAULT '0',
  `sibling_lgmd2b1` varchar(3) NOT NULL DEFAULT '',
  `sibling_name2` varchar(30) NOT NULL DEFAULT '',
  `sibling_age2` int(3) NOT NULL DEFAULT '0',
  `sibling_lgmd2b2` varchar(3) NOT NULL DEFAULT '',
  `sibling_name3` varchar(30) NOT NULL DEFAULT '',
  `sibling_age3` int(3) NOT NULL DEFAULT '0',
  `sibling_lgmd2b3` varchar(3) NOT NULL DEFAULT '',
  `sibling_name4` varchar(30) NOT NULL DEFAULT '',
  `sibling_age4` int(3) NOT NULL DEFAULT '0',
  `sibling_lgmd2b4` varchar(3) NOT NULL DEFAULT '',
  `age_symptoms` int(11) NOT NULL DEFAULT '0',
  `scooter` varchar(10) NOT NULL DEFAULT '',
  `scooter_age` int(11) NOT NULL DEFAULT '0',
  `cane` varchar(10) NOT NULL DEFAULT '',
  `cane_age` int(11) NOT NULL DEFAULT '0',
  `leg_braces` varchar(10) NOT NULL DEFAULT '',
  `leg_braces_age` int(11) NOT NULL DEFAULT '0',
  `walk_without_assistance` varchar(20) NOT NULL DEFAULT '',
  `stand_no_support` varchar(255) NOT NULL DEFAULT '',
  `tiptoes` varchar(3) NOT NULL DEFAULT '',
  `tiptoes_age` int(11) NOT NULL DEFAULT '0',
  `rising_sitting_position` varchar(3) NOT NULL DEFAULT '',
  `rising_sitting_position_age` int(11) NOT NULL DEFAULT '0',
  `rising_sitting_position_explained` text NOT NULL,
  `sitting_horizontal` varchar(3) NOT NULL DEFAULT '',
  `sitting_horizontal_age` int(11) NOT NULL DEFAULT '0',
  `climbing_stairs` varchar(3) NOT NULL DEFAULT '',
  `climbing_stairs_age` int(11) NOT NULL DEFAULT '0',
  `climbing_stairs_explained` text NOT NULL,
  `elevation` varchar(3) NOT NULL DEFAULT '',
  `elevation_age` int(11) NOT NULL DEFAULT '0',
  `raising_arm_above_head` varchar(3) NOT NULL DEFAULT '',
  `raising_arm_above_head_age` int(11) NOT NULL DEFAULT '0',
  `glass_of_water` varchar(3) NOT NULL DEFAULT '',
  `glass_of_water_age` int(11) NOT NULL DEFAULT '0',
  `opening_jar` varchar(3) NOT NULL DEFAULT '',
  `opening_jar_age` int(11) NOT NULL DEFAULT '0',
  `carrying_milk` varchar(3) NOT NULL DEFAULT '',
  `carrying_milk_age` int(11) NOT NULL DEFAULT '0',
  `turning_car_wheel` varchar(3) NOT NULL DEFAULT '',
  `turning_car_wheel_age` int(11) NOT NULL DEFAULT '0',
  `typing` varchar(3) NOT NULL DEFAULT '',
  `typing_age` int(11) NOT NULL DEFAULT '0',
  `respiratory_difficulties` text NOT NULL,
  `factors_symptoms` text NOT NULL,
  `sports` text NOT NULL,
  `neurological` text NOT NULL,
  `agreetoterms` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registrant`
--

DROP TABLE IF EXISTS `registrant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_key` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `degree_other` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `position_other` varchar(255) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `institution_profile` varchar(255) DEFAULT NULL,
  `institution_profile_other` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state_province` varchar(255) DEFAULT NULL,
  `zip_postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `submitting_abstract` varchar(255) DEFAULT NULL,
  `abstract_title` varchar(255) DEFAULT NULL,
  `local_attendee` varchar(255) DEFAULT NULL,
  `hotel_parking` varchar(255) DEFAULT NULL,
  `attendance_day1` varchar(255) DEFAULT NULL,
  `attendance_day2` varchar(255) DEFAULT NULL,
  `attendance_day3` varchar(255) DEFAULT NULL,
  `attendance_day4` varchar(255) DEFAULT NULL,
  `meals_day2_breakfast` varchar(255) DEFAULT NULL,
  `meals_day2_lunch` varchar(255) DEFAULT NULL,
  `meals_day3_breakfast` varchar(255) DEFAULT NULL,
  `meals_day3_lunch` varchar(255) DEFAULT NULL,
  `meals_day4_breakfast` varchar(255) DEFAULT NULL,
  `meals_day4_lunch` varchar(255) DEFAULT NULL,
  `meals_gala_dinner` varchar(255) DEFAULT NULL,
  `meals_gala_dinner_guests` varchar(255) DEFAULT NULL,
  `meals_gala_dinner_numguests` varchar(255) DEFAULT NULL,
  `share_room` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `arrival_date` varchar(255) DEFAULT NULL,
  `departure_date` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `total_fee` int(11) DEFAULT NULL,
  `meals_day2_lunch_entree` varchar(255) DEFAULT NULL,
  `meals_day3_lunch_entree` varchar(255) DEFAULT NULL,
  `meals_day4_lunch_entree` varchar(255) DEFAULT NULL,
  `meals_gala_dinner_vegetarian` varchar(255) DEFAULT NULL,
  `have_promo_code` varchar(255) DEFAULT NULL,
  `promo_code` varchar(255) DEFAULT NULL,
  `comments` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-03-28 15:21:07
