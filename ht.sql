-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 01:59 PM
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
  `user_type` enum('o','m','s','c','a') DEFAULT NULL COMMENT 'a = Admin o = Owner m = Manufacturer s = Supplier c = Customer',
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('0','1','2','') DEFAULT NULL,
  `user_created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ausers`
--

INSERT INTO `ausers` (`uid`, `firstname`, `lastname`, `username`, `password`, `user_type`, `email`, `contact`, `address`, `status`, `user_created_on`) VALUES
(1, 'Parshva', 'Shah', 'parshva213', '8e3c82bbe74ba6ca39e4e9add7d8ba2a', 'a', 'ljminiproject@gmail.com', '+91 99047-88109', 'abc12', '1', '2025-05-30 07:02:14'),
(8, 'hardik b', 'Shah', '50214', '$2y$10$DIIzzrpna72.PNW6yCghm.eL9f/lhNE5zSslZ0XiFfx08AZWLWFyO', 's', '1234@google.com', '9427416209', '1234567890 adac\nkjab njasn ', '2', '2025-06-12 04:48:53'),
(9, 'H', 'Shah', '100', '%???2;E8??bM', 'c', 'dd@mail.cm', '+91 12345-67890', '123 gms hospital', '0', '2025-05-31 07:44:14'),
(10, 'Ha', 'Shah', '50216', '%???2;E8??bM', 's', '123@google.co', '+91 94274-16208', '1234567890', '2', '2025-06-04 07:01:32'),
(11, 'Parshva', 'Shah', '5021', '%???2;E8??bM', 'c', '13@google.com', '+91 99048-88108', '123 khadiya ', '2', '2025-06-04 07:01:28'),
(12, 'Jbshdkb', 'Shah', '1001', '?B???Yu??㥬???', 's', 'kjds@google.com', '+91 12345-67809', '321645789', '1', '2025-05-28 11:13:14'),
(13, '1231', '1321', '13215', '123456789', 'm', '123456789', '1326548790', '1234564879', '0', '2025-05-31 06:12:43'),
(14, 'parshva', 'Shah', NULL, NULL, 's', '12@google.com', '9904788105', '123456', NULL, '2025-06-04 11:45:50');

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
  `user_type` enum('o','m','s','c','a') NOT NULL COMMENT '	a = Admin o = Owner m = Manufacturer s = Supplier c = Customer',
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
        email, address, status, user_created_on,contact
    )
    VALUES (
       OLD.uid, OLD.firstname, OLD.lastname, OLD.username, OLD.password, OLD.user_type,
        OLD.email, OLD.address, OLD.status, OLD.user_created_on,OLD.contact
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `post_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `quantity` decimal(5,0) NOT NULL,
  `mrp` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `uploaded_by_uid` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_type` enum('o','c','m','s','a') NOT NULL COMMENT 'a = Admin\r\no = Owner\r\nm = Manufacturer\r\ns = Supplier\r\nc = Customer\r\n',
  `pstatus` varchar(100) DEFAULT 'in stock',
  `hsfno` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pstate` enum('Active','In Active') NOT NULL DEFAULT 'Active' COMMENT 'Access or Reject product to display',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `pname`, `product_type`, `image1`, `image2`, `image3`, `image4`, `quantity`, `mrp`, `selling_price`, `uploaded_by_uid`, `user_name`, `user_type`, `pstatus`, `hsfno`, `description`, `pstate`, `created_at`, `last_updated_at`) VALUES
(1, '1', 'hg', NULL, NULL, NULL, NULL, 0, 12.25, 12.00, 1, NULL, 'a', 'in stock', '1', 'abc', 'Active', '2025-05-30 11:07:24', '2025-06-04 07:11:22');

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `set_user_type_on_product_insert` BEFORE INSERT ON `product` FOR EACH ROW BEGIN
    DECLARE utype CHAR(1);
    DECLARE fname VARCHAR(50);
    DECLARE lname VARCHAR(50);

    -- Fetch firstname, lastname, and user_type from ausers table
    SELECT firstname, lastname, user_type
    INTO fname, lname, utype
    FROM ausers
    WHERE uid = NEW.uploaded_by_uid;

    -- Assign user_type and user_name to new row
    SET NEW.user_type = utype;
    SET NEW.user_name = CONCAT(fname, ' ', lname);
END
$$
DELIMITER ;

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

--
-- Dumping data for table `scompany`
--

INSERT INTO `scompany` (`company_id`, `uid`, `company_name`, `company_address`, `gst_no`, `company_created_on`) VALUES
(1, 8, '12', 'asd', '24OZHJZ9582F6Z8', '2025-06-12 06:12:51');

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

--
-- Dumping data for table `scompanybank`
--

INSERT INTO `scompanybank` (`company_id`, `bank_name`, `bank_branch`, `bank_ifsc`, `acc_no`, `acc_hol_name`, `gid_no`) VALUES
(1, 'State Bank of India', 'Sabarmati', 'SBI000001', '23000025022', 'Hardik Shah', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sorder`
--

CREATE TABLE `sorder` (
  `order_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `company_invoice_number` varchar(100) NOT NULL,
  `date_of_invoice` date NOT NULL,
  `e_way_bill_number` varchar(100) NOT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ausers`
--
ALTER TABLE `ausers`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`,`email`,`contact`);

--
-- Indexes for table `causers`
--
ALTER TABLE `causers`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `contact` (`contact`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uploaded_by_uid` (`uploaded_by_uid`);

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
-- Indexes for table `sorder`
--
ALTER TABLE `sorder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_company` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ausers`
--
ALTER TABLE `ausers`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `causers`
--
ALTER TABLE `causers`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scompany`
--
ALTER TABLE `scompany`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sorder`
--
ALTER TABLE `sorder`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`uploaded_by_uid`) REFERENCES `ausers` (`uid`);

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
-- Constraints for table `sorder`
--
ALTER TABLE `sorder`
  ADD CONSTRAINT `fk_company` FOREIGN KEY (`company_id`) REFERENCES `scompany` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
