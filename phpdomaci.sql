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
(2,3,1,'45'),
(2,4,1,'43'),
(2,6,1,'45'),
(3,3,2,'45 48'),
(4,1,1,'M'),
(4,2,2,'46 47'),
(4,3,1,'48'),
(4,5,2,'M L'),
(8,6,1,'45 '),
(8,7,1,'XXL '),
(9,1,2,'M L '),
(9,5,6,'L M  M  M '),
(9,6,2,'46 45 ');

/*Table structure for table `datapayment` */

DROP TABLE IF EXISTS `datapayment`;

CREATE TABLE `datapayment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `banka` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `brojRacuna` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `transactionId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign_key` (`transactionId`),
  CONSTRAINT `foreign_key` FOREIGN KEY (`transactionId`) REFERENCES `transaction` (`transactionId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `datapayment` */

insert  into `datapayment`(`id`,`banka`,`brojRacuna`,`transactionId`) values 
(7,'Unicredit','123000000821349123',31);

/*Table structure for table `transaction` */

DROP TABLE IF EXISTS `transaction`;

CREATE TABLE `transaction` (
  `transactionId` int NOT NULL AUTO_INCREMENT,
  `adresa` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `opstina` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `brojTelefona` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `placanje` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `dostava` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `iznos` int NOT NULL,
  `userId` int NOT NULL,
  PRIMARY KEY (`transactionId`),
  KEY `user_foreign_key` (`userId`),
  CONSTRAINT `user_foreign_key` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transaction` */

insert  into `transaction`(`transactionId`,`adresa`,`opstina`,`brojTelefona`,`email`,`placanje`,`dostava`,`iznos`,`userId`) values 
(31,'Vojvode Stepe 315','Beograd','060-2313-034','taraaa@gmail.com','Platna kartica','Posta Srbije',134776,11);

/*Table structure for table `transactionarticles` */

DROP TABLE IF EXISTS `transactionarticles`;

CREATE TABLE `transactionarticles` (
  `transactionId` int NOT NULL,
  `articleId` int NOT NULL,
  `velicine` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`transactionId`,`articleId`),
  KEY `article_foreign_key` (`articleId`),
  CONSTRAINT `article_foreign_key` FOREIGN KEY (`articleId`) REFERENCES `articles` (`id`),
  CONSTRAINT `transaction_fk` FOREIGN KEY (`transactionId`) REFERENCES `transaction` (`transactionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transactionarticles` */

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`userId`,`username`,`password`,`ime`,`prezime`,`brojProizvoda`) values 
(1,'vukman','vukman','Vuk','Manojlovic',2),
(2,'marina97','marina97','Marina','Manojlovic',3),
(3,'andjela00','andjela00','Andjela','Lausevic',1),
(4,'nenad70','nenad','Nenad','Manojlovic',4),
(8,'nikola00','nikola00','Nikola','Vujicic',2),
(9,'baki00','baki','Balsa','Kretic',3),
(10,'kaca98','kaca','Katarina','Vujicic',0),
(11,'tara00','tara00','Tara','Paunovic',2),
(12,'dimitrije00','dimitrije00','Dimitrije','Jovanovic',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
