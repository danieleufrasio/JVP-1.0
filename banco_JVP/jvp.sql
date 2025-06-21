-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/06/2025 às 17:07
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
-- Banco de dados: `jvp`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `codigo_interno` varchar(50) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `codigo`, `codigo_interno`, `nome`, `status`) VALUES
(3, '777', '7777', 'Teste', 'Inativo'),
(5, '333', '333', 'Maiara', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `nivel_acesso` enum('freelancer','projetista','calculista','verificador','adm','estagiario') NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `cargo` enum('freelancer','projetista','calculista','verificador','adm','estagiario') NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `codigo`, `nome`, `email`, `nivel_acesso`, `status`, `cargo`, `usuario`, `senha`) VALUES
(1, 'ADM001', 'Administrador', 'admin@empresa.com', 'adm', 'ativo', '', 'admin', '$2y$10$c2/T2fB4IqhJi3PkpZX1u.V5AFN65mjG6kHYSKAG6PIEAPZ8foYn2'),
(2, '777', 'teste', 'teste@example.com', 'adm', 'ativo', '', 'Administrador', '$2y$10$5VUN1ZEEZhtVVx/EblEnQ.TpWdW/j8FUTh7M0hsyWMPJrL0V4pCGu'),
(3, '111', 'Maiara', 'maiara@example.com', 'adm', 'ativo', '', 'Maiara', '$2y$10$TUF7xdRd33bDyDEXYBxLKOCVO5ZuwjmfdXbfQE7kBmQjtbWJ3WW5O');

-- --------------------------------------------------------

--
-- Estrutura para tabela `elementos`
--

CREATE TABLE `elementos` (
  `id` int(11) NOT NULL,
  `tipo_projeto_id` int(11) NOT NULL,
  `sigla` varchar(20) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `elementos`
--

INSERT INTO `elementos` (`id`, `tipo_projeto_id`, `sigla`, `descricao`) VALUES
(1, 1, 'APL', 'AGUAS PLUVIAIS'),
(2, 2, 'Geral', 'Geral');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `fornecedor` varchar(100) NOT NULL,
  `status` enum('Ativo','Inativo') NOT NULL DEFAULT 'Ativo',
  `email` varchar(100) NOT NULL,
  `categoria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `codigo`, `fornecedor`, `status`, `email`, `categoria`) VALUES
(1, '333', 'Farmacia', 'Ativo', 'farmacia@example.com', 'Nacional');

-- --------------------------------------------------------

--
-- Estrutura para tabela `obras`
--

CREATE TABLE `obras` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `obra` varchar(255) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `outros_campos` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `obras`
--

INSERT INTO `obras` (`id`, `codigo`, `obra`, `cliente_id`, `ano`, `status`, `outros_campos`) VALUES
(1, '7777', '7777', 3, 2007, 'Ativo', ''),
(2, '333', 'Teste', 5, 2025, 'Inativo', 'xxx');

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pavimentos`
--

CREATE TABLE `pavimentos` (
  `id` int(11) NOT NULL,
  `sigla` varchar(10) NOT NULL,
  `pavimento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pavimentos`
--

INSERT INTO `pavimentos` (`id`, `sigla`, `pavimento`) VALUES
(1, 'JIR', 'Jiral');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pranchas`
--

CREATE TABLE `pranchas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `obra_id` int(11) DEFAULT NULL,
  `previsao_conclusao` date DEFAULT NULL,
  `conclusao` date DEFAULT NULL,
  `tipo_projeto_id` int(11) DEFAULT NULL,
  `numero_prancha` varchar(20) DEFAULT NULL,
  `elemento_id` int(11) DEFAULT NULL,
  `pavimento_id` int(11) DEFAULT NULL,
  `revisao` varchar(10) DEFAULT NULL,
  `tipo_papel_id` int(11) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `status` enum('pendente','em aprovação','aprovado','em alteração','reprovado','cancelado','todos') NOT NULL DEFAULT 'pendente',
  `projetado_id` int(11) DEFAULT NULL,
  `verificado_id` int(11) DEFAULT NULL,
  `calculado_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_papel`
--

CREATE TABLE `tipos_papel` (
  `id` int(11) NOT NULL,
  `sigla` varchar(10) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `equivalencia` varchar(10) NOT NULL,
  `valor_equivalencia` decimal(5,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipos_papel`
--

INSERT INTO `tipos_papel` (`id`, `sigla`, `descricao`, `equivalencia`, `valor_equivalencia`) VALUES
(3, 'A0', 'xxx', 'A0', 2.000);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_projeto`
--

CREATE TABLE `tipos_projeto` (
  `id` int(11) NOT NULL,
  `sigla` varchar(20) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipos_projeto`
--

INSERT INTO `tipos_projeto` (`id`, `sigla`, `descricao`) VALUES
(1, 'APL', 'AGUAS PLUVIAIS'),
(2, 'AVL', 'Alvenaria');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Índices de tabela `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_projeto_id` (`tipo_projeto_id`);

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pavimentos`
--
ALTER TABLE `pavimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pranchas`
--
ALTER TABLE `pranchas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `obra_id` (`obra_id`),
  ADD KEY `tipo_projeto_id` (`tipo_projeto_id`),
  ADD KEY `elemento_id` (`elemento_id`),
  ADD KEY `pavimento_id` (`pavimento_id`),
  ADD KEY `tipo_papel_id` (`tipo_papel_id`),
  ADD KEY `projetado_id` (`projetado_id`),
  ADD KEY `verificado_id` (`verificado_id`),
  ADD KEY `calculado_id` (`calculado_id`);

--
-- Índices de tabela `tipos_papel`
--
ALTER TABLE `tipos_papel`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipos_projeto`
--
ALTER TABLE `tipos_projeto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `elementos`
--
ALTER TABLE `elementos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pavimentos`
--
ALTER TABLE `pavimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pranchas`
--
ALTER TABLE `pranchas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipos_papel`
--
ALTER TABLE `tipos_papel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipos_projeto`
--
ALTER TABLE `tipos_projeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `elementos`
--
ALTER TABLE `elementos`
  ADD CONSTRAINT `elementos_ibfk_1` FOREIGN KEY (`tipo_projeto_id`) REFERENCES `tipos_projeto` (`id`);

--
-- Restrições para tabelas `obras`
--
ALTER TABLE `obras`
  ADD CONSTRAINT `obras_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

--
-- Restrições para tabelas `pranchas`
--
ALTER TABLE `pranchas`
  ADD CONSTRAINT `pranchas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `pranchas_ibfk_2` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`),
  ADD CONSTRAINT `pranchas_ibfk_3` FOREIGN KEY (`tipo_projeto_id`) REFERENCES `tipos_projeto` (`id`),
  ADD CONSTRAINT `pranchas_ibfk_4` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`),
  ADD CONSTRAINT `pranchas_ibfk_5` FOREIGN KEY (`pavimento_id`) REFERENCES `pavimentos` (`id`),
  ADD CONSTRAINT `pranchas_ibfk_6` FOREIGN KEY (`tipo_papel_id`) REFERENCES `tipos_papel` (`id`),
  ADD CONSTRAINT `pranchas_ibfk_7` FOREIGN KEY (`projetado_id`) REFERENCES `colaboradores` (`id`),
  ADD CONSTRAINT `pranchas_ibfk_8` FOREIGN KEY (`verificado_id`) REFERENCES `colaboradores` (`id`),
  ADD CONSTRAINT `pranchas_ibfk_9` FOREIGN KEY (`calculado_id`) REFERENCES `colaboradores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
