-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 03:04 PM
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
-- Database: `rsms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_list`
--

CREATE TABLE `client_list` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_list`
--

INSERT INTO `client_list` (`id`, `firstname`, `middlename`, `lastname`, `contact`, `email`, `address`, `delete_flag`, `date_created`, `date_updated`) VALUES
(5, 'Md', '', 'Abubakar', '01961877152', 'itsmdabubakar@gmail.com', 'ghhhhhhhhhhhjk', 0, '2024-09-18 02:54:12', NULL),
(6, 'Tauhid', '', 'Rahman', '01961877152', 'somoytvad@gmail.com', 'sadasdf', 0, '2024-09-19 21:15:59', NULL),
(7, 'Arafat ', '', 'Rahman', '+8801985469878', 'qfrytjygily@internetkeno.com', '', 0, '2024-10-01 18:50:34', NULL),
(8, 'Abdullah', '', 'Sarkar', '', 'qfryt345ly@internetkeno.com', '', 0, '2024-10-01 18:51:19', NULL),
(9, 'Faisal', '', 'Mahmud', '', 'qfrytj32ygily@internetkeno.com', '', 0, '2024-10-01 18:51:45', NULL),
(10, 'Abdur', '', 'Rahman', '', 'q45ygily@internetkeno.com', '', 0, '2024-10-01 18:52:19', NULL),
(11, 'Sakib', '', 'Hasan', '+8801985469878', 'ma7863290@gmail.com', 'Uttara', 0, '2024-10-21 18:28:47', NULL),
(12, 'Abid', '', 'Hasan', '', 'abidhasanstudent20@gmail.com', '102 bakai,gournodi,\r\nbarisal.', 0, '2024-10-27 20:16:43', NULL),
(13, 'mavrick', '', 'fighter', '0156484923', 'mavrick@gmail.com', '200 house,sector10,uttara', 0, '2024-10-28 19:42:49', NULL),
(14, 'sabbir', '', 'ahmed', '', 'sabbir@gmail.com', '27 house,sector10,uttara', 0, '2024-10-28 19:55:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message_list`
--

CREATE TABLE `message_list` (
  `id` int(30) NOT NULL,
  `fullname` text NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message_list`
--

INSERT INTO `message_list` (`id`, `fullname`, `contact`, `email`, `message`, `status`, `date_created`) VALUES
(3, 'Redwan', 'Siddique', 'qfrytjygily@internetkeno.com', 'Hi!', 1, '2024-09-18 03:28:27'),
(4, 'Redwan', '+8801985469878', 'itsmdabubakar@gmail.com', 'hekkii k', 1, '2024-09-18 12:29:31'),
(5, 'Redwan', 'Siddique', 'qfrytjygily@internetkeno.com', 'Hi, I have some queries', 0, '2024-10-01 18:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_service_list`
--

CREATE TABLE `mobile_service_list` (
  `id` int(30) NOT NULL,
  `service` text NOT NULL,
  `description` text NOT NULL,
  `cost` float NOT NULL DEFAULT 0,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Active, 1 = Delete',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mobile_service_list`
--

INSERT INTO `mobile_service_list` (`id`, `service`, `description`, `cost`, `delete_flag`, `date_created`, `date_updated`) VALUES
(6, 'Screen Replacement', 'Fixing cracked or shattered screens.\r\nReplacing unresponsive touch screens.', 1000, 0, '2024-07-05 23:10:30', NULL),
(7, 'Battery Replacement:', 'Replacing old or malfunctioning batteries.\r\nResolving charging issues.', 1000, 0, '2024-07-05 23:11:48', NULL),
(8, 'Connectivity Issues', 'Fixing problems with Wi-Fi, Bluetooth, or cellular connectivity.', 0, 0, '2024-07-17 02:07:14', NULL),
(9, 'Water Damage Repair', 'Cleaning and repairing internal components damaged by water.', 1000, 0, '2024-07-05 23:15:08', NULL),
(10, 'Charging Port Repair', 'Fixing or replacing damaged charging ports.\r\nAddressing issues with slow or non-charging devices.', 1500, 0, '2024-07-05 23:16:34', NULL),
(11, 'Button Repair', 'Repairing or replacing malfunctioning buttons (home, power, volume)', 1000, 0, '2024-07-05 23:17:32', NULL),
(12, 'Camera Repair', 'Fixing or replacing faulty front or rear cameras.\r\nAddressing issues with camera lenses or sensors.', 500, 0, '2024-07-05 23:20:24', NULL),
(13, 'Software Troubleshooting and Updates', 'Resolving software glitches and crashes.\r\nInstalling the latest operating system updates.', 0, 0, '2024-07-17 02:05:59', NULL),
(14, 'Sensor Repairs', 'Fixing issues with sensors (proximity, accelerometer, gyroscope)', 0, 0, '2024-07-17 02:07:54', NULL),
(20, 'Speaker and Microphone Repair', 'Fixing issues with sound output or input.\r\nReplacing damaged speakers or microphones.', 500, 0, '2024-07-17 01:47:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repair_list`
--

CREATE TABLE `repair_list` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `client_id` int(30) NOT NULL,
  `tech_id` int(30) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `total_amount` float NOT NULL DEFAULT 0,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= Unpaid, 1= paid',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1= Approved, 2 = In-Progress, 3 = Checking, 4 = Done, 5= Cancelled ',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updadted` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repair_list`
--

INSERT INTO `repair_list` (`id`, `code`, `client_id`, `tech_id`, `remarks`, `total_amount`, `payment_status`, `status`, `date_created`, `date_updadted`) VALUES
(24, 'RSMS-2024100001', 9, 0, '', 2500, 0, 5, '2024-10-01 18:53:43', '2024-10-02 22:02:02'),
(26, 'RSMS-2024100002', 8, 0, '', 1000, 0, 4, '2024-10-02 22:04:15', NULL),
(27, 'RSMS-2024100003', 7, 0, '', 1000, 0, 0, '2024-10-02 22:04:45', NULL),
(28, 'RSMS-2024100004', 10, 0, '', 0, 0, 4, '2024-10-02 22:05:30', '2024-10-27 20:15:44'),
(33, 'RSMS-2024100007', 10, 9, 'service', 1500, 0, 0, '2024-10-28 18:17:11', '2024-10-28 18:28:47'),
(34, 'RSMS-2024100005', 12, 9, 'hghtyhth', 1000, 1, 4, '2024-10-28 19:14:01', '2024-10-28 19:39:52'),
(35, 'RSMS-2024100006', 13, 5, 'take my service fast', 2500, 1, 4, '2024-10-28 19:43:58', '2024-10-28 19:45:23'),
(36, 'RSMS-2024100008', 14, 9, 'for services', 1500, 0, 0, '2024-10-28 19:57:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repair_materials`
--

CREATE TABLE `repair_materials` (
  `repair_id` int(30) NOT NULL,
  `material` text NOT NULL,
  `cost` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repair_services`
--

CREATE TABLE `repair_services` (
  `repair_id` int(30) NOT NULL,
  `service_id` int(30) NOT NULL,
  `fee` float NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repair_services`
--

INSERT INTO `repair_services` (`repair_id`, `service_id`, `fee`, `status`) VALUES
(24, 10, 1500, 0),
(24, 6, 1000, 0),
(26, 11, 1000, 0),
(27, 7, 1000, 0),
(28, 14, 0, 0),
(33, 10, 1500, 0),
(33, 8, 0, 0),
(34, 6, 1000, 0),
(35, 6, 1000, 0),
(35, 12, 500, 0),
(35, 7, 1000, 0),
(36, 11, 1000, 0),
(36, 12, 500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` int(30) NOT NULL,
  `service` text NOT NULL,
  `description` text NOT NULL,
  `cost` float NOT NULL DEFAULT 0,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Active, 1 = Delete',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `service`, `description`, `cost`, `delete_flag`, `date_created`, `date_updated`) VALUES
(6, 'Hardware Services', 'Hardware repairs involve fixing or replacing physical components of a computer, such as the Motherboard, Hard Drive, or RAM. These repairs address issues like a non-booting computer, overheating, or faulty power supply.', 1000, 0, '2024-07-05 23:10:30', NULL),
(7, 'Software Services', 'Software repairs address issues related to operating systems, applications, or software conflicts. These services include troubleshooting, software updates, installation, and resolving compatibility issues.', 1000, 0, '2024-07-05 23:11:48', NULL),
(8, 'Virus Removal', 'Virus removal services are an essential type of computer repair that focuses on detecting and eliminating viruses, malware, and other malicious software from your computer system. Viruses can cause significant damage to your computer, compromising your data, slowing down performance, and even allowing unauthorized access to your personal information.', 500, 0, '2024-07-05 23:13:00', NULL),
(9, 'Water Damage Repair', 'There are many computer accessories like scanners and printers which might need repair due to damage.', 1000, 0, '2024-07-05 23:15:08', NULL),
(10, 'Data Recovery & Backup', 'Data Recovery is essential for protecting and preserving valuable data stored on computers. These services help to recover lost or corrupted data and create backups to prevent data loss in the future.', 1500, 0, '2024-07-05 23:16:34', NULL),
(11, 'Network Issue & Troubleshooting', 'Computer networking services involve the setup, maintenance, and troubleshooting of computer networks. A computer network is a collection of interconnected devices, such as computers, servers, printers, and other peripherals, that are linked together to facilitate communication and resource sharing. Networking services ensure that these networks are functioning optimally and securely.', 1000, 0, '2024-07-05 23:17:32', NULL),
(12, 'OS Update & Recovery', 'OS support such as Windows 7, Windows 8, Windows 10 and newer Windows 11 installation, driver update, fixing issues. These services are provided here.', 500, 0, '2024-07-05 23:20:24', NULL),
(13, 'Hardware Services', '', 23, 1, '2024-07-17 01:30:09', NULL),
(14, 'Accessories Repair', 'There are many computer accessories like scanners and printers which might need repair due to damage.', 0, 0, '2024-07-17 01:50:48', NULL),
(15, 'Battery Replacement', 'Replacing old or malfunctioning batteries.\r\nResolving charging issues.', 1000, 1, '2024-10-02 22:23:52', NULL),
(16, 'Charging Port Repair', 'Fixing or replacing damaged charging ports.\r\nAddressing issues with slow or non-charging devices.', 1000, 1, '2024-10-02 22:25:29', NULL),
(17, 'Screen Replacement', 'Fixing cracked or shattered screens.\r\nReplacing unresponsive touch screens.\r\n\r\n', 1000, 1, '2024-10-02 22:26:43', NULL),
(18, 'Camera Repair', 'Fixing or replacing faulty front or rear cameras.\r\nAddressing issues with camera lenses or sensors.', 0, 1, '2024-10-02 22:27:51', NULL),
(19, 'test', 'test', 1000, 1, '2024-10-28 11:12:52', NULL),
(20, 'test', 'text', 1000, 1, '2024-10-28 11:41:13', NULL),
(21, 'test2', 'test2', 10000, 1, '2024-10-28 11:41:48', NULL),
(22, 'test', 'mobile_service_list', 10000, 1, '2024-10-28 11:43:48', NULL),
(23, 'test', 'mobilesave_service', 400, 1, '2024-10-28 11:45:27', NULL),
(24, 'test', 'text', 500, 1, '2024-10-28 12:01:37', NULL),
(25, 'test', 'test', 110, 1, '2024-10-28 12:09:47', NULL),
(26, '', '', 0, 1, '2024-10-28 12:09:58', NULL),
(27, 'test', 'textt', 100, 1, '2024-10-28 12:11:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'TechFix - Computer and Mobile Repair Services'),
(6, 'short_name', 'TechFix'),
(11, 'logo', 'uploads/logo-1640568130.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1640568273.png'),
(15, 'content', 'Array'),
(16, 'email', 'info@techfix.com'),
(17, 'contact', '+8801985469878'),
(18, 'from_time', '11:00'),
(19, 'to_time', '21:30'),
(20, 'address', 'Mirpur-10, Dhaka, Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=admin,2=staff,3=technician',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`) VALUES
(1, 'Mohammed', NULL, 'Abubakar', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1639468007', NULL, 1, 1, '2021-01-20 14:02:37', '2024-07-05 22:48:04'),
(5, 'Ajhar', NULL, 'Uddin', 'ajhar1', 'e99a18c428cb38d5f260853678922e03', NULL, NULL, 3, 1, '2024-10-01 18:56:59', '2024-10-27 22:14:01'),
(6, 'Tauhid', NULL, 'Rahman', 'tauhid1', 'e99a18c428cb38d5f260853678922e03', NULL, NULL, 2, 1, '2024-10-19 09:41:12', NULL),
(8, 'Abid', NULL, 'Hasan', 'abid', 'e99a18c428cb38d5f260853678922e03', NULL, NULL, 2, 1, '2024-10-27 12:12:08', '2024-10-28 11:02:54'),
(9, 'abrar', NULL, 'ahmed', 'abrar', 'e99a18c428cb38d5f260853678922e03', NULL, NULL, 3, 1, '2024-10-28 18:28:20', NULL),
(10, 'adib', NULL, 'Hasan', 'adib', 'e99a18c428cb38d5f260853678922e03', NULL, NULL, 2, 1, '2024-10-28 19:40:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_list`
--
ALTER TABLE `client_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_list`
--
ALTER TABLE `message_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_service_list`
--
ALTER TABLE `mobile_service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repair_list`
--
ALTER TABLE `repair_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `tech_id` (`tech_id`),
  ADD KEY `tech_id_2` (`tech_id`);

--
-- Indexes for table `repair_materials`
--
ALTER TABLE `repair_materials`
  ADD KEY `repair_id` (`repair_id`);

--
-- Indexes for table `repair_services`
--
ALTER TABLE `repair_services`
  ADD KEY `repair_id` (`repair_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_list`
--
ALTER TABLE `client_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `message_list`
--
ALTER TABLE `message_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mobile_service_list`
--
ALTER TABLE `mobile_service_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `repair_list`
--
ALTER TABLE `repair_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `repair_list`
--
ALTER TABLE `repair_list`
  ADD CONSTRAINT `repair_list_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `repair_materials`
--
ALTER TABLE `repair_materials`
  ADD CONSTRAINT `repair_materials_ibfk_1` FOREIGN KEY (`repair_id`) REFERENCES `client_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `repair_services`
--
ALTER TABLE `repair_services`
  ADD CONSTRAINT `repair_services_ibfk_1` FOREIGN KEY (`repair_id`) REFERENCES `repair_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `repair_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
