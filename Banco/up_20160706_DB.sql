# Tabela `assembleia`.`organica` movida para `assembleia`.`setores`


CREATE TABLE IF NOT EXISTS `setores` (
`id` int(11) NOT NULL,
  `hier` int(11) NOT NULL COMMENT 'Hierarquia de cada grupo-função, 0 como nível mais alto',
  `codigo` varchar(13) NOT NULL,
  `conta` int(11) NOT NULL,
  `alias` varchar(50) NOT NULL COMMENT 'Nome para exibição',
  `cargo1` varchar(150) NOT NULL,
  `cargo2` varchar(150) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `cad` varchar(150) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `setores`
--

INSERT INTO `setores` (`id`, `hier`, `codigo`, `conta`, `alias`, `cargo1`, `cargo2`, `descricao`, `cad`, `data`) VALUES
(1, 0, '1', 0, 'Pastor Local', 'Pastor', 'Pastora', 'Direção Geral  ', '', '2011-09-19 00:38:17'),
(2, 1, '1.01.01.001', 0, 'Tesouraria Geral', '1º Tesoureiro', '1ª Tesoureira', 'Tesouraria Geral', '', '2011-09-19 00:13:58'),
(3, 1, '1.02.01.001', 0, 'Secretaria Executiva', '1º Secretário', '1ª Secretária', 'Secretaria Executiva', '', '2011-09-19 00:04:45'),
(4, 1, '1.03.01.001', 0, 'SEMADBY', '1º Secretario', '1ª Secretaria', 'Secretaria de Missões', '', '2011-09-19 00:04:45'),
(5, 1, '1.04.01.001', 0, 'USADEBY', 'Lider', 'Lider', 'União de Senhoras', '', '2011-09-19 00:04:45'),
(6, 1, '1.05.01.001', 0, 'UMADEBY', '1º Secretario', '1ª Secretaria', 'União da Mocidade', '', '2011-09-19 00:07:03'),
(7, 1, '1.06.01.001', 0, 'DEPIADBY', 'Coordenador', 'Coordenadora', 'Departamento Infatil', '', '2011-09-19 00:05:33'),
(8, 1, '1.07.01.001', 0, 'DEADBY', 'Coordenador', 'Coordenadora', 'Departamento de Ensino', '', '2011-09-19 00:05:33'),
(9, 1, '1.08.01.001', 0, 'DEMADBY', 'Coordenador', 'Coordenadora', 'Departamento de Música', '', '2011-09-19 00:05:33'),
(11, 1, '1.09.02.001', 0, 'Dir de Congregação', 'Dirigente', 'Dirigente', 'Dirigente de Congregação', '', '2009-12-30 14:17:54'),
(12, 2, '1.09.02.010', 0, 'Secretaria Executiva', '', '', 'Secretaria Executiva da Congregação', '', '2009-12-30 13:54:24'),
(13, 2, '1.09.02.005', 0, 'Tesouraria da Congregação', 'Tesoureiro', 'Tesoureira', 'Financeiro da Congregação', '', '2009-12-30 13:54:24'),
(14, 3, '1.03.06.001', 0, 'GEPA - Andreazza I', 'Coordenador', 'Coordenadora', 'Grupo de Envangelismo', '', '2009-12-30 13:54:24'),
(15, 3, '1.04.01.100', 0, 'Circulo de Oração', 'Dirigente', 'Dirigente', 'Circulo de Oração', '', '2009-12-29 03:18:07'),
(16, 3, '1.04.01.200', 0, 'Camp de Visitas', 'Dirigente', 'Dirigente', 'Campanha de Visitas', '', '2009-12-30 13:54:24'),
(17, 2, '1.05.01.110', 0, 'Setor I - UMADEBY', 'Coordenador', 'Coordenadora', 'UMADEBY - Setor I', '', '2011-09-19 00:06:54'),
(18, 2, '1.05.01.120', 0, 'Setor II - UMADEBY', 'Coordenador', 'Coordenadora', 'UMADEBY - Setor II', '', '2011-09-19 00:06:54'),
(19, 2, '1.05.01.130', 0, 'Setor III - UMADEBY', 'Coordenador', 'Coordenadora', 'UMADEBY - Setor III', '', '2011-09-19 00:06:54'),
(20, 2, '1.05.01.140', 0, 'Setor IV - UMADEBY', 'Coordenador', 'Coordenadora', 'UMADEBY - Setor IV', '', '2011-09-19 00:06:54'),
(21, 3, '1.06.01.100', 0, 'Dir de Crianças', 'Dirigente', 'Dirigente', 'Dirigente de Crianças da Congregação', '', '2009-12-30 14:15:58'),
(22, 2, '1.07.01.100', 0, 'Escola Bíblica', 'Superintendente', 'Vice - Superintendente', 'Escola Bíblica Dominical', '', '2009-12-30 14:15:58'),
(23, 2, '1.08.01.170', 0, 'Coral Adulto', 'Dirigente', 'Dirigente', 'Coral Adulto da Congregação', '', '2009-12-30 14:15:58'),
(24, 2, '1.08.01.190', 0, 'Coral Jovem', 'Dirigente', 'Dirigente', 'Coral Jovem da Congregação', '', '2009-12-30 14:15:58'),
(25, 3, '1.06.01.200', 0, 'Soldadinhos de Cristo', 'Dirigente', 'Dirigente', 'Coral Infantil da Congregação', '', '2009-12-30 14:15:58'),
(26, 2, '1.08.01.210', 0, 'Conj Eletrônico', 'Dirigente', 'Dirigente', 'Conjunto Eletrônico da Congregação', '', '2009-12-30 14:15:58'),
(27, 1, '1.01.01.002', 0, 'Tesouraria Geral', '2º Tesoureiro', '2ª Tesoureira', 'Tesouraria Geral', '', '0000-00-00 00:00:00'),
(28, 1, '1.02.01.002', 0, 'Secretaria Executiva', '2º Secretário', '2ª Secretária', 'Secretaria Executiva', '', '0000-00-00 00:00:00'),
(29, 1, '1.02.01.003', 0, 'Secretaria Executiva', 'Secretário Adjunto', 'Secretária Adjunta', 'Secretaria Executiva', '', '0000-00-00 00:00:00'),
(30, 1, '1.10.01.001', 0, 'SEASADBY', '1º Secretário', '1ª Secretária', 'Secretaria de Ação Social', '', '2011-09-19 00:43:52'),
(31, 2, '1.04.01.002', 0, 'Setor I - USADEBY', 'Coordenador', 'Coordenadora', 'União de Senhoras', '', '2011-09-24 02:09:12'),
(32, 2, '1.04.01.003', 0, 'Setor II - USADEBY', 'Coordenador', 'Coordenadora', 'União de Senhoras', '', '2011-09-24 02:09:12'),
(33, 2, '1.08.01.100', 0, 'Asas da Alva', 'Dirigente', 'Dirigente', 'Conjunto Vocal', '', '2011-09-25 02:47:22'),
(34, 2, '1.08.01.150', 0, 'Primícias do Louvor', 'Dirigente', 'Dirigente', 'Conjunto eletrônico', '', '2011-09-25 02:47:22'),
(39, 2, '1.07.01.101', 0, 'Vice-Superintendente EB', 'Superintendente Substituto', 'Superintendente Substituta', 'Escola Bíblica Dominical', '', '2011-09-25 02:55:39'),
(41, 4, '1.09.02.020', 0, 'Portaria', 'Porteiro', 'Porteira', 'Porteiro da congregação', '', '2011-09-25 03:03:13'),
(42, 4, '1.09.02.021', 0, 'Limpeza', 'Zelador', 'Zeladora', 'Consevação e limpeza', '', '2011-09-25 03:03:13'),
(43, 3, '1.09.02.011', 0, 'Coral Adulto', 'Dirigente', 'Dirigente', 'Coral Adulto', '', '2011-09-26 03:13:32'),
(44, 3, '1.09.02.012', 0, 'Coral Jovem', 'Dirigente', 'Dirigente', 'Coral Jovem', '', '2011-09-26 03:13:32'),
(47, 3, '1.09.02.013', 0, 'Coral Infantil', 'Dirigente', 'Dirigente', 'Coral Infantil', '', '2011-09-26 03:15:46'),
(48, 3, '1.09.02.014', 0, 'Conjunto Eletrônico', 'Dirigente', 'Dirigente', 'Conjunto Eletrônico', '', '2011-09-26 03:15:46'),
(49, 4, '1.10.01.100', 0, 'Assistido da Ação Social', 'Assistido', 'Assistida', 'Oferta ou Auxílio', '', '2011-09-26 03:29:06'),
(50, 4, '1.09.02.022', 0, 'Segurança', 'Vigia', 'Vigia', 'Vigilância', '', '2011-09-26 18:39:58'),
(53, 2, '1.00.002', 0, 'Evangelista', 'Evangelista', 'Evangelista', 'Ministério de Evangelista', '', '0000-00-00 00:00:00'),
(54, 2, '1.00.003', 0, 'Presbiterio', 'Presbítero', 'Presbítero', 'Presbiterio', '645.822.304-82', '0000-00-00 00:00:00'),
(55, 2, '1.08.01.010', 0, 'Sonoplastia Templo Sede', 'Sonoplasta', 'Sonoplasta', 'Sonoplastia Templo Sede', '', '2011-09-28 13:14:04');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `setores`
--
ALTER TABLE `setores`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `codigo` (`codigo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `setores`
--
ALTER TABLE `setores`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


ALTER TABLE `agsercretaria` DROP `tipo`;
ALTER TABLE `agsercretaria` DROP `prioridade`;
ALTER TABLE `agsercretaria` CHANGE `comando` `comando` VARCHAR(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'colocar rol separdo por virgula , do 1º resp e depois os seguinte';
ALTER TABLE `agsercretaria` CHANGE `ano` `inicio` DATE NOT NULL;
ALTER TABLE `agsercretaria` DROP `periodo`;
ALTER TABLE `agsercretaria` CHANGE `status` `status` ENUM('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT '0 - Desativado, 1 - Ativo';
ALTER TABLE `agsercretaria` ADD `igreja` INT NOT NULL COMMENT 'id tabela igreja' AFTER `id`;
ALTER TABLE `agsercretaria` CHANGE `hist` `hist` VARCHAR(150) NOT NULL COMMENT 'Nome do cadastrador';

INSERT INTO `assembleia`.`agsercretaria` (`id`, `igreja`, `inicio`, `evento`, `comando`, `status`, `hist`, `data`) VALUES (NULL, '2', '2016-07-03', '1', '', '1', 'Joseiltn', CURRENT_TIMESTAMP);
ALTER TABLE `agsercretaria` ADD `semana` INT NOT NULL AFTER `inicio`, ADD `dia` ENUM('0','1','2','3','4','5','6','7') NOT NULL COMMENT '0-p/ repetição exata do dia e demais 1-dom, 2-seg, 3-ter ...' AFTER `semana`;
UPDATE `assembleia`.`agsercretaria` SET `semana` = '1', `dia` = '1' WHERE `agsercretaria`.`id` = 1;
ALTER TABLE `agsercretaria` CHANGE `comando` `resp` VARCHAR(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'colocar rol do 1º resp';
ALTER TABLE `agsercretaria` CHANGE `resp` `resp` INT NOT NULL COMMENT 'id da tabela eventosresp';
ALTER TABLE `agsercretaria` CHANGE `status` `fim` DATE NOT NULL;
ALTER TABLE `eventos` ADD `datafim` DATE NOT NULL COMMENT 'data do ultimo evento' AFTER `data`;
ALTER TABLE `eventos` ADD `dataini` DATE NOT NULL AFTER `data`;
ALTER TABLE `agsercretaria` CHANGE `hist` `cad` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Nome do cadastrador';
ALTER TABLE `eventos` DROP `data`, DROP `cad`;

ALTER TABLE `eventos` ADD `nome` VARCHAR(50) NOT NULL AFTER `id`;
ALTER TABLE `eventos` ADD `frequencia` INT(2) NOT NULL COMMENT '1-Mensal, 2-semanal, 3-quinzenal, 4-bimestral, 5-trimestral,6-semestral, 7-anul, ...' AFTER `descricao`, ADD UNIQUE (`frequencia`) ;
ALTER TABLE `eventos` ADD `vinculo` INT(2) NOT NULL COMMENT 'id tabela setores - subodinação' AFTER `id`;