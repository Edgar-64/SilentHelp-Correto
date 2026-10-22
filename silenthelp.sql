-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql205.infinityfree.com
-- Tempo de geração: 22/10/2026 às 08:12
-- Versão do servidor: 11.4.13-MariaDB
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `if0_42575676_silenthelp`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(60) NOT NULL,
  `message` text NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `alerts`
--

INSERT INTO `alerts` (`id`, `user_id`, `type`, `message`, `latitude`, `longitude`, `status`, `created_at`) VALUES
(8, 36, 'emergencia', 'Alerta de emergência - Alerta de emergência acionado pelo usuário.', '-23.0368904', '-45.5799123', 'attended', '2026-10-15 13:18:46'),
(9, 36, 'emergencia', 'Alerta de emergência - Alerta de emergência acionado pelo usuário.', '-23.0368689', '-45.5799048', 'attended', '2026-10-20 14:20:29'),
(10, 36, 'emergencia', 'Alerta de emergência - Alerta de emergência acionado pelo usuário.', '-23.0368798', '-45.5798809', 'attended', '2026-10-20 16:34:58'),
(11, 36, 'emergencia', 'Alerta de emergência - Alerta de emergência acionado pelo usuário.', '-23.0369454', '-45.5798983', 'attended', '2026-10-20 16:36:50'),
(12, 36, 'emergencia', 'Alerta de emergência - Alerta de emergência acionado pelo usuário.', '-23.0368962', '-45.5799124', 'attended', '2026-10-20 16:51:35'),
(13, 36, 'emergencia', 'Alerta de emergência - Alerta de emergência acionado pelo usuário.', '-23.0369808', '-45.5799228', 'open', '2026-10-20 17:09:15'),
(14, 36, 'emergencia', 'Alerta de emergência - Alerta de emergência acionado pelo usuário.', '-23.0369096', '-45.5799262', 'attended', '2026-10-20 17:12:16'),
(15, 36, 'emergencia', 'Alerta de emergência - Alerta de emergência acionado pelo usuário.', '-23.0369300', '-45.5799125', 'open', '2026-10-22 12:00:02'),
(16, 36, 'emergencia', 'Alerta de emergência - Alerta de emergência acionado pelo usuário.', '-23.0369311', '-45.5799159', 'open', '2026-10-22 12:11:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(160) NOT NULL,
  `device_code` varchar(80) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'connected',
  `last_seen` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `diary_entries`
--

CREATE TABLE `diary_entries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` text NOT NULL,
  `mood` varchar(60) DEFAULT NULL,
  `entry_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `diary_entries`
--

INSERT INTO `diary_entries` (`id`, `user_id`, `title`, `content`, `mood`, `entry_date`, `created_at`) VALUES
(3, 36, 'rwewe', 'rrwerwer', '', '2026-10-15', '2026-10-15 11:33:43');

-- --------------------------------------------------------

--
-- Estrutura para tabela `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(160) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `emergency_contacts`
--

INSERT INTO `emergency_contacts` (`id`, `user_id`, `name`, `phone`, `relationship`, `is_primary`, `created_at`) VALUES
(3, 36, 'Fulano', '(12) 99191-4394', 'Pessoa de confiança', 1, '2026-10-15 11:34:16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `alert_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `alert_id`, `message`, `is_read`, `read_at`, `created_at`) VALUES
(6, 36, 37, NULL, 'olá', 1, '2026-10-15 08:04:39', '2026-10-15 11:04:37'),
(7, 37, 36, NULL, 'oi', 1, '2026-10-15 08:04:42', '2026-10-15 11:04:42'),
(8, 36, 37, NULL, 'i', 1, '2026-10-15 08:04:49', '2026-10-15 11:04:46'),
(9, 36, 37, NULL, 'sasdfgh', 1, '2026-10-15 08:05:00', '2026-10-15 11:04:58'),
(10, 37, 36, NULL, 'asdfuio', 1, '2026-10-15 08:05:06', '2026-10-15 11:05:04'),
(11, 36, 37, NULL, 'Teste no celular', 1, '2026-10-15 05:40:26', '2026-10-15 12:40:24'),
(12, 37, 36, NULL, 'oi', 1, '2026-10-15 05:42:36', '2026-10-15 12:42:33'),
(13, 36, 37, NULL, 'Rhr', 1, '2026-10-15 05:43:23', '2026-10-15 12:43:21'),
(14, 36, 37, NULL, 'rds', 1, '2026-10-15 06:13:16', '2026-10-15 13:13:15'),
(15, 36, 37, NULL, 'Gif', 1, '2026-10-15 06:19:13', '2026-10-15 13:19:12'),
(16, 36, 37, NULL, 'Socorro', 1, '2026-10-15 06:19:25', '2026-10-15 13:19:23'),
(17, 37, 36, NULL, 'nao', 1, '2026-10-15 06:19:35', '2026-10-15 13:19:32'),
(18, 36, 37, NULL, 'Oi', 1, '2026-10-20 06:52:22', '2026-10-20 13:52:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `responsible_links`
--

CREATE TABLE `responsible_links` (
  `id` int(11) NOT NULL,
  `protected_user_id` int(11) NOT NULL,
  `responsible_user_id` int(11) NOT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `status` enum('pending','active','blocked','ended') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `responsible_links`
--

INSERT INTO `responsible_links` (`id`, `protected_user_id`, `responsible_user_id`, `relationship`, `status`, `created_at`, `updated_at`) VALUES
(2, 36, 37, 'amiga', 'active', '2026-10-15 11:04:23', '2026-10-15 11:04:23');

-- --------------------------------------------------------

--
-- Estrutura para tabela `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `setting_key`, `setting_value`) VALUES
(1, 36, 'battery_level', '54'),
(2, 36, 'battery_updated_at', '2026-10-20 13:10:41');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `type` enum('protegida','responsavel','admin') NOT NULL DEFAULT 'protegida',
  `name` varchar(160) NOT NULL,
  `email` varchar(190) NOT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `invite_code` varchar(255) DEFAULT NULL,
  `emergency_contact` varchar(160) DEFAULT NULL,
  `emergency_phone` varchar(40) DEFAULT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `status` enum('admin','protegida','responsavel') NOT NULL DEFAULT 'protegida',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `type`, `name`, `email`, `phone`, `password_hash`, `invite_code`, `emergency_contact`, `emergency_phone`, `relationship`, `status`, `created_at`, `updated_at`) VALUES
(7, 'protegida', 'Edgar', 'edd@gmail.com', '(12) 99191-4394', '$2y$10$W9Yj5QZRd3DsxLFZlaR7gektKnmTkjze20yKBplEQwv6vILo3VsTm', '', 'fdafde', '(21) 32141-2312', '', 'protegida', '2026-10-06 12:33:29', '2026-10-06 12:33:29'),
(33, 'admin', 'Admin', 'admin@gmail.com', '(12) 99191-4394', '$2y$10$VxR/FfujstpDZ.Jm717q.OlBpwWu8rHL/WcZf9lu4W1ahC3i0/aNW', NULL, '', '', '', 'protegida', '2026-10-06 16:36:46', '2026-10-06 16:36:46'),
(34, 'protegida', 'Fulano', 'alemao@gmail.com', '(12) 99999-9999', '$2y$10$EPvcCiW78AGwK09cQi9u0OhS6arA6g2yJBrdkzhL.x1ujxBGQ./U2', NULL, 'fasdfe', '(12) 99191-4394', '', 'protegida', '2026-10-08 11:07:28', '2026-10-08 11:07:28'),
(35, 'responsavel', 'EdgarR', 'eddr@gmail.com', '(12) 99999-9999', '$2y$10$BWKdOCi3Ep5jHfY2LpLawO4CGOmhN5fFF0iivsH8DXZZRQqjwo8Zm', 'BY31KX', '', '', 'Sósia', 'protegida', '2026-10-15 10:42:18', '2026-10-15 10:42:18'),
(36, 'protegida', 'Pedro', 'pedro@gmail.com', '(12) 99999-9999', '$2y$10$hS93bQ1LReCPNS1XNeKu0eBovI.Dr.juzqPfgcnIJRc866Rc69MDK', 'SHE6CA3616', 'felix', '(12) 99999-9999', '', 'protegida', '2026-10-15 11:03:05', '2026-10-15 11:03:05'),
(37, 'responsavel', 'Maria', 'maria@gmail.com', '(12) 99999-9999', '$2y$10$4B2B0hwmLrskWLiIEDxPoOuPowEp.aHxMIZ3RvC2pHzUGTCpLGpsa', NULL, '', '', 'amiga', 'protegida', '2026-10-15 11:04:23', '2026-10-15 11:04:23');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `device_code` (`device_code`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `diary_entries`
--
ALTER TABLE `diary_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_sender` (`sender_id`),
  ADD KEY `idx_receiver` (`receiver_id`),
  ADD KEY `idx_alert` (`alert_id`),
  ADD KEY `idx_chat` (`sender_id`,`receiver_id`,`created_at`);

--
-- Índices de tabela `responsible_links`
--
ALTER TABLE `responsible_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_responsible_link` (`protected_user_id`,`responsible_user_id`),
  ADD KEY `idx_protected_user` (`protected_user_id`),
  ADD KEY `idx_responsible_user` (`responsible_user_id`),
  ADD KEY `idx_link_status` (`status`);

--
-- Índices de tabela `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_user_setting` (`user_id`,`setting_key`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `invite_code` (`invite_code`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `diary_entries`
--
ALTER TABLE `diary_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `responsible_links`
--
ALTER TABLE `responsible_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `diary_entries`
--
ALTER TABLE `diary_entries`
  ADD CONSTRAINT `diary_entries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD CONSTRAINT `emergency_contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_message_alert` FOREIGN KEY (`alert_id`) REFERENCES `alerts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_message_receiver` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_message_sender` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `responsible_links`
--
ALTER TABLE `responsible_links`
  ADD CONSTRAINT `fk_link_protected` FOREIGN KEY (`protected_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_link_responsible` FOREIGN KEY (`responsible_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
