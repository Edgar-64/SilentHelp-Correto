-- phpMyAdmin SQL Dump

-- version 4.9.0.1

-- https://www.phpmyadmin.net/

--

-- Host: sql205.infinityfree.com

-- Tempo de geração: 20/10/2026 às 09:41

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

--

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

--

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

--

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

--

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

--

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

--

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

MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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

MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--

-- AUTO_INCREMENT de tabela `responsible_links`

--

ALTER TABLE `responsible_links`

MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--

-- AUTO_INCREMENT de tabela `settings`

--

ALTER TABLE `settings`

MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
