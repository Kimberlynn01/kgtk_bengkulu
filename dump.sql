-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
--
-- Host: localhost    Database: kgtk_bengkulu
-- ------------------------------------------------------
-- Server version	8.0.46-0ubuntu0.22.04.3

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
-- Table structure for table `actions`
--

DROP TABLE IF EXISTS `actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actions`
--

LOCK TABLES `actions` WRITE;
/*!40000 ALTER TABLE `actions` DISABLE KEYS */;
INSERT INTO `actions` VALUES (1,'view','2026-06-16 20:29:33','2026-06-16 20:29:33'),(2,'create','2026-06-16 20:29:33','2026-06-16 20:29:33'),(3,'update','2026-06-16 20:29:33','2026-06-16 20:29:33'),(4,'delete','2026-06-16 20:29:33','2026-06-16 20:29:33'),(5,'download','2026-06-16 20:29:33','2026-06-16 20:29:33');
/*!40000 ALTER TABLE `actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artikel_images`
--

DROP TABLE IF EXISTS `artikel_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artikel_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `artikel_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `artikel_images_artikel_id_foreign` (`artikel_id`),
  CONSTRAINT `artikel_images_artikel_id_foreign` FOREIGN KEY (`artikel_id`) REFERENCES `artikels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artikel_images`
--

LOCK TABLES `artikel_images` WRITE;
/*!40000 ALTER TABLE `artikel_images` DISABLE KEYS */;
INSERT INTO `artikel_images` VALUES (1,1,'artikels/EuJHtc7cOcnxZ3ef9cVpIDDR6BMnmnmcUMSVdIyz.png','2026-06-20 16:59:47','2026-06-20 16:59:47'),(3,2,'artikels/rhaM1xBXihNv6TzUEBbspKskH1tP2YsaKec7oBWi.png','2026-06-20 22:50:02','2026-06-20 22:50:02'),(4,2,'artikels/QOMP9yyIlivJQjuIClpq8XRPOmCjtkelELoOium6.png','2026-06-20 22:50:02','2026-06-20 22:50:02'),(5,2,'artikels/M50yY9o1YMaaGAMXJBP2P6xiV7iiA6InlEFzeBth.png','2026-06-20 22:50:02','2026-06-20 22:50:02');
/*!40000 ALTER TABLE `artikel_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artikels`
--

DROP TABLE IF EXISTS `artikels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artikels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `artikels_slug_unique` (`slug`),
  KEY `artikels_date_index` (`date`),
  KEY `artikels_title_index` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artikels`
--

LOCK TABLES `artikels` WRITE;
/*!40000 ALTER TABLE `artikels` DISABLE KEYS */;
INSERT INTO `artikels` VALUES (1,'2026-06-20','testing','testing','<p>adadada</p>','2026-06-20 16:59:47','2026-06-20 16:59:47'),(2,'2026-06-21','dada','dada','<p>dada</p>','2026-06-20 22:50:02','2026-06-20 22:50:02');
/*!40000 ALTER TABLE `artikels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audits`
--

DROP TABLE IF EXISTS `audits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_user_type_user_id_index` (`user_type`,`user_id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audits`
--

LOCK TABLES `audits` WRITE;
/*!40000 ALTER TABLE `audits` DISABLE KEYS */;
/*!40000 ALTER TABLE `audits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `berita_images`
--

DROP TABLE IF EXISTS `berita_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `berita_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `berita_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `berita_images_berita_id_foreign` (`berita_id`),
  CONSTRAINT `berita_images_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `beritas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berita_images`
--

LOCK TABLES `berita_images` WRITE;
/*!40000 ALTER TABLE `berita_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `berita_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beritas`
--

DROP TABLE IF EXISTS `beritas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `beritas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beritas_slug_unique` (`slug`),
  KEY `beritas_date_index` (`date`),
  KEY `beritas_title_index` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beritas`
--

LOCK TABLES `beritas` WRITE;
/*!40000 ALTER TABLE `beritas` DISABLE KEYS */;
/*!40000 ALTER TABLE `beritas` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `hasil_surveys`
--

DROP TABLE IF EXISTS `hasil_surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hasil_surveys` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hasil_surveys`
--

LOCK TABLES `hasil_surveys` WRITE;
/*!40000 ALTER TABLE `hasil_surveys` DISABLE KEYS */;
/*!40000 ALTER TABLE `hasil_surveys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `informasi_program_files`
--

DROP TABLE IF EXISTS `informasi_program_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `informasi_program_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `informasi_program_id` bigint unsigned NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `informasi_program_files_informasi_program_id_foreign` (`informasi_program_id`),
  CONSTRAINT `informasi_program_files_informasi_program_id_foreign` FOREIGN KEY (`informasi_program_id`) REFERENCES `informasi_programs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `informasi_program_files`
--

LOCK TABLES `informasi_program_files` WRITE;
/*!40000 ALTER TABLE `informasi_program_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `informasi_program_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `informasi_programs`
--

DROP TABLE IF EXISTS `informasi_programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `informasi_programs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `informasi_programs`
--

LOCK TABLES `informasi_programs` WRITE;
/*!40000 ALTER TABLE `informasi_programs` DISABLE KEYS */;
/*!40000 ALTER TABLE `informasi_programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `janji_maklumat_images`
--

DROP TABLE IF EXISTS `janji_maklumat_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `janji_maklumat_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `janji_maklumat_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `janji_maklumat_images_janji_maklumat_id_foreign` (`janji_maklumat_id`),
  CONSTRAINT `janji_maklumat_images_janji_maklumat_id_foreign` FOREIGN KEY (`janji_maklumat_id`) REFERENCES `janji_maklumats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `janji_maklumat_images`
--

LOCK TABLES `janji_maklumat_images` WRITE;
/*!40000 ALTER TABLE `janji_maklumat_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `janji_maklumat_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `janji_maklumats`
--

DROP TABLE IF EXISTS `janji_maklumats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `janji_maklumats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `janji_maklumats`
--

LOCK TABLES `janji_maklumats` WRITE;
/*!40000 ALTER TABLE `janji_maklumats` DISABLE KEYS */;
/*!40000 ALTER TABLE `janji_maklumats` ENABLE KEYS */;
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
-- Table structure for table `kemitraan_files`
--

DROP TABLE IF EXISTS `kemitraan_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kemitraan_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kemitraan_id` bigint unsigned NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kemitraan_files_kemitraan_id_foreign` (`kemitraan_id`),
  CONSTRAINT `kemitraan_files_kemitraan_id_foreign` FOREIGN KEY (`kemitraan_id`) REFERENCES `kemitraans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kemitraan_files`
--

LOCK TABLES `kemitraan_files` WRITE;
/*!40000 ALTER TABLE `kemitraan_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `kemitraan_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kemitraans`
--

DROP TABLE IF EXISTS `kemitraans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kemitraans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kemitraans`
--

LOCK TABLES `kemitraans` WRITE;
/*!40000 ALTER TABLE `kemitraans` DISABLE KEYS */;
/*!40000 ALTER TABLE `kemitraans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_groups`
--

DROP TABLE IF EXISTS `menu_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_groups`
--

LOCK TABLES `menu_groups` WRITE;
/*!40000 ALTER TABLE `menu_groups` DISABLE KEYS */;
INSERT INTO `menu_groups` VALUES (1,'Beranda','2026-06-16 20:29:33','2026-06-16 20:29:33',NULL),(2,'Page Profil','2026-06-16 20:29:33','2026-06-16 20:29:33',NULL),(3,'Layanan Page','2026-06-16 20:29:33','2026-06-16 20:29:33',NULL),(4,'Publikasi','2026-06-16 20:29:33','2026-06-16 20:29:33',NULL),(5,'Manajemen','2026-06-16 20:29:33','2026-06-16 20:29:33',NULL);
/*!40000 ALTER TABLE `menu_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_role`
--

DROP TABLE IF EXISTS `menu_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_role` (
  `menu_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int unsigned NOT NULL,
  `action_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_role`
--

LOCK TABLES `menu_role` WRITE;
/*!40000 ALTER TABLE `menu_role` DISABLE KEYS */;
INSERT INTO `menu_role` VALUES ('019ed3a0-87e9-7099-b555-3bb1b2c8e4be',1,1,NULL,NULL),('019ed3a0-87e9-7099-b555-3bb1b2c8e4be',1,2,NULL,NULL),('019ed3a0-87e9-7099-b555-3bb1b2c8e4be',1,3,NULL,NULL),('019ed3a0-87e9-7099-b555-3bb1b2c8e4be',1,4,NULL,NULL),('019ed3a0-87e9-7099-b555-3bb1b2c8e4be',1,5,NULL,NULL),('019ed3a0-87ec-709f-acc4-6f4b3bd674c5',1,1,NULL,NULL),('019ed3a0-87ec-709f-acc4-6f4b3bd674c5',1,2,NULL,NULL),('019ed3a0-87ec-709f-acc4-6f4b3bd674c5',1,3,NULL,NULL),('019ed3a0-87ec-709f-acc4-6f4b3bd674c5',1,4,NULL,NULL),('019ed3a0-87ec-709f-acc4-6f4b3bd674c5',1,5,NULL,NULL),('019ed3a0-87ef-714f-b40d-22f2755c10a7',1,1,NULL,NULL),('019ed3a0-87ef-714f-b40d-22f2755c10a7',1,2,NULL,NULL),('019ed3a0-87ef-714f-b40d-22f2755c10a7',1,3,NULL,NULL),('019ed3a0-87ef-714f-b40d-22f2755c10a7',1,4,NULL,NULL),('019ed3a0-87ef-714f-b40d-22f2755c10a7',1,5,NULL,NULL),('019ed3a0-87f1-71fd-93d9-bf1765260f03',1,1,NULL,NULL),('019ed3a0-87f1-71fd-93d9-bf1765260f03',1,2,NULL,NULL),('019ed3a0-87f1-71fd-93d9-bf1765260f03',1,3,NULL,NULL),('019ed3a0-87f1-71fd-93d9-bf1765260f03',1,4,NULL,NULL),('019ed3a0-87f1-71fd-93d9-bf1765260f03',1,5,NULL,NULL),('019ed3a0-87f3-70d7-b965-4a505d79e10b',1,1,NULL,NULL),('019ed3a0-87f3-70d7-b965-4a505d79e10b',1,2,NULL,NULL),('019ed3a0-87f3-70d7-b965-4a505d79e10b',1,3,NULL,NULL),('019ed3a0-87f3-70d7-b965-4a505d79e10b',1,4,NULL,NULL),('019ed3a0-87f3-70d7-b965-4a505d79e10b',1,5,NULL,NULL),('019ed3a0-87f4-72a0-ad67-56c4b367b860',1,1,NULL,NULL),('019ed3a0-87f4-72a0-ad67-56c4b367b860',1,2,NULL,NULL),('019ed3a0-87f4-72a0-ad67-56c4b367b860',1,3,NULL,NULL),('019ed3a0-87f4-72a0-ad67-56c4b367b860',1,4,NULL,NULL),('019ed3a0-87f4-72a0-ad67-56c4b367b860',1,5,NULL,NULL),('019ed3a0-87f7-72d5-8efe-03ff4bcda319',1,1,NULL,NULL),('019ed3a0-87f7-72d5-8efe-03ff4bcda319',1,2,NULL,NULL),('019ed3a0-87f7-72d5-8efe-03ff4bcda319',1,3,NULL,NULL),('019ed3a0-87f7-72d5-8efe-03ff4bcda319',1,4,NULL,NULL),('019ed3a0-87f7-72d5-8efe-03ff4bcda319',1,5,NULL,NULL),('019ed3a0-87f8-7160-93b4-134c1aea237a',1,1,NULL,NULL),('019ed3a0-87f8-7160-93b4-134c1aea237a',1,2,NULL,NULL),('019ed3a0-87f8-7160-93b4-134c1aea237a',1,3,NULL,NULL),('019ed3a0-87f8-7160-93b4-134c1aea237a',1,4,NULL,NULL),('019ed3a0-87f8-7160-93b4-134c1aea237a',1,5,NULL,NULL),('019ed3a0-87fa-70ba-a226-e9dfa92dbb00',1,1,NULL,NULL),('019ed3a0-87fa-70ba-a226-e9dfa92dbb00',1,2,NULL,NULL),('019ed3a0-87fa-70ba-a226-e9dfa92dbb00',1,3,NULL,NULL),('019ed3a0-87fa-70ba-a226-e9dfa92dbb00',1,4,NULL,NULL),('019ed3a0-87fa-70ba-a226-e9dfa92dbb00',1,5,NULL,NULL),('019ed3a0-87fc-73e5-bae8-a256691a4510',1,1,NULL,NULL),('019ed3a0-87fc-73e5-bae8-a256691a4510',1,2,NULL,NULL),('019ed3a0-87fc-73e5-bae8-a256691a4510',1,3,NULL,NULL),('019ed3a0-87fc-73e5-bae8-a256691a4510',1,4,NULL,NULL),('019ed3a0-87fc-73e5-bae8-a256691a4510',1,5,NULL,NULL),('019ed3a0-87fd-7096-9149-d24610bf117b',1,1,NULL,NULL),('019ed3a0-87fd-7096-9149-d24610bf117b',1,2,NULL,NULL),('019ed3a0-87fd-7096-9149-d24610bf117b',1,3,NULL,NULL),('019ed3a0-87fd-7096-9149-d24610bf117b',1,4,NULL,NULL),('019ed3a0-87fd-7096-9149-d24610bf117b',1,5,NULL,NULL),('019ed3a0-87ff-7313-a75d-0f0ad1da1959',1,1,NULL,NULL),('019ed3a0-87ff-7313-a75d-0f0ad1da1959',1,2,NULL,NULL),('019ed3a0-87ff-7313-a75d-0f0ad1da1959',1,3,NULL,NULL),('019ed3a0-87ff-7313-a75d-0f0ad1da1959',1,4,NULL,NULL),('019ed3a0-87ff-7313-a75d-0f0ad1da1959',1,5,NULL,NULL),('019ed3a0-8801-70c5-9b02-cc4690ab93d8',1,1,NULL,NULL),('019ed3a0-8801-70c5-9b02-cc4690ab93d8',1,2,NULL,NULL),('019ed3a0-8801-70c5-9b02-cc4690ab93d8',1,3,NULL,NULL),('019ed3a0-8801-70c5-9b02-cc4690ab93d8',1,4,NULL,NULL),('019ed3a0-8801-70c5-9b02-cc4690ab93d8',1,5,NULL,NULL),('019ed3a0-8803-70e6-887e-48ee2e98fe18',1,1,NULL,NULL),('019ed3a0-8803-70e6-887e-48ee2e98fe18',1,2,NULL,NULL),('019ed3a0-8803-70e6-887e-48ee2e98fe18',1,3,NULL,NULL),('019ed3a0-8803-70e6-887e-48ee2e98fe18',1,4,NULL,NULL),('019ed3a0-8803-70e6-887e-48ee2e98fe18',1,5,NULL,NULL),('019ed3a0-8805-73c3-9dd0-b5e17ae34793',1,1,NULL,NULL),('019ed3a0-8805-73c3-9dd0-b5e17ae34793',1,2,NULL,NULL),('019ed3a0-8805-73c3-9dd0-b5e17ae34793',1,3,NULL,NULL),('019ed3a0-8805-73c3-9dd0-b5e17ae34793',1,4,NULL,NULL),('019ed3a0-8805-73c3-9dd0-b5e17ae34793',1,5,NULL,NULL),('019ed3a0-8807-707a-8ec0-0ff654469f98',1,1,NULL,NULL),('019ed3a0-8807-707a-8ec0-0ff654469f98',1,2,NULL,NULL),('019ed3a0-8807-707a-8ec0-0ff654469f98',1,3,NULL,NULL),('019ed3a0-8807-707a-8ec0-0ff654469f98',1,4,NULL,NULL),('019ed3a0-8807-707a-8ec0-0ff654469f98',1,5,NULL,NULL),('019ed3a0-8809-7018-91ab-07a3d494b16d',1,1,NULL,NULL),('019ed3a0-8809-7018-91ab-07a3d494b16d',1,2,NULL,NULL),('019ed3a0-8809-7018-91ab-07a3d494b16d',1,3,NULL,NULL),('019ed3a0-8809-7018-91ab-07a3d494b16d',1,4,NULL,NULL),('019ed3a0-8809-7018-91ab-07a3d494b16d',1,5,NULL,NULL),('019ed3a0-87e9-7099-b555-3bb1b2c8e4be',2,1,NULL,NULL),('019ed3a0-87e9-7099-b555-3bb1b2c8e4be',2,2,NULL,NULL),('019ed3a0-87e9-7099-b555-3bb1b2c8e4be',2,3,NULL,NULL),('019ed3a0-87e9-7099-b555-3bb1b2c8e4be',2,4,NULL,NULL),('019ed3a0-87e9-7099-b555-3bb1b2c8e4be',2,5,NULL,NULL),('019ed3a0-87f1-71fd-93d9-bf1765260f03',2,1,NULL,NULL),('019ed3a0-87f1-71fd-93d9-bf1765260f03',2,2,NULL,NULL),('019ed3a0-87f1-71fd-93d9-bf1765260f03',2,3,NULL,NULL),('019ed3a0-87f1-71fd-93d9-bf1765260f03',2,4,NULL,NULL),('019ed3a0-87f1-71fd-93d9-bf1765260f03',2,5,NULL,NULL);
/*!40000 ALTER TABLE `menu_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_group_id` int unsigned DEFAULT NULL,
  `parent_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_order` int unsigned DEFAULT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES ('019f1294-2fac-71ca-8db7-9a915982773c',1,NULL,'Beranda','beranda',1,'dashboard','icofont icofont-ui-home',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fb5-71ab-ac9e-be5b039ddea3',5,NULL,'Pengguna','pengguna',2,'users','icofont icofont-ui-user-group',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fb7-70a8-ba6f-edd8d3f49510',5,NULL,'Otoritas','otoritas',4,'otoritas','icofont icofont-shield-alt',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fba-7051-b66f-113ea626fd3b',1,NULL,'Profil','profil',5,'profil','icofont icofont-ui-user',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fbc-7373-a6bc-5e0c12d52693',2,NULL,'Visi dan Misi','visi_misi',1,'visi_misi','icofont icofont-paper-plane',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fbe-7282-b2fc-ff5092a0aea3',2,NULL,'Tugas dan Fungsi','tugas_fungsi',2,'tugas_fungsi','icofont icofont-tasks-alt',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fc1-737a-b73e-cc88643718b6',2,NULL,'Tim Kerja','tim_kerja',3,'tim_kerja','icofont icofont-users-alt-2',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fc4-709b-9241-e3a1d39726e7',2,NULL,'Janji & Maklumat Layanan','janji_maklumat',4,'janji_maklumat','icofont icofont-certificate-alt-1',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fc7-72fc-812c-89e3f569c26d',2,NULL,'Profil Pejabat Struktural','profil_pejabat',5,'profil_pejabat','icofont icofont-users-social',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fc9-7279-a690-a70d2dbb8f23',3,NULL,'Informasi & Program','informasi_program',1,'informasi_program','icofont icofont-info-square',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fcb-7363-9607-1de1a826140e',3,NULL,'Kemitraan','kemitraan',2,'kemitraan','icofont icofont-handshake-deal',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fcd-7225-b419-f265c8e0c385',3,NULL,'QnA','qna',3,'qna','icofont icofont-chat',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fcf-7245-961d-04b8fbbeaefc',4,NULL,'Publikasi Artikel','artikel',1,'artikel','icofont icofont-read-book-alt',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fd1-72d4-b07c-921c99b35b70',4,NULL,'Berita','berita',2,'berita','icofont icofont-news',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fd3-73f5-905b-ae21df95162a',4,NULL,'Survey Kepuasan (SKM)','skm',3,'skm','icofont icofont-listing-box',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fd5-728b-b96e-53e5a4076e78',4,NULL,'Hasil Survey SKM','hasil_survey',4,'hasil_survey','icofont icofont-chart-histogram-alt',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL),('019f1294-2fd6-7351-ab34-b0ccee5e6a71',5,NULL,'Manajemen Menu','manajemen_menu',2,'manajemen-menu','icofont icofont-navigation-menu',1,'2026-06-29 08:52:09','2026-06-29 08:52:09',NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_09_17_034613_create_roles_table',1),(5,'2024_09_17_034639_create_actions_table',1),(6,'2024_09_17_034716_create_user_role_table',1),(7,'2024_09_17_035033_create_menu_groups_table',1),(8,'2024_09_17_035057_create_menus_table',1),(9,'2024_09_17_035349_create_menu_role_table',1),(10,'2024_09_17_043523_create_audits_table',1),(11,'2025_03_26_032232_create_profil_table',1),(12,'2026_04_17_032754_create_beritas_table',1),(13,'2026_04_17_032755_create_artikels_table',1),(14,'2026_04_17_032756_create_artikel_images_table',1),(15,'2026_04_17_032756_create_berita_images_table',1),(16,'2026_04_17_032756_create_hasil_surveys_table',1),(17,'2026_04_17_032756_create_skms_table',1),(18,'2026_04_17_032814_create_informasi_programs_table',1),(19,'2026_04_17_032814_create_janji_maklumats_table',1),(20,'2026_04_17_032814_create_kemitraans_table',1),(21,'2026_04_17_032814_create_profil_pejabats_table',1),(22,'2026_04_17_032814_create_tim_kerjas_table',1),(23,'2026_04_17_032814_create_visi_misis_table',1),(24,'2026_04_17_032815_create_visi_misi_images_table',1),(25,'2026_04_17_032816_create_janji_maklumat_images_table',1),(26,'2026_04_17_032816_create_profil_pejabat_images_table',1),(27,'2026_04_17_032816_create_tim_kerja_images_table',1),(28,'2026_04_17_032816_create_tugas_fungsis_table',1),(29,'2026_04_17_032817_create_informasi_program_files_table',1),(30,'2026_04_17_032817_create_kemitraan_files_table',1),(31,'2026_04_18_051946_create_qnas_table',1),(32,'2026_05_03_161106_create_personal_access_tokens_table',2),(33,'2026_06_24_103943_add_answered_at_to_qnas_table',3);
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profil`
--

DROP TABLE IF EXISTS `profil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profil` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `profil_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profil`
--

LOCK TABLES `profil` WRITE;
/*!40000 ALTER TABLE `profil` DISABLE KEYS */;
/*!40000 ALTER TABLE `profil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profil_pejabat_images`
--

DROP TABLE IF EXISTS `profil_pejabat_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profil_pejabat_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `profil_pejabat_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profil_pejabat_images_profil_pejabat_id_foreign` (`profil_pejabat_id`),
  CONSTRAINT `profil_pejabat_images_profil_pejabat_id_foreign` FOREIGN KEY (`profil_pejabat_id`) REFERENCES `profil_pejabats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profil_pejabat_images`
--

LOCK TABLES `profil_pejabat_images` WRITE;
/*!40000 ALTER TABLE `profil_pejabat_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `profil_pejabat_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profil_pejabats`
--

DROP TABLE IF EXISTS `profil_pejabats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profil_pejabats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profil_pejabats`
--

LOCK TABLES `profil_pejabats` WRITE;
/*!40000 ALTER TABLE `profil_pejabats` DISABLE KEYS */;
/*!40000 ALTER TABLE `profil_pejabats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qnas`
--

DROP TABLE IF EXISTS `qnas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qnas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('ppg','bcks','pkgbk','pkgsd mbi','stem','pm/kka','ukkj','gpk mahir','bcps','sekolah model') COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `answered_at` timestamp NULL DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qnas_user_id_foreign` (`user_id`),
  CONSTRAINT `qnas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qnas`
--

LOCK TABLES `qnas` WRITE;
/*!40000 ALTER TABLE `qnas` DISABLE KEYS */;
INSERT INTO `qnas` VALUES (8,'Nasyith forefry','KGTK',81318458540,'forefry@gmail.com','ukkj','Jika Penilaian Kinerja belum masuk ruang GTK apakah bisa mengikuti UKKJ','Untuk Gelombang satu tahun ini masih kami beri dispensasi dapat mengikuti. Namun yang terdaftar dalam gelombang 2 wajib menggunakan penilaian kinerja yang ada di ruang GTK','2026-06-25 03:37:44','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 03:35:55','2026-06-25 03:37:44'),(9,'Indra Avico','SDN 01 Seberang Musi',89507975093,'indraavico44@gmail.com','stem','kapan kegiatan STEM dilaksanakan untuk wilayah prov. Bengkulu ?','stem akan dilaksanakan insyaAllah dibulan Oktober','2026-06-25 13:05:27','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:47:20','2026-06-25 13:05:27'),(10,'Ersy Sonata','Sdn 05 Bengkulu Tengah',81271999864,'ersysonata64@gmail.com','bcks','Kapan kegiatan BCKS 2026 dimulai','bcks akan dimulai di bulan agustus','2026-06-25 13:06:29','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:47:47','2026-06-25 13:06:29'),(11,'Fakhrurrozi Ikhsan','SD Negeri 10 Kepahiang',82284279079,'roziikhsanfakhrur@gmail.com','stem','Apa saja sintaks pendekatan STEM?','| Tahap             | Tujuan                   | Aktivitas Utama            |\r\n| ----------------- | ------------------------ | -------------------------- |\r\n| 1. Ask            | Mengidentifikasi masalah | Mengamati dan bertanya     |\r\n| 2. Research       | Mengumpulkan informasi   | Eksplorasi dan investigasi |\r\n| 3. Plan           | Merancang solusi         | Mendesain produk           |\r\n| 4. Create         | Membuat produk           | Membangun prototipe        |\r\n| 5. Test & Improve | Menguji dan memperbaiki  | Evaluasi dan revisi        |\r\n| 6. Communicate    | Menyampaikan hasil       | Presentasi dan refleksi    |','2026-06-26 01:33:01','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:47:48','2026-06-26 01:33:01'),(12,'DWI OKTA VIANI','SD MUHAMMADIYAH 5 KEPAHIANG',83803857730,'dwi4047@guru.sd.belajar.id','stem','Kapan pelatihan STEM bagi guru akan dilaksanakan?','Pelatihan stem insyaAllah dibulan oktober','2026-06-25 13:13:01','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:48:03','2026-06-25 13:13:01'),(13,'Ena Widayanti','SDN 72 Bengkulu Tengah',8989168194,'enawidayanti55@guru.sd.belajar.id','pkgsd mbi','Kapan adanya pelatihan guru bahasa inggris di sekolah dasar ?','Pelatihan guru bahasa inggris sedang berjalan. namun karena keterbatasan anggran baru kab rejang lebong','2026-06-25 13:14:07','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:48:16','2026-06-25 13:14:07'),(14,'Ria Yulia Sari','SD Negeri 10 Ujan Mas',85762975773,'riasari77@guru.sd.belajar.id','pkgsd mbi','Kapan diadakan pelatihan untuk mata pelajaran Bahasa Inggris bagi guru kelas SD','pelatihan PKGSDMBI sedang berjalan dikarenakan effisiensi anggaran  baru di kab rejang lebong yang berjalan','2026-06-25 12:56:31','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:48:24','2026-06-25 12:56:31'),(15,'Elpa setiawati','SDN 57 KOTA BENGKULU',82289668925,'elvasetiawati58@guru.sd.belajar.id','pm/kka','Apakah tahun ini ada pelatihan KKA dari kementerian. \nTerimakasih 🙏🏻','Pelatihan KKA ada tetapi tidak berdiri sendiri digabung dengan PM','2026-06-25 13:35:55','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:48:43','2026-06-25 13:35:55'),(16,'Bethalisa Sukmaningtyas','SD Negeri 25 Kota Bengkulu',85353090001,'bethalisa10@gmail.com','pm/kka','Bagaimana penerapan Kecerdasan Artifisial di sekolah dasar?','penerapan KA disekolah dasar dengan cara guru dapat menyiapkan media ajar agar media ajar konstektual untuk pembelajaran dapat memanfaatkan AI dan guru dapat membuat langkah langkah pembelajaran agar menarik untuk siswa dapat memanfaatkan AI untuk membuat Langkah-langkah pembelajaran tersebut','2026-06-26 01:18:23','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:48:44','2026-06-26 01:18:23'),(17,'YULIA EFRIYANI .M.Pd','SDN 22 Bengkulu Tengah',82378955334,'yulia.efriyani42@guru.sd.belajar.id','ukkj','Bagaiman kami yang sudah S2 dalam jabatan yang sama,apakah tetap harus menunggu 4 tahun baru bisa ujikom','Tidak perlu menunggu 4 tahun jika syarat sudah terpenuhi bisa mendaftar UKOM','2026-06-26 00:01:30','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:48:52','2026-06-26 00:01:30'),(18,'murdani','SDN 88 Kota Bengkulu',81373865808,'murdani.369@guru.sd.belajar.id','pkgsd mbi','Bagaimana cara mendapatkan pelatihan tentang PKGSD MBI - Peningkatan Kompetensi Guru Sekolah Dasar Mengajar Bahasa Inggris ?','untuk PKGSD MBI sasarannya saat ini adalah sekolah dasar yang belum ada guru yang memiliki kualifikasi bhs inggris dan belum ada pelajaran bahas inggris disekolah tersebut.','2026-06-26 01:21:40','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:49:15','2026-06-26 01:21:40'),(19,'Zakiah Al Amini Nur','SD IT DARUNNAJAH',82179071276,'alamininurzakiah@gmail.com','ppg','Pak izin bertanya, saya PPG dari Ilmu Kimia MIPA. Apakah saya linier mengajar di SMP? Kalau iya, Mapel apa saja yang dapat saya ambil?','Bisa di chek pada Keputusan Menteri Pendidikan Dasar dan Menengah (Kepmendikdasmen) Nomor 222/O/2025 tentang Kesesuaian Bidang Tugas dengan Sertifikat Pendidik','2026-06-26 00:00:42','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:49:16','2026-06-26 00:00:42'),(20,'Tri Setio Handoko','SDN 55 Seluma',81278199544,'trisetio99@gmail.com','pm/kka','Dari mana saya bisa mendapat sumber yang baik dalam merancang sebuah pembelajaran matematika yang tidak menakutkan dan menyenangkan untuk anak sekolah dasar?','Bisa dengan menerapkan Tahapan Pembelajaran Matematika Gembira sebagaimana yang dikuti sekarang atau dapat bertanya dengan para Fasda yang sudah dilatih oleh KGTK. Untuk informasi lengkap terkait dengan Numerasi baik di sekolah, keluarga, masyarakat, dan media dapat dilihat pada link berikut : https://guru.kemendikdasmen.go.id/gnn/sumber-belajar','2026-06-26 01:39:22','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:49:22','2026-06-26 01:39:22'),(21,'Melda Dwi Novita','SDN 61 Kota Bengkulu',89657747392,'meldanovita71@guru.sd.belajar.id','stem','Adakah kegiatan perlombaan yang terkait dengan STEM untuk Kategori siswa Sekolah Dasar','Untuk lomba Siswa dibawah kewengan Direktorat Jenderal PDM','2026-06-25 13:15:48','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:49:39','2026-06-25 13:15:48'),(22,'Elsie Astreani','SD Alam Mahira Kota Bengkulu',82178495772,'elsieastreani69@guru.sd.belajar.id','pkgbk','Kapan ada pelatihan guru bimbingan khusus?','pelatihan PKGBK akan dilaksanakan di bulan agustus 2026','2026-06-25 12:48:06','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:49:43','2026-06-25 12:48:06'),(23,'Vebbriza Novri Sanica','SD Negeri 65 Seluma',83171184835,'vebbrizanovrisanica25@gmail.com','stem','Apa itu STEM ?\nMengapa pendekatan ini ini penting dan apa saja kelebihan  dari pembelajaran STEM ini terutama untuk anak sekolah dasar?','STEM merupakan singkatan dari Science (Sains), Technology (Teknologi), Engineering (Rekayasa), dan Mathematics (Matematika). STEM bukan sekadar mengajarkan empat mata pelajaran tersebut secara terpisah, melainkan mengintegrasikan keempatnya dalam satu pengalaman belajar yang kontekstual untuk memecahkan masalah nyata.\r\n\r\nDalam pembelajaran STEM, peserta didik diajak untuk:\r\n\r\nmengamati fenomena,\r\nmengajukan pertanyaan,\r\nmencari informasi,\r\nmerancang solusi,\r\nmembuat prototipe,\r\nmenguji hasil,\r\nmemperbaiki desain,\r\nserta mengomunikasikan temuannya.\r\n\r\nDengan demikian, STEM menempatkan peserta didik sebagai problem solver, inovator, dan pencipta, bukan hanya sebagai penerima informasi\r\n\r\nPendekatan STEM menjadi sangat penting karena dunia saat ini menghadapi perubahan yang sangat cepat akibat perkembangan teknologi, digitalisasi, kecerdasan artifisial (AI), otomatisasi, dan tantangan global seperti perubahan iklim, energi, kesehatan, serta ketahanan pangan.\r\n\r\nSekolah perlu mempersiapkan peserta didik agar tidak hanya menguasai pengetahuan, tetapi juga memiliki kemampuan untuk:\r\n\r\nberpikir kritis dalam menganalisis masalah;\r\nberpikir kreatif menghasilkan solusi;\r\nberkolaborasi dengan orang lain;\r\nberkomunikasi secara efektif;\r\nmemanfaatkan teknologi secara bijaksana;\r\nmampu beradaptasi terhadap perubahan.','2026-06-26 01:30:20','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:49:59','2026-06-26 01:30:20'),(24,'Sari Prehati','SD negeri 068 Bengkulu Utara',82269229704,'sarisd10@gmail.com','ppg','Apakah wajib mengikuti UJIKOM untuk kenaikan jenjang jabatan?','Berdasarkan Permenpan RB No. 1 Tahun 2023 dan Permenpan RB No. 7 Tahun 2026, setiap Aparatur Sipil Negara (ASN) yang akan naik Jenjang Jabatan Fungsional (bukan sekadar naik pangkat biasa dalam satu jenjang) wajib mengikuti dan dinyatakan lulus Uji Kompetensi Kenaikan Jenjang (UKKJ).','2026-06-25 23:59:55','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:50:41','2026-06-25 23:59:55'),(25,'OKPI DIANA, S.Pd','SD NEGERI 83 KOTA BENGKULU',81367488694,'okpidiana10@guru.sd.belajar.id','stem','Kaapan  STEM dilaksanakan?','STEM akan dilaksanakan pada bulan oktober','2026-06-25 09:52:29','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:50:45','2026-06-25 09:52:29'),(26,'Lilian Anggela','SDN 107 SELUMA',81377777741,'liliyan332@gmail.com','ukkj','Saya akan naik jenjang ke IV A, apakah saya dapat mengikuti ukom, dari mana saya bisa mencari informasi tentang ukom untuk naik pangkat ke berikutnya. terima kasih','Anda dapat mengikuti UKOM ketika semua persyaratan terpenuhi dan tersedia formasi pada jabatan yang anda tuju. Anda dapat mencari informasi pada situs resmi ukom kemendikdasmen https://ujikompetensi.kemendikdasmen.go.id/, akun SIMPKB, Kantor GTK Bengkulu, Dinas Pendidikan dan Kebudayaan.','2026-06-25 23:58:50','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:52:00','2026-06-25 23:58:50'),(27,'Disma Riza','SDN 15 Bengkulu Tengah',85266790582,'dismariza@gmail.com','ppg','Saya PNS golongan 3B dan sudah lulus S2. Apakah harus menunggu 4 tahun dalam golongan tersebut untuk bisa melaksanakan uji kompetensi ?\nApakah sertifikat pendidik belum cukup kuat untuk mengakui bahwa guru tersebut sudah berkompetensi ?\nMengapa masih harus ikut uji kompetensi untuk naik ke golongan 3C ?','Kenaikan jenjang jabatan dari Guru Ahli Pertama (III/b) ke Ahli Muda (III/c) kini tidak harus menunggu 4 tahun melainkan berbasis capaian Angka Kredit tahunan, namun tetap wajib lulus Uji Kompetensi (UKKJ) sesuai UU ASN Nomor 20 Tahun 2023 karena Sertifikat Pendidik (Serdik) hanya berfungsi sebagai lisensi mengajar awal, bukan syarat kenaikan jenjang.','2026-06-25 23:58:26','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:52:24','2026-06-25 23:58:26'),(28,'lilis stiyowati','SDN 034 Bengkulu Utara',85268993628,'lilis.stiyowati42@guru.sd.belajar.id','ppg','Bagaimana mengatasi persoalan data untuk mengirimkan ke kgtk dengan masala ada kesalahan data apakah bisa di ulanng kembali','jika ada kesalahan data atau update data dapodik guru silahkan perbaiki melalui operator dapodik disekolah selanjut operator seoklah berkoordinasi dengan opertor dapodik di dinas pendidikan','2026-06-26 01:10:07','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:57:35','2026-06-26 01:10:07'),(29,'Misda Inun Hasibuan','SDN 010 Bengkulu Utara',81274602881,'ainunmisda0@gmail.com','ppg','Siapa yang dapat dihubungi apabila mengalami kendala pada layanan atau aplikasi yang dikelola KGTK Bengkulu?','silahkan bertanya melalui fitur layanan tanya jawab ini','2026-06-26 01:08:26','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 10:02:33','2026-06-26 01:08:26'),(30,'Purwati','Sdit Ruhul Jadid',81325499373,'purwati554@guru.sd.belajar.id','ppg','Izin bertanya bapak.\nBagaimana  yang guru swasta apakah bisa memiliki peluang p3k dan bisakah juga penempatannya tetap berada di sekolah swasta tersebut.','Terkait P3K kewenangan ada pemda','2026-06-26 01:13:28','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 10:03:10','2026-06-26 01:13:28'),(31,'rusnadi','SDN 093 BENGKULU UTARA',82376181846,'rusnadi13@guru.sd.belajar.id','bcks','Kapan pelaksanaan BCKS','BCKS untuk APBNP akan dilaksanakan di bulan agustus 2026','2026-06-25 12:44:58','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 10:05:27','2026-06-25 12:44:58'),(32,'Dwi Dian Panike','SDN 14 Bermani ilir',85758506543,'dwidianpanike881@gmail.com','stem','Bagaimana sistem pelatihan stem nanti?','untuk sistem pelatihan stem masih menunggu juknisnya yang sedang disusun oleh pusat','2026-06-25 12:44:24','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 10:07:25','2026-06-25 12:44:24'),(35,'Budi Santoso','SMA Negeri 1 Jakarta',81234567890,'budi@example.com','bcks','Bagaimana cara mendaftar PPG?','Cara mendaftar PPG dibedakan berdasarkan kategori kepesertaan Anda. Silakan cermati dua kategori di bawah ini untuk menentukan jalur yang sesuai:\r\n1. PPG bagi Calon Guru (Prajabatan)\r\nProgram ini ditujukan bagi lulusan S1 atau D4 yang belum terdaftar sebagai guru di Dapodik.\r\n2. PPG bagi Guru Tertentu (Dalam Jabatan)\r\nProgram ini dikhususkan bagi guru yang saat ini sudah aktif mengajar dan datanya telah tercatat di sistem Dapodik. Proses pendaftaran dan pemanggilannya dilakukan terintegrasi melalui sistem SIMPKB dan INFO GTK.','2026-06-25 23:57:22','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 12:54:02','2026-06-25 23:57:22'),(36,'Budi Santoso','SMA Negeri 1 Jakarta',81234567890,'budi@example.com','bcks','Bagaimana cara mendaftar PPG?','Cara mendaftar PPG dibedakan berdasarkan kategori kepesertaan Anda. Silakan cermati dua kategori di bawah ini untuk menentukan jalur yang sesuai:\r\n1. PPG bagi Calon Guru (Prajabatan)\r\nProgram ini ditujukan bagi lulusan S1 atau D4 yang belum terdaftar sebagai guru di Dapodik.\r\n2. PPG bagi Guru Tertentu (Dalam Jabatan)\r\nProgram ini dikhususkan bagi guru yang saat ini sudah aktif mengajar dan datanya telah tercatat di sistem Dapodik. Proses pendaftaran dan pemanggilannya dilakukan terintegrasi melalui sistem SIMPKB dan INFO GTK.','2026-06-25 23:57:06','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 13:57:53','2026-06-25 23:57:06'),(39,'Misda Inun Hasibuan','SDN 010 Bengkulu Utara',81274602881,'ainunmisda0@gmail.com','ppg','Pak, saya mau nanya kalau mau daftar pelatihan, apa apa aja ya langkahnya?',NULL,NULL,NULL,'2026-06-29 01:49:37','2026-06-29 01:49:37'),(40,'Fevi Pitrianti','SDN 52 LEBONG',85369548484,'fevipitrianti@gmail.com','pkgbk','saya sudah mendaftar Pelatihan Pendidikan Inklusif Tingkat Dasar Angkatan 3, untuk selanjutnya dimana saya akan mendapatkan informasi apakah saya terpilih untuk mengikuti pelatihannya atau tidak?',NULL,NULL,NULL,'2026-06-29 04:26:28','2026-06-29 04:26:28');
/*!40000 ALTER TABLE `qnas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','super-admin',1,'2026-06-16 20:29:33','2026-06-16 20:29:33',NULL),(2,'User','user',1,'2026-06-16 20:29:33','2026-06-16 20:29:33',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
INSERT INTO `sessions` VALUES ('0YKD8LIx4ppcfTMWfTik6CXHIeZqL8pjk9PMipgA','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoibVJpSENRZVdTWnNsN0VHTkxHYnFtaEhLY2EwcWRDaWx1M3RINnJmVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9rZ3RrLmRhbnVkaXJhamEuc3BhY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czozNjoiYTIwYWFhYjUtZWZmZC00N2U4LTgwY2UtNmI0YTRmMThiNGE2IjtzOjc6InJvbGVfaWQiO2k6MTtzOjk6InJvbGVfbmFtZSI7czoxMToiU3VwZXIgQWRtaW4iO3M6MTA6Im11bHRpX3JvbGUiO2I6MTt9',1782723057),('EVevz0m9V0kVXFWEhDjPzMgubQrX9NVAMofggFMG',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6.1 Safari/605.1.15','YTozOntzOjY6Il90b2tlbiI7czo0MDoicEk5MGlBMXExT0UyRlB6eXVPMVMyN1VjMTIwOXhtdEpVZkF2bTFoaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1782722081),('ha72HseI9txmCOWfFoSvoSXF1ClaAbqi0tHs43FE',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWTA4WFMzOEZzdGpYUHJITXpHclVXV3B0cWh0aFg0ZTJoc1ZRZzlNMSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozODoiaHR0cDovL2tndGsuZGFudWRpcmFqYS5zcGFjZS9kYXNoYm9hcmQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovL2tndGsuZGFudWRpcmFqYS5zcGFjZS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1782821771),('hUKGTKZqzekguSAa7khHkmqnleMWAgcLLQCTrMt6',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZThSVFdjY1A1TDlTYTlCRkt3QnZhRGdTdGs2SnpnRDZ4M2dQcjZHRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1782722783),('sxtxSvGjOo5SEDmNXEy14jd6ggKc4Rl00TWesJcS','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo4OntzOjY6Il90b2tlbiI7czo0MDoiVFA3SGtucTNCQjhLcmRIeVh3M2JTd1RVa01JTGVQZjFWN3NDaFRldCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9rZ3RrLmRhbnVkaXJhamEuc3BhY2UvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjM2OiJhMjBhYWFiNS1lZmZkLTQ3ZTgtODBjZS02YjRhNGYxOGI0YTYiO3M6Nzoicm9sZV9pZCI7aToxO3M6OToicm9sZV9uYW1lIjtzOjExOiJTdXBlciBBZG1pbiI7czoxMDoibXVsdGlfcm9sZSI7YjoxO30=',1782821744),('TMa1E9AD3tEl0Y6NU6h2wByXDBV7Itaj8CnhDRbR','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo4OntzOjY6Il90b2tlbiI7czo0MDoiOFR1cm4xTThZRTZLS2s2TjlNVmRrWlhoTGFudVA1S0FYalFOSG5XQiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwOi8vc3RhZ2luZy5kYW51ZGlyYWphLnNwYWNlL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjM2OiJhMjBhYWFiNS1lZmZkLTQ3ZTgtODBjZS02YjRhNGYxOGI0YTYiO3M6Nzoicm9sZV9pZCI7aToxO3M6OToicm9sZV9uYW1lIjtzOjExOiJTdXBlciBBZG1pbiI7czoxMDoibXVsdGlfcm9sZSI7YjoxO30=',1782723253),('xapLHraCoOUvu5hNAs6i0qzFpGYftGDj8ESw3JI1','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoicjQ2TjVlakNMSndObXlqajlzYW9xUkdqdGZuMjBaMW1UUzVMc0hFbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9zdGFnaW5nLmRhbnVkaXJhamEuc3BhY2UvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6MzY6ImEyMGFhYWI1LWVmZmQtNDdlOC04MGNlLTZiNGE0ZjE4YjRhNiI7czo3OiJyb2xlX2lkIjtpOjE7czo5OiJyb2xlX25hbWUiO3M6MTE6IlN1cGVyIEFkbWluIjtzOjEwOiJtdWx0aV9yb2xlIjtiOjE7fQ==',1782723181);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skms`
--

DROP TABLE IF EXISTS `skms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skms`
--

LOCK TABLES `skms` WRITE;
/*!40000 ALTER TABLE `skms` DISABLE KEYS */;
/*!40000 ALTER TABLE `skms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tim_kerja_images`
--

DROP TABLE IF EXISTS `tim_kerja_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tim_kerja_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tim_kerja_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tim_kerja_images_tim_kerja_id_foreign` (`tim_kerja_id`),
  CONSTRAINT `tim_kerja_images_tim_kerja_id_foreign` FOREIGN KEY (`tim_kerja_id`) REFERENCES `tim_kerjas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tim_kerja_images`
--

LOCK TABLES `tim_kerja_images` WRITE;
/*!40000 ALTER TABLE `tim_kerja_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `tim_kerja_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tim_kerjas`
--

DROP TABLE IF EXISTS `tim_kerjas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tim_kerjas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tim_kerjas`
--

LOCK TABLES `tim_kerjas` WRITE;
/*!40000 ALTER TABLE `tim_kerjas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tim_kerjas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tugas_fungsis`
--

DROP TABLE IF EXISTS `tugas_fungsis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tugas_fungsis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tugas_fungsis`
--

LOCK TABLES `tugas_fungsis` WRITE;
/*!40000 ALTER TABLE `tugas_fungsis` DISABLE KEYS */;
/*!40000 ALTER TABLE `tugas_fungsis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_role` (
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES ('a20aaab5-effd-47e8-80ce-6b4a4f18b4a6',1,NULL,NULL),('a20aaab5-effd-47e8-80ce-6b4a4f18b4a6',2,NULL,NULL),('a20aaab6-69f1-4fce-b64a-7773d4729212',2,NULL,NULL);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','Super Admin','admin','administrator@app.com',NULL,'$2y$12$ssiPNkDkHNt/BsSeucn1e.cd6LpXKlpIEn2jr5sw1QdBLUUB9Auam',NULL,1,'2026-06-16 20:29:34','2026-06-16 20:29:34',NULL),('a20aaab6-69f1-4fce-b64a-7773d4729212','User','user','user@app.com',NULL,'$2y$12$1IvjxgZgGrqlQnV0o34F7uCTAXKM7I9N7y3nmNi4NkXPCqFa7p2Qi',NULL,1,'2026-06-16 20:29:34','2026-06-16 20:29:34',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visi_misi_images`
--

DROP TABLE IF EXISTS `visi_misi_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visi_misi_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `visi_misi_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visi_misi_images_visi_misi_id_foreign` (`visi_misi_id`),
  CONSTRAINT `visi_misi_images_visi_misi_id_foreign` FOREIGN KEY (`visi_misi_id`) REFERENCES `visi_misis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visi_misi_images`
--

LOCK TABLES `visi_misi_images` WRITE;
/*!40000 ALTER TABLE `visi_misi_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `visi_misi_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visi_misis`
--

DROP TABLE IF EXISTS `visi_misis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visi_misis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visi_misis`
--

LOCK TABLES `visi_misis` WRITE;
/*!40000 ALTER TABLE `visi_misis` DISABLE KEYS */;
/*!40000 ALTER TABLE `visi_misis` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-30 19:19:02
