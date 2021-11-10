-- MySQL dump 10.19  Distrib 10.3.31-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: escola
-- ------------------------------------------------------
-- Server version	10.3.31-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `listName` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lists`
--

/*!40000 ALTER TABLE `lists` DISABLE KEYS */;
INSERT INTO `lists` VALUES (1,'m8 maria',2),(2,'m7 maria',2),(3,'deures pere',1),(4,'2daw',3),(5,'m7',4),(6,'m8',5);
/*!40000 ALTER TABLE `lists` ENABLE KEYS */;

--
-- Table structure for table `taskItems`
--

DROP TABLE IF EXISTS `taskItems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taskItems` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `listId` int(11) NOT NULL,
  `completed` bit(1) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taskItems`
--

/*!40000 ALTER TABLE `taskItems` DISABLE KEYS */;
INSERT INTO `taskItems` VALUES (1,'Activitat 1',2,'\0','2021-11-05 16:26:30','2021-11-05 16:26:30'),(2,'Control M7',2,'\0','2021-11-12 16:35:18','2021-11-30 00:00:00'),(3,'Projecte',1,'','2021-11-05 16:28:46','2021-11-05 16:28:49'),(4,'Control M7',5,'\0','2021-11-05 16:30:17','2021-11-05 16:30:19'),(5,'Exercici 5',1,'','2021-11-05 16:31:24','2021-11-05 16:31:27'),(6,'M8 Activitat 1',4,'','2021-11-05 16:32:30','2021-11-05 16:32:33'),(7,'M7 Activitat 2',4,'\0','2021-11-05 16:33:02','2021-11-05 16:33:05'),(8,'Projecte',3,'\0','2021-11-05 16:34:09','2021-11-05 16:34:11'),(9,'Control M7',3,'\0','2021-11-05 16:34:55','2021-11-05 16:34:58'),(10,'Complecio UF1 M7',2,'','2021-11-05 16:35:58','2021-11-05 16:36:01');
/*!40000 ALTER TABLE `taskItems` ENABLE KEYS */;

--
-- Table structure for table `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuaris` (
  `email` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `contrasenya` varchar(100) DEFAULT NULL,
  `rol` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuaris`
--

/*!40000 ALTER TABLE `usuaris` DISABLE KEYS */;
INSERT INTO `usuaris` VALUES ('alumne1@gmail.com','pere','$2y$10$pAAlQJSho.MIeRgxp5kaVeUrWGgFbFuA2P4tJzepsGWsZMd0DMBMy','alumne',1),('alumne2@gmail.com','maria','123456','alumne',2),('marc@gmail.com','marc','0000','alumne',3),('pepe@gmail.com','pepe','0000','alumne',4),('professor1@gmail.com','rosa','123456','professor',5),('xavi@gmail.com','xavier','0000','professor',6);
/*!40000 ALTER TABLE `usuaris` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-10 11:09:01
