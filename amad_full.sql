/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 8.0.30 : Database - amad_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`amad_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `amad_db`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `logtable` */

DROP TABLE IF EXISTS `logtable`;

CREATE TABLE `logtable` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1350285 DEFAULT CHARSET=latin1;

/*Data for the table `logtable` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2021_05_11_160520_create_images_table',2),
(5,'2021_05_11_205347_create_asuetos_table',3),
(7,'2021_05_13_200610_create_tipodocumentos_table',4),
(9,'2021_05_13_203407_create_tiponotas_table',5),
(10,'2021_05_13_205018_create_tipotareas_table',6),
(12,'2021_05_17_154649_create_entidads_table',7),
(14,'2021_05_17_161732_create_tipo_solicituds_table',8),
(15,'2021_05_17_180945_create_clase_solicituds_table',9),
(16,'2021_05_17_200355_create_tipo_movimientos_table',10),
(17,'2021_05_17_203328_documentos',11),
(19,'2021_05_25_202312_create_dependencias_table',12);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'App\\User',1,'1','1','2023-08-10 11:54:14','2023-08-10 11:54:14'),
(17,'App\\User',193,'1','1','2024-03-08 10:02:32','2024-03-08 10:02:32'),
(18,'App\\User',194,'1','1','2024-03-08 09:48:34','2024-03-08 09:48:34'),
(19,'App\\User',195,'1','1','2024-03-08 09:48:58','2024-03-08 09:48:58');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(1,'seguridad','web','2024-03-06 08:53:32','2024-03-08 09:46:12'),
(2,'ver-listado-empresas','web','2024-03-06 08:54:06','2024-03-06 08:54:06'),
(3,'ver-listado-instituciones','web','2024-03-06 08:54:22','2024-03-06 08:54:22'),
(4,'ver-listado-estudios','web','2024-03-06 08:54:37','2024-03-06 08:54:37'),
(5,'ver-listado-especialistas','web','2024-03-06 08:55:32','2024-03-06 08:55:32'),
(6,'ver-listado-transacciones','web','2024-03-06 08:55:59','2024-03-06 08:55:59'),
(7,'ver-listado-cobros','web','2024-03-06 08:56:20','2024-03-06 08:56:20'),
(8,'ver-listado-pagos','web','2024-03-06 08:56:52','2024-03-06 08:56:52'),
(9,'ver-generales','web','2024-03-08 09:51:35','2024-03-08 09:51:35');

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(2,17,'2024-03-08 09:51:42','2024-03-08 09:51:42',NULL,NULL),
(3,17,'2024-03-08 09:51:42','2024-03-08 09:51:42',NULL,NULL),
(4,17,'2024-03-08 09:51:42','2024-03-08 09:51:42',NULL,NULL),
(5,17,'2024-03-08 09:51:42','2024-03-08 09:51:42',NULL,NULL),
(6,17,'2024-03-08 09:51:42','2024-03-08 09:51:42',NULL,NULL),
(6,18,'2024-03-07 10:05:44','2024-03-07 10:05:44',NULL,NULL),
(6,19,'2024-03-07 10:05:59','2024-03-07 10:05:59',NULL,NULL),
(7,17,'2024-03-08 09:51:42','2024-03-08 09:51:42',NULL,NULL),
(8,17,'2024-03-08 09:51:42','2024-03-08 09:51:42',NULL,NULL),
(9,17,'2024-03-08 09:51:42','2024-03-08 09:51:42',NULL,NULL);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(1,'Super Admin','web','2022-10-28 09:32:54','2022-10-28 09:32:57'),
(17,'Administrador','web','2024-03-06 08:58:27','2024-03-08 09:33:45'),
(18,'Tecnico','web','2024-03-07 10:05:12','2024-03-07 10:05:44'),
(19,'Radiologo','web','2024-03-07 10:05:26','2024-03-07 10:05:26');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '0',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`name`,`profile_picture`,`email`,`email_verified_at`,`estado`,`password`,`remember_token`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,'dmelchor','Daniel Alfonso Melchor Anleu','profile_pictures/1701204321_20181208_104759.jpg','dmelchor@muniguate.com',NULL,1,'$2y$10$lZnG/AGBHETG6FgA/OYYfO5yhfH0B07R7wrI/gNnI9FqG3uua.kle','ZTyegYm5V3Cw0BrGcsaZHdQ7hlTdkTHj3iMl5WAdCOsFbfvSOUXX7ox9O9zY','2023-03-09 10:33:13','2023-11-28 14:45:21',NULL,'1'),
(193,'cguillermo','Cristian Guillermo',NULL,'cguillermo@gmail.com',NULL,0,'$2y$10$lrUDlIVAMa/X/AphvPM86e2PeRgIgLm9Cthz7pHpI5/.vwdj2qf32',NULL,'2024-03-06 12:04:38','2024-03-08 10:01:57','1','1'),
(194,'tecnico','Técnico',NULL,'tecnico@gmail.com',NULL,0,'$2y$10$tcN4eTZqQc7e9OivDN0fZuQCXbyP8XvKCCtj.y2TzG2FJFUls5YPu',NULL,'2024-03-08 09:48:25','2024-03-08 09:48:25','1','1'),
(195,'radiologo','Radiologo',NULL,'radiologo@muniguate.com',NULL,0,'$2y$10$hKjhqq/.fZmv/Ze4x9fLVeKmTQVk78Z88ZWwIL0U5ut96s8r.FWdG',NULL,'2024-03-08 09:48:52','2024-03-08 09:48:52','1','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
