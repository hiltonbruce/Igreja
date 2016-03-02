CREATE DATABASE  IF NOT EXISTS `igrejaDB` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `igrejaDB`;
-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: igrejaDB
-- ------------------------------------------------------
-- Server version	5.5.47-0+deb8u1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `hist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agenda`
--

LOCK TABLES `agenda` WRITE;
/*!40000 ALTER TABLE `agenda` DISABLE KEYS */;
/*!40000 ALTER TABLE `agenda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bairro`
--

DROP TABLE IF EXISTS `bairro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bairro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bairro` varchar(70) NOT NULL,
  `idcidade` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `historico` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bairro`
--

LOCK TABLES `bairro` WRITE;
/*!40000 ALTER TABLE `bairro` DISABLE KEYS */;
INSERT INTO `bairro` VALUES (1,'Jardim Aeroporto',2585,'2009-06-11 23:26:53','Inserido por:023.261.774-01'),(2,'Tambay',2585,'2009-06-12 01:42:26','Inserido por:023.261.774-01'),(3,'Jaguaribe',2655,'2009-06-12 04:09:42','Inserido por:023.261.774-01'),(4,'Torre',2655,'2009-06-12 04:13:50','Inserido por:023.261.774-01'),(5,'Tambaú',2655,'2009-06-12 04:18:43','Inserido por:023.261.774-01'),(6,'Odilandia',2731,'2009-06-12 14:39:43','Inserido por:023.261.774-01'),(7,'Centro',2585,'2009-06-22 03:48:17','Inserido por:023.261.774-01'),(9,'Rio do Meio',2585,'2009-06-22 03:49:40','Inserido por:023.261.774-01'),(10,'Sesi',2585,'2009-06-22 03:50:04','Inserido por:023.261.774-01'),(11,'Imaculada',2585,'2009-06-22 03:51:00','Inserido por:023.261.774-01'),(12,'Alto da Boa Vista',2585,'2009-06-22 03:51:55','Inserido por:023.261.774-01'),(13,'Mário Andreaza',2585,'2009-06-22 03:54:28','Inserido por:023.261.774-01'),(14,'São Sebastião',2585,'2009-06-22 03:58:52','Inserido por:023.261.774-01'),(15,'Manguinhos',2585,'2009-06-22 04:00:12','Inserido por:023.261.774-01'),(16,'BRASILIA',2585,'2009-07-01 12:02:27','Inserido por:873.703.604-15'),(24,'Trincheiras',2655,'2009-07-18 18:08:51','Inserido por:873.703.604-15'),(25,'João Pessoa',2655,'2009-07-20 13:38:26','Inserido por:873.703.604-15'),(27,'Baralho',2585,'2009-07-20 19:42:27','Inserido por:023.261.774-01'),(28,'Valentina',2655,'2009-07-29 15:01:30','Inserido por:873.703.604-15'),(29,'Centro',2594,'2009-07-29 22:49:13','Inserido por:873.703.604-15'),(32,'Comercial Norte',2585,'2009-11-08 21:58:00','Inserido por:4037'),(33,'Liberdade',2610,'2009-11-18 10:19:16','Inserido por:2272'),(43,'Loteamento Novo Contorno',2731,'2010-05-14 23:59:17','Inserido por:4037'),(45,'Planalto',2731,'2010-05-24 22:33:29','Inserido por:2272'),(55,'Varzea Nova',2731,'2010-09-28 16:19:26','Inserido por:4184'),(62,'São Vicente',2585,'2010-09-30 21:27:28','Inserido por:4184'),(70,'São Bento',2585,'2010-11-02 18:26:48','Inserido por:1600'),(72,'Recanto Feliz',2585,'2011-02-02 23:31:41','Inserido por:645.822.304-82'),(73,'Varzea Nova (Shalom)',2731,'2011-06-28 12:53:07','Inserido por:873.703.604-15'),(76,'SÃO LOURENÇO',2585,'2011-07-08 13:24:19','Inserido por:034.641.584-54'),(79,'Tibiri II',2724,'2011-07-18 23:18:56','Inserido por:873.703.604-15'),(80,'Tibiri II',2731,'2011-07-18 23:19:40','Inserido por:873.703.604-15'),(81,'Manaíra',2655,'2011-10-06 13:55:26','Inserido por:645.822.304-82'),(82,'centro',0,'2013-05-31 13:57:53','Inserido por:713.671.284-04'),(83,'Boa Vista',2731,'2013-10-25 12:16:37','Inserido por:873.703.604-15'),(84,'Heitel Santiago',2731,'2014-07-25 23:31:21','Inserido por:873.703.604-15'),(85,'CONJ CASA BRANCA',2585,'2014-10-19 23:02:31','Inserido por:645.822.304-82'),(86,'Shalon',2585,'2014-10-27 13:10:32','Inserido por:873.703.604-15'),(87,'Jardim São Severino',2585,'2015-11-10 23:23:31','Inserido por:223.043.368-76'),(88,'Centro',2731,'2016-01-28 14:54:41','Inserido por:223.043.368-76'),(89,'Alto do Mateus',2655,'2016-02-03 13:58:33','Inserido por:873.703.604-15');
/*!40000 ALTER TABLE `bairro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargo_igreja`
--

DROP TABLE IF EXISTS `cargo_igreja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo_igreja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` int(2) NOT NULL,
  `obs` varchar(255) NOT NULL,
  `igreja` int(4) NOT NULL,
  `rol` int(11) NOT NULL COMMENT 'rol do membro nesta função',
  `hierarquia` int(2) NOT NULL,
  `ativo` char(1) NOT NULL DEFAULT '1' COMMENT 'Se 1 atual cargo ativo p este membro',
  `hist` varchar(255) NOT NULL,
  `cad` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo_igreja`
--

LOCK TABLES `cargo_igreja` WRITE;
/*!40000 ALTER TABLE `cargo_igreja` DISABLE KEYS */;
/*!40000 ALTER TABLE `cargo_igreja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargohist`
--

DROP TABLE IF EXISTS `cargohist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargohist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` int(2) NOT NULL,
  `obs` varchar(255) NOT NULL,
  `igreja` int(4) NOT NULL,
  `rol` int(11) NOT NULL COMMENT 'rol do membro nesta função',
  `hierarquia` int(2) NOT NULL,
  `dataini` date NOT NULL COMMENT 'data de inicio na função',
  `datafim` date NOT NULL COMMENT 'data final na função',
  `cad` varchar(255) NOT NULL,
  `cadfim` varchar(150) NOT NULL COMMENT 'REsp pelo pela data final',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargohist`
--

LOCK TABLES `cargohist` WRITE;
/*!40000 ALTER TABLE `cargohist` DISABLE KEYS */;
/*!40000 ALTER TABLE `cargohist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargoigreja`
--

DROP TABLE IF EXISTS `cargoigreja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargoigreja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `cad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargoigreja`
--

LOCK TABLES `cargoigreja` WRITE;
/*!40000 ALTER TABLE `cargoigreja` DISABLE KEYS */;
/*!40000 ALTER TABLE `cargoigreja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_apresentacao`
--

DROP TABLE IF EXISTS `cart_apresentacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_apresentacao` (
  `rol` int(11) NOT NULL AUTO_INCREMENT,
  `id_cong` int(3) NOT NULL COMMENT 'id da tabela igreja',
  `nome` varchar(100) NOT NULL COMMENT 'Nome da criança',
  `pai` varchar(200) NOT NULL,
  `rol_pai` int(3) NOT NULL,
  `mae` varchar(200) NOT NULL,
  `rol_mae` int(3) NOT NULL,
  `dt_nasc` date NOT NULL COMMENT 'Data de nascimento da criança',
  `maternidade` varchar(100) NOT NULL COMMENT 'Hospital onde a crança nasceu',
  `sexo` varchar(20) NOT NULL,
  `cidade` varchar(100) NOT NULL COMMENT 'Cidade de nascimento',
  `uf` varchar(2) NOT NULL,
  `fl` int(4) NOT NULL COMMENT 'Número da folha no livro de registro',
  `livro` varchar(30) NOT NULL COMMENT 'Número do livro de registro',
  `dt_apresent` date NOT NULL COMMENT 'Data da apresentação da criança',
  `num_cert` int(10) NOT NULL COMMENT 'Número da certidão de nascimento -Cartório',
  `obs` varchar(200) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hist` varchar(150) NOT NULL COMMENT 'log de cadastro',
  PRIMARY KEY (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_apresentacao`
--

LOCK TABLES `cart_apresentacao` WRITE;
/*!40000 ALTER TABLE `cart_apresentacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_apresentacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carta`
--

DROP TABLE IF EXISTS `carta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` int(2) NOT NULL COMMENT '1 - Recomendação; 2 - Mudança',
  `rol` int(11) NOT NULL,
  `destino` varchar(255) NOT NULL,
  `igreja` varchar(200) NOT NULL DEFAULT 'Assembleia de Deus',
  `obs` varchar(500) NOT NULL,
  `data` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `hist` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carta`
--

LOCK TABLES `carta` WRITE;
/*!40000 ALTER TABLE `carta` DISABLE KEYS */;
/*!40000 ALTER TABLE `carta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cetad_aluno`
--

DROP TABLE IF EXISTS `cetad_aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cetad_aluno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `curso` int(4) NOT NULL,
  `situacao` int(1) NOT NULL COMMENT '0 - cancelou, 1 - Curso em andamento, 2 - Curso concluído',
  `mensal` float(5,2) NOT NULL,
  `vencimento` int(2) NOT NULL,
  `cadatro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cetad_aluno`
--

LOCK TABLES `cetad_aluno` WRITE;
/*!40000 ALTER TABLE `cetad_aluno` DISABLE KEYS */;
/*!40000 ALTER TABLE `cetad_aluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cetad_curso`
--

DROP TABLE IF EXISTS `cetad_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cetad_curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(150) NOT NULL,
  `turma` varchar(150) NOT NULL,
  `mensal` decimal(5,2) NOT NULL,
  `horas_total` int(4) NOT NULL,
  `dias` varchar(13) NOT NULL,
  `hora_ini` time NOT NULL,
  `hora_fim` time NOT NULL,
  `hist` varchar(200) NOT NULL,
  `ativo` binary(1) NOT NULL COMMENT '1 - ativo / 0 - inativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cetad_curso`
--

LOCK TABLES `cetad_curso` WRITE;
/*!40000 ALTER TABLE `cetad_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `cetad_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cetad_pgto`
--

DROP TABLE IF EXISTS `cetad_pgto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cetad_pgto` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `pgto` decimal(15,2) NOT NULL,
  `rol_recebeu` varchar(200) NOT NULL,
  `data_pgto` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cetad_pgto`
--

LOCK TABLES `cetad_pgto` WRITE;
/*!40000 ALTER TABLE `cetad_pgto` DISABLE KEYS */;
/*!40000 ALTER TABLE `cetad_pgto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cidade`
--

DROP TABLE IF EXISTS `cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cidade` (
  `nome` varchar(70) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coduf` char(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coduf` (`coduf`)
) ENGINE=InnoDB AUTO_INCREMENT=5567 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cidade`
--

LOCK TABLES `cidade` WRITE;
/*!40000 ALTER TABLE `cidade` DISABLE KEYS */;
INSERT INTO `cidade` VALUES ('Acrelândia',1,'AC'),('Assis Brasil',2,'AC'),('Brasiléia',3,'AC'),('Bujari',4,'AC'),('Capixaba',5,'AC'),('Cruzeiro do Sul',6,'AC'),('Epitaciolândia',7,'AC'),('Feijó',8,'AC'),('Jordão',9,'AC'),('Mâncio Lima',10,'AC'),('Manoel Urbano',11,'AC'),('Marechal Thaumaturgo',12,'AC'),('Plácido de Castro',13,'AC'),('Porto Acre',14,'AC'),('Porto Walter',15,'AC'),('Rodrigues Alves',16,'AC'),('Santa Rosa do Purus',17,'AC'),('Sena Madureira',18,'AC'),('Senador Guiomard',19,'AC'),('Tarauacá',20,'AC'),('Xapuri',21,'AC'),('Rio Branco',22,'AC'),('Água Branca',23,'AL'),('Anadia',24,'AL'),('Arapiraca',25,'AL'),('Atalaia',26,'AL'),('Barra de Santo Antônio',27,'AL'),('Barra de São Miguel',28,'AL'),('Batalha',29,'AL'),('Belém',30,'AL'),('Belo Monte',31,'AL'),('Boca da Mata',32,'AL'),('Branquinha',33,'AL'),('Cacimbinhas',34,'AL'),('Cajueiro',35,'AL'),('Campestre',36,'AL'),('Campo Alegre',37,'AL'),('Campo Grande',38,'AL'),('Canapi',39,'AL'),('Capela',40,'AL'),('Carneiros',41,'AL'),('Chã Preta',42,'AL'),('Coité do Nóia',43,'AL'),('Colônia Leopoldina',44,'AL'),('Coqueiro Seco',45,'AL'),('Coruripe',46,'AL'),('Craíbas',47,'AL'),('Delmiro Gouveia',48,'AL'),('Dois Riachos',49,'AL'),('Estrela de Alagoas',50,'AL'),('Feira Grande',51,'AL'),('Feliz Deserto',52,'AL'),('Flexeiras',53,'AL'),('Girau do Ponciano',54,'AL'),('Ibateguara',55,'AL'),('Igaci',56,'AL'),('Igreja Nova',57,'AL'),('Inhapi',58,'AL'),('Jacaré dos Homens',59,'AL'),('Jacuípe',60,'AL'),('Japaratinga',61,'AL'),('Jaramataia',62,'AL'),('Jequiá da Praia',63,'AL'),('Joaquim Gomes',64,'AL'),('Jundiá',65,'AL'),('Junqueiro',66,'AL'),('Lagoa da Canoa',67,'AL'),('Limoeiro de Anadia',68,'AL'),('Major Isidoro',69,'AL'),('Mar Vermelho',70,'AL'),('Maragogi',71,'AL'),('Maravilha',72,'AL'),('Marechal Deodoro',73,'AL'),('Maribondo',74,'AL'),('Mata Grande',75,'AL'),('Matriz de Camaragibe',76,'AL'),('Messias',77,'AL'),('Minador do Negrão',78,'AL'),('Monteirópolis',79,'AL'),('Murici',80,'AL'),('Novo Lino',81,'AL'),('Olho d`Água das Flores',82,'AL'),('Olho d`Água do Casado',83,'AL'),('Olho d`Água Grande',84,'AL'),('Olivença',85,'AL'),('Ouro Branco',86,'AL'),('Palestina',87,'AL'),('Palmeira dos Índios',88,'AL'),('Pão de Açúcar',89,'AL'),('Pariconha',90,'AL'),('Paripueira',91,'AL'),('Passo de Camaragibe',92,'AL'),('Paulo Jacinto',93,'AL'),('Penedo',94,'AL'),('Piaçabuçu',95,'AL'),('Pilar',96,'AL'),('Pindoba',97,'AL'),('Piranhas',98,'AL'),('Poço das Trincheiras',99,'AL'),('Porto Calvo',100,'AL'),('Porto de Pedras',101,'AL'),('Porto Real do Colégio',102,'AL'),('Quebrangulo',103,'AL'),('Rio Largo',104,'AL'),('Roteiro',105,'AL'),('Santa Luzia do Norte',106,'AL'),('Santana do Ipanema',107,'AL'),('Santana do Mundaú',108,'AL'),('São Brás',109,'AL'),('São José da Laje',110,'AL'),('São José da Tapera',111,'AL'),('São Luís do Quitunde',112,'AL'),('São Miguel dos Campos',113,'AL'),('São Miguel dos Milagres',114,'AL'),('São Sebastião',115,'AL'),('Satuba',116,'AL'),('Senador Rui Palmeira',117,'AL'),('Tanque d`Arca',118,'AL'),('Taquarana',119,'AL'),('Teotônio Vilela',120,'AL'),('Traipu',121,'AL'),('União dos Palmares',122,'AL'),('Viçosa',123,'AL'),('Maceió',124,'AL'),('Alvarães',125,'AM'),('Amaturá',126,'AM'),('Anamã',127,'AM'),('Anori',128,'AM'),('Apuí',129,'AM'),('Atalaia do Norte',130,'AM'),('Autazes',131,'AM'),('Barcelos',132,'AM'),('Barreirinha',133,'AM'),('Benjamin Constant',134,'AM'),('Beruri',135,'AM'),('Boa Vista do Ramos',136,'AM'),('Boca do Acre',137,'AM'),('Borba',138,'AM'),('Caapiranga',139,'AM'),('Canutama',140,'AM'),('Carauari',141,'AM'),('Careiro',142,'AM'),('Careiro da Várzea',143,'AM'),('Coari',144,'AM'),('Codajás',145,'AM'),('Eirunepé',146,'AM'),('Envira',147,'AM'),('Fonte Boa',148,'AM'),('Guajará',149,'AM'),('Humaitá',150,'AM'),('Ipixuna',151,'AM'),('Iranduba',152,'AM'),('Itacoatiara',153,'AM'),('Itamarati',154,'AM'),('Itapiranga',155,'AM'),('Japurá',156,'AM'),('Juruá',157,'AM'),('Jutaí',158,'AM'),('Lábrea',159,'AM'),('Manacapuru',160,'AM'),('Manaquiri',161,'AM'),('Manicoré',162,'AM'),('Maraã',163,'AM'),('Maués',164,'AM'),('Nhamundá',165,'AM'),('Nova Olinda do Norte',166,'AM'),('Novo Airão',167,'AM'),('Novo Aripuanã',168,'AM'),('Parintins',169,'AM'),('Pauini',170,'AM'),('Presidente Figueiredo',171,'AM'),('Rio Preto da Eva',172,'AM'),('Santa Isabel do Rio Negro',173,'AM'),('Santo Antônio do Içá',174,'AM'),('São Gabriel da Cachoeira',175,'AM'),('São Paulo de Olivença',176,'AM'),('São Sebastião do Uatumã',177,'AM'),('Silves',178,'AM'),('Tabatinga',179,'AM'),('Tapauá',180,'AM'),('Tefé',181,'AM'),('Tonantins',182,'AM'),('Uarini',183,'AM'),('Urucará',184,'AM'),('Urucurituba',185,'AM'),('Manaus',186,'AM'),('Amapá',187,'AP'),('Calçoene',188,'AP'),('Cutias',189,'AP'),('Ferreira Gomes',190,'AP'),('Itaubal',191,'AP'),('Laranjal do Jari',192,'AP'),('Mazagão',193,'AP'),('Oiapoque',194,'AP'),('Pedra Branca do Amaparí',195,'AP'),('Porto Grande',196,'AP'),('Pracuúba',197,'AP'),('Santana',198,'AP'),('Serra do Navio',199,'AP'),('Tartarugalzinho',200,'AP'),('Vitória do Jar',201,'AP'),('Macapá',202,'AP'),('Abaíra',203,'BA'),('Abaré',204,'BA'),('Acajutiba',205,'BA'),('Adustina',206,'BA'),('Água Fria',207,'BA'),('Aiquara',208,'BA'),('Alagoinhas',209,'BA'),('Alcobaça',210,'BA'),('Almadina',211,'BA'),('Amargosa',212,'BA'),('Amélia Rodrigues',213,'BA'),('América Dourada',214,'BA'),('Anagé',215,'BA'),('Andaraí',216,'BA'),('Andorinha',217,'BA'),('Angical',218,'BA'),('Anguera',219,'BA'),('Antas',220,'BA'),('Antônio Cardoso',221,'BA'),('Antônio Gonçalves',222,'BA'),('Aporá',223,'BA'),('Apuarema',224,'BA'),('Araças',225,'BA'),('Aracatu',226,'BA'),('Araci',227,'BA'),('Aramari',228,'BA'),('Arataca',229,'BA'),('Aratuípe',230,'BA'),('Aurelino Leal',231,'BA'),('Baianópolis',232,'BA'),('Baixa Grande',233,'BA'),('Banzaê',234,'BA'),('Barra',235,'BA'),('Barra da Estiva',236,'BA'),('Barra do Choça',237,'BA'),('Barra do Mendes',238,'BA'),('Barra do Rocha',239,'BA'),('Barreiras',240,'BA'),('Barro Alto',241,'BA'),('Barro Preto [antigo Gov. Lomanto Jr.]',242,'BA'),('Barrocas',243,'BA'),('Belmonte',244,'BA'),('Belo Campo',245,'BA'),('Biritinga',246,'BA'),('Boa Nova',247,'BA'),('Boa Vista do Tupim',248,'BA'),('Bom Jesus da Lapa',249,'BA'),('Bom Jesus da Serra',250,'BA'),('Boninal',251,'BA'),('Bonito',252,'BA'),('Boquira',253,'BA'),('Botuporã',254,'BA'),('Brejões',255,'BA'),('Brejolândia',256,'BA'),('Brotas de Macaúbas',257,'BA'),('Brumado',258,'BA'),('Buerarema',259,'BA'),('Buritirama',260,'BA'),('Caatiba',261,'BA'),('Cabaceiras do Paraguaçu',262,'BA'),('Cachoeira',263,'BA'),('Caculé',264,'BA'),('Caém',265,'BA'),('Caetanos',266,'BA'),('Caetité',267,'BA'),('Cafarnaum',268,'BA'),('Cairu',269,'BA'),('Caldeirão Grande',270,'BA'),('Camacan',271,'BA'),('Camaçari',272,'BA'),('Camamu',273,'BA'),('Campo Alegre de Lourdes',274,'BA'),('Campo Formoso',275,'BA'),('Canápolis',276,'BA'),('Canarana',277,'BA'),('Canavieiras',278,'BA'),('Candeal',279,'BA'),('Candeias',280,'BA'),('Candiba',281,'BA'),('Cândido Sales',282,'BA'),('Cansanção',283,'BA'),('Canudos',284,'BA'),('Capela do Alto Alegre',285,'BA'),('Capim Grosso',286,'BA'),('Caraíbas',287,'BA'),('Caravelas',288,'BA'),('Cardeal da Silva',289,'BA'),('Carinhanha',290,'BA'),('Casa Nova',291,'BA'),('Castro Alves',292,'BA'),('Catolândia',293,'BA'),('Catu',294,'BA'),('Caturama',295,'BA'),('Central',296,'BA'),('Chorrochó',297,'BA'),('Cícero Dantas',298,'BA'),('Cipó',299,'BA'),('Coaraci',300,'BA'),('Cocos',301,'BA'),('Conceição da Feira',302,'BA'),('Conceição do Almeida',303,'BA'),('Conceição do Coité',304,'BA'),('Conceição do Jacuípe',305,'BA'),('Conde',306,'BA'),('Condeúba',307,'BA'),('Contendas do Sincorá',308,'BA'),('Coração de Maria',309,'BA'),('Cordeiros',310,'BA'),('Coribe',311,'BA'),('Coronel João Sá',312,'BA'),('Correntina',313,'BA'),('Cotegipe',314,'BA'),('Cravolândia',315,'BA'),('Crisópolis',316,'BA'),('Cristópolis',317,'BA'),('Cruz das Almas',318,'BA'),('Curaçá',319,'BA'),('Dário Meira',320,'BA'),('Dias d`Ávila',321,'BA'),('Dom Basílio',322,'BA'),('Dom Macedo Costa',323,'BA'),('Elísio Medrado',324,'BA'),('Encruzilhada',325,'BA'),('Entre Rios',326,'BA'),('Érico Cardoso',327,'BA'),('Esplanada',328,'BA'),('Euclides da Cunha',329,'BA'),('Eunápolis',330,'BA'),('Fátima',331,'BA'),('Feira da Mata',332,'BA'),('Feira de Santana',333,'BA'),('Filadélfia',334,'BA'),('Firmino Alves',335,'BA'),('Floresta Azul',336,'BA'),('Formosa do Rio Preto',337,'BA'),('Gandu',338,'BA'),('Gavião',339,'BA'),('Gentio do Ouro',340,'BA'),('Glória',341,'BA'),('Gongogi',342,'BA'),('Governador Mangabeira',343,'BA'),('Guajeru',344,'BA'),('Guanambi',345,'BA'),('Guaratinga',346,'BA'),('Heliópolis',347,'BA'),('Iaçu',348,'BA'),('Ibiassucê',349,'BA'),('Ibicaraí',350,'BA'),('Ibicoara',351,'BA'),('Ibicuí',352,'BA'),('Ibipeba',353,'BA'),('Ibipitanga',354,'BA'),('Ibiquera',355,'BA'),('Ibirapitanga',356,'BA'),('Ibirapuã',357,'BA'),('Ibirataia',358,'BA'),('Ibitiara',359,'BA'),('Ibititá',360,'BA'),('Ibotirama',361,'BA'),('Ichu',362,'BA'),('Igaporã',363,'BA'),('Igrapiúna',364,'BA'),('Iguaí',365,'BA'),('Ilhéus',366,'BA'),('Inhambupe',367,'BA'),('Ipecaetá',368,'BA'),('Ipiaú',369,'BA'),('Ipirá',370,'BA'),('Ipupiara',371,'BA'),('Irajuba',372,'BA'),('Iramaia',373,'BA'),('Iraquara',374,'BA'),('Irará',375,'BA'),('Irecê',376,'BA'),('Itabela',377,'BA'),('Itaberaba',378,'BA'),('Itabuna',379,'BA'),('Itacaré',380,'BA'),('Itaeté',381,'BA'),('Itagi',382,'BA'),('Itagibá',383,'BA'),('Itagimirim',384,'BA'),('Itaguaçu da Bahia',385,'BA'),('Itaju do Colônia',386,'BA'),('Itajuípe',387,'BA'),('Itamaraju',388,'BA'),('Itamari',389,'BA'),('Itambé',390,'BA'),('Itanagra',391,'BA'),('Itanhém',392,'BA'),('Itaparica',393,'BA'),('Itapé',394,'BA'),('Itapebi',395,'BA'),('Itapetinga',396,'BA'),('Itapicuru',397,'BA'),('Itapitanga',398,'BA'),('Itaquara',399,'BA'),('Itarantim',400,'BA'),('Itatim',401,'BA'),('Itiruçu',402,'BA'),('Itiúba',403,'BA'),('Itororó',404,'BA'),('Ituaçu',405,'BA'),('Ituberá',406,'BA'),('Iuiú',407,'BA'),('Jaborandi',408,'BA'),('Jacaraci',409,'BA'),('Jacobina',410,'BA'),('Jaguaquara',411,'BA'),('Jaguarari',412,'BA'),('Jaguaripe',413,'BA'),('Jandaíra',414,'BA'),('Jequié',415,'BA'),('Jeremoabo',416,'BA'),('Jiquiriçá',417,'BA'),('Jitaúna',418,'BA'),('João Dourado',419,'BA'),('Juazeiro',420,'BA'),('Jucuruçu',421,'BA'),('Jussara',422,'BA'),('Jussari',423,'BA'),('Jussiape',424,'BA'),('Lafaiete Coutinho',425,'BA'),('Lagoa Real',426,'BA'),('Laje',427,'BA'),('Lajedão',428,'BA'),('Lajedinho',429,'BA'),('Lajedo do Tabocal',430,'BA'),('Lamarão',431,'BA'),('Lapão',432,'BA'),('Lauro de Freitas',433,'BA'),('Lençóis',434,'BA'),('Licínio de Almeida',435,'BA'),('Livramento de Nossa Senhora',436,'BA'),('Luís Eduardo Magalhães',437,'BA'),('Macajuba',438,'BA'),('Macarani',439,'BA'),('Macaúbas',440,'BA'),('Macururé',441,'BA'),('Madre de Deus',442,'BA'),('Maetinga',443,'BA'),('Maiquinique',444,'BA'),('Mairi',445,'BA'),('Malhada',446,'BA'),('Malhada de Pedras',447,'BA'),('Manoel Vitorino',448,'BA'),('Mansidão',449,'BA'),('Maracás',450,'BA'),('Maragogipe',451,'BA'),('Maraú',452,'BA'),('Marcionílio Souza',453,'BA'),('Mascote',454,'BA'),('Mata de São João',455,'BA'),('Matina',456,'BA'),('Medeiros Neto',457,'BA'),('Miguel Calmon',458,'BA'),('Milagres',459,'BA'),('Mirangaba',460,'BA'),('Mirante',461,'BA'),('Monte Santo',462,'BA'),('Morpará',463,'BA'),('Morro do Chapéu',464,'BA'),('Mortugaba',465,'BA'),('Mucugê',466,'BA'),('Mucuri',467,'BA'),('Mulungu do Morro',468,'BA'),('Mundo Novo',469,'BA'),('Muniz Ferreira',470,'BA'),('Muquém de São Francisco',471,'BA'),('Muritiba',472,'BA'),('Mutuípe',473,'BA'),('Nazaré',474,'BA'),('Nilo Peçanha',475,'BA'),('Nordestina',476,'BA'),('Nova Canaã',477,'BA'),('Nova Fátima',478,'BA'),('Nova Ibiá',479,'BA'),('Nova Itarana',480,'BA'),('Nova Redenção',481,'BA'),('Nova Soure',482,'BA'),('Nova Viçosa',483,'BA'),('Novo Horizonte',484,'BA'),('Novo Triunfo',485,'BA'),('Olindina',486,'BA'),('Oliveira dos Brejinhos',487,'BA'),('Ouriçangas',488,'BA'),('Ourolândia',489,'BA'),('Palmas de Monte Alto',490,'BA'),('Palmeiras',491,'BA'),('Paramirim',492,'BA'),('Paratinga',493,'BA'),('Paripiranga',494,'BA'),('Pau Brasil',495,'BA'),('Paulo Afonso',496,'BA'),('Pé de Serra',497,'BA'),('Pedrão',498,'BA'),('Pedro Alexandre',499,'BA'),('Piatã',500,'BA'),('Pilão Arcado',501,'BA'),('Pindaí',502,'BA'),('Pindobaçu',503,'BA'),('Pintadas',504,'BA'),('Piraí do Norte',505,'BA'),('Piripá',506,'BA'),('Piritiba',507,'BA'),('Planaltino',508,'BA'),('Planalto',509,'BA'),('Poções',510,'BA'),('Pojuca',511,'BA'),('Ponto Novo',512,'BA'),('Porto Seguro',513,'BA'),('Potiraguá',514,'BA'),('Prado',515,'BA'),('Presidente Dutra',516,'BA'),('Presidente Jânio Quadros',517,'BA'),('Presidente Tancredo Neves',518,'BA'),('Queimadas',519,'BA'),('Quijingue',520,'BA'),('Quixabeira',521,'BA'),('Rafael Jambeiro',522,'BA'),('Remanso',523,'BA'),('Retirolândia',524,'BA'),('Riachão das Neves',525,'BA'),('Riachão do Jacuípe',526,'BA'),('Riacho de Santana',527,'BA'),('Ribeira do Amparo',528,'BA'),('Ribeira do Pombal',529,'BA'),('Ribeirão do Largo',530,'BA'),('Rio de Contas',531,'BA'),('Rio do Antônio',532,'BA'),('Rio do Pires',533,'BA'),('Rio Real',534,'BA'),('Rodelas',535,'BA'),('Ruy Barbosa',536,'BA'),('Salinas da Margarida',537,'BA'),('Salvador',538,'BA'),('Santa Bárbara',539,'BA'),('Santa Brígida',540,'BA'),('Santa Cruz Cabrália',541,'BA'),('Santa Cruz da Vitória',542,'BA'),('Santa Inês',543,'BA'),('Santa Luzia',544,'BA'),('Santa Maria da Vitória',545,'BA'),('Santa Rita de Cássia',546,'BA'),('Santa Teresinha',547,'BA'),('Santaluz',548,'BA'),('Santana',549,'BA'),('Santanópolis',550,'BA'),('Santo Amaro',551,'BA'),('Santo Antônio de Jesus',552,'BA'),('Santo Estêvão',553,'BA'),('São Desidério',554,'BA'),('São Domingos',555,'BA'),('São Felipe',556,'BA'),('São Félix',557,'BA'),('São Félix do Coribe',558,'BA'),('São Francisco do Conde',559,'BA'),('São Gabriel',560,'BA'),('São Gonçalo dos Campos',561,'BA'),('São José da Vitória',562,'BA'),('São José do Jacuípe',563,'BA'),('São Miguel das Matas',564,'BA'),('São Sebastião do Passé',565,'BA'),('Sapeaçu',566,'BA'),('Sátiro Dias',567,'BA'),('Saubara',568,'BA'),('Saúde',569,'BA'),('Seabra',570,'BA'),('Sebastião Laranjeiras',571,'BA'),('Senhor do Bonfim',572,'BA'),('Sento Sé',573,'BA'),('Serra do Ramalho',574,'BA'),('Serra Dourada',575,'BA'),('Serra Preta',576,'BA'),('Serrinha',577,'BA'),('Serrolândia',578,'BA'),('Simões Filho',579,'BA'),('Sítio do Mato',580,'BA'),('Sítio do Quinto',581,'BA'),('Sobradinho',582,'BA'),('Souto Soares',583,'BA'),('Tabocas do Brejo Velho',584,'BA'),('Tanhaçu',585,'BA'),('Tanque Novo',586,'BA'),('Tanquinho',587,'BA'),('Taperoá',588,'BA'),('Tapiramutá',589,'BA'),('Teixeira de Freitas',590,'BA'),('Teodoro Sampaio',591,'BA'),('Teofilândia',592,'BA'),('Teolândia',593,'BA'),('Terra Nova',594,'BA'),('Tremedal',595,'BA'),('Tucano',596,'BA'),('Uauá',597,'BA'),('Ubaíra',598,'BA'),('Ubaitaba',599,'BA'),('Ubatã',600,'BA'),('Uibaí',601,'BA'),('Umburanas',602,'BA'),('Una',603,'BA'),('Urandi',604,'BA'),('Uruçuca',605,'BA'),('Utinga',606,'BA'),('Valença',607,'BA'),('Valente',608,'BA'),('Várzea da Roça',609,'BA'),('Várzea do Poço',610,'BA'),('Várzea Nova',611,'BA'),('Varzedo',612,'BA'),('Vera Cruz',613,'BA'),('Vereda',614,'BA'),('Vitória da Conquista',615,'BA'),('Wagner',616,'BA'),('Wanderley',617,'BA'),('Wenceslau Guimarães',618,'BA'),('Xique -Xique',619,'BA'),('Abaiara',620,'CE'),('Acarape',621,'CE'),('Acaraú',622,'CE'),('Acopiara',623,'CE'),('Aiuaba',624,'CE'),('Alcântaras',625,'CE'),('Altaneira',626,'CE'),('Alto Santo',627,'CE'),('Amontada',628,'CE'),('Antonina do Norte',629,'CE'),('Apuiarés',630,'CE'),('Aquiraz',631,'CE'),('Aracati',632,'CE'),('Aracoiaba',633,'CE'),('Ararendá',634,'CE'),('Araripe',635,'CE'),('Aratuba',636,'CE'),('Arneiroz',637,'CE'),('Assaré',638,'CE'),('Aurora',639,'CE'),('Baixio',640,'CE'),('Banabuiú',641,'CE'),('Barbalha',642,'CE'),('Barreira',643,'CE'),('Barro',644,'CE'),('Barroquinha',645,'CE'),('Baturité',646,'CE'),('Beberibe',647,'CE'),('Bela Cruz',648,'CE'),('Boa Viagem',649,'CE'),('Brejo Santo',650,'CE'),('Camocim',651,'CE'),('Campos Sales',652,'CE'),('Canindé',653,'CE'),('Capistrano',654,'CE'),('Caridade',655,'CE'),('Cariré',656,'CE'),('Caririaçu',657,'CE'),('Cariús',658,'CE'),('Carnaubal',659,'CE'),('Cascavel',660,'CE'),('Catarina',661,'CE'),('Catunda',662,'CE'),('Caucaia',663,'CE'),('Cedro',664,'CE'),('Chaval',665,'CE'),('Choró',666,'CE'),('Chorozinho',667,'CE'),('Coreaú',668,'CE'),('Crateús',669,'CE'),('Crato',670,'CE'),('Croatá',671,'CE'),('Cruz',672,'CE'),('Deputado Irapuan Pinheiro',673,'CE'),('Ererê',674,'CE'),('Eusébio',675,'CE'),('Farias Brito',676,'CE'),('Forquilha',677,'CE'),('Fortaleza',678,'CE'),('Fortim',679,'CE'),('Frecheirinha',680,'CE'),('General Sampaio',681,'CE'),('Graça',682,'CE'),('Granja',683,'CE'),('Granjeiro',684,'CE'),('Groaíras',685,'CE'),('Guaiúba',686,'CE'),('Guaraciaba do Norte',687,'CE'),('Guaramiranga',688,'CE'),('Hidrolândia',689,'CE'),('Horizonte',690,'CE'),('Ibaretama',691,'CE'),('Ibiapina',692,'CE'),('Ibicuitinga',693,'CE'),('Icapuí',694,'CE'),('Icó',695,'CE'),('Iguatu',696,'CE'),('Independência',697,'CE'),('Ipaporanga',698,'CE'),('Ipaumirim',699,'CE'),('Ipu',700,'CE'),('Ipueiras',701,'CE'),('Iracema',702,'CE'),('Irauçuba',703,'CE'),('Itaiçaba',704,'CE'),('Itaitinga',705,'CE'),('Itapagé',706,'CE'),('Itapipoca',707,'CE'),('Itapiúna',708,'CE'),('Itarema',709,'CE'),('Itatira',710,'CE'),('Jaguaretama',711,'CE'),('Jaguaribara',712,'CE'),('Jaguaribe',713,'CE'),('Jaguaruana',714,'CE'),('Jardim',715,'CE'),('Jati',716,'CE'),('Jijoca de Jericoacoara',717,'CE'),('Juazeiro do Norte',718,'CE'),('Jucás',719,'CE'),('Lavras da Mangabeira',720,'CE'),('Limoeiro do Norte',721,'CE'),('Madalena',722,'CE'),('Maracanaú',723,'CE'),('Maranguape',724,'CE'),('Marco',725,'CE'),('Martinópole',726,'CE'),('Massapê',727,'CE'),('Mauriti',728,'CE'),('Meruoca',729,'CE'),('Milagres',730,'CE'),('Milhã',731,'CE'),('Miraíma',732,'CE'),('Missão Velha',733,'CE'),('Mombaça',734,'CE'),('Monsenhor Tabosa',735,'CE'),('Morada Nova',736,'CE'),('Moraújo',737,'CE'),('Morrinhos',738,'CE'),('Mucambo',739,'CE'),('Mulungu',740,'CE'),('Nova Olinda',741,'CE'),('Nova Russas',742,'CE'),('Novo Oriente',743,'CE'),('Ocara',744,'CE'),('Orós',745,'CE'),('Pacajus',746,'CE'),('Pacatuba',747,'CE'),('Pacoti',748,'CE'),('Pacujá',749,'CE'),('Palhano',750,'CE'),('Palmácia',751,'CE'),('Paracuru',752,'CE'),('Paraipaba',753,'CE'),('Parambu',754,'CE'),('Paramoti',755,'CE'),('Pedra Branca',756,'CE'),('Penaforte',757,'CE'),('Pentecoste',758,'CE'),('Pereiro',759,'CE'),('Pindoretama',760,'CE'),('Piquet Carneiro',761,'CE'),('Pires Ferreira',762,'CE'),('Poranga',763,'CE'),('Porteiras',764,'CE'),('Potengi',765,'CE'),('Potiretama',766,'CE'),('Quiterianópolis',767,'CE'),('Quixadá',768,'CE'),('Quixelô',769,'CE'),('Quixeramobim',770,'CE'),('Quixeré',771,'CE'),('Redenção',772,'CE'),('Reriutaba',773,'CE'),('Russas',774,'CE'),('Saboeiro',775,'CE'),('Salitre',776,'CE'),('Santa Quitéria',777,'CE'),('Santana do Acaraú',778,'CE'),('Santana do Cariri',779,'CE'),('São Benedito',780,'CE'),('São Gonçalo do Amarante',781,'CE'),('São João do Jaguaribe',782,'CE'),('São Luís do Curu',783,'CE'),('Senador Pompeu',784,'CE'),('Senador Sá',785,'CE'),('Sobral',786,'CE'),('Solonópole',787,'CE'),('Tabuleiro do Norte',788,'CE'),('Tamboril',789,'CE'),('Tarrafas',790,'CE'),('Tauá',791,'CE'),('Tejuçuoca',792,'CE'),('Tianguá',793,'CE'),('Trairi',794,'CE'),('Tururu',795,'CE'),('Ubajara',796,'CE'),('Umari',797,'CE'),('Umirim',798,'CE'),('Uruburetama',799,'CE'),('Uruoca',800,'CE'),('Varjota',801,'CE'),('Várzea Alegre',802,'CE'),('Viçosa do Ceará',803,'CE'),('Brasília',804,'DF'),('Afonso Cláudio',805,'ES'),('Água Doce do Norte',806,'ES'),('Águia Branca',807,'ES'),('Alegre',808,'ES'),('Alfredo Chaves',809,'ES'),('Alto Rio Novo',810,'ES'),('Anchieta',811,'ES'),('Apiacá',812,'ES'),('Aracruz',813,'ES'),('Atilio Vivacqua',814,'ES'),('Baixo Guandu',815,'ES'),('Barra de São Francisco',816,'ES'),('Boa Esperança',817,'ES'),('Bom Jesus do Norte',818,'ES'),('Brejetuba',819,'ES'),('Cachoeiro de Itapemirim',820,'ES'),('Cariacica',821,'ES'),('Castelo',822,'ES'),('Colatina',823,'ES'),('Conceição da Barra',824,'ES'),('Conceição do Castelo',825,'ES'),('Divino de São Lourenço',826,'ES'),('Domingos Martins',827,'ES'),('Dores do Rio Preto',828,'ES'),('Ecoporanga',829,'ES'),('Fundão',830,'ES'),('Governador Lindenberg',831,'ES'),('Guaçuí',832,'ES'),('Guarapari',833,'ES'),('Ibatiba',834,'ES'),('Ibiraçu',835,'ES'),('Ibitirama',836,'ES'),('Iconha',837,'ES'),('Irupi',838,'ES'),('Itaguaçu',839,'ES'),('Itapemirim',840,'ES'),('Itarana',841,'ES'),('Iúna',842,'ES'),('Jaguaré',843,'ES'),('Jerônimo Monteiro',844,'ES'),('João Neiva',845,'ES'),('Laranja da Terra',846,'ES'),('Linhares',847,'ES'),('Mantenópolis',848,'ES'),('Marataízes',849,'ES'),('Marechal Floriano',850,'ES'),('Marilândia',851,'ES'),('Mimoso do Sul',852,'ES'),('Montanha',853,'ES'),('Mucurici',854,'ES'),('Muniz Freire',855,'ES'),('Muqui',856,'ES'),('Nova Venécia',857,'ES'),('Pancas',858,'ES'),('Pedro Canário',859,'ES'),('Pinheiros',860,'ES'),('Piúma',861,'ES'),('Ponto Belo',862,'ES'),('Presidente Kennedy',863,'ES'),('Rio Bananal',864,'ES'),('Rio Novo do Sul',865,'ES'),('Santa Leopoldina',866,'ES'),('Santa Maria de Jetibá',867,'ES'),('Santa Teresa',868,'ES'),('São Domingos do Norte',869,'ES'),('São Gabriel da Palha',870,'ES'),('São José do Calçado',871,'ES'),('São Mateus',872,'ES'),('São Roque do Canaã',873,'ES'),('Serra',874,'ES'),('Sooretama',875,'ES'),('Vargem Alta',876,'ES'),('Venda Nova do Imigrante',877,'ES'),('Viana',878,'ES'),('Vila Pavão',879,'ES'),('Vila Valério',880,'ES'),('Vila Velha',881,'ES'),('Vitória',882,'ES'),('Abadia de Goiás',883,'GO'),('Abadiânia',884,'GO'),('Acreúna',885,'GO'),('Adelândia',886,'GO'),('Água Fria de Goiás',887,'GO'),('Água Limpa',888,'GO'),('Águas Lindas de Goiás',889,'GO'),('Alexânia',890,'GO'),('Aloândia',891,'GO'),('Alto Horizonte',892,'GO'),('Alto Paraíso de Goiás',893,'GO'),('Alvorada do Norte',894,'GO'),('Amaralina',895,'GO'),('Americano do Brasil',896,'GO'),('Amorinópolis',897,'GO'),('Anápolis',898,'GO'),('Anhanguera',899,'GO'),('Anicuns',900,'GO'),('Aparecida de Goiânia',901,'GO'),('Aparecida do Rio Doce',902,'GO'),('Aporé',903,'GO'),('Araçu',904,'GO'),('Aragarças',905,'GO'),('Aragoiânia',906,'GO'),('Araguapaz',907,'GO'),('Arenópolis',908,'GO'),('Aruanã',909,'GO'),('Aurilândia',910,'GO'),('Avelinópolis',911,'GO'),('Baliza',912,'GO'),('Barro Alto',913,'GO'),('Bela Vista de Goiás',914,'GO'),('Bom Jardim de Goiás',915,'GO'),('Bom Jesus de Goiás',916,'GO'),('Bonfinópolis',917,'GO'),('Bonópolis',918,'GO'),('Brazabrantes',919,'GO'),('Britânia',920,'GO'),('Buriti Alegre',921,'GO'),('Buriti de Goiás',922,'GO'),('Buritinópolis',923,'GO'),('Cabeceiras',924,'GO'),('Cachoeira Alta',925,'GO'),('Cachoeira de Goiás',926,'GO'),('Cachoeira Dourada',927,'GO'),('Caçu',928,'GO'),('Caiapônia',929,'GO'),('Caldas Novas',930,'GO'),('Caldazinha',931,'GO'),('Campestre de Goiás',932,'GO'),('Campinaçu',933,'GO'),('Campinorte',934,'GO'),('Campo Alegre de Goiás',935,'GO'),('Campo Limpo de Goiás',936,'GO'),('Campos Belos',937,'GO'),('Campos Verdes',938,'GO'),('Carmo do Rio Verde',939,'GO'),('Castelândia',940,'GO'),('Catalão',941,'GO'),('Caturaí',942,'GO'),('Cavalcante',943,'GO'),('Ceres',944,'GO'),('Cezarina',945,'GO'),('Chapadão do Céu',946,'GO'),('Cidade Ocidental',947,'GO'),('Cocalzinho de Goiás',948,'GO'),('Colinas do Sul',949,'GO'),('Córrego do Ouro',950,'GO'),('Corumbá de Goiás',951,'GO'),('Corumbaíba',952,'GO'),('Cristalina',953,'GO'),('Cristianópolis',954,'GO'),('Crixás',955,'GO'),('Cromínia',956,'GO'),('Cumari',957,'GO'),('Damianópolis',958,'GO'),('Damolândia',959,'GO'),('Davinópolis',960,'GO'),('Diorama',961,'GO'),('Divinópolis de Goiás',962,'GO'),('Doverlândia',963,'GO'),('Edealina',964,'GO'),('Edéia',965,'GO'),('Estrela do Norte',966,'GO'),('Faina',967,'GO'),('Fazenda Nova',968,'GO'),('Firminópolis',969,'GO'),('Flores de Goiás',970,'GO'),('Formosa',971,'GO'),('Formoso',972,'GO'),('Gameleira de Goiás',973,'GO'),('Goianápolis',974,'GO'),('Goiandira',975,'GO'),('Goianésia',976,'GO'),('Goiânia',977,'GO'),('Goianira',978,'GO'),('Goiás',979,'GO'),('Goiatuba',980,'GO'),('Gouvelândia',981,'GO'),('Guapó',982,'GO'),('Guaraíta',983,'GO'),('Guarani de Goiás',984,'GO'),('Guarinos',985,'GO'),('Heitoraí',986,'GO'),('Hidrolândia',987,'GO'),('Hidrolina',988,'GO'),('Iaciara',989,'GO'),('Inaciolândia',990,'GO'),('Indiara',991,'GO'),('Inhumas',992,'GO'),('Ipameri',993,'GO'),('Ipiranga de Goiás',994,'GO'),('Iporá',995,'GO'),('Israelândia',996,'GO'),('Itaberaí',997,'GO'),('Itaguari',998,'GO'),('Itaguaru',999,'GO'),('Itajá',1000,'GO'),('Itapaci',1001,'GO'),('Itapirapuã',1002,'GO'),('Itapuranga',1003,'GO'),('Itarumã',1004,'GO'),('Itauçu',1005,'GO'),('Itumbiara',1006,'GO'),('Ivolândia',1007,'GO'),('Jandaia',1008,'GO'),('Jaraguá',1009,'GO'),('Jataí',1010,'GO'),('Jaupaci',1011,'GO'),('Jesúpolis',1012,'GO'),('Joviânia',1013,'GO'),('Jussara',1014,'GO'),('Lagoa Santa',1015,'GO'),('Leopoldo de Bulhões',1016,'GO'),('Luziânia',1017,'GO'),('Mairipotaba',1018,'GO'),('Mambaí',1019,'GO'),('Mara Rosa',1020,'GO'),('Marzagão',1021,'GO'),('Matrinchã',1022,'GO'),('Maurilândia',1023,'GO'),('Mimoso de Goiás',1024,'GO'),('Minaçu',1025,'GO'),('Mineiros',1026,'GO'),('Moiporá',1027,'GO'),('Monte Alegre de Goiás',1028,'GO'),('Montes Claros de Goiás',1029,'GO'),('Montividiu',1030,'GO'),('Montividiu do Norte',1031,'GO'),('Morrinhos',1032,'GO'),('Morro Agudo de Goiás',1033,'GO'),('Mossâmedes',1034,'GO'),('Mozarlândia',1035,'GO'),('Mundo Novo',1036,'GO'),('Mutunópolis',1037,'GO'),('Nazário',1038,'GO'),('Nerópolis',1039,'GO'),('Niquelândia',1040,'GO'),('Nova América',1041,'GO'),('Nova Aurora',1042,'GO'),('Nova Crixás',1043,'GO'),('Nova Glória',1044,'GO'),('Nova Iguaçu de Goiás',1045,'GO'),('Nova Roma',1046,'GO'),('Nova Veneza',1047,'GO'),('Novo Brasil',1048,'GO'),('Novo Gama',1049,'GO'),('Novo Planalto',1050,'GO'),('Orizona',1051,'GO'),('Ouro Verde de Goiás',1052,'GO'),('Ouvidor',1053,'GO'),('Padre Bernardo',1054,'GO'),('Palestina de Goiás',1055,'GO'),('Palmeiras de Goiás',1056,'GO'),('Palmelo',1057,'GO'),('Palminópolis',1058,'GO'),('Panamá',1059,'GO'),('Paranaiguara',1060,'GO'),('Paraúna',1061,'GO'),('Perolândia',1062,'GO'),('Petrolina de Goiás',1063,'GO'),('Pilar de Goiás',1064,'GO'),('Piracanjuba',1065,'GO'),('Piranhas',1066,'GO'),('Pirenópolis',1067,'GO'),('Pires do Rio',1068,'GO'),('Planaltina',1069,'GO'),('Pontalina',1070,'GO'),('Porangatu',1071,'GO'),('Porteirão',1072,'GO'),('Portelândia',1073,'GO'),('Posse',1074,'GO'),('Professor Jamil',1075,'GO'),('Quirinópolis',1076,'GO'),('Rialma',1077,'GO'),('Rianápolis',1078,'GO'),('Rio Quente',1079,'GO'),('Rio Verde',1080,'GO'),('Rubiataba',1081,'GO'),('Sanclerlândia',1082,'GO'),('Santa Bárbara de Goiás',1083,'GO'),('Santa Cruz de Goiás',1084,'GO'),('Santa Fé de Goiás',1085,'GO'),('Santa Helena de Goiás',1086,'GO'),('Santa Isabel',1087,'GO'),('Santa Rita do Araguaia',1088,'GO'),('Santa Rita do Novo Destino',1089,'GO'),('Santa Rosa de Goiás',1090,'GO'),('Santa Tereza de Goiás',1091,'GO'),('Santa Terezinha de Goiás',1092,'GO'),('Santo Antônio da Barra',1093,'GO'),('Santo Antônio de Goiás',1094,'GO'),('Santo Antônio do Descoberto',1095,'GO'),('São Domingos',1096,'GO'),('São Francisco de Goiás',1097,'GO'),('São João d`Aliança',1098,'GO'),('São João da Paraúna',1099,'GO'),('São Luís de Montes Belos',1100,'GO'),('São Luíz do Norte',1101,'GO'),('São Miguel do Araguaia',1102,'GO'),('São Miguel do Passa Quatro',1103,'GO'),('São Patrício',1104,'GO'),('São Simão',1105,'GO'),('Senador Canedo',1106,'GO'),('Serranópolis',1107,'GO'),('Silvânia',1108,'GO'),('Simolândia',1109,'GO'),('Sítio d`Abadia',1110,'GO'),('Taquaral de Goiás',1111,'GO'),('Teresina de Goiás',1112,'GO'),('Terezópolis de Goiás',1113,'GO'),('Três Ranchos',1114,'GO'),('Trindade',1115,'GO'),('Trombas',1116,'GO'),('Turvânia',1117,'GO'),('Turvelândia',1118,'GO'),('Uirapuru',1119,'GO'),('Uruaçu',1120,'GO'),('Uruana',1121,'GO'),('Urutaí',1122,'GO'),('Valparaíso de Goiás',1123,'GO'),('Varjão',1124,'GO'),('Vianópolis',1125,'GO'),('Vicentinópolis',1126,'GO'),('Vila Boa',1127,'GO'),('Vila Propício',1128,'GO'),('Açailândia',1129,'MA'),('Afonso Cunha',1130,'MA'),('Água Doce do Maranhão',1131,'MA'),('Alcântara',1132,'MA'),('Aldeias Altas',1133,'MA'),('Altamira do Maranhão',1134,'MA'),('Alto Alegre do Maranhão',1135,'MA'),('Alto Alegre do Pindaré',1136,'MA'),('Alto Parnaíba',1137,'MA'),('Amapá do Maranhão',1138,'MA'),('Amarante do Maranhão',1139,'MA'),('Anajatuba',1140,'MA'),('Anapurus',1141,'MA'),('Apicum-Açu',1142,'MA'),('Araguanã',1143,'MA'),('Araioses',1144,'MA'),('Arame',1145,'MA'),('Arari',1146,'MA'),('Axixá',1147,'MA'),('Bacabal',1148,'MA'),('Bacabeira',1149,'MA'),('Bacuri',1150,'MA'),('Bacurituba',1151,'MA'),('Balsas',1152,'MA'),('Barão de Grajaú',1153,'MA'),('Barra do Corda',1154,'MA'),('Barreirinhas',1155,'MA'),('Bela Vista do Maranhão',1156,'MA'),('Belágua',1157,'MA'),('Benedito Leite',1158,'MA'),('Bequimão',1159,'MA'),('Bernardo do Mearim',1160,'MA'),('Boa Vista do Gurupi',1161,'MA'),('Bom Jardim',1162,'MA'),('Bom Jesus das Selvas',1163,'MA'),('Bom Lugar',1164,'MA'),('Brejo',1165,'MA'),('Brejo de Areia',1166,'MA'),('Buriti',1167,'MA'),('Buriti Bravo',1168,'MA'),('Buriticupu',1169,'MA'),('Buritirana',1170,'MA'),('Cachoeira Grande',1171,'MA'),('Cajapió',1172,'MA'),('Cajari',1173,'MA'),('Campestre do Maranhão',1174,'MA'),('Cândido Mendes',1175,'MA'),('Cantanhede',1176,'MA'),('Capinzal do Norte',1177,'MA'),('Carolina',1178,'MA'),('Carutapera',1179,'MA'),('Caxias',1180,'MA'),('Cedral',1181,'MA'),('Central do Maranhão',1182,'MA'),('Centro do Guilherme',1183,'MA'),('Centro Novo do Maranhão',1184,'MA'),('Chapadinha',1185,'MA'),('Cidelândia',1186,'MA'),('Codó',1187,'MA'),('Coelho Neto',1188,'MA'),('Colinas',1189,'MA'),('Conceição do Lago-Açu',1190,'MA'),('Coroatá',1191,'MA'),('Cururupu',1192,'MA'),('Davinópolis',1193,'MA'),('Dom Pedro',1194,'MA'),('Duque Bacelar',1195,'MA'),('Esperantinópolis',1196,'MA'),('Estreito',1197,'MA'),('Feira Nova do Maranhão',1198,'MA'),('Fernando Falcão',1199,'MA'),('Formosa da Serra Negra',1200,'MA'),('Fortaleza dos Nogueiras',1201,'MA'),('Fortuna',1202,'MA'),('Godofredo Viana',1203,'MA'),('Gonçalves Dias',1204,'MA'),('Governador Archer',1205,'MA'),('Governador Edison Lobão',1206,'MA'),('Governador Eugênio Barros',1207,'MA'),('Governador Luiz Rocha',1208,'MA'),('Governador Newton Bello',1209,'MA'),('Governador Nunes Freire',1210,'MA'),('Graça Aranha',1211,'MA'),('Grajaú',1212,'MA'),('Guimarães',1213,'MA'),('Humberto de Campos',1214,'MA'),('Icatu',1215,'MA'),('Igarapé do Meio',1216,'MA'),('Igarapé Grande',1217,'MA'),('Imperatriz',1218,'MA'),('Itaipava do Grajaú',1219,'MA'),('Itapecuru Mirim',1220,'MA'),('Itinga do Maranhão',1221,'MA'),('Jatobá',1222,'MA'),('Jenipapo dos Vieiras',1223,'MA'),('João Lisboa',1224,'MA'),('Joselândia',1225,'MA'),('Junco do Maranhão',1226,'MA'),('Lago da Pedra',1227,'MA'),('Lago do Junco',1228,'MA'),('Lago dos Rodrigues',1229,'MA'),('Lago Verde',1230,'MA'),('Lagoa do Mato',1231,'MA'),('Lagoa Grande do Maranhão',1232,'MA'),('Lajeado Novo',1233,'MA'),('Lima Campos',1234,'MA'),('Loreto',1235,'MA'),('Luís Domingues',1236,'MA'),('Magalhães de Almeida',1237,'MA'),('Maracaçumé',1238,'MA'),('Marajá do Sena',1239,'MA'),('Maranhãozinho',1240,'MA'),('Mata Roma',1241,'MA'),('Matinha',1242,'MA'),('Matões',1243,'MA'),('Matões do Norte',1244,'MA'),('Milagres do Maranhão',1245,'MA'),('Mirador',1246,'MA'),('Miranda do Norte',1247,'MA'),('Mirinzal',1248,'MA'),('Monção',1249,'MA'),('Montes Altos',1250,'MA'),('Morros',1251,'MA'),('Nina Rodrigues',1252,'MA'),('Nova Colinas',1253,'MA'),('Nova Iorque',1254,'MA'),('Nova Olinda do Maranhão',1255,'MA'),('Olho d`Água das Cunhãs',1256,'MA'),('Olinda Nova do Maranhão',1257,'MA'),('Paço do Lumiar',1258,'MA'),('Palmeirândia',1259,'MA'),('Paraibano',1260,'MA'),('Parnarama',1261,'MA'),('Passagem Franca',1262,'MA'),('Pastos Bons',1263,'MA'),('Paulino Neves',1264,'MA'),('Paulo Ramos',1265,'MA'),('Pedreiras',1266,'MA'),('Pedro do Rosário',1267,'MA'),('Penalva',1268,'MA'),('Peri Mirim',1269,'MA'),('Peritoró',1270,'MA'),('Pindaré-Mirim',1271,'MA'),('Pinheiro',1272,'MA'),('Pio XII',1273,'MA'),('Pirapemas',1274,'MA'),('Poção de Pedras',1275,'MA'),('Porto Franco',1276,'MA'),('Porto Rico do Maranhão',1277,'MA'),('Presidente Dutra',1278,'MA'),('Presidente Juscelino',1279,'MA'),('Presidente Médici',1280,'MA'),('Presidente Sarney',1281,'MA'),('Presidente Vargas',1282,'MA'),('Primeira Cruz',1283,'MA'),('Raposa',1284,'MA'),('Riachão',1285,'MA'),('Ribamar Fiquene',1286,'MA'),('Rosário',1287,'MA'),('Sambaíba',1288,'MA'),('Santa Filomena do Maranhão',1289,'MA'),('Santa Helena',1290,'MA'),('Santa Inês',1291,'MA'),('Santa Luzia',1292,'MA'),('Santa Luzia do Paruá',1293,'MA'),('Santa Quitéria do Maranhão',1294,'MA'),('Santa Rita',1295,'MA'),('Santana do Maranhão',1296,'MA'),('Santo Amaro do Maranhão',1297,'MA'),('Santo Antônio dos Lopes',1298,'MA'),('São Benedito do Rio Preto',1299,'MA'),('São Bento',1300,'MA'),('São Bernardo',1301,'MA'),('São Domingos do Azeitão',1302,'MA'),('São Domingos do Maranhão',1303,'MA'),('São Félix de Balsas',1304,'MA'),('São Francisco do Brejão',1305,'MA'),('São Francisco do Maranhão',1306,'MA'),('São João Batista',1307,'MA'),('São João do Carú',1308,'MA'),('São João do Paraíso',1309,'MA'),('São João do Soter',1310,'MA'),('São João dos Patos',1311,'MA'),('São José de Ribamar',1312,'MA'),('São José dos Basílios',1313,'MA'),('São Luís',1314,'MA'),('São Luís Gonzaga do Maranhão',1315,'MA'),('São Mateus do Maranhão',1316,'MA'),('São Pedro da Água Branca',1317,'MA'),('São Pedro dos Crentes',1318,'MA'),('São Raimundo das Mangabeiras',1319,'MA'),('São Raimundo do Doca Bezerra',1320,'MA'),('São Roberto',1321,'MA'),('São Vicente Ferrer',1322,'MA'),('Satubinha',1323,'MA'),('Senador Alexandre Costa',1324,'MA'),('Senador La Rocque',1325,'MA'),('Serrano do Maranhão',1326,'MA'),('Sítio Novo',1327,'MA'),('Sucupira do Norte',1328,'MA'),('Sucupira do Riachão',1329,'MA'),('Tasso Fragoso',1330,'MA'),('Timbiras',1331,'MA'),('Timon',1332,'MA'),('Trizidela do Vale',1333,'MA'),('Tufilândia',1334,'MA'),('Tuntum',1335,'MA'),('Turiaçu',1336,'MA'),('Turilândia',1337,'MA'),('Tutóia',1338,'MA'),('Urbano Santos',1339,'MA'),('Vargem Grande',1340,'MA'),('Viana',1341,'MA'),('Vila Nova dos Martírios',1342,'MA'),('Vitória do Mearim',1343,'MA'),('Vitorino Freire',1344,'MA'),('Zé Doca',1345,'MA'),('Abadia dos Dourados',1346,'MG'),('Abaeté',1347,'MG'),('Abre Campo',1348,'MG'),('Acaiaca',1349,'MG'),('Açucena',1350,'MG'),('Água Boa',1351,'MG'),('Água Comprida',1352,'MG'),('Aguanil',1353,'MG'),('Águas Formosas',1354,'MG'),('Águas Vermelhas',1355,'MG'),('Aimorés',1356,'MG'),('Aiuruoca',1357,'MG'),('Alagoa',1358,'MG'),('Albertina',1359,'MG'),('Além Paraíba',1360,'MG'),('Alfenas',1361,'MG'),('Alfredo Vasconcelos',1362,'MG'),('Almenara',1363,'MG'),('Alpercata',1364,'MG'),('Alpinópolis',1365,'MG'),('Alterosa',1366,'MG'),('Alto Caparaó',1367,'MG'),('Alto Jequitibá',1368,'MG'),('Alto Rio Doce',1369,'MG'),('Alvarenga',1370,'MG'),('Alvinópolis',1371,'MG'),('Alvorada de Minas',1372,'MG'),('Amparo do Serra',1373,'MG'),('Andradas',1374,'MG'),('Andrelândia',1375,'MG'),('Angelândia',1376,'MG'),('Antônio Carlos',1377,'MG'),('Antônio Dias',1378,'MG'),('Antônio Prado de Minas',1379,'MG'),('Araçaí',1380,'MG'),('Aracitaba',1381,'MG'),('Araçuaí',1382,'MG'),('Araguari',1383,'MG'),('Arantina',1384,'MG'),('Araponga',1385,'MG'),('Araporã',1386,'MG'),('Arapuá',1387,'MG'),('Araújos',1388,'MG'),('Araxá',1389,'MG'),('Arceburgo',1390,'MG'),('Arcos',1391,'MG'),('Areado',1392,'MG'),('Argirita',1393,'MG'),('Aricanduva',1394,'MG'),('Arinos',1395,'MG'),('Astolfo Dutra',1396,'MG'),('Ataléia',1397,'MG'),('Augusto de Lima',1398,'MG'),('Baependi',1399,'MG'),('Baldim',1400,'MG'),('Bambuí',1401,'MG'),('Bandeira',1402,'MG'),('Bandeira do Sul',1403,'MG'),('Barão de Cocais',1404,'MG'),('Barão de Monte Alto',1405,'MG'),('Barbacena',1406,'MG'),('Barra Longa',1407,'MG'),('Barroso',1408,'MG'),('Bela Vista de Minas',1409,'MG'),('Belmiro Braga',1410,'MG'),('Belo Horizonte',1411,'MG'),('Belo Oriente',1412,'MG'),('Belo Vale',1413,'MG'),('Berilo',1414,'MG'),('Berizal',1415,'MG'),('Bertópolis',1416,'MG'),('Betim',1417,'MG'),('Bias Fortes',1418,'MG'),('Bicas',1419,'MG'),('Biquinhas',1420,'MG'),('Boa Esperança',1421,'MG'),('Bocaina de Minas',1422,'MG'),('Bocaiúva',1423,'MG'),('Bom Despacho',1424,'MG'),('Bom Jardim de Minas',1425,'MG'),('Bom Jesus da Penha',1426,'MG'),('Bom Jesus do Amparo',1427,'MG'),('Bom Jesus do Galho',1428,'MG'),('Bom Repouso',1429,'MG'),('Bom Sucesso',1430,'MG'),('Bonfim',1431,'MG'),('Bonfinópolis de Minas',1432,'MG'),('Bonito de Minas',1433,'MG'),('Borda da Mata',1434,'MG'),('Botelhos',1435,'MG'),('Botumirim',1436,'MG'),('Brás Pires',1437,'MG'),('Brasilândia de Minas',1438,'MG'),('Brasília de Minas',1439,'MG'),('Brasópolis',1440,'MG'),('Braúnas',1441,'MG'),('Brumadinho',1442,'MG'),('Bueno Brandão',1443,'MG'),('Buenópolis',1444,'MG'),('Bugre',1445,'MG'),('Buritis',1446,'MG'),('Buritizeiro',1447,'MG'),('Cabeceira Grande',1448,'MG'),('Cabo Verde',1449,'MG'),('Cachoeira da Prata',1450,'MG'),('Cachoeira de Minas',1451,'MG'),('Cachoeira de Pajeú',1452,'MG'),('Cachoeira Dourada',1453,'MG'),('Caetanópolis',1454,'MG'),('Caeté',1455,'MG'),('Caiana',1456,'MG'),('Cajuri',1457,'MG'),('Caldas',1458,'MG'),('Camacho',1459,'MG'),('Camanducaia',1460,'MG'),('Cambuí',1461,'MG'),('Cambuquira',1462,'MG'),('Campanário',1463,'MG'),('Campanha',1464,'MG'),('Campestre',1465,'MG'),('Campina Verde',1466,'MG'),('Campo Azul',1467,'MG'),('Campo Belo',1468,'MG'),('Campo do Meio',1469,'MG'),('Campo Florido',1470,'MG'),('Campos Altos',1471,'MG'),('Campos Gerais',1472,'MG'),('Cana Verde',1473,'MG'),('Canaã',1474,'MG'),('Canápolis',1475,'MG'),('Candeias',1476,'MG'),('Cantagalo',1477,'MG'),('Caparaó',1478,'MG'),('Capela Nova',1479,'MG'),('Capelinha',1480,'MG'),('Capetinga',1481,'MG'),('Capim Branco',1482,'MG'),('Capinópolis',1483,'MG'),('Capitão Andrade',1484,'MG'),('Capitão Enéas',1485,'MG'),('Capitólio',1486,'MG'),('Caputira',1487,'MG'),('Caraí',1488,'MG'),('Caranaíba',1489,'MG'),('Carandaí',1490,'MG'),('Carangola',1491,'MG'),('Caratinga',1492,'MG'),('Carbonita',1493,'MG'),('Careaçu',1494,'MG'),('Carlos Chagas',1495,'MG'),('Carmésia',1496,'MG'),('Carmo da Cachoeira',1497,'MG'),('Carmo da Mata',1498,'MG'),('Carmo de Minas',1499,'MG'),('Carmo do Cajuru',1500,'MG'),('Carmo do Paranaíba',1501,'MG'),('Carmo do Rio Claro',1502,'MG'),('Carmópolis de Minas',1503,'MG'),('Carneirinho',1504,'MG'),('Carrancas',1505,'MG'),('Carvalhópolis',1506,'MG'),('Carvalhos',1507,'MG'),('Casa Grande',1508,'MG'),('Cascalho Rico',1509,'MG'),('Cássia',1510,'MG'),('Cataguases',1511,'MG'),('Catas Altas',1512,'MG'),('Catas Altas da Noruega',1513,'MG'),('Catuji',1514,'MG'),('Catuti',1515,'MG'),('Caxambu',1516,'MG'),('Cedro do Abaeté',1517,'MG'),('Central de Minas',1518,'MG'),('Centralina',1519,'MG'),('Chácara',1520,'MG'),('Chalé',1521,'MG'),('Chapada do Norte',1522,'MG'),('Chapada Gaúcha',1523,'MG'),('Chiador',1524,'MG'),('Cipotânea',1525,'MG'),('Claraval',1526,'MG'),('Claro dos Poções',1527,'MG'),('Cláudio',1528,'MG'),('Coimbra',1529,'MG'),('Coluna',1530,'MG'),('Comendador Gomes',1531,'MG'),('Comercinho',1532,'MG'),('Conceição da Aparecida',1533,'MG'),('Conceição da Barra de Minas',1534,'MG'),('Conceição das Alagoas',1535,'MG'),('Conceição das Pedras',1536,'MG'),('Conceição de Ipanema',1537,'MG'),('Conceição do Mato Dentro',1538,'MG'),('Conceição do Pará',1539,'MG'),('Conceição do Rio Verde',1540,'MG'),('Conceição dos Ouros',1541,'MG'),('Cônego Marinho',1542,'MG'),('Confins',1543,'MG'),('Congonhal',1544,'MG'),('Congonhas',1545,'MG'),('Congonhas do Norte',1546,'MG'),('Conquista',1547,'MG'),('Conselheiro Lafaiete',1548,'MG'),('Conselheiro Pena',1549,'MG'),('Consolação',1550,'MG'),('Contagem',1551,'MG'),('Coqueiral',1552,'MG'),('Coração de Jesus',1553,'MG'),('Cordisburgo',1554,'MG'),('Cordislândia',1555,'MG'),('Corinto',1556,'MG'),('Coroaci',1557,'MG'),('Coromandel',1558,'MG'),('Coronel Fabriciano',1559,'MG'),('Coronel Murta',1560,'MG'),('Coronel Pacheco',1561,'MG'),('Coronel Xavier Chaves',1562,'MG'),('Córrego Danta',1563,'MG'),('Córrego do Bom Jesus',1564,'MG'),('Córrego Fundo',1565,'MG'),('Córrego Novo',1566,'MG'),('Couto de Magalhães de Minas',1567,'MG'),('Crisólita',1568,'MG'),('Cristais',1569,'MG'),('Cristália',1570,'MG'),('Cristiano Otoni',1571,'MG'),('Cristina',1572,'MG'),('Crucilândia',1573,'MG'),('Cruzeiro da Fortaleza',1574,'MG'),('Cruzília',1575,'MG'),('Cuparaque',1576,'MG'),('Curral de Dentro',1577,'MG'),('Curvelo',1578,'MG'),('Datas',1579,'MG'),('Delfim Moreira',1580,'MG'),('Delfinópolis',1581,'MG'),('Delta',1582,'MG'),('Descoberto',1583,'MG'),('Desterro de Entre Rios',1584,'MG'),('Desterro do Melo',1585,'MG'),('Diamantina',1586,'MG'),('Diogo de Vasconcelos',1587,'MG'),('Dionísio',1588,'MG'),('Divinésia',1589,'MG'),('Divino',1590,'MG'),('Divino das Laranjeiras',1591,'MG'),('Divinolândia de Minas',1592,'MG'),('Divinópolis',1593,'MG'),('Divisa Alegre',1594,'MG'),('Divisa Nova',1595,'MG'),('Divisópolis',1596,'MG'),('Dom Bosco',1597,'MG'),('Dom Cavati',1598,'MG'),('Dom Joaquim',1599,'MG'),('Dom Silvério',1600,'MG'),('Dom Viçoso',1601,'MG'),('Dona Eusébia',1602,'MG'),('Dores de Campos',1603,'MG'),('Dores de Guanhães',1604,'MG'),('Dores do Indaiá',1605,'MG'),('Dores do Turvo',1606,'MG'),('Doresópolis',1607,'MG'),('Douradoquara',1608,'MG'),('Durandé',1609,'MG'),('Elói Mendes',1610,'MG'),('Engenheiro Caldas',1611,'MG'),('Engenheiro Navarro',1612,'MG'),('Entre Folhas',1613,'MG'),('Entre Rios de Minas',1614,'MG'),('Ervália',1615,'MG'),('Esmeraldas',1616,'MG'),('Espera Feliz',1617,'MG'),('Espinosa',1618,'MG'),('Espírito Santo do Dourado',1619,'MG'),('Estiva',1620,'MG'),('Estrela Dalva',1621,'MG'),('Estrela do Indaiá',1622,'MG'),('Estrela do Sul',1623,'MG'),('Eugenópolis',1624,'MG'),('Ewbank da Câmara',1625,'MG'),('Extrema',1626,'MG'),('Fama',1627,'MG'),('Faria Lemos',1628,'MG'),('Felício dos Santos',1629,'MG'),('Felisburgo',1630,'MG'),('Felixlândia',1631,'MG'),('Fernandes Tourinho',1632,'MG'),('Ferros',1633,'MG'),('Fervedouro',1634,'MG'),('Florestal',1635,'MG'),('Formiga',1636,'MG'),('Formoso',1637,'MG'),('Fortaleza de Minas',1638,'MG'),('Fortuna de Minas',1639,'MG'),('Francisco Badaró',1640,'MG'),('Francisco Dumont',1641,'MG'),('Francisco Sá',1642,'MG'),('Franciscópolis',1643,'MG'),('Frei Gaspar',1644,'MG'),('Frei Inocêncio',1645,'MG'),('Frei Lagonegro',1646,'MG'),('Fronteira',1647,'MG'),('Fronteira dos Vales',1648,'MG'),('Fruta de Leite',1649,'MG'),('Frutal',1650,'MG'),('Funilândia',1651,'MG'),('Galiléia',1652,'MG'),('Gameleiras',1653,'MG'),('Glaucilândia',1654,'MG'),('Goiabeira',1655,'MG'),('Goianá',1656,'MG'),('Gonçalves',1657,'MG'),('Gonzaga',1658,'MG'),('Gouveia',1659,'MG'),('Governador Valadares',1660,'MG'),('Grão Mogol',1661,'MG'),('Grupiara',1662,'MG'),('Guanhães',1663,'MG'),('Guapé',1664,'MG'),('Guaraciaba',1665,'MG'),('Guaraciama',1666,'MG'),('Guaranésia',1667,'MG'),('Guarani',1668,'MG'),('Guarará',1669,'MG'),('Guarda-Mor',1670,'MG'),('Guaxupé',1671,'MG'),('Guidoval',1672,'MG'),('Guimarânia',1673,'MG'),('Guiricema',1674,'MG'),('Gurinhatã',1675,'MG'),('Heliodora',1676,'MG'),('Iapu',1677,'MG'),('Ibertioga',1678,'MG'),('Ibiá',1679,'MG'),('Ibiaí',1680,'MG'),('Ibiracatu',1681,'MG'),('Ibiraci',1682,'MG'),('Ibirité',1683,'MG'),('Ibitiúra de Minas',1684,'MG'),('Ibituruna',1685,'MG'),('Icaraí de Minas',1686,'MG'),('Igarapé',1687,'MG'),('Igaratinga',1688,'MG'),('Iguatama',1689,'MG'),('Ijaci',1690,'MG'),('Ilicínea',1691,'MG'),('Imbé de Minas',1692,'MG'),('Inconfidentes',1693,'MG'),('Indaiabira',1694,'MG'),('Indianópolis',1695,'MG'),('Ingaí',1696,'MG'),('Inhapim',1697,'MG'),('Inhaúma',1698,'MG'),('Inimutaba',1699,'MG'),('Ipaba',1700,'MG'),('Ipanema',1701,'MG'),('Ipatinga',1702,'MG'),('Ipiaçu',1703,'MG'),('Ipuiúna',1704,'MG'),('Iraí de Minas',1705,'MG'),('Itabira',1706,'MG'),('Itabirinha de Mantena',1707,'MG'),('Itabirito',1708,'MG'),('Itacambira',1709,'MG'),('Itacarambi',1710,'MG'),('Itaguara',1711,'MG'),('Itaipé',1712,'MG'),('Itajubá',1713,'MG'),('Itamarandiba',1714,'MG'),('Itamarati de Minas',1715,'MG'),('Itambacuri',1716,'MG'),('Itambé do Mato Dentro',1717,'MG'),('Itamogi',1718,'MG'),('Itamonte',1719,'MG'),('Itanhandu',1720,'MG'),('Itanhomi',1721,'MG'),('Itaobim',1722,'MG'),('Itapagipe',1723,'MG'),('Itapecerica',1724,'MG'),('Itapeva',1725,'MG'),('Itatiaiuçu',1726,'MG'),('Itaú de Minas',1727,'MG'),('Itaúna',1728,'MG'),('Itaverava',1729,'MG'),('Itinga',1730,'MG'),('Itueta',1731,'MG'),('Ituiutaba',1732,'MG'),('Itumirim',1733,'MG'),('Iturama',1734,'MG'),('Itutinga',1735,'MG'),('Jaboticatubas',1736,'MG'),('Jacinto',1737,'MG'),('Jacuí',1738,'MG'),('Jacutinga',1739,'MG'),('Jaguaraçu',1740,'MG'),('Jaíba',1741,'MG'),('Jampruca',1742,'MG'),('Janaúba',1743,'MG'),('Januária',1744,'MG'),('Japaraíba',1745,'MG'),('Japonvar',1746,'MG'),('Jeceaba',1747,'MG'),('Jenipapo de Minas',1748,'MG'),('Jequeri',1749,'MG'),('Jequitaí',1750,'MG'),('Jequitibá',1751,'MG'),('Jequitinhonha',1752,'MG'),('Jesuânia',1753,'MG'),('Joaíma',1754,'MG'),('Joanésia',1755,'MG'),('João Monlevade',1756,'MG'),('João Pinheiro',1757,'MG'),('Joaquim Felício',1758,'MG'),('Jordânia',1759,'MG'),('José Gonçalves de Minas',1760,'MG'),('José Raydan',1761,'MG'),('Josenópolis',1762,'MG'),('Juatuba',1763,'MG'),('Juiz de Fora',1764,'MG'),('Juramento',1765,'MG'),('Juruaia',1766,'MG'),('Juvenília',1767,'MG'),('Ladainha',1768,'MG'),('Lagamar',1769,'MG'),('Lagoa da Prata',1770,'MG'),('Lagoa dos Patos',1771,'MG'),('Lagoa Dourada',1772,'MG'),('Lagoa Formosa',1773,'MG'),('Lagoa Grande',1774,'MG'),('Lagoa Santa',1775,'MG'),('Lajinha',1776,'MG'),('Lambari',1777,'MG'),('Lamim',1778,'MG'),('Laranjal',1779,'MG'),('Lassance',1780,'MG'),('Lavras',1781,'MG'),('Leandro Ferreira',1782,'MG'),('Leme do Prado',1783,'MG'),('Leopoldina',1784,'MG'),('Liberdade',1785,'MG'),('Lima Duarte',1786,'MG'),('Limeira do Oeste',1787,'MG'),('Lontra',1788,'MG'),('Luisburgo',1789,'MG'),('Luislândia',1790,'MG'),('Luminárias',1791,'MG'),('Luz',1792,'MG'),('Machacalis',1793,'MG'),('Machado',1794,'MG'),('Madre de Deus de Minas',1795,'MG'),('Malacacheta',1796,'MG'),('Mamonas',1797,'MG'),('Manga',1798,'MG'),('Manhuaçu',1799,'MG'),('Manhumirim',1800,'MG'),('Mantena',1801,'MG'),('Mar de Espanha',1802,'MG'),('Maravilhas',1803,'MG'),('Maria da Fé',1804,'MG'),('Mariana',1805,'MG'),('Marilac',1806,'MG'),('Mário Campos',1807,'MG'),('Maripá de Minas',1808,'MG'),('Marliéria',1809,'MG'),('Marmelópolis',1810,'MG'),('Martinho Campos',1811,'MG'),('Martins Soares',1812,'MG'),('Mata Verde',1813,'MG'),('Materlândia',1814,'MG'),('Mateus Leme',1815,'MG'),('Mathias Lobato',1816,'MG'),('Matias Barbosa',1817,'MG'),('Matias Cardoso',1818,'MG'),('Matipó',1819,'MG'),('Mato Verde',1820,'MG'),('Matozinhos',1821,'MG'),('Matutina',1822,'MG'),('Medeiros',1823,'MG'),('Medina',1824,'MG'),('Mendes Pimentel',1825,'MG'),('Mercês',1826,'MG'),('Mesquita',1827,'MG'),('Minas Novas',1828,'MG'),('Minduri',1829,'MG'),('Mirabela',1830,'MG'),('Miradouro',1831,'MG'),('Miraí',1832,'MG'),('Miravânia',1833,'MG'),('Moeda',1834,'MG'),('Moema',1835,'MG'),('Monjolos',1836,'MG'),('Monsenhor Paulo',1837,'MG'),('Montalvânia',1838,'MG'),('Monte Alegre de Minas',1839,'MG'),('Monte Azul',1840,'MG'),('Monte Belo',1841,'MG'),('Monte Carmelo',1842,'MG'),('Monte Formoso',1843,'MG'),('Monte Santo de Minas',1844,'MG'),('Monte Sião',1845,'MG'),('Montes Claros',1846,'MG'),('Montezuma',1847,'MG'),('Morada Nova de Minas',1848,'MG'),('Morro da Garça',1849,'MG'),('Morro do Pilar',1850,'MG'),('Munhoz',1851,'MG'),('Muriaé',1852,'MG'),('Mutum',1853,'MG'),('Muzambinho',1854,'MG'),('Nacip Raydan',1855,'MG'),('Nanuque',1856,'MG'),('Naque',1857,'MG'),('Natalândia',1858,'MG'),('Natércia',1859,'MG'),('Nazareno',1860,'MG'),('Nepomuceno',1861,'MG'),('Ninheira',1862,'MG'),('Nova Belém',1863,'MG'),('Nova Era',1864,'MG'),('Nova Lima',1865,'MG'),('Nova Módica',1866,'MG'),('Nova Ponte',1867,'MG'),('Nova Porteirinha',1868,'MG'),('Nova Resende',1869,'MG'),('Nova Serrana',1870,'MG'),('Nova União',1871,'MG'),('Novo Cruzeiro',1872,'MG'),('Novo Oriente de Minas',1873,'MG'),('Novorizonte',1874,'MG'),('Olaria',1875,'MG'),('Olhos-d`Água',1876,'MG'),('Olímpio Noronha',1877,'MG'),('Oliveira',1878,'MG'),('Oliveira Fortes',1879,'MG'),('Onça de Pitangui',1880,'MG'),('Oratórios',1881,'MG'),('Orizânia',1882,'MG'),('Ouro Branco',1883,'MG'),('Ouro Fino',1884,'MG'),('Ouro Preto',1885,'MG'),('Ouro Verde de Minas',1886,'MG'),('Padre Carvalho',1887,'MG'),('Padre Paraíso',1888,'MG'),('Pai Pedro',1889,'MG'),('Paineiras',1890,'MG'),('Pains',1891,'MG'),('Paiva',1892,'MG'),('Palma',1893,'MG'),('Palmópolis',1894,'MG'),('Papagaios',1895,'MG'),('Pará de Minas',1896,'MG'),('Paracatu',1897,'MG'),('Paraguaçu',1898,'MG'),('Paraisópolis',1899,'MG'),('Paraopeba',1900,'MG'),('Passa Quatro',1901,'MG'),('Passa Tempo',1902,'MG'),('Passabém',1903,'MG'),('Passa-Vinte',1904,'MG'),('Passos',1905,'MG'),('Patis',1906,'MG'),('Patos de Minas',1907,'MG'),('Patrocínio',1908,'MG'),('Patrocínio do Muriaé',1909,'MG'),('Paula Cândido',1910,'MG'),('Paulistas',1911,'MG'),('Pavão',1912,'MG'),('Peçanha',1913,'MG'),('Pedra Azul',1914,'MG'),('Pedra Bonita',1915,'MG'),('Pedra do Anta',1916,'MG'),('Pedra do Indaiá',1917,'MG'),('Pedra Dourada',1918,'MG'),('Pedralva',1919,'MG'),('Pedras de Maria da Cruz',1920,'MG'),('Pedrinópolis',1921,'MG'),('Pedro Leopoldo',1922,'MG'),('Pedro Teixeira',1923,'MG'),('Pequeri',1924,'MG'),('Pequi',1925,'MG'),('Perdigão',1926,'MG'),('Perdizes',1927,'MG'),('Perdões',1928,'MG'),('Periquito',1929,'MG'),('Pescador',1930,'MG'),('Piau',1931,'MG'),('Piedade de Caratinga',1932,'MG'),('Piedade de Ponte Nova',1933,'MG'),('Piedade do Rio Grande',1934,'MG'),('Piedade dos Gerais',1935,'MG'),('Pimenta',1936,'MG'),('Pingo-d`Água',1937,'MG'),('Pintópolis',1938,'MG'),('Piracema',1939,'MG'),('Pirajuba',1940,'MG'),('Piranga',1941,'MG'),('Piranguçu',1942,'MG'),('Piranguinho',1943,'MG'),('Pirapetinga',1944,'MG'),('Pirapora',1945,'MG'),('Piraúba',1946,'MG'),('Pitangui',1947,'MG'),('Piumhi',1948,'MG'),('Planura',1949,'MG'),('Poço Fundo',1950,'MG'),('Poços de Caldas',1951,'MG'),('Pocrane',1952,'MG'),('Pompéu',1953,'MG'),('Ponte Nova',1954,'MG'),('Ponto Chique',1955,'MG'),('Ponto dos Volantes',1956,'MG'),('Porteirinha',1957,'MG'),('Porto Firme',1958,'MG'),('Poté',1959,'MG'),('Pouso Alegre',1960,'MG'),('Pouso Alto',1961,'MG'),('Prados',1962,'MG'),('Prata',1963,'MG'),('Pratápolis',1964,'MG'),('Pratinha',1965,'MG'),('Presidente Bernardes',1966,'MG'),('Presidente Juscelino',1967,'MG'),('Presidente Kubitschek',1968,'MG'),('Presidente Olegário',1969,'MG'),('Prudente de Morais',1970,'MG'),('Quartel Geral',1971,'MG'),('Queluzito',1972,'MG'),('Raposos',1973,'MG'),('Raul Soares',1974,'MG'),('Recreio',1975,'MG'),('Reduto',1976,'MG'),('Resende Costa',1977,'MG'),('Resplendor',1978,'MG'),('Ressaquinha',1979,'MG'),('Riachinho',1980,'MG'),('Riacho dos Machados',1981,'MG'),('Ribeirão das Neves',1982,'MG'),('Ribeirão Vermelho',1983,'MG'),('Rio Acima',1984,'MG'),('Rio Casca',1985,'MG'),('Rio do Prado',1986,'MG'),('Rio Doce',1987,'MG'),('Rio Espera',1988,'MG'),('Rio Manso',1989,'MG'),('Rio Novo',1990,'MG'),('Rio Paranaíba',1991,'MG'),('Rio Pardo de Minas',1992,'MG'),('Rio Piracicaba',1993,'MG'),('Rio Pomba',1994,'MG'),('Rio Preto',1995,'MG'),('Rio Vermelho',1996,'MG'),('Ritápolis',1997,'MG'),('Rochedo de Minas',1998,'MG'),('Rodeiro',1999,'MG'),('Romaria',2000,'MG'),('Rosário da Limeira',2001,'MG'),('Rubelita',2002,'MG'),('Rubim',2003,'MG'),('Sabará',2004,'MG'),('Sabinópolis',2005,'MG'),('Sacramento',2006,'MG'),('Salinas',2007,'MG'),('Salto da Divisa',2008,'MG'),('Santa Bárbara',2009,'MG'),('Santa Bárbara do Leste',2010,'MG'),('Santa Bárbara do Monte Verde',2011,'MG'),('Santa Bárbara do Tugúrio',2012,'MG'),('Santa Cruz de Minas',2013,'MG'),('Santa Cruz de Salinas',2014,'MG'),('Santa Cruz do Escalvado',2015,'MG'),('Santa Efigênia de Minas',2016,'MG'),('Santa Fé de Minas',2017,'MG'),('Santa Helena de Minas',2018,'MG'),('Santa Juliana',2019,'MG'),('Santa Luzia',2020,'MG'),('Santa Margarida',2021,'MG'),('Santa Maria de Itabira',2022,'MG'),('Santa Maria do Salto',2023,'MG'),('Santa Maria do Suaçuí',2024,'MG'),('Santa Rita de Caldas',2025,'MG'),('Santa Rita de Ibitipoca',2026,'MG'),('Santa Rita de Jacutinga',2027,'MG'),('Santa Rita de Minas',2028,'MG'),('Santa Rita do Itueto',2029,'MG'),('Santa Rita do Sapucaí',2030,'MG'),('Santa Rosa da Serra',2031,'MG'),('Santa Vitória',2032,'MG'),('Santana da Vargem',2033,'MG'),('Santana de Cataguases',2034,'MG'),('Santana de Pirapama',2035,'MG'),('Santana do Deserto',2036,'MG'),('Santana do Garambéu',2037,'MG'),('Santana do Jacaré',2038,'MG'),('Santana do Manhuaçu',2039,'MG'),('Santana do Paraíso',2040,'MG'),('Santana do Riacho',2041,'MG'),('Santana dos Montes',2042,'MG'),('Santo Antônio do Amparo',2043,'MG'),('Santo Antônio do Aventureiro',2044,'MG'),('Santo Antônio do Grama',2045,'MG'),('Santo Antônio do Itambé',2046,'MG'),('Santo Antônio do Jacinto',2047,'MG'),('Santo Antônio do Monte',2048,'MG'),('Santo Antônio do Retiro',2049,'MG'),('Santo Antônio do Rio Abaixo',2050,'MG'),('Santo Hipólito',2051,'MG'),('Santos Dumont',2052,'MG'),('São Bento Abade',2053,'MG'),('São Brás do Suaçuí',2054,'MG'),('São Domingos das Dores',2055,'MG'),('São Domingos do Prata',2056,'MG'),('São Félix de Minas',2057,'MG'),('São Francisco',2058,'MG'),('São Francisco de Paula',2059,'MG'),('São Francisco de Sales',2060,'MG'),('São Francisco do Glória',2061,'MG'),('São Geraldo',2062,'MG'),('São Geraldo da Piedade',2063,'MG'),('São Geraldo do Baixio',2064,'MG'),('São Gonçalo do Abaeté',2065,'MG'),('São Gonçalo do Pará',2066,'MG'),('São Gonçalo do Rio Abaixo',2067,'MG'),('São Gonçalo do Rio Preto',2068,'MG'),('São Gonçalo do Sapucaí',2069,'MG'),('São Gotardo',2070,'MG'),('São João Batista do Glória',2071,'MG'),('São João da Lagoa',2072,'MG'),('São João da Mata',2073,'MG'),('São João da Ponte',2074,'MG'),('São João das Missões',2075,'MG'),('São João del Rei',2076,'MG'),('São João do Manhuaçu',2077,'MG'),('São João do Manteninha',2078,'MG'),('São João do Oriente',2079,'MG'),('São João do Pacuí',2080,'MG'),('São João do Paraíso',2081,'MG'),('São João Evangelista',2082,'MG'),('São João Nepomuceno',2083,'MG'),('São Joaquim de Bicas',2084,'MG'),('São José da Barra',2085,'MG'),('São José da Lapa',2086,'MG'),('São José da Safira',2087,'MG'),('São José da Varginha',2088,'MG'),('São José do Alegre',2089,'MG'),('São José do Divino',2090,'MG'),('São José do Goiabal',2091,'MG'),('São José do Jacuri',2092,'MG'),('São José do Mantimento',2093,'MG'),('São Lourenço',2094,'MG'),('São Miguel do Anta',2095,'MG'),('São Pedro da União',2096,'MG'),('São Pedro do Suaçuí',2097,'MG'),('São Pedro dos Ferros',2098,'MG'),('São Romão',2099,'MG'),('São Roque de Minas',2100,'MG'),('São Sebastião da Bela Vista',2101,'MG'),('São Sebastião da Vargem Alegre',2102,'MG'),('São Sebastião do Anta',2103,'MG'),('São Sebastião do Maranhão',2104,'MG'),('São Sebastião do Oeste',2105,'MG'),('São Sebastião do Paraíso',2106,'MG'),('São Sebastião do Rio Preto',2107,'MG'),('São Sebastião do Rio Verde',2108,'MG'),('São Thomé das Letras',2109,'MG'),('São Tiago',2110,'MG'),('São Tomás de Aquino',2111,'MG'),('São Vicente de Minas',2112,'MG'),('Sapucaí-Mirim',2113,'MG'),('Sardoá',2114,'MG'),('Sarzedo',2115,'MG'),('Sem-Peixe',2116,'MG'),('Senador Amaral',2117,'MG'),('Senador Cortes',2118,'MG'),('Senador Firmino',2119,'MG'),('Senador José Bento',2120,'MG'),('Senador Modestino Gonçalves',2121,'MG'),('Senhora de Oliveira',2122,'MG'),('Senhora do Porto',2123,'MG'),('Senhora dos Remédios',2124,'MG'),('Sericita',2125,'MG'),('Seritinga',2126,'MG'),('Serra Azul de Minas',2127,'MG'),('Serra da Saudade',2128,'MG'),('Serra do Salitre',2129,'MG'),('Serra dos Aimorés',2130,'MG'),('Serrania',2131,'MG'),('Serranópolis de Minas',2132,'MG'),('Serranos',2133,'MG'),('Serro',2134,'MG'),('Sete Lagoas',2135,'MG'),('Setubinha',2136,'MG'),('Silveirânia',2137,'MG'),('Silvianópolis',2138,'MG'),('Simão Pereira',2139,'MG'),('Simonésia',2140,'MG'),('Sobrália',2141,'MG'),('Soledade de Minas',2142,'MG'),('Tabuleiro',2143,'MG'),('Taiobeiras',2144,'MG'),('Taparuba',2145,'MG'),('Tapira',2146,'MG'),('Tapiraí',2147,'MG'),('Taquaraçu de Minas',2148,'MG'),('Tarumirim',2149,'MG'),('Teixeiras',2150,'MG'),('Teófilo Otoni',2151,'MG'),('Timóteo',2152,'MG'),('Tiradentes',2153,'MG'),('Tiros',2154,'MG'),('Tocantins',2155,'MG'),('Tocos do Moji',2156,'MG'),('Toledo',2157,'MG'),('Tombos',2158,'MG'),('Três Corações',2159,'MG'),('Três Marias',2160,'MG'),('Três Pontas',2161,'MG'),('Tumiritinga',2162,'MG'),('Tupaciguara',2163,'MG'),('Turmalina',2164,'MG'),('Turvolândia',2165,'MG'),('Ubá',2166,'MG'),('Ubaí',2167,'MG'),('Ubaporanga',2168,'MG'),('Uberaba',2169,'MG'),('Uberlândia',2170,'MG'),('Umburatiba',2171,'MG'),('Unaí',2172,'MG'),('União de Minas',2173,'MG'),('Uruana de Minas',2174,'MG'),('Urucânia',2175,'MG'),('Urucuia',2176,'MG'),('Vargem Alegre',2177,'MG'),('Vargem Bonita',2178,'MG'),('Vargem Grande do Rio Pardo',2179,'MG'),('Varginha',2180,'MG'),('Varjão de Minas',2181,'MG'),('Várzea da Palma',2182,'MG'),('Varzelândia',2183,'MG'),('Vazante',2184,'MG'),('Verdelândia',2185,'MG'),('Veredinha',2186,'MG'),('Veríssimo',2187,'MG'),('Vermelho Novo',2188,'MG'),('Vespasiano',2189,'MG'),('Viçosa',2190,'MG'),('Vieiras',2191,'MG'),('Virgem da Lapa',2192,'MG'),('Virgínia',2193,'MG'),('Virginópolis',2194,'MG'),('Virgolândia',2195,'MG'),('Visconde do Rio Branco',2196,'MG'),('Volta Grande',2197,'MG'),('Wenceslau Braz',2198,'MG'),('Água Clara',2199,'MS'),('Alcinópolis',2200,'MS'),('Amambaí',2201,'MS'),('Anastácio',2202,'MS'),('Anaurilândia',2203,'MS'),('Angélica',2204,'MS'),('Antônio João',2205,'MS'),('Aparecida do Taboado',2206,'MS'),('Aquidauana',2207,'MS'),('Aral Moreira',2208,'MS'),('Bandeirantes',2209,'MS'),('Bataguassu',2210,'MS'),('Bataiporã',2211,'MS'),('Bela Vista',2212,'MS'),('Bodoquena',2213,'MS'),('Bonito',2214,'MS'),('Brasilândia',2215,'MS'),('Caarapó',2216,'MS'),('Camapuã',2217,'MS'),('Campo Grande',2218,'MS'),('Caracol',2219,'MS'),('Cassilândia',2220,'MS'),('Chapadão do Sul',2221,'MS'),('Corguinho',2222,'MS'),('Coronel Sapucaia',2223,'MS'),('Corumbá',2224,'MS'),('Costa Rica',2225,'MS'),('Coxim',2226,'MS'),('Deodápolis',2227,'MS'),('Dois Irmãos do Buriti',2228,'MS'),('Douradina',2229,'MS'),('Dourados',2230,'MS'),('Eldorado',2231,'MS'),('Fátima do Sul',2232,'MS'),('Figueirão',2233,'MS'),('Glória de Dourados',2234,'MS'),('Guia Lopes da Laguna',2235,'MS'),('Iguatemi',2236,'MS'),('Inocência',2237,'MS'),('Itaporã',2238,'MS'),('Itaquiraí',2239,'MS'),('Ivinhema',2240,'MS'),('Japorã',2241,'MS'),('Jaraguari',2242,'MS'),('Jardim',2243,'MS'),('Jateí',2244,'MS'),('Juti',2245,'MS'),('Ladário',2246,'MS'),('Laguna Carapã',2247,'MS'),('Maracaju',2248,'MS'),('Miranda',2249,'MS'),('Mundo Novo',2250,'MS'),('Naviraí',2251,'MS'),('Nioaque',2252,'MS'),('Nova Alvorada do Sul',2253,'MS'),('Nova Andradina',2254,'MS'),('Novo Horizonte do Sul',2255,'MS'),('Paranaíba',2256,'MS'),('Paranhos',2257,'MS'),('Pedro Gomes',2258,'MS'),('Ponta Porã',2259,'MS'),('Porto Murtinho',2260,'MS'),('Ribas do Rio Pardo',2261,'MS'),('Rio Brilhante',2262,'MS'),('Rio Negro',2263,'MS'),('Rio Verde de Mato Grosso',2264,'MS'),('Rochedo',2265,'MS'),('Santa Rita do Pardo',2266,'MS'),('São Gabriel do Oeste',2267,'MS'),('Selvíria',2268,'MS'),('Sete Quedas',2269,'MS'),('Sidrolândia',2270,'MS'),('Sonora',2271,'MS'),('Tacuru',2272,'MS'),('Taquarussu',2273,'MS'),('Terenos',2274,'MS'),('Três Lagoas',2275,'MS'),('Vicentina',2276,'MS'),('Acorizal',2277,'MT'),('Água Boa',2278,'MT'),('Alta Floresta',2279,'MT'),('Alto Araguaia',2280,'MT'),('Alto Boa Vista',2281,'MT'),('Alto Garças',2282,'MT'),('Alto Paraguai',2283,'MT'),('Alto Taquari',2284,'MT'),('Apiacás',2285,'MT'),('Araguaiana',2286,'MT'),('Araguainha',2287,'MT'),('Araputanga',2288,'MT'),('Arenápolis',2289,'MT'),('Aripuanã',2290,'MT'),('Barão de Melgaço',2291,'MT'),('Barra do Bugres',2292,'MT'),('Barra do Garças',2293,'MT'),('Bom Jesus do Araguaia',2294,'MT'),('Brasnorte',2295,'MT'),('Cáceres',2296,'MT'),('Campinápolis',2297,'MT'),('Campo Novo do Parecis',2298,'MT'),('Campo Verde',2299,'MT'),('Campos de Júlio',2300,'MT'),('Canabrava do Norte',2301,'MT'),('Canarana',2302,'MT'),('Carlinda',2303,'MT'),('Castanheira',2304,'MT'),('Chapada dos Guimarães',2305,'MT'),('Cláudia',2306,'MT'),('Cocalinho',2307,'MT'),('Colíder',2308,'MT'),('Colniza',2309,'MT'),('Comodoro',2310,'MT'),('Confresa',2311,'MT'),('Conquista d`Oeste',2312,'MT'),('Cotriguaçu',2313,'MT'),('Cuiabá',2314,'MT'),('Curvelândia',2315,'MT'),('Curvelândia',2316,'MT'),('Denise',2317,'MT'),('Diamantino',2318,'MT'),('Dom Aquino',2319,'MT'),('Feliz Natal',2320,'MT'),('Figueirópolis d`Oeste',2321,'MT'),('Gaúcha do Norte',2322,'MT'),('General Carneiro',2323,'MT'),('Glória d`Oeste',2324,'MT'),('Guarantã do Norte',2325,'MT'),('Guiratinga',2326,'MT'),('Indiavaí',2327,'MT'),('Ipiranga do Norte',2328,'MT'),('Itanhangá',2329,'MT'),('Itaúba',2330,'MT'),('Itiquira',2331,'MT'),('Jaciara',2332,'MT'),('Jangada',2333,'MT'),('Jauru',2334,'MT'),('Juara',2335,'MT'),('Juína',2336,'MT'),('Juruena',2337,'MT'),('Juscimeira',2338,'MT'),('Lambari d`Oeste',2339,'MT'),('Lucas do Rio Verde',2340,'MT'),('Luciára',2341,'MT'),('Marcelândia',2342,'MT'),('Matupá',2343,'MT'),('Mirassol d`Oeste',2344,'MT'),('Nobres',2345,'MT'),('Nortelândia',2346,'MT'),('Nossa Senhora do Livramento',2347,'MT'),('Nova Bandeirantes',2348,'MT'),('Nova Brasilândia',2349,'MT'),('Nova Canaã do Norte',2350,'MT'),('Nova Guarita',2351,'MT'),('Nova Lacerda',2352,'MT'),('Nova Marilândia',2353,'MT'),('Nova Maringá',2354,'MT'),('Nova Monte verde',2355,'MT'),('Nova Mutum',2356,'MT'),('Nova Olímpia',2357,'MT'),('Nova Santa Helena',2358,'MT'),('Nova Ubiratã',2359,'MT'),('Nova Xavantina',2360,'MT'),('Novo Horizonte do Norte',2361,'MT'),('Novo Mundo',2362,'MT'),('Novo Santo Antônio',2363,'MT'),('Novo São Joaquim',2364,'MT'),('Paranaíta',2365,'MT'),('Paranatinga',2366,'MT'),('Pedra Preta',2367,'MT'),('Peixoto de Azevedo',2368,'MT'),('Planalto da Serra',2369,'MT'),('Poconé',2370,'MT'),('Pontal do Araguaia',2371,'MT'),('Ponte Branca',2372,'MT'),('Pontes e Lacerda',2373,'MT'),('Porto Alegre do Norte',2374,'MT'),('Porto dos Gaúchos',2375,'MT'),('Porto Esperidião',2376,'MT'),('Porto Estrela',2377,'MT'),('Poxoréo',2378,'MT'),('Primavera do Leste',2379,'MT'),('Querência',2380,'MT'),('Reserva do Cabaçal',2381,'MT'),('Ribeirão Cascalheira',2382,'MT'),('Ribeirãozinho',2383,'MT'),('Rio Branco',2384,'MT'),('Rondolândia',2385,'MT'),('Rondonópolis',2386,'MT'),('Rosário Oeste',2387,'MT'),('Salto do Céu',2388,'MT'),('Santa Carmem',2389,'MT'),('Santa Cruz do Xingu',2390,'MT'),('Santa Rita do Trivelato',2391,'MT'),('Santa Terezinha',2392,'MT'),('Santo Afonso',2393,'MT'),('Santo Antônio do Leste',2394,'MT'),('Santo Antônio do Leverger',2395,'MT'),('São Félix do Araguaia',2396,'MT'),('São José do Povo',2397,'MT'),('São José do Rio Claro',2398,'MT'),('São José do Xingu',2399,'MT'),('São José dos Quatro Marcos',2400,'MT'),('São Pedro da Cipa',2401,'MT'),('Sapezal',2402,'MT'),('Serra Nova Dourada',2403,'MT'),('Sinop',2404,'MT'),('Sorriso',2405,'MT'),('Tabaporã',2406,'MT'),('Tangará da Serra',2407,'MT'),('Tapurah',2408,'MT'),('Terra Nova do Norte',2409,'MT'),('Tesouro',2410,'MT'),('Torixoréu',2411,'MT'),('União do Sul',2412,'MT'),('Vale de São Domingos',2413,'MT'),('Várzea Grande',2414,'MT'),('Vera',2415,'MT'),('Vila Bela da Santíssima Trindade',2416,'MT'),('Vila Rica',2417,'MT'),('Abaetetuba',2418,'PA'),('Abel Figueiredo',2419,'PA'),('Acará',2420,'PA'),('Afuá',2421,'PA'),('Água Azul do Norte',2422,'PA'),('Alenquer',2423,'PA'),('Almeirim',2424,'PA'),('Altamira',2425,'PA'),('Anajás',2426,'PA'),('Ananindeua',2427,'PA'),('Anapu',2428,'PA'),('Augusto Corrêa',2429,'PA'),('Aurora do Pará',2430,'PA'),('Aveiro',2431,'PA'),('Bagre',2432,'PA'),('Baião',2433,'PA'),('Bannach',2434,'PA'),('Barcarena',2435,'PA'),('Belém',2436,'PA'),('Belterra',2437,'PA'),('Benevides',2438,'PA'),('Bom Jesus do Tocantins',2439,'PA'),('Bonito',2440,'PA'),('Bragança',2441,'PA'),('Brasil Novo',2442,'PA'),('Brejo Grande do Araguaia',2443,'PA'),('Breu Branco',2444,'PA'),('Breves',2445,'PA'),('Bujaru',2446,'PA'),('Cachoeira do Arari',2447,'PA'),('Cachoeira do Piriá',2448,'PA'),('Cametá',2449,'PA'),('Canaã dos Carajás',2450,'PA'),('Capanema',2451,'PA'),('Capitão Poço',2452,'PA'),('Castanhal',2453,'PA'),('Chaves',2454,'PA'),('Colares',2455,'PA'),('Conceição do Araguaia',2456,'PA'),('Concórdia do Pará',2457,'PA'),('Cumaru do Norte',2458,'PA'),('Curionópolis',2459,'PA'),('Curralinho',2460,'PA'),('Curuá',2461,'PA'),('Curuçá',2462,'PA'),('Dom Eliseu',2463,'PA'),('Eldorado dos Carajás',2464,'PA'),('Faro',2465,'PA'),('Floresta do Araguaia',2466,'PA'),('Garrafão do Norte',2467,'PA'),('Goianésia do Pará',2468,'PA'),('Gurupá',2469,'PA'),('Igarapé-Açu',2470,'PA'),('Igarapé-Miri',2471,'PA'),('Inhangapi',2472,'PA'),('Ipixuna do Pará',2473,'PA'),('Irituia',2474,'PA'),('Itaituba',2475,'PA'),('Itupiranga',2476,'PA'),('Jacareacanga',2477,'PA'),('Jacundá',2478,'PA'),('Juruti',2479,'PA'),('Limoeiro do Ajuru',2480,'PA'),('Mãe do Rio',2481,'PA'),('Magalhães Barata',2482,'PA'),('Marabá',2483,'PA'),('Maracanã',2484,'PA'),('Marapanim',2485,'PA'),('Marituba',2486,'PA'),('Medicilândia',2487,'PA'),('Melgaço',2488,'PA'),('Mocajuba',2489,'PA'),('Moju',2490,'PA'),('Monte Alegre',2491,'PA'),('Muaná',2492,'PA'),('Nova Esperança do Piriá',2493,'PA'),('Nova Ipixuna',2494,'PA'),('Nova Timboteua',2495,'PA'),('Novo Progresso',2496,'PA'),('Novo Repartimento',2497,'PA'),('Óbidos',2498,'PA'),('Oeiras do Pará',2499,'PA'),('Oriximiná',2500,'PA'),('Ourém',2501,'PA'),('Ourilândia do Norte',2502,'PA'),('Pacajá',2503,'PA'),('Palestina do Pará',2504,'PA'),('Paragominas',2505,'PA'),('Parauapebas',2506,'PA'),('Pau d`Arco',2507,'PA'),('Peixe-Boi',2508,'PA'),('Piçarra',2509,'PA'),('Placas',2510,'PA'),('Ponta de Pedras',2511,'PA'),('Portel',2512,'PA'),('Porto de Moz',2513,'PA'),('Prainha',2514,'PA'),('Primavera',2515,'PA'),('Quatipuru',2516,'PA'),('Redenção',2517,'PA'),('Rio Maria',2518,'PA'),('Rondon do Pará',2519,'PA'),('Rurópolis',2520,'PA'),('Salinópolis',2521,'PA'),('Salvaterra',2522,'PA'),('Santa Bárbara do Pará',2523,'PA'),('Santa Cruz do Arari',2524,'PA'),('Santa Isabel do Pará',2525,'PA'),('Santa Luzia do Pará',2526,'PA'),('Santa Maria das Barreiras',2527,'PA'),('Santa Maria do Pará',2528,'PA'),('Santana do Araguaia',2529,'PA'),('Santarém',2530,'PA'),('Santarém Novo',2531,'PA'),('Santo Antônio do Tauá',2532,'PA'),('São Caetano de Odivelas',2533,'PA'),('São Domingos do Araguaia',2534,'PA'),('São Domingos do Capim',2535,'PA'),('São Félix do Xingu',2536,'PA'),('São Francisco do Pará',2537,'PA'),('São Geraldo do Araguaia',2538,'PA'),('São João da Ponta',2539,'PA'),('São João de Pirabas',2540,'PA'),('São João do Araguaia',2541,'PA'),('São Miguel do Guamá',2542,'PA'),('São Sebastião da Boa Vista',2543,'PA'),('Sapucaia',2544,'PA'),('Senador José Porfírio',2545,'PA'),('Soure',2546,'PA'),('Tailândia',2547,'PA'),('Terra Alta',2548,'PA'),('Terra Santa',2549,'PA'),('Tomé-Açu',2550,'PA'),('Tracuateua',2551,'PA'),('Trairão',2552,'PA'),('Tucumã',2553,'PA'),('Tucuruí',2554,'PA'),('Ulianópolis',2555,'PA'),('Uruará',2556,'PA'),('Vigia',2557,'PA'),('Viseu',2558,'PA'),('Vitória do Xingu',2559,'PA'),('Xinguara',2560,'PA'),('Água Branca',2561,'PB'),('Aguiar',2562,'PB'),('Alagoa Grande',2563,'PB'),('Alagoa Nova',2564,'PB'),('Alagoinha',2565,'PB'),('Alcantil',2566,'PB'),('Algodão de Jandaíra',2567,'PB'),('Alhandra',2568,'PB'),('Amparo',2569,'PB'),('Aparecida',2570,'PB'),('Araçagi',2571,'PB'),('Arara',2572,'PB'),('Araruna',2573,'PB'),('Areia',2574,'PB'),('Areia de Baraúnas',2575,'PB'),('Areial',2576,'PB'),('Aroeiras',2577,'PB'),('Assunção',2578,'PB'),('Baía da Traição',2579,'PB'),('Bananeiras',2580,'PB'),('Baraúna',2581,'PB'),('Barra de Santa Rosa',2582,'PB'),('Barra de Santana',2583,'PB'),('Barra de São Miguel',2584,'PB'),('Bayeux',2585,'PB'),('Belém',2586,'PB'),('Belém do Brejo do Cruz',2587,'PB'),('Bernardino Batista',2588,'PB'),('Boa Ventura',2589,'PB'),('Boa Vista',2590,'PB'),('Bom Jesus',2591,'PB'),('Bom Sucesso',2592,'PB'),('Bonito de Santa Fé',2593,'PB'),('Boqueirão',2594,'PB'),('Borborema',2595,'PB'),('Brejo do Cruz',2596,'PB'),('Brejo dos Santos',2597,'PB'),('Caaporã',2598,'PB'),('Cabaceiras',2599,'PB'),('Cabedelo',2600,'PB'),('Cachoeira dos Índios',2601,'PB'),('Cacimba de Areia',2602,'PB'),('Cacimba de Dentro',2603,'PB'),('Cacimbas',2604,'PB'),('Caiçara',2605,'PB'),('Cajazeiras',2606,'PB'),('Cajazeirinhas',2607,'PB'),('Caldas Brandão',2608,'PB'),('Camalaú',2609,'PB'),('Campina Grande',2610,'PB'),('Tacima',2611,'PB'),('Capim',2612,'PB'),('Caraúbas',2613,'PB'),('Carrapateira',2614,'PB'),('Casserengue',2615,'PB'),('Catingueira',2616,'PB'),('Catolé do Rocha',2617,'PB'),('Caturité',2618,'PB'),('Conceição',2619,'PB'),('Condado',2620,'PB'),('Conde',2621,'PB'),('Congo',2622,'PB'),('Coremas',2623,'PB'),('Coxixola',2624,'PB'),('Cruz do Espírito Santo',2625,'PB'),('Cubati',2626,'PB'),('Cuité',2627,'PB'),('Cuité de Mamanguape',2628,'PB'),('Cuitegi',2629,'PB'),('Curral de Cima',2630,'PB'),('Curral Velho',2631,'PB'),('Damião',2632,'PB'),('Desterro',2633,'PB'),('Diamante',2634,'PB'),('Dona Inês',2635,'PB'),('Duas Estradas',2636,'PB'),('Emas',2637,'PB'),('Esperança',2638,'PB'),('Fagundes',2639,'PB'),('Frei Martinho',2640,'PB'),('Gado Bravo',2641,'PB'),('Guarabira',2642,'PB'),('Gurinhém',2643,'PB'),('Gurjão',2644,'PB'),('Ibiara',2645,'PB'),('Igaracy',2646,'PB'),('Imaculada',2647,'PB'),('Ingá',2648,'PB'),('Itabaiana',2649,'PB'),('Itaporanga',2650,'PB'),('Itapororoca',2651,'PB'),('Itatuba',2652,'PB'),('Jacaraú',2653,'PB'),('Jericó',2654,'PB'),('João Pessoa',2655,'PB'),('Juarez Távora',2656,'PB'),('Juazeirinho',2657,'PB'),('Junco do Seridó',2658,'PB'),('Juripiranga',2659,'PB'),('Juru',2660,'PB'),('Lagoa',2661,'PB'),('Lagoa de Dentro',2662,'PB'),('Lagoa Seca',2663,'PB'),('Lastro',2664,'PB'),('Livramento',2665,'PB'),('Logradouro',2666,'PB'),('Lucena',2667,'PB'),('Mãe d`Água',2668,'PB'),('Malta',2669,'PB'),('Mamanguape',2670,'PB'),('Manaíra',2671,'PB'),('Marcação',2672,'PB'),('Mari',2673,'PB'),('Marizópolis',2674,'PB'),('Massaranduba',2675,'PB'),('Mataraca',2676,'PB'),('Matinhas',2677,'PB'),('Mato Grosso',2678,'PB'),('Maturéia',2679,'PB'),('Mogeiro',2680,'PB'),('Montadas',2681,'PB'),('Monte Horebe',2682,'PB'),('Monteiro',2683,'PB'),('Mulungu',2684,'PB'),('Natuba',2685,'PB'),('Nazarezinho',2686,'PB'),('Nova Floresta',2687,'PB'),('Nova Olinda',2688,'PB'),('Nova Palmeira',2689,'PB'),('Olho d`Água',2690,'PB'),('Olivedos',2691,'PB'),('Ouro Velho',2692,'PB'),('Parari',2693,'PB'),('Passagem',2694,'PB'),('Patos',2695,'PB'),('Paulista',2696,'PB'),('Pedra Branca',2697,'PB'),('Pedra Lavrada',2698,'PB'),('Pedras de Fogo',2699,'PB'),('Pedro Régis',2700,'PB'),('Piancó',2701,'PB'),('Picuí',2702,'PB'),('Pilar',2703,'PB'),('Pilões',2704,'PB'),('Pilõezinhos',2705,'PB'),('Pirpirituba',2706,'PB'),('Pitimbu',2707,'PB'),('Pocinhos',2708,'PB'),('Poço Dantas',2709,'PB'),('Poço de José de Moura',2710,'PB'),('Pombal',2711,'PB'),('Prata',2712,'PB'),('Princesa Isabel',2713,'PB'),('Puxinanã',2714,'PB'),('Queimadas',2715,'PB'),('Quixabá',2716,'PB'),('Remígio',2717,'PB'),('Riachão',2718,'PB'),('Riachão do Bacamarte',2719,'PB'),('Riachão do Poço',2720,'PB'),('Riacho de Santo Antônio',2721,'PB'),('Riacho dos Cavalos',2722,'PB'),('Rio Tinto',2723,'PB'),('Salgadinho',2724,'PB'),('Salgado de São Félix',2725,'PB'),('Santa Cecília',2726,'PB'),('Santa Cruz',2727,'PB'),('Santa Helena',2728,'PB'),('Santa Inês',2729,'PB'),('Santa Luzia',2730,'PB'),('Santa Rita',2731,'PB'),('Santa Teresinha',2732,'PB'),('Santana de Mangueira',2733,'PB'),('Santana dos Garrotes',2734,'PB'),('Santarém',2735,'PB'),('Santo André',2736,'PB'),('São Bentinho',2737,'PB'),('São Bento',2738,'PB'),('São Domingos de Pombal',2739,'PB'),('São Domingos do Cariri',2740,'PB'),('São Francisco',2741,'PB'),('São João do Cariri',2742,'PB'),('São João do Rio do Peixe',2743,'PB'),('São João do Tigre',2744,'PB'),('São José da Lagoa Tapada',2745,'PB'),('São José de Caiana',2746,'PB'),('São José de Espinharas',2747,'PB'),('São José de Piranhas',2748,'PB'),('São José de Princesa',2749,'PB'),('São José do Bonfim',2750,'PB'),('São José do Brejo do Cruz',2751,'PB'),('São José do Sabugi',2752,'PB'),('São José dos Cordeiros',2753,'PB'),('São José dos Ramos',2754,'PB'),('São Mamede',2755,'PB'),('São Miguel de Taipu',2756,'PB'),('São Sebastião de Lagoa de Roça',2757,'PB'),('São Sebastião do Umbuzeiro',2758,'PB'),('Sapé',2759,'PB'),('Seridó',2760,'PB'),('Serra Branca',2761,'PB'),('Serra da Raiz',2762,'PB'),('Serra Grande',2763,'PB'),('Serra Redonda',2764,'PB'),('Serraria',2765,'PB'),('Sertãozinho',2766,'PB'),('Sobrado',2767,'PB'),('Solânea',2768,'PB'),('Soledade',2769,'PB'),('Sossêgo',2770,'PB'),('Sousa',2771,'PB'),('Sumé',2772,'PB'),('Taperoá',2773,'PB'),('Tavares',2774,'PB'),('Teixeira',2775,'PB'),('Tenório',2776,'PB'),('Triunfo',2777,'PB'),('Uiraúna',2778,'PB'),('Umbuzeiro',2779,'PB'),('Várzea',2780,'PB'),('Vieirópolis',2781,'PB'),('Vista Serrana',2782,'PB'),('Zabelê',2783,'PB'),('Abreu e Lima',2784,'PE'),('Afogados da Ingazeira',2785,'PE'),('Afrânio',2786,'PE'),('Agrestina',2787,'PE'),('Água Preta',2788,'PE'),('Águas Belas',2789,'PE'),('Alagoinha',2790,'PE'),('Aliança',2791,'PE'),('Altinho',2792,'PE'),('Amaraji',2793,'PE'),('Angelim',2794,'PE'),('Araçoiaba',2795,'PE'),('Araripina',2796,'PE'),('Arcoverde',2797,'PE'),('Barra de Guabiraba',2798,'PE'),('Barreiros',2799,'PE'),('Belém de Maria',2800,'PE'),('Belém de São Francisco',2801,'PE'),('Belo Jardim',2802,'PE'),('Betânia',2803,'PE'),('Bezerros',2804,'PE'),('Bodocó',2805,'PE'),('Bom Conselho',2806,'PE'),('Bom Jardim',2807,'PE'),('Bonito',2808,'PE'),('Brejão',2809,'PE'),('Brejinho',2810,'PE'),('Brejo da Madre de Deus',2811,'PE'),('Buenos Aires',2812,'PE'),('Buíque',2813,'PE'),('Cabo de Santo Agostinho',2814,'PE'),('Cabrobó',2815,'PE'),('Cachoeirinha',2816,'PE'),('Caetés',2817,'PE'),('Calçado',2818,'PE'),('Calumbi',2819,'PE'),('Camaragibe',2820,'PE'),('Camocim de São Félix',2821,'PE'),('Camutanga',2822,'PE'),('Canhotinho',2823,'PE'),('Capoeiras',2824,'PE'),('Carnaíba',2825,'PE'),('Carnaubeira da Penha',2826,'PE'),('Carpina',2827,'PE'),('Caruaru',2828,'PE'),('Casinhas',2829,'PE'),('Catende',2830,'PE'),('Cedro',2831,'PE'),('Chã de Alegria',2832,'PE'),('Chã Grande',2833,'PE'),('Condado',2834,'PE'),('Correntes',2835,'PE'),('Cortês',2836,'PE'),('Cumaru',2837,'PE'),('Cupira',2838,'PE'),('Custódia',2839,'PE'),('Dormentes',2840,'PE'),('Escada',2841,'PE'),('Exu',2842,'PE'),('Feira Nova',2843,'PE'),('Fernando de Noronha',2844,'PE'),('Ferreiros',2845,'PE'),('Flores',2846,'PE'),('Floresta',2847,'PE'),('Frei Miguelinho',2848,'PE'),('Gameleira',2849,'PE'),('Garanhuns',2850,'PE'),('Glória do Goitá',2851,'PE'),('Goiana',2852,'PE'),('Granito',2853,'PE'),('Gravatá',2854,'PE'),('Iati',2855,'PE'),('Ibimirim',2856,'PE'),('Ibirajuba',2857,'PE'),('Igarassu',2858,'PE'),('Iguaraci',2859,'PE'),('Ilha de Itamaracá',2860,'PE'),('Inajá',2861,'PE'),('Ingazeira',2862,'PE'),('Ipojuca',2863,'PE'),('Ipubi',2864,'PE'),('Itacuruba',2865,'PE'),('Itaíba',2866,'PE'),('Itambé',2867,'PE'),('Itapetim',2868,'PE'),('Itapissuma',2869,'PE'),('Itaquitinga',2870,'PE'),('Jaboatão dos Guararapes',2871,'PE'),('Jaqueira',2872,'PE'),('Jataúba',2873,'PE'),('Jatobá',2874,'PE'),('João Alfredo',2875,'PE'),('Joaquim Nabuco',2876,'PE'),('Jucati',2877,'PE'),('Jupi',2878,'PE'),('Jurema',2879,'PE'),('Lagoa do Carro',2880,'PE'),('Lagoa do Itaenga',2881,'PE'),('Lagoa do Ouro',2882,'PE'),('Lagoa dos Gatos',2883,'PE'),('Lagoa Grande',2884,'PE'),('Lajedo',2885,'PE'),('Limoeiro',2886,'PE'),('Macaparana',2887,'PE'),('Machados',2888,'PE'),('Manari',2889,'PE'),('Maraial',2890,'PE'),('Mirandiba',2891,'PE'),('Moreilândia',2892,'PE'),('Moreno',2893,'PE'),('Nazaré da Mata',2894,'PE'),('Olinda',2895,'PE'),('Orobó',2896,'PE'),('Orocó',2897,'PE'),('Ouricuri',2898,'PE'),('Palmares',2899,'PE'),('Palmeirina',2900,'PE'),('Panelas',2901,'PE'),('Paranatama',2902,'PE'),('Parnamirim',2903,'PE'),('Passira',2904,'PE'),('Paudalho',2905,'PE'),('Paulista',2906,'PE'),('Pedra',2907,'PE'),('Pesqueira',2908,'PE'),('Petrolândia',2909,'PE'),('Petrolina',2910,'PE'),('Poção',2911,'PE'),('Pombos',2912,'PE'),('Primavera',2913,'PE'),('Quipapá',2914,'PE'),('Quixaba',2915,'PE'),('Recife',2916,'PE'),('Riacho das Almas',2917,'PE'),('Ribeirão',2918,'PE'),('Rio Formoso',2919,'PE'),('Sairé',2920,'PE'),('Salgadinho',2921,'PE'),('Salgueiro',2922,'PE'),('Saloá',2923,'PE'),('Sanharó',2924,'PE'),('Santa Cruz',2925,'PE'),('Santa Cruz da Baixa Verde',2926,'PE'),('Santa Cruz do Capibaribe',2927,'PE'),('Santa Filomena',2928,'PE'),('Santa Maria da Boa Vista',2929,'PE'),('Santa Maria do Cambucá',2930,'PE'),('Santa Terezinha',2931,'PE'),('São Benedito do Sul',2932,'PE'),('São Bento do Una',2933,'PE'),('São Caitano',2934,'PE'),('São João',2935,'PE'),('São Joaquim do Monte',2936,'PE'),('São José da Coroa Grande',2937,'PE'),('São José do Belmonte',2938,'PE'),('São José do Egito',2939,'PE'),('São Lourenço da Mata',2940,'PE'),('São Vicente Ferrer',2941,'PE'),('Serra Talhada',2942,'PE'),('Serrita',2943,'PE'),('Sertânia',2944,'PE'),('Sirinhaém',2945,'PE'),('Solidão',2946,'PE'),('Surubim',2947,'PE'),('Tabira',2948,'PE'),('Tacaimbó',2949,'PE'),('Tacaratu',2950,'PE'),('Tamandaré',2951,'PE'),('Taquaritinga do Norte',2952,'PE'),('Terezinha',2953,'PE'),('Terra Nova',2954,'PE'),('Timbaúba',2955,'PE'),('Toritama',2956,'PE'),('Tracunhaém',2957,'PE'),('Trindade',2958,'PE'),('Triunfo',2959,'PE'),('Tupanatinga',2960,'PE'),('Tuparetama',2961,'PE'),('Venturosa',2962,'PE'),('Verdejante',2963,'PE'),('Vertente do Lério',2964,'PE'),('Vertentes',2965,'PE'),('Vicência',2966,'PE'),('Vitória de Santo Antão',2967,'PE'),('Xexéu',2968,'PE'),('Acauã',2969,'PI'),('Agricolândia',2970,'PI'),('Água Branca',2971,'PI'),('Alagoinha do Piauí',2972,'PI'),('Alegrete do Piauí',2973,'PI'),('Alto Longá',2974,'PI'),('Altos',2975,'PI'),('Alvorada do Gurguéia',2976,'PI'),('Amarante',2977,'PI'),('Angical do Piauí',2978,'PI'),('Anísio de Abreu',2979,'PI'),('Antônio Almeida',2980,'PI'),('Aroazes',2981,'PI'),('Aroeiras do Itaim',2982,'PI'),('Arraial',2983,'PI'),('Assunção do Piauí',2984,'PI'),('Avelino Lopes',2985,'PI'),('Baixa Grande do Ribeiro',2986,'PI'),('Barra d`Alcântara',2987,'PI'),('Barras',2988,'PI'),('Barreiras do Piauí',2989,'PI'),('Barro Duro',2990,'PI'),('Batalha',2991,'PI'),('Bela Vista do Piauí',2992,'PI'),('Belém do Piauí',2993,'PI'),('Beneditinos',2994,'PI'),('Bertolínia',2995,'PI'),('Betânia do Piauí',2996,'PI'),('Boa Hora',2997,'PI'),('Bocaina',2998,'PI'),('Bom Jesus',2999,'PI'),('Bom Princípio do Piauí',3000,'PI'),('Bonfim do Piauí',3001,'PI'),('Boqueirão do Piauí',3002,'PI'),('Brasileira',3003,'PI'),('Brejo do Piauí',3004,'PI'),('Buriti dos Lopes',3005,'PI'),('Buriti dos Montes',3006,'PI'),('Cabeceiras do Piauí',3007,'PI'),('Cajazeiras do Piauí',3008,'PI'),('Cajueiro da Praia',3009,'PI'),('Caldeirão Grande do Piauí',3010,'PI'),('Campinas do Piauí',3011,'PI'),('Campo Alegre do Fidalgo',3012,'PI'),('Campo Grande do Piauí',3013,'PI'),('Campo Largo do Piauí',3014,'PI'),('Campo Maior',3015,'PI'),('Canavieira',3016,'PI'),('Canto do Buriti',3017,'PI'),('Capitão de Campos',3018,'PI'),('Capitão Gervásio Oliveira',3019,'PI'),('Caracol',3020,'PI'),('Caraúbas do Piauí',3021,'PI'),('Caridade do Piauí',3022,'PI'),('Castelo do Piauí',3023,'PI'),('Caxingó',3024,'PI'),('Cocal',3025,'PI'),('Cocal de Telha',3026,'PI'),('Cocal dos Alves',3027,'PI'),('Coivaras',3028,'PI'),('Colônia do Gurguéia',3029,'PI'),('Colônia do Piauí',3030,'PI'),('Conceição do Canindé',3031,'PI'),('Coronel José Dias',3032,'PI'),('Corrente',3033,'PI'),('Cristalândia do Piauí',3034,'PI'),('Cristino Castro',3035,'PI'),('Curimatá',3036,'PI'),('Currais',3037,'PI'),('Curral Novo do Piauí',3038,'PI'),('Curralinhos',3039,'PI'),('Demerval Lobão',3040,'PI'),('Dirceu Arcoverde',3041,'PI'),('Dom Expedito Lopes',3042,'PI'),('Dom Inocêncio',3043,'PI'),('Domingos Mourão',3044,'PI'),('Elesbão Veloso',3045,'PI'),('Eliseu Martins',3046,'PI'),('Esperantina',3047,'PI'),('Fartura do Piauí',3048,'PI'),('Flores do Piauí',3049,'PI'),('Floresta do Piauí',3050,'PI'),('Floriano',3051,'PI'),('Francinópolis',3052,'PI'),('Francisco Ayres',3053,'PI'),('Francisco Macedo',3054,'PI'),('Francisco Santos',3055,'PI'),('Fronteiras',3056,'PI'),('Geminiano',3057,'PI'),('Gilbués',3058,'PI'),('Guadalupe',3059,'PI'),('Guaribas',3060,'PI'),('Hugo Napoleão',3061,'PI'),('Ilha Grande',3062,'PI'),('Inhuma',3063,'PI'),('Ipiranga do Piauí',3064,'PI'),('Isaías Coelho',3065,'PI'),('Itainópolis',3066,'PI'),('Itaueira',3067,'PI'),('Jacobina do Piauí',3068,'PI'),('Jaicós',3069,'PI'),('Jardim do Mulato',3070,'PI'),('Jatobá do Piauí',3071,'PI'),('Jerumenha',3072,'PI'),('João Costa',3073,'PI'),('Joaquim Pires',3074,'PI'),('Joca Marques',3075,'PI'),('José de Freitas',3076,'PI'),('Juazeiro do Piauí',3077,'PI'),('Júlio Borges',3078,'PI'),('Jurema',3079,'PI'),('Lagoa Alegre',3080,'PI'),('Lagoa de São Francisco',3081,'PI'),('Lagoa do Barro do Piauí',3082,'PI'),('Lagoa do Piauí',3083,'PI'),('Lagoa do Sítio',3084,'PI'),('Lagoinha do Piauí',3085,'PI'),('Landri Sales',3086,'PI'),('Luís Correia',3087,'PI'),('Luzilândia',3088,'PI'),('Madeiro',3089,'PI'),('Manoel Emídio',3090,'PI'),('Marcolândia',3091,'PI'),('Marcos Parente',3092,'PI'),('Massapê do Piauí',3093,'PI'),('Matias Olímpio',3094,'PI'),('Miguel Alves',3095,'PI'),('Miguel Leão',3096,'PI'),('Milton Brandão',3097,'PI'),('Monsenhor Gil',3098,'PI'),('Monsenhor Hipólito',3099,'PI'),('Monte Alegre do Piauí',3100,'PI'),('Morro Cabeça no Tempo',3101,'PI'),('Morro do Chapéu do Piauí',3102,'PI'),('Murici dos Portelas',3103,'PI'),('Nazaré do Piauí',3104,'PI'),('Nossa Senhora de Nazaré',3105,'PI'),('Nossa Senhora dos Remédios',3106,'PI'),('Nova Santa Rita',3107,'PI'),('Novo Oriente do Piauí',3108,'PI'),('Novo Santo Antônio',3109,'PI'),('Oeiras',3110,'PI'),('Olho d`Água do Piauí',3111,'PI'),('Padre Marcos',3112,'PI'),('Paes Landim',3113,'PI'),('Pajeú do Piauí',3114,'PI'),('Palmeira do Piauí',3115,'PI'),('Palmeirais',3116,'PI'),('Paquetá',3117,'PI'),('Parnaguá',3118,'PI'),('Parnaíba',3119,'PI'),('Passagem Franca do Piauí',3120,'PI'),('Patos do Piauí',3121,'PI'),('Pau d`Arco do Piauí',3122,'PI'),('Paulistana',3123,'PI'),('Pavussu',3124,'PI'),('Pedro II',3125,'PI'),('Pedro Laurentino',3126,'PI'),('Picos',3127,'PI'),('Pimenteiras',3128,'PI'),('Pio IX',3129,'PI'),('Piracuruca',3130,'PI'),('Piripiri',3131,'PI'),('Porto',3132,'PI'),('Porto Alegre do Piauí',3133,'PI'),('Prata do Piauí',3134,'PI'),('Queimada Nova',3135,'PI'),('Redenção do Gurguéia',3136,'PI'),('Regeneração',3137,'PI'),('Riacho Frio',3138,'PI'),('Ribeira do Piauí',3139,'PI'),('Ribeiro Gonçalves',3140,'PI'),('Rio Grande do Piauí',3141,'PI'),('Santa Cruz do Piauí',3142,'PI'),('Santa Cruz dos Milagres',3143,'PI'),('Santa Filomena',3144,'PI'),('Santa Luz',3145,'PI'),('Santa Rosa do Piauí',3146,'PI'),('Santana do Piauí',3147,'PI'),('Santo Antônio de Lisboa',3148,'PI'),('Santo Antônio dos Milagres',3149,'PI'),('Santo Inácio do Piauí',3150,'PI'),('São Braz do Piauí',3151,'PI'),('São Félix do Piauí',3152,'PI'),('São Francisco de Assis do Piauí',3153,'PI'),('São Francisco do Piauí',3154,'PI'),('São Gonçalo do Gurguéia',3155,'PI'),('São Gonçalo do Piauí',3156,'PI'),('São João da Canabrava',3157,'PI'),('São João da Fronteira',3158,'PI'),('São João da Serra',3159,'PI'),('São João da Varjota',3160,'PI'),('São João do Arraial',3161,'PI'),('São João do Piauí',3162,'PI'),('São José do Divino',3163,'PI'),('São José do Peixe',3164,'PI'),('São José do Piauí',3165,'PI'),('São Julião',3166,'PI'),('São Lourenço do Piauí',3167,'PI'),('São Luis do Piauí',3168,'PI'),('São Miguel da Baixa Grande',3169,'PI'),('São Miguel do Fidalgo',3170,'PI'),('São Miguel do Tapuio',3171,'PI'),('São Pedro do Piauí',3172,'PI'),('São Raimundo Nonato',3173,'PI'),('Sebastião Barros',3174,'PI'),('Sebastião Leal',3175,'PI'),('Sigefredo Pacheco',3176,'PI'),('Simões',3177,'PI'),('Simplício Mendes',3178,'PI'),('Socorro do Piauí',3179,'PI'),('Sussuapara',3180,'PI'),('Tamboril do Piauí',3181,'PI'),('Tanque do Piauí',3182,'PI'),('Teresina',3183,'PI'),('União',3184,'PI'),('Uruçuí',3185,'PI'),('Valença do Piauí',3186,'PI'),('Várzea Branca',3187,'PI'),('Várzea Grande',3188,'PI'),('Vera Mendes',3189,'PI'),('Vila Nova do Piauí',3190,'PI'),('Wall Ferraz',3191,'PI'),('Abatiá',3192,'PR'),('Adrianópolis',3193,'PR'),('Agudos do Sul',3194,'PR'),('Almirante Tamandaré',3195,'PR'),('Altamira do Paraná',3196,'PR'),('Alto Paraíso',3197,'PR'),('Alto Paraná',3198,'PR'),('Alto Piquiri',3199,'PR'),('Altônia',3200,'PR'),('Alvorada do Sul',3201,'PR'),('Amaporã',3202,'PR'),('Ampére',3203,'PR'),('Anahy',3204,'PR'),('Andirá',3205,'PR'),('Ângulo',3206,'PR'),('Antonina',3207,'PR'),('Antônio Olinto',3208,'PR'),('Apucarana',3209,'PR'),('Arapongas',3210,'PR'),('Arapoti',3211,'PR'),('Arapuã',3212,'PR'),('Araruna',3213,'PR'),('Araucária',3214,'PR'),('Ariranha do Ivaí',3215,'PR'),('Assaí',3216,'PR'),('Assis Chateaubriand',3217,'PR'),('Astorga',3218,'PR'),('Atalaia',3219,'PR'),('Balsa Nova',3220,'PR'),('Bandeirantes',3221,'PR'),('Barbosa Ferraz',3222,'PR'),('Barra do Jacaré',3223,'PR'),('Barracão',3224,'PR'),('Bela Vista da Caroba',3225,'PR'),('Bela Vista do Paraíso',3226,'PR'),('Bituruna',3227,'PR'),('Boa Esperança',3228,'PR'),('Boa Esperança do Iguaçu',3229,'PR'),('Boa Ventura de São Roque',3230,'PR'),('Boa Vista da Aparecida',3231,'PR'),('Bocaiúva do Sul',3232,'PR'),('Bom Jesus do Sul',3233,'PR'),('Bom Sucesso',3234,'PR'),('Bom Sucesso do Sul',3235,'PR'),('Borrazópolis',3236,'PR'),('Braganey',3237,'PR'),('Brasilândia do Sul',3238,'PR'),('Cafeara',3239,'PR'),('Cafelândia',3240,'PR'),('Cafezal do Sul',3241,'PR'),('Califórnia',3242,'PR'),('Cambará',3243,'PR'),('Cambé',3244,'PR'),('Cambira',3245,'PR'),('Campina da Lagoa',3246,'PR'),('Campina do Simão',3247,'PR'),('Campina Grande do Sul',3248,'PR'),('Campo Bonito',3249,'PR'),('Campo do Tenente',3250,'PR'),('Campo Largo',3251,'PR'),('Campo Magro',3252,'PR'),('Campo Mourão',3253,'PR'),('Cândido de Abreu',3254,'PR'),('Candói',3255,'PR'),('Cantagalo',3256,'PR'),('Capanema',3257,'PR'),('Capitão Leônidas Marques',3258,'PR'),('Carambeí',3259,'PR'),('Carlópolis',3260,'PR'),('Cascavel',3261,'PR'),('Castro',3262,'PR'),('Catanduvas',3263,'PR'),('Centenário do Sul',3264,'PR'),('Cerro Azul',3265,'PR'),('Céu Azul',3266,'PR'),('Chopinzinho',3267,'PR'),('Cianorte',3268,'PR'),('Cidade Gaúcha',3269,'PR'),('Clevelândia',3270,'PR'),('Colombo',3271,'PR'),('Colorado',3272,'PR'),('Congonhinhas',3273,'PR'),('Conselheiro Mairinck',3274,'PR'),('Contenda',3275,'PR'),('Corbélia',3276,'PR'),('Cornélio Procópio',3277,'PR'),('Coronel Domingos Soares',3278,'PR'),('Coronel Vivida',3279,'PR'),('Corumbataí do Sul',3280,'PR'),('Cruz Machado',3281,'PR'),('Cruzeiro do Iguaçu',3282,'PR'),('Cruzeiro do Oeste',3283,'PR'),('Cruzeiro do Sul',3284,'PR'),('Cruzmaltina',3285,'PR'),('Curitiba',3286,'PR'),('Curiúva',3287,'PR'),('Diamante d`Oeste',3288,'PR'),('Diamante do Norte',3289,'PR'),('Diamante do Sul',3290,'PR'),('Dois Vizinhos',3291,'PR'),('Douradina',3292,'PR'),('Doutor Camargo',3293,'PR'),('Doutor Ulysses',3294,'PR'),('Enéas Marques',3295,'PR'),('Engenheiro Beltrão',3296,'PR'),('Entre Rios do Oeste',3297,'PR'),('Esperança Nova',3298,'PR'),('Espigão Alto do Iguaçu',3299,'PR'),('Farol',3300,'PR'),('Faxinal',3301,'PR'),('Fazenda Rio Grande',3302,'PR'),('Fênix',3303,'PR'),('Fernandes Pinheiro',3304,'PR'),('Figueira',3305,'PR'),('Flor da Serra do Sul',3306,'PR'),('Floraí',3307,'PR'),('Floresta',3308,'PR'),('Florestópolis',3309,'PR'),('Flórida',3310,'PR'),('Formosa do Oeste',3311,'PR'),('Foz do Iguaçu',3312,'PR'),('Foz do Jordão',3313,'PR'),('Francisco Alves',3314,'PR'),('Francisco Beltrão',3315,'PR'),('General Carneiro',3316,'PR'),('Godoy Moreira',3317,'PR'),('Goioerê',3318,'PR'),('Goioxim',3319,'PR'),('Grandes Rios',3320,'PR'),('Guaíra',3321,'PR'),('Guairaçá',3322,'PR'),('Guamiranga',3323,'PR'),('Guapirama',3324,'PR'),('Guaporema',3325,'PR'),('Guaraci',3326,'PR'),('Guaraniaçu',3327,'PR'),('Guarapuava',3328,'PR'),('Guaraqueçaba',3329,'PR'),('Guaratuba',3330,'PR'),('Honório Serpa',3331,'PR'),('Ibaiti',3332,'PR'),('Ibema',3333,'PR'),('Ibiporã',3334,'PR'),('Icaraíma',3335,'PR'),('Iguaraçu',3336,'PR'),('Iguatu',3337,'PR'),('Imbaú',3338,'PR'),('Imbituva',3339,'PR'),('Inácio Martins',3340,'PR'),('Inajá',3341,'PR'),('Indianópolis',3342,'PR'),('Ipiranga',3343,'PR'),('Iporã',3344,'PR'),('Iracema do Oeste',3345,'PR'),('Irati',3346,'PR'),('Iretama',3347,'PR'),('Itaguajé',3348,'PR'),('Itaipulândia',3349,'PR'),('Itambaracá',3350,'PR'),('Itambé',3351,'PR'),('Itapejara d`Oeste',3352,'PR'),('Itaperuçu',3353,'PR'),('Itaúna do Sul',3354,'PR'),('Ivaí',3355,'PR'),('Ivaiporã',3356,'PR'),('Ivaté',3357,'PR'),('Ivatuba',3358,'PR'),('Jaboti',3359,'PR'),('Jacarezinho',3360,'PR'),('Jaguapitã',3361,'PR'),('Jaguariaíva',3362,'PR'),('Jandaia do Sul',3363,'PR'),('Janiópolis',3364,'PR'),('Japira',3365,'PR'),('Japurá',3366,'PR'),('Jardim Alegre',3367,'PR'),('Jardim Olinda',3368,'PR'),('Jataizinho',3369,'PR'),('Jesuítas',3370,'PR'),('Joaquim Távora',3371,'PR'),('Jundiaí do Sul',3372,'PR'),('Juranda',3373,'PR'),('Jussara',3374,'PR'),('Kaloré',3375,'PR'),('Lapa',3376,'PR'),('Laranjal',3377,'PR'),('Laranjeiras do Sul',3378,'PR'),('Leópolis',3379,'PR'),('Lidianópolis',3380,'PR'),('Lindoeste',3381,'PR'),('Loanda',3382,'PR'),('Lobato',3383,'PR'),('Londrina',3384,'PR'),('Luiziana',3385,'PR'),('Lunardelli',3386,'PR'),('Lupionópolis',3387,'PR'),('Mallet',3388,'PR'),('Mamborê',3389,'PR'),('Mandaguaçu',3390,'PR'),('Mandaguari',3391,'PR'),('Mandirituba',3392,'PR'),('Manfrinópolis',3393,'PR'),('Mangueirinha',3394,'PR'),('Manoel Ribas',3395,'PR'),('Marechal Cândido Rondon',3396,'PR'),('Maria Helena',3397,'PR'),('Marialva',3398,'PR'),('Marilândia do Sul',3399,'PR'),('Marilena',3400,'PR'),('Mariluz',3401,'PR'),('Maringá',3402,'PR'),('Mariópolis',3403,'PR'),('Maripá',3404,'PR'),('Marmeleiro',3405,'PR'),('Marquinho',3406,'PR'),('Marumbi',3407,'PR'),('Matelândia',3408,'PR'),('Matinhos',3409,'PR'),('Mato Rico',3410,'PR'),('Mauá da Serra',3411,'PR'),('Medianeira',3412,'PR'),('Mercedes',3413,'PR'),('Mirador',3414,'PR'),('Miraselva',3415,'PR'),('Missal',3416,'PR'),('Moreira Sales',3417,'PR'),('Morretes',3418,'PR'),('Munhoz de Melo',3419,'PR'),('Nossa Senhora das Graças',3420,'PR'),('Nova Aliança do Ivaí',3421,'PR'),('Nova América da Colina',3422,'PR'),('Nova Aurora',3423,'PR'),('Nova Cantu',3424,'PR'),('Nova Esperança',3425,'PR'),('Nova Esperança do Sudoeste',3426,'PR'),('Nova Fátima',3427,'PR'),('Nova Laranjeiras',3428,'PR'),('Nova Londrina',3429,'PR'),('Nova Olímpia',3430,'PR'),('Nova Prata do Iguaçu',3431,'PR'),('Nova Santa Bárbara',3432,'PR'),('Nova Santa Rosa',3433,'PR'),('Nova Tebas',3434,'PR'),('Novo Itacolomi',3435,'PR'),('Ortigueira',3436,'PR'),('Ourizona',3437,'PR'),('Ouro Verde do Oeste',3438,'PR'),('Paiçandu',3439,'PR'),('Palmas',3440,'PR'),('Palmeira',3441,'PR'),('Palmital',3442,'PR'),('Palotina',3443,'PR'),('Paraíso do Norte',3444,'PR'),('Paranacity',3445,'PR'),('Paranaguá',3446,'PR'),('Paranapoema',3447,'PR'),('Paranavaí',3448,'PR'),('Pato Bragado',3449,'PR'),('Pato Branco',3450,'PR'),('Paula Freitas',3451,'PR'),('Paulo Frontin',3452,'PR'),('Peabiru',3453,'PR'),('Perobal',3454,'PR'),('Pérola',3455,'PR'),('Pérola d`Oeste',3456,'PR'),('Piên',3457,'PR'),('Pinhais',3458,'PR'),('Pinhal de São Bento',3459,'PR'),('Pinhalão',3460,'PR'),('Pinhão',3461,'PR'),('Piraí do Sul',3462,'PR'),('Piraquara',3463,'PR'),('Pitanga',3464,'PR'),('Pitangueiras',3465,'PR'),('Planaltina do Paraná',3466,'PR'),('Planalto',3467,'PR'),('Ponta Grossa',3468,'PR'),('Pontal do Paraná',3469,'PR'),('Porecatu',3470,'PR'),('Porto Amazonas',3471,'PR'),('Porto Barreiro',3472,'PR'),('Porto Rico',3473,'PR'),('Porto Vitória',3474,'PR'),('Prado Ferreira',3475,'PR'),('Pranchita',3476,'PR'),('Presidente Castelo Branco',3477,'PR'),('Primeiro de Maio',3478,'PR'),('Prudentópolis',3479,'PR'),('Quarto Centenário',3480,'PR'),('Quatiguá',3481,'PR'),('Quatro Barras',3482,'PR'),('Quatro Pontes',3483,'PR'),('Quedas do Iguaçu',3484,'PR'),('Querência do Norte',3485,'PR'),('Quinta do Sol',3486,'PR'),('Quitandinha',3487,'PR'),('Ramilândia',3488,'PR'),('Rancho Alegre',3489,'PR'),('Rancho Alegre d`Oeste',3490,'PR'),('Realeza',3491,'PR'),('Rebouças',3492,'PR'),('Renascença',3493,'PR'),('Reserva',3494,'PR'),('Reserva do Iguaçu',3495,'PR'),('Ribeirão Claro',3496,'PR'),('Ribeirão do Pinhal',3497,'PR'),('Rio Azul',3498,'PR'),('Rio Bom',3499,'PR'),('Rio Bonito do Iguaçu',3500,'PR'),('Rio Branco do Ivaí',3501,'PR'),('Rio Branco do Sul',3502,'PR'),('Rio Negro',3503,'PR'),('Rolândia',3504,'PR'),('Roncador',3505,'PR'),('Rondon',3506,'PR'),('Rosário do Ivaí',3507,'PR'),('Sabáudia',3508,'PR'),('Salgado Filho',3509,'PR'),('Salto do Itararé',3510,'PR'),('Salto do Lontra',3511,'PR'),('Santa Amélia',3512,'PR'),('Santa Cecília do Pavão',3513,'PR'),('Santa Cruz de Monte Castelo',3514,'PR'),('Santa Fé',3515,'PR'),('Santa Helena',3516,'PR'),('Santa Inês',3517,'PR'),('Santa Isabel do Ivaí',3518,'PR'),('Santa Izabel do Oeste',3519,'PR'),('Santa Lúcia',3520,'PR'),('Santa Maria do Oeste',3521,'PR'),('Santa Mariana',3522,'PR'),('Santa Mônica',3523,'PR'),('Santa Tereza do Oeste',3524,'PR'),('Santa Terezinha de Itaipu',3525,'PR'),('Santana do Itararé',3526,'PR'),('Santo Antônio da Platina',3527,'PR'),('Santo Antônio do Caiuá',3528,'PR'),('Santo Antônio do Paraíso',3529,'PR'),('Santo Antônio do Sudoeste',3530,'PR'),('Santo Inácio',3531,'PR'),('São Carlos do Ivaí',3532,'PR'),('São Jerônimo da Serra',3533,'PR'),('São João',3534,'PR'),('São João do Caiuá',3535,'PR'),('São João do Ivaí',3536,'PR'),('São João do Triunfo',3537,'PR'),('São Jorge d`Oeste',3538,'PR'),('São Jorge do Ivaí',3539,'PR'),('São Jorge do Patrocínio',3540,'PR'),('São José da Boa Vista',3541,'PR'),('São José das Palmeiras',3542,'PR'),('São José dos Pinhais',3543,'PR'),('São Manoel do Paraná',3544,'PR'),('São Mateus do Sul',3545,'PR'),('São Miguel do Iguaçu',3546,'PR'),('São Pedro do Iguaçu',3547,'PR'),('São Pedro do Ivaí',3548,'PR'),('São Pedro do Paraná',3549,'PR'),('São Sebastião da Amoreira',3550,'PR'),('São Tomé',3551,'PR'),('Sapopema',3552,'PR'),('Sarandi',3553,'PR'),('Saudade do Iguaçu',3554,'PR'),('Sengés',3555,'PR'),('Serranópolis do Iguaçu',3556,'PR'),('Sertaneja',3557,'PR'),('Sertanópolis',3558,'PR'),('Siqueira Campos',3559,'PR'),('Sulina',3560,'PR'),('Tamarana',3561,'PR'),('Tamboara',3562,'PR'),('Tapejara',3563,'PR'),('Tapira',3564,'PR'),('Teixeira Soares',3565,'PR'),('Telêmaco Borba',3566,'PR'),('Terra Boa',3567,'PR'),('Terra Rica',3568,'PR'),('Terra Roxa',3569,'PR'),('Tibagi',3570,'PR'),('Tijucas do Sul',3571,'PR'),('Toledo',3572,'PR'),('Tomazina',3573,'PR'),('Três Barras do Paraná',3574,'PR'),('Tunas do Paraná',3575,'PR'),('Tuneiras do Oeste',3576,'PR'),('Tupãssi',3577,'PR'),('Turvo',3578,'PR'),('Ubiratã',3579,'PR'),('Umuarama',3580,'PR'),('União da Vitória',3581,'PR'),('Uniflor',3582,'PR'),('Uraí',3583,'PR'),('Ventania',3584,'PR'),('Vera Cruz do Oeste',3585,'PR'),('Verê',3586,'PR'),('Virmond',3587,'PR'),('Vitorino',3588,'PR'),('Wenceslau Braz',3589,'PR'),('Xambrê',3590,'PR'),('Angra dos Reis',3591,'RJ'),('Aperibé',3592,'RJ'),('Araruama',3593,'RJ'),('Areal',3594,'RJ'),('Armação dos Búzios',3595,'RJ'),('Arraial do Cabo',3596,'RJ'),('Barra do Piraí',3597,'RJ'),('Barra Mansa',3598,'RJ'),('Belford Roxo',3599,'RJ'),('Bom Jardim',3600,'RJ'),('Bom Jesus do Itabapoana',3601,'RJ'),('Cabo Frio',3602,'RJ'),('Cachoeiras de Macacu',3603,'RJ'),('Cambuci',3604,'RJ'),('Campos dos Goytacazes',3605,'RJ'),('Cantagalo',3606,'RJ'),('Carapebus',3607,'RJ'),('Cardoso Moreira',3608,'RJ'),('Carmo',3609,'RJ'),('Casimiro de Abreu',3610,'RJ'),('Comendador Levy Gasparian',3611,'RJ'),('Conceição de Macabu',3612,'RJ'),('Cordeiro',3613,'RJ'),('Duas Barras',3614,'RJ'),('Duque de Caxias',3615,'RJ'),('Engenheiro Paulo de Frontin',3616,'RJ'),('Guapimirim',3617,'RJ'),('Iguaba Grande',3618,'RJ'),('Itaboraí',3619,'RJ'),('Itaguaí',3620,'RJ'),('Italva',3621,'RJ'),('Itaocara',3622,'RJ'),('Itaperuna',3623,'RJ'),('Itatiaia',3624,'RJ'),('Japeri',3625,'RJ'),('Laje do Muriaé',3626,'RJ'),('Macaé',3627,'RJ'),('Macuco',3628,'RJ'),('Magé',3629,'RJ'),('Mangaratiba',3630,'RJ'),('Maricá',3631,'RJ'),('Mendes',3632,'RJ'),('Mesquita',3633,'RJ'),('Miguel Pereira',3634,'RJ'),('Miracema',3635,'RJ'),('Natividade',3636,'RJ'),('Nilópolis',3637,'RJ'),('Niterói',3638,'RJ'),('Nova Friburgo',3639,'RJ'),('Nova Iguaçu',3640,'RJ'),('Paracambi',3641,'RJ'),('Paraíba do Sul',3642,'RJ'),('Parati',3643,'RJ'),('Paty do Alferes',3644,'RJ'),('Petrópolis',3645,'RJ'),('Pinheiral',3646,'RJ'),('Piraí',3647,'RJ'),('Porciúncula',3648,'RJ'),('Porto Real',3649,'RJ'),('Quatis',3650,'RJ'),('Queimados',3651,'RJ'),('Quissamã',3652,'RJ'),('Resende',3653,'RJ'),('Rio Bonito',3654,'RJ'),('Rio Claro',3655,'RJ'),('Rio das Flores',3656,'RJ'),('Rio das Ostras',3657,'RJ'),('Rio de Janeiro',3658,'RJ'),('Santa Maria Madalena',3659,'RJ'),('Santo Antônio de Pádua',3660,'RJ'),('São Fidélis',3661,'RJ'),('São Francisco de Itabapoana',3662,'RJ'),('São Gonçalo',3663,'RJ'),('São João da Barra',3664,'RJ'),('São João de Meriti',3665,'RJ'),('São José de Ubá',3666,'RJ'),('São José do Vale do Rio Pret',3667,'RJ'),('São Pedro da Aldeia',3668,'RJ'),('São Sebastião do Alto',3669,'RJ'),('Sapucaia',3670,'RJ'),('Saquarema',3671,'RJ'),('Seropédica',3672,'RJ'),('Silva Jardim',3673,'RJ'),('Sumidouro',3674,'RJ'),('Tanguá',3675,'RJ'),('Teresópolis',3676,'RJ'),('Trajano de Morais',3677,'RJ'),('Três Rios',3678,'RJ'),('Valença',3679,'RJ'),('Varre-Sai',3680,'RJ'),('Vassouras',3681,'RJ'),('Volta Redonda',3682,'RJ'),('Acari',3683,'RN'),('Açu',3684,'RN'),('Afonso Bezerra',3685,'RN'),('Água Nova',3686,'RN'),('Alexandria',3687,'RN'),('Almino Afonso',3688,'RN'),('Alto do Rodrigues',3689,'RN'),('Angicos',3690,'RN'),('Antônio Martins',3691,'RN'),('Apodi',3692,'RN'),('Areia Branca',3693,'RN'),('Arês',3694,'RN'),('Augusto Severo',3695,'RN'),('Baía Formosa',3696,'RN'),('Baraúna',3697,'RN'),('Barcelona',3698,'RN'),('Bento Fernandes',3699,'RN'),('Bodó',3700,'RN'),('Bom Jesus',3701,'RN'),('Brejinho',3702,'RN'),('Caiçara do Norte',3703,'RN'),('Caiçara do Rio do Vento',3704,'RN'),('Caicó',3705,'RN'),('Campo Redondo',3706,'RN'),('Canguaretama',3707,'RN'),('Caraúbas',3708,'RN'),('Carnaúba dos Dantas',3709,'RN'),('Carnaubais',3710,'RN'),('Ceará-Mirim',3711,'RN'),('Cerro Corá',3712,'RN'),('Coronel Ezequiel',3713,'RN'),('Coronel João Pessoa',3714,'RN'),('Cruzeta',3715,'RN'),('Currais Novos',3716,'RN'),('Doutor Severiano',3717,'RN'),('Encanto',3718,'RN'),('Equador',3719,'RN'),('Espírito Santo',3720,'RN'),('Extremoz',3721,'RN'),('Felipe Guerra',3722,'RN'),('Fernando Pedroza',3723,'RN'),('Florânia',3724,'RN'),('Francisco Dantas',3725,'RN'),('Frutuoso Gomes',3726,'RN'),('Galinhos',3727,'RN'),('Goianinha',3728,'RN'),('Governador Dix-Sept Rosado',3729,'RN'),('Grossos',3730,'RN'),('Guamaré',3731,'RN'),('Ielmo Marinho',3732,'RN'),('Ipanguaçu',3733,'RN'),('Ipueira',3734,'RN'),('Itajá',3735,'RN'),('Itaú',3736,'RN'),('Jaçanã',3737,'RN'),('Jandaíra',3738,'RN'),('Janduís',3739,'RN'),('Januário Cicco',3740,'RN'),('Japi',3741,'RN'),('Jardim de Angicos',3742,'RN'),('Jardim de Piranhas',3743,'RN'),('Jardim do Seridó',3744,'RN'),('João Câmara',3745,'RN'),('João Dias',3746,'RN'),('José da Penha',3747,'RN'),('Jucurutu',3748,'RN'),('Jundiá',3749,'RN'),('Lagoa d`Anta',3750,'RN'),('Lagoa de Pedras',3751,'RN'),('Lagoa de Velhos',3752,'RN'),('Lagoa Nova',3753,'RN'),('Lagoa Salgada',3754,'RN'),('Lajes',3755,'RN'),('Lajes Pintadas',3756,'RN'),('Lucrécia',3757,'RN'),('Luís Gomes',3758,'RN'),('Macaíba',3759,'RN'),('Macau',3760,'RN'),('Major Sales',3761,'RN'),('Marcelino Vieira',3762,'RN'),('Martins',3763,'RN'),('Maxaranguape',3764,'RN'),('Messias Targino',3765,'RN'),('Montanhas',3766,'RN'),('Monte Alegre',3767,'RN'),('Monte das Gameleiras',3768,'RN'),('Mossoró',3769,'RN'),('Natal',3770,'RN'),('Nísia Floresta',3771,'RN'),('Nova Cruz',3772,'RN'),('Olho-d`Água do Borges',3773,'RN'),('Ouro Branco',3774,'RN'),('Paraná',3775,'RN'),('Paraú',3776,'RN'),('Parazinho',3777,'RN'),('Parelhas',3778,'RN'),('Parnamirim',3779,'RN'),('Passa e Fica',3780,'RN'),('Passagem',3781,'RN'),('Patu',3782,'RN'),('Pau dos Ferros',3783,'RN'),('Pedra Grande',3784,'RN'),('Pedra Preta',3785,'RN'),('Pedro Avelino',3786,'RN'),('Pedro Velho',3787,'RN'),('Pendências',3788,'RN'),('Pilões',3789,'RN'),('Poço Branco',3790,'RN'),('Portalegre',3791,'RN'),('Porto do Mangue',3792,'RN'),('Presidente Juscelino',3793,'RN'),('Pureza',3794,'RN'),('Rafael Fernandes',3795,'RN'),('Rafael Godeiro',3796,'RN'),('Riacho da Cruz',3797,'RN'),('Riacho de Santana',3798,'RN'),('Riachuelo',3799,'RN'),('Rio do Fogo',3800,'RN'),('Rodolfo Fernandes',3801,'RN'),('Ruy Barbosa',3802,'RN'),('Santa Cruz',3803,'RN'),('Santa Maria',3804,'RN'),('Santana do Matos',3805,'RN'),('Santana do Seridó',3806,'RN'),('Santo Antônio',3807,'RN'),('São Bento do Norte',3808,'RN'),('São Bento do Trairí',3809,'RN'),('São Fernando',3810,'RN'),('São Francisco do Oeste',3811,'RN'),('São Gonçalo do Amarante',3812,'RN'),('São João do Sabugi',3813,'RN'),('São José de Mipibu',3814,'RN'),('São José do Campestre',3815,'RN'),('São José do Seridó',3816,'RN'),('São Miguel',3817,'RN'),('São Miguel do Gostoso',3818,'RN'),('São Paulo do Potengi',3819,'RN'),('São Pedro',3820,'RN'),('São Rafael',3821,'RN'),('São Tomé',3822,'RN'),('São Vicente',3823,'RN'),('Senador Elói de Souza',3824,'RN'),('Senador Georgino Avelino',3825,'RN'),('Serra de São Bento',3826,'RN'),('Serra do Mel',3827,'RN'),('Serra Negra do Norte',3828,'RN'),('Serrinha',3829,'RN'),('Serrinha dos Pintos',3830,'RN'),('Severiano Melo',3831,'RN'),('Sítio Novo',3832,'RN'),('Taboleiro Grande',3833,'RN'),('Taipu',3834,'RN'),('Tangará',3835,'RN'),('Tenente Ananias',3836,'RN'),('Tenente Laurentino Cruz',3837,'RN'),('Tibau',3838,'RN'),('Tibau do Sul',3839,'RN'),('Timbaúba dos Batistas',3840,'RN'),('Touros',3841,'RN'),('Triunfo Potiguar',3842,'RN'),('Umarizal',3843,'RN'),('Upanema',3844,'RN'),('Várzea',3845,'RN'),('Venha-Ver',3846,'RN'),('Vera Cruz',3847,'RN'),('Viçosa',3848,'RN'),('Vila Flor',3849,'RN'),('Alta Floresta d`Oeste',3850,'RO'),('Alto Alegre dos Parecis',3851,'RO'),('Alto Paraíso',3852,'RO'),('Alvorada d`Oeste',3853,'RO'),('Ariquemes',3854,'RO'),('Buritis',3855,'RO'),('Cabixi',3856,'RO'),('Cacaulândia',3857,'RO'),('Cacoal',3858,'RO'),('Campo Novo de Rondônia',3859,'RO'),('Candeias do Jamari',3860,'RO'),('Castanheiras',3861,'RO'),('Cerejeiras',3862,'RO'),('Chupinguaia',3863,'RO'),('Colorado do Oeste',3864,'RO'),('Corumbiara',3865,'RO'),('Costa Marques',3866,'RO'),('Cujubim',3867,'RO'),('Espigão d`Oeste',3868,'RO'),('Governador Jorge Teixeira',3869,'RO'),('Guajará-Mirim',3870,'RO'),('Itapuã do Oeste',3871,'RO'),('Jaru',3872,'RO'),('Ji-Paraná',3873,'RO'),('Machadinho d`Oeste',3874,'RO'),('Ministro Andreazza',3875,'RO'),('Mirante da Serra',3876,'RO'),('Monte Negro',3877,'RO'),('Nova Brasilândia d`Oeste',3878,'RO'),('Nova Mamoré',3879,'RO'),('Nova União',3880,'RO'),('Novo Horizonte do Oeste',3881,'RO'),('Ouro Preto do Oeste',3882,'RO'),('Parecis',3883,'RO'),('Pimenta Bueno',3884,'RO'),('Pimenteiras do Oeste',3885,'RO'),('Porto Velho',3886,'RO'),('Presidente Médici',3887,'RO'),('Primavera de Rondônia',3888,'RO'),('Rio Crespo',3889,'RO'),('Rolim de Moura',3890,'RO'),('Santa Luzia d`Oeste',3891,'RO'),('São Felipe d`Oeste',3892,'RO'),('São Francisco do Guaporé',3893,'RO'),('São Miguel do Guaporé',3894,'RO'),('Seringueiras',3895,'RO'),('Teixeirópolis',3896,'RO'),('Theobroma',3897,'RO'),('Urupá',3898,'RO'),('Vale do Anari',3899,'RO'),('Vale do Paraíso',3900,'RO'),('Vilhena',3901,'RO'),('Alto Alegre',3902,'RR'),('Amajari',3903,'RR'),('Boa Vista',3904,'RR'),('Bonfim',3905,'RR'),('Cantá',3906,'RR'),('Caracaraí',3907,'RR'),('Caroebe',3908,'RR'),('Iracema',3909,'RR'),('Mucajaí',3910,'RR'),('Normandia',3911,'RR'),('Pacaraima',3912,'RR'),('Rorainópolis',3913,'RR'),('São João da Baliza',3914,'RR'),('São Luiz',3915,'RR'),('Uiramutã',3916,'RR'),('Aceguá',3917,'RS'),('Água Santa',3918,'RS'),('Agudo',3919,'RS'),('Ajuricaba',3920,'RS'),('Alecrim',3921,'RS'),('Alegrete',3922,'RS'),('Alegria',3923,'RS'),('Almirante Tamandaré do Sul',3924,'RS'),('Alpestre',3925,'RS'),('Alto Alegre',3926,'RS'),('Alto Feliz',3927,'RS'),('Alvorada',3928,'RS'),('Amaral Ferrador',3929,'RS'),('Ametista do Sul',3930,'RS'),('André da Rocha',3931,'RS'),('Anta Gorda',3932,'RS'),('Antônio Prado',3933,'RS'),('Arambaré',3934,'RS'),('Araricá',3935,'RS'),('Aratiba',3936,'RS'),('Arroio do Meio',3937,'RS'),('Arroio do Padre',3938,'RS'),('Arroio do Sal',3939,'RS'),('Arroio do Tigre',3940,'RS'),('Arroio dos Ratos',3941,'RS'),('Arroio Grande',3942,'RS'),('Arvorezinha',3943,'RS'),('Augusto Pestana',3944,'RS'),('Áurea',3945,'RS'),('Bagé',3946,'RS'),('Balneário Pinhal',3947,'RS'),('Barão',3948,'RS'),('Barão de Cotegipe',3949,'RS'),('Barão do Triunfo',3950,'RS'),('Barra do Guarita',3951,'RS'),('Barra do Quaraí',3952,'RS'),('Barra do Ribeiro',3953,'RS'),('Barra do Rio Azul',3954,'RS'),('Barra Funda',3955,'RS'),('Barracão',3956,'RS'),('Barros Cassal',3957,'RS'),('Benjamin Constant do Sul',3958,'RS'),('Bento Gonçalves',3959,'RS'),('Boa Vista das Missões',3960,'RS'),('Boa Vista do Buricá',3961,'RS'),('Boa Vista do Cadeado',3962,'RS'),('Boa Vista do Incra',3963,'RS'),('Boa Vista do Sul',3964,'RS'),('Bom Jesus',3965,'RS'),('Bom Princípio',3966,'RS'),('Bom Progresso',3967,'RS'),('Bom Retiro do Sul',3968,'RS'),('Boqueirão do Leão',3969,'RS'),('Bossoroca',3970,'RS'),('Bozano',3971,'RS'),('Braga',3972,'RS'),('Brochier',3973,'RS'),('Butiá',3974,'RS'),('Caçapava do Sul',3975,'RS'),('Cacequi',3976,'RS'),('Cachoeira do Sul',3977,'RS'),('Cachoeirinha',3978,'RS'),('Cacique Doble',3979,'RS'),('Caibaté',3980,'RS'),('Caiçara',3981,'RS'),('Camaquã',3982,'RS'),('Camargo',3983,'RS'),('Cambará do Sul',3984,'RS'),('Campestre da Serra',3985,'RS'),('Campina das Missões',3986,'RS'),('Campinas do Sul',3987,'RS'),('Campo Bom',3988,'RS'),('Campo Novo',3989,'RS'),('Campos Borges',3990,'RS'),('Candelária',3991,'RS'),('Cândido Godói',3992,'RS'),('Candiota',3993,'RS'),('Canela',3994,'RS'),('Canguçu',3995,'RS'),('Canoas',3996,'RS'),('Canudos do Vale',3997,'RS'),('Capão Bonito do Sul',3998,'RS'),('Capão da Canoa',3999,'RS'),('Capão do Cipó',4000,'RS'),('Capão do Leão',4001,'RS'),('Capela de Santana',4002,'RS'),('Capitão',4003,'RS'),('Capivari do Sul',4004,'RS'),('Caraá',4005,'RS'),('Carazinho',4006,'RS'),('Carlos Barbosa',4007,'RS'),('Carlos Gomes',4008,'RS'),('Casca',4009,'RS'),('Caseiros',4010,'RS'),('Catuípe',4011,'RS'),('Caxias do Sul',4012,'RS'),('Centenário',4013,'RS'),('Cerrito',4014,'RS'),('Cerro Branco',4015,'RS'),('Cerro Grande',4016,'RS'),('Cerro Grande do Sul',4017,'RS'),('Cerro Largo',4018,'RS'),('Chapada',4019,'RS'),('Charqueadas',4020,'RS'),('Charrua',4021,'RS'),('Chiapeta',4022,'RS'),('Chuí',4023,'RS'),('Chuvisca',4024,'RS'),('Cidreira',4025,'RS'),('Ciríaco',4026,'RS'),('Colinas',4027,'RS'),('Colorado',4028,'RS'),('Condor',4029,'RS'),('Constantina',4030,'RS'),('Coqueiro Baixo',4031,'RS'),('Coqueiros do Sul',4032,'RS'),('Coronel Barros',4033,'RS'),('Coronel Bicaco',4034,'RS'),('Coronel Pilar',4035,'RS'),('Cotiporã',4036,'RS'),('Coxilha',4037,'RS'),('Crissiumal',4038,'RS'),('Cristal',4039,'RS'),('Cristal do Sul',4040,'RS'),('Cruz Alta',4041,'RS'),('Cruzaltense',4042,'RS'),('Cruzeiro do Sul',4043,'RS'),('David Canabarro',4044,'RS'),('Derrubadas',4045,'RS'),('Dezesseis de Novembro',4046,'RS'),('Dilermando de Aguiar',4047,'RS'),('Dois Irmãos',4048,'RS'),('Dois Irmãos das Missões',4049,'RS'),('Dois Lajeados',4050,'RS'),('Dom Feliciano',4051,'RS'),('Dom Pedrito',4052,'RS'),('Dom Pedro de Alcântara',4053,'RS'),('Dona Francisca',4054,'RS'),('Doutor Maurício Cardoso',4055,'RS'),('Doutor Ricardo',4056,'RS'),('Eldorado do Sul',4057,'RS'),('Encantado',4058,'RS'),('Encruzilhada do Sul',4059,'RS'),('Engenho Velho',4060,'RS'),('Entre Rios do Sul',4061,'RS'),('Entre-Ijuís',4062,'RS'),('Erebango',4063,'RS'),('Erechim',4064,'RS'),('Ernestina',4065,'RS'),('Erval Grande',4066,'RS'),('Erval Seco',4067,'RS'),('Esmeralda',4068,'RS'),('Esperança do Sul',4069,'RS'),('Espumoso',4070,'RS'),('Estação',4071,'RS'),('Estância Velha',4072,'RS'),('Esteio',4073,'RS'),('Estrela',4074,'RS'),('Estrela Velha',4075,'RS'),('Eugênio de Castro',4076,'RS'),('Fagundes Varela',4077,'RS'),('Farroupilha',4078,'RS'),('Faxinal do Soturno',4079,'RS'),('Faxinalzinho',4080,'RS'),('Fazenda Vilanova',4081,'RS'),('Feliz',4082,'RS'),('Flores da Cunha',4083,'RS'),('Floriano Peixoto',4084,'RS'),('Fontoura Xavier',4085,'RS'),('Formigueiro',4086,'RS'),('Forquetinha',4087,'RS'),('Fortaleza dos Valos',4088,'RS'),('Frederico Westphalen',4089,'RS'),('Garibaldi',4090,'RS'),('Garruchos',4091,'RS'),('Gaurama',4092,'RS'),('General Câmara',4093,'RS'),('Gentil',4094,'RS'),('Getúlio Vargas',4095,'RS'),('Giruá',4096,'RS'),('Glorinha',4097,'RS'),('Gramado',4098,'RS'),('Gramado dos Loureiros',4099,'RS'),('Gramado Xavier',4100,'RS'),('Gravataí',4101,'RS'),('Guabiju',4102,'RS'),('Guaíba',4103,'RS'),('Guaporé',4104,'RS'),('Guarani das Missões',4105,'RS'),('Harmonia',4106,'RS'),('Herval',4107,'RS'),('Herveiras',4108,'RS'),('Horizontina',4109,'RS'),('Hulha Negra',4110,'RS'),('Humaitá',4111,'RS'),('Ibarama',4112,'RS'),('Ibiaçá',4113,'RS'),('Ibiraiaras',4114,'RS'),('Ibirapuitã',4115,'RS'),('Ibirubá',4116,'RS'),('Igrejinha',4117,'RS'),('Ijuí',4118,'RS'),('Ilópolis',4119,'RS'),('Imbé',4120,'RS'),('Imigrante',4121,'RS'),('Independência',4122,'RS'),('Inhacorá',4123,'RS'),('Ipê',4124,'RS'),('Ipiranga do Sul',4125,'RS'),('Iraí',4126,'RS'),('Itaara',4127,'RS'),('Itacurubi',4128,'RS'),('Itapuca',4129,'RS'),('Itaqui',4130,'RS'),('Itati',4131,'RS'),('Itatiba do Sul',4132,'RS'),('Ivorá',4133,'RS'),('Ivoti',4134,'RS'),('Jaboticaba',4135,'RS'),('Jacuizinho',4136,'RS'),('Jacutinga',4137,'RS'),('Jaguarão',4138,'RS'),('Jaguari',4139,'RS'),('Jaquirana',4140,'RS'),('Jari',4141,'RS'),('Jóia',4142,'RS'),('Júlio de Castilhos',4143,'RS'),('Lagoa Bonita do Sul',4144,'RS'),('Lagoa dos Três Cantos',4145,'RS'),('Lagoa Vermelha',4146,'RS'),('Lagoão',4147,'RS'),('Lajeado',4148,'RS'),('Lajeado do Bugre',4149,'RS'),('Lavras do Sul',4150,'RS'),('Liberato Salzano',4151,'RS'),('Lindolfo Collor',4152,'RS'),('Linha Nova',4153,'RS'),('Maçambara',4154,'RS'),('Machadinho',4155,'RS'),('Mampituba',4156,'RS'),('Manoel Viana',4157,'RS'),('Maquiné',4158,'RS'),('Maratá',4159,'RS'),('Marau',4160,'RS'),('Marcelino Ramos',4161,'RS'),('Mariana Pimentel',4162,'RS'),('Mariano Moro',4163,'RS'),('Marques de Souza',4164,'RS'),('Mata',4165,'RS'),('Mato Castelhano',4166,'RS'),('Mato Leitão',4167,'RS'),('Mato Queimado',4168,'RS'),('Maximiliano de Almeida',4169,'RS'),('Minas do Leão',4170,'RS'),('Miraguaí',4171,'RS'),('Montauri',4172,'RS'),('Monte Alegre dos Campos',4173,'RS'),('Monte Belo do Sul',4174,'RS'),('Montenegro',4175,'RS'),('Mormaço',4176,'RS'),('Morrinhos do Sul',4177,'RS'),('Morro Redondo',4178,'RS'),('Morro Reuter',4179,'RS'),('Mostardas',4180,'RS'),('Muçum',4181,'RS'),('Muitos Capões',4182,'RS'),('Muliterno',4183,'RS'),('Não-Me-Toque',4184,'RS'),('Nicolau Vergueiro',4185,'RS'),('Nonoai',4186,'RS'),('Nova Alvorada',4187,'RS'),('Nova Araçá',4188,'RS'),('Nova Bassano',4189,'RS'),('Nova Boa Vista',4190,'RS'),('Nova Bréscia',4191,'RS'),('Nova Candelária',4192,'RS'),('Nova Esperança do Sul',4193,'RS'),('Nova Hartz',4194,'RS'),('Nova Pádua',4195,'RS'),('Nova Palma',4196,'RS'),('Nova Petrópolis',4197,'RS'),('Nova Prata',4198,'RS'),('Nova Ramada',4199,'RS'),('Nova Roma do Sul',4200,'RS'),('Nova Santa Rita',4201,'RS'),('Novo Barreiro',4202,'RS'),('Novo Cabrais',4203,'RS'),('Novo Hamburgo',4204,'RS'),('Novo Machado',4205,'RS'),('Novo Tiradentes',4206,'RS'),('Novo Xingu',4207,'RS'),('Osório',4208,'RS'),('Paim Filho',4209,'RS'),('Palmares do Sul',4210,'RS'),('Palmeira das Missões',4211,'RS'),('Palmitinho',4212,'RS'),('Panambi',4213,'RS'),('Pantano Grande',4214,'RS'),('Paraí',4215,'RS'),('Paraíso do Sul',4216,'RS'),('Pareci Novo',4217,'RS'),('Parobé',4218,'RS'),('Passa Sete',4219,'RS'),('Passo do Sobrado',4220,'RS'),('Passo Fundo',4221,'RS'),('Paulo Bento',4222,'RS'),('Paverama',4223,'RS'),('Pedras Altas',4224,'RS'),('Pedro Osório',4225,'RS'),('Pejuçara',4226,'RS'),('Pelotas',4227,'RS'),('Picada Café',4228,'RS'),('Pinhal',4229,'RS'),('Pinhal da Serra',4230,'RS'),('Pinhal Grande',4231,'RS'),('Pinheirinho do Vale',4232,'RS'),('Pinheiro Machado',4233,'RS'),('Pirapó',4234,'RS'),('Piratini',4235,'RS'),('Planalto',4236,'RS'),('Poço das Antas',4237,'RS'),('Pontão',4238,'RS'),('Ponte Preta',4239,'RS'),('Portão',4240,'RS'),('Porto Alegre',4241,'RS'),('Porto Lucena',4242,'RS'),('Porto Mauá',4243,'RS'),('Porto Vera Cruz',4244,'RS'),('Porto Xavier',4245,'RS'),('Pouso Novo',4246,'RS'),('Presidente Lucena',4247,'RS'),('Progresso',4248,'RS'),('Protásio Alves',4249,'RS'),('Putinga',4250,'RS'),('Quaraí',4251,'RS'),('Quatro Irmãos',4252,'RS'),('Quevedos',4253,'RS'),('Quinze de Novembro',4254,'RS'),('Redentora',4255,'RS'),('Relvado',4256,'RS'),('Restinga Seca',4257,'RS'),('Rio dos Índios',4258,'RS'),('Rio Grande',4259,'RS'),('Rio Pardo',4260,'RS'),('Riozinho',4261,'RS'),('Roca Sales',4262,'RS'),('Rodeio Bonito',4263,'RS'),('Rolador',4264,'RS'),('Rolante',4265,'RS'),('Ronda Alta',4266,'RS'),('Rondinha',4267,'RS'),('Roque Gonzales',4268,'RS'),('Rosário do Sul',4269,'RS'),('Sagrada Família',4270,'RS'),('Saldanha Marinho',4271,'RS'),('Salto do Jacuí',4272,'RS'),('Salvador das Missões',4273,'RS'),('Salvador do Sul',4274,'RS'),('Sananduva',4275,'RS'),('Santa Bárbara do Sul',4276,'RS'),('Santa Cecília do Sul',4277,'RS'),('Santa Clara do Sul',4278,'RS'),('Santa Cruz do Sul',4279,'RS'),('Santa Margarida do Sul',4280,'RS'),('Santa Maria',4281,'RS'),('Santa Maria do Herval',4282,'RS'),('Santa Rosa',4283,'RS'),('Santa Tereza',4284,'RS'),('Santa Vitória do Palmar',4285,'RS'),('Santana da Boa Vista',4286,'RS'),('Santana do Livramento',4287,'RS'),('Santiago',4288,'RS'),('Santo Ângelo',4289,'RS'),('Santo Antônio da Patrulha',4290,'RS'),('Santo Antônio das Missões',4291,'RS'),('Santo Antônio do Palma',4292,'RS'),('Santo Antônio do Planalto',4293,'RS'),('Santo Augusto',4294,'RS'),('Santo Cristo',4295,'RS'),('Santo Expedito do Sul',4296,'RS'),('São Borja',4297,'RS'),('São Domingos do Sul',4298,'RS'),('São Francisco de Assis',4299,'RS'),('São Francisco de Paula',4300,'RS'),('São Gabriel',4301,'RS'),('São Jerônimo',4302,'RS'),('São João da Urtiga',4303,'RS'),('São João do Polêsine',4304,'RS'),('São Jorge',4305,'RS'),('São José das Missões',4306,'RS'),('São José do Herval',4307,'RS'),('São José do Hortêncio',4308,'RS'),('São José do Inhacorá',4309,'RS'),('São José do Norte',4310,'RS'),('São José do Ouro',4311,'RS'),('São José do Sul',4312,'RS'),('São José dos Ausentes',4313,'RS'),('São Leopoldo',4314,'RS'),('São Lourenço do Sul',4315,'RS'),('São Luiz Gonzaga',4316,'RS'),('São Marcos',4317,'RS'),('São Martinho',4318,'RS'),('São Martinho da Serra',4319,'RS'),('São Miguel das Missões',4320,'RS'),('São Nicolau',4321,'RS'),('São Paulo das Missões',4322,'RS'),('São Pedro da Serra',4323,'RS'),('São Pedro das Missões',4324,'RS'),('São Pedro do Butiá',4325,'RS'),('São Pedro do Sul',4326,'RS'),('São Sebastião do Caí',4327,'RS'),('São Sepé',4328,'RS'),('São Valentim',4329,'RS'),('São Valentim do Sul',4330,'RS'),('São Valério do Sul',4331,'RS'),('São Vendelino',4332,'RS'),('São Vicente do Sul',4333,'RS'),('Sapiranga',4334,'RS'),('Sapucaia do Sul',4335,'RS'),('Sarandi',4336,'RS'),('Seberi',4337,'RS'),('Sede Nova',4338,'RS'),('Segredo',4339,'RS'),('Selbach',4340,'RS'),('Senador Salgado Filho',4341,'RS'),('Sentinela do Sul',4342,'RS'),('Serafina Corrêa',4343,'RS'),('Sério',4344,'RS'),('Sertão',4345,'RS'),('Sertão Santana',4346,'RS'),('Sete de Setembro',4347,'RS'),('Severiano de Almeida',4348,'RS'),('Silveira Martins',4349,'RS'),('Sinimbu',4350,'RS'),('Sobradinho',4351,'RS'),('Soledade',4352,'RS'),('Tabaí',4353,'RS'),('Tapejara',4354,'RS'),('Tapera',4355,'RS'),('Tapes',4356,'RS'),('Taquara',4357,'RS'),('Taquari',4358,'RS'),('Taquaruçu do Sul',4359,'RS'),('Tavares',4360,'RS'),('Tenente Portela',4361,'RS'),('Terra de Areia',4362,'RS'),('Teutônia',4363,'RS'),('Tio Hugo',4364,'RS'),('Tiradentes do Sul',4365,'RS'),('Toropi',4366,'RS'),('Torres',4367,'RS'),('Tramandaí',4368,'RS'),('Travesseiro',4369,'RS'),('Três Arroios',4370,'RS'),('Três Cachoeiras',4371,'RS'),('Três Coroas',4372,'RS'),('Três de Maio',4373,'RS'),('Três Forquilhas',4374,'RS'),('Três Palmeiras',4375,'RS'),('Três Passos',4376,'RS'),('Trindade do Sul',4377,'RS'),('Triunfo',4378,'RS'),('Tucunduva',4379,'RS'),('Tunas',4380,'RS'),('Tupanci do Sul',4381,'RS'),('Tupanciretã',4382,'RS'),('Tupandi',4383,'RS'),('Tuparendi',4384,'RS'),('Turuçu',4385,'RS'),('Ubiretama',4386,'RS'),('União da Serra',4387,'RS'),('Unistalda',4388,'RS'),('Uruguaiana',4389,'RS'),('Vacaria',4390,'RS'),('Vale do Sol',4391,'RS'),('Vale Real',4392,'RS'),('Vale Verde',4393,'RS'),('Vanini',4394,'RS'),('Venâncio Aires',4395,'RS'),('Vera Cruz',4396,'RS'),('Veranópolis',4397,'RS'),('Vespasiano Correa',4398,'RS'),('Viadutos',4399,'RS'),('Viamão',4400,'RS'),('Vicente Dutra',4401,'RS'),('Victor Graeff',4402,'RS'),('Vila Flores',4403,'RS'),('Vila Lângaro',4404,'RS'),('Vila Maria',4405,'RS'),('Vila Nova do Sul',4406,'RS'),('Vista Alegre',4407,'RS'),('Vista Alegre do Prata',4408,'RS'),('Vista Gaúcha',4409,'RS'),('Vitória das Missões',4410,'RS'),('Westfália',4411,'RS'),('Xangri-lá',4412,'RS'),('Abdon Batista',4413,'SC'),('Abelardo Luz',4414,'SC'),('Agrolândia',4415,'SC'),('Agronômica',4416,'SC'),('Água Doce',4417,'SC'),('Águas de Chapecó',4418,'SC'),('Águas Frias',4419,'SC'),('Águas Mornas',4420,'SC'),('Alfredo Wagner',4421,'SC'),('Alto Bela Vista',4422,'SC'),('Anchieta',4423,'SC'),('Angelina',4424,'SC'),('Anita Garibaldi',4425,'SC'),('Anitápolis',4426,'SC'),('Antônio Carlos',4427,'SC'),('Apiúna',4428,'SC'),('Arabutã',4429,'SC'),('Araquari',4430,'SC'),('Araranguá',4431,'SC'),('Armazém',4432,'SC'),('Arroio Trinta',4433,'SC'),('Arvoredo',4434,'SC'),('Ascurra',4435,'SC'),('Atalanta',4436,'SC'),('Aurora',4437,'SC'),('Balneário Arroio do Silva',4438,'SC'),('Balneário Barra do Sul',4439,'SC'),('Balneário Camboriú',4440,'SC'),('Balneário Gaivota',4441,'SC'),('Bandeirante',4442,'SC'),('Barra Bonita',4443,'SC'),('Barra Velha',4444,'SC'),('Bela Vista do Toldo',4445,'SC'),('Belmonte',4446,'SC'),('Benedito Novo',4447,'SC'),('Biguaçu',4448,'SC'),('Blumenau',4449,'SC'),('Bocaina do Sul',4450,'SC'),('Bom Jardim da Serra',4451,'SC'),('Bom Jesus',4452,'SC'),('Bom Jesus do Oeste',4453,'SC'),('Bom Retiro',4454,'SC'),('Bombinhas',4455,'SC'),('Botuverá',4456,'SC'),('Braço do Norte',4457,'SC'),('Braço do Trombudo',4458,'SC'),('Brunópolis',4459,'SC'),('Brusque',4460,'SC'),('Caçador',4461,'SC'),('Caibi',4462,'SC'),('Calmon',4463,'SC'),('Camboriú',4464,'SC'),('Campo Alegre',4465,'SC'),('Campo Belo do Sul',4466,'SC'),('Campo Erê',4467,'SC'),('Campos Novos',4468,'SC'),('Canelinha',4469,'SC'),('Canoinhas',4470,'SC'),('Capão Alto',4471,'SC'),('Capinzal',4472,'SC'),('Capivari de Baixo',4473,'SC'),('Catanduvas',4474,'SC'),('Caxambu do Sul',4475,'SC'),('Celso Ramos',4476,'SC'),('Cerro Negro',4477,'SC'),('Chapadão do Lageado',4478,'SC'),('Chapecó',4479,'SC'),('Cocal do Sul',4480,'SC'),('Concórdia',4481,'SC'),('Cordilheira Alta',4482,'SC'),('Coronel Freitas',4483,'SC'),('Coronel Martins',4484,'SC'),('Correia Pinto',4485,'SC'),('Corupá',4486,'SC'),('Criciúma',4487,'SC'),('Cunha Porã',4488,'SC'),('Cunhataí',4489,'SC'),('Curitibanos',4490,'SC'),('Descanso',4491,'SC'),('Dionísio Cerqueira',4492,'SC'),('Dona Emma',4493,'SC'),('Doutor Pedrinho',4494,'SC'),('Entre Rios',4495,'SC'),('Ermo',4496,'SC'),('Erval Velho',4497,'SC'),('Faxinal dos Guedes',4498,'SC'),('Flor do Sertão',4499,'SC'),('Florianópolis',4500,'SC'),('Formosa do Sul',4501,'SC'),('Forquilhinha',4502,'SC'),('Fraiburgo',4503,'SC'),('Frei Rogério',4504,'SC'),('Galvão',4505,'SC'),('Garopaba',4506,'SC'),('Garuva',4507,'SC'),('Gaspar',4508,'SC'),('Governador Celso Ramos',4509,'SC'),('Grão Pará',4510,'SC'),('Gravatal',4511,'SC'),('Guabiruba',4512,'SC'),('Guaraciaba',4513,'SC'),('Guaramirim',4514,'SC'),('Guarujá do Sul',4515,'SC'),('Guatambú',4516,'SC'),('Herval d`Oeste',4517,'SC'),('Ibiam',4518,'SC'),('Ibicaré',4519,'SC'),('Ibirama',4520,'SC'),('Içara',4521,'SC'),('Ilhota',4522,'SC'),('Imaruí',4523,'SC'),('Imbituba',4524,'SC'),('Imbuia',4525,'SC'),('Indaial',4526,'SC'),('Iomerê',4527,'SC'),('Ipira',4528,'SC'),('Iporã do Oeste',4529,'SC'),('Ipuaçu',4530,'SC'),('Ipumirim',4531,'SC'),('Iraceminha',4532,'SC'),('Irani',4533,'SC'),('Irati',4534,'SC'),('Irineópolis',4535,'SC'),('Itá',4536,'SC'),('Itaiópolis',4537,'SC'),('Itajaí',4538,'SC'),('Itapema',4539,'SC'),('Itapiranga',4540,'SC'),('Itapoá',4541,'SC'),('Ituporanga',4542,'SC'),('Jaborá',4543,'SC'),('Jacinto Machado',4544,'SC'),('Jaguaruna',4545,'SC'),('Jaraguá do Sul',4546,'SC'),('Jardinópolis',4547,'SC'),('Joaçaba',4548,'SC'),('Joinville',4549,'SC'),('José Boiteux',4550,'SC'),('Jupiá',4551,'SC'),('Lacerdópolis',4552,'SC'),('Lages',4553,'SC'),('Laguna',4554,'SC'),('Lajeado Grande',4555,'SC'),('Laurentino',4556,'SC'),('Lauro Muller',4557,'SC'),('Lebon Régis',4558,'SC'),('Leoberto Leal',4559,'SC'),('Lindóia do Sul',4560,'SC'),('Lontras',4561,'SC'),('Luiz Alves',4562,'SC'),('Luzerna',4563,'SC'),('Macieira',4564,'SC'),('Mafra',4565,'SC'),('Major Gercino',4566,'SC'),('Major Vieira',4567,'SC'),('Maracajá',4568,'SC'),('Maravilha',4569,'SC'),('Marema',4570,'SC'),('Massaranduba',4571,'SC'),('Matos Costa',4572,'SC'),('Meleiro',4573,'SC'),('Mirim Doce',4574,'SC'),('Modelo',4575,'SC'),('Mondaí',4576,'SC'),('Monte Carlo',4577,'SC'),('Monte Castelo',4578,'SC'),('Morro da Fumaça',4579,'SC'),('Morro Grande',4580,'SC'),('Navegantes',4581,'SC'),('Nova Erechim',4582,'SC'),('Nova Itaberaba',4583,'SC'),('Nova Trento',4584,'SC'),('Nova Veneza',4585,'SC'),('Novo Horizonte',4586,'SC'),('Orleans',4587,'SC'),('Otacílio Costa',4588,'SC'),('Ouro',4589,'SC'),('Ouro Verde',4590,'SC'),('Paial',4591,'SC'),('Painel',4592,'SC'),('Palhoça',4593,'SC'),('Palma Sola',4594,'SC'),('Palmeira',4595,'SC'),('Palmitos',4596,'SC'),('Papanduva',4597,'SC'),('Paraíso',4598,'SC'),('Passo de Torres',4599,'SC'),('Passos Maia',4600,'SC'),('Paulo Lopes',4601,'SC'),('Pedras Grandes',4602,'SC'),('Penha',4603,'SC'),('Peritiba',4604,'SC'),('Petrolândia',4605,'SC'),('Piçarras',4606,'SC'),('Pinhalzinho',4607,'SC'),('Pinheiro Preto',4608,'SC'),('Piratuba',4609,'SC'),('Planalto Alegre',4610,'SC'),('Pomerode',4611,'SC'),('Ponte Alta',4612,'SC'),('Ponte Alta do Norte',4613,'SC'),('Ponte Serrada',4614,'SC'),('Porto Belo',4615,'SC'),('Porto União',4616,'SC'),('Pouso Redondo',4617,'SC'),('Praia Grande',4618,'SC'),('Presidente Castelo Branco',4619,'SC'),('Presidente Getúlio',4620,'SC'),('Presidente Nereu',4621,'SC'),('Princesa',4622,'SC'),('Quilombo',4623,'SC'),('Rancho Queimado',4624,'SC'),('Rio das Antas',4625,'SC'),('Rio do Campo',4626,'SC'),('Rio do Oeste',4627,'SC'),('Rio do Sul',4628,'SC'),('Rio dos Cedros',4629,'SC'),('Rio Fortuna',4630,'SC'),('Rio Negrinho',4631,'SC'),('Rio Rufino',4632,'SC'),('Riqueza',4633,'SC'),('Rodeio',4634,'SC'),('Romelândia',4635,'SC'),('Salete',4636,'SC'),('Saltinho',4637,'SC'),('Salto Veloso',4638,'SC'),('Sangão',4639,'SC'),('Santa Cecília',4640,'SC'),('Santa Helena',4641,'SC'),('Santa Rosa de Lima',4642,'SC'),('Santa Rosa do Sul',4643,'SC'),('Santa Terezinha',4644,'SC'),('Santa Terezinha do Progresso',4645,'SC'),('Santiago do Sul',4646,'SC'),('Santo Amaro da Imperatriz',4647,'SC'),('São Bento do Sul',4648,'SC'),('São Bernardino',4649,'SC'),('São Bonifácio',4650,'SC'),('São Carlos',4651,'SC'),('São Cristovão do Sul',4652,'SC'),('São Domingos',4653,'SC'),('São Francisco do Sul',4654,'SC'),('São João Batista',4655,'SC'),('São João do Itaperiú',4656,'SC'),('São João do Oeste',4657,'SC'),('São João do Sul',4658,'SC'),('São Joaquim',4659,'SC'),('São José',4660,'SC'),('São José do Cedro',4661,'SC'),('São José do Cerrito',4662,'SC'),('São Lourenço do Oeste',4663,'SC'),('São Ludgero',4664,'SC'),('São Martinho',4665,'SC'),('São Miguel da Boa Vista',4666,'SC'),('São Miguel do Oeste',4667,'SC'),('São Pedro de Alcântara',4668,'SC'),('Saudades',4669,'SC'),('Schroeder',4670,'SC'),('Seara',4671,'SC'),('Serra Alta',4672,'SC'),('Siderópolis',4673,'SC'),('Sombrio',4674,'SC'),('Sul Brasil',4675,'SC'),('Taió',4676,'SC'),('Tangará',4677,'SC'),('Tigrinhos',4678,'SC'),('Tijucas',4679,'SC'),('Timbé do Sul',4680,'SC'),('Timbó',4681,'SC'),('Timbó Grande',4682,'SC'),('Três Barras',4683,'SC'),('Treviso',4684,'SC'),('Treze de Maio',4685,'SC'),('Treze Tílias',4686,'SC'),('Trombudo Central',4687,'SC'),('Tubarão',4688,'SC'),('Tunápolis',4689,'SC'),('Turvo',4690,'SC'),('União do Oeste',4691,'SC'),('Urubici',4692,'SC'),('Urupema',4693,'SC'),('Urussanga',4694,'SC'),('Vargeão',4695,'SC'),('Vargem',4696,'SC'),('Vargem Bonita',4697,'SC'),('Vidal Ramos',4698,'SC'),('Videira',4699,'SC'),('Vitor Meireles',4700,'SC'),('Witmarsum',4701,'SC'),('Xanxerê',4702,'SC'),('Xavantina',4703,'SC'),('Xaxim',4704,'SC'),('Zortéa',4705,'SC'),('Amparo de São Francisco',4706,'SE'),('Aquidabã',4707,'SE'),('Aracaju',4708,'SE'),('Arauá',4709,'SE'),('Areia Branca',4710,'SE'),('Barra dos Coqueiros',4711,'SE'),('Boquim',4712,'SE'),('Brejo Grande',4713,'SE'),('Campo do Brito',4714,'SE'),('Canhoba',4715,'SE'),('Canindé de São Francisco',4716,'SE'),('Capela',4717,'SE'),('Carira',4718,'SE'),('Carmópolis',4719,'SE'),('Cedro de São João',4720,'SE'),('Cristinápolis',4721,'SE'),('Cumbe',4722,'SE'),('Divina Pastora',4723,'SE'),('Estância',4724,'SE'),('Feira Nova',4725,'SE'),('Frei Paulo',4726,'SE'),('Gararu',4727,'SE'),('General Maynard',4728,'SE'),('Gracho Cardoso',4729,'SE'),('Ilha das Flores',4730,'SE'),('Indiaroba',4731,'SE'),('Itabaiana',4732,'SE'),('Itabaianinha',4733,'SE'),('Itabi',4734,'SE'),('Itaporanga d`Ajuda',4735,'SE'),('Japaratuba',4736,'SE'),('Japoatã',4737,'SE'),('Lagarto',4738,'SE'),('Laranjeiras',4739,'SE'),('Macambira',4740,'SE'),('Malhada dos Bois',4741,'SE'),('Malhador',4742,'SE'),('Maruim',4743,'SE'),('Moita Bonita',4744,'SE'),('Monte Alegre de Sergipe',4745,'SE'),('Muribeca',4746,'SE'),('Neópolis',4747,'SE'),('Nossa Senhora Aparecida',4748,'SE'),('Nossa Senhora da Glória',4749,'SE'),('Nossa Senhora das Dores',4750,'SE'),('Nossa Senhora de Lourdes',4751,'SE'),('Nossa Senhora do Socorro',4752,'SE'),('Pacatuba',4753,'SE'),('Pedra Mole',4754,'SE'),('Pedrinhas',4755,'SE'),('Pinhão',4756,'SE'),('Pirambu',4757,'SE'),('Poço Redondo',4758,'SE'),('Poço Verde',4759,'SE'),('Porto da Folha',4760,'SE'),('Propriá',4761,'SE'),('Riachão do Dantas',4762,'SE'),('Riachuelo',4763,'SE'),('Ribeirópolis',4764,'SE'),('Rosário do Catete',4765,'SE'),('Salgado',4766,'SE'),('Santa Luzia do Itanhy',4767,'SE'),('Santa Rosa de Lima',4768,'SE'),('Santana do São Francisco',4769,'SE'),('Santo Amaro das Brotas',4770,'SE'),('São Cristóvão',4771,'SE'),('São Domingos',4772,'SE'),('São Francisco',4773,'SE'),('São Miguel do Aleixo',4774,'SE'),('Simão Dias',4775,'SE'),('Siriri',4776,'SE'),('Telha',4777,'SE'),('Tobias Barreto',4778,'SE'),('Tomar do Geru',4779,'SE'),('Umbaúba',4780,'SE'),('Adamantina',4781,'SP'),('Adolfo',4782,'SP'),('Aguaí',4783,'SP'),('Águas da Prata',4784,'SP'),('Águas de Lindóia',4785,'SP'),('Águas de Santa Bárbara',4786,'SP'),('Águas de São Pedro',4787,'SP'),('Agudos',4788,'SP'),('Alambari',4789,'SP'),('Alfredo Marcondes',4790,'SP'),('Altair',4791,'SP'),('Altinópolis',4792,'SP'),('Alto Alegre',4793,'SP'),('Alumínio',4794,'SP'),('Álvares Florence',4795,'SP'),('Álvares Machado',4796,'SP'),('Álvaro de Carvalho',4797,'SP'),('Alvinlândia',4798,'SP'),('Americana',4799,'SP'),('Américo Brasiliense',4800,'SP'),('Américo de Campos',4801,'SP'),('Amparo',4802,'SP'),('Analândia',4803,'SP'),('Andradina',4804,'SP'),('Angatuba',4805,'SP'),('Anhembi',4806,'SP'),('Anhumas',4807,'SP'),('Aparecida',4808,'SP'),('Aparecida d`Oeste',4809,'SP'),('Apiaí',4810,'SP'),('Araçariguama',4811,'SP'),('Araçatuba',4812,'SP'),('Araçoiaba da Serra',4813,'SP'),('Aramina',4814,'SP'),('Arandu',4815,'SP'),('Arapeí',4816,'SP'),('Araraquara',4817,'SP'),('Araras',4818,'SP'),('Arco-Íris',4819,'SP'),('Arealva',4820,'SP'),('Areias',4821,'SP'),('Areiópolis',4822,'SP'),('Ariranha',4823,'SP'),('Artur Nogueira',4824,'SP'),('Arujá',4825,'SP'),('Aspásia',4826,'SP'),('Assis',4827,'SP'),('Atibaia',4828,'SP'),('Auriflama',4829,'SP'),('Avaí',4830,'SP'),('Avanhandava',4831,'SP'),('Avaré',4832,'SP'),('Bady Bassitt',4833,'SP'),('Balbinos',4834,'SP'),('Bálsamo',4835,'SP'),('Bananal',4836,'SP'),('Barão de Antonina',4837,'SP'),('Barbosa',4838,'SP'),('Bariri',4839,'SP'),('Barra Bonita',4840,'SP'),('Barra do Chapéu',4841,'SP'),('Barra do Turvo',4842,'SP'),('Barretos',4843,'SP'),('Barrinha',4844,'SP'),('Barueri',4845,'SP'),('Bastos',4846,'SP'),('Batatais',4847,'SP'),('Bauru',4848,'SP'),('Bebedouro',4849,'SP'),('Bento de Abreu',4850,'SP'),('Bernardino de Campos',4851,'SP'),('Bertioga',4852,'SP'),('Bilac',4853,'SP'),('Birigui',4854,'SP'),('Biritiba-Mirim',4855,'SP'),('Boa Esperança do Sul',4856,'SP'),('Bocaina',4857,'SP'),('Bofete',4858,'SP'),('Boituva',4859,'SP'),('Bom Jesus dos Perdões',4860,'SP'),('Bom Sucesso de Itararé',4861,'SP'),('Borá',4862,'SP'),('Boracéia',4863,'SP'),('Borborema',4864,'SP'),('Borebi',4865,'SP'),('Botucatu',4866,'SP'),('Bragança Paulista',4867,'SP'),('Braúna',4868,'SP'),('Brejo Alegre',4869,'SP'),('Brodowski',4870,'SP'),('Brotas',4871,'SP'),('Buri',4872,'SP'),('Buritama',4873,'SP'),('Buritizal',4874,'SP'),('Cabrália Paulista',4875,'SP'),('Cabreúva',4876,'SP'),('Caçapava',4877,'SP'),('Cachoeira Paulista',4878,'SP'),('Caconde',4879,'SP'),('Cafelândia',4880,'SP'),('Caiabu',4881,'SP'),('Caieiras',4882,'SP'),('Caiuá',4883,'SP'),('Cajamar',4884,'SP'),('Cajati',4885,'SP'),('Cajobi',4886,'SP'),('Cajuru',4887,'SP'),('Campina do Monte Alegre',4888,'SP'),('Campinas',4889,'SP'),('Campo Limpo Paulista',4890,'SP'),('Campos do Jordão',4891,'SP'),('Campos Novos Paulista',4892,'SP'),('Cananéia',4893,'SP'),('Canas',4894,'SP'),('Cândido Mota',4895,'SP'),('Cândido Rodrigues',4896,'SP'),('Canitar',4897,'SP'),('Capão Bonito',4898,'SP'),('Capela do Alto',4899,'SP'),('Capivari',4900,'SP'),('Caraguatatuba',4901,'SP'),('Carapicuíba',4902,'SP'),('Cardoso',4903,'SP'),('Casa Branca',4904,'SP'),('Cássia dos Coqueiros',4905,'SP'),('Castilho',4906,'SP'),('Catanduva',4907,'SP'),('Catiguá',4908,'SP'),('Cedral',4909,'SP'),('Cerqueira César',4910,'SP'),('Cerquilho',4911,'SP'),('Cesário Lange',4912,'SP'),('Charqueada',4913,'SP'),('Chavantes',4914,'SP'),('Clementina',4915,'SP'),('Colina',4916,'SP'),('Colômbia',4917,'SP'),('Conchal',4918,'SP'),('Conchas',4919,'SP'),('Cordeirópolis',4920,'SP'),('Coroados',4921,'SP'),('Coronel Macedo',4922,'SP'),('Corumbataí',4923,'SP'),('Cosmópolis',4924,'SP'),('Cosmorama',4925,'SP'),('Cotia',4926,'SP'),('Cravinhos',4927,'SP'),('Cristais Paulista',4928,'SP'),('Cruzália',4929,'SP'),('Cruzeiro',4930,'SP'),('Cubatão',4931,'SP'),('Cunha',4932,'SP'),('Descalvado',4933,'SP'),('Diadema',4934,'SP'),('Dirce Reis',4935,'SP'),('Divinolândia',4936,'SP'),('Dobrada',4937,'SP'),('Dois Córregos',4938,'SP'),('Dolcinópolis',4939,'SP'),('Dourado',4940,'SP'),('Dracena',4941,'SP'),('Duartina',4942,'SP'),('Dumont',4943,'SP'),('Echaporã',4944,'SP'),('Eldorado',4945,'SP'),('Elias Fausto',4946,'SP'),('Elisiário',4947,'SP'),('Embaúba',4948,'SP'),('Embu',4949,'SP'),('Embu-Guaçu',4950,'SP'),('Emilianópolis',4951,'SP'),('Engenheiro Coelho',4952,'SP'),('Espírito Santo do Pinhal',4953,'SP'),('Espírito Santo do Turvo',4954,'SP'),('Estiva Gerbi',4955,'SP'),('Estrela d`Oeste',4956,'SP'),('Estrela do Norte',4957,'SP'),('Euclides da Cunha Paulista',4958,'SP'),('Fartura',4959,'SP'),('Fernando Prestes',4960,'SP'),('Fernandópolis',4961,'SP'),('Fernão',4962,'SP'),('Ferraz de Vasconcelos',4963,'SP'),('Flora Rica',4964,'SP'),('Floreal',4965,'SP'),('Flórida Paulista',4966,'SP'),('Florínia',4967,'SP'),('Franca',4968,'SP'),('Francisco Morato',4969,'SP'),('Franco da Rocha',4970,'SP'),('Gabriel Monteiro',4971,'SP'),('Gália',4972,'SP'),('Garça',4973,'SP'),('Gastão Vidigal',4974,'SP'),('Gavião Peixoto',4975,'SP'),('General Salgado',4976,'SP'),('Getulina',4977,'SP'),('Glicério',4978,'SP'),('Guaiçara',4979,'SP'),('Guaimbê',4980,'SP'),('Guaíra',4981,'SP'),('Guapiaçu',4982,'SP'),('Guapiara',4983,'SP'),('Guará',4984,'SP'),('Guaraçaí',4985,'SP'),('Guaraci',4986,'SP'),('Guarani d`Oeste',4987,'SP'),('Guarantã',4988,'SP'),('Guararapes',4989,'SP'),('Guararema',4990,'SP'),('Guaratinguetá',4991,'SP'),('Guareí',4992,'SP'),('Guariba',4993,'SP'),('Guarujá',4994,'SP'),('Guarulhos',4995,'SP'),('Guatapará',4996,'SP'),('Guzolândia',4997,'SP'),('Herculândia',4998,'SP'),('Holambra',4999,'SP'),('Hortolândia',5000,'SP'),('Iacanga',5001,'SP'),('Iacri',5002,'SP'),('Iaras',5003,'SP'),('Ibaté',5004,'SP'),('Ibirá',5005,'SP'),('Ibirarema',5006,'SP'),('Ibitinga',5007,'SP'),('Ibiúna',5008,'SP'),('Icém',5009,'SP'),('Iepê',5010,'SP'),('Igaraçu do Tietê',5011,'SP'),('Igarapava',5012,'SP'),('Igaratá',5013,'SP'),('Iguape',5014,'SP'),('Ilha Comprida',5015,'SP'),('Ilha Solteira',5016,'SP'),('Ilhabela',5017,'SP'),('Indaiatuba',5018,'SP'),('Indiana',5019,'SP'),('Indiaporã',5020,'SP'),('Inúbia Paulista',5021,'SP'),('Ipaussu',5022,'SP'),('Iperó',5023,'SP'),('Ipeúna',5024,'SP'),('Ipiguá',5025,'SP'),('Iporanga',5026,'SP'),('Ipuã',5027,'SP'),('Iracemápolis',5028,'SP'),('Irapuã',5029,'SP'),('Irapuru',5030,'SP'),('Itaberá',5031,'SP'),('Itaí',5032,'SP'),('Itajobi',5033,'SP'),('Itaju',5034,'SP'),('Itanhaém',5035,'SP'),('Itaóca',5036,'SP'),('Itapecerica da Serra',5037,'SP'),('Itapetininga',5038,'SP'),('Itapeva',5039,'SP'),('Itapevi',5040,'SP'),('Itapira',5041,'SP'),('Itapirapuã Paulista',5042,'SP'),('Itápolis',5043,'SP'),('Itaporanga',5044,'SP'),('Itapuí',5045,'SP'),('Itapura',5046,'SP'),('Itaquaquecetuba',5047,'SP'),('Itararé',5048,'SP'),('Itariri',5049,'SP'),('Itatiba',5050,'SP'),('Itatinga',5051,'SP'),('Itirapina',5052,'SP'),('Itirapuã',5053,'SP'),('Itobi',5054,'SP'),('Itu',5055,'SP'),('Itupeva',5056,'SP'),('Ituverava',5057,'SP'),('Jaborandi',5058,'SP'),('Jaboticabal',5059,'SP'),('Jacareí',5060,'SP'),('Jaci',5061,'SP'),('Jacupiranga',5062,'SP'),('Jaguariúna',5063,'SP'),('Jales',5064,'SP'),('Jambeiro',5065,'SP'),('Jandira',5066,'SP'),('Jardinópolis',5067,'SP'),('Jarinu',5068,'SP'),('Jaú',5069,'SP'),('Jeriquara',5070,'SP'),('Joanópolis',5071,'SP'),('João Ramalho',5072,'SP'),('José Bonifácio',5073,'SP'),('Júlio Mesquita',5074,'SP'),('Jumirim',5075,'SP'),('Jundiaí',5076,'SP'),('Junqueirópolis',5077,'SP'),('Juquiá',5078,'SP'),('Juquitiba',5079,'SP'),('Lagoinha',5080,'SP'),('Laranjal Paulista',5081,'SP'),('Lavínia',5082,'SP'),('Lavrinhas',5083,'SP'),('Leme',5084,'SP'),('Lençóis Paulista',5085,'SP'),('Limeira',5086,'SP'),('Lindóia',5087,'SP'),('Lins',5088,'SP'),('Lorena',5089,'SP'),('Lourdes',5090,'SP'),('Louveira',5091,'SP'),('Lucélia',5092,'SP'),('Lucianópolis',5093,'SP'),('Luís Antônio',5094,'SP'),('Luiziânia',5095,'SP'),('Lupércio',5096,'SP'),('Lutécia',5097,'SP'),('Macatuba',5098,'SP'),('Macaubal',5099,'SP'),('Macedônia',5100,'SP'),('Magda',5101,'SP'),('Mairinque',5102,'SP'),('Mairiporã',5103,'SP'),('Manduri',5104,'SP'),('Marabá Paulista',5105,'SP'),('Maracaí',5106,'SP'),('Marapoama',5107,'SP'),('Mariápolis',5108,'SP'),('Marília',5109,'SP'),('Marinópolis',5110,'SP'),('Martinópolis',5111,'SP'),('Matão',5112,'SP'),('Mauá',5113,'SP'),('Mendonça',5114,'SP'),('Meridiano',5115,'SP'),('Mesópolis',5116,'SP'),('Miguelópolis',5117,'SP'),('Mineiros do Tietê',5118,'SP'),('Mira Estrela',5119,'SP'),('Miracatu',5120,'SP'),('Mirandópolis',5121,'SP'),('Mirante do Paranapanema',5122,'SP'),('Mirassol',5123,'SP'),('Mirassolândia',5124,'SP'),('Mococa',5125,'SP'),('Mogi das Cruzes',5126,'SP'),('Mogi Guaçu',5127,'SP'),('Moji Mirim',5128,'SP'),('Mombuca',5129,'SP'),('Monções',5130,'SP'),('Mongaguá',5131,'SP'),('Monte Alegre do Sul',5132,'SP'),('Monte Alto',5133,'SP'),('Monte Aprazível',5134,'SP'),('Monte Azul Paulista',5135,'SP'),('Monte Castelo',5136,'SP'),('Monte Mor',5137,'SP'),('Monteiro Lobato',5138,'SP'),('Morro Agudo',5139,'SP'),('Morungaba',5140,'SP'),('Motuca',5141,'SP'),('Murutinga do Sul',5142,'SP'),('Nantes',5143,'SP'),('Narandiba',5144,'SP'),('Natividade da Serra',5145,'SP'),('Nazaré Paulista',5146,'SP'),('Neves Paulista',5147,'SP'),('Nhandeara',5148,'SP'),('Nipoã',5149,'SP'),('Nova Aliança',5150,'SP'),('Nova Campina',5151,'SP'),('Nova Canaã Paulista',5152,'SP'),('Nova Castilho',5153,'SP'),('Nova Europa',5154,'SP'),('Nova Granada',5155,'SP'),('Nova Guataporanga',5156,'SP'),('Nova Independência',5157,'SP'),('Nova Luzitânia',5158,'SP'),('Nova Odessa',5159,'SP'),('Novais',5160,'SP'),('Novo Horizonte',5161,'SP'),('Nuporanga',5162,'SP'),('Ocauçu',5163,'SP'),('Óleo',5164,'SP'),('Olímpia',5165,'SP'),('Onda Verde',5166,'SP'),('Oriente',5167,'SP'),('Orindiúva',5168,'SP'),('Orlândia',5169,'SP'),('Osasco',5170,'SP'),('Oscar Bressane',5171,'SP'),('Osvaldo Cruz',5172,'SP'),('Ourinhos',5173,'SP'),('Ouro Verde',5174,'SP'),('Ouroeste',5175,'SP'),('Pacaembu',5176,'SP'),('Palestina',5177,'SP'),('Palmares Paulista',5178,'SP'),('Palmeira d`Oeste',5179,'SP'),('Palmital',5180,'SP'),('Panorama',5181,'SP'),('Paraguaçu Paulista',5182,'SP'),('Paraibuna',5183,'SP'),('Paraíso',5184,'SP'),('Paranapanema',5185,'SP'),('Paranapuã',5186,'SP'),('Parapuã',5187,'SP'),('Pardinho',5188,'SP'),('Pariquera-Açu',5189,'SP'),('Parisi',5190,'SP'),('Patrocínio Paulista',5191,'SP'),('Paulicéia',5192,'SP'),('Paulínia',5193,'SP'),('Paulistânia',5194,'SP'),('Paulo de Faria',5195,'SP'),('Pederneiras',5196,'SP'),('Pedra Bela',5197,'SP'),('Pedranópolis',5198,'SP'),('Pedregulho',5199,'SP'),('Pedreira',5200,'SP'),('Pedrinhas Paulista',5201,'SP'),('Pedro de Toledo',5202,'SP'),('Penápolis',5203,'SP'),('Pereira Barreto',5204,'SP'),('Pereiras',5205,'SP'),('Peruíbe',5206,'SP'),('Piacatu',5207,'SP'),('Piedade',5208,'SP'),('Pilar do Sul',5209,'SP'),('Pindamonhangaba',5210,'SP'),('Pindorama',5211,'SP'),('Pinhalzinho',5212,'SP'),('Piquerobi',5213,'SP'),('Piquete',5214,'SP'),('Piracaia',5215,'SP'),('Piracicaba',5216,'SP'),('Piraju',5217,'SP'),('Pirajuí',5218,'SP'),('Pirangi',5219,'SP'),('Pirapora do Bom Jesus',5220,'SP'),('Pirapozinho',5221,'SP'),('Pirassununga',5222,'SP'),('Piratininga',5223,'SP'),('Pitangueiras',5224,'SP'),('Planalto',5225,'SP'),('Platina',5226,'SP'),('Poá',5227,'SP'),('Poloni',5228,'SP'),('Pompéia',5229,'SP'),('Pongaí',5230,'SP'),('Pontal',5231,'SP'),('Pontalinda',5232,'SP'),('Pontes Gestal',5233,'SP'),('Populina',5234,'SP'),('Porangaba',5235,'SP'),('Porto Feliz',5236,'SP'),('Porto Ferreira',5237,'SP'),('Potim',5238,'SP'),('Potirendaba',5239,'SP'),('Pracinha',5240,'SP'),('Pradópolis',5241,'SP'),('Praia Grande',5242,'SP'),('Pratânia',5243,'SP'),('Presidente Alves',5244,'SP'),('Presidente Bernardes',5245,'SP'),('Presidente Epitácio',5246,'SP'),('Presidente Prudente',5247,'SP'),('Presidente Venceslau',5248,'SP'),('Promissão',5249,'SP'),('Quadra',5250,'SP'),('Quatá',5251,'SP'),('Queiroz',5252,'SP'),('Queluz',5253,'SP'),('Quintana',5254,'SP'),('Rafard',5255,'SP'),('Rancharia',5256,'SP'),('Redenção da Serra',5257,'SP'),('Regente Feijó',5258,'SP'),('Reginópolis',5259,'SP'),('Registro',5260,'SP'),('Restinga',5261,'SP'),('Ribeira',5262,'SP'),('Ribeirão Bonito',5263,'SP'),('Ribeirão Branco',5264,'SP'),('Ribeirão Corrente',5265,'SP'),('Ribeirão do Sul',5266,'SP'),('Ribeirão dos Índios',5267,'SP'),('Ribeirão Grande',5268,'SP'),('Ribeirão Pires',5269,'SP'),('Ribeirão Preto',5270,'SP'),('Rifaina',5271,'SP'),('Rincão',5272,'SP'),('Rinópolis',5273,'SP'),('Rio Claro',5274,'SP'),('Rio das Pedras',5275,'SP'),('Rio Grande da Serra',5276,'SP'),('Riolândia',5277,'SP'),('Riversul',5278,'SP'),('Rosana',5279,'SP'),('Roseira',5280,'SP'),('Rubiácea',5281,'SP'),('Rubinéia',5282,'SP'),('Sabino',5283,'SP'),('Sagres',5284,'SP'),('Sales',5285,'SP'),('Sales Oliveira',5286,'SP'),('Salesópolis',5287,'SP'),('Salmourão',5288,'SP'),('Saltinho',5289,'SP'),('Salto',5290,'SP'),('Salto de Pirapora',5291,'SP'),('Salto Grande',5292,'SP'),('Sandovalina',5293,'SP'),('Santa Adélia',5294,'SP'),('Santa Albertina',5295,'SP'),('Santa Bárbara d`Oeste',5296,'SP'),('Santa Branca',5297,'SP'),('Santa Clara d`Oeste',5298,'SP'),('Santa Cruz da Conceição',5299,'SP'),('Santa Cruz da Esperança',5300,'SP'),('Santa Cruz das Palmeiras',5301,'SP'),('Santa Cruz do Rio Pardo',5302,'SP'),('Santa Ernestina',5303,'SP'),('Santa Fé do Sul',5304,'SP'),('Santa Gertrudes',5305,'SP'),('Santa Isabel',5306,'SP'),('Santa Lúcia',5307,'SP'),('Santa Maria da Serra',5308,'SP'),('Santa Mercedes',5309,'SP'),('Santa Rita d`Oeste',5310,'SP'),('Santa Rita do Passa Quatro',5311,'SP'),('Santa Rosa de Viterbo',5312,'SP'),('Santa Salete',5313,'SP'),('Santana da Ponte Pensa',5314,'SP'),('Santana de Parnaíba',5315,'SP'),('Santo Anastácio',5316,'SP'),('Santo André',5317,'SP'),('Santo Antônio da Alegria',5318,'SP'),('Santo Antônio de Posse',5319,'SP'),('Santo Antônio do Aracanguá',5320,'SP'),('Santo Antônio do Jardim',5321,'SP'),('Santo Antônio do Pinhal',5322,'SP'),('Santo Expedito',5323,'SP'),('Santópolis do Aguapeí',5324,'SP'),('Santos',5325,'SP'),('São Bento do Sapucaí',5326,'SP'),('São Bernardo do Campo',5327,'SP'),('São Caetano do Sul',5328,'SP'),('São Carlos',5329,'SP'),('São Francisco',5330,'SP'),('São João da Boa Vista',5331,'SP'),('São João das Duas Pontes',5332,'SP'),('São João de Iracema',5333,'SP'),('São João do Pau d`Alho',5334,'SP'),('São Joaquim da Barra',5335,'SP'),('São José da Bela Vista',5336,'SP'),('São José do Barreiro',5337,'SP'),('São José do Rio Pardo',5338,'SP'),('São José do Rio Preto',5339,'SP'),('São José dos Campos',5340,'SP'),('São Lourenço da Serra',5341,'SP'),('São Luís do Paraitinga',5342,'SP'),('São Manuel',5343,'SP'),('São Miguel Arcanjo',5344,'SP'),('São Paulo',5345,'SP'),('São Pedro',5346,'SP'),('São Pedro do Turvo',5347,'SP'),('São Roque',5348,'SP'),('São Sebastião',5349,'SP'),('São Sebastião da Grama',5350,'SP'),('São Simão',5351,'SP'),('São Vicente',5352,'SP'),('Sarapuí',5353,'SP'),('Sarutaiá',5354,'SP'),('Sebastianópolis do Sul',5355,'SP'),('Serra Azul',5356,'SP'),('Serra Negra',5357,'SP'),('Serrana',5358,'SP'),('Sertãozinho',5359,'SP'),('Sete Barras',5360,'SP'),('Severínia',5361,'SP'),('Silveiras',5362,'SP'),('Socorro',5363,'SP'),('Sorocaba',5364,'SP'),('Sud Mennucci',5365,'SP'),('Sumaré',5366,'SP'),('Suzanápolis',5367,'SP'),('Suzano',5368,'SP'),('Tabapuã',5369,'SP'),('Tabatinga',5370,'SP'),('Taboão da Serra',5371,'SP'),('Taciba',5372,'SP'),('Taguaí',5373,'SP'),('Taiaçu',5374,'SP'),('Taiúva',5375,'SP'),('Tambaú',5376,'SP'),('Tanabi',5377,'SP'),('Tapiraí',5378,'SP'),('Tapiratiba',5379,'SP'),('Taquaral',5380,'SP'),('Taquaritinga',5381,'SP'),('Taquarituba',5382,'SP'),('Taquarivaí',5383,'SP'),('Tarabai',5384,'SP'),('Tarumã',5385,'SP'),('Tatuí',5386,'SP'),('Taubaté',5387,'SP'),('Tejupá',5388,'SP'),('Teodoro Sampaio',5389,'SP'),('Terra Roxa',5390,'SP'),('Tietê',5391,'SP'),('Timburi',5392,'SP'),('Torre de Pedra',5393,'SP'),('Torrinha',5394,'SP'),('Trabiju',5395,'SP'),('Tremembé',5396,'SP'),('Três Fronteiras',5397,'SP'),('Tuiuti',5398,'SP'),('Tupã',5399,'SP'),('Tupi Paulista',5400,'SP'),('Turiúba',5401,'SP'),('Turmalina',5402,'SP'),('Ubarana',5403,'SP'),('Ubatuba',5404,'SP'),('Ubirajara',5405,'SP'),('Uchoa',5406,'SP'),('União Paulista',5407,'SP'),('Urânia',5408,'SP'),('Uru',5409,'SP'),('Urupês',5410,'SP'),('Valentim Gentil',5411,'SP'),('Valinhos',5412,'SP'),('Valparaíso',5413,'SP'),('Vargem',5414,'SP'),('Vargem Grande do Sul',5415,'SP'),('Vargem Grande Paulista',5416,'SP'),('Várzea Paulista',5417,'SP'),('Vera Cruz',5418,'SP'),('Vinhedo',5419,'SP'),('Viradouro',5420,'SP'),('Vista Alegre do Alto',5421,'SP'),('Vitória Brasil',5422,'SP'),('Votorantim',5423,'SP'),('Votuporanga',5424,'SP'),('Zacarias',5425,'SP'),('Abreulândia',5426,'TO'),('Aguiarnópolis',5427,'TO'),('Aliança do Tocantins',5428,'TO'),('Almas',5429,'TO'),('Alvorada',5430,'TO'),('Ananás',5431,'TO'),('Angico',5432,'TO'),('Aparecida do Rio Negro',5433,'TO'),('Aragominas',5434,'TO'),('Araguacema',5435,'TO'),('Araguaçu',5436,'TO'),('Araguaína',5437,'TO'),('Araguanã',5438,'TO'),('Araguatins',5439,'TO'),('Arapoema',5440,'TO'),('Arraias',5441,'TO'),('Augustinópolis',5442,'TO'),('Aurora do Tocantins',5443,'TO'),('Axixá do Tocantins',5444,'TO'),('Babaçulândia',5445,'TO'),('Bandeirantes do Tocantins',5446,'TO'),('Barra do Ouro',5447,'TO'),('Barrolândia',5448,'TO'),('Bernardo Sayão',5449,'TO'),('Bom Jesus do Tocantins',5450,'TO'),('Brasilândia do Tocantins',5451,'TO'),('Brejinho de Nazaré',5452,'TO'),('Buriti do Tocantins',5453,'TO'),('Cachoeirinha',5454,'TO'),('Campos Lindos',5455,'TO'),('Cariri do Tocantins',5456,'TO'),('Carmolândia',5457,'TO'),('Carrasco Bonito',5458,'TO'),('Caseara',5459,'TO'),('Centenário',5460,'TO'),('Chapada da Natividade',5461,'TO'),('Chapada de Areia',5462,'TO'),('Colinas do Tocantins',5463,'TO'),('Colméia',5464,'TO'),('Combinado',5465,'TO'),('Conceição do Tocantins',5466,'TO'),('Couto de Magalhães',5467,'TO'),('Cristalândia',5468,'TO'),('Crixás do Tocantins',5469,'TO'),('Darcinópolis',5470,'TO'),('Dianópolis',5471,'TO'),('Divinópolis do Tocantins',5472,'TO'),('Dois Irmãos do Tocantins',5473,'TO'),('Dueré',5474,'TO'),('Esperantina',5475,'TO'),('Fátima',5476,'TO'),('Figueirópolis',5477,'TO'),('Filadélfia',5478,'TO'),('Formoso do Araguaia',5479,'TO'),('Fortaleza do Tabocão',5480,'TO'),('Goianorte',5481,'TO'),('Goiatins',5482,'TO'),('Guaraí',5483,'TO'),('Gurupi',5484,'TO'),('Ipueiras',5485,'TO'),('Itacajá',5486,'TO'),('Itaguatins',5487,'TO'),('Itapiratins',5488,'TO'),('Itaporã do Tocantins',5489,'TO'),('Jaú do Tocantins',5490,'TO'),('Juarina',5491,'TO'),('Lagoa da Confusão',5492,'TO'),('Lagoa do Tocantins',5493,'TO'),('Lajeado',5494,'TO'),('Lavandeira',5495,'TO'),('Lizarda',5496,'TO'),('Luzinópolis',5497,'TO'),('Marianópolis do Tocantins',5498,'TO'),('Mateiros',5499,'TO'),('Maurilândia do Tocantins',5500,'TO'),('Miracema do Tocantins',5501,'TO'),('Miranorte',5502,'TO'),('Monte do Carmo',5503,'TO'),('Monte Santo do Tocantins',5504,'TO'),('Muricilândia',5505,'TO'),('Natividade',5506,'TO'),('Nazaré',5507,'TO'),('Nova Olinda',5508,'TO'),('Nova Rosalândia',5509,'TO'),('Novo Acordo',5510,'TO'),('Novo Alegre',5511,'TO'),('Novo Jardim',5512,'TO'),('Oliveira de Fátima',5513,'TO'),('Palmas',5514,'TO'),('Palmeirante',5515,'TO'),('Palmeiras do Tocantins',5516,'TO'),('Palmeirópolis',5517,'TO'),('Paraíso do Tocantins',5518,'TO'),('Paranã',5519,'TO'),('Pau d`Arco',5520,'TO'),('Pedro Afonso',5521,'TO'),('Peixe',5522,'TO'),('Pequizeiro',5523,'TO'),('Pindorama do Tocantins',5524,'TO'),('Piraquê',5525,'TO'),('Pium',5526,'TO'),('Ponte Alta do Bom Jesus',5527,'TO'),('Ponte Alta do Tocantins',5528,'TO'),('Porto Alegre do Tocantins',5529,'TO'),('Porto Nacional',5530,'TO'),('Praia Norte',5531,'TO'),('Presidente Kennedy',5532,'TO'),('Pugmil',5533,'TO'),('Recursolândia',5534,'TO'),('Riachinho',5535,'TO'),('Rio da Conceição',5536,'TO'),('Rio dos Bois',5537,'TO'),('Rio Sono',5538,'TO'),('Sampaio',5539,'TO'),('Sandolândia',5540,'TO'),('Santa Fé do Araguaia',5541,'TO'),('Santa Maria do Tocantins',5542,'TO'),('Santa Rita do Tocantins',5543,'TO'),('Santa Rosa do Tocantins',5544,'TO'),('Santa Tereza do Tocantins',5545,'TO'),('Santa Terezinha do Tocantins',5546,'TO'),('São Bento do Tocantins',5547,'TO'),('São Félix do Tocantins',5548,'TO'),('São Miguel do Tocantins',5549,'TO'),('São Salvador do Tocantins',5550,'TO'),('São Sebastião do Tocantins',5551,'TO'),('São Valério da Natividade',5552,'TO'),('Silvanópolis',5553,'TO'),('Sítio Novo do Tocantins',5554,'TO'),('Sucupira',5555,'TO'),('Taguatinga',5556,'TO'),('Taipas do Tocantins',5557,'TO'),('Talismã',5558,'TO'),('Tocantínia',5559,'TO'),('Tocantinópolis',5560,'TO'),('Tupirama',5561,'TO'),('Tupiratins',5562,'TO'),('Wanderlândia',5563,'TO'),('Xambioá',5564,'TO'),('Barra do Geraldo',5565,'RN'),('São Miguel Paulista',5566,'SP');
/*!40000 ALTER TABLE `cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contas`
--

DROP TABLE IF EXISTS `contas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `tipo` varchar(1) NOT NULL COMMENT 'D - Devedora, C - Credora',
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=559 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contas`
--

LOCK TABLES `contas` WRITE;
/*!40000 ALTER TABLE `contas` DISABLE KEYS */;
INSERT INTO `contas` VALUES (1,'1','1','1','1','1',0,'Ativo','','',0.00,1,'D'),(2,'1.1','1','1.1','1.1','1.1',0,'Ativo Circulante','','',0.00,1,'D'),(3,'1.1.1','1','1.1','1.1.1','1.1.1',0,'Disponível','','',0.00,1,'D'),(4,'1.1.1.001','1','1.1','1.1.1','1.1.1.001',0,'Caixa Geral - Disponível','','Saldo de todos os caixas deduzida as provisões',0.00,1,'D'),(5,'1.1.1.001.001','1','1.1','1.1.1','1.1.1.001',1,'Caixa Central','','',0.00,1,'D'),(6,'1.1.1.001.002','1','1.1','1.1.1','1.1.1.001',2,'Caixa de Missões','','',0.00,1,'D'),(7,'1.1.1.001.003','1','1.1','1.1.1','1.1.1.001',3,'Caixa de Senhoras','','',0.00,1,'D'),(8,'1.1.1.001.004','1','1.1','1.1.1','1.1.1.001',4,'Caixa de Ensino','','',0.00,1,'D'),(9,'1.1.1.001.005','1','1.1','1.1.1','1.1.1.001',5,'Caixa Infantil','','',0.00,1,'D'),(10,'1.1.1.001.006','1','1.1','1.1.1','1.1.1.001',6,'( - ) Provisão p/ COMADEP - Contribuição 10%','','',0.00,1,'C'),(11,'1.1.1.001.007','1','1.1','1.1.1','1.1.1.001',7,'( - ) Provisão p/ SEMAD - Contribuição 40%','','',0.00,1,'C'),(12,'1.1.1.002','1','1.1','1.1.1','1.1.1.002',0,'Banco Conta Movimentos','','',0.00,1,'D'),(13,'1.1.1.002.001','1','1.1','1.1.1','1.1.1.002',20,'Banco do Brasil S/A','','',0.00,1,'D'),(14,'1.1.1.003','1','1.1','1.1.1','1.1.1.003',0,'Banco Conta Poupança','','',0.00,1,'D'),(15,'1.1.1.003.001','1','1.1','1.1.1','1.1.1.003',30,'Caixa Econônica Federal','','',0.00,1,'D'),(16,'1.1.1.004','1','1.1','1.1.1','1.1.1.004',0,'Títulos de Capitalização','','',0.00,1,'D'),(17,'1.1.1.005','1','1.1','1.1.1','1.1.1.005',0,'Mercado Aberto','','',0.00,1,'D'),(18,'1.1.1.006','1','1.1','1.1.1','1.1.1.006',0,'Banco Conta Vínculadas','','',0.00,1,'D'),(19,'1.1.1.006.001','1','1.1','1.1.1','1.1.1.006',60,'Banco do Brasil S/A','','',0.00,1,'D'),(20,'1.1.1.007','1','1.1','1.1.1','1.1.1.007',0,'Adiantamentos a Funcionários','','',0.00,1,'D'),(21,'1.1.1.007.001','1','1.1','1.1.1','1.1.1.007',70,'Adiantamento de Salários','','',0.00,1,'D'),(22,'1.1.1.007.002','1','1.1','1.1.1','1.1.1.007',71,'Adiantamentos de Férias','','',0.00,1,'D'),(23,'1.1.1.007.003','1','1.1','1.1.1','1.1.1.007',72,'Adiantamento de 13º Salário','','',0.00,1,'D'),(24,'1.1.1.099','1','1.1','1.1.1','1.1.1.099',0,'Outros Créditos','','',0.00,1,'D'),(25,'1.1.1.099.001','1','1.1','1.1.1','1.1.1.099',150,'Créditos em Circulação','','',0.00,1,'D'),(26,'1.2','1','1.2','1.2','1.2',0,'Ativo Permanete','','',0.00,1,'D'),(27,'1.2.1','1','1.2','1.2.1','1.2.1',0,'Imobilizado','','',0.00,1,'D'),(28,'1.2.1.001','1','1.2','1.2.1','1.2.1.001',0,'Matriz','','',0.00,1,'D'),(29,'1.2.1.001.005','1','1.2','1.2.1','1.2.1.001',164,'Predios','','',0.00,1,'D'),(30,'1.2.1.001.001','1','1.2','1.2.1','1.2.1.001',160,'Móveis e Utensílios','','',0.00,1,'D'),(31,'1.2.1.001.002','1','1.2','1.2.1','1.2.1.001',161,'Máquinas e Equipamentos','','',0.00,1,'D'),(32,'1.2.1.001.003','1','1.2','1.2.1','1.2.1.001',162,'Veículos','','',0.00,1,'D'),(33,'1.2.1.001.004','1','1.2','1.2.1','1.2.1.001',163,'Terrenos','','',0.00,1,'D'),(34,'1.2.1.002','1','1.2','1.2.1','1.2.1.002',0,'Congregações','','',0.00,1,'D'),(35,'1.2.1.002.001','1','1.2','1.2.1','1.2.1.002',170,'Móveis e Utensílios','','',0.00,1,'D'),(36,'1.2.1.002.002','1','1.2','1.2.1','1.2.1.002',171,'Terrenos','','',0.00,1,'D'),(37,'1.2.1.002.003','1','1.2','1.2.1','1.2.1.002',172,'Instalações e Manutenção - Congregações','','',0.00,1,'D'),(38,'1.2.1.002.004','1','1.2','1.2.1','1.2.1.002',173,'Máquinas e Equipamentos','','',0.00,1,'D'),(39,'1.2.1.002.005','1','1.2','1.2.1','1.2.1.002',174,'Prédio','','',0.00,1,'D'),(40,'1.3','1','1.3','1.3','1.3',0,'Investimentos','','',0.00,1,'D'),(41,'2','2','2','2','2',0,'Passivo','','',0.00,1,'C'),(42,'2.1','2','2.1','2.1','2.1',0,'Passivo Circulante','','',0.00,1,'C'),(43,'2.1.1','2','2.1','2.1.1','2.1.1',0,'Fornecedores','','',0.00,1,'C'),(44,'2.1.1.001','2','2.1','2.1.1','2.1.1.001',0,'Sede e Congregações','','',0.00,1,'C'),(45,'2.1.1.001.001','2','2.1','2.1.1','2.1.1.001',300,'Kiluz - Mat. Elétrico Ltda.','','',0.00,1,'C'),(46,'2.1.1.001.002','2','2.1','2.1.1','2.1.1.001',301,'Tocmix','','',0.00,1,'C'),(47,'2.1.1.001.003','2','2.1','2.1.1','2.1.1.001',302,'Geraldo - Mat. de Construção','','',0.00,1,'C'),(48,'2.1.1.001.004','2','2.1','2.1.1','2.1.1.001',303,'Lojão da Econômica - Mat. de Construção','','',0.00,1,'C'),(49,'2.1.2','2','2.1','2.1.2','2.1.2',0,'Credores Diversos','','',0.00,1,'C'),(50,'2.1.2.001','2','2.1','2.1.2','2.1.2.001',0,'Sede e Congregações','','',0.00,1,'C'),(51,'2.1.3','2','2.1','2.1.3','2.1.3',0,'Obrigações Sociais','','',0.00,1,'C'),(52,'2.1.3.001','2','2.1','2.1.3','2.1.3.001',0,'Sede e Congregações','','',0.00,1,'C'),(53,'2.1.3.001.001','2','2.1','2.1.3','2.1.3.001',304,'MPS - Previdência Social - A Recolher','','',0.00,1,'C'),(54,'2.1.3.001.002','2','2.1','2.1.3','2.1.3.001',305,'FGTS - Fundo de Garantia - A Recolher','','',0.00,1,'C'),(55,'2.1.3.001.003','2','2.1','2.1.3','2.1.3.001',306,'PIS a Recolher','','',0.00,1,'C'),(56,'2.1.3.001.004','2','2.1','2.1.3','2.1.3.001',0,'Salários a Pagar','','',0.00,1,'C'),(57,'2.1.3.001.005','2','2.1','2.1.3','2.1.3.001',308,'Férias a Pagar','','',0.00,1,'C'),(58,'2.1.3.001.006','2','2.1','2.1.3','2.1.3.001',309,'Vale Transporte a Pagar','','',0.00,1,'C'),(59,'2.1.4','2','2.1','2.1.4','2.1.4',0,'Emprestimos e financiamentos','','',0.00,1,'C'),(60,'2.1.4.001','2','2.1','2.1.4','2.1.4.001',0,'Sede e Congregações','','',0.00,1,'C'),(61,'2.1.4.001.001','2','2.1','2.1.4','2.1.4.001',330,'Tambay Motor - Concesionária','','',0.00,1,'C'),(62,'2.1.5','2','2.1','2.1.5','2.1.5',0,'Provisões','','',0.00,1,'C'),(71,'2.1.5.001','2','2.1','2.1.5','2.1.5.001',0,'SEMAD - Sec. de Missões','','',0.00,1,'C'),(72,'2.1.5.001.001','2','2.1','2.1.5','2.1.5.001',870,'Provisão p/ SEMAD - Sede e Congregações','','',0.00,1,'C'),(73,'2.2','2','2.2','2.2','2.2',0,'Patrimônio Líquido','','',0.00,1,'C'),(74,'2.2.1','2','2.2','2.2.1','2.2.1',0,'Patrimônio','','',0.00,1,'C'),(75,'2.2.1.001','2','2.2','2.2.1','2.2.1.001',0,'Sede e Congregações','','',0.00,1,'C'),(76,'2.2.1.001.001','2','2.2','2.2.1','2.2.1.001',311,'Patrimômio Social','','',0.00,1,'C'),(80,'3','3','3','3','3',0,'DESPESAS','','',0.00,1,'D'),(81,'3.1','3','3.1','3.1','3.1',0,'DESPESAS OPERACIONAIS','','',0.00,1,'D'),(82,'3.1.1','3','3.1','3.1.1','3.1.1',0,'DESPESAS ECLESIÁSTICAS','','',0.00,1,'D'),(83,'3.1.1.001','3','3.1','3.1.1','3.1.1.001',0,'DESPESAS C/ CULTOS','','',0.00,1,'D'),(84,'3.1.1.001.001','3','3.1','3.1.1','3.1.1.001',400,'Despesas c/ Energia Elétrica','','',0.00,1,'D'),(85,'3.1.1.001.002','3','3.1','3.1.1','3.1.1.001',401,'Água e Esgoto','','',0.00,1,'D'),(86,'3.1.1.001.003','3','3.1','3.1.1','3.1.1.001',402,'Material de Higiene e Limpeza','','',0.00,1,'D'),(87,'3.1.1.001.004','3','3.1','3.1.1','3.1.1.001',403,'Santa Ceia','','',0.00,1,'D'),(88,'3.1.1.001.005','3','3.1','3.1.1','3.1.1.001',404,'Oferta Zelador','','',0.00,1,'D'),(89,'3.1.1.001.006','3','3.1','3.1.1','3.1.1.001',405,'Aluguel e Locação','','',0.00,1,'D'),(90,'3.1.1.001.007','3','3.1','3.1.1','3.1.1.001',406,'COMADEP - Contribuição 10%','','Contribuição sobre arrecadação cultos em geral (exeto oferta missões), circ. de oração',0.00,1,'D'),(100,'3.1.1.002','3','3.1','3.1.1','3.1.1.002',0,'AÇÃO SOCIAL','','',0.00,1,'D'),(101,'3.1.1.002.001','3','3.1','3.1.1','3.1.1.002',410,'Medicamentos e Consultas','','',0.00,1,'D'),(102,'3.1.1.002.002','3','3.1','3.1.1','3.1.1.002',411,'Generos Alimentícios','','',0.00,1,'D'),(103,'3.1.1.002.003','3','3.1','3.1.1','3.1.1.002',412,'Auxílio Social','','',0.00,1,'D'),(104,'3.1.1.002.004','3','3.1','3.1.1','3.1.1.002',413,'Energia Elétrica','','',0.00,1,'D'),(105,'3.1.1.002.005','3','3.1','3.1.1','3.1.1.002',414,'Água e Esgoto','','',0.00,1,'D'),(106,'3.1.1.003','3','3.1','3.1.1','3.1.1.003',0,'USADEBY','','',0.00,1,'D'),(107,'3.1.1.003.001','3','3.1','3.1.1','3.1.1.003',420,'Ofertas a Pregadores','','',0.00,1,'D'),(108,'3.1.1.003.002','3','3.1','3.1.1','3.1.1.003',421,'Passagem e Transporte','','',0.00,1,'D'),(109,'3.1.1.003.003','3','3.1','3.1.1','3.1.1.003',422,'Presentes','','',0.00,1,'D'),(110,'3.1.1.003.004','3','3.1','3.1.1','3.1.1.003',423,'Congressos e Eventos','','',0.00,1,'D'),(111,'3.1.1.003.005','3','3.1','3.1.1','3.1.1.003',424,'Alimentação','','',0.00,1,'D'),(112,'3.1.1.004','3','3.1','3.1.1','3.1.1.004',0,'UMADEBY','','',0.00,1,'D'),(113,'3.1.1.004.001','3','3.1','3.1.1','3.1.1.004',430,'Ofertas a Pregadores','','',0.00,1,'D'),(114,'3.1.1.004.002','3','3.1','3.1.1','3.1.1.004',431,'Passagem e Transporte','','',0.00,1,'D'),(115,'3.1.1.004.003','3','3.1','3.1.1','3.1.1.004',432,'Presentes','','',0.00,1,'D'),(116,'3.1.1.004.004','3','3.1','3.1.1','3.1.1.004',433,'Congressos e Eventos','','',0.00,1,'D'),(117,'3.1.1.004.005','3','3.1','3.1.1','3.1.1.004',434,'Alimentação','','',0.00,1,'D'),(118,'3.1.1.005','3','3.1','3.1.1','3.1.1.005',0,'DEADBY - DEPARTAMENTO DE ENSINO','','',0.00,1,'D'),(119,'3.1.1.005.001','3','3.1','3.1.1','3.1.1.005',440,'Lições bíblicas Infantil','','',0.00,1,'D'),(120,'3.1.1.005.002','3','3.1','3.1.1','3.1.1.005',441,'Lições Bíblicas Adulto','','',0.00,1,'D'),(121,'3.1.1.005.003','3','3.1','3.1.1','3.1.1.005',442,'Material Escolar','','Despesas com quadro, canetas, cadernos, carteiras e outros do mesmo gênero',0.00,1,'D'),(122,'3.1.1.005.004','3','3.1','3.1.1','3.1.1.005',443,'Passagem e Transporte','','Auxílio de passagens a professores de EB e teologia da Igreja',0.00,1,'D'),(123,'3.1.1.005.005','3','3.1','3.1.1','3.1.1.005',444,'Congressos e Eventos','','Despesas com cursos, inscrições em congressos e viagens para capacitação e aperfeiçoamento de professores\r\n',0.00,1,'D'),(124,'3.1.1.005.006','3','3.1','3.1.1','3.1.1.005',445,'Biblioteca','','Despesas com livros para o acervo',0.00,1,'D'),(125,'3.1.1.005.007','3','3.1','3.1.1','3.1.1.005',446,'Capacitação de Professores','','',0.00,1,'D'),(126,'3.1.1.005.008','3','3.1','3.1.1','3.1.1.005',447,'Ofertas a Professores e Palestrantes','','',0.00,1,'D'),(127,'3.1.1.006','3','3.1','3.1.1','3.1.1.006',0,'DEMADBY - DEP. DE MÚSICA','','Despesas com corais, sonoplastia, professores de música e outros do gênero',0.00,1,'D'),(128,'3.1.1.006.001','3','3.1','3.1.1','3.1.1.006',460,'Oferta Maestro','','',0.00,1,'D'),(129,'3.1.1.006.002','3','3.1','3.1.1','3.1.1.006',461,'Oferta Sonoplasta','','',0.00,1,'D'),(130,'3.1.2','3','3.1','3.1.2','3.1.2',0,'DESPESAS ADMINISTRATIVAS','','',0.00,1,'D'),(131,'3.1.2.001','3','3.1','3.1.2','3.1.2.001',0,'ADMINISTRAÇÃO','','',0.00,1,'D'),(132,'3.1.2.001.001','3','3.1','3.1.2','3.1.2.001',501,'Água e Esgoto','','',0.00,1,'D'),(133,'3.1.2.001.002','3','3.1','3.1.2','3.1.2.001',502,'Energia Elétrica','','',0.00,1,'D'),(134,'3.1.2.001.003','3','3.1','3.1.2','3.1.2.001',503,'Material de Expediente','','Gastos com canetas, papeis, cartuchos, tonners e outros',0.00,1,'D'),(135,'3.1.2.001.004','3','3.1','3.1.2','3.1.2.001',504,'Telefone','','',0.00,1,'D'),(136,'3.1.2.001.005','3','3.1','3.1.2','3.1.2.001',505,'Auxílios e Ofertas','','',0.00,1,'D'),(137,'3.1.2.001.006','3','3.1','3.1.2','3.1.2.001',506,'Combustíveis e Lubrificantes','','De veículos',0.00,1,'D'),(138,'3.1.2.001.007','3','3.1','3.1.2','3.1.2.001',507,'Despesas com Veículos','','Manuteção, multas de trânsito, lavagem ...',0.00,1,'D'),(139,'3.1.2.001.008','3','3.1','3.1.2','3.1.2.001',508,'Café e Lanches','','',0.00,1,'D'),(140,'3.1.2.001.009','3','3.1','3.1.2','3.1.2.001',509,'Higiene e Limpeza','','',0.00,1,'D'),(141,'3.1.2.001.010','3','3.1','3.1.2','3.1.2.001',510,'Impostos e Taxas','','',0.00,1,'D'),(142,'3.1.2.001.011','3','3.1','3.1.2','3.1.2.001',511,'Serviços de Terceiros','','',0.00,1,'D'),(143,'3.1.2.001.012','3','3.1','3.1.2','3.1.2.001',512,'Fretes e Carretos','','',0.00,1,'D'),(144,'3.1.2.001.013','3','3.1','3.1.2','3.1.2.001',513,'Cópias','','',0.00,1,'D'),(145,'3.1.2.001.014','3','3.1','3.1.2','3.1.2.001',514,'Consertos e Reparos','','Serviços e peças para conserto de equipamentos',0.00,1,'D'),(146,'3.1.2.001.015','3','3.1','3.1.2','3.1.2.001',515,'Prestação de Serviços','','',0.00,1,'D'),(147,'3.1.2.001.016','3','3.1','3.1.2','3.1.2.001',516,'Aluguel de Imóvel','','',0.00,1,'D'),(148,'3.1.2.001.017','3','3.1','3.1.2','3.1.2.001',517,'Fretes e Carretos','','',0.00,1,'D'),(149,'3.1.2.001.018','3','3.1','3.1.2','3.1.2.001',518,'Gratificações','','',0.00,1,'D'),(150,'3.1.2.001.019','3','3.1','3.1.2','3.1.2.001',519,'Manutenção e Conservação','','Serviço e material para manutenção de imóvel',0.00,1,'D'),(151,'3.1.2.001.020','3','3.1','3.1.2','3.1.2.001',520,'Viagens e Translados','','',0.00,1,'D'),(152,'3.1.2.001.021','3','3.1','3.1.2','3.1.2.001',521,'Instalações','','',0.00,1,'D'),(153,'3.1.2.001.022','3','3.1','3.1.2','3.1.2.001',522,'Hospedagens e Estadias','','',0.00,1,'D'),(154,'3.1.2.001.023','3','3.1','3.1.2','3.1.2.001',523,'Publicidade','','propagandas, Carro de som...',0.00,1,'D'),(155,'3.1.2.001.024','3','3.1','3.1.2','3.1.2.001',524,'Sinistro com Veículos','','Despesas com acidentes envolvendo veículos da igreja',0.00,1,'D'),(156,'3.1.2.001.025','3','3.1','3.1.2','3.1.2.001',525,'Ajuda de Custo','','',0.00,1,'D'),(157,'3.1.2.001.026','3','3.1','3.1.2','3.1.2.001',526,'Despesas com Cartório','','Autenticações, escrituras ...',0.00,1,'D'),(158,'3.1.2.001.027','3','3.1','3.1.2','3.1.2.001',527,'Comunicação','','Programs de rádio, provedores de intenet',0.00,1,'D'),(159,'3.1.2.001.028','3','3.1','3.1.2','3.1.2.001',528,'Correios e Postagens','','',0.00,1,'D'),(160,'3.1.2.001.029','3','3.1','3.1.2','3.1.2.001',529,'Máquinas e Equipamentos','','',0.00,1,'D'),(161,'3.1.2.001.030','3','3.1','3.1.2','3.1.2.001',530,'Móveis e Utensílios','','',0.00,1,'D'),(162,'3.1.2.001.031','3','3.1','3.1.2','3.1.2.001',531,'Caixa de Evangelização','','',0.00,1,'D'),(180,'3.1.2.001.099','3','3.1','3.1.2','3.1.2.001',549,'Despesas Diversas','','',0.00,1,'D'),(185,'3.1.2.002','3','3.1','3.1.2','3.1.2.002',0,'DESPESAS C/ CONSTRUÇÃO','','',0.00,1,'D'),(186,'3.1.2.002.001','3','3.1','3.1.2','3.1.2.002',600,'Meteriais para Construção Civil','','',0.00,1,'D'),(187,'3.1.2.002.002','3','3.1','3.1.2','3.1.2.002',601,'Serviços','','',0.00,1,'D'),(210,'3.1.3','3','3.1','3.1.3','3.1.3',0,'DESPESAS COM PESSOAL','','',0.00,1,'D'),(211,'3.1.3.001','3','3.1','3.1.3','3.1.3.001',0,'MÃO DE OBRA DIRETA','','',0.00,1,'D'),(212,'3.1.3.001.001','3','3.1','3.1.3','3.1.3.001',550,'Salário','','',0.00,1,'D'),(213,'3.1.3.001.002','3','3.1','3.1.3','3.1.3.001',551,'Décimo Terceiro','','',0.00,1,'D'),(214,'3.1.3.001.003','3','3.1','3.1.3','3.1.3.001',552,'Férias','','',0.00,1,'D'),(215,'3.1.3.001.004','3','3.1','3.1.3','3.1.3.001',553,'Encargos Sociais','','',0.00,1,'D'),(216,'3.1.3.001.005','3','3.1','3.1.3','3.1.3.001',554,'Vale Transporte','','',0.00,1,'D'),(217,'3.1.3.001.006','3','3.1','3.1.3','3.1.3.001',555,'Uniformes','','',0.00,1,'D'),(218,'3.1.3.001.007','3','3.1','3.1.3','3.1.3.001',556,'Refeições','','',0.00,1,'D'),(219,'3.1.3.001.008','3','3.1','3.1.3','3.1.3.001',557,'PIS Sobre a Folha','','',0.00,1,'D'),(220,'3.1.3.001.009','3','3.1','3.1.3','3.1.3.001',558,'FGTS','','',0.00,1,'D'),(230,'3.1.4','3','3.1','3.1.4','3.1.4',0,'DESPESAS TRIBUTÁRIAS','','',0.00,1,'D'),(231,'3.1.4.001','3','3.1','3.1.4','3.1.4.001',0,'DESPESAS E MULTAS FISCAIS','','',0.00,1,'D'),(232,'3.1.4.001.001','3','3.1','3.1.4','3.1.4.001',557,'IPTU','','',0.00,1,'D'),(233,'3.1.4.001.002','3','3.1','3.1.4','3.1.4.001',558,'IPVA','','',0.00,1,'D'),(234,'3.1.4.001.003','3','3.1','3.1.4','3.1.4.001',559,'IOF','','',0.00,1,'D'),(235,'3.1.4.001.004','3','3.1','3.1.4','3.1.4.001',560,'Multas Fiscais','','',0.00,1,'D'),(236,'3.1.4.001.005','3','3.1','3.1.4','3.1.4.001',561,'ITBI ','','',0.00,1,'D'),(237,'3.1.4.001.006','3','3.1','3.1.4','3.1.4.001',562,'IRRF - Imposto de Renda Retido na Fonte','','',0.00,1,'D'),(238,'3.1.4.001.099','3','3.1','3.1.4','3.1.4.001',563,'Impostos e Taxas Diversas','','',0.00,1,'D'),(250,'3.1.5','3','3.1','3.1.5','3.1.5',0,'DESPESAS FINANCEIRAS','','',0.00,1,'D'),(251,'3.1.5.001','3','3.1','3.1.5','3.1.5.001',0,'JUROS, MULTAS E CUSTOS FINANCEIROS','','',0.00,1,'D'),(252,'3.1.5.001.001','3','3.1','3.1.5','3.1.5.001',570,'Juros de Mora','','',0.00,1,'D'),(253,'3.1.5.001.002','3','3.1','3.1.5','3.1.5.001',571,'Multas Diversas','','',0.00,1,'D'),(254,'3.1.5.001.003','3','3.1','3.1.5','3.1.5.001',572,'Taxas Bancárias','','',0.00,1,'D'),(255,'3.1.5.001.004','3','3.1','3.1.5','3.1.5.001',573,'IOF','','',0.00,1,'D'),(260,'3.1.6','3','3.1','3.1.6','3.1.6.001',0,'DESPESAS SEMADBY','','Secretaria de Missões. Despesas na compra de bíblias, cruzadas, literatura...',0.00,1,'D'),(261,'3.1.6.001','3','3.1','3.1.6','3.1.6.001',0,'DESPESAS SEC. DE MISSÕES','','Secretaria de Missões. Despesas na compra de bíblias, cruzadas, literatura...',0.00,1,'D'),(262,'3.1.6.001.001','3','3.1','3.1.6','3.1.6.001',580,'Compra de Bíblias','','',0.00,1,'D'),(263,'3.1.6.001.002','3','3.1','3.1.6','3.1.6.001',581,'Compra de Literaturas','','',0.00,1,'D'),(264,'3.1.6.001.003','3','3.1','3.1.6','3.1.6.001',574,'Oferta a Pregadores - Missões','','',0.00,1,'D'),(265,'3.1.6.001.004','3','3.1','3.1.6','3.1.6.001',575,'Despesas com Cruzadas - Missões','','',0.00,1,'D'),(266,'3.1.6.001.005','3','3.1','3.1.6','3.1.6.001',576,'SEMAD - Contrib. Sec. de Missões 40%','','Contribuição da Sec. de Missões local a sede da convenção - indice de 40% das arrecadações',0.00,1,'D'),(300,'4','4','4','4','4',0,'RECEITAS','','',0.00,1,'C'),(301,'4.1','4','4.1','4.1','4.1',0,'RECEITAS OPERACIONAIS','','',0.00,1,'C'),(302,'4.1.1','4','4.1','4.1.1','4.1.1',0,'SEDE E CONGREGAÇÕES','','',0.00,1,'C'),(303,'4.1.1.001','4','4.1','4.1.1','4.1.1.001',0,'RECEITA DE CULTOS','','',0.00,1,'C'),(304,'4.1.1.001.001','4','4.1','4.1.1','4.1.1.001',700,'Dízimos','dízimos','',0.00,1,'C'),(305,'4.1.1.001.002','4','4.1','4.1.1','4.1.1.001',701,'Ofertas de cultos','ofertas','',0.00,1,'C'),(306,'4.1.1.001.003','4','4.1','4.1.1','4.1.1.001',702,'Ofertas Extras','ofertas extras','',0.00,1,'C'),(307,'4.1.1.001.004','4','4.1','4.1.1','4.1.1.002',703,'Outras Arrecadações em Cultos','ofertas','',0.00,1,'C'),(308,'4.1.1.001.005','4','4.1','4.1.1','4.1.1.001',704,'Votos em Cultos','votos','',0.00,1,'C'),(320,'4.1.1.002','4','4.1','4.1.1','4.1.1.002',0,'RECEITAS USADEBY','','',0.00,1,'C'),(321,'4.1.1.002.001','4','4.1','4.1.1','4.1.1.002',720,'Ofertas em Circ. de Oração - Adulto','ofertas (Senhoras)','',0.00,1,'C'),(322,'4.1.1.002.002','4','4.1','4.1.1','4.1.1.002',721,'Votos em Circ. de Oração','votos em circ. de oração','',0.00,1,'C'),(323,'4.1.1.002.003','4','4.1','4.1.1','4.1.1.002',722,'Ofertas de Cultos - Senhoras','ofertas (Senhoras)','Ofertas de Cultos de Senhoras na Sede e congregações',0.00,1,'C'),(325,'4.1.1.002.005','4','4.1','4.1.1','4.1.1.002',724,'ofertas extras de circ. de oração','ofertas (Senhoras)','',0.00,1,'C'),(326,'4.1.1.002.006','4','4.1','4.1.1','4.1.1.002',726,'Sobras de Vendas para Congresso','Sobras de Vendas','Sobras de Vendas para Congresso\',\'Sobra da venda de camisas, lanches, doações e outros relacionados, para realização do congresso ou outras festividades das Senhoras',0.00,1,'C'),(330,'4.1.1.002.099','4','4.1','4.1.1','4.1.1.002',725,'Outras Arrecadações em Circ. de Oração','ofertas (Senhoras)','',0.00,1,'C'),(331,'4.1.1.003','4','4.1','4.1.1','4.1.1.003',0,'RECEITAS DE CAMPANHAS ','','',0.00,1,'C'),(332,'4.1.1.003.001','4','4.1','4.1.1','4.1.1.003',730,'Joaquim Fernades - Compra e Construção','campanha (Joaquim Fernades)','Arrecadação para compra e/ou construção da nova congregação',0.00,1,'C'),(333,'4.1.1.003.002','4','4.1','4.1.1','4.1.1.003',731,'Templo Sede - Casas para ampliação','campanha das casas','Compra de casa para ampliação do templo sede',0.00,1,'C'),(334,'4.1.1.003.003','4','4.1','4.1.1','4.1.1.003',732,'Andreazza I - Reforma','campanha (Andreazza I )','Campanha para reforma da igreja realizada pelos irmãos',0.00,1,'C'),(400,'4.1.1.004','4','4.1','4.1.1','4.1.1.004',0,'DEADBY - DEPARTAMENTO DE ENSINO','','',0.00,1,'C'),(401,'4.1.1.004.001','4','4.1','4.1.1','4.1.1.004',800,'Ofertas - Escola Bíblicas','ofertas p/ ensino','',0.00,1,'C'),(402,'4.1.1.004.002','4','4.1','4.1.1','4.1.1.004',801,'Ofertas - Corpo de Professores','ofertas p/ ensino','',0.00,1,'C'),(403,'4.1.1.004.003','4','4.1','4.1.1','4.1.1.004',802,'Outras Arrecadações - Dep. de Ensino','ofertas p/ ensino','',0.00,1,'C'),(404,'4.1.1.004.004','4','4.1','4.1.1','4.1.1.004',803,'Arrecadações p/ pgto de Revista da EBD','coleta pgto revistas EBD','Arrecadações p/ pgto de Revista da EBD\',\'A igreja compra e repassa a preço de custo as revistas adquiridas diretamente na CPDA, além de custear todas as de criança',0.00,1,'C'),(420,'4.1.2','4','4.1','4.1.2','4.1.2',0,'MISSÕES','','',0.00,1,'C'),(421,'4.1.2.001','4','4.1','4.1.2','4.1.2.001',0,'SEDE E CONGREGAÇÕES - MISSÕES','','',0.00,1,'C'),(422,'4.1.2.001.001','4','4.1','4.1.2','4.1.2.001',820,'Ofertas de Missões -  Cultos na Sede','missões','',0.00,1,'C'),(423,'4.1.2.001.002','4','4.1','4.1.2','4.1.2.001',821,'Ofertas de Missões -  Cultos nas Congregações','missões','',0.00,1,'C'),(424,'4.1.2.001.003','4','4.1','4.1.2','4.1.2.001',822,'Ofertas de Missões -  Carnês','missões','',0.00,1,'C'),(425,'4.1.2.001.004','4','4.1','4.1.2','4.1.2.001',823,'Ofertas de Missões -  Cofre','missões','',0.00,1,'C'),(426,'4.1.2.001.005','4','4.1','4.1.2','4.1.2.001',824,'Ofertas de Missões -  Envelopes','missões','',0.00,1,'C'),(427,'4.1.2.001.007','4','4.1','4.1.2','4.1.2.001',825,'Votos para Missões','missões','',0.00,1,'C'),(440,'4.1.2.001.099','4','4.1','4.1.2','4.1.2.001',826,'Outras Arrecadações - Cultos de Missões','missões','',0.00,1,'C'),(460,'4.2','4','4.2','4.2','4.2',0,'RECEITAS NÃO OPERACIONAIS','','',0.00,1,'C'),(461,'4.2.1','4','4.2','4.2.1','4.2.1',0,'OUTRAS RECEITAS','','',0.00,1,'C'),(462,'4.2.1.001','4','4.2','4.2.1','4.2.1.001',0,'RECEITAS DIVERSAS - SEDE E CONGREGAÇÕES','','',0.00,1,'C'),(463,'4.2.1.001.001','4','4.2','4.2.1','4.2.1.001',840,'Arrecadação - Revistas Esc. Bíblica','coleta pgto revistas EBD','Arrecadação pela compra de revistas bíblicas',0.00,1,'C'),(464,'4.2.1.001.002','4','4.2','4.2.1','4.2.1.001',841,'Sobras de Vendas - Custear Eventos','sobras vendas pgto eventos','Venda de camisas e blusas para custear eventos de qualquer natureza',0.00,1,'C'),(480,'4.2.1.002','4','4.2','4.2.1','4.2.1.002',0,'RECEITAS FINANCEIRAS','','',0.00,1,'C'),(481,'4.2.1.002.001','4','4.2','4.2.1','4.2.1.002',860,'Rendimentos Sobre Aplicações ','','Poupança e outras aplicações',0.00,1,'C'),(482,'1.1.1.001.008','1','1.1','1.1.1','1.1.1.001',8,'Caixa Mocidade','','Referente cultos, ofertas e orações de mocidade',0.00,1,'D'),(483,'3.1.3.002','3','3.1','3.1.3','3.1.3.002',0,'DESPESAS COM MINISTÉRIO','','',0.00,1,'D'),(484,'3.1.3.002.001','3','3.1','3.1.3','3.1.3.002',880,'Oferta a Dirigentes de Congregação','','',0.00,1,'D'),(485,'3.1.3.002.002','3','3.1','3.1.3','3.1.3.002',881,'Ministério','','',0.00,1,'D'),(486,'3.1.2.002.003','3','3.1','3.1.2','3.1.2.002',602,'Alimentação trabalhadores da construção civil','','Gastos com alimentação relacionadas a construção civil e assemelhados ',0.00,1,'D'),(487,'3.1.2.001.032','3','3.1','3.1.2','3.1.2.001',532,'Serviço de Segurança','','Guarda e segurança de terceiros nas igrejas',0.00,1,'D'),(490,'4.1.1.005','4','4.1','4.1.1','4.1.1.005',0,'RECEITA UMADEBY','','Todas as entradas relacionadas as arrecadações de mocidade',0.00,1,'C'),(491,'4.1.1.005.001','4','4.1','4.1.1','4.1.1.005',900,'Ofertas em Circ. de Oração - Mocidade','ofertas mocidade','Circulo de oração da mocidade',0.00,1,'C'),(492,'4.1.1.005.007','4','4.1','4.1.1','4.1.1.005',906,'Sobras de Vendas - UMADEBY','','',0.00,1,'C'),(493,'4.2.1.001.003','4','4.2','4.2.1','4.2.1.001',842,'Sobras de Vendas p/ Custear Eventos - UMADEBY','sobras vendas pgto eventos','Vendas de Camisas, cantinas e assemelhados para custear qualquer tipo de evento da União da Mocidade',0.00,1,'C'),(494,'4.2.1.001.004','4','4.2','4.2.1','4.2.1.001',843,'Sobras de Vendas p/ Custear Eventos - USADEBY','sobras vendas pgto eventos','Vendas de Camisas, cantinas e assemelhados para custear qualquer tipo de evento da União da Mocidade',0.00,1,'C'),(495,'3.1.4.001.007','3','3.1','3.1.4','3.1.4.001',564,'MPS - Previdência Social','','Contribuições sociais dos contribuintes da Previdência Social',0.00,1,'D'),(496,'4.1.1.003.004','4','4.1','4.1.1','4.1.1.003',733,'Balbino de Mendonça - Campanha','campanha (Balbino )','Campanha realizada pela congregação para compra de algum equipamento, móvel ou qualquer objeto, desde que autorizado pelo Pastor da cidade',0.00,1,'C'),(497,'3.1.1.005.009','3','3.1','3.1.1','3.1.1.005',448,'Curso de Teologia','','Investimento em Curso de teologia para membros da igreja',0.00,1,'D'),(498,'3.1.1.001.008','3','3.1','3.1.1','3.1.1.001',407,'Som - Manutenção e Consertos','','Reparo, Manutenção, compra de peças para os equipamentos de som de uso na congregação e no evangelismo de rua',0.00,1,'D'),(499,'3.1.1.006.003','3','3.1','3.1.1','3.1.1.006',462,'Professores de Música','','Pgto a professores e instrutores de música, hora aula, e outras despesas relacionadas',0.00,1,'D'),(500,'4.1.1.005.002','4','4.1','4.1.1','4.1.1.005',901,'Setor I - Rubem','sobras vendas da mocidade','Arrecadação realizada pela mocidade do setor I, para composição de seu caixa',0.00,1,'C'),(501,'4.1.1.005.003','4','4.1','4.1.1','4.1.1.005',902,'Setor II - Zebulom','sobras vendas da mocidade','Arrecadação realizada pela mocidade do setor II, para composição de seu caixa',0.00,1,'C'),(502,'4.1.1.005.004','4','4.1','4.1.1','4.1.1.005',903,'Setor III - Azer','sobras vendas da mocidade','Arrecadação realizada pela mocidade do setor III, para composição de seu caixa',0.00,1,'C'),(503,'4.1.1.005.005','4','4.1','4.1.1','4.1.1.005',904,'Setor IV - Juda','sobras vendas da mocidade','Arrecadação realizada pela mocidade do setor IV, para composição de seu caixa',0.00,1,'C'),(504,'1.1.1.001.009','1','1.1','1.1.1','1.1.1.001',9,'Caixa Mocidade Setor I - Rubem','','Arrecadação realizada pela mocidade do setor I, para composição de seu caixa',0.00,1,'D'),(505,'1.1.1.001.010','1','1.1','1.1.1','1.1.1.001',10,'Caixa Mocidade Setor II - Zebulom','','Arrecadação realizada pela mocidade do setor II, para composição de seu caixa',0.00,1,'D'),(506,'1.1.1.001.011','1','1.1','1.1.1','1.1.1.001',11,'Caixa Mocidade Setor III - Azer','','Arrecadação realizada pela mocidade do setor III, para composição de seu caixa',0.00,1,'D'),(507,'1.1.1.001.012','1','1.1','1.1.1','1.1.1.001',12,'Caixa Mocidade Setor IV - Juda','','Arrecadação realizada pela mocidade do setor IV, para composição de seu caixa',0.00,1,'D'),(508,'3.1.1.001.009','3','3.1','3.1.1','3.1.1.001',408,'Predial - Manutenção e Conservação','','Reparos e material para conservação do imóvel e equipamentos elétricos da igreja',0.00,1,'D'),(509,'4.1.1.006','4','4.1','4.1.1','4.1.1.006',0,'DEPARTAMENTO INFANTIL','','Receitas das ofertas: nos círculos de orações de crianças, dos cultos de crianças e nos eventos voltados especificamente infantil',0.00,1,'C'),(510,'4.1.1.006.001','4','4.1','4.1.1','4.1.1.006',950,'Ofertas em Circ. de Oração - Infantil','ofertas infantil','Circulo de orações da Sede e congregações',0.00,1,'C'),(511,'4.1.1.006.002','4','4.1','4.1.1','4.1.1.006',951,'Votos em Circ. Oração - Infantil','votos infantil','Votos em Circ. Oração de crianças na Sede e congregações',0.00,1,'D'),(512,'4.1.1.006.003','4','4.1','4.1.1','4.1.1.006',952,'Ofertas Extras - Infantil','ofertas infantil','Ofertas Extras nos cultos e círculos de orações de crianças',0.00,1,'C'),(513,'4.1.1.006.004','4','4.1','4.1.1','4.1.1.006',953,'Ofertas de Cultos - Infantil','ofertas infantil','Ofertas de cultos de crianças',0.00,1,'C'),(514,'4.1.1.005.006','4','4.1','4.1.1','4.1.1.005',905,'Ofertas de Cultos - Mocidade','ofertas mocidade','Ofertas de Cultos de jovens',0.00,1,'D'),(515,'4.1.1.003.005','4','4.1','4.1.1','4.1.1.003',734,'São Vicente - Construção','campanha (São Vicente - Construção )','Campanha para ajudar na construção da nova congregação',0.00,1,'C'),(516,'3.1.1.007','3','3.1','3.1.1','3.1.1.007',0,'DEPARTAMENTO INFANTIL','','Despesas com eventos de crianças, não incluindo escola bíblica',0.00,1,'D'),(517,'3.1.1.007.001','3','3.1','3.1.1','3.1.1.007',980,'Ofertas a Pregadores','','Ofertas a Pregadores para cultos e eventos para crianças.',0.00,1,'D'),(518,'4.2.1.001.005','4','4.2','4.2.1','4.2.1.001',844,'Sobras de Vendas p/ Custear Eventos - Setor I','sobras vendas','',0.00,1,'C'),(519,'4.2.1.001.006','4','4.2','4.2.1','4.2.1.001',845,'Sobras de Vendas p/ Custear Eventos - Setor II','sobras vendas','',0.00,1,'C'),(522,'4.2.1.001.007','4','4.2','4.2.1','4.2.1.001',846,'Sobras de Vendas p/ Custear Eventos - Setor III','sobras vendas','',0.00,1,'C'),(523,'4.2.1.001.008','4','4.2','4.2.1','4.2.1.001',847,'Sobras de Vendas p/ Custear Eventos - Setor IV','sobras vendas','',0.00,1,'C'),(524,'4.2.1.001.009','4','4.2','4.2.1','4.2.1.001',848,'Sobras para Custear XVI Congresso - USADEBY ','sobras vendas','',0.00,1,'C'),(525,'3.1.6.001.006','3','3.1','3.1.6','3.1.6.001',577,'Assinaturas - Revista e Jornais','','',0.00,1,'D'),(526,'3.1.2.002.004','3','3.1','3.1.2','3.1.2.002',603,'Locação de Máquinas e Equipamentos','','Aluguel de: andaimes, betoneira, fretes para transporte de material, etc.',0.00,1,'D'),(527,'4.2.1.001.010','4','4.2','4.2.1','4.2.1.001',849,'Oferta para Congressos e Eventos','Ofertas extras','Doações e ofertas para congressos em geral',0.00,1,'C'),(528,'4.2.1.001.011','4','4.2','4.2.1','4.2.1.001',850,'Campanhas p/ Compra de Equipamentos','campanha','Contribuições de membros ou simpatizantes para aquisição de equipamentos de qualquer natureza para uso na congregação',0.00,1,'C'),(529,'2.1.1.001.099','2','2.1','2.1.1','2.1.1.001',350,'Dívidas a Pagar','Reconhecimento de dívidas a pagar','',0.00,1,'C'),(530,'3.1.6.001.007','3','3.1','3.1.6','3.1.6.001',578,'Administração Missões - Salários ','Pgto de despesas administrativas','Pgto de salário ou pró-labore da diretoria',0.00,1,'D'),(531,'3.1.6.001.008','3','3.1','3.1.6','3.1.6.001',579,'Ajuda de Custos - Missões','Pgto de despesas para ajuda de custos em eventos de missões','Pgto de despesas para ajuda de custos em eventos de missões, tipo café, translado, hotel, táxi etc',0.00,1,'D'),(532,'3.1.1.001.010','3','3.1','3.1.1','3.1.1.001',409,'Oferta à Pregadores','Auxílio para pregadores do culto','\0',0.00,1,'D'),(533,'1.2.1.001.006','1','1.2','1.2.1','1.2.1.001',165,'Instalações e Manutenção - Sede','Material para manutenção predial - Sede','',0.00,1,'D'),(534,'3.1.2.002.005','3','3.1','3.1.2','3.1.2.002',604,'Material Elétrico','','Despesas com material elétrico para manutenção, reforma e construção de Igrejas',0.00,1,'D'),(535,'3.1.1.001.011','3','3.1','3.1.1','3.1.1.001',750,'Maquinas e Equipamentos - Manutenção e Consertos','Consertos de equipamentos','Conserto de maquinas e equipamento, exceto som, tais com ventiladores, motores e outros',0.00,1,'D'),(536,'3.1.6.001.009','3','3.1','3.1.6','3.1.6.001',582,'Programas de Rádio','','',0.00,1,'D'),(537,'3.1.1.008','3','3.1','3.1.1','3.1.1.008',0,'CONSTRUÇÃO DE TEMPLOS','','Material elétrico e construção civil',0.00,1,'D'),(538,'3.1.1.008.001','3','3.1','3.1.1','3.1.1.008',1000,'Material de Construção Civil','','',0.00,1,'D'),(539,'3.1.1.008.002','3','3.1','3.1.1','3.1.1.008',1001,'Material Elétrico','','',0.00,1,'D'),(540,'3.1.1.008.003','3','3.1','3.1.1','3.1.1.008',1002,'Material Hidráulico ','','',0.00,1,'D'),(541,'3.1.1.008.004','3','3.1','3.1.1','3.1.1.008',1003,'Mão de Obra','','',0.00,1,'D'),(542,'3.1.1.008.005','3','3.1','3.1.1','3.1.1.008',1004,'Serviços','','',0.00,1,'D'),(543,'3.1.3.003','3','3.1','3.1.3','3.1.3.003',0,'MANUTENÇÃO PASTORAL','','',0.00,1,'D'),(544,'3.1.3.003.001','3','3.1','3.1.3','3.1.3.003',1010,'Oferta Administrativa','','',0.00,1,'D'),(545,'3.1.3.002.003','3','3.1','3.1.3','3.1.3.002',882,'Secretaria','','',0.00,1,'D'),(546,'3.1.3.002.004','3','3.1','3.1.3','3.1.3.002',883,'Tesouraria','','',0.00,1,'D'),(547,'3.1.3.003.002','3','3.1','3.1.3','3.1.3.003',1011,'Construção Civil','','',0.00,1,'D'),(548,'3.1.3.003.099','3','3.1','3.1.3','3.1.3.003',1012,'Outras Despesas Pastorais','','',0.00,1,'D'),(549,'3.1.3.004','3','3.1','3.1.3','3.1.3.004',0,'VOLUNTÁRIOS','','',0.00,1,'D'),(550,'3.1.3.004.001','3','3.1','3.1.3','3.1.3.004',1020,'Tesoureiros - Passagens','','',0.00,1,'D'),(551,'3.1.3.004.002','3','3.1','3.1.3','3.1.3.004',1021,'Zeladores - Ajuda de custos','','',0.00,1,'D'),(553,'3.1.1.003.006','3','3.1','3.1.1','3.1.1.003',425,'Dirigentes Circ. de Oração - Passagem','','',0.00,1,'D'),(554,'3.1.1.008.006','3','3.1','3.1.1','3.1.1.008',1005,'Aluguel e Locação de Máquinas e Equipamentos','','',0.00,1,'D'),(555,'4.2.1.001.012','4','4.2','4.2.1','4.2.1.001',851,'Oferta p/ Pgto de Ônibus','Contribuição p/ locação de ônibus','',0.00,1,'C'),(556,'3.1.1.007.002','3','3.1','3.1.1','3.1.1.007',981,'Congresso e Eventos','Despesas com festividades','Despesas com festividades dos eventos e congressos de crinças',0.00,1,'D'),(557,'3.1.6.001.010','3','3.1','3.1.6','3.1.6.001',583,'Congressos e Eventos','','Despesas com eventos, festas e congressos em geral',0.00,1,'D'),(558,'3.1.3.002.005','3','3.1','3.1.3','3.1.3.002',884,'Festas, Aniversários e Eventos','Comemoração','Festas, aniversários e eventos em geral, na Sede e congregações',0.00,1,'D');
/*!40000 ALTER TABLE `contas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credores`
--

DROP TABLE IF EXISTS `credores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `hist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `razao` (`razao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credores`
--

LOCK TABLES `credores` WRITE;
/*!40000 ALTER TABLE `credores` DISABLE KEYS */;
/*!40000 ALTER TABLE `credores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplina` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `rol` int(11) NOT NULL,
  `situacao` int(2) NOT NULL DEFAULT '2',
  `motivo` text NOT NULL,
  `data_ini` date NOT NULL,
  `data_fim` date NOT NULL,
  `cad` varchar(255) NOT NULL,
  `hist` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplina`
--

LOCK TABLES `disciplina` WRITE;
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dizimistas`
--

DROP TABLE IF EXISTS `dizimistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dizimistas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `igreja` int(5) NOT NULL,
  `cad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hist` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Cadastro de dizimistas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dizimistas`
--

LOCK TABLES `dizimistas` WRITE;
/*!40000 ALTER TABLE `dizimistas` DISABLE KEYS */;
/*!40000 ALTER TABLE `dizimistas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dizimooferta`
--

DROP TABLE IF EXISTS `dizimooferta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dizimooferta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `hist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dizimooferta`
--

LOCK TABLES `dizimooferta` WRITE;
/*!40000 ALTER TABLE `dizimooferta` DISABLE KEYS */;
/*!40000 ALTER TABLE `dizimooferta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eclesiastico`
--

DROP TABLE IF EXISTS `eclesiastico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eclesiastico` (
  `rol` int(11) NOT NULL,
  `congregacao` varchar(100) NOT NULL,
  `batismo_em_aguas` date NOT NULL,
  `local_batismo` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `batismo_espirito_santo` year(4) NOT NULL,
  `dt_mudanca_denominacao` date NOT NULL,
  `veio_qual_denominacao` varchar(100) NOT NULL,
  `auxiliar` date NOT NULL,
  `diaconato` date NOT NULL,
  `presbitero` date NOT NULL,
  `evangelista` date NOT NULL,
  `pastor` date NOT NULL,
  `veio_outra_assemb_deus` varchar(3) NOT NULL,
  `dt_muda_assembleia` date NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `dat_aclam` date NOT NULL,
  `c_impresso` date NOT NULL,
  `quem_imprimiu` int(11) NOT NULL,
  `c_entregue` date NOT NULL,
  `quem_recebeu` int(11) NOT NULL,
  `quem_entregou` int(11) NOT NULL,
  `rec_entrega` int(11) NOT NULL,
  `situacao_espiritual` int(1) NOT NULL,
  `envelope` varchar(500) NOT NULL,
  `hist` varchar(255) NOT NULL,
  `dt_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obs` text NOT NULL,
  PRIMARY KEY (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eclesiastico`
--

LOCK TABLES `eclesiastico` WRITE;
/*!40000 ALTER TABLE `eclesiastico` DISABLE KEYS */;
/*!40000 ALTER TABLE `eclesiastico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `est_civil`
--

DROP TABLE IF EXISTS `est_civil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `est_civil` (
  `rol` int(11) NOT NULL,
  `estado_civil` varchar(50) NOT NULL,
  `conjugue` varchar(200) NOT NULL,
  `rol_conjugue` int(11) NOT NULL,
  `certidao_casamento_n` varchar(100) NOT NULL,
  `livro` varchar(100) NOT NULL,
  `obs` varchar(250) NOT NULL,
  `folhas` varchar(15) NOT NULL,
  `data` date NOT NULL,
  `hist` varchar(150) NOT NULL,
  `dt_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `est_civil`
--

LOCK TABLES `est_civil` WRITE;
/*!40000 ALTER TABLE `est_civil` DISABLE KEYS */;
/*!40000 ALTER TABLE `est_civil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `iduf` char(2) NOT NULL,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`iduf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES ('AC','Acre'),('AL','Alagoas'),('AM','Amazonas'),('AP','Amapá'),('BA','Bahia'),('CE','Ceará'),('DF','Distrito Federal'),('ES','Espírito Santo'),('GO','Goiás'),('MA','Maranhão'),('MG','Minas Gerais'),('MS','Mato Grosso do Sul'),('MT','Mato Groso'),('PA','Pará'),('PB','Paraíba'),('PE','Pernambuco'),('PI','Piauí'),('PR','Paraná'),('RJ','Rio de Janeiro'),('RN','Rio Grande do Norte'),('RO','Rondônia'),('RR','Roraima'),('RS','Rio Grande do Sul'),('SC','Santa Catarina'),('SE','Sergipe'),('SP','São Paulo'),('TO','Tocantins');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fatura`
--

DROP TABLE IF EXISTS `fatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `rol` int(11) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(50) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `igreja` int(11) NOT NULL COMMENT 'Destinado a congreção indicada',
  `datainicio` date NOT NULL,
  `tipo` int(11) NOT NULL COMMENT '1-Folha pgto, 2-Administrativo, 3-Eclesiástico, 4-Tesoureiro(passes), 5-Limpeza, 6-Social',
  `frequencia` int(11) NOT NULL COMMENT '1-Todos os Menses, 2-Mensal c/ quantidade, 3-Quinzenal, 4-Semanal',
  `hist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fatura`
--

LOCK TABLES `fatura` WRITE;
/*!40000 ALTER TABLE `fatura` DISABLE KEYS */;
/*!40000 ALTER TABLE `fatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folha`
--

DROP TABLE IF EXISTS `folha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `folha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idorganica` int(11) NOT NULL,
  `igreja` int(11) NOT NULL,
  `rol` int(11) NOT NULL,
  `naomembro` varchar(255) NOT NULL,
  `ultgera` date NOT NULL COMMENT 'Data que foi gerado oultimo recibo',
  `idant` int(11) NOT NULL COMMENT 'id desta tabela de quem tinha esta função',
  `idpos` int(11) NOT NULL COMMENT 'id desta tabela de quem assumiu após este',
  `valor` decimal(10,2) NOT NULL,
  `tipo` int(1) NOT NULL DEFAULT '5' COMMENT '1-Remuneração, 2-Auxilio, 3-Oferta Administrativa, 4-Oferta Ministerial, 5-Oferta passagem, 6-Oferta Zeladores',
  `diapgto` int(1) NOT NULL DEFAULT '1',
  `inicio` date NOT NULL DEFAULT '2011-09-28' COMMENT 'Data início de quando assumiu esta atividade',
  `final` date NOT NULL COMMENT 'Data início de quando foi afastado desta atividade',
  `apresentado` date NOT NULL COMMENT 'Se foi apresentado a igreja, coloque a data aqui, caso contrário será apontado o início',
  `pastor` varchar(150) NOT NULL DEFAULT 'Pr. Antônio Ferreira da Siva' COMMENT 'Pastor da igreja na época em que assumiu esta função e que tenha sido nomeado por ele',
  `cad` varchar(255) NOT NULL DEFAULT '645.822.304-82',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='fonções e cargos na igreja';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folha`
--

LOCK TABLES `folha` WRITE;
/*!40000 ALTER TABLE `folha` DISABLE KEYS */;
/*!40000 ALTER TABLE `folha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fontes`
--

DROP TABLE IF EXISTS `fontes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fontes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discriminar` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fontes`
--

LOCK TABLES `fontes` WRITE;
/*!40000 ALTER TABLE `fontes` DISABLE KEYS */;
INSERT INTO `fontes` VALUES (1,'Dízimos e Ofertas','2011-01-18 19:44:50',''),(2,'Missões - Ofertas','2011-01-18 21:58:10',''),(3,'Usadeby - Circulo de oração','2011-01-18 21:58:28',''),(4,'Departamento de Ensino','2011-01-18 19:46:15',''),(5,'UMADEBY - União da Mocidade','2014-03-05 00:41:01',''),(6,'Departamento de Música','2014-03-07 23:21:59','Joseilton'),(7,'Administrativo','2014-03-07 23:28:30','Joseilton');
/*!40000 ALTER TABLE `fontes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj_cpf` varchar(18) NOT NULL,
  `razao` varchar(255) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `telefone` varchar(12) NOT NULL,
  `celular` varchar(12) NOT NULL,
  `fax` varchar(12) NOT NULL,
  `end` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` int(11) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `responsavel` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `fornece` varchar(255) NOT NULL COMMENT 'Que produto fornece',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `razao` (`razao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcao`
--

DROP TABLE IF EXISTS `funcao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcao` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  `tipo` int(1) NOT NULL DEFAULT '1' COMMENT '0-Auxílio,1-Cargo',
  `hist` varchar(255) NOT NULL,
  `cad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcao`
--

LOCK TABLES `funcao` WRITE;
/*!40000 ALTER TABLE `funcao` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `igreja`
--

DROP TABLE IF EXISTS `igreja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `igreja` (
  `rol` int(5) NOT NULL AUTO_INCREMENT,
  `razao` varchar(150) NOT NULL,
  `setor` int(11) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `site` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `ceia` int(2) NOT NULL COMMENT 'Dia da Santa Ceia. 1º dígito ref. semana do mês. 2º dígito ref. dia da semana. Domingo como 1º dia',
  `oracao` int(1) NOT NULL COMMENT 'Dia da semena do circulo de oração. Domingo como 1º dia da semana',
  `cultos` varchar(15) NOT NULL,
  `pastor` varchar(150) NOT NULL COMMENT 'Nome completo do Pastor ou dirigente da Igreja',
  `secretario1` int(11) NOT NULL COMMENT 'Rol do membro',
  `secretario2` int(11) NOT NULL COMMENT 'Rol do membro',
  `matlimpeza` binary(1) NOT NULL DEFAULT '1' COMMENT '1 - Entregue na congregação, 0 - Adquirir em mercado autorizado',
  `rua` varchar(200) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(200) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `fone` varchar(9) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0 - Destivada, 1 - Ativada',
  `registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hist` varchar(150) NOT NULL COMMENT 'log do cadastrador',
  PRIMARY KEY (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `igreja`
--

LOCK TABLES `igreja` WRITE;
/*!40000 ALTER TABLE `igreja` DISABLE KEYS */;
/*!40000 ALTER TABLE `igreja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lanc`
--

DROP TABLE IF EXISTS `lanc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lanc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lancamento` int(11) NOT NULL,
  `debitar` int(11) NOT NULL COMMENT 'id da tabelas contas - debitada',
  `creditar` int(11) NOT NULL COMMENT 'id da tabelas contas -  Creditada',
  `valor` decimal(12,2) NOT NULL,
  `igreja` int(11) NOT NULL COMMENT 'Informar para qual igreja',
  `data` date NOT NULL,
  `hist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Dados dos lançamentos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lanc`
--

LOCK TABLES `lanc` WRITE;
/*!40000 ALTER TABLE `lanc` DISABLE KEYS */;
/*!40000 ALTER TABLE `lanc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lancamento`
--

DROP TABLE IF EXISTS `lancamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lancamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lancamento` int(11) NOT NULL,
  `conta` int(11) NOT NULL,
  `d_c` varchar(1) NOT NULL COMMENT 'D - Debitado, C - Creditado',
  `valor` decimal(12,2) NOT NULL,
  `igreja` int(11) NOT NULL COMMENT 'Informar para qual igreja',
  `dizconven` bit(1) NOT NULL DEFAULT b'1' COMMENT 'Se o credito não incidir no dizimo da convenção o valor deve ser zero',
  `data` date NOT NULL,
  `hist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamento`
--

LOCK TABLES `lancamento` WRITE;
/*!40000 ALTER TABLE `lancamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `lancamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lanchist`
--

DROP TABLE IF EXISTS `lanchist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lanchist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idlanca` int(11) NOT NULL COMMENT 'id da tabela lançamento',
  `referente` varchar(300) NOT NULL,
  `igreja` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Texto detalhando o motivo do lançamento, a que se refere';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lanchist`
--

LOCK TABLES `lanchist` WRITE;
/*!40000 ALTER TABLE `lanchist` DISABLE KEYS */;
/*!40000 ALTER TABLE `lanchist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `limpeza`
--

DROP TABLE IF EXISTS `limpeza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `limpeza` (
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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 COMMENT='Lista de material de limpeza disponível para entrega';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `limpeza`
--

LOCK TABLES `limpeza` WRITE;
/*!40000 ALTER TABLE `limpeza` DISABLE KEYS */;
INSERT INTO `limpeza` VALUES (1,'Água sanitária','litros',2,2,0,15,7,5,0,0,'','2013-01-29 06:18:19','Joseilton'),(2,'Balde 5 litros','Unid',1,4,0,0,0,0,0,0,'','2013-01-29 06:18:19','Joseilton'),(3,'Balde grande','unid',1,4,0,0,0,0,0,0,'','2013-01-30 07:08:38','Joseilton'),(5,'Cera liquida incolor','litros',5,2,0,0,0,0,0,0,'','2013-01-30 07:27:44','Joseilton'),(6,'Cera incolor','unid',1,2,0,0,0,0,0,0,'','2013-01-30 07:27:44','Joseilton'),(7,'Cesto de lixo','unid',1,2,0,0,0,0,0,0,'','2013-01-29 09:00:00','Joseilton'),(8,'Cesto de lixo grande','unid',1,2,0,0,0,0,0,0,'','2013-01-29 09:00:00','Joseilton'),(9,'Cloro','litros',5,2,0,3,1,1,0,0,'','2013-01-30 07:31:06','Joseilton'),(10,'Desinfetante','litros',5,2,0,5,3,2,0,0,'','2013-01-29 09:00:00','Joseilton'),(11,'Destac p/ piso','unid',1,2,0,5,3,1,0,0,'','2013-01-30 07:32:10','Joseilton'),(12,'Detergente','Militros',200,2,0,1,1,1,0,0,'','2013-01-30 07:32:10','Joseilton'),(13,'Espanador','unid',1,3,0,0,0,0,0,0,'','2013-01-30 07:32:42','Joseilton'),(14,'Esponja','unid',1,2,0,5,4,2,0,0,'','2013-01-30 07:32:42','Joseilton'),(15,'Flanela','unid',1,2,0,5,3,2,0,0,'','2013-01-30 07:33:16','Joseilton'),(16,'Limpa vidro - refil','ml',500,2,0,4,2,0,0,0,'','2013-01-30 07:33:16',''),(17,'Lustra móveis','ml',200,2,0,10,4,2,0,0,'','2013-01-30 07:34:34','Joseilton'),(18,'Luva emborrachada','par',1,2,0,2,1,1,0,0,'','2013-01-30 07:34:34','Joseilton'),(19,'Mangueira','m',25,12,0,0,0,0,0,0,'','2013-01-30 07:35:50','Joseilton'),(20,'Óleo de peroba','unid',1,2,0,0,0,0,0,0,'','2013-01-30 07:35:50','Joseilton'),(21,'Pá','unid',1,6,0,0,0,0,0,0,'','2013-01-30 07:36:33','Joseilton'),(22,'Palha de aço','pc',1,2,0,2,1,1,0,0,'','2013-01-30 07:36:33','Joseilton'),(23,'Pano de chão','unid',1,6,0,5,3,2,0,0,'','2013-01-30 07:37:05','Joseilton'),(24,'Pano de prato','unid',1,6,0,4,3,1,0,0,'','2013-01-30 07:37:05','Joseilton'),(25,'Papel higiênico','pc c/ 4 unid',1,2,0,25,14,10,0,0,'','2013-01-30 07:37:46','Joseilton'),(26,'Pastilha para banheiro','unid',1,2,0,25,17,10,0,0,'','2013-01-30 07:37:46','Joseilton'),(27,'Limpeza Pesada','Litro',1,2,0,16,6,3,0,0,'','2013-01-30 07:38:22','Joseilton'),(28,'Querosene','ml',200,2,0,0,0,0,0,0,'','2013-01-30 07:38:22','Joseilton'),(29,'Rodo','unid',1,6,0,0,0,0,0,0,'','2013-01-30 07:38:55','Joseilton'),(30,'Sabão de coco','unid',1,2,0,0,1,1,0,0,'','2013-01-30 07:38:55','Joseilton'),(31,'Sabão de pedra','unid',1,2,0,2,2,1,0,0,'','2013-01-30 07:39:22','Joseilton'),(32,'Sabão em pó Ala ou Bem-te-vi','g',500,2,0,25,15,8,0,0,'','2013-01-30 07:39:22','Joseilton'),(33,'Sabão líquido','Litro',1,2,0,1,0,0,0,0,'','2013-01-30 07:40:26','Joseilton'),(34,'Sabonete','g',90,2,0,0,2,1,0,0,'','2013-01-30 07:40:26','Joseilton'),(35,'Saco de lixo - 100 litros','pc c/ 5 unid',1,2,0,10,4,2,0,0,'','2013-01-30 07:41:49','Joseilton'),(36,'Saco de lixo - 30 litros','pc c/ 5 unid',1,2,0,0,0,0,0,0,'','2013-01-30 07:41:49','Joseilton'),(37,'Saco de lixo - 60 litros','pc c/ 5 unid',1,2,0,0,0,0,0,0,'','2013-01-30 07:42:24','Joseilton'),(39,'Tapete de porta','unid',1,6,0,0,0,0,0,0,'','2013-01-30 07:43:32','Joseilton'),(40,'Toalha de mão','unid',1,6,0,4,2,2,0,0,'','2013-01-30 07:44:03','Joseilton'),(41,'Vaselina líquida','ml',200,6,0,0,0,0,0,0,'','2013-01-30 07:44:03','Joseilton'),(42,'Vassoura de nylon','unid',1,4,0,0,0,0,0,0,'','2013-01-30 07:44:32','Joseilton'),(43,'Vassoura de pelo','unid',1,4,0,0,0,0,0,0,'','2013-01-30 07:44:58','Joseilton'),(44,'Vassoura de talo','unid',1,4,0,0,0,0,0,0,'','2013-01-30 07:44:58','Joseilton'),(45,'Vassoura p/ vaso sanitário','unid',1,6,0,0,0,0,0,0,'','2013-01-30 07:45:21','Joseilton'),(46,'Vassourão','unid',1,6,0,0,0,0,0,0,'','2013-01-30 07:45:21','Joseilton'),(47,'Veja multiuso','ml',200,2,0,5,2,2,0,0,'','2013-01-30 07:45:47','Joseilton'),(48,'Veneno p/ inseto – aerosol','unid',1,4,0,3,1,1,0,0,'','2013-01-30 07:46:10','Joseilton'),(49,'Lixeira p/ Banheiro','litros',5,6,0,0,0,0,0,0,'','2013-05-16 02:05:56','Joseilton'),(50,'Detergente limpa alumínio','litro',1,2,0,1,1,1,0,0,'','2013-05-16 02:10:11','Joseilton'),(51,'Saco de Lixo - 15 litros','unid/pc',5,2,0,10,5,3,0,0,'','2013-05-28 03:36:32','Joseilton'),(52,'Limpa vidro com gatilho','ml',500,2,0,1,1,1,0,0,'','2013-08-14 00:45:52','Joseilton'),(53,'Adesivo sanitário','Unid',1,2,0,0,0,0,0,0,'','2014-11-12 03:05:37','Joseilton'),(55,'Agua sanitária de 1litro','litros',1,2,0,0,0,0,0,0,'','2015-08-20 01:43:59','Joseilton'),(56,'Espanador de teto','Unid',1,2,0,0,0,0,0,0,'','2016-01-26 22:14:53','Joseilton'),(57,'Tapete frete de Igreja','unid',1,12,0,0,0,0,0,0,'','2016-01-26 22:17:33','Joseilton'),(58,'Lixeira média','Unid',1,3,0,0,0,0,0,0,'','2016-01-26 22:20:47','Joseilton');
/*!40000 ALTER TABLE `limpeza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `limpezpedid`
--

DROP TABLE IF EXISTS `limpezpedid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `limpezpedid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` int(11) NOT NULL,
  `quant` int(2) NOT NULL,
  `mesref` varchar(7) NOT NULL COMMENT 'Mes de referência (01/2013)',
  `cad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `igreja` int(11) NOT NULL,
  `entrega` binary(1) NOT NULL DEFAULT '1' COMMENT '1 - Entregue na congregação, 0 - Adquirir em mercado autorizado',
  `hist` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `limpezpedid`
--

LOCK TABLES `limpezpedid` WRITE;
/*!40000 ALTER TABLE `limpezpedid` DISABLE KEYS */;
/*!40000 ALTER TABLE `limpezpedid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `nome` varchar(20) NOT NULL,
  `tempo` varchar(20) NOT NULL,
  `status` int(1) NOT NULL COMMENT 'Vazio - Online, 1- Ausente, 2-desconectado, 3-Não pertube',
  PRIMARY KEY (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membro`
--

DROP TABLE IF EXISTS `membro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membro` (
  `rol` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `nacionalidade` varchar(100) NOT NULL,
  `naturalidade` varchar(150) NOT NULL,
  `uf_nasc` varchar(2) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `complemento` varchar(150) NOT NULL,
  `cep` varchar(15) NOT NULL,
  `bairro` varchar(150) NOT NULL,
  `cidade` varchar(150) NOT NULL,
  `uf_resid` varchar(4) NOT NULL,
  `escolaridade` varchar(30) NOT NULL,
  `graduacao` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `fone_resid` varchar(50) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `datanasc` date NOT NULL,
  `obs` text NOT NULL,
  `doador` varchar(4) NOT NULL,
  `sangue` varchar(5) NOT NULL,
  `mae` varchar(200) NOT NULL,
  `rol_mae` int(11) NOT NULL,
  `pai` varchar(200) NOT NULL,
  `rol_pai` int(11) NOT NULL,
  `dt_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hist` varchar(200) NOT NULL,
  PRIMARY KEY (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membro`
--

LOCK TABLES `membro` WRITE;
/*!40000 ALTER TABLE `membro` DISABLE KEYS */;
/*!40000 ALTER TABLE `membro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel`
--

DROP TABLE IF EXISTS `nivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivel` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nivel` int(2) NOT NULL,
  `Descricao` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel`
--

LOCK TABLES `nivel` WRITE;
/*!40000 ALTER TABLE `nivel` DISABLE KEYS */;
INSERT INTO `nivel` VALUES (1,6,'Cadastrar usuario'),(2,5,'Pode consultar dados pessoais');
/*!40000 ALTER TABLE `nivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia`
--

DROP TABLE IF EXISTS `noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `noticia` text NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(200) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia`
--

LOCK TABLES `noticia` WRITE;
/*!40000 ALTER TABLE `noticia` DISABLE KEYS */;
INSERT INTO `noticia` VALUES (1,'O mundo da natureza.\r\nO mundo do Homem.\r\nO mundo de Deus:\r\nTodos eles se encaixam.','O mundo!','Johanes Kepler','2008-04-04 19:42:04'),(2,'Ao contrário da noção popular de que o criacionismo se apóia no sobrenatural, o evolucionismo deve também apoiar-se, desde que as probabilidades da formação da vida ao acaso são tão pequenas, que exigem um \'milagre\' de geração espontânea equivalente a um argumento teológico.','Como tudo Começou!','Dr. Norman L. Geisler em Creator in the Classroom - 1981','2008-04-04 19:42:29'),(3,'&quot;Se o sistema solar veio a existir devido a uma colis&atilde;o acidental, ent&atilde;o, o aparecimento da vida org&acirc;nica neste planeta tamb&eacute;m foi acidental, e toda evolu&ccedil;&atilde;o do homem foi acidental tamb&eacute;m. Se este &eacute; o caso, todos os nossos pensamentos presentes s&atilde;o meros acidentes - acidentes criados pelo movimento dos &aacute;tomos. E isto &eacute; v&aacute;lido para qualquer pessoa. Mas, se os seus pensamentos - isto &eacute;, dos materialistas e dos astronomos - s&atilde;o meramente produtos acidentais, por que deveriamos crer que eles s&atilde;o verdadeiros? Eu n&atilde;o creio que um acidente possa dar a explica&ccedil;&atilde;o correta do porqu&ecirc; de todos os outros acidentes&quot;.','Tudo veio de um acidente ?','C.S. Lewis - Escritor irland&ecirc;s','2008-05-08 17:22:04'),(4,'N&atilde;o dever&iacute;amos come&ccedil;ar com o mais &oacute;bvio fato da exist&ecirc;ncia - de que, seja l&aacute; quem for o respons&aacute;vel, ele &eacute; um ardente e incompar&aacute;vel artista diante de quem qualquer feito ou criatividade humana mingua como se fosse um rabisco de crian&ccedil;a?','A Exist&ecirc;ncia','Philip Yancey','2008-10-30 14:06:14');
/*!40000 ALTER TABLE `noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nv_convert`
--

DROP TABLE IF EXISTS `nv_convert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nv_convert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `numero` int(6) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `nacionalidade` varchar(255) NOT NULL,
  `fone` varchar(12) NOT NULL,
  `celular` varchar(12) NOT NULL,
  `dt_nasc` date NOT NULL,
  `congregacao` int(2) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `dt_aceitou` date NOT NULL,
  `obs` text NOT NULL,
  `hist` varchar(255) NOT NULL,
  `dt_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nv_convert`
--

LOCK TABLES `nv_convert` WRITE;
/*!40000 ALTER TABLE `nv_convert` DISABLE KEYS */;
/*!40000 ALTER TABLE `nv_convert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organica`
--

DROP TABLE IF EXISTS `organica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hier` int(11) NOT NULL COMMENT 'Hierarquia de cada grupo-função, 0 como nível mais alto',
  `codigo` varchar(13) NOT NULL,
  `conta` int(11) NOT NULL,
  `alias` varchar(50) NOT NULL COMMENT 'Nome para exibição',
  `cargo1` varchar(150) NOT NULL,
  `cargo2` varchar(150) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `cad` varchar(150) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organica`
--

LOCK TABLES `organica` WRITE;
/*!40000 ALTER TABLE `organica` DISABLE KEYS */;
/*!40000 ALTER TABLE `organica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profissional`
--

DROP TABLE IF EXISTS `profissional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profissional` (
  `rol` int(11) NOT NULL,
  `profissao` varchar(150) NOT NULL,
  `obs` varchar(250) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `orgao_expedidor` varchar(150) NOT NULL,
  `onde_trabalha` varchar(200) NOT NULL,
  `hist` varchar(255) NOT NULL,
  `dt_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profissional`
--

LOCK TABLES `profissional` WRITE;
/*!40000 ALTER TABLE `profissional` DISABLE KEYS */;
/*!40000 ALTER TABLE `profissional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recibos`
--

DROP TABLE IF EXISTS `recibos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recibos` (
  `rol` int(20) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  `rol_entregue` varchar(255) NOT NULL COMMENT 'o rol separado por vígula dos cartões entregues',
  `rol_recebeu` int(11) NOT NULL,
  `cpf_entregou` varchar(14) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `obs` varchar(255) NOT NULL,
  PRIMARY KEY (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Será registrado a entrega de todos os recibos nesta tabela';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recibos`
--

LOCK TABLES `recibos` WRITE;
/*!40000 ALTER TABLE `recibos` DISABLE KEYS */;
/*!40000 ALTER TABLE `recibos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tes_recibo`
--

DROP TABLE IF EXISTS `tes_recibo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tes_recibo` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `igreja` int(11) NOT NULL,
  `tipo` int(1) NOT NULL,
  `recebeu` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `conta` varchar(30) NOT NULL COMMENT 'id da tabela contas',
  `fonte` int(2) NOT NULL COMMENT 'Indica a fonte do recurso a que se refere esta saída',
  `lancamento` int(11) NOT NULL,
  `motivo` varchar(300) NOT NULL,
  `data` date NOT NULL,
  `hist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Será registrado a entrega de todos os recibos nesta tabela';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tes_recibo`
--

LOCK TABLES `tes_recibo` WRITE;
/*!40000 ALTER TABLE `tes_recibo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tes_recibo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transcheck`
--

DROP TABLE IF EXISTS `transcheck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transcheck` (
  `transid` text,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transcheck`
--

LOCK TABLES `transcheck` WRITE;
/*!40000 ALTER TABLE `transcheck` DISABLE KEYS */;
/*!40000 ALTER TABLE `transcheck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `nivel` int(2) NOT NULL DEFAULT '0',
  `setor` int(2) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL DEFAULT '379dba6199d9986e77b272c75adee08f',
  `situacao` int(1) NOT NULL DEFAULT '1' COMMENT '0 - inativo; 1-ativo',
  `historico` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Administrador','111.111.111.11',20,99,'Desenvolvedor do Sistema','202cb962ac59075b964b07152d234b70',1,'','2016-03-02 11:09:42');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-02  8:12:01
