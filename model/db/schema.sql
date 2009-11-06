/*
SQLyog Community Edition- MySQL GUI v6.15
MySQL - 5.1.22-rc-community-log : Database - simplemvc_demo
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `simplemvc_demo`;

USE `simplemvc_demo`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `articles` */

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `article_id` varchar(36) NOT NULL DEFAULT '',
  `author` varchar(100) NOT NULL,
  `title` varchar(250) NOT NULL,
  `body` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_on_ms` smallint(6) NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `articles` */

insert  into `articles`(`article_id`,`author`,`title`,`body`,`created_on`,`created_on_ms`) values ('2f3b4ae4-d56f-4906-8325-519f6a230978','Max Indelicato','A Title','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis diam elit, egestas id, ultrices ut, pretium a, lacus. Suspendisse potenti. Nullam tempor dui nec felis interdum viverra. Fusce posuere tortor quis libero. Pellentesque convallis vulputate purus. Duis luctus, nulla non porttitor sodales, dui nisl fermentum augue, placerat vulputate massa orci et urna. Duis gravida tortor rhoncus neque. Nulla ipsum elit, suscipit ut, imperdiet et, consequat ac, tortor. Nullam auctor augue vel mi. Phasellus porta pellentesque dolor. Mauris malesuada, pede a lacinia mattis, mi nibh tempus pede, a imperdiet erat dui nec turpis. Nam fermentum. Donec varius diam id mi. Morbi est libero, iaculis a, elementum ac, pulvinar ut, felis. Vestibulum pharetra molestie arcu. Suspendisse vitae dui. Donec leo leo, molestie nec, volutpat et, tempus eget, risus. Sed gravida augue vel arcu. Curabitur eget velit.','2008-09-15 00:00:00',0),('8e3093fb-5e04-2164-d16d-53a5efdf54f6','John Doe','Hey Title Two','Nullam et massa ut neque vehicula condimentum. Donec pulvinar nibh sed justo. Aenean laoreet volutpat nunc. In ante. Etiam gravida varius justo. Maecenas lorem. Proin convallis, nisl id hendrerit hendrerit, ipsum dui ornare dui, in porta diam felis at magna. Praesent congue felis. Curabitur molestie augue nec sem. Suspendisse in urna. Morbi adipiscing posuere sem. Sed lacinia tortor vel neque dignissim rhoncus. Sed libero. Phasellus molestie. Pellentesque lobortis scelerisque lorem. ','2008-11-21 01:22:16',477);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
