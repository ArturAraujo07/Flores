-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Jan-2021 às 14:11
-- Versão do servidor: 10.4.16-MariaDB
-- versão do PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `abelhas_flores`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Uruçu (Melipona scutellaris)'),
(2, 'Uruçu-Amarela (Melipona rufiventris)'),
(3, 'Guarupu (Melipona bicolor)'),
(4, 'Iraí (Nannotrigona testaceicornes)');

-- --------------------------------------------------------

--
-- Estrutura da tabela `registros`
--

CREATE TABLE `registros` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `meses` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `registros`
--

INSERT INTO `registros` (`id`, `id_usuario`, `id_categoria`, `titulo`, `descricao`, `meses`) VALUES
(2, 1, 1, 'Laranjeira', 'Algum texto sobre a laranjeira', 6),
(3, 1, 3, 'mangueira', '', 6),
(4, 1, 4, 'Orégano', '', 1),
(5, 1, 2, 'Quaresmeira', '', 6),
(6, 1, 4, 'Pessegueiro', '', 7),
(7, 1, 2, 'Sálvia Vermelha', '', 11),
(8, 1, 4, 'Sabugueiro', '', 2),
(9, 1, 4, 'Sibipurana', '', 11),
(11, 1, 2, 'Azaléia', 'Alguma descrição qualquer', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `registros_imagens`
--

CREATE TABLE `registros_imagens` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_registro` int(11) NOT NULL,
  `url` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `registros_imagens`
--

INSERT INTO `registros_imagens` (`id`, `id_registro`, `url`) VALUES
(2, 2, '192cc0cf4aac8891c8d766254cd7adf4.jpg'),
(3, 3, '22892df1b2d8d58b3828045750ef1b7b.jpg'),
(4, 4, '25d1855a31f2c7008c6daa039b48f510.jpg'),
(6, 6, '26ecf412df5bd1ca8f551eeff34d194b.jpg'),
(7, 7, '36bfd2847ec3a6effa19a070be30b233.jpg'),
(8, 8, '3ac0c736af821ff8e023ac3d7ee1987e.jpg'),
(9, 9, 'fe42254284d8b28cf66681383243e184.jpg'),
(10, 5, 'b73a2679205ef7981a97ab246971e723.jpg'),
(12, 11, 'c6cb3f730cb46fd81f28fdfc12f463ce.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `senha` varchar(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'admin', 'admin@admin.com', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `registros_imagens`
--
ALTER TABLE `registros_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `registros_imagens`
--
ALTER TABLE `registros_imagens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
