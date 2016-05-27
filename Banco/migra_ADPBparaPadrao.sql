--
-- Estrutura para tabela `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
`id` int(11) NOT NULL,
  `idfatura` int(11) NOT NULL COMMENT 'identifica a sequencia de lancamento de uma mesma dívida',
  `credor` varchar(30) NOT NULL COMMENT 'id da tabela fornecedores(CPF e CNPJ)  e membro (rol). Ex. membro@rol ou fornecedor@idcredores',
  `debitar` int(11) NOT NULL COMMENT 'Código de acesso da tabela contas',
  `creditar` int(11) NOT NULL COMMENT 'Código de acesso da tabela contas',
  `idlanc` int(11) NOT NULL COMMENT 'Valor da tabela lanc campo lancamento',
  `frequencia` int(11) NOT NULL DEFAULT '0' COMMENT '0-Único,1-Mensal, 2-Mensal c/ quantidade, 3-Quinzenal, 4-Semanal',
  `igreja` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `multa` decimal(10,2) NOT NULL COMMENT 'Multas e juros em pagamentos após vencimento',
  `motivo` varchar(255) NOT NULL,
  `vencimento` date NOT NULL,
  `resppgto` varchar(150) NOT NULL,
  `datapgto` date NOT NULL COMMENT 'Data do pagamento da conta',
  `status` int(1) NOT NULL COMMENT '0 - Vazio Pendente, 1-Saiu p/ pgto, 2-Pago, 3-Quitado',
  `hist` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4035 DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `agenda`
--
ALTER TABLE `agenda`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



--
-- Estrutura para tabela `agsercretaria`
--

CREATE TABLE IF NOT EXISTS `agsercretaria` (
`id` int(11) NOT NULL,
  `periodo` varchar(8) NOT NULL,
  `ano` year(4) NOT NULL,
  `evento` int(11) NOT NULL COMMENT 'id tabela eventos',
  `tipo` int(11) NOT NULL COMMENT '0-Desativo, 1-Data fixa, 2-frequência semanal, 3-frequência quinzenal, 4-frequência mensal, 5-frequência semestral, 6-frequência anual, 7-frequência bianual',
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

--Remove tabela batismo
DROP TABLE batismo;

--Remove tabela cargo_igreja
DROP TABLE cargo_igreja;

--
-- Estrutura para tabela `cargohist`
--

CREATE TABLE IF NOT EXISTS `cargohist` (
`id` int(11) NOT NULL,
  `descricao` int(2) NOT NULL,
  `obs` varchar(255) NOT NULL,
  `igreja` int(4) NOT NULL,
  `rol` int(11) NOT NULL COMMENT 'rol do membro nesta função',
  `hierarquia` int(2) NOT NULL,
  `dataini` date NOT NULL COMMENT 'data de inicio na função',
  `datafim` date NOT NULL COMMENT 'data final na função',
  `cad` varchar(255) NOT NULL,
  `cadfim` varchar(150) NOT NULL COMMENT 'REsp pelo pela data final'
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cargohist`
--
ALTER TABLE `cargohist`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cargohist`
--
ALTER TABLE `cargohist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Estrutura para tabela `cargoigreja`
--

CREATE TABLE IF NOT EXISTS `cargoigreja` (
`id` int(11) NOT NULL,
  `descricao` int(2) NOT NULL,
  `setor` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0-Inativo,1-Ativo',
  `igreja` int(4) NOT NULL,
  `rol` int(11) NOT NULL COMMENT 'rol do membro nesta função',
  `naomembro` varchar(200) NOT NULL,
  `hierarquia` int(2) NOT NULL DEFAULT '1',
  `pgto` decimal(10,2) NOT NULL,
  `diapgto` varchar(3) NOT NULL DEFAULT '15' COMMENT 'Dia do pagamento, iniciado com u é dia útil, 1º digito dia da semana, 2º a semana do mês',
  `tipo` int(11) NOT NULL DEFAULT '1' COMMENT '1-Social,2-Adm,3-Minist,4-Func,5-Oferta',
  `coddespesa` int(11) NOT NULL,
  `hist` varchar(255) NOT NULL DEFAULT 'Joseilton',
  `cad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cargoigreja`
--
ALTER TABLE `cargoigreja`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cargoigreja`
--
ALTER TABLE `cargoigreja`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Estrutura para tabela `contas`
--

CREATE TABLE IF NOT EXISTS `contas` (
`id` int(11) NOT NULL,
  `codigo` varchar(13) NOT NULL,
  `nivel1` varchar(1) NOT NULL,
  `nivel2` varchar(3) NOT NULL,
  `nivel3` varchar(5) NOT NULL,
  `nivel4` varchar(9) NOT NULL,
  `acesso` int(7) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `histlancam` varchar(60) NOT NULL COMMENT 'Tesxto para histórico de lançamentos',
  `descricao` text NOT NULL COMMENT 'informa detalhes do que deve ser lançado nesta conta',
  `saldo` decimal(12,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `tipo` varchar(1) NOT NULL COMMENT 'D - Devedora, C - Credora'
) ENGINE=InnoDB AUTO_INCREMENT=566 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `contas`
--

INSERT INTO `contas` (`id`, `codigo`, `nivel1`, `nivel2`, `nivel3`, `nivel4`, `acesso`, `titulo`, `histlancam`, `descricao`, `saldo`, `status`, `tipo`) VALUES
(1, '1', '1', '1', '1', '1', 0, 'Ativo', '', '', 2935750.92, 1, 'D'),
(2, '1.1', '1', '1.1', '1.1', '1.1', 0, 'Ativo Circulante', '', '', 2935330.57, 1, 'D'),
(3, '1.1.1', '1', '1.1', '1.1.1', '1.1.1', 0, 'Disponível', '', '', 2935330.57, 1, 'D'),
(4, '1.1.1.001', '1', '1.1', '1.1.1', '1.1.1.001', 0, 'Caixa Geral - Disponível', '', 'Saldo de todos os caixas deduzida as provisões', 2935330.57, 1, 'D'),
(5, '1.1.1.001.001', '1', '1.1', '1.1.1', '1.1.1.001', 1, 'Caixa Central', '', '', 3108294.28, 1, 'D'),
(6, '1.1.1.001.002', '1', '1.1', '1.1.1', '1.1.1.001', 2, 'Caixa de Missões', '', '', 83651.00, 1, 'D'),
(7, '1.1.1.001.003', '1', '1.1', '1.1.1', '1.1.1.001', 3, 'Caixa de Senhoras', '', '', 71550.30, 1, 'D'),
(8, '1.1.1.001.004', '1', '1.1', '1.1.1', '1.1.1.001', 4, 'Caixa de Ensino', '', '', 27534.25, 1, 'D'),
(9, '1.1.1.001.005', '1', '1.1', '1.1.1', '1.1.1.001', 5, 'Caixa Infantil', '', '', 64.10, 1, 'D'),
(10, '1.1.1.001.006', '1', '1.1', '1.1.1', '1.1.1.001', 6, '( - ) Provisão p/ COMADEP - Contribuição 10%', '', '', 325645.01, 1, 'C'),
(11, '1.1.1.001.007', '1', '1.1', '1.1.1', '1.1.1.001', 7, '( - ) Provisão p/ SEMAD - Contribuição 40%', '', '', 34073.45, 1, 'C'),
(12, '1.1.1.002', '1', '1.1', '1.1.1', '1.1.1.002', 0, 'Banco Conta Movimentos', '', '', 0.00, 1, 'D'),
(13, '1.1.1.002.001', '1', '1.1', '1.1.1', '1.1.1.002', 20, 'Banco do Brasil S/A', '', '', 0.00, 1, 'D'),
(14, '1.1.1.003', '1', '1.1', '1.1.1', '1.1.1.003', 0, 'Banco Conta Poupança', '', '', 0.00, 1, 'D'),
(15, '1.1.1.003.001', '1', '1.1', '1.1.1', '1.1.1.003', 30, 'Caixa Econônica Federal', '', '', 0.00, 1, 'D'),
(16, '1.1.1.004', '1', '1.1', '1.1.1', '1.1.1.004', 0, 'Títulos de Capitalização', '', '', 0.00, 1, 'D'),
(17, '1.1.1.005', '1', '1.1', '1.1.1', '1.1.1.005', 0, 'Mercado Aberto', '', '', 0.00, 1, 'D'),
(18, '1.1.1.006', '1', '1.1', '1.1.1', '1.1.1.006', 0, 'Banco Conta Vínculadas', '', '', 0.00, 1, 'D'),
(19, '1.1.1.006.001', '1', '1.1', '1.1.1', '1.1.1.006', 60, 'Banco do Brasil S/A', '', '', 0.00, 1, 'D'),
(20, '1.1.1.007', '1', '1.1', '1.1.1', '1.1.1.007', 0, 'Adiantamentos a Funcionários', '', '', 0.00, 1, 'D'),
(21, '1.1.1.007.001', '1', '1.1', '1.1.1', '1.1.1.007', 70, 'Adiantamento de Salários', '', '', 0.00, 1, 'D'),
(22, '1.1.1.007.002', '1', '1.1', '1.1.1', '1.1.1.007', 71, 'Adiantamentos de Férias', '', '', 0.00, 1, 'D'),
(23, '1.1.1.007.003', '1', '1.1', '1.1.1', '1.1.1.007', 72, 'Adiantamento de 13º Salário', '', '', 0.00, 1, 'D'),
(24, '1.1.1.099', '1', '1.1', '1.1.1', '1.1.1.099', 0, 'Outros Créditos', '', '', 0.00, 1, 'D'),
(25, '1.1.1.099.001', '1', '1.1', '1.1.1', '1.1.1.099', 150, 'Créditos em Circulação', '', '', 0.00, 1, 'D'),
(26, '1.2', '1', '1.2', '1.2', '1.2', 0, 'Ativo Permanete', '', '', 420.35, 1, 'D'),
(27, '1.2.1', '1', '1.2', '1.2.1', '1.2.1', 0, 'Imobilizado', '', '', 420.35, 1, 'D'),
(28, '1.2.1.001', '1', '1.2', '1.2.1', '1.2.1.001', 0, 'Matriz', '', '', 0.00, 1, 'D'),
(29, '1.2.1.001.005', '1', '1.2', '1.2.1', '1.2.1.001', 164, 'Predios', '', '', 0.00, 1, 'D'),
(30, '1.2.1.001.001', '1', '1.2', '1.2.1', '1.2.1.001', 160, 'Móveis e Utensílios', '', '', 0.00, 1, 'D'),
(31, '1.2.1.001.002', '1', '1.2', '1.2.1', '1.2.1.001', 161, 'Máquinas e Equipamentos', '', '', 0.00, 1, 'D'),
(32, '1.2.1.001.003', '1', '1.2', '1.2.1', '1.2.1.001', 162, 'Veículos', '', '', 0.00, 1, 'D'),
(33, '1.2.1.001.004', '1', '1.2', '1.2.1', '1.2.1.001', 163, 'Terrenos', '', '', 0.00, 1, 'D'),
(34, '1.2.1.002', '1', '1.2', '1.2.1', '1.2.1.002', 0, 'Congregações', '', '', 420.35, 1, 'D'),
(35, '1.2.1.002.001', '1', '1.2', '1.2.1', '1.2.1.002', 170, 'Móveis e Utensílios', '', '', 0.00, 1, 'D'),
(36, '1.2.1.002.002', '1', '1.2', '1.2.1', '1.2.1.002', 171, 'Terrenos', '', '', 420.35, 1, 'D'),
(37, '1.2.1.002.003', '1', '1.2', '1.2.1', '1.2.1.002', 172, 'Instalações e Manutenção - Congregações', '', '', 0.00, 1, 'D'),
(38, '1.2.1.002.004', '1', '1.2', '1.2.1', '1.2.1.002', 173, 'Máquinas e Equipamentos', '', '', 0.00, 1, 'D'),
(39, '1.2.1.002.005', '1', '1.2', '1.2.1', '1.2.1.002', 174, 'Prédio', '', '', 0.00, 1, 'D'),
(40, '1.3', '1', '1.3', '1.3', '1.3', 0, 'Investimentos', '', '', 0.00, 1, 'D'),
(41, '2', '2', '2', '2', '2', 0, 'Passivo', '', '', 0.00, 1, 'C'),
(42, '2.1', '2', '2.1', '2.1', '2.1', 0, 'Passivo Circulante', '', '', 0.00, 1, 'C'),
(43, '2.1.1', '2', '2.1', '2.1.1', '2.1.1', 0, 'Fornecedores', '', '', 0.00, 1, 'C'),
(44, '2.1.1.001', '2', '2.1', '2.1.1', '2.1.1.001', 0, 'Sede e Congregações', '', '', 0.00, 1, 'C'),
(45, '2.1.1.001.001', '2', '2.1', '2.1.1', '2.1.1.001', 300, 'Kiluz - Mat. Elétrico Ltda.', '', '', 0.00, 1, 'C'),
(46, '2.1.1.001.002', '2', '2.1', '2.1.1', '2.1.1.001', 301, 'Tocmix', '', '', 0.00, 1, 'C'),
(47, '2.1.1.001.003', '2', '2.1', '2.1.1', '2.1.1.001', 302, 'Geraldo - Mat. de Construção', '', '', 0.00, 1, 'C'),
(48, '2.1.1.001.004', '2', '2.1', '2.1.1', '2.1.1.001', 303, 'Lojão da Econômica - Mat. de Construção', '', '', 0.00, 1, 'C'),
(49, '2.1.2', '2', '2.1', '2.1.2', '2.1.2', 0, 'Credores Diversos', '', '', 0.00, 1, 'C'),
(50, '2.1.2.001', '2', '2.1', '2.1.2', '2.1.2.001', 0, 'Sede e Congregações', '', '', 0.00, 1, 'C'),
(51, '2.1.3', '2', '2.1', '2.1.3', '2.1.3', 0, 'Obrigações Sociais', '', '', 0.00, 1, 'C'),
(52, '2.1.3.001', '2', '2.1', '2.1.3', '2.1.3.001', 0, 'Sede e Congregações', '', '', 0.00, 1, 'C'),
(53, '2.1.3.001.001', '2', '2.1', '2.1.3', '2.1.3.001', 304, 'MPS - Previdência Social - A Recolher', '', '', 0.00, 1, 'C'),
(54, '2.1.3.001.002', '2', '2.1', '2.1.3', '2.1.3.001', 305, 'FGTS - Fundo de Garantia - A Recolher', '', '', 0.00, 1, 'C'),
(55, '2.1.3.001.003', '2', '2.1', '2.1.3', '2.1.3.001', 306, 'PIS a Recolher', '', '', 0.00, 1, 'C'),
(56, '2.1.3.001.004', '2', '2.1', '2.1.3', '2.1.3.001', 0, 'Salários a Pagar', '', '', 0.00, 1, 'C'),
(57, '2.1.3.001.005', '2', '2.1', '2.1.3', '2.1.3.001', 308, 'Férias a Pagar', '', '', 0.00, 1, 'C'),
(58, '2.1.3.001.006', '2', '2.1', '2.1.3', '2.1.3.001', 309, 'Vale Transporte a Pagar', '', '', 0.00, 1, 'C'),
(59, '2.1.4', '2', '2.1', '2.1.4', '2.1.4', 0, 'Emprestimos e financiamentos', '', '', 0.00, 1, 'C'),
(60, '2.1.4.001', '2', '2.1', '2.1.4', '2.1.4.001', 0, 'Sede e Congregações', '', '', 0.00, 1, 'C'),
(61, '2.1.4.001.001', '2', '2.1', '2.1.4', '2.1.4.001', 330, 'Tambay Motor - Concesionária', '', '', 0.00, 1, 'C'),
(62, '2.1.5', '2', '2.1', '2.1.5', '2.1.5', 0, 'Provisões', '', '', 0.00, 1, 'C'),
(71, '2.1.5.001', '2', '2.1', '2.1.5', '2.1.5.001', 0, 'SEMAD - Sec. de Missões', '', '', 0.00, 1, 'C'),
(72, '2.1.5.001.001', '2', '2.1', '2.1.5', '2.1.5.001', 870, 'Provisão p/ SEMAD - Sede e Congregações', '', '', 0.00, 1, 'C'),
(73, '2.2', '2', '2.2', '2.2', '2.2', 0, 'Patrimônio Líquido', '', '', 0.00, 1, 'C'),
(74, '2.2.1', '2', '2.2', '2.2.1', '2.2.1', 0, 'Patrimônio', '', '', 0.00, 1, 'C'),
(75, '2.2.1.001', '2', '2.2', '2.2.1', '2.2.1.001', 0, 'Sede e Congregações', '', '', 0.00, 1, 'C'),
(76, '2.2.1.001.001', '2', '2.2', '2.2.1', '2.2.1.001', 311, 'Patrimômio Social', '', '', 0.00, 1, 'C'),
(80, '3', '3', '3', '3', '3', 0, 'DESPESAS', '', '', 482031.76, 1, 'D'),
(81, '3.1', '3', '3.1', '3.1', '3.1', 0, 'DESPESAS OPERACIONAIS', '', '', 482031.76, 1, 'D'),
(82, '3.1.1', '3', '3.1', '3.1.1', '3.1.1', 0, 'DESPESAS ECLESIÁSTICAS', '', '', 431811.66, 1, 'D'),
(83, '3.1.1.001', '3', '3.1', '3.1.1', '3.1.1.001', 0, 'DESPESAS C/ CULTOS', '', '', 409912.36, 1, 'D'),
(84, '3.1.1.001.001', '3', '3.1', '3.1.1', '3.1.1.001', 400, 'Despesas c/ Energia Elétrica', '', '', 72853.08, 1, 'D'),
(85, '3.1.1.001.002', '3', '3.1', '3.1.1', '3.1.1.001', 401, 'Água e Esgoto', '', '', 11394.27, 1, 'D'),
(86, '3.1.1.001.003', '3', '3.1', '3.1.1', '3.1.1.001', 402, 'Material de Higiene e Limpeza', '', '', 0.00, 1, 'D'),
(87, '3.1.1.001.004', '3', '3.1', '3.1.1', '3.1.1.001', 403, 'Santa Ceia', '', '', 0.00, 1, 'D'),
(88, '3.1.1.001.005', '3', '3.1', '3.1.1', '3.1.1.001', 404, 'Oferta Zelador', '', '', 0.00, 1, 'D'),
(89, '3.1.1.001.006', '3', '3.1', '3.1.1', '3.1.1.001', 405, 'Aluguel e Locação', '', '', 20.00, 1, 'D'),
(90, '3.1.1.001.007', '3', '3.1', '3.1.1', '3.1.1.001', 406, 'COMADEP - Contribuição 10%', '', 'Contribuição sobre arrecadação cultos em geral (exeto oferta missões), circ. de oração', 325645.01, 1, 'D'),
(100, '3.1.1.002', '3', '3.1', '3.1.1', '3.1.1.002', 0, 'AÇÃO SOCIAL', '', '', 3275.06, 1, 'D'),
(101, '3.1.1.002.001', '3', '3.1', '3.1.1', '3.1.1.002', 410, 'Medicamentos e Consultas', '', '', 0.00, 1, 'D'),
(102, '3.1.1.002.002', '3', '3.1', '3.1.1', '3.1.1.002', 411, 'Generos Alimentícios', '', '', 0.00, 1, 'D'),
(103, '3.1.1.002.003', '3', '3.1', '3.1.1', '3.1.1.002', 412, 'Auxílio Social', '', '', 1791.00, 1, 'D'),
(104, '3.1.1.002.004', '3', '3.1', '3.1.1', '3.1.1.002', 413, 'Energia Elétrica', '', '', 1347.71, 1, 'D'),
(105, '3.1.1.002.005', '3', '3.1', '3.1.1', '3.1.1.002', 414, 'Água e Esgoto', '', '', 136.35, 1, 'D'),
(106, '3.1.1.003', '3', '3.1', '3.1.1', '3.1.1.003', 0, 'USADEBY', '', '', 2050.00, 1, 'D'),
(107, '3.1.1.003.001', '3', '3.1', '3.1.1', '3.1.1.003', 420, 'Ofertas a Pregadores', '', '', 0.00, 1, 'D'),
(108, '3.1.1.003.002', '3', '3.1', '3.1.1', '3.1.1.003', 421, 'Passagem e Transporte', '', '', 0.00, 1, 'D'),
(109, '3.1.1.003.003', '3', '3.1', '3.1.1', '3.1.1.003', 422, 'Presentes', '', '', 0.00, 1, 'D'),
(110, '3.1.1.003.004', '3', '3.1', '3.1.1', '3.1.1.003', 423, 'Congressos e Eventos', '', '', 2050.00, 1, 'D'),
(111, '3.1.1.003.005', '3', '3.1', '3.1.1', '3.1.1.003', 424, 'Alimentação', '', '', 0.00, 1, 'D'),
(112, '3.1.1.004', '3', '3.1', '3.1.1', '3.1.1.004', 0, 'UMADEBY', '', '', 11961.24, 1, 'D'),
(113, '3.1.1.004.001', '3', '3.1', '3.1.1', '3.1.1.004', 430, 'Ofertas a Pregadores', '', '', 900.00, 1, 'D'),
(114, '3.1.1.004.002', '3', '3.1', '3.1.1', '3.1.1.004', 431, 'Passagem e Transporte', '', '', 0.00, 1, 'D'),
(115, '3.1.1.004.003', '3', '3.1', '3.1.1', '3.1.1.004', 432, 'Presentes', '', '', 100.00, 1, 'D'),
(116, '3.1.1.004.004', '3', '3.1', '3.1.1', '3.1.1.004', 433, 'Congressos e Eventos', '', '', 10961.24, 1, 'D'),
(117, '3.1.1.004.005', '3', '3.1', '3.1.1', '3.1.1.004', 434, 'Alimentação', '', '', 0.00, 1, 'D'),
(118, '3.1.1.005', '3', '3.1', '3.1.1', '3.1.1.005', 0, 'DEADBY - DEPARTAMENTO DE ENSINO', '', '', 3101.00, 1, 'D'),
(119, '3.1.1.005.001', '3', '3.1', '3.1.1', '3.1.1.005', 440, 'Lições bíblicas Infantil', '', '', 0.00, 1, 'D'),
(120, '3.1.1.005.002', '3', '3.1', '3.1.1', '3.1.1.005', 441, 'Lições Bíblicas Adulto', '', '', 0.00, 1, 'D'),
(121, '3.1.1.005.003', '3', '3.1', '3.1.1', '3.1.1.005', 442, 'Material Escolar', '', 'Despesas com quadro, canetas, cadernos, carteiras e outros do mesmo gênero', 0.00, 1, 'D'),
(122, '3.1.1.005.004', '3', '3.1', '3.1.1', '3.1.1.005', 443, 'Passagem e Transporte', '', 'Auxílio de passagens a professores de EB e teologia da Igreja', 0.00, 1, 'D'),
(123, '3.1.1.005.005', '3', '3.1', '3.1.1', '3.1.1.005', 444, 'Congressos e Eventos', '', 'Despesas com cursos, inscrições em congressos e viagens para capacitação e aperfeiçoamento de professores\r\n', 0.00, 1, 'D'),
(124, '3.1.1.005.006', '3', '3.1', '3.1.1', '3.1.1.005', 445, 'Biblioteca', '', 'Despesas com livros para o acervo', 0.00, 1, 'D'),
(125, '3.1.1.005.007', '3', '3.1', '3.1.1', '3.1.1.005', 446, 'Capacitação de Professores', '', '', 0.00, 1, 'D'),
(126, '3.1.1.005.008', '3', '3.1', '3.1.1', '3.1.1.005', 447, 'Ofertas a Professores e Palestrantes', '', '', 1576.00, 1, 'D'),
(127, '3.1.1.006', '3', '3.1', '3.1.1', '3.1.1.006', 0, 'DEMADBY - DEP. DE MÚSICA', '', 'Despesas com corais, sonoplastia, professores de música e outros do gênero', 1512.00, 1, 'D'),
(128, '3.1.1.006.001', '3', '3.1', '3.1.1', '3.1.1.006', 460, 'Oferta Maestro', '', '', 0.00, 1, 'D'),
(129, '3.1.1.006.002', '3', '3.1', '3.1.1', '3.1.1.006', 461, 'Oferta Sonoplasta', '', '', 0.00, 1, 'D'),
(130, '3.1.2', '3', '3.1', '3.1.2', '3.1.2', 0, 'DESPESAS ADMINISTRATIVAS', '', '', 3382.90, 1, 'D'),
(131, '3.1.2.001', '3', '3.1', '3.1.2', '3.1.2.001', 0, 'ADMINISTRAÇÃO', '', '', 3382.90, 1, 'D'),
(132, '3.1.2.001.001', '3', '3.1', '3.1.2', '3.1.2.001', 501, 'Água e Esgoto', '', '', 292.10, 1, 'D'),
(133, '3.1.2.001.002', '3', '3.1', '3.1.2', '3.1.2.001', 502, 'Energia Elétrica', '', '', 0.00, 1, 'D'),
(134, '3.1.2.001.003', '3', '3.1', '3.1.2', '3.1.2.001', 503, 'Material de Expediente', '', 'Gastos com canetas, papeis, cartuchos, tonners e outros', 0.00, 1, 'D'),
(135, '3.1.2.001.004', '3', '3.1', '3.1.2', '3.1.2.001', 504, 'Telefone', '', '', 913.90, 1, 'D'),
(136, '3.1.2.001.005', '3', '3.1', '3.1.2', '3.1.2.001', 505, 'Auxílios e Ofertas', '', '', 197.00, 1, 'D'),
(137, '3.1.2.001.006', '3', '3.1', '3.1.2', '3.1.2.001', 506, 'Combustíveis e Lubrificantes', '', 'De veículos', 0.00, 1, 'D'),
(138, '3.1.2.001.007', '3', '3.1', '3.1.2', '3.1.2.001', 507, 'Despesas com Veículos', '', 'Manuteção, multas de trânsito, lavagem ...', 0.00, 1, 'D'),
(139, '3.1.2.001.008', '3', '3.1', '3.1.2', '3.1.2.001', 508, 'Café e Lanches', '', '', 0.00, 1, 'D'),
(140, '3.1.2.001.009', '3', '3.1', '3.1.2', '3.1.2.001', 509, 'Higiene e Limpeza', '', '', 0.00, 1, 'D'),
(141, '3.1.2.001.010', '3', '3.1', '3.1.2', '3.1.2.001', 510, 'Impostos e Taxas', '', '', 0.00, 1, 'D'),
(142, '3.1.2.001.011', '3', '3.1', '3.1.2', '3.1.2.001', 511, 'Serviços de Terceiros', '', '', 79.90, 1, 'D'),
(143, '3.1.2.001.012', '3', '3.1', '3.1.2', '3.1.2.001', 512, 'Fretes e Carretos', '', '', 0.00, 1, 'D'),
(144, '3.1.2.001.013', '3', '3.1', '3.1.2', '3.1.2.001', 513, 'Cópias', '', '', 0.00, 1, 'D'),
(145, '3.1.2.001.014', '3', '3.1', '3.1.2', '3.1.2.001', 514, 'Consertos e Reparos', '', 'Serviços e peças para conserto de equipamentos', 0.00, 1, 'D'),
(146, '3.1.2.001.015', '3', '3.1', '3.1.2', '3.1.2.001', 515, 'Prestação de Serviços', '', '', 0.00, 1, 'D'),
(147, '3.1.2.001.016', '3', '3.1', '3.1.2', '3.1.2.001', 516, 'Aluguel de Imóvel', '', '', 0.00, 1, 'D'),
(148, '3.1.2.001.017', '3', '3.1', '3.1.2', '3.1.2.001', 517, 'Fretes e Carretos', '', '', 0.00, 1, 'D'),
(149, '3.1.2.001.018', '3', '3.1', '3.1.2', '3.1.2.001', 518, 'Gratificações', '', '', 0.00, 1, 'D'),
(150, '3.1.2.001.019', '3', '3.1', '3.1.2', '3.1.2.001', 519, 'Manutenção e Conservação', '', 'Serviço e material para manutenção de imóvel', 0.00, 1, 'D'),
(151, '3.1.2.001.020', '3', '3.1', '3.1.2', '3.1.2.001', 520, 'Viagens e Translados', '', '', 0.00, 1, 'D'),
(152, '3.1.2.001.021', '3', '3.1', '3.1.2', '3.1.2.001', 521, 'Instalações', '', '', 0.00, 1, 'D'),
(153, '3.1.2.001.022', '3', '3.1', '3.1.2', '3.1.2.001', 522, 'Hospedagens e Estadias', '', '', 0.00, 1, 'D'),
(154, '3.1.2.001.023', '3', '3.1', '3.1.2', '3.1.2.001', 523, 'Publicidade', '', 'propagandas, Carro de som...', 0.00, 1, 'D'),
(155, '3.1.2.001.024', '3', '3.1', '3.1.2', '3.1.2.001', 524, 'Sinistro com Veículos', '', 'Despesas com acidentes envolvendo veículos da igreja', 0.00, 1, 'D'),
(156, '3.1.2.001.025', '3', '3.1', '3.1.2', '3.1.2.001', 525, 'Ajuda de Custo', '', '', 0.00, 1, 'D'),
(157, '3.1.2.001.026', '3', '3.1', '3.1.2', '3.1.2.001', 526, 'Despesas com Cartório', '', 'Autenticações, escrituras ...', 0.00, 1, 'D'),
(158, '3.1.2.001.027', '3', '3.1', '3.1.2', '3.1.2.001', 527, 'Comunicação', '', 'Programs de rádio, provedores de intenet', 1900.00, 1, 'D'),
(159, '3.1.2.001.028', '3', '3.1', '3.1.2', '3.1.2.001', 528, 'Correios e Postagens', '', '', 0.00, 1, 'D'),
(160, '3.1.2.001.029', '3', '3.1', '3.1.2', '3.1.2.001', 529, 'Máquinas e Equipamentos', '', '', 0.00, 1, 'D'),
(161, '3.1.2.001.030', '3', '3.1', '3.1.2', '3.1.2.001', 530, 'Móveis e Utensílios', '', '', 0.00, 1, 'D'),
(162, '3.1.2.001.031', '3', '3.1', '3.1.2', '3.1.2.001', 531, 'Caixa de Evangelização', '', '', 0.00, 1, 'D'),
(180, '3.1.2.001.099', '3', '3.1', '3.1.2', '3.1.2.001', 549, 'Despesas Diversas', '', '', 0.00, 1, 'D'),
(185, '3.1.2.002', '3', '3.1', '3.1.2', '3.1.2.002', 0, 'DESPESAS C/ CONSTRUÇÃO', '', '', 0.00, 1, 'D'),
(186, '3.1.2.002.001', '3', '3.1', '3.1.2', '3.1.2.002', 600, 'Meteriais para Construção Civil', '', '', 0.00, 1, 'D'),
(187, '3.1.2.002.002', '3', '3.1', '3.1.2', '3.1.2.002', 601, 'Serviços', '', '', 0.00, 1, 'D'),
(210, '3.1.3', '3', '3.1', '3.1.3', '3.1.3', 0, 'DESPESAS COM PESSOAL', '', '', 1910.91, 1, 'D'),
(211, '3.1.3.001', '3', '3.1', '3.1.3', '3.1.3.001', 0, 'MÃO DE OBRA DIRETA', '', '', 1910.91, 1, 'D'),
(212, '3.1.3.001.001', '3', '3.1', '3.1.3', '3.1.3.001', 550, 'Salário', '', '', 0.00, 1, 'D'),
(213, '3.1.3.001.002', '3', '3.1', '3.1.3', '3.1.3.001', 551, 'Décimo Terceiro', '', '', 0.00, 1, 'D'),
(214, '3.1.3.001.003', '3', '3.1', '3.1.3', '3.1.3.001', 552, 'Férias', '', '', 0.00, 1, 'D'),
(215, '3.1.3.001.004', '3', '3.1', '3.1.3', '3.1.3.001', 553, 'Encargos Sociais', '', '', 0.00, 1, 'D'),
(216, '3.1.3.001.005', '3', '3.1', '3.1.3', '3.1.3.001', 554, 'Vale Transporte', '', '', 0.00, 1, 'D'),
(217, '3.1.3.001.006', '3', '3.1', '3.1.3', '3.1.3.001', 555, 'Uniformes', '', '', 0.00, 1, 'D'),
(218, '3.1.3.001.007', '3', '3.1', '3.1.3', '3.1.3.001', 556, 'Refeições', '', '', 0.00, 1, 'D'),
(219, '3.1.3.001.008', '3', '3.1', '3.1.3', '3.1.3.001', 557, 'PIS Sobre a Folha', '', '', 294.60, 1, 'D'),
(220, '3.1.3.001.009', '3', '3.1', '3.1.3', '3.1.3.001', 558, 'FGTS', '', '', 1616.31, 1, 'D'),
(230, '3.1.4', '3', '3.1', '3.1.4', '3.1.4', 0, 'DESPESAS TRIBUTÁRIAS', '', '', 9374.24, 1, 'D'),
(231, '3.1.4.001', '3', '3.1', '3.1.4', '3.1.4.001', 0, 'DESPESAS E MULTAS FISCAIS', '', '', 9374.24, 1, 'D'),
(232, '3.1.4.001.001', '3', '3.1', '3.1.4', '3.1.4.001', 557, 'IPTU', '', '', 0.00, 1, 'D'),
(233, '3.1.4.001.002', '3', '3.1', '3.1.4', '3.1.4.001', 558, 'IPVA', '', '', 0.00, 1, 'D'),
(234, '3.1.4.001.003', '3', '3.1', '3.1.4', '3.1.4.001', 559, 'IOF', '', '', 0.00, 1, 'D'),
(235, '3.1.4.001.004', '3', '3.1', '3.1.4', '3.1.4.001', 560, 'Multas Fiscais', '', '', 0.00, 1, 'D'),
(236, '3.1.4.001.005', '3', '3.1', '3.1.4', '3.1.4.001', 561, 'ITBI ', '', '', 0.00, 1, 'D'),
(237, '3.1.4.001.006', '3', '3.1', '3.1.4', '3.1.4.001', 562, 'IRRF - Imposto de Renda Retido na Fonte', '', '', 0.00, 1, 'D'),
(238, '3.1.4.001.099', '3', '3.1', '3.1.4', '3.1.4.001', 563, 'Impostos e Taxas Diversas', '', '', 0.00, 1, 'D'),
(250, '3.1.5', '3', '3.1', '3.1.5', '3.1.5', 0, 'DESPESAS FINANCEIRAS', '', '', 5.40, 1, 'D'),
(251, '3.1.5.001', '3', '3.1', '3.1.5', '3.1.5.001', 0, 'JUROS, MULTAS E CUSTOS FINANCEIROS', '', '', 5.40, 1, 'D'),
(252, '3.1.5.001.001', '3', '3.1', '3.1.5', '3.1.5.001', 570, 'Juros de Mora', '', '', 0.00, 1, 'D'),
(253, '3.1.5.001.002', '3', '3.1', '3.1.5', '3.1.5.001', 571, 'Multas Diversas', '', '', 5.40, 1, 'D'),
(254, '3.1.5.001.003', '3', '3.1', '3.1.5', '3.1.5.001', 572, 'Taxas Bancárias', '', '', 0.00, 1, 'D'),
(255, '3.1.5.001.004', '3', '3.1', '3.1.5', '3.1.5.001', 573, 'IOF', '', '', 0.00, 1, 'D'),
(260, '3.1.6', '3', '3.1', '3.1.6', '3.1.6.001', 0, 'DESPESAS SEMADBY', '', 'Secretaria de Missões. Despesas na compra de bíblias, cruzadas, literatura...', 35546.65, 1, 'D'),
(261, '3.1.6.001', '3', '3.1', '3.1.6', '3.1.6.001', 0, 'DESPESAS SEC. DE MISSÕES', '', 'Secretaria de Missões. Despesas na compra de bíblias, cruzadas, literatura...', 35546.65, 1, 'D'),
(262, '3.1.6.001.001', '3', '3.1', '3.1.6', '3.1.6.001', 580, 'Compra de Bíblias', '', '', 0.00, 1, 'D'),
(263, '3.1.6.001.002', '3', '3.1', '3.1.6', '3.1.6.001', 581, 'Compra de Literaturas', '', '', 0.00, 1, 'D'),
(264, '3.1.6.001.003', '3', '3.1', '3.1.6', '3.1.6.001', 574, 'Oferta a Pregadores - Missões', '', '', 0.00, 1, 'D'),
(265, '3.1.6.001.004', '3', '3.1', '3.1.6', '3.1.6.001', 575, 'Despesas com Cruzadas - Missões', '', '', 0.00, 1, 'D'),
(266, '3.1.6.001.005', '3', '3.1', '3.1.6', '3.1.6.001', 576, 'SEMAD - Contrib. Sec. de Missões 40%', '', 'Contribuição da Sec. de Missões local a sede da convenção - indice de 40% das arrecadações', 34073.45, 1, 'D'),
(300, '4', '4', '4', '4', '4', 0, 'RECEITAS', '', '', 3417782.68, 1, 'C'),
(301, '4.1', '4', '4.1', '4.1', '4.1', 0, 'RECEITAS OPERACIONAIS', '', '', 3378454.29, 1, 'C'),
(302, '4.1.1', '4', '4.1', '4.1.1', '4.1.1', 0, 'SEDE E CONGREGAÇÕES', '', '', 3295044.19, 1, 'C'),
(303, '4.1.1.001', '4', '4.1', '4.1.1', '4.1.1.001', 0, 'RECEITA DE CULTOS', '', '', 3140090.54, 1, 'C'),
(304, '4.1.1.001.001', '4', '4.1', '4.1.1', '4.1.1.001', 700, 'Dízimos', 'dízimos', '', 2834498.30, 1, 'C'),
(305, '4.1.1.001.002', '4', '4.1', '4.1.1', '4.1.1.001', 701, 'Ofertas de cultos', 'ofertas', '', 288429.84, 1, 'C'),
(306, '4.1.1.001.003', '4', '4.1', '4.1.1', '4.1.1.001', 702, 'Ofertas Extras', 'ofertas extras', '', 3452.15, 1, 'C'),
(307, '4.1.1.001.004', '4', '4.1', '4.1.1', '4.1.1.002', 703, 'Outras Arrecadações em Cultos', 'ofertas', '', 0.00, 1, 'C'),
(308, '4.1.1.001.005', '4', '4.1', '4.1.1', '4.1.1.001', 704, 'Votos em Cultos', 'votos', '', 13710.25, 1, 'C'),
(320, '4.1.1.002', '4', '4.1', '4.1.1', '4.1.1.002', 0, 'RECEITAS USADEBY', '', '', 58529.25, 1, 'C'),
(321, '4.1.1.002.001', '4', '4.1', '4.1.1', '4.1.1.002', 720, 'Ofertas em Circ. de Oração - Adulto', 'ofertas (Senhoras)', '', 58371.65, 1, 'C'),
(322, '4.1.1.002.002', '4', '4.1', '4.1.1', '4.1.1.002', 721, 'Votos em Circ. de Oração', 'votos em circ. de oração', '', 97.00, 1, 'C'),
(323, '4.1.1.002.003', '4', '4.1', '4.1.1', '4.1.1.002', 722, 'Ofertas de Cultos - Senhoras', 'ofertas (Senhoras)', 'Ofertas de Cultos de Senhoras na Sede e congregações', 60.60, 1, 'C'),
(325, '4.1.1.002.005', '4', '4.1', '4.1.1', '4.1.1.002', 724, 'ofertas extras de circ. de oração', 'ofertas (Senhoras)', '', 0.00, 1, 'C'),
(326, '4.1.1.002.006', '4', '4.1', '4.1.1', '4.1.1.002', 726, 'Sobras de Vendas para Congresso', 'Sobras de Vendas', 'Sobras de Vendas para Congresso'',''Sobra da venda de camisas, lanches, doações e outros relacionados, para realização do congresso ou outras festividades das Senhoras', 0.00, 1, 'C'),
(330, '4.1.1.002.099', '4', '4.1', '4.1.1', '4.1.1.002', 725, 'Outras Arrecadações em Circ. de Oração', 'ofertas (Senhoras)', '', 0.00, 1, 'C'),
(331, '4.1.1.003', '4', '4.1', '4.1.1', '4.1.1.003', 0, 'RECEITAS DE CAMPANHAS ', '', '', 75469.15, 1, 'C'),
(332, '4.1.1.003.001', '4', '4.1', '4.1.1', '4.1.1.003', 730, 'Joaquim Fernades - Compra e Construção', 'campanha (Joaquim Fernades)', 'Arrecadação para compra e/ou construção da nova congregação', 62.00, 1, 'C'),
(333, '4.1.1.003.002', '4', '4.1', '4.1.1', '4.1.1.003', 731, 'Templo Sede - Casas para ampliação', 'campanha das casas', 'Compra de casa para ampliação do templo sede', 59525.15, 1, 'C'),
(334, '4.1.1.003.003', '4', '4.1', '4.1.1', '4.1.1.003', 732, 'Andreazza I - Reforma', 'campanha (Andreazza I )', 'Campanha para reforma da igreja realizada pelos irmãos', 8941.00, 1, 'C'),
(400, '4.1.1.004', '4', '4.1', '4.1.1', '4.1.1.004', 0, 'DEADBY - DEPARTAMENTO DE ENSINO', '', '', 17642.75, 1, 'C'),
(401, '4.1.1.004.001', '4', '4.1', '4.1.1', '4.1.1.004', 800, 'Ofertas - Escola Bíblica', 'ofertas p/ ensino', '', 16621.00, 1, 'C'),
(402, '4.1.1.004.002', '4', '4.1', '4.1.1', '4.1.1.004', 801, 'Ofertas - Corpo de Professores', 'ofertas p/ ensino', '', 682.25, 1, 'C'),
(403, '4.1.1.004.003', '4', '4.1', '4.1.1', '4.1.1.004', 802, 'Outras Arrecadações - Dep. de Ensino', 'ofertas p/ ensino', '', 339.50, 1, 'C'),
(404, '4.1.1.004.004', '4', '4.1', '4.1.1', '4.1.1.004', 803, 'Arrecadações p/ pgto de Revista da EBD', 'coleta pgto revistas EBD', 'Arrecadações p/ pgto de Revista da EBD'',''A igreja compra e repassa a preço de custo as revistas adquiridas diretamente na CPDA, além de custear todas as de criança', 0.00, 1, 'C'),
(420, '4.1.2', '4', '4.1', '4.1.2', '4.1.2', 0, 'MISSÕES', '', '', 83410.10, 1, 'C'),
(421, '4.1.2.001', '4', '4.1', '4.1.2', '4.1.2.001', 0, 'SEDE E CONGREGAÇÕES - MISSÕES', '', '', 83410.10, 1, 'C'),
(422, '4.1.2.001.001', '4', '4.1', '4.1.2', '4.1.2.001', 820, 'Ofertas de Missões -  Cultos na Sede', 'missões', '', 12214.25, 1, 'C'),
(423, '4.1.2.001.002', '4', '4.1', '4.1.2', '4.1.2.001', 821, 'Ofertas de Missões -  Cultos nas Congregações', 'missões', '', 26335.90, 1, 'C'),
(424, '4.1.2.001.003', '4', '4.1', '4.1.2', '4.1.2.001', 822, 'Ofertas de Missões -  Carnês', 'missões', '', 28593.85, 1, 'C'),
(425, '4.1.2.001.004', '4', '4.1', '4.1.2', '4.1.2.001', 823, 'Ofertas de Missões -  Cofre', 'missões', '', 5945.15, 1, 'C'),
(426, '4.1.2.001.005', '4', '4.1', '4.1.2', '4.1.2.001', 824, 'Ofertas de Missões -  Envelopes', 'missões', '', 10200.95, 1, 'C'),
(427, '4.1.2.001.007', '4', '4.1', '4.1.2', '4.1.2.001', 825, 'Votos para Missões', 'missões', '', 100.00, 1, 'C'),
(440, '4.1.2.001.099', '4', '4.1', '4.1.2', '4.1.2.001', 826, 'Outras Arrecadações - Cultos de Missões', 'missões', '', 20.00, 1, 'C'),
(460, '4.2', '4', '4.2', '4.2', '4.2', 0, 'RECEITAS NÃO OPERACIONAIS', '', '', 39328.39, 1, 'C'),
(461, '4.2.1', '4', '4.2', '4.2.1', '4.2.1', 0, 'OUTRAS RECEITAS', '', '', 39328.39, 1, 'C'),
(462, '4.2.1.001', '4', '4.2', '4.2.1', '4.2.1.001', 0, 'RECEITAS DIVERSAS - SEDE E CONGREGAÇÕES', '', '', 39328.39, 1, 'C'),
(463, '4.2.1.001.001', '4', '4.2', '4.2.1', '4.2.1.001', 840, 'Arrecadação - Revistas Esc. Bíblica', 'coleta pgto revistas EBD', 'Arrecadação pela compra de revistas bíblicas', 10091.50, 1, 'C'),
(464, '4.2.1.001.002', '4', '4.2', '4.2.1', '4.2.1.001', 841, 'Sobras de Vendas - Custear Eventos', 'sobras vendas pgto eventos', 'Venda de camisas e blusas para custear eventos de qualquer natureza', 0.00, 1, 'C'),
(480, '4.2.1.002', '4', '4.2', '4.2.1', '4.2.1.002', 0, 'RECEITAS FINANCEIRAS', '', '', 0.00, 1, 'C'),
(481, '4.2.1.002.001', '4', '4.2', '4.2.1', '4.2.1.002', 860, 'Rendimentos Sobre Aplicações ', '', 'Poupança e outras aplicações', 0.00, 1, 'C'),
(482, '1.1.1.001.008', '1', '1.1', '1.1.1', '1.1.1.001', 8, 'Caixa Mocidade', '', 'Referente cultos, ofertas e orações de mocidade', 3245.30, 1, 'D'),
(483, '3.1.3.002', '3', '3.1', '3.1.3', '3.1.3.002', 0, 'DESPESAS COM MINISTÉRIO', '', '', 0.00, 1, 'D'),
(484, '3.1.3.002.001', '3', '3.1', '3.1.3', '3.1.3.002', 880, 'Oferta a Dirigentes de Congregação', '', '', 0.00, 1, 'D'),
(485, '3.1.3.002.002', '3', '3.1', '3.1.3', '3.1.3.002', 881, 'Ministério', '', '', 0.00, 1, 'D'),
(486, '3.1.2.002.003', '3', '3.1', '3.1.2', '3.1.2.002', 602, 'Alimentação trabalhadores da construção civil', '', 'Gastos com alimentação relacionadas a construção civil e assemelhados ', 0.00, 1, 'D'),
(487, '3.1.2.001.032', '3', '3.1', '3.1.2', '3.1.2.001', 532, 'Serviço de Segurança', '', 'Guarda e segurança de terceiros nas igrejas', 0.00, 1, 'D'),
(490, '4.1.1.005', '4', '4.1', '4.1.1', '4.1.1.005', 0, 'RECEITA UMADEBY', '', 'Todas as entradas relacionadas as arrecadações de mocidade', 3248.40, 1, 'C'),
(491, '4.1.1.005.001', '4', '4.1', '4.1.1', '4.1.1.005', 900, 'Ofertas em Circ. de Oração - Mocidade', 'ofertas mocidade', 'Circulo de oração da mocidade', 2618.60, 1, 'C'),
(492, '4.1.1.005.007', '4', '4.1', '4.1.1', '4.1.1.005', 906, 'Sobras de Vendas - UMADEBY', '', '', 0.00, 1, 'C'),
(493, '4.2.1.001.003', '4', '4.2', '4.2.1', '4.2.1.001', 842, 'Sobras de Vendas p/ Custear Eventos - UMADEBY', 'sobras vendas pgto eventos', 'Vendas de Camisas, cantinas e assemelhados para custear qualquer tipo de evento da União da Mocidade', 9415.34, 1, 'C'),
(494, '4.2.1.001.004', '4', '4.2', '4.2.1', '4.2.1.001', 843, 'Sobras de Vendas p/ Custear Eventos - USADEBY', 'sobras vendas pgto eventos', 'Vendas de Camisas, cantinas e assemelhados para custear qualquer tipo de evento da União da Mocidade', 10670.00, 1, 'C'),
(495, '3.1.4.001.007', '3', '3.1', '3.1.4', '3.1.4.001', 564, 'MPS - Previdência Social', '', 'Contribuições sociais dos contribuintes da Previdência Social', 9374.24, 1, 'D'),
(496, '4.1.1.003.004', '4', '4.1', '4.1.1', '4.1.1.003', 733, 'Balbino de Mendonça - Campanha', 'campanha (Balbino )', 'Campanha realizada pela congregação para compra de algum equipamento, móvel ou qualquer objeto, desde que autorizado pelo Pastor da cidade', 2250.00, 1, 'C'),
(497, '3.1.1.005.009', '3', '3.1', '3.1.1', '3.1.1.005', 448, 'Curso de Teologia', '', 'Investimento em Curso de teologia para membros da igreja', 1525.00, 1, 'D'),
(498, '3.1.1.001.008', '3', '3.1', '3.1.1', '3.1.1.001', 407, 'Som - Manutenção e Consertos', '', 'Reparo, Manutenção, compra de peças para os equipamentos de som de uso na congregação e no evangelismo de rua', 0.00, 1, 'D'),
(499, '3.1.1.006.003', '3', '3.1', '3.1.1', '3.1.1.006', 462, 'Professores de Música', '', 'Pgto a professores e instrutores de música, hora aula, e outras despesas relacionadas', 1512.00, 1, 'D'),
(500, '4.1.1.005.002', '4', '4.1', '4.1.1', '4.1.1.005', 901, 'Setor I - Rubem', 'sobras vendas da mocidade', 'Arrecadação realizada pela mocidade do setor I, para composição de seu caixa', 0.00, 1, 'C'),
(501, '4.1.1.005.003', '4', '4.1', '4.1.1', '4.1.1.005', 902, 'Setor II - Zebulom', 'sobras vendas da mocidade', 'Arrecadação realizada pela mocidade do setor II, para composição de seu caixa', 629.80, 1, 'C'),
(502, '4.1.1.005.004', '4', '4.1', '4.1.1', '4.1.1.005', 903, 'Setor III - Azer', 'sobras vendas da mocidade', 'Arrecadação realizada pela mocidade do setor III, para composição de seu caixa', 0.00, 1, 'C'),
(503, '4.1.1.005.005', '4', '4.1', '4.1.1', '4.1.1.005', 904, 'Setor IV - Juda', 'sobras vendas da mocidade', 'Arrecadação realizada pela mocidade do setor IV, para composição de seu caixa', 0.00, 1, 'C'),
(504, '1.1.1.001.009', '1', '1.1', '1.1.1', '1.1.1.001', 9, 'Caixa Mocidade Setor I - Rubem', '', 'Arrecadação realizada pela mocidade do setor I, para composição de seu caixa', 200.00, 1, 'D'),
(505, '1.1.1.001.010', '1', '1.1', '1.1.1', '1.1.1.001', 10, 'Caixa Mocidade Setor II - Zebulom', '', 'Arrecadação realizada pela mocidade do setor II, para composição de seu caixa', 509.80, 1, 'D'),
(506, '1.1.1.001.011', '1', '1.1', '1.1.1', '1.1.1.001', 11, 'Caixa Mocidade Setor III - Azer', '', 'Arrecadação realizada pela mocidade do setor III, para composição de seu caixa', 0.00, 1, 'D'),
(507, '1.1.1.001.012', '1', '1.1', '1.1.1', '1.1.1.001', 12, 'Caixa Mocidade Setor IV - Juda', '', 'Arrecadação realizada pela mocidade do setor IV, para composição de seu caixa', 0.00, 1, 'D'),
(508, '3.1.1.001.009', '3', '3.1', '3.1.1', '3.1.1.001', 408, 'Predial - Manutenção e Conservação', '', 'Reparos e material para conservação do imóvel e equipamentos elétricos da igreja', 0.00, 1, 'D'),
(509, '4.1.1.006', '4', '4.1', '4.1.1', '4.1.1.006', 0, 'DEPARTAMENTO INFANTIL', '', 'Receitas das ofertas: nos círculos de orações de crianças, dos cultos de crianças e nos eventos voltados especificamente infantil', 64.10, 1, 'C'),
(510, '4.1.1.006.001', '4', '4.1', '4.1.1', '4.1.1.006', 950, 'Ofertas em Circ. de Oração - Infantil', 'ofertas infantil', 'Circulo de orações da Sede e congregações', 64.10, 1, 'C'),
(511, '4.1.1.006.002', '4', '4.1', '4.1.1', '4.1.1.006', 951, 'Votos em Circ. Oração - Infantil', 'votos infantil', 'Votos em Circ. Oração de crianças na Sede e congregações', 0.00, 1, 'D'),
(512, '4.1.1.006.003', '4', '4.1', '4.1.1', '4.1.1.006', 952, 'Ofertas Extras - Infantil', 'ofertas infantil', 'Ofertas Extras nos cultos e círculos de orações de crianças', 0.00, 1, 'C'),
(513, '4.1.1.006.004', '4', '4.1', '4.1.1', '4.1.1.006', 953, 'Ofertas de Cultos - Infantil', 'ofertas infantil', 'Ofertas de cultos de crianças', 0.00, 1, 'C'),
(514, '4.1.1.005.006', '4', '4.1', '4.1.1', '4.1.1.005', 905, 'Ofertas de Cultos - Mocidade', 'ofertas mocidade', 'Ofertas de Cultos de jovens', 0.00, 1, 'D'),
(515, '4.1.1.003.005', '4', '4.1', '4.1.1', '4.1.1.003', 734, 'São Vicente - Construção', 'campanha (São Vicente - Construção )', 'Campanha para ajudar na construção da nova congregação', 4691.00, 1, 'C'),
(516, '3.1.1.007', '3', '3.1', '3.1.1', '3.1.1.007', 0, 'DEPARTAMENTO INFANTIL', '', 'Despesas com eventos de crianças, não incluindo escola bíblica', 0.00, 1, 'D'),
(517, '3.1.1.007.001', '3', '3.1', '3.1.1', '3.1.1.007', 980, 'Ofertas a Pregadores', '', 'Ofertas a Pregadores para cultos e eventos para crianças.', 0.00, 1, 'D'),
(518, '4.2.1.001.005', '4', '4.2', '4.2.1', '4.2.1.001', 844, 'Sobras de Vendas p/ Custear Eventos - Setor I', 'sobras vendas', '', 1000.00, 1, 'C'),
(519, '4.2.1.001.006', '4', '4.2', '4.2.1', '4.2.1.001', 845, 'Sobras de Vendas p/ Custear Eventos - Setor II', 'sobras vendas', '', 920.00, 1, 'C'),
(522, '4.2.1.001.007', '4', '4.2', '4.2.1', '4.2.1.001', 846, 'Sobras de Vendas p/ Custear Eventos - Setor III', 'sobras vendas', '', 1000.00, 1, 'C'),
(523, '4.2.1.001.008', '4', '4.2', '4.2.1', '4.2.1.001', 847, 'Sobras de Vendas p/ Custear Eventos - Setor IV', 'sobras vendas', '', 0.00, 1, 'C'),
(524, '4.2.1.001.009', '4', '4.2', '4.2.1', '4.2.1.001', 848, 'Sobras para Custear XVI Congresso - USADEBY ', 'sobras vendas', '', 4500.00, 1, 'C'),
(525, '3.1.6.001.006', '3', '3.1', '3.1.6', '3.1.6.001', 577, 'Assinaturas - Revista e Jornais', '', '', 1123.20, 1, 'D'),
(526, '3.1.2.002.004', '3', '3.1', '3.1.2', '3.1.2.002', 603, 'Locação de Máquinas e Equipamentos', '', 'Aluguel de: andaimes, betoneira, fretes para transporte de material, etc.', 0.00, 1, 'D'),
(527, '4.2.1.001.010', '4', '4.2', '4.2.1', '4.2.1.001', 849, 'Oferta para Congressos e Eventos', 'Ofertas extras', 'Doações e ofertas para congressos em geral', 115.00, 1, 'C'),
(528, '4.2.1.001.011', '4', '4.2', '4.2.1', '4.2.1.001', 850, 'Campanhas p/ Compra de Equipamentos', 'campanha', 'Contribuições de membros ou simpatizantes para aquisição de equipamentos de qualquer natureza para uso na congregação', 1500.00, 1, 'C'),
(529, '2.1.1.001.099', '2', '2.1', '2.1.1', '2.1.1.001', 350, 'Dívidas a Pagar', 'Reconhecimento de dívidas a pagar', '', 0.00, 1, 'C'),
(530, '3.1.6.001.007', '3', '3.1', '3.1.6', '3.1.6.001', 578, 'Administração Missões - Salários ', 'Pgto de despesas administrativas', 'Pgto de salário ou pró-labore da diretoria', 350.00, 1, 'D'),
(531, '3.1.6.001.008', '3', '3.1', '3.1.6', '3.1.6.001', 579, 'Ajuda de Custos - Missões', 'Pgto de despesas para ajuda de custos em eventos de missões', 'Pgto de despesas para ajuda de custos em eventos de missões, tipo café, translado, hotel, táxi etc', 0.00, 1, 'D'),
(532, '3.1.1.001.010', '3', '3.1', '3.1.1', '3.1.1.001', 409, 'Oferta à Pregadores', 'Auxílio para pregadores do culto', '\0', 0.00, 1, 'D'),
(533, '1.2.1.001.006', '1', '1.2', '1.2.1', '1.2.1.001', 165, 'Instalações e Manutenção - Sede', 'Material para manutenção predial - Sede', '', 0.00, 1, 'D'),
(534, '3.1.2.002.005', '3', '3.1', '3.1.2', '3.1.2.002', 604, 'Material Elétrico', '', 'Despesas com material elétrico para manutenção, reforma e construção de Igrejas', 0.00, 1, 'D'),
(535, '3.1.1.001.011', '3', '3.1', '3.1.1', '3.1.1.001', 750, 'Maquinas e Equipamentos - Manutenção e Consertos', 'Consertos de equipamentos', 'Conserto de maquinas e equipamento, exceto som, tais com ventiladores, motores e outros', 0.00, 1, 'D'),
(536, '3.1.6.001.009', '3', '3.1', '3.1.6', '3.1.6.001', 582, 'Programas de Rádio', '', '', 0.00, 1, 'D'),
(537, '3.1.1.008', '3', '3.1', '3.1.1', '3.1.1.008', 0, 'CONSTRUÇÃO DE TEMPLOS', '', 'Material elétrico e construção civil', 0.00, 1, 'D'),
(538, '3.1.1.008.001', '3', '3.1', '3.1.1', '3.1.1.008', 1000, 'Material de Construção Civil', '', '', 0.00, 1, 'D'),
(539, '3.1.1.008.002', '3', '3.1', '3.1.1', '3.1.1.008', 1001, 'Material Elétrico', '', '', 0.00, 1, 'D'),
(540, '3.1.1.008.003', '3', '3.1', '3.1.1', '3.1.1.008', 1002, 'Material Hidráulico ', '', '', 0.00, 1, 'D'),
(541, '3.1.1.008.004', '3', '3.1', '3.1.1', '3.1.1.008', 1003, 'Mão de Obra', '', '', 0.00, 1, 'D'),
(542, '3.1.1.008.005', '3', '3.1', '3.1.1', '3.1.1.008', 1004, 'Serviços', '', '', 0.00, 1, 'D'),
(543, '3.1.3.003', '3', '3.1', '3.1.3', '3.1.3.003', 0, 'MANUTENÇÃO PASTORAL', '', '', 0.00, 1, 'D'),
(544, '3.1.3.003.001', '3', '3.1', '3.1.3', '3.1.3.003', 1010, 'Oferta Administrativa', '', '', 0.00, 1, 'D'),
(545, '3.1.3.002.003', '3', '3.1', '3.1.3', '3.1.3.002', 882, 'Secretaria', '', '', 0.00, 1, 'D'),
(546, '3.1.3.002.004', '3', '3.1', '3.1.3', '3.1.3.002', 883, 'Tesouraria', '', '', 0.00, 1, 'D'),
(547, '3.1.3.003.002', '3', '3.1', '3.1.3', '3.1.3.003', 1011, 'Construção Civil', '', '', 0.00, 1, 'D'),
(548, '3.1.3.003.099', '3', '3.1', '3.1.3', '3.1.3.003', 1012, 'Outras Despesas Pastorais', '', '', 0.00, 1, 'D'),
(549, '3.1.3.004', '3', '3.1', '3.1.3', '3.1.3.004', 0, 'VOLUNTÁRIOS', '', '', 0.00, 1, 'D'),
(550, '3.1.3.004.001', '3', '3.1', '3.1.3', '3.1.3.004', 1020, 'Tesoureiros - Passagens', '', '', 0.00, 1, 'D'),
(551, '3.1.3.004.002', '3', '3.1', '3.1.3', '3.1.3.004', 1021, 'Zeladores - Ajuda de custos', '', '', 0.00, 1, 'D'),
(553, '3.1.1.003.006', '3', '3.1', '3.1.1', '3.1.1.003', 425, 'Dirigentes Circ. de Oração - Passagem', '', '', 0.00, 1, 'D'),
(554, '3.1.1.008.006', '3', '3.1', '3.1.1', '3.1.1.008', 1005, 'Aluguel e Locação de Máquinas e Equipamentos', '', '', 0.00, 1, 'D'),
(555, '4.2.1.001.012', '4', '4.2', '4.2.1', '4.2.1.001', 851, 'Oferta p/ Pgto de Ônibus', 'Contribuição p/ locação de ônibus', '', 116.55, 1, 'C'),
(556, '3.1.1.007.002', '3', '3.1', '3.1.1', '3.1.1.007', 981, 'Congresso e Eventos', 'Despesas com festividades', 'Despesas com festividades dos eventos e congressos de crinças', 0.00, 1, 'D'),
(557, '3.1.6.001.010', '3', '3.1', '3.1.6', '3.1.6.001', 583, 'Congressos e Eventos', '', 'Despesas com eventos, festas e congressos em geral', 0.00, 1, 'D'),
(558, '3.1.3.002.005', '3', '3.1', '3.1.3', '3.1.3.002', 884, 'Festas, Aniversários e Eventos', 'Comemoração', 'Festas, aniversários e eventos em geral, na Sede e congregações', 0.00, 1, 'D'),
(559, '1.1.1.008', '1', '1.1', '1.1.1', '1.1.1.008', 0, 'Adiantamento a Fornecedoes', '', ' os adiantamentos efetuados a fornecedores de produtos como móveis, máquinas, construção,registrados nessa conta. Sendo baixa efetuada por ocasião do efetivo recebimento do material ou bem, registrando-se o custo total na correspondente conta, e caso haja saldo a pagar, na conta Fornecedores, no passivo circulante', 0.00, 1, 'D'),
(562, '1.1.1.008.001', '1', '1.1', '1.1.1', '1.1.1.008', 1050, 'Construção Civil', 'Adiatemento para aquisição de material', 'Materiais para construção civil em geral, como tijolo, areia, pedra, entre outros', 0.00, 1, 'D'),
(563, '1.1.1.008.002', '1', '1.1', '1.1.1', '1.1.1.008', 1051, 'Móveis e Utensílios', '', 'Contabilização de adiantamentos para compra de bancos para nave da igreja e demais móveis', 0.00, 1, 'D'),
(564, '1.1.1.008.003', '1', '1.1', '1.1.1', '1.1.1.008', 1052, 'Produtos de Limpeza', 'Adiatemento para aquisição de material de limpeza', 'Adiantamento para compra de água sanitária, sabão em pó, pano de chão e outros materiais relacionados', 0.00, 1, 'D'),
(565, '1.1.1.008.004', '1', '1.1', '1.1.1', '1.1.1.008', 1053, 'Manutenções em Máquinas e Equipamentos', 'Adiantamentos para consertos de equipamentos', 'Adiantamentos para consertos de equipamentos e maquinas de som, aparelhos de ar condicionado, bebedouros e outros relacionados', 0.00, 1, 'D');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `contas`
--
ALTER TABLE `contas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `codigo` (`codigo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `contas`
--
ALTER TABLE `contas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=566;

--
-- Estrutura para tabela `credores`
--

CREATE TABLE IF NOT EXISTS `credores` (
`id` int(11) NOT NULL,
  `cnpj_cpf` varchar(18) NOT NULL,
  `razao` varchar(255) NOT NULL,
  `alias` varchar(30) NOT NULL,
  `contas` varchar(30) NOT NULL COMMENT 'contas dos plano de contas que este credor fornece, separado por vígula',
  `telefone` varchar(30) NOT NULL,
  `celular` varchar(30) NOT NULL,
  `end` varchar(255) NOT NULL COMMENT 'Logradouro e número',
  `bairro` varchar(255) NOT NULL,
  `cidade` int(11) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `responsavel` varchar(255) NOT NULL,
  `cpf` varchar(30) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hist` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `credores`
--
ALTER TABLE `credores`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `razao` (`razao`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `credores`
--
ALTER TABLE `credores`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
--Remove tabela dizimo
--
DROP TABLE dizimo;

--
-- Estrutura para tabela `dizimooferta`
--

CREATE TABLE IF NOT EXISTS `dizimooferta` (
`id` int(11) NOT NULL,
  `lancamento` int(11) NOT NULL COMMENT 'Quando realizado lançamento id referente ao lançamento',
  `credito` int(11) NOT NULL COMMENT 'Acesso da conta credora',
  `devedora` int(11) NOT NULL COMMENT 'Acesso da conta devedora',
  `tipo` int(1) NOT NULL COMMENT '1-Dízimo, 2-Oferta, 3-Oferta extra, 4-Voto, 5-Missões, 6-Campanha, 7 - Circulo de Oração',
  `congcadastro` int(11) NOT NULL COMMENT 'Congregação onde este membro está cadastrado neste momento',
  `rol` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL COMMENT 'Se tipo=1 e este campo vazio dizimo anónimo',
  `valor` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `semana` enum('1','2','3','4','5') NOT NULL,
  `mesrefer` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL COMMENT 'Mês de referência da contribuição',
  `anorefer` int(4) NOT NULL DEFAULT '2012',
  `igreja` int(11) NOT NULL,
  `tesoureiro` varchar(14) NOT NULL COMMENT 'CPF do tesoureiro responsável pelo lançamento',
  `confirma` varchar(14) NOT NULL COMMENT 'CPF do 2º tesoureiro confirmando lançamento',
  `obs` varchar(255) NOT NULL,
  `cad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hist` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38935 DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `dizimooferta`
--
ALTER TABLE `dizimooferta`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `dizimooferta`
--
ALTER TABLE `dizimooferta`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;