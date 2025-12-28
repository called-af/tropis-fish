/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.1.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: tropis-fish
-- ------------------------------------------------------
-- Server version	12.1.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `about_sections`
--

DROP TABLE IF EXISTS `about_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `about_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description_1` text NOT NULL,
  `description_2` text DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `feature_1_title` varchar(255) DEFAULT NULL,
  `feature_1_description` varchar(255) DEFAULT NULL,
  `feature_1_icon` varchar(255) NOT NULL DEFAULT 'check-circle',
  `feature_2_title` varchar(255) DEFAULT NULL,
  `feature_2_description` varchar(255) DEFAULT NULL,
  `feature_2_icon` varchar(255) NOT NULL DEFAULT 'currency-dollar',
  `feature_3_title` varchar(255) DEFAULT NULL,
  `feature_3_description` varchar(255) DEFAULT NULL,
  `feature_3_icon` varchar(255) NOT NULL DEFAULT 'truck',
  `feature_4_title` varchar(255) DEFAULT NULL,
  `feature_4_description` varchar(255) DEFAULT NULL,
  `feature_4_icon` varchar(255) NOT NULL DEFAULT 'heart',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about_sections`
--

LOCK TABLES `about_sections` WRITE;
/*!40000 ALTER TABLE `about_sections` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `about_sections` VALUES
(1,'About Us','Since 1986, we has been at the forefront of breeding and distributing premium quality tropical ornamental fish. With over two decades of experience, we have established ourselves as one of Indonesia most trusted suppliers of aquatic life.','Our passion for aquatic excellence drives us to maintain the highest standards in fish breeding, health management, and customer service. We take pride in our commitment to sustainability and the well-being of every fish that leaves our facility.','about/banner-home1.jpg','Premium Quality','Carefully selected and quarantined fish','check-circle','Best Prices','Direct from our breeding center','currency-dollar','Fast Delivery','Professional packaging nationwide','truck','Expert Care','Dedicated team of specialists','heart',1,0,'2025-12-28 07:24:25','2025-12-28 07:24:25');
/*!40000 ALTER TABLE `about_sections` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `admins` VALUES
(1,'Administrator','admin@tropisfish.com','$2y$12$u8mRN/r60vWpYYNYvbBLguV6bcx951RzKNjEKTQ.omCcGbfwI1WPC',NULL,'2025-12-28 07:24:24','2025-12-28 07:24:24');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
set autocommit=0;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
set autocommit=0;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `company_sections`
--

DROP TABLE IF EXISTS `company_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('about','farm','quality') NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `main_description_1` text NOT NULL,
  `main_description_2` text DEFAULT NULL,
  `main_title_1` varchar(255) DEFAULT NULL,
  `main_title_2` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `image_layout` enum('grid','slider') NOT NULL DEFAULT 'slider',
  `content_blocks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content_blocks`)),
  `process_steps` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`process_steps`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_sections_type_unique` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_sections`
--

LOCK TABLES `company_sections` WRITE;
/*!40000 ALTER TABLE `company_sections` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `company_sections` VALUES
(1,'about','Company Profile','Leading Ornamental Fish Exporter','CV. Tropis Fish was established in 1986, and has exported to South East Asia, Middle East, Europe, and USA since 2005. We are the specialist for export ornamental fishes, Invertebrates, and Aquatic Plants. In 2026 CV Tropis Fish has officially transitioned into PT Tropis Fish Indonesia. This change represents a strategic step to strengthen our corporate structure, improve administrative compliance, and enhance the quality of our services.','Our fishes collection consist of Indonesian origin fishes as well as from overseas such as Clown Loach, Brackish Fishes, Scats Fishes, many kinds of Tetra Fishes, Angel Fishes, Barb Fishes, Catfishes, Cichlids, Killie Fishes, Metynis, Ancient Fishes, Rasboras, Rainbows, Mollies, Platys, Guppies, Various Shrimps, Lobsters, Crabs, Snails, and Clams.','Established in 1986','Extensive Collection','[]','slider','[{\"title\":\"Established in 1986\",\"description\":\"CV. Tropis Fish was established in 1986, and has exported to South East Asia, Middle East, Europe, and USA since 2005. We are the specialist for export ornamental fishes, Invertebrates, and Aquatic Plants. In 2026 CV Tropis Fish has officially transitioned into PT Tropis Fish Indonesia. This change represents a strategic step to strengthen our corporate structure, improve administrative compliance, and enhance the quality of our services.\"},{\"title\":\"Extensive Collection\",\"description\":\"Our fishes collection consist of Indonesian origin fishes as well as from overseas such as Clown Loach, Brackish Fishes, Scats Fishes, many kinds of Tetra Fishes, Angel Fishes, Barb Fishes, Catfishes, Cichlids, Killie Fishes, Metynis, Ancient Fishes, Rasboras, Rainbows, Mollies, Platys, Guppies, Various Shrimps, Lobsters, Crabs, Snails, and Clams.\"}]',NULL,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(2,'farm','Our Farm','State-of-the-Art Facilities Across Strategic Locations','Our facilities are strategically located across West Java to ensure optimal fish breeding, health management, and efficient distribution. Each location is equipped with modern infrastructure and managed by experienced professionals.','We have hundreds of aquarium and tanks to cover all of our fishes stocks. Besides, we have many other facilities to support us in doing business and ensuring the best care for our aquatic life.','Strategic Locations','Extensive Infrastructure','[]','slider','[{\"title\":\"Cibitung - Main Office & Quarantine Facility\",\"description\":\"Our main office and quarantine facility is located in Cibitung, Bekasi. This central hub serves as our primary operation center, featuring state-of-the-art quarantine systems to ensure all fish are healthy and disease-free before shipment. The facility is strategically positioned near Jakarta for efficient logistics and international shipping.\"},{\"title\":\"Bogor - Breeding Facility\",\"description\":\"Our specialized breeding facility in Bogor is dedicated to cultivating high-quality ornamental fish. With optimal water conditions and carefully controlled environments, this location focuses on breeding various species of tropical fish. The natural surroundings and superior water quality make it an ideal location for fish reproduction and early-stage development.\"}]',NULL,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(3,'quality','Quality Control','Ensuring Excellence in Every Shipment','We only supply high quality of tropical fishes and we are very concern about size, because that is make more value for our customers.','After we check in the quality control room, the fishes will be brought into the special area (quarantine area) to process before the shipment.','High Quality Standards','Rigorous Inspection Process','[]','slider','[{\"title\":\"High Quality Standards\",\"description\":\"We only supply high quality of tropical fishes and we are very concern about size, because that is make more value for our customers.\"},{\"title\":\"Rigorous Inspection Process\",\"description\":\"After we check in the quality control room, the fishes will be brought into the special area (quarantine area) to process before the shipment.\"}]','[{\"number\":\"1\",\"title\":\"Initial Selection\",\"description\":\"Careful selection of healthy specimens\"},{\"number\":\"2\",\"title\":\"Quality Control Room\",\"description\":\"Thorough health and size inspection\"},{\"number\":\"3\",\"title\":\"Quarantine Area\",\"description\":\"Special care before shipment\"},{\"number\":\"4\",\"title\":\"Final Preparation\",\"description\":\"Ready for safe shipment worldwide\"}]',1,'2025-12-28 07:24:25','2025-12-28 07:24:25');
/*!40000 ALTER TABLE `company_sections` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
set autocommit=0;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `footer_sections`
--

DROP TABLE IF EXISTS `footer_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `footer_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('company','menu','information','social') DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`links`)),
  `copyright_text` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `footer_sections_type_unique` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `footer_sections`
--

LOCK TABLES `footer_sections` WRITE;
/*!40000 ALTER TABLE `footer_sections` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `footer_sections` VALUES
(1,'company','Company Info','Premium quality tropical ornamental fish supplier for your aquarium','[]','All rights reserved',0,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(2,'menu','Menu',NULL,'[{\"text\":\"Home\",\"url\":\"\\/\"},{\"text\":\"Company Profile\",\"url\":\"\\/#company-profile\"},{\"text\":\"Stock List\",\"url\":\"\\/#stock-list\"},{\"text\":\"Gallery\",\"url\":\"\\/#gallery\"}]',NULL,1,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(3,'information','Information',NULL,'[{\"text\":\"How to Order\",\"url\":\"#\"},{\"text\":\"Privacy Policy\",\"url\":\"#\"},{\"text\":\"Terms & Conditions\",\"url\":\"#terms\"}]',NULL,2,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(4,'social','Follow Us',NULL,'[{\"text\":\"Facebook\",\"url\":\"#\",\"icon\":\"facebook\"},{\"text\":\"Twitter\",\"url\":\"#\",\"icon\":\"twitter\"},{\"text\":\"Instagram\",\"url\":\"#\",\"icon\":\"instagram\"}]',NULL,3,1,'2025-12-28 07:24:25','2025-12-28 07:24:25');
/*!40000 ALTER TABLE `footer_sections` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `category` enum('fish','farm','quality') NOT NULL DEFAULT 'fish',
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `galleries` VALUES
(1,'Archer Fish Brackish','Fish Gallery','gallery/fish/archer-fish-brackish.jpg','fish',1,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(2,'Checker Barb','Fish Gallery','gallery/fish/checker-barb.jpg','fish',2,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(3,'Thumbs Albino Neon Tetra','Fish Gallery','gallery/fish/thumbs_albino-neon-tetra.jpg','fish',3,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(4,'Thumbs Albino Tiger Barb','Fish Gallery','gallery/fish/thumbs_albino-tiger-barb.jpg','fish',4,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(5,'Thumbs Amandae Tetra','Fish Gallery','gallery/fish/thumbs_amandae-tetra.jpg','fish',5,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(6,'Thumbs Black Crystal Bee Shrimp','Fish Gallery','gallery/fish/thumbs_black-crystal-bee-shrimp.jpg','fish',6,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(7,'Thumbs Black Neon Tetra','Fish Gallery','gallery/fish/thumbs_black-neon-tetra.jpg','fish',7,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(8,'Thumbs Black Palmeri','Fish Gallery','gallery/fish/thumbs_black-palmeri.jpg','fish',8,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(9,'Thumbs Black Phantom Tetra','Fish Gallery','gallery/fish/thumbs_black-phantom-tetra.jpg','fish',9,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(10,'Thumbs Blue Cherry Shrimp','Fish Gallery','gallery/fish/thumbs_blue-cherry-shrimp.jpg','fish',10,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(11,'Thumbs Blue Emperor Tetra','Fish Gallery','gallery/fish/thumbs_blue-emperor-tetra.jpg','fish',11,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(12,'Thumbs Blue Gourami','Fish Gallery','gallery/fish/thumbs_blue-gourami.jpg','fish',12,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(13,'Thumbs Blue Moon Lobster','Fish Gallery','gallery/fish/thumbs_blue-moon-lobster.jpg','fish',13,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(14,'Thumbs Blue Rainbow','Fish Gallery','gallery/fish/thumbs_blue-rainbow.jpg','fish',14,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(15,'Thumbs Blue Ramarezi','Fish Gallery','gallery/fish/thumbs_blue-ramarezi.jpg','fish',15,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(16,'Thumbs Boesmani Rainbow','Fish Gallery','gallery/fish/thumbs_boesmani-rainbow.jpg','fish',16,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(17,'Thumbs Cambarellus Puer','Fish Gallery','gallery/fish/thumbs_cambarellus-puer.jpg','fish',17,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(18,'Thumbs Cambarellus Texanus','Fish Gallery','gallery/fish/thumbs_cambarellus-texanus.jpg','fish',18,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(19,'Thumbs Cardinal Tetra','Fish Gallery','gallery/fish/thumbs_cardinal-tetra.jpg','fish',19,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(20,'Thumbs Celebes Harlequin Shrimp','Fish Gallery','gallery/fish/thumbs_celebes_harlequin_shrimp.jpg','fish',20,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(21,'Thumbs Cherry Barb','Fish Gallery','gallery/fish/thumbs_cherry-barb.jpg','fish',21,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(22,'Thumbs Cichlid Blue Morri','Fish Gallery','gallery/fish/thumbs_cichlid-blue-morri.jpg','fish',22,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(23,'Thumbs Cichlid Frontosa','Fish Gallery','gallery/fish/thumbs_cichlid-frontosa.jpg','fish',23,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(24,'Thumbs Cichlid Manaquense','Fish Gallery','gallery/fish/thumbs_cichlid-manaquense.jpg','fish',24,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(25,'Thumbs Colisa Lalia Gourami','Fish Gallery','gallery/fish/thumbs_colisa-lalia-gourami.jpg','fish',25,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(26,'Thumbs Corydoras Aeneus','Fish Gallery','gallery/fish/thumbs_corydoras-aeneus.jpg','fish',26,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(27,'Thumbs Corydoras Albino','Fish Gallery','gallery/fish/thumbs_corydoras-albino.jpg','fish',27,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(28,'Thumbs Corydoras Peppered','Fish Gallery','gallery/fish/thumbs_corydoras-peppered.jpg','fish',28,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(29,'Thumbs Corydoras Sterbai','Fish Gallery','gallery/fish/thumbs_corydoras-sterbai.jpg','fish',29,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(30,'Thumbs Corydoras Metae ','Fish Gallery','gallery/fish/thumbs_corydoras_metae_.jpg','fish',30,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(31,'Thumbs Corydoras Panda','Fish Gallery','gallery/fish/thumbs_corydoras_panda.jpg','fish',31,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(32,'Thumbs Corydoras Similis','Fish Gallery','gallery/fish/thumbs_corydoras_similis.jpg','fish',32,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(33,'Thumbs Diamon Neon Tetra','Fish Gallery','gallery/fish/thumbs_diamon-neon-tetra.jpg','fish',33,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(34,'Thumbs Diamond Tetra','Fish Gallery','gallery/fish/thumbs_diamond-tetra.jpg','fish',34,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(35,'Thumbs Dwarf Gourami','Fish Gallery','gallery/fish/thumbs_dwarf-gourami.jpg','fish',35,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(36,'Thumbs Dwarf Neon Rainbowfish ','Fish Gallery','gallery/fish/thumbs_dwarf_neon_rainbowfish_.jpg','fish',36,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(37,'Thumbs Featheredfin Synodontis','Fish Gallery','gallery/fish/thumbs_featheredfin-synodontis.jpg','fish',37,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(38,'Thumbs Forktail Rainbow','Fish Gallery','gallery/fish/thumbs_forktail-rainbow.jpg','fish',38,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(39,'Thumbs Four Season Shrimp','Fish Gallery','gallery/fish/thumbs_four-season-shrimp.jpg','fish',39,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(40,'Thumbs Gertrudae','Fish Gallery','gallery/fish/thumbs_gertrudae.jpg','fish',40,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(41,'Thumbs Glowlight Tetra','Fish Gallery','gallery/fish/thumbs_glowlight-tetra.jpg','fish',41,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(42,'Thumbs Golden Pencil Tetra','Fish Gallery','gallery/fish/thumbs_golden-pencil-tetra.jpg','fish',42,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(43,'Thumbs Green Scat Brackish','Fish Gallery','gallery/fish/thumbs_green-scat-brackish.jpg','fish',43,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(44,'Thumbs Green Terror Cichlid','Fish Gallery','gallery/fish/thumbs_green-terror-cichlid.jpg','fish',44,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(45,'Thumbs Green Tiger Barb','Fish Gallery','gallery/fish/thumbs_green-tiger-barb.jpg','fish',45,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(46,'Thumbs Hairly Snail','Fish Gallery','gallery/fish/thumbs_hairly-snail.jpg','fish',46,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(47,'Thumbs Hinomaru Shrimp','Fish Gallery','gallery/fish/thumbs_hinomaru-shrimp.jpg','fish',47,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(48,'Thumbs Hybrid Synodontis','Fish Gallery','gallery/fish/thumbs_hybrid-synodontis.jpg','fish',48,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(49,'Thumbs Land Snail','Fish Gallery','gallery/fish/thumbs_land-snail.jpg','fish',49,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(50,'Thumbs Lemon Cichlid','Fish Gallery','gallery/fish/thumbs_lemon-cichlid.jpg','fish',50,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(51,'Thumbs Leopard Ctenopoma','Fish Gallery','gallery/fish/thumbs_leopard-ctenopoma.jpg','fish',51,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(52,'Thumbs Mini Mexican Lobster','Fish Gallery','gallery/fish/thumbs_mini-mexican-lobster.jpg','fish',52,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(53,'Thumbs Monoductylus Brackish','Fish Gallery','gallery/fish/thumbs_monoductylus-brackish.jpg','fish',53,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(54,'Thumbs Neon Tetra','Fish Gallery','gallery/fish/thumbs_neon-tetra.jpg','fish',54,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(55,'Thumbs Orange Lobster','Fish Gallery','gallery/fish/thumbs_orange-lobster.jpg','fish',55,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(56,'Thumbs Orange Rabbit Snail','Fish Gallery','gallery/fish/thumbs_orange-rabbit-snail.jpg','fish',56,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(57,'Thumbs Paradise Fish','Fish Gallery','gallery/fish/thumbs_paradise-fish.jpg','fish',57,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(58,'Thumbs Pearl Gourami','Fish Gallery','gallery/fish/thumbs_pearl-gourami.jpg','fish',58,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(59,'Thumbs Penguin Tetra','Fish Gallery','gallery/fish/thumbs_penguin-tetra.jpg','fish',59,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(60,'Thumbs Rainbow Macullochi','Fish Gallery','gallery/fish/thumbs_rainbow-macullochi.jpg','fish',60,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(61,'Thumbs Rainbow Parkinson','Fish Gallery','gallery/fish/thumbs_rainbow-parkinson.jpg','fish',61,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(62,'Thumbs Rainbow Trifasciata','Fish Gallery','gallery/fish/thumbs_rainbow-trifasciata.jpg','fish',62,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(63,'Thumbs Red Brick Lobster','Fish Gallery','gallery/fish/thumbs_red-brick-lobster.jpg','fish',63,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(64,'Thumbs Red Cherry Shrimp','Fish Gallery','gallery/fish/thumbs_red-cherry-shrimp.jpg','fish',64,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(65,'Thumbs Red Crystal Shrimp','Fish Gallery','gallery/fish/thumbs_red-crystal-shrimp.jpg','fish',65,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(66,'Thumbs Red Devil Cichlid','Fish Gallery','gallery/fish/thumbs_red-devil-cichlid.jpg','fish',66,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(67,'Thumbs Red Eye Tetra','Fish Gallery','gallery/fish/thumbs_red-eye-tetra.jpg','fish',67,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(68,'Thumbs Red Fire Lobster','Fish Gallery','gallery/fish/thumbs_red-fire-lobster.jpg','fish',68,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(69,'Thumbs Red Frontosa','Fish Gallery','gallery/fish/thumbs_red-frontosa.jpg','fish',69,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(70,'Thumbs Red Rainbow','Fish Gallery','gallery/fish/thumbs_red-rainbow.jpg','fish',70,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(71,'Thumbs Red Spotted Snail','Fish Gallery','gallery/fish/thumbs_red-spotted-snail.jpg','fish',71,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(72,'Thumbs Red Vampire Crab','Fish Gallery','gallery/fish/thumbs_red-vampire-crab.jpg','fish',72,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(73,'Thumbs Rose Line Barb','Fish Gallery','gallery/fish/thumbs_rose-line-barb.jpg','fish',73,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(74,'Thumbs Rosy Barb','Fish Gallery','gallery/fish/thumbs_rosy-barb.jpg','fish',74,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(75,'Thumbs Rosy Tetra','Fish Gallery','gallery/fish/thumbs_rosy-tetra.jpg','fish',75,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(76,'Thumbs Rummy Nose Tetra','Fish Gallery','gallery/fish/thumbs_rummy-nose-tetra.jpg','fish',76,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(77,'Thumbs Serpae Longfin Tetra','Fish Gallery','gallery/fish/thumbs_serpae-longfin-tetra.jpg','fish',77,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(78,'Thumbs Serpae Tetra','Fish Gallery','gallery/fish/thumbs_serpae-tetra.jpg','fish',78,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(79,'Thumbs Silver Scat Brackish','Fish Gallery','gallery/fish/thumbs_silver-scat-brackish.jpg','fish',79,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(80,'Thumbs Spider Crab','Fish Gallery','gallery/fish/thumbs_spider-crab.jpg','fish',80,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(81,'Thumbs Spiral Horn Snail','Fish Gallery','gallery/fish/thumbs_spiral-horn-snail.jpg','fish',81,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(82,'Thumbs Spotted Greenpuffer Brackish','Fish Gallery','gallery/fish/thumbs_spotted-greenpuffer-brackish.png','fish',82,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(83,'Thumbs Sunkist Shrimp','Fish Gallery','gallery/fish/thumbs_sunkist-shrimp.jpg','fish',83,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(84,'Thumbs Synodontis Valentiana','Fish Gallery','gallery/fish/thumbs_synodontis-valentiana.jpg','fish',84,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(85,'Thumbs Synodontis Multipunctatus ','Fish Gallery','gallery/fish/thumbs_synodontis_multipunctatus_.jpg','fish',85,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(86,'Thumbs Threadfin Rainbow','Fish Gallery','gallery/fish/thumbs_threadfin-rainbow.jpg','fish',86,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(87,'Thumbs Tiger Barb','Fish Gallery','gallery/fish/thumbs_tiger-barb.jpg','fish',87,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(88,'Thumbs Tiger Snail','Fish Gallery','gallery/fish/thumbs_tiger-snail.jpg','fish',88,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(89,'Thumbs Tropheus Bimba','Fish Gallery','gallery/fish/thumbs_tropheus-bimba.jpg','fish',89,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(90,'Thumbs Tropheus Duboisi','Fish Gallery','gallery/fish/thumbs_tropheus-duboisi.jpg','fish',90,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(91,'Thumbs Tropheus Ikola','Fish Gallery','gallery/fish/thumbs_tropheus-ikola.jpg','fish',91,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(92,'Thumbs Vampire Crab','Fish Gallery','gallery/fish/thumbs_vampire-crab.jpg','fish',92,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(93,'Thumbs Violet Lobster','Fish Gallery','gallery/fish/thumbs_violet-lobster.jpg','fish',93,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(94,'Thumbs Volcano Snail','Fish Gallery','gallery/fish/thumbs_volcano-snail.jpg','fish',94,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(95,'Thumbs White Snow Lobster','Fish Gallery','gallery/fish/thumbs_white-snow-lobster.jpg','fish',95,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(96,'Thumbs White Spot Red Bee Shrimp','Fish Gallery','gallery/fish/thumbs_white-spot-red-bee-shrimp.jpg','fish',96,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(97,'Thumbs Zebra Snail','Fish Gallery','gallery/fish/thumbs_zebra-snail.jpg','fish',97,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(98,'Our Farm 1','Farm Gallery','gallery/farm/Our-Farm-1.jpg','farm',1,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(99,'Our Farm 10','Farm Gallery','gallery/farm/Our-Farm-10.jpg','farm',2,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(100,'Our Farm 11','Farm Gallery','gallery/farm/Our-Farm-11.jpg','farm',3,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(101,'Our Farm 12','Farm Gallery','gallery/farm/Our-Farm-12.jpg','farm',4,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(102,'Our Farm 13','Farm Gallery','gallery/farm/Our-Farm-13.jpg','farm',5,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(103,'Our Farm 14','Farm Gallery','gallery/farm/Our-Farm-14.jpg','farm',6,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(104,'Our Farm 15','Farm Gallery','gallery/farm/Our-Farm-15.jpg','farm',7,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(105,'Our Farm 16','Farm Gallery','gallery/farm/Our-Farm-16.jpg','farm',8,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(106,'Our Farm 17','Farm Gallery','gallery/farm/Our-Farm-17.jpg','farm',9,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(107,'Our Farm 18','Farm Gallery','gallery/farm/Our-Farm-18.jpg','farm',10,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(108,'Our Farm 19','Farm Gallery','gallery/farm/Our-Farm-19.jpg','farm',11,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(109,'Our Farm 2','Farm Gallery','gallery/farm/Our-Farm-2.jpg','farm',12,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(110,'Our Farm 20','Farm Gallery','gallery/farm/Our-Farm-20.jpg','farm',13,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(111,'Our Farm 21','Farm Gallery','gallery/farm/Our-Farm-21.jpg','farm',14,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(112,'Our Farm 22','Farm Gallery','gallery/farm/Our-Farm-22.jpg','farm',15,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(113,'Our Farm 23','Farm Gallery','gallery/farm/Our-Farm-23.jpg','farm',16,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(114,'Our Farm 24','Farm Gallery','gallery/farm/Our-Farm-24.jpg','farm',17,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(115,'Our Farm 25','Farm Gallery','gallery/farm/Our-Farm-25.jpg','farm',18,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(116,'Our Farm 26','Farm Gallery','gallery/farm/Our-Farm-26.jpg','farm',19,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(117,'Our Farm 27','Farm Gallery','gallery/farm/Our-Farm-27.jpg','farm',20,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(118,'Our Farm 28','Farm Gallery','gallery/farm/Our-Farm-28.jpg','farm',21,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(119,'Our Farm 29','Farm Gallery','gallery/farm/Our-Farm-29.jpg','farm',22,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(120,'Our Farm 3','Farm Gallery','gallery/farm/Our-Farm-3.jpg','farm',23,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(121,'Our Farm 30','Farm Gallery','gallery/farm/Our-Farm-30.jpg','farm',24,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(122,'Our Farm 31','Farm Gallery','gallery/farm/Our-Farm-31.jpg','farm',25,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(123,'Our Farm 32','Farm Gallery','gallery/farm/Our-Farm-32.jpg','farm',26,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(124,'Our Farm 33','Farm Gallery','gallery/farm/Our-Farm-33.jpg','farm',27,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(125,'Our Farm 34','Farm Gallery','gallery/farm/Our-Farm-34.jpg','farm',28,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(126,'Our Farm 35','Farm Gallery','gallery/farm/Our-Farm-35.jpg','farm',29,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(127,'Our Farm 36','Farm Gallery','gallery/farm/Our-Farm-36.jpg','farm',30,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(128,'Our Farm 37','Farm Gallery','gallery/farm/Our-Farm-37.jpg','farm',31,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(129,'Our Farm 4','Farm Gallery','gallery/farm/Our-Farm-4.jpg','farm',32,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(130,'Our Farm 6','Farm Gallery','gallery/farm/Our-Farm-6.jpg','farm',33,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(131,'Our Farm 7','Farm Gallery','gallery/farm/Our-Farm-7.jpg','farm',34,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(132,'Our Farm 8','Farm Gallery','gallery/farm/Our-Farm-8.jpg','farm',35,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(133,'Our Farm 9','Farm Gallery','gallery/farm/Our-Farm-9.jpg','farm',36,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(134,'Packaging Process 1','Farm Gallery','gallery/farm/packaging-process-1.jpg','farm',37,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(135,'Packaging Process 2','Farm Gallery','gallery/farm/packaging-process-2.jpg','farm',38,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(136,'Packaging Process 3','Farm Gallery','gallery/farm/packaging-process-3.jpg','farm',39,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(137,'Packaging Process 4','Farm Gallery','gallery/farm/packaging-process-4.jpg','farm',40,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(138,'Packaging Process 5','Farm Gallery','gallery/farm/packaging-process-5.jpg','farm',41,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(139,'Quarantine Fish Room 1','Quality Control','gallery/qc/quarantine-fish-room-1.jpg','quality',1,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(140,'Quarantine Fish Room 2','Quality Control','gallery/qc/quarantine-fish-room-2.jpg','quality',2,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(141,'Shipping Process 1','Quality Control','gallery/qc/shipping-process-1.jpg','quality',3,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(142,'Shipping Process 2','Quality Control','gallery/qc/shipping-process-2.jpg','quality',4,1,'2025-12-28 07:24:25','2025-12-28 07:24:25');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `heroes`
--

DROP TABLE IF EXISTS `heroes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `heroes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `background_type` enum('image','video','youtube') NOT NULL DEFAULT 'image',
  `image_path` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `courtesy_text` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `heroes`
--

LOCK TABLES `heroes` WRITE;
/*!40000 ALTER TABLE `heroes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `heroes` VALUES
(1,'Premium Quality Ornamental Fish','Discover our extensive collection of high-quality ornamental fish, carefully bred and maintained to meet international standards.','youtube',NULL,NULL,'https://youtu.be/hgRSWXJwja4?si=P3AloXxj2wuHSHKY','@AquaExplorer',1,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(2,'Worldwide Export Services','We export premium ornamental fish globally with professional packaging and fast delivery to ensure your fish arrive healthy and safe.','youtube',NULL,NULL,'https://youtu.be/zQ8caaUxIvY?si=52ae0WIvLWc-YQ0i',NULL,2,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(3,'Trusted by Aquarium Enthusiasts','Join thousands of satisfied customers worldwide who trust PT. Tropis Fish Indonesia for their ornamental fish needs.','youtube',NULL,NULL,'https://youtu.be/HHi8qOtHnhE?si=CjtcMLsaqAbbZfQ7','comadyret',3,1,'2025-12-28 07:24:24','2025-12-28 07:24:24');
/*!40000 ALTER TABLE `heroes` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
set autocommit=0;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
set autocommit=0;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2025_12_10_155019_create_admins_table',1),
(5,'2025_12_14_182947_create_galleries_table',1),
(6,'2025_12_14_182951_create_stock_lists_table',1),
(7,'2025_12_15_034918_create_heroes_table',1),
(8,'2025_12_15_035010_create_stats_table',1),
(9,'2025_12_15_035032_create_contact_messages_table',1),
(10,'2025_12_15_035056_create_settings_table',1),
(11,'2025_12_17_035127_create_about_sections_table',1),
(12,'2025_12_18_114259_create_company_sections_table',1),
(13,'2025_12_18_120946_add_layout_to_company_sections_table',1),
(14,'2025_12_18_135801_create_footer_sections_table',1),
(15,'2025_12_18_141045_add_description_and_copyright_to_footer_sections_table',1),
(16,'2025_12_18_141619_update_footer_sections_type_enum',1),
(17,'2025_12_18_142313_create_terms_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
set autocommit=0;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
set autocommit=0;
INSERT INTO `sessions` VALUES
('eUHwrfEXAn3o2wjSieUbKSsupn2sfck94t0iKAUl',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlNnRGhaNzV4ajAza2xpSWFsVjRJNzg0NGFTWThPVTFvaVNERmZtSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1766931967);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `stats`
--

DROP TABLE IF EXISTS `stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `stats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stats`
--

LOCK TABLES `stats` WRITE;
/*!40000 ALTER TABLE `stats` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `stats` VALUES
(1,'Years of Experience','25+',1,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(2,'Fish Species','500+',2,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(3,'Fish Tanks','3000+',3,1,'2025-12-28 07:24:24','2025-12-28 07:24:24'),
(4,'Happy Customers','10K+',4,1,'2025-12-28 07:24:24','2025-12-28 07:24:24');
/*!40000 ALTER TABLE `stats` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `stock_lists`
--

DROP TABLE IF EXISTS `stock_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_lists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `scientific_name` varchar(255) NOT NULL,
  `common_name` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stock_lists_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_lists`
--

LOCK TABLES `stock_lists` WRITE;
/*!40000 ALTER TABLE `stock_lists` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `stock_lists` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `terms`
--

DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `terms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terms`
--

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `terms` VALUES
(1,'Price','All the prices quote here is F.O.B from Jakarta – Indonesia, with US Dollar (USD). The prices can be changed anytime without prior notice.',1,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(2,'Delivery Order','A minimum of 7 (seven) days order notice prior to shipment as highly advisable to ensure proper conditioning of fishes. For the seasonal fishes, please inquire ordering to ensuring the availability.',2,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(3,'Packing','All fishes are packing in double plastic bags. Our packing bag and box are IATA standard, and we use styrofoam, plastic bag, and carton box for packing.\n\nOne box normally content of 4 bags with double plastic bags for safety with box dimension 60 x 40 x 32cm, and have another box also which could content of 6 bags, with box dimension 75 x 40 x 32cm.',3,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(4,'Dimension','We use two types of boxes, there are:\n\n1) 60 x 40 x 32 cm\nActual weight 15kgs for freshwater fishes. Estimated weight 14-16 kgs (4 bags).\n\n2) 75 x 40 x 32 cm\nActual weight 17kgs. Estimated weight 17-20kgs (6 bags).\n\nFor total weight of boxes, it depends of the weight of fishes, and packing density for each box.',4,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(5,'Claim for D.O.A.','Complain only received within 24 hours after the shipment arrival. Any shipment without news in 24 hours after the arrival, must be accepted well by consignee.',5,1,'2025-12-28 07:24:25','2025-12-28 07:24:25'),
(6,'Payment','For new buyer, advance payment in full is required prior to shipment. Credit terms can be negotiated upon the establishment of regular business.',6,1,'2025-12-28 07:24:25','2025-12-28 07:24:25');
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
set autocommit=0;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-12-28 21:26:09
