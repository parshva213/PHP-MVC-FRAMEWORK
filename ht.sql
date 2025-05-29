-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 02:57 PM
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
-- Database: `ht`
--

-- --------------------------------------------------------

--
-- Table structure for table `ausers`
--

CREATE TABLE `ausers` (
  `uid` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` enum('o','m','s','c') DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('0','1','2','') DEFAULT NULL,
  `user_created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `contact` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ausers`
--

INSERT INTO `ausers` (`uid`, `firstname`, `lastname`, `username`, `password`, `user_type`, `email`, `address`, `status`, `user_created_on`, `contact`) VALUES
(1, 'Parshva', 'Shah', 'parshva213', '??|UI???ɱ?D', 'o', 'ljminiproject@gmail.com', 'abc12', '1', '2025-05-29 12:49:49', '+91 99047-88109'),
(8, 'Ha', 'Shah', '50214', '$2y$10$DIIzzrpna72.PNW6yCghm.eL9f/lhNE5zSslZ0XiFfx08AZWLWFyO', 's', '1234@google.com', '1234567890', '0', '2025-05-29 10:50:04', '+91 94274-16209'),
(9, 'H', 'Shah', '100', '%???2;E8??bM', 'c', 'dd@mail.cm', '123 gms hospital', '2', '2025-05-28 11:12:01', '+91 12345-67890'),
(10, 'Ha', 'Shah', '50216', '%???2;E8??bM', 's', '123@google.co', '1234567890', '1', '2025-05-28 11:12:12', '+91 94274-16208'),
(11, 'Parshva', 'Shah', '5021', '%???2;E8??bM', 'c', '13@google.com', '123 khadiya ', '1', '2025-05-28 11:12:38', '+91 99048-88108'),
(12, 'Jbshdkb', 'Shah', '1001', '?B???Yu??㥬???', 's', 'kjds@google.com', '321645789', '1', '2025-05-28 11:13:14', '+91 12345-67809');

-- --------------------------------------------------------

--
-- Table structure for table `causers`
--

CREATE TABLE `causers` (
  `uid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` enum('o','m','s','c') NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `user_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `causers`
--
DELIMITER $$
CREATE TRIGGER `before_delete_causers` BEFORE DELETE ON `causers` FOR EACH ROW BEGIN

    -- Insert into ausers and let uid auto-increment
    INSERT INTO ausers (
       uid, firstname, lastname, username, password, user_type,
        email, address, status, user_created_on
    )
    VALUES (
       OLD.uid, OLD.firstname, OLD.lastname, OLD.username, OLD.password, OLD.user_type,
        OLD.email, OLD.address, OLD.status, OLD.user_created_on
    );

    -- Get the newly generated uid

    -- Insert into usercon using the new uid
    INSERT INTO usercon (
        uid, contact
    )
    VALUES (
        OLD.uid, OLD.contact
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cusuerbank`
--

CREATE TABLE `cusuerbank` (
  `acc_no` varchar(100) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `gid_no` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `musuerbank`
--

CREATE TABLE `musuerbank` (
  `bank_id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_branch` varchar(100) DEFAULT NULL,
  `bank_ifsc` varchar(100) DEFAULT NULL,
  `acc_no` varchar(100) DEFAULT NULL,
  `acc_hol_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ouserbank`
--

CREATE TABLE `ouserbank` (
  `bank_id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_branch` varchar(100) DEFAULT NULL,
  `bank_ifsc` varchar(100) DEFAULT NULL,
  `acc_no` varchar(100) DEFAULT NULL,
  `acc_hol_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_id` int(11) DEFAULT NULL,
  `product_image_path` text DEFAULT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raw_product`
--

CREATE TABLE `raw_product` (
  `product_id` int(11) NOT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_type` varchar(100) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scompany`
--

CREATE TABLE `scompany` (
  `company_id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `gst_no` varchar(100) DEFAULT NULL,
  `company_created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scompanybank`
--

CREATE TABLE `scompanybank` (
  `company_id` int(11) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_branch` varchar(100) DEFAULT NULL,
  `bank_ifsc` varchar(100) DEFAULT NULL,
  `acc_no` varchar(100) DEFAULT NULL,
  `acc_hol_name` varchar(100) DEFAULT NULL,
  `gid_no` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sell_product`
--

CREATE TABLE `sell_product` (
  `product_id` int(11) NOT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ausers`
--
ALTER TABLE `ausers`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `causers`
--
ALTER TABLE `causers`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cusuerbank`
--
ALTER TABLE `cusuerbank`
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `musuerbank`
--
ALTER TABLE `musuerbank`
  ADD PRIMARY KEY (`bank_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `ouserbank`
--
ALTER TABLE `ouserbank`
  ADD PRIMARY KEY (`bank_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD KEY `fk_product_image_sell` (`product_id`);

--
-- Indexes for table `raw_product`
--
ALTER TABLE `raw_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indexes for table `scompany`
--
ALTER TABLE `scompany`
  ADD PRIMARY KEY (`company_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `scompanybank`
--
ALTER TABLE `scompanybank`
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `sell_product`
--
ALTER TABLE `sell_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ausers`
--
ALTER TABLE `ausers`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `causers`
--
ALTER TABLE `causers`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `musuerbank`
--
ALTER TABLE `musuerbank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ouserbank`
--
ALTER TABLE `ouserbank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raw_product`
--
ALTER TABLE `raw_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scompany`
--
ALTER TABLE `scompany`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cusuerbank`
--
ALTER TABLE `cusuerbank`
  ADD CONSTRAINT `cusuerbank_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `ausers` (`uid`);

--
-- Constraints for table `musuerbank`
--
ALTER TABLE `musuerbank`
  ADD CONSTRAINT `musuerbank_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `ausers` (`uid`);

--
-- Constraints for table `ouserbank`
--
ALTER TABLE `ouserbank`
  ADD CONSTRAINT `ouserbank_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `ausers` (`uid`);

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `fk_product_image_sell` FOREIGN KEY (`product_id`) REFERENCES `sell_product` (`product_id`),
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `raw_product` (`product_id`);

--
-- Constraints for table `raw_product`
--
ALTER TABLE `raw_product`
  ADD CONSTRAINT `raw_product_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `ausers` (`uid`);

--
-- Constraints for table `scompany`
--
ALTER TABLE `scompany`
  ADD CONSTRAINT `scompany_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `ausers` (`uid`);

--
-- Constraints for table `scompanybank`
--
ALTER TABLE `scompanybank`
  ADD CONSTRAINT `scompanybank_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `scompany` (`company_id`);

--
-- Constraints for table `sell_product`
--
ALTER TABLE `sell_product`
  ADD CONSTRAINT `sell_product_ibfk_2` FOREIGN KEY (`uploaded_by`) REFERENCES `ausers` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
