-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: pset7
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `Portfolios`
--

DROP TABLE IF EXISTS `Portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Portfolios` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `symbol` varchar(20) NOT NULL,
  `shares` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Portfolios`
--

LOCK TABLES `Portfolios` WRITE;
/*!40000 ALTER TABLE `Portfolios` DISABLE KEYS */;
INSERT INTO `Portfolios` VALUES (1,7,'AAPL',12),(2,3,'AAPL',12),(3,1,'AAPL',122),(4,12,'LMT',16),(5,12,'LUV',9),(6,12,'TSLA',11),(9,13,'DIS',2147483647),(10,14,'ARC',1),(11,14,'NPD',1),(12,14,'XXXXXX',1),(13,14,'XXXXXXXX',9996),(14,14,'XXXXXXXXX',11),(15,14,'XXXXXXXXXX',1),(16,14,'XXXXXXX',1),(17,14,'XXXXX',1);
/*!40000 ALTER TABLE `Portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Transaction_History`
--

DROP TABLE IF EXISTS `Transaction_History`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Transaction_History` (
  `Transaction_Num` int(255) NOT NULL AUTO_INCREMENT,
  `User_ID` int(255) NOT NULL,
  `Symbol` varchar(25) NOT NULL,
  `Number_Shares` int(255) NOT NULL,
  `Share_Price` decimal(60,2) NOT NULL,
  `Buy_Sell` varchar(15) NOT NULL,
  `Date_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Transaction_Num`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Transaction_History`
--

LOCK TABLES `Transaction_History` WRITE;
/*!40000 ALTER TABLE `Transaction_History` DISABLE KEYS */;
INSERT INTO `Transaction_History` VALUES (1,12,'LMT',1,232.00,'Sell','2016-10-25 06:52:24'),(2,12,'LMT',2,232.00,'Buy','2016-10-25 07:17:10'),(3,12,'TSLA',12,203.00,'Buy','2016-10-25 07:18:06'),(4,12,'TSLA',1,203.00,'Sell','2016-10-25 07:18:21'),(5,12,'LMT',1,249.26,'Buy','2016-10-26 03:56:53'),(6,13,'DIS',1,92.75,'Buy','2016-10-26 05:05:45'),(7,13,'DIS',1,92.75,'Sell','2016-10-26 05:06:19'),(8,13,'DIS',1,92.75,'Buy','2016-10-26 05:06:54'),(9,13,'DIS',1,92.75,'Sell','2016-10-26 05:06:59'),(10,13,'DIS',1000000,92.75,'Buy','2016-10-26 05:10:09'),(11,13,'DIS',2147483647,92.75,'Buy','2016-10-26 05:10:40'),(12,14,'ARC',1,3.49,'Buy','2016-10-26 05:15:02'),(13,14,'NPD',1,2.55,'Buy','2016-10-26 05:15:18'),(14,14,'XXXXXX',1,0.00,'Buy','2016-10-26 05:15:25'),(15,14,'XXXXXXXX',9996,0.00,'Buy','2016-10-26 05:15:40'),(16,14,'XXXXXXXXX',11,0.00,'Buy','2016-10-26 05:17:23'),(17,14,'XXXXXXXXXX',1,0.00,'Buy','2016-10-26 05:17:37'),(18,14,'XXXXXXX',1,0.00,'Buy','2016-10-26 05:18:14'),(19,14,'XXXXX',1,0.00,'Buy','2016-10-26 05:18:31'),(20,14,'REI',1,10.79,'Buy','2016-10-26 05:19:11'),(21,14,'REI',1,10.79,'Sell','2016-10-26 05:19:27'),(22,14,'CASH',11,1.00,'Add_F','2016-10-26 05:27:02'),(23,14,'CASH',11,1.00,'Add Funds','2016-10-26 05:28:28'),(24,12,'CASH',1,1.00,'Add Funds','2016-10-26 05:36:39'),(25,12,'AAPL',1,118.25,'Buy','2016-10-26 05:41:26'),(26,12,'AAPL',1,118.25,'Sell','2016-10-26 05:41:36'),(27,12,'LMT',1,249.26,'Buy','2016-10-26 05:43:58');
/*!40000 ALTER TABLE `Transaction_History` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `cash` decimal(65,4) unsigned NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'andi','$2y$10$c.e4DK7pVyLT.stmHxgAleWq4yViMmkwKz3x8XCo4b/u3r8g5OTnS',10000.0000),(2,'caesar','$2y$10$0p2dlmu6HnhzEMf9UaUIfuaQP7tFVDMxgFcVs0irhGqhOxt6hJFaa',10000.0000),(3,'eli','$2y$10$COO6EnTVrCPCEddZyWeEJeH9qPCwPkCS0jJpusNiru.XpRN6Jf7HW',10000.0000),(4,'hdan','$2y$10$o9a4ZoHqVkVHSno6j.k34.wC.qzgeQTBHiwa3rpnLq7j2PlPJHo1G',10000.0000),(5,'jason','$2y$10$ci2zwcWLJmSSqyhCnHKUF.AjoysFMvlIb1w4zfmCS7/WaOrmBnLNe',10000.0000),(6,'john','$2y$10$dy.LVhWgoxIQHAgfCStWietGdJCPjnNrxKNRs5twGcMrQvAPPIxSy',10000.0000),(7,'levatich','$2y$10$fBfk7L/QFiplffZdo6etM.096pt4Oyz2imLSp5s8HUAykdLXaz6MK',10000.0000),(8,'rob','$2y$10$3pRWcBbGdAdzdDiVVybKSeFq6C50g80zyPRAxcsh2t5UnwAkG.I.2',10000.0000),(9,'skroob','$2y$10$395b7wODm.o2N7W5UZSXXuXwrC0OtFB17w4VjPnCIn/nvv9e4XUQK',10000.0000),(10,'zamyla','$2y$10$UOaRF0LGOaeHG4oaEkfO4O7vfI34B1W23WqHr9zCpXL68hfQsS3/e',10000.0000),(12,'jshales','$2y$10$H8tQh8vpJG8op4KJ9dJl7eVS9af4M4MpBNaf7CePxKWJZ72rjrbVG',15438.9000),(13,'TESTER','$2y$10$gmZ6VuOIzI8rl0GbZ4/OoudWRS53m10bFDUfpG9lLcig80mtcY6EK',0.0000),(14,'TESTER2','$2y$10$wy.UojBsGMnMaL6B.NE5de0SSdIqAYvZmGhuHN2BFxaFwxVg74p56',32373.0600);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-26  5:48:07
