-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: webcoursedevops
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
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
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
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
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `image_path` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (1,'Web Development Fundamentals','Belajar dasar-dasar pengembangan web, mulai dari HTML, CSS, hingga JavaScript.','courses/web_dev.jpg','2025-10-23 06:07:40','2025-10-23 06:07:40',NULL),(2,'Mobile App Development','Pelajari cara membangun aplikasi mobile menggunakan Flutter dan konsep dasar pemrograman mobile.','courses/app_dev.jpg','2025-10-23 06:07:40','2025-10-23 06:07:40',NULL),(3,'Data Science Basics','Pahami konsep dasar Data Science, mulai dari pengolahan data, visualisasi, hingga analisis sederhana.','courses/data_science.jpg','2025-10-23 06:07:40','2025-10-23 06:07:40',NULL),(4,'UI/UX Design Principles','Pelajari prinsip UI/UX untuk menciptakan pengalaman pengguna yang menyenangkan dan desain yang efektif.','courses/UI-UX-implementation.jpg','2025-10-23 06:07:40','2025-10-23 06:07:40',NULL),(5,'Introduction to Cybersecurity','Pengenalan dunia keamanan siber, memahami ancaman digital, dan cara menjaga keamanan data pribadi.','courses/cyber_security.jpg','2025-10-23 06:07:40','2025-10-23 06:07:40',NULL);
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_course`
--

DROP TABLE IF EXISTS `detail_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_course` (
  `detail_course_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `type` enum('PDF','Video') DEFAULT NULL,
  `path` text DEFAULT NULL,
  `subcourse_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`detail_course_id`),
  KEY `subcourse_id` (`subcourse_id`),
  CONSTRAINT `detail_course_ibfk_1` FOREIGN KEY (`subcourse_id`) REFERENCES `subcourse` (`subcourse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_course`
--

LOCK TABLES `detail_course` WRITE;
/*!40000 ALTER TABLE `detail_course` DISABLE KEYS */;
INSERT INTO `detail_course` VALUES (1,'HTML & CSS Basics - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',1,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(2,'HTML & CSS Basics - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',1,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(3,'HTML & CSS Basics - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',1,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(4,'JavaScript for Beginners - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',2,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(5,'JavaScript for Beginners - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',2,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(6,'JavaScript for Beginners - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',2,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(7,'Responsive Design - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',3,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(8,'Responsive Design - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',3,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(9,'Responsive Design - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',3,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(10,'Flutter Introduction - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',4,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(11,'Flutter Introduction - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',4,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(12,'Flutter Introduction - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',4,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(13,'State Management - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',5,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(14,'State Management - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',5,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(15,'State Management - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',5,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(16,'Data Preprocessing - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',6,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(17,'Data Preprocessing - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',6,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(18,'Data Preprocessing - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',6,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(19,'Introduction to Python - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',7,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(20,'Introduction to Python - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',7,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(21,'Introduction to Python - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',7,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(22,'Figma Basics - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',8,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(23,'Figma Basics - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',8,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(24,'Figma Basics - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',8,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(25,'Wireframing & Prototyping - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',9,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(26,'Wireframing & Prototyping - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',9,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(27,'Wireframing & Prototyping - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',9,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(28,'Network Fundamentals - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',10,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(29,'Network Fundamentals - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',10,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(30,'Network Fundamentals - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',10,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(31,'Ethical Hacking Basics - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',11,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(32,'Ethical Hacking Basics - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',11,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL),(33,'Ethical Hacking Basics - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',11,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL);
/*!40000 ALTER TABLE `detail_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
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
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
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
  `leaderboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `urutan` int(11) DEFAULT NULL COMMENT 'urutan 1-10',
  `user_id` int(11) DEFAULT NULL COMMENT 'one to one',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`leaderboard_id`),
  UNIQUE KEY `urutan` (`urutan`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaderboard`
--

LOCK TABLES `leaderboard` WRITE;
/*!40000 ALTER TABLE `leaderboard` DISABLE KEYS */;
INSERT INTO `leaderboard` VALUES (1,1,3,'2025-11-06 11:30:00','2025-11-06 11:30:00',NULL);
/*!40000 ALTER TABLE `leaderboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
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
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
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
  `roadmap_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`roadmap_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roadmap`
--

LOCK TABLES `roadmap` WRITE;
/*!40000 ALTER TABLE `roadmap` DISABLE KEYS */;
INSERT INTO `roadmap` VALUES (1,'Front-end Developer Path','frontend-developer','Jalur ini mencakup semua dasar Web Development Fundamentals dan UI/UX Design Principles untuk antarmuka yang solid.','2025-10-30 04:59:10','2025-10-30 04:59:10',NULL),(2,'Multi-Discipline Analyst Path','multi-discipline-analyst','Mempelajari dasar-dasar Data Science, Mobile App Development, dan Cybersecurity, membentuk fondasi analisis yang kuat.','2025-10-30 04:59:45','2025-10-30 04:59:45',NULL);
/*!40000 ALTER TABLE `roadmap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roadmap_course`
--

DROP TABLE IF EXISTS `roadmap_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roadmap_course` (
  `roadmap_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`roadmap_id`,`course_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `roadmap_course_ibfk_1` FOREIGN KEY (`roadmap_id`) REFERENCES `roadmap` (`roadmap_id`) ON DELETE CASCADE,
  CONSTRAINT `roadmap_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roadmap_course`
--

LOCK TABLES `roadmap_course` WRITE;
/*!40000 ALTER TABLE `roadmap_course` DISABLE KEYS */;
INSERT INTO `roadmap_course` VALUES (1,1),(1,4);
/*!40000 ALTER TABLE `roadmap_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
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
INSERT INTO `sessions` VALUES ('fGMWf1nMXwGO7x9VBwHieuvglDSaUjDqwtRSxqW6',2,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUnprNHNXTURoYVdLdE9IZ3BKSHpRWDhFTWhyanVlNG5SajE3eVNWeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9sb2NhbGhvc3Qvcm9hZG1hcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==',1761829949),('uYk3MwyEPPyTqTERZ73YFBghYOcpj9iEuXZDH9bL',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUmljZkgxYmhuUmNOME9LUEd1Uk5LZEl1WFpBVkRvcGdTZ2Z1U2dEOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sZWFkZXJib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==',1762413915);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcourse`
--

DROP TABLE IF EXISTS `subcourse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcourse` (
  `subcourse_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `image_path` text DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`subcourse_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `subcourse_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcourse`
--

LOCK TABLES `subcourse` WRITE;
/*!40000 ALTER TABLE `subcourse` DISABLE KEYS */;
INSERT INTO `subcourse` VALUES (1,'HTML & CSS Basics',NULL,1,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL),(2,'JavaScript for Beginners',NULL,1,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL),(3,'Responsive Design',NULL,1,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL),(4,'Flutter Introduction',NULL,2,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL),(5,'State Management',NULL,2,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL),(6,'Data Preprocessing',NULL,3,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL),(7,'Introduction to Python',NULL,3,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL),(8,'Figma Basics',NULL,4,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL),(9,'Wireframing & Prototyping',NULL,4,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL),(10,'Network Fundamentals',NULL,5,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL),(11,'Ethical Hacking Basics',NULL,5,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL);
/*!40000 ALTER TABLE `subcourse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'HaikalRisnandar','haikal@example.com','$2y$12$ktCEQcG9yBeUno6YlH6PzO/pSk3dJEzNHb.hrdD7DpGYUAEdGLK2W','2025-10-23 22:19:12','2025-10-23 22:19:12',NULL),(2,'Adam','adamjames@example.com','$2y$12$S1cillSN1CfI2Vuta814DudiJ8M3lt85qbmBD74gC3T7BRS6seEr2','2025-10-30 03:35:18','2025-10-30 03:35:18',NULL),(3,'Raphael Permana Barus','raphael@email.com','$2y$12$gyq3/T6AwCfgA.bszaoxAefbwTXorgMurFlGjNAvpXDXFf6FiJchi','2025-11-05 23:46:14','2025-11-05 23:46:14',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_course_history`
--

DROP TABLE IF EXISTS `user_course_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_course_history` (
  `user_course_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `last_seen` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `detail_course_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_course_history_id`),
  UNIQUE KEY `unique_user_history` (`user_id`,`detail_course_id`),
  KEY `user_course_history_ibfk_2_idx` (`detail_course_id`),
  CONSTRAINT `user_course_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `user_course_history_ibfk_2` FOREIGN KEY (`detail_course_id`) REFERENCES `detail_course` (`detail_course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_course_history`
--

LOCK TABLES `user_course_history` WRITE;
/*!40000 ALTER TABLE `user_course_history` DISABLE KEYS */;
INSERT INTO `user_course_history` VALUES (1,'2025-10-30 12:42:27',1,1,'2025-10-24 01:06:15','2025-10-30 05:42:27',NULL),(2,'2025-10-24 15:08:36',1,2,'2025-10-24 01:06:38','2025-10-24 01:08:36',NULL),(3,'2025-10-24 15:10:37',1,3,'2025-10-24 01:07:42','2025-10-24 01:10:37',NULL),(4,'2025-10-24 15:12:19',1,10,'2025-10-24 01:11:05','2025-10-24 01:12:19',NULL),(5,'2025-10-24 15:11:25',1,16,'2025-10-24 01:11:17','2025-10-24 01:11:25',NULL),(6,'2025-10-24 15:11:23',1,17,'2025-10-24 01:11:23','2025-10-24 01:11:23',NULL),(7,'2025-10-24 15:12:16',1,11,'2025-10-24 01:12:16','2025-10-24 01:12:16',NULL),(8,'2025-11-06 18:00:00',3,12,'2025-11-06 11:00:00','2025-11-06 11:00:00',NULL),(9,'2025-11-06 17:30:00',3,11,'2025-11-06 10:30:00','2025-11-06 10:30:00',NULL),(10,'2025-11-06 16:45:00',3,10,'2025-11-06 09:45:00','2025-11-06 09:45:00',NULL);
/*!40000 ALTER TABLE `user_course_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_course_progress`
--

DROP TABLE IF EXISTS `user_course_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_course_progress` (
  `user_course_progress_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `detail_course_id` int(11) NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_course_progress_id`),
  UNIQUE KEY `unique_user_detail` (`user_id`,`detail_course_id`),
  KEY `fk_detail_course` (`detail_course_id`),
  CONSTRAINT `fk_detail_course` FOREIGN KEY (`detail_course_id`) REFERENCES `detail_course` (`detail_course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_course_progress`
--

LOCK TABLES `user_course_progress` WRITE;
/*!40000 ALTER TABLE `user_course_progress` DISABLE KEYS */;
INSERT INTO `user_course_progress` VALUES (2,1,1,1,'2025-10-24 00:47:03','2025-10-24 00:47:03',NULL),(3,1,2,1,'2025-10-24 01:08:36','2025-10-24 01:08:36',NULL),(4,3,1,1,'2025-11-06 00:00:00','2025-11-06 00:00:00',NULL),(5,3,2,1,'2025-11-06 01:00:00','2025-11-06 01:00:00',NULL),(6,3,3,1,'2025-11-06 02:00:00','2025-11-06 02:00:00',NULL),(7,3,4,1,'2025-11-06 03:00:00','2025-11-06 03:00:00',NULL),(8,3,5,1,'2025-11-06 04:00:00','2025-11-06 04:00:00',NULL),(9,3,6,1,'2025-11-06 05:00:00','2025-11-06 05:00:00',NULL),(10,3,7,1,'2025-11-06 06:00:00','2025-11-06 06:00:00',NULL),(11,3,8,1,'2025-11-06 07:00:00','2025-11-06 07:00:00',NULL),(12,3,9,1,'2025-11-06 08:00:00','2025-11-06 08:00:00',NULL),(13,3,10,1,'2025-11-06 09:00:00','2025-11-06 09:00:00',NULL),(14,3,11,1,'2025-11-06 10:00:00','2025-11-06 10:00:00',NULL),(15,3,12,1,'2025-11-06 11:00:00','2025-11-06 11:00:00',NULL);
/*!40000 ALTER TABLE `user_course_progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_profile` (
  `user_profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `lainnya` text DEFAULT NULL COMMENT 'kolom lainnya',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_profile_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
  `user_roadmap_id` int(11) NOT NULL AUTO_INCREMENT,
  `lainnya` text DEFAULT NULL COMMENT 'kolom lainnya',
  `user_id` int(11) DEFAULT NULL,
  `roadmap_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_roadmap_id`),
  KEY `user_id` (`user_id`),
  KEY `roadmap_id` (`roadmap_id`),
  CONSTRAINT `user_roadmap_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `user_roadmap_ibfk_2` FOREIGN KEY (`roadmap_id`) REFERENCES `roadmap` (`roadmap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roadmap`
--

LOCK TABLES `user_roadmap` WRITE;
/*!40000 ALTER TABLE `user_roadmap` DISABLE KEYS */;
INSERT INTO `user_roadmap` VALUES (1,NULL,2,1,'2025-10-30 05:14:48','2025-10-30 05:14:48',NULL),(2,NULL,3,1,'2025-11-05 23:50:00','2025-11-05 23:50:00',NULL),(3,NULL,3,2,'2025-11-05 23:55:00','2025-11-05 23:55:00',NULL);
/*!40000 ALTER TABLE `user_roadmap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
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
  `watchlater_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`watchlater_id`),
  KEY `course_id` (`course_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `watchlater_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  CONSTRAINT `watchlater_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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

-- Dump completed on 2025-11-06 14:37:50
