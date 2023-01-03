/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 8.0.31 : Database - phpdomaci
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`phpdomaci` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `phpdomaci`;

/*Table structure for table `articles` */

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `naziv` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `marka` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cena` int NOT NULL,
  `velicina` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `articles` */

insert  into `articles`(`id`,`naziv`,`marka`,`cena`,`velicina`) values 
(1,'Muška parka sa kapuljačom','Tommy Hilfinger',41592,'XL,L,M'),
(2,'Zimske cizme','Timberland',16000,'46,47,48'),
(3,'Kožne cipele','Asos',23000,'45,48'),
(4,'Chukka cipele','Asos',17000,'44,45,43'),
(5,'Crna kapa','Collusion',5000,'M,L'),
(6,'Kick Hi patike','Kickers',13599,'44,45,46'),
(7,'Maslinasta kozna jakna','Topman',16999,'L,XL,XXL'),
(8,'Kaput','Only & sons',9000,'M,L,XL,XXL');

/*Table structure for table `basket` */

DROP TABLE IF EXISTS `basket`;

CREATE TABLE `basket` (
  `userId` int NOT NULL,
  `articleId` int NOT NULL,
  `kolicina` int NOT NULL DEFAULT '0',
  `velicina` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`userId`,`articleId`),
  KEY `article_fk` (`articleId`),
  CONSTRAINT `article_fk` FOREIGN KEY (`articleId`) REFERENCES `articles` (`id`),
  CONSTRAINT `user_fk` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `basket` */

insert  into `basket`(`userId`,`articleId`,`kolicina`,`velicina`) values 
(1,6,1,'45'),
(1,8,1,'XXL'),
(11,5,2,'M L'),
(11,6,1,'44');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ime` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `prezime` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `brojProizvoda` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`userId`,`username`,`password`,`ime`,`prezime`,`brojProizvoda`) values 
(1,'vukman','vukman','Vuk','Manojlovic',2),
(2,'marina97','marina97','Marina','Manojlovic',0),
(8,'nikola00','nikola00','Nikola','Vujicic',0),
(9,'baki00','baki','Balsa','Kretic',0),
(10,'kaca98','kaca','Katarina','Vujicic',0),
(11,'tara00','tara00','Tara','Paunovic',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
