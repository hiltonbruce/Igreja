-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 22/04/2016 às 11:52
-- Versão do servidor: 5.5.47-0+deb8u1-log
-- Versão do PHP: 5.6.19-0+deb8u1

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
-- Estrutura para tabela `agsercretaria`
--

CREATE TABLE IF NOT EXISTS `agsercretaria` (
`id` int(11) NOT NULL,
  `periodo` varchar(8) NOT NULL,
  `ano` year(4) NOT NULL,
  `evento` int(11) NOT NULL,
  `comando` varchar(30) NOT NULL COMMENT 'colocar rol separdo por virgula , o 1º resp na frente',
  `status` enum('0','1') NOT NULL,
  `prioridade` int(1) NOT NULL,
  `hist` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `agsercretaria`
--
ALTER TABLE `agsercretaria`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `agsercretaria`
--
ALTER TABLE `agsercretaria`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
