-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: ntra
-- ------------------------------------------------------
-- Server version  8.0.39-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ads` (
                       `id` int NOT NULL AUTO_INCREMENT,
                       `title` varchar(255) NOT NULL,
                       `description` text,
                       `user_id` int DEFAULT NULL,
                       `status_id` int DEFAULT NULL,
                       `branch_id` int DEFAULT NULL,
                       `address` varchar(255) DEFAULT NULL,
                       `price` float DEFAULT NULL,
                       `rooms` int DEFAULT NULL,
                       `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                       `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                       PRIMARY KEY (`id`),
                       KEY `user_id` (`user_id`),
                       KEY `status_id` (`status_id`),
                       KEY `branch_id` (`branch_id`),
                       CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
                       CONSTRAINT `ads_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (25,'jdiwqji','isjqisji',2,2,1,'jqiqjisjqijs',1000,20,'2024-08-22 13:08:09','2024-08-22 13:08:09'),(26,'beuquw','ctrctcr',2,2,1,'andijon',712,21,'2024-08-22 14:14:49','2024-08-22 14:14:49'),(27,'idioewjoid','rierwjoideej',2,2,1,'jirwoeji',908429000,320492,'2024-08-22 14:15:47','2024-08-22 14:15:47'),(28,'fytugihu','gyuihiu',2,2,1,'andijon',10000,45678,'2024-08-22 14:47:14','2024-08-22 14:47:14'),(29,'vhjbiuhiu','hiuhiuhiuhiuhui',2,2,1,'andijon',100,555,'2024-08-22 18:26:33','2024-08-22 18:26:33'),(30,'uy','uhduiqwhdiuqwuidhqwihdwqiuhd',2,2,1,'Toshkent',100000,50,'2024-08-24 11:04:26','2024-08-24 11:04:26'),(31,'default','tarif',2,2,1,'andijon',10000,1000,'2024-08-24 11:12:25','2024-08-24 11:12:25'),(32,'ikkinchi','idwjodijwe',2,2,1,'jisqwojoisojqw',9218390,9009,'2024-08-24 11:19:59','2024-08-24 11:19:59'),(33,'hiiuewhiudwi','ijoijdiowejd',2,2,1,'andijon',87879,0,'2024-08-24 11:58:19','2024-08-24 11:58:19');
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ads_image`
--

DROP TABLE IF EXISTS `ads_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ads_image` (
                             `id` int NOT NULL AUTO_INCREMENT,
                             `ads_id` int DEFAULT NULL,
                             `name` varchar(255) DEFAULT NULL,
                             PRIMARY KEY (`id`),
                             KEY `fk_ads_image_ads` (`ads_id`),
                             CONSTRAINT `fk_ads_image_ads` FOREIGN KEY (`ads_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads_image`
--


LOCK TABLES `ads_image` WRITE;
/*!40000 ALTER TABLE `ads_image` DISABLE KEYS */;
INSERT INTO `ads_image` VALUES (6,25,'66c7383933092__Screenshot from 2024-06-29 03-38-45.png'),(7,26,'66c747d9eb9c4__Screenshot from 2024-07-03 01-11-04.png'),(8,27,'66c7481304fb1__Screenshot from 2024-07-25 15-48-24.png'),(9,28,'66c74f724a55b__Screenshot from 2024-07-25 15-52-56.png'),(10,29,'66c782d990a81__Screenshot from 2024-07-10 12-35-53.png'),(11,30,'66c9be3a5c3a3__Screenshot from 2024-07-25 15-38-20.png'),(12,31,'default.jpg'),(13,32,'default.jpg'),(14,33,'default.jpg');
/*!40000 ALTER TABLE `ads_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branch` (
                          `id` int NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) NOT NULL,
                          `address` varchar(255) DEFAULT NULL,
                          `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                          `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES (1,'Xorazm','Toshkent','2024-08-21 16:18:08','2024-08-21 16:18:08'),(2,'Andijon','Andijon','2024-08-21 16:18:31','2024-08-21 16:18:31');
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
                         `id` int DEFAULT NULL,
                         `name` varchar(255) DEFAULT NULL,
                         KEY `idx_roles_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
                          `id` int NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) NOT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Abdulqayum'),(2,'Sher'),(3,'Abdulqayum');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
                              `user_id` int DEFAULT NULL,
                              `roles_id` int DEFAULT NULL,
                              KEY `user_roles_users_id_fk` (`user_id`),
                              KEY `idx_roles_id` (`roles_id`),
                              CONSTRAINT `user_roles_roles_id_fk` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`),
                              CONSTRAINT `user_roles_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--


DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `username` varchar(255) NOT NULL,
                         `position` varchar(255) DEFAULT NULL,
                         `gender` enum('male','female') DEFAULT NULL,
                         `password` varchar(255) DEFAULT NULL,
                         `phone` varchar(255) DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                         `updated_at` timestamp NULL DEFAULT NULL COMMENT 'timestamp',
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Abdulqayum','Developer','male',NULL,'928579989','2024-08-08 15:00:43','2024-08-08 16:01:12'),(2,'Sher','Software','male',NULL,'484848','2024-08-16 11:22:19',NULL),(4,'a.eshqoziyev@newuu.uz','Data Engineer','male',NULL,'7879879788','2024-08-22 15:56:55',NULL),(5,'a.eshqoziyev@newuu','Data Engineer','male','2024-08-23 14:55:38','87678767868',NULL,NULL),(9,'Sobirjon','Data Engineer','male','2024-08-23 14:57:46','848484845548989',NULL,NULL),(10,'Abdulqayum To\'raboyev','Data Engineer','male','2024-08-25 16:38:06','6678878',NULL,NULL);
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

-- Dump completed on 2024-08-27 11:15:37
