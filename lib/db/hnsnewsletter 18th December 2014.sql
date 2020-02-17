
-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 97.74.31.62
-- Generation Time: Dec 18, 2014 at 03:22 AM
-- Server version: 5.5.33
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON-0ERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hnsnewsletter`
--

-- --------------------------------------------------------

--
-- Table structure for table `hn_admin`
--

CREATE TABLE `hn_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hn_admin`
--

INSERT INTO `hn_admin` VALUES(1, 'Popoola Haruna', 'harunpopson@yahoo.com', 'alwajud');
INSERT INTO `hn_admin` VALUES(2, 'Admin', 'admin@highrachy.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `hn_campaigns`
--

CREATE TABLE `hn_campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `subject` varchar(400) DEFAULT NULL,
  `from_name` varchar(250) NOT NULL,
  `from_email` varchar(250) NOT NULL,
  `reply_email` varchar(250) NOT NULL,
  `body` text,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hn_campaigns`
--


-- --------------------------------------------------------

--
-- Table structure for table `hn_contactgroup`
--

CREATE TABLE `hn_contactgroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hn_contactgroup`
--


-- --------------------------------------------------------

--
-- Table structure for table `hn_contacts`
--

CREATE TABLE `hn_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `first_name` varchar(150) DEFAULT NULL,
  `last_name` varchar(150) DEFAULT NULL,
  `company` varchar(250) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hn_contacts`
--


-- --------------------------------------------------------

--
-- Table structure for table `hn_groups`
--

CREATE TABLE `hn_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hn_groups`
--


-- --------------------------------------------------------

--
-- Table structure for table `hn_options`
--

CREATE TABLE `hn_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL,
  `option_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `hn_options`
--

INSERT INTO `hn_options` VALUES(1, 'from_name', 'Highrachy Investment and Technology');
INSERT INTO `hn_options` VALUES(2, 'from_email', 'info@highrachy.com');
INSERT INTO `hn_options` VALUES(3, 'reply_email', 'info@highrachy.com');
INSERT INTO `hn_options` VALUES(4, 'default_template', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hn_send`
--

CREATE TABLE `hn_send` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `page` int(11) NOT NULL DEFAULT '0',
  `start_send` datetime DEFAULT NULL,
  `status` tinyint(11) NOT NULL DEFAULT '0',
  `percentage` int(11) NOT NULL DEFAULT '0',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hn_send`
--


-- --------------------------------------------------------

--
-- Table structure for table `hn_templates`
--

CREATE TABLE `hn_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hn_templates`
--

