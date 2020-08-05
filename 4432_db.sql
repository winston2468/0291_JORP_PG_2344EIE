-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2019 at 05:49 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4432_db`
--
DROP DATABASE IF EXISTS `4432_db`;
CREATE DATABASE IF NOT EXISTS `4432_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `4432_db`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullName` text COLLATE utf8_unicode_nopad_ci NOT NULL COMMENT 'user real name',
  `username` text COLLATE utf8_unicode_nopad_ci NOT NULL COMMENT 'user login name',
  `password` text COLLATE utf8_unicode_nopad_ci NOT NULL COMMENT 'user password',
  `email` text COLLATE utf8_unicode_nopad_ci DEFAULT NULL COMMENT 'use email',
  `address` text COLLATE utf8_unicode_nopad_ci DEFAULT NULL COMMENT 'user address',
  `phone` text COLLATE utf8_unicode_nopad_ci DEFAULT NULL COMMENT 'user phone number',
  `country` int(10) UNSIGNED NOT NULL COMMENT 'country id, connect to `country`.id',
  `type` int(1) UNSIGNED NOT NULL COMMENT 'user type, 0-admin, 1-seller, 2-buyer',
  `currency` text COLLATE utf8_unicode_nopad_ci DEFAULT 'HKD' COMMENT 'user currency'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_nopad_ci COMMENT='user account table';

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `fullName`, `username`, `password`, `email`, `address`, `phone`, `country`, `type`, `currency`) VALUES
(1, 'Samsung Electronics Co., Ltd.', 'Samsung', 'Samsung', 'Ireland.SamsungSupport@exertis.com', 'Samsung store M50 Business Park Ballymount Road Upper Dublin D12 Ireland', '0818 302 016', 103, 1, 'HKD'),
(2, 'Acer America Corporation', 'Acer', 'Acer', 'Acer@gmail.com', '333 West San Carlos Street, Suite 1500, San Jose, CA 95110', '533-7700', 185, 1, 'HKD'),
(3, 'Apple Inc.', 'Apple', 'Apple', 'Apple@gmail.com', 'Hysan Place  500 Hennessy Road  Hong Kong, Causeway Bay', '800-275-2273', 226, 1, 'HKD'),
(4, 'HP Development Company, L.P.', 'HP', 'HP', 'HP@gmail.com', '25/F, Citiplaza One, 1111 King\'s Road, Tai Koo Shing', '866-625-3906', 226, 1, 'HKD'),
(5, 'Dell Inc.', 'Dell', 'Dell', 'Dell@gmail.com', '18/F Oxford House, Taikoo Place, 979 King’s Road, Island East, Hong Kong', '866-516-3115', 226, 1, 'HKD'),
(6, 'Lenovo', 'Lenovo', 'Lenovo', 'Lenovo@gmail.com', 'Quarry Bay, King\'s Rd, 979', '855-253-6686', 226, 1, 'HKD'),
(7, 'ASUSTeK Computer Inc.', 'Asus', 'Asus', 'Asus@gmail.com', 'Room E, 19/f, The Globe, Wing Hong St, Lai Chi Kok', '855-755-2787', 226, 1, 'HKD'),
(8, 'LG Electronics.', 'LG', 'LG', 'comm.display@lge.com', 'Lee Garden Manulife Insurance Building', '888-865-3026', 113, 1, 'HKD'),
(9, 'Sony Corporation.', 'Sony', 'Sony', 'Sony@gmail.com', '16/F East Point Centre (Old Wing, 555 Hennessy Rd, Causeway Bay', '22-367-2111', 107, 1, 'HKD'),
(10, 'Toshiba', 'Toshiba', 'Toshiba', 'Toshiba@gmail.com', 'Suite 1410-1419, 14/F., Shatin Galleria, 18-24 Shan Mei Street, Fotan, N.T., Hong Kong.', '2956 0222', 96, 1, 'HKD'),
(11, 'Fujitsu', 'Fujitsu', 'Fujitsu', 'Fujitsu@gmail.com', 'Unit 2, 33/F, Tower 2, Enterprise Square 5, 38 Wang Chiu Road, Kowloon Bay, Hong Kong', '2827 5780', 96, 1, 'HKD'),
(12, 'MSI', 'MSI', 'MSI', 'MSI@gmail.com', 'Room 1705-08, 17/F, St. George\'s Building, 2 Ice House Street, Central', '2820 1100', 96, 1, 'HKD'),
(13, 'Huawei', 'Huawei', 'Huawei', 'Huawei@gmail.com', '9/F, Tower 6, The Gateway, 9 Canton Road, Tsim Sha Tsui, Kowloon', '2588 1899', 96, 1, 'HKD'),
(14, 'Microsoft', 'Microsoft', 'Microsoft', 'Microsoft@gmail.com', '100 Cyberport Rd, Telegraph Bay', '2804 4200', 96, 1, 'HKD'),
(15, 'Google', 'Google', 'Google', 'Google@gmail.com', 'Tower 2, Times Square, 1 Matheson St, Causeway Bay', '3923 5400', 96, 1, 'HKD'),
(16, 'Redmi', 'Redmi', 'Redmi', 'Redmi@gmail.com', 'Mong Kok, Nathan Rd, 601, Chong Hing Square', '2698 8871', 96, 1, 'HKD'),
(17, 'Vivo', 'Vivo', 'Vivo', 'Vivo@gmail.com', 'Vivo service center , Unit 01, 19/F, No.1 Hung To Road, Kwun Tong, Hong Kong', '2301 0999', 96, 1, 'HKD'),
(18, 'STMicroelectronics', 'stmicroelectronics', 'stmicroelectronics', 'stcompany@gmail.com', 'Office No.88, ZiHai Road, ZiZhu Science ParknHang district SHANGHAI,200241, China', '21 2418 8688', 44, 1, 'HKD'),
(19, 'Texas Instruments', 'TexasInstruments', 'TexasInstruments', 'texasinstruments@gmail.com', '12500 TI Boulevard Dallas, Texas 75243 USA', '9729952011', 226, 1, 'HKD'),
(20, 'Silicon Lab', 'SiliconLab', 'SiliconLab', 'SiliconLab@gmail.com', '343 Congress Street, Suite 4100 Boston, MA 02210 USA', '6179510200', 226, 1, 'HKD'),
(21, 'CORSAIR', 'CORSAIR', 'CORSAIR', 'CORSAIR@gmail.com', 'Corsair Memory 46221 Landing Parkway Fremont, CA 94538', '8882224346', 226, 1, 'HKD'),
(22, 'NZXT', 'NZXT', 'NZXT', 'NZXT@gmail.com', 'NZXT HQ 13164 E. Temple Ave. City of Industry, CA 91746', '8002289395', 226, 1, 'HKD'),
(23, 'Renesas', 'Renesas', 'Renesas', 'Renesas@gmail.com', '3-2-24 Toyosu Koto-ku Tokyo 135-0061, Japan', '+81 3 6773 3000', 107, 1, 'HKD'),
(24, 'Admin', 'Admin', 'Admin', 'admin@gmail.com', 'admin address', '00000000', 96, 0, 'HKD'),
(25, 'test_seller', 'tests', 'tests', 'tests@gmail.com', 'tests', '12345678654', 44, 1, 'HKD'),
(26, 'test_buyer', 'testb', 'testb', 'testb@gmail.com', 'testb', '55555555', 96, 2, 'HKD');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `buyer` int(10) UNSIGNED NOT NULL COMMENT 'buyer id, connect to `account`.id',
  `product` int(10) UNSIGNED NOT NULL COMMENT 'product id, connect to `product`.id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_nopad_ci COMMENT='cart table';

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8_unicode_nopad_ci DEFAULT NULL COMMENT 'tag name',
  `parent` int(10) UNSIGNED DEFAULT NULL COMMENT 'parent id, connect to `category`.id',
  `otherinfo` text COLLATE utf8_unicode_nopad_ci DEFAULT NULL COMMENT 'other product information'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_nopad_ci COMMENT='category table';

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent`, `otherinfo`) VALUES
(0, NULL, NULL, 'main'),
(1, 'Microcontroller', 0, 'main'),
(2, 'STMicroelectronics', 1, 'sub'),
(3, 'Others', 1, 'sub'),
(4, 'Computer', 0, 'main'),
(5, 'Desktop', 4, 'sub'),
(6, 'Laptop', 4, 'sub'),
(7, 'Customized Build', 4, 'sub'),
(8, 'Others', 4, 'sub'),
(9, 'Others', 0, 'main'),
(10, 'Others', 9, 'sub'),
(11, 'Texas Instruments', 1, 'sub'),
(12, 'Silicon Labs', 1, 'sub'),
(13, 'Renesas', 1, 'sub');

-- --------------------------------------------------------

--
-- Table structure for table `category_pressed_time`
--

DROP TABLE IF EXISTS `category_pressed_time`;
CREATE TABLE `category_pressed_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` int(10) UNSIGNED NOT NULL COMMENT 'category id',
  `user` int(10) UNSIGNED NOT NULL COMMENT 'user id',
  `pressed_times` int(10) UNSIGNED NOT NULL COMMENT 'pressed times',
  `dummy` int(10) UNSIGNED DEFAULT 0 COMMENT 'dummy used for search max'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_nopad_ci COMMENT='category pressed time table';

--
-- Dumping data for table `category_pressed_time`
--

INSERT INTO `category_pressed_time` (`id`, `category`, `user`, `pressed_times`, `dummy`) VALUES
(1, 1, 24, 1, 0),
(2, 0, 26, 9, 0),
(3, 1, 26, 4, 0),
(4, 4, 26, 15, 0),
(5, 5, 26, 12, 0),
(6, 9, 26, 4, 0),
(7, 6, 26, 2, 0),
(8, 7, 26, 6, 0),
(9, 2, 26, 2, 0),
(10, 11, 26, 2, 0),
(11, 4, 23, 5, 0),
(12, 9, 23, 7, 0),
(13, 10, 23, 8, 0),
(14, 1, 23, 2, 0),
(15, 3, 23, 2, 0),
(16, 8, 23, 4, 0),
(17, 5, 23, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` int(10) UNSIGNED NOT NULL,
  `iso` char(2) COLLATE utf8_unicode_nopad_ci NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_nopad_ci NOT NULL,
  `nicename` varchar(80) COLLATE utf8_unicode_nopad_ci NOT NULL,
  `iso3` char(3) COLLATE utf8_unicode_nopad_ci DEFAULT NULL,
  `numcode` smallint(6) UNSIGNED DEFAULT NULL,
  `phonecode` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_nopad_ci COMMENT='country table';

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `order_made`
--

DROP TABLE IF EXISTS `order_made`;
CREATE TABLE `order_made` (
  `id` int(10) UNSIGNED NOT NULL,
  `cart` int(10) UNSIGNED NOT NULL COMMENT 'cart id, connect to `cart`.id',
  `order_time` datetime NOT NULL COMMENT 'order time',
  `status` text COLLATE utf8_unicode_nopad_ci NOT NULL COMMENT 'order status',
  `quantity` int(10) UNSIGNED NOT NULL COMMENT 'order quantity of the product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_nopad_ci COMMENT='order made table';

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller` int(10) UNSIGNED NOT NULL COMMENT 'seller id, connect to `account`.user id',
  `name` text COLLATE utf8_unicode_nopad_ci NOT NULL COMMENT 'product name',
  `image` text COLLATE utf8_unicode_nopad_ci NOT NULL COMMENT 'product image',
  `price` float NOT NULL COMMENT 'product price',
  `stock` int(10) UNSIGNED NOT NULL COMMENT 'product stock ',
  `video` text COLLATE utf8_unicode_nopad_ci NOT NULL COMMENT 'product video',
  `description` text COLLATE utf8_unicode_nopad_ci DEFAULT NULL,
  `category` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_nopad_ci COMMENT='product table';

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `seller`, `name`, `image`, `price`, `stock`, `video`, `description`, `category`) VALUES
(1, 18, 'STM32F101CBT6TR', '1574596511-LQFP_48_t.jpg', 4.56, 100, '', 'Mainstream Access line, ARM Cortex-M3 MCU with 128 Kbytes Flash, 36 MHz CPU', 2),
(2, 18, 'STM32F101RBT6TR', '1574597674-STM32F101RBT6TR.jpg', 4.98, 100, '', ' Mainstream Access line, ARM Cortex-M3 MCU with 128 Kbytes Flash, 36 MHz CPU', 2),
(3, 18, 'STM32F102C4T6A', '1574598311-STM32F102C4T6A.jpg', 3.52, 100, '', ' Mainstream USB Access line, ARM Cortex-M3 MCU with 16 Kbytes Flash, 48 MHz CPU, USB FS', 2),
(4, 18, 'STM32F103RBT6', '1574616781-stm32f103rbt6-arm-cortex-m3-performance-mcu-with-128-kbytes-flash-72-mhz-cpu-motor-control-usb-and-can.jpg', 6.66, 100, '', ' Mainstream Performance line, ARM Cortex-M3 MCU with 128 Kbytes Flash, 72 MHz CPU, motor control, USB and CAN', 2),
(5, 18, 'STM32F103ZFH6', '1574618466-STM32F103ZFH6.JPG', 10.76, 100, '', ' Mainstream Performance line, ARM Cortex-M3 MCU with 768 Kbytes Flash, 72 MHz CPU, motor control, USB and CAN', 2),
(6, 18, 'STM32L476RGT6TR', '1574618545-STM32L476RGT6TR.jpg', 10.91, 100, '', ' Ultra-low-power with FPU ARM Cortex-M4 MCU 80 MHz with 1 Mbyte Flash, LCD, USB OTG, DFSDM', 2),
(7, 18, 'STM32F405RGT6TR', '1574618628-STM32F405RGT6TR.jpg', 10.08, 100, '', 'High-performance foundation line, ARM Cortex-M4 core with DSP and FPU, 1 Mbyte Flash, 168 MHz CPU, ART Accelerator', 2),
(8, 18, 'STM32F407IGT6', '1574618700-STM32F405RGT6TR.jpg', 10.18, 100, '', ' High-performance foundation line, ARM Cortex-M4 core with DSP and FPU, 1 Mbyte Flash, 168 MHz CPU, ART Accelerator, Ethernet, FSMC', 2),
(9, 18, 'STM32F407ZGT6J', '1574618803-STM32F407ZGT6J.jpg', 16.25, 100, '', ' High-performance foundation line, ARM Cortex-M4 core with DSP and FPU, 1 Mbyte Flash, 168 MHz CPU, ART Accelerator, Ethernet, FSMC', 2),
(10, 18, 'STM32F407ZGT6TR', '1574618852-STM32F407ZGT6TR.jpg', 10.99, 100, '', ' High-performance foundation line, ARM Cortex-M4 core with DSP and FPU, 1 Mbyte Flash, 168 MHz CPU, ART Accelerator, Ethernet, FSMC', 2),
(11, 18, 'STM32F412G-DISCO', '1574618903-STM32F412G-DISCO.jpg', 36.75, 100, '', ' Discovery kit with STM32F412ZG MCU ', 2),
(12, 18, 'STM32F413H-DISCO', '1574618987-STM32F413H-DISCO.jpg', 73.5, 100, '', ' Discovery kit with STM32F413ZH MCU', 2),
(13, 1, 'Notebook 9 Pen 13\"', '1574622341-Notebook 9 Pen 13_.jpg', 11200, 10, '', 'Windows 10 Home, 8th Gen Intel® Core™ i7 Mobile Processor 13.3\" FHD LED Display (1920x1080 dots), 512GB SSD Storage\r\n', 6),
(14, 2, 'Swift 7', '1574622538-Swift 7.png', 13600, 10, '', '\"Windows 10 Home\r\nIntel® Core™ i7-7Y75 processor Dual-core 1.30 GHz\r\nIntel® HD Graphics 615 shared memory\r\n14\"\" Full HD (1920 x 1080) 16:9 IPS\r\n8 GB, LPDDR3\r\n256 GB SSD\"\r\n', 6),
(15, 2, 'Aspire 3', '1574622593-Aspire 3.png', 2640, 10, '', '\"Windows 10 Home\r\nAMD Ryzen 5 2500U processor Quad-core 2 GHz\r\nAMD Radeon Vega 8 Shared Memory\r\n15.6\"\" Full HD (1920 x 1080) 16:9\r\n8 GB, DDR4 SDRAM\r\n1 TB HDD\r\n30-day Microsoft Office trial included\"\r\n', 6),
(16, 3, 'Macbook Air', '1574623025-Macbook Air.jpg', 8899, 10, '', 'Retina display,1.6GHz dual-core Intel Core i5, Turbo Boost up to 3.6GHz, with 4MB L3 cache,128GB PCIe-based SSD,8GB of 2133MHz LPDDR3 onboard memory\r\n', 6),
(17, 3, 'Macbook Pro 13\"', '1574623281-Macbook Pro 13_.jpg', 10399, 10, '', '13.3‑inch (diagonal) LED-backlit display,1.4GHz quad‑core Intel Core i5, Turbo Boost up to 3.9GHz, with 128MB of eDRAM,128GB SSD,8GB of 2133MHz LPDDR3 onboard memory\r\n', 6),
(18, 4, 'HP Spectre x360', '1574623420-HP Spectre x360.jpg', 14999, 10, '', '\"10th Generation Intel® Core™ i7 processor\r\nWindows 10 Home 64\r\n512 GB PCIe® NVMe™ M.2 SSD\r\n16 GB LPDDR4-3200 SDRAM (onboard)\r\n13.3\"\" diagonal FHD IPS BrightView micro-edge WLED-backlit multitouch-enabled edge-to-edge\"\r\n', 6),
(19, 4, 'HP Notebook 17\"', '1574623530-HP Notebook 17_.png', 9699, 10, '', '\"10th Generation Intel® Core™ i7 processor\r\nWindows 10 Home 64\r\n1 TB 5400 rpm SATA\r\n256 GB PCIe® NVMe™ M.2 SSD\r\n16 GB DDR4-2666 SDRAM (2 x 8 GB)\r\n17.3\"\" diagonal FHD IPS anti-glare WLED-backlit\"\r\n', 6),
(20, 4, 'OMEN', '1574623564-OMEN.png', 18999, 10, '', '\"9th Generation Intel® Core™ i7 processor\r\nWindows 10 Home 64\r\n1 TB PCIe® NVMe™ M.2 SSD\r\n512 GB PCIe® NVMe™ M.2 SSD\r\n32 GB DDR4-2666 SDRAM (2 x 16 GB)\r\n17.3\"\" diagonal FHD IPS anti-glare micro-edge WLED (1920 x 1080)\"\r\n', 6),
(21, 5, 'Vostro', '1574623801-Vostro.jpg', 4499, 10, '', '\"10th Generation Intel® Core™ i5-10210U Processor (6MB Cache, up to 4.2 GHz)\r\nWindows 10 Home 64bit English, Simplified Chinese, Traditional Chinese\r\nIntel® UHD Graphics with shared graphics memory\r\n8GB, 8Gx1, DDR4, 2666MHz\r\n256GB M.2 PCIe NVMe Solid State Drive\"\r\n', 6),
(22, 5, 'G3', '1574623909-G3.jpg', 7099, 10, '', '\"9th Generation Intel® Core™ i5-9300H (8MB Cache, up to 4.1 GHz, 4 cores)\r\n\r\nWindows 10 Home 64bit English, Simplified Chinese, Traditional Chinese\r\n\r\nNVIDIA® GeForce® GTX 1050 3GB GDDR5\r\n\r\n8GB 2x4GB DDR4 2666MHz\r\n\r\n512GB M.2 PCIe NVMe Solid State Drive\"\r\n', 6),
(23, 6, 'ThinkPad T590', '1574623991-ThinkPad T590.jpg', 8500, 10, '', 'Intel Core i5-8265U Processor (1.60GHz, up to 3.90GHz with Turbo Boost, 4 Cores, 6MB Cache),Windows 10 Home 64,8GB DDR4 2666MHz Onboard,256GB Solid State Drive, M.2 2280, SATA, OPAL 2.0, TLC\r\n', 6),
(24, 6, 'X1 Extreme Gen 2', '1574624017-X1 Extreme Gen 2.jpg', 14050, 10, '', 'Intel Core i5-9400H Processor with vPro (2.50GHz, up to 4.30GHz with Turbo Boost, 4 Cores, 8MB Cache),Windows 10 Home 64,8GB DDR4 2666MHz SoDIMM,256GB Solid State Drive\r\n', 6),
(25, 7, 'TUF Gaming Laptop', '1574624097-TUF Gaming Laptop.jpg', 8000, 10, '', '\"NVIDIA GeForce RTX 2060 8GB GDDR6 (Base: 1110MHz, Boost: 1335MHz, TDP: 80W)\r\nQuad-core AMD Ryzen 5 R5-3550H Processor\r\n120Hz 15.6” Full HD (1920x1080) IPS-Type display\r\n512GB NVMe SSD | 16GB DDR4 RAM | Windows 10 Home\r\nGigabit Wave 2 Wi-Fi 5 (802.11ac)\r\nDurable MIL-STD-810 military standard construction\r\nDual fans with anti-dust technology\r\nRGB Backlit keyboard rated for 20-million keystroke durability\"\r\n', 6),
(26, 7, 'ZenBook 13', '1574624115-ZenBook 13.jpg', 9600, 10, '', '\"Innovative ScreenPad™: 5.65-inch interactive touchscreen trackpad\r\n30th Anniversary Edition: Genuine-leather lid cover, carry sleeve & wireless mouse\r\nApp Switcher: Easily move docked windows between main display & ScreenPad™ display\r\n13.3 inch wide-view Full HD 4-way NanoEdge bezel display\r\nLatest Intel Core i7-8565U Core Processor with discrete graphics NVIDIA GeForce MX250\r\nFast storage and memory featuring 1TB PCIe NVMe SSD with 16GB RAM\r\nBuilt-in IR camera for facial recognition sign in with Windows Hello\r\nHDMI, USB Type C, Gigabit-class Wi-Fi 5 (802.11ac), Bluetooth 5.0 & Micro SD reader\r\nSleek and lightweight 2.8 lbs for comfortable portability\r\nMIL-STD 810G military standard for reliability and durability\"\r\n', 6),
(27, 8, 'gram 15.6”', '1574624308-gram 15.6.jpg', 7600, 10, '', '\"Weighs 980g\r\n15.6 Inch Full HD IPS Display\r\nMagnesium Alloy Body\r\nUSB-C™\r\nErgonomic and Numeric Keypad\"\r\n', 6),
(28, 12, 'GE65 Raider 9SF', '1574624433-GE65 Raider 9SF.png', 16999, 10, '', 'Up to 9th Gen. Intel® Core™ i9 Processor,Windows 10 Home,15.6\" FHD (1920x1080), 144Hz, IPS-Level,NVIDIA® GeForce RTX™ 2070 with 8GB GDDR6,DDR4-2666\r\n', 6),
(29, 11, 'LIFEBOOK', '1574624501-LIFEBOOK.jpg', 18800, 10, '', 'Windows 10 Pro,Intel® Core™ i7-8665U Processor (Quad Cores, 8M Cache, 1.9 GHz, up to 4.80 GHz),Up to 16 GB LPDDR3-2133 (on board),,SSD SATA, 256 GB / 512 GB, M.2,13.3” FHD (1,920 x 1,080), antiglare, touch, UWVA, 1000:1, 400cd/m2,Intel® UHD Graphics 620\r\n', 6),
(30, 16, 'Laptop Air', '1574624591-Laptop Air.jpg', 4880, 10, '', '\"6th Generation Intel® Core™ m3 Processor\r\nIntel® HD Graphics 515\r\n4GB RAM / 128GB SATA SSD\"', 6),
(31, 14, 'Surface Laptop 3', '1574624641-Surface Laptop 3.jpg', 9888, 10, '', '3580U/ 128GB / 8GB RAM\r\n', 6),
(32, 14, 'Surface Pro 7', '1574624668-Surface Pro 7.jpg', 5988, 10, '', 'Intel Core i3 / 128GB / 4GB RAM\r\n', 6),
(33, 19, 'MSP432P4011IRGCT', '1574625275-MSP432P4011IRGCT.jpg', 98.15, 100, '', 'SimpleLink Ultra-Low-Power 32-Bit Arm Cortex-M4F MCU with Precision ADC, 2MB Flash and 256KB RAM', 11),
(34, 19, 'MSP432P411VTPZ', '1574625707-MSP432P411VTPZ.jpg', 101.4, 100, '', 'SimpleLink Ultra-Low-Power 32-Bit Arm Cortex-M4F MCU with Precision ADC, 512KB Flash and 128KB RAM ', 11),
(35, 19, 'RM57L843BZWTT', '1574626165-RM57L843BZWTT.jpg', 477.74, 100, '', '16/32 Bit RISC Flash MCU, Arm Cortex-R5F, EMAC ', 11),
(36, 19, 'TMS5704357BZWTQQ1', '1574626565-TMS5704357BZWTQQ1.jpg', 477.82, 100, '', '16/32 Bit RISC Flash MCU, Arm Cortex-R5F, EMAC ', 11),
(37, 19, 'MSP432E401YTPDT', '1574627100-MSP432E401YTPDT.jpg', 147.18, 100, '', 'SimpleLink™ ethernet microcontroller , 1024KB of Flash Memory With 4-Bank Configuration ', 11),
(38, 19, 'TMS5700432BPZQQ1R', '1574627340-TMS5700432BPZQQ1R.jpg', 93.01, 100, '', '16/32 Bit RISC Flash MCU, Arm Cortex-R4, Auto Q-100, Up to 384KB of Program Flash With ECC', 11),
(39, 19, 'TMS5701114CPGEQQ1', '1574671756-TMS5701114CPGEQQ1.jpg', 178.16, 100, '', 'Up to 180-MHz System Clock\r\n1MB of Program Flash With ECC', 11),
(40, 19, 'F28M36P63C2ZWTS', '1574672169-F28M36P63C2ZWTS.jpg', 313.36, 100, '', '125 MHz system clock\r\n1MB of Flash \r\n128KB of RAM ', 11),
(41, 19, 'TM4C123BH6ZRBI', '1574672508-TM4C123BH6ZRBI.jpg', 80.86, 100, '', '32-bit ARM® Cortex™-M4 80-MHz processor core\r\n256 KB single-cycle Flash up to 40 MHz ', 11),
(42, 20, 'SLSTK3301A', '1574687676-SLSTK3301A.jpg', 704.21, 100, '', 'EFM32TG11B520F128GM80 MCU with 128 kB flash and 32 kB RAM', 12),
(43, 20, 'EFM32ZG-STK3200', '1574687797-EFM32ZG-STK3200.jpg', 782.46, 99, '', 'EFM32ZG222F32 MCU with 32 KB Flash and 4 KB RAM', 12),
(44, 20, 'EFM32WG-DK3850', '1574687954-EFM32WG-DK3850.jpg', 2730.8, 100, '', 'EFM32WG990F256 MCU with 256 kB flash and 32 kB SRAM', 12),
(45, 20, 'EFM32G-DK3550', '1574688179-EFM32G-DK3550.jpg', 2347.39, 100, '', 'EFM32G890F128 MCU with 128 kB flash and 16 kB RAM', 12),
(46, 20, 'EFM32-G8XX-STK', '1574693408-EFM32-G8XX-STK.jpg', 782.46, 100, '', 'EFM32G890F128 MCU with 128 kB flash and 16 kB RAM', 12),
(47, 20, 'SLSTK3400A', '1574693713-SLSTK3400A.jpg', 782.46, 100, '', 'EFM32HG322F64 with 64 kB Flash and 8 kB RAM', 12),
(48, 4, 'Flagship Pro', '1574703119-Flagship Pro.jpg', 1500, 10, '', 'Core I5 Up to 3.6GHz、8GB、512GB SSD、WiFi、DVD、DP、VGA、USB 3.0、Windows 10 Pro 64 Bit-Multi Language\r\n', 5),
(49, 5, 'ALIENWARE AURORA GAMING DESKTOP', '1574703186-ALIENWARE AURORA GAMING DESKTOP.jpg', 6400, 10, '', '9th Gen Intel® Core™ i5 9400,Windows 10 Home 64bit English,NVIDIA GeForce GTX 1660 with 6GB GDDR5,8GB DDR4 at 2666MHz; up to 64GB,1TB 7200RPM SATA 6Gb/s HDD', 5),
(50, 3, '21.5\" iMac with Retina 4K Display', '1574703242-21.5_ iMac with Retina 4K Display.jpeg', 8000, 10, '', '\"3.0 GHz Intel Core i5 Quad-Core,8GB of DDR4 RAM, 1TB Hard Drive\r\n21.5\"\" 4096 x 2304 IPS Retina 4K Display,AMD Radeon Pro 555 Graphics Card (2GB)\"', 5),
(51, 14, 'Surface Studio 2', '1574703307-Surface Studio 2.jpg', 28000, 10, '', 'Intel Core 7th Gen i7,28” PixelSense Display,16GB or 32GB (DDR4),Windows 10 Pro', 5),
(52, 6, 'Yoga A940 27\"', '1574703473-Yoga A940 27_.jpg', 25000, 10, '', 'Intel Core i5-8400T with TURBO BOOST to 3.30GHz,32 GB of RAM (ULTRA performance); up to 10GB graphics RAM,2 TB SSD (MASSIVE pure ssd); QI Wireless Charging;,27\" Ultra HD 4K 10-point MULTI-TOUCH tilting screen with pen support', 5),
(53, 5, 'Inspiron 24 5000 Series Touch', '1574703606-Inspiron 24 5000 Series Touch.png', 9000, 10, '', '10th Generation Intel® Core™ i5-10210U Processor (6MB Cache, up to 1.6 GHz),Windows 10 Home, 64-bit, English,(Dell recommends Windows 10 Pro for business),Intel® UHD Graphics 620 with shared graphics memory,12GB (8Gx1 + 4Gx1) DDR4, 2666MHz,1TB 7200 rpm 2.5\" SATA Hard Drive', 5),
(54, 5, 'OptiPlex 7760', '1574703732-OptiPlex 7760.jpg', 7500, 10, '', 'Intel Core™ i5-8500,Windows 10 Pro 64bit English,NVIDIA GeForce GTX 1050, 4GB,128GB SATA Class 20 Solid State Drive,16GB 2X8GB DDR4 2666MHz Non-ECC', 5),
(55, 4, 'Z2 G4 Workstation', '1574703825-Z2 G4 Workstation.jpg', 7200, 10, '', 'Windows 10 Pro,9th Generation Intel® Core™ i3 processor,4 GB memory,500 GB HDD storage,Intel® UHD Graphics 630', 5),
(56, 3, 'iMac Pro 27\"', '1574704327-iMac Pro 27_.jpeg', 36000, 10, '', '8-Core 3.2GHz Intel Xeon W,5K\r\nRetina display,Radeon Pro Vega 56 graphics processor,32GB of 2666MHz DDR4 ECC memory,1TB SSD', 5),
(57, 3, 'Mac mini 1', '1574704961-Mac mini 1.jpg', 5500, 10, '', 'Quad-core i3 8th-Generation Intel Core Processor ,Intel UHD Graphics 630,8GB 2666MHz DDR4,Ultrafast SSD storage', 5),
(58, 6, 'ThinkCentre M720 Tiny', '1574705026-ThinkCentre M720 Tiny.jpg', 2900, 10, '', 'Intel Pentium Gold G5400T (3.10GHz, 4MB Cache),Windows 10 Home 64,4GB DDR4 2666MHz,500GB Hard Disk Drive, 7200rpm, 2.5\", SATA3', 5),
(59, 2, 'Aspire Z3', '1574705339-Aspire Z3.png', 3200, 10, '', 'Windows 10 Home,Intel® Pentium® J3710 processor Quad-core 1.60 GHz,Full HD (1920 x 1080) 16:9,Intel® HD Graphics 405 with Shared Memory,4 GB, DDR3 SDRAM,128 GB SSD,30-day Microsoft Office trial included', 5),
(60, 21, 'CORSAIR ONE i160 Compact Gaming PC', '1574706455-CORSAIR ONE i160 Compact Gaming PC.png', 27300, 10, '', 'Intel Core i9-9900K, NVIDIA GeForce RTX 2080 Ti,  2x16GB DDR4-2666, 480GB M.2 NVMe SSD\r\n2TB 5400RPM 2.5” HDD,  Windows 10 Home', 5),
(61, 22, 'Starter PC', '1574706586-Starter PC.jpg', 7200, 10, '', 'Intel Pentium Gold G5400T (3.10GHz, 4MB Cache),Windows 10 Home 64,4GB DDR4 2666MHz,500GB Hard Disk Drive, 7200rpm, 2.5\", SATA3', 5),
(62, 23, 'EK-RA2A1', '1574712412-EK-RA2A1.jpg', 469.64, 100, '', 'R7FA2A1AB3CFM MCU\r\n48MHz, 256kB Code Flash, 32kB SRAM', 13),
(63, 23, 'EK-RA6M1', '1574712959-EK-RA6M1.jpg', 469.64, 100, '', '120MHz, Arm Cortex-M4 core\r\n512KB Code Flash, 256KB SRAM ', 13),
(64, 23, 'EK-RA6M3', '1574714949-EK-RA6M3.jpg', 968.47, 100, '', '120MHz, Arm Cortex M4 core\r\n2MB Code Flash, 640kB SRAM', 13),
(65, 23, 'EK-RA6M3G', '1574715063-EK-RA6M3G.jpg', 1271.73, 100, '', '120MHz, Arm Cortex-M4 core\r\n2MB Code Flash, 640kB SRAM', 13),
(66, 23, 'R7FA6M2AF3CFP', '1574715537-R7FA6M2AF3CFP.jpg', 93.91, 100, '', '120 MHz, 1024 KB Flash memory, 384 KB RAM', 13),
(67, 23, 'R7FA6M1AD3CFP', '1574716101-R7FA6M1AD3CFP.jpg', 80.6, 100, '', '120 MHz, 512 KB Flash memory, 256 KB RAM', 13),
(68, 23, 'R7FA6M3AH3CFB', '1574716325-R7FA6M3AH3CFB.jpg', 117.5, 100, '', '120 MHz, 2048 KB Flash memory, 640 KB RAM', 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING HASH,
  ADD KEY `account_country_fk` (`country`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_buyer_fk` (`buyer`),
  ADD KEY `cart_product_fk` (`product`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_parent_fk` (`parent`) USING BTREE;

--
-- Indexes for table `category_pressed_time`
--
ALTER TABLE `category_pressed_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_pressed_time_category_fk` (`category`),
  ADD KEY `category_pressed_time_user_fk` (`user`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_made`
--
ALTER TABLE `order_made`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_cart_fk` (`cart`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_seller_fk` (`seller`),
  ADD KEY `product_category_fk` (`category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category_pressed_time`
--
ALTER TABLE `category_pressed_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `order_made`
--
ALTER TABLE `order_made`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_country_fk` FOREIGN KEY (`country`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_buyer_fk` FOREIGN KEY (`buyer`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_product_fk` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`parent`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_pressed_time`
--
ALTER TABLE `category_pressed_time`
  ADD CONSTRAINT `category_pressed_time_category_fk` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_pressed_time_user_fk` FOREIGN KEY (`user`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_made`
--
ALTER TABLE `order_made`
  ADD CONSTRAINT `order_cart_fk` FOREIGN KEY (`cart`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_fk` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_seller_fk` FOREIGN KEY (`seller`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
