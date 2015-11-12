-- phpMyAdmin SQL Dump
-- version 4.0.9deb1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 12-Nov-2015 às 12:06
-- Versão do servidor: 5.5.33-1-log
-- versão do PHP: 5.5.6-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `assembleia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `limpeza`
--

CREATE TABLE IF NOT EXISTS `limpeza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discrim` varchar(100) NOT NULL,
  `unid` varchar(20) NOT NULL,
  `quant` int(11) NOT NULL COMMENT 'Quantidade por uidade',
  `tempo` int(11) NOT NULL COMMENT 'tempo em meses de duração',
  `tipo1` int(11) NOT NULL,
  `tipo2` int(11) NOT NULL,
  `tipo3` int(11) NOT NULL,
  `tipo4` int(11) NOT NULL,
  `tipo5` int(11) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `cad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hist` varchar(50) NOT NULL DEFAULT 'Joseilton',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Lista de material de limpeza disponível para entrega' AUTO_INCREMENT=56 ;

--
-- Extraindo dados da tabela `limpeza`
--

INSERT INTO `limpeza` (`id`, `discrim`, `unid`, `quant`, `tempo`, `tipo1`, `tipo2`, `tipo3`, `tipo4`, `tipo5`, `valor`, `status`, `cad`, `hist`) VALUES
(1, 'Água sanitária', 'litros', 2, 2, 0, 35, 12, 5, 0, 0, b'1', '2013-01-29 03:18:19', 'Joseilton'),
(2, 'Balde 5 litros', 'Unid', 1, 4, 0, 0, 0, 0, 0, 0, b'1', '2013-01-29 03:18:19', 'Joseilton'),
(3, 'Balde grande', 'unid', 1, 4, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:08:38', 'Joseilton'),
(5, 'Cera liquida incolor', 'litros', 5, 2, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:27:44', 'Joseilton'),
(6, 'Cera incolor', 'unid', 1, 2, 0, 5, 3, 1, 0, 0, b'1', '2013-01-30 04:27:44', 'Joseilton'),
(7, 'Cesto de lixo', 'unid', 1, 2, 0, 0, 0, 0, 0, 0, b'1', '2013-01-29 06:00:00', 'Joseilton'),
(8, 'Cesto de lixo grande', 'unid', 1, 2, 0, 0, 0, 0, 0, 0, b'1', '2013-01-29 06:00:00', 'Joseilton'),
(9, 'Cloro', 'litros', 5, 2, 0, 10, 3, 1, 0, 0, b'1', '2013-01-30 04:31:06', 'Joseilton'),
(10, 'Desinfetante', 'litros', 5, 2, 0, 20, 10, 5, 0, 0, b'1', '2013-01-29 06:00:00', 'Joseilton'),
(11, 'Destac p/ piso', 'unid', 1, 2, 0, 15, 4, 2, 0, 0, b'1', '2013-01-30 04:32:10', 'Joseilton'),
(12, 'Detergente', 'Militros', 200, 2, 0, 2, 1, 1, 0, 0, b'1', '2013-01-30 04:32:10', 'Joseilton'),
(13, 'Espanador', 'unid', 1, 3, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:32:42', 'Joseilton'),
(14, 'Esponja', 'unid', 1, 2, 0, 10, 4, 3, 0, 0, b'1', '2013-01-30 04:32:42', 'Joseilton'),
(15, 'Flanela', 'unid', 1, 2, 0, 10, 5, 4, 0, 0, b'1', '2013-01-30 04:33:16', 'Joseilton'),
(16, 'Limpa vidro - refil', 'ml', 500, 2, 0, 9, 4, 1, 0, 0, b'1', '2013-01-30 04:33:16', ''),
(17, 'Lustra móveis', 'ml', 200, 2, 0, 15, 8, 3, 0, 0, b'1', '2013-01-30 04:34:34', 'Joseilton'),
(18, 'Luva emborrachada', 'par', 1, 2, 0, 5, 2, 2, 0, 0, b'1', '2013-01-30 04:34:34', 'Joseilton'),
(19, 'Mangueira', 'm', 25, 12, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:35:50', 'Joseilton'),
(20, 'Óleo de peroba', 'unid', 1, 2, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:35:50', 'Joseilton'),
(21, 'Pá', 'unid', 1, 6, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:36:33', 'Joseilton'),
(22, 'Palha de aço', 'pc', 1, 2, 0, 5, 4, 3, 0, 0, b'1', '2013-01-30 04:36:33', 'Joseilton'),
(23, 'Pano de chão', 'unid', 1, 6, 0, 10, 5, 4, 0, 0, b'1', '2013-01-30 04:37:05', 'Joseilton'),
(24, 'Pano de prato', 'unid', 1, 6, 0, 10, 5, 3, 0, 0, b'1', '2013-01-30 04:37:05', 'Joseilton'),
(25, 'Papel higiênico', 'pc c/ 4 unid', 1, 2, 0, 30, 15, 10, 0, 0, b'1', '2013-01-30 04:37:46', 'Joseilton'),
(26, 'Pastilha para banheiro', 'unid', 1, 2, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:37:46', 'Joseilton'),
(27, 'Limpeza Pesada', 'Litro', 1, 2, 0, 20, 10, 5, 0, 0, b'1', '2013-01-30 04:38:22', 'Joseilton'),
(28, 'Querosene', 'ml', 200, 2, 0, 3, 1, 1, 0, 0, b'1', '2013-01-30 04:38:22', 'Joseilton'),
(29, 'Rodo', 'unid', 1, 6, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:38:55', 'Joseilton'),
(30, 'Sabão de coco', 'unid', 1, 2, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:38:55', 'Joseilton'),
(31, 'Sabão de pedra', 'unid', 1, 2, 0, 5, 2, 1, 0, 0, b'1', '2013-01-30 04:39:22', 'Joseilton'),
(32, 'Sabão em pó Ala ou Bem-te-vi', 'g', 500, 2, 0, 25, 20, 15, 0, 0, b'1', '2013-01-30 04:39:22', 'Joseilton'),
(33, 'Sabão líquido', 'Litro', 1, 2, 0, 3, 2, 1, 0, 0, b'1', '2013-01-30 04:40:26', 'Joseilton'),
(34, 'Sabonete', 'g', 90, 2, 0, 5, 2, 2, 0, 0, b'1', '2013-01-30 04:40:26', 'Joseilton'),
(35, 'Saco de lixo - 100 litros', 'pc c/ 5 unid', 1, 2, 0, 10, 4, 3, 0, 0, b'1', '2013-01-30 04:41:49', 'Joseilton'),
(36, 'Saco de lixo - 30 litros', 'pc c/ 5 unid', 1, 2, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:41:49', 'Joseilton'),
(37, 'Saco de lixo - 60 litros', 'pc c/ 5 unid', 1, 2, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:42:24', 'Joseilton'),
(39, 'Tapete de porta', 'unid', 1, 6, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:43:32', 'Joseilton'),
(40, 'Toalha de mão', 'unid', 1, 6, 0, 4, 2, 2, 0, 0, b'1', '2013-01-30 04:44:03', 'Joseilton'),
(41, 'Vaselina líquida', 'ml', 200, 6, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:44:03', 'Joseilton'),
(42, 'Vassoura de nylon', 'unid', 1, 4, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:44:32', 'Joseilton'),
(43, 'Vassoura de pelo', 'unid', 1, 4, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:44:58', 'Joseilton'),
(44, 'Vassoura de talo', 'unid', 1, 4, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:44:58', 'Joseilton'),
(45, 'Vassoura p/ vaso sanitário', 'unid', 1, 6, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:45:21', 'Joseilton'),
(46, 'Vassourão', 'unid', 1, 6, 0, 0, 0, 0, 0, 0, b'1', '2013-01-30 04:45:21', 'Joseilton'),
(47, 'Veja multiuso', 'ml', 200, 2, 0, 10, 4, 3, 0, 0, b'1', '2013-01-30 04:45:47', 'Joseilton'),
(48, 'Veneno p/ inseto – aerosol', 'unid', 1, 4, 0, 5, 3, 2, 0, 0, b'1', '2013-01-30 04:46:10', 'Joseilton'),
(49, 'Lixeira p/ Banheiro', 'litros', 5, 6, 0, 0, 0, 0, 0, 0, b'1', '2013-05-15 23:05:56', 'Joseilton'),
(50, 'Detergente limpa alumínio', 'litro', 1, 2, 0, 2, 2, 2, 0, 0, b'1', '2013-05-15 23:10:11', 'Joseilton'),
(51, 'Saco de Lixo - 15 litros', 'unid/pc', 5, 2, 0, 10, 5, 3, 0, 0, b'1', '2013-05-28 00:36:32', 'Joseilton'),
(52, 'Limpa vidro com gatilho', 'ml', 500, 2, 0, 1, 1, 1, 0, 0, b'1', '2013-08-13 21:45:52', 'Joseilton'),
(53, 'Adesivo sanitário', 'Unid', 1, 2, 0, 30, 25, 20, 0, 0, b'1', '2014-11-12 00:05:37', 'Joseilton'),
(55, 'Agua sanitária de 1litro', 'litros', 1, 2, 0, 0, 0, 0, 0, 0, b'1', '2015-08-19 22:43:59', 'Joseilton');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
