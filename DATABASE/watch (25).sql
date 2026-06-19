-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2025 at 04:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watch`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(50) NOT NULL,
  `a_fnm` varchar(50) DEFAULT NULL,
  `a_email` varchar(50) DEFAULT NULL,
  `a_mn` int(10) DEFAULT NULL,
  `a_pass` varchar(10) DEFAULT NULL,
  `a_time` int(255) DEFAULT NULL,
  `a_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_fnm`, `a_email`, `a_mn`, `a_pass`, `a_time`, `a_status`) VALUES
(1, 'bhavik', 'abc@gmail.com', 2147483647, '123456', 1749660747, 1),
(2, 'abc', 'abc@gmail.com', 2147483647, '456789', 1750313120, 1),
(4, 'nikhil', 'nikhil@gmail.com', 1234567890, '159632', 1759949969, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`b_id`, `b_name`, `time`, `status`) VALUES
(1, 'titan', '2025-09-11 18:18:22', 1),
(2, 'rolax', '2025-09-11 18:18:39', 1),
(6, 'TIMEX', '2025-10-29 17:00:31', 1),
(7, 'RADO', '2025-10-29 17:28:48', 1),
(8, 'Citizen', '2025-10-31 17:35:57', 1),
(9, 'Versace', '2025-10-31 17:49:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(17, 2, 12, 200, '2025-10-29 17:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `c_id` int(11) NOT NULL,
  `c_nm` varchar(100) NOT NULL,
  `c_des` text DEFAULT NULL,
  `c_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`c_id`, `c_nm`, `c_des`, `c_time`, `c_status`) VALUES
(3, 'Luxury', 'Premium craftsmanship and elegant detailing.', '2025-09-07 05:31:23', 'Active'),
(7, 'Vintage', 'Old-school charm with retro looks', '2025-09-11 12:26:55', 'Active'),
(9, 'casual', 'Everyday wear watches, comfortable and stylish.', '2025-10-08 18:03:23', 'Active'),
(10, 'Formal', 'Elegant and minimal for office or events', '2025-10-08 18:04:06', 'Active'),
(11, 'Classic', 'Timeless designs with simple dials and leather straps.', '2025-10-08 18:04:32', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'bhavik', 'abc@gmail.come', 'watch', 'it is many issues in service so fixed it', '2025-10-28 18:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `pin` varchar(20) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `shipping` decimal(10,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `name`, `email`, `mobile`, `address`, `city`, `pin`, `subtotal`, `shipping`, `total`, `status`, `created_at`) VALUES
(1, 1, 'bhavik', 'abc@gmail.come', '9979035757', 'nhdncgfkeosjxbgf', 'rajkot', '360007', 14999.00, 50.00, 15049.00, 'completed', '2025-10-18 12:21:43'),
(2, 1, 'bhavik', 'abc@gmail.come', '1234567890', 'nbvcxkjhgfd', 'rajkot', '360007', 29999.00, 50.00, 30049.00, 'confirmed', '2025-10-18 12:28:39'),
(3, 1, 'bhavik', 'abc@gmail.come', '9979035757', 'cftgvbhyjnb', 'rajkot', '360007', 37000.00, 50.00, 37050.00, 'pending', '2025-10-18 12:32:15'),
(4, 1, 'bhavik', 'abc@gmail.come', '9979035757', 'hfbvhdhwhd', 'rajkot', '360007', 14999.00, 50.00, 15049.00, 'pending', '2025-10-18 12:35:19'),
(5, 2, 'bhavik', 'abc@gmail.come', '9979035757', 'bhuikjn', 'rajkot', '360007', 464999.00, 50.00, 465049.00, 'pending', '2025-10-29 17:06:28'),
(6, 1, 'bhavik', 'abc@gmail.come', '9979035757', 'zxcvbnm,asdfghjkl;qwertyuio', 'rajkot', '360007', 20000.00, 50.00, 20050.00, 'completed', '2025-11-03 04:18:47'),
(7, 1, 'bhavik', 'abc@gmail.come', '9979035757', 'Gandhigram  st. no 7 Rajkot', 'rajkot', '360007', 179000.00, 50.00, 179050.00, 'pending', '2025-11-05 15:00:40'),
(8, 1, 'bhavik', 'abc@gmail.come', '9979035757', 'Harivandana College, Rajkot, Gujarat ', 'rajkot', '360007', 230000.00, 50.00, 230050.00, 'pending', '2025-11-05 15:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`) VALUES
(1, 1, 9, 'Titan Workwear Multifunction Black Round Dial Black Metal Strap Watch', 14999.00, 1),
(2, 2, 9, 'Titan Workwear Multifunction Black Round Dial Black Metal Strap Watch', 14999.00, 1),
(3, 2, 7, 'Titan Maritime Pro Lateen Sail Chronograph Watch', 15000.00, 1),
(4, 3, 5, 'Xylys Quartz Chronograph Blue Dial Silver Stainless Steel Strap Watch', 30000.00, 1),
(5, 3, 8, 'Titan Workwear Multifunction Black Dial Black Metal Strap Watch', 7000.00, 1),
(6, 4, 9, 'Titan Workwear Multifunction Black Round Dial Black Metal Strap Watch', 14999.00, 1),
(7, 5, 12, 'TIMEX Easy Reader Classic White Round Dial Analog Mens Watch - TW2W52100JQ', 9000.00, 50),
(8, 5, 9, 'Titan Workwear Multifunction Black Round Dial Black Metal Strap Watch', 14999.00, 1),
(9, 6, 18, 'Titan Ceramic Fusion', 20000.00, 1),
(10, 7, 12, 'TIMEX Easy Reader Classic White Round Dial Analog Mens Watch - TW2W52100JQ', 9000.00, 1),
(11, 7, 18, 'Titan Ceramic Fusion', 20000.00, 1),
(12, 7, 19, 'Versace GRECA LOGO-VI', 150000.00, 1),
(13, 8, 18, 'Titan Ceramic Fusion', 20000.00, 4),
(14, 8, 19, 'Versace GRECA LOGO-VI', 150000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `main_image` varchar(255) DEFAULT NULL,
  `gallery_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery_images`)),
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `average_rating` decimal(2,1) DEFAULT 0.0,
  `review_count` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `short_description`, `description`, `price`, `stock`, `main_image`, `gallery_images`, `category_id`, `brand_id`, `average_rating`, `review_count`, `status`, `time`) VALUES
(5, 'Xylys Quartz Chronograph Blue Dial Silver Stainless Steel Strap Watch', 'Xylys Quartz Chronograph Blue Dial Silver Stainless Steel Strap Watch Xylys Quartz Chronograph Blue Dial Silver Stainless Steel Strap Watch Xylys Quartz Chronograph Blue Dial Silver Stainless Steel Strap Watch', 'Xylys Quartz Chronograph Blue Dial Silver Stainless Steel Strap Watch Xylys Quartz Chronograph Blue Dial Silver Stainless Steel Strap Watch Xylys Quartz Chronograph Blue Dial Silver Stainless Steel Strap Watch Xylys Quartz Chronograph Blue Dial Silver Stainless Steel Strap Watch Xylys Quartz Chronograph Blue Dial Silver Stainless Steel Strap Watch Xylys Quartz Chronograph Blue Dial Silver Stainless Steel Strap Watch Xylys Quartz Chronograph Blue Dial Silver Stainless Steel Strap Watch', 30000.00, 500, '1759943243_45025SM02E_1.webp', '[\"1759943243_45025SM02E_2.webp\",\"1759943243_45025SM02E_3.webp\",\"1759943243_45025SM02E_4.webp\",\"1759943243_45025SM02E_5.webp\"]', 3, 1, 5.0, 1000, 'active', '2025-10-08 17:07:23'),
(7, 'Titan Maritime Pro Lateen Sail Chronograph Watch', 'Titan Mens Maritime Pro Lateen Sail Chronograph Watch Titan Mens Maritime Pro Lateen Sail Chronograph Watch Titan Mens Maritime Pro Lateen Sail Chronograph Watch Titan Mens Maritime Pro Lateen Sail Chronograph Watch', 'Titan Mens Maritime Pro Lateen Sail Chronograph Watch Titan Mens Maritime Pro Lateen Sail Chronograph Watch Titan Mens Maritime Pro Lateen Sail Chronograph Watch Titan Mens Maritime Pro Lateen Sail Chronograph Watch Titan Mens Maritime Pro Lateen Sail Chronograph Watch Titan Mens Maritime Pro Lateen Sail Chronograph Watch Titan Mens Maritime Pro Lateen Sail Chronograph Watch', 15000.00, 2000, '1759947178_1830KL02_1.webp', '[\"1759947178_1830KL02_2.webp\",\"1759947178_1830KL02_3.webp\",\"1759947178_1830KL02_4.webp\",\"1759947178_1830KL02_5.webp\"]', 9, 1, 5.0, 5000, 'active', '2025-10-08 18:12:58'),
(8, 'Titan Workwear Multifunction Black Dial Black Metal Strap Watch', 'Titan Workwear Multifunction Black Dial Black Metal Strap Watch Titan Workwear Multifunction Black Dial Black Metal Strap Watch Titan Workwear Multifunction Black Dial Black Metal Strap Watch', 'Titan Workwear Multifunction Black Dial Black Metal Strap Watch Titan Workwear Multifunction Black Dial Black Metal Strap Watch Titan Workwear Multifunction Black Dial Black Metal Strap Watch Titan Workwear Multifunction Black Dial Black Metal Strap Watch Titan Workwear Multifunction Black Dial Black Metal Strap Watch Titan Workwear Multifunction Black Dial Black Metal Strap Watch', 7000.00, 500, '1759947491_1805NM02_1.jpg', '[\"1759947491_1805NM02_2.webp\",\"1759947491_1805NM02_4.webp\",\"1759947491_1805NM02_5.webp\",\"1759947491_1805NM02_6.webp\"]', 9, 1, 4.0, 2000, 'active', '2025-10-08 18:18:11'),
(9, 'Titan Workwear Multifunction Black Round Dial Black Metal Strap Watch', 'Titan Workwear Multifunction Black Round Dial Black Metal Strap Watch Titan Workwear Multifunction Black Round Dial Black Metal Strap Watch', 'Titan Workwear Multifunction Black Round Dial Black Metal Strap Watch Titan Workwear Multifunction Black Round Dial Black Metal Strap Watch Titan Workwear Multifunction Black Round Dial Black Metal Strap Watch Titan Workwear Multifunction Black Round Dial Black Metal Strap Watch Titan Workwear Multifunction Black Round Dial Black Metal Strap Watch', 14999.00, 1000, '1759948012_1805NM01_1.webp', '[\"1759948012_1805NM01_2.webp\",\"1759948012_1805NM01_4.webp\",\"1759948012_1805NM01_5.webp\"]', 10, 1, 0.0, 0, 'active', '2025-10-08 18:26:52'),
(10, 'Titan Workwear Blue Dial Quartz Multifunction Stainless Steel Strap watch', 'Titan Workwear Blue Dial Quartz Multifunction Stainless Steel Strap watch Titan Workwear Blue Dial Quartz Multifunction Stainless Steel Strap watch ', 'Titan Workwear Blue Dial Quartz Multifunction Stainless Steel Strap watch Titan Workwear Blue Dial Quartz Multifunction Stainless Steel Strap watch Titan Workwear Blue Dial Quartz Multifunction Stainless Steel Strap watch Titan Workwear Blue Dial Quartz Multifunction Stainless Steel Strap watch', 7999.00, 700, '1759948255_1769SM01_1.webp', '[\"1759948255_1769SM01_2.webp\",\"1759948255_1769SM01_4.webp\",\"1759948255_1769SM01_5.jpg\"]', 9, 1, 4.2, 400, 'active', '2025-10-08 18:30:55'),
(12, 'TIMEX Easy Reader Classic White Round Dial Analog Mens Watch - TW2W52100JQ', 'best watch is segment', 'Our Oversized Easy Reader® is our largest Easy Reader® to date, built with a 40mm case that’s as timeless as it is durable. Its easy-to-read, high-contrast dial appears in white, while our two-tone stainless-steel Perfect Fit™ expansion band allows you to easily adjust its proportions based on the size of your wrist.  Other details include a date window, INDIGLO® backlight, and 30m of water resistance. ', 9000.00, 200, '1761757401_TW2W52100_670x.webp', '[\"1761757401_TW2W52100_B_363x.webp\",\"1761757401_TW2W52100_C_363x.webp\",\"1761757401_TW2W52100_D_363x.webp\",\"1761757401_TW2W52100_E_363x.webp\"]', 11, 6, 0.0, 0, 'active', '2025-10-29 17:03:21'),
(13, 'TIMEX Waterbury Classic 40mm Leather Strap Watch', 'We have looked to our past, and we are paying homage to our original watch collection by using the Waterbury Watch Company logo on the dial and second hand, which bears the stylized W. Each watch displays our attention to craftsmanship and detail, with finely finished surfaces and careful applications of watchmaking ingenuity.', '\r\nWe have looked to our past, and we are paying homage to our original watch collection by using the Waterbury Watch Company logo on the dial and second hand, which bears the stylized W. Each watch displays our attention to craftsmanship and detail, with finely finished surfaces and careful applications of watchmaking ingenuity. Featuring a 40mm stainless-steel case; a navy blue dial with Roman numerals; and a more casual brown natural leather strap with quick release spring bars; our Waterbury Classic unites all of these elements into something thats right for your wrist today, and right for all the days to come.', 15000.00, 500, '1761758237_TW2W14900_670x.webp', '[\"1761758237_TW2W14900_B_363x.webp\",\"1761758237_TW2W14900_C_363x.webp\",\"1761758237_TW2W14900_D_363x.webp\",\"1761758237_TW2W14900_E_363x.webp\"]', 11, 6, 0.0, 0, 'active', '2025-10-29 17:17:17'),
(14, 'TIMEX Waterbury Classic Chronograph 40mm Leather Strap Watch', 'We have looked to our past, and We’ve paying homage to our original watch collection by using the Waterbury Watch Company logo on the dial and second hand, which bears the stylized W. Each watch displays our attention to craftsmanship and detail, with finely-finished surfaces and careful applications of watchmaking ingenuity', 'We have looked to our past, and We’ve paying homage to our original watch collection by using the Waterbury Watch Company logo on the dial and second hand, which bears the stylized W. Each watch displays our attention to craftsmanship and detail, with finely-finished surfaces and careful applications of watchmaking ingenuity. Featuring a gunmetal stainless-steel case and gold accents, a classic navy dial with Roman numerals and a rich tan natural leather strap, our Waterbury Classic Chronograph unites all of these elements into something that delivers function just as well as form.', 20000.00, 250, '1761758365_TW2U88200_670x.webp', '[\"1761758365_TW2U88200_B_363x.webp\",\"1761758365_TW2U88200_C_363x.webp\",\"1761758365_TW2U88200_D_363x.webp\",\"1761758365_TW2U88200_I_363x.webp\"]', 11, 6, 0.0, 0, 'active', '2025-10-29 17:19:25'),
(15, 'RADO Captain Cook High-Tech Ceramic Automatic Chronograph', 'Precision forged through extreme engineering—the Captain Cook High-Tech Ceramic Chronograph is the result of uncompromising processes and material innovation.', 'In outdoor pursuits, at-a-glance accuracy is essential, and that comes easy with substantial hour and minute hands that point to equally purposeful indexes – all of which are finished with white Super LumiNova®. The second, minute and hour chronograph hands all sport a painted red tip for easy identification. Overall, the dial feels supremely well balanced, with its three subdials lending an unmistakeable sense of energy – a chrono hour counter is a new addition to Captain Cook chronographs. Rado’s moving anchor symbol is at 12 o’clock, rotating on a synthetic ruby backplate, and there’s a trapezoidal date window at 6 o’clock shaped to match the indexes. Around the edge runs a subtle minute track, surrounded by a turning bezel with deliberately spartan engraved markings. Collectively, it’s all a brilliant demonstration of ‘less is more’ – which helps explain why the piece never feels too energetic. This approach also applies to the Rado calibre R801 automatic movement, featuring a 59-hour power reserve, whose svelte dimensions mean the height of the case, including the crystal, measures just 16.2mm – making it easy to accessorise an outfit.', 500000.00, 10, '1761759053_captaincook_r32190153_sld_web_1.avif', '[\"1761759053_captaincook_r32190153_a_1.avif\",\"1761759053_captaincook_r32190153_b_1.avif\",\"1761759053_captaincook_r32190153_c_1.avif\",\"1761759053_captaincook_r32190153_d_1.avif\"]', 3, 7, 0.0, 0, 'active', '2025-10-29 17:30:53'),
(16, 'RADO Captain Cook Automatic', 'An original look from 1962 is brought to life in a new and improved form for the twenty-first century.', 'An original look from 1962 is brought to life in a new and improved form for the twenty-first century. With vintage details and styling true to the original, and up-to-date features that make it a match for modern wearers, Captain Cook is a watch designed to stand the test of time. The Captain Cook benefits from Rado’s EasyClip System which allows you to change the bracelet or strap quickly and easily without the need for any tools.', 250000.00, 25, '1761759413_rgb_cat_hyperchrome_763_0505_3_031_hres_4.avif', '[\"1761759413_captaincook_0176305053031_r32505313_a_3.avif\",\"1761759413_captaincook_0176305053031_r32505313_c_3.avif\",\"1761759413_captaincook_r32505313_wrist_a.avif\"]', 7, 7, 0.0, 0, 'active', '2025-10-29 17:36:53'),
(17, 'Citizen Automatic Tsuyosa', 'Introducing Citizen watch NJ0154-80H, a premium timepiece from the Citizen watches for Men & from collection AUTOMATIC TSUYOSA.', 'Introducing Citizen watch NJ0154-80H, a premium timepiece from the Citizen watches for Men & from collection AUTOMATIC TSUYOSA. This brand hailing from Japan, this time piece exemplifies the quality found across Citizen watches, featuring Automatic movement and a durable Sapphire Crystal. Its distinctive Stainless Steel with two tone rose gold Plating case adds a modern touch, while offering water resistance up to 50 m. The Analog dial ensures timeless elegance, backed by a 24 Months warranty for your peace of mind.', 35000.00, 200, '1761932289_nj0154-80h_1.jpg', '[\"1761932289_nj0154-80h_2.jpg\",\"1761932289_nj0154-80h_3.jpg\"]', 10, 8, 0.0, 0, 'active', '2025-10-31 17:38:09'),
(18, 'Titan Ceramic Fusion', 'Introducing Titan watch 90148KD01, a premium timepiece from the Titan watches for Men & from collection CERAMIC FUSION.', 'Introducing Titan watch 90148KD01, a premium timepiece from the Titan watches for Men & from collection CERAMIC FUSION. This brand hailing from India, this time piece exemplifies the quality found across Titan watches, featuring Quartz movement and a durable Mineral Glass. Its distinctive Stainless Steel case adds a modern touch, while offering water resistance up to 50 m. The Analog dial ensures timeless elegance, backed by a 24 Months warranty for your peace of mind.', 20000.00, 500, '1761932847_90148kd01_1_3.jpg', '[\"1761932847_90148kd01_3_1.jpg\",\"1761932847_90148kd01_4_1.jpg\",\"1761932847_90148kd01_5_1.jpg\"]', 10, 1, 0.0, 0, 'active', '2025-10-31 17:47:27'),
(19, 'Versace GRECA LOGO-VI', 'Introducing Versace watch VEVI00420, a premium timepiece from the Versace watches for Men & from collection GRECA LOGO-VI. This brand hailing from Italy, this time piece exemplifies the quality found across Versace watches, featuring Quartz movement and a durable Sapphire Crystal.', 'Introducing Versace watch VEVI00420, a premium timepiece from the Versace watches for Men & from collection GRECA LOGO-VI. This brand hailing from Italy, this time piece exemplifies the quality found across Versace watches, featuring Quartz movement and a durable Sapphire Crystal. Its distinctive Stainless Steel case adds a modern touch, while offering water resistance up to 50 m. The Analog dial ensures timeless elegance, backed by a 24 Months warranty for your peace of mind. With this we would also like to highlight the essence of Versace Greca. With its bold green dial and stylish markers, this watch is perfect for those who want their watch to make a fashion statement. The bicolor bracelet with butterfly buckle adds a luxurious touch, while the sapphire crystal and 50m water resistance ensure durability.', 150000.00, 15, '1761933095_vevi00420_1.jpg', '[\"1761933095_vevi00420_2.jpg\",\"1761933095_vevi00420_3.jpg\",\"1761933095_vevi00420_4.jpg\"]', 3, 9, 0.0, 0, 'active', '2025-10-31 17:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(1, 9, 1, 4, 'this is best product', '2025-10-27 23:35:50'),
(2, 9, 2, 5, 'that is very very best watch👌', '2025-10-27 23:38:05'),
(3, 10, 1, 1, 'this is best watch i can buy', '2025-10-28 00:06:53'),
(4, 10, 1, 5, 'this is value for money watch all time', '2025-10-28 00:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `business_address` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email_address` varchar(150) DEFAULT NULL,
  `website_logo` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `business_address`, `phone_number`, `email_address`, `website_logo`, `facebook_url`, `twitter_url`, `instagram_url`, `created_at`, `updated_at`) VALUES
(1, 'Timecore', 'aaaaaaaaaaaa bbbbbbbbbbbbbbb ccccccccccc ddddddddddd', '1234567890', 'abc@gmail.com', '1761742605_logo1.png', 'https://www.facebook.com/', 'https://x.com/i/flow/login', 'https://www.instagram.com/', '2025-10-29 12:25:48', '2025-10-29 12:56:56');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `button_text` varchar(50) DEFAULT 'Shop Now',
  `button_link` varchar(255) DEFAULT 'product.php',
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `title`, `subtitle`, `button_text`, `button_link`, `status`, `created_at`) VALUES
(14, '1760125135_watch4.png', 'Timecore', 'Time That Defines You', 'Shop Now', 'product.php', 1, '2025-10-10 19:38:55'),
(15, '1760125373_watch3.jpg', 'timecore', 'Time is at the heart of everything', 'Shop Now', 'product.php', 1, '2025-10-10 19:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(100) NOT NULL,
  `u_fnm` varchar(50) DEFAULT NULL,
  `u_mn` int(10) DEFAULT NULL,
  `u_email` varchar(50) DEFAULT NULL,
  `u_pass` varchar(10) NOT NULL,
  `u_time` int(255) DEFAULT NULL,
  `u_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_fnm`, `u_mn`, `u_email`, `u_pass`, `u_time`, `u_status`) VALUES
(1, 'bhavik chauhan', 2147483647, 'abc@gmail.com', '123456', 1748670295, 1),
(2, 'nikhil sarvaiya', 2147483647, 'abc@gmail.com', '159632', 1760121912, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `visited_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_product` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
