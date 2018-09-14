-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Set-2018 às 00:47
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projcap`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ata`
--

CREATE TABLE `ata` (
  `cd_ata` int(11) NOT NULL,
  `dt_ata` date NOT NULL,
  `nm_tipo_ata` varchar(10) NOT NULL,
  `cd_gestao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ata`
--

INSERT INTO `ata` (`cd_ata`, `dt_ata`, `nm_tipo_ata`, `cd_gestao`) VALUES
(1, '0000-00-00', 'Nova', 1),
(2, '0000-00-00', 'Nova', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `capitulo`
--

CREATE TABLE `capitulo` (
  `cd_capitulo` int(11) NOT NULL,
  `nm_capitulo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `capitulo`
--

INSERT INTO `capitulo` (`cd_capitulo`, `nm_capitulo`) VALUES
(0, 'Praia Grande');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo`
--

CREATE TABLE `cargo` (
  `cd_cargo` int(11) NOT NULL,
  `nm_cargo` varchar(20) NOT NULL,
  `cd_gestao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cargo`
--

INSERT INTO `cargo` (`cd_cargo`, `nm_cargo`, `cd_gestao`) VALUES
(1, 'Ativo', 1),
(2, 'Ativo', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comissao`
--

CREATE TABLE `comissao` (
  `cd_comissao` int(11) NOT NULL,
  `nm_comissao` varchar(20) NOT NULL,
  `cd_gestao` int(11) NOT NULL,
  `cd_demolay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comissao`
--

INSERT INTO `comissao` (`cd_comissao`, `nm_comissao`, `cd_gestao`, `cd_demolay`) VALUES
(1, 'Diversao', 1, 1),
(3, 'teste', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `demolay`
--

CREATE TABLE `demolay` (
  `cd_demolay` int(11) NOT NULL,
  `cd_cid_demolay` int(11) DEFAULT NULL,
  `nm_demolay` varchar(100) NOT NULL,
  `cd_capitulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `demolay`
--

INSERT INTO `demolay` (`cd_demolay`, `cd_cid_demolay`, `nm_demolay`, `cd_capitulo`) VALUES
(1, 74837, 'Andre', 0),
(2, 11, 'adas', 0),
(5, 12, 'teste1', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gestao`
--

CREATE TABLE `gestao` (
  `cd_gestao` int(11) NOT NULL,
  `cd_capitulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gestao`
--

INSERT INTO `gestao` (`cd_gestao`, `cd_capitulo`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `membro`
--

CREATE TABLE `membro` (
  `cd_membro` int(11) NOT NULL,
  `cd_demolay` int(11) NOT NULL,
  `cd_comissao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `membro`
--

INSERT INTO `membro` (`cd_membro`, `cd_demolay`, `cd_comissao`) VALUES
(9, 1, 3),
(10, 2, 3),
(13, 1, 3),
(17, 5, 1),
(18, 1, 1),
(19, 2, 1),
(20, 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidade`
--

CREATE TABLE `mensalidade` (
  `cd_mensalidade` int(11) NOT NULL,
  `dt_mensalidade` date NOT NULL,
  `dt_pagamento_mensalidade` date NOT NULL,
  `cd_demolay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mensalidade`
--

INSERT INTO `mensalidade` (`cd_mensalidade`, `dt_mensalidade`, `dt_pagamento_mensalidade`, `cd_demolay`) VALUES
(1, '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reuniao`
--

CREATE TABLE `reuniao` (
  `cd_reuniao` int(11) NOT NULL,
  `dt_reuniao` date NOT NULL,
  `nm_pauta_reuniao` varchar(100) NOT NULL,
  `cd_gestao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `reuniao`
--

INSERT INTO `reuniao` (`cd_reuniao`, `dt_reuniao`, `nm_pauta_reuniao`, `cd_gestao`) VALUES
(1, '0000-00-00', 'escreva pauta aqui', 1),
(2, '0000-00-00', 'escreva pauta aqui escreva pauta aqui escreva pauta aqui escreva pauta aqui escreva pauta aqui escre', 1),
(3, '2018-12-09', 'ete', 1),
(4, '2018-09-13', 'hh', 1),
(5, '2018-09-13', 'novo', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ata`
--
ALTER TABLE `ata`
  ADD PRIMARY KEY (`cd_ata`),
  ADD KEY `cd_gestaoAta` (`cd_gestao`) USING BTREE;

--
-- Indexes for table `capitulo`
--
ALTER TABLE `capitulo`
  ADD PRIMARY KEY (`cd_capitulo`);

--
-- Indexes for table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`cd_cargo`),
  ADD KEY `cd_gestaoCargo` (`cd_gestao`);

--
-- Indexes for table `comissao`
--
ALTER TABLE `comissao`
  ADD PRIMARY KEY (`cd_comissao`),
  ADD KEY `cd_gestaoComissao` (`cd_gestao`),
  ADD KEY `cd_demolayComissao` (`cd_demolay`);

--
-- Indexes for table `demolay`
--
ALTER TABLE `demolay`
  ADD PRIMARY KEY (`cd_demolay`),
  ADD KEY `cd_capituloDemolay` (`cd_capitulo`) USING BTREE;

--
-- Indexes for table `gestao`
--
ALTER TABLE `gestao`
  ADD PRIMARY KEY (`cd_gestao`),
  ADD KEY `cd_capituloGestao` (`cd_capitulo`);

--
-- Indexes for table `membro`
--
ALTER TABLE `membro`
  ADD PRIMARY KEY (`cd_membro`),
  ADD KEY `cd_comissaoMembro` (`cd_comissao`),
  ADD KEY `cd_demolayMembro` (`cd_demolay`);

--
-- Indexes for table `mensalidade`
--
ALTER TABLE `mensalidade`
  ADD PRIMARY KEY (`cd_mensalidade`),
  ADD KEY `cd_demolayMensalidade` (`cd_demolay`);

--
-- Indexes for table `reuniao`
--
ALTER TABLE `reuniao`
  ADD PRIMARY KEY (`cd_reuniao`),
  ADD KEY `cd_gestaoReuniao` (`cd_gestao`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ata`
--
ALTER TABLE `ata`
  MODIFY `cd_ata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `cd_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comissao`
--
ALTER TABLE `comissao`
  MODIFY `cd_comissao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `demolay`
--
ALTER TABLE `demolay`
  MODIFY `cd_demolay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gestao`
--
ALTER TABLE `gestao`
  MODIFY `cd_gestao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `membro`
--
ALTER TABLE `membro`
  MODIFY `cd_membro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mensalidade`
--
ALTER TABLE `mensalidade`
  MODIFY `cd_mensalidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reuniao`
--
ALTER TABLE `reuniao`
  MODIFY `cd_reuniao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `ata`
--
ALTER TABLE `ata`
  ADD CONSTRAINT `cd_gestao` FOREIGN KEY (`cd_gestao`) REFERENCES `gestao` (`cd_gestao`);

--
-- Limitadores para a tabela `cargo`
--
ALTER TABLE `cargo`
  ADD CONSTRAINT `cd_gestaoCargo` FOREIGN KEY (`cd_gestao`) REFERENCES `gestao` (`cd_gestao`);

--
-- Limitadores para a tabela `comissao`
--
ALTER TABLE `comissao`
  ADD CONSTRAINT `cd_demolayComissao` FOREIGN KEY (`cd_demolay`) REFERENCES `demolay` (`cd_demolay`),
  ADD CONSTRAINT `cd_gestaoComissao` FOREIGN KEY (`cd_gestao`) REFERENCES `gestao` (`cd_gestao`);

--
-- Limitadores para a tabela `demolay`
--
ALTER TABLE `demolay`
  ADD CONSTRAINT `cd_capitulo` FOREIGN KEY (`cd_capitulo`) REFERENCES `capitulo` (`cd_capitulo`);

--
-- Limitadores para a tabela `gestao`
--
ALTER TABLE `gestao`
  ADD CONSTRAINT `cd_capituloGestao` FOREIGN KEY (`cd_capitulo`) REFERENCES `capitulo` (`cd_capitulo`);

--
-- Limitadores para a tabela `membro`
--
ALTER TABLE `membro`
  ADD CONSTRAINT `cd_comissaoMembro` FOREIGN KEY (`cd_comissao`) REFERENCES `comissao` (`cd_comissao`),
  ADD CONSTRAINT `cd_demolayMembro` FOREIGN KEY (`cd_demolay`) REFERENCES `demolay` (`cd_demolay`);

--
-- Limitadores para a tabela `mensalidade`
--
ALTER TABLE `mensalidade`
  ADD CONSTRAINT `cd_demolayMensalidade` FOREIGN KEY (`cd_demolay`) REFERENCES `demolay` (`cd_demolay`);

--
-- Limitadores para a tabela `reuniao`
--
ALTER TABLE `reuniao`
  ADD CONSTRAINT `cd_gestaoReuniao` FOREIGN KEY (`cd_gestao`) REFERENCES `gestao` (`cd_gestao`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
