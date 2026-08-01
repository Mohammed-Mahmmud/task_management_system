-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Aug 01, 2026 at 06:32 PM
-- Server version: 8.0.46
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_01_075208_create_projects_table', 1),
(5, '2026_08_01_075209_create_tasks_table', 1),
(6, '2026_08_01_104134_create_personal_access_tokens_table', 1),
(7, '2026_08_01_132004_add_overdue_notified_at_to_tasks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', 'b307ddaf0841955cf90a70020096fcf534b34327622a253d9c98819f6c8ab0da', '[\"*\"]', '2026-08-01 17:24:38', NULL, '2026-08-01 17:12:35', '2026-08-01 17:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'distinctio sed eos', 'Esse omnis ut velit pariatur nulla omnis qui.', 'active', '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(2, 1, 'autem molestias aut', 'Voluptas natus nihil aliquam et eligendi dignissimos voluptatum incidunt.', 'active', '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(3, 1, 'vero consequuntur sit', 'Temporibus assumenda consequatur nostrum rerum incidunt ipsum atque nihil aut voluptatibus placeat iste dolorem.', 'active', '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(4, 2, 'doloribus eum et', 'Aperiam vitae et consequuntur nisi dignissimos quis et harum iure enim fuga.', 'active', '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(5, 2, 'ratione dolor molestiae', 'Aperiam aperiam quia esse velit explicabo odio.', 'active', '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(6, 2, 'occaecati quo molestias', 'Eaque ducimus quia corrupti et eum eveniet et et dolore vel.', 'active', '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(7, 2, 'aliquam eligendi beatae', 'Amet nisi illo vel quae sit quidem aliquam asperiores fuga.', 'active', '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(8, 3, 'quia laudantium neque', 'Quos in provident necessitatibus unde sunt repellendus aspernatur dolorum quae.', 'active', '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(9, 3, 'optio consequatur nobis', 'Enim est voluptatem asperiores architecto et ut quaerat cupiditate quasi magni.', 'active', '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(10, 3, 'optio a ab', 'Explicabo autem quas quos recusandae quia quos adipisci.', 'active', '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(11, 3, 'labore libero sequi', 'Delectus aliquid consectetur ducimus provident autem aut quisquam fuga qui.', 'active', '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(12, 3, 'dolores ut deserunt', 'Doloremque sunt similique quasi modi dolore ducimus.', 'active', '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EkM67JAaVhVcsOO7gSTOwWJEKEYcG4yPA27gUuqg', NULL, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJNTkJ0WFBSVVhhZk1RQ1hMcFdjdDVqNEkzMnE4Z2M5MUF0UFlXSFNlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1785606815);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'todo',
  `due_date` date DEFAULT NULL,
  `overdue_notified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `title`, `description`, `priority`, `status`, `due_date`, `overdue_notified_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Dolores ut soluta.', 'Dolores et impedit dolorum adipisci. Tenetur natus qui odio rerum iste. Nesciunt aut ullam eum omnis ab.', 'low', 'done', '2026-08-18', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(2, 1, 'Reiciendis magni necessitatibus dolorem odio dolor.', 'Sunt iure iusto aliquid explicabo. Sed et sapiente debitis et rerum corporis aut. Recusandae enim natus quis. Dolorem nesciunt qui impedit sequi cum consectetur labore.', 'medium', 'todo', '2026-07-24', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(3, 1, 'Dicta deleniti autem.', 'Et qui ipsum illum blanditiis nihil et aut veniam. Qui numquam voluptatem voluptates. Quo voluptatem temporibus similique.', 'low', 'todo', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(4, 1, 'Beatae vitae est.', 'Fugiat aut itaque accusantium cupiditate sint tempore quo. Non debitis omnis quidem vel occaecati amet consectetur omnis. Est unde animi nihil dolor debitis et cupiditate facere. Et rerum occaecati quod quia quod cupiditate.', 'low', 'in_progress', '2026-08-09', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(5, 1, 'Aliquam doloribus ut incidunt.', 'Aspernatur vel unde omnis maiores qui dolorum rem. Ab ducimus veniam optio necessitatibus. Voluptatem ut non officiis earum voluptas.', 'medium', 'in_progress', '2026-07-04', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(6, 1, 'Enim aut itaque nemo maiores.', 'Temporibus sit possimus ut nihil numquam ut. Dolor distinctio ut illum perspiciatis est debitis aliquam sint. Impedit labore beatae doloribus rerum. Aut officiis non cumque et atque.', 'medium', 'in_progress', '2026-08-14', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(7, 1, 'Quia excepturi veniam tenetur natus et.', 'Quam at qui recusandae unde maxime. Quidem minima et doloribus est quos ipsa sint. Magni molestiae dolores id placeat laborum odit. Nobis soluta et quo animi repellat.', 'low', 'in_progress', '2026-07-12', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(8, 1, 'Et incidunt officiis qui dolorem sed.', 'Et assumenda esse excepturi accusamus vel. In placeat non non reiciendis quas eaque sunt. Illum architecto quidem aut. Quae beatae non in quis. Debitis qui quo odio minus sint.', 'low', 'in_progress', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(9, 1, 'Error rerum ratione facilis porro et.', 'Fuga quod sunt sit voluptatem. A ab officia quia fugiat voluptatem cupiditate. Ut et ducimus odit ut. Temporibus voluptatum minus tenetur saepe non.', 'low', 'in_progress', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(10, 1, 'Nesciunt id voluptatem nobis vel.', 'Repellat et ex incidunt molestias dicta et. Nemo eos reprehenderit laboriosam autem. Pariatur porro dignissimos sunt dolor. Consequatur itaque quo voluptatum doloribus cumque.', 'low', 'in_progress', '2026-07-30', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(11, 1, 'Accusamus pariatur eveniet in.', 'Quibusdam est reprehenderit officia dolor omnis delectus autem. Quis dignissimos quo ipsum sequi deleniti debitis. Dolorem quis ea enim quis dolores.', 'low', 'done', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(12, 1, 'Suscipit est consequuntur ut repellat.', 'Aut rem ex consequatur laudantium. Vel ipsum ut voluptatum laudantium veritatis ullam repellendus. Delectus excepturi sed accusamus earum perspiciatis quod hic. Dolores beatae reprehenderit optio nulla accusantium.', 'high', 'done', '2026-07-23', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(13, 1, 'Corporis et repudiandae fugiat error.', 'Nam quisquam rerum incidunt ipsam magnam commodi et laudantium. Temporibus voluptates iste deleniti nulla ratione quo voluptas quis. Accusamus voluptas architecto non facere quos qui. Et commodi mollitia corrupti ipsum rerum.', 'high', 'in_progress', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(14, 1, 'Ad dolor pariatur consequatur.', 'Necessitatibus sit magnam quia a quas voluptas. Facere magnam commodi dolores mollitia velit ut. Vero magnam repellendus eligendi optio. Qui iste molestiae alias sed suscipit.', 'high', 'todo', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(15, 1, 'Consequatur amet quis reiciendis.', 'Vel saepe et minima odit vero ipsam quaerat. Aliquid perferendis velit aut esse. Doloribus rem cumque est ipsam consequuntur. Quia quasi incidunt ut beatae at esse.', 'low', 'in_progress', '2026-08-30', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(16, 2, 'Voluptas molestiae sequi vero quia exercitationem.', 'Aut voluptatem vero quam sunt itaque quae quas architecto. Nesciunt et sunt vel. Facilis cum velit incidunt quia ut vel. Omnis tenetur voluptas et. Explicabo tempora et quis incidunt accusamus inventore quos dolorem.', 'low', 'in_progress', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(17, 2, 'Et ratione quia et id.', 'Alias aut molestias eaque laboriosam tempore ut accusantium. Velit qui suscipit at consequuntur doloribus. Tempora est ad dolor vel dolorem dolorum soluta consequatur. Aut sapiente quisquam quas et.', 'low', 'done', '2026-07-11', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(18, 2, 'Sed reiciendis laboriosam qui nisi provident.', 'Et excepturi est eos. Eos et maxime magnam est magni. Officiis est enim voluptas sit quia quo sint.', 'high', 'todo', '2026-07-03', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(19, 2, 'Recusandae quis labore quam.', 'Ut consequuntur animi fugit qui nobis suscipit eos. Deserunt dignissimos omnis ad porro dolor rem. Aut ut sit officia sed reprehenderit occaecati veritatis et. Corrupti animi corporis ducimus blanditiis exercitationem.', 'low', 'todo', '2026-08-12', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(20, 2, 'Similique nostrum corporis.', 'Delectus quis quas commodi. Voluptatem ut in voluptate error impedit. Ut accusantium non tempora odit. Qui vel id nihil.', 'high', 'done', '2026-07-18', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(21, 2, 'Rem nulla qui facilis eum porro.', 'Deleniti sint aperiam voluptas quos ea ipsum. Itaque nam architecto atque ullam aperiam. Accusantium quam odit optio velit vel expedita. Est maiores neque vitae praesentium. Perferendis iusto aut delectus rem est.', 'high', 'todo', '2026-07-11', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(22, 2, 'Maxime totam expedita mollitia tenetur.', 'Non aut exercitationem impedit ut soluta beatae. Similique et natus mollitia fuga qui.', 'low', 'done', '2026-08-05', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(23, 2, 'Ratione tempora quae.', 'Eos et molestiae doloribus repellendus modi modi similique impedit. Blanditiis expedita culpa non perspiciatis in. Dolore laboriosam tempora sit. Ex reiciendis accusantium omnis quia non suscipit reprehenderit enim.', 'medium', 'done', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(24, 2, 'Distinctio explicabo repellendus est doloremque unde.', 'Magnam vero beatae reiciendis ab sit est architecto. Est non provident minus qui et aperiam debitis. Illo nemo illum cupiditate incidunt repellendus dolor soluta.', 'low', 'in_progress', '2026-07-31', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(25, 2, 'Esse voluptatem a quibusdam reprehenderit.', 'Eius rem quia et doloremque quas provident iste dolores. Et dolor ipsam aperiam. Harum enim laudantium dolor autem.', 'low', 'todo', '2026-07-02', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(26, 2, 'Voluptatem amet quaerat vitae.', 'Voluptate debitis tempora pariatur et architecto itaque et voluptas. Voluptatem veniam est et eligendi. Amet nihil nulla molestiae fuga quia.', 'low', 'done', '2026-07-28', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(27, 2, 'Omnis dolorem suscipit aut occaecati.', 'Minima iusto est ducimus temporibus amet perspiciatis. Quis ut quisquam voluptatem perferendis necessitatibus modi aliquam doloremque. Nobis molestias laboriosam architecto qui dicta doloremque nam. Quasi voluptas repellat quia non.', 'low', 'done', '2026-08-19', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(28, 2, 'Iusto ut quas error voluptatibus et.', 'Nobis enim et vel dolorem architecto aliquid. Quae omnis voluptatibus adipisci molestiae. In iusto blanditiis necessitatibus nisi quibusdam et. Occaecati qui et quia aut unde.', 'low', 'done', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(29, 2, 'Et velit et quo.', 'Nihil modi facilis quibusdam beatae molestiae omnis cum. Ut a odit nisi id suscipit quia illo.', 'low', 'in_progress', '2026-08-17', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(30, 2, 'Aperiam dolorum placeat eius amet.', 'Voluptate quis ea adipisci consequuntur sed neque. Incidunt repellendus quasi necessitatibus ducimus quidem similique cumque. Qui et sit harum modi non sed mollitia. Inventore enim quia dolor atque officiis.', 'medium', 'todo', '2026-07-14', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(31, 2, 'Recusandae ullam quis vitae consequatur harum.', 'At dolor est nihil aspernatur quo doloremque asperiores. Est autem quia sit sit. Quod autem sit nemo quo sequi. Illum architecto reprehenderit voluptatem.', 'medium', 'in_progress', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(32, 3, 'Aperiam fugiat molestiae error quae sequi.', 'Qui ut dolorem in ad. Quae omnis similique tempore quia. Eos repellendus nemo deleniti dolore corrupti.', 'low', 'done', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(33, 3, 'Saepe distinctio eligendi non.', 'Atque aut deserunt repellat maiores saepe dolorum. In qui sint aut omnis incidunt ut. Ut aut ab similique cum voluptatem et omnis. Natus illum ullam aut perspiciatis fugiat.', 'medium', 'done', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(34, 3, 'Velit rerum in ipsum quas.', 'Fuga consequuntur reprehenderit alias voluptas. Rerum eum voluptates et cumque repellat. Sit quas optio dolorem repudiandae. Ut deleniti aut placeat corporis.', 'low', 'done', '2026-07-19', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(35, 3, 'Quisquam voluptatem facere libero.', 'Cum excepturi voluptate corrupti aliquam in dolor. Molestiae odit quos recusandae iste quae. Quos nisi maiores sunt et.', 'high', 'done', '2026-07-26', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(36, 3, 'Iure dolore sed.', 'Molestiae nobis voluptatibus molestiae iure et veniam. Ea et similique itaque totam occaecati. Aut consequatur et aperiam.', 'low', 'done', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(37, 3, 'Sunt non rerum.', 'Modi odio assumenda qui reiciendis fugiat. Nemo et amet voluptatem eveniet dolor. Dolore enim qui tempora laudantium. Natus asperiores harum et vel vel et perferendis vero. Eligendi nesciunt veritatis expedita.', 'low', 'todo', '2026-07-09', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(38, 3, 'Quis odio aspernatur voluptas.', 'Quod aut placeat doloribus sed dicta. Quibusdam voluptas earum veniam ipsam et cupiditate. Molestiae eveniet at vero placeat sit. Distinctio voluptas aut repudiandae occaecati explicabo est.', 'medium', 'done', '2026-08-08', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(39, 3, 'Adipisci aut ipsum.', 'Praesentium nobis et delectus accusamus nostrum tempora amet. Et ut unde et. Non consequatur consequatur ut est molestias ut alias. Accusantium eligendi animi quis officia et eaque.', 'low', 'done', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(40, 3, 'Odit voluptatem accusantium voluptas ut.', 'Non asperiores veritatis sapiente voluptates ut quia ut. Est optio qui eveniet vitae ex doloremque ut. Quas corporis saepe velit ab inventore rerum.', 'high', 'todo', '2026-08-08', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(41, 3, 'Illo deserunt non.', 'Sapiente incidunt deserunt sed quos suscipit minus. Qui et voluptatem laborum accusantium explicabo. Molestiae voluptatibus sunt consequatur repellendus rerum ab. Quia unde earum beatae saepe nam ipsam.', 'low', 'todo', '2026-07-02', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(42, 3, 'Veritatis ea et.', 'Iusto et doloremque cupiditate ut esse quis. Natus sed beatae voluptate aut. Qui dolores aut non quia.', 'medium', 'todo', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(43, 4, 'Ut sunt sed maxime.', 'Dolores sed voluptatem minus. Rerum voluptatum totam et voluptates veritatis. Sit nisi quis sit dolor rerum ut.', 'medium', 'done', '2026-07-09', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(44, 4, 'Molestiae autem perferendis ullam ipsa ipsa.', 'Et explicabo est debitis consequatur est aut. Et consequatur et sit nihil. Consequatur officia itaque libero facilis sapiente perferendis et temporibus. Sit ad qui nihil sed et.', 'low', 'done', '2026-08-05', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(45, 4, 'Molestiae incidunt consectetur necessitatibus iusto non.', 'Occaecati quisquam dolore illum accusamus. Sit et similique ut ullam nobis velit et. Sed similique earum excepturi earum rerum ipsa recusandae. Natus nihil et voluptatum eveniet illum fugiat.', 'medium', 'done', '2026-07-13', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(46, 4, 'Vel et vel quos.', 'Quisquam asperiores qui et quos suscipit dolorem consequatur veritatis. Qui labore eos molestiae et dolore nesciunt ad. Neque velit dolores sit voluptatibus. Qui dolores et consequuntur praesentium dolore hic esse. Eius sint vel nobis maiores.', 'low', 'in_progress', '2026-07-23', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(47, 4, 'Itaque adipisci eum cupiditate veniam.', 'Minima ratione sunt autem omnis nihil quo magni. Laboriosam molestiae aspernatur maiores beatae minima animi iusto. Omnis reprehenderit alias deleniti odio adipisci explicabo. Fugiat beatae saepe illo saepe dolor vel.', 'high', 'done', '2026-07-02', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(48, 4, 'Iste quasi eligendi explicabo cumque.', 'Hic rem velit et similique fugiat voluptate a. Voluptas exercitationem cum libero et dolor voluptatum.', 'medium', 'in_progress', '2026-08-28', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(49, 4, 'Quisquam delectus nulla est porro.', 'Dolorem aut recusandae dicta aut. Ex doloremque id dolores aut corporis sapiente animi illum. Et eum at occaecati illo harum sed ut laborum. Itaque numquam dicta cumque ab quasi molestiae iste aliquam. Nam odit voluptatem error aut.', 'high', 'in_progress', '2026-07-07', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(50, 4, 'Quod excepturi in et tempora reiciendis.', 'Mollitia dolor dolorem iste maiores repellat aut. Temporibus excepturi porro omnis est ea est adipisci. Maxime excepturi quae assumenda rem quae omnis repellat accusantium.', 'low', 'done', '2026-07-20', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(51, 4, 'Enim est similique corporis quos minima.', 'Quis distinctio nulla deserunt veritatis a et. Odio vel reiciendis quaerat aut ullam nesciunt. Et est ratione id sit. A asperiores voluptas autem.', 'high', 'todo', '2026-07-27', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(52, 4, 'Pariatur eligendi repudiandae ut.', 'Et qui aut cumque ut asperiores necessitatibus tempore. Qui dolor nemo est aut corrupti aut. Et odio est soluta et suscipit quaerat laborum ut. Atque ipsa consectetur consequatur omnis velit voluptatem. Quam voluptates et odit rerum.', 'low', 'in_progress', '2026-07-30', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(53, 4, 'Eos minus ut deleniti.', 'Aut aut esse sed voluptatem. Aspernatur voluptatibus at qui dolores recusandae quo. Est quasi et suscipit. Veritatis hic tempore doloribus ad.', 'low', 'todo', '2026-07-21', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(54, 4, 'Officiis dolor ut.', 'Consequatur officiis dicta inventore qui. Et sint asperiores et iste officiis laudantium. Non velit molestiae odio quo sed odio.', 'high', 'done', '2026-08-25', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(55, 4, 'Rerum eveniet suscipit.', 'Laudantium eos possimus qui fugiat expedita dolores inventore. Quibusdam qui quas enim ea aspernatur. Maxime odit ipsam deleniti dolore nisi.', 'high', 'done', '2026-07-03', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(56, 4, 'Totam aspernatur consectetur incidunt ducimus.', 'Labore autem temporibus perferendis laudantium numquam voluptas. Dolorem suscipit omnis assumenda voluptas saepe. Consectetur rem esse minima est non voluptas aut. Dolorem expedita quibusdam inventore natus.', 'low', 'done', '2026-08-09', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(57, 4, 'Perferendis eum quisquam deleniti.', 'Quasi est rerum pariatur vitae ullam et. Odio molestias vero id eos. Autem doloremque provident eum sequi. Reprehenderit rerum est culpa exercitationem quia. Fuga in est optio consectetur et et.', 'low', 'todo', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(58, 4, 'Dolor eos eveniet et impedit.', 'Qui veritatis culpa quisquam eligendi. Quaerat accusamus commodi eos qui odit. Commodi quis qui repudiandae nostrum et qui occaecati.', 'high', 'in_progress', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(59, 5, 'Voluptatem odio rerum.', 'Quo nemo vel accusamus ut eum vero. Voluptatem delectus ex culpa quia. Facilis ipsum id molestiae est illo et. Ut mollitia magnam beatae est.', 'high', 'done', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(60, 5, 'In cum non ea libero esse.', 'Non impedit et vel ullam saepe. Sunt unde non nihil non porro. Quia id laboriosam a inventore nam. Accusantium ut praesentium incidunt nisi dolorem nobis in. Commodi nihil non pariatur tempora voluptas quia sed.', 'medium', 'in_progress', '2026-07-21', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(61, 5, 'Et et alias optio.', 'Recusandae rem sequi aut nihil earum. Excepturi est et sequi consequatur corrupti. Dicta sit quia quia hic impedit sed eos. Sunt non quas pariatur qui quas aut ex. Voluptas quo officia explicabo et in numquam aut.', 'medium', 'done', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(62, 5, 'Et debitis expedita.', 'Quod qui iste aut enim rerum saepe. Cupiditate non inventore praesentium ut amet iusto. Pariatur voluptatum eum itaque. Eligendi et quisquam ullam ut qui.', 'medium', 'in_progress', NULL, NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(63, 5, 'Et saepe at debitis.', 'Quae est consequuntur recusandae officia amet adipisci veniam. Voluptatibus voluptates quia et nobis consequuntur saepe voluptas. Error voluptatem quos iste voluptatibus illo rerum. Velit modi aut minus est sit aperiam ut. Provident aliquam illum aspernatur molestias.', 'low', 'in_progress', '2026-08-31', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(64, 5, 'Sit veniam veritatis ipsa nemo.', 'Voluptas id rerum possimus nobis rerum voluptatum. Eum cum laboriosam a repellat iste. Vel odio deserunt repellendus voluptatem esse ut.', 'high', 'done', '2026-07-29', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(65, 5, 'Blanditiis dolorem animi nulla delectus.', 'Temporibus cum ipsa asperiores vero beatae et inventore. Qui voluptatibus facere et adipisci aperiam excepturi reprehenderit. Voluptatem vel aut omnis deserunt nemo eius ut.', 'medium', 'done', '2026-07-28', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(66, 5, 'Sapiente velit error.', 'Sed est quidem dolorem et. Veritatis adipisci porro voluptatem. Totam incidunt quia consectetur temporibus eveniet magnam. Laudantium deleniti deserunt repudiandae rerum quia sequi sunt.', 'medium', 'todo', '2026-07-31', NULL, '2026-08-01 17:07:24', '2026-08-01 17:07:24', NULL),
(67, 5, 'Qui debitis debitis officiis.', 'Corporis magni quas et distinctio sunt ex earum. Quia omnis iusto eum reprehenderit et libero expedita rem. Praesentium voluptas laboriosam eveniet quia veritatis quia. Mollitia omnis voluptatem aut eos.', 'high', 'in_progress', '2026-07-25', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(68, 5, 'Quisquam nostrum rem quidem aut.', 'Consequatur provident corrupti voluptatum sed iure illum. Dignissimos quasi cumque aut. A laudantium occaecati dolorum aliquam vero debitis omnis. Omnis autem recusandae quod magnam dolorem quis.', 'high', 'in_progress', '2026-07-08', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(69, 5, 'Commodi blanditiis minus.', 'Nihil nobis aut dolor incidunt ut sequi et. Doloribus qui fuga ipsa.', 'high', 'done', '2026-08-13', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(70, 5, 'Aut ipsa non.', 'Impedit consectetur placeat consequatur sed quam non et. Repellendus qui molestiae in amet ut cupiditate. Repellendus fugit voluptate consequatur dolor nulla quo optio. Consequatur natus repellendus aliquid molestiae dolorem.', 'low', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(71, 5, 'Ut corporis praesentium.', 'Quis et et qui commodi. Est nemo cumque delectus dicta. Veniam praesentium error enim occaecati pariatur eum. Id id incidunt doloremque est voluptas aut.', 'medium', 'done', '2026-07-24', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(72, 5, 'Ipsum quisquam accusamus omnis eligendi.', 'Adipisci distinctio sunt et omnis impedit. Mollitia qui dolorum non et tenetur rem. Numquam et alias perspiciatis voluptatem.', 'high', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(73, 5, 'Eligendi ut laboriosam repudiandae dolore.', 'Ut consequatur quaerat provident nisi deleniti error. Qui consectetur nihil est neque veniam natus neque. Velit non laboriosam magnam pariatur in delectus.', 'medium', 'in_progress', '2026-07-04', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(74, 5, 'Magnam nisi nam cupiditate sit et.', 'Aspernatur nesciunt voluptas et atque. Porro enim sit animi amet sint veniam. Sint ipsam pariatur dolores nemo. Suscipit velit animi doloremque aperiam fugiat.', 'medium', 'in_progress', '2026-08-03', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(75, 5, 'Magnam in maiores ipsa.', 'Sequi nemo quia nobis ad. Similique aut at voluptatibus possimus. Rerum aut quae magnam tempora. A laboriosam ut eum quidem.', 'low', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(76, 6, 'Quisquam in aut.', 'Tempore rerum omnis et minus ad at et. Culpa officiis optio at dolor aperiam. Ad qui est accusamus culpa distinctio.', 'low', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(77, 6, 'Esse corrupti sed at.', 'Culpa rerum magni debitis omnis occaecati quibusdam minima. Facilis nulla sit eius corporis. Quaerat quia sapiente quae excepturi. Soluta vel nihil quae quia.', 'high', 'done', '2026-08-28', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(78, 6, 'Ut nesciunt ullam qui cumque.', 'Atque veritatis cupiditate quos quisquam explicabo non. Eos libero quis quia non. Similique omnis voluptatibus voluptates reiciendis magni totam dolores laborum.', 'low', 'todo', '2026-07-12', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(79, 6, 'Est sunt laudantium.', 'Magni sapiente eos eveniet aperiam sed. Quas ea qui nemo voluptatem omnis debitis necessitatibus.', 'high', 'todo', '2026-07-18', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(80, 6, 'Natus tenetur odio qui.', 'Sed veritatis sequi optio doloremque minima aperiam repudiandae ipsam. Dolor nisi alias ea ut et cumque. Ullam atque fugit quas enim quae atque rerum sed. Porro voluptas amet nulla labore et minus sit.', 'high', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(81, 6, 'Eligendi asperiores sint ut.', 'Consequatur hic facilis et doloribus. Hic architecto eaque qui eligendi. Explicabo accusamus dolores ducimus id a laborum eligendi. Voluptate non id aperiam eius doloribus aut tempora.', 'low', 'todo', '2026-08-29', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(82, 6, 'Officiis accusantium et quos.', 'Qui cumque in est adipisci consequatur ut placeat. Rerum quia tempore fuga quibusdam voluptas. Magnam quae voluptates dolores dolores. Tempore animi recusandae temporibus accusantium neque veritatis officiis sapiente.', 'medium', 'todo', '2026-07-07', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(83, 6, 'Qui labore quam adipisci.', 'Magnam nisi doloribus eaque est ad eum rerum. Vero in odit nostrum qui. Libero iure officia veniam non et.', 'medium', 'done', '2026-07-12', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(84, 6, 'Fuga illum voluptatibus optio.', 'Et dicta aliquid placeat maxime et ipsa tempore. Occaecati repellat libero aut et animi asperiores. Esse assumenda ex aut quaerat a.', 'low', 'in_progress', '2026-07-18', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(85, 6, 'Vel necessitatibus velit suscipit tenetur.', 'Eius earum maiores perspiciatis vitae. Rerum fugit quo alias ut commodi et.', 'medium', 'in_progress', '2026-07-06', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(86, 6, 'Sit quos expedita voluptatem minus.', 'Illo tenetur quod vel doloremque ratione labore est. Earum quibusdam qui natus vel saepe. Distinctio aliquid officia architecto nisi ipsam ipsam et. Eaque non blanditiis neque praesentium non aut omnis atque.', 'medium', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(87, 6, 'Officia eos incidunt.', 'Veritatis rerum quia dignissimos. Error temporibus quia illum ut. Mollitia natus quia qui.', 'high', 'done', '2026-08-05', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(88, 6, 'Qui ex voluptate dolor aut id.', 'Unde dolorem numquam rerum facilis. Sint voluptas repellat rerum assumenda ipsum. Aut eaque quis est natus modi sunt ad.', 'low', 'in_progress', '2026-07-11', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(89, 6, 'Omnis voluptate voluptate quo non commodi.', 'Omnis omnis atque aut molestiae architecto quae. Dignissimos dolores vitae aliquid quia dolorem eos. Possimus velit error deleniti commodi corrupti et ea.', 'high', 'in_progress', '2026-08-09', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(90, 7, 'Est debitis sed quisquam.', 'Sed eius provident officiis. Aut nihil et debitis. Inventore temporibus nostrum mollitia amet esse quos quae. Fugit eius et ut animi eligendi aut vero.', 'low', 'in_progress', '2026-08-06', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(91, 7, 'A hic inventore sint.', 'Mollitia nam placeat quis est architecto nihil repellat. Illo et aut corporis libero sint quia.', 'medium', 'in_progress', '2026-08-18', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(92, 7, 'Eveniet quod eaque minus.', 'Modi est perferendis sit. Molestias ea ut eligendi et. Quae est est nostrum itaque enim quis fugiat. Voluptate nisi distinctio et iusto consequatur. Sint molestiae voluptatum rerum officia sit libero.', 'low', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(93, 7, 'Qui occaecati minima quisquam ut doloribus.', 'Non eos quibusdam incidunt. Aperiam neque aliquam non doloremque explicabo consequuntur. Qui suscipit consectetur et magnam delectus.', 'low', 'todo', '2026-08-10', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(94, 7, 'Omnis aliquam in ipsa voluptatem eos.', 'Aut explicabo est distinctio similique. Maxime a ut labore ipsam aut ad. Nemo ut adipisci tempora ut. Id minus suscipit neque dolor sint laboriosam.', 'medium', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(95, 7, 'Magni possimus minima.', 'Sit repellat porro non maxime vel. Quis explicabo maxime est. Voluptates quam porro quia harum quia necessitatibus esse.', 'high', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(96, 7, 'Eos laborum quia.', 'Facilis natus et porro veritatis voluptates sunt quis. Voluptatum eius molestiae earum est.', 'low', 'todo', '2026-07-13', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(97, 7, 'Fugiat laudantium voluptates ipsam dolorum sed.', 'Sunt ut dolores accusamus possimus similique itaque alias. Rerum ad id aliquid sequi et. Voluptas minima ab voluptatum non laborum ad. Quo mollitia odio voluptas dolorem. Iste omnis qui ut provident quibusdam.', 'high', 'todo', '2026-07-06', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(98, 7, 'Doloremque dolores minus in pariatur.', 'Voluptatem asperiores doloribus velit itaque incidunt tempore. Laboriosam ut et ea cupiditate. Vero rem dolores ut rem id. Id sit officiis error quidem. Ut tenetur expedita consequatur maiores necessitatibus.', 'medium', 'done', '2026-07-22', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(99, 7, 'Totam itaque vero et voluptas non.', 'Dignissimos omnis illum dolor et deserunt iure. Quia ipsa aut explicabo sint sed aut impedit. Adipisci unde sed qui repellat rerum itaque.', 'low', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(100, 7, 'Aperiam sunt id optio.', 'Deserunt similique eum vel dolorem. Eligendi et iusto culpa fugit mollitia veniam. Quidem necessitatibus officia explicabo excepturi.', 'high', 'in_progress', '2026-07-12', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(101, 7, 'Cupiditate dolores explicabo nihil.', 'Similique suscipit voluptatum ducimus animi neque quaerat. Alias placeat sit consequatur quibusdam dolor unde. Nemo et rerum pariatur quo. Consequatur aspernatur nihil porro dolorem recusandae.', 'low', 'done', '2026-07-11', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(102, 7, 'Dolorum voluptatibus dolores.', 'Cupiditate dolorem fuga similique ipsam fugiat aut. Eos quam doloribus quas quo mollitia. Ratione vitae omnis libero magnam et doloribus aperiam. Quod aspernatur architecto et voluptates qui.', 'medium', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(103, 7, 'Exercitationem aspernatur maxime sit voluptate nemo.', 'Ut occaecati dolore quidem dignissimos officia asperiores et. Possimus dolores molestiae rerum ut est voluptates. Eum corrupti provident quo est debitis quia ut. Tempora omnis alias eaque nemo deleniti.', 'medium', 'done', '2026-07-23', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(104, 7, 'Ab rerum eos officiis.', 'Laudantium laudantium et magnam vero minima. Voluptatem culpa illum a qui deserunt. At nemo voluptatem quia itaque. Minima harum rerum odio quidem.', 'medium', 'todo', '2026-07-14', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(105, 7, 'Illo reiciendis itaque quia voluptates maiores.', 'Molestias et deleniti enim a perspiciatis. Quia consequatur atque autem tempora est. Nam rem omnis aliquid. Aut voluptas cupiditate doloremque.', 'low', 'in_progress', '2026-08-28', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(106, 8, 'Maiores vel error.', 'Deserunt facilis quia maiores ab. Possimus ipsum ipsum modi quia in maxime. Deserunt omnis quidem et velit aut deserunt quis. Assumenda qui aperiam omnis alias magnam blanditiis cumque impedit.', 'medium', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(107, 8, 'Consequuntur labore ut ad eaque occaecati.', 'Quaerat repellat aut ut sed dolores optio voluptatem repellat. Quos qui quisquam qui magni fuga. Sit molestias consequuntur alias reiciendis et inventore quo.', 'low', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(108, 8, 'Officiis possimus est aut ipsa.', 'Officia ipsum occaecati ea qui. Quam doloribus sint ea possimus aut eaque. Consequatur eum et commodi error nihil explicabo quo quo.', 'low', 'done', '2026-07-22', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(109, 8, 'Eum consequatur nobis provident quibusdam est.', 'Est et eum ut quia quis. Nobis dolore possimus et repudiandae aut veniam sed. Enim id aut aut dolorum non. Quia non modi odit natus error.', 'low', 'todo', '2026-08-06', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(110, 8, 'Odio quasi dolorum modi amet aliquam.', 'Inventore quibusdam repudiandae dicta unde repellat. Iste alias ab eius. Est similique vel quod totam ea doloremque cum voluptatem. Nulla et reprehenderit eaque occaecati delectus enim veniam.', 'medium', 'done', '2026-07-12', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(111, 8, 'Dolor fugiat delectus.', 'Iste quia rerum vel nemo qui inventore. Incidunt commodi ratione aut pariatur pariatur. Nostrum velit qui nostrum. Incidunt est sed tempore facilis ea.', 'high', 'in_progress', '2026-08-10', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(112, 8, 'Quaerat officiis voluptatem.', 'Quia temporibus et consectetur ipsum impedit. Modi dolores optio voluptatem vel expedita iste at. Asperiores corrupti enim fugit illum. Consequuntur dignissimos ipsum distinctio et voluptatem velit consequatur. Omnis culpa distinctio consectetur deserunt.', 'medium', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(113, 8, 'Quae atque labore.', 'Reiciendis ad dignissimos unde quo. Quos officia enim officiis consequatur eaque. Eos culpa sed aliquid et modi facere. Et aut atque facere voluptas.', 'low', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(114, 8, 'Deleniti vitae quia delectus.', 'Incidunt quibusdam quidem fugiat id ullam suscipit. Mollitia id nihil fuga. Amet id esse adipisci suscipit sunt libero. Et ratione temporibus molestias quam porro.', 'high', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(115, 8, 'Reprehenderit nisi aut dolores.', 'Aut minus quidem aut in corporis. Nulla rerum libero accusamus et. Neque voluptatum ut tempore a. Corrupti rem illo explicabo fuga illum.', 'medium', 'in_progress', '2026-07-31', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(116, 8, 'Eos consequatur deserunt tenetur atque.', 'Commodi ad accusamus vel distinctio. Beatae aliquid sed hic ut quidem soluta.', 'low', 'in_progress', '2026-07-21', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(117, 8, 'Accusamus impedit numquam.', 'Distinctio in est nihil facere velit. Velit consequatur sapiente nemo id ut iure.', 'high', 'done', '2026-07-26', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(118, 8, 'Sit aut dolor nobis.', 'Repellendus iste aut quis autem. Aut eius eaque est nobis facilis. Autem velit nam deserunt ea. Dolorem id ullam iste officia impedit et beatae excepturi. Distinctio sed non nostrum et quasi itaque.', 'medium', 'done', '2026-08-25', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(119, 8, 'Assumenda iusto quos in.', 'Sint reprehenderit facere quae sit culpa molestiae vitae. Quia illo mollitia dicta minus. Sit tempore autem rerum voluptatum consequuntur.', 'low', 'done', '2026-07-25', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(120, 8, 'Aut cumque excepturi eligendi sed.', 'Quis officiis repellat maxime commodi quo. Sed ducimus fuga sequi. Est omnis ipsam voluptate nesciunt.', 'low', 'done', '2026-08-08', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(121, 8, 'Vitae fugiat natus aut.', 'Ab porro rerum quibusdam dolores non. Libero vel sapiente totam. Eos aliquid maiores eum voluptas ut sunt. Est corrupti quisquam illo non.', 'low', 'in_progress', '2026-08-09', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(122, 8, 'Adipisci voluptas consequuntur quae temporibus.', 'Laboriosam aperiam esse velit perferendis aut. Voluptas aperiam adipisci et nemo. Placeat nihil magni aut error non sapiente. Nam voluptatibus nemo et possimus voluptas cum.', 'high', 'in_progress', '2026-07-23', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(123, 8, 'Unde quidem commodi veritatis.', 'Quidem voluptas odit molestiae ratione eaque. Dolorem dolores doloremque velit voluptatem veritatis. Aut ex soluta molestias.', 'medium', 'in_progress', '2026-08-20', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(124, 9, 'Fuga a consequatur aut incidunt.', 'Officia adipisci in omnis dolores occaecati quos non sapiente. Neque est est aut nobis explicabo aut et eum. Quos et eligendi alias ipsa quia. Maxime nulla tenetur pariatur quibusdam impedit.', 'high', 'todo', '2026-08-25', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(125, 9, 'Corrupti eveniet deleniti nobis aliquam quisquam.', 'Quasi maxime voluptatibus non excepturi qui dolores ea. Dolores unde tempore suscipit rerum molestiae.', 'low', 'todo', '2026-08-30', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(126, 9, 'Reiciendis velit consequuntur ut ut.', 'Omnis perspiciatis omnis aliquid eius assumenda distinctio. Totam atque qui dolorem et totam incidunt praesentium. Id tempore sit est.', 'low', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(127, 9, 'Est voluptas dolorem vitae ad.', 'Quibusdam recusandae corporis ut dolore vitae. Doloremque ea doloribus et eius similique. Nemo est perspiciatis sunt aperiam adipisci.', 'high', 'done', '2026-07-28', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(128, 9, 'Iure possimus modi molestiae quidem consectetur.', 'Fugiat quas earum similique placeat consequatur error sit ut. Cumque tempora possimus voluptatem consequatur. Quam deleniti numquam hic non sequi quaerat maiores molestias. Debitis at dignissimos aut.', 'high', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(129, 9, 'Aperiam rerum veritatis at ex consequatur.', 'Ut repellat temporibus labore. Qui voluptatum veritatis eos qui. In dolorem qui dolor ut corrupti veniam nostrum.', 'medium', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(130, 9, 'Nisi rerum accusamus ipsum dolorem.', 'Atque illum dolores corrupti perspiciatis debitis. Iusto nisi est repellendus sunt. Accusantium cupiditate qui nostrum laudantium.', 'high', 'done', '2026-08-14', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(131, 9, 'Enim sed veniam alias.', 'Quia enim sunt libero. Magnam hic aut eveniet nam quia voluptas. Vel suscipit sunt necessitatibus provident est commodi.', 'medium', 'done', '2026-08-12', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(132, 9, 'Aut aut officiis.', 'Voluptas in voluptates iusto aut dolor eligendi. Totam omnis modi cum ut. Exercitationem commodi perferendis voluptas.', 'high', 'in_progress', '2026-08-02', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(133, 9, 'Illum modi id aliquam.', 'Laboriosam officiis excepturi reiciendis totam ut. Praesentium dignissimos aut libero in blanditiis qui. Voluptas et quo iste qui.', 'medium', 'todo', '2026-07-12', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(134, 9, 'Modi quo quae cum quis.', 'Quod aut laborum rem modi exercitationem quo itaque. Molestiae necessitatibus reprehenderit atque corporis ut et accusamus. Ex possimus quia et mollitia.', 'medium', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(135, 9, 'Asperiores quo recusandae magnam ipsa.', 'Aut asperiores nihil asperiores modi libero vero. Nihil unde est atque eveniet. Consequatur voluptas vitae molestiae labore. Qui autem nihil fugit dolorem sit amet sint.', 'medium', 'done', '2026-07-11', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(136, 9, 'Dolor qui qui sunt voluptatem.', 'Omnis quia facilis fugit unde exercitationem maxime et. Vero rerum voluptatibus similique sequi animi qui quia nemo. Consequuntur amet vero earum facere et alias. Minus excepturi cupiditate qui praesentium maiores.', 'low', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(137, 9, 'Illum ut porro eos delectus harum.', 'Illum quae rerum sit laborum vel nostrum eveniet. Voluptatibus a rerum molestiae mollitia nostrum deserunt deserunt. Qui omnis laborum id ipsa veritatis pariatur. Aliquam aut nobis eaque et expedita.', 'low', 'todo', '2026-08-29', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(138, 9, 'Alias eos molestias fugit autem est.', 'Qui doloribus aliquid dolore voluptatem eaque qui. Quia eos asperiores vitae labore accusamus. At vitae harum velit eos fugiat. Asperiores quod enim alias unde ex laboriosam libero.', 'low', 'in_progress', '2026-07-04', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(139, 9, 'Ut rerum et in at est.', 'Dolores culpa nihil laboriosam et. Quia voluptatem similique reprehenderit totam. Libero nihil et incidunt magnam modi similique.', 'low', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(140, 10, 'Aut placeat nemo sint.', 'Harum ab est atque repudiandae commodi. Aperiam nihil ratione corporis. Nostrum dolores consectetur exercitationem.', 'low', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(141, 10, 'Consequatur unde itaque maxime.', 'Exercitationem non enim voluptas aliquam. Sapiente quibusdam pariatur qui cumque. Consequatur omnis architecto itaque temporibus. Eos ex neque voluptas impedit atque veniam. Fuga quia vitae qui.', 'medium', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(142, 10, 'Ab quibusdam architecto.', 'Maxime tenetur vitae molestiae est. Voluptas deleniti non eaque voluptate. Qui est vero quaerat facere consectetur. Voluptas dolor expedita expedita et est est quae.', 'low', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(143, 10, 'Aut et minima quasi beatae ea.', 'Molestiae recusandae sapiente ea nihil molestiae aperiam. Laborum quidem quae dolor blanditiis voluptas ipsa voluptas suscipit. Eius architecto alias omnis rem.', 'high', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(144, 10, 'Ea magni esse velit.', 'Dolores sit molestiae dolorem. Est aut sit sapiente et tempore. Ab consequuntur est enim non.', 'low', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(145, 10, 'Dolor laborum suscipit architecto.', 'Vitae quaerat deleniti esse occaecati omnis. Id distinctio et quis facere mollitia est. Odio enim provident qui quidem nam ut et. Tempora non alias tempore eos voluptas magni. Temporibus dolores molestiae quod excepturi soluta et autem.', 'low', 'todo', '2026-08-07', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(146, 10, 'Odit consequatur soluta accusamus qui.', 'Iure perspiciatis earum ut ipsum quia repellat. Aliquid architecto qui molestiae eius. Dolore illum officiis repudiandae quae.', 'medium', 'todo', '2026-08-10', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(147, 10, 'Odio illum aut non praesentium.', 'Provident optio velit corrupti. Deleniti inventore beatae dolores et aliquid optio. Repellendus laboriosam vel dicta blanditiis ullam alias impedit. Deleniti voluptatibus quis vero rerum.', 'high', 'todo', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(148, 10, 'Recusandae necessitatibus blanditiis.', 'Quia voluptas est ut quia. Nobis quia in nemo iure temporibus rerum. Illo non numquam temporibus omnis. Provident et illum asperiores sed nesciunt.', 'high', 'in_progress', '2026-08-28', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(149, 10, 'Commodi eos optio.', 'Omnis est et omnis voluptate. Fugit voluptatem est recusandae necessitatibus. Perspiciatis voluptates accusamus fugiat ut. Natus ut quia repudiandae et architecto animi.', 'medium', 'in_progress', '2026-07-24', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(150, 10, 'Vero et eaque.', 'Occaecati nemo saepe distinctio cumque maiores. Necessitatibus aut quia vel perferendis quia omnis. Similique quas dolorum eligendi voluptatem sapiente id aspernatur animi.', 'medium', 'todo', '2026-07-07', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(151, 10, 'Ut harum ut.', 'Laborum quam ducimus quidem. Ea asperiores magni et architecto iste numquam.', 'high', 'done', '2026-07-24', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(152, 10, 'Aut asperiores accusantium aliquid.', 'Enim ipsam tenetur quae non aut ut perferendis est. Accusamus voluptatum et nam adipisci voluptatem ab. Est tenetur iure voluptatem voluptates incidunt est debitis. Placeat doloribus et optio in sed officiis eveniet. Voluptate adipisci vel consequuntur ipsam.', 'medium', 'done', '2026-07-02', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(153, 10, 'Laborum nihil ullam ad laudantium.', 'Totam eaque minus laudantium dolores. Maxime debitis deleniti voluptas mollitia tenetur doloremque. Aut vitae consequatur tempora eos expedita delectus. Ullam dignissimos ab ut earum omnis.', 'high', 'in_progress', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(154, 10, 'Voluptas sequi aut quibusdam aspernatur corrupti.', 'Voluptatibus dolore voluptates quisquam aspernatur neque repudiandae ad autem. Magni similique consequatur molestiae.', 'high', 'todo', '2026-07-29', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(155, 11, 'Enim neque modi necessitatibus eaque.', 'Quos sapiente voluptas qui sint. Est necessitatibus laudantium pariatur enim quis omnis sapiente. Non sed voluptas quia aperiam laborum. Beatae et et dolor suscipit ducimus ullam nostrum.', 'high', 'todo', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(156, 11, 'Totam dolorem architecto laboriosam.', 'Ut et ab qui dolores. Doloribus distinctio ratione corporis et hic nulla. Odio est corrupti sed. Autem possimus distinctio rerum tempora impedit quia.', 'medium', 'in_progress', '2026-08-23', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(157, 11, 'Nobis aliquid id omnis.', 'Voluptatem quia libero molestiae dolor et aperiam voluptates fuga. Architecto et voluptatibus quia cupiditate veritatis. Dolores quia et est voluptatem adipisci atque praesentium quia. Consequatur expedita excepturi autem sunt suscipit qui neque. Voluptate non voluptate assumenda voluptatem labore esse laboriosam nihil.', 'medium', 'todo', '2026-08-12', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(158, 11, 'Voluptates est assumenda.', 'Ipsam ad libero dolor exercitationem qui doloremque quia. Illo ut quidem blanditiis porro quas atque et. Eos accusamus officiis eaque veritatis ut inventore autem.', 'low', 'todo', '2026-08-29', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(159, 11, 'Omnis voluptas quam vel voluptas modi.', 'Cum culpa qui consequuntur adipisci aliquid quis. Ea mollitia aliquam necessitatibus a quas. Culpa tempora fuga commodi sit praesentium.', 'low', 'todo', '2026-08-23', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(160, 11, 'Aut illo magni dolor qui.', 'Ratione consequatur aspernatur ex nostrum. Qui qui cupiditate libero ut. Numquam perspiciatis ipsa voluptatem ut.', 'high', 'todo', '2026-08-23', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(161, 11, 'Soluta voluptas quia placeat.', 'Et repellendus minima error. Nihil voluptas ut itaque vel accusamus eaque. Dolorum illum sunt vitae ut.', 'high', 'done', '2026-07-18', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(162, 11, 'Quos ipsam recusandae ea facilis.', 'Commodi explicabo voluptatem provident accusamus est laboriosam nam. Aliquam eos ab sit sint repellat sit. Labore porro neque et voluptatum recusandae aut quod. Recusandae fugiat modi molestias voluptates corrupti est dolore.', 'medium', 'done', '2026-07-27', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(163, 11, 'Saepe nihil ut nostrum.', 'Expedita minus debitis debitis. Illo deleniti reiciendis autem et. Accusantium tempore repellendus doloremque hic odit. Magnam illo velit magnam similique exercitationem possimus sint qui.', 'low', 'todo', '2026-07-09', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(164, 11, 'Iure ipsam eum accusantium error.', 'Laborum placeat animi ut alias accusantium quia nihil. Aut vero dicta asperiores accusantium.', 'low', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(165, 11, 'Et consequuntur et sed adipisci.', 'Adipisci ut vel id qui consectetur. Qui iusto in maxime est corrupti et officiis voluptatem. Et eum suscipit tenetur. Qui voluptatem consequatur natus quam totam vitae.', 'low', 'done', '2026-07-29', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(166, 11, 'Error praesentium optio doloribus et nobis.', 'Recusandae dolore reprehenderit totam sed illum laborum. Excepturi et et porro tempore non ipsa. Est laboriosam reiciendis occaecati minima qui. Quis consequatur porro ipsam eius.', 'low', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(167, 11, 'Deserunt quod recusandae.', 'Neque quisquam qui corrupti eos. Tempora eum repellat ut consequatur nostrum. Quisquam iste sed hic ut in aut omnis eos. Consectetur ipsam sunt commodi quisquam itaque nemo libero.', 'medium', 'done', '2026-08-14', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(168, 11, 'Quaerat est praesentium dolores repellendus cum.', 'Aliquam sunt eveniet in voluptatum neque et vero minima. Enim numquam veniam dolor itaque. Cumque dolore quia enim asperiores dolorum velit unde sed.', 'medium', 'in_progress', '2026-08-02', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(169, 11, 'Sed sint eligendi facere.', 'Praesentium ipsa rem nam autem odit quasi unde ex. Deleniti veritatis quo et eveniet. Inventore repudiandae exercitationem ea animi esse.', 'medium', 'todo', '2026-07-10', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL);
INSERT INTO `tasks` (`id`, `project_id`, `title`, `description`, `priority`, `status`, `due_date`, `overdue_notified_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(170, 12, 'Quidem sed vel iste.', 'Illo et quis magni eaque eum. Expedita rerum omnis velit accusantium. Consequatur voluptatibus sed et eius quam itaque praesentium repellendus. Saepe sed qui qui.', 'low', 'in_progress', '2026-08-17', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(171, 12, 'Deserunt soluta error voluptatibus quos.', 'Et nisi consequatur est nostrum ea assumenda et et. Qui voluptatibus in deserunt nam vel repellat. Architecto qui animi fugit quia.', 'medium', 'done', '2026-07-12', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(172, 12, 'Velit perspiciatis ad cupiditate dolores.', 'Vel eum iure quasi facilis veniam. Deleniti voluptatem et maxime maiores aut temporibus. Facere consequatur dolor sequi eum commodi sint. Non et molestiae soluta perferendis sed.', 'medium', 'todo', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(173, 12, 'Quidem et consequuntur.', 'Voluptatem et est veritatis ut rerum ex neque. Modi itaque id animi impedit et soluta. Rerum omnis deleniti consequatur odit.', 'high', 'todo', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(174, 12, 'Blanditiis reprehenderit impedit omnis non alias.', 'Impedit id ipsa vitae sed. In inventore quia rerum. Maiores magnam non dolorum. Animi et sapiente incidunt eos.', 'low', 'todo', '2026-07-11', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(175, 12, 'Necessitatibus eum ex occaecati est.', 'Dolore rerum consequuntur ad doloribus. Qui reiciendis quo nostrum cumque nam voluptas aut. Perspiciatis suscipit qui ea in. Architecto voluptatum laudantium assumenda soluta quasi.', 'medium', 'in_progress', '2026-08-14', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(176, 12, 'Quas a doloremque incidunt.', 'Commodi sunt accusantium facere nisi. Vero totam nemo inventore neque sunt ut. Et fuga ratione eligendi officia et consequatur blanditiis et.', 'low', 'done', '2026-07-12', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(177, 12, 'Ratione blanditiis ea magni labore.', 'Accusamus molestiae aut architecto. Aperiam atque doloribus deleniti voluptatem ut ea. Neque molestiae ea quibusdam consequuntur et. Rerum quia iusto aperiam.', 'medium', 'done', '2026-07-13', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(178, 12, 'Temporibus suscipit corrupti quaerat quisquam.', 'Iure perspiciatis inventore minus vero et magnam. Iure voluptas assumenda voluptatem libero vitae et deserunt. Voluptatem provident sunt placeat voluptatem eius delectus amet. Sed consequatur hic natus qui minima porro.', 'high', 'todo', '2026-07-13', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(179, 12, 'Possimus vero inventore sed quas incidunt.', 'Ut numquam quis sit incidunt necessitatibus est officia. Ex enim mollitia assumenda dolor velit rerum. Dignissimos voluptatem aut tempore soluta sint. Quidem fugit minus nam magni voluptatem.', 'medium', 'todo', '2026-07-03', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(180, 12, 'Suscipit placeat consequatur quia.', 'Fugit sed sed explicabo vero alias quas officia molestiae. Architecto debitis alias nihil id amet in reiciendis. Sapiente vero reiciendis culpa debitis voluptas.', 'high', 'in_progress', '2026-07-02', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(181, 12, 'Quis natus laboriosam consequuntur qui.', 'Eum eaque sit ab repellendus rem in. Nam omnis quam vitae nulla sint aut voluptatem qui. Beatae iusto cupiditate voluptas enim reprehenderit. Numquam magnam eos velit officia neque. Deserunt placeat est fuga minima.', 'medium', 'todo', '2026-07-07', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(182, 12, 'Deleniti explicabo quam nesciunt saepe.', 'Asperiores reprehenderit cumque eos qui inventore. Corporis minima sit maxime tempora qui in et. Excepturi sunt rerum quo enim. Architecto quo debitis optio.', 'medium', 'done', '2026-08-05', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(183, 12, 'Et laboriosam omnis laboriosam.', 'Dolorum et vel praesentium voluptatibus fugit. Voluptatibus quos aliquid voluptatem nihil minus ea. Laborum temporibus laudantium quidem laborum.', 'medium', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(184, 12, 'Dolor est consequatur sit.', 'Possimus rerum ea maxime omnis inventore. Nemo et eos ut accusamus. Aut voluptas officia et non id numquam expedita. Eum sunt aut ut a et.', 'medium', 'done', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(185, 12, 'Autem rerum aliquid officia.', 'Quos eveniet dolor eum voluptatem quis veritatis reprehenderit dolores. Magni aut dolores sint fugit nihil. Repellendus omnis cumque omnis deserunt veniam omnis vero. Aut provident sed optio facere sint nemo eum. Dolorem eveniet assumenda libero dolor autem perspiciatis.', 'low', 'done', '2026-08-09', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(186, 12, 'Dolores consequatur in autem.', 'Exercitationem rerum eos saepe qui. Vitae ducimus neque qui animi nobis. Aperiam vitae aut dignissimos eveniet qui ut aut.', 'medium', 'todo', '2026-08-05', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(187, 12, 'Fugiat tempore debitis assumenda consectetur alias.', 'Rerum vitae optio cupiditate reprehenderit accusamus alias. Velit sequi in rerum numquam maiores exercitationem. Reiciendis distinctio omnis similique esse laboriosam. Accusantium laboriosam harum sed quia omnis.', 'low', 'todo', NULL, NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL),
(188, 12, 'Ut aliquid fugiat voluptatum atque.', 'Incidunt ut natus incidunt minima neque. Eveniet aut officiis molestias enim id id perspiciatis ut. Quibusdam incidunt placeat excepturi.', 'medium', 'in_progress', '2026-07-26', NULL, '2026-08-01 17:07:25', '2026-08-01 17:07:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', '2026-08-01 17:07:22', '$2y$12$hvqkT0qOxtU14cH/1J7Sh.xI42NumVBBza.HTYTuQ3XPqh7zQsXYW', NULL, '2026-08-01 17:07:22', '2026-08-01 17:07:22'),
(2, 'Test User', 'test@example.com', '2026-08-01 17:07:22', '$2y$12$bmLb05CC23H47xBnxiBM/e.2uIzQKtqY.xXAD3XEYyA8Sxen2Fdde', NULL, '2026-08-01 17:07:22', '2026-08-01 17:07:22'),
(3, 'Demo User', 'demo@example.com', '2026-08-01 17:07:23', '$2y$12$Uj4ovwHbLhTHjSCX.1vETODU4J06ZBA3b8MdHRsDRQfP0X6C2sMHO', NULL, '2026-08-01 17:07:23', '2026-08-01 17:07:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_user_id_index` (`user_id`),
  ADD KEY `projects_status_index` (`status`),
  ADD KEY `projects_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_index` (`project_id`),
  ADD KEY `tasks_priority_index` (`priority`),
  ADD KEY `tasks_status_index` (`status`),
  ADD KEY `tasks_due_date_index` (`due_date`),
  ADD KEY `tasks_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
