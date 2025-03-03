-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/03/2025 às 22:56
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
-- Banco de dados: `ourofeira_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `barracas`
--

CREATE TABLE `barracas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `responsavel` varchar(14) NOT NULL,
  `imagembarraca` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `barracas`
--

INSERT INTO `barracas` (`id`, `nome`, `descricao`, `categoria`, `responsavel`, `imagembarraca`) VALUES
(25, 'Barraca da Maria', 'Vendemos artesanatos', 'Artesanatos', '194.105.234-82', '../Arquivosdeimagem/barraca1.jpg'),
(26, 'Barraca do Seu Zé', 'Vendemos Bebidas', 'Bebidas', '941.185.174-73', '../Arquivosdeimagem/barraca2.jpg'),
(27, 'Barraca da Ana', 'Vendemos Comidas', 'Comidas', '234.714.153-82', '../Arquivosdeimagem/barraca3.jpg'),
(28, 'Barraca da Fátima', 'Vendemos Roupas', 'Roupas', '185.523.412-42', '../Arquivosdeimagem/barraca-de-feira-livre.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`nome`) VALUES
('Artesanatos'),
('Bebidas'),
('Comidas'),
('Eletrônicos'),
('Roupas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagems_produtos`
--

CREATE TABLE `imagems_produtos` (
  `id` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `pathdaimagem` varchar(100) NOT NULL,
  `dataupload` datetime NOT NULL DEFAULT current_timestamp(),
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `idproduto` bigint(20) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `descricao` text NOT NULL,
  `valor` double NOT NULL,
  `quantidade` int(255) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `peso` double NOT NULL,
  `idbarraca` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `validade` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`idproduto`, `nome`, `descricao`, `valor`, `quantidade`, `categoria`, `peso`, `idbarraca`, `imagem`, `validade`) VALUES
(28, 'Casas de Artesanato', 'Casas de Artesanato feitas de barro', 50, 17, 'Artesanatos', 1, 25, '../Arquivosdeimagem/artesanato_3.png', '9999-12-31'),
(29, 'Cestos', 'Artesanato de Cestos', 65, 15, 'Artesanatos', 0.75, 25, '../Arquivosdeimagem/16050_16051_14799_14797.png', '9999-12-31'),
(30, 'Panelas de Barro', 'Panela de Barro', 45, 10, 'Artesanatos', 0.5, 25, '../Arquivosdeimagem/noticia_1258728243648734eb7b6ce.png', '9999-12-31'),
(31, 'Guaraná 2L', 'Garrafa de Guaraná 2L', 5, 15, 'Bebidas', 2, 26, '../Arquivosdeimagem/7ade0ebb64269904c17a1edab1482224.png', '2026-12-31'),
(32, 'Garrafa de Água', 'Garrafa de Água de 500 ml', 2.5, 27, 'Artesanatos', 0.5, 26, '../Arquivosdeimagem/agua.jpg', '2026-12-31'),
(33, 'Lata Coca Cola', 'Lata de Coca Cola 350 ml', 4.5, 50, 'Artesanatos', 0.35, 26, '../Arquivosdeimagem/images (1)32432.jpg', '2026-12-31'),
(34, 'Coxinha', 'Coxinha de Frango; unidade', 3.5, 50, 'Comidas', 0.1, 27, '../Arquivosdeimagem/images.jpg', '2025-03-05'),
(35, 'Pastel', 'Opções: pastel de carne, queijo e de presunto; preço por unidade', 5, 50, 'Comidas', 0.2, 27, '../Arquivosdeimagem/Massa-de-pastel.jpg', '2025-03-05'),
(36, 'Marmita', 'Marmita com: arroz, feijão, macarrão, carne e salada', 20, 30, 'Comidas', 0.8, 27, '../Arquivosdeimagem/images (1)342.jpg', '2025-03-03'),
(37, 'Vestido', 'Vestido, temos nas cores: azul e vermelho; Tamanhos: P, M, G e GG', 50, 10, 'Roupas', 0.3, 28, '../Arquivosdeimagem/300642285.png', '9999-12-31'),
(38, 'Camisa Lisa', 'Camisa lisas, temos nas cores: bege, branco, preto, azul, cinza e vermelho; Tamanhos: P, M, G e GG', 35, 30, 'Roupas', 0.3, 28, '../Arquivosdeimagem/bege-vic-926x926.png', '9999-12-31'),
(39, 'Calça jeans', 'Calça Jeans Unissex, Tamanhos: P, M, G e GG', 50, 10, 'Roupas', 0.3, 28, '../Arquivosdeimagem/da686085a13788fb1c17d649eae06bca.jpg', '9999-12-31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `registro_compras`
--

CREATE TABLE `registro_compras` (
  `IDCompra` bigint(50) NOT NULL,
  `idproduto` bigint(20) NOT NULL,
  `quant` int(11) DEFAULT NULL,
  `valorproduto` double DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `dataehora` datetime DEFAULT NULL,
  `origem` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `statuscompra` varchar(255) DEFAULT NULL,
  `controle` int(50) NOT NULL,
  `statuscompraadm` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `registro_compras`
--

INSERT INTO `registro_compras` (`IDCompra`, `idproduto`, `quant`, `valorproduto`, `cpf`, `dataehora`, `origem`, `nome`, `statuscompra`, `controle`, `statuscompraadm`, `descricao`) VALUES
(7549797916, 28, 2, 50, '321.321.321-32', '2025-03-03 08:27:24', 25, 'Casas de Artesanato', 'pendente', 32, 'Aguardando pagamento', ''),
(7549797916, 32, 2, 2.5, '321.321.321-32', '2025-03-03 08:27:24', 26, 'Garrafa de Água', 'pendente', 33, 'Aguardando pagamento', ''),
(2673701154, 28, 1, 50, '321.321.321-32', '2025-03-03 17:05:49', 25, 'Casas de Artesanato', 'pendente', 34, 'Aguardando pagamento', ''),
(2673701154, 32, 1, 2.5, '321.321.321-32', '2025-03-03 17:05:49', 26, 'Garrafa de Água', 'pendente', 35, 'Aguardando pagamento', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `imagemperfil` varchar(255) DEFAULT NULL,
  `atividade` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`nome`, `email`, `telefone`, `endereco`, `cpf`, `senha`, `cargo`, `codigo`, `imagemperfil`, `atividade`) VALUES
('Fátima dos Santos', 'fatima@gmail.com', '(31) 90121-8461', 'Rua F', '185.523.412-42', '$2y$10$Zsz9FhqlBkcesDZNUv2MFuurKN7ttTtaiMDjNEdQxhcl.uBrUey6a', 'feirante', '', '../Arquivosdeimagem/fatima.png', 'ativo'),
('Maria Da Costa', 'maria@gmail.com', '(31) 98264-8164', 'Rua C', '194.105.234-82', '$2y$10$yRxNX2v0ot6nTCT6rDLZFe2FuOAc6RQZnrjJgKhb9aJcgDW9vSnEC', 'feirante', '', '../Arquivosdeimagem/ana.jpg', 'ativo'),
('Ana Mendes', 'ana@gmail.com', '(31) 97285-2975', 'Rua E', '234.714.153-82', '$2y$10$VYWTJwwO3.ASaDjcIY035u1wBqGTGiP.TgL0jrrgYP0pPK3ymZIli', 'feirante', '', '../Arquivosdeimagem/fotoperfil.jpg', 'ativo'),
('Lucas Rodrigues Moreira', 'lucas@gmail.com', '(31)90000-0000', 'Rua A', '321.321.321-32', '$2y$10$KBysKALTPhx51sI8O38/dup.b9oEh/ZqHR0rDN4ZANMMHuwgrVsYa', 'admin', '', '../Arquivosdeimagem/depositphotos_144492381-stock-photo-happy-handsome-caucasian-man.jpg', 'ativo'),
('João Da Silva', 'joao@gmail.com', '(31) 9746-4234', 'Rua B', '328.931.270-48', '$2y$10$OG3L21pRLOYWpX76G77bpOmD1B01BOPguPt3htwEmCNMJnN8H1jdi', 'comum', '', '../Arquivosdeimagem/icon.jpg', 'ativo'),
('José De Oliveira', 'jose@gmail.com', '(31) 91641-9386', 'Rua D', '941.185.174-73', '$2y$10$asfunLEQcmsyr1qHA06m.eYbBQgXn2P6dHbqEYVKPl1c5eWzBQ/cG', 'feirante', '', '../Arquivosdeimagem/images999.jpg', 'ativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `barracas`
--
ALTER TABLE `barracas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `fk_responsavel` (`responsavel`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`nome`);

--
-- Índices de tabela `imagems_produtos`
--
ALTER TABLE `imagems_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idproduto`),
  ADD KEY `idbarraca` (`idbarraca`),
  ADD KEY `categoria` (`categoria`);

--
-- Índices de tabela `registro_compras`
--
ALTER TABLE `registro_compras`
  ADD PRIMARY KEY (`controle`),
  ADD KEY `origem` (`origem`),
  ADD KEY `idproduto` (`idproduto`),
  ADD KEY `cpf` (`cpf`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `barracas`
--
ALTER TABLE `barracas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `imagems_produtos`
--
ALTER TABLE `imagems_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idproduto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `registro_compras`
--
ALTER TABLE `registro_compras`
  MODIFY `controle` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `barracas`
--
ALTER TABLE `barracas`
  ADD CONSTRAINT `fk_responsavel` FOREIGN KEY (`responsavel`) REFERENCES `usuario` (`cpf`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`idbarraca`) REFERENCES `barracas` (`id`),
  ADD CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`nome`);

--
-- Restrições para tabelas `registro_compras`
--
ALTER TABLE `registro_compras`
  ADD CONSTRAINT `cpf` FOREIGN KEY (`cpf`) REFERENCES `usuario` (`cpf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
