-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 07, 2024 lúc 03:44 AM
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
(5, 11, 'Phạm Hữu Nghị', 'nghipham', 'nghipham@gmail.com', '$2y$12$J9B.zkEWO75vLZoj5wYhieWtZmSrgWn2C.StK7dP3rSUG/6A885Mq', '', 1, '2024-09-15 21:25:06', '2024-10-04 06:40:56'),
(14, 18, 'Phát Tài', 'Phattai', 'nguyenchauphattai@gmail.com', '$2y$12$vLGQZyO4ouAUZqp/BPHtVeF2h98SerXhOM216.QOb3m5Jdcf12rmS', NULL, 1, '2024-10-06 20:19:27', '2024-10-06 20:19:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `administration_groups`
--

CREATE TABLE `administration_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `administration_groups`
--

INSERT INTO `administration_groups` (`id`, `name`, `permission`, `created_at`, `updated_at`) VALUES
(10, 'Quản trị cấp cao', '[\"product\",\"user\",\"userGroup\",\"administration\",\"administrationGroup\",\"categoryArticle\",\"article\",\"productAdd\",\"productEdit\",\"productCheckboxDelete\",\"userAdd\",\"userEdit\",\"userCheckboxDelete\",\"userGroupAdd\",\"userGroupEdit\",\"userGroupCheckboxDelete\",\"adminstrationAdd\",\"adminstrationEdit\",\"adminstrationCheckboxDelete\",\"adminstrationGroupAdd\",\"adminstrationGroupEdit\",\"adminstrationGroupCheckboxDelete\",\"categoryArticleAdd\",\"categoryArticleEdit\",\"categoryArticleCheckboxDelete\",\"articleAdd\",\"articleEdit\",\"articleCheckboxDelete\"]', '2024-09-13 04:55:18', '2024-10-06 19:52:01'),
(11, 'khách hàng và nhóm khách hàng', '[\"user\",\"userGroup\",\"userAdd\",\"userEdit\",\"userCheckboxDelete\",\"userGroupAdd\",\"userGroupEdit\",\"userGroupCheckboxDelete\"]', '2024-09-15 06:54:09', '2024-10-04 06:39:52'),
(18, 'Quản lý bài viết', '[\"categoryArticle\",\"article\",\"categoryArticleAdd\",\"categoryArticleEdit\",\"categoryArticleCheckboxDelete\",\"articleAdd\",\"articleEdit\",\"articleCheckboxDelete\"]', '2024-10-06 20:12:26', '2024-10-06 20:12:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `categoryArticle_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `description_short` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, 'Mô hình trẻ em', NULL, 'mo-hinh-nguoi-lon', NULL, 1, 0, NULL, NULL, NULL),
(2, 'Mô hình người lớn\r\n', NULL, 'mo-hinh-tre-em', NULL, 2, 0, NULL, NULL, NULL),
(3, 'Mô hình con gái\r\n', NULL, 'mo-hinh-con-gai', NULL, 3, 1, NULL, NULL, NULL),
(4, 'Súng NERF\r\n', NULL, 'mo-hinh-con-gai', NULL, 4, 0, NULL, NULL, NULL),
(5, 'Mô hình đơn giản', NULL, 'danh-muc-tre-em-1', NULL, 1, 0, 1, NULL, NULL),
(6, 'Mô hình DUPLO', NULL, 'danh-muc-tre-em-2', NULL, 1, 0, 1, NULL, NULL),
(7, 'Mô hình cô điển', NULL, 'danh-muc-tre-em-3', NULL, 1, 0, 1, NULL, NULL),
(8, 'Mô hình thiếu niên', NULL, 'danh-muc-tre-em-4', NULL, 1, 0, 1, NULL, NULL),
(9, 'Mô hình kỹ thuật Việt Nam', NULL, 'danh-muc-nguoi-lon-1', NULL, 1, 0, 2, NULL, NULL),
(10, 'Mô hình động cơ điện', NULL, 'danh-muc-nguoi-lon-2', NULL, 1, 0, 2, NULL, NULL),
(11, 'Mô hình chuyên gia tạo hình', NULL, 'danh-muc-nguoi-lon-3', NULL, 1, 0, 2, NULL, NULL),
(12, 'Mô hình phương tiện trong thành phố', NULL, 'danh-muc-nguoi-lon-4', NULL, 1, 0, 2, NULL, NULL),
(13, 'Mô hình kiến trúc', NULL, 'danh-muc-nguoi-lon-5', NULL, 1, 0, 2, NULL, NULL),
(14, 'Mô hình những người bạn', NULL, 'danh-muc-con-gai-1', NULL, 1, 0, 3, NULL, NULL),
(15, 'Mô hình công chúa, lâu đài công chúa', NULL, 'danh-muc-con-gai-2', NULL, 1, 1, 3, NULL, NULL),
(16, 'Mô hình yêu tinh(nữ)', NULL, 'danh-muc-con-gai-3', NULL, 1, 0, 3, NULL, NULL),
(17, 'Mô hình nữ anh hùng', NULL, 'danh-muc-con-gai-4', NULL, 1, 0, 3, NULL, NULL),
(18, 'Súng NERF N-Strike Elite', NULL, 'danh-muc-sung-NERF-1', NULL, 1, 0, 4, NULL, NULL),
(19, 'Súng NERF Zombie Strike', NULL, 'danh-muc-sung-NERF-2', NULL, 1, 0, 4, NULL, NULL),
(20, 'Súng NERF Mega N-Strike', NULL, 'danh-muc-sung-NERF-3', NULL, 1, 0, 4, NULL, NULL),
(21, 'Súng NERF Fortnite', NULL, 'danh-muc-sung-NERF-4', NULL, 1, 0, 4, NULL, NULL),
(22, 'Súng NERF Rival', NULL, 'danh-muc-sung-NERF-5', NULL, 1, 0, 4, NULL, NULL),
(23, 'Súng NERF Doomlands', NULL, 'danh-muc-sung-NERF-6', NULL, 1, 0, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_articles`
--

CREATE TABLE `category_articles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `description_short` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `name_coupon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` int NOT NULL,
  `type` tinyint NOT NULL,
  `total` decimal(15,0) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `discount` decimal(15,0) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`id`, `name_coupon`, `code`, `type`, `total`, `date_start`, `date_end`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'kha', 1234, 0, 500000, NULL, NULL, 5, 1, NULL, NULL);

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
(16, '2024_09_16_115455_create_product_discounts_table', 9),
(17, '2024_10_01_024046_create_carts_table', 10),
(18, '2024_10_01_024441_create_orders_table', 11),
(19, '2024_10_01_025406_create_order_products_table', 12),
(20, '2024_10_02_115535_create_coupons_table', 13),
(21, '2024_10_07_015053_create_category_articles_table', 14),
(22, '2024_10_07_015602_create_articles_table', 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ward` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(15,0) NOT NULL,
  `payment` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `coupon_code` int DEFAULT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `province`, `district`, `ward`, `total`, `payment`, `status`, `coupon_code`, `order_code`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'Huỳnh Kha', 'kvl@gmail.com', 1234567899, 'Quang nam', 'Can nam', 'Dong Tay', 214060000, 1, 1, NULL, 'LEGOLOFT-957603', 'đ', '2024-10-03 12:17:10', '2024-10-04 22:17:49'),
(2, 1, 'Khách vãng lai 2', 'kvl@gmail.com', 1234567899, 'Quang nam', 'Can nam', 'Dong Tay', 240000, 1, 5, NULL, '', 'đ', '2024-10-04 15:57:10', '2024-10-04 22:22:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `quantity` int NOT NULL,
  `total` decimal(15,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `name`, `price`, `quantity`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 17, 'san pham F', 255000, 110, 28050000, NULL, NULL),
(2, 1, 12, 'san pham A', 195000, 135, 26325000, NULL, NULL),
(3, 1, 16, 'san pham E', 245000, 146, 35770000, NULL, NULL),
(4, 1, 13, 'san pham B', 215000, 150, 32250000, NULL, NULL),
(5, 1, 14, 'san pham C', 225000, 200, 45000000, NULL, NULL),
(6, 1, 15, 'san pham D', 235000, 179, 42065000, NULL, NULL),
(7, 2, 15, 'san pham D', 235000, 1, 235000, NULL, NULL);

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
  `price` decimal(15,0) NOT NULL,
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
(12, 'San pham A', 'san-pham-a', 'product-test.webp', 15, 200000, 1, 1, 1, '', NULL, NULL),
(13, 'San pham B', 'san-pham-b', 'product-test.webp', 9, 220000, 1, 1, 1, '', NULL, NULL),
(14, 'San pham C', 'san-pham-c', 'product-test.webp', 15, 230000, 1, 1, 1, '', NULL, NULL),
(15, 'San pham D', 'san-pham-d', 'product-test.webp', 15, 240000, 1, 1, 1, '', NULL, NULL),
(16, 'San pham E', 'san-pham-e', 'product-test.webp', 9, 250000, 1, 0, 1, '', NULL, NULL),
(17, 'San pham F', 'san-pham-f', 'product-test.webp', 15, 260000, 1, 0, 1, '', NULL, NULL),
(18, 'San pham Q', 'san-pham-Q', 'product-test.webp', 1, 230000, 1, 0, 1, '', NULL, NULL),
(19, 'San pham W', 'san-pham-W', 'product-test.webp', 15, 240000, 1, 0, 1, '', NULL, NULL),
(20, 'San pham R', 'san-pham-r', 'product-test.webp', 6, 250000, 1, 0, 0, '', NULL, NULL),
(21, 'San pham U', 'san-pham-u', 'product-test.webp', 5, 260000, 1, 0, 0, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_discounts`
--

CREATE TABLE `product_discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_group_id` bigint UNSIGNED NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_discounts`
--

INSERT INTO `product_discounts` (`id`, `product_id`, `user_group_id`, `price`, `created_at`, `updated_at`) VALUES
(37, 16, 1, 245000, NULL, NULL),
(38, 17, 1, 255000, NULL, NULL),
(39, 18, 1, 225000, NULL, NULL),
(40, 19, 1, 235000, NULL, NULL),
(41, 16, 2, 240000, NULL, NULL),
(42, 17, 2, 250000, NULL, NULL),
(43, 18, 2, 220000, NULL, NULL),
(44, 19, 2, 230000, NULL, NULL);

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

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `images`, `created_at`, `updated_at`) VALUES
(6, 17, '2_66f90538de76b.png', '2024-09-29 00:27:11', '2024-09-29 00:43:52'),
(7, 17, '2_66f9019754d58.jpg', '2024-09-29 00:27:11', '2024-09-29 00:28:23'),
(8, 17, '2_66f903f8713f6.jpg', '2024-09-29 00:27:28', '2024-09-29 00:38:32'),
(9, 17, '2_66f903ea77bc6.png', '2024-09-29 00:38:18', '2024-09-29 00:38:18'),
(10, 17, '2_66f9056150d0f.jpg', '2024-09-29 00:44:19', '2024-09-29 00:44:33');

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
('g56Si0P04uOQIYiAGyJRqDOpTvgTVOXVd1iytGDc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6InFGakpHSE1EMVFIQTBCWmNpOWZ3M1JMTVdVVlhHQmp1NGc5VEhaZ2giO30=', 1728272641),
('YpXT4bJvRSJaxwpaT5iRsjUR0HmJ0Q7PSGKaeHlw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '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', 1728271384);

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
  `verification_code` int DEFAULT NULL,
  `user_group_id` bigint UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `verification_code`, `user_group_id`) VALUES
(1, 'kha', 'khakha5087@gmail.com', NULL, '$2y$12$iTIh4lveGPukaao1qcMua.hHEPloLVDUxyOspw/4gB7as0mbXp4uu', NULL, NULL, '2024-09-21 04:35:39', 1, NULL, 2),
(2, 'xaaaa', 'khahps31506@fpt.edu.vn', NULL, '$2y$12$1m1Ji3DxsIAz/uDDmmdCbeXhnL5zSH9yJDhz.aglhUbIS.mVfMWd2', NULL, NULL, '2024-10-01 23:40:34', 1, NULL, 2),
(3, 'tester', 'solakearlene2004@outlook.com', NULL, '$2y$12$ngHJm6fXH21XwQvdiG7/zuNExgTya41rZGZj1tP9oZyO1sXFtpFoa', NULL, '2024-10-03 00:10:39', '2024-10-03 00:10:39', 1, NULL, 1),
(6, 'xuww', 'xuxa0710@gmail.com', NULL, '$2y$12$6js62rg/AXb8ZhuAXTFb.OWD1TPX5ukGQxqHYCRepP2HJBj73233a', NULL, '2024-10-03 07:36:10', '2024-10-03 07:36:10', 1, NULL, 1);

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
-- Đang đổ dữ liệu cho bảng `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Mặc định', NULL, NULL),
(2, 'Đồng', NULL, NULL),
(3, 'Bạc', NULL, NULL),
(4, 'Vàng', NULL, NULL);

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
-- Chỉ mục cho bảng `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_categoryarticle_id_foreign` (`categoryArticle_id`);

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
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Chỉ mục cho bảng `category_articles`
--
ALTER TABLE `category_articles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

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
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_order_id_foreign` (`order_id`),
  ADD KEY `order_products_product_id_foreign` (`product_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `user_group_id` (`user_group_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `administration_groups`
--
ALTER TABLE `administration_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `category_articles`
--
ALTER TABLE `category_articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=381;

--
-- AUTO_INCREMENT cho bảng `product_discounts`
--
ALTER TABLE `product_discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `administrations`
--
ALTER TABLE `administrations`
  ADD CONSTRAINT `administrations_admin_group_id_foreign` FOREIGN KEY (`admin_group_id`) REFERENCES `administration_groups` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_categoryarticle_id_foreign` FOREIGN KEY (`categoryArticle_id`) REFERENCES `category_articles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
