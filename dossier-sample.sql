# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.38)
# Database: dossier-sample
# Generation Time: 2014-08-06 06:43:10 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table entities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `entities`;

CREATE TABLE `entities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(190) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `entities` WRITE;
/*!40000 ALTER TABLE `entities` DISABLE KEYS */;

INSERT INTO `entities` (`id`, `name`)
VALUES
	(8,'Apple'),
	(1,'Bill Gates'),
	(5,'Google'),
	(3,'Marissa Mayer'),
	(4,'Microsoft'),
	(7,'Sergey Brin'),
	(2,'Steve Ballmer'),
	(9,'Steve Jobs'),
	(6,'Yahoo!');

/*!40000 ALTER TABLE `entities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table properties
# ------------------------------------------------------------

DROP TABLE IF EXISTS `properties`;

CREATE TABLE `properties` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) unsigned NOT NULL,
  `key` varchar(190) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL DEFAULT '',
  `value` varchar(190) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL DEFAULT '',
  `extra` varchar(190) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `key` (`key`),
  KEY `value` (`value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;

INSERT INTO `properties` (`id`, `entity_id`, `key`, `value`, `extra`)
VALUES
	(1,1,'Company','Microsoft',''),
	(2,2,'Company','Microsoft','CEO, January 2000 to February 2014'),
	(3,3,'Company','Yahoo!','CEO, July 2012 to present'),
	(4,3,'Company','Google','1999-2012'),
	(5,1,'Type','Person',''),
	(6,2,'Type','Person',''),
	(7,3,'Type','Person',''),
	(8,4,'Type','Company',''),
	(9,5,'Type','Company',''),
	(10,6,'Type','Company',''),
	(11,1,'Full Name','William Henry Gates III',''),
	(12,1,'School','Harvard University',''),
	(13,1,'Spouse','Melinda French',''),
	(14,1,'Born','1955-10-28',''),
	(15,3,'Full Name','Marissa Ann Mayer',''),
	(18,3,'Spouse','Zachary Bogue',''),
	(19,3,'School','Stanford University',''),
	(20,3,'School','West High School',''),
	(21,3,'Born','1975-05-30',''),
	(22,2,'Full Name','Steven Anthony Ballmer',''),
	(23,2,'Spouse','Connie Snyder',''),
	(24,2,'School','Harvard College',''),
	(25,2,'Birthdate','1956-03-24',''),
	(26,7,'Type','Person',''),
	(27,7,'Company','Google','Co-founder'),
	(28,7,'Born','1973-08-21',''),
	(29,7,'Spouse','Anne Wojcicki','2007, separated'),
	(30,6,'Headquarters','Sunnyvale, CA, USA',''),
	(31,4,'Headquarters','Redmond, WA, USA',''),
	(32,8,'Type','Company',''),
	(33,9,'Type','Person',''),
	(34,9,'Company','Apple','Founder and CEO, 1976-2011'),
	(35,9,'School','Reed College',''),
	(36,9,'Company','Pixar',''),
	(37,9,'Company','NeXT',''),
	(38,9,'Spouse','Laurene Powell',''),
	(39,9,'Born','1955-02-24',''),
	(40,9,'Died','2011-10-05','');

/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL DEFAULT '',
  `password_hash` varchar(128) NOT NULL DEFAULT '',
  `session_token` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `session_token` (`session_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `password_hash`, `session_token`)
VALUES
	(1,'admin','insert-bcrypt-hash-here','');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
