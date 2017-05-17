-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2014 at 10:25 PM
-- Server version: 5.5.36-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `willi822_bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `isbn` bigint(13) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `authorfirst` varchar(255) DEFAULT NULL,
  `authorlast` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `reservationid` int(10) DEFAULT NULL,
  PRIMARY KEY (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `title`, `authorfirst`, `authorlast`, `price`, `reservationid`) VALUES
(9780062220967, 'Asylum', 'Roux', 'Madeleine', 10.58, NULL),
(9780307588364, 'Gone Girl', 'Flynn', 'Gillian', 14.4, NULL),
(9780345807298, 'The Circle', 'Dave', 'Eggers', 13.19, NULL),
(9780385537681, 'Fifty Shades Darker', 'James', 'E L', 20.64, NULL),
(9780399164439, 'Concealed in Death', 'Robb', 'J D', 19.39, NULL),
(9780778316817, 'Four Friends', 'Robyn', 'Carr', 9.63, NULL),
(9781476770383, 'Revival', 'King', 'Stephen', 21.47, NULL),
(9781594204234, 'Bleeding Edge', 'Pynchon', 'Thomas', 19.81, NULL),
(9781594632389, 'And The Mountains Echoed', 'Khaled', 'Hosseini', 13.22, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip` int(5) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(14) NOT NULL,
  `accttype` varchar(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `state` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `lastname`, `firstname`, `street`, `city`, `zip`, `email`, `phonenumber`, `accttype`, `password`, `state`) VALUES
(32, 'user', 'test', '123 center st.', 'somecity', 12345, 'b@b.com', '555-555-5555', NULL, '5f4dcc3b5aa765d61d8327deb882cf99', 'wisconsin'),
(33, 'admin', 'admin', '1 mke street', 'janesville', 53224, 'admin@admin.com', '414-456-5555', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Wisconsin'),
(34, 'R', 'Tammy', '1 e Kenwood blvd', 'milwaukee', 53209, 'mail@mail.com', '414-229-5555', NULL, '1a1dc91c907325c69271ddf0c944bc72', 'Wisconsin'),
(37, 'user', 'admin', '123 Enterprise Ct.', 'Milwaukee', 53211, 'admin@49books.net', '414-555-5555', 'admin', 'dd701cb53abf5583fe90b2c8a746699f', 'Wisconsin'),
(49, 'User', 'Test', '123 Center St.', 'Milwaukee', 53211, 'test@user.com', '414-555-5555', NULL, 'a3236a7ca9b12fb515588d7ad7a018e9', 'Wisconsin'),
(50, 'Doe', 'John', '123 Center St', 'Milwaukee', 53204, '123@go.com', '555-555-5555', NULL, '25d55ad283aa400af464c76d713c07ad', 'WI');

-- --------------------------------------------------------

--
-- Table structure for table `users2`
--

CREATE TABLE IF NOT EXISTS `users2` (
  `user_id` int(10) NOT NULL DEFAULT '0',
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip` int(5) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `accttype` varchar(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `state` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users2`
--

INSERT INTO `users2` (`user_id`, `lastname`, `firstname`, `street`, `city`, `zip`, `email`, `phonenumber`, `accttype`, `password`, `state`) VALUES
(2, 'Blast', 'Bfirst', 'some address', 'some city', 12346, 'b@b.com', '1234567890', 'user', '5f4dcc3b5aa765d61d8327deb882cf99', 'WI'),
(32, '', 'user', '', 'somewhere', 12345, 'test@user.com', '5555555555', NULL, '5f4dcc3b5aa765d61d8327deb882cf99', 'wisconsin'),
(33, '', 'admin', '', 'janesville', 53224, 'admin@admin.com', '123-098-09', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Wisconsin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
