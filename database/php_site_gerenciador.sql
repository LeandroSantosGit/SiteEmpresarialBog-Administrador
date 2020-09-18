-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Set-2020 às 03:42
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `php_site_gerenciador`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_cadastro_user`
--

CREATE TABLE `adms_cadastro_user` (
  `id` int(11) NOT NULL,
  `envio_email_config` int(11) NOT NULL,
  `adms_niveis_acesso_id` int(11) NOT NULL,
  `adms_situacao_user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `adms_cadastro_user`
--

INSERT INTO `adms_cadastro_user` (`id`, `envio_email_config`, `adms_niveis_acesso_id`, `adms_situacao_user_id`, `created`, `modified`) VALUES
(1, 1, 1, 1, '2020-04-11 10:08:29', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_cors`
--

CREATE TABLE `adms_cors` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `cor` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adms_cors`
--

INSERT INTO `adms_cors` (`id`, `nome`, `cor`, `created`, `modified`) VALUES
(1, 'Azul', 'primary', '2020-04-03 00:00:00', '2020-06-05 17:11:47'),
(2, 'Cinza', 'secondary', '2020-04-03 00:00:00', NULL),
(3, 'Verde', 'success', '2020-04-03 00:00:00', NULL),
(4, 'Vermelho', 'danger', '2020-04-03 00:00:00', NULL),
(5, 'Amarelo', 'warning', '2020-04-03 00:00:00', NULL),
(6, 'Azul claro', 'info', '2020-04-03 00:00:00', NULL),
(7, 'Claro', 'ligth', '2020-04-03 00:00:00', NULL),
(8, 'Cinza escuro', 'dark', '2020-04-03 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_grupos_paginas`
--

CREATE TABLE `adms_grupos_paginas` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adms_grupos_paginas`
--

INSERT INTO `adms_grupos_paginas` (`id`, `nome`, `ordem`, `created`, `modified`) VALUES
(1, 'Listar', 1, '2018-05-23 00:00:00', NULL),
(2, 'Cadastrar', 2, '2018-05-23 00:00:00', NULL),
(3, 'Editar', 3, '2018-05-23 00:00:00', NULL),
(4, 'Apagar', 4, '2018-05-23 00:00:00', NULL),
(5, 'Visualizar', 5, '2018-05-23 00:00:00', NULL),
(6, 'Outros', 6, '2018-05-23 00:00:00', NULL),
(7, 'Acesso', 7, '2018-05-23 00:00:00', '2020-06-19 17:02:28'),
(8, 'Alterar Ordem', 8, '2020-05-07 14:10:38', '2020-06-19 17:02:28'),
(9, 'Pesquisar', 9, '2020-07-19 17:24:53', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_menus`
--

CREATE TABLE `adms_menus` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `icone` varchar(40) NOT NULL,
  `ordem` int(11) NOT NULL,
  `adms_situacao_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `adms_menus`
--

INSERT INTO `adms_menus` (`id`, `nome`, `icone`, `ordem`, `adms_situacao_id`, `created`, `modified`) VALUES
(1, 'Dashborad', 'fas fa-tachometer-alt', 1, 1, '2020-04-03 13:42:32', '2020-06-01 23:14:46'),
(2, 'Usuario', 'fas fa-user', 2, 1, '2020-04-03 13:47:03', '2020-06-01 23:14:46'),
(3, 'sair', 'fas fa-sign-out-alt', 5, 1, '2020-04-17 10:38:35', '2020-06-17 16:41:44'),
(4, 'Configuracao', 'fas fa-cogs', 3, 1, '2020-04-17 11:07:38', '2020-06-01 23:06:57'),
(5, 'Site', 'fas fa-laptop-code', 4, 1, '2020-06-17 16:39:40', '2020-06-17 16:41:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_niveis_acessos`
--

CREATE TABLE `adms_niveis_acessos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adms_niveis_acessos`
--

INSERT INTO `adms_niveis_acessos` (`id`, `nome`, `ordem`, `created`, `modified`) VALUES
(1, 'Super Administrador', 1, '2020-04-03 00:00:00', '2020-05-23 17:54:09'),
(2, 'Administrador', 2, '2020-04-03 00:00:00', '2020-05-23 17:54:09'),
(3, 'Colaborador', 4, '2020-04-03 00:00:00', '2020-05-24 23:39:00'),
(4, 'Financeiro', 3, '2020-04-03 00:00:00', '2020-05-24 23:39:00'),
(5, 'Cliente', 5, '2020-04-03 00:00:00', '2020-05-24 23:39:00'),
(6, 'Supervisor', 6, '2020-05-25 00:16:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_niveis_acessos_paginas`
--

CREATE TABLE `adms_niveis_acessos_paginas` (
  `id` int(11) NOT NULL,
  `permissao` int(11) NOT NULL,
  `ordem` int(11) NOT NULL,
  `dropdown` int(11) NOT NULL DEFAULT 2,
  `lib_menu` int(11) NOT NULL DEFAULT 2,
  `adms_menu_id` int(11) NOT NULL DEFAULT 4,
  `adms_niveis_acesso_id` int(11) NOT NULL,
  `adms_pagina_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `adms_niveis_acessos_paginas`
--

INSERT INTO `adms_niveis_acessos_paginas` (`id`, `permissao`, `ordem`, `dropdown`, `lib_menu`, `adms_menu_id`, `adms_niveis_acesso_id`, `adms_pagina_id`, `created`, `modified`) VALUES
(1, 1, 1, 2, 1, 1, 1, 1, '2020-04-03 00:00:00', '2020-05-28 20:45:50'),
(2, 1, 2, 1, 1, 2, 1, 2, '2020-04-03 13:34:26', '2020-05-28 20:39:00'),
(3, 1, 4, 2, 1, 3, 1, 4, '2020-04-05 11:21:16', '2020-06-01 17:12:28'),
(4, 1, 5, 2, 2, 4, 1, 5, '2020-04-05 12:31:21', '2020-06-02 00:01:59'),
(5, 1, 6, 1, 2, 2, 1, 7, '2020-04-17 11:16:39', '2020-05-23 17:26:19'),
(6, 1, 7, 2, 2, 2, 1, 9, '2020-04-17 12:31:05', '2020-05-23 17:26:13'),
(7, 1, 8, 2, 2, 2, 1, 10, '2020-04-18 17:44:11', '2020-05-23 17:26:09'),
(8, 1, 9, 2, 2, 2, 1, 11, '2020-04-19 10:57:49', '2020-05-23 17:26:05'),
(9, 1, 10, 2, 2, 2, 1, 12, '2020-04-22 12:40:33', '2020-05-23 17:26:01'),
(10, 1, 11, 2, 2, 2, 1, 13, '2020-04-23 11:30:26', '2020-05-23 17:25:57'),
(11, 1, 12, 2, 2, 2, 1, 14, '2020-04-25 09:56:36', '2020-05-23 17:25:52'),
(12, 1, 13, 2, 2, 2, 1, 15, '2020-04-28 12:49:00', '2020-05-23 17:25:48'),
(13, 1, 14, 2, 2, 2, 1, 16, '2020-04-28 14:14:44', '2020-05-23 17:25:42'),
(14, 2, 1, 2, 1, 1, 2, 1, '2020-04-29 12:04:19', '2020-05-24 18:14:23'),
(15, 1, 2, 2, 2, 2, 2, 9, '2020-04-29 12:06:11', NULL),
(16, 1, 3, 2, 2, 2, 2, 10, '2020-04-29 12:06:51', NULL),
(17, 1, 4, 2, 2, 2, 2, 11, '2020-04-29 12:07:32', NULL),
(18, 1, 5, 1, 1, 2, 2, 2, '2020-04-29 12:08:02', NULL),
(19, 1, 6, 2, 2, 2, 2, 12, '2020-04-29 12:08:44', NULL),
(20, 1, 7, 2, 2, 2, 2, 13, '2020-04-29 12:09:11', NULL),
(21, 1, 8, 2, 2, 2, 2, 14, '2020-04-29 12:09:28', NULL),
(22, 1, 9, 2, 2, 2, 2, 15, '2020-04-29 12:10:17', NULL),
(23, 2, 10, 2, 2, 2, 2, 16, '2020-04-29 12:10:44', NULL),
(24, 1, 11, 2, 1, 3, 2, 4, '2020-04-29 12:11:23', '2020-05-24 18:12:33'),
(25, 1, 3, 1, 1, 2, 1, 17, '2020-05-01 12:07:29', '2020-06-02 00:01:34'),
(26, 1, 15, 2, 2, 2, 1, 18, '2020-05-04 10:58:17', NULL),
(27, 1, 16, 2, 2, 2, 1, 19, '2020-05-04 12:57:51', NULL),
(28, 1, 17, 2, 2, 2, 1, 20, '2020-05-05 11:52:49', NULL),
(29, 1, 18, 2, 2, 2, 1, 21, '2020-05-05 11:53:17', NULL),
(30, 1, 19, 2, 2, 2, 1, 22, '2020-05-05 11:54:03', NULL),
(31, 1, 12, 1, 1, 2, 2, 17, '2020-05-07 00:00:00', NULL),
(32, 1, 13, 2, 2, 2, 2, 18, '2020-05-07 00:00:00', NULL),
(33, 1, 14, 2, 2, 2, 2, 19, '2020-05-07 00:00:00', NULL),
(34, 1, 15, 2, 2, 2, 2, 20, '2020-05-07 00:00:00', NULL),
(35, 1, 16, 2, 2, 2, 2, 21, '2020-05-07 00:00:00', NULL),
(36, 1, 17, 2, 2, 2, 2, 22, '2020-05-07 00:00:00', NULL),
(37, 1, 21, 1, 1, 4, 1, 23, '2020-05-08 11:55:11', '2020-05-23 17:28:46'),
(38, 1, 20, 2, 2, 4, 1, 24, '2020-05-08 12:43:11', '2020-05-23 17:28:46'),
(39, 1, 22, 2, 2, 4, 1, 25, '2020-05-16 22:22:19', NULL),
(40, 1, 18, 1, 1, 4, 2, 23, '2020-05-19 19:17:43', NULL),
(41, 2, 1, 2, 2, 4, 3, 25, '2020-05-19 19:17:43', NULL),
(42, 2, 1, 2, 2, 4, 4, 25, '2020-05-19 19:17:43', '2020-05-21 23:39:30'),
(43, 2, 1, 2, 2, 4, 5, 25, '2020-05-19 19:17:43', NULL),
(44, 1, 23, 2, 2, 4, 1, 26, '2020-05-16 22:22:19', NULL),
(45, 2, 19, 2, 2, 4, 2, 26, '2020-05-16 22:22:19', NULL),
(46, 2, 2, 2, 2, 4, 3, 26, '2020-05-16 22:22:19', NULL),
(47, 2, 2, 2, 2, 4, 4, 26, '2020-05-16 22:22:19', NULL),
(48, 2, 2, 2, 2, 4, 5, 26, '2020-05-16 22:22:19', NULL),
(49, 1, 24, 2, 2, 4, 1, 27, '2020-05-16 22:22:19', NULL),
(50, 1, 20, 2, 2, 4, 2, 27, '2020-05-16 22:22:19', NULL),
(51, 2, 3, 2, 2, 4, 3, 27, '2020-05-16 22:22:19', NULL),
(52, 2, 3, 2, 2, 4, 4, 27, '2020-05-16 22:22:19', NULL),
(53, 2, 3, 2, 2, 4, 5, 27, '2020-05-16 22:22:19', NULL),
(54, 1, 25, 2, 2, 4, 1, 28, '2020-05-16 22:22:19', NULL),
(55, 1, 21, 2, 2, 4, 2, 28, '2020-05-16 22:22:19', '2020-05-21 23:39:06'),
(56, 2, 4, 2, 2, 4, 3, 28, '2020-05-16 22:22:19', NULL),
(57, 2, 4, 2, 2, 4, 4, 28, '2020-05-16 22:22:19', NULL),
(58, 2, 4, 2, 2, 4, 5, 28, '2020-05-19 19:17:43', NULL),
(59, 1, 26, 2, 2, 4, 1, 29, '2020-05-21 12:52:42', '2020-06-01 17:11:59'),
(60, 2, 22, 2, 2, 4, 2, 29, '2020-05-21 12:52:42', '2020-05-22 01:43:08'),
(61, 2, 5, 2, 2, 4, 3, 29, '2020-05-21 12:52:42', '2020-05-22 02:40:16'),
(62, 2, 5, 2, 2, 4, 4, 29, '2020-05-21 12:52:42', NULL),
(63, 2, 5, 2, 2, 4, 5, 29, '2020-05-21 12:52:42', NULL),
(64, 1, 6, 2, 1, 1, 3, 1, '2020-05-21 00:00:00', NULL),
(65, 1, 7, 1, 1, 2, 3, 2, '2020-05-21 00:00:00', NULL),
(66, 1, 8, 2, 1, 3, 3, 4, '2020-05-21 00:00:00', NULL),
(67, 1, 27, 2, 2, 4, 1, 30, '2020-05-22 09:48:29', NULL),
(68, 2, 23, 2, 2, 4, 2, 30, '2020-05-22 09:48:29', NULL),
(69, 2, 9, 2, 2, 4, 3, 30, '2020-05-22 09:48:29', NULL),
(70, 2, 6, 2, 2, 4, 4, 30, '2020-05-22 09:48:29', NULL),
(71, 2, 6, 2, 2, 4, 5, 30, '2020-05-22 09:48:29', NULL),
(72, 1, 28, 2, 2, 4, 1, 31, '2020-05-22 10:24:39', NULL),
(73, 2, 24, 2, 2, 4, 2, 31, '2020-05-22 10:24:39', NULL),
(74, 2, 10, 2, 2, 4, 3, 31, '2020-05-22 10:24:39', NULL),
(75, 2, 7, 2, 2, 4, 4, 31, '2020-05-22 10:24:39', NULL),
(76, 2, 7, 2, 2, 4, 5, 31, '2020-05-22 10:24:39', NULL),
(77, 1, 29, 2, 2, 4, 1, 32, '2020-05-23 10:56:36', NULL),
(78, 2, 25, 2, 2, 4, 2, 32, '2020-05-23 10:56:36', NULL),
(79, 2, 11, 2, 2, 4, 3, 32, '2020-05-23 10:56:36', NULL),
(80, 2, 8, 2, 2, 4, 4, 32, '2020-05-23 10:56:36', NULL),
(81, 2, 8, 2, 2, 4, 5, 32, '2020-05-23 10:56:36', NULL),
(82, 1, 30, 2, 2, 4, 1, 33, '2020-05-24 19:06:27', NULL),
(83, 2, 26, 2, 2, 4, 2, 33, '2020-05-24 12:23:37', NULL),
(84, 2, 12, 2, 2, 4, 3, 33, '2020-05-24 12:23:37', NULL),
(85, 2, 9, 2, 2, 4, 4, 33, '2020-05-24 12:23:37', NULL),
(86, 2, 9, 2, 2, 4, 5, 33, '2020-05-24 12:23:37', NULL),
(87, 1, 31, 2, 2, 4, 1, 3, '2020-05-25 00:16:33', NULL),
(88, 1, 32, 2, 2, 4, 1, 6, '2020-05-25 00:16:33', NULL),
(89, 1, 33, 2, 2, 4, 1, 8, '2020-05-25 00:16:33', NULL),
(90, 1, 27, 2, 2, 4, 2, 3, '2020-05-25 00:16:33', NULL),
(91, 1, 28, 2, 2, 4, 2, 5, '2020-05-25 00:16:33', NULL),
(92, 1, 29, 2, 2, 4, 2, 6, '2020-05-25 00:16:33', NULL),
(93, 1, 30, 2, 2, 4, 2, 7, '2020-05-25 00:16:33', NULL),
(94, 1, 31, 2, 2, 4, 2, 8, '2020-05-25 00:16:33', NULL),
(95, 2, 32, 2, 2, 4, 2, 24, '2020-05-25 00:16:33', NULL),
(96, 1, 33, 2, 2, 4, 2, 25, '2020-05-25 00:16:33', NULL),
(97, 1, 13, 2, 2, 4, 3, 3, '2020-05-25 00:16:34', NULL),
(98, 1, 14, 2, 2, 4, 3, 5, '2020-05-25 00:16:34', NULL),
(99, 1, 15, 2, 2, 4, 3, 6, '2020-05-25 00:16:34', NULL),
(100, 1, 16, 2, 2, 4, 3, 7, '2020-05-25 00:16:34', NULL),
(101, 1, 17, 2, 2, 4, 3, 8, '2020-05-25 00:16:34', NULL),
(102, 2, 18, 2, 2, 4, 3, 9, '2020-05-25 00:16:34', NULL),
(103, 2, 19, 2, 2, 4, 3, 10, '2020-05-25 00:16:34', NULL),
(104, 2, 20, 2, 2, 4, 3, 11, '2020-05-25 00:16:34', NULL),
(105, 2, 21, 2, 2, 4, 3, 12, '2020-05-25 00:16:34', NULL),
(106, 2, 22, 2, 2, 4, 3, 13, '2020-05-25 00:16:34', NULL),
(107, 2, 23, 2, 2, 4, 3, 14, '2020-05-25 00:16:34', NULL),
(108, 2, 24, 2, 2, 4, 3, 15, '2020-05-25 00:16:34', NULL),
(109, 2, 25, 2, 2, 4, 3, 16, '2020-05-25 00:16:34', NULL),
(110, 2, 26, 2, 2, 4, 3, 17, '2020-05-25 00:16:34', NULL),
(111, 2, 27, 2, 2, 4, 3, 18, '2020-05-25 00:16:34', NULL),
(112, 2, 28, 2, 2, 4, 3, 19, '2020-05-25 00:16:34', NULL),
(113, 2, 29, 2, 2, 4, 3, 20, '2020-05-25 00:16:34', NULL),
(114, 2, 30, 2, 2, 4, 3, 21, '2020-05-25 00:16:34', NULL),
(115, 2, 31, 2, 2, 4, 3, 22, '2020-05-25 00:16:34', NULL),
(116, 2, 32, 2, 2, 4, 3, 23, '2020-05-25 00:16:34', NULL),
(117, 2, 33, 2, 2, 4, 3, 24, '2020-05-25 00:16:34', NULL),
(118, 2, 10, 2, 2, 4, 4, 1, '2020-05-25 00:16:34', NULL),
(119, 2, 11, 2, 2, 4, 4, 2, '2020-05-25 00:16:34', NULL),
(120, 1, 12, 2, 2, 4, 4, 3, '2020-05-25 00:16:35', NULL),
(121, 1, 13, 2, 2, 4, 4, 4, '2020-05-25 00:16:35', NULL),
(122, 1, 14, 2, 2, 4, 4, 5, '2020-05-25 00:16:35', NULL),
(123, 1, 15, 2, 2, 4, 4, 6, '2020-05-25 00:16:35', NULL),
(124, 1, 16, 2, 2, 4, 4, 7, '2020-05-25 00:16:35', NULL),
(125, 1, 17, 2, 2, 4, 4, 8, '2020-05-25 00:16:35', NULL),
(126, 2, 18, 2, 2, 4, 4, 9, '2020-05-25 00:16:35', NULL),
(127, 2, 19, 2, 2, 4, 4, 10, '2020-05-25 00:16:35', NULL),
(128, 2, 20, 2, 2, 4, 4, 11, '2020-05-25 00:16:35', NULL),
(129, 2, 21, 2, 2, 4, 4, 12, '2020-05-25 00:16:35', NULL),
(130, 2, 22, 2, 2, 4, 4, 13, '2020-05-25 00:16:35', NULL),
(131, 2, 23, 2, 2, 4, 4, 14, '2020-05-25 00:16:35', NULL),
(132, 2, 24, 2, 2, 4, 4, 15, '2020-05-25 00:16:35', NULL),
(133, 2, 25, 2, 2, 4, 4, 16, '2020-05-25 00:16:35', NULL),
(134, 2, 26, 2, 2, 4, 4, 17, '2020-05-25 00:16:35', NULL),
(135, 2, 27, 2, 2, 4, 4, 18, '2020-05-25 00:16:35', NULL),
(136, 2, 28, 2, 2, 4, 4, 19, '2020-05-25 00:16:35', NULL),
(137, 2, 29, 2, 2, 4, 4, 20, '2020-05-25 00:16:35', NULL),
(138, 2, 30, 2, 2, 4, 4, 21, '2020-05-25 00:16:35', NULL),
(139, 2, 31, 2, 2, 4, 4, 22, '2020-05-25 00:16:35', NULL),
(140, 2, 32, 2, 2, 4, 4, 23, '2020-05-25 00:16:35', NULL),
(141, 2, 33, 2, 2, 4, 4, 24, '2020-05-25 00:16:35', NULL),
(142, 2, 10, 2, 2, 4, 5, 1, '2020-05-25 00:16:36', NULL),
(143, 2, 11, 2, 2, 4, 5, 2, '2020-05-25 00:16:36', NULL),
(144, 1, 12, 2, 2, 4, 5, 3, '2020-05-25 00:16:36', NULL),
(145, 1, 13, 2, 2, 4, 5, 4, '2020-05-25 00:16:36', NULL),
(146, 1, 14, 2, 2, 4, 5, 5, '2020-05-25 00:16:36', NULL),
(147, 1, 15, 2, 2, 4, 5, 6, '2020-05-25 00:16:36', NULL),
(148, 1, 16, 2, 2, 4, 5, 7, '2020-05-25 00:16:36', NULL),
(149, 1, 17, 2, 2, 4, 5, 8, '2020-05-25 00:16:36', NULL),
(150, 2, 18, 2, 2, 4, 5, 9, '2020-05-25 00:16:36', NULL),
(151, 2, 19, 2, 2, 4, 5, 10, '2020-05-25 00:16:36', NULL),
(152, 2, 20, 2, 2, 4, 5, 11, '2020-05-25 00:16:36', NULL),
(153, 2, 21, 2, 2, 4, 5, 12, '2020-05-25 00:16:36', NULL),
(154, 2, 22, 2, 2, 4, 5, 13, '2020-05-25 00:16:36', NULL),
(155, 2, 23, 2, 2, 4, 5, 14, '2020-05-25 00:16:36', NULL),
(156, 2, 24, 2, 2, 4, 5, 15, '2020-05-25 00:16:36', NULL),
(157, 2, 25, 2, 2, 4, 5, 16, '2020-05-25 00:16:36', NULL),
(158, 2, 26, 2, 2, 4, 5, 17, '2020-05-25 00:16:36', NULL),
(159, 2, 27, 2, 2, 4, 5, 18, '2020-05-25 00:16:36', NULL),
(160, 2, 28, 2, 2, 4, 5, 19, '2020-05-25 00:16:36', NULL),
(161, 2, 29, 2, 2, 4, 5, 20, '2020-05-25 00:16:36', NULL),
(162, 2, 30, 2, 2, 4, 5, 21, '2020-05-25 00:16:36', NULL),
(163, 2, 31, 2, 2, 4, 5, 22, '2020-05-25 00:16:36', NULL),
(164, 2, 32, 2, 2, 4, 5, 23, '2020-05-25 00:16:36', NULL),
(165, 2, 33, 2, 2, 4, 5, 24, '2020-05-25 00:16:37', NULL),
(166, 2, 1, 2, 2, 4, 6, 1, '2020-05-25 00:16:37', NULL),
(167, 2, 2, 2, 2, 4, 6, 2, '2020-05-25 00:16:37', NULL),
(168, 1, 3, 2, 2, 4, 6, 3, '2020-05-25 00:16:37', NULL),
(169, 1, 4, 2, 2, 4, 6, 4, '2020-05-25 00:16:37', NULL),
(170, 1, 5, 2, 2, 4, 6, 5, '2020-05-25 00:16:37', NULL),
(171, 1, 6, 2, 2, 4, 6, 6, '2020-05-25 00:16:37', NULL),
(172, 1, 7, 2, 2, 4, 6, 7, '2020-05-25 00:16:37', NULL),
(173, 1, 8, 2, 2, 4, 6, 8, '2020-05-25 00:16:37', NULL),
(174, 2, 9, 2, 2, 4, 6, 9, '2020-05-25 00:16:37', NULL),
(175, 2, 10, 2, 2, 4, 6, 10, '2020-05-25 00:16:37', NULL),
(176, 2, 11, 2, 2, 4, 6, 11, '2020-05-25 00:16:37', NULL),
(177, 2, 12, 2, 2, 4, 6, 12, '2020-05-25 00:16:37', NULL),
(178, 2, 13, 2, 2, 4, 6, 13, '2020-05-25 00:16:38', NULL),
(179, 2, 14, 2, 2, 4, 6, 14, '2020-05-25 00:16:38', NULL),
(180, 2, 15, 2, 2, 4, 6, 15, '2020-05-25 00:16:38', NULL),
(181, 2, 16, 2, 2, 4, 6, 16, '2020-05-25 00:16:38', NULL),
(182, 2, 17, 2, 2, 4, 6, 17, '2020-05-25 00:16:38', NULL),
(183, 2, 18, 2, 2, 4, 6, 18, '2020-05-25 00:16:38', NULL),
(184, 2, 19, 2, 2, 4, 6, 19, '2020-05-25 00:16:38', NULL),
(185, 2, 20, 2, 2, 4, 6, 20, '2020-05-25 00:16:38', NULL),
(186, 2, 21, 2, 2, 4, 6, 21, '2020-05-25 00:16:38', NULL),
(187, 2, 22, 2, 2, 4, 6, 22, '2020-05-25 00:16:38', NULL),
(188, 2, 23, 2, 2, 4, 6, 23, '2020-05-25 00:16:38', NULL),
(189, 2, 24, 2, 2, 4, 6, 24, '2020-05-25 00:16:38', NULL),
(190, 1, 25, 2, 2, 4, 6, 25, '2020-05-25 00:16:38', NULL),
(191, 1, 26, 2, 2, 4, 6, 26, '2020-05-25 00:16:38', NULL),
(192, 1, 27, 2, 2, 4, 6, 27, '2020-05-25 00:16:38', NULL),
(193, 2, 28, 2, 2, 4, 6, 28, '2020-05-25 00:16:38', NULL),
(194, 2, 29, 2, 2, 4, 6, 29, '2020-05-25 00:16:38', NULL),
(195, 2, 30, 2, 2, 4, 6, 30, '2020-05-25 00:16:38', NULL),
(196, 2, 31, 2, 2, 4, 6, 31, '2020-05-25 00:16:38', NULL),
(197, 2, 32, 2, 2, 4, 6, 32, '2020-05-25 00:16:38', NULL),
(198, 2, 33, 2, 2, 4, 6, 33, '2020-05-25 00:16:39', NULL),
(199, 1, 34, 2, 2, 4, 1, 34, '2020-05-28 18:27:47', NULL),
(200, 2, 34, 2, 2, 4, 2, 34, '2020-05-28 16:11:35', NULL),
(201, 2, 34, 2, 2, 4, 3, 34, '2020-05-28 16:11:35', NULL),
(202, 2, 34, 2, 2, 4, 4, 34, '2020-05-28 16:11:35', NULL),
(203, 2, 34, 2, 2, 4, 5, 34, '2020-05-28 16:11:35', NULL),
(204, 1, 35, 1, 1, 4, 1, 35, '2020-05-29 17:20:09', '2020-06-01 17:13:10'),
(205, 1, 36, 2, 2, 4, 1, 36, '2020-05-30 18:08:22', NULL),
(206, 1, 37, 2, 2, 4, 1, 37, '2020-05-31 16:15:33', '2020-06-01 17:10:53'),
(207, 1, 38, 2, 2, 4, 1, 38, '2020-06-01 17:17:08', NULL),
(208, 1, 39, 2, 2, 4, 1, 39, '2020-06-01 19:05:54', NULL),
(209, 1, 40, 2, 2, 4, 1, 40, '2020-06-01 22:14:53', NULL),
(210, 1, 41, 1, 1, 4, 1, 41, '2020-06-02 00:08:29', '2020-06-02 00:47:39'),
(211, 1, 42, 1, 1, 4, 1, 42, '2020-06-02 16:33:02', '2020-06-02 17:14:22'),
(212, 1, 43, 1, 1, 4, 1, 43, '2020-06-03 17:00:25', '2020-06-03 17:01:56'),
(213, 1, 44, 2, 2, 4, 1, 44, '2020-06-03 19:17:48', NULL),
(214, 1, 45, 2, 2, 4, 1, 45, '2020-06-05 16:39:41', NULL),
(215, 1, 46, 2, 2, 4, 1, 46, '2020-06-05 17:14:25', NULL),
(216, 1, 47, 2, 2, 4, 1, 47, '2020-06-05 17:42:13', NULL),
(217, 1, 48, 1, 1, 4, 1, 48, '2020-06-09 16:41:56', '2020-06-09 16:43:09'),
(218, 1, 49, 2, 2, 4, 1, 49, '2020-06-09 17:18:57', NULL),
(219, 1, 50, 2, 2, 4, 1, 50, '2020-06-09 18:28:54', NULL),
(220, 1, 51, 2, 2, 4, 1, 51, '2020-06-09 19:14:48', NULL),
(221, 1, 52, 2, 2, 4, 1, 52, '2020-06-10 00:21:34', NULL),
(222, 1, 53, 2, 2, 4, 1, 53, '2020-06-10 01:08:15', NULL),
(223, 1, 54, 1, 1, 4, 1, 54, '2020-06-10 16:46:26', '2020-06-10 16:46:46'),
(224, 1, 55, 2, 2, 4, 1, 55, '2020-06-10 18:15:17', NULL),
(225, 1, 56, 2, 2, 4, 1, 56, '2020-06-10 19:04:26', NULL),
(226, 1, 57, 2, 2, 4, 1, 57, '2020-06-11 02:36:42', NULL),
(227, 1, 58, 2, 2, 4, 1, 58, '2020-06-11 03:26:31', NULL),
(228, 1, 59, 2, 2, 4, 1, 59, '2020-06-11 03:39:03', NULL),
(229, 1, 60, 1, 1, 4, 1, 60, '2020-06-11 17:29:58', '2020-06-11 17:30:16'),
(230, 1, 61, 2, 2, 4, 1, 61, '2020-06-11 17:59:43', NULL),
(231, 1, 62, 2, 2, 4, 1, 62, '2020-06-11 23:16:51', NULL),
(232, 1, 63, 2, 2, 4, 1, 63, '2020-06-12 00:02:19', NULL),
(233, 1, 64, 2, 2, 4, 1, 64, '2020-06-12 00:51:43', NULL),
(234, 1, 65, 1, 1, 4, 1, 65, '2020-06-12 17:30:14', '2020-06-12 17:30:36'),
(235, 1, 66, 2, 2, 4, 1, 66, '2020-06-12 18:18:07', NULL),
(236, 1, 67, 2, 2, 4, 1, 67, '2020-06-12 18:41:34', NULL),
(237, 1, 68, 2, 2, 4, 1, 68, '2020-06-12 19:23:43', NULL),
(238, 1, 69, 2, 2, 4, 1, 69, '2020-06-12 19:58:10', NULL),
(239, 1, 70, 1, 1, 4, 1, 70, '2020-06-13 16:52:49', '2020-06-13 16:53:19'),
(240, 1, 71, 2, 2, 4, 1, 71, '2020-06-13 17:12:52', NULL),
(241, 1, 72, 2, 2, 4, 1, 72, '2020-06-13 17:43:40', NULL),
(242, 1, 73, 2, 2, 4, 1, 73, '2020-06-13 18:28:22', NULL),
(243, 1, 74, 2, 2, 4, 1, 74, '2020-06-13 19:02:49', NULL),
(244, 1, 75, 1, 1, 5, 1, 75, '2020-06-17 16:57:19', '2020-06-17 17:03:00'),
(245, 1, 76, 2, 2, 4, 1, 76, '2020-06-17 19:11:39', NULL),
(246, 1, 77, 2, 2, 4, 1, 77, '2020-06-18 15:31:07', NULL),
(247, 1, 78, 2, 2, 4, 1, 78, '2020-06-18 15:31:13', NULL),
(248, 1, 79, 2, 2, 4, 1, 79, '2020-06-19 16:42:58', NULL),
(249, 1, 80, 2, 2, 4, 1, 80, '2020-06-19 18:05:25', NULL),
(250, 1, 81, 2, 2, 4, 1, 81, '2020-06-19 18:41:49', NULL),
(251, 1, 82, 1, 1, 5, 1, 82, '2020-06-20 17:09:08', '2020-06-20 17:09:00'),
(252, 1, 83, 1, 1, 5, 1, 83, '2020-06-20 17:57:45', '2020-06-20 17:58:00'),
(253, 1, 84, 1, 1, 5, 1, 84, '2020-06-21 17:14:06', '2020-06-21 17:14:00'),
(254, 1, 85, 2, 2, 4, 1, 85, '2020-06-21 18:53:53', NULL),
(255, 1, 86, 2, 2, 4, 1, 86, '2020-06-23 18:48:32', NULL),
(256, 1, 87, 2, 2, 4, 1, 87, '2020-06-24 18:36:28', NULL),
(257, 1, 88, 2, 2, 4, 1, 88, '2020-06-24 22:40:13', NULL),
(258, 1, 89, 2, 2, 4, 1, 89, '2020-06-24 23:05:39', NULL),
(259, 1, 90, 2, 2, 4, 1, 90, '2020-06-24 23:29:47', NULL),
(260, 1, 91, 1, 1, 5, 1, 91, '2020-06-25 17:34:07', '2020-06-25 17:34:00'),
(261, 1, 92, 2, 2, 4, 1, 92, '2020-06-25 18:17:58', NULL),
(262, 1, 93, 2, 2, 4, 1, 93, '2020-06-25 18:38:38', NULL),
(263, 1, 94, 1, 1, 5, 1, 94, '2020-06-28 16:34:30', '2020-06-28 16:37:00'),
(264, 1, 95, 1, 1, 5, 1, 95, '2020-06-28 17:46:27', '2020-06-28 17:46:00'),
(265, 1, 96, 2, 2, 4, 1, 96, '2020-06-28 18:38:22', NULL),
(266, 1, 97, 2, 2, 4, 1, 97, '2020-06-30 15:32:28', NULL),
(267, 1, 98, 2, 2, 4, 1, 98, '2020-06-30 15:58:15', NULL),
(268, 1, 99, 2, 2, 4, 1, 99, '2020-06-30 16:35:15', NULL),
(269, 1, 100, 1, 1, 5, 1, 100, '2020-06-30 17:16:45', '2020-06-30 17:17:00'),
(270, 1, 101, 2, 2, 4, 1, 101, '2020-06-30 17:52:30', NULL),
(271, 1, 102, 2, 2, 4, 1, 102, '2020-07-01 15:38:57', NULL),
(272, 1, 103, 2, 2, 4, 1, 103, '2020-07-01 15:59:59', NULL),
(273, 1, 104, 2, 2, 4, 1, 104, '2020-07-01 16:46:40', NULL),
(274, 1, 105, 1, 1, 5, 1, 105, '2020-07-01 16:55:45', '2020-07-01 16:56:00'),
(275, 1, 106, 2, 2, 4, 1, 106, '2020-07-01 17:59:13', NULL),
(276, 1, 107, 2, 2, 4, 1, 107, '2020-07-01 18:17:59', NULL),
(277, 1, 108, 2, 2, 4, 1, 108, '2020-07-02 18:05:55', NULL),
(278, 1, 109, 2, 2, 4, 1, 109, '2020-07-02 18:37:41', NULL),
(279, 1, 110, 2, 2, 4, 1, 110, '2020-07-02 19:03:10', NULL),
(280, 1, 111, 1, 1, 5, 1, 111, '2020-07-03 19:39:30', '2020-07-03 19:39:00'),
(281, 1, 112, 2, 2, 4, 1, 112, '2020-07-06 16:40:45', NULL),
(282, 1, 113, 2, 2, 4, 1, 113, '2020-07-06 17:47:53', NULL),
(283, 1, 114, 2, 2, 4, 1, 114, '2020-07-06 23:34:39', NULL),
(284, 1, 115, 2, 2, 4, 1, 115, '2020-07-07 00:09:48', NULL),
(285, 1, 116, 2, 2, 4, 1, 116, '2020-07-07 03:38:48', NULL),
(286, 1, 117, 2, 2, 4, 1, 117, '2020-07-07 03:46:53', NULL),
(287, 1, 118, 1, 1, 5, 1, 118, '2020-07-07 17:35:37', '2020-07-07 17:36:00'),
(288, 1, 119, 2, 2, 4, 1, 119, '2020-07-07 22:55:04', NULL),
(289, 1, 120, 2, 2, 4, 1, 120, '2020-07-07 23:18:33', NULL),
(290, 1, 121, 2, 2, 4, 1, 121, '2020-07-07 23:56:54', NULL),
(291, 1, 122, 2, 2, 4, 1, 122, '2020-07-08 00:13:01', NULL),
(292, 1, 123, 1, 1, 5, 1, 123, '2020-07-08 16:45:21', '2020-07-08 16:45:00'),
(293, 1, 124, 2, 2, 4, 1, 124, '2020-07-08 17:18:44', NULL),
(294, 1, 125, 2, 2, 4, 1, 125, '2020-07-08 17:41:37', NULL),
(295, 1, 126, 2, 2, 4, 1, 126, '2020-07-09 01:18:21', NULL),
(296, 1, 127, 2, 2, 4, 1, 127, '2020-07-09 15:51:17', NULL),
(297, 1, 128, 2, 2, 4, 1, 128, '2020-07-09 16:24:58', NULL),
(298, 1, 129, 1, 1, 5, 1, 129, '2020-07-09 17:05:47', '2020-07-09 17:06:00'),
(299, 1, 130, 2, 2, 4, 1, 130, '2020-07-10 15:04:48', NULL),
(300, 1, 131, 2, 2, 4, 1, 131, '2020-07-10 15:37:42', NULL),
(301, 1, 132, 2, 2, 4, 1, 132, '2020-07-10 16:42:53', NULL),
(302, 1, 133, 2, 2, 4, 1, 133, '2020-07-10 17:15:50', NULL),
(303, 1, 134, 2, 2, 4, 1, 134, '2020-07-14 16:59:22', NULL),
(304, 1, 135, 2, 2, 4, 1, 135, '2020-07-14 17:18:20', NULL),
(305, 1, 136, 2, 2, 4, 1, 136, '2020-07-14 17:48:37', NULL),
(306, 1, 137, 1, 1, 5, 1, 137, '2020-07-17 17:55:20', '2020-07-17 17:55:00'),
(307, 1, 138, 2, 2, 4, 1, 138, '2020-07-19 17:26:35', NULL),
(308, 1, 139, 1, 1, 2, 1, 139, '2020-07-20 16:37:04', '2020-07-20 16:37:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_paginas`
--

CREATE TABLE `adms_paginas` (
  `id` int(11) NOT NULL,
  `controller` varchar(220) NOT NULL,
  `metodo` varchar(220) NOT NULL,
  `menu_controller` varchar(220) NOT NULL,
  `menu_metodo` varchar(220) NOT NULL,
  `nome_pagina` varchar(220) NOT NULL,
  `observacao` text NOT NULL,
  `lib_publica` int(11) NOT NULL DEFAULT 2,
  `icone` varchar(40) DEFAULT NULL,
  `adms_grupo_pagina_id` int(11) NOT NULL,
  `adms_tipos_pagina_id` int(11) NOT NULL,
  `adms_situacao_pagina_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `adms_paginas`
--

INSERT INTO `adms_paginas` (`id`, `controller`, `metodo`, `menu_controller`, `menu_metodo`, `nome_pagina`, `observacao`, `lib_publica`, `icone`, `adms_grupo_pagina_id`, `adms_tipos_pagina_id`, `adms_situacao_pagina_id`, `created`, `modified`) VALUES
(1, 'Home', 'index', 'home', 'index', 'Dashboard', 'Pagina inicial', 2, 'fas fa-tachometer-alt', 1, 1, 1, '2020-04-02 11:40:56', '0000-00-00 00:00:00'),
(2, 'Users', 'listUsers', 'users', 'list-users', 'usuarios', 'Pagina para listar usuarios', 2, 'fas fa-users', 1, 1, 1, '2020-04-03 12:06:53', NULL),
(3, 'Login', 'access', 'login', 'access', 'Acesso', 'Pagina de login', 1, NULL, 7, 1, 1, '2020-04-03 13:54:17', NULL),
(4, 'Login', 'logout', 'login', 'logout', 'Sair', 'Pagina para sair do administrativo', 1, NULL, 7, 1, 1, '2020-04-05 11:18:42', NULL),
(5, 'NewUser', 'registerNewUser', 'newuser', 'register-new-user', 'Novo usuario', 'Pagina para cadastrar novo usuario para acessar o sistema', 1, NULL, 7, 1, 1, '2020-04-05 12:29:00', NULL),
(6, 'ConfirmEmail', 'confirmEmailUser', 'confirmemail', 'confirm-email-user', 'Confirma email', 'Pagina para confirma email de novo usuario', 1, NULL, 7, 1, 1, '2020-04-12 12:52:27', NULL),
(7, 'resetPasssword', 'resetPass', 'reset-passsword', 'reset-pass', 'Recuperar senha', 'Pagina para recuperar senha', 1, NULL, 7, 1, 1, '2020-04-13 11:15:20', NULL),
(8, 'UpdatePassword', 'restorePassword', 'update-password', 'restore-password', 'Atualizar a Senha', 'Página para atualizar a senha', 1, NULL, 7, 1, 1, '2020-04-14 12:47:01', NULL),
(9, 'Profile', 'profileUser', 'profile', 'profile-user', 'Visualizar Perfil', 'Pagina para visualizar perfil', 2, NULL, 5, 1, 1, '2020-04-17 12:27:09', NULL),
(10, 'ModifyPassword', 'modifyPass', 'modify-password', 'modify-pass', 'Alterar Senha', 'Página para alterar senha', 2, NULL, 3, 1, 1, '2020-04-18 17:42:13', NULL),
(11, 'EditProfile', 'editProfileUser', 'edit-profile', 'edit-profile-user', 'Editar Perfil', 'Pagina para editar perfil', 2, NULL, 3, 1, 1, '2020-04-19 10:53:05', NULL),
(12, 'ViewInfoUser', 'detailInfoUser', 'view-info-user', 'detail-info-user', 'Visualizar Usuario', 'Página para visualizar detalhes do usuario', 2, NULL, 5, 1, 1, '2020-04-22 12:37:49', NULL),
(13, 'EditPassword', 'editPass', 'edit-password', 'edit-pass', 'Editar Senha', 'Pagina para o administrador editar senha dos usuarios', 2, NULL, 3, 1, 1, '2020-04-23 11:28:29', NULL),
(14, 'EditUser', 'editInfoUser', 'edit-user', 'edit-info-user', 'Editar Usuario', 'Pagina para editar usuario', 2, NULL, 3, 1, 1, '2020-04-25 09:54:52', NULL),
(15, 'RegisterNewUser', 'registerInfoUser', 'register-new-user', 'register-info-user', 'Cadastrar Usuario', 'Pagina para castrar novo usuario', 2, NULL, 2, 1, 1, '2020-04-28 12:47:13', NULL),
(16, 'DeleteUser', 'removeUser', 'delete-user', 'remove-user', 'Apagar usuario', 'Pagina para apagar usuario', 2, NULL, 4, 1, 1, '2020-04-28 14:12:47', NULL),
(17, 'AccessLevel', 'listAccess', 'access-level', 'list-access', 'Nivel de Acesso', 'Pagina para Listar Niveis de Acesso', 2, 'fas fa-key', 1, 1, 1, '2020-05-01 12:01:57', NULL),
(18, 'RegisterLevelAccess', 'registerAccess', 'register-level-access', 'register-access', 'Cadastrar Nível de Acesso', 'Pagina para cadastrar niveis de acessos', 2, NULL, 2, 1, 1, '2020-05-04 10:54:58', NULL),
(19, 'ViewLevelAccess', 'detailAccess', 'view-level-access', 'detail-access', 'Detalhes de nivel de acesso', 'Pagina para ver detalhes do Nivel de Acesso', 2, NULL, 5, 1, 1, '2020-05-04 12:53:43', NULL),
(20, 'EditLevelAccess', 'editAccess', 'edit-level-access', 'edit-access', 'Editar Nivel de Acesso', 'Pagina para editar nivel de acesso', 2, NULL, 3, 1, 1, '2020-05-05 11:45:32', NULL),
(21, 'DeleteLevelAccess', 'removeAcess', 'delete-level-access', 'remove-acess', 'Deletar nivel de acesso', 'Pagina para deletar nivel de acesso', 2, NULL, 4, 1, 1, '2020-05-07 10:10:04', NULL),
(22, 'ModifyOrderAccess', 'modifyOrderAcc', 'modify-order-access', 'modify-orderAcc', 'Alterar Ordem Nivel de Acesso', 'Pagina para alterar ordem de nivel de acesso', 2, NULL, 8, 1, 1, '2020-05-07 10:14:03', NULL),
(23, 'ListPage', 'listPages', 'list-page', 'list-pages', 'Listar Paginas', 'Pagina para listar paginas do administrativo', 2, 'fas fa-file-alt', 2, 1, 1, '2020-05-08 11:50:38', '2020-05-19 18:28:27'),
(24, 'RegisterNewPage', 'registerInfoPage', 'register-new-page', 'register-info-page', 'Cadastrar Pagina', 'Pagina para cadastrar novas paginas', 2, '', 2, 1, 1, '2020-05-08 12:40:50', NULL),
(25, 'ViewInfoPage', 'detailInfoPage', 'view-info-page', 'detail-info-page', 'Visualizar Pagina', 'Pagina para visualizar pagina', 1, '', 5, 1, 1, '2020-05-16 22:35:19', NULL),
(26, 'EditPage', 'editInfoPage', 'edit-page', 'edit-info-page', 'Editar Pagina', 'Pagina para editar pagina', 1, '', 3, 1, 1, '2020-05-17 03:13:00', '2020-05-18 19:01:59'),
(27, 'DeletePage', 'removePage', 'delete-page', 'remove-page', 'Apagar Pagina', 'Pagina para apagar pagina', 1, '', 4, 1, 1, '2020-05-18 20:26:06', NULL),
(28, 'Permission', 'listPermission', 'permission', 'list-permission', 'Permissoes', 'Pagina para listar permissoes do nivel de acesso', 2, '', 1, 1, 1, '2020-05-19 17:52:54', '2020-05-20 22:01:06'),
(29, 'releasePermission', 'liberatePermission', 'release-permission', 'liberate-permission', 'Liberar Permissao', 'pagina para liberar permissao', 2, '', 3, 1, 1, '2020-05-21 12:52:42', NULL),
(30, 'ReleaseMenu', 'liberateMenu', 'release-menu', 'liberate-menu', 'Liberar no menu', 'pagina para liberar ou bloquear a pagina no menu', 2, NULL, 3, 1, 1, '2020-05-22 09:48:29', NULL),
(31, 'ReleaseDropdown', 'liberateDropdown', 'release-dropdown', 'liberate-dropdown', 'Liberar Dropdown', 'Pagina para liberar ou bloquear a pagina a ser apresentado como dropdown no menu', 2, NULL, 3, 1, 1, '2020-05-22 10:24:39', NULL),
(32, 'ModifyOrderMenu', 'alterOrderMenu', 'modify-order-menu', 'alter-order-menu', 'Alterar Ordem Menu', 'Pagina para alterar a ordem das paginas no menu', 2, NULL, 3, 1, 1, '2020-05-23 10:56:36', NULL),
(33, 'SynchronizeLevelAccessPage', 'synchronizeAccessPg', 'synchronize-level-access-page', 'synchronize-access-pg', 'Sincronizar Permissoes', 'Pagina para sincronizar as permissoes de acesso a cada nivel de acesso para as paginas do sistema', 2, '', 3, 1, 1, '2020-05-24 19:06:27', NULL),
(34, 'EditLevelAccessPageMenu', 'editAccessPgMenu', 'edit-level-access-page-menu', 'edit-access-pg-menu', 'Editar Item de Menu da Pagina', 'Pagina para editar item de menu que a pagina pertence para um determinado nivel de acesso', 2, '', 3, 1, 1, '2020-05-28 18:27:47', NULL),
(35, 'ListMenu', 'listItensMenu', 'list-menu', 'list-itens-menu', 'Listar Itens do Menu', 'Pagina para listar os itens do menu', 2, 'fab fa-elementor', 1, 1, 1, '2020-05-29 17:20:09', NULL),
(36, 'RegisterNewMenu', 'registerInfoMenu', 'register-new-menu', 'register-info-menu', 'Cadastrar item do Menu', 'Pagina para cadastrar novo item do menu', 2, '', 2, 1, 1, '2020-05-30 18:08:22', NULL),
(37, 'ViewInfoMenu', 'detailInfoMenu', 'view-info-menu', 'detail-info-menu', 'Visualizar Item do Menu', 'Pagina para visualizar detalhes de item do menu', 2, '', 5, 1, 1, '2020-05-31 16:15:32', NULL),
(38, 'EditMenu', 'editInfoMenu', 'edit-menu', 'edit-info-menu', 'Editar Item do Menu', 'Pagina para editar item do menu', 2, '', 3, 1, 1, '2020-06-01 17:17:08', NULL),
(39, 'DeleteMenu', 'removeMenu', 'delete-menu', 'remove-menu', 'Apagar Item do Menu', 'Pagina para apagar item do menu', 2, '', 4, 1, 1, '2020-06-01 19:05:54', NULL),
(40, 'ModifyOrderItemMenu', 'alterOrderItemMenu', 'modify-order-item-menu', 'alter-order-item-menu', 'Alterar Ordem Item do Menu', 'Pagina para alterar ordem do item do menu', 2, '', 8, 1, 1, '2020-06-01 22:14:53', NULL),
(41, 'EditRegisterUserLogin', 'editInfoUserLogin', 'edit-register-user-login', 'edit-info-user-login', 'Editar Cadastro de Login', 'Pagina para editar os dados de login do usuario', 2, 'fas fa-edit', 3, 1, 1, '2020-06-02 00:08:29', NULL),
(42, 'ConfigSendEmail', 'sendEmail', 'config-send-email', 'send-email', 'Configurar Envio de Email', 'Pagina para editar as configurações do envio de email', 2, 'fas fa-at', 3, 1, 1, '2020-06-02 16:33:01', NULL),
(43, 'ListColor', 'listColors', 'list-color', 'list-colors', 'Cores', 'Pagina para listar as cores', 2, 'fas fa-tint', 1, 1, 1, '2020-06-03 17:00:25', '2020-06-13 16:35:28'),
(44, 'ViewInfoColor', 'detailInfoColor', 'view-info-color', 'detail-info-color', 'Visualizar Cor', 'Pagina para visualizar detalhes da cor', 2, '', 5, 1, 1, '2020-06-03 19:17:48', NULL),
(45, 'EditColor', 'editInfoColor', 'edit-color', 'edit-info-color', 'Editar Cor', 'Pagina para editar cor ', 2, '', 3, 1, 1, '2020-06-05 16:39:41', NULL),
(46, 'RegisterNewColor', 'registerInfoColor', 'register-new-color', 'register-info-color', 'cadastrar Cor', 'Pagina para cadastrar nova cor', 2, '', 2, 1, 1, '2020-06-05 17:14:25', NULL),
(47, 'DeleteColor', 'removeColor', 'delete-color', 'remove-color', 'Apagar Cor', 'Pagina para apagar cor', 2, '', 4, 1, 1, '2020-06-05 17:42:13', NULL),
(48, 'ListGroupPage', 'listGroupsPages', 'list-group-page', 'list-groups-pages', 'Grupos de Páginas', 'Listar grupos das paginas', 2, 'fas fa-file-alt', 1, 1, 1, '2020-06-09 16:41:56', '2020-06-13 16:35:03'),
(49, 'ViewInfoGroupPg', 'DetailInfoGroupPg', 'view-info-group-pg', 'detail-info-group-pg', 'Visualizar Grupo da Página', 'Pagina para visualizar grupo da página', 2, '', 5, 1, 1, '2020-06-09 17:18:57', NULL),
(50, 'RegisterNewGroupPg', 'RegisterInfoGroupPg', 'register-new-group-pg', 'register-info-group-pg', 'Cadastrar Grupo de Páginas', 'Página para cadastrar grupo de páginas', 2, '', 2, 1, 1, '2020-06-09 18:28:53', NULL),
(51, 'EditGroupPg', 'editInfoGroupPg', 'edit-group-pg', 'edit-info-group-pg', 'Editar Grupo de Páginas', 'Pagina para editar grupo de páginas', 2, '', 3, 1, 1, '2020-06-09 19:14:47', NULL),
(52, 'DeleteGroupPg', 'removeGroupPg', 'delete-group-pg', 'remove-group-pg', 'Apagar Grupo de Páginas', 'Página para deletar grupo de páginas', 2, '', 4, 1, 1, '2020-06-10 00:21:34', NULL),
(53, 'ModifyOrderGroupPg', 'alterOrderGroupPg', 'modify-order-group-pg', 'alter-order-group-pg', 'Alterar Ordem do Grupo de Páginas', 'Página para alterar a ordem do grupo de páginas', 2, '', 8, 1, 1, '2020-06-10 01:08:15', NULL),
(54, 'ListTypePage', 'listTypesPages', 'list-type-page', 'list-types-pages', 'Tipos de Páginas', 'Página para lista os tipos de páginas', 2, 'fas fa-list-ol', 1, 1, 1, '2020-06-10 16:46:26', '2020-06-13 16:34:12'),
(55, 'RegisterNewTypePage', 'registerInfoTypePage', 'register-new-type-page', 'register-info-type-page', 'cadastrar Tipo de Páginas', 'Página para cadastrar tipo de páginas', 2, '', 2, 1, 1, '2020-06-10 18:15:17', NULL),
(56, 'EditTypePage', 'editInfoTypePage', 'edit-type-page', 'edit-info-type-page', 'Editar Tipo de Páginas', 'Página para editar tipo de página', 2, '', 3, 1, 1, '2020-06-10 19:04:25', NULL),
(57, 'ViewInfoTypePage', 'detailInfoTypePage', 'view-info-type-page', 'detail-info-type-page', 'Visualizar Tipo de Páginas', 'Página para visualizar tipo de páginas', 2, '', 5, 1, 1, '2020-06-11 02:36:42', NULL),
(58, 'DeleteTypePage', 'removeTypePage', 'delete-type-page', 'remove-type-page', 'Apagar Tipo de Páginas', 'Página para apagar tipo de páginas', 2, '', 4, 1, 1, '2020-06-11 03:26:31', NULL),
(59, 'ModifyOrderTypePage', 'alterOrderTypePage', 'modify-order-type-page', 'alter-order-type-page', 'Alterar Ordem do Tipo de Páginas', 'Página para alterar a ordem do tipo de páginas', 2, '', 8, 1, 1, '2020-06-11 03:39:03', NULL),
(60, 'ListSituation', 'listsituations', 'list-situation', 'list-situations', 'Situação', 'Página para listar a situação', 2, 'fas fa-exclamation-triangle', 1, 1, 1, '2020-06-11 17:29:58', NULL),
(61, 'ViewInfoSituation', 'detailInfoSituation', 'view-info-situation', 'detail-info-situation', 'Visualizar Situação', 'Página para visualizar situação', 2, '', 5, 1, 1, '2020-06-11 17:59:43', NULL),
(62, 'RegisterNewSituation', 'registerInfoSituation', 'register-new-situation', 'register-info-situation', 'Cadastrar Situação', 'Página para cadastrar situação', 2, '', 2, 1, 1, '2020-06-11 23:16:51', NULL),
(63, 'EditSituation', 'editInfoSituation', 'edit-situation', 'edit-info-situation', 'Editar Situação', 'Página para editar situação', 2, '', 3, 1, 1, '2020-06-12 00:02:18', NULL),
(64, 'DeleteSituation', 'removeSituation', 'delete-situation', 'remove-situation', 'Apagar Situação', 'Página para apagar situação', 2, '', 4, 1, 1, '2020-06-12 00:51:43', NULL),
(65, 'ListSituationUser', 'listSituationUsers', 'list-situation-user', 'list-situation-users', 'Situação dos Usuários', 'Página para listar a situação dos usuários', 2, 'far fa-id-badge', 1, 1, 1, '2020-06-12 17:30:14', NULL),
(66, 'ViewInfoSituationUser', 'detailInfoSituationUser', 'view-info-situation-user', 'detail-info-situation-user', 'Visualizar Situação Usuário', 'Página para visualizar situação de usuário', 2, '', 5, 1, 1, '2020-06-12 18:18:07', NULL),
(67, 'RegisterNewSituationUser', 'registerInfoSituationUser', 'register-new-situation-user', 'register-info-situation-user', 'Cadastrar Situação Usuário', 'Página para cadastrar situação usuário', 2, '', 2, 1, 1, '2020-06-12 18:41:34', NULL),
(68, 'EditSituationUser', 'editInfoSituationUser', 'edit-situation-user', 'edit-info-situation-user', 'Editar Situação Usuário', 'Página para editar situação usuário', 2, '', 3, 1, 1, '2020-06-12 19:23:43', NULL),
(69, 'DeleteSituationUser', 'removeSituationUser', 'delete-situation-user', 'remove-situation-user', 'Apagar Situação Usuário', 'Página para apagar situação usuário', 2, '', 4, 1, 1, '2020-06-12 19:58:10', NULL),
(70, 'ListSituationPage', 'listSituationPages', 'list-situation-page', 'list-situation-pages', 'Situação de Página', 'Página para listar situação de página', 2, 'fas fa-exclamation', 1, 1, 1, '2020-06-13 16:52:49', NULL),
(71, 'ViewInfoSituationPage', 'detailInfoSituationPage', 'view-info-situation-page', 'detail-info-situation-page', 'Visualizar Situação Página', 'Página para visualizar situação de página', 2, '', 5, 1, 1, '2020-06-13 17:12:52', NULL),
(72, 'RegisterNewSituationPage', 'registerInfoSituationPage', 'register-new-situation-page', 'register-info-situation-page', 'Cadastrar Situação de Página', 'Página para cadastrar situação de páginas', 2, '', 2, 1, 1, '2020-06-13 17:43:40', NULL),
(73, 'EditSituationPage', 'editInfoSituationPage', 'edit-situation-page', 'edit-info-situation-page', 'Editar Situação de Página', 'Página para editar situação de página', 2, '', 3, 1, 1, '2020-06-13 18:28:22', NULL),
(74, 'DeleteSituationPage', 'removeSituationPage', 'delete-situation-page', 'remove-situation-page', 'Apagar Situação de Página', 'Página para apagar situação de página', 2, '', 4, 1, 1, '2020-06-13 19:02:49', NULL),
(75, 'ListCarousel', 'listCarousels', 'list-carousel', 'list-carousels', 'Carousel', 'Página para listar carousel', 2, 'fas fa-sliders-h', 1, 2, 1, '2020-06-17 16:57:19', NULL),
(76, 'ViewInfoCarousel', 'detailInfoCarousel', 'view-info-carousel', 'detail-info-carousel', 'Visualizar Carousel', 'Página para visualizar slide do carousel', 2, '', 5, 2, 1, '2020-06-17 19:11:39', NULL),
(77, 'RegisterNewCarousel', 'registerInfoCarousel', 'register-new-carousel', 'register-info-carousel', 'Cadastrar Carousel', 'Página para cadastrar slide de carousel', 2, '', 2, 2, 1, '2020-06-18 15:31:06', NULL),
(78, 'EditCarousel', 'editInfoCarousel', 'edit-carousel', 'edit-info-carousel', 'Editar Carousel', 'Página para editar slide de carousel', 2, '', 3, 2, 1, '2020-06-18 15:31:12', NULL),
(79, 'DeleteCarousel', 'removeCarousel', 'delete-carousel', 'remove-carousel', 'Apagar Carousel', 'Página para apagar slide do carousel', 2, '', 4, 2, 1, '2020-06-19 16:42:58', NULL),
(80, 'ModifyOrderCarousel', 'alterOrderCarousel', 'modify-order-carousel', 'alter-order-carousel', 'Alterar Ordem do Carousel', 'Página para alterar ordem do carousel', 2, '', 8, 2, 1, '2020-06-19 18:05:25', NULL),
(81, 'ModifySituationCarousel', 'alterSituationCarousel', 'modify-situation-carousel', 'alter-situation-carousel', 'Alterar Situação Carousel', 'Página para alterar situação do slide carousel', 2, '', 6, 2, 1, '2020-06-19 18:41:49', NULL),
(82, 'EditService', 'editInfoServices', 'edit-service', 'edit-info-services', 'Editar Serviço', 'Página para editar os serviços do site', 2, 'fas fa-wrench', 3, 2, 1, '2020-06-20 17:09:07', NULL),
(83, 'EditVideo', 'editInfoVideo', 'edit-video', 'edit-info-video', 'Editar Vídeo', 'Página para editar informações da área de vídeo do site', 2, 'fas fa-video', 3, 2, 1, '2020-06-20 17:57:45', NULL),
(84, 'ListSobCompany', 'listInfoCompany', 'list-sob-company', 'list-info-company', 'Sobre Empresa', 'Página para listar os registros sobre empresa', 2, 'fas fa-newspaper', 1, 2, 1, '2020-06-21 17:14:06', NULL),
(85, 'ViewInfoSobCompany', 'detailInfoSobCompany', 'view-info-sob-company', 'detail-info-sob-company', 'Visualizar Sobre Empresa', 'Página para visualizar informações sobre a empresa', 2, '', 5, 2, 1, '2020-06-21 18:53:53', NULL),
(86, 'RegisterNewSobCompany', 'registerInfoSobCompany', 'register-new-sob-company', 'register-info-sob-company', 'Cadastrar Sobre Empresa', 'Página para cadastrar informações sobre empresa', 2, '', 2, 2, 1, '2020-06-23 18:48:30', NULL),
(87, 'EditSobCompany', 'editInfoSobCompany', 'edit-sob-company', 'edit-info-sob-company', 'Editar Sobre Empresa', 'Página para editar informações sobre empresa do site', 2, '', 3, 2, 1, '2020-06-24 18:36:28', NULL),
(88, 'ModifyOrderSobCompany', 'alterOrderSobCompany', 'modify-order-sob-company', 'alter-order-sob-company', 'Alterar Ordem Sobre Empresa', 'Página pra alterar a ordem de apresentação do sobre empresa', 2, '', 8, 2, 1, '2020-06-24 22:40:13', NULL),
(89, 'ModifySituationSobCompany', 'alterSituationSobCompany', 'modify-situation-sob-company', 'alter-situation-sob-company', 'Alterar Situação Sobre Empresa', 'Página para alterar a situação de informações sobre empresa', 2, '', 8, 2, 1, '2020-06-24 23:05:39', NULL),
(90, 'DeleteSobCompany', 'removeSobCompany', 'delete-sob-company', 'remove-sob-company', 'Apagar Sobre Empresa', 'Página para deletar informações do tópico sobre empresa', 2, '', 4, 2, 1, '2020-06-24 23:29:47', NULL),
(91, 'ListContact', 'listInfoContact', 'list-contact', 'list-info-contact', 'Contato', 'Página para listar as mensagens enviadas de contato', 2, 'far fa-envelope', 1, 2, 1, '2020-06-25 17:34:06', NULL),
(92, 'ViewInfoContact', 'detailInfoContact', 'view-info-contact', 'detail-info-contact', 'Visualizar Mensagem Contato', 'Página para visualizar mensagem envida de contato', 2, '', 5, 2, 1, '2020-06-25 18:17:58', NULL),
(93, 'DeleteContact', 'removeContact', 'delete-contact', 'remove-contact', 'Apagar Mensagem Contato', 'Página para deletar mensagem envida de contato', 2, '', 4, 2, 1, '2020-06-25 18:38:38', NULL),
(94, 'EditAboutArticles', 'editInfoArticles', 'edit-about-articles', 'edit-info-articles', 'Editar Sobre Artigos', 'Página para editar informações sobre artigos do site', 2, 'fas fa-user-circle', 3, 2, 1, '2020-06-28 16:34:30', NULL),
(95, 'ListRobots', 'listInfoRobots', 'list-robots', 'list-info-robots', 'Robots', 'Página para listar robots das páginas do site', 2, 'fas fa-search', 1, 2, 1, '2020-06-28 17:46:27', NULL),
(96, 'ViewInfoRobots', 'detailInfoRobots', 'view-info-robots', 'detail-info-robots', 'Visualizar Robots', 'Página para visualizar robots das páginas do site', 2, '', 5, 2, 1, '2020-06-28 18:38:21', NULL),
(97, 'RegisterNewRobots', 'registerInfoRobots', 'register-new-robots', 'register-info-robots', 'Cadastrar Robots', 'Página para cadastrar robots do site', 2, '', 2, 2, 1, '2020-06-30 15:32:28', NULL),
(98, 'EditRobots', 'editInfoRobots', 'edit-robots', 'edit-info-robots', 'Editar Robots', 'Página para editar robots do site', 2, '', 3, 2, 1, '2020-06-30 15:58:14', NULL),
(99, 'DeleteRobots', 'removeRobots', 'delete-robots', 'remove-robots', 'Apagar Robots', 'Página para deletar robots de páginas do site', 2, '', 4, 2, 1, '2020-06-30 16:35:15', NULL),
(100, 'ListTypeArticle', 'listInfoTypeArticle', 'list-type-article', 'list-info-type-article', 'Tipo de Artigo', 'Página pra listar tipo do site', 2, 'far fa-clipboard', 1, 2, 1, '2020-06-30 17:16:45', NULL),
(101, 'RegisterNewTypeArticle', 'registerInfoTypeArticle', 'register-new-type-article', 'register-info-type-article', 'Cadastrar Tipo de Artigo', 'Página para cadastrar tipo de artigo do site', 2, '', 2, 2, 1, '2020-06-30 17:52:30', '2020-06-30 17:58:38'),
(102, 'ViewInfoTypeArticle', 'detailInfoTypeArticle', 'view-info-type-article', 'detail-info-type-article', 'Visualizar Tipo de Artigo', 'Página para visualizar tipo de artigo do site', 2, '', 5, 2, 1, '2020-07-01 15:38:56', NULL),
(103, 'EditTypeArticle', 'editInfoTypeArticle', 'edit-type-article', 'edit-info-type-article', 'Editar Tipo de Artigo', 'Página para editar tipo de artigo', 2, '', 3, 2, 1, '2020-07-01 15:59:59', '2020-07-01 16:12:15'),
(104, 'DeleteTypeArticle', 'removeTypeArticle', 'delete-type-article', 'remove-type-article', 'Apagar Tipo de Artigo', 'Página para deletar tipo de artigo', 2, '', 4, 2, 1, '2020-07-01 16:46:40', NULL),
(105, 'ListCategoryArticle', 'listInfoCategoryArticle', 'list-category-article', 'list-info-category-article', 'Categoria de Artigo', 'Página para listar categoria de artigo do site', 2, 'fas fa-clipboard-list', 1, 2, 1, '2020-07-01 16:55:45', NULL),
(106, 'ViewInfoCategoryArticle', 'detailInfoCategoryArticle', 'view-info-category-article', 'detail-info-category-article', 'Visualizar Categoria de Artigo', 'Página para visualizar categoria de artigo do site', 2, '', 5, 2, 1, '2020-07-01 17:59:13', NULL),
(107, 'RegisterNewCategoryArticle', 'registerInfoCategoryArticle', 'register-new-category-article', 'register-info-category-article', 'Cadastrar Categoria de Artigo', 'Página para cadastrar categoria de artigo do site', 2, '', 2, 2, 1, '2020-07-01 18:17:59', NULL),
(108, 'EditCategoryArticle', 'editInfoCategoryArticle', 'edit-category-article', 'edit-info-category-article', 'Editar Categoria de Artigo', 'Página para editar categoria de artigo do site', 2, '', 3, 2, 1, '2020-07-02 18:05:55', NULL),
(109, 'DeleteCategoryArticle', 'removeCategoryArticle', 'delete-category-article', 'remove-category-article', 'Apagar Categoria de Artigo', 'Página pra deletar categoria de artigo do site', 2, '', 4, 2, 1, '2020-07-02 18:37:41', NULL),
(110, 'ModifySitCategoryArticle', 'alterSitCategoryArticle', 'modify-sit-category-article', 'alter-sit-category-article', 'Alterar Situação de Artigo', 'Página para alterar a situação da categoria de artigo do site', 2, '', 6, 2, 1, '2020-07-02 19:03:09', NULL),
(111, 'ListArticle', 'listInfoArticle', 'list-article', 'list-info-article', 'Artigos', 'Página para listar os artigos do site', 2, 'fas fa-newspaper', 1, 2, 1, '2020-07-03 19:39:30', NULL),
(112, 'ViewInfoArticle', 'detailInfoArticle', 'view-info-article', 'detail-info-article', 'Visualizar Artigo', 'Página para visualizar artigo do site', 2, '', 6, 2, 1, '2020-07-06 16:40:45', NULL),
(113, 'RegisterNewArticle', 'registerInfoArticle', 'register-new-article', 'register-info-article', 'Cadastrar Artigo', 'Página para cadastrar artigo do site', 2, '', 2, 2, 1, '2020-07-06 17:47:53', NULL),
(114, 'EditAuthorArticle', 'editInfoAuthorArticle', 'edit-author-article', 'edit-info-author-article', 'Editar Autor de Artigo', 'Página para editar autor de artigo do site', 2, '', 3, 2, 1, '2020-07-06 23:34:39', NULL),
(115, 'EditArticle', 'editInfoArticle', 'edit-article', 'edit-info-article', 'Editar Artigo', 'Página para editar artigo do site', 2, '', 3, 2, 1, '2020-07-07 00:09:48', NULL),
(116, 'DeleteArticle', 'removeArticle', 'delete-article', 'remove-article', 'Apagar Artigo', 'Página para deletar artigo do site', 2, '', 4, 2, 1, '2020-07-07 03:38:48', NULL),
(117, 'ModifySitArticle', 'alterSitArticle', 'modify-sit-article', 'alter-sit-article', 'Alterar Situação de Artigo', 'Página para alterar a situação de artigo do site', 2, '', 6, 2, 1, '2020-07-07 03:46:53', NULL),
(118, 'ListSitpageSite', 'listInfoSitpageSite', 'list-sitpage-site', 'list-info-sitpage-site', 'Situação de Página', 'Página para listar a situação de páginas do site', 2, 'fas fa-exclamation-triangle', 1, 2, 1, '2020-07-07 17:35:36', '2020-07-07 22:48:53'),
(119, 'ViewInfoSitpageSite', 'detailInfoSitpageSite', 'view-info-sitpage-site', 'detail-info-sitpage-site', 'Visualizar Situação de Pagina do Site', 'Página para visualizar situação de página do site', 2, '', 2, 2, 1, '2020-07-07 22:55:04', NULL),
(120, 'RegisterNewSitpageSite', 'registerInfoSitpageSite', 'register-new-sitpage-site', 'register-info-sitpage-site', 'Cadastrar Situação de Página do Site', 'Página para cadastrar situação de página do site', 2, '', 2, 2, 1, '2020-07-07 23:18:33', NULL),
(121, 'EditSitpageSite', 'editInfoSitpageSite', 'edit-sitpage-site', 'edit-info-sitpage-site', 'Editar Situação de Página do Site', 'Página para editar situação de página do site', 2, '', 3, 2, 1, '2020-07-07 23:56:53', NULL),
(122, 'DeleteSitpageSite', 'removeSitpageSite', 'delete-sitpage-site', 'remove-sitpage-site', 'Apagar Situação de Página do Site', 'Página para deletar situação de página do site', 2, '', 4, 2, 1, '2020-07-08 00:13:00', NULL),
(123, 'ListTypepgSite', 'listInfoTypepgSite', 'list-typepg-site', 'list-info-typepg-site', 'Tipo de Página', 'Página para listar tipo de página do site', 2, 'fas fa-th-list\'', 1, 2, 1, '2020-07-08 16:45:21', NULL),
(124, 'ViewInfoTypepgSite', 'detailInfoTypepgSite', 'view-info-typepg-site', 'detail-info-typepg-site', 'Visualizar Tipo de Página do Site', 'Página para visualizar tipo de página do site', 2, '', 5, 2, 1, '2020-07-08 17:18:44', NULL),
(125, 'RegisterNewTypepgSite', 'registerInfoTypepgSite', 'register-new-typepg-site', 'register-info-typepg-site', 'Cadastrar Tipo de Página do Site', 'Página para cadastrar tipo de página do site', 2, '', 2, 2, 1, '2020-07-08 17:41:37', NULL),
(126, 'EditTypepgSite', 'editInfoTypepgSite', 'edit-typepg-site', 'edit-info-typepg-site', 'Editar Tipo de Página do Site', 'Página para editar tipo de página do site', 2, '', 3, 2, 1, '2020-07-09 01:18:21', NULL),
(127, 'DeleteTypepgSite', 'removeTypepgSite', 'delete-typepg-site', 'remove-typepg-site', 'Apagar Tipo de Páginas do Site', 'Página para deletar tipo de página do site', 2, '', 4, 2, 1, '2020-07-09 15:51:17', NULL),
(128, 'ModifyOrderTypepgSite', 'alterOrderTypepgSite', 'modify-order-typepg-site', 'alter-order-typepg-site', 'Alterar Ordem do Tipo de Páginas do Site', 'Página para alterar ordem do tipo de páginas do site', 2, '', 8, 2, 1, '2020-07-09 16:24:58', NULL),
(129, 'ListPageSite', 'listInfoPageSite', 'list-page-site', 'list-info-page-site', 'Página do Site', 'Página para listar páginas do site', 2, 'fas fa-file-alt', 1, 2, 1, '2020-07-09 17:05:47', '2020-07-16 17:24:25'),
(130, 'ViewInfoPageSite', 'detailInfoPageSite', 'view-info-page-site', 'detail-info-page-site', 'Visualizar Página', 'Página para visualizar página do site', 2, '', 5, 2, 1, '2020-07-10 15:04:48', NULL),
(131, 'EditPageSite', 'editInfoPageSite', 'edit-page-site', 'edit-info-page-site', 'Editar Página', 'Página para editar página do site', 2, '', 3, 2, 1, '2020-07-10 15:37:41', NULL),
(132, 'RegisterNewPageSite', 'registerInfoPageSite', 'register-new-page-site', 'register-info-page-site', 'Cadastrar Página', 'Cadastrar Página do site', 2, '', 2, 2, 1, '2020-07-10 16:42:53', NULL),
(133, 'DeletePageSite', 'removePageSite', 'delete-page-site', 'remove-page-site', 'Apagar Página', 'Página para deletar página do site', 2, '', 4, 2, 1, '2020-07-10 17:15:50', NULL),
(134, 'ModifySitPageSite', 'alterSitPageSite', 'modify-sit-page-site', 'alter-sit-page-site', 'Alterar Situação da Página', 'Página para alterar situação da página do site', 2, '', 6, 2, 1, '2020-07-14 16:59:22', NULL),
(135, 'ModifyOrderPageSite', 'alterOrderPageSite', 'modify-order-page-site', 'alter-order-page-site', 'Alterar Ordem da Página', 'Página para alterar ordem de apresentação das páginas no site', 2, '', 8, 2, 1, '2020-07-14 17:18:20', NULL),
(136, 'ModifyPermissionPageSite', 'alterPermissionPageSite', 'modify-permission-page-site', 'alter-permission-page-site', 'Liberar e Bloquear Página no Menu', 'Página para liberar e bloquear a página do site no menu', 2, '', 6, 2, 1, '2020-07-14 17:48:37', NULL),
(137, 'EditSeo', 'editInfoSeo', 'edit-seo', 'edit-info-seo', 'Seo', 'Página para editar informações básicas de SEO do Facebook e Twitter', 2, 'fab fa-searchengin', 3, 2, 1, '2020-07-17 17:55:20', NULL),
(138, 'SearchUser', 'listUsersSearched', 'search-user', 'list-users-searched', 'Pesquisar Usuários', 'Página para pesquisar usuários cadastrado', 2, '', 9, 1, 1, '2020-07-19 17:26:35', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_robots`
--

CREATE TABLE `adms_robots` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adms_robots`
--

INSERT INTO `adms_robots` (`id`, `nome`, `tipo`, `created`, `modified`) VALUES
(1, 'Indexar a pÃ¡gina e seguir os links', 'index,follow', '2018-02-23 00:00:00', NULL),
(2, 'NÃ£o indexar a pÃ¡gina mas seguir os links', 'noindex,follow', '2018-02-23 00:00:00', NULL),
(3, 'Indexar a pÃ¡gina mas nÃ£o seguir os links', 'index,nofollow', '2018-02-23 00:00:00', NULL),
(4, 'NÃ£o indexar a pÃ¡gina e nem seguir os links', 'noindex,nofollow', '2018-02-23 00:00:00', NULL),
(5, 'NÃ£o exibir a versÃ£o em cache da pÃ¡gina', 'noarchive', '2018-02-23 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_situacao`
--

CREATE TABLE `adms_situacao` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `adms_cor_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `adms_situacao`
--

INSERT INTO `adms_situacao` (`id`, `nome`, `adms_cor_id`, `created`, `modified`) VALUES
(1, 'Ativo', 3, '2020-04-03 13:40:32', NULL),
(2, 'Inativo', 4, '2020-04-03 13:40:32', NULL),
(3, 'Analise', 1, '2020-04-03 13:41:18', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_situacao_paginas`
--

CREATE TABLE `adms_situacao_paginas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adms_situacao_paginas`
--

INSERT INTO `adms_situacao_paginas` (`id`, `nome`, `cor`, `created`, `modified`) VALUES
(1, 'Ativo', 'success', '2018-03-23 00:00:00', NULL),
(2, 'Inativo', 'danger', '2018-03-23 00:00:00', NULL),
(3, 'Analise', 'primary', '2018-03-23 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_situacao_users`
--

CREATE TABLE `adms_situacao_users` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `adms_cor_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adms_situacao_users`
--

INSERT INTO `adms_situacao_users` (`id`, `nome`, `adms_cor_id`, `created`, `modified`) VALUES
(1, 'Ativo', 3, '2020-04-03 00:00:00', NULL),
(2, 'Inativo', 5, '2020-04-03 00:00:00', NULL),
(3, 'Aguardando Confirmacao', 1, '2020-04-03 00:00:00', NULL),
(4, 'Spam', 4, '2020-04-03 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_tipos_paginas`
--

CREATE TABLE `adms_tipos_paginas` (
  `id` int(11) NOT NULL,
  `tipo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `obs` text COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adms_tipos_paginas`
--

INSERT INTO `adms_tipos_paginas` (`id`, `tipo`, `nome`, `obs`, `ordem`, `created`, `modified`) VALUES
(1, 'administrative', 'Administrativo', 'Config do Administrativo', 1, '2018-05-23 00:00:00', '2020-06-11 03:48:40'),
(2, 'site', 'Administrativo do Site', 'Modulo para administrar o site', 2, '2020-06-17 16:46:13', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_usuarios`
--

CREATE TABLE `adms_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `apelido` varchar(220) DEFAULT NULL,
  `email` varchar(220) NOT NULL,
  `usuario` varchar(220) NOT NULL,
  `senha` varchar(220) NOT NULL,
  `recuperar_senha` varchar(220) DEFAULT NULL,
  `chave_descadastro` varchar(220) DEFAULT NULL,
  `config_email` varchar(120) DEFAULT NULL,
  `imagem` varchar(220) DEFAULT NULL,
  `adms_niveis_acesso_id` int(11) NOT NULL,
  `adms_situacao_user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `adms_usuarios`
--

INSERT INTO `adms_usuarios` (`id`, `nome`, `apelido`, `email`, `usuario`, `senha`, `recuperar_senha`, `chave_descadastro`, `config_email`, `imagem`, `adms_niveis_acesso_id`, `adms_situacao_user_id`, `created`, `modified`) VALUES
(1, 'administrador', 'administrador', 'administrador@gmail.com', 'administrador', '$2y$10$HHFwJRzOdoks560ssdRrk.YUdKP.J5anxrKAMw4uqyT6nAKiy2zEG', NULL, 'bbe0d9883f909fb95ca46e8396fd7194', '2', 'administrator.jpg', 1, 1, '2020-04-03 12:22:34', '2020-09-18 01:40:37'),
(2, 'Josiane Silva', 'Josi', 'josiane@gmail.com', 'jose2020', '$2y$10$.c30VfoSv3KbWG/XhUChC.79VMOuXLFXiJ/F1SkA4QsUsO7waLv1q', NULL, NULL, NULL, '94283.jpg', 2, 1, '2020-04-29 17:59:50', NULL),
(3, 'Manoel de Souza Rocha', 'manoel', 'manoel@gmail.com', 'manoel123', '$2y$10$PcKXOgAmU6kJp8w.h1tVv.e1RYx6Rc8d84/dNpsFcsn7jh6.BTp8e', NULL, NULL, NULL, '84885.jpg', 3, 1, '2020-04-29 18:20:28', NULL),
(4, 'Ana Luzia', 'ana', 'ana.lizia@gmail.info.com', 'ana220', '$2y$10$9f1sqwHSFQiwOdruGlIA2OrqcLYeE.3qIoelivcCjHOYcPXdfJ/J6', NULL, NULL, NULL, 'blackhat.jpg', 4, 1, '2020-04-29 18:21:17', '2020-07-20 00:13:55'),
(5, 'Leandro henrique1998', 'santos1998', 'santos@hotmail.com', 'santos@hotmail.com', '$2y$10$hdAsBHKRroSiPKcADcDOF.jioomURbtWwgUF05pYEBXRCy1lG9QF2', NULL, NULL, NULL, NULL, 5, 3, '2020-07-18 15:55:52', NULL),
(6, 'Leandro henrique1997', 'santos1997', 'santosaacf1998@hotmail.com', 'santosaacf1998@hotmail.com', '$2y$10$z8l6jja.D1Sy/3X4O9KdqelRujL/3dixuJHitVRQjlMmaEElf4DBW', NULL, NULL, NULL, NULL, 5, 3, '2020-07-18 16:06:23', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `amds_configuracao_email`
--

CREATE TABLE `amds_configuracao_email` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  `host` varchar(220) NOT NULL,
  `username` varchar(220) NOT NULL,
  `password` varchar(120) NOT NULL,
  `smtpsecure` varchar(10) NOT NULL,
  `port` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `amds_configuracao_email`
--

INSERT INTO `amds_configuracao_email` (`id`, `nome`, `email`, `host`, `username`, `password`, `smtpsecure`, `port`, `created`, `modified`) VALUES
(1, '', '', '', '', '', '', 0, '2020-04-12 11:34:06', '2020-09-18 02:01:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_artigos`
--

CREATE TABLE `sts_artigos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `conteudo` text COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `resumo_publico` text COLLATE utf8_unicode_ci NOT NULL,
  `qnt_acesso` int(11) NOT NULL DEFAULT 0,
  `sts_robot_id` int(11) NOT NULL,
  `adms_usuario_id` int(11) NOT NULL,
  `adms_sit_id` int(11) NOT NULL,
  `sts_tps_artigo_id` int(11) NOT NULL,
  `sts_cats_artigo_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_artigos`
--

INSERT INTO `sts_artigos` (`id`, `titulo`, `descricao`, `conteudo`, `imagem`, `slug`, `keywords`, `description`, `author`, `resumo_publico`, `qnt_acesso`, `sts_robot_id`, `adms_usuario_id`, `adms_sit_id`, `sts_tps_artigo_id`, `sts_cats_artigo_id`, `created`, `modified`) VALUES
(1, 'Article 1', '<p>Donec 1 ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>', '<p>This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p><p>Cum sociis natoque penatibus et magnis <a href=\"#\">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p><blockquote><p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p></blockquote><p>Etiam porta <i>sem malesuada magna</i> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p><h2>Heading</h2><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p><h3>Sub-heading</h3><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Example code block</p><p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p><h3>Sub-heading</h3><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p><ul><li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li><li>Donec id elit non mi porta gravida at eget metus.</li><li>Nulla vitae elit libero, a pharetra augue.</li></ul><p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p><ol><li>Vestibulum id ligula porta felis euismod semper.</li><li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li><li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li></ol><p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>', 'artigo.jpg', 'article-1', 'artigo, artigo 1, ', 'Descricao do artigo um para seo', 'Leandro Santos', '<p>This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p><p>Cum sociis natoque penatibus et magnis <a href=\"#\">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>', 6, 1, 1, 1, 1, 1, '2018-02-18 00:00:00', '2020-09-18 01:22:43'),
(2, 'Article 2', '<p>Donec 2 ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>', '<p>This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p><p>Cum sociis natoque penatibus et magnis <a href=\"#\">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p><blockquote><p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p></blockquote><p>Etiam porta <i>sem malesuada magna</i> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p><h2>Heading</h2><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p><h3>Sub-heading</h3><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Example code block</p><p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p><h3>Sub-heading</h3><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p><ul><li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li><li>Donec id elit non mi porta gravida at eget metus.</li><li>Nulla vitae elit libero, a pharetra augue.</li></ul><p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p><ol><li>Vestibulum id ligula porta felis euismod semper.</li><li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li><li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li></ol><p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>', 'artigo.jpg', 'article-2', 'artigo, artigo 2, ', 'Descricao do artigo dois para seo', 'Leandro Santos', '<p>This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p><p>Cum sociis natoque penatibus et magnis <a href=\"#\">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>', 4, 1, 1, 1, 1, 1, '2018-02-19 00:00:00', '2020-09-18 01:22:25'),
(3, 'Article 3', '<p>Donec 3 ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>', '<p>This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p><p>Cum sociis natoque penatibus et magnis <a href=\"#\">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p><blockquote><p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p></blockquote><p>Etiam porta <i>sem malesuada magna</i> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p><h2>Heading</h2><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p><h3>Sub-heading</h3><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Example code block</p><p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p><h3>Sub-heading</h3><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p><ul><li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li><li>Donec id elit non mi porta gravida at eget metus.</li><li>Nulla vitae elit libero, a pharetra augue.</li></ul><p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p><ol><li>Vestibulum id ligula porta felis euismod semper.</li><li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li><li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li></ol><p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>', 'artigo.jpg', 'article-3', 'artigo, artigo 3 ', 'Descricao do artigo tres para seo', 'Leandro Santos', '<p>This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p><p>Cum sociis natoque penatibus et magnis <a href=\"#\">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>', 14, 1, 1, 1, 1, 1, '2018-02-20 00:00:00', '2020-09-18 01:21:41'),
(4, 'Article 4', '<p>Donec 4 ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>', '<p>4This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p><p>Cum sociis natoque penatibus et magnis <a href=\"#\">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p><blockquote><p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p></blockquote><p>Etiam porta <i>sem malesuada magna</i> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p><h2>Heading</h2><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p><h3>Sub-heading</h3><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Example code block</p><p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p><h3>Sub-heading</h3><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p><ul><li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li><li>Donec id elit non mi porta gravida at eget metus.</li><li>Nulla vitae elit libero, a pharetra augue.</li></ul><p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p><ol><li>Vestibulum id ligula porta felis euismod semper.</li><li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li><li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li></ol><p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>', 'artigo.jpg', 'article-4', 'artigo, artigo 4 ', 'Descricao do artigo quatro para seo', 'Leandro Santos', '<p>This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p><p>Cum sociis natoque penatibus et magnis <a href=\"#\">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>', 13, 1, 1, 1, 1, 1, '2018-02-21 00:00:00', '2020-09-18 01:21:20'),
(5, 'Article 5', '<p>Donec 5 ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>', '<p>This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p><p>Cum sociis natoque penatibus et magnis <a href=\"#\">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p><blockquote><p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p></blockquote><p>Etiam porta <i>sem malesuada magna</i> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p><h2>Heading</h2><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p><h3>Sub-heading</h3><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Example code block</p><p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p><h3>Sub-heading</h3><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p><ul><li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li><li>Donec id elit non mi porta gravida at eget metus.</li><li>Nulla vitae elit libero, a pharetra augue.</li></ul><p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p><ol><li>Vestibulum id ligula porta felis euismod semper.</li><li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li><li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li></ol><p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>', 'artigo.jpg', 'article-5', 'artigo, artigo 5', 'Descricao do artigo cinco para seo', 'Leandro Santos', '<p>This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p><p>Cum sociis natoque penatibus et magnis <a href=\"#\">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>', 1, 1, 1, 1, 1, 1, '2018-02-22 00:00:00', '2020-09-18 01:20:38'),
(6, 'Article 6', '<p>Donec 6 ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>', '<p>6This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p><p>Cum sociis natoque penatibus et magnis <a href=\"#\">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p><blockquote><p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p></blockquote><p>Etiam porta <i>sem malesuada magna</i> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p><h2>Heading</h2><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p><h3>Sub-heading</h3><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Example code block</p><p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p><h3>Sub-heading</h3><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p><ul><li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li><li>Donec id elit non mi porta gravida at eget metus.</li><li>Nulla vitae elit libero, a pharetra augue.</li></ul><p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p><ol><li>Vestibulum id ligula porta felis euismod semper.</li><li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li><li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li></ol><p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>', 'artigo.jpg', 'article-6', 'artigo, artigo 6', 'Descricao do artigo seis para seo', 'Leandro Santos', '<p>This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p><p>Cum sociis natoque penatibus et magnis <a href=\"#\">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>', 20, 4, 1, 1, 1, 1, '2018-02-23 00:00:00', '2020-09-18 01:19:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_carousels`
--

CREATE TABLE `sts_carousels` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `posicao_text` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_botao` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordem` int(11) NOT NULL,
  `adms_cor_id` int(11) DEFAULT NULL,
  `adms_situacoes_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_carousels`
--

INSERT INTO `sts_carousels` (`id`, `nome`, `imagem`, `titulo`, `descricao`, `posicao_text`, `titulo_botao`, `link`, `ordem`, `adms_cor_id`, `adms_situacoes_id`, `created`, `modified`) VALUES
(1, 'Primeiro Exemplo', 'imagem_um.jpg', 'Example headline1.', 'Cras 1 justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', 'text-left', 'Mais detalhes', '#', 3, 1, 1, '2018-05-23 00:00:00', '2020-07-09 17:50:52'),
(2, 'Segundo Exemplo', 'imagem_dois.png', 'Example headline2.', 'Cras 2 justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', 'text-center', 'Inscrever-se', '#', 2, 1, 1, '2018-05-23 00:00:00', '2020-07-09 17:50:52'),
(3, 'Terceiro Exemplo', 'imagem_tres.jpg', 'One more for good measure3.', 'Cras 3 justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', 'text-right', 'Comprar', '#', 1, 1, 1, '2018-05-23 00:00:00', '2020-06-24 23:13:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_cats_artigos`
--

CREATE TABLE `sts_cats_artigos` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `sts_situacoe_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_cats_artigos`
--

INSERT INTO `sts_cats_artigos` (`id`, `nome`, `sts_situacoe_id`, `created`, `modified`) VALUES
(1, 'PHP', 1, '2018-02-23 00:00:00', '2020-07-02 19:12:03'),
(2, 'Bootstrap', 1, '2018-02-23 00:00:00', '2020-07-02 19:12:04'),
(3, 'MySQLi', 1, '2018-02-23 00:00:00', '2020-07-02 19:12:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_comentario_artigo`
--

CREATE TABLE `sts_comentario_artigo` (
  `id` int(11) NOT NULL,
  `conteudo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adms_usuario_id` int(11) NOT NULL,
  `sts_artigo_id` int(11) NOT NULL,
  `adms_situacao_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sts_comentario_artigo`
--

INSERT INTO `sts_comentario_artigo` (`id`, `conteudo`, `adms_usuario_id`, `sts_artigo_id`, `adms_situacao_id`, `created`, `modified`) VALUES
(1, 'Pergunta 1 - Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. ', 37, 6, 1, '2020-07-17 17:26:19', NULL),
(2, 'Pergunta 2 - Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. ', 39, 6, 1, '2020-07-15 17:26:20', NULL),
(3, 'Pergunta 3 - Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. ', 40, 6, 1, '2020-07-16 17:28:30', NULL),
(4, 'comentario1', 39, 6, 3, '2020-07-18 06:05:33', NULL),
(5, 'edfbfgdsnbsfgnbgf', 39, 6, 3, '2020-07-18 15:39:25', NULL),
(6, 'edfbfgdsnbsfgnbgf', 39, 6, 3, '2020-07-18 15:40:22', NULL),
(7, 'edfbfgdsnbsfgnbgf', 42, 6, 3, '2020-07-18 16:05:11', NULL),
(8, 'Avsdfbgtefbgrb', 43, 6, 3, '2020-07-18 16:06:23', NULL),
(9, 'PPknjkansfjb', 44, 6, 3, '2020-07-18 16:54:03', NULL),
(10, 'Comentário verificador', 37, 6, 3, '2020-07-18 16:56:08', NULL),
(11, 'sdfsadgsdgvsdgv', 42, 6, 3, '2020-07-18 17:19:52', NULL),
(12, 'Ahgvblkjhgbkjpibh', 1, 6, 3, '2020-07-18 17:20:40', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_contatos`
--

CREATE TABLE `sts_contatos` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `assunto` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `mensagem` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_footer`
--

CREATE TABLE `sts_footer` (
  `id` int(11) NOT NULL,
  `nome_empresa` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `copyright` varchar(220) NOT NULL,
  `email` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telefone1` varchar(30) NOT NULL,
  `telefone2` varchar(30) NOT NULL,
  `facebook_url` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `twitter_url` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `instagram_url` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `whatsapp_url` varchar(220) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `rua` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `cidade` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(8) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `uf` char(2) NOT NULL,
  `sts_tipos_paginas_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sts_footer`
--

INSERT INTO `sts_footer` (`id`, `nome_empresa`, `copyright`, `email`, `telefone1`, `telefone2`, `facebook_url`, `twitter_url`, `instagram_url`, `whatsapp_url`, `rua`, `bairro`, `cidade`, `numero`, `cep`, `uf`, `sts_tipos_paginas_id`, `created`, `modified`) VALUES
(1, 'Santos Developer', '&copy; 2020 Santos Developer - Todos os direitos reservados.', 'santos.developer@gmail.com.br', '(92) 3033-5238', '(92) 98985-4566', '#', '#', '#', '#', 'Av. Max Teixeira', 'Cidade Nova', 'Manaus', '215', '69165-216', 'AM', 1, '2020-03-15 20:17:42', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_paginas`
--

CREATE TABLE `sts_paginas` (
  `id` int(11) NOT NULL,
  `controller` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `nome_pagina` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `obs` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lib_bloqueado` int(11) NOT NULL DEFAULT 2,
  `ordem_paginas` int(11) NOT NULL,
  `sts_tipos_pagina_id` int(11) NOT NULL,
  `sts_robot_id` int(11) NOT NULL,
  `sts_situacao_pagina_id` int(11) NOT NULL DEFAULT 2,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_paginas`
--

INSERT INTO `sts_paginas` (`id`, `controller`, `endereco`, `nome_pagina`, `titulo`, `obs`, `keywords`, `description`, `author`, `imagem`, `lib_bloqueado`, `ordem_paginas`, `sts_tipos_pagina_id`, `sts_robot_id`, `sts_situacao_pagina_id`, `created`, `modified`) VALUES
(1, 'Home', 'home', 'Pagina inicial', 'Santos Developer - Pagina inicial', 'Pagina inicial do site do projeto sts', 'noticias,...', 'Site de noticias sobre...', 'Leandro Santos', 'home.jpg', 1, 1, 1, 3, 1, '2018-05-23 00:00:00', '2020-07-16 17:56:12'),
(2, 'SobreEmpresa', 'sobre-empresa', 'Sobre Empresa', 'Santos Developer - Sobre Empresa', 'Pagina sobre empresa do site do projeto sts', 'sobre a empresa celke, celke', 'A empresa Celke...', 'Leandro Santos', 'sobre_empresa.jpg', 1, 2, 1, 1, 1, '2018-05-23 00:00:00', '2020-07-16 17:56:12'),
(3, 'Blog', 'blog', 'Blog', 'Santos Developer - Blog', 'Pagina blog do site do projeto sts', 'Ultimas noticias, noticias sobre...', 'Ultimas noticias sobre...', 'Leandro Santos', 'blog.jpg', 1, 3, 1, 1, 1, '2018-05-23 00:00:00', '2020-07-16 17:56:12'),
(4, 'Artigo', 'artigo', 'Artigo', 'Santos Developer - Artigo', 'Pagina para ver o artigo inteiro no site do projeto sts', 'php, php oo,...', 'Como criar o ...', 'Leandro Santos', 'artigo.jpg', 2, 4, 1, 1, 1, '2018-05-23 00:00:00', '2020-07-16 17:56:12'),
(5, 'Contato', 'contato', 'Contato', 'Santos Developer - Contato', 'Pagina contato no site do projeto sts', 'contato, contato com,...', 'Formulario de contato...', 'Leandro Santos', 'contato.jpg', 1, 5, 1, 1, 1, '2018-05-23 00:00:00', '2020-07-16 17:56:12'),
(10, 'ComentariosArtigo', 'comentarios-artigo', 'ComentariosArtigo', 'Comentario do Artigo', 'Página para salvar comentários dos artigos do site', 'comentario', 'comentario do artigo', 'Leandro Santos', 'comentario.png', 2, 6, 1, 4, 1, '2020-07-18 05:35:34', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_robots`
--

CREATE TABLE `sts_robots` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_robots`
--

INSERT INTO `sts_robots` (`id`, `nome`, `tipo`, `created`, `modified`) VALUES
(1, 'Indexar a pÃ¡gina e seguir os links', 'index,follow', '2018-05-23 00:00:00', NULL),
(5, 'NÃ£o exibir a versÃ£o em cache da pÃ¡gina', 'noarchive', '2020-06-30 00:00:00', NULL),
(3, 'Indexar a pÃ¡gina mas nÃ£o seguir os links', 'index,nofollow', '2018-05-23 00:00:00', NULL),
(4, 'NÃ£o indexar a pÃ¡gina e nem seguir os links', 'noindex,nofollow', '2018-05-23 00:00:00', NULL),
(2, 'NÃ£o indexar a pÃ¡gina mas seguir os links', 'noindex,follow', '2020-06-30 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_seo`
--

CREATE TABLE `sts_seo` (
  `id` int(11) NOT NULL,
  `og_site_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `og_locale` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `fb_admins` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_site` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_seo`
--

INSERT INTO `sts_seo` (`id`, `og_site_name`, `og_locale`, `fb_admins`, `twitter_site`, `created`, `modified`) VALUES
(1, '', '', '', '', '2018-05-23 00:00:00', '2020-09-18 01:51:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_servicos`
--

CREATE TABLE `sts_servicos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `icone_um` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `nome_um` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `descricao_um` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `icone_dois` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `nome_dois` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `descricao_dois` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `icone_tres` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `nome_tres` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `descricao_tres` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_servicos`
--

INSERT INTO `sts_servicos` (`id`, `titulo`, `icone_um`, `nome_um`, `descricao_um`, `icone_dois`, `nome_dois`, `descricao_dois`, `icone_tres`, `nome_tres`, `descricao_tres`, `created`, `modified`) VALUES
(1, 'Serviços', 'ion-ios-camera-outline', 'Serviços um', 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 'ion-ios-film-outline', 'Serviços dois', 'This card has supporting text below as a natural lead-in to additional content.', 'ion-ios-videocam-outline', 'Serviços tres', 'This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.', '2018-05-23 00:00:00', '2020-06-20 17:40:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_situacaos_pgs`
--

CREATE TABLE `sts_situacaos_pgs` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `adms_cor_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_situacaos_pgs`
--

INSERT INTO `sts_situacaos_pgs` (`id`, `nome`, `adms_cor_id`, `created`, `modified`) VALUES
(1, 'Ativo', 3, '2018-05-23 00:00:00', NULL),
(2, 'Inativo', 5, '2018-05-23 00:00:00', NULL),
(3, 'Analise', 1, '2018-05-23 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_sobres`
--

CREATE TABLE `sts_sobres` (
  `id` int(11) NOT NULL,
  `titulo` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `adms_sit_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_sobres`
--

INSERT INTO `sts_sobres` (`id`, `titulo`, `descricao`, `imagem`, `adms_sit_id`, `created`, `modified`) VALUES
(1, 'Leandro Santos', 'Software Developer PHP e Javascript, cursando Sistema de Informação na Universidade Estácio de Sá, Técnico em Informática pela Fucapi, entusiasta de métodos ágeis e viciado em café.', 'img_20170621_100337.png', 1, '2018-05-23 00:00:00', '2020-09-18 01:37:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_sob_empresa`
--

CREATE TABLE `sts_sob_empresa` (
  `id` int(11) NOT NULL,
  `titulo` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int(11) NOT NULL,
  `adms_sit_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_sob_empresa`
--

INSERT INTO `sts_sob_empresa` (`id`, `titulo`, `descricao`, `imagem`, `ordem`, `adms_sit_id`, `created`, `modified`) VALUES
(1, 'Sobre empresa um.', 'Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.', 'empresa.jpg', 1, 1, '2018-05-23 00:00:00', '2020-06-24 23:01:34'),
(2, 'Sobre empresa dois.', 'Descricao sobre empresa 2 Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.', 'empresa.jpg', 2, 1, '2018-05-23 00:00:00', '2020-06-24 23:01:40'),
(3, 'Sobre empresa tres.', 'Descricao sobre empresa 3 Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.', 'empresa.jpg', 3, 1, '2018-05-23 00:00:00', '2020-06-24 23:23:00'),
(4, 'Sobre empresa quatro.', 'Descricao sobre empresa 4 Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.', 'empresa.jpg', 4, 1, '2018-05-23 00:00:00', '2020-06-24 23:23:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_tipos_paginas`
--

CREATE TABLE `sts_tipos_paginas` (
  `id` int(11) NOT NULL,
  `tipo` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `obs` text COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_tipos_paginas`
--

INSERT INTO `sts_tipos_paginas` (`id`, `tipo`, `nome`, `obs`, `ordem`, `created`, `modified`) VALUES
(1, 'sts', 'Site Principal', 'Core do site principal', 1, '2018-05-23 00:00:00', '2020-07-09 16:41:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_tps_artigos`
--

CREATE TABLE `sts_tps_artigos` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_tps_artigos`
--

INSERT INTO `sts_tps_artigos` (`id`, `nome`, `created`, `modified`) VALUES
(1, 'Publico', '2018-02-23 00:00:00', NULL),
(2, 'Privado', '2018-02-23 00:00:00', NULL),
(3, 'Privado com resumo publico', '2018-02-23 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sts_videos`
--

CREATE TABLE `sts_videos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sts_videos`
--

INSERT INTO `sts_videos` (`id`, `titulo`, `descricao`, `video`, `created`, `modified`) VALUES
(1, 'Vídeo', 'PHP, vamos responder as principais dúvidas dos programadores iniciantes', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Q0gL995UazU\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>                ', '2018-05-23 00:00:00', '2020-06-20 18:47:22');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adms_cadastro_user`
--
ALTER TABLE `adms_cadastro_user`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_cors`
--
ALTER TABLE `adms_cors`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_grupos_paginas`
--
ALTER TABLE `adms_grupos_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_menus`
--
ALTER TABLE `adms_menus`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_niveis_acessos`
--
ALTER TABLE `adms_niveis_acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_niveis_acessos_paginas`
--
ALTER TABLE `adms_niveis_acessos_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_paginas`
--
ALTER TABLE `adms_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_robots`
--
ALTER TABLE `adms_robots`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_situacao`
--
ALTER TABLE `adms_situacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_situacao_paginas`
--
ALTER TABLE `adms_situacao_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_situacao_users`
--
ALTER TABLE `adms_situacao_users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_tipos_paginas`
--
ALTER TABLE `adms_tipos_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_usuarios`
--
ALTER TABLE `adms_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `amds_configuracao_email`
--
ALTER TABLE `amds_configuracao_email`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_artigos`
--
ALTER TABLE `sts_artigos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_carousels`
--
ALTER TABLE `sts_carousels`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_cats_artigos`
--
ALTER TABLE `sts_cats_artigos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_comentario_artigo`
--
ALTER TABLE `sts_comentario_artigo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_contatos`
--
ALTER TABLE `sts_contatos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_footer`
--
ALTER TABLE `sts_footer`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_paginas`
--
ALTER TABLE `sts_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_robots`
--
ALTER TABLE `sts_robots`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_seo`
--
ALTER TABLE `sts_seo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_servicos`
--
ALTER TABLE `sts_servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_situacaos_pgs`
--
ALTER TABLE `sts_situacaos_pgs`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_sobres`
--
ALTER TABLE `sts_sobres`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_sob_empresa`
--
ALTER TABLE `sts_sob_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_tipos_paginas`
--
ALTER TABLE `sts_tipos_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_tps_artigos`
--
ALTER TABLE `sts_tps_artigos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sts_videos`
--
ALTER TABLE `sts_videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adms_cadastro_user`
--
ALTER TABLE `adms_cadastro_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `adms_cors`
--
ALTER TABLE `adms_cors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `adms_grupos_paginas`
--
ALTER TABLE `adms_grupos_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `adms_menus`
--
ALTER TABLE `adms_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `adms_niveis_acessos`
--
ALTER TABLE `adms_niveis_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `adms_niveis_acessos_paginas`
--
ALTER TABLE `adms_niveis_acessos_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT de tabela `adms_paginas`
--
ALTER TABLE `adms_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT de tabela `adms_robots`
--
ALTER TABLE `adms_robots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `adms_situacao`
--
ALTER TABLE `adms_situacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `adms_situacao_paginas`
--
ALTER TABLE `adms_situacao_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `adms_situacao_users`
--
ALTER TABLE `adms_situacao_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `adms_tipos_paginas`
--
ALTER TABLE `adms_tipos_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `adms_usuarios`
--
ALTER TABLE `adms_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `amds_configuracao_email`
--
ALTER TABLE `amds_configuracao_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `sts_artigos`
--
ALTER TABLE `sts_artigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `sts_carousels`
--
ALTER TABLE `sts_carousels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sts_cats_artigos`
--
ALTER TABLE `sts_cats_artigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `sts_comentario_artigo`
--
ALTER TABLE `sts_comentario_artigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `sts_contatos`
--
ALTER TABLE `sts_contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sts_footer`
--
ALTER TABLE `sts_footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `sts_paginas`
--
ALTER TABLE `sts_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `sts_robots`
--
ALTER TABLE `sts_robots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `sts_seo`
--
ALTER TABLE `sts_seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `sts_servicos`
--
ALTER TABLE `sts_servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `sts_situacaos_pgs`
--
ALTER TABLE `sts_situacaos_pgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sts_sobres`
--
ALTER TABLE `sts_sobres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `sts_sob_empresa`
--
ALTER TABLE `sts_sob_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `sts_tipos_paginas`
--
ALTER TABLE `sts_tipos_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sts_tps_artigos`
--
ALTER TABLE `sts_tps_artigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sts_videos`
--
ALTER TABLE `sts_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
