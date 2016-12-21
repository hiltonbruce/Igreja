-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 21/12/2016 às 19:36
-- Versão do servidor: 5.5.53-0+deb8u1-log
-- Versão do PHP: 5.6.29-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `assembleia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamssgs`
--

CREATE TABLE IF NOT EXISTS `agendamssgs` (
`id` mediumint(5) unsigned NOT NULL,
  `uid` varchar(14) NOT NULL,
  `setor` int(11) NOT NULL,
  `igreja` int(4) NOT NULL,
  `m` tinyint(2) NOT NULL DEFAULT '0',
  `d` tinyint(2) NOT NULL DEFAULT '0',
  `y` smallint(4) NOT NULL DEFAULT '0',
  `start_time` time NOT NULL DEFAULT '00:00:00',
  `end_time` time NOT NULL DEFAULT '00:00:00',
  `title` varchar(50) NOT NULL DEFAULT '',
  `text` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `agendamssgs`
--
ALTER TABLE `agendamssgs`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`), ADD KEY `m` (`m`), ADD KEY `y` (`y`), ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `agendamssgs`
--
ALTER TABLE `agendamssgs`
MODIFY `id` mediumint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
