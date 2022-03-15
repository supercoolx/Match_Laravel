/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.21-MariaDB : Database - match1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`match` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `match`;

/*Table structure for table `addresses` */

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

/*Data for the table `addresses` */

insert  into `addresses`(`id`,`name`,`parent_id`,`created_at`,`updated_at`) values 
(1,'関東',0,'2021-11-28 14:16:50','2021-11-28 14:16:50'),
(2,'東海',0,'2021-11-28 14:16:55','2021-11-28 14:16:55'),
(3,'関西',0,'2021-11-28 14:17:06','2021-11-28 14:17:06'),
(4,'九州',0,'2021-11-28 14:17:09','2021-11-28 14:17:09'),
(5,'東京都',1,'2021-11-28 14:17:30','2021-11-28 14:17:30'),
(6,'神奈川県',1,'2021-11-28 14:17:35','2021-11-28 14:17:35'),
(7,'千葉県',1,'2021-11-28 14:17:40','2021-11-28 14:17:40'),
(8,'埼玉県',1,'2021-11-28 14:17:42','2021-11-28 14:17:42'),
(9,'23区内',5,'2021-11-28 14:18:22','2021-11-28 14:18:22'),
(10,'その他',5,'2021-11-28 14:18:27','2021-11-28 14:18:27'),
(11,'横浜市',6,'2021-11-28 14:18:43','2021-11-28 14:18:43'),
(12,'その他',6,'2021-11-28 14:18:48','2021-11-28 14:18:48'),
(13,'六本木・麻布・赤坂',9,'2021-11-28 14:19:14','2021-11-28 14:19:14'),
(14,'品川・三田・浜松町',9,'2021-11-28 14:19:20','2021-11-28 14:19:20'),
(15,'渋谷・原宿・代官山',9,'2021-11-28 14:19:25','2021-11-28 14:19:25'),
(16,'恵比寿・中目黒・目黒',9,'2021-11-28 14:19:30','2021-11-28 14:19:30'),
(17,'上野・日暮里・御徒町',9,'2021-11-28 14:19:35','2021-11-28 14:19:35'),
(18,'新宿・代々木・大久保',9,'2021-11-28 14:19:40','2021-11-28 14:19:40'),
(19,'池袋・高田馬場・目白',9,'2021-11-28 14:19:46','2021-11-28 14:19:46'),
(20,'神楽坂・飯田橋・四谷',9,'2021-11-28 14:19:51','2021-11-28 14:19:51'),
(21,'高円寺・荻窪・中野・阿佐ヶ谷',9,'2021-11-28 14:19:57','2021-11-28 14:19:57'),
(22,'下北沢・笹塚・明大前',9,'2021-11-28 14:20:02','2021-11-28 14:20:02'),
(23,'三軒茶屋・世田谷・池尻大橋',9,'2021-11-28 14:20:07','2021-11-28 14:20:07'),
(24,'銀座・京橋・有楽町',9,'2021-11-28 14:20:14','2021-11-28 14:20:14'),
(25,'東京・日本橋・大手町',9,'2021-11-28 14:20:19','2021-11-28 14:20:19'),
(26,'神保町・水道橋・九段下',9,'2021-11-28 14:20:26','2021-11-28 14:20:26'),
(27,'秋葉原・神田・御茶ノ水',9,'2021-11-28 14:20:32','2021-11-28 14:20:32'),
(28,'五反田・大崎',9,'2021-11-28 14:20:38','2021-11-28 14:20:38'),
(29,'愛知県',2,'2021-11-28 14:22:35','2021-11-28 14:22:35'),
(30,'大阪府',3,'2021-11-28 14:23:33','2021-11-28 14:23:33'),
(31,'兵庫県',3,'2021-11-28 14:23:39','2021-11-28 14:23:39'),
(32,'京都府',3,'2021-11-28 14:23:40','2021-11-28 14:23:40'),
(33,'大阪市',30,'2021-11-28 14:24:06','2021-11-28 14:24:06'),
(34,'その他',30,'2021-11-28 14:24:11','2021-11-28 14:24:11'),
(35,'新大阪・江坂・西中島南方',33,'2021-11-28 14:25:02','2021-11-28 14:25:02'),
(36,'南森町・大阪ビジネスパーク・京橋',33,'2021-11-28 14:25:08','2021-11-28 14:25:08'),
(37,'梅田・中津・堂島',33,'2021-11-28 14:25:13','2021-11-28 14:25:13'),
(38,'中之島・淀屋橋・肥後橋',33,'2021-11-28 14:25:19','2021-11-28 14:25:19'),
(39,'本町・四ツ橋・なんば',33,'2021-11-28 14:25:24','2021-11-28 14:25:24'),
(40,'天王寺・阿倍野・大国町',33,'2021-11-28 14:25:30','2021-11-28 14:25:30'),
(41,'西九条・弁天町・大正',33,'2021-11-28 14:25:32','2021-11-28 14:25:32'),
(42,'福岡県',4,'2021-11-28 14:26:12','2021-11-28 14:26:12'),
(43,'長崎県',4,'2021-11-28 14:26:18','2021-11-28 14:26:18'),
(44,'熊本県',4,'2021-11-28 14:26:20','2021-11-28 14:26:20'),
(45,'大分県',4,'2021-11-28 14:26:24','2021-11-28 14:26:24'),
(46,'福岡市',42,'2021-11-28 14:26:53','2021-11-28 14:26:53'),
(47,'その他',42,'2021-11-28 14:26:55','2021-11-28 14:26:55');

/*Table structure for table `channels` */

DROP TABLE IF EXISTS `channels`;

CREATE TABLE `channels` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `user_f` int(11) DEFAULT NULL,
  `user_s` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `channels` */

/*Table structure for table `contract_types` */

DROP TABLE IF EXISTS `contract_types`;

CREATE TABLE `contract_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(31) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `contract_types` */

insert  into `contract_types`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'業務委託','2021-11-21 22:41:31','2021-11-21 22:41:31'),
(2,'正社員','2021-11-21 22:41:36','2021-11-21 22:41:36'),
(3,'契約社員','2021-11-21 22:41:41','2021-11-21 22:41:41'),
(4,'派遣','2021-11-21 22:41:44','2021-11-21 22:41:44');

/*Table structure for table `dresses` */

DROP TABLE IF EXISTS `dresses`;

CREATE TABLE `dresses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(1023) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `dresses` */

insert  into `dresses`(`id`,`name`) values 
(1,'私服'),
(2,'ビジネスカジュアル'),
(3,'スーツ'),
(4,'こだわりはない');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `industries` */

DROP TABLE IF EXISTS `industries`;

CREATE TABLE `industries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `industries` */

insert  into `industries`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'ソーシャルゲーム','2021-11-20 22:22:40','2021-11-20 22:22:40'),
(2,'生命保険','2021-11-20 22:22:48','2021-11-20 22:22:48'),
(3,'証券','2021-11-20 22:22:52','2021-11-20 22:22:52'),
(4,'人材･教育','2021-11-20 22:22:57','2021-11-20 22:22:57'),
(5,'医療･福祉','2021-11-20 22:23:02','2021-11-20 22:23:02'),
(6,'小売','2021-11-20 22:23:07','2021-11-20 22:23:07'),
(7,'放送・出版・音楽・芸能','2021-11-20 22:23:12','2021-11-20 22:23:12'),
(8,'官公庁','2021-11-20 22:23:17','2021-11-20 22:23:17'),
(9,'通信','2021-11-20 22:23:22','2021-11-20 22:23:22'),
(10,'ビッグデータ','2021-11-20 22:23:27','2021-11-20 22:23:27'),
(11,'ECサイト','2021-11-20 22:23:32','2021-11-20 22:23:32'),
(12,'コンシューマーゲーム','2021-11-20 22:23:37','2021-11-20 22:23:37'),
(13,'損害保険','2021-11-20 22:23:42','2021-11-20 22:23:42'),
(14,'銀行','2021-11-20 22:23:46','2021-11-20 22:23:46'),
(15,'クレジットカード・信販','2021-11-20 22:23:49','2021-11-20 22:23:49');

/*Table structure for table `invites` */

DROP TABLE IF EXISTS `invites`;

CREATE TABLE `invites` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `email` varchar(127) NOT NULL,
  `token` varchar(127) NOT NULL,
  `accepted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `invites` */

/*Table structure for table `job_types` */

DROP TABLE IF EXISTS `job_types`;

CREATE TABLE `job_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `more` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `job_types` */

insert  into `job_types`(`id`,`name`,`created_at`,`updated_at`,`more`) values 
(1,'ITコンサルタント','2021-11-20 22:19:27','2021-11-20 22:19:27',1),
(2,'データサイエンティスト','2021-11-20 22:19:33','2021-11-20 22:19:33',1),
(3,'ネットワークエンジニア','2021-11-20 22:19:43','2021-11-20 22:19:43',1),
(4,'サーバーエンジニア','2021-11-20 22:19:49','2021-11-20 22:19:49',1),
(5,'インフラエンジニア','2021-11-20 22:19:58','2021-11-20 22:19:58',1),
(6,'テクニカルサポート','2021-11-20 22:20:03','2021-11-20 22:20:03',1),
(7,'フロントエンドエンジニア','2021-11-20 22:20:10','2021-11-20 22:20:10',1),
(8,'サーバーサイドエンジニア','2021-11-20 22:20:18','2021-11-20 22:20:18',1),
(9,'アプリケーションエンジニア','2021-11-20 22:20:25','2021-11-20 22:20:25',1),
(10,'セキュリティエンジニア','2021-11-20 22:20:31','2021-11-20 22:20:31',1),
(11,'データベースエンジニア','2021-11-20 22:20:37','2021-11-20 22:20:37',1),
(12,'テストエンジニア','2021-11-20 22:20:43','2021-11-20 22:20:43',1),
(13,'社内SE','2021-11-20 22:20:50','2021-11-20 22:20:50',1),
(14,'プロジェクトマネージャ','2021-11-20 22:20:56','2021-11-20 22:20:56',1),
(15,'ゲームエンジニア','2021-11-20 22:21:03','2021-11-20 22:21:03',1),
(16,'デザイナー','2021-11-20 22:21:11','2021-11-20 22:21:11',1),
(17,'プランナー','2021-11-20 22:21:17','2021-11-20 22:21:17',1),
(18,'ディレクター','2021-11-20 22:21:22','2021-11-20 22:21:22',1),
(19,'プロデューサー','2021-11-20 22:21:25','2021-11-20 22:21:25',1),
(20,'一般事務','2021-11-25 14:02:45','2021-11-25 14:02:45',1),
(21,'営業事務','2021-11-25 14:07:41','2021-11-25 14:07:41',0),
(22,'人事','2021-11-25 14:07:51','2021-11-25 14:07:51',0),
(23,'総務・労務','2021-11-25 14:08:02','2021-11-25 14:08:02',0),
(24,'広報・採用','2021-11-25 14:08:14','2021-11-25 14:08:14',0),
(25,'経理','2021-11-25 14:08:24','2021-11-25 14:08:24',0),
(26,'通訳・翻訳','2021-11-25 14:08:40','2021-11-25 14:08:40',0),
(27,'動画制作','2021-11-25 14:08:55','2021-11-25 14:08:55',0),
(28,'警備・清掃','2021-11-25 14:09:08','2021-11-25 14:09:08',0),
(29,'飲食・販売','2021-11-25 14:09:10','2021-11-25 14:09:10',0);

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `channel_id` bigint(20) DEFAULT NULL,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `type` char(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4;

/*Data for the table `messages` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `profile_contract` */

DROP TABLE IF EXISTS `profile_contract`;

CREATE TABLE `profile_contract` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `profile_contract` */

/*Table structure for table `profile_education` */

DROP TABLE IF EXISTS `profile_education`;

CREATE TABLE `profile_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `school_name` varchar(1023) NOT NULL,
  `subject_name` varchar(1023) DEFAULT NULL,
  `start_date` varchar(31) DEFAULT NULL,
  `end_date` varchar(31) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4;

/*Data for the table `profile_education` */

/*Table structure for table `profile_employees` */

DROP TABLE IF EXISTS `profile_employees`;

CREATE TABLE `profile_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `employee_name` varchar(63) NOT NULL,
  `employee_date` varchar(31) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4;

/*Data for the table `profile_employees` */

/*Table structure for table `profile_experiences` */

DROP TABLE IF EXISTS `profile_experiences`;

CREATE TABLE `profile_experiences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(1023) NOT NULL,
  `start_date` varchar(31) DEFAULT NULL,
  `end_date` varchar(31) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4;

/*Data for the table `profile_experiences` */

/*Table structure for table `profile_job` */

DROP TABLE IF EXISTS `profile_job`;

CREATE TABLE `profile_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4;

/*Data for the table `profile_job` */

/*Table structure for table `profile_portfolios` */

DROP TABLE IF EXISTS `profile_portfolios`;

CREATE TABLE `profile_portfolios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(1023) NOT NULL,
  `link` varchar(1023) DEFAULT NULL,
  `date` varchar(31) DEFAULT NULL,
  `image` varchar(63) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4;

/*Data for the table `profile_portfolios` */

/*Table structure for table `profile_qualifications` */

DROP TABLE IF EXISTS `profile_qualifications`;

CREATE TABLE `profile_qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(1023) NOT NULL,
  `date` varchar(31) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4;

/*Data for the table `profile_qualifications` */

/*Table structure for table `profile_skills` */

DROP TABLE IF EXISTS `profile_skills`;

CREATE TABLE `profile_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(1023) NOT NULL,
  `year` varchar(1023) NOT NULL,
  `type` varchar(1023) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=312 DEFAULT CHARSET=utf8mb4;

/*Data for the table `profile_skills` */

/*Table structure for table `profile_writings` */

DROP TABLE IF EXISTS `profile_writings`;

CREATE TABLE `profile_writings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(1023) NOT NULL,
  `link` varchar(1023) DEFAULT NULL,
  `date` varchar(31) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

/*Data for the table `profile_writings` */

/*Table structure for table `profiles` */

DROP TABLE IF EXISTS `profiles`;

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `week` int(4) DEFAULT NULL,
  `icon` tinyint(1) DEFAULT 1,
  `full_name` tinyint(1) DEFAULT 1,
  `phone` tinyint(1) DEFAULT 1,
  `open_job` tinyint(1) DEFAULT 1,
  `remote_work_id` int(11) DEFAULT NULL,
  `join_date` varchar(31) DEFAULT NULL,
  `dress_id` int(11) DEFAULT NULL,
  `salary` int(11) unsigned DEFAULT NULL,
  `location` varchar(1023) DEFAULT NULL,
  `other` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4;

/*Data for the table `profiles` */

/*Table structure for table `project_contract` */

DROP TABLE IF EXISTS `project_contract`;

CREATE TABLE `project_contract` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

/*Data for the table `project_contract` */

/*Table structure for table `projects` */

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1023) NOT NULL,
  `price_min` int(11) NOT NULL,
  `price_max` int(11) NOT NULL,
  `job_type` int(11) DEFAULT NULL,
  `industry` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `required_skills` text DEFAULT NULL,
  `applicable_skills` text DEFAULT NULL,
  `required_person` text DEFAULT NULL,
  `team_structure` text DEFAULT NULL,
  `gained_skills` text DEFAULT NULL,
  `work_location` varchar(1023) DEFAULT NULL,
  `interviews` int(1) DEFAULT NULL,
  `start_date` varchar(31) DEFAULT NULL,
  `start_time` varchar(15) DEFAULT NULL,
  `end_time` varchar(15) DEFAULT NULL,
  `uptime_min` int(4) DEFAULT NULL,
  `uptime_max` int(4) DEFAULT NULL,
  `week` int(1) DEFAULT NULL,
  `contract_type` varchar(1023) DEFAULT NULL,
  `online_interview` tinyint(1) DEFAULT 0,
  `remote_work` tinyint(1) DEFAULT 0,
  `comment` text DEFAULT NULL,
  `avatar` tinyint(1) DEFAULT 0,
  `client` tinyint(1) DEFAULT 0,
  `image` varchar(1023) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` int(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

/*Data for the table `projects` */

/*Table structure for table `remote_works` */

DROP TABLE IF EXISTS `remote_works`;

CREATE TABLE `remote_works` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(1023) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `remote_works` */

insert  into `remote_works`(`id`,`name`) values 
(1,'フルリモート'),
(2,'出社とリモート選択可能'),
(3,'フル出社'),
(4,'こだわりはない');

/*Table structure for table `user_follow` */

DROP TABLE IF EXISTS `user_follow`;

CREATE TABLE `user_follow` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `follow` int(11) unsigned NOT NULL,
  `follow_by` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_follow` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_kana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(2047) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(1) NOT NULL,
  `chat_mail` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `verification_code` varchar(63) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`name_kana`,`email`,`email_verified_at`,`password`,`remember_token`,`phone`,`avatar`,`website`,`user_type`,`chat_mail`,`created_at`,`updated_at`,`verification_code`,`deleted`) values 
(1,'company','company','company@email.com','2021-11-22 13:11:32','$2y$10$M5wCiOkfpSnl.V8wVYFwvONYzBHY7Mb0oxslGQC7xsUbAPgQA02Le',NULL,'34-5234-5345','avatar/FQEGJIcxo4eq8MWhFeSi6ylqCJyPlUNYKyMjyk1S.jpg','https://www.google.com',1,1,'2021-11-22 13:10:32','2022-02-03 21:31:19',NULL,0),
(2,'氏名','氏名(カナ)','agent@email.com','2021-11-24 01:11:01','$2y$10$M5wCiOkfpSnl.V8wVYFwvONYzBHY7Mb0oxslGQC7xsUbAPgQA02Le',NULL,'345-2345-3454','avatar/J4d2XIEOhjTLoBPjBEtQNRObReOqC1cqUFSjl8SH.jpg',NULL,2,0,'2021-11-24 01:08:01','2022-01-31 02:44:00',NULL,0),
(3,'山田','山田(太郎)','engineer@email.com','2021-11-25 02:11:27','$2y$10$M5wCiOkfpSnl.V8wVYFwvONYzBHY7Mb0oxslGQC7xsUbAPgQA02Le',NULL,'345-2345-3451','avatar/FYUhSuZvumXb1XHftzQKPNmubSqToETIUGRs1F8W.jpg',NULL,3,1,'2021-11-25 02:35:27','2022-02-04 13:37:33','d9706a16190e7ae86294d36541f9d878',0),
(4,'admin','admin','admin@match.jp','2021-12-02 15:42:54','$2y$10$M5wCiOkfpSnl.V8wVYFwvONYzBHY7Mb0oxslGQC7xsUbAPgQA02Le',NULL,NULL,NULL,NULL,0,0,'2021-12-02 15:43:25','2021-12-04 01:33:42',NULL,0);

/*Table structure for table `weeks` */

DROP TABLE IF EXISTS `weeks`;

CREATE TABLE `weeks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(7) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `weeks` */

insert  into `weeks`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'1日','2021-11-21 22:40:37','2021-11-21 22:40:37'),
(2,'2日','2021-11-21 22:40:38','2021-11-21 22:40:38'),
(3,'3日','2021-11-21 22:40:39','2021-11-21 22:40:39'),
(4,'4日','2021-11-21 22:40:41','2021-11-21 22:40:41'),
(5,'5日','2021-11-21 22:40:46','2021-11-21 22:40:46');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
