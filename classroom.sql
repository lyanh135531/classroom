-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2021 at 10:17 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_info`
--

CREATE TABLE `attendance_info` (
  `id` int(11) NOT NULL,
  `idstudent` int(11) NOT NULL,
  `idclass` int(11) NOT NULL,
  `absent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance_info`
--

INSERT INTO `attendance_info` (`id`, `idstudent`, `idclass`, `absent`) VALUES
(47, 251, 4, 5),
(48, 253, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `class_info`
--

CREATE TABLE `class_info` (
  `id` int(11) NOT NULL,
  `nameclass` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `period` int(11) NOT NULL,
  `imgteacher` varchar(255) NOT NULL,
  `owned` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_info`
--

INSERT INTO `class_info` (`id`, `nameclass`, `subject`, `room`, `period`, `imgteacher`, `owned`) VALUES
(4, '512312', 'Cấu trúc dữ liệu và giải thuật 1', 'B123', 45, 'uploads/download (1).png', 'nguyenvand@gmail.com'),
(5, '512482', 'Nhập môn mạng máy tính', 'B007', 45, 'uploads/unnamed.jpg', 'nguyenvanc@gmail.com'),
(6, '512317', 'Nhập môn trí tuệ nhân tạo', 'C002', 30, 'uploads/download.png', 'nguyenvand@gmail.com'),
(7, '512382', 'Khai phá tri thức', 'B001', 45, 'uploads/logo-suc-khoe-xanh-cho-cuoc-song-them-xanh.png', 'nguyenvand@gmail.com'),
(8, '512412', 'Tổ chức máy tính', 'C012', 45, 'uploads/unnamed.jpg', 'nguyenvand@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `comment_info`
--

CREATE TABLE `comment_info` (
  `id` int(11) NOT NULL,
  `content` varchar(2048) NOT NULL,
  `idlesson` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment_info`
--

INSERT INTO `comment_info` (`id`, `content`, `idlesson`) VALUES
(1, 'đã gửi', 6),
(2, 'đã gửi', 15);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_info`
--

CREATE TABLE `lesson_info` (
  `id` int(11) NOT NULL,
  `content` varchar(2048) NOT NULL,
  `idclass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lesson_info`
--

INSERT INTO `lesson_info` (`id`, `content`, `idclass`) VALUES
(3, 'ngày mai kiểm tra', 0),
(4, 'ngày mai kiểm tra', 0),
(5, 'ngày mai kiểm tra', 0),
(8, 'Thông báo: Ngày mai kiểm tra', 6),
(15, 'Buổi thứ 1', 4),
(16, 'Buổi thứ 2', 4),
(17, 'Buổi thứ 3', 4),
(18, 'Buổi thứ 4', 4),
(19, 'Buổi thứ 5', 4),
(20, 'Buổi thứ 6', 4),
(21, 'Buổi thứ 7', 4),
(22, 'Buổi thứ 8', 4),
(23, 'Buổi thứ 9', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notify_info`
--

CREATE TABLE `notify_info` (
  `id` int(11) NOT NULL,
  `content` varchar(2048) NOT NULL,
  `idclass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notify_info`
--

INSERT INTO `notify_info` (`id`, `content`, `idclass`) VALUES
(6, 'Thi cuối kì bằng hình thức tự luận', 6),
(12, 'Thi cuối kì bằng hình thức tự luận', 4);

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` int(11) NOT NULL,
  `mssv` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `idclass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `mssv`, `surname`, `name`, `email`, `idclass`) VALUES
(251, '518H0404', 'Trần Phạm Thanh', 'Minh', '518H0404@student.tdtu.edu.vn', 4),
(252, '518H0114', 'Lê Tấn', 'Tài', '518H0114@student.tdtu.edu.vn', 4),
(253, '518H0372', 'Nguyễn Thành', 'Khang', '518H0372@student.tdtu.edu.vn', 4),
(254, '519H0144', 'Vũ Huy', 'Chương', '519H0144@student.tdtu.edu.vn', 4),
(255, '519H0323', 'Đoàn Văn', 'Nghĩa', '519H0323@student.tdtu.edu.vn', 4),
(256, '﻿517H0054', 'Hoàng Tuấn', 'Huy', '517H0054@student.tdtu.edu.vn', 4),
(258, '518H9033', 'Nguyễn Huy', 'Minh', '518H9033@student.tdtu.edu.vn', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `email`, `password`, `faculty`, `phone`, `level`) VALUES
(16, 'Hữu Đông', 'huudong@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'cntt', '241241', 0),
(17, 'Đình Khôi', 'dinhkhoi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'cntt', '15125', 0),
(29, 'Đặng Minh Thắng', 'dangminhthang@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'cntt', '1251523', 0),
(30, 'Lý Anh', 'lyanh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'cntt', '124215', 1),
(31, 'Admin', 'admin@gmail.com', 'a66abb5684c45962d887564f08346e8d', 'admin', '11111', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_info`
--
ALTER TABLE `attendance_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_info`
--
ALTER TABLE `class_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_info`
--
ALTER TABLE `comment_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_info`
--
ALTER TABLE `lesson_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify_info`
--
ALTER TABLE `notify_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_info`
--
ALTER TABLE `attendance_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `class_info`
--
ALTER TABLE `class_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comment_info`
--
ALTER TABLE `comment_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lesson_info`
--
ALTER TABLE `lesson_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `notify_info`
--
ALTER TABLE `notify_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
