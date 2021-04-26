-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2021 at 05:37 AM
-- Server version: 5.7.33-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mx_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) UNSIGNED NOT NULL,
  `action_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `action_name`) VALUES
(1, 'Collaboration with other organisations '),
(2, 'General promotion '),
(3, 'Intervention from statutory bodies '),
(4, 'More funding '),
(5, 'Raising awareness/ campaigning on the topic '),
(6, 'Research '),
(7, 'Training'),
(8, 'Other (please explain) ');

-- --------------------------------------------------------

--
-- Table structure for table `age_ranges`
--

CREATE TABLE `age_ranges` (
  `id` int(11) UNSIGNED NOT NULL,
  `range_name` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `age_ranges`
--

INSERT INTO `age_ranges` (`id`, `range_name`, `order`) VALUES
(1, '0-16', 10),
(2, '16-25', 11),
(3, '25-40', 12),
(5, '40-65', 13),
(6, '65-75', 14),
(7, '75+', 15),
(8, 'Not relevant', 1);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) UNSIGNED NOT NULL,
  `area_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `is_active` enum('y','n') NOT NULL DEFAULT 'y',
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_active`, `description`) VALUES
(1, 'Issue', 'y', 'A problem or concern that you are picking up e.g. Lack of access to online schooling as they do not have the technology'),
(2, 'Impact', 'y', 'A positive impact you are hearing about'),
(3, 'Idea', 'y', 'A possible solution to the issues and challenges you are facing, or an action that could be taken, e.g. An idea for a new project, requirements / collaborations needed?'),
(4, 'Interest', 'y', 'An interest you, your organisation or your services users have (e.g. a new area of work you would like to explore, a new service that would be beneficial to introduce etc)');

-- --------------------------------------------------------

--
-- Table structure for table `CISessions`
--

CREATE TABLE `CISessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` int(11) UNSIGNED NOT NULL,
  `submitted_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `organisation_id` int(11) DEFAULT NULL,
  `reviewed` enum('y','n') DEFAULT 'n',
  `brief` text,
  `detailed` mediumtext,
  `category` int(11) DEFAULT NULL,
  `impact_number` int(11) DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `action_alternate` text,
  `contact_name` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(100) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `issue_age_map`
--

CREATE TABLE `issue_age_map` (
  `id` int(11) UNSIGNED NOT NULL,
  `issue_id` int(11) DEFAULT NULL,
  `age_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `issue_keyword_map`
--

CREATE TABLE `issue_keyword_map` (
  `id` int(11) UNSIGNED NOT NULL,
  `issue_id` int(11) DEFAULT NULL,
  `keyword_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `issue_location_map`
--

CREATE TABLE `issue_location_map` (
  `id` int(11) UNSIGNED NOT NULL,
  `issue_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `is_active` enum('y','n') NOT NULL DEFAULT 'y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `name`, `is_active`) VALUES
(1, 'Represention of local community ', 'y'),
(2, 'Representation of whole of Milton Keynes', 'y'),
(3, 'Represention - nationally or globally', 'y'),
(4, 'Representing self', 'y'),
(6, 'Climate change action ', 'y'),
(7, 'Energy or water use ', 'y'),
(8, 'Food relating to climate change', 'y'),
(9, 'Housing & developments relating to climate change', 'y'),
(10, 'Packaging / plastic use ', 'y'),
(11, 'Recycling or re-use', 'y'),
(12, 'Transport relating to climate change ', 'y'),
(13, 'Domestic abuse ', 'y'),
(14, 'Disproportionate impacts', 'y'),
(15, 'Newly vulnerable', 'y'),
(16, 'Financial impacts', 'y'),
(17, 'Physical health impacts', 'y'),
(18, 'Mental health impacts', 'y'),
(19, 'Covid social / behavioural restrictions', 'y'),
(20, 'Education', 'y'),
(21, 'Voluntary response / neighbourhood support', 'y'),
(22, 'Anti Social Behaviour', 'y'),
(23, 'Begging', 'y'),
(24, 'Fly tippers ', 'y'),
(25, 'Intimidating behaviour', 'y'),
(26, 'Street drinking / drug taking ', 'y'),
(27, 'Violent behaviour ', 'y'),
(28, 'Young Person Crime ', 'y'),
(29, 'Community safety', 'y'),
(30, 'Road Safety ', 'y'),
(31, 'Arrival to new community', 'y'),
(32, 'Facilities in new communities ', 'y'),
(33, 'Homes in new developments ', 'y'),
(34, 'MK Futures / City planning ', 'y'),
(35, 'New communities', 'y'),
(36, 'Oxford to Cambridge Arc ', 'y'),
(37, 'Roads, pavements and access re new communities', 'y'),
(38, 'Adult education ', 'y'),
(39, 'Early years', 'y'),
(40, 'ESOL (English for Speakers of Different Languages)', 'y'),
(41, 'Extra curricular activity ', 'y'),
(42, 'Post 16', 'y'),
(43, 'School', 'y'),
(44, 'SEN (special educational needs)', 'y'),
(45, 'Training', 'y'),
(46, 'Childcare (in order to work)', 'y'),
(47, 'Employed ', 'y'),
(48, 'Employment support services', 'y'),
(49, 'Self-employed ', 'y'),
(50, 'Unemployed', 'y'),
(51, 'Unpaid work ', 'y'),
(52, 'Work experience ', 'y'),
(53, 'Fly tipping', 'y'),
(54, 'Neighbourhood management ', 'y'),
(55, 'Parking ', 'y'),
(56, 'Parks and open spaces ', 'y'),
(57, 'Physical disabilities', 'y'),
(58, 'Racial issues', 'y'),
(59, 'Learning disabilities ', 'y'),
(60, 'LGBTQ+', 'y'),
(61, 'Access to family related support ', 'y'),
(62, 'Access childcare', 'y'),
(63, 'Children\'s Centres', 'y'),
(64, 'Family breakdown', 'y'),
(65, 'Maternity/Paternity ', 'y'),
(66, 'Parenting', 'y'),
(67, 'Benefits', 'y'),
(68, 'Budgeting ', 'y'),
(69, 'Debt', 'y'),
(70, 'Poverty / hardship ', 'y'),
(71, 'Low income ', 'y'),
(72, 'Access to health services (e.g. Doctors, Hospitals etc)', 'y'),
(73, 'Emotional support (e.g. Bereavement, Therapy and Counselling) ', 'y'),
(74, 'Physical health', 'y'),
(75, 'Mental health ', 'y'),
(76, 'Isolation / loneliness', 'y'),
(77, 'Carers', 'y'),
(78, 'Rough sleeping ', 'y'),
(79, 'Access to statutory support services', 'y'),
(80, 'Access to community, voluntary and charitable support services ', 'y'),
(81, 'Sofa-Surfing', 'y'),
(82, 'Temporary homelessness (in temporary accommodation)', 'y'),
(83, 'Cold weather emergency ', 'y'),
(84, 'Homelessness overnight accommodation ', 'y'),
(85, 'HIMOs (houses in multiple occupancy)', 'y'),
(86, 'House Swap', 'y'),
(87, 'New home', 'y'),
(88, 'Regeneration', 'y'),
(89, 'Repairs ', 'y'),
(90, 'Traveller\'s sites', 'y'),
(91, 'Community facilities ', 'y'),
(92, 'Libraries', 'y'),
(93, 'Police', 'y'),
(94, 'Prison', 'y'),
(95, 'Social services', 'y'),
(96, 'Transport', 'y'),
(97, 'Youth Services ', 'y'),
(98, 'Advice and information', 'y'),
(99, 'Community activity / community development', 'y'),
(100, 'Community hubs ', 'y'),
(101, 'Community led planning and action', 'y'),
(102, 'Funding', 'y'),
(103, 'Voluntary and Community Sector (activity, services, issues)', 'y'),
(104, 'Service delivery', 'y'),
(105, 'Support to VCS (Voluntary & Community Sector) ', 'y'),
(106, 'Volunteering ', 'y'),
(107, 'Training ', 'y'),
(110, 'Access to cultural activities ', 'y'),
(111, 'Heritage', 'y'),
(112, 'Performing Arts ', 'y'),
(113, 'Arts for Health & Wellbeing', 'y'),
(114, 'Public Arts', 'y'),
(115, 'Visual Arts', 'y'),
(116, 'Venues (including music venues, theatres, museums etc) ', 'y'),
(117, 'No access to internet', 'y'),
(118, 'Damaged tech goods', 'y'),
(119, 'Not able to get a SIM card', 'y'),
(120, 'Can\'t afford updated technology / tools needed', 'y'),
(121, 'Can\'t use various technology', 'y'),
(122, 'Can\'t access online courses / classes / support', 'y'),
(123, 'Impact on Environment', 'y'),
(124, 'Animal Welfare', 'y'),
(125, 'Local Waterways', 'y'),
(126, 'Community Allotments', 'y'),
(127, 'Befriending', 'y'),
(128, 'Bereavement', 'y'),
(129, 'Sports Clubs', 'y'),
(130, 'Sport and Leisure', 'y'),
(131, 'Gyms', 'y'),
(132, 'Exercise', 'y'),
(133, 'Representing specific issues', 'y'),
(134, 'Food distribution required due to Pandemic', 'y'),
(135, 'Hate crime', 'y'),
(136, 'Sexual abuse', 'y'),
(137, 'Regeneration', 'y'),
(138, 'Mentoring', 'y'),
(139, 'Conservation', 'y'),
(140, 'Inclusive communications', 'y'),
(141, 'Racial issues', 'y'),
(142, 'Refugees & Asylum Seekers', 'y'),
(143, 'Religion or Belief', 'y'),
(144, 'Social Justice', 'y'),
(145, 'Mediation', 'y'),
(146, 'Food poverty', 'y'),
(147, 'Sexual Health', 'y'),
(148, 'Substance mis-use', 'y'),
(149, 'Voluntary and Community Sector (activity, services, issues)', 'y'),
(150, 'Community sector advice / guidance', 'y'),
(151, 'Community sector led food provision', 'y'),
(152, 'Community sector older person\'s activities / support', 'y'),
(153, 'Community sector Youth Provision', 'y'),
(154, 'Age', 'y'),
(155, 'Disability', 'y'),
(156, 'Gender reassignment', 'y'),
(157, 'Marriage and civil partnership', 'y'),
(158, 'Pregnancy and maternity', 'y'),
(159, 'Race', 'y'),
(160, 'Religion or belief', 'y'),
(161, 'Sex', 'y'),
(162, 'Sexual orientation', 'y'),
(163, 'Free school meals schemes', 'y'),
(164, 'Local authority', 'y'),
(165, 'Older Person\'s Services/ Provision', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) UNSIGNED NOT NULL,
  `location` varchar(100) NOT NULL DEFAULT '',
  `parish_id` int(11) DEFAULT '49',
  `order_id` int(11) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location`, `parish_id`, `order_id`) VALUES
(1, 'Ashland', 35, 10),
(2, 'Atterbury', 6, 10),
(3, 'Bancroft', 36, 10),
(4, 'Bancroft Park', 49, 10),
(5, 'Beanhill', 48, 10),
(6, 'Blakelands', 17, 10),
(7, 'Bleak Hall', 48, 10),
(8, 'Bletchley', 3, 10),
(9, 'Blue Bridge', 36, 10),
(10, 'Bolbeck Park', 17, 10),
(11, 'Bradville', 36, 10),
(12, 'Bradwell', 5, 10),
(13, 'Bradwell Abbey', 5, 10),
(14, 'Bradwell Common', 5, 10),
(15, 'Brinklow', 20, 10),
(16, 'Brook Furlong', 6, 10),
(17, 'Brooklands', 6, 10),
(18, 'Broughton', 6, 10),
(19, 'Browns Wood', 40, 10),
(20, 'Caldecotte', 40, 10),
(21, 'Campbell Park', 8, 10),
(22, 'Central Milton Keynes', 10, 10),
(23, 'Church Farm', 40, 10),
(24, 'Coffee Hall', 48, 10),
(25, 'Conniburrow', 17, 10),
(26, 'Crownhill', 33, 10),
(27, 'Denbigh', 3, 10),
(28, 'Denbigh Hall', 3, 10),
(29, 'Denbigh East', 3, 10),
(30, 'Denbigh West', 3, 10),
(31, 'Downs Barn', 17, 10),
(32, 'Downhead Park', 17, 10),
(33, 'Eagle Farm', 42, 10),
(34, 'Eaglestone', 48, 10),
(35, 'Elfield Park', 48, 10),
(36, 'Emerson Valley', 32, 10),
(37, 'Fairfields', 15, 10),
(38, 'Fen Farm', 42, 10),
(39, 'Fishermead', 8, 10),
(40, 'Fox Milne', 6, 10),
(41, 'Fullers Slade', 38, 10),
(42, 'Furzton', 32, 10),
(43, 'Galley Hill', 38, 10),
(44, 'Gifford Park', 17, 10),
(45, 'Glebe Farm', 42, 10),
(46, 'Granby', 3, 10),
(47, 'Grange Farm', 33, 10),
(48, 'Great Holm', 24, 10),
(49, 'Great Linford', 17, 10),
(50, 'Greenleys', 47, 10),
(51, 'Hazeley', 33, 10),
(52, 'Heelands', 5, 10),
(53, 'Hodge Lea', 47, 10),
(54, 'Kents Hill', 20, 10),
(55, 'Kents Hill Park', 20, 10),
(56, 'Kiln Farm', 1, 10),
(57, 'Kingsmead', 32, 10),
(58, 'Kingston', 20, 10),
(59, 'Knowlhill', 24, 10),
(60, 'Leadenhall', 48, 10),
(61, 'Linford Wood', 36, 10),
(62, 'Loughton', 24, 10),
(63, 'Loughton Lodge', 24, 10),
(64, 'Magna Park', 42, 10),
(65, 'Medbourne', 33, 10),
(66, 'Middleton', 6, 10),
(67, 'Milton Keynes Village', 6, 10),
(68, 'Monkston', 20, 10),
(69, 'Monkston Park', 20, 10),
(70, 'Mount Farm', 3, 10),
(71, 'Neath Hill', 17, 10),
(72, 'Neatherfield', 48, 10),
(73, 'New Bradwell', 26, 10),
(74, 'Newlands', 8, 10),
(75, 'Newton Leys', 43, 10),
(76, 'Northfield', 6, 10),
(77, 'Oakgrove', 6, 10),
(78, 'Oakhill', 33, 10),
(79, 'Oakridge Park', 36, 10),
(80, 'Oldbrook', 8, 10),
(81, 'Old Farm Park', 40, 10),
(82, 'Old Wolverton', 47, 10),
(83, 'Oxley Park', 33, 10),
(84, 'Oxley Woods', 33, 10),
(85, 'Peartree Bridge', 48, 10),
(86, 'Pennylands', 17, 10),
(87, 'Pineham', 6, 10),
(88, 'Redhouse Park', 17, 10),
(89, 'Redmoor', 48, 10),
(90, 'Rooksley', 5, 10),
(91, 'Shenley Brook End', 32, 10),
(92, 'Shenley Church End', 33, 10),
(93, 'Shenley Lodge', 32, 10),
(94, 'Shenley Wood', 33, 10),
(95, 'Simpson', 35, 10),
(96, 'Snelshall East', 32, 10),
(97, 'Snelshall West', 32, 10),
(98, 'Springfield', 8, 10),
(99, 'Stacey Bushes', 47, 10),
(100, 'Stantonbury', 36, 10),
(101, 'Stonebridge', 47, 10),
(102, 'Stony Stratford', 38, 10),
(103, 'Tattenhoe', 32, 10),
(104, 'Tattenhoe Park', 32, 10),
(105, 'Tilbrook', 40, 10),
(106, 'Tinkers Bridge', 48, 10),
(107, 'Tongwell', 17, 10),
(108, 'Towergate', 40, 10),
(109, 'Two Mile Ash', 1, 10),
(110, 'Walnut Tree', 40, 10),
(111, 'Walton', 40, 10),
(112, 'Walton Hall', 40, 10),
(113, 'Walton Park', 40, 10),
(114, 'Wavendon', 42, 10),
(115, 'West Ashland', 35, 10),
(116, 'Westcroft', 32, 10),
(117, 'Whitehouse Park', 45, 10),
(118, 'Willen', 8, 10),
(119, 'Willen Park', 8, 10),
(120, 'Winterhill', 8, 10),
(121, 'Wolverton', 47, 10),
(122, 'Wolverton Mill', 47, 10),
(123, 'Woolstone', 8, 10),
(124, 'Woughton-on-the-Green', 29, 10),
(125, 'Woughton Park', 29, 10),
(126, 'Wymbush', 1, 10),
(127, 'All of MK', 49, 1),
(128, 'N/A', 49, 2),
(131, 'Astwood', 2, 10),
(132, 'Hardmead', 2, 10),
(133, 'Woburn Sands', 46, 10),
(134, 'Aspley Guise', 46, 10),
(135, 'Weston Underwood', 44, 10),
(136, 'Old Bletchley', 43, 10),
(137, 'West Bletchley', 43, 10),
(138, 'Far Bletchley', 43, 10),
(139, 'Warrington', 41, 10),
(140, 'Filgrave', 39, 10),
(141, 'Tyringham', 39, 10),
(142, 'Stoke Goldington', 37, 10),
(143, 'Sherington', 34, 10),
(144, 'Ravenstone', 31, 10),
(145, 'Olney', 30, 10),
(146, 'Passmore', 29, 10),
(147, 'North Crawley', 28, 10),
(148, 'Newport Pagnell', 27, 10),
(149, 'Moulsoe', 25, 10),
(150, 'Little Brickhill', 23, 10),
(151, 'Lavendon', 22, 10),
(152, 'Lathbury', 21, 10),
(153, 'Haversham', 19, 10),
(154, 'Little Linford', 19, 10),
(155, 'Hanslope', 18, 10),
(156, 'Gayhurst', 16, 10),
(157, 'Emberton', 14, 10),
(158, 'Cold Brayfield', 13, 10),
(159, 'Clifton Reynes', 12, 10),
(160, 'Newton Blossomville', 12, 10),
(161, 'Chicheley', 11, 10),
(162, 'Castlethorpe', 9, 10),
(163, 'Calverton', 7, 10),
(164, 'Lower Meald', 7, 10),
(165, 'Middle Weald', 7, 10),
(166, 'Upper Meald', 7, 10),
(167, 'Broughton Manor', 49, 10),
(168, 'Bradwell Village', 5, 10),
(169, 'Bow Brickhill', 4, 10),
(170, 'Brickfields', 3, 10),
(171, 'Central Bletchley', 49, 10),
(172, 'Fenny Stratford', 3, 10),
(173, 'Fenny Lock', 3, 10),
(174, 'Water Eaton', 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `organisations`
--

CREATE TABLE `organisations` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `area` int(11) DEFAULT NULL,
  `external_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organisations`
--

INSERT INTO `organisations` (`id`, `name`, `area`, `external_id`) VALUES
(1, 'Stoke Goldington Helping Out', 1, NULL),
(2, 'Castlethorpe Parish', 1, NULL),
(3, 'Olney Town Council', 1, NULL),
(4, 'Milton Keynes Community Support Group', 1, NULL),
(5, 'BID (Sensory Advice Resource Centre)', 8, NULL),
(6, 'Hanslope Village Hall', 1, NULL),
(7, 'Castlethorpe Parish Council Clerk', 1, NULL),
(8, 'Lavendon Baptist Church', 1, NULL),
(9, 'Men in Sheds', 2, NULL),
(10, 'Carers MK', 8, NULL),
(11, 'ARC MK (Addiction Recovery Centre)', 8, NULL),
(12, 'Woughton Community Council', 2, NULL),
(13, 'Fishermead Community Fridge', 2, NULL),
(14, 'Netherfield Residents Association', 2, NULL),
(15, 'Food Bank Xtra', 8, NULL),
(16, 'Central Milton Keynes Town Council', 2, NULL),
(17, 'PCSOs Woughton and Campbell Park', 2, NULL),
(18, 'The Church of Jesus Christ of Latter-Day Saints', 2, NULL),
(19, 'Fawcett Society', 8, NULL),
(20, 'Stantonbury Parish Council', 3, NULL),
(21, 'Great Linford Parish Council', 3, NULL),
(22, 'Newport Pagnell United Reformed Church', 3, NULL),
(23, 'Blakelands Resident', 3, NULL),
(24, 'Bradville Residents Association', 3, NULL),
(25, 'MK Community Covid Group - Great Linford', 3, NULL),
(26, 'MK Coronavirus Community Support', 8, NULL),
(27, 'MK Council Youth Forum', 3, NULL),
(28, 'Wolverton and Greenleys Town Council', 4, NULL),
(29, 'Galley Hill Residents Association', 4, NULL),
(30, 'MKC Traveller Liaison Team', 8, NULL),
(31, 'Fullers Slade Residents Association', 4, NULL),
(32, 'MK Council Support Team', 8, NULL),
(33, 'Bradwell Parish Council', 4, NULL),
(34, 'Stony Stratford Town Council', 4, NULL),
(35, 'MK Snap', 8, NULL),
(36, 'Woburn Community Task Force (WTF) ', 5, NULL),
(37, 'Transitions UK', 8, NULL),
(38, 'Church Without Walls', 5, NULL),
(39, 'Xtra Special Families', 5, NULL),
(40, 'Aspire UK - Oxford', 8, NULL),
(41, 'Walton Community Council', 5, NULL),
(42, 'Age UK - Social Prescribers', 8, NULL),
(43, 'MK Homeless Partnership', 8, NULL),
(44, 'Christ The King Church (Kents Hill)', 5, NULL),
(45, 'Walton Community Council', 5, NULL),
(46, 'Middleton Coronavirus Community Support', 5, NULL),
(47, 'British Red Cross', 8, NULL),
(48, 'Sofea / Fareshare', 8, NULL),
(49, 'Fareshare Hub - Water Eaton', 6, NULL),
(50, 'Loughton Baptist Church', 6, NULL),
(51, 'MK Mission Partnership', 8, NULL),
(52, 'MK College', 6, NULL),
(53, 'Bletchley Park Residents Association', 6, NULL),
(54, 'Lakes Estate RA', 6, NULL),
(55, 'West Bletchley Parish Council', 6, NULL),
(56, 'MK Dons Set', 8, NULL),
(57, 'Sanctuary Hosting', 8, NULL),
(58, 'Arthur Ellis', 7, 'AUT2'),
(59, 'Planting Up MK', 7, NULL),
(60, 'Parks Trust', 7, NULL),
(61, 'Wildlife Trust', 7, NULL),
(62, 'Community Pharmacist', 7, NULL),
(63, 'Sensory Advice resource center', 7, NULL),
(64, 'Jo\'s Hope', 7, NULL),
(65, 'Works for us', 8, NULL),
(66, 'The Bus Shelter MK', 8, NULL),
(67, 'Community Action: MK', 8, NULL),
(70, 'Starting Point', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parishes`
--

CREATE TABLE `parishes` (
  `id` int(11) UNSIGNED NOT NULL,
  `parish_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parishes`
--

INSERT INTO `parishes` (`id`, `parish_name`) VALUES
(1, 'Abbey Hill'),
(2, 'Astwood and Hardmead'),
(3, 'Bletchley & Fenny Stratford'),
(4, 'Bow Brickhill'),
(5, 'Bradwell'),
(6, 'Broughton & Milton Keynes'),
(7, 'Calverton'),
(8, 'Campbell Park'),
(9, 'Castlethorpe'),
(10, 'Central Milton Keynes'),
(11, 'Chicheley'),
(12, 'Clifton Reynes & Newton Blossomville'),
(13, 'Cold Brayfield'),
(14, 'Emberton'),
(15, 'Fairfields'),
(16, 'Gayhurst'),
(17, 'Great Linford'),
(18, 'Hanslope'),
(19, 'Haversham cum Little Linford'),
(20, 'Kents Hill and Monkston'),
(21, 'Lathbury'),
(22, 'Lavendon'),
(23, 'Little Brickhill'),
(24, 'Loughton'),
(25, 'Moulsoe'),
(26, 'New Bradwell'),
(27, 'Newport Pagnell'),
(28, 'North Crawley'),
(29, 'Old Woughton'),
(30, 'Olney'),
(31, 'Ravenstone'),
(32, 'Shenley Brook End & Tattenhoe'),
(33, 'Shenley Church End'),
(34, 'Sherington'),
(35, 'Simpson and Ashland'),
(36, 'Stantonbury'),
(37, 'Stoke Goldington'),
(38, 'Stony Stratford'),
(39, 'Tyringham & Filgrave'),
(40, 'Walton'),
(41, 'Warrington'),
(42, 'Wavendon'),
(43, 'West Bletchley'),
(44, 'Weston Underwood'),
(45, 'Whitehouse'),
(46, 'Woburn Sands'),
(47, 'Wolverton & Greenleys'),
(48, 'Woughton'),
(49, 'All Parishes');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_active` enum('y','n') DEFAULT 'y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `name`, `is_active`) VALUES
(1, 'Representation', 'y'),
(2, 'Climate Change', 'y'),
(3, 'Covid 19', 'y'),
(4, 'Crime and Safety', 'y'),
(5, 'Development and Growth of MK', 'y'),
(6, 'Education', 'y'),
(7, 'Employment', 'y'),
(8, 'Outdoor Spaces, Nature and Animals', 'y'),
(9, 'Equality, Diversity and Inclusion', 'y'),
(10, 'Family / Related support Networks', 'y'),
(11, 'Financial', 'y'),
(12, 'Health (mental & physical)', 'y'),
(13, 'Homelessness', 'y'),
(14, 'Housing', 'y'),
(15, 'Public services (excuding health)', 'y'),
(16, 'Voluntary and Community Sector (activity, services, issues)', 'y'),
(44, 'Digital Exclusion', 'y'),
(45, 'Arts and Culture', 'y'),
(46, 'Sport and Leisure', 'y'),
(47, 'Protected characteristics', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `theme_keyword_map`
--

CREATE TABLE `theme_keyword_map` (
  `id` int(11) UNSIGNED NOT NULL,
  `theme_id` int(11) NOT NULL,
  `keyword_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme_keyword_map`
--

INSERT INTO `theme_keyword_map` (`id`, `theme_id`, `keyword_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(11, 2, 11),
(12, 2, 12),
(13, 4, 13),
(15, 3, 14),
(16, 3, 15),
(17, 3, 16),
(18, 3, 17),
(19, 3, 18),
(20, 3, 19),
(21, 3, 20),
(22, 3, 21),
(23, 4, 22),
(24, 4, 23),
(25, 4, 24),
(26, 4, 25),
(27, 4, 26),
(28, 4, 27),
(29, 4, 28),
(30, 4, 29),
(31, 4, 30),
(32, 5, 31),
(33, 5, 32),
(34, 5, 33),
(35, 5, 34),
(36, 5, 35),
(37, 5, 36),
(38, 5, 37),
(39, 6, 38),
(40, 6, 39),
(41, 6, 40),
(42, 6, 41),
(43, 6, 42),
(44, 6, 43),
(45, 6, 44),
(46, 6, 45),
(47, 7, 46),
(48, 7, 47),
(49, 7, 48),
(50, 7, 49),
(51, 7, 50),
(52, 7, 51),
(54, 8, 53),
(55, 8, 54),
(56, 8, 55),
(57, 8, 56),
(58, 9, 57),
(59, 9, 58),
(60, 9, 59),
(61, 9, 60),
(62, 10, 61),
(63, 10, 62),
(64, 10, 63),
(65, 10, 64),
(66, 10, 65),
(67, 10, 66),
(68, 11, 67),
(69, 11, 68),
(70, 11, 69),
(71, 11, 70),
(72, 11, 71),
(73, 12, 72),
(74, 12, 73),
(75, 12, 74),
(76, 12, 75),
(77, 12, 76),
(78, 12, 77),
(79, 13, 78),
(80, 13, 79),
(81, 13, 80),
(82, 13, 81),
(83, 13, 82),
(84, 13, 83),
(85, 13, 84),
(86, 14, 85),
(87, 14, 86),
(88, 14, 87),
(89, 14, 88),
(90, 14, 89),
(91, 14, 90),
(92, 15, 91),
(93, 15, 92),
(94, 15, 93),
(95, 15, 94),
(96, 15, 95),
(97, 15, 96),
(98, 15, 97),
(99, 15, 98),
(100, 16, 99),
(101, 16, 100),
(102, 16, 101),
(103, 16, 102),
(104, 16, 103),
(105, 16, 104),
(106, 16, 105),
(107, 16, 106),
(108, 16, 107),
(109, 45, 110),
(110, 45, 111),
(111, 45, 112),
(112, 45, 113),
(113, 45, 114),
(114, 45, 115),
(115, 45, 116),
(116, 44, 117),
(117, 44, 118),
(118, 44, 119),
(119, 44, 120),
(120, 44, 121),
(121, 44, 122),
(122, 5, 123),
(123, 8, 124),
(124, 8, 125),
(125, 8, 126),
(126, 10, 127),
(127, 10, 128),
(128, 46, 129),
(129, 46, 130),
(130, 46, 131),
(131, 46, 132),
(132, 1, 133),
(133, 3, 134),
(134, 4, 135),
(135, 4, 136),
(136, 5, 137),
(137, 6, 138),
(138, 8, 139),
(139, 9, 140),
(141, 9, 142),
(142, 9, 143),
(143, 9, 144),
(144, 10, 145),
(145, 11, 146),
(146, 12, 147),
(147, 12, 148),
(148, 16, 149),
(149, 16, 150),
(150, 16, 151),
(151, 16, 152),
(152, 16, 153),
(153, 47, 154),
(154, 47, 155),
(155, 47, 156),
(156, 47, 157),
(157, 47, 158),
(158, 47, 159),
(159, 47, 160),
(160, 47, 161),
(161, 47, 162),
(162, 15, 163),
(163, 15, 164),
(164, 15, 165),
(181, 45, 185);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `age_ranges`
--
ALTER TABLE `age_ranges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CISessions`
--
ALTER TABLE `CISessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_age_map`
--
ALTER TABLE `issue_age_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_keyword_map`
--
ALTER TABLE `issue_keyword_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_location_map`
--
ALTER TABLE `issue_location_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisations`
--
ALTER TABLE `organisations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parishes`
--
ALTER TABLE `parishes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_keyword_map`
--
ALTER TABLE `theme_keyword_map`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `age_ranges`
--
ALTER TABLE `age_ranges`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_age_map`
--
ALTER TABLE `issue_age_map`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_keyword_map`
--
ALTER TABLE `issue_keyword_map`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_location_map`
--
ALTER TABLE `issue_location_map`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `organisations`
--
ALTER TABLE `organisations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `parishes`
--
ALTER TABLE `parishes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `theme_keyword_map`
--
ALTER TABLE `theme_keyword_map`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
