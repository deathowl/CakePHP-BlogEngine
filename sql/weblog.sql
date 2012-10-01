-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 01. Okt 2012 um 03:03
-- Server Version: 5.5.25a
-- PHP-Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `weblog`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `attempts`
--

CREATE TABLE IF NOT EXISTS `attempts` (
  `id` char(36) NOT NULL DEFAULT '',
  `ip` varchar(64) DEFAULT NULL,
  `action` varchar(32) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`,`action`),
  KEY `expires` (`expires`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `postcomments`
--

CREATE TABLE IF NOT EXISTS `postcomments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `body` text COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `postcomments`
--

INSERT INTO `postcomments` (`id`, `post_id`, `user_id`, `created`, `body`) VALUES
(1, 1, 1, '2012-09-30 00:00:00', 'Comment van!'),
(10, 1, 1, '2012-09-30 23:49:49', 'hozzaszolas_test'),
(13, 2, 23, '2012-10-01 03:01:06', 'Ã‰n nem lopnÃ¡m el.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `relative_path_to_image` varchar(60) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `posts`
--

INSERT INTO `posts` (`id`, `title`, `relative_path_to_image`, `created`, `modified`) VALUES
(1, 'ElsÅ‘', '/img/Posts/01.jpg', '2012-09-29 00:00:00', '2012-09-30 21:40:10'),
(2, 'MÃ¡sodik', '/img/Posts/02.jpg', '2012-09-30 21:47:36', '2012-09-30 21:48:43'),
(3, 'Harmadik', '/img/Posts/03.jpg', '2012-09-30 21:47:54', '2012-09-30 21:47:54'),
(4, 'Negyedik', '/img/Posts/04.jpg', '2012-09-30 21:49:01', '2012-09-30 21:49:01'),
(5, 'Ã–tÃ¶dik', '/img/Posts/05.jpg', '2012-09-30 21:49:23', '2012-09-30 21:49:23'),
(6, 'Hatodik', '/img/Posts/06.jpg', '2012-09-30 21:49:40', '2012-09-30 21:49:40');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `post_ratings`
--

CREATE TABLE IF NOT EXISTS `post_ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `post_ratings`
--

INSERT INTO `post_ratings` (`id`, `user_id`, `post_id`, `rating`) VALUES
(1, 1, 1, 5),
(2, 1, 2, 3),
(3, 23, 1, 1),
(4, 23, 2, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=24 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'admin', '17dab2db1a4c1ee49ac6ae2f71146e7aad53f83d', 'admin', '2012-09-29 00:36:38', '2012-09-30 23:01:15'),
(23, 'user1', '90f9025439022d6b5ae9f50df5bfe58a63d6bc7e', 'user', '2012-09-30 21:18:56', '2012-09-30 23:01:27');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
