-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: webcourseid
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course` (
  `course_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc` text,
  `image_path` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (1,'Web Development Fundamentals','Belajar dasar-dasar pengembangan web, mulai dari HTML, CSS, hingga JavaScript.','courses/web_dev.jpg','2025-10-23 13:07:40','2025-10-23 13:07:40',NULL),(2,'Mobile App Development','Pelajari cara membangun aplikasi mobile menggunakan Flutter dan konsep dasar pemrograman mobile.','courses/app_dev.jpg','2025-10-23 13:07:40','2025-10-23 13:07:40',NULL),(3,'Data Science Basics','Pahami konsep dasar Data Science, mulai dari pengolahan data, visualisasi, hingga analisis sederhana.','courses/data_science.jpg','2025-10-23 13:07:40','2025-10-23 13:07:40',NULL),(4,'UI/UX Design Principles','Pelajari prinsip UI/UX untuk menciptakan pengalaman pengguna yang menyenangkan dan desain yang efektif.','courses/UI-UX-implementation.jpg','2025-10-23 13:07:40','2025-10-23 13:07:40',NULL),(5,'Introduction to Cybersecurity','Pengenalan dunia keamanan siber, memahami ancaman digital, dan cara menjaga keamanan data pribadi.','courses/cyber_security.jpg','2025-10-23 13:07:40','2025-10-23 13:07:40',NULL);
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_course`
--

DROP TABLE IF EXISTS `detail_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_course` (
  `detail_course_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `type` enum('PDF','Video') DEFAULT NULL,
  `path` text,
  `subcourse_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`detail_course_id`),
  KEY `subcourse_id` (`subcourse_id`),
  CONSTRAINT `detail_course_ibfk_1` FOREIGN KEY (`subcourse_id`) REFERENCES `subcourse` (`subcourse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_course`
--

LOCK TABLES `detail_course` WRITE;
/*!40000 ALTER TABLE `detail_course` DISABLE KEYS */;
INSERT INTO `detail_course` VALUES (1,'HTML & CSS Basics - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',1,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(2,'HTML & CSS Basics - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',1,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(3,'HTML & CSS Basics - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',1,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(4,'JavaScript for Beginners - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',2,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(5,'JavaScript for Beginners - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',2,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(6,'JavaScript for Beginners - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',2,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(7,'Responsive Design - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',3,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(8,'Responsive Design - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',3,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(9,'Responsive Design - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',3,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(10,'Flutter Introduction - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',4,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(11,'Flutter Introduction - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',4,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(12,'Flutter Introduction - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',4,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(13,'State Management - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',5,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(14,'State Management - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',5,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(15,'State Management - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',5,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(16,'Data Preprocessing - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',6,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(17,'Data Preprocessing - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',6,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(18,'Data Preprocessing - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',6,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(19,'Introduction to Python - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',7,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(20,'Introduction to Python - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',7,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(21,'Introduction to Python - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',7,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(22,'Figma Basics - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',8,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(23,'Figma Basics - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',8,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(24,'Figma Basics - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',8,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(25,'Wireframing & Prototyping - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',9,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(26,'Wireframing & Prototyping - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',9,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(27,'Wireframing & Prototyping - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',9,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(28,'Network Fundamentals - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',10,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(29,'Network Fundamentals - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',10,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(30,'Network Fundamentals - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',10,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(31,'Ethical Hacking Basics - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',11,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(32,'Ethical Hacking Basics - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',11,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL),(33,'Ethical Hacking Basics - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',11,'2025-10-23 14:14:47','2025-10-23 14:14:47',NULL);
/*!40000 ALTER TABLE `detail_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leaderboard`
--

DROP TABLE IF EXISTS `leaderboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leaderboard` (
  `leaderboard_id` int NOT NULL AUTO_INCREMENT,
  `urutan` int DEFAULT NULL COMMENT 'urutan 1-10',
  `user_id` int DEFAULT NULL COMMENT 'one to one',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`leaderboard_id`),
  UNIQUE KEY `urutan` (`urutan`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaderboard`
--

LOCK TABLES `leaderboard` WRITE;
/*!40000 ALTER TABLE `leaderboard` DISABLE KEYS */;
/*!40000 ALTER TABLE `leaderboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roadmap`
--

DROP TABLE IF EXISTS `roadmap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roadmap` (
  `roadmap_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`roadmap_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `roadmap_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roadmap`
--

LOCK TABLES `roadmap` WRITE;
/*!40000 ALTER TABLE `roadmap` DISABLE KEYS */;
/*!40000 ALTER TABLE `roadmap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('zhzihHwvFeB1XGGHO2QQl4zOGITEClZbYCrSKIjv',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSk9vc1VHeW9GM3VyNUlIMVI3WGN3UHNnRDl3TnUyaEFrbG5VNVdCRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb3Vyc2Uvc3ViY291cnNlL2RldGFpbHMvND9kZXRhaWw9MTAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1761318739);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcourse`
--

DROP TABLE IF EXISTS `subcourse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcourse` (
  `subcourse_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `image_path` text,
  `course_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`subcourse_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `subcourse_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcourse`
--

LOCK TABLES `subcourse` WRITE;
/*!40000 ALTER TABLE `subcourse` DISABLE KEYS */;
INSERT INTO `subcourse` VALUES (1,'HTML & CSS Basics',NULL,1,'2025-10-23 13:08:56','2025-10-23 13:08:56',NULL),(2,'JavaScript for Beginners',NULL,1,'2025-10-23 13:08:56','2025-10-23 13:08:56',NULL),(3,'Responsive Design',NULL,1,'2025-10-23 13:08:56','2025-10-23 13:08:56',NULL),(4,'Flutter Introduction',NULL,2,'2025-10-23 13:08:56','2025-10-23 13:08:56',NULL),(5,'State Management',NULL,2,'2025-10-23 13:08:56','2025-10-23 13:08:56',NULL),(6,'Data Preprocessing',NULL,3,'2025-10-23 13:08:56','2025-10-23 13:08:56',NULL),(7,'Introduction to Python',NULL,3,'2025-10-23 13:08:56','2025-10-23 13:08:56',NULL),(8,'Figma Basics',NULL,4,'2025-10-23 13:08:56','2025-10-23 13:08:56',NULL),(9,'Wireframing & Prototyping',NULL,4,'2025-10-23 13:08:56','2025-10-23 13:08:56',NULL),(10,'Network Fundamentals',NULL,5,'2025-10-23 13:08:56','2025-10-23 13:08:56',NULL),(11,'Ethical Hacking Basics',NULL,5,'2025-10-23 13:08:56','2025-10-23 13:08:56',NULL);
/*!40000 ALTER TABLE `subcourse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'HaikalRisnandar','haikal@example.com','$2y$12$ktCEQcG9yBeUno6YlH6PzO/pSk3dJEzNHb.hrdD7DpGYUAEdGLK2W','2025-10-24 05:19:12','2025-10-24 05:19:12',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_course_history`
--

DROP TABLE IF EXISTS `user_course_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_course_history` (
  `user_course_history_id` int NOT NULL AUTO_INCREMENT,
  `last_seen` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `detail_course_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_course_history_id`),
  UNIQUE KEY `unique_user_history` (`user_id`,`detail_course_id`),
  KEY `user_course_history_ibfk_2_idx` (`detail_course_id`),
  CONSTRAINT `user_course_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `user_course_history_ibfk_2` FOREIGN KEY (`detail_course_id`) REFERENCES `detail_course` (`detail_course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_course_history`
--

LOCK TABLES `user_course_history` WRITE;
/*!40000 ALTER TABLE `user_course_history` DISABLE KEYS */;
INSERT INTO `user_course_history` VALUES (1,'2025-10-24 15:10:38',1,1,'2025-10-24 08:06:15','2025-10-24 08:10:38',NULL),(2,'2025-10-24 15:08:36',1,2,'2025-10-24 08:06:38','2025-10-24 08:08:36',NULL),(3,'2025-10-24 15:10:37',1,3,'2025-10-24 08:07:42','2025-10-24 08:10:37',NULL),(4,'2025-10-24 15:12:19',1,10,'2025-10-24 08:11:05','2025-10-24 08:12:19',NULL),(5,'2025-10-24 15:11:25',1,16,'2025-10-24 08:11:17','2025-10-24 08:11:25',NULL),(6,'2025-10-24 15:11:23',1,17,'2025-10-24 08:11:23','2025-10-24 08:11:23',NULL),(7,'2025-10-24 15:12:16',1,11,'2025-10-24 08:12:16','2025-10-24 08:12:16',NULL);
/*!40000 ALTER TABLE `user_course_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_course_progress`
--

DROP TABLE IF EXISTS `user_course_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_course_progress` (
  `user_course_progress_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `detail_course_id` int NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_course_progress_id`),
  UNIQUE KEY `unique_user_detail` (`user_id`,`detail_course_id`),
  KEY `fk_detail_course` (`detail_course_id`),
  CONSTRAINT `fk_detail_course` FOREIGN KEY (`detail_course_id`) REFERENCES `detail_course` (`detail_course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_course_progress`
--

LOCK TABLES `user_course_progress` WRITE;
/*!40000 ALTER TABLE `user_course_progress` DISABLE KEYS */;
INSERT INTO `user_course_progress` VALUES (2,1,1,1,'2025-10-24 07:47:03','2025-10-24 07:47:03',NULL),(3,1,2,1,'2025-10-24 08:08:36','2025-10-24 08:08:36',NULL);
/*!40000 ALTER TABLE `user_course_progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_profile` (
  `user_profile_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `lainnya` text COMMENT 'kolom lainnya',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_profile_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roadmap`
--

DROP TABLE IF EXISTS `user_roadmap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roadmap` (
  `user_roadmap_id` int NOT NULL AUTO_INCREMENT,
  `lainnya` text COMMENT 'kolom lainnya',
  `user_id` int DEFAULT NULL,
  `roadmap_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_roadmap_id`),
  KEY `user_id` (`user_id`),
  KEY `roadmap_id` (`roadmap_id`),
  CONSTRAINT `user_roadmap_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `user_roadmap_ibfk_2` FOREIGN KEY (`roadmap_id`) REFERENCES `roadmap` (`roadmap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roadmap`
--

LOCK TABLES `user_roadmap` WRITE;
/*!40000 ALTER TABLE `user_roadmap` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_roadmap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `watchlater`
--

DROP TABLE IF EXISTS `watchlater`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `watchlater` (
  `watchlater_id` int NOT NULL AUTO_INCREMENT,
  `course_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`watchlater_id`),
  KEY `course_id` (`course_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `watchlater_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  CONSTRAINT `watchlater_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `watchlater`
--

LOCK TABLES `watchlater` WRITE;
/*!40000 ALTER TABLE `watchlater` DISABLE KEYS */;
/*!40000 ALTER TABLE `watchlater` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-24 22:17:53
