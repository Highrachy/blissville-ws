-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 97.74.31.131
-- Generation Time: Oct 30, 2016 at 06:53 AM
-- Server version: 5.5.43
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `blissville`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` VALUES(1, 'Our Vision', '<p class="lead">“To be a front runner in providing convenient and efficient housing thereby enhancing returns to our investors and property owners.”</p>\r\n                                                 <p>Our projects strategically aim at providing energy efficient luxurious condos that are well within your grasp. Unique edifices that don''t just cater for the affordability on procurement but also ensure that the lives of the occupants are enhanced at minimum running and maintenance cost. The architectural designs respond imaginatively to the cultural climatic and environment conditions as such only the most suitable materials are considered and specified. We don''t just sell homes, we guarantee your future.</p>\r\n\r\n                                                <p>We intend to continuously and progressively expand\r\n                                                    our portfolio nationwide over the next five years and\r\n                                                    provide similar housing solutions suitable for\r\n                                                    strategically selected locations like Ibeju Lekki,\r\n                                                    Porthharcourt, Uyo, Abuja and Kaduna.</p>', '0000-00-00 00:00:00', '2016-05-01 01:23:24');
INSERT INTO `abouts` VALUES(2, 'Location Summary', ' <p>Blissville Condos will be accessible via multiple routes giving you the option of choice while on the move. Our estates will be conveniently located within the Lekki/Epe axis between Ikate and Chevron environs. </p>\r\n                                                 <p>Notable locations within close proximity include;</p>\r\n                                                <ul>\r\n                                                    <li>The new Circle Mall</li>\r\n                                                    <li>Prince Ebeano Supermarket</li>\r\n                                                    <li>Dreamworld Africana Amusement Park</li>\r\n                                                    <li>Lekki Conservation Center accessories</li>\r\n                                                    <li>Several bank branches, ATMs, plazas and filling/service stations guarantee the convenience experienced by our residents.</li>\r\n                                                </ul>  ', '0000-00-00 00:00:00', '2016-04-20 02:53:54');
INSERT INTO `abouts` VALUES(3, 'Safety and Security:', '\n                                                <p>\n                                                    <strong>''Safety first''</strong> is the watch phrase as we implement several standardized security features;\n                                                </p>\n                                                <ul>\n                                                    <li>Perimeter fence, electrically protected</li>\n                                                    <li>Automated gates that can be controlled right from the comfort of your home</li>\n                                                    <li>Panic Alarm system</li>\n                                                    <li>Fire detection and firefighting apparatus</li>\n                                                </ul>', '0000-00-00 00:00:00', '2016-04-21 07:29:46');
INSERT INTO `abouts` VALUES(4, 'Power and ICT:', '                                                <p>We have harnessed superior architectural designs with technological systems that enhance lives and save time and lots of money;</p>\n                                                <ul>\n                                                    <li>Smart solar and inverter systems</li>\n                                                    <li>Efficient lighting systems</li>\n                                                    <li>Cable TV distribution network</li>\n                                                    <li>Core fiber internet connectivity</li>\n                                                    <li>Intercom and Gate Management</li>\n                                                </ul>', '0000-00-00 00:00:00', '2016-04-21 07:30:37');
INSERT INTO `abouts` VALUES(5, 'Ambience and Lifestyle:', '                                                <p>We provide plush luxury at affordable rates via a wide range of recreational amenities including;</p>\n                                                <ul>\n                                                    <li>Swimming pool/ Children’s play area <span class="danger">*</span></li>\n                                                    <li>Rooftop gym/ Dance room</li>\n                                                    <li>Sky lounge with exciting views</li>\n                                                    <li>Dedicated parking for vehicles</li>\n                                                </ul>', '0000-00-00 00:00:00', '2016-04-21 07:32:23');
INSERT INTO `abouts` VALUES(6, 'Blissville Benefits', '<ul>\r\n                                                        <li>Our discounted purchase rates avail you with up to 15% for  immediate returns on investment.</li>\r\n                                                        <li>Energy efficient houses that gives you up to 25% power cost  savings</li>\r\n                                                        <li>Flexible and customized payment plans to complement your  income streams</li>\r\n                                                        <li>We strictly transact with proper titled lands for seamless  transfer of ownership.</li>\r\n                                                        <li>Blissville Estates are strategically located with multiple  roads and close proximity to healthcare facilities, grocery shopping centres,  ATMs and filling stations for increased convenience.</li>\r\n                                                        <li>The use of Horticulture and other natural components  increase homeliness of the estates</li>\r\n                                                    </ul>', '2016-10-02 10:37:24', '2016-10-02 02:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` VALUES(1, 'Admin', 'admin@highrachy.com', 'IT Officer', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '2016-05-01 01:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `url_name` varchar(500) NOT NULL,
  `excerpt` text,
  `full_article` text NOT NULL,
  `tags` text,
  `picture` varchar(150) DEFAULT NULL,
  `picture2` varchar(150) DEFAULT NULL,
  `picture3` varchar(150) DEFAULT NULL,
  `video` varchar(500) DEFAULT NULL,
  `category` smallint(6) NOT NULL DEFAULT '1',
  `type` smallint(6) NOT NULL DEFAULT '1',
  `published_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` VALUES(1, 'Corporations and Human Rights: Need for Regulatory Compliance', 'corporations-and-human-rights-need-for-regulatory-compliance', '<p>As the new millennium emerges, trends in global human rights are changing. Human rights issues are crossing sovereign boundaries and are no longer just issues of the state. As more and more non-governmental organizations are growing, and the Internet expands and facilitates a quicker spread of information, there are more and more people raising concerns about human rights related issues. Some of these come from the increasingly larger and influential commercial sector including large, multinational companies.</p>', '<!--StartFragment--><p>As the new millennium emerges, trends in global human rights are changing. Human rights issues are crossing sovereign boundaries and are no longer just issues of the state. As more and more non-governmental organizations are growing, and the Internet expands and facilitates a quicker spread of information, there are more and more people raising concerns about human rights related issues. Some of these come from the increasingly larger and influential commercial sector including large, multinational companies.</p><!--StartFragment--><p>As the world globalizes, multinational corporations are also coming under more scrutiny, as questions about their accountability are also being raised.</p><p>In some cases, some corporations have lobbied their governments to aggressively support regimes that are favorable to them. For example, especially in the 1970s and 80s, some tacitly supported dictatorships as they could control their own people, be more easily influenced and corrupted, allow conditions like cheap labor and sweatshops, and so on. This is less practical today as a company’s image with such associations can more readily be tarnished today. Increasingly then, influence is being spread through lobbying for global economic and trade arrangements that are more beneficial to themselves.</p><p>This can be accomplished through various means including:</p><ul>  <li>Tacitly supporting military interventions (often dressed in propaganda about saving the people from themselves, or undoing a wrong in the other country and so on)</li>  <li>Pushing for economic policies that are heavily weighted in their favor</li>  <li>Foreign investment treaties and other negotiations designed in part to give more abilities for corporations to expand into other poorer countries possibly at the expense of local businesses.</li>  <li>Following an ideology which is believed to be beneficial to everyone, but hides the realities and complexities that may worsen situations. These ideologies can be influential as some larger corporations may indeed benefit from these policies, but that does not automatically mean everyone else will, and power and such interests may see these agendas being pushed forth more so.</li></ul><p>However, with this expansion and drive for further profits, there has often come a disregard for human rights. In some cases, corporations have been accused for hiring local militaries to subdue and even kill people who are protesting the effects and practices of these corporations, such as the various controversies over <a href="http://www.globalissues.org/article/86/nigeria-and-oil" title="Global Issues: “Nigeria and Oil”, Last updated: Thursday, June 10, 2010">oil corporations</a> and<a href="http://www.globalissues.org/article/87/the-democratic-republic-of-congo" title="Global Issues: “The Democratic Republic of Congo”, Last updated: Saturday, August 21, 2010">resource and mineral companies</a> in parts of Africa have highlighted.</p><p>As globalization has increased in the past decade or two, so has the criticisms. Whether it is concerns at <a href="http://www.corpwatch.org/article.php?id=376" title="External Link: Elizabeth Martinez and Arnoldo Garcia, ''What is Neo-Liberalism?'', Corpwatch.org">profits</a> over people as the driving factor, or <a href="http://www.corpwatch.org/article.php?id=911" title="External Link: ''Repression Inc. The Assault on Human Rights'', Corpwatch.org, February 1999">violations of human rights</a>, or<a href="http://www.alternet.org/story.html?StoryID=9464" title="External Link: ''How Corporations Operate Tax Free'', Senator Byron Dorgan, Washington Monthly, July 18 2000">large scale tax avoidance</a> by some companies, some large multinationals operating in developing countries in particular have certainly had many questions to answer.</p><p>The pressure to compete has often meant fighting against <a href="http://www.foreignpolicy-infocus.org/briefs/vol3/v3n28soc.html" title="External Link: Terry Collingsworth, ''An Enforceable Social Clause'', Foreign Policy In Focus, Volume 3, Number 28, October 1998">social clauses</a> and policies that may lead to more costs for the company where other companies may not be subject to the same restrictions. The fear of losing out in competition then drives many companies to a lower common denominator rather than a higher one.</p><p>And so there is <a href="http://web.archive.org/web/20001207172600/http://www.oneworld.org/ips2/apr98/11_52_033.html" title="External Link: Moyiga Nduru, ''China, EPZs Listed as Major Violators of Workers Rights'', IPS News Service, April 2 1998">a downward pressure on worker’s wages and their working conditions</a>because they are such major costs for many operations.</p><p>Many multinationals encourage the formation of export processing zones in developing countries which end up being areas where worker’s rights are reduced. This way they are able to play off countries against each other; if one tries to improve worker or living standards in some way, the company can threaten to move operations to another zone in another country. Some developing countries such as China also benefit from this arrangement as it makes them more competitive in international markets.</p><!--EndFragment--><!--EndFragment-->', 'human rights, corporation', 'corporation-of-human-rights.jpg', NULL, NULL, '', 1, 1, '2015-08-20', '2015-08-23 15:14:23', '2015-08-28 10:21:56');
INSERT INTO `articles` VALUES(2, 'Newsletter on Employee Compensation Scheme', 'Newsletter-on-Employee-Compensation-Scheme', '<p><strong>An Overview of the Employee Compensation Act 2010</strong></p><p>The Federal Government of Nigeria in December 2010 passed the Employee Compensation Act (“ECA”) 2010 into law. The ECA which repeals the Workmen’s Compensation Act of 2004, makes provisions for compensations for any death, injury, disease or disability arising out of or in the course of employment &nbsp;and for related matters and it applies to all employees in both the public and private sector. The ECA shall be regulated by the board of Nigerian Social Insurance Trust Fund (NSITF). &nbsp;Although the Commencement date on the Act is December 2010, the NSITF has only just begun a sensitization process to create the awareness of this Act and to this end, in March 2012 opened an office in Lagos State. The ECA is made up of 9 parts, 74 sections and 1 schedule.&nbsp;</p>', '<!--StartFragment--><p><strong>An Overview of the Employee Compensation Act 2010</strong></p><p>The Federal Government of Nigeria in December 2010 passed the Employee Compensation Act (“ECA”) 2010 into law. The ECA which repeals the Workmen’s Compensation Act of 2004, makes provisions for compensations for any death, injury, disease or disability arising out of or in the course of employment &nbsp;and for related matters and it applies to all employees in both the public and private sector. The ECA shall be regulated by the board of Nigerian Social Insurance Trust Fund (NSITF). &nbsp;Although the Commencement date on the Act is December 2010, the NSITF has only just begun a sensitization process to create the awareness of this Act and to this end, in March 2012 opened an office in Lagos State. The ECA is made up of 9 parts, 74 sections and 1 schedule.&nbsp;</p><p><strong>Important Sections in the ECA</strong></p><p>Part I of the ECA contains the objectives, scope and application of the ECA. &nbsp;Section 1 of the ECA provides the key objectives of the ECA as to provide an open and fair system of guaranteed and adequate compensation for all employees or their dependants for any death, injury, disease or disability arising out of or in the course of employment. The ECA also provides for rehabilitation to employees with work-related disabilities as provided in the Act, establish and maintain a solvent compensation fund managed in the interest of employees and employers ; provide for fair and adequate assessments for employers ; provide an appeal procedure that is simple, fair and accessible, with minimal delays ; and combine efforts and resources of relevant stakeholders for the prevention of workplace disabilities, including the enforcement of occupational safety and health standards.</p><p>Part II of the ECA makes provisions for the procedures for making claims under sections 4, 5 &amp; 6. Section 4 provides for the procedure for making claims by the employee or his/her dependant in the case of death by requiring that notification be giving to the employer of the injury or disabling occupational disease within 14 days of the occurrence or of receipt of information of the occurrence. The information of the disease or injury should be communicated to a manager, supervisor, first-aid attendant, agent in charge of the work where the injury occurred or other appropriate representative of the employer which information shall include the name of the employee; the time and place of the occurrence; and in ordinary language, the nature and cause of the disease or injury if known. In the case of a disabling occupational disease, the employer to be informed of the death or disability is the employer who last employed the employee in the employment to the nature of which the disease was due. This section further provides that failure to provide the information required under sub-section (1) of this section is a bar to a claim for compensation under this Act, unless the Board is satisfied that the information, though not complete sufficiently describes the disease or injury suffered, the employer or the employer’s representative had knowledge of it or that employer has not been prejudiced, and the Board considers that the interests of justice requires that the claim be allowed.<strong>Section 5&nbsp;</strong>of the ECA requires the employer to report to the Board, to the local representative of the Board and the nearest office of the National Council for Occupational Safety and Health in the State within 7 days of its occurrence every injury, every disabling occupational disease or claim for or allegation of an occupational disease to an employee and every death of an employee that is or is claimed to be one arising out of and in the course of employment.</p><p>&nbsp;A report under this section shall be in such form and manner as prescribed by the Board and shall include the name and address of the employee, the time and place of the disease, injury or death, the nature of the injury or alleged injury, the name and address of any specialist or accredited medical practitioner who attend to the employee and any other particulars required by the Board under the ECA or any regulation made there under and such report may be made by mailing the copies of the form addressed to the Board at the address the Board prescribes. The failure to make a report required under this section, unless allowed by the Board, constitutes an offence under this Act. The Board also makes rules of procedures for making claims for compensation under the ECA.</p><!--EndFragment-->', 'employee, compensation', 'employee_compensation.jpg', NULL, NULL, '', 2, 1, '2015-08-23', '2015-08-23 15:25:01', '2015-08-23 13:25:01');
INSERT INTO `articles` VALUES(3, 'A Legal Puzzle not Easy to Solve', 'A-Legal-Puzzle-not-Easy-to-Solve', '<p style="text-align: justify;">Strange are the ways of God.&nbsp;<em>Terian tu hee jane</em>. (Only God knows how He conducts Himself)<em>,&nbsp;</em>so goes another saying. No less strange are the ways of law. The thousands of enactments that have gushed out of the statute book of our State and Central legislatures since the colonial rule and after India became free have turned our system of jurisprudence into a great ocean, unmeasurable and unfathomable. Its waters are so violent and tricky that one cannot touch the shore of one’s destination without the compass of the relevant law and a legal navigator.</p>', '<!--StartFragment--><p style="text-align: justify;">Strange are the ways of God.&nbsp;<em>Terian tu hee jane</em>. (Only God knows how He conducts Himself)<em>,&nbsp;</em>so goes another saying. No less strange are the ways of law. The thousands of enactments that have gushed out of the statute book of our State and Central legislatures since the colonial rule and after India became free have turned our system of jurisprudence into a great ocean, unmeasurable and unfathomable. Its waters are so violent and tricky that one cannot touch the shore of one’s destination without the compass of the relevant law and a legal navigator.</p><p style="text-align: justify;">The latest case which has dazzled the perception and puzzled the mind of the common man — and, to an extent, even of a legal luminary — is the latest verdict of the Punjab and Haryana High Court which on April 21, 2015 commuted to life imprisonment the death sentence of one Dharam Pal, a resident of Shahpur Turk in Sonipat (Haryana).</p><p style="text-align: justify;">He was awarded 10-year imprisonment on January 7, 1991 in a rape case&nbsp;&nbsp;Out on a parole in 1993, he and his brother Nirmal Singh murdered the rape victim’s father, mother, two brothers and a sister on June 4, 1993, though the rape victim and her husband were able to save their lives. Dharam Pal was awarded death sentence which was upheld by the Supreme Court. In 2013, the President had turned down his mercy plea in a rape case &nbsp;In 2013, the High Court had extended the stay on his execution fixed on April 15, 2013.</p><p style="text-align: justify;">While pronouncing its verdict what weighed with the court was the fact that the President took over 15 years to decide his mercy petition. The other mitigating factor was that Dharam Pal had been on bail in the rape case in which he was, later, acquitted during the pendency of mercy petition.. As a consequence, he will remain behind bars, but not executed. How does his acquittal become a “mitigating circumstance” in the heinous murder of the alleged rape victim’s five family members remains a puzzle?</p><p style="text-align: justify;">It must have ben the rarest of the rare cases in which a person who was sentenced to death, whose sentence was upheld by the Supreme Court, whose mercy petition was rejected by the President of India, and whose date of execution was also fixed, though stalled by the court, his sentence has been commuted by the High Court. This baffles the mind of the common man.</p><!--EndFragment-->', 'Legal System', NULL, NULL, NULL, '', 1, 7, '2015-08-23', '2015-08-23 15:29:27', '2015-08-23 13:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `url_name` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` VALUES(1, 'Human Rights', '', '2015-08-23 15:14:23', '2015-08-23 13:14:23');
INSERT INTO `category` VALUES(2, 'Employee Compensation', '', '2015-08-23 15:25:01', '2015-08-23 13:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(120) NOT NULL,
  `text` text NOT NULL,
  `reply_to` int(11) DEFAULT NULL,
  `show` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` VALUES(1, 2, 'Tom Harrison', 'tom.harrison@yahoo.com', 'I really love this write up. Please keep it up.', NULL, 1, '2015-08-24 17:48:53', '2015-08-24 09:48:53');
INSERT INTO `comments` VALUES(2, 2, 'Tom Harrison', 'tom.harrison@yahoo.com', 'I really love this write up. Please keep it up.', NULL, 1, '2015-08-24 17:49:20', '2015-08-24 09:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url_name` varchar(150) NOT NULL,
  `venue` varchar(500) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `details` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` VALUES(1, 'ES&A Convention Cocktail', 'esa-convention-cocktail', 'No.70 Adetokunbo Ademola Street, Victoria Island, Lagos State,Nigeria', '2015-09-04', '09:00:00', '<p>No.70 Adetokunbo Ademola Street, Victoria Island, Lagos State, Nigeria</p>', '2015-08-23 09:35:19', '2015-08-28 10:39:20');
INSERT INTO `events` VALUES(2, 'ES&A Super Marketing Conference', 'esa-super-marketing-conference', '5th Floor, Ibukun House, No.70 Adetokunbo Ademola Street,Victoria Island, Lagos State,', '2015-08-29', '09:00:00', '<p>We present to you the best Marketing Conference. </p>', '2015-08-23 09:47:35', '2015-08-28 10:39:16');
INSERT INTO `events` VALUES(3, 'Orientation for New Lawyers', 'orientation-for-new-lawyers', '5th Floor, Ibukun House, No.70 Adetokunbo Ademola Street,Victoria Island, Lagos State,', '2015-09-02', '10:00:00', '<p>Orientation for New Lawyers.</p>', '2015-08-23 09:54:33', '2015-08-28 10:39:12');
INSERT INTO `events` VALUES(4, 'ES&A End of the Year Party', 'esa-end-of-the-year-party', '5th Floor, Ibukun House, No.70 Adetokunbo Ademola Street, Victoria Island,  Lagos State,', '2015-09-21', '09:00:00', '<p>Come and celebrate with us.</p>', '2015-08-23 09:56:06', '2015-08-28 10:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(500) NOT NULL,
  `answer` text,
  `priority` int(11) NOT NULL DEFAULT '1',
  `category` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` VALUES(1, 'Tell me about Blissville Condominiums?', '<p>Our projects strategically aim at providing energy efficient luxurious condos that are well within your grasp. Unique edifices that don''t just cater for the affordability on procurement but also ensure that the lives of the occupants are enhanced at minimum running and maintenance cost. The architectural designs respond imaginatively to the cultural climatic and environment conditions as such only the most suitable materials are considered and specified. We don''t just sell homes, we guarantee your future.</p><p>We intend to continuously and progressively expand our portfolio nationwide over the next five years and provide similar housing solutions suitable for strategically selected locations like Ibeju Lekki, Porthharcourt, Uyo, Abuja and Kaduna.</p>', 1, 1, '2016-05-01 01:28:53', NULL);
INSERT INTO `faqs` VALUES(2, 'Where is Blissville Condomoniums located?', '<p>Blissville Condos will be accessible via multiple routes giving you the option of choice while on the move. Our estates will be conveniently located within the Lekki/Epe axis between Ikate and Chevron environs.</p><p>Notable locations within close proximity include;</p><ul>  <li>The new Circle Mall</li>  <li>Prince Ebeano Supermarket</li>  <li>Dreamworld Africana Amusement Park</li>  <li>Lekki Conservation Center accessories</li>  <li>Several bank branches, ATMs, plazas and filling/service stations guarantee the convenience experienced by our residents.</li></ul>', 1, 1, '2016-05-01 01:29:58', NULL);
INSERT INTO `faqs` VALUES(3, 'What are the features of Blissville Condomoniums?', '<h3>Safety and Security:</h3><p><strong>''Safety first''</strong>&nbsp;is the watch phrase as we implement several standardized security features;</p><ul>  <li>Perimeter fence, electrically protected</li>  <li>Automated gates that can be controlled right from the comfort of your home</li>  <li>Panic Alarm system</li>  <li>Fire detection and firefighting apparatus</li></ul><h3>Power and ICT:</h3><p>We have harnessed superior architectural designs with technological systems that enhance lives and save time and lots of money;</p><ul>  <li>Smart solar and inverter systems</li>  <li>Efficient lighting systems</li>  <li>Cable TV distribution network</li>  <li>Core fiber internet connectivity</li>  <li>Intercom and Gate Management</li></ul><h3>Ambience and Lifestyle:</h3><p>We provide plush luxury at affordable rates via a wide range of recreational amenities including;</p><ul>  <li>Swimming pool/ Children’s play area&nbsp;*</li>  <li>Rooftop gym/ Dance room</li>  <li>Sky lounge with exciting views</li>  <li>Dedicated parking for vehicles</li></ul>', 1, 1, '2016-05-01 01:36:07', NULL);
INSERT INTO `faqs` VALUES(4, 'Give an overview of your Investment?', '<p>Our projects strategically aim at&nbsp;<strong>providing energy efficient luxurious condominiums</strong>&nbsp;for the ever growing middle class within the Lekki suburbs. We aim to continually avail this market segment with unique edifices that are affordable to acquire and conveniently manage, while they enjoy the luxuries available in today’s real estate industry. Seasoned industry experts diligently working with proven project management methodologies will handle the day to day conceptualization, planning, execution and control of the projects.</p><p>Truth be told, we don’t just sell homes we provide peace of mind to our stakeholders.</p><p>We intend to continuously and progressively expand our portfolio nationwide over the next five years and provide similar housing solutions suitable for strategically selected locations like Ibeju Lekki, Portharcourt, Uyo, Abuja and Kaduna.</p><p><strong>We forecast that our initial projects will have&nbsp;a future valuation greater than N1.3B and an exit value of approximately N1.2B.&nbsp;We are seeking investments ranging from N80M to N200M and more to be disbursed as required by our projects over the next 24months.</strong>&nbsp;Once initiated, our projects are modeled to finance themselves via cash flow. We seek investors who share our vision of enhancing lives and the environment by providing energy efficient residential dwellings, and are willing to benefit from our exciting pipeline of projects by keying in at this inception stage.</p>', 1, 2, '2016-05-01 01:37:26', NULL);
INSERT INTO `faqs` VALUES(5, 'What are your Mid Term Forecasts?', '<p>Informed by our research results and projections, we intend to run at least 3 Blissvile Estates within the Lagos metropolis. This provides a platform to boost our brand recognition and introduce a broader range of products and services to the market.</p><p>These include but are not limited to;</p><ul>  <li>Facility Management services</li>  <li>Procurement and supply channels</li>  <li>Recreational and capacity building services</li></ul>', 1, 2, '2016-05-01 01:38:13', '2016-05-02 09:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `faqs_category`
--

CREATE TABLE `faqs_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `faqs_category`
--

INSERT INTO `faqs_category` VALUES(1, 'About Blissville Condominiums', 1, '2015-08-23 15:14:23', '2016-04-30 23:38:58');
INSERT INTO `faqs_category` VALUES(2, 'Becoming an Investor', 1, '2015-08-23 15:25:01', '2016-04-30 23:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `homepages`
--

CREATE TABLE `homepages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `homepages`
--

INSERT INTO `homepages` VALUES(1, 'Start Planning your New Dream Home with us', '<p>Security, Convenience and Comfort... well within your reach.</p>', '2016-04-24 00:27:19', '2016-05-01 02:35:41');
INSERT INTO `homepages` VALUES(2, 'Executive Summary', 'Our projects strategically aim at providing energy efficient luxurious condominiums for the ever growing middle class within the Lekki suburbs. We aim to continually avail this market segment with unique edifices that are affordable to acquire and convenient manage, while they enjoy the luxuries available in today’s real estate industry.', '2016-04-24 00:27:19', '2016-04-24 00:27:19');
INSERT INTO `homepages` VALUES(3, 'Why Choose Us', 'Our designs respond imaginatively to the cultural climatic and environment conditions as such only the most suitable materials are considered and specified. Truth be told, we don’t just sell homes we provide peace of mind to our stakeholders.', '2016-04-24 00:27:47', '2016-04-24 00:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` VALUES(1, 'Invest Today', ' <p>Blissville Condos are without a doubt one of the most viable real estate investments opportunities in the country today as we avail our esteemed investors with wonderful returns of over 50%. Our esteemed investors also have the opportunity to convert their investments into real estate units of their choice and still enjoy juicy double digit discounts.</p>', '0000-00-00 00:00:00', '2016-04-21 14:08:17');
INSERT INTO `investors` VALUES(2, 'Projected Quarterly Revenues by 2018:', '&#8358; 300,000,000', '0000-00-00 00:00:00', '2016-04-21 07:48:17');
INSERT INTO `investors` VALUES(3, 'Investment Overview', ' <p>Our projects strategically aim at <strong>providing energy efficient luxurious condominiums</strong> for the ever growing middle class within the Lekki suburbs. We aim to continually avail this market segment with unique edifices that are affordable to acquire and conveniently manage, while they enjoy the luxuries available in today’s real estate industry. Seasoned industry experts diligently working with proven project management methodologies will handle the day to day conceptualization, planning, execution and control of the projects.</p>\n\n                                    <p style="color:#446cb3;" class="lead">Truth be told, we don’t just sell homes we provide peace of mind to our stakeholders.</p>\n\n                                    <p>We intend to continuously and progressively expand our portfolio nationwide over the next five years and provide similar housing solutions suitable for strategically selected locations like Ibeju Lekki, Portharcourt, Uyo, Abuja and Kaduna. </p>\n\n                                    <p><strong>We forecast that our initial projects will have <span style="color: #446cb3">a future valuation greater than N1.3B and an exit value of approximately N1.2B.</span> We are seeking investments ranging from N80M to N200M and more to be disbursed as required by our projects over the next 24months.</strong> Once initiated, our projects are modeled to finance themselves via cash flow. We seek investors who share our vision of enhancing lives and the environment by providing energy efficient residential dwellings, and are willing to benefit from our exciting pipeline of \n                                    projects by keying in at this inception stage. </p>', '0000-00-00 00:00:00', '2016-04-21 07:46:14');
INSERT INTO `investors` VALUES(4, 'Project Hightlights', '<p>The Blissville Condominiums Lifestyle housing estates will be introduced into the market using two (2) kick-off projects;</p>\n                                <table class="table table-bordered table-striped">\n                                    <tr>\n                                        <th>PROJECT 1</th>\n                                    </tr>\n                                    <tr>\n                                        <td>A 1,400M<sup>2</sup> expanse of land (Identified) situate off Alpha beach road valued at N60M.</td>\n                                    </tr>\n                                    <tr>\n                                        <th>PROJECT 2</th>\n                                    </tr>\n                                    <tr>\n                                        <td>At least 3,000M<sup>2</sup> expanse of land within the suburbs of Lekki, with a projected value less than N200M.</td>\n                                    </tr>\n                                </table>\n                                <p>Once initiated, our projects are modeled to finance themselves via cash flow.</p>', '0000-00-00 00:00:00', '2016-04-21 07:46:51');
INSERT INTO `investors` VALUES(5, 'Investment', '&#8358; 200,000,000', '0000-00-00 00:00:00', '2016-04-21 07:48:57');
INSERT INTO `investors` VALUES(6, 'Project cost', '&#8358; 720,000,000', '0000-00-00 00:00:00', '2016-04-21 07:50:07');
INSERT INTO `investors` VALUES(7, 'Exit Value ', '&#8358; 1,200,000,000', '0000-00-00 00:00:00', '2016-04-21 07:50:07');
INSERT INTO `investors` VALUES(8, 'Mid-Term Forecast', '                                    <p>Informed by our research results and projections, we intend to run at least 3 Blissvile Estates within the Lagos metropolis. This provides a platform to boost our brand recognition and introduce a broader range of products and services to the market.</p>\r\n\r\n                                    <p>These include but are not limited to;</p>\r\n                                    <ul>\r\n                                        <li>Facility Management services</li>\r\n                                        <li>Procurement and supply channels</li>\r\n                                        <li>Recreational and capacity building services</li>\r\n                                    </ul>', '0000-00-00 00:00:00', '2016-04-21 07:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `value` text,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` VALUES(1, 'address', '<address><strong>Office Address 1:</strong><br>  5th Floor, Ibukun House,<br>  No.70 Adetokunbo Ademola Street,<br>  Victoria Island,<br>  Lagos.<br><strong>Office Address 2:</strong><br>  Suite 10C, Yomade Complex,<br>  Lekki-Epe Expressway,<br>  Awoyaya, Lagos.  </address>', '2015-08-16 20:49:59', '2016-05-01 01:56:59');
INSERT INTO `options` VALUES(2, 'phone', '0802-833-7440', '2015-08-16 20:49:59', '2016-05-01 01:55:34');
INSERT INTO `options` VALUES(3, 'email', 'info@highrachy.com', '2015-08-16 20:49:59', '2016-05-01 01:57:14');
INSERT INTO `options` VALUES(4, 'facebook', 'https://www.facebook.com/highrachy-investment', '2015-08-16 20:49:59', '2015-08-17 07:18:56');
INSERT INTO `options` VALUES(5, 'twitter', 'http://twitter.com/highrachy', '2015-08-16 20:49:59', '2015-08-17 07:19:16');
INSERT INTO `options` VALUES(6, 'linkedin', 'http://www.linkedin.com/highrachyinvestment', '2015-08-16 20:49:59', '2015-08-17 07:19:40');
INSERT INTO `options` VALUES(7, 'youtube', 'http://www.linkedin.com/highrachyinvestment', '2015-08-16 20:49:59', '2015-08-17 07:19:40');
INSERT INTO `options` VALUES(8, 'menu', NULL, '2015-08-30 00:00:00', '2016-05-01 02:32:14');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `sidebar` text,
  `tagline` mediumtext,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` VALUES(1, 'Home', '', '<p>We ensure our clients success via a unique blend of legal expertise and impeccable service delivery standards.</p>', '2013-07-01 18:10:22', NULL, NULL);
INSERT INTO `pages` VALUES(2, 'About', '<p><span style="color: #b9b9b9;">Elvira Salleras &amp; Associates has provided trusted counsel and forward-thinking legal solutions to clients throughout many industries in Nigeria and all over the world.</span></p>', '<p>We have never lost a case</p>', '2013-03-06 23:40:50', NULL, NULL);
INSERT INTO `pages` VALUES(3, 'Legal Clinic', 'At Elvira Salleras & Associates, We provide a wide range of services which includes :', '<p>We&rsquo;ve got a wide range of legal services.</p>', '2013-09-25 07:43:20', NULL, NULL);
INSERT INTO `pages` VALUES(4, 'Practise Area', '<p>At Elvira Salleras &amp; Associates, We give our clients legal advice, we draft legal documents for our clients, and represent our clients in legal negotiations and court preceedings. Our major Practise Areas are:</p>', '<p>We are the best in Law Practices</p>', '2013-06-06 03:19:41', NULL, NULL);
INSERT INTO `pages` VALUES(5, 'Our People', 'Elvira Salleras & Associates is made up of executive team members. They are:', 'We are committed to helping our clients succeed', '2014-02-18 02:20:17', NULL, NULL);
INSERT INTO `pages` VALUES(6, 'Contact Us', NULL, 'We will really love to hear from you.', '2013-03-02 00:47:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text,
  `price` decimal(10,0) NOT NULL DEFAULT '0',
  `property_type` varchar(255) DEFAULT NULL,
  `floor` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `bedroom` smallint(6) NOT NULL DEFAULT '0',
  `living_room` smallint(6) NOT NULL DEFAULT '0',
  `washroom` smallint(6) NOT NULL DEFAULT '0',
  `parking_lots` smallint(6) NOT NULL DEFAULT '0',
  `cable_tv` varchar(3) DEFAULT 'YES',
  `core_fibre` varchar(3) DEFAULT 'YES',
  `inverter` varchar(3) DEFAULT 'YES',
  `security_fence` varchar(3) DEFAULT 'YES',
  `car_port` varchar(3) DEFAULT 'YES',
  `guest_toilet` varchar(3) DEFAULT 'YES',
  `guest_room` varchar(3) DEFAULT 'YES',
  `maid_room` varchar(3) DEFAULT 'YES',
  `surveillance` varchar(3) DEFAULT 'YES',
  `smart_solar` varchar(3) DEFAULT 'YES',
  `panic_alarm` varchar(3) DEFAULT 'YES',
  `intercom` varchar(3) DEFAULT 'YES',
  `video_door` varchar(3) DEFAULT 'YES',
  `fire_detection` varchar(3) DEFAULT 'YES',
  `swimming_pool` varchar(3) DEFAULT 'YES',
  `rooftop_gym` varchar(3) DEFAULT 'YES',
  `priority` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` VALUES(1, 'Our Property', '<p>Our homes are affordable and still have the perks that come with a healthy luxurious lifestyle, hence property acquisition costs are low with juicy returns from rentals making Blissville the ideal investors destination.</p>', 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 1, '2016-04-24 03:16:26', '2016-05-01 01:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `slideshows`
--

CREATE TABLE `slideshows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `description` varchar(500) NOT NULL,
  `link_text` varchar(250) NOT NULL,
  `link_page` varchar(100) NOT NULL,
  `buy_now` varchar(3) NOT NULL DEFAULT 'YES',
  `price` decimal(10,0) NOT NULL DEFAULT '0',
  `picture` varchar(60) NOT NULL,
  `show_picture` varchar(10) NOT NULL DEFAULT 'YES',
  `priority` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `slideshows`
--

INSERT INTO `slideshows` VALUES(1, '4 Bedroom Apartments', 'Elevated 4 bedroom apartments with a maids room, with four and a half bathrooms, living room, dining space, kitchen, guest toilet and dedicated parking lots. ', 'Learn More', '4-bedroom-apartments.php', 'YES', 35000000, 'slide-2.jpg', 'YES', 2, '2016-04-24 08:55:22', '2016-07-07 14:00:51');
INSERT INTO `slideshows` VALUES(2, '5 Bedroom Terraces', '5 bedroom Semi – Detached Terrace houses (a guest room and a maids room inclusive) with five and a half bathrooms, Living room, dining room, entry foyer, guest toilet, personal yard and a dedicated carport.', 'Learn More', '5-bedroom-terraces.php', 'YES', 45000000, 'slide-3.jpg', 'YES', 1, '2016-04-24 08:58:03', '2016-07-07 14:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `company` varchar(250) NOT NULL,
  `testimonials` text NOT NULL,
  `approved` varchar(10) NOT NULL,
  `added` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` VALUES(1, '2012/2013 Externs', 'oladele@yahoo.com', 'Nigerian Law School', '<p>A dynamic leader with an excellent spirit, an invaluable legal team of professionals,&nbsp;a radiating family. We are indeed privileged to have experienced the values entrenched on these walls.</p>\r\n<p>A good place to be a great place to grow!!</p>', 'YES', '2013-07-01 23:22:39', NULL, '2014-03-11 00:26:36');
INSERT INTO `testimonials` VALUES(2, 'Simon Rose', '', 'United Biscuits (UK) Ltd', '<p>Elvira Salleras and Associates have proved themselves to be an excellent business partner for United Biscuits in helping to set up and support our growing Nigerian business.</p>\r\n<p>Elvira and her team provide practical and timely advice, efficiently and with good humour - they are a pleasure to work with!</p>', 'YES', '', '2014-04-01 23:29:45', '2014-04-01 15:32:46');
INSERT INTO `testimonials` VALUES(3, 'Klaus Gautsh', '', 'European Union', '<p><span style="font-size: x-small;">We take this opportunity to congratulate Daisy, Elvira Salleras and the General Practice team from Elvira Salleras &amp; Associates for today''s great success in obtaining the guardianship Order for Dorcas. Your relentless efforts and continued support made this great achievement possible. A huge load has been lifted from us, especially from Seble. Leaving Dorcas behind at the orphanage would have haunted her for the rest of her life. We have no words to thank you for the enormous support we got from members of your team. Thanks to you, the children now legally have a loving home for years to come, and Peace and Praise&nbsp;will benefit from good education as the basis for a happy and prosperous life. Dorcas too will benefit from a loving family environment.... Thanks again for this wonderful achievement.</span></p>', 'YES', '', '2015-05-27 13:53:22', '2015-05-27 06:49:43');
INSERT INTO `testimonials` VALUES(4, 'Seble & Klaus Gautsh', '', 'European Union', '<p><span style="font-size: x-small;">This is really a big step forward and we want to take this opportunity to thank you Elvira Salleras&nbsp;and your colleagues at Elvira Salleras &amp; Associates from the bottom of our hearts for their support, passion and the countless hours of work they have invested in these cases. Eventually we managed to obtain two(2) guardianship Orders within one week. This is way beyond our expectations and dreams. Our special thanks goes to Daisy who has been in the forefront during these last months and has done a fantastic job. It is only through her strong will, determination and commitment that today''s great success was possible. Thank you so much for that wonderful gift Daisy....</span></p>', 'YES', '', '2015-05-27 14:14:47', '2015-05-27 06:48:19');
INSERT INTO `testimonials` VALUES(5, 'Jacques Picarle', '', 'Citoyen Français', '<p><span style="font-size: medium;"><span style="font-family: ''Calibri'',sans-serif; mso-ascii-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: Arial; mso-ansi-language: FR;" lang="FR">Je me permets ce bref message car je souhaite vivement porter &agrave; votre attention la qualit&eacute; et la fiabilit&eacute; des conseils et</span><span style="font-family: ''Calibri'',sans-serif; mso-ascii-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: Arial; mso-ansi-language: FR;" lang="FR">interventions de Madame Annie HERPIN de votre Consulat &agrave; Lagos et de Madame&nbsp; Elvira SALLERAS, votre Avocat Conseil, &eacute;galement bas&eacute; &agrave; Lagos.</span></span></p>\r\n<p><span style="font-size: medium;"><span style="font-family: ''Calibri'',sans-serif; mso-ascii-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: Arial; mso-ansi-language: FR;" lang="FR">En effet, dans le cadre d&rsquo;un dossier &agrave; envergure internationale que je devais construire, une des conditions requises</span><span style="font-family: ''Calibri'',sans-serif; mso-ascii-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: Arial; mso-ansi-language: FR;" lang="FR">exigeait la fourniture d&rsquo;un &ldquo;Police Character Certificate&rdquo; &agrave; obtenir aupr&egrave;s de la Nigerian Police Force dont les bureaux sont &agrave;</span><span style="font-family: ''Calibri'',sans-serif; mso-ascii-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: Arial; mso-ansi-language: FR;" lang="FR">Ikoyi. Or une d&eacute;marche par courrier, c&rsquo;est-&agrave;-dire DHL &agrave; partir de Paris &eacute;tait vou&eacute;e &agrave; l&rsquo;&eacute;chec. Il fallait donc s&rsquo;appuyer sur un</span><span style="font-family: ''Calibri'',sans-serif; mso-ascii-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: Arial; mso-ansi-language: FR;" lang="FR">relais local comp&eacute;tant et efficace. Ce f&ucirc;t le cas pour Madame HARPIN et Madame SALLERAS, chacune dans leur r&ocirc;le.</span></span></p>\r\n<p>&nbsp;</p>', 'YES', '', '2015-06-10 13:26:49', '2015-06-10 05:58:25');
INSERT INTO `testimonials` VALUES(6, 'Jacques PICARLE  (TRANSLATED)', '', 'French Citizen', '<p><span style="font-size: small;">I strongly wish to bring to your attention the quality and reliability of the advice and actions of Madame Annie HERPIN your Consulate in Lagos and&nbsp;Mrs. Elvira Salleras, your Board Lawyer, also based in Lagos.</span></p>\r\n<p><span style="font-size: small;">As part of a major international issue that I had to build, one of the conditions required the provision of a "Police Character Certificate" to be obtained from the Nigerian Police Force with office in Ikoyi.&nbsp;The process by mail, through DHL from Paris was doomed to failure. We had to rely on a competent and effective local relay. This was the case for Madame HARPIN and Mrs. Elvira Salleras, each in their role</span>.</p>', 'YES', '', '2015-06-10 13:56:08', '2015-06-10 05:59:57');
INSERT INTO `testimonials` VALUES(7, 'Klaus-Dieter Gautsch & Seblewongel ', '', 'European Union', '<p>Given our very positive experience, both at professional and personal levels, we have no hesitation whatsoever in recommending the Law Firm, Elvira Salleras &amp; Associates for any legal support and representation on child adoption, child guardianship, child custody or related matters.</p>\r\n<p>This to express our profound gratitude and appreciation to Elvira Salleras and the entire team of the Law firm, Elvira Salleras &amp; Associates (ES&amp;A) through whose outstanding committment, dedication and support we were successful in obtaining legal guardianship for three needy children from an orphanage in Abuja.</p>\r\n<p>Because the interpretation of the Child Rights act by the Federal Capital Territory (FCT) administration does not support the adoption of Nigerian children by non-Nigerians, the ES&amp;A team introduced our applications for legal guardianship over the children at the High Court of the FCT instead. The convincing legal presentation prepared by ES&amp;A team and the right choice of supporting documents resulted in three successful guardianship orders thereby transferring the children under our custody until they reach majority. we understand that these High Court orders transferring legal guardianship over Nigerian children to non-Nigerians are a NOVUM in FCT and thus represent a landmark judgment of reference which will be very helpful for similar future guardianship applications by third parties.</p>\r\n<p>The ES&amp;A team did not spear any effort, they worked late evenings and weekends in order to expedite the legal process so that all guardianship orders could be obtained in time before our final departure from Nigeria.</p>\r\n<p>Special thanks to Elvira Salleras for her relentless support and valuable legal advice throughout the entire process, and Daisy Yusuf for her successful and dilligent handling of our cases at court level in Abuja. We also thank other members of the ES&amp;A team for their swift and efficient support whenever needed.</p>\r\n<p>&nbsp;</p>', 'YES', '', '2015-06-23 08:38:28', '2015-06-23 00:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `post` varchar(200) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'Administrator', 'admin@elvirasallerasandassociates.com', '$2a$08$eJAZ0QHwiFnkyavQsG9db.GqrEEbmipzVCcU0Yga.fhWRIeqHVuHO', 'Managing Director', 'administrator.jpg', '0000-00-00 00:00:00', '2014-02-19 12:18:24');
