CREATE DATABASE qltccn;
-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 11, 2018 lúc 04:33 PM
-- Phiên bản máy phục vụ: 10.1.25-MariaDB
-- Phiên bản PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qltccn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `budget`
--

CREATE TABLE `budget` (
  `budget_id` int(10) NOT NULL,
  `time` date NOT NULL,
  `budget_money` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `budget`
--

INSERT INTO `budget` (`budget_id`, `time`, `budget_money`, `user_id`, `category_id`, `note`) VALUES
(2, '2018-01-01', 2000000, 1, 10, ''),
(3, '2018-01-01', 2000000, 1, 11, ''),
(4, '2018-01-01', 300000, 1, 12, ''),
(6, '2018-01-01', 300000, 2, 11, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(3) NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `icon` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `icon`) VALUES
(6, 'Hóa đơn', 'fa-credit-card'),
(7, 'Giáo dục', 'fa-graduation-cap'),
(8, 'Giải trí', 'fa-gamepad'),
(9, 'Gia đình', 'fa-home'),
(10, 'Sức khỏe', ' fa-heartbeat'),
(11, 'Ăn uống', 'fa-cutlery'),
(12, 'Di chuyển', 'fa-taxi'),
(13, 'Hẹn hò', 'fa-heart'),
(14, 'Mua sắm', 'fa-shopping-cart'),
(15, 'Lương', 'fa-dollar'),
(16, 'Thưởng', 'fa-trophy'),
(17, 'Lãi suất', 'fa-percent'),
(18, 'Quà tặng', 'fa-gift'),
(19, 'Bán đồ', ' fa-tags');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(10) NOT NULL,
  `user_id` int(4) NOT NULL,
  `time` date NOT NULL,
  `category_id` int(255) NOT NULL,
  `money` int(32) NOT NULL,
  `note` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `expense`
--

INSERT INTO `expense` (`expense_id`, `user_id`, `time`, `category_id`, `money`, `note`) VALUES
(2, 1, '2018-01-10', 7, 20000, 'Ăn ở trường'),
(4, 1, '2018-01-10', 9, 60000, 'Đi chơi'),
(5, 1, '2018-01-10', 12, 60000, 'Đi chơi'),
(6, 1, '2018-01-02', 10, 44353, 'Ăn sáng'),
(12, 1, '2018-01-10', 7, 34000, ''),
(14, 1, '2018-01-10', 8, 50000, ''),
(17, 1, '2018-01-09', 7, 345300, 'học phí'),
(19, 1, '2018-02-02', 7, 300000, ''),
(21, 1, '2018-01-10', 7, 50000, ''),
(22, 1, '2018-01-10', 14, 456000, ''),
(25, 1, '2018-01-11', 6, 50000, 'Tiền internet'),
(30, 1, '2018-01-11', 11, 300000, ''),
(33, 3, '2018-01-11', 11, 10, ''),
(35, 1, '2018-02-02', 6, 300000, ''),
(36, 1, '2018-02-03', 8, 300000, ''),
(37, 1, '2018-02-07', 9, 300000, ''),
(38, 1, '2018-02-09', 12, 300000, ''),
(41, 1, '2018-02-08', 14, 300000, ''),
(42, 1, '2018-01-11', 8, 1000000, ''),
(43, 1, '2018-02-07', 8, 10000, ''),
(44, 1, '2018-01-12', 12, 300000, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `income`
--

CREATE TABLE `income` (
  `income_id` int(10) NOT NULL,
  `time` date NOT NULL,
  `category_id` int(4) NOT NULL,
  `money` int(32) NOT NULL,
  `note` varchar(255) NOT NULL,
  `user_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `income`
--

INSERT INTO `income` (`income_id`, `time`, `category_id`, `money`, `note`, `user_id`) VALUES
(4, '2018-01-07', 15, 3000000, '', 1),
(6, '2018-01-11', 15, 4000000, '', 1),
(8, '2018-01-11', 17, 3000000, '', 1),
(10, '2018-01-10', 15, 3000000, '123', 1),
(11, '2018-01-11', 15, 4000000, '', 1),
(13, '2018-01-11', 15, 1000000, '', 1),
(14, '2018-01-11', 16, 400000, '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `wallet` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `wallet`) VALUES
(1, 'hoangdn', '202cb962ac59075b964b07152d234b70', 9419112),
(2, 'trung', '202cb962ac59075b964b07152d234b70', 0),
(3, 'user1', 'c4ca4238a0b923820dcc509a6f75849b', 299990);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`budget_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Chỉ mục cho bảng `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `budget`
--
ALTER TABLE `budget`
  MODIFY `budget_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT cho bảng `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
