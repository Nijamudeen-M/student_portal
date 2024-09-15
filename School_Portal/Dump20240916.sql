-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: db_school
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_class`
--

DROP TABLE IF EXISTS `tbl_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_class` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `marks` int DEFAULT NULL,
  `status` int DEFAULT '1',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_class`
--

LOCK TABLES `tbl_class` WRITE;
/*!40000 ALTER TABLE `tbl_class` DISABLE KEYS */;
INSERT INTO `tbl_class` VALUES (1,'ARIVU','TAMIL',10,0,'2024-09-14 15:29:56',NULL),(3,'NIJAM','COMPUTER',55,0,'2024-09-14 18:11:17',NULL),(4,'ANBU','HINDI',33,0,'2024-09-15 19:20:02',NULL),(5,'VEL','MATHS',33,0,'2024-09-15 19:46:20',NULL),(7,'VETRI','SOCIAL',80,1,'2024-09-15 23:51:00',NULL),(8,'SELVI','TAMIL',66,1,'2024-09-16 00:50:17',NULL),(9,'AATHI SS','SCIENCE',98,0,'2024-09-16 01:00:15',NULL),(10,'SAM','COMPUTER',66,1,'2024-09-16 01:07:35',NULL);
/*!40000 ALTER TABLE `tbl_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(145) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `status` int DEFAULT '1',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (2,'nijam','$2y$10$VkwDov/wMAua3tNSU19SneRk1dWKYXwvwJg.6uLeB4G9s73Ii0B4y',1,'2024-09-15 16:16:49',NULL),(4,'nijam2','$2y$10$Lq/DdmkTEe/s37/YgMBP6uU/SEvQgPIAiLhCT2SjzSGraVMLf6NQC',1,'2024-09-15 19:20:41',NULL),(5,'demo','$2y$10$5FirgAlOxSEB5I3H8c247OzytOBuqj9PYcJh77Rz5FsSvILu/V0JK',1,'2024-09-15 22:28:36',NULL),(7,'abcd','$2y$10$mVd1Efl4JQuSGXk7r1wulub7UQN13/dUPg7xboGd7xKgpnF6Phg5u',1,'2024-09-15 23:46:19',NULL),(8,'admin1','$2y$10$CUFndrX1brirEX/Q/SSeRuOCSmRPf2o.ENZ1vRK2UQl4eVzcv4o5y',1,'2024-09-15 23:47:19',NULL),(9,'aaa','$2y$10$dqqHlVq0E6PqZu0ZGkPcUuCPe8vTUHUYYP8sWzp2iiHM4oYtSHdbK',1,'2024-09-16 00:49:22',NULL);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-16  1:21:22
