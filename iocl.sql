-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2019 at 06:45 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iocl`
--

-- --------------------------------------------------------

--
-- Table structure for table `closing_stock`
--

CREATE TABLE `closing_stock` (
  `ms` float(10,4) NOT NULL,
  `hsd` float(10,4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `closing_stock`
--

INSERT INTO `closing_stock` (`ms`, `hsd`, `date`) VALUES
(10.0000, 50.0000, '2019-03-01'),
(90.0000, 80.0000, '2019-03-01'),
(60.0000, 80.0000, '2019-03-02'),
(30.0000, 40.0000, '2019-03-02'),
(10.0000, 10.0000, '2019-03-03'),
(20.0000, 40.0000, '2019-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `meter_reading`
--

CREATE TABLE `meter_reading` (
  `nozzle_name` varchar(10) NOT NULL,
  `reading` float(10,4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meter_reading`
--

INSERT INTO `meter_reading` (`nozzle_name`, `reading`, `date`) VALUES
('abc', 1000.0000, '2019-03-02'),
('ans', 600.0000, '2019-03-16'),
('ghf', 890.0000, '2019-03-03'),
('fgg', 5600.0000, '2019-03-09'),
('nnnlllmmm', 560.9000, '2019-03-23'),
('orange', 560.9000, '2019-03-14'),
('asd', 900.0000, '2019-03-02'),
('fgg', 800.0000, '2019-03-02'),
('oggi', 460.0000, '2019-03-02'),
('olll', 300.0000, '2019-03-02'),
('ghf', 700.0000, '2019-03-02'),
('lmn', 120.0000, '2019-03-02'),
('d4', 9000.0000, '2019-03-02'),
('orange', 100.0000, '2019-03-02'),
('orange', 800.0000, '2019-03-02'),
('abc', 100.0000, '2019-03-10'),
('asd', 700.0000, '2019-03-10'),
('fgg', 900.0000, '2019-03-10'),
('oggi', 560.0000, '2019-03-10'),
('olll', 780.0000, '2019-03-10'),
('ghf', 788.0000, '2019-03-10'),
('ans', 450.0000, '2019-03-10'),
('orange', 900.0000, '2019-03-10'),
('lmn', 9000.0000, '2019-03-10'),
('nnnlllmmm', 450.0000, '2019-03-10'),
('d4', 890.0000, '2019-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `nozzle`
--

CREATE TABLE `nozzle` (
  `pump_name` varchar(10) NOT NULL,
  `nozzle_id` int(10) NOT NULL,
  `nozzle_name` varchar(10) NOT NULL,
  `item_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nozzle`
--

INSERT INTO `nozzle` (`pump_name`, `nozzle_id`, `nozzle_name`, `item_name`) VALUES
('p1', 1, 'abc', 'MS'),
('p1', 2, 'asd', 'MS'),
('p2', 3, 'fgg', 'MS'),
('p3', 4, 'oggi', 'HSD'),
('p4', 5, 'olll', 'MS'),
('p3', 6, 'ghf', 'HSD'),
('p4', 7, 'ans', 'MS'),
('p2', 8, 'orange', 'HSD'),
('p6', 9, 'lmn', 'MS'),
('p6', 10, 'nnnlllmmm', 'HSD'),
('b', 11, 'd4', 'MS');

-- --------------------------------------------------------

--
-- Table structure for table `opening_stock`
--

CREATE TABLE `opening_stock` (
  `ms` float(10,4) NOT NULL,
  `hsd` float(10,4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opening_stock`
--

INSERT INTO `opening_stock` (`ms`, `hsd`, `date`) VALUES
(100.0000, 40.0000, '2019-02-03'),
(100.0000, 40.0000, '2019-02-03'),
(4600.0000, 4000.0000, '2019-03-01'),
(590.0000, 500.0000, '2019-03-02'),
(900.0000, 600.0000, '2019-03-03'),
(100.0000, 200.0000, '2019-03-01'),
(200.0000, 300.0000, '2019-03-02'),
(40.0000, 70.0000, '2019-03-03'),
(80.0000, 90.0000, '2019-03-03'),
(7.0000, -2.0000, '2019-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `pump`
--

CREATE TABLE `pump` (
  `tank_name` varchar(20) NOT NULL,
  `pump_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pump`
--

INSERT INTO `pump` (`tank_name`, `pump_name`) VALUES
('t1', 'p1'),
('t1', 'p2'),
('t2', 'p90'),
('t5', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `ms` float(10,4) NOT NULL,
  `hsd` float(10,4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`ms`, `hsd`, `date`) VALUES
(1000.0000, 1000.0000, '2019-03-01'),
(3000.0000, 6000.0000, '2019-03-06'),
(12000.0000, 150000.0000, '2019-03-15'),
(100.0000, 200.0000, '2019-03-14'),
(100.0000, 100.0000, '2019-03-15'),
(100.0000, 300.0000, '2019-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `tank`
--

CREATE TABLE `tank` (
  `tank_id` int(10) NOT NULL,
  `tank_name` varchar(20) NOT NULL,
  `capacity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tank`
--

INSERT INTO `tank` (`tank_id`, `tank_name`, `capacity`) VALUES
(1, 't1', 100),
(2, 't2', 5000),
(3, 't3', 6000),
(4, 't4', 10000),
(5, 't5', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

CREATE TABLE `testing` (
  `pump_name` varchar(10) NOT NULL,
  `ms` float(10,4) NOT NULL,
  `hsd` float(10,4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testing`
--

INSERT INTO `testing` (`pump_name`, `ms`, `hsd`, `date`) VALUES
('p1', 100.0000, 100.0000, '2019-03-01'),
('p2', 20.0000, 30.0000, '2019-03-02'),
('p1', 20.0000, 30.0000, '2019-03-03'),
('p1', 30.0000, 20.0000, '2019-03-04'),
('p1', 50.0000, 80.0000, '2019-03-05'),
('p1', 10.0000, 10.0000, '2019-03-06'),
('p1', 50000.0000, 4500.0000, '0015-12-09'),
('b', 500.0000, 200.0000, '2019-03-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nozzle`
--
ALTER TABLE `nozzle`
  ADD PRIMARY KEY (`nozzle_id`);

--
-- Indexes for table `pump`
--
ALTER TABLE `pump`
  ADD PRIMARY KEY (`pump_name`),
  ADD KEY `tank_name` (`tank_name`);

--
-- Indexes for table `tank`
--
ALTER TABLE `tank`
  ADD PRIMARY KEY (`tank_name`),
  ADD UNIQUE KEY `tank_id` (`tank_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pump`
--
ALTER TABLE `pump`
  ADD CONSTRAINT `pump_ibfk_1` FOREIGN KEY (`tank_name`) REFERENCES `tank` (`tank_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
