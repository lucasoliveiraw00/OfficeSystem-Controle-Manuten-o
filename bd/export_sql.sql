-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Jul-2019 às 03:36
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `office`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aux_os_servico`
--

CREATE TABLE `aux_os_servico` (
  `id` int(11) NOT NULL,
  `id_ordem_de_servico` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `situacao` enum('Ativo','Inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cpfcnpj` varchar(20) NOT NULL,
  `dataNasc` date NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(23) DEFAULT NULL,
  `celular` varchar(23) NOT NULL,
  `cep` varchar(15) NOT NULL,
  `cidade` varchar(150) NOT NULL,
  `uf` varchar(10) DEFAULT NULL,
  `bairro` varchar(150) NOT NULL,
  `rua` varchar(150) NOT NULL,
  `numEnd` varchar(150) NOT NULL,
  `situacao` enum('Ativo','Inativo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `cpfcnpj`, `dataNasc`, `email`, `telefone`, `celular`, `cep`, `cidade`, `uf`, `bairro`, `rua`, `numEnd`, `situacao`) VALUES
(1, 'Carlos Diego', '706.996.690-30', '2018-11-07', 'carlos@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(2, 'Miguel Carlos', '173.443.020-63', '2018-11-07', 'miguel@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(3, 'Carlos Rodrigo', '105.747.820-28', '2018-11-07', 'carlos.rodrigo@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(4, 'Aluga Car', '95.105.178/0001-03', '2018-11-07', 'alugacar@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(5, 'Rodrigo Junior', '347.879.090-53', '2018-11-07', 'rodrigo@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(6, 'Joel Oliveira', '173.443.020-63', '2018-11-07', 'joel@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(7, 'Anderson Silva', '173.443.020-63', '2018-11-07', 'anderson@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(8, 'Adriano Fagundes', '410.056.100-88', '2018-11-07', 'adriano@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(9, 'Tecila Junior', '722.364.010-35', '2018-11-07', 'tecila@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(10, 'Disk Car', '97.178.106/0001-11', '2018-11-07', 'diskCar@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(11, 'Lugar Car', '88.177.134/0001-23', '2018-11-07', 'lugarcar@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(12, 'Mendonça Junior', '014.142.260-20', '2018-11-07', 'mendonca@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(13, 'Armando Carlos', '990.188.130-79', '2018-11-07', 'armando@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(14, 'Danilo Silva', '960.635.220-00', '2018-11-07', 'danilo@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo'),
(15, 'Antonio Guedes', '173.443.020-63', '2018-11-07', 'antonio@gmail.com', '4436846579', '44998842512', '87502-080', 'Umuarama', 'PR', 'Zona III', 'Avenida Maringá', '4544', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaborador`
--

CREATE TABLE `colaborador` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `telefone` varchar(23) DEFAULT NULL,
  `celular` varchar(23) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `situacao` enum('Ativo','Inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `colaborador`
--

INSERT INTO `colaborador` (`id`, `id_usuario`, `nome`, `telefone`, `celular`, `ativo`, `situacao`) VALUES
(1, 1, 'admin', '(36) 8698-7555', '(44) 99758-2627', 'Sim', 'Ativo'),
(2, 2, 'Rodrigo', '', '(45) 6944-99758', 'Não', 'Ativo'),
(3, 3, 'Diego', '(44) 3685-4430', '(44) 99858-8869', 'Não', 'Ativo'),
(4, 4, 'Rogerio', '(44) 3685-1125', '(44) 99788-4899', 'Sim', 'Ativo'),
(5, 5, 'Carlos', '(44) 3658-7842', '(67) 99785-9858', 'Sim', 'Ativo'),
(6, 6, 'Mateus', '', '(44) 4464-46464', 'Sim', 'Ativo'),
(7, 7, 'Igor', '', '(44) 99758-5869', 'Sim', 'Ativo'),
(8, 8, 'Maicon', '(44) 3659-6021', '(44) 99852-2145', 'Sim', 'Ativo'),
(9, 9, 'Jonathan', '(44) 3685-1255', '(44) 99788-4899', 'Sim', 'Ativo'),
(10, 10, 'Tarcisio', '(44) 3622-2242', '(44) 99758-9858', 'Sim', 'Ativo'),
(11, 11, 'Josefe', '', '(44) 99764-46464', 'Sim', 'Ativo'),
(12, 12, 'Valmir', '', '(44) 99758-5869', 'Sim', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `componente`
--

CREATE TABLE `componente` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `situacao` enum('Ativo','Inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `componente`
--

INSERT INTO `componente` (`id`, `codigo`, `descricao`, `situacao`) VALUES
(1, 100, 'Motor', 'Ativo'),
(2, 200, 'Sist. Arrefecimento', 'Ativo'),
(3, 300, 'Sist. Direção', 'Ativo'),
(4, 400, 'Sistema Alimentação', 'Ativo'),
(5, 500, 'Embreagem', 'Ativo'),
(6, 600, 'Câmbio', 'Ativo'),
(7, 700, 'Transmissão', 'Ativo'),
(8, 800, 'Suspensão', 'Ativo'),
(9, 900, 'Sist. de Freio', 'Ativo'),
(10, 1000, 'Dif. Dianteiro', 'Ativo'),
(11, 1100, 'Dif. Traseiro', 'Ativo'),
(12, 1200, 'Cubo de Roda', 'Ativo'),
(13, 1300, 'Eixo Tandem', 'Ativo'),
(14, 1400, 'Sist. Eletrico', 'Ativo'),
(15, 1500, 'Funilaria', 'Ativo'),
(16, 1600, 'Sist. Hidràulico', 'Ativo'),
(17, 1700, 'Chassi', 'Ativo'),
(18, 1800, 'Carrroceria', 'Ativo'),
(19, 1900, 'Rodante', 'Ativo'),
(20, 2000, 'Cardan', 'Ativo'),
(21, 2100, 'Caixa de Controle', 'Ativo'),
(22, 2200, 'Caixa de Compensação', 'Ativo'),
(23, 2300, 'Ar Condicionado', 'Ativo'),
(24, 2400, 'Comp. Mola Tensora', 'Ativo'),
(25, 2500, 'Eixo Pivô', 'Ativo'),
(26, 2600, 'Admissão de Ar', 'Ativo'),
(27, 2700, 'Eixo Dianteiro', 'Ativo'),
(28, 2800, 'Geral', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `id_comp` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `situacao` enum('Ativo','Inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`id`, `id_comp`, `codigo`, `descricao`, `situacao`) VALUES
(1, 1, 101, 'Cabeçote', 'Ativo'),
(2, 1, 102, 'Bomba de Óleo', 'Ativo'),
(3, 1, 103, 'Freio Motor', 'Ativo'),
(4, 1, 104, 'Mangueira/Tubulações', 'Ativo'),
(5, 1, 105, 'Volante', 'Ativo'),
(6, 1, 106, 'Junta', 'Ativo'),
(7, 1, 107, 'Retentor', 'Ativo'),
(8, 1, 108, 'Trocador de Calor', 'Ativo'),
(9, 1, 109, 'Tubagem', 'Ativo'),
(10, 1, 110, 'Correia', 'Ativo'),
(11, 1, 111, 'Coxim', 'Ativo'),
(12, 1, 112, 'Caixa Seca', 'Ativo'),
(13, 1, 113, 'Polia', 'Ativo'),
(14, 1, 114, 'Turbina', 'Ativo'),
(15, 1, 115, 'Valvula', 'Ativo'),
(16, 1, 116, 'Filtro Lubrificante', 'Ativo'),
(17, 1, 117, 'Óleo', 'Ativo'),
(18, 1, 118, 'Bujão do Carte', 'Ativo'),
(19, 1, 119, 'Cabo de Afogador', 'Ativo'),
(20, 1, 120, 'Cabo de Acelerador', 'Ativo'),
(21, 1, 121, 'Filtro Bypass', 'Ativo'),
(22, 1, 122, 'Vira Brequim', 'Ativo'),
(23, 1, 123, 'Camisa', 'Ativo'),
(24, 1, 124, 'Cilindro', 'Ativo'),
(25, 1, 125, 'Pistão', 'Ativo'),
(26, 1, 126, 'Bronzina de Biela', 'Ativo'),
(27, 1, 127, 'Bronzina Mancal', 'Ativo'),
(28, 1, 128, 'Bucha de Biela', 'Ativo'),
(29, 1, 129, 'Biela', 'Ativo'),
(30, 1, 130, 'Carter', 'Ativo'),
(31, 1, 131, 'Filtro Lubrif.Secund', 'Ativo'),
(32, 1, 132, 'Bloco Motor', 'Ativo'),
(33, 1, 133, 'Comando', 'Ativo'),
(34, 1, 134, 'Engrenagem', 'Ativo'),
(35, 1, 135, 'Parafuso e Porca', 'Ativo'),
(36, 1, 136, 'Suporte do Motor LD', 'Ativo'),
(37, 1, 137, 'Suporte do Motor LE', 'Ativo'),
(38, 1, 138, 'Hélice do Motor', 'Ativo'),
(39, 1, 139, 'Radiador de Óleo', 'Ativo'),
(40, 1, 140, 'Esticador de Correi', 'Ativo'),
(41, 1, 141, 'Bucha Rolam.Volante', 'Ativo'),
(42, 1, 142, 'Rolamento', 'Ativo'),
(43, 1, 143, 'Jogo de velas', 'Ativo'),
(44, 1, 144, 'Cabo de velas', 'Ativo'),
(45, 1, 145, 'Junta tampa Válvula', 'Ativo'),
(46, 1, 146, 'Junta do Cárter', 'Ativo'),
(47, 1, 147, 'Protetor do Cárter', 'Ativo'),
(48, 1, 148, 'Gremalheira', 'Ativo'),
(49, 1, 149, 'Rol.Cubo da Hélice', 'Ativo'),
(50, 1, 150, 'Cubo da Hélice', 'Ativo'),
(51, 1, 151, 'Rol.Estic.de Correia', 'Ativo'),
(52, 1, 152, 'Suporte do motor', 'Ativo'),
(53, 1, 153, 'Correia Dentada', 'Ativo'),
(54, 1, 154, 'Motor', 'Ativo'),
(55, 1, 155, 'Compress.AR', 'Ativo'),
(56, 2, 201, 'Radiador', 'Ativo'),
(57, 2, 202, 'Bomba D´agua', 'Ativo'),
(58, 2, 203, 'Valvula Termostática', 'Ativo'),
(59, 2, 204, 'Líquido + Aditivo', 'Ativo'),
(60, 2, 205, 'Mangueira', 'Ativo'),
(61, 2, 206, 'Aditivo Prolongador', 'Ativo'),
(62, 2, 207, 'Filtro Arrefecimento', 'Ativo'),
(63, 2, 208, 'Reparo Bomda Dagua', 'Ativo'),
(64, 2, 209, 'Parafuso e Porca', 'Ativo'),
(65, 2, 210, 'Abraçadeira', 'Ativo'),
(66, 2, 211, 'Aro', 'Ativo'),
(67, 2, 212, 'Defletor', 'Ativo'),
(68, 2, 213, 'Coxim Radiador', 'Ativo'),
(69, 2, 214, 'Tanque Expansão', 'Ativo'),
(70, 2, 215, 'Anel', 'Ativo'),
(71, 2, 216, 'Arrefecimento', 'Ativo'),
(72, 3, 301, 'Barra de Direção', 'Ativo'),
(73, 3, 302, 'Terminais', 'Ativo'),
(74, 3, 303, 'Bomba', 'Ativo'),
(75, 3, 304, 'Caixa de Direção', 'Ativo'),
(76, 3, 305, 'Mangueira', 'Ativo'),
(77, 3, 306, 'Pistão', 'Ativo'),
(78, 3, 307, 'Óleo', 'Ativo'),
(79, 3, 308, 'Filtro', 'Ativo'),
(80, 3, 309, 'Parafuso e Porca', 'Ativo'),
(81, 3, 310, 'Correia', 'Ativo'),
(82, 3, 311, 'Volante', 'Ativo'),
(83, 3, 312, 'Cabo do Volante', 'Ativo'),
(84, 3, 313, 'Sistema Direção', 'Ativo'),
(85, 4, 401, 'Bomba Injetora', 'Ativo'),
(86, 4, 402, 'Bomba Alimentação', 'Ativo'),
(87, 4, 403, 'Bicos Injetores', 'Ativo'),
(88, 4, 404, 'Tanque', 'Ativo'),
(89, 4, 405, 'Canos Injetores', 'Ativo'),
(90, 4, 406, 'Carburador', 'Ativo'),
(91, 4, 407, 'Filtro Racor', 'Ativo'),
(92, 4, 408, 'Filtro Combustivel', 'Ativo'),
(93, 4, 409, 'Filtro Comb.Secundário', 'Ativo'),
(94, 4, 410, 'Parafuso e Porca', 'Ativo'),
(95, 4, 411, 'Filtro Tanque Combus', 'Ativo'),
(96, 4, 412, 'Mangueira Combustíve', 'Ativo'),
(97, 4, 413, 'Unidade Injetora', 'Ativo'),
(98, 4, 414, 'Cinta do Tanque', 'Ativo'),
(99, 4, 415, 'Camisa de Bico', 'Ativo'),
(100, 4, 416, 'Bomba Manual', 'Ativo'),
(101, 4, 417, 'Bóia do Tanque', 'Ativo'),
(102, 4, 418, 'Válvula Retenção', 'Ativo'),
(103, 4, 419, 'Luva Unidade Injetor', 'Ativo'),
(104, 4, 420, 'Tampa do Tanque', 'Ativo'),
(105, 4, 421, 'Reserv.Adit.Arla 32', 'Ativo'),
(106, 4, 422, 'Alimentação', 'Ativo'),
(107, 4, 423, 'Cabo do Afogador', 'Ativo'),
(108, 5, 501, 'Cabo Embreagem', 'Ativo'),
(109, 5, 502, 'Rolamento', 'Ativo'),
(110, 5, 503, 'Plato', 'Ativo'),
(111, 5, 504, 'Disco', 'Ativo'),
(112, 5, 505, 'Servo de Embreagem', 'Ativo'),
(113, 5, 506, 'Parafuso', 'Ativo'),
(114, 5, 507, 'Disco Interno', 'Ativo'),
(115, 5, 508, 'Disco Externo', 'Ativo'),
(116, 5, 509, 'Placa Intermediaria', 'Ativo'),
(117, 5, 510, 'Garfo', 'Ativo'),
(118, 5, 511, 'Rolete do Garfo', 'Ativo'),
(119, 5, 512, 'Guia do Rolamento', 'Ativo'),
(120, 5, 513, 'Bucha Guia Rolamento', 'Ativo'),
(121, 5, 514, 'Mola', 'Ativo'),
(122, 5, 515, 'Óleo / Fluído', 'Ativo'),
(123, 5, 516, 'Porcas', 'Ativo'),
(124, 5, 517, 'Paraf.de Regulagem', 'Ativo'),
(125, 5, 518, 'Pinos', 'Ativo'),
(126, 5, 519, 'Travas', 'Ativo'),
(127, 5, 521, 'Luva de Acionamento', 'Ativo'),
(128, 5, 522, 'Eixo de Acionamento', 'Ativo'),
(129, 5, 523, 'Espaçador', 'Ativo'),
(130, 5, 524, 'Bucha estriada', 'Ativo'),
(131, 5, 525, 'Eixo da TDP', 'Ativo'),
(132, 5, 526, 'Retentor', 'Ativo'),
(133, 5, 527, 'Tubo Fluido', 'Ativo'),
(134, 5, 528, 'Abraçadeira', 'Ativo'),
(135, 5, 529, 'Alavanca', 'Ativo'),
(136, 5, 530, 'Mola Membrana', 'Ativo'),
(137, 5, 531, 'Pedal', 'Ativo'),
(138, 5, 533, 'Cilindro mestre', 'Ativo'),
(139, 5, 534, 'Reservat.p/ fluído', 'Ativo'),
(140, 5, 535, 'Varão', 'Ativo'),
(141, 5, 536, 'Pedal da Embreagem', 'Ativo'),
(142, 5, 537, 'Embreagem', 'Ativo'),
(143, 6, 601, 'Trambulador', 'Ativo'),
(144, 6, 602, 'Transferência', 'Ativo'),
(145, 6, 603, 'Junta', 'Ativo'),
(146, 6, 604, 'Retentor', 'Ativo'),
(147, 6, 605, 'Óleo', 'Ativo'),
(148, 6, 606, 'Filtro', 'Ativo'),
(149, 6, 607, 'Alavanca', 'Ativo'),
(150, 6, 608, 'Engrenagem', 'Ativo'),
(151, 6, 609, 'Sincronizador', 'Ativo'),
(152, 6, 610, 'Rolamento', 'Ativo'),
(153, 6, 611, 'Eixo Principal', 'Ativo'),
(154, 6, 612, 'Parafuso e Porca', 'Ativo'),
(155, 6, 613, 'Radiador de Óleo', 'Ativo'),
(156, 6, 614, 'Tomada de força', 'Ativo'),
(157, 6, 615, 'Trava alavanca Câmbi', 'Ativo'),
(158, 6, 616, 'Carcaça CX.Câmbio', 'Ativo'),
(159, 6, 617, 'Guarda-pó', 'Ativo'),
(160, 6, 618, 'Articulador', 'Ativo'),
(161, 6, 619, 'Cabo', 'Ativo'),
(162, 6, 620, 'Varao', 'Ativo'),
(163, 6, 621, 'Tampa', 'Ativo'),
(164, 6, 622, 'Bujão', 'Ativo'),
(165, 6, 623, 'Garfo seletor', 'Ativo'),
(166, 6, 624, 'Eixo do Seletor', 'Ativo'),
(167, 6, 625, 'Respiro', 'Ativo'),
(168, 6, 626, 'Arruela de Trava', 'Ativo'),
(169, 6, 627, 'Anel de segurança', 'Ativo'),
(170, 6, 628, 'Chaveta', 'Ativo'),
(171, 6, 629, 'Anel espaçador', 'Ativo'),
(172, 6, 630, 'Anel encosto', 'Ativo'),
(173, 6, 631, 'Calço', 'Ativo'),
(174, 6, 632, 'Pino', 'Ativo'),
(175, 6, 633, 'Bucha', 'Ativo'),
(176, 6, 634, 'Rolete', 'Ativo'),
(177, 6, 635, 'Mola', 'Ativo'),
(178, 6, 636, 'Tubo de Lubrificação', 'Ativo'),
(179, 6, 638, 'Bomda de Óleo', 'Ativo'),
(180, 6, 639, 'Tubo de Sucção', 'Ativo'),
(181, 6, 640, 'Prisioneiro', 'Ativo'),
(182, 6, 641, 'Cambio', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_de_servico`
--

CREATE TABLE `ordem_de_servico` (
  `id` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `id_colaborador` int(11) NOT NULL,
  `numero_os` int(11) NOT NULL,
  `dataAbertura` date NOT NULL,
  `horaAbertura` time NOT NULL,
  `dataFechamento` date DEFAULT NULL,
  `horaFechamento` time DEFAULT NULL,
  `prazo` datetime NOT NULL,
  `descricao` text NOT NULL,
  `status` enum('Aberto','Fechado') NOT NULL,
  `status_prazo` enum('Normal','ProximoVen','Vencido') NOT NULL,
  `situacao` enum('Ativo','Inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `procedimento`
--

CREATE TABLE `procedimento` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `situacao` enum('Ativo','Inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `procedimento`
--

INSERT INTO `procedimento` (`id`, `codigo`, `descricao`, `situacao`) VALUES
(1, 1, 'Regular', 'Ativo'),
(2, 2, 'Montar', 'Ativo'),
(3, 3, 'Limpar', 'Ativo'),
(4, 4, 'Usinar', 'Ativo'),
(5, 5, 'Alinhar/Balancear', 'Ativo'),
(6, 6, 'Verificar', 'Ativo'),
(7, 7, 'Retificar Geral', 'Ativo'),
(8, 8, 'Lavar', 'Ativo'),
(9, 9, 'Coletar', 'Ativo'),
(10, 10, 'Remontar', 'Ativo'),
(11, 11, 'Reapertar', 'Ativo'),
(12, 12, 'Pintar', 'Ativo'),
(13, 13, 'Engraxar/Lubrificar', 'Ativo'),
(14, 14, 'Consertar', 'Ativo'),
(15, 15, 'Calibrar', 'Ativo'),
(16, 16, 'Desmontar', 'Ativo'),
(17, 17, 'Soldar', 'Ativo'),
(18, 18, 'Requisitar Itens', 'Ativo'),
(19, 19, 'Prensar', 'Ativo'),
(20, 20, 'Realizando diálise', 'Ativo'),
(21, 21, 'Cortar', 'Ativo'),
(22, 22, 'Lixar', 'Ativo'),
(23, 23, 'Sacar Parafuso', 'Ativo'),
(24, 24, 'Partida Auxiliar', 'Ativo'),
(25, 25, 'Orçamento', 'Ativo'),
(26, 26, 'Trocar', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `id_col` int(11) NOT NULL,
  `id_proc` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `dataAbertura` date DEFAULT NULL,
  `horaAbertura` time DEFAULT NULL,
  `dataFechamento` date DEFAULT NULL,
  `horaFechamento` time DEFAULT NULL,
  `status` enum('Aberto','Fechado') DEFAULT NULL,
  `situacao` enum('Ativo','Inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao`
--

CREATE TABLE `solicitacao` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `token` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cargo` varchar(150) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `situacao` enum('Ativo','Inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `matricula`, `senha`, `email`, `cargo`, `ativo`, `situacao`) VALUES
(1, 1, '$argon2i$v=19$m=1024,t=2,p=2$QnF2eGhQRVlJSXJRN3JEbA$07YYns1VXrJgnWTxZDwxDvXXzABxfntSS99rhqy9SB4', 'admin@gmail.com', 'Admin', 'Sim', 'Ativo'),
(2, 2, '$2y$10$jTDZ9RMHBrqfBiYVKfy2muTGTsP2qF47zMojyRZ8sBrgZar6IKZk2', 'rodrigo@gmail.com', 'Admin', 'Não', 'Ativo'),
(3, 3, '$2y$10$KidOOctuNse.4wl3Rz6f6em420.zUKoYzYQqdwud4.09FDf4ZTfLS', 'diego@gmail.com', 'Mecânico', 'Não', 'Ativo'),
(4, 4, '$2y$10$O0B01qf1JbRduhzc6M2nfOXJqlEUd.huQfKlRc5OxdXRul6YH3Bty', 'rogerio@gmail.com', 'Admin', 'Sim', 'Ativo'),
(5, 5, '$2y$10$MbI602xKs6h38mRX8j2A3OvTTYQnAgHS9K0s.nTQCmxTmzrgIsngC', 'carlos@gmail.com', 'Mecânico', 'Sim', 'Ativo'),
(6, 6, '$2y$10$2t84XNT9NBUFcWU4/RIWWOim5solukp/GG2CgpqqEAKFG3pw3RVSK', 'mateus@gmail.com', 'Atendente', 'Sim', 'Ativo'),
(7, 7, '$2y$10$HEsDbZ9CrbI3MBwrWl3aGOCgCrT2l67VJfGAa/Skh6LFTBUD0zS0C', 'igor@gmail.com', 'Mecânico', 'Sim', 'Ativo'),
(8, 8, '$2y$10$NbxYQ5plc9Cdz/uk51ecxu0oGGazyBCMDAHTQMKTdUYC3WvTWjFHe', 'maicon@gmail.com', 'Mecânico', 'Sim', 'Ativo'),
(9, 9, '$2y$10$O0B01qf1JbRduhzc6M2nfOXJqlEUd.huQfKlRc5OxdXRul6YH3Bty', 'jonathan@gmail.com', 'Admin', 'Sim', 'Ativo'),
(10, 10, '$2y$10$MbI602xKs6h38mRX8j2A3OvTTYQnAgHS9K0s.nTQCmxTmzrgIsngC', 'tarcisio@gmail.com', 'Mecânico', 'Sim', 'Ativo'),
(11, 11, '$2y$10$2t84XNT9NBUFcWU4/RIWWOim5solukp/GG2CgpqqEAKFG3pw3RVSK', 'josefe@gmail.com', 'Atendente', 'Sim', 'Ativo'),
(12, 12, '$2y$10$HEsDbZ9CrbI3MBwrWl3aGOCgCrT2l67VJfGAa/Skh6LFTBUD0zS0C', 'valmir@gmail.com', 'Mecânico', 'Sim', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `marca` varchar(150) NOT NULL,
  `modelo` varchar(150) NOT NULL,
  `cor` varchar(100) NOT NULL,
  `ano` varchar(10) NOT NULL,
  `situacao` enum('Ativo','Inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id`, `id_cliente`, `placa`, `marca`, `modelo`, `cor`, `ano`, `situacao`) VALUES
(1, 1, 'AAA-6446', 'Volkswagen', 'Gol G3', 'Preto', '2005', 'Ativo'),
(2, 2, 'AAS-4544', 'Chevrolet ', 'Astra', 'Preto', '2005', 'Ativo'),
(3, 2, 'ASA-4574', 'Fiat', 'Palio', 'Preto', '2005', 'Ativo'),
(4, 4, 'DFS-4555', 'Chevrolet', 'Vactra', 'Preto', '2005', 'Ativo'),
(5, 4, 'DSF-7787', 'Chevrolet', 'Onix', 'Preto', '2005', 'Ativo'),
(6, 1, 'HRR-7878', 'Chevrolet', 'Gol G3', 'Preto', '2005', 'Ativo'),
(7, 5, 'WQE-4544', 'Chevrolet', 'Cruze LT', 'Preto', '2005', 'Ativo'),
(8, 5, 'GFF-7858', 'Volkswagen', 'Gof', 'Preto', '2005', 'Ativo'),
(9, 6, 'FGH-5646', 'Volkswagen', 'Jeta', 'Preto', '2005', 'Ativo'),
(10, 7, 'FGH-4524', 'Fiat', 'Argo', 'Preto', '2005', 'Ativo'),
(11, 8, 'FDG-7575', 'Fiat', 'Toro', 'Preto', '2005', 'Ativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aux_os_servico`
--
ALTER TABLE `aux_os_servico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ordem_de_servico` (`id_ordem_de_servico`),
  ADD KEY `id_servico` (`id_servico`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `componente`
--
ALTER TABLE `componente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_comp` (`id_comp`);

--
-- Índices para tabela `ordem_de_servico`
--
ALTER TABLE `ordem_de_servico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_veiculo` (`id_veiculo`),
  ADD KEY `id_colaborador` (`id_colaborador`);

--
-- Índices para tabela `procedimento`
--
ALTER TABLE `procedimento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_col` (`id_col`),
  ADD KEY `id_proc` (`id_proc`),
  ADD KEY `id_item` (`id_item`);

--
-- Índices para tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aux_os_servico`
--
ALTER TABLE `aux_os_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `componente`
--
ALTER TABLE `componente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT de tabela `ordem_de_servico`
--
ALTER TABLE `ordem_de_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `procedimento`
--
ALTER TABLE `procedimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aux_os_servico`
--
ALTER TABLE `aux_os_servico`
  ADD CONSTRAINT `aux_os_servico_ibfk_1` FOREIGN KEY (`id_ordem_de_servico`) REFERENCES `ordem_de_servico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aux_os_servico_ibfk_2` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `colaborador`
--
ALTER TABLE `colaborador`
  ADD CONSTRAINT `colaborador_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_comp`) REFERENCES `componente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ordem_de_servico`
--
ALTER TABLE `ordem_de_servico`
  ADD CONSTRAINT `ordem_de_servico_ibfk_1` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ordem_de_servico_ibfk_2` FOREIGN KEY (`id_colaborador`) REFERENCES `colaborador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `servico`
--
ALTER TABLE `servico`
  ADD CONSTRAINT `servico_ibfk_1` FOREIGN KEY (`id_col`) REFERENCES `colaborador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servico_ibfk_2` FOREIGN KEY (`id_proc`) REFERENCES `procedimento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servico_ibfk_3` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD CONSTRAINT `solicitacao_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `veiculo_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
