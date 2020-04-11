-- phpMyAdmin SQL Dump
-- version 4.3.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 19 2015 г., 20:05
-- Версия сервера: 5.5.27
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `saitznak`
--

-- --------------------------------------------------------

--
-- Структура таблицы `adminblockedlog`
--

CREATE TABLE `adminblockedlog` (
  `login` varchar(255) NOT NULL COMMENT 'логин'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='таблица администратора';

--
-- Дамп данных таблицы `adminblockedlog`
--

INSERT INTO `adminblockedlog` (`login`) VALUES
('OQ==');

-- --------------------------------------------------------

--
-- Структура таблицы `adresatsms`
--

CREATE TABLE `adresatsms` (
  `nom` int(10) unsigned NOT NULL,
  `otkogo` varchar(255) NOT NULL,
  `komu` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `adresatsms`
--

INSERT INTO `adresatsms` (`nom`, `otkogo`, `komu`) VALUES
(1, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', ''),
(2, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI='),
(3, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'OQ=='),
(4, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'NTU='),
(5, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'Mw=='),
(6, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'NA=='),
(7, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'NQ=='),
(8, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '﻿bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ=='),
(9, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', ''),
(10, '', ''),
(11, '', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ=='),
(12, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ=='),
(13, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'NA==');

-- --------------------------------------------------------

--
-- Структура таблицы `druzyainet`
--

CREATE TABLE `druzyainet` (
  `nom` int(10) unsigned NOT NULL,
  `moy` varchar(255) NOT NULL COMMENT 'кому',
  `drug` varchar(255) NOT NULL COMMENT 'друзья',
  `net` tinyint(4) NOT NULL COMMENT 'черный список',
  `da` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='друзья и черный список';

--
-- Дамп данных таблицы `druzyainet`
--

INSERT INTO `druzyainet` (`nom`, `moy`, `drug`, `net`, `da`) VALUES
(1, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 0, 1),
(2, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'OQ==', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `forgostey`
--

CREATE TABLE `forgostey` (
  `nomer` int(10) unsigned NOT NULL,
  `login` varchar(255) NOT NULL COMMENT 'моя',
  `login_q` varchar(255) NOT NULL COMMENT 'кто заходил',
  `data` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COMMENT='гости';

--
-- Дамп данных таблицы `forgostey`
--

INSERT INTO `forgostey` (`nomer`, `login`, `login_q`, `data`) VALUES
(1, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-05 13:53:11'),
(2, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-05 13:53:24'),
(3, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '', '2015-04-05 14:19:03'),
(4, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '', '2015-04-05 14:38:02'),
(5, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '', '2015-04-05 14:41:28'),
(6, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'MQ==', '2015-04-05 18:50:58'),
(7, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'MQ==', '2015-04-05 18:52:04'),
(8, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'MTA=', '2015-04-05 18:52:54'),
(9, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-05 20:30:46'),
(10, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-05 20:40:40'),
(11, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-05 20:43:12'),
(12, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-05 20:43:56'),
(13, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-05 20:44:04'),
(14, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-05 20:46:19'),
(15, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 17:12:49'),
(16, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 17:38:55'),
(17, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 17:57:41'),
(18, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:28:49'),
(19, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:29:04'),
(20, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:30:12'),
(21, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:32:37'),
(22, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:33:22'),
(23, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:38:40'),
(24, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:39:10'),
(25, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:40:09'),
(26, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:41:40'),
(27, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:42:23'),
(28, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:47:04'),
(29, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:47:46'),
(30, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:48:05'),
(31, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:48:32'),
(32, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:52:06'),
(33, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-09 18:53:05'),
(34, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-14 07:59:57'),
(35, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-15 20:18:14'),
(36, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-16 16:50:49'),
(37, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-16 16:51:21'),
(38, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'OQ==', '2015-04-16 16:53:21'),
(39, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'OQ==', '2015-04-16 16:53:31'),
(40, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'OQ==', '2015-04-16 16:54:34'),
(41, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'OQ==', '2015-04-16 16:55:10'),
(42, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'OQ==', '2015-04-16 16:55:29'),
(43, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'OQ==', '2015-04-16 16:55:35'),
(44, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'OQ==', '2015-04-16 16:55:41'),
(45, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'OQ==', '2015-04-16 16:56:03'),
(46, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'OQ==', '2015-04-16 16:56:22'),
(47, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'NTU=', '2015-04-16 18:02:58'),
(48, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'NTU=', '2015-04-16 18:03:52'),
(49, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'Mw==', '2015-04-16 18:04:41'),
(50, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-16 18:05:30'),
(51, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-16 18:16:47'),
(52, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'NA==', '2015-04-16 18:17:15'),
(53, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'NA==', '2015-04-16 18:17:31'),
(54, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'NQ==', '2015-04-16 18:25:53'),
(55, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'NA==', '2015-04-16 18:35:36'),
(56, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '﻿bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-16 18:35:55'),
(57, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '', '2015-04-17 18:22:29'),
(58, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '', '2015-04-17 18:39:32'),
(59, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '', '2015-04-17 18:39:51'),
(60, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 18:43:22'),
(61, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'NA==', '2015-04-17 18:43:46'),
(62, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'NA==', '2015-04-17 18:44:26'),
(63, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'NA==', '2015-04-17 18:47:53'),
(64, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '', '2015-04-17 18:48:20'),
(65, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '', '2015-04-17 19:55:06'),
(66, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '', '2015-04-17 19:55:14'),
(67, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'MTA=', '2015-04-17 20:06:49'),
(68, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 20:15:57'),
(69, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 20:17:02'),
(70, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 20:17:32'),
(71, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 20:18:08'),
(72, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 20:19:14'),
(73, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 20:20:48'),
(74, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 20:21:28'),
(75, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 20:21:49'),
(76, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 20:22:16'),
(77, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 20:22:36'),
(78, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 20:55:53'),
(79, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-17 21:07:45'),
(80, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'NA==', '2015-04-17 21:38:52'),
(81, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2015-04-18 08:27:32'),
(82, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-18 14:05:37'),
(83, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-18 14:29:18'),
(84, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-18 14:29:31'),
(85, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2015-04-18 18:31:33'),
(86, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'Mw==', '2015-04-18 18:31:46');

-- --------------------------------------------------------

--
-- Структура таблицы `fototabl`
--

CREATE TABLE `fototabl` (
  `loginp` varchar(255) NOT NULL COMMENT 'логин пользователя',
  `foto` varchar(255) NOT NULL COMMENT 'имя фото',
  `metka` varchar(10) NOT NULL COMMENT 'указатель на главную фотографию',
  `opisanie` varchar(255) NOT NULL COMMENT 'описание от пользователя',
  `ponravilos` text NOT NULL COMMENT 'список логинов которым понравилось фото',
  `nom` int(10) unsigned NOT NULL COMMENT 'номер фото',
  `data` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='фотографии';

--
-- Дамп данных таблицы `fototabl`
--

INSERT INTO `fototabl` (`loginp`, `foto`, `metka`, `opisanie`, `ponravilos`, `nom`, `data`) VALUES
('bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '201504030828300000000031.jpg', '', '', '', 3, '0000-00-00 00:00:00'),
('bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '201504032253450000000032.jpg', '', '', '', 4, '0000-00-00 00:00:00'),
('bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '201504041139370000000032.jpg', '', 'fotkik', '', 5, '0000-00-00 00:00:00'),
('bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '201504051337130000000032.jpg', '', 'цветочки еще', '', 7, '2015-04-05 12:37:14'),
('bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '201504161748400000000032.jpg', 'glav', '', '', 8, '2015-04-16 16:48:41'),
('bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '201504181522590000000032.jpg', '', '', '', 9, '2015-04-18 14:23:00');

-- --------------------------------------------------------

--
-- Структура таблицы `goroda`
--

CREATE TABLE `goroda` (
  `region` varchar(255) NOT NULL COMMENT 'регион'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goroda`
--

INSERT INTO `goroda` (`region`) VALUES
('Адыгея Республика'),
('Алтай Республика'),
('Алтайский край'),
('Амурская область'),
('Архангельская область'),
('Астраханская область'),
('Башкортостан Республика'),
('Белгородская область'),
('Брянская область'),
('Бурятия Республика'),
('Владимирская область'),
('Волгоградская область'),
('Вологодская область'),
('Воронежская область'),
('Дагестан Республика'),
('Еврейская автономная область'),
('Забайкальский край'),
('Ивановская область'),
('Ингушетия Республика'),
('Иркутская область'),
('Кабардино-Балкарская Республика'),
('Калининградская область'),
('Калмыкия Республика'),
('Калужская область'),
('Камчатский край'),
('Карачаево-Черкесская Республика'),
('Карелия Республика'),
('Кемеровская область'),
('Кировская область'),
('Коми Республика'),
('Костромская область'),
('Краснодарский край'),
('Крым Республика'),
('Курганская область'),
('Курская область'),
('Ленинградская область'),
('Липецкая область'),
('Магаданская область'),
('Марий Эл Республика'),
('Мордовия Республика'),
('Москва город федерального значения'),
('Московская область'),
('Мурманская область'),
('Ненецкий автономный округ'),
('Нижегородская область'),
('Новгородская область'),
('Новосибирская область'),
('Омская область'),
('Оренбургская область'),
('Орловская область'),
('Пензенская область'),
('Пермский край'),
('Приморский край'),
('Псковская область'),
('Ростовская область'),
('Рязанская область'),
('Самарская область'),
('Санкт-Петербург город федерального значения'),
('Саратовская область'),
('Саха (Якутия) Республика'),
('Сахалинская область'),
('Свердловская область'),
('Севастополь город федерального значения'),
('Северная Осетия  - Алания Республика'),
('Смоленская область'),
('Ставропольский край'),
('Тамбовская область'),
('Татарстан Республика'),
('Тверская область'),
('Томская область'),
('Тульская область'),
('Тыва Республика'),
('Тюменская область'),
('Удмуртская Республика'),
('Ульяновская область'),
('Хабаровский край'),
('Хакасия Республика'),
('Ханты-Мансийский (Югра) автономный округ'),
('Челябинская область'),
('Чеченская Республика'),
('Чувашская Республика'),
('Чукотский автономный округ'),
('Ямало-Ненецкий автономный округ'),
('Ярославская область');

-- --------------------------------------------------------

--
-- Структура таблицы `lichnoe`
--

CREATE TABLE `lichnoe` (
  `loginp` varchar(255) NOT NULL COMMENT 'логин пользователя',
  `imya` varchar(255) NOT NULL COMMENT 'имя',
  `region` varchar(255) NOT NULL,
  `gorod` varchar(255) NOT NULL,
  `datarozd` date NOT NULL,
  `vozrast` tinyint(4) NOT NULL,
  `metkap` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'группа',
  `ipp` varchar(255) NOT NULL COMMENT 'ip пользователя',
  `limitfoto` tinyint(4) NOT NULL DEFAULT '10' COMMENT 'количество фото',
  `osebe` text NOT NULL COMMENT 'анкетка'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Личные данные';

--
-- Дамп данных таблицы `lichnoe`
--

INSERT INTO `lichnoe` (`loginp`, `imya`, `region`, `gorod`, `datarozd`, `vozrast`, `metkap`, `ipp`, `limitfoto`, `osebe`) VALUES
('bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'миша', 'Адыгея Республика', 'Астрахань', '1948-05-03', 67, 0, '127.0.0.1', 10, 'hhho2'),
('bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '&lt;hr&gt;', '', '', '1980-01-03', 35, 0, '127.0.0.1', 10, ''),
('MQ==', '1', '', '', '1980-01-03', 0, 0, '', 10, ''),
('MTA=', '2', '', '', '1980-02-02', 0, 0, '0', 10, ''),
('Mw==', '3', '', '', '1980-02-02', 0, 0, '0', 10, ''),
('NA==', '', '', '', '1980-02-02', 0, 0, '0', 10, ''),
('Ng==', '', '', '', '1980-02-02', 0, 0, '0', 10, ''),
('NQ==', '', '', '', '1980-02-02', 0, 0, '0', 10, ''),
('NTU=', '', '', '', '1980-02-02', 0, 0, '0', 10, ''),
('Nw==', '', '', '', '1980-02-02', 0, 0, '0', 10, ''),
('OA==', '', '', '', '1980-02-02', 0, 0, '0', 10, ''),
('OQ==', '', '', '', '1980-02-02', 0, 0, '0', 10, ''),
('﻿bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '', '', '', '1980-02-02', 0, 0, '0', 10, '');

-- --------------------------------------------------------

--
-- Структура таблицы `metki`
--

CREATE TABLE `metki` (
  `loginp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `online`
--

CREATE TABLE `online` (
  `login` varchar(255) NOT NULL,
  `idsession` varchar(255) NOT NULL,
  `vremya` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='пользователи онлайн';

--
-- Дамп данных таблицы `online`
--

INSERT INTO `online` (`login`, `idsession`, `vremya`) VALUES
('bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '', '2015-04-18 20:28:54');

-- --------------------------------------------------------

--
-- Структура таблицы `polzovateli`
--

CREATE TABLE `polzovateli` (
  `nomp` int(10) unsigned zerofill NOT NULL COMMENT 'номер пользователя',
  `loginp` varchar(255) NOT NULL COMMENT 'логин',
  `parp` varchar(255) NOT NULL COMMENT 'пароль',
  `vrepar` varchar(255) NOT NULL COMMENT 'временный пароль'
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COMMENT='Пользователи';

--
-- Дамп данных таблицы `polzovateli`
--

INSERT INTO `polzovateli` (`nomp`, `loginp`, `parp`, `vrepar`) VALUES
(0000000017, 'MQ==', 'MQ==', ' '),
(0000000018, 'Mg==', 'Mg==', ' '),
(0000000019, 'Mw==', 'Mw==', ' '),
(0000000020, 'NA==', 'NA==', ' '),
(0000000021, 'NQ==', 'NQ==', ' '),
(0000000022, 'Ng==', 'Ng==', ' '),
(0000000023, 'Nw==', 'Nw==', ' '),
(0000000024, 'OA==', 'OA==', ' '),
(0000000025, 'OQ==', 'OQ==', ' '),
(0000000027, 'NDQ=', 'NDQ=', ' '),
(0000000029, 'MTEx', 'MTEx', ' '),
(0000000031, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', ' '),
(0000000032, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '12677'),
(0000000033, 'NTU=', '8effee409c625e1a2d8f5033631840e6ce1dcb64', ' '),
(0000000043, 'MTA=', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', ' ');

-- --------------------------------------------------------

--
-- Структура таблицы `soobsheniya`
--

CREATE TABLE `soobsheniya` (
  `nomer` int(10) unsigned NOT NULL COMMENT 'номер сообщения',
  `otkogo` varchar(255) NOT NULL,
  `komu` varchar(255) NOT NULL,
  `soobshenie` text NOT NULL,
  `data` datetime NOT NULL,
  `otmetka` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'по умолчанию 0 не прочитано'
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COMMENT='таблица сообщений';

--
-- Дамп данных таблицы `soobsheniya`
--

INSERT INTO `soobsheniya` (`nomer`, `otkogo`, `komu`, `soobshenie`, `data`, `otmetka`) VALUES
(1, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '1265', '2015-04-05 21:30:55', 1),
(2, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '26', '2015-04-05 21:31:17', 1),
(3, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '698', '2015-04-05 21:33:29', 1),
(4, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '98', '2015-04-05 21:35:44', 1),
(5, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'kl', '2015-04-05 21:37:10', 1),
(6, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '3', '2015-04-05 21:37:50', 1),
(7, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '64', '2015-04-05 21:39:24', 1),
(8, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '6', '2015-04-05 21:40:35', 1),
(9, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'привет', '2015-04-05 21:43:03', 1),
(10, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'рпщтрппр', '2015-04-05 21:43:29', 1),
(11, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '65р56о', '2015-04-05 21:43:34', 1),
(12, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '1', '2015-04-13 10:14:26', 1),
(13, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2', '2015-04-13 10:14:47', 1),
(14, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '3', '2015-04-13 10:14:54', 1),
(15, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'й', '2015-04-13 10:16:33', 1),
(16, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '6цук', '2015-04-13 10:17:55', 1),
(17, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'бь бь юб', '2015-04-13 10:19:35', 1),
(18, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '1', '2015-04-14 07:44:11', 1),
(19, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '1', '2015-04-14 07:58:44', 1),
(20, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2', '2015-04-14 08:04:20', 1),
(21, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'hjhjh', '2015-04-14 08:06:16', 1),
(22, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '999', '2015-04-14 08:09:47', 1),
(23, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'lkl', '2015-04-14 16:12:26', 1),
(24, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'fgjhgm пать', '2015-04-14 16:50:23', 1),
(25, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2', '2015-04-14 17:16:15', 1),
(26, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '6589', '2015-04-14 17:39:14', 1),
(27, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '2', '2015-04-14 18:22:51', 1),
(28, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'q', '2015-04-14 18:39:53', 1),
(29, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '5', '2015-04-14 18:50:03', 1),
(30, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'lk', '2015-04-14 18:51:01', 1),
(31, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'knkjhjb', '2015-04-14 19:23:19', 1),
(32, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'jjj', '2015-04-14 19:40:06', 1),
(33, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'ссс', '2015-04-14 19:54:16', 1),
(34, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'авпапаи', '2015-04-14 19:56:57', 1),
(35, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '41', '2015-04-14 20:16:30', 1),
(36, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'т', '2015-04-15 09:46:18', 1),
(37, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'однр', '2015-04-15 17:37:59', 1),
(38, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'kjnj', '2015-04-15 18:41:56', 1),
(39, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'ghnjhgg', '2015-04-15 18:47:02', 1),
(40, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'tyjtj', '2015-04-15 18:47:58', 1),
(41, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'gmntgmgh', '2015-04-15 18:50:46', 1),
(42, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'йцвчидтсцрсц \r\nукаим', '2015-04-15 19:04:41', 1),
(43, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '3265', '2015-04-15 21:08:33', 1),
(44, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'авиапи', '2015-04-15 21:11:53', 1),
(45, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'ывсцымв', '2015-04-15 21:13:31', 1),
(46, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'орборб', '2015-04-15 21:17:43', 1),
(47, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'прр пр', '2015-04-15 21:18:09', 1),
(48, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '123', '2015-04-16 17:50:43', 1),
(49, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', '123', '2015-04-16 17:51:16', 1),
(50, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'OQ==', '2', '2015-04-16 17:54:23', 0),
(51, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'Mw==', 'l', '2015-04-16 19:05:00', 0),
(52, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'Mw==', 'l', '2015-04-16 19:05:52', 0),
(53, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'NA==', '1', '2015-04-16 19:17:40', 0),
(54, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'NTU=', '44', '2015-04-16 19:32:17', 0),
(55, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'Mw==', '52', '2015-04-16 19:35:17', 0),
(56, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'Mw==', 'tfr', '2015-04-16 19:46:03', 0),
(57, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '1', '2015-04-17 19:23:00', 1),
(58, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '2', '2015-04-17 19:39:03', 1),
(59, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'iy', '2015-04-17 19:41:14', 1),
(60, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'NA==', '2', '2015-04-17 19:43:56', 0),
(61, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'gfngfmgh gh', '2015-04-18 08:20:42', 1),
(62, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'gfnghghmhj', '2015-04-18 08:20:48', 1),
(63, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'ghjmhmhj  j', '2015-04-18 08:20:52', 1),
(64, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'hj,hj gf', '2015-04-18 08:20:57', 1),
(65, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'sdvcsdvb', '2015-04-18 08:21:01', 1),
(66, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'ujy,um', '2015-04-18 08:21:06', 1),
(67, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydTEyMTI=', 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '6', '2015-04-18 08:25:54', 1),
(68, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'Mw==', 'огпргрпоиот', '2015-04-18 21:29:18', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `statusp`
--

CREATE TABLE `statusp` (
  `nomp` int(10) unsigned NOT NULL,
  `login` varchar(255) NOT NULL,
  `texts` text NOT NULL COMMENT 'мысль вслух',
  `data` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Мысль пользователя';

--
-- Дамп данных таблицы `statusp`
--

INSERT INTO `statusp` (`nomp`, `login`, `texts`, `data`) VALUES
(1, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'ghbdtn', '2015-04-05 17:10:39'),
(2, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'превед', '2015-04-05 17:10:49'),
(3, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'превед', '2015-04-05 17:11:12'),
(4, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'пусть всегда будет небо', '2015-04-05 17:18:36'),
(5, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'пусть будет папа!', '2015-04-05 17:19:38'),
(6, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'все ok!', '2015-04-05 18:33:19'),
(7, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '', '2015-04-05 20:29:41'),
(8, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '', '2015-04-05 20:29:58'),
(9, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'привет по ссылке', '2015-04-15 07:57:21'),
(10, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'все равно все ок!!', '2015-04-15 07:59:44'),
(11, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'ну', '2015-04-15 21:58:49'),
(12, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', 'хоть так, все равно он динамическую кнопку не видит', '2015-04-15 21:59:28'),
(13, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '523', '2015-04-16 16:53:01');

-- --------------------------------------------------------

--
-- Структура таблицы `threetimesblock`
--

CREATE TABLE `threetimesblock` (
  `nomer` int(10) unsigned NOT NULL,
  `loginr` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `timer` datetime NOT NULL,
  `parol` varchar(255) NOT NULL,
  `times` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='таблица для недопущения ввода данных более 3 раз за 15 минут';

--
-- Дамп данных таблицы `threetimesblock`
--

INSERT INTO `threetimesblock` (`nomer`, `loginr`, `ip`, `timer`, `parol`, `times`) VALUES
(1, 'bWlzaGFueWFrYXNoaW5AbWFpbC5ydQ==', '127.0.0.1', '2015-04-15 22:01:24', '1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9', 0),
(2, 'bWlzaGFueWFNaXNoYW55YQ==', '127.0.0.1', '2015-04-09 17:09:31', 'fe820c6e49b1c949a097c4eb40e593fbf4eb362c', 3),
(3, '', '127.0.0.1', '2015-04-16 18:40:58', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `zalobyna`
--

CREATE TABLE `zalobyna` (
  `nom` int(10) unsigned NOT NULL,
  `login_q` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `vremya` datetime NOT NULL,
  `prichina` varchar(255) NOT NULL COMMENT 'причина жалобы'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Черный список';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `adminblockedlog`
--
ALTER TABLE `adminblockedlog`
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `adresatsms`
--
ALTER TABLE `adresatsms`
  ADD PRIMARY KEY (`nom`);

--
-- Индексы таблицы `druzyainet`
--
ALTER TABLE `druzyainet`
  ADD PRIMARY KEY (`nom`);

--
-- Индексы таблицы `forgostey`
--
ALTER TABLE `forgostey`
  ADD UNIQUE KEY `nomer` (`nomer`);

--
-- Индексы таблицы `fototabl`
--
ALTER TABLE `fototabl`
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Индексы таблицы `goroda`
--
ALTER TABLE `goroda`
  ADD UNIQUE KEY `region` (`region`);

--
-- Индексы таблицы `lichnoe`
--
ALTER TABLE `lichnoe`
  ADD UNIQUE KEY `loginp` (`loginp`);

--
-- Индексы таблицы `metki`
--
ALTER TABLE `metki`
  ADD UNIQUE KEY `login_p` (`loginp`);

--
-- Индексы таблицы `online`
--
ALTER TABLE `online`
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `polzovateli`
--
ALTER TABLE `polzovateli`
  ADD PRIMARY KEY (`nomp`), ADD UNIQUE KEY `loginp` (`loginp`);

--
-- Индексы таблицы `soobsheniya`
--
ALTER TABLE `soobsheniya`
  ADD UNIQUE KEY `nomer` (`nomer`);

--
-- Индексы таблицы `statusp`
--
ALTER TABLE `statusp`
  ADD UNIQUE KEY `nomp` (`nomp`);

--
-- Индексы таблицы `threetimesblock`
--
ALTER TABLE `threetimesblock`
  ADD UNIQUE KEY `nomer` (`nomer`), ADD UNIQUE KEY `loginr` (`loginr`);

--
-- Индексы таблицы `zalobyna`
--
ALTER TABLE `zalobyna`
  ADD UNIQUE KEY `nom` (`nom`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `adresatsms`
--
ALTER TABLE `adresatsms`
  MODIFY `nom` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `druzyainet`
--
ALTER TABLE `druzyainet`
  MODIFY `nom` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `forgostey`
--
ALTER TABLE `forgostey`
  MODIFY `nomer` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT для таблицы `fototabl`
--
ALTER TABLE `fototabl`
  MODIFY `nom` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'номер фото',AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `polzovateli`
--
ALTER TABLE `polzovateli`
  MODIFY `nomp` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'номер пользователя',AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT для таблицы `soobsheniya`
--
ALTER TABLE `soobsheniya`
  MODIFY `nomer` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'номер сообщения',AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT для таблицы `statusp`
--
ALTER TABLE `statusp`
  MODIFY `nomp` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `threetimesblock`
--
ALTER TABLE `threetimesblock`
  MODIFY `nomer` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `zalobyna`
--
ALTER TABLE `zalobyna`
  MODIFY `nom` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
