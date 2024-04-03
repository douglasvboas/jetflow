-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/03/2024 às 20:20
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `jetflow_cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `proximo_id` int(11) NOT NULL,
  `cpf` varchar(13) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `telefone` int(13) NOT NULL,
  `email` varchar(250) NOT NULL,
  `marca_modelo` varchar(200) NOT NULL,
  `ano_fabricacao` varchar(4) NOT NULL,
  `data_cadastro` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`proximo_id`, `cpf`, `nome`, `telefone`, `email`, `marca_modelo`, `ano_fabricacao`, `data_cadastro`) VALUES
(49, '221.415.939-3', 'lissass', 2147483647, 'lincongordao@gmail.com', 'gsx 800', '1998', '10/10/'),
(50, '221.415.939-3', 'taty', 2147483647, 'taty@gmail.com', 'yamaha', '2010', '10/10/'),
(51, '222222222222', '', 0, '', '', '', ''),
(52, '', '', 0, '', '', '', ''),
(53, '', '', 0, '', '', '', ''),
(54, '', '', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `cpf` int(13) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `data_cadastro` date NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `marca_modelo` varchar(120) NOT NULL,
  `ano_fabricacao` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `orcamento`
--

CREATE TABLE `orcamento` (
  `cpf` varchar(13) NOT NULL,
  `data` varchar(10) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `marca` varchar(110) NOT NULL,
  `id_orc` int(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `descricao` varchar(220) NOT NULL,
  `quantidade` varchar(20) NOT NULL,
  `preco` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `orcamento`
--

INSERT INTO `orcamento` (`cpf`, `data`, `nome`, `marca`, `id_orc`, `item`, `descricao`, `quantidade`, `preco`, `total`) VALUES
('21347701800', 'douglas vi', '18061979', 'yamaha vx', 1, '01', 'vela de ignição', '02', 100, 200),
('21365498700', 'teste vint', '20052020', '', 2, '05', 'selo', '10', 10, 330);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `senha` varchar(150) NOT NULL,
  `usuario` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`senha`, `usuario`) VALUES
('123', 'teste'),
('admin', 'admin'),
('tata', 'tata');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`proximo_id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `orcamento`
--
ALTER TABLE `orcamento`
  ADD PRIMARY KEY (`id_orc`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`senha`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `proximo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `id_orc` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
