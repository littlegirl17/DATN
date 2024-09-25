-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 25, 2024 lúc 02:36 PM
-- Phiên bản máy phục vụ: 8.3.0
-- Phiên bản PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `legoloft`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `administrations`
--

CREATE TABLE `administrations` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_group_id` bigint UNSIGNED NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `administrations`
--

INSERT INTO `administrations` (`id`, `admin_group_id`, `fullname`, `username`, `email`, `password`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 10, 'Huynh Kha', 'khakha17', 'khakha5087@gmail.com', '$2y$12$9sUstnGn30lTWyH4sVrkmuaXHilrdi5mRk.lIr/NFic/ei2j7h8we', '1.png', 1, '2024-09-13 23:29:42', '2024-09-15 20:31:50'),
(5, 11, 'test kkk', 'test', 'test@gmail.com', '$2y$12$XCMwaYCQzut9/nQ8sWCYeOvGZB8FFlyrTRh/AOoBMIooOma4ON2eK', '', 1, '2024-09-15 21:25:06', '2024-09-15 21:25:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `administration_groups`
--

CREATE TABLE `administration_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `administration_groups`
--

INSERT INTO `administration_groups` (`id`, `name`, `permission`, `created_at`, `updated_at`) VALUES
(10, 'Quản trị cấp cao', '[\"product\",\"administration\",\"administrationGroup\",\"productAdd\",\"productEdit\",\"productCheckboxDelete\",\"adminstrationAdd\",\"adminstrationEdit\",\"adminstrationCheckboxDelete\",\"adminstrationGroupAdd\",\"adminstrationGroupEdit\",\"adminstrationGroupCheckboxDelete\"]', '2024-09-13 04:55:18', '2024-09-21 22:22:03'),
(11, 'test 2', '[\"administration\",\"adminstrationAdd\",\"adminstrationEdit\",\"adminstrationCheckboxDelete\"]', '2024-09-15 06:54:09', '2024-09-15 22:02:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `slug`, `description`, `sort_order`, `status`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Mô hình trẻ em', NULL, 'mo-hinh-nguoi-lon', NULL, 1, 1, NULL, NULL, NULL),
(2, 'Mô hình người lớn\r\n', NULL, 'mo-hinh-tre-em', NULL, 2, 1, NULL, NULL, NULL),
(5, 'Danh mục trẻ em 1', NULL, 'danh-muc-tre-em-1', NULL, 1, 1, 1, NULL, NULL),
(6, 'Danh mục trẻ em 2', NULL, 'danh-muc-tre-em-2', NULL, 1, 1, 1, NULL, NULL),
(7, 'Danh mục người lớn 1', NULL, 'danh-muc-nguoi-lon-1', NULL, 1, 1, 2, NULL, NULL),
(8, 'Danh mục người lớn 2', NULL, 'danh-muc-nguoi-lon-2', NULL, 2, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(8, '2024_09_13_024534_create_administration_groups_table', 2),
(9, '2024_09_13_025553_create_administrations_table', 3),
(10, '2024_09_16_063018_create_categories_table', 4),
(11, '2024_09_16_064848_create_categories_table', 5),
(12, '2024_09_16_065447_create_products_table', 6),
(13, '2024_09_16_114844_create_product_images_table', 7),
(14, '2024_09_16_115342_create_user_groups_table', 8),
(16, '2024_09_16_115455_create_product_discounts_table', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `view` int NOT NULL,
  `outstanding` tinyint NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `image`, `category_id`, `price`, `view`, `outstanding`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ưd', '1.jpg', 6, 11111111.00, 500, 1, 1, 'dfdaf', '2024-09-24 08:27:14', '2024-09-24 08:27:14'),
(2, 'san pham a', 'san-pham-a', '2.webp', 5, 1111111.00, 500, 1, 1, 'ssssssssss', '2024-09-24 08:34:48', '2024-09-24 09:15:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_discounts`
--

CREATE TABLE `product_discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_group_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `discount_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
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
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('K0FaO0CyX8iVr6pVzcB8CrSLVxMYgiYR0inVkBe5', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', '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', 1727194519),
('s11Vw54E8H1K0YcmLj7D0yRVELOhW559q5zgUs8P', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Avast/128.0.0.0', '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', 1727238293),
('uCYBKbZrlIU0hXNLW8Ln7upxxxrDDIh841isgL0j', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Avast/128.0.0.0', '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', 1727274036);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `verification_code` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `verification_code`) VALUES
(1, 'kha', 'khakha5087@gmail.com', NULL, '$2y$12$iTIh4lveGPukaao1qcMua.hHEPloLVDUxyOspw/4gB7as0mbXp4uu', NULL, NULL, '2024-09-21 04:35:39', 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_groups`
--

CREATE TABLE `user_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `administrations`
--
ALTER TABLE `administrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `administrations_email_unique` (`email`),
  ADD KEY `administrations_admin_group_id_foreign` (`admin_group_id`);

--
-- Chỉ mục cho bảng `administration_groups`
--
ALTER TABLE `administration_groups`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_discounts_product_id_foreign` (`product_id`),
  ADD KEY `product_discounts_user_group_id_foreign` (`user_group_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `administrations`
--
ALTER TABLE `administrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `administration_groups`
--
ALTER TABLE `administration_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `product_discounts`
--
ALTER TABLE `product_discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `administrations`
--
ALTER TABLE `administrations`
  ADD CONSTRAINT `administrations_admin_group_id_foreign` FOREIGN KEY (`admin_group_id`) REFERENCES `administration_groups` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD CONSTRAINT `product_discounts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_discounts_user_group_id_foreign` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
