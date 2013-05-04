-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-05-2013 a las 11:12:59
-- Versión del servidor: 5.1.68-cll
-- Versión de PHP: 5.3.17

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
-- Estructura de tabla para la tabla `apadrinar`
--

CREATE TABLE IF NOT EXISTS `apadrinar` (
  `fid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `timestamp` char(14) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `type` int(2) NOT NULL,
  `quality` int(1) NOT NULL,
  `uid` int(5) NOT NULL,
  `date` char(14) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(2) NOT NULL,
  `name` varchar(110) NOT NULL,
  `max_q` int(2) NOT NULL DEFAULT '5',
  `cost` int(3) NOT NULL DEFAULT '0',
  `employers` int(2) NOT NULL DEFAULT '0',
  `produces` int(3) NOT NULL DEFAULT '0',
  `produces_type` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companyTypes`
--

CREATE TABLE IF NOT EXISTS `companyTypes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `json` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `companyTypes`
--

INSERT INTO `companyTypes` (`id`, `json`) VALUES
(1, '{"industry_id":1,"industry_name":"Food","industry_token":"FOOD","products_img":"","quality":2,"building_name":"Food Factory","building_img":"","is_raw":false,"raw_img":"http://www.erepublik.com/images/icons/industry/7/default.png","preset_works":0,"preset_own_work":0,"base_production":100,"resource_bonus":80,"raw_usage":0,"production":0,"employee_limit":"2","upgrade_url":"http://economy.erepublik.com/en/company/customize/1120625","todays_works":0,"total_works":2,"sell_url":"http://economy.erepublik.com/en/company/sell/1120625","upgrades":{"1":{"level":1,"employees":1,"cost":10,"img":"/images/modules/manager/factory_buildings/1_1.png","raw_usage":1,"type":-1},"2":{"level":2,"employees":2,"cost":0,"img":"/images/modules/manager/factory_buildings/1_2.png","raw_usage":2,"type":0},"3":{"level":3,"employees":3,"cost":50,"img":"/images/modules/manager/factory_buildings/1_3.png","raw_usage":3,"type":1},"4":{"level":4,"employees":5,"cost":150,"img":"/images/modules/manager/factory_buildings/1_4.png","raw_usage":4,"type":1},"5":{"level":5,"employees":10,"cost":350,"img":"/images/modules/manager/factory_buildings/1_5.png","raw_usage":5,"type":1},"6":{"level":6,"employees":10,"cost":750,"img":"/images/modules/manager/factory_buildings/1_6.png","raw_usage":6,"type":1},"7":{"level":7,"employees":10,"cost":1200,"img":"/images/modules/manager/factory_buildings/1_7.png","raw_usage":20,"type":1}},"max_quality":7}'),
(2, '{"industry_id":2,"industry_name":"Weapons","industry_token":"WEAPON","products_img":"","quality":1,"building_name":"Weapons Factory","building_img":"","is_raw":false,"raw_img":"http://www.erepublik.com/images/icons/industry/12/default.png","preset_works":0,"preset_own_work":0,"base_production":10,"resource_bonus":80,"raw_usage":0,"production":0,"employee_limit":"1","upgrade_url":"http://economy.erepublik.com/en/company/customize/1345941","todays_works":0,"total_works":1,"sell_url":"http://economy.erepublik.com/en/company/sell/1345941","upgrades":{"1":{"level":1,"employees":1,"cost":0,"img":"/images/modules/manager/factory_buildings/2_1.png","raw_usage":10,"type":0},"2":{"level":2,"employees":2,"cost":20,"img":"/images/modules/manager/factory_buildings/2_2.png","raw_usage":20,"type":1},"3":{"level":3,"employees":3,"cost":70,"img":"/images/modules/manager/factory_buildings/2_3.png","raw_usage":30,"type":1},"4":{"level":4,"employees":5,"cost":170,"img":"/images/modules/manager/factory_buildings/2_4.png","raw_usage":40,"type":1},"5":{"level":5,"employees":10,"cost":370,"img":"/images/modules/manager/factory_buildings/2_5.png","raw_usage":50,"type":1},"6":{"level":6,"employees":10,"cost":770,"img":"/images/modules/manager/factory_buildings/2_6.png","raw_usage":60,"type":1},"7":{"level":7,"employees":10,"cost":1220,"img":"/images/modules/manager/factory_buildings/2_7.png","raw_usage":200,"type":1}},"max_quality":7}'),
(3, '{"industry_id":8,"industry_name":"Fruits","industry_token":"FOOD","products_img":"","quality":1,"building_name":"Fruit Orchard","building_img":"","is_raw":true,"raw_img":"http://www.erepublik.com/images/icons/industry/7/default.png","preset_works":0,"preset_own_work":0,"base_production":70,"resource_bonus":80,"raw_usage":0,"production":0,"employee_limit":"0","upgrade_url":"","todays_works":0,"total_works":0,"sell_url":"http://economy.erepublik.com/en/company/sell/8569870","upgrades":[],"max_quality":0}'),
(4, '{"industry_id":7,"industry_name":"Grain","industry_token":"FOOD","products_img":"","quality":1,"building_name":"Grain Farm","building_img":"","is_raw":true,"raw_img":"http://www.erepublik.com/images/icons/industry/7/default.png","preset_works":0,"preset_own_work":0,"base_production":35,"resource_bonus":80,"raw_usage":0,"production":0,"employee_limit":"0","upgrade_url":"","todays_works":0,"total_works":0,"sell_url":"http://economy.erepublik.com/en/company/sell/1120615","upgrades":[],"max_quality":0}'),
(7, '{"industry_id":13,"industry_name":"Oil","industry_token":"WEAPON","products_img":"","quality":1,"building_name":"Oil Rig","building_img":"","is_raw":true,"raw_img":"http://www.erepublik.com/images/icons/industry/12/default.png","preset_works":0,"preset_own_work":0,"base_production":70,"resource_bonus":80,"raw_usage":0,"production":0,"employee_limit":"0","upgrade_url":"","todays_works":0,"total_works":0,"sell_url":"http://economy.erepublik.com/en/company/sell/1208032","upgrades":[],"max_quality":0}'),
(8, '{"industry_id":12,"industry_name":"Iron","industry_token":"WEAPON","products_img":"","quality":1,"building_name":"Iron Mine","building_img":"","is_raw":true,"raw_img":"http://www.erepublik.com/images/icons/industry/12/default.png","preset_works":0,"preset_own_work":0,"base_production":35,"resource_bonus":80,"raw_usage":0,"production":0,"employee_limit":"0","upgrade_url":"","todays_works":0,"total_works":0,"sell_url":"http://economy.erepublik.com/en/company/sell/1234094","upgrades":[],"max_quality":0}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(3) NOT NULL,
  `name` varchar(120) NOT NULL,
  `initials` varchar(4) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `currency` varchar(3) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`, `initials`, `is_active`, `currency`) VALUES
(167, 'Albania', '', 1, ''),
(27, 'Argentina', '', 1, ''),
(50, 'Australia', '', 1, ''),
(33, 'Austria', '', 1, ''),
(83, 'Belarus', '', 1, ''),
(32, 'Belgium', '', 1, ''),
(76, 'Bolivia', '', 1, ''),
(69, 'Bosnia and Herzegovina', '', 1, ''),
(9, 'Brazil', '', 1, ''),
(42, 'Bulgaria', '', 1, ''),
(23, 'Canada', '', 1, ''),
(64, 'Chile', '', 1, ''),
(14, 'China', '', 1, ''),
(78, 'Colombia', '', 1, ''),
(63, 'Croatia', '', 1, ''),
(82, 'Cyprus', '', 1, ''),
(34, 'Czech Republic', '', 1, ''),
(55, 'Denmark', '', 1, ''),
(165, 'Egypt', '', 1, ''),
(70, 'Estonia', '', 1, ''),
(39, 'Finland', '', 1, ''),
(11, 'France', '', 1, ''),
(12, 'Germany', '', 1, ''),
(44, 'Greece', '', 1, ''),
(13, 'Hungary', '', 1, ''),
(48, 'India', '', 1, ''),
(49, 'Indonesia', '', 1, ''),
(56, 'Iran', '', 1, ''),
(54, 'Ireland', '', 1, ''),
(58, 'Israel', '', 1, ''),
(10, 'Italy', '', 1, ''),
(45, 'Japan', '', 1, ''),
(71, 'Latvia', '', 1, ''),
(72, 'Lithuania', '', 1, ''),
(66, 'Malaysia', '', 1, ''),
(26, 'Mexico', '', 1, ''),
(80, 'Montenegro', '', 1, ''),
(31, 'Netherlands', '', 1, ''),
(84, 'New Zealand', '', 1, ''),
(73, 'North Korea', '', 1, ''),
(37, 'Norway', '', 1, ''),
(57, 'Pakistan', '', 1, ''),
(75, 'Paraguay', '', 1, ''),
(77, 'Peru', '', 1, ''),
(67, 'Philippines', '', 1, ''),
(35, 'Poland', '', 1, ''),
(53, 'Portugal', '', 1, ''),
(81, 'Republic of China (Taiwan)', '', 1, ''),
(79, 'Republic of Macedonia (FYROM)', '', 1, ''),
(52, 'Republic of Moldova', '', 1, ''),
(1, 'Romania', '', 1, ''),
(41, 'Russia', '', 1, ''),
(164, 'Saudi Arabia', '', 1, ''),
(65, 'Serbia', '', 1, ''),
(68, 'Singapore', '', 1, ''),
(36, 'Slovakia', '', 1, ''),
(61, 'Slovenia', '', 1, ''),
(51, 'South Africa', '', 1, ''),
(47, 'South Korea', '', 1, ''),
(15, 'Spain', '', 1, ''),
(38, 'Sweden', '', 1, ''),
(30, 'Switzerland', '', 1, ''),
(59, 'Thailand', '', 1, ''),
(43, 'Turkey', '', 1, ''),
(40, 'Ukraine', '', 1, ''),
(166, 'United Arab Emirates', '', 1, ''),
(29, 'United Kingdom', '', 1, ''),
(74, 'Uruguay', '', 1, ''),
(24, 'USA', '', 1, ''),
(28, 'Venezuela', '', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grounds`
--

CREATE TABLE IF NOT EXISTS `grounds` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `json` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `grounds`
--

INSERT INTO `grounds` (`id`, `json`) VALUES
(1, '{"price":"0","cost":"0.00","bonus":0,"quality":"2","img":"/images/modules/myland/buildings/training_grounds_q2.png","name":"Weights Room - Quality 2","strength":0,"upgrades":{"1":{"level":1,"strength":5,"cost":10,"img":"http://www.erepublik.com/images/modules/manager/train_upgrades/training_grounds_q1.png","type":-1},"2":{"level":2,"strength":10,"cost":0,"img":"http://www.erepublik.com/images/modules/manager/train_upgrades/training_grounds_q2.png","type":0},"3":{"level":3,"strength":15,"cost":50,"img":"http://www.erepublik.com/images/modules/manager/train_upgrades/training_grounds_q3.png","type":1}}}'),
(2, '{"price":"100","cost":"0.19","bonus":"2.5","quality":"1","img":"/images/modules/myland/buildings/train_1.png","name":"Climbing Center - Quality 1","strength":2.5,"upgrades":{"1":{"level":1,"strength":2.5,"cost":0,"img":"http://www.erepublik.com/images/modules/manager/train_upgrades/train_1_q1.png","type":0},"2":{"level":2,"strength":5,"cost":20,"img":"http://www.erepublik.com/images/modules/manager/train_upgrades/train_1_q2.png","type":1},"3":{"level":3,"strength":7.5,"cost":70,"img":"http://www.erepublik.com/images/modules/manager/train_upgrades/train_1_q3.png","type":1}}}'),
(3, '{"price":"200","cost":"1.49","bonus":5,"quality":"1","img":"/images/modules/myland/buildings/train_2.png","name":"Shooting Range - Quality 1","strength":5,"upgrades":{"1":{"level":1,"strength":5,"cost":0,"img":"http://www.erepublik.com/images/modules/manager/train_upgrades/train_2_q1.png","type":0},"2":{"level":2,"strength":10,"cost":20,"img":"http://www.erepublik.com/images/modules/manager/train_upgrades/train_2_q2.png","type":1},"3":{"level":3,"strength":15,"cost":70,"img":"http://www.erepublik.com/images/modules/manager/train_upgrades/train_2_q3.png","type":1}}}'),
(4, '{"price":"300","cost":"1.79","bonus":10,"quality":"1","img":"/images/modules/myland/buildings/train_3.png","name":"Special Forces Center - Quality 1","strength":10,"upgrades":{"1":{"level":1,"strength":10,"cost":0,"img":"http://www.erepublik.com/images/modules/manager/train_upgrades/train_3_q1.png","type":0},"2":{"level":2,"strength":20,"cost":20,"img":"http://www.erepublik.com/images/modules/manager/train_upgrades/train_3_q2.png","type":1},"3":{"level":3,"strength":30,"cost":70,"img":"http://www.erepublik.com/images/modules/manager/train_upgrades/train_3_q3.png","type":1}}}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `type` int(1) NOT NULL,
  `json` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `name`, `type`, `json`) VALUES
(1, 'Grain raw', 1, ''),
(2, 'Weapon raw', 1, ''),
(3, 'Food', 2, '[{"1":{"energy":"2"}},{"2":{"energy":"4"}},{"3":{"energy":"6"}},\r\n{"4":{"energy":"8"}},{"5":{"energy":"10"}},{"6":{"energy":"12"}},{"7":{"energy":"20"}},{"10":{"energy":"100"}}]'),
(4, 'Weapon', 3, '[{"0":{"power":"20","durability":1}},{"1":{"power":"40","durability":2}},\r\n{"2":{"power":"60","durability":3}},\r\n{"3":{"power":"80","durability":4}},\r\n{"4":{"power":"100","durability":5}},\r\n{"5":{"power":"120","durability":6}},\r\n{"6":{"power":"200","durability":10}}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `missions`
--

CREATE TABLE IF NOT EXISTS `missions` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `rewards` text NOT NULL,
  `conditions` text NOT NULL,
  `hint` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `nick` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `date` char(14) NOT NULL,
  `status` int(1) NOT NULL,
  `pass` varchar(120) NOT NULL,
  `maxhp` int(10) NOT NULL,
  `currenthp` int(10) NOT NULL,
  `country` int(8) NOT NULL,
  `gold` varchar(10) NOT NULL,
  `money` varchar(20) NOT NULL,
  `xp` int(30) NOT NULL,
  UNIQUE KEY `nick` (`nick`,`email`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
