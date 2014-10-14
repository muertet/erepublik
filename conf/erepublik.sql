-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-12-2013 a las 14:16:55
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `erepublik`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app`
--

CREATE TABLE IF NOT EXISTS `app` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `secret` varchar(120) NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `uid` int(10) NOT NULL,
  `url` varchar(120) NOT NULL,
  `official` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `app`
--

INSERT INTO `app` (`id`, `secret`, `name`, `description`, `uid`, `url`, `official`, `status`, `date`) VALUES
(1, '2345r6tujyhtg', 'Main App', 'Used for official game', 1, '', 1, 1, '2013-12-13 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `authtoken`
--

CREATE TABLE IF NOT EXISTS `authtoken` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `app` int(10) NOT NULL,
  `token` varchar(120) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `authtoken`
--

INSERT INTO `authtoken` (`id`, `app`, `token`, `date`) VALUES
(23, 1, '8c929a976c2277ef9b103a6388f2b849', '2013-12-27 11:17:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `name` varchar(120) NOT NULL,
  `product` int(2) NOT NULL,
  `quality` int(1) NOT NULL,
  `productType` int(1) NOT NULL,
  `maxEmployees` int(2) NOT NULL,
  `pendingUnits` float NOT NULL,
  `money` float NOT NULL,
  `region` int(3) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`id`, `uid`, `name`, `product`, `quality`, `productType`, `maxEmployees`, `pendingUnits`, `money`, `region`, `date`) VALUES
(1, 1, 'Los verdugos', 1, 1, 1, 5, 0.5, 391.76, 1, '2013-12-14 20:57:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_stock`
--

CREATE TABLE IF NOT EXISTS `company_stock` (
  `company` int(10) NOT NULL,
  `product` int(2) NOT NULL,
  `productType` int(1) NOT NULL,
  `quantity` int(10) NOT NULL,
  `quality` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `company` (`company`,`product`,`productType`,`quality`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `company_stock`
--

INSERT INTO `company_stock` (`company`, `product`, `productType`, `quantity`, `quality`) VALUES
(1, 1, 2, 2219, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_transaction`
--

CREATE TABLE IF NOT EXISTS `company_transaction` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `quantity` float NOT NULL,
  `action` varchar(120) NOT NULL,
  `receiver` int(10) NOT NULL,
  `receiverType` int(2) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `company_transaction`
--

INSERT INTO `company_transaction` (`id`, `quantity`, `action`, `receiver`, `receiverType`, `date`) VALUES
(1, -34.02, 'PAY_SALARY', 1, 1, '2013-12-26 15:05:52'),
(2, -34.02, 'PAY_SALARY', 1, 1, '2013-12-26 15:07:06'),
(3, -34.02, 'PAY_SALARY', 1, 1, '2013-12-26 15:09:16'),
(4, -34.02, 'PAY_SALARY', 1, 1, '2013-12-26 15:12:03'),
(5, -34.02, 'PAY_SALARY', 1, 1, '2013-12-26 15:13:18'),
(6, -34.02, 'PAY_SALARY', 1, 1, '2013-12-26 15:15:09'),
(7, 34.02, 'PAY_SALARY', 1, 1, '2013-12-26 15:21:16'),
(8, 34.02, 'PAY_SALARY', 1, 1, '2013-12-26 15:26:42'),
(9, 34.02, 'PAY_SALARY', 1, 1, '2013-12-26 15:31:34'),
(10, 34.02, 'PAY_SALARY', 1, 1, '2013-12-26 16:15:32'),
(11, 34.02, 'PAY_SALARY', 1, 1, '2013-12-26 16:17:24'),
(12, 34.02, 'PAY_SALARY', 1, 1, '2013-12-26 16:17:55'),
(13, 34.02, 'PAY_SALARY', 1, 1, '2013-12-26 16:18:32'),
(14, 34.02, 'PAY_SALARY', 1, 1, '2013-12-26 16:22:05'),
(15, 34.02, 'PAY_SALARY', 1, 1, '2013-12-26 16:25:07'),
(16, 34.02, 'PAY_SALARY', 1, 1, '2013-12-26 16:26:10'),
(17, 34.02, 'PAY_SALARY', 1, 1, '2013-12-26 16:38:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(3) NOT NULL,
  `name` varchar(120) NOT NULL,
  `shortName` varchar(10) NOT NULL,
  `capitalRegionId` int(10) NOT NULL,
  `currency` varchar(3) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `country`
--

INSERT INTO `country` (`id`, `name`, `shortName`, `capitalRegionId`, `currency`) VALUES
(18, 'Portugal', 'PT', 106, 'PTE'),
(52, 'Belarus', 'BY', 311, 'BYR'),
(54, 'Philippines', 'PH', 320, 'PHP'),
(30, 'Iran', 'IR', 181, 'IRR'),
(32, 'Taiwan', 'TW', 189, 'TWD'),
(14, 'Greece', 'GR', 82, 'GRD'),
(63, 'Thailand', 'TH', 373, 'THB'),
(16, 'Ukraine', 'UA', 92, 'UAH'),
(29, 'Indonesia', 'ID', 171, 'IDR'),
(45, 'Chile', 'CL', 267, 'CLP'),
(7, 'Italy', 'IT', 40, 'ITL'),
(34, 'India', 'IN', 202, 'INR'),
(4, 'France', 'FR', 19, 'FRF'),
(15, 'Republic of Macedonia', 'MK', 89, 'MKD'),
(20, 'Latvia', 'LV', 120, 'LVL'),
(59, 'Bangladesh', 'BD', 352, 'BDT'),
(13, 'Bosnia and Herzegovina', 'BA', 75, 'BAM'),
(41, 'Pakistan', 'PK', 243, 'PKR'),
(22, 'Turkey', 'TR', 133, 'TRY'),
(51, 'Czech Republic', 'CZ', 301, 'CZK'),
(25, 'Mexico', 'MX', 149, 'MXN'),
(27, 'Canada', 'CA', 160, 'CAD'),
(23, 'Brazil', 'BR', 137, 'BRL'),
(9, 'Romania', 'RO', 51, 'RON'),
(12, 'Croatia', 'HR', 73, 'HRK'),
(17, 'Sweden', 'SE', 100, 'SEK'),
(11, 'Serbia', 'RS', 67, 'RSD'),
(53, 'Estonia', 'EE', 315, 'EEK'),
(5, 'Spain', 'ES', 28, 'ESP'),
(38, 'Ireland', 'I', 228, 'IEP'),
(33, 'Israel', 'IL', 21, 'NIS'),
(46, 'Colombia', 'CO', 275, 'COP'),
(39, 'Switzerland', 'CH', 233, 'CHF'),
(42, 'Malaysia', 'MY', 249, 'MYR'),
(35, 'Australia', 'AU', 211, 'AUD'),
(44, 'Peru', 'PE', 260, 'PEN'),
(36, 'Netherlands', 'NL', 205, 'NLG'),
(28, 'China', 'CN', 169, 'CNY'),
(21, 'Slovenia', 'SI', 124, 'SIT'),
(37, 'Finland', 'FI', 221, 'FIM'),
(19, 'Lithuania', 'LT', 115, 'LTL'),
(6, 'United Kingdom', 'GB', 32, 'GBP'),
(8, 'Hungary', 'HU', 46, 'HUF'),
(26, 'USA', 'US', 155, 'USD'),
(24, 'Argentina', 'AR', 141, 'ARS'),
(1, 'Poland', 'PL', 1, 'PLN'),
(40, 'Belgium', 'BE', 236, 'BEF'),
(2, 'Russia', 'RU', 7, 'RUB'),
(10, 'Bulgaria', 'BG', 56, 'BGN'),
(3, 'Germany', 'GER', 13, 'DEM'),
(43, 'Norway', 'NO', 258, 'NOK'),
(31, 'South Korea', 'KR', 185, 'KRW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `company` int(10) NOT NULL,
  `salary` float NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `job`
--

INSERT INTO `job` (`id`, `uid`, `company`, `salary`, `date`) VALUES
(2, 1, 1, 34.02, '2013-12-15 20:49:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_market`
--

CREATE TABLE IF NOT EXISTS `job_market` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company` int(10) NOT NULL,
  `skill` int(2) NOT NULL,
  `salary` float NOT NULL,
  `quantity` int(2) NOT NULL,
  `country` int(3) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `job_market`
--

INSERT INTO `job_market` (`id`, `company`, `skill`, `salary`, `quantity`, `country`, `date`) VALUES
(2, 1, 5, 34.02, 1, 1, '2013-12-15 18:21:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `resource` int(2) NOT NULL,
  `resourceUnits` int(4) NOT NULL,
  `productivityBase` int(4) NOT NULL,
  `maxQuality` int(1) NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `resource`, `resourceUnits`, `productivityBase`, `maxQuality`) VALUES
(1, 'Weapon', 1, 2, 2, 5),
(2, 'House', 5, 300, 300, 5),
(3, 'Gift', 6, 2, 2, 5),
(4, 'Food', 2, 1, 1, 5),
(5, 'Ticket', 3, 4, 4, 5),
(6, 'Defense System', 4, 300, 300, 5),
(7, 'Hospital', 4, 300, 300, 5),
(8, 'Estate', 4, 600, 600, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rank`
--

CREATE TABLE IF NOT EXISTS `rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `damageRequired` int(20) NOT NULL,
  `damageModifier` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Volcado de datos para la tabla `rank`
--

INSERT INTO `rank` (`id`, `name`, `damageRequired`, `damageModifier`) VALUES
(1, 'Rookie', 0, 1),
(2, 'Private', 250, 1.1),
(3, 'Private First Class', 1000, 1.2),
(4, 'Corporal', 3000, 1.3),
(5, 'Sergeant', 5000, 1.4),
(6, 'Staff Sergeant', 10000, 1.5),
(7, 'Sergeant First Class', 30000, 1.6),
(8, 'Master Sergeant', 60000, 1.65),
(9, 'First Sergeant', 100000, 1.7),
(10, 'Sergeant Major', 250000, 1.75),
(11, 'Command Sergeant Major', 500000, 1.8),
(12, 'Sergeant Major of the Army', 750000, 1.85),
(13, 'Second Lieutenant', 1000000, 1.9),
(14, 'First Lieutenant', 1500000, 1.93),
(15, 'Captain', 2500000, 1.96),
(16, 'Major', 5000000, 2),
(17, 'Lieutenant Colonel', 10000000, 2.03),
(18, 'Colonel', 17000000, 2.06),
(19, 'Brigadier General', 25000000, 2.1),
(20, 'Major General', 35000000, 2.13),
(21, 'Lieutenant General', 45000000, 2.16),
(22, 'General', 60000000, 2.19),
(23, 'General of the Army', 80000000, 2.21),
(24, 'Marshall', 100000000, 2.24),
(25, 'Field Marshall', 125000000, 2.27),
(26, 'Supreme Marshall', 175000000, 2.3),
(27, 'Generalissimus', 250000000, 2.33),
(28, 'Supreme Generalissimus', 400000000, 2.36),
(29, 'Imperial Generalissimus', 600000000, 2.4),
(30, 'Legendary Generalissimus', 800000000, 2.42),
(31, 'Imperator', 1000000000, 2.44),
(32, 'Imperator Caesar', 1500000000, 2.46),
(33, 'Deus Dimidiam', 2147483647, 2.48),
(34, 'Deus', 2147483647, 2.5),
(35, 'Summi Deus', 2147483647, 2.52),
(36, 'Deus Imperialis', 2147483647, 2.54),
(37, 'Deus Fabuloso', 2147483647, 2.56),
(38, 'Deus Ultimum', 2147483647, 2.58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `resourceAmount` int(2) NOT NULL,
  `resourceType` int(2) NOT NULL,
  `country` int(10) NOT NULL,
  `countryConqueror` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=379 ;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id`, `name`, `resourceAmount`, `resourceType`, `country`, `countryConqueror`) VALUES
(1, 'Mazovia', 0, 0, 1, 1),
(2, 'Silesia', 10, 1, 1, 1),
(3, 'Great Poland', 0, 0, 1, 1),
(4, 'Mazuria', 0, 0, 1, 1),
(5, 'Little Poland', 5, 4, 1, 1),
(6, 'Pomerania', 0, 0, 1, 1),
(7, 'Moscow', 0, 0, 2, 2),
(8, 'Western Russia', 10, 2, 2, 2),
(9, 'Siberia', 0, 0, 2, 2),
(10, 'North Caucasus', 0, 0, 2, 2),
(11, 'Kamchatka', 5, 6, 2, 2),
(12, 'Northwestern Russia', 0, 0, 2, 2),
(13, 'Brandenburgia', 0, 0, 3, 3),
(14, 'Mecklenburg and Western Pomerania', 0, 0, 3, 3),
(15, 'Saxony', 10, 3, 3, 3),
(16, 'Bavaria', 0, 0, 3, 3),
(17, 'Rhineland', 0, 0, 3, 3),
(18, 'Baden-Wurttemberg', 5, 6, 3, 3),
(19, 'Central France', 0, 0, 4, 4),
(20, 'Northern France', 0, 0, 4, 4),
(21, 'Jerusalem', 0, 0, 33, 33),
(22, 'Rhone Alpes', 10, 4, 4, 4),
(23, 'Great West', 0, 0, 4, 4),
(24, 'Southwestern France', 0, 0, 4, 4),
(25, 'Alsace Lorraine', 5, 2, 4, 4),
(26, 'Andalusia', 0, 0, 5, 5),
(27, 'Aragon Catalonia', 0, 0, 5, 5),
(28, 'Madrid', 0, 0, 5, 5),
(29, 'Galicia', 5, 2, 5, 5),
(30, 'Castile Leon', 10, 5, 5, 5),
(31, 'Castile-La Mancha', 0, 0, 5, 5),
(32, 'London', 0, 0, 6, 6),
(33, 'Northeastern England', 10, 6, 6, 6),
(34, 'Wales', 0, 0, 6, 6),
(35, 'Southwestern England', 0, 0, 6, 6),
(36, 'Scotland', 0, 0, 6, 6),
(37, 'Northern Ireland', 5, 2, 6, 6),
(38, 'Sicily', 0, 0, 7, 7),
(39, 'Naples', 5, 5, 7, 7),
(40, 'Central Italy', 0, 0, 7, 7),
(41, 'Tuscany', 10, 1, 7, 7),
(42, 'Veneto', 0, 0, 7, 7),
(43, 'Lombardia Piemonte', 0, 0, 7, 7),
(44, 'Western Transdanubia', 10, 2, 8, 8),
(45, 'Eastern Transdanubia', 0, 0, 8, 8),
(46, 'Central Hungary', 0, 0, 8, 8),
(47, 'Southern Great Plain', 0, 0, 8, 8),
(48, 'Northern Great Plain', 5, 1, 8, 8),
(49, 'Northern Great Hungary', 0, 0, 8, 8),
(50, 'Crisana Banat', 10, 3, 9, 9),
(51, 'Wallachia', 0, 0, 9, 9),
(52, 'Dobrogea', 0, 0, 9, 9),
(53, 'Transylvania', 5, 5, 9, 9),
(54, 'Moldova', 0, 0, 9, 9),
(55, 'Maramur Bucovina', 0, 0, 9, 9),
(56, 'Sofia', 0, 0, 10, 10),
(57, 'Plovdiv', 10, 4, 10, 10),
(58, 'Burgas', 0, 0, 10, 10),
(59, 'Varna', 5, 2, 10, 10),
(60, 'Ruse', 0, 0, 10, 10),
(61, 'Vidin', 0, 0, 10, 10),
(62, 'Western Serbia', 0, 0, 11, 11),
(63, 'Southern Serbia', 10, 5, 11, 11),
(64, 'Sumadija', 5, 1, 11, 11),
(65, 'Eastern Serbia', 0, 0, 11, 11),
(66, 'Vojvodina', 0, 0, 11, 11),
(67, 'Belgrade', 0, 0, 11, 11),
(68, 'Slavonia', 0, 0, 12, 12),
(69, 'Central Croatia', 10, 6, 12, 12),
(70, 'Dalmatia', 5, 2, 12, 12),
(71, 'Kvarner', 0, 0, 12, 12),
(72, 'Istria', 0, 0, 12, 12),
(73, 'Zagreb', 0, 0, 12, 12),
(74, 'Herzegovina', 5, 2, 13, 13),
(75, 'Sarajevo', 0, 0, 13, 13),
(76, 'Northern Bosnia', 10, 6, 13, 13),
(77, 'Posavina', 0, 0, 13, 13),
(78, 'Central Bosnia', 0, 0, 13, 13),
(79, 'Bosanska Krajina', 0, 0, 13, 13),
(80, 'Crete', 5, 6, 14, 14),
(81, 'Peloponnese', 10, 1, 14, 14),
(82, 'Central Greece', 0, 0, 14, 14),
(83, 'Epirus Thessaly', 0, 0, 14, 14),
(84, 'Makedonia', 0, 0, 14, 14),
(85, 'Thrace', 0, 0, 14, 14),
(86, 'Western Republic of Macedonia', 0, 0, 15, 15),
(87, 'Pelagonia', 10, 2, 15, 15),
(88, 'Vardar', 0, 0, 15, 15),
(89, 'Skopje', 0, 0, 15, 15),
(90, 'Southeastern Republic of Macedonia', 5, 6, 15, 15),
(91, 'Northeastern Republic of Macedonia', 0, 0, 15, 15),
(92, 'Kiev', 0, 0, 16, 16),
(93, 'Western Ukraine', 0, 0, 16, 16),
(94, 'Central Ukraine', 10, 2, 16, 16),
(95, 'Eastern Ukraine', 0, 0, 16, 16),
(96, 'Black Sea Coast', 5, 3, 16, 16),
(97, 'Crimea', 0, 0, 16, 16),
(98, 'Smaland Scania', 0, 0, 17, 17),
(99, 'Gotaland', 10, 4, 17, 17),
(100, 'Svealand', 0, 0, 17, 17),
(101, 'Bohus', 0, 0, 17, 17),
(102, 'Jamtland', 5, 2, 17, 17),
(103, 'Norrland Sameland', 0, 0, 17, 17),
(104, 'Northern Portugal', 0, 0, 18, 18),
(105, 'Beira', 5, 5, 18, 18),
(106, 'Estremadura Ribatejo', 0, 0, 18, 18),
(107, 'Alentejo', 0, 0, 18, 18),
(108, 'Algarve', 0, 0, 18, 18),
(109, 'Azores', 10, 6, 18, 18),
(110, 'Lithuania Eastern highland', 5, 5, 19, 19),
(111, 'Sudovia', 0, 0, 19, 19),
(112, 'Lithuania Western highland', 0, 0, 19, 19),
(113, 'Samogitia', 10, 6, 19, 19),
(114, 'Lithuania minor', 0, 0, 19, 19),
(115, 'Dainava', 0, 0, 19, 19),
(116, 'Eastern Vidzeme', 5, 2, 20, 20),
(117, 'Latgalia', 10, 1, 20, 20),
(118, 'Selija', 0, 0, 20, 20),
(119, 'Western Vidzeme', 0, 0, 20, 20),
(120, 'Zemgale', 0, 0, 20, 20),
(121, 'Kurzeme', 0, 0, 20, 20),
(122, 'Prekmurje', 0, 0, 21, 21),
(123, 'Styria Carinthia', 10, 2, 21, 21),
(124, 'Upper Carniola', 0, 0, 21, 21),
(125, 'Slovenian Littoral', 5, 3, 21, 21),
(126, 'Lower Carniola', 0, 0, 21, 21),
(127, 'Inner Carniola', 0, 0, 21, 21),
(128, 'Marmara', 10, 3, 22, 22),
(129, 'Turkey Aegean Coast', 0, 0, 22, 22),
(130, 'Turkey Mediterranean Coast', 5, 6, 22, 22),
(131, 'Turkey Black Sea Coast', 0, 0, 22, 22),
(132, 'Eastern Anatolia', 0, 0, 22, 22),
(133, 'Central Anatolia', 0, 0, 22, 22),
(134, 'North of Brazil', 10, 1, 23, 23),
(135, 'Northeast of Brazil', 0, 0, 23, 23),
(136, 'Southeast of Brazil', 0, 0, 23, 23),
(137, 'Central Brazil', 0, 0, 23, 23),
(138, 'Parana and Santa Catarina', 5, 2, 23, 23),
(139, 'Rio Grande do Sul', 0, 0, 23, 23),
(140, 'Patagonia', 10, 5, 24, 24),
(141, 'Pampas', 0, 0, 24, 24),
(142, 'Cuyo', 0, 0, 24, 24),
(143, 'Tucuman', 5, 3, 24, 24),
(144, 'Chaco', 0, 0, 24, 24),
(145, 'Mesopotamia', 0, 0, 24, 24),
(146, 'Northern Mexico', 0, 0, 25, 25),
(147, 'Mexico Pacific Coast', 5, 4, 25, 25),
(148, 'Yucatan Peninsula', 10, 6, 25, 25),
(149, 'Central Mexico', 0, 0, 25, 25),
(150, 'The Bajio', 0, 0, 25, 25),
(151, 'Baja California', 0, 0, 25, 25),
(152, 'Alaska', 0, 0, 26, 26),
(153, 'USA Pacific Coast', 10, 1, 26, 26),
(154, 'Western USA', 0, 0, 26, 26),
(155, 'Central USA', 0, 0, 26, 26),
(156, 'USA East Coast', 5, 5, 26, 26),
(157, 'USA Gulf of Mexico', 0, 0, 26, 26),
(158, 'Northern Canada', 5, 6, 27, 27),
(159, 'Canada East Coast', 10, 2, 27, 27),
(160, 'Quebec', 0, 0, 27, 27),
(161, 'Manitoba', 0, 0, 27, 27),
(162, 'Alberta', 0, 0, 27, 27),
(163, 'Canada Pacific Coast', 0, 0, 27, 27),
(164, 'Manchuria', 0, 0, 28, 28),
(165, 'Northwest China', 10, 3, 28, 28),
(166, 'Tibet', 0, 0, 28, 28),
(167, 'North China', 0, 0, 28, 28),
(168, 'South China', 5, 2, 28, 28),
(169, 'East China', 0, 0, 28, 28),
(170, 'Sumatra', 10, 1, 29, 29),
(171, 'Java', 0, 0, 29, 29),
(172, 'Kalimantan', 0, 0, 29, 29),
(173, 'Sulawesi', 0, 0, 29, 29),
(174, 'Papua', 5, 4, 29, 29),
(175, 'Maluku Islands', 0, 0, 29, 29),
(176, 'Western Iran', 0, 0, 30, 30),
(177, 'Northern Iran', 10, 5, 30, 30),
(178, 'Khorasan', 0, 0, 30, 30),
(179, 'Southeastern Iran', 0, 0, 30, 30),
(180, 'Fars', 5, 3, 30, 30),
(181, 'Central Iran', 0, 0, 30, 30),
(182, 'Jeolla', 10, 6, 31, 31),
(183, 'Gyeongsang', 0, 0, 31, 31),
(184, 'Chuncheon', 0, 0, 31, 31),
(185, 'Gyeonggi', 0, 0, 31, 31),
(186, 'North Chungcheong', 5, 2, 31, 31),
(187, 'South Chungcheong', 0, 0, 31, 31),
(188, 'Penghu', 10, 1, 32, 32),
(189, 'Taipei', 0, 0, 32, 32),
(190, 'Northeastern Taiwan', 5, 4, 32, 32),
(191, 'Southeastern Taiwan', 0, 0, 32, 32),
(192, 'Kaohsiung', 0, 0, 32, 32),
(193, 'Western Taiwan', 0, 0, 32, 32),
(194, 'Nazareth', 0, 0, 33, 33),
(195, 'Judea and Samaria', 5, 3, 33, 33),
(196, 'Beersheba', 0, 0, 33, 33),
(197, 'Haifa', 0, 0, 33, 33),
(198, 'Coastal Plain', 10, 1, 33, 33),
(199, 'Southern India', 0, 0, 34, 34),
(200, 'Western India', 5, 4, 34, 34),
(201, 'Bengal Coast', 10, 2, 34, 34),
(202, 'Central India', 0, 0, 34, 34),
(203, 'Northern India', 0, 0, 34, 34),
(204, 'Eastern India', 0, 0, 34, 34),
(205, 'North Holland-Utrecht', 0, 0, 36, 36),
(206, 'South Holland-Zeeland', 0, 0, 36, 36),
(207, 'Western Australia', 0, 0, 35, 35),
(208, 'Northern Territory', 0, 0, 35, 35),
(209, 'South Australia', 10, 6, 35, 35),
(210, 'Queensland', 0, 0, 35, 35),
(211, 'New South Wales', 0, 0, 35, 35),
(212, 'Victoria', 5, 1, 35, 35),
(213, 'Groningen-Drenthe', 0, 0, 36, 36),
(214, 'Friesland-Flevoland', 10, 2, 36, 36),
(215, 'Gelderland-Overijssel', 0, 0, 36, 36),
(216, 'Brabant-Limburg', 5, 5, 36, 36),
(217, 'Western Finland', 5, 3, 37, 37),
(218, 'Aland', 0, 0, 37, 37),
(219, 'Eastern Finland', 0, 0, 37, 37),
(220, 'Lapland', 0, 0, 37, 37),
(221, 'Southern Finland', 0, 0, 37, 37),
(222, 'Oulu', 10, 6, 37, 37),
(223, 'Cork/Kerry', 0, 0, 38, 38),
(224, 'Shannon', 10, 1, 38, 38),
(225, 'South-east Ireland', 0, 0, 38, 38),
(226, 'North-west Ireland', 5, 3, 38, 38),
(227, 'Western Ireland', 0, 0, 38, 38),
(228, 'Midlands-Ireland', 0, 0, 38, 38),
(229, 'Zurich', 0, 0, 39, 39),
(230, 'Ticino-Grisons', 5, 2, 39, 39),
(231, 'Northeastern Switzerland', 0, 0, 39, 39),
(232, 'Central Switzerland', 10, 6, 39, 39),
(233, 'Bern-Valais', 0, 0, 39, 39),
(234, 'Western Switzerland', 0, 0, 39, 39),
(235, 'Antwerpen - Limburg', 10, 5, 40, 40),
(236, 'Brussels', 0, 0, 40, 40),
(237, 'Vlaanderen', 5, 1, 40, 40),
(238, 'Hainaut - Namur', 0, 0, 40, 40),
(239, 'Liege', 0, 0, 40, 40),
(240, 'Luxembourg', 0, 0, 40, 40),
(241, 'Sindh', 0, 0, 41, 41),
(242, 'Balochistan', 5, 3, 41, 41),
(243, 'Punjab', 0, 0, 41, 41),
(244, 'Northern Areas', 0, 0, 41, 41),
(245, 'North West Frontier Province', 10, 1, 41, 41),
(246, 'Tribal areas', 0, 0, 41, 41),
(247, 'Sarawak', 0, 0, 42, 42),
(248, 'Sabah', 5, 1, 42, 42),
(249, 'Kuala Lumpur', 0, 0, 42, 42),
(250, 'Pahang', 10, 3, 42, 42),
(251, 'Northern Peninsular-Malaysia', 0, 0, 42, 42),
(252, 'Southern Peninsular-Malaysia', 0, 0, 42, 42),
(253, 'Svalbard', 0, 0, 43, 43),
(254, 'Nord-Norge', 5, 3, 43, 43),
(255, 'Trondelag', 0, 0, 43, 43),
(256, 'Sorlandet', 0, 0, 43, 43),
(257, 'Vestlandet', 10, 1, 43, 43),
(258, 'Ostlandet', 0, 0, 43, 43),
(259, 'Loreto', 0, 0, 44, 44),
(260, 'Lima', 0, 0, 44, 44),
(261, 'Southern Coast of Peru', 5, 6, 44, 44),
(262, 'Northwestern Peru', 10, 2, 44, 44),
(263, 'Peru Andes', 0, 0, 44, 44),
(264, 'Central Peru', 0, 0, 44, 44),
(265, 'Punta Arenas', 5, 6, 45, 45),
(266, 'Puerto Montt', 0, 0, 45, 45),
(267, 'Santiago', 0, 0, 45, 45),
(268, 'Atacama', 0, 0, 45, 45),
(269, 'Antofagasta', 0, 0, 45, 45),
(270, 'Tarapaca', 10, 3, 45, 45),
(271, 'Amazonica', 0, 0, 46, 46),
(272, 'Orinoquia', 0, 0, 46, 46),
(273, 'Pacifica', 5, 2, 46, 46),
(274, 'Caribe', 0, 0, 46, 46),
(275, 'Bogota', 0, 0, 46, 46),
(276, 'Andino', 10, 4, 46, 46),
(301, 'Prague', 0, 0, 51, 51),
(302, 'Czech Silesia', 0, 0, 51, 51),
(303, 'Moravia', 0, 0, 51, 51),
(304, 'Sudetsko', 0, 0, 51, 51),
(305, 'Pardubice-Vysocina', 10, 5, 51, 51),
(306, 'South Bohemia', 5, 2, 51, 51),
(307, 'Brest', 0, 0, 52, 52),
(308, 'Viciebsk', 5, 2, 52, 52),
(309, 'Mahilou', 10, 3, 52, 52),
(310, 'Hrodna', 0, 0, 52, 52),
(311, 'Minsk', 0, 0, 52, 52),
(312, 'Homiel', 0, 0, 52, 52),
(313, 'Saaremaa-Hiiumaa', 0, 0, 53, 53),
(314, 'Southeastern Estonia', 0, 0, 53, 53),
(315, 'Tallinn', 0, 0, 53, 53),
(316, 'Central Estonia', 10, 2, 53, 53),
(317, 'Eastern Estonia', 5, 6, 53, 53),
(318, 'Northern Estonia', 0, 0, 53, 53),
(319, 'Luzon', 0, 0, 54, 54),
(320, 'Manila', 0, 0, 54, 54),
(321, 'Mindanao', 0, 0, 54, 54),
(322, 'Puerto Princesa', 0, 0, 54, 54),
(323, 'Eastern Visayas', 10, 2, 54, 54),
(324, 'Western Visayas', 5, 4, 54, 54),
(349, 'Rangpur', 0, 0, 59, 59),
(350, 'Rajshahi', 0, 0, 59, 59),
(351, 'Khulna', 5, 1, 59, 59),
(352, 'Dhaka', 0, 0, 59, 59),
(353, 'Eastern Bangladesh', 0, 0, 59, 59),
(354, 'Barisal', 10, 6, 59, 59),
(373, 'Central Thailand', 0, 0, 63, 63),
(374, 'North Thailand', 0, 0, 63, 63),
(375, 'North-east Thailand', 0, 0, 63, 63),
(376, 'East Thailand', 10, 1, 63, 63),
(377, 'West Thailand', 5, 2, 63, 63),
(378, 'South Thailand', 0, 0, 63, 63);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `resource`
--

INSERT INTO `resource` (`id`, `name`) VALUES
(1, 'Iron'),
(2, 'Grain'),
(3, 'Oil'),
(4, 'Stone'),
(5, 'Wood'),
(6, 'Diamonds');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `skill`
--

CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(20) NOT NULL,
  `strengh` int(3) NOT NULL,
  `economic` int(3) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `skill`
--

INSERT INTO `skill` (`id`, `strengh`, `economic`) VALUES
(1, 400, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `resource` int(2) NOT NULL,
  `vat` float NOT NULL,
  `income` float NOT NULL,
  `import` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `train_historial`
--

CREATE TABLE IF NOT EXISTS `train_historial` (
  `uid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  UNIQUE KEY `uid` (`uid`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `train_historial`
--

INSERT INTO `train_historial` (`uid`, `date`) VALUES
(1, '2013-12-26 18:42:14');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nick` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `password` varchar(120) NOT NULL,
  `maxHp` int(10) NOT NULL,
  `currentHp` int(10) NOT NULL,
  `country` int(8) NOT NULL,
  `region` int(10) NOT NULL,
  `gold` varchar(10) NOT NULL DEFAULT '0',
  `currency` varchar(4) NOT NULL,
  `xp` int(30) NOT NULL DEFAULT '0',
  `language` varchar(3) NOT NULL DEFAULT 'en',
  `citizenship` int(3) NOT NULL,
  UNIQUE KEY `nick` (`nick`,`email`),
  KEY `uid` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nick`, `email`, `date`, `status`, `password`, `maxHp`, `currentHp`, `country`, `region`, `gold`, `currency`, `xp`, `language`, `citizenship`) VALUES
(1, 'tester', 'admin@admin.com', '2013-12-02 00:00:00', 1, 'a15a3d6d3f37bc6f5de23de577bbee0a', 100, 45, 1, 1, '213', 'PLN', 187, 'en', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertoken`
--

CREATE TABLE IF NOT EXISTS `usertoken` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `app` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `token` varchar(120) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `usertoken`
--

INSERT INTO `usertoken` (`id`, `app`, `uid`, `token`, `date`) VALUES
(12, 1, 1, 'e96e9bed0862a9921f97b501b5ac44cb', '2013-12-27 11:17:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_currency`
--

CREATE TABLE IF NOT EXISTS `user_currency` (
  `uid` int(10) NOT NULL,
  `name` varchar(5) NOT NULL,
  `quantity` float NOT NULL,
  UNIQUE KEY `uid` (`uid`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_currency`
--

INSERT INTO `user_currency` (`uid`, `name`, `quantity`) VALUES
(1, 'PLN', 374.22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `work_historial`
--

CREATE TABLE IF NOT EXISTS `work_historial` (
  `uid` int(10) NOT NULL,
  `date` datetime NOT NULL,
  UNIQUE KEY `uid` (`uid`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `work_historial`
--

INSERT INTO `work_historial` (`uid`, `date`) VALUES
(1, '2013-12-26 16:38:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xp_reasons`
--

CREATE TABLE IF NOT EXISTS `xp_reasons` (
  `reason` varchar(120) NOT NULL,
  `xp` int(11) NOT NULL,
  UNIQUE KEY `reason` (`reason`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `xp_reasons`
--

INSERT INTO `xp_reasons` (`reason`, `xp`) VALUES
('ADD_AVATAR', 5),
('HIT', 1),
('TRAIN', 4),
('VOTE', 5),
('WIN_CONGRESS_ELECTIONS', 50),
('WIN_PRESIDENTIAL_ELECTIONS', 500),
('WORK', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
