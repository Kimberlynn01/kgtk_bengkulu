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
INSERT INTO `actions` VALUES (1,'view','2026-07-01 01:37:46','2026-07-01 01:37:46'),(2,'create','2026-07-01 01:37:46','2026-07-01 01:37:46'),(3,'update','2026-07-01 01:37:46','2026-07-01 01:37:46'),(4,'delete','2026-07-01 01:37:46','2026-07-01 01:37:46'),(5,'download','2026-07-01 01:37:46','2026-07-01 01:37:46');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artikel_images`
--

LOCK TABLES `artikel_images` WRITE;
/*!40000 ALTER TABLE `artikel_images` DISABLE KEYS */;
INSERT INTO `artikel_images` VALUES (1,1,'artikels/xoNd4wrPJTdmYmeJOhjE7li6JIHj6ztULOWMC15A.jpg','2026-07-21 04:38:46','2026-07-21 04:38:46'),(2,2,'artikels/tMIR7N67loQTfyYuc0xKv89Ss33kaRI5qYhzGZ9M.jpg','2026-07-21 04:48:48','2026-07-21 04:48:48'),(3,3,'artikels/NrkhSTh6YpvGAyaWYt6rTA8D4FYgwWPp7FH7BYjf.jpg','2026-07-21 05:05:01','2026-07-21 05:05:01'),(4,4,'artikels/AzlJyhkZayd1Rb9hKDDkp25xKCI4DbRk1z73NEmU.jpg','2026-07-21 05:12:48','2026-07-21 05:12:48');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artikels`
--

LOCK TABLES `artikels` WRITE;
/*!40000 ALTER TABLE `artikels` DISABLE KEYS */;
INSERT INTO `artikels` VALUES (1,'2026-07-21','Semarak Hardiknas KGTK Provinsi Bengkulu: Perteguh Komitmen Cetak Generasi Emas','semarak-hardiknas-kgtk-provinsi-bengkulu-perteguh-komitmen-cetak-generasi-emas','<p><strong>BENGKULU</strong> &ndash; Suasana khidmat dan penuh semangat mewarnai Peringatan Hari Pendidikan Nasional (Hardiknas) di lingkungan KGTK&nbsp;Provinsi Bengkulu pagi ini. Para pahlawan tanpa tanda jasa yang menjadi garda terdepan pendidikan generasi emas,&nbsp;melaksanakan upacara bendera untuk mengenang kembali semangat juang Bapak Pendidikan Indonesia, Ki Hajar Dewantara.</p>','2026-07-21 04:38:46','2026-07-21 04:38:46'),(2,'2026-07-21','Wujudkan Standar Pendidikan Unggul, KGTK Provinsi Bengkulu Sukses Gelar Pelatihan Sekolah Model','wujudkan-standar-pendidikan-unggul-kgtk-provinsi-bengkulu-sukses-gelar-pelatihan-sekolah-model','<p><strong>BENGKULU</strong> &ndash; Dalam upaya mengakselerasi mutu dan kualitas institusi pendidikan, Kantor Guru dan Tenaga Kependidikan (KGTK) Provinsi Bengkulu menyelenggarakan kegiatan strategis bertajuk &quot;Pelatihan Sekolah Model&quot;. Agenda ini dihadiri oleh para kepala sekolah, guru, dan tenaga kependidikan dari berbagai wilayah di Bengkulu, dengan fokus utama pada pengembangan tata kelola sekolah yang inovatif dan berdaya saing tinggi.</p>\r\n\r\n<p>Pelatihan ini dirancang untuk memberikan pembekalan komprehensif terkait manajemen sekolah percontohan, mulai dari penguatan Kurikulum Merdeka, optimalisasi administrasi, hingga penciptaan iklim akademik yang positif. Menjadi Sekolah Model berarti institusi tersebut disiapkan untuk menjadi rujukan dan <em>benchmarking</em> bagi sekolah-sekolah lain di sekitarnya.</p>\r\n\r\n<p>Melalui pemaparan materi dari narasumber ahli dan diskusi interaktif, para peserta diajak untuk membedah praktik-praktik terbaik (<em>best practice</em>) dalam pengelolaan ekosistem sekolah.</p>\r\n\r\n<p>Dengan terselenggaranya pelatihan ini, KGTK Provinsi Bengkulu berharap lahirnya percontohan sekolah-sekolah unggul yang mampu mengangkat standar kualitas pendidikan di Bumi Rafflesia. Langkah nyata ini menjadi bukti komitmen KGTK dalam memfasilitasi peningkatan kompetensi para pendidik di Bengkulu secara berkelanjutan.</p>','2026-07-21 04:48:48','2026-07-21 04:48:48'),(3,'2026-07-21','Perluas Ekosistem Pendidikan, KGTK Provinsi Bengkulu Sukses Gelar Program Kolaboratif \"Semua Bisa Mengajar\"','perluas-ekosistem-pendidikan-kgtk-provinsi-bengkulu-sukses-gelar-program-kolaboratif-semua-bisa-mengajar','<p><strong>BENGKULU</strong> &ndash; Meyakini bahwa pendidikan adalah tanggung jawab bersama, Kantor Guru dan Tenaga Kependidikan (KGTK) Provinsi Bengkulu menyelenggarakan program inovatif bertajuk &quot;Semua Bisa Mengajar&quot;. Kegiatan ini menjadi wadah kolaborasi yang mempertemukan para profesional dari berbagai bidang, relawan, dan tokoh masyarakat untuk terjun langsung membagikan ilmu serta pengalaman mereka di ruang-ruang kelas.</p>\r\n\r\n<p>Program &quot;Semua Bisa Mengajar&quot; diinisiasi untuk mendobrak stigma bahwa proses belajar mengajar hanya bisa dilakukan oleh guru formal. Sebaliknya, inisiatif ini membuktikan bahwa setiap individu yang memiliki keahlian dan kepedulian dapat berkontribusi memberikan inspirasi nyata bagi para peserta didik. Mulai dari wirausahawan, praktisi kesehatan, seniman, hingga aparat, semua bahu-membahu memberikan wawasan baru yang memperkaya perspektif siswa tentang masa depan.</p>','2026-07-21 05:05:01','2026-07-21 05:05:01'),(4,'2026-07-21','Perkuat Sinergi dan Penyelarasan Program, KGTK Provinsi Bengkulu Gelar Rapat Koordinasi','perkuat-sinergi-dan-penyelarasan-program-kgtk-provinsi-bengkulu-gelar-rapat-koordinasi','<p><strong>BENGKULU</strong> &ndash; Guna memastikan kelancaran dan efektivitas seluruh program kerja, Kantor Guru dan Tenaga Kependidikan (KGTK) Provinsi Bengkulu menyelenggarakan Rapat Koordinasi (Rakor) yang dihadiri oleh jajaran pengurus, perwakilan pendidik, serta tenaga kependidikan. Agenda strategis ini menjadi momentum penting untuk menyelaraskan visi, mengevaluasi capaian, serta merumuskan langkah-langkah konkret organisasi ke depan.</p>\r\n\r\n<p>Rapat koordinasi ini membahas berbagai isu esensial, mulai dari peningkatan kompetensi guru, optimalisasi tata kelola administrasi, hingga rencana pelaksanaan program-program strategis yang akan digulirkan dalam waktu dekat. Melalui forum diskusi yang interaktif, seluruh peserta saling bertukar gagasan untuk mencari solusi atas berbagai tantangan pendidikan di lapangan.</p>\r\n\r\n<p>Penyelenggaraan Rakor ini merupakan wujud nyata transparansi dan akuntabilitas KGTK Provinsi Bengkulu. Dengan perencanaan yang matang dan sinergi yang kuat antar-elemen, diharapkan seluruh program yang dicanangkan dapat berjalan tepat sasaran dan memberikan dampak positif yang signifikan bagi ekosistem pendidikan.</p>\r\n\r\n<p>KGTK Provinsi Bengkulu berkomitmen untuk terus menjadi wadah yang solid dan aspiratif, bergerak bersama demi memajukan kualitas pendidikan dan kesejahteraan tenaga pendidik di Bumi Rafflesia.</p>','2026-07-21 05:12:48','2026-07-21 05:12:48');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audits`
--

LOCK TABLES `audits` WRITE;
/*!40000 ALTER TABLE `audits` DISABLE KEYS */;
INSERT INTO `audits` VALUES (1,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226d7d3-82f1-4b16-9b3e-c50d0db9b1bf','[]','{\"id\": \"a226d7d3-82f1-4b16-9b3e-c50d0db9b1bf\", \"name\": \"Seto PIC PPG\", \"email\": \"seto@gmail.com\", \"password\": \"$2y$12$FJnfFc7CssrpfnqvL.C5tedtHa3iQRtf3VwDXnvnfMoteuiSoMA8i\", \"username\": \"seto\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36',NULL,'2026-07-01 03:38:54','2026-07-01 03:38:54'),(2,NULL,NULL,'created','App\\Models\\User','a226dc6a-bc1e-474c-8446-434616c4abd8','[]','{\"id\": \"a226dc6a-bc1e-474c-8446-434616c4abd8\", \"name\": \"ade\", \"email\": \"adeseptiawn79@dikbud.belajar.id\", \"password\": \"$2y$12$dJ6/HOnX5UgTbGE28hzseugCC0OJvi7zN0tP.eNMs4XWH3JN6ikPm\", \"username\": \"gasken\"}','http://kgtk.danudiraja.space/register','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 03:51:44','2026-07-01 03:51:44'),(3,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226e474-e7e9-42dc-8ad2-e5fda3d463d3','[]','{\"id\": \"a226e474-e7e9-42dc-8ad2-e5fda3d463d3\", \"name\": \"ade Septiawan\", \"email\": \"KGTKbengkulu@gmail.com\", \"password\": \"$2y$12$7VzficSVOEie2YQF4yz7R.rYSG/DNm9cK5MMC.nXvRQc7dGBFqqT.\", \"username\": \"ade\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 04:14:13','2026-07-01 04:14:13'),(4,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226e5bc-51b3-4d94-88b9-fb1c547523d0','[]','{\"id\": \"a226e5bc-51b3-4d94-88b9-fb1c547523d0\", \"name\": \"Yulia\", \"email\": \"YuliaKGTK@gmail.com\", \"password\": \"$2y$12$FF1ECGGKA3bqsMCgq4Pg2u.6RL5osQJ7rNRS79QN2cor13guUTKAu\", \"username\": \"Yulia\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 04:17:47','2026-07-01 04:17:47'),(5,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226e68f-615b-4de6-95fa-31a8baa38beb','[]','{\"id\": \"a226e68f-615b-4de6-95fa-31a8baa38beb\", \"name\": \"Syafrizal\", \"email\": \"SayfrizalKGTK@gmail.com\", \"password\": \"$2y$12$gzxqXSYXDiPXrlPU6nzLD.MY.G/tjND9fg78ba7CyejdsJuXLyNQ6\", \"username\": \"Syafrizal\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 04:20:06','2026-07-01 04:20:06'),(6,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226e752-5e6a-48b6-b818-a229d664b5ed','[]','{\"id\": \"a226e752-5e6a-48b6-b818-a229d664b5ed\", \"name\": \"Syafrizal\", \"email\": \"KGTKsayfrizal@gmail.com\", \"password\": \"$2y$12$1J1UAam0wIleXP7zpkfKjOpib5sqC8abhxqHbEDxRZAKxsKIYHR1y\", \"username\": \"Izal\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 04:22:13','2026-07-01 04:22:13'),(7,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226eb15-86aa-422c-a16b-da9921d7618c','[]','{\"id\": \"a226eb15-86aa-422c-a16b-da9921d7618c\", \"name\": \"Muzanip\", \"email\": \"KGTKMuzanip@gmail.com\", \"password\": \"$2y$12$3TJndC7Eywh/RlHUvl2eYOrL47CaHGK6qPJL00BizQWJ8KFV3VekS\", \"username\": \"Muzanip\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 04:32:45','2026-07-01 04:32:45'),(8,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226ebab-396f-4359-9c08-d21a2d6965f3','[]','{\"id\": \"a226ebab-396f-4359-9c08-d21a2d6965f3\", \"name\": \"Denny T\", \"email\": \"KGTKDenny@gmail.com\", \"password\": \"$2y$12$z4uw2RzfyIa2NRljl0ooLOKCwuwMrN8gm5WmwlJ9ZKyLbbZeoVX0W\", \"username\": \"Denny\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 04:34:23','2026-07-01 04:34:23'),(9,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226ec77-edd3-41a7-a0be-7851a850eb71','[]','{\"id\": \"a226ec77-edd3-41a7-a0be-7851a850eb71\", \"name\": \"Sutanto\", \"email\": \"KGTKSutanto@gmail.com\", \"password\": \"$2y$12$HTXvYE6wHvklJvrBPLzqh.L3kldJGW77z7wbQV0d3ZVslKp9t2AVy\", \"username\": \"Tanto\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 04:36:37','2026-07-01 04:36:37'),(10,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226ed31-b71c-47bd-9490-ccdcf305b3cb','[]','{\"id\": \"a226ed31-b71c-47bd-9490-ccdcf305b3cb\", \"name\": \"Harniningsih\", \"email\": \"KGTKHarning@gmail.com\", \"password\": \"$2y$12$FBAdUjbYe03u0P9RDixbSeptKwozXJvIzpplv1ZkcrpumudM7dVa6\", \"username\": \"Harning\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 04:38:39','2026-07-01 04:38:39'),(11,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226ee2f-af27-45d8-8920-af7a48a60b57','[]','{\"id\": \"a226ee2f-af27-45d8-8920-af7a48a60b57\", \"name\": \"M.Sabani\", \"email\": \"KGTKSabani@gmail.com\", \"password\": \"$2y$12$aoh4WaKMBz6dYYwCCf8sdOx61rRgyF8SHc0HA6ABBFq2s7DTYpGCu\", \"username\": \"Sabani\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 04:41:25','2026-07-01 04:41:25'),(12,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226eee6-05fb-4d8a-814b-cfedeb10d9f1','[]','{\"id\": \"a226eee6-05fb-4d8a-814b-cfedeb10d9f1\", \"name\": \"Yetty\", \"email\": \"KGTKYetty@gmail.com\", \"password\": \"$2y$12$CdSXyCrLChEZCz1Gv9biN.2ENCqEKNPjG3mJUMXZ3F0mpAA.sGwtS\", \"username\": \"Yetty\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 04:43:25','2026-07-01 04:43:25'),(13,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226f1e9-dec2-4cf7-8185-9e50b3c5627b','[]','{\"id\": \"a226f1e9-dec2-4cf7-8185-9e50b3c5627b\", \"name\": \"Yarni\", \"email\": \"KGTKYarni@gmail.com\", \"password\": \"$2y$12$yJPLy3btMALtoFseQXxAhu9LN6/q8JEGjzKRybRJclPFF8UaIJabS\", \"username\": \"Yarni\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 04:51:50','2026-07-01 04:51:50'),(14,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226f36f-a62b-47c8-8c10-d2ff4ff823e0','[]','{\"id\": \"a226f36f-a62b-47c8-8c10-d2ff4ff823e0\", \"name\": \"Nova\", \"email\": \"KGTKNova@gmail.com\", \"password\": \"$2y$12$Be9pILQytxoHUcYhkECgSupxVBsOthveBjuxn/HParVFMd6Mh69zG\", \"username\": \"Nova\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 04:56:06','2026-07-01 04:56:06'),(15,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a226f4e1-bf00-4a0f-a473-79db8d946721','[]','{\"id\": \"a226f4e1-bf00-4a0f-a473-79db8d946721\", \"name\": \"Gustia\", \"email\": \"KGTKGustia@gmail.com\", \"password\": \"$2y$12$WmcIgrKSnhCWsQDtb77Thu4BPKF8vOEWaVRiqJd8ISUrIL5dkOjoe\", \"username\": \"Gustia\", \"is_active\": 1}','http://kgtk.danudiraja.space/qna/store-pic','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36',NULL,'2026-07-01 05:00:08','2026-07-01 05:00:08'),(16,'App\\Models\\User','a226ac83-001b-450f-989a-a7cccb3b9cef','created','App\\Models\\User','a24fcd67-d96e-4d57-a621-f5c58feb9485','[]','{\"id\": \"a24fcd67-d96e-4d57-a621-f5c58feb9485\", \"name\": \"Anggito Setoadji\", \"email\": \"setoadji76@gmail.com\", \"password\": \"$2y$12$69Fp5jVa.4b4ZEELDT53eeL69JqRErzMhmhCs.ggV5owJzKuQRM86\", \"username\": \"Anggito TEST\"}','http://kgtk.danudiraja.space/users/store','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36',NULL,'2026-07-21 12:18:42','2026-07-21 12:18:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berita_images`
--

LOCK TABLES `berita_images` WRITE;
/*!40000 ALTER TABLE `berita_images` DISABLE KEYS */;
INSERT INTO `berita_images` VALUES (12,8,'beritas/Lxtzza5UuhUWCtHO4Ztejr3JqHbKuMzZNL4cwJla.jpg','2026-07-21 12:00:13','2026-07-21 12:00:13'),(13,9,'beritas/QUOC6NTkwk64dniV7GfaYusuRpJu8mCOwHXJtu4M.jpg','2026-07-21 12:01:26','2026-07-21 12:01:26');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beritas`
--

LOCK TABLES `beritas` WRITE;
/*!40000 ALTER TABLE `beritas` DISABLE KEYS */;
INSERT INTO `beritas` VALUES (8,'2026-02-01','Rajut Ukhuwah dan Kepedulian, KGTK Provinsi Bengkulu Sukses Gelar Rangkaian Syiar Ramadhan 2026','rajut-ukhuwah-dan-kepedulian-kgtk-provinsi-bengkulu-sukses-gelar-rangkaian-syiar-ramadhan-2026-ucjjM','<p><strong>BENGKULU</strong> &ndash; Bulan suci Ramadhan 1447 H / 2026 M menjadi momentum istimewa bagi Kantor Guru dan Tenaga Kependidikan (KGTK) Provinsi Bengkulu untuk memperbanyak amal kebaikan dan mempererat tali silaturahmi. Melalui program &quot;Syiar Ramadhan 2026&quot;, KGTK Bengkulu sukses menyelenggarakan serangkaian kegiatan keagamaan dan sosial yang melibatkan seluruh jajaran pendidik serta tenaga kependidikan.</p>','2026-07-21 12:00:13','2026-07-21 12:00:13'),(9,'2026-02-02','KGTK Provinsi Bengkulu Gelar Pengabdian Masyarakat: Tingkatkan Kompetensi Digital Guru Lewat Pelatihan Modul Ajar Berbasis AI','kgtk-provinsi-bengkulu-gelar-pengabdian-masyarakat-tingkatkan-kompetensi-digital-guru-lewat-pelatihan-modul-ajar-berbasis-ai-SuW82','<p><strong>BENGKULU</strong> &nbsp;Menjawab tantangan disrupsi teknologi di era pendidikan modern, Kantor Guru dan Tenaga Kependidikan (KGTK) Provinsi Bengkulu sukses menyelenggarakan kegiatan Pengabdian Masyarakat bertajuk &quot;Pelatihan Inovasi Modul Ajar Berbasis Artificial Intelligence (AI)&quot;. Kegiatan strategis ini ditujukan bagi para pendidik guna mengintegrasikan teknologi kecerdasan buatan dalam merancang materi pembelajaran yang interaktif, adaptif, dan efisien.<br />\r\n<br />\r\nPemanfaatan kecerdasan buatan kini bukan lagi sekadar tren, melainkan alat bantu esensial. Dalam pelatihan ini, para peserta dibimbing secara komprehensif dan praktis mengenai cara memanfaatkan berbagai platform <em>generative AI</em> untuk mempermudah penyusunan perangkat ajar, rubrik penilaian, hingga Rencana Pelaksanaan Pembelajaran (RPP) yang selaras dengan Kurikulum Merdeka.</p>','2026-07-21 12:01:26','2026-07-21 12:01:26');
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
INSERT INTO `cache` VALUES ('admid|127.0.0.1','i:2;',1785207420),('admid|127.0.0.1:timer','i:1785207420;',1785207420),('admind|127.0.0.1','i:3;',1785207934),('admind|127.0.0.1:timer','i:1785207934;',1785207934),('ricohendrawan7556@gmail.com|127.0.0.1','i:2;',1785207374),('ricohendrawan7556@gmail.com|127.0.0.1:timer','i:1785207374;',1785207374);
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
-- Table structure for table `data_sasarans`
--

DROP TABLE IF EXISTS `data_sasarans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_sasarans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_sasarans`
--

LOCK TABLES `data_sasarans` WRITE;
/*!40000 ALTER TABLE `data_sasarans` DISABLE KEYS */;
INSERT INTO `data_sasarans` VALUES (1,'Data Sasaran','Data Sasaran','0','2026-07-29 06:51:50','2026-07-29 06:51:50');
/*!40000 ALTER TABLE `data_sasarans` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `janji_maklumat_images`
--

LOCK TABLES `janji_maklumat_images` WRITE;
/*!40000 ALTER TABLE `janji_maklumat_images` DISABLE KEYS */;
INSERT INTO `janji_maklumat_images` VALUES (4,2,'janji_maklumats/dOsuPpqwp0t19q8ZJOlYAp9RRC62r8nmoIFmd0uI.jpg','2026-07-29 06:50:25','2026-07-29 06:50:25');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `janji_maklumats`
--

LOCK TABLES `janji_maklumats` WRITE;
/*!40000 ALTER TABLE `janji_maklumats` DISABLE KEYS */;
INSERT INTO `janji_maklumats` VALUES (2,'Janji dan Maklumat','2026-07-29 06:50:25','2026-07-29 06:50:25');
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
-- Table structure for table `laporan_kerjas`
--

DROP TABLE IF EXISTS `laporan_kerjas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laporan_kerjas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporan_kerjas`
--

LOCK TABLES `laporan_kerjas` WRITE;
/*!40000 ALTER TABLE `laporan_kerjas` DISABLE KEYS */;
INSERT INTO `laporan_kerjas` VALUES (3,'Laporan Kerja','Tautan dan Dokumen','laporan_kerjas/9ubsR5JFDQClEajYp1uQJB0lXsVx45300P46twj8.pdf','2026-07-27 04:36:13','2026-08-12 07:55:09');
/*!40000 ALTER TABLE `laporan_kerjas` ENABLE KEYS */;
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
INSERT INTO `menu_groups` VALUES (1,'Beranda','2026-07-01 01:37:46','2026-07-01 01:37:46',NULL),(2,'Page Profil','2026-07-01 01:37:46','2026-07-01 01:37:46',NULL),(3,'Layanan Page','2026-07-01 01:37:46','2026-07-01 01:37:46',NULL),(4,'Publikasi','2026-07-01 01:37:46','2026-07-01 01:37:46',NULL),(5,'Manajemen','2026-07-01 01:37:46','2026-07-01 01:37:46',NULL);
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
INSERT INTO `menu_role` VALUES ('019f9d4d-566c-739e-982c-6dc653775fcb',1,1,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',1,2,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',1,3,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',1,4,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',1,5,NULL,NULL),('019f9d4d-5676-70cf-b847-8da00471d2c6',1,1,NULL,NULL),('019f9d4d-5676-70cf-b847-8da00471d2c6',1,2,NULL,NULL),('019f9d4d-5676-70cf-b847-8da00471d2c6',1,3,NULL,NULL),('019f9d4d-5676-70cf-b847-8da00471d2c6',1,4,NULL,NULL),('019f9d4d-5676-70cf-b847-8da00471d2c6',1,5,NULL,NULL),('019f9d4d-5679-738c-a903-eff2a69b3689',1,1,NULL,NULL),('019f9d4d-5679-738c-a903-eff2a69b3689',1,2,NULL,NULL),('019f9d4d-5679-738c-a903-eff2a69b3689',1,3,NULL,NULL),('019f9d4d-5679-738c-a903-eff2a69b3689',1,4,NULL,NULL),('019f9d4d-5679-738c-a903-eff2a69b3689',1,5,NULL,NULL),('019f9d4d-567c-7022-89b9-2fe00234ee1e',1,1,NULL,NULL),('019f9d4d-567c-7022-89b9-2fe00234ee1e',1,2,NULL,NULL),('019f9d4d-567c-7022-89b9-2fe00234ee1e',1,3,NULL,NULL),('019f9d4d-567c-7022-89b9-2fe00234ee1e',1,4,NULL,NULL),('019f9d4d-567c-7022-89b9-2fe00234ee1e',1,5,NULL,NULL),('019f9d4d-567e-7337-8cbd-47256c97134e',1,1,NULL,NULL),('019f9d4d-567e-7337-8cbd-47256c97134e',1,2,NULL,NULL),('019f9d4d-567e-7337-8cbd-47256c97134e',1,3,NULL,NULL),('019f9d4d-567e-7337-8cbd-47256c97134e',1,4,NULL,NULL),('019f9d4d-567e-7337-8cbd-47256c97134e',1,5,NULL,NULL),('019f9d4d-5680-71b3-8f02-f3cf40d8539c',1,1,NULL,NULL),('019f9d4d-5680-71b3-8f02-f3cf40d8539c',1,2,NULL,NULL),('019f9d4d-5680-71b3-8f02-f3cf40d8539c',1,3,NULL,NULL),('019f9d4d-5680-71b3-8f02-f3cf40d8539c',1,4,NULL,NULL),('019f9d4d-5680-71b3-8f02-f3cf40d8539c',1,5,NULL,NULL),('019f9d4d-5682-70b5-91a1-04d5f2362233',1,1,NULL,NULL),('019f9d4d-5682-70b5-91a1-04d5f2362233',1,2,NULL,NULL),('019f9d4d-5682-70b5-91a1-04d5f2362233',1,3,NULL,NULL),('019f9d4d-5682-70b5-91a1-04d5f2362233',1,4,NULL,NULL),('019f9d4d-5682-70b5-91a1-04d5f2362233',1,5,NULL,NULL),('019f9d4d-5685-72cd-837b-eac502e6f6f2',1,1,NULL,NULL),('019f9d4d-5685-72cd-837b-eac502e6f6f2',1,2,NULL,NULL),('019f9d4d-5685-72cd-837b-eac502e6f6f2',1,3,NULL,NULL),('019f9d4d-5685-72cd-837b-eac502e6f6f2',1,4,NULL,NULL),('019f9d4d-5685-72cd-837b-eac502e6f6f2',1,5,NULL,NULL),('019f9d4d-5688-7180-a6f5-c4cf4c733559',1,1,NULL,NULL),('019f9d4d-5688-7180-a6f5-c4cf4c733559',1,2,NULL,NULL),('019f9d4d-5688-7180-a6f5-c4cf4c733559',1,3,NULL,NULL),('019f9d4d-5688-7180-a6f5-c4cf4c733559',1,4,NULL,NULL),('019f9d4d-5688-7180-a6f5-c4cf4c733559',1,5,NULL,NULL),('019f9d4d-568b-71c1-8481-74c4d75fc412',1,1,NULL,NULL),('019f9d4d-568b-71c1-8481-74c4d75fc412',1,2,NULL,NULL),('019f9d4d-568b-71c1-8481-74c4d75fc412',1,3,NULL,NULL),('019f9d4d-568b-71c1-8481-74c4d75fc412',1,4,NULL,NULL),('019f9d4d-568b-71c1-8481-74c4d75fc412',1,5,NULL,NULL),('019f9d4d-568e-710e-949b-97078bf3982e',1,1,NULL,NULL),('019f9d4d-568e-710e-949b-97078bf3982e',1,2,NULL,NULL),('019f9d4d-568e-710e-949b-97078bf3982e',1,3,NULL,NULL),('019f9d4d-568e-710e-949b-97078bf3982e',1,4,NULL,NULL),('019f9d4d-568e-710e-949b-97078bf3982e',1,5,NULL,NULL),('019f9d4d-5690-7102-ada4-ab0692bd293c',1,1,NULL,NULL),('019f9d4d-5690-7102-ada4-ab0692bd293c',1,2,NULL,NULL),('019f9d4d-5690-7102-ada4-ab0692bd293c',1,3,NULL,NULL),('019f9d4d-5690-7102-ada4-ab0692bd293c',1,4,NULL,NULL),('019f9d4d-5690-7102-ada4-ab0692bd293c',1,5,NULL,NULL),('019f9d4d-5693-7297-b936-5ba10bef53c1',1,1,NULL,NULL),('019f9d4d-5693-7297-b936-5ba10bef53c1',1,2,NULL,NULL),('019f9d4d-5693-7297-b936-5ba10bef53c1',1,3,NULL,NULL),('019f9d4d-5693-7297-b936-5ba10bef53c1',1,4,NULL,NULL),('019f9d4d-5693-7297-b936-5ba10bef53c1',1,5,NULL,NULL),('019f9d4d-5696-718c-aa40-4fc516f0bcba',1,1,NULL,NULL),('019f9d4d-5696-718c-aa40-4fc516f0bcba',1,2,NULL,NULL),('019f9d4d-5696-718c-aa40-4fc516f0bcba',1,3,NULL,NULL),('019f9d4d-5696-718c-aa40-4fc516f0bcba',1,4,NULL,NULL),('019f9d4d-5696-718c-aa40-4fc516f0bcba',1,5,NULL,NULL),('019f9d4d-5699-7069-973e-9da6e5f98b19',1,1,NULL,NULL),('019f9d4d-5699-7069-973e-9da6e5f98b19',1,2,NULL,NULL),('019f9d4d-5699-7069-973e-9da6e5f98b19',1,3,NULL,NULL),('019f9d4d-5699-7069-973e-9da6e5f98b19',1,4,NULL,NULL),('019f9d4d-5699-7069-973e-9da6e5f98b19',1,5,NULL,NULL),('019f9d4d-569b-72f9-a785-c7bc3119affe',1,1,NULL,NULL),('019f9d4d-569b-72f9-a785-c7bc3119affe',1,2,NULL,NULL),('019f9d4d-569b-72f9-a785-c7bc3119affe',1,3,NULL,NULL),('019f9d4d-569b-72f9-a785-c7bc3119affe',1,4,NULL,NULL),('019f9d4d-569b-72f9-a785-c7bc3119affe',1,5,NULL,NULL),('019f9d4d-569d-7071-b998-c9954314d3cf',1,1,NULL,NULL),('019f9d4d-569d-7071-b998-c9954314d3cf',1,2,NULL,NULL),('019f9d4d-569d-7071-b998-c9954314d3cf',1,3,NULL,NULL),('019f9d4d-569d-7071-b998-c9954314d3cf',1,4,NULL,NULL),('019f9d4d-569d-7071-b998-c9954314d3cf',1,5,NULL,NULL),('019f9d4d-56a0-7287-b82e-2d79bd218b40',1,1,NULL,NULL),('019f9d4d-56a0-7287-b82e-2d79bd218b40',1,2,NULL,NULL),('019f9d4d-56a0-7287-b82e-2d79bd218b40',1,3,NULL,NULL),('019f9d4d-56a0-7287-b82e-2d79bd218b40',1,4,NULL,NULL),('019f9d4d-56a0-7287-b82e-2d79bd218b40',1,5,NULL,NULL),('019f9d4d-56a2-7372-ba9a-4666ffcd0fe0',1,1,NULL,NULL),('019f9d4d-56a2-7372-ba9a-4666ffcd0fe0',1,2,NULL,NULL),('019f9d4d-56a2-7372-ba9a-4666ffcd0fe0',1,3,NULL,NULL),('019f9d4d-56a2-7372-ba9a-4666ffcd0fe0',1,4,NULL,NULL),('019f9d4d-56a2-7372-ba9a-4666ffcd0fe0',1,5,NULL,NULL),('019f9d4d-56a5-718f-b8ff-5b1a6b0e6458',1,1,NULL,NULL),('019f9d4d-56a5-718f-b8ff-5b1a6b0e6458',1,2,NULL,NULL),('019f9d4d-56a5-718f-b8ff-5b1a6b0e6458',1,3,NULL,NULL),('019f9d4d-56a5-718f-b8ff-5b1a6b0e6458',1,4,NULL,NULL),('019f9d4d-56a5-718f-b8ff-5b1a6b0e6458',1,5,NULL,NULL),('019f9d4d-56a7-71a8-9e7b-bbea41e4373a',1,1,NULL,NULL),('019f9d4d-56a7-71a8-9e7b-bbea41e4373a',1,2,NULL,NULL),('019f9d4d-56a7-71a8-9e7b-bbea41e4373a',1,3,NULL,NULL),('019f9d4d-56a7-71a8-9e7b-bbea41e4373a',1,4,NULL,NULL),('019f9d4d-56a7-71a8-9e7b-bbea41e4373a',1,5,NULL,NULL),('019f9d4d-56a9-720b-abbc-00afe391676e',1,1,NULL,NULL),('019f9d4d-56a9-720b-abbc-00afe391676e',1,2,NULL,NULL),('019f9d4d-56a9-720b-abbc-00afe391676e',1,3,NULL,NULL),('019f9d4d-56a9-720b-abbc-00afe391676e',1,4,NULL,NULL),('019f9d4d-56a9-720b-abbc-00afe391676e',1,5,NULL,NULL),('019f9d4d-56ac-7307-bd8b-0ca0f4755cdf',1,1,NULL,NULL),('019f9d4d-56ac-7307-bd8b-0ca0f4755cdf',1,2,NULL,NULL),('019f9d4d-56ac-7307-bd8b-0ca0f4755cdf',1,3,NULL,NULL),('019f9d4d-56ac-7307-bd8b-0ca0f4755cdf',1,4,NULL,NULL),('019f9d4d-56ac-7307-bd8b-0ca0f4755cdf',1,5,NULL,NULL),('019f9d4d-56ae-725a-9149-d4420c0ed77e',1,1,NULL,NULL),('019f9d4d-56ae-725a-9149-d4420c0ed77e',1,2,NULL,NULL),('019f9d4d-56ae-725a-9149-d4420c0ed77e',1,3,NULL,NULL),('019f9d4d-56ae-725a-9149-d4420c0ed77e',1,4,NULL,NULL),('019f9d4d-56ae-725a-9149-d4420c0ed77e',1,5,NULL,NULL),('019f9d4d-56b1-73e7-8b3e-190c47e931ae',1,1,NULL,NULL),('019f9d4d-56b1-73e7-8b3e-190c47e931ae',1,2,NULL,NULL),('019f9d4d-56b1-73e7-8b3e-190c47e931ae',1,3,NULL,NULL),('019f9d4d-56b1-73e7-8b3e-190c47e931ae',1,4,NULL,NULL),('019f9d4d-56b1-73e7-8b3e-190c47e931ae',1,5,NULL,NULL),('019f9d4d-56b3-7140-a624-9c806306299a',1,1,NULL,NULL),('019f9d4d-56b3-7140-a624-9c806306299a',1,2,NULL,NULL),('019f9d4d-56b3-7140-a624-9c806306299a',1,3,NULL,NULL),('019f9d4d-56b3-7140-a624-9c806306299a',1,4,NULL,NULL),('019f9d4d-56b3-7140-a624-9c806306299a',1,5,NULL,NULL),('019f9d4d-56b6-712b-a2cb-71356f1af203',1,1,NULL,NULL),('019f9d4d-56b6-712b-a2cb-71356f1af203',1,2,NULL,NULL),('019f9d4d-56b6-712b-a2cb-71356f1af203',1,3,NULL,NULL),('019f9d4d-56b6-712b-a2cb-71356f1af203',1,4,NULL,NULL),('019f9d4d-56b6-712b-a2cb-71356f1af203',1,5,NULL,NULL),('019f9d4d-56b9-7354-b655-c8e71a5000be',1,1,NULL,NULL),('019f9d4d-56b9-7354-b655-c8e71a5000be',1,2,NULL,NULL),('019f9d4d-56b9-7354-b655-c8e71a5000be',1,3,NULL,NULL),('019f9d4d-56b9-7354-b655-c8e71a5000be',1,4,NULL,NULL),('019f9d4d-56b9-7354-b655-c8e71a5000be',1,5,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',2,1,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',2,2,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',2,3,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',2,4,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',2,5,NULL,NULL),('019f9d4d-567c-7022-89b9-2fe00234ee1e',2,1,NULL,NULL),('019f9d4d-567c-7022-89b9-2fe00234ee1e',2,2,NULL,NULL),('019f9d4d-567c-7022-89b9-2fe00234ee1e',2,3,NULL,NULL),('019f9d4d-567c-7022-89b9-2fe00234ee1e',2,4,NULL,NULL),('019f9d4d-567c-7022-89b9-2fe00234ee1e',2,5,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',3,1,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',3,2,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',3,3,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',3,4,NULL,NULL),('019f9d4d-566c-739e-982c-6dc653775fcb',3,5,NULL,NULL),('019f9d4d-56a0-7287-b82e-2d79bd218b40',3,1,NULL,NULL),('019f9d4d-56a0-7287-b82e-2d79bd218b40',3,3,NULL,NULL),('019fb1b1-4622-7107-b5ec-43dba73153e1',1,1,NULL,NULL),('019fb1b1-4622-7107-b5ec-43dba73153e1',1,2,NULL,NULL),('019fb1b1-4622-7107-b5ec-43dba73153e1',1,3,NULL,NULL),('019fb1b1-4622-7107-b5ec-43dba73153e1',1,4,NULL,NULL),('019fb1b1-4622-7107-b5ec-43dba73153e1',1,5,NULL,NULL),('019fb1b1-463c-71eb-8be3-59be2f1617a3',1,1,NULL,NULL),('019fb1b1-463c-71eb-8be3-59be2f1617a3',1,2,NULL,NULL),('019fb1b1-463c-71eb-8be3-59be2f1617a3',1,3,NULL,NULL),('019fb1b1-463c-71eb-8be3-59be2f1617a3',1,4,NULL,NULL),('019fb1b1-463c-71eb-8be3-59be2f1617a3',1,5,NULL,NULL),('019fb1b1-464c-704b-8789-6263e0933964',1,1,NULL,NULL),('019fb1b1-464c-704b-8789-6263e0933964',1,2,NULL,NULL),('019fb1b1-464c-704b-8789-6263e0933964',1,3,NULL,NULL),('019fb1b1-464c-704b-8789-6263e0933964',1,4,NULL,NULL),('019fb1b1-464c-704b-8789-6263e0933964',1,5,NULL,NULL),('019fb1b1-465e-7096-93d0-ba9a974e6f76',1,1,NULL,NULL),('019fb1b1-465e-7096-93d0-ba9a974e6f76',1,2,NULL,NULL),('019fb1b1-465e-7096-93d0-ba9a974e6f76',1,3,NULL,NULL),('019fb1b1-465e-7096-93d0-ba9a974e6f76',1,4,NULL,NULL),('019fb1b1-465e-7096-93d0-ba9a974e6f76',1,5,NULL,NULL),('ffe66421-3e03-4510-aaa9-9c750fc6a6f1',1,1,'2026-08-23 02:28:41','2026-08-23 02:28:41'),('ffe66421-3e03-4510-aaa9-9c750fc6a6f1',1,2,'2026-08-23 02:28:41','2026-08-23 02:28:41'),('ffe66421-3e03-4510-aaa9-9c750fc6a6f1',1,3,'2026-08-23 02:28:41','2026-08-23 02:28:41'),('ffe66421-3e03-4510-aaa9-9c750fc6a6f1',1,4,'2026-08-23 02:28:41','2026-08-23 02:28:41'),('ffe66421-3e03-4510-aaa9-9c750fc6a6f1',1,5,'2026-08-23 02:28:41','2026-08-23 02:28:41'),('b184b179-c943-4f1d-a122-ddffb2069786',1,1,'2026-08-23 02:28:41','2026-08-23 02:28:41'),('b184b179-c943-4f1d-a122-ddffb2069786',1,2,'2026-08-23 02:28:41','2026-08-23 02:28:41'),('b184b179-c943-4f1d-a122-ddffb2069786',1,3,'2026-08-23 02:28:41','2026-08-23 02:28:41'),('b184b179-c943-4f1d-a122-ddffb2069786',1,4,'2026-08-23 02:28:41','2026-08-23 02:28:41'),('b184b179-c943-4f1d-a122-ddffb2069786',1,5,'2026-08-23 02:28:41','2026-08-23 02:28:41');
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
INSERT INTO `menus` VALUES ('019f9d4d-566c-739e-982c-6dc653775fcb',1,NULL,'Beranda','beranda',1,'dashboard','icofont icofont-ui-home',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-5676-70cf-b847-8da00471d2c6',5,NULL,'Pengguna','pengguna',2,'users','icofont icofont-ui-user-group',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-5679-738c-a903-eff2a69b3689',5,NULL,'Otoritas','otoritas',4,'otoritas','icofont icofont-shield-alt',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-567c-7022-89b9-2fe00234ee1e',1,NULL,'Profil','profil',5,'profil','icofont icofont-ui-user',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-567e-7337-8cbd-47256c97134e',2,NULL,'Visi dan Misi','visi_misi',1,'visi_misi','icofont icofont-paper-plane',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-5680-71b3-8f02-f3cf40d8539c',2,NULL,'Tugas dan Fungsi','tugas_fungsi',2,'tugas_fungsi','icofont icofont-tasks-alt',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-5682-70b5-91a1-04d5f2362233',2,NULL,'Tim Kerja','tim_kerja',3,'tim_kerja','icofont icofont-users-alt-2',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-5685-72cd-837b-eac502e6f6f2',2,NULL,'Janji & Maklumat Layanan','janji_maklumat',4,'janji_maklumat','icofont icofont-certificate-alt-1',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-5688-7180-a6f5-c4cf4c733559',2,NULL,'Profil Pejabat Struktural','profil_pejabat',5,'profil_pejabat','icofont icofont-users-social',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-568b-71c1-8481-74c4d75fc412',2,NULL,'Struktur Organisasi','struktur_organisasi',6,'struktur_organisasi','icofont icofont-network',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-568e-710e-949b-97078bf3982e',2,NULL,'Sejarah','sejarah',7,'sejarah','icofont icofont-history',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-5690-7102-ada4-ab0692bd293c',2,NULL,'Perilaku & Core Value','perilaku_core_value',8,'perilaku-core-value','icofont icofont-badge',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-5693-7297-b936-5ba10bef53c1',2,NULL,'Rencana Strategis','rencana_strategis',9,'rencana-strategis','icofont icofont-target-audience',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-5696-718c-aa40-4fc516f0bcba',2,NULL,'Perjanjian Kerja','perjanjian_kerja',10,'perjanjian-kerja','icofont icofont-paper',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-5699-7069-973e-9da6e5f98b19',2,NULL,'Laporan Kerja','laporan_kerja',11,'laporan-kerja','icofont icofont-file-text',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-569b-72f9-a785-c7bc3119affe',3,NULL,'Informasi & Program','informasi_program',1,'informasi_program','icofont icofont-info-square',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-569d-7071-b998-c9954314d3cf',3,NULL,'Kemitraan','kemitraan',2,'kemitraan','icofont icofont-handshake-deal',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-56a0-7287-b82e-2d79bd218b40',3,NULL,'QnA','qna',3,'qna','icofont icofont-chat',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-56a2-7372-ba9a-4666ffcd0fe0',3,NULL,'Permohonan Informasi','permohonan_informasi',4,'permohonan_informasi','icofont icofont-file-document',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-56a5-718f-b8ff-5b1a6b0e6458',3,NULL,'Permohonan Kerja Sama','permohonan_kerja_sama',5,'permohonan_kerja_sama','icofont icofont-handshake-deal',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-56a7-71a8-9e7b-bbea41e4373a',3,NULL,'Permohonan Narasumber','permohonan_narasumber',6,'permohonan_narasumber','icofont icofont-microphone-alt',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-56a9-720b-abbc-00afe391676e',3,NULL,'Permohonan Pemanfaatan Sarana & Prasarana','permohonan_sarana_prasarana',7,'permohonan_sarana_prasarana','icofont icofont-building-alt',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-56ac-7307-bd8b-0ca0f4755cdf',4,NULL,'Publikasi Artikel','artikel',1,'artikel','icofont icofont-read-book-alt',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-56ae-725a-9149-d4420c0ed77e',4,NULL,'Berita','berita',2,'berita','icofont icofont-news',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-56b1-73e7-8b3e-190c47e931ae',4,NULL,'Survey Kepuasan (SKM)','skm',3,'skm','icofont icofont-listing-box',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-56b3-7140-a624-9c806306299a',4,NULL,'Hasil Survey SKM','hasil_survey',4,'hasil_survey','icofont icofont-chart-histogram-alt',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-56b6-712b-a2cb-71356f1af203',4,NULL,'Data Sasaran','data_sasaran',5,'data_sasaran','icofont icofont-focus',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019f9d4d-56b9-7354-b655-c8e71a5000be',5,NULL,'Manajemen Menu','manajemen_menu',2,'manajemen-menu','icofont icofont-navigation-menu',1,'2026-07-26 07:21:59','2026-07-26 07:21:59',NULL),('019fb1b1-4622-7107-b5ec-43dba73153e1',3,NULL,'Peningkatan Guru','peningkatan_guru',8,'peningkatan-guru','icofont icofont-teacher',1,'2026-07-30 06:23:32','2026-07-30 06:23:32',NULL),('019fb1b1-463c-71eb-8be3-59be2f1617a3',3,NULL,'Peningkatan Kompetensi Kepala Sekolah','peningkatan_kompetensi_kepala_sekolah',9,'peningkatan-kompetensi-kepala-sekolah','icofont icofont-business-man-alt-2',1,'2026-07-30 06:23:32','2026-07-30 06:23:32',NULL),('019fb1b1-464c-704b-8789-6263e0933964',3,NULL,'Peningkatan Kompetensi Pengawas Sekolah','peningkatan_kompetensi_pengawas_sekolah',10,'peningkatan-kompetensi-pengawas-sekolah','icofont icofont-binoculars',1,'2026-07-30 06:23:32','2026-07-30 06:23:32',NULL),('019fb1b1-465e-7096-93d0-ba9a974e6f76',3,NULL,'Peningkatan Kompetensi Tenaga Pendidikan','peningkatan_kompetensi_tenaga_pendidikan',11,'peningkatan-kompetensi-tenaga-pendidikan','icofont icofont-graduate',1,'2026-07-30 06:23:32','2026-07-30 06:23:32',NULL),('b184b179-c943-4f1d-a122-ddffb2069786',5,NULL,'Rekapitulasi PTK','ptk_recap',21,'ptk/recap','icofont icofont-chart-pie-alt',1,'2026-08-23 02:28:41','2026-08-23 02:28:41',NULL),('ffe66421-3e03-4510-aaa9-9c750fc6a6f1',5,NULL,'Data PTK','ptk',20,'ptk','icofont icofont-listing-box',1,'2026-08-23 02:28:41','2026-08-23 02:28:41',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_09_17_034613_create_roles_table',1),(5,'2024_09_17_034639_create_actions_table',1),(6,'2024_09_17_034716_create_user_role_table',1),(7,'2024_09_17_035033_create_menu_groups_table',1),(8,'2024_09_17_035057_create_menus_table',1),(9,'2024_09_17_035349_create_menu_role_table',1),(10,'2024_09_17_043523_create_audits_table',1),(11,'2025_03_26_032232_create_profil_table',1),(12,'2026_04_17_032754_create_beritas_table',1),(13,'2026_04_17_032755_create_artikels_table',1),(14,'2026_04_17_032756_create_artikel_images_table',1),(15,'2026_04_17_032756_create_berita_images_table',1),(16,'2026_04_17_032756_create_hasil_surveys_table',1),(17,'2026_04_17_032756_create_skms_table',1),(18,'2026_04_17_032814_create_informasi_programs_table',1),(19,'2026_04_17_032814_create_janji_maklumats_table',1),(20,'2026_04_17_032814_create_kemitraans_table',1),(21,'2026_04_17_032814_create_profil_pejabats_table',1),(22,'2026_04_17_032814_create_tim_kerjas_table',1),(23,'2026_04_17_032814_create_visi_misis_table',1),(24,'2026_04_17_032815_create_visi_misi_images_table',1),(25,'2026_04_17_032816_create_janji_maklumat_images_table',1),(26,'2026_04_17_032816_create_profil_pejabat_images_table',1),(27,'2026_04_17_032816_create_tim_kerja_images_table',1),(28,'2026_04_17_032816_create_tugas_fungsis_table',1),(29,'2026_04_17_032817_create_informasi_program_files_table',1),(30,'2026_04_17_032817_create_kemitraan_files_table',1),(31,'2026_04_18_051946_create_qnas_table',1),(32,'2026_05_03_161106_create_personal_access_tokens_table',1),(33,'2026_06_24_103943_add_answered_at_to_qnas_table',1),(34,'2026_06_29_122649_create_struktur_organisasis',1),(35,'2026_06_29_122851_create_data_sasarans',1),(36,'2026_06_29_123324_create_permohonan_informasis',1),(37,'2026_06_29_151722_create_permohonan_narasumbers',1),(38,'2026_06_29_151814_create_permohonan_kerja_samas',1),(39,'2026_06_29_151839_create_permohonan_sarana_prasaranas',1),(40,'2026_07_17_173908_add_sekolah_model_to_qnas_category_enum',2),(41,'2026_07_26_111416_create_sejarahs_table',3),(42,'2026_07_26_111441_create_perilaku_core_values_table',3),(43,'2026_07_26_111504_create_rencana_strategis_table',3),(44,'2026_07_26_111526_create_perjanjian_kerjas_table',3),(45,'2026_07_26_111545_create_laporan_kerjas_table',3),(46,'2026_07_29_235641_create_peningkatan_gurus_table',4),(47,'2026_07_29_235642_create_peningkatan_kompetensi_kepala_sekolahs_table',4),(48,'2026_07_29_235643_create_peningkatan_kompetensi_pengawas_sekolahs_table',4),(49,'2026_07_29_235644_create_peningkatan_kompetensi_tenaga_pendidikans_table',4),(51,'2026_08_19_150000_create_qna_categories_table',5),(52,'2026_08_19_150001_qna_category_to_relation',5),(53,'2026_08_21_144611_create_ptk_fields_table',6),(54,'2026_08_21_144651_create_ptks_table',6),(55,'2026_08_21_144747_seed_default_ptk_fields',6),(56,'2026_08_21_174835_add_jumlah_to_ptks_table',7);
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
-- Table structure for table `peningkatan_gurus`
--

DROP TABLE IF EXISTS `peningkatan_gurus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peningkatan_gurus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peningkatan_gurus`
--

LOCK TABLES `peningkatan_gurus` WRITE;
/*!40000 ALTER TABLE `peningkatan_gurus` DISABLE KEYS */;
INSERT INTO `peningkatan_gurus` VALUES (1,'peningkatan_gurus/HQwCmjQQKaOsRYCFGl9yUIqof53eMKh345hrw4JY.jpg','Program Peningkatan Kompetensi Guru Bengkulu hadir sebagai wadah transformasi bagi para pendidik di seluruh penjuru daerah. Kami percaya bahwa kualitas pendidikan berakar pada kualitas pengajarnya. Oleh karena itu, program ini dirancang khusus untuk membekali para guru dengan metode pengajaran adaptif, literasi digital, dan keterampilan kepemimpinan ruang kelas. Bersama-sama, kita wujudkan ekosistem belajar yang inspiratif dan melahirkan generasi emas Bengkulu yang siap bersaing di masa depan.','2026-07-30 06:24:27','2026-08-12 07:35:19');
/*!40000 ALTER TABLE `peningkatan_gurus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peningkatan_kompetensi_kepala_sekolahs`
--

DROP TABLE IF EXISTS `peningkatan_kompetensi_kepala_sekolahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peningkatan_kompetensi_kepala_sekolahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peningkatan_kompetensi_kepala_sekolahs`
--

LOCK TABLES `peningkatan_kompetensi_kepala_sekolahs` WRITE;
/*!40000 ALTER TABLE `peningkatan_kompetensi_kepala_sekolahs` DISABLE KEYS */;
INSERT INTO `peningkatan_kompetensi_kepala_sekolahs` VALUES (1,'peningkatan_kompetensi_kepala_sekolahs/tl7HtqplnTi4xoklFyqRqaZzRjRzryDnKABEblDJ.jpg','dadadada','2026-08-12 07:34:42','2026-08-12 07:34:42');
/*!40000 ALTER TABLE `peningkatan_kompetensi_kepala_sekolahs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peningkatan_kompetensi_pengawas_sekolahs`
--

DROP TABLE IF EXISTS `peningkatan_kompetensi_pengawas_sekolahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peningkatan_kompetensi_pengawas_sekolahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peningkatan_kompetensi_pengawas_sekolahs`
--

LOCK TABLES `peningkatan_kompetensi_pengawas_sekolahs` WRITE;
/*!40000 ALTER TABLE `peningkatan_kompetensi_pengawas_sekolahs` DISABLE KEYS */;
/*!40000 ALTER TABLE `peningkatan_kompetensi_pengawas_sekolahs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peningkatan_kompetensi_tenaga_pendidikans`
--

DROP TABLE IF EXISTS `peningkatan_kompetensi_tenaga_pendidikans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peningkatan_kompetensi_tenaga_pendidikans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peningkatan_kompetensi_tenaga_pendidikans`
--

LOCK TABLES `peningkatan_kompetensi_tenaga_pendidikans` WRITE;
/*!40000 ALTER TABLE `peningkatan_kompetensi_tenaga_pendidikans` DISABLE KEYS */;
/*!40000 ALTER TABLE `peningkatan_kompetensi_tenaga_pendidikans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perilaku_core_values`
--

DROP TABLE IF EXISTS `perilaku_core_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perilaku_core_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perilaku_core_values`
--

LOCK TABLES `perilaku_core_values` WRITE;
/*!40000 ALTER TABLE `perilaku_core_values` DISABLE KEYS */;
INSERT INTO `perilaku_core_values` VALUES (3,'Panduan Perilaku dan Core Value KGTK Bengkulu','Panduan Perilaku dan Core Value KGTK Bengkulu','perilaku_core_values/DlNY3uD394qNqAjigLrp3FrEPpgGiu8LxGRYjfHA.pdf','2026-07-29 06:50:57','2026-07-29 06:50:57');
/*!40000 ALTER TABLE `perilaku_core_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perjanjian_kerjas`
--

DROP TABLE IF EXISTS `perjanjian_kerjas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perjanjian_kerjas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perjanjian_kerjas`
--

LOCK TABLES `perjanjian_kerjas` WRITE;
/*!40000 ALTER TABLE `perjanjian_kerjas` DISABLE KEYS */;
INSERT INTO `perjanjian_kerjas` VALUES (2,'Perjanjian Kerja','Tautan dan Dokumen','perjanjian_kerjas/XUdD6xOr5cX2hVcsvZzyn160MeefbZ5d4SppG3Xa.pdf','2026-07-27 04:35:19','2026-08-12 07:54:55');
/*!40000 ALTER TABLE `perjanjian_kerjas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permohonan_informasis`
--

DROP TABLE IF EXISTS `permohonan_informasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permohonan_informasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permohonan_informasis`
--

LOCK TABLES `permohonan_informasis` WRITE;
/*!40000 ALTER TABLE `permohonan_informasis` DISABLE KEYS */;
INSERT INTO `permohonan_informasis` VALUES (1,'https://docs.google.com/forms/d/e/1FAIpQLSeOnHX-Gd-TiYZ-eCIw4LUq25z3jVFP4GuLr929lYYVJGuO2g/viewform?usp=publish-editor','2026-07-15 09:55:55','2026-08-12 07:32:11');
/*!40000 ALTER TABLE `permohonan_informasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permohonan_kerja_samas`
--

DROP TABLE IF EXISTS `permohonan_kerja_samas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permohonan_kerja_samas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permohonan_kerja_samas`
--

LOCK TABLES `permohonan_kerja_samas` WRITE;
/*!40000 ALTER TABLE `permohonan_kerja_samas` DISABLE KEYS */;
INSERT INTO `permohonan_kerja_samas` VALUES (1,'https://docs.google.com/forms/d/e/1FAIpQLSeOnHX-Gd-TiYZ-eCIw4LUq25z3jVFP4GuLr929lYYVJGuO2g/viewform?usp=publish-editor','2026-08-12 07:31:43','2026-08-12 07:31:43');
/*!40000 ALTER TABLE `permohonan_kerja_samas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permohonan_narasumbers`
--

DROP TABLE IF EXISTS `permohonan_narasumbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permohonan_narasumbers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permohonan_narasumbers`
--

LOCK TABLES `permohonan_narasumbers` WRITE;
/*!40000 ALTER TABLE `permohonan_narasumbers` DISABLE KEYS */;
INSERT INTO `permohonan_narasumbers` VALUES (1,'https://accenture.wd103.myworkdayjobs.com/en-US/AccentureCareers/job/SAP-ABAP-Associate_R00265289','2026-07-29 06:53:54','2026-07-29 06:53:54');
/*!40000 ALTER TABLE `permohonan_narasumbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permohonan_sarana_prasaranas`
--

DROP TABLE IF EXISTS `permohonan_sarana_prasaranas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permohonan_sarana_prasaranas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permohonan_sarana_prasaranas`
--

LOCK TABLES `permohonan_sarana_prasaranas` WRITE;
/*!40000 ALTER TABLE `permohonan_sarana_prasaranas` DISABLE KEYS */;
INSERT INTO `permohonan_sarana_prasaranas` VALUES (1,'https://docs.google.com/forms/d/e/1FAIpQLSeOnHX-Gd-TiYZ-eCIw4LUq25z3jVFP4GuLr929lYYVJGuO2g/viewform?usp=publish-editor','2026-07-29 06:53:33','2026-08-12 07:31:17');
/*!40000 ALTER TABLE `permohonan_sarana_prasaranas` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profil`
--

LOCK TABLES `profil` WRITE;
/*!40000 ALTER TABLE `profil` DISABLE KEYS */;
INSERT INTO `profil` VALUES (1,'a226dc6a-bc1e-474c-8446-434616c4abd8','ade','adeseptiawan79@dikbud.belajar.id','082177795088','lebong selatan','1987-09-27',NULL,'Jl. M ali amin kandang limun',NULL,NULL,NULL,NULL,NULL,'2026-07-01 03:53:29','2026-07-01 03:53:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profil_pejabats`
--

LOCK TABLES `profil_pejabats` WRITE;
/*!40000 ALTER TABLE `profil_pejabats` DISABLE KEYS */;
/*!40000 ALTER TABLE `profil_pejabats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ptk_fields`
--

DROP TABLE IF EXISTS `ptk_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ptk_fields` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('text','number','select','date') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `options` json DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `is_filterable` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ptk_fields_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ptk_fields`
--

LOCK TABLES `ptk_fields` WRITE;
/*!40000 ALTER TABLE `ptk_fields` DISABLE KEYS */;
INSERT INTO `ptk_fields` VALUES (3,'Jenjang','jenjang','select','[\"PAUD\", \"SD\", \"SLB\", \"SMA\", \"SMK\", \"SMP\", \"SPNF\"]',1,1,3,'2026-08-21 10:41:36','2026-08-21 10:41:36'),(4,'Jabatan','jabatan','select','[\"Guru\", \"Kepala Sekolah\", \"Tenaga Kependidikan\"]',1,1,4,'2026-08-21 10:41:36','2026-08-21 10:41:36');
/*!40000 ALTER TABLE `ptk_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ptks`
--

DROP TABLE IF EXISTS `ptks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ptks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data` json NOT NULL,
  `jumlah` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ptks`
--

LOCK TABLES `ptks` WRITE;
/*!40000 ALTER TABLE `ptks` DISABLE KEYS */;
/*!40000 ALTER TABLE `ptks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qna_categories`
--

DROP TABLE IF EXISTS `qna_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qna_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `qna_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qna_categories`
--

LOCK TABLES `qna_categories` WRITE;
/*!40000 ALTER TABLE `qna_categories` DISABLE KEYS */;
INSERT INTO `qna_categories` VALUES (1,'PPG','ppg',1,0,'2026-08-19 08:29:43','2026-08-19 08:29:43'),(2,'BCKS','bcks',1,0,'2026-08-19 08:29:43','2026-08-19 08:29:43'),(3,'BCPS','bcps',1,0,'2026-08-19 08:29:43','2026-08-19 08:29:43'),(4,'PKGBK','pkgbk',1,0,'2026-08-19 08:29:43','2026-08-19 08:29:43'),(5,'PKGSD MBI','pkgsd-mbi',1,0,'2026-08-19 08:29:43','2026-08-19 08:29:43'),(6,'STEM','stem',1,0,'2026-08-19 08:29:43','2026-08-19 08:29:43'),(7,'PM/KKA','pmkka',1,0,'2026-08-19 08:29:43','2026-08-19 08:29:43'),(8,'UKKJ','ukkj',1,0,'2026-08-19 08:29:43','2026-08-19 08:29:43'),(9,'GPK Mahir','gpk-mahir',1,0,'2026-08-19 08:29:43','2026-08-19 08:29:43'),(10,'Sekolah Model','sekolah-model',1,0,'2026-08-19 08:29:43','2026-08-19 08:29:43');
/*!40000 ALTER TABLE `qna_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qnas`
--

DROP TABLE IF EXISTS `qnas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qnas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `answered_at` timestamp NULL DEFAULT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qnas_user_id_foreign` (`user_id`),
  KEY `qnas_category_id_foreign` (`category_id`),
  CONSTRAINT `qnas_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `qna_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `qnas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qnas`
--

LOCK TABLES `qnas` WRITE;
/*!40000 ALTER TABLE `qnas` DISABLE KEYS */;
INSERT INTO `qnas` VALUES (8,'Nasyith forefry','KGTK',81318458540,'forefry@gmail.com',8,'Jika Penilaian Kinerja belum masuk ruang GTK apakah bisa mengikuti UKKJ','Untuk Gelombang satu tahun ini masih kami beri dispensasi dapat mengikuti. Namun yang terdaftar dalam gelombang 2 wajib menggunakan penilaian kinerja yang ada di ruang GTK','2026-06-25 03:37:44','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 03:35:55','2026-06-25 03:37:44'),(9,'Indra Avico','SDN 01 Seberang Musi',89507975093,'indraavico44@gmail.com',6,'kapan kegiatan STEM dilaksanakan untuk wilayah prov. Bengkulu ?','stem akan dilaksanakan insyaAllah dibulan Oktober','2026-06-25 13:05:27','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:47:20','2026-06-25 13:05:27'),(10,'Ersy Sonata','Sdn 05 Bengkulu Tengah',81271999864,'ersysonata64@gmail.com',2,'Kapan kegiatan BCKS 2026 dimulai','bcks akan dimulai di bulan agustus','2026-06-25 13:06:29','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:47:47','2026-06-25 13:06:29'),(11,'Fakhrurrozi Ikhsan','SD Negeri 10 Kepahiang',82284279079,'roziikhsanfakhrur@gmail.com',6,'Apa saja sintaks pendekatan STEM?','| Tahap             | Tujuan                   | Aktivitas Utama            |\r\n| ----------------- | ------------------------ | -------------------------- |\r\n| 1. Ask            | Mengidentifikasi masalah | Mengamati dan bertanya     |\r\n| 2. Research       | Mengumpulkan informasi   | Eksplorasi dan investigasi |\r\n| 3. Plan           | Merancang solusi         | Mendesain produk           |\r\n| 4. Create         | Membuat produk           | Membangun prototipe        |\r\n| 5. Test & Improve | Menguji dan memperbaiki  | Evaluasi dan revisi        |\r\n| 6. Communicate    | Menyampaikan hasil       | Presentasi dan refleksi    |','2026-06-26 01:33:01','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:47:48','2026-06-26 01:33:01'),(12,'DWI OKTA VIANI','SD MUHAMMADIYAH 5 KEPAHIANG',83803857730,'dwi4047@guru.sd.belajar.id',6,'Kapan pelatihan STEM bagi guru akan dilaksanakan?','Pelatihan stem insyaAllah dibulan oktober','2026-06-25 13:13:01','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:48:03','2026-06-25 13:13:01'),(13,'Ena Widayanti','SDN 72 Bengkulu Tengah',8989168194,'enawidayanti55@guru.sd.belajar.id',5,'Kapan adanya pelatihan guru bahasa inggris di sekolah dasar ?','Pelatihan guru bahasa inggris sedang berjalan. namun karena keterbatasan anggran baru kab rejang lebong','2026-06-25 13:14:07','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:48:16','2026-06-25 13:14:07'),(14,'Ria Yulia Sari','SD Negeri 10 Ujan Mas',85762975773,'riasari77@guru.sd.belajar.id',5,'Kapan diadakan pelatihan untuk mata pelajaran Bahasa Inggris bagi guru kelas SD','pelatihan PKGSDMBI sedang berjalan dikarenakan effisiensi anggaran  baru di kab rejang lebong yang berjalan','2026-06-25 12:56:31','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:48:24','2026-06-25 12:56:31'),(15,'Elpa setiawati','SDN 57 KOTA BENGKULU',82289668925,'elvasetiawati58@guru.sd.belajar.id',7,'Apakah tahun ini ada pelatihan KKA dari kementerian. \nTerimakasih 🙏🏻','Pelatihan KKA ada tetapi tidak berdiri sendiri digabung dengan PM','2026-06-25 13:35:55','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:48:43','2026-06-25 13:35:55'),(16,'Bethalisa Sukmaningtyas','SD Negeri 25 Kota Bengkulu',85353090001,'bethalisa10@gmail.com',7,'Bagaimana penerapan Kecerdasan Artifisial di sekolah dasar?','penerapan KA disekolah dasar dengan cara guru dapat menyiapkan media ajar agar media ajar konstektual untuk pembelajaran dapat memanfaatkan AI dan guru dapat membuat langkah langkah pembelajaran agar menarik untuk siswa dapat memanfaatkan AI untuk membuat Langkah-langkah pembelajaran tersebut','2026-06-26 01:18:23','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:48:44','2026-06-26 01:18:23'),(17,'YULIA EFRIYANI .M.Pd','SDN 22 Bengkulu Tengah',82378955334,'yulia.efriyani42@guru.sd.belajar.id',8,'Bagaiman kami yang sudah S2 dalam jabatan yang sama,apakah tetap harus menunggu 4 tahun baru bisa ujikom','Tidak perlu menunggu 4 tahun jika syarat sudah terpenuhi bisa mendaftar UKOM','2026-06-26 00:01:30','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:48:52','2026-06-26 00:01:30'),(18,'murdani','SDN 88 Kota Bengkulu',81373865808,'murdani.369@guru.sd.belajar.id',5,'Bagaimana cara mendapatkan pelatihan tentang PKGSD MBI - Peningkatan Kompetensi Guru Sekolah Dasar Mengajar Bahasa Inggris ?','untuk PKGSD MBI sasarannya saat ini adalah sekolah dasar yang belum ada guru yang memiliki kualifikasi bhs inggris dan belum ada pelajaran bahas inggris disekolah tersebut.','2026-06-26 01:21:40','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:49:15','2026-06-26 01:21:40'),(19,'Zakiah Al Amini Nur','SD IT DARUNNAJAH',82179071276,'alamininurzakiah@gmail.com',1,'Pak izin bertanya, saya PPG dari Ilmu Kimia MIPA. Apakah saya linier mengajar di SMP? Kalau iya, Mapel apa saja yang dapat saya ambil?','Bisa di chek pada Keputusan Menteri Pendidikan Dasar dan Menengah (Kepmendikdasmen) Nomor 222/O/2025 tentang Kesesuaian Bidang Tugas dengan Sertifikat Pendidik','2026-06-26 00:00:42','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:49:16','2026-06-26 00:00:42'),(20,'Tri Setio Handoko','SDN 55 Seluma',81278199544,'trisetio99@gmail.com',7,'Dari mana saya bisa mendapat sumber yang baik dalam merancang sebuah pembelajaran matematika yang tidak menakutkan dan menyenangkan untuk anak sekolah dasar?','Bisa dengan menerapkan Tahapan Pembelajaran Matematika Gembira sebagaimana yang dikuti sekarang atau dapat bertanya dengan para Fasda yang sudah dilatih oleh KGTK. Untuk informasi lengkap terkait dengan Numerasi baik di sekolah, keluarga, masyarakat, dan media dapat dilihat pada link berikut : https://guru.kemendikdasmen.go.id/gnn/sumber-belajar','2026-06-26 01:39:22','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:49:22','2026-06-26 01:39:22'),(21,'Melda Dwi Novita','SDN 61 Kota Bengkulu',89657747392,'meldanovita71@guru.sd.belajar.id',6,'Adakah kegiatan perlombaan yang terkait dengan STEM untuk Kategori siswa Sekolah Dasar','Untuk lomba Siswa dibawah kewenangan Direktorat Jenderal PDM','2026-07-02 14:10:56','a226f36f-a62b-47c8-8c10-d2ff4ff823e0','2026-06-25 09:49:39','2026-07-02 14:10:56'),(22,'Elsie Astreani','SD Alam Mahira Kota Bengkulu',82178495772,'elsieastreani69@guru.sd.belajar.id',4,'Kapan ada pelatihan guru bimbingan khusus?','pelatihan PKGBK akan dilaksanakan di bulan agustus 2026','2026-06-25 12:48:06','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:49:43','2026-06-25 12:48:06'),(23,'Vebbriza Novri Sanica','SD Negeri 65 Seluma',83171184835,'vebbrizanovrisanica25@gmail.com',6,'Apa itu STEM ?\nMengapa pendekatan ini ini penting dan apa saja kelebihan  dari pembelajaran STEM ini terutama untuk anak sekolah dasar?','STEM merupakan singkatan dari Science (Sains), Technology (Teknologi), Engineering (Rekayasa), dan Mathematics (Matematika). STEM bukan sekadar mengajarkan empat mata pelajaran tersebut secara terpisah, melainkan mengintegrasikan keempatnya dalam satu pengalaman belajar yang kontekstual untuk memecahkan masalah nyata.\r\n\r\nDalam pembelajaran STEM, peserta didik diajak untuk:\r\n\r\nmengamati fenomena,\r\nmengajukan pertanyaan,\r\nmencari informasi,\r\nmerancang solusi,\r\nmembuat prototipe,\r\nmenguji hasil,\r\nmemperbaiki desain,\r\nserta mengomunikasikan temuannya.\r\n\r\nDengan demikian, STEM menempatkan peserta didik sebagai problem solver, inovator, dan pencipta, bukan hanya sebagai penerima informasi\r\n\r\nPendekatan STEM menjadi sangat penting karena dunia saat ini menghadapi perubahan yang sangat cepat akibat perkembangan teknologi, digitalisasi, kecerdasan artifisial (AI), otomatisasi, dan tantangan global seperti perubahan iklim, energi, kesehatan, serta ketahanan pangan.\r\n\r\nSekolah perlu mempersiapkan peserta didik agar tidak hanya menguasai pengetahuan, tetapi juga memiliki kemampuan untuk:\r\n\r\nberpikir kritis dalam menganalisis masalah;\r\nberpikir kreatif menghasilkan solusi;\r\nberkolaborasi dengan orang lain;\r\nberkomunikasi secara efektif;\r\nmemanfaatkan teknologi secara bijaksana;\r\nmampu beradaptasi terhadap perubahan.','2026-06-26 01:30:20','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:49:59','2026-06-26 01:30:20'),(24,'Sari Prehati','SD negeri 068 Bengkulu Utara',82269229704,'sarisd10@gmail.com',1,'Apakah wajib mengikuti UJIKOM untuk kenaikan jenjang jabatan?','Berdasarkan Permenpan RB No. 1 Tahun 2023 dan Permenpan RB No. 7 Tahun 2026, setiap Aparatur Sipil Negara (ASN) yang akan naik Jenjang Jabatan Fungsional (bukan sekadar naik pangkat biasa dalam satu jenjang) wajib mengikuti dan dinyatakan lulus Uji Kompetensi Kenaikan Jenjang (UKKJ).','2026-06-25 23:59:55','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:50:41','2026-06-25 23:59:55'),(25,'OKPI DIANA, S.Pd','SD NEGERI 83 KOTA BENGKULU',81367488694,'okpidiana10@guru.sd.belajar.id',6,'Kaapan  STEM dilaksanakan?','STEM akan dilaksanakan pada bulan oktober','2026-06-25 09:52:29','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:50:45','2026-06-25 09:52:29'),(26,'Lilian Anggela','SDN 107 SELUMA',81377777741,'liliyan332@gmail.com',8,'Saya akan naik jenjang ke IV A, apakah saya dapat mengikuti ukom, dari mana saya bisa mencari informasi tentang ukom untuk naik pangkat ke berikutnya. terima kasih','Anda dapat mengikuti UKOM ketika semua persyaratan terpenuhi dan tersedia formasi pada jabatan yang anda tuju. Anda dapat mencari informasi pada situs resmi ukom kemendikdasmen https://ujikompetensi.kemendikdasmen.go.id/, akun SIMPKB, Kantor GTK Bengkulu, Dinas Pendidikan dan Kebudayaan.','2026-06-25 23:58:50','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:52:00','2026-06-25 23:58:50'),(27,'Disma Riza','SDN 15 Bengkulu Tengah',85266790582,'dismariza@gmail.com',1,'Saya PNS golongan 3B dan sudah lulus S2. Apakah harus menunggu 4 tahun dalam golongan tersebut untuk bisa melaksanakan uji kompetensi ?\nApakah sertifikat pendidik belum cukup kuat untuk mengakui bahwa guru tersebut sudah berkompetensi ?\nMengapa masih harus ikut uji kompetensi untuk naik ke golongan 3C ?','Kenaikan jenjang jabatan dari Guru Ahli Pertama (III/b) ke Ahli Muda (III/c) kini tidak harus menunggu 4 tahun melainkan berbasis capaian Angka Kredit tahunan, namun tetap wajib lulus Uji Kompetensi (UKKJ) sesuai UU ASN Nomor 20 Tahun 2023 karena Sertifikat Pendidik (Serdik) hanya berfungsi sebagai lisensi mengajar awal, bukan syarat kenaikan jenjang.','2026-06-25 23:58:26','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:52:24','2026-06-25 23:58:26'),(28,'lilis stiyowati','SDN 034 Bengkulu Utara',85268993628,'lilis.stiyowati42@guru.sd.belajar.id',1,'Bagaimana mengatasi persoalan data untuk mengirimkan ke kgtk dengan masala ada kesalahan data apakah bisa di ulanng kembali','jika ada kesalahan data atau update data dapodik guru silahkan perbaiki melalui operator dapodik disekolah selanjut operator seoklah berkoordinasi dengan opertor dapodik di dinas pendidikan','2026-06-26 01:10:07','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 09:57:35','2026-06-26 01:10:07'),(29,'Misda Inun Hasibuan','SDN 010 Bengkulu Utara',81274602881,'ainunmisda0@gmail.com',1,'Siapa yang dapat dihubungi apabila mengalami kendala pada layanan atau aplikasi yang dikelola KGTK Bengkulu?','silahkan bertanya melalui fitur layanan tanya jawab ini','2026-06-26 01:08:26','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 10:02:33','2026-06-26 01:08:26'),(30,'Purwati','Sdit Ruhul Jadid',81325499373,'purwati554@guru.sd.belajar.id',1,'Izin bertanya bapak.\nBagaimana  yang guru swasta apakah bisa memiliki peluang p3k dan bisakah juga penempatannya tetap berada di sekolah swasta tersebut.','Terkait P3K kewenangan ada pemda','2026-06-26 01:13:28','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 10:03:10','2026-06-26 01:13:28'),(31,'rusnadi','SDN 093 BENGKULU UTARA',82376181846,'rusnadi13@guru.sd.belajar.id',2,'Kapan pelaksanaan BCKS','BCKS untuk APBNP akan dilaksanakan di bulan agustus 2026','2026-06-25 12:44:58','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 10:05:27','2026-06-25 12:44:58'),(32,'Dwi Dian Panike','SDN 14 Bermani ilir',85758506543,'dwidianpanike881@gmail.com',6,'Bagaimana sistem pelatihan stem nanti?','untuk sistem pelatihan stem masih menunggu juknisnya yang sedang disusun oleh pusat','2026-06-25 12:44:24','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 10:07:25','2026-06-25 12:44:24'),(35,'Budi Santoso','SMA Negeri 1 Jakarta',81234567890,'budi@example.com',2,'Bagaimana cara mendaftar PPG?','Cara mendaftar PPG dibedakan berdasarkan kategori kepesertaan Anda. Silakan cermati dua kategori di bawah ini untuk menentukan jalur yang sesuai:\r\n1. PPG bagi Calon Guru (Prajabatan)\r\nProgram ini ditujukan bagi lulusan S1 atau D4 yang belum terdaftar sebagai guru di Dapodik.\r\n2. PPG bagi Guru Tertentu (Dalam Jabatan)\r\nProgram ini dikhususkan bagi guru yang saat ini sudah aktif mengajar dan datanya telah tercatat di sistem Dapodik. Proses pendaftaran dan pemanggilannya dilakukan terintegrasi melalui sistem SIMPKB dan INFO GTK.','2026-06-25 23:57:22','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 12:54:02','2026-06-25 23:57:22'),(36,'Budi Santoso','SMA Negeri 1 Jakarta',81234567890,'budi@example.com',2,'Bagaimana cara mendaftar PPG?','Cara mendaftar PPG dibedakan berdasarkan kategori kepesertaan Anda. Silakan cermati dua kategori di bawah ini untuk menentukan jalur yang sesuai:\r\n1. PPG bagi Calon Guru (Prajabatan)\r\nProgram ini ditujukan bagi lulusan S1 atau D4 yang belum terdaftar sebagai guru di Dapodik.\r\n2. PPG bagi Guru Tertentu (Dalam Jabatan)\r\nProgram ini dikhususkan bagi guru yang saat ini sudah aktif mengajar dan datanya telah tercatat di sistem Dapodik. Proses pendaftaran dan pemanggilannya dilakukan terintegrasi melalui sistem SIMPKB dan INFO GTK.','2026-06-25 23:57:06','a20aaab5-effd-47e8-80ce-6b4a4f18b4a6','2026-06-25 13:57:53','2026-06-25 23:57:06'),(39,'Misda Inun Hasibuan','SDN 010 Bengkulu Utara',81274602881,'ainunmisda0@gmail.com',1,'Pak, saya mau nanya kalau mau daftar pelatihan, apa apa aja ya langkahnya?','mau mendaftar pelatihan apa? mohon izin, lebih spesifik pertanyaannya','2026-07-01 04:27:43','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-06-29 01:49:37','2026-07-01 04:27:43'),(40,'Fevi Pitrianti','SDN 52 LEBONG',85369548484,'fevipitrianti@gmail.com',4,'saya sudah mendaftar Pelatihan Pendidikan Inklusif Tingkat Dasar Angkatan 3, untuk selanjutnya dimana saya akan mendapatkan informasi apakah saya terpilih untuk mengikuti pelatihannya atau tidak?','Silahkan Ibu mendaftar di ruang GTK','2026-07-01 03:50:01','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-06-29 04:26:28','2026-07-01 03:50:01'),(42,'DR. ACENG JOYO, M.Pd.','SMKN 1 SELUMA',85367288224,'acengjoyo06@guru.smk.belajar.id',3,'Apakah seorang guru yang ingin mengikuti seleksi BCPS tidak memiliki latar belakang kepala sekolah untuk mengikuti kegiatan BCPS atau seperti apa regulasi aturannya serta kapan ada peluang pendaftarannya? Was','Dari info yang  kami  terima dari KSPSTK, untuk mengikuti BCPS persyaratannya pernah menjabat sebagai kepala sekolah. Untuk Bimtek BCPS sampai saat ini belum dibuka, karena masih ada proses2 yang belum selesai.','2026-07-02 09:40:24','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-01 16:17:41','2026-07-02 09:40:24'),(43,'DR. ACENG JOYO, M.Pd.','SMKN 1 SELUMA',85367288224,'acengjoyo06@guru.smk.belajar.id',2,'Seperti apakah dampak patal bila seseorang diangkat Kepala sekolah jika tidak melalui BCKS baik sekolah yang dituju? Misal Pak Amir sebelumnya guru SLB kemudian mendapat kepercayaan menjadi kepsek di SMA 5 Kota B misalnya.','Pengangkatan kepala sekolah bisa melalui pengangkatan non reguler artinya belum mengikuti pelatihan BCKS dan itu bisa saja. Untuk nanti jika akan memasuki periode kedua masa jabatannya maka diwajibkan memiliki sertifikat lulus pelatihan BCKS, kalau tidak ada sertifikat maka kedepannya tidak bisa melanjutkan ke periode 2 di sistemnya. Jadi dampaknya kalau non reguler hanya bisa satu periode saja tidak bisa menlanjutkan ke periode 2.','2026-07-02 09:57:14','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-01 16:24:15','2026-07-02 09:57:14'),(44,'JULIANDI SAPUTRA','SMA NEGERI 5 BENGKULU SELATAN',6282374466986,'juliandisaputram.pd@gmail.com',7,'Apakah aplikasi ini sudah disosialisasikan ke satuan pendidikan di provinsi Bengkulu','Untuk aplikasi system layanan informasi digital saat ini masih tahap ujicoba dan pengembngan. Dan fitur layanan tanya jawab akan di masukan dalam laman KGTK','2026-07-02 13:26:51','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-07-02 12:03:09','2026-07-02 13:26:51'),(45,'Dr. PAIDI, S.Pd., M.TPd','SMKN 6 Kota Bengkulu',85185146934,'paidi1971@gmail.com',1,'Mohon info proses dari KS SMK (pemegang sertifikat recognisi) untuk menjadi pengawas Madya SMK , mksh',NULL,NULL,NULL,'2026-07-02 12:04:21','2026-07-02 12:04:21'),(46,'Dian Rafika Astari','SMA Negeri 2 Lebong',82175990459,'dianastari51@guru.sma.belajar.id',3,'Kapan akan diadakan Diklat Cawas dan Diklat cakep ? \nApakah tidak ada lagi Diklat ? \nSementara program Guru Penggerak sudah di hapuskan.','Untuk BCKS APBN sedang proses, kalau BCKS APBD sesuai usulan dari dinas pendidikan.  Untuk BCPS belum ada info terbaru, nanti kalau sudah ada akan kami sosialisasikan','2026-07-02 13:48:33','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:05:35','2026-07-02 13:48:33'),(47,'Desti Susanti','SMA Negeri 4 Kepahiang',85267364707,'destisusanti42@guru.sma.belajari.id',3,'Bagaimana kita sebagai guru untuk bisa ikut BCPS','info yang kami terima persyaratan untukmenjadi  pengawas, pernah menjadi kepala sekolah, kita tunggu dulu peraturan dan juknisnya','2026-07-02 13:19:58','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:08:02','2026-07-02 13:19:58'),(48,'Monna Fathrecia','SMK Negeri 4 Rejang Lebong',82183646930,'monnafathrecia90@guru.smk.belajar.id',1,'Mengapa data di Info GTK saya berbeda atau belum valid dengan yang ada di Dapodik?\"',NULL,NULL,NULL,'2026-07-02 12:08:18','2026-07-02 12:08:18'),(49,'Nini Yuliarni','SD Negeri 76 Kota Bengkulu',85367441751,'niniyuliarni44@admin.sd.belajar.id',2,'Apakah yang sudah menjadi KS dapat mengikuti penguatan BCKS?','jika kepala sekolah  akan melanjutkan ke periode 2 sebagai kepala sekolah maka diwajibkan punya sertfikat BCKS','2026-07-02 13:49:54','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:08:37','2026-07-02 13:49:54'),(50,'Dian Rafika Astari','SMA Negeri 2 Lebong',82175990459,'dianastari51@guru.sma.belajar.id',8,'Adakah slot soal acuan yang dapat di unduh agar UKKJ hasilnya maksimal ?',NULL,NULL,NULL,'2026-07-02 12:11:00','2026-07-02 12:11:00'),(51,'Rukmiwati','Cabang Dinas Pendidikan Wilayah V Muara Aman',85267086048,'rukmiwati261@dinas.belajar.id',8,'Kapan lagi akan diadakan UKJJ perpindahan jafung Guru Ke Pengawas?',NULL,NULL,NULL,'2026-07-02 12:11:15','2026-07-02 12:11:15'),(52,'Hendriwati,S.Pd,.M.Pd','SDN 72 Bengkulu Tengah',82180938213,'hendriwati11@admin.sd.belajar.id',7,'Bagaimana sekolah yang belum mendapat pelatihan tentang PM dan KKA  untuk menerapkan di sekolahnya','Melalui kelompok kerja didaerah masing masing dengan bantuan para Fasilitator Kelompok Kerja yang telah dilatih sebagai pendamping pelaksanaan Implementasi PM dan KKA','2026-07-02 13:28:47','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-07-02 12:11:39','2026-07-02 13:28:47'),(53,'Bilal Iswanto','SMKN 1 Rejang Lebong',85274046327,'bilaliswanto77@guru.smk.belajar.id',8,'Kapan jadwal pelaksanaan UKKJF?','Untuk periode pertama di tanggal 20 july dan periode selanjutnya di bulan november','2026-07-02 13:50:58','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-07-02 12:16:18','2026-07-02 13:50:58'),(54,'dessi yulistiani','SMA Negeri 2 Kota Bengkulu',85271726175,'dessiyulistiani75@gmail.com',7,'Bentuk asesmen otentik seperti apa yang paling efektif untuk mengukur keterampilan berpikir kritis dan reflektif siswa tanpa terjebak hanya pada standarisasi nilai angka?','Pentingnya melihat tujuan asesmen (ada 3 bapak/ibu sudah mengetahuinya). Maka perlu dikemas, diatur porsi dan waktunya (persentasi asesmen sumatif, formatif, diagnostik). Perkaya rubrik penilaian, terapakan pembelajaran diferensiasi (konten, proses, produk). Selamat mengeksplor kembali.','2026-07-02 13:48:03','a226eee6-05fb-4d8a-814b-cfedeb10d9f1','2026-07-02 12:17:53','2026-07-02 13:48:03'),(55,'Eni Ermawati','SMP Negeri 4 Kota Bengkulu',82377801300,'eniermawati77@guru.smp.belajar.id',7,'Kapan pelatihan lanjutan PID pak?','Pelatihan PID saat ini belum direncanakan oleh KGTK Bengkulu. Terkait pemanfaatan PID dapat belajar mandiri melalui Ruang GTK atau sumber lainnya.','2026-07-02 14:06:06','a226ee2f-af27-45d8-8920-af7a48a60b57','2026-07-02 12:19:37','2026-07-02 14:06:06'),(56,'Mitha Diana Veronika','SDN 61 Kota Bengkulu',81375613691,'mithaveronikaspd34@guru.sd.belajar.id',2,'Kapan dibuka pelatihan BCKS nya','BCKS APBN sedang proses sedangkan BCKS APBD diusulkan masing-masing dinas pendidikan','2026-07-02 13:14:28','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:19:44','2026-07-02 13:14:28'),(57,'Erna Halian','SMAN 4 KOTA BENGKULU',85366138788,'ernahalian@gmail.com',2,'Mengapa alumni BCKS 2025 sudah mau setahun tifak ditindaklanjuti ?','Silahkan menghubungi dinas pendidikan untuk berkoordinasi dengan pemdanya terkait pengangkatan/mutasi/dll','2026-07-02 13:15:55','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:20:01','2026-07-02 13:15:55'),(58,'Vivin Paramita','SDN 82 Kota Bengkulu',85273762324,'vivinparamita83@guru.sd.belajar.id',2,'Kapan seleksi BCKS dibuka?','Kalau BCKS APBN sedang proses, kalau BCKS dengan APBD  sesuai usulan dinas pendidikan masing-masing','2026-07-02 13:17:10','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:20:02','2026-07-02 13:17:10'),(59,'Yulian Ferdiansyah','SMA NEGERI 7 KOTA BENGKULU',82210292837,'mathematicyf@gmail.com',6,'Apakah ada pelatihan STEM yang diselenggarakan oleh KGTK Provinsi Bengkulu?','InsyaAllah ada ,Saat ini KGTK masih menunggu Juknis pelatihan STEM.','2026-07-02 14:01:35','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-07-02 12:21:02','2026-07-02 14:01:35'),(60,'Mitha Diana Veronika','SDN 61 Kota Bengkulu',81375613691,'mithaveronikaspd34@guru.sd.belajar.id',2,'Kapan Layanan BCKS dibuka kembali?','Kalau BCKS APBN sedang proses, kalau  BCKS APBD tergantung dinas  pendidikan yang mengusulkan','2026-07-02 13:10:04','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:21:07','2026-07-02 13:10:04'),(61,'Sri Lestari Puji Rahayu','SDN 08 Kota Bengkulu',82298855473,'fujierahayu82@gmail.com',2,'Izin bertanya Ibu/ Bapak terkait kapan seleksi administrasi BCKS untuk tahun ini dilaksanakan?\nApakah ada kriteria dan syarat yang berbeda dari tahun sebelumnya?','BCKS APBN sedang proses, kalau BCKS APBD sesuai usulan kegiatan dari dinas pendidikan masing2. Persyaratannya ada di permendikdasmen nomor 7 tahun 2025','2026-07-02 13:11:41','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:21:16','2026-07-02 13:11:41'),(62,'Intan Permata Sari','SMPN 25 Bengkulu Tengah',89677611300,'intansari09@guru.smp.belajar.id',6,'Apakah guru di sekolah kami bisa diberikan pelatihan khusus tentang STEM oleh fasilitator/pemateri dari KGTK? bagaimana caranya? atau adakah info pelatihan STEM yang akan segera dilaksanakan oleh KGTK prov Bengkulu?','Terkait STEM kita masih menunggu petunjuk dari pusat','2026-07-02 14:08:42','a226f36f-a62b-47c8-8c10-d2ff4ff823e0','2026-07-02 12:21:31','2026-07-02 14:08:42'),(63,'Mitha Diana Veronika','SDN 61 Kota Bengkulu',81375613691,'mithaveronikaspd34@guru.sd.belajar.id',2,'Kapan Layanan BCKS dibuka kembali?','Kalau BCKS APBN sedang proses, kalau BCKS dengan anggaran APBD diusulkan dinas pendidikan masing-masing','2026-07-02 13:12:50','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:21:48','2026-07-02 13:12:50'),(64,'Widya','SMK NEGERI 1 REJANG LEBONG',81363064285,'widyaz66@guru.smk.belajar.id',5,'Apakah akan ada pelatihan fasilitator guru bahasa inggris pada kegiatan PGSD MBI','Untuk pelatihan fasilitator PKGSD MBI  saat ini sdh tersedia fasilitatornya yang dilatih Oleh Direktorat Guru Pendidikan Dasar','2026-07-02 13:33:51','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-07-02 12:27:45','2026-07-02 13:33:51'),(65,'Yunarti','SMA N 2 LEBONG',82282638503,'yunarti49@guru.sma.belajar.id',7,'Bagaimana teknis pelaksanaan pendampingan Kegiatan Pelatihan nanti ?','Nanti akan disosialisasikan, bisa mempelajari juknis implementasi PM tahun 2026. Ada 6 siklus pendampingan di kelompok kerja (KKG/MGMP/MKKS, dsb)','2026-07-02 13:35:27','a226eee6-05fb-4d8a-814b-cfedeb10d9f1','2026-07-02 12:27:50','2026-07-02 13:35:27'),(66,'Titian afisi','SMAN 2 REJANG LEBONG',8127843303,'titianafisi98@guru.sma.belajar.id',6,'Kapan pelatihan tentang ini dilaksanakan?','Pelatihan STEM masih menunggu juknis dari pusat yang diperkirakan akan dilaksanakan di bulan November','2026-07-03 03:19:26','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-07-02 12:28:36','2026-07-03 03:19:26'),(67,'Ana Marleni','SMAN 2 Lebong',81380150595,'anamarleni18@guru.sma.belajar.id',7,'Bagaimana teknis untuk pendampingan pembelajaran guru  di kabupaten?','FKK akan ditugaskan pada kelompok kerja sasaran berdasarkan pemetaan mata pelajaran oleh KGTK Provinsi Bengkulu. Fasilitasi penyelenggaraan serta koordinasi dengan Dinas Pendidikan Kabupaten/Kota terkait lokasi dan kepanitiaan akan disesuaikan dengan ketersediaan anggaran. Jika anggaran tidak tersedia, FKK dapat melaksanakan pengimbasan secara mandiri di kelompok kerja dan satuan pendidikannya masing-masing.','2026-07-02 14:04:09','a226ee2f-af27-45d8-8920-af7a48a60b57','2026-07-02 12:28:43','2026-07-02 14:04:09'),(68,'Ana marleni','SMA N 2 Lebong',81380150595,'anamarleni18@guru.sma.belajar.id',8,'Kapan ujikom dilaksanakan?','untuk tahun ini ada 2x ujikom yang pertama akan dilaksanakan tanggl 20 juli dan yang berikutnya rencana di bulan November','2026-07-02 13:52:35','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-07-02 12:29:57','2026-07-02 13:52:35'),(69,'Donni Fahlepi','SMPN 25 BENGKULU TENGAH',82182654175,'don.nie3491@gmail.com',1,'Apakah kita yg memiliki serdik pgsd sertifikasi nya akan cair bila mengajar di paud?',NULL,NULL,NULL,'2026-07-02 12:32:19','2026-07-02 12:32:19'),(70,'SUNGKEMTRI WAHYUNI','Smkn 7 kota bengkulu',85284000048,'trimedia.tm@gmail.com',7,'Unruk pembelajaran KA apakah tidak ada pelatihan khusus utk pendalaman materi koding sMK ?','Tahun ini program prioritas PM diimplementasikan ke mapel KKA. Memang ada materi esensial yaitu bagaimana memilih materi fundamental dan kontekstual dalam kehidupan sehari-hari. \r\nUntuk pendalaman materi koding bisa di lihat di ruang GTK, atau webinar lainnya yang dapat mendukung pemahaman materi koding. Bisa follow medsos direktorat SMK, UPT KGTK Bengkulu untuk mendapat informasi terbaru.','2026-07-02 13:30:15','a226eee6-05fb-4d8a-814b-cfedeb10d9f1','2026-07-02 12:32:57','2026-07-02 13:30:15'),(71,'Helen Helen','SMPN 21 Kota Bengkulu',81367222217,'helen77@admin.smp.belajar.id',2,'Assalamualaikum, terkait kita yang sudah kepsek definitif, bagaimana regulasinya untuk bisa mendapatkan sertifikat BCKS? terima kasih','silahkan mengikuti pelatihan BCKS kalau belum memasuki periode 2 menjadi kepala sekolah','2026-07-02 13:07:59','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:34:41','2026-07-02 13:07:59'),(72,'Septi Marlita','SMA Negeri 3 Bengkulu Selatan',85268866077,'septimarlita85@gmail.com',7,'Bagaimana tolak ukur menjadi guru yang memahami program PM?','Guru yang memahami PM adalah yang mampu mengimplementasikan PM dimulai dari kelasnya. Bagaimana prinsip, pengalaman belajar PM dapat dihadirkan dalam kelas. Bagaimana seorang guru dapat mengajarkan materi esensial yang kontekstual dalam kehidupan sehari-hari. Bagaimana karakter siswa semakin positif semakin hari. Bagaimana kolaborasi meningkatkan mutu pembelajaran tercapai. Dan banyak indikator lainnya.','2026-07-02 13:41:12','a226eee6-05fb-4d8a-814b-cfedeb10d9f1','2026-07-02 12:48:06','2026-07-02 13:41:12'),(73,'Asep Suparman','SMKN 1 Rejang Lebong',85268792500,'asepsuparman61@admin.smk.belajar.id',6,'Kapan ada pelatihan STEM buat guru-guru SMK?','Saat ini masih menunggu juknis yg sedang disusun di direktorat jenderal GTK','2026-07-02 14:07:49','a226f36f-a62b-47c8-8c10-d2ff4ff823e0','2026-07-02 12:50:38','2026-07-02 14:07:49'),(74,'AM. NASARRUDIN','SMA Negeri 5 Lebong',82269998007,'amnasarrudin881@admin.sma.belajar.id',3,'Kapan dibuka untuk BCPS / ujikom untuk jadi pengawas sekolah','Belum ada info terbaru terkait pembukaan untuk BCPS ya pak, nanti klu sudah ada info terbaru akan kami sosialisasikan','2026-07-02 13:06:40','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:51:59','2026-07-02 13:06:40'),(75,'Asril Setiawan','SMA Negeri 1 Lebong',82306724898,'asrilsetiawan98@gmail.com',2,'Untuk mengikuti Bakal Calon Kepala Sekolah persyaratannya apa?','Bisa lihat di permendikdasmen nomor 7 tahun 2025','2026-07-02 13:05:42','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:55:05','2026-07-02 13:05:42'),(76,'Ferdiyan Midas','SMAN 1 LEBONG',81367030656,'yayanmidas@gmail.com',3,'Kapan seleksi calon pengawas dibuka, apa saja persyaratan nya..?','Belum ada info kapan seleksi calon pengawasnya juga termasuk persyaratannya, nanti kalau sdh ada info terbaru akan kami sosialisasikan','2026-07-02 13:04:57','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:55:44','2026-07-02 13:04:57'),(77,'Mitha Diana Veronika,s.pd','SDN 61 Kota Bengkulu',81375613691,'mithaveronikaspd34@guru.sd.belajar.id',2,'Kapan dibuka pelatihan BCKS lagi ya?','Untuk pelatihan BCKS APBN sedang dalam proses ya bu, kalau BCKS dengan APBD tergantung dari dinas pendidikan masing-masing pengusulannya','2026-07-02 13:03:56','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:55:54','2026-07-02 13:03:56'),(78,'Lisnawati','SDN 15 Bengkulu Tengah',81273667876,'lisnawati124@guru.sd.belajar.id',3,'izin Ibu/Bapak yang saya tanyakan adalah apakah bisa guru mengikuti tes calon pengawas tanpa menjadi kepala sekolah terlebih dahulu,dan apa saja syaratnya?','Untuk calon pengawas persyaratan pernah menjadi kepala sekolah. Untuk peraturan dan juknis BCPS kita tunggu info dari KSPSTK ya bu, nanti kalau sudah ada info akan kami sosialisasikan','2026-07-02 13:02:27','a226e5bc-51b3-4d94-88b9-fb1c547523d0','2026-07-02 12:58:13','2026-07-02 13:02:27'),(79,'Disma Riza','SDN 15 Bengkulu Tengah',85266790582,'dismariza@gmail.com',6,'Apakah ada pelatihan STEM untuk guru sekolah dasar ? Jika ada, kapan diadakan ? dan apakah persyaratan supaya saya dapat ikut pelatihan tersebut ?','Terkait pelatihan STEM, kita masih menunggu petunjuk dari pusat.\r\n\r\nJika sudah ada informasi akan segera kami sosialisasikan','2026-07-02 14:06:58','a226f36f-a62b-47c8-8c10-d2ff4ff823e0','2026-07-02 13:00:50','2026-07-02 14:06:58'),(80,'Dwi Putriyanti','SMA Negeri 1 Bengkulu Selatan',85285746458,'dwiputriyanti09@guru.sma.belajar.id',7,'Bagaimana cara agar pelatihan PM itu dilakukan secara bertahap kepada seluru jenjang mapel ?','Fasilitator akan berbagi praktik baik ke kelompok kerja sesuai mapel, namun tahun ini masih terbatas di beberapa kab/kota dan mapel tertentu yang ditetapkan kementerian.','2026-07-02 13:42:31','a226eee6-05fb-4d8a-814b-cfedeb10d9f1','2026-07-02 13:27:17','2026-07-02 13:42:31'),(81,'DESI HARYANI','SMP Negeri 21 Kota Bengkulu',85273498656,'desiharyani92@guru.smp.belajar.id',8,'Assalammualaikum.. izin bertanya Bapak/Ibu kapan pelaksanaan UKKJ tahun ini?','Waalaikumsalam untuk tahun ini ada 2x ujikom yang pertama akan dilaksanakan tanggl 20 juli dan yang berikutnya rencana di bulan November','2026-07-02 13:53:06','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-07-02 13:34:01','2026-07-02 13:53:06'),(82,'Meiliana','Dinas pendidikan dan kebudayaan kabupaten Bengkulu tengah',85268142996,'meiliana853@dinas.belajar.id',1,'Kami para pendidik dan tenaga kependidikan membutuh kan sekali pelatihan pid kapan kira nyaa bisa diadakan pelatihan pid bagi guru² dan tenaga kependidikan??? Mohon di fasilitasi trima kasih.','Untuk pelatihan PID sementara ini menunggu juknis terbaru karena perlu dimodifikasi secara daring mengingat efisiensi Anggaran','2026-07-03 03:18:27','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-07-02 22:41:57','2026-07-03 03:18:27'),(83,'Helen','SMPN 21 Kota Bengkulu',81367222217,'helen77@admin.belajar.id',2,'Terkait tindak lanjut pertanyaan saya sebelumnya, SK KS saya 28 Maret 2022, apakah peluang untuk ikut BCKS masih ada?',NULL,NULL,NULL,'2026-07-05 01:12:30','2026-07-05 01:12:30'),(102,'nasyith forefry','KGTK',81318458540,'forefry@gmail.com',2,'Kapan BCKS APBN dimulai untuk tahun 2026 ini','akan dimulai akhir agustus tahun 2026','2026-07-21 01:36:08','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-07-21 01:12:22','2026-07-21 01:36:08'),(134,'Bayu basu swasta','Sdn 66 rejang lebong',895870165389,'bayubasu@gmail.com',10,'Kapan sekolah model dimulai',NULL,NULL,NULL,'2026-07-21 19:30:20','2026-07-21 19:30:20'),(136,'Bayu Basu Swasta','SDN 10 Rejang Lebong',89519540506,'bayubasu5@gmail.com',2,'Kapan BCKS akan dimulai',NULL,NULL,NULL,'2026-07-21 21:44:32','2026-07-21 21:44:32'),(137,'Bayu Basu Swasta','SDN 66 Mukomuko',89519540506,'bayubasu5@gmail.com',2,'Kapan BCKS akan ada?',NULL,NULL,NULL,'2026-07-21 21:59:15','2026-07-21 21:59:15'),(139,'Bayu Basu Swasta','SDN 03 REJANG LEBONG',89519540506,'bayubasu5@gmail.com',8,'Kapan UKKJ akan dimulai?','UKKJ dimulai periode 1 sdh selesai dibulan juli untuk periode 2 akan dilaksakanan dibulan november 2026','2026-07-28 02:27:46','a226ac83-001b-450f-989a-a7cccb3b9cef','2026-07-22 01:17:31','2026-07-28 02:27:46');
/*!40000 ALTER TABLE `qnas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rencana_strategis`
--

DROP TABLE IF EXISTS `rencana_strategis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rencana_strategis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rencana_strategis`
--

LOCK TABLES `rencana_strategis` WRITE;
/*!40000 ALTER TABLE `rencana_strategis` DISABLE KEYS */;
INSERT INTO `rencana_strategis` VALUES (2,'Rencana Strategis','Tautan dan Dokumen','rencana_strategis/FT0AY0ooAqkhmep8x8qqg95lmffM9OBDRdIqvUZq.pdf','2026-07-27 04:35:49','2026-08-12 07:54:36');
/*!40000 ALTER TABLE `rencana_strategis` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','super-admin',1,'2026-07-26 07:22:00','2026-07-26 07:22:00',NULL),(2,'User','user',1,'2026-07-26 07:22:00','2026-07-26 07:22:00',NULL),(3,'PIC','pic',1,'2026-07-26 07:22:00','2026-07-26 07:22:00',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sejarahs`
--

DROP TABLE IF EXISTS `sejarahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sejarahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sejarahs`
--

LOCK TABLES `sejarahs` WRITE;
/*!40000 ALTER TABLE `sejarahs` DISABLE KEYS */;
INSERT INTO `sejarahs` VALUES (1,'Sejarah KGTK Provinsi Bengkulu','Deskripsi','sejarahs/KM94nVVTLnFohgAYw6wKUtuDuI7yojI6kUyR1xgW.jpg','2026-07-26 07:24:45','2026-08-12 07:46:13');
/*!40000 ALTER TABLE `sejarahs` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('4fYVys4ZX76NsHzIpVAXS3xECa9cPFSfT2yiMI7o','a226ac83-001b-450f-989a-a7cccb3b9cef','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiQjRJMjNTMGNyNjl0NlBkc0JIMGpnTWh2bHZmdkZUVU1iN21ZcWVUUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9rZ3RrLmRhbnVkaXJhamEuc3BhY2UvcHRrL3JlY2FwIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6MzY6ImEyMjZhYzgzLTAwMWItNDUwZi05ODlhLWE3Y2NjYjNiOWNlZiI7czo3OiJyb2xlX2lkIjtpOjE7czo5OiJyb2xlX25hbWUiO3M6MTE6IlN1cGVyIEFkbWluIjtzOjEwOiJtdWx0aV9yb2xlIjtiOjE7fQ==',1787452139);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skms`
--

LOCK TABLES `skms` WRITE;
/*!40000 ALTER TABLE `skms` DISABLE KEYS */;
INSERT INTO `skms` VALUES (1,'Survey KGTK Bengkulu','Tautan Survey','https://docs.google.com/forms/d/e/1FAIpQLSeOnHX-Gd-TiYZ-eCIw4LUq25z3jVFP4GuLr929lYYVJGuO2g/viewform?usp=publish-editor','2026-07-15 09:57:14','2026-08-12 07:52:43');
/*!40000 ALTER TABLE `skms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `struktur_organisasis`
--

DROP TABLE IF EXISTS `struktur_organisasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `struktur_organisasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `struktur_organisasis`
--

LOCK TABLES `struktur_organisasis` WRITE;
/*!40000 ALTER TABLE `struktur_organisasis` DISABLE KEYS */;
/*!40000 ALTER TABLE `struktur_organisasis` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tim_kerja_images`
--

LOCK TABLES `tim_kerja_images` WRITE;
/*!40000 ALTER TABLE `tim_kerja_images` DISABLE KEYS */;
INSERT INTO `tim_kerja_images` VALUES (4,2,'tim_kerjas/aKRcsSaQTho1xEW8bWMKNMRrLqgAcHgPWtKKnWhs.jpg','2026-07-29 06:47:29','2026-07-29 06:47:29'),(5,3,'tim_kerjas/aUVUf9LLeb6H4pICmRAHkvTQaiHt3Ohc2GhqG6uB.jpg','2026-08-12 07:47:20','2026-08-12 07:47:20');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tim_kerjas`
--

LOCK TABLES `tim_kerjas` WRITE;
/*!40000 ALTER TABLE `tim_kerjas` DISABLE KEYS */;
INSERT INTO `tim_kerjas` VALUES (2,'Tim Kerja KGTK Bengkulu','Tim Kerja KGTK Bengkulu','2026-07-29 06:47:29','2026-07-29 06:47:29'),(3,'Tim Lead','Tim Lead','2026-08-12 07:47:20','2026-08-12 07:47:20');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tugas_fungsis`
--

LOCK TABLES `tugas_fungsis` WRITE;
/*!40000 ALTER TABLE `tugas_fungsis` DISABLE KEYS */;
INSERT INTO `tugas_fungsis` VALUES (3,'Tugas dan Fungsi','Tugas dan Fungsi','tugas_fungsis/EaesvxY7TkAZSxp7S1WaxwuJNUvyNMMadFDZCqyl.jpg','2026-08-12 07:49:00','2026-08-12 07:49:00');
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
INSERT INTO `user_role` VALUES ('a226ac83-001b-450f-989a-a7cccb3b9cef',1,NULL,NULL),('a226ac83-001b-450f-989a-a7cccb3b9cef',2,NULL,NULL),('a226ac83-001b-450f-989a-a7cccb3b9cef',3,NULL,NULL),('a226ac83-79af-46e5-b48d-0913c868d66e',2,NULL,NULL),('a226ac83-f052-4dbc-b669-a6d7996d4114',3,NULL,NULL),('a226d7d3-82f1-4b16-9b3e-c50d0db9b1bf',3,NULL,NULL),('a226dc6a-bc1e-474c-8446-434616c4abd8',2,NULL,NULL),('a226e474-e7e9-42dc-8ad2-e5fda3d463d3',3,NULL,NULL),('a226e5bc-51b3-4d94-88b9-fb1c547523d0',3,NULL,NULL),('a226e68f-615b-4de6-95fa-31a8baa38beb',3,NULL,NULL),('a226e752-5e6a-48b6-b818-a229d664b5ed',3,NULL,NULL),('a226eb15-86aa-422c-a16b-da9921d7618c',3,NULL,NULL),('a226ebab-396f-4359-9c08-d21a2d6965f3',3,NULL,NULL),('a226ec77-edd3-41a7-a0be-7851a850eb71',3,NULL,NULL),('a226ed31-b71c-47bd-9490-ccdcf305b3cb',3,NULL,NULL),('a226ee2f-af27-45d8-8920-af7a48a60b57',3,NULL,NULL),('a226eee6-05fb-4d8a-814b-cfedeb10d9f1',3,NULL,NULL),('a226f1e9-dec2-4cf7-8185-9e50b3c5627b',3,NULL,NULL),('a226f36f-a62b-47c8-8c10-d2ff4ff823e0',3,NULL,NULL),('a226f4e1-bf00-4a0f-a473-79db8d946721',3,NULL,NULL),('a24fcd67-d96e-4d57-a621-f5c58feb9485',3,NULL,NULL);
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
INSERT INTO `users` VALUES ('a226ac83-001b-450f-989a-a7cccb3b9cef','Super Admin','admin','administrator@app.com',NULL,'$2y$12$ZfiD4JUfep8pVsDTOt6.5.AYqrTo8FZ3weAGxbs4Es18G0ZyBj7qW',NULL,1,'2026-07-01 01:37:47','2026-07-01 01:37:47',NULL),('a226ac83-79af-46e5-b48d-0913c868d66e','User','user','user@app.com',NULL,'$2y$12$W9a9S9u77co4WabXJ4iweOzaBWrsWFuIWmhAi1d5sIG8dgzILumAa',NULL,1,'2026-07-01 01:37:47','2026-07-01 01:37:47',NULL),('a226ac83-f052-4dbc-b669-a6d7996d4114','PIC','pic','pic@app.com',NULL,'$2y$12$i.GuXUCDM6pBQB9OkCV62OiB0HUDRjr/rPUHGrUYAPrMkPU.fT7Tq',NULL,1,'2026-07-01 01:37:47','2026-07-01 01:37:47',NULL),('a226d7d3-82f1-4b16-9b3e-c50d0db9b1bf','Seto PIC PPG','seto','seto@gmail.com',NULL,'$2y$12$FJnfFc7CssrpfnqvL.C5tedtHa3iQRtf3VwDXnvnfMoteuiSoMA8i',NULL,1,'2026-07-01 03:38:54','2026-07-01 03:38:54',NULL),('a226dc6a-bc1e-474c-8446-434616c4abd8','ade','gasken','adeseptiawan79@dikbud.belajar.id',NULL,'$2y$12$dJ6/HOnX5UgTbGE28hzseugCC0OJvi7zN0tP.eNMs4XWH3JN6ikPm',NULL,1,'2026-07-01 03:51:44','2026-07-01 03:53:29',NULL),('a226e474-e7e9-42dc-8ad2-e5fda3d463d3','ade Septiawan','ade','KGTKbengkulu@gmail.com',NULL,'$2y$12$7VzficSVOEie2YQF4yz7R.rYSG/DNm9cK5MMC.nXvRQc7dGBFqqT.',NULL,1,'2026-07-01 04:14:13','2026-07-01 04:14:13',NULL),('a226e5bc-51b3-4d94-88b9-fb1c547523d0','Yulia','Yulia','YuliaKGTK@gmail.com',NULL,'$2y$12$FF1ECGGKA3bqsMCgq4Pg2u.6RL5osQJ7rNRS79QN2cor13guUTKAu',NULL,1,'2026-07-01 04:17:47','2026-07-01 04:17:47',NULL),('a226e68f-615b-4de6-95fa-31a8baa38beb','Syafrizal','Syafrizal','SayfrizalKGTK@gmail.com',NULL,'$2y$12$gzxqXSYXDiPXrlPU6nzLD.MY.G/tjND9fg78ba7CyejdsJuXLyNQ6',NULL,1,'2026-07-01 04:20:06','2026-07-01 04:20:06',NULL),('a226e752-5e6a-48b6-b818-a229d664b5ed','Syafrizal','Izal','KGTKsayfrizal@gmail.com',NULL,'$2y$12$1J1UAam0wIleXP7zpkfKjOpib5sqC8abhxqHbEDxRZAKxsKIYHR1y',NULL,1,'2026-07-01 04:22:13','2026-07-01 04:22:13',NULL),('a226eb15-86aa-422c-a16b-da9921d7618c','Muzanip','Muzanip','KGTKMuzanip@gmail.com',NULL,'$2y$12$3TJndC7Eywh/RlHUvl2eYOrL47CaHGK6qPJL00BizQWJ8KFV3VekS',NULL,1,'2026-07-01 04:32:45','2026-07-01 04:32:45',NULL),('a226ebab-396f-4359-9c08-d21a2d6965f3','Denny T','Denny','KGTKDenny@gmail.com',NULL,'$2y$12$z4uw2RzfyIa2NRljl0ooLOKCwuwMrN8gm5WmwlJ9ZKyLbbZeoVX0W',NULL,1,'2026-07-01 04:34:23','2026-07-01 04:34:23',NULL),('a226ec77-edd3-41a7-a0be-7851a850eb71','Sutanto','Tanto','KGTKSutanto@gmail.com',NULL,'$2y$12$HTXvYE6wHvklJvrBPLzqh.L3kldJGW77z7wbQV0d3ZVslKp9t2AVy',NULL,1,'2026-07-01 04:36:37','2026-07-01 04:36:37',NULL),('a226ed31-b71c-47bd-9490-ccdcf305b3cb','Harniningsih','Harning','KGTKHarning@gmail.com',NULL,'$2y$12$FBAdUjbYe03u0P9RDixbSeptKwozXJvIzpplv1ZkcrpumudM7dVa6',NULL,1,'2026-07-01 04:38:39','2026-07-01 04:38:39',NULL),('a226ee2f-af27-45d8-8920-af7a48a60b57','M.Sabani','Sabani','KGTKSabani@gmail.com',NULL,'$2y$12$aoh4WaKMBz6dYYwCCf8sdOx61rRgyF8SHc0HA6ABBFq2s7DTYpGCu',NULL,1,'2026-07-01 04:41:25','2026-07-01 04:41:25',NULL),('a226eee6-05fb-4d8a-814b-cfedeb10d9f1','Yetty','Yetty','KGTKYetty@gmail.com',NULL,'$2y$12$CdSXyCrLChEZCz1Gv9biN.2ENCqEKNPjG3mJUMXZ3F0mpAA.sGwtS',NULL,1,'2026-07-01 04:43:25','2026-07-01 04:43:25',NULL),('a226f1e9-dec2-4cf7-8185-9e50b3c5627b','Yarni','Yarni','KGTKYarni@gmail.com',NULL,'$2y$12$yJPLy3btMALtoFseQXxAhu9LN6/q8JEGjzKRybRJclPFF8UaIJabS',NULL,1,'2026-07-01 04:51:50','2026-07-01 04:51:50',NULL),('a226f36f-a62b-47c8-8c10-d2ff4ff823e0','Nova','Nova','KGTKNova@gmail.com',NULL,'$2y$12$Be9pILQytxoHUcYhkECgSupxVBsOthveBjuxn/HParVFMd6Mh69zG',NULL,1,'2026-07-01 04:56:06','2026-07-01 04:56:06',NULL),('a226f4e1-bf00-4a0f-a473-79db8d946721','Gustia','Gustia','KGTKGustia@gmail.com',NULL,'$2y$12$WmcIgrKSnhCWsQDtb77Thu4BPKF8vOEWaVRiqJd8ISUrIL5dkOjoe',NULL,1,'2026-07-01 05:00:08','2026-07-01 05:00:08',NULL),('a24fcd67-d96e-4d57-a621-f5c58feb9485','Anggito Setoadji','Anggito TEST','setoadji76@gmail.com',NULL,'$2y$12$69Fp5jVa.4b4ZEELDT53eeL69JqRErzMhmhCs.ggV5owJzKuQRM86',NULL,1,'2026-07-21 12:18:42','2026-07-21 12:18:42',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visi_misi_images`
--

LOCK TABLES `visi_misi_images` WRITE;
/*!40000 ALTER TABLE `visi_misi_images` DISABLE KEYS */;
INSERT INTO `visi_misi_images` VALUES (6,2,'visi_misis/nRqy2xBRUk9ABgafCw20I2qFVgJwSPqMyzxdKPmD.png','2026-08-12 07:39:45','2026-08-12 07:39:45');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visi_misis`
--

LOCK TABLES `visi_misis` WRITE;
/*!40000 ALTER TABLE `visi_misis` DISABLE KEYS */;
INSERT INTO `visi_misis` VALUES (2,'Visi Misi KGTK Bengkulu','Visi Misi KGTK','2026-07-29 06:48:11','2026-08-12 07:39:45');
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

-- Dump completed on 2026-08-23  9:56:30
