-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Nov 2015 um 13:46
-- Server-Version: 5.6.26
-- PHP-Version: 5.6.12

CREATE TABLE IF NOT EXISTS `autor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `autor` (`id`, `name`) VALUES
(1, 'Wolf'),
(2, 'patu');

CREATE TABLE IF NOT EXISTS `buecher` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `verlagsid` int(11) NOT NULL,
  `autorid` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `netto` int(11) NOT NULL,
  `mws` enum('7','19') NOT NULL,
  `lager` int(11) NOT NULL,
  `gewicht` int(11) DEFAULT NULL,
  `piclink` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `buecher` (`id`, `barcode`, `verlagsid`, `autorid`, `titel`, `netto`, `mws`, `lager`, `gewicht`, `piclink`) VALUES
(1, '2356223', 1, 1, 'Das ist ein Buch', 11, '19', 2, 200, 'http://iasp2.informatik.htw-dresden.de/wiedem/imgw/wiedem_Foto2009_200.jpg'),
(2, '235622F', 2, 2, 'Hörbuch', 1, '19', 100, 0, ''),
(3, '23345', 2, 1, 'E-Book', 2, '7', 12, 0, '');

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(8) NOT NULL,
  `Username` varchar(32) COLLATE latin1_german1_ci NOT NULL,
  `Userpwmd5` varchar(60) COLLATE latin1_german1_ci NOT NULL,
  `UserAnrede` varchar(32) COLLATE latin1_german1_ci NOT NULL,
  `UserAdresse` varchar(32) COLLATE latin1_german1_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

CREATE TABLE IF NOT EXISTS `user_alt` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `anrede` varchar(255) NOT NULL,
  `adresse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `verlag` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `verlag` (`id`, `name`) VALUES
(1, 'HTW Verlag'),
(2, 'CCC-Verlag');

ALTER TABLE `autor`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `buecher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barcode` (`barcode`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

ALTER TABLE `user_alt`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `verlag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `autor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `buecher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `user`
  MODIFY `UserID` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
ALTER TABLE `user_alt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `verlag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

