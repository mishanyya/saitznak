-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2016 at 08:33 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `saitznak`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminblockedlog`
--

CREATE TABLE IF NOT EXISTS `adminblockedlog` (
  `login` varchar(255) NOT NULL COMMENT 'логин',
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='таблица администратора';

-- --------------------------------------------------------

--
-- Table structure for table `adresatsms`
--

CREATE TABLE IF NOT EXISTS `adresatsms` (
  `nom` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `otkogo` varchar(255) NOT NULL,
  `komu` varchar(255) NOT NULL,
  PRIMARY KEY (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE IF NOT EXISTS `anketa` (
  `loginp` varchar(255) NOT NULL COMMENT 'логин',
  `obrazovanie` text NOT NULL COMMENT 'образование',
  `zanyatiya` text NOT NULL COMMENT 'занятие',
  `prozhivanie` text NOT NULL COMMENT 'проживание',
  `deti` text NOT NULL COMMENT 'дети',
  `uvlechenie` text NOT NULL COMMENT 'увлечения',
  `privichki` text NOT NULL COMMENT 'привычки',
  `dopolnitelno` text NOT NULL COMMENT 'дополнительно',
  PRIMARY KEY (`loginp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='таблица для анкеты';

-- --------------------------------------------------------

--
-- Table structure for table `druzyainet`
--

CREATE TABLE IF NOT EXISTS `druzyainet` (
  `nom` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `moy` varchar(255) NOT NULL COMMENT 'кому',
  `drug` varchar(255) NOT NULL COMMENT 'друзья',
  `net` tinyint(4) NOT NULL COMMENT 'черный список',
  `da` tinyint(4) NOT NULL,
  PRIMARY KEY (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='друзья и черный список' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `forgostey`
--

CREATE TABLE IF NOT EXISTS `forgostey` (
  `nomer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL COMMENT 'моя',
  `login_q` varchar(255) NOT NULL COMMENT 'кто заходил',
  `data` datetime NOT NULL,
  UNIQUE KEY `nomer` (`nomer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='гости' AUTO_INCREMENT=363 ;

-- --------------------------------------------------------

--
-- Table structure for table `fototabl`
--

CREATE TABLE IF NOT EXISTS `fototabl` (
  `loginp` varchar(255) NOT NULL COMMENT 'логин пользователя',
  `foto` varchar(255) NOT NULL COMMENT 'имя фото',
  `metka` varchar(10) NOT NULL COMMENT 'указатель на главную фотографию',
  `opisanie` varchar(255) NOT NULL COMMENT 'описание от пользователя',
  `ponravilos` text NOT NULL COMMENT 'список логинов которым понравилось фото',
  `nom` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'номер фото',
  `data` datetime NOT NULL,
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='фотографии' AUTO_INCREMENT=57 ;

-- --------------------------------------------------------

--
-- Table structure for table `goroda`
--

CREATE TABLE IF NOT EXISTS `goroda` (
  `region` varchar(255) NOT NULL COMMENT 'регион',
  UNIQUE KEY `region` (`region`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lichnoe`
--

CREATE TABLE IF NOT EXISTS `lichnoe` (
  `loginp` varchar(255) NOT NULL COMMENT 'логин пользователя',
  `imya` varchar(255) NOT NULL COMMENT 'имя',
  `region` varchar(255) NOT NULL,
  `gorod` varchar(255) NOT NULL,
  `datarozd` date NOT NULL,
  `vozrast` tinyint(4) NOT NULL,
  `metkap` tinyint(4) NOT NULL COMMENT 'группа',
  `ipp` varchar(255) NOT NULL COMMENT 'ip пользователя',
  `limitfoto` tinyint(4) NOT NULL COMMENT 'количество фото',
  `osebe` varchar(255) NOT NULL COMMENT 'замужем/незамужем',
  `pol` varchar(7) NOT NULL COMMENT 'пол человека',
  `nomp` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'номер пользователя',
  PRIMARY KEY (`nomp`),
  UNIQUE KEY `loginp` (`loginp`),
  UNIQUE KEY `nomp` (`nomp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Личные данные' AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `metki`
--

CREATE TABLE IF NOT EXISTS `metki` (
  `loginp` varchar(255) NOT NULL,
  UNIQUE KEY `login_p` (`loginp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE IF NOT EXISTS `online` (
  `login` varchar(255) NOT NULL,
  `idsession` varchar(255) NOT NULL,
  `vremya` datetime NOT NULL,
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='пользователи онлайн';

-- --------------------------------------------------------

--
-- Table structure for table `polzovateli`
--

CREATE TABLE IF NOT EXISTS `polzovateli` (
  `nomp` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'номер пользователя',
  `loginp` varchar(255) NOT NULL COMMENT 'логин',
  `parp` varchar(255) NOT NULL COMMENT 'пароль',
  `vrepar` varchar(255) NOT NULL COMMENT 'временный пароль',
  `timeregistr` datetime NOT NULL COMMENT 'дата регистрации',
  `proveren` tinyint(4) NOT NULL COMMENT 'подтверждение',
  `dengymone` int(11) NOT NULL COMMENT 'местные деньги',
  PRIMARY KEY (`nomp`),
  UNIQUE KEY `loginp` (`loginp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Пользователи' AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `regiongorod`
--

CREATE TABLE IF NOT EXISTS `regiongorod` (
  `region` varchar(255) NOT NULL,
  `gorod` varchar(255) NOT NULL,
  `nom` int(11) NOT NULL AUTO_INCREMENT COMMENT 'номер',
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='сюда вносятся города к регионам' AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `soobsheniya`
--

CREATE TABLE IF NOT EXISTS `soobsheniya` (
  `nomer` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'номер сообщения',
  `otkogo` varchar(255) NOT NULL,
  `komu` varchar(255) NOT NULL,
  `soobshenie` text NOT NULL,
  `data` datetime NOT NULL,
  `otmetka` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'по умолчанию 0 не прочитано',
  UNIQUE KEY `nomer` (`nomer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='таблица сообщений' AUTO_INCREMENT=233 ;

-- --------------------------------------------------------

--
-- Table structure for table `statusp`
--

CREATE TABLE IF NOT EXISTS `statusp` (
  `nomp` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `texts` text NOT NULL COMMENT 'мысль вслух',
  `data` datetime NOT NULL,
  UNIQUE KEY `nomp` (`nomp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Мысль пользователя' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `threetimesblock`
--

CREATE TABLE IF NOT EXISTS `threetimesblock` (
  `nomer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `loginr` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `timer` datetime NOT NULL,
  `parol` varchar(255) NOT NULL,
  `times` tinyint(4) NOT NULL,
  UNIQUE KEY `nomer` (`nomer`),
  UNIQUE KEY `loginr` (`loginr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='таблица для недопущения ввода данных более 3 раз за 15 минут' AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `zalobyna`
--

CREATE TABLE IF NOT EXISTS `zalobyna` (
  `nom` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_q` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `vremya` datetime NOT NULL,
  `prichina` varchar(255) NOT NULL COMMENT 'причина жалобы',
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Черный список' AUTO_INCREMENT=16 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anketa`
--
ALTER TABLE `anketa`
  ADD CONSTRAINT `anketa_ibfk_1` FOREIGN KEY (`loginp`) REFERENCES `polzovateli` (`loginp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lichnoe`
--
ALTER TABLE `lichnoe`
  ADD CONSTRAINT `lichnoe_ibfk_1` FOREIGN KEY (`loginp`) REFERENCES `polzovateli` (`loginp`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
