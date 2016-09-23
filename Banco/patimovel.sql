-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 23/09/2016 às 11:39
-- Versão do servidor: 5.5.52-0+deb8u1-log
-- Versão do PHP: 5.6.24-0+deb8u1

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
-- Estrutura para tabela `patimovel`
--

CREATE TABLE IF NOT EXISTS `patimovel` (
  `id` int(11) NOT NULL COMMENT 'id da tabela igreja depende do tipo',
  `incricacao` varchar(30) NOT NULL,
  `tipo` int(11) NOT NULL,
  `quadralote` varchar(10) NOT NULL,
  `lotenum` int(11) NOT NULL,
  `nomeloteam` varchar(150) NOT NULL,
  `proprietario` text NOT NULL,
  `patrimonio` int(11) NOT NULL COMMENT 'privado, público',
  `sitlotequadra` varchar(100) NOT NULL COMMENT 'Situação do lote na quadra',
  `topografia` varchar(50) NOT NULL,
  `pedologia` varchar(50) NOT NULL,
  `frentes` int(1) NOT NULL,
  `ocupaterreno` varchar(50) NOT NULL,
  `limfrente` varchar(50) NOT NULL COMMENT 'Limites/Frente',
  `limlaterais` varchar(50) NOT NULL COMMENT 'Limites/Laterais',
  `calcada` varchar(50) NOT NULL COMMENT 'Calçada para pedestre',
  `estacion` varchar(50) NOT NULL COMMENT 'Estacionamento calçada',
  `arvore` int(11) NOT NULL,
  `poste` int(11) NOT NULL,
  `sitrel` varchar(50) NOT NULL COMMENT 'Situação relativa ao lote'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
