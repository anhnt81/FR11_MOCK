/*
Navicat MySQL Data Transfer

Source Server         : database
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : laravel

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2017-12-23 23:01:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2017_10_01_141846_create_category_table', '1');
INSERT INTO `migrations` VALUES ('4', '2017_10_01_142405_create_brand_table', '1');
INSERT INTO `migrations` VALUES ('5', '2017_10_01_142440_create_product_table', '1');
INSERT INTO `migrations` VALUES ('6', '2017_10_01_142524_create_customer_table', '1');
INSERT INTO `migrations` VALUES ('7', '2017_10_01_142744_create_slide_table', '1');
INSERT INTO `migrations` VALUES ('8', '2017_10_01_142848_create_orders_table', '1');
INSERT INTO `migrations` VALUES ('9', '2017_10_01_143315_create_orders_detail_table', '1');
INSERT INTO `migrations` VALUES ('10', '2017_10_01_143345_create_comment_table', '1');
INSERT INTO `migrations` VALUES ('11', '2017_10_01_151011_create_view_table', '1');
INSERT INTO `migrations` VALUES ('12', '2017_10_01_152858_create_rate_table', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for tb_brand
-- ----------------------------
DROP TABLE IF EXISTS `tb_brand`;
CREATE TABLE `tb_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tb_brand
-- ----------------------------
INSERT INTO `tb_brand` VALUES ('1', 'Bánh Kinh Đô', '2017-10-02 09:25:18', '2017-10-02 09:25:21');
INSERT INTO `tb_brand` VALUES ('2', 'Bánh Hữu Nghị', '2017-10-02 09:25:33', '2017-10-02 09:25:35');
INSERT INTO `tb_brand` VALUES ('3', 'Bánh Bibika', '2017-10-02 09:25:57', '2017-10-02 09:26:00');
INSERT INTO `tb_brand` VALUES ('4', 'Bánh  Bảo Ngọc', '2017-10-02 09:26:47', '2017-10-02 09:26:50');

-- ----------------------------
-- Table structure for tb_category
-- ----------------------------
DROP TABLE IF EXISTS `tb_category`;
CREATE TABLE `tb_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentId` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_category_id_parentid_unique` (`id`,`parentId`),
  KEY `tb_category_parentid_foreign` (`parentId`),
  CONSTRAINT `tb_category_parentid_foreign` FOREIGN KEY (`parentId`) REFERENCES `tb_category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tb_category
-- ----------------------------
INSERT INTO `tb_category` VALUES ('1', 'Bánh mỳ', null, '2017-10-02 10:19:34', '2017-10-02 10:19:34');
INSERT INTO `tb_category` VALUES ('2', 'Bánh ngọt', null, '2017-10-02 10:19:34', '2017-10-02 10:19:34');
INSERT INTO `tb_category` VALUES ('3', 'Hộp bánh', null, '2017-10-02 10:19:34', '2017-10-02 10:19:34');
INSERT INTO `tb_category` VALUES ('4', 'Kiểu Âu', '1', '2017-10-02 10:21:04', '2017-10-02 10:21:04');
INSERT INTO `tb_category` VALUES ('5', 'Kiểu Úc', '1', '2017-10-02 10:21:05', '2017-10-02 10:21:05');
INSERT INTO `tb_category` VALUES ('6', 'Kiểu Nhật', '1', '2017-10-02 10:21:05', '2017-10-02 10:21:05');
INSERT INTO `tb_category` VALUES ('7', 'Kiểu cứng', '1', '2017-10-02 10:21:05', '2017-10-03 07:37:13');
INSERT INTO `tb_category` VALUES ('8', 'Bánh Gato', '2', '2017-10-02 10:21:05', '2017-10-02 04:33:22');
INSERT INTO `tb_category` VALUES ('9', 'Bánh cắt', '2', '2017-10-02 10:21:05', '2017-10-02 10:21:05');
INSERT INTO `tb_category` VALUES ('10', 'Bánh socola', '2', '2017-10-02 10:21:05', '2017-10-02 10:21:05');
INSERT INTO `tb_category` VALUES ('11', 'Bánh valie', '2', '2017-10-02 10:21:05', '2017-10-02 10:21:05');
INSERT INTO `tb_category` VALUES ('12', 'Bánh cuộn', '2', '2017-10-02 10:21:05', '2017-10-02 10:21:05');
INSERT INTO `tb_category` VALUES ('13', 'Bánh vụn', '1', '2017-10-02 04:25:34', '2017-10-02 04:25:34');

-- ----------------------------
-- Table structure for tb_comment
-- ----------------------------
DROP TABLE IF EXISTS `tb_comment`;
CREATE TABLE `tb_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_comment_uid_foreign` (`uid`),
  KEY `tb_comment_pid_foreign` (`pid`),
  CONSTRAINT `tb_comment_pid_foreign` FOREIGN KEY (`pid`) REFERENCES `tb_product` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tb_comment_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tb_comment
-- ----------------------------
INSERT INTO `tb_comment` VALUES ('1', '3', '3', 'Bánh rất ngon, mẫu mã đẹp', '4', '1', '2017-10-08 22:23:23', '2017-10-08 22:23:23');
INSERT INTO `tb_comment` VALUES ('2', '5', '3', 'Bánh rất ngon, mẫu mã đẹp', '5', '1', '2017-10-08 22:23:23', '2017-10-08 22:23:23');
INSERT INTO `tb_comment` VALUES ('4', '4', '3', 'Bánh rất ngon, mẫu mã đẹp', '2', '1', '2017-10-08 22:24:18', '2017-10-08 22:24:18');
INSERT INTO `tb_comment` VALUES ('5', '1', '6', 'tốt', '3', '1', '2017-10-11 11:51:17', '2017-10-11 11:51:17');

-- ----------------------------
-- Table structure for tb_customer
-- ----------------------------
DROP TABLE IF EXISTS `tb_customer`;
CREATE TABLE `tb_customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(10) unsigned NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `tb_customer_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `tb_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tb_customer
-- ----------------------------
INSERT INTO `tb_customer` VALUES ('1', '2', 'cus2', '1', '5435434534534', 'cus2@mamil.com', 'ha tay', '2017-10-07 10:09:57', '2017-10-07 10:09:57');
INSERT INTO `tb_customer` VALUES ('2', '2', 'cus3', '3', '31645225492', 'cus3@mamil.com', 'ha bac', '2017-10-07 10:09:57', '2017-10-07 10:09:57');
INSERT INTO `tb_customer` VALUES ('3', '3', 'cus4', '1', '62524615181', 'cus4@mamil.com', 'ha dong', '2017-10-07 10:09:57', '2017-10-07 10:09:57');
INSERT INTO `tb_customer` VALUES ('4', '9', 'cus5', '2', '16519849849', 'cus5@mamil.com', 'ha nam', '2017-10-07 10:09:57', '2017-10-07 10:09:57');
INSERT INTO `tb_customer` VALUES ('5', '9', 'cus6', '1', '651951651651', 'cus6@mamil.com', 'da nang', '2017-10-07 10:09:57', '2017-10-07 10:09:57');
INSERT INTO `tb_customer` VALUES ('6', '2', 'cus7', '1', '156165161651', 'cus7@mamil.com', 'hai phong', '2017-10-07 10:09:57', '2017-10-07 10:09:57');
INSERT INTO `tb_customer` VALUES ('7', '2', 'cus8', '2', '0065165446456', 'cus8@mamil.com', 'hồ chí minh', '2017-10-07 10:09:57', '2017-10-02 02:27:42');
INSERT INTO `tb_customer` VALUES ('8', '2', 'cus9', '1', '87846561561', 'cus9@mamil.com', 'ha noi', '2017-10-07 10:09:57', '2017-10-07 10:09:57');
INSERT INTO `tb_customer` VALUES ('9', '10', 'cus10', '1', '5165498465165', 'cus10@mamil.com', 'ha noi', '2017-10-07 10:09:57', '2017-10-07 10:09:57');
INSERT INTO `tb_customer` VALUES ('10', '2', 'cus11', '2', '8764654654654', 'cus11@mamil.com', 'ha noi', '2017-10-07 10:09:57', '2017-10-07 10:09:57');
INSERT INTO `tb_customer` VALUES ('11', '10', 'cus12', '1', '01234567777', 'cus12@mamil.com', 'ha noi', '2017-10-07 10:09:57', '2017-10-07 14:52:29');

-- ----------------------------
-- Table structure for tb_order
-- ----------------------------
DROP TABLE IF EXISTS `tb_order`;
CREATE TABLE `tb_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `total` double NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_order_cid_foreign` (`cid`),
  CONSTRAINT `tb_order_cid_foreign` FOREIGN KEY (`cid`) REFERENCES `tb_customer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tb_order
-- ----------------------------
INSERT INTO `tb_order` VALUES ('1', '1', '180000', '', '4', '2017-10-02 14:53:31', '2017-10-02 14:53:31');
INSERT INTO `tb_order` VALUES ('2', '5', '250000', '', '4', '2017-10-02 14:53:31', '2017-10-02 14:53:31');
INSERT INTO `tb_order` VALUES ('3', '2', '156000', '', '4', '2017-10-02 14:53:31', '2017-10-02 14:53:31');
INSERT INTO `tb_order` VALUES ('4', '9', '180000', '', '6', '2017-10-02 14:53:32', '2017-10-02 14:53:32');
INSERT INTO `tb_order` VALUES ('5', '3', '180000', '', '7', '2017-10-02 14:53:32', '2017-10-02 18:04:21');
INSERT INTO `tb_order` VALUES ('6', '1', '250000', '', '3', '2017-10-02 14:53:32', '2017-10-02 14:53:32');
INSERT INTO `tb_order` VALUES ('7', '3', '250000', '', '2', '2017-10-02 14:53:32', '2017-10-02 14:53:32');
INSERT INTO `tb_order` VALUES ('8', '8', '160000', '', '1', '2017-10-02 14:53:32', '2017-10-02 14:53:32');
INSERT INTO `tb_order` VALUES ('9', '7', '180000', '', '3', '2017-10-02 14:53:32', '2017-10-02 17:16:29');

-- ----------------------------
-- Table structure for tb_order_detail
-- ----------------------------
DROP TABLE IF EXISTS `tb_order_detail`;
CREATE TABLE `tb_order_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oid` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_order_detail_oid_foreign` (`oid`),
  KEY `tb_order_detail_pid_foreign` (`pid`),
  CONSTRAINT `tb_order_detail_oid_foreign` FOREIGN KEY (`oid`) REFERENCES `tb_order` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tb_order_detail_pid_foreign` FOREIGN KEY (`pid`) REFERENCES `tb_product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tb_order_detail
-- ----------------------------
INSERT INTO `tb_order_detail` VALUES ('1', '1', '2', '1', '180000', '2017-10-07 14:07:11', '2017-10-07 14:07:11');
INSERT INTO `tb_order_detail` VALUES ('2', '9', '3', '1', '180000', '2017-10-07 14:07:11', '2017-10-07 14:07:11');
INSERT INTO `tb_order_detail` VALUES ('3', '8', '4', '1', '160000', '2017-10-07 14:07:11', '2017-10-07 14:07:11');
INSERT INTO `tb_order_detail` VALUES ('4', '2', '2', '1', '250000', '2017-10-07 14:07:11', '2017-10-07 14:07:11');
INSERT INTO `tb_order_detail` VALUES ('5', '3', '6', '1', '156000', '2017-10-07 14:07:11', '2017-10-07 14:07:11');
INSERT INTO `tb_order_detail` VALUES ('6', '4', '3', '1', '180000', '2017-10-07 14:07:11', '2017-10-07 14:07:11');
INSERT INTO `tb_order_detail` VALUES ('7', '5', '9', '1', '180000', '2017-10-07 14:07:11', '2017-10-07 14:07:11');
INSERT INTO `tb_order_detail` VALUES ('8', '6', '2', '1', '250000', '2017-10-07 14:07:12', '2017-10-07 14:07:12');
INSERT INTO `tb_order_detail` VALUES ('9', '7', '2', '1', '250000', '2017-10-07 14:07:12', '2017-10-07 14:07:12');

-- ----------------------------
-- Table structure for tb_product
-- ----------------------------
DROP TABLE IF EXISTS `tb_product`;
CREATE TABLE `tb_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `bid` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `promotion_price` double NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `new` int(11) NOT NULL,
  `datetime_promotion` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_product_cid_foreign` (`cid`),
  KEY `tb_product_bid_foreign` (`bid`),
  CONSTRAINT `tb_product_bid_foreign` FOREIGN KEY (`bid`) REFERENCES `tb_brand` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tb_product_cid_foreign` FOREIGN KEY (`cid`) REFERENCES `tb_category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tb_product
-- ----------------------------
INSERT INTO `tb_product` VALUES ('2', '7', '1', 'Bánh Doremon', 'Được làm những nguyên liệu hàng đầu đất nước', 'p-ava-20.jpg,p-ava-21.jpg', '3', '250000', '170000', '1', '2016-10-26 03:00:16', '2017-07-27 15:14:29', '1', null, 'p-ava-20.jpg', null);
INSERT INTO `tb_product` VALUES ('3', '4', '1', 'Bánh Crepe Sầu riêng - Chuối', 'Nếu từng bị mê hoặc bởi các loại tarlet ngọt thì chắn chắn bạn không thể bỏ qua những loại tarlet mặn. Ngoài hình dáng bắt mắt, lớp vở bánh giòn giòn cùng với nhân mặn như thịt gà, nấm, thị h', 'p-ava-30.jpg', '5', '180000', '0', '1', '2017-08-26 03:00:16', '2017-10-27 15:02:58', '1', null, 'p-ava-30.jpg', '1');
INSERT INTO `tb_product` VALUES ('4', '4', '3', 'Bánh Crepe Đào', 'Bánh Crepre với hương vị Đào rất mê hoặc người thưởng thức', 'crepe-dao.jpg', '2', '160000', '0', '1', '2017-08-26 03:00:16', '2017-10-24 22:11:00', '1', null, 'crepe-dao.jpg', null);
INSERT INTO `tb_product` VALUES ('5', '4', '4', 'Bánh Crepe Dâu', 'Với hương vị dâu ngọt ngào Bánh Crepe Dâu rất ngon', 'p-ava-50.jpg', '3', '160000', '0', '1', '2017-09-26 03:00:16', '2017-10-26 22:11:00', '0', null, 'p-ava-50.jpg', null);
INSERT INTO `tb_product` VALUES ('6', '4', '3', 'Bánh Crepe Pháp', 'Bánh được làm theo phương thức của Pháp', 'p-ava-60.jpg', '2', '156000', '0', '1', '2017-09-26 03:00:16', '2017-10-26 22:11:00', '1', null, 'p-ava-60.jpg', null);
INSERT INTO `tb_product` VALUES ('8', '4', '4', 'Bánh Crepe Trà xanh', 'Hương vị trà xanh thuần khiết đem lại 1 đặc trưng riêng cho bánh crepe', 'p-ava-81.jpg,p-ava-82.jpg', '2', '170000', '0', '1', '2017-09-26 03:00:16', '2017-10-08 10:37:50', '0', null, 'p-ava-80.jpg', null);
INSERT INTO `tb_product` VALUES ('9', '4', '2', 'Bánh Crepe Sầu riêng và Dứa', 'Sự pha trộn giữa 2 loại hoa quả Sầu riêng và Dứa đem lại 1 hương vị rất lạ cho người thưởng thức', 'p-ava-90.jpg', '2', '180000', '0', '1', '2017-09-26 03:00:16', '2017-10-26 22:11:00', '1', null, 'p-ava-90.jpg', null);
INSERT INTO `tb_product` VALUES ('10', '6', '1', 'Bánh Kem Sinh Nhật', 'Bánh kem sinh nhật với hương vị kem tự nhiên mát lạnh', 'p-ava-100.jpg', '2', '180000', '150000', '1', '2017-10-02 10:17:50', '2017-10-02 10:17:50', '0', null, 'p-ava-100.jpg', null);
INSERT INTO `tb_product` VALUES ('11', '2', '2', 'Bánh Bông Lan Trứng', 'Bánh Bông Lan Trứng có một hương vị quê hướng đậm đà vị trứng gà', 'p-ava-110.jpg', '2', '179000', '150000', '1', '2017-10-02 10:22:54', '2017-10-02 10:22:54', '1', null, 'p-ava-110.jpg', null);
INSERT INTO `tb_product` VALUES ('12', '2', '2', 'Bánh Su Kem Dâu', 'Bánh Su Kem Dâu với hương vị dâu đầy đặc trưng. Ngọt ngào', 'p-ava-120.jpg', '2', '180000', '0', '1', '2017-10-04 17:11:18', '2017-10-04 17:11:18', '1', null, 'p-ava-120.jpg', null);
INSERT INTO `tb_product` VALUES ('14', '6', '1', 'Bánh Su Kem Dâu', 'Bánh su kem dâu được làm từ công thức gia truyền của xứ sở Hoa Anh Đào.', 'p-ava-140.jpg', '2', '256000', '0', '1', '2017-10-04 17:52:23', '2017-10-04 17:52:23', '1', null, 'p-ava-140.jpg', null);

-- ----------------------------
-- Table structure for tb_slide
-- ----------------------------
DROP TABLE IF EXISTS `tb_slide`;
CREATE TABLE `tb_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `ordinal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_slide_pid_foreign` (`pid`),
  CONSTRAINT `tb_slide_pid_foreign` FOREIGN KEY (`pid`) REFERENCES `tb_product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tb_slide
-- ----------------------------
INSERT INTO `tb_slide` VALUES ('1', '2', '1', '2017-10-08 12:26:30', '2017-10-08 12:26:30');
INSERT INTO `tb_slide` VALUES ('2', '3', '3', '2017-10-08 12:26:30', '2017-10-08 12:27:46');
INSERT INTO `tb_slide` VALUES ('3', '4', '5', '2017-10-08 12:26:31', '2017-10-08 12:28:13');
INSERT INTO `tb_slide` VALUES ('4', '5', '4', '2017-10-08 12:26:31', '2017-10-08 12:26:31');
INSERT INTO `tb_slide` VALUES ('5', '6', '2', '2017-10-08 12:26:31', '2017-10-08 12:28:13');

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(1) NOT NULL DEFAULT '4',
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_user_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES ('1', 'Vô Thanh Phong', 'master@shoponline.local', '$2y$10$vbOgorRAoSeYg88vFOiL9OisnBuYnsELUaim36snqhF8Ms7Gnx6Aq', '0912121212', 'u-ava-1.jpg', '1', '1', 'jfWukT5jJa7XbjL4KlLTXMKnmbuRSkBTmas5sGPxinxEkGMgBj30HeuxSFbY', null, '2017-10-07 17:49:32');
INSERT INTO `tb_user` VALUES ('2', 'Nguyễn Tuấn Anh', 'anhnt9@smartosc.com', '$2y$10$vbOgorRAoSeYg88vFOiL9OisnBuYnsELUaim36snqhF8Ms7Gnx6Aq', '01234567890', 'avatar.png', '1', '1', 'cZ6L80Pzfr47PYAw6roFDYXjOPebX1oZQrHcCQ7UvSHywjiMmEjT4MpGqduB', '2017-10-03 10:01:58', '2017-10-03 10:01:58');
INSERT INTO `tb_user` VALUES ('3', 'user2', 'user2@mail.com', '$2y$10$vbOgorRAoSeYg88vFOiL9OisnBuYnsELUaim36snqhF8Ms7Gnx6Aq', '01234567891', 'avatar.png', '3', '1', null, '2017-10-03 10:01:58', '2017-10-03 16:33:16');
INSERT INTO `tb_user` VALUES ('4', 'user3', 'user3@mail.com', '$2y$10$vbOgorRAoSeYg88vFOiL9OisnBuYnsELUaim36snqhF8Ms7Gnx6Aq', '01234567892', 'avatar.png', '4', '1', null, '2017-10-03 10:01:58', '2017-10-03 10:01:58');
INSERT INTO `tb_user` VALUES ('5', 'admin1', 'admin1@mail.com', '$2y$10$vbOgorRAoSeYg88vFOiL9OisnBuYnsELUaim36snqhF8Ms7Gnx6Aq', '01234567892', 'avatar.png', '2', '1', 'fjPkCbPi1KTS5PoJHA3nAwWL3SfReWzyMnSgS7SNIHvoCmwIOOJNQoyhFl1t', '2017-10-03 10:01:58', '2017-10-03 10:01:58');
INSERT INTO `tb_user` VALUES ('6', 'admin2', 'admin2@mail.com', '$2y$10$vbOgorRAoSeYg88vFOiL9OisnBuYnsELUaim36snqhF8Ms7Gnx6Aq', '01234567893', 'avatar.png', '2', '1', null, '2017-10-03 10:01:58', '2017-10-03 10:01:58');
INSERT INTO `tb_user` VALUES ('8', 'user6', 'user6@mail.com', '$2y$10$vbOgorRAoSeYg88vFOiL9OisnBuYnsELUaim36snqhF8Ms7Gnx6Aq', '01234567894', 'avatar.png', '4', '1', null, '2017-10-03 10:02:35', '2017-10-03 10:02:35');
INSERT INTO `tb_user` VALUES ('9', 'user4', 'user4@mail.com', '$2y$10$vbOgorRAoSeYg88vFOiL9OisnBuYnsELUaim36snqhF8Ms7Gnx6Aq', '01234567895', 'avatar.png', '3', '1', null, '2017-10-03 10:02:35', '2017-10-03 17:19:14');
INSERT INTO `tb_user` VALUES ('10', 'user5', 'user5@mail.com', '$2y$10$vbOgorRAoSeYg88vFOiL9OisnBuYnsELUaim36snqhF8Ms7Gnx6Aq', '01234567895', 'avatar.png', '4', '1', null, '2017-10-03 10:02:35', '2017-10-03 10:02:35');

-- ----------------------------
-- Table structure for tb_view
-- ----------------------------
DROP TABLE IF EXISTS `tb_view`;
CREATE TABLE `tb_view` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `view` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_view_pid_foreign` (`pid`),
  CONSTRAINT `tb_view_pid_foreign` FOREIGN KEY (`pid`) REFERENCES `tb_product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tb_view
-- ----------------------------
