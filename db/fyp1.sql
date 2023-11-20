-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: Feb 28, 2023 at 06:42 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_uname` varchar(50) NOT NULL,
  `admin_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_uname`, `admin_pass`) VALUES
(1, 'admin', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `pd_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `subtotal` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cust_id`, `shop_id`, `pd_id`, `quantity`, `subtotal`) VALUES
(199, 17, 7, 24, 1, '7.30'),
(215, 10, 10, 46, 1, '18.00'),
(216, 10, 9, 35, 1, '7.30');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(5) NOT NULL,
  `cust_name` varchar(50) NOT NULL,
  `cust_email` varchar(255) NOT NULL,
  `cust_username` varchar(30) NOT NULL,
  `cust_pwd` varchar(30) NOT NULL,
  `cust_no` varchar(12) DEFAULT NULL,
  `cust_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_email`, `cust_username`, `cust_pwd`, `cust_no`, `cust_address`) VALUES
(10, 'Idah', 'alid@gmail.com', 'idahmuhip', '1014', '0191123456', 'Kg Marakau Ranau'),
(13, 'Alya Hannani Roslan', 'hannani@gmail.com', 'alyahan', 'alya1011', '0198207096', 'Kajang'),
(16, 'Nur Farahin', 'farahin@gmail.com', 'farahin', 'farah2910', '019223457', 'Marakau Ranau'),
(17, 'solehah yaakob', 'nsolehah289@gmail.com', 'sossaakob', 'solehah31', '0197249075', 'kota belud'),
(18, 'Asyi', 'asyi@gmail.com', 'asyi', '12345678', '0198818729', 'UCA 2, Block V');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_uname` varchar(30) NOT NULL,
  `emp_pwd` varchar(30) NOT NULL,
  `emp_no` varchar(12) NOT NULL,
  `emp_email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `emp_uname`, `emp_pwd`, `emp_no`, `emp_email`) VALUES
(1, 'Syafiq', 'syafiq12', '12345', '0198818729', 'syafiq@gmail.com'),
(4, 'Fadhlee', 'didi', '020997', '0197652398', 'fadhlee@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fdback_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `ord_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fdback_id`, `cust_id`, `ord_id`, `comment`) VALUES
(13, 13, 94, 'Fast delivery'),
(14, 13, 95, 'Nicee!'),
(15, 16, 126, ' Good'),
(16, 16, 148, 'Good!');

-- --------------------------------------------------------

--
-- Table structure for table `ordination`
--

CREATE TABLE `ordination` (
  `ord_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `ord_date` datetime NOT NULL,
  `ord_amt` decimal(18,2) NOT NULL,
  `pay_method` varchar(150) NOT NULL,
  `pay_status` varchar(50) NOT NULL,
  `ord_status` varchar(150) NOT NULL,
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordination`
--

INSERT INTO `ordination` (`ord_id`, `cust_id`, `ord_date`, `ord_amt`, `pay_method`, `pay_status`, `ord_status`, `emp_id`) VALUES
(94, 13, '2023-01-11 00:39:21', '12.80', 'Cash on Delivery', 'Paid', 'Completed', 1),
(95, 13, '2023-01-23 21:07:18', '7.30', 'Cash on Delivery', '', 'Delivering', 1),
(96, 13, '2023-01-24 16:49:09', '5.50', 'Cash on Delivery', 'Paid', 'Completed', 1),
(126, 16, '2023-01-27 04:23:20', '15.50', 'QrCode', 'Paid', 'Completed', 1),
(143, 13, '2023-02-04 16:47:37', '72.50', 'Paypal', 'Paid', 'Completed', 4),
(146, 16, '2023-02-04 20:42:40', '79.80', 'Cash on Delivery', 'Pending', 'Canceled', 0),
(147, 16, '2023-02-04 20:44:54', '29.00', 'QrCode', 'Pending', 'Canceled', 0),
(148, 16, '2023-02-04 20:46:31', '22.00', 'Paypal', 'Paid', 'Completed', 4),
(150, 10, '2023-02-04 21:14:05', '18.00', 'Paypal', 'Pending', 'Pending', 0),
(151, 10, '2023-02-04 21:17:00', '7.30', 'Paypal', 'Pending', 'Pending', 0),
(152, 10, '2023-02-04 21:18:38', '18.00', 'Paypal', 'Pending', 'Pending', 0),
(153, 10, '2023-02-04 21:20:32', '25.30', 'Paypal', 'Pending', 'Pending', 0),
(156, 16, '2023-02-28 13:19:53', '18.00', 'Paypal', 'Paid', 'Completed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ord_product`
--

CREATE TABLE `ord_product` (
  `row_id` int(11) NOT NULL,
  `pd_id` int(11) NOT NULL,
  `ord_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `ord_date` datetime NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ord_product`
--

INSERT INTO `ord_product` (`row_id`, `pd_id`, `ord_id`, `cust_id`, `ord_date`, `quantity`) VALUES
(132, 42, 94, 13, '2023-01-11 00:39:21', 1),
(133, 35, 94, 13, '2023-01-11 00:39:21', 1),
(134, 24, 95, 13, '2023-01-23 21:07:18', 1),
(135, 42, 96, 13, '2023-01-24 16:49:09', 1),
(172, 42, 126, 16, '2023-01-27 04:23:20', 1),
(173, 26, 126, 16, '2023-01-27 04:23:20', 1),
(194, 37, 143, 13, '2023-02-04 16:47:37', 5),
(195, 24, 144, 16, '2023-02-04 20:34:33', 1),
(196, 37, 144, 16, '2023-02-04 20:34:33', 5),
(197, 24, 145, 16, '2023-02-04 20:40:00', 1),
(198, 24, 146, 16, '2023-02-04 20:42:40', 1),
(199, 37, 146, 16, '2023-02-04 20:42:40', 5),
(200, 46, 147, 16, '2023-02-04 20:44:54', 1),
(201, 50, 147, 16, '2023-02-04 20:44:54', 1),
(202, 42, 148, 16, '2023-02-04 20:46:31', 4),
(203, 46, 149, 10, '2023-02-04 21:13:32', 1),
(204, 46, 150, 10, '2023-02-04 21:14:05', 1),
(205, 35, 151, 10, '2023-02-04 21:17:00', 1),
(206, 46, 152, 10, '2023-02-04 21:18:38', 1),
(207, 46, 153, 10, '2023-02-04 21:20:32', 1),
(208, 35, 153, 10, '2023-02-04 21:20:32', 1),
(212, 51, 156, 16, '2023-02-28 13:19:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL,
  `ord_id` int(11) NOT NULL,
  `bank_type` varchar(150) NOT NULL,
  `ref_no` varchar(255) NOT NULL,
  `total_payment` decimal(18,2) NOT NULL,
  `paySlip` varchar(255) NOT NULL,
  `payDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `ord_id`, `bank_type`, `ref_no`, `total_payment`, `paySlip`, `payDate`) VALUES
(30, 126, 'CimbClicks', '1233412', '15.50', 'img/transaction/681782869.pdf', '2023-01-27 04:23:28'),
(31, 126, 'CimbClicks', '1233412', '15.50', 'img/transaction/681782869.pdf', '2023-01-27 04:23:28'),
(32, 147, 'CimbClicks', 'demo1234', '29.00', 'img/transaction/transaction.jpeg', '2023-02-04 20:45:05'),
(33, 147, 'CimbClicks', 'demo1234', '29.00', 'img/transaction/transaction.jpeg', '2023-02-04 20:45:05'),
(34, 154, 'CimbClicks', 'demo1234', '33.00', 'img/transaction/transaction.jpeg', '2023-02-04 23:26:16'),
(35, 154, 'CimbClicks', 'demo1234', '33.00', 'img/transaction/transaction.jpeg', '2023-02-04 23:26:16');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pd_id` int(5) NOT NULL,
  `shop_id` int(5) DEFAULT NULL,
  `pdCat_id` int(5) DEFAULT NULL,
  `pd_name` varchar(30) NOT NULL,
  `pd_desc` longtext DEFAULT NULL,
  `pd_price` decimal(10,2) NOT NULL,
  `pd_expdate` date NOT NULL,
  `pd_img` varchar(255) NOT NULL,
  `pd_stock` int(10) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pd_id`, `shop_id`, `pdCat_id`, `pd_name`, `pd_desc`, `pd_price`, `pd_expdate`, `pd_img`, `pd_stock`, `status`) VALUES
(24, 7, 8, 'Mister Potato', ' Hot & Spicy Flavour          ', '7.30', '2023-05-25', 'img/product/potato.jpg', 30, 1),
(26, 7, 8, 'Chipsters', 'Sour Cream & Onion flavour', '10.00', '2023-05-19', 'img/product/twisties.jpg', 435, 1),
(33, 9, 8, 'Peanuts', 'Nuts', '6.50', '2023-06-30', 'img/product/peanuts.jpg', 388, 1),
(35, 9, 15, 'Nestum', 'Original', '7.30', '2023-07-22', 'img/product/nestum.jpg', 631, 1),
(37, 7, 15, 'OldTown Hazelnut', '1 pack, 15pcs', '14.50', '2023-08-11', 'img/product/hazelnut.jpg', 510, 1),
(42, 9, 21, 'Yogurt', ' 150g ', '5.50', '2023-02-21', 'img/product/yogurt.jpg', 230, 1),
(43, 7, 8, 'Chipster', ' Hot&Spicy ', '10.00', '2023-09-28', 'img/product/chipsters.jpg', 229, 0),
(46, 10, 26, 'Tresseme Shampoo', 'Shampoo', '18.00', '2023-10-14', 'img/product/tresemme.jpg', 46, 1),
(47, 10, 26, 'Antabax', 'Body wash', '17.00', '2024-01-06', 'img/product/antabax.jpg', 100, 1),
(48, 13, 0, 'Exam pad', 'exam pad', '8.00', '0000-00-00', 'img/product/exampad.jpg', 150, 1),
(49, 13, 28, 'Ball pen', '1 pack, 3 pcs', '4.00', '2025-01-07', 'img/product/ballpen.jpg', 500, 1),
(50, 12, 29, 'Panadol', '500mg 2x10', '11.00', '2023-09-08', 'img/product/panadol.png', 180, 1),
(51, 12, 0, 'Face Mask', '4-ply 50 pcs', '18.00', '2023-08-17', 'img/product/mask.jpg', 79, 1),
(54, 21, 32, 'Hdmi adapter', ' hdmi ', '18.00', '0000-00-00', 'img/product/hdmi.jpg', 150, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

CREATE TABLE `product_cat` (
  `pdCat_id` int(5) NOT NULL,
  `pdCat_name` varchar(30) NOT NULL,
  `pdCat_desc` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`pdCat_id`, `pdCat_name`, `pdCat_desc`, `creation_date`) VALUES
(8, 'Snack', 'Snack type product.\r\n', '2022-11-21 10:00:16'),
(15, 'Beverages', 'Coffee, Tea, etc.', '2022-12-03 22:38:31'),
(16, 'Biscuits', 'Any type of biscuits', '2022-12-05 06:29:10'),
(21, 'Dairy', 'Milk, cheese, etc', '2022-12-05 11:10:33'),
(26, 'Care', 'shampoo, body wash, etc.', '2023-01-30 08:13:18'),
(27, 'Book', 'book, paper related stuff', '2023-01-30 09:18:12'),
(28, 'Pen', 'Things used to write, eg: pen, pencil, etc.', '2023-01-30 09:18:35'),
(29, 'Medicine', 'Medicine related stuff, e.g; panadol etc.\r\n', '2023-01-30 09:26:48'),
(30, 'Mask', 'Face mask related', '2023-01-30 09:27:22'),
(32, 'Electronic', 'electronic', '2023-02-04 20:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `seller_id` int(11) NOT NULL,
  `seller_name` varchar(50) NOT NULL,
  `seller_username` varchar(30) NOT NULL,
  `seller_pwd` varchar(30) NOT NULL,
  `seller_img` varchar(255) NOT NULL,
  `seller_cat` int(11) NOT NULL,
  `seller_no` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`seller_id`, `seller_name`, `seller_username`, `seller_pwd`, `seller_img`, `seller_cat`, `seller_no`) VALUES
(7, 'Milimewa', 'milimewa', 'shop1', 'img/shop/milimewa.JPG', 1, '01982236'),
(9, 'Hapseng', 'hapseng', 'shop2', 'img/shop/hapseng.jpg', 1, ''),
(10, 'Watsons', 'watsons', 'shop3', 'img/shop/watsons.jpg', 2, '088 875490'),
(11, 'G-Mart', 'gmart', 'shop4', 'img/shop/gmart.jpg', 1, ''),
(12, 'My Choice Pharmacy', 'mychoice', 'shop5', 'img/shop/pharmacy.jpg', 3, '088 897887'),
(13, 'Kedai Buku Ranau', 'kedaibuku', 'shop6', 'img/shop/buku.jpg', 4, ''),
(16, 'Sabindo sdn bhd', 'sabindo', 'shop7', 'img/shop/sabindo.jpg', 1, ''),
(21, 'Yei Seng', 'yeiseng', 'yei12345', 'img/shop/yei seng.jpg', 5, '088567234');

-- --------------------------------------------------------

--
-- Table structure for table `shop_cat`
--

CREATE TABLE `shop_cat` (
  `shopCat_id` int(2) NOT NULL,
  `shopCat_name` varchar(30) NOT NULL,
  `shopCat_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_cat`
--

INSERT INTO `shop_cat` (`shopCat_id`, `shopCat_name`, `shopCat_desc`) VALUES
(1, 'Grocery', 'Shop that sells grocery '),
(2, 'Personal Care', 'Shop that sells personal care e.g: skincare, makeup, etc.'),
(3, 'Health Care', 'Shop that sells medicine, etc.'),
(4, 'Stationary', 'Shop that sells book and school stuff'),
(5, 'Technology', 'Shop that sells electronic ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `pd_id` (`pd_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fdback_id`);

--
-- Indexes for table `ordination`
--
ALTER TABLE `ordination`
  ADD PRIMARY KEY (`ord_id`);

--
-- Indexes for table `ord_product`
--
ALTER TABLE `ord_product`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `pdCat_id` (`pdCat_id`);

--
-- Indexes for table `product_cat`
--
ALTER TABLE `product_cat`
  ADD PRIMARY KEY (`pdCat_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`seller_id`),
  ADD KEY `seller_cat` (`seller_cat`);

--
-- Indexes for table `shop_cat`
--
ALTER TABLE `shop_cat`
  ADD PRIMARY KEY (`shopCat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fdback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ordination`
--
ALTER TABLE `ordination`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `ord_product`
--
ALTER TABLE `ord_product`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pd_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `product_cat`
--
ALTER TABLE `product_cat`
  MODIFY `pdCat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `shop_cat`
--
ALTER TABLE `shop_cat`
  MODIFY `shopCat_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`pd_id`) REFERENCES `product` (`pd_id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`shop_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`shop_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`pdCat_id`) REFERENCES `product_cat` (`pdCat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
