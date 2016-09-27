/*
SQLyog Professional v12.09 (64 bit)
MySQL - 5.6.15 : Database - garant
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`garant` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `garant`;

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values ('m000000_000000_base',1474652396);

/*Table structure for table `xwp_calculation` */

DROP TABLE IF EXISTS `xwp_calculation`;

CREATE TABLE `xwp_calculation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `xtitle` (`title`),
  KEY `xdate` (`created_at`,`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `xwp_calculation` */

insert  into `xwp_calculation`(`id`,`title`,`text`,`created_at`,`updated_at`) values (2,'Новый отчет','demis \r\n4 \r\nlala-}blab{la ! =)) \r\n:( \r\n{457}7775         {-1.000001 } \r\n32 \r\n{+98} \r\n{2}           {+3.14}  {12637} 9812 {89123789} \r\n1 \r\nO   O1         01 \r\n1O \r\n1}OO \r\n{zer}o! \r\n{df1000 ggg... \r\n{5-} \r\n105} \r\n{-2010} \r\nwass{auupp!! ','2016-09-23 22:33:26','2016-09-23 22:50:13'),(3,'Новый отчет 2','<<<demis \r\n4 \r\nlala-}blab{la ! =)) \r\n:( \r\n{14459} {-1000001 } \r\n{7775}','2016-09-23 22:54:18','2016-09-23 22:54:18'),(4,'Пинтагон взломан!','1O \r\n1}OO \r\n{zer}o! \r\n{df1000 ggg... \r\n{-59663} \r\n105} \r\n{-663} \r\nwass{auupp!! ','2016-09-23 23:07:56','2016-09-23 23:07:56');

/*Table structure for table `xwp_calculation_code` */

DROP TABLE IF EXISTS `xwp_calculation_code`;

CREATE TABLE `xwp_calculation_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calculation_id` int(11) DEFAULT NULL,
  `code` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `xmix` (`calculation_id`,`code`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `xwp_calculation_code` */

insert  into `xwp_calculation_code`(`id`,`calculation_id`,`code`) values (18,2,'-2010'),(15,2,'2'),(14,2,'98'),(13,2,'457'),(16,2,'12637'),(17,2,'89123789'),(20,3,'7775'),(19,3,'14459'),(21,4,'-59663'),(22,4,'-663');

/*Table structure for table `xwp_migration` */

DROP TABLE IF EXISTS `xwp_migration`;

CREATE TABLE `xwp_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `xwp_migration` */

insert  into `xwp_migration`(`version`,`apply_time`) values ('m000000_000000_base',1474653405),('m160923_171816_setStructure_tables',1474658950);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
