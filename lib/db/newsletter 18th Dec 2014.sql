-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2014 at 03:39 AM
-- Server version: 5.5.40-36.1-log
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON-0ERO";
SET time-0one = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `newsletter`
--

-- --------------------------------------------------------


--
-- Table structure for table `hn_admin`
--

CREATE TABLE IF NOT EXISTS `hn_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hn_admin`
--

INSERT INTO `hn_admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Popoola Haruna', 'harunpopson@yahoo.com', 'alwajud'),
(2, 'Admin', 'admin@elvirasallerasandassociates.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `hn_campaigns`
--

CREATE TABLE IF NOT EXISTS `hn_campaigns` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hn_campaigns`
--

INSERT INTO `hn_campaigns` (`id`, `name`, `subject`, `from_name`, `from_email`, `reply_email`, `body`, `created`, `modified`) VALUES
(1, 'Sample Campaign', 'Sample Campaign', 'Elvira Salleras and Associates', 'info@elvirasallerasandassociates.com', 'info@elvirasallerasandassociates.com', '<p style="margin-top: -15px;"><!-- Targeting Windows Mobile --><!-- [if IEMobile 7]>\r\n  <style type="text/css">\r\n  \r\n  </style>\r\n  <![endif]--><!-- ***********************************************\r\n  ****************************************************\r\n  END MOBILE TARGETING\r\n  ****************************************************\r\n  ************************************************ --><!-- [if gte mso 9]>\r\n    <style>\r\n    /* Target Outlook 2007 and 2010 */\r\n    </style>\r\n  <![endif]--><!-- Begin Background Table --></p>\r\n<table id="backgroundTable" border="0" cellspacing="0" cellpadding="0" bgcolor="#CCC">\r\n<tbody>\r\n<tr>\r\n<td style="background-color: #cccccc;" valign="top" bgcolor="#CCCCCC" width="100%"><!-- Begin Wrapper Table -->\r\n<table border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="background-color: #fff;" align="center" valign="top" width="600">\r\n<table border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td style="border-width: 0; border-bottom-width: 1px; border-bottom-color: #ffffff; border-bottom-style: solid:;" colspan="3" bgcolor="#000000" width="600">&nbsp;</td>\r\n</tr>\r\n<!-- Begin Divider line -->\r\n<tr>\r\n<td colspan="3" valign="top" bgcolor="#666" width="600"><hr style="border-bottom-width: 1px; margin: 0; padding: 0; border: 0 solid #CCC;" /></td>\r\n</tr>\r\n<!-- End Divider line -->\r\n<tr>\r\n<td style="background-color: #666; color: #ddd; font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 16px; padding: 10px; padding-left: 20px; padding-right: 20px; text-align: center;" colspan="3" valign="middle" bgcolor="#666" width="600"><strong>WRITE YOUR CAMPAIGN NAME HERE</strong></td>\r\n</tr>\r\n<!-- End Social Media Links -->\r\n<tr><!-- Begin Divider line --></tr>\r\n<tr>\r\n<td colspan="3" valign="top" bgcolor="#666" width="600"><hr style="border-bottom-width: 1px; margin: 0; padding: 0; border: 0 solid #CCC;" /></td>\r\n</tr>\r\n<!-- End Divider line --><!-- Begin Logo/branding -->\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td class="branding" align="center" valign="middle" width="480">\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><a href="http://www.highrachy.com/" target="_blank"><img src="../assets/uploads/logo.jpg" alt="" /></a></p>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<!-- End Logo/branding --><!-- Begin Divider line -->\r\n<tr>\r\n<td colspan="3" valign="top" bgcolor="FFFFFF" width="600"><hr style="border-bottom-width: 1px; margin: 0; margin-bottom: 16px; padding: 0; border: 0 solid #CCCCCC;" /></td>\r\n</tr>\r\n<!-- End Divider line --><!-- Begin 1st Content Row -->\r\n<tr><!-- Begin spacing Cell -->\r\n<td width="60">&nbsp;</td>\r\n<td align="left" valign="top" width="480">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td width="350">\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 600; font-size: 16px; color: #333;">Hello {first_name},</p>\r\n</td>\r\n<td align="right" width="130"><!-- <img alt="Logo" src="" style="width: 125px; height: 30px; margin-right: -8px; float: right;" /> --></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin-bottom: 1em; text-align: justify;">Type your introduction here<br /><br /><br /><br /></p>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin-bottom: 1em; text-align: justify;">Type your contents here<br /><br /><br /><br /></p>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin-bottom: 1em; text-align: justify;">Type your Closing Remarks here<br /><br /><br /><br /><br /><br /></p>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin-bottom: 1em;"><strong>Elvira Salleras and Associates</strong><br />5th Floor,&nbsp;Ibukun House,<br />No.70 Adetokunbo Ademola Street,<br />Victoria Island, <br />Lagos State,&nbsp;Nigeria.</p>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin-bottom: 1em;">Telephone: +234 1 9037325<em class="icon-blank">&nbsp;</em></p>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin-bottom: 1em;">Email:&nbsp;<a href="mailto:info@elvirasallerasandassociates.com">info@elvirasallerasandassociates.com</a></p>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin: 1em 0; text-align: justify;">Sincerely,</p>\r\n</td>\r\n<!-- Begin spacing Cell -->\r\n<td width="60">&nbsp;</td>\r\n<!-- End spacing Cell --></tr>\r\n<!-- End 1st Content Row --><!-- Begin Divider line -->\r\n<tr>\r\n<td colspan="3" valign="top" bgcolor="#FFFFFF" width="600"><hr style="border-bottom-width: 1px; margin: 0; padding: 0; margin-top: 16px; margin-bottom: 0; border: 0 solid #CCCCCC;" /></td>\r\n</tr>\r\n<!-- End Divider line --><!-- Begin Footer -->\r\n<tr><!-- Begin spacing Cell -->\r\n<td valign="top" bgcolor="#666666" width="60">&nbsp;</td>\r\n<!-- End spacing Cell -->\r\n<td align="left" valign="top" bgcolor="#666666" width="480">&nbsp; &nbsp;</td>\r\n<!-- Begin spacing Cell -->\r\n<td valign="top" bgcolor="#666666" width="60">&nbsp;</td>\r\n<!-- End spacing Cell --></tr>\r\n<!-- End Footer --><!-- Begin Divider line -->\r\n<tr>\r\n<td colspan="3" valign="top" bgcolor="#666" width="600"><hr style="border-bottom-width: 1px; margin: 0; padding: 0; border: 0 solid #CCC;" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- End Content Table --></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- End Wrapper table --></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="display: none;">&nbsp;</p>', '2014-12-14 14:59:46', '2014-12-15 08:25:47'),
(2, 'SEASONS GREETINGS', 'SEASONS GREETINGS FROM ELVIRA SALLERAS AND ASSOCIATES', 'Elvira Salleras and Associates', 'nnamdi@elvirasallerasandassociates.com', 'nnamdi@elvirasallerasandassociates.com', '<p>&nbsp;</p>\r\n<!-- Wrapper -->\r\n<table class="w100" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#fff">\r\n<tbody>\r\n<tr>\r\n<td valign="top" bgcolor="#9a030d" width="100%" height="100%">\r\n<table class="w100" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#232323">\r\n<tbody>\r\n<tr>\r\n<td bgcolor="#ffffff">\r\n<table class="w100" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td bgcolor="#57554d" height="1">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="table" border="0" width="598" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr>\r\n<td width="12" height="10">&nbsp;</td>\r\n<td class="table" valign="bottom"><!-- Logo -->\r\n<table class="mobileLogo" border="0" cellspacing="0" cellpadding="0" align="left">\r\n<tbody>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td valign="top" height="30"><img src="../assets/uploads/logo.jpg" alt="" /></td>\r\n</tr>\r\n<tr>\r\n<td class="webonly" height="20">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td width="10" height="12">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="table" border="0" width="598" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr>\r\n<td><img src="../assets/uploads/xmas.jpg" alt="" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="table" border="0" width="598" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff">\r\n<tbody>\r\n<tr>\r\n<td valign="top" bgcolor="#ffffff"><!-- 1st column start ===========================================================================================-->\r\n<table class="table" border="0" width="598" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff">\r\n<tbody>\r\n<tr>\r\n<td valign="top">\r\n<table class="table" border="0" width="598" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table class="table" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td colspan="3" width="15" height="30">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width="15">&nbsp;</td>\r\n<td>\r\n<table class="table" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td class="heading" style="font-size: 24px; font-style: italic; color: #c3060a; font-weight: normal; font-family: georgia, Arial, Helvetica, sans-serif; line-height: 30px;">Elvira Salleras &amp;&nbsp;Associates wishes you a Happy Holiday !</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td width="15">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width="15">&nbsp;</td>\r\n<td height="15">&nbsp;</td>\r\n<td width="15">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width="15">&nbsp;</td>\r\n<td>\r\n<table class="table" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td style="font-size: 14px; font-style: italic; color: #454545; font-weight: normal; font-family: georgia, Geneva, sans-serif; line-height: 20px;">\r\n<p><strong>Hello&nbsp;{first_name},</strong></p>\r\n<p>Wishing you the best this season has to offer and more.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style="font-size: 14px; font-style: italic; color: #454545; font-weight: normal; font-family: georgia, Geneva, sans-serif; line-height: 20px;" align="left">Regards,<br /><span style="font-weight: 600; color: #c3060a;">The Elvira Salleras &amp;&nbsp;Associates&nbsp;Team </span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td width="15">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width="15">&nbsp;</td>\r\n<td height="30">&nbsp;</td>\r\n<td width="15">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- 1st column end ===========================================================================================--></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- footer start ================================================================================================ -->\r\n<table class="w100" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#232323">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table class="table" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td height="15">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="table" border="0" width="598" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="font-size: 11px; color: #d0d1d1; font-weight: normal; text-align: center; font-family: arial, Geneva, sans-serif; line-height: 16px; vertical-align: top;">Copyright &copy; 2014 Elvira Salleras and Associates. <br /> All Rights Reserved.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- footer end -->\r\n<p>&nbsp;</p>', '2014-12-14 15:24:22', '2014-12-15 12:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `hn_contactgroup`
--

CREATE TABLE IF NOT EXISTS `hn_contactgroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `hn_contactgroup`
--

INSERT INTO `hn_contactgroup` (`id`, `group_id`, `contact_id`, `created`, `modified`) VALUES
(1, 1, 1, '2014-12-14 03:24:46', '0000-00-00 00:00:00'),
(2, 1, 2, '2014-12-14 03:24:46', '0000-00-00 00:00:00'),
(4, 3, 10, '2014-12-15 02:51:51', '0000-00-00 00:00:00'),
(5, 2, 11, '2014-12-15 06:28:46', '0000-00-00 00:00:00'),
(6, 3, 12, '2014-12-15 06:34:45', '0000-00-00 00:00:00'),
(7, 3, 13, '2014-12-15 06:45:54', '0000-00-00 00:00:00'),
(8, 3, 14, '2014-12-15 06:45:54', '0000-00-00 00:00:00'),
(9, 3, 15, '2014-12-15 06:45:54', '0000-00-00 00:00:00'),
(10, 2, 16, '2014-12-17 02:10:47', '0000-00-00 00:00:00'),
(11, 2, 17, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(12, 2, 18, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(13, 2, 19, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(14, 2, 20, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(15, 2, 21, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(16, 2, 22, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(17, 2, 23, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(18, 2, 24, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(19, 2, 25, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(20, 2, 26, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(21, 2, 27, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(22, 2, 28, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(23, 2, 29, '2014-12-17 03:51:19', '0000-00-00 00:00:00'),
(24, 2, 10, '2014-12-17 04:05:27', '0000-00-00 00:00:00'),
(25, 2, 12, '2014-12-17 04:05:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hn_contacts`
--

CREATE TABLE IF NOT EXISTS `hn_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `first_name` varchar(150) DEFAULT NULL,
  `last_name` varchar(150) DEFAULT NULL,
  `company` varchar(250) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `hn_contacts`
--

INSERT INTO `hn_contacts` (`id`, `title`, `first_name`, `last_name`, `company`, `email`, `created`, `modified`) VALUES
(1, 'Mr', 'Haruna', 'Popoola', 'Highrachy Investment and Technology', 'haruna@highrachy.com', '2014-02-08 13:23:01', '2014-02-08 12:23:01'),
(2, 'Mr', 'Nnamdi', 'Ijei', 'Highrachy Investment and Technology', 'nnamdi@highrachy.com', '2014-02-08 13:23:43', '2014-02-08 12:23:43'),
(10, 'Mrs', 'Bernadette', 'Ojo', 'Elvira Salleras and Associates', 'bernadette@elvirasallerasandassociates.com', '2014-12-15 02:49:34', '2014-12-15 08:49:34'),
(11, 'Ms', 'Sarah', 'Nelson', 'United Biscuits', 'nelsons@unitedbiscuits.com', '2014-12-15 06:28:19', '2014-12-15 12:28:19'),
(12, 'Mrs.', 'Elvira', 'Salleras', 'ES & A', 'elvira@elvirasallerasandassociates.com', '2014-12-15 06:34:13', '2014-12-15 12:34:13'),
(13, 'Mrs.', 'Edith', 'Jituboh', 'ES & A', 'edith@elvirasallerasandassociates.com', '2014-12-15 06:39:32', '2014-12-15 12:39:32'),
(14, 'Mrs.', 'Daisy', 'Yusuf', 'ES & A', 'daisy@elvirasallerasandassociates.com', '2014-12-15 06:42:32', '2014-12-15 12:42:32'),
(15, 'Ms', 'Chinwe', 'Obijiaku', 'ES & A', 'chinwe@elvirasallerasandassociates.com', '2014-12-15 06:45:26', '2014-12-15 12:45:26'),
(16, 'Mr.', 'Chris', 'Woods', 'United Biscuits', 'chriswood@unitedbiscuits.com', '2014-12-17 02:10:06', '2014-12-17 08:10:06'),
(17, 'Ms.', 'Meredith', 'Caly', 'United Biscuits', 'merecaly@unitedbiscuits.com', '2014-12-17 02:20:13', '2014-12-17 08:20:13'),
(18, 'Ms.', 'Simon', 'Rose', 'United Biscuits', 'srose1@unitedbiscuits.com', '2014-12-17 02:26:26', '2014-12-17 08:26:26'),
(19, 'Mr.', 'Hital', 'Patel', 'United Biscuits', 'patelH2@unitedbiscuits.com', '2014-12-17 02:29:08', '2014-12-17 08:29:08'),
(20, 'Mr.', 'Paul', 'Bradbury', 'United Biscuits', 'paulbradbury@unitedbiscuits.com', '2014-12-17 02:30:56', '2014-12-17 08:30:56'),
(21, 'Mr.', 'Mark', 'Jauncey', 'United Biscuits', 'mark.jauncey@unitedbiscuits.com', '2014-12-17 02:33:28', '2014-12-17 08:33:28'),
(22, 'Mr.', 'Matt', 'Smith', 'United Biscuits', 'mattsmith@unitedbiscuits.com', '2014-12-17 02:40:27', '2014-12-17 08:40:27'),
(23, 'Ms', 'Heather', 'Buglass', 'United Biscuits', 'hbuglass1@unitedbiscuits.com', '2014-12-17 02:43:01', '2014-12-17 08:43:01'),
(24, 'Mr.', 'Murphy', 'Audrey', 'United Biscuits', 'murphyA2@unitedbiscuits.com', '2014-12-17 02:45:38', '2014-12-17 08:45:38'),
(25, 'Mrs.', 'Chika', 'Ikem Obi', 'Chika Ikem Obi', 'cmio2online@yahoo.com', '2014-12-17 02:55:01', '2014-12-17 08:55:01'),
(26, 'Mr.', 'Hans', 'Herdenberger', 'Egis Engineering Nig. Ltd.', 'hans.herdenberger@egis.fr', '2014-12-17 03:26:51', '2014-12-17 09:26:51'),
(27, 'Mr.', 'Ilker', 'Izci', 'Merpa Communication Nig. Ltd', 'ilker.izci@mer-pa.com.tr', '2014-12-17 03:32:40', '2014-12-17 09:32:40'),
(28, 'Mr.', 'Charl', 'Vanderwalt', 'MSD Idea Pharmaceuticals Nig.Ltd', 'charl.vanderwalt@merck.com', '2014-12-17 03:43:54', '2014-12-17 09:43:54'),
(29, 'Mr.', 'J.C', 'Brossard', 'Petrolis Staff and Crew Nig. Ltd', 'jc.brossard@petrolisgroup.com', '2014-12-17 03:48:00', '2014-12-17 09:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `hn_groups`
--

CREATE TABLE IF NOT EXISTS `hn_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `hn_groups`
--

INSERT INTO `hn_groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Consultant', '2014-12-14 03:24:03', '0000-00-00 00:00:00'),
(2, 'Clients', '2014-12-14 15:19:28', '2014-12-15 02:50:55'),
(3, 'Staff', '2014-12-15 02:50:28', '0000-00-00 00:00:00'),
(4, 'Friends', '2014-12-15 06:25:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hn_options`
--

CREATE TABLE IF NOT EXISTS `hn_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL,
  `option_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `hn_options`
--

INSERT INTO `hn_options` (`id`, `option_name`, `option_value`) VALUES
(1, 'from_name', 'Elvira Salleras and Associates'),
(2, 'from_email', 'info@elvirasallerasandassociates.com'),
(3, 'reply_email', 'info@elvirasallerasandassociates.com'),
(4, 'default_template', '3');

-- --------------------------------------------------------

--
-- Table structure for table `hn_send`
--

CREATE TABLE IF NOT EXISTS `hn_send` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `hn_send`
--

INSERT INTO `hn_send` (`id`, `campaign_id`, `group_id`, `page`, `start_send`, `status`, `percentage`, `start_time`, `end_time`, `date_added`, `modified`) VALUES
(1, 1, 0, 0, NULL, 0, 0, NULL, NULL, '2014-12-14 15:01:10', '2014-12-15 08:25:47'),
(2, 2, 0, 0, NULL, 0, 0, NULL, NULL, '2014-12-14 15:26:28', '2014-12-15 12:37:15'),
(3, 2, 1, 2, NULL, 4, 100, '2014-12-15 01:05:59', '2014-12-15 01:06:08', '2014-12-14 15:26:56', '2014-12-15 07:06:08'),
(4, 2, 2, 17, NULL, 4, 100, '2014-12-17 04:07:38', '2014-12-17 04:09:11', '2014-12-14 15:29:43', '2014-12-17 10:09:11'),
(5, 2, 3, 5, NULL, 4, 100, '2014-12-15 06:46:35', '2014-12-15 06:47:05', '2014-12-15 02:53:56', '2014-12-15 12:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `hn_templates`
--

CREATE TABLE IF NOT EXISTS `hn_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `hn_templates`
--

INSERT INTO `hn_templates` (`id`, `name`, `body`, `created`, `modified`) VALUES
(3, 'Classic Design', '<p style="margin-top: -15px;"><!-- Targeting Windows Mobile --><!-- [if IEMobile 7]>\r\n  <style type="text/css">\r\n  \r\n  </style>\r\n  <![endif]--><!-- ***********************************************\r\n  ****************************************************\r\n  END MOBILE TARGETING\r\n  ****************************************************\r\n  ************************************************ --><!-- [if gte mso 9]>\r\n    <style>\r\n    /* Target Outlook 2007 and 2010 */\r\n    </style>\r\n  <![endif]--><!-- Begin Background Table --></p>\r\n<table id="backgroundTable" border="0" cellspacing="0" cellpadding="0" bgcolor="#CCC">\r\n<tbody>\r\n<tr>\r\n<td style="background-color: #cccccc;" valign="top" bgcolor="#CCCCCC" width="100%"><!-- Begin Wrapper Table -->\r\n<table border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="background-color: #fff;" align="center" valign="top" width="600">\r\n<table border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td style="border-width: 0; border-bottom-width: 1px; border-bottom-color: #ffffff; border-bottom-style: solid:;" colspan="3" bgcolor="#000000" width="600">&nbsp;</td>\r\n</tr>\r\n<!-- Begin Divider line -->\r\n<tr>\r\n<td colspan="3" valign="top" bgcolor="#666" width="600"><hr style="border-bottom-width: 1px; margin: 0; padding: 0; border: 0 solid #CCC;" /></td>\r\n</tr>\r\n<!-- End Divider line -->\r\n<tr>\r\n<td style="background-color: #666; color: #ddd; font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 16px; padding: 10px; padding-left: 20px; padding-right: 20px; text-align: center;" colspan="3" valign="middle" bgcolor="#666" width="600"><strong>WRITE YOUR CAMPAIGN NAME HERE</strong></td>\r\n</tr>\r\n<!-- End Social Media Links -->\r\n<tr><!-- Begin Divider line --></tr>\r\n<tr>\r\n<td colspan="3" valign="top" bgcolor="#666" width="600"><hr style="border-bottom-width: 1px; margin: 0; padding: 0; border: 0 solid #CCC;" /></td>\r\n</tr>\r\n<!-- End Divider line --><!-- Begin Logo/branding -->\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td class="branding" align="center" valign="middle" width="480">\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><a href="../../" target="_blank"><img src="../assets/uploads/logo.jpg" alt="" /></a></p>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<!-- End Logo/branding --><!-- Begin Divider line -->\r\n<tr>\r\n<td colspan="3" valign="top" bgcolor="FFFFFF" width="600"><hr style="border-bottom-width: 1px; margin: 0; margin-bottom: 16px; padding: 0; border: 0 solid #CCCCCC;" /></td>\r\n</tr>\r\n<!-- End Divider line --><!-- Begin 1st Content Row -->\r\n<tr><!-- Begin spacing Cell -->\r\n<td width="60">&nbsp;</td>\r\n<td align="left" valign="top" width="480">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td width="350">\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 600; font-size: 16px; color: #333;">Hello {first_name},</p>\r\n</td>\r\n<td align="right" width="130"><!-- <img alt="Logo" src="" style="width: 125px; height: 30px; margin-right: -8px; float: right;" /> --></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin-bottom: 1em; text-align: justify;">Type your introduction here<br /><br /><br /><br /></p>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin-bottom: 1em; text-align: justify;">Type your contents here<br /><br /><br /><br /></p>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin-bottom: 1em; text-align: justify;">Type your Closing Remarks here<br /><br /><br /><br /><br /><br /></p>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin-bottom: 1em;"><strong>Elvira Salleras and Associates</strong><br />5th Floor,&nbsp;Ibukun House,<br />No.70 Adetokunbo Ademola Street,<br />Victoria Island, <br />Lagos State,&nbsp;Nigeria.</p>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin-bottom: 1em;">Telephone: +234 1 9037325<em class="icon-blank">&nbsp;</em></p>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin-bottom: 1em;">Email:&nbsp;<a href="mailto:info@elvirasallerasandassociates.com">info@elvirasallerasandassociates.com</a></p>\r\n<p style="font-family: Arial, Helvetica, sans-serif; font-weight: 100; font-size: 14px; color: #333; line-height: 20px; margin: 1em 0; text-align: justify;">Sincerely,</p>\r\n</td>\r\n<!-- Begin spacing Cell -->\r\n<td width="60">&nbsp;</td>\r\n<!-- End spacing Cell --></tr>\r\n<!-- End 1st Content Row --><!-- Begin Divider line -->\r\n<tr>\r\n<td colspan="3" valign="top" bgcolor="#FFFFFF" width="600"><hr style="border-bottom-width: 1px; margin: 0; padding: 0; margin-top: 16px; margin-bottom: 0; border: 0 solid #CCCCCC;" /></td>\r\n</tr>\r\n<!-- End Divider line --><!-- Begin Footer -->\r\n<tr><!-- Begin spacing Cell -->\r\n<td valign="top" bgcolor="#666666" width="60">&nbsp;</td>\r\n<!-- End spacing Cell -->\r\n<td align="left" valign="top" bgcolor="#666666" width="480">&nbsp; &nbsp;</td>\r\n<!-- Begin spacing Cell -->\r\n<td valign="top" bgcolor="#666666" width="60">&nbsp;</td>\r\n<!-- End spacing Cell --></tr>\r\n<!-- End Footer --><!-- Begin Divider line -->\r\n<tr>\r\n<td colspan="3" valign="top" bgcolor="#666" width="600"><hr style="border-bottom-width: 1px; margin: 0; padding: 0; border: 0 solid #CCC;" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- End Content Table --></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- End Wrapper table --></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="display: none;">&nbsp;</p>', '2014-04-25 05:11:23', '2014-12-14 22:12:33'),
(4, 'Season Greetings', '<p>&nbsp;</p>\r\n<!-- Copy or cut code from the commented section to add or delete table/block --->\r\n<p>&nbsp;</p>\r\n<!-- Wrapper -->\r\n<table class="w100" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#fff">\r\n<tbody>\r\n<tr>\r\n<td valign="top" bgcolor="#9a030d" width="100%" height="100%">\r\n<table class="w100" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#232323">\r\n<tbody>\r\n<tr>\r\n<td bgcolor="#ffffff">\r\n<table class="w100" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td bgcolor="#57554d" height="1">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="table" border="0" width="598" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr>\r\n<td width="12" height="10">&nbsp;</td>\r\n<td class="table" valign="bottom"><!-- Logo -->\r\n<table class="mobileLogo" border="0" cellspacing="0" cellpadding="0" align="left">\r\n<tbody>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td valign="top" height="30"><img src="../assets/uploads/logo.jpg" alt="" /></td>\r\n</tr>\r\n<tr>\r\n<td class="webonly" height="20">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td width="10" height="12">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="table" border="0" width="598" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr>\r\n<td><img src="../assets/uploads/xmas.jpg" alt="" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="table" border="0" width="598" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff">\r\n<tbody>\r\n<tr>\r\n<td valign="top" bgcolor="#ffffff"><!-- 1st column start ===========================================================================================-->\r\n<table class="table" border="0" width="598" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff">\r\n<tbody>\r\n<tr>\r\n<td valign="top">\r\n<table class="table" border="0" width="598" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table class="table" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td colspan="3" width="15" height="30">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width="15">&nbsp;</td>\r\n<td>\r\n<table class="table" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td class="heading" style="font-size: 24px; font-style: italic; color: #c3060a; font-weight: normal; font-family: georgia, Arial, Helvetica, sans-serif; line-height: 30px;">Elvira Salleras and Associates wishes you a Happy Holiday !</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td width="15">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width="15">&nbsp;</td>\r\n<td height="15">&nbsp;</td>\r\n<td width="15">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width="15">&nbsp;</td>\r\n<td>\r\n<table class="table" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td style="font-size: 14px; font-style: italic; color: #454545; font-weight: normal; font-family: georgia, Geneva, sans-serif; line-height: 20px;">Enter your contents here</td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style="font-size: 14px; font-style: italic; color: #454545; font-weight: normal; font-family: georgia, Geneva, sans-serif; line-height: 20px;" align="left">Regards,<br /> <span style="font-weight: 600; color: #c3060a;">Our Team </span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td width="15">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width="15">&nbsp;</td>\r\n<td height="30">&nbsp;</td>\r\n<td width="15">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- 1st column end ===========================================================================================--></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- footer start ================================================================================================ -->\r\n<table class="w100" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#232323">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table class="table" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td height="15">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="table" border="0" width="598" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="font-size: 11px; color: #d0d1d1; font-weight: normal; text-align: center; font-family: arial, Geneva, sans-serif; line-height: 16px; vertical-align: top;">Copyright &copy; 2015 Elvira Salleras and Associates. <br /> All Rights Reserved.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- footer end -->\r\n<p>&nbsp;</p>', '2014-12-14 14:43:25', '2014-12-14 22:14:22');
