-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Feb 24, 2024 alle 15:13
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freeblog`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `user_id` int(12) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `message`, `datecreated`) VALUES
(1, 1, 'My first post', 'My first post text', '2024-02-17 09:33:11'),
(2, 1, 'My second post', 'My second post text', '2024-02-18 09:33:11'),
(3, 1, 'My first post created', 'My first message created', '2024-02-20 18:38:38'),
(4, 1, 'My second post created ', 'My second message created', '2024-02-20 18:39:46'),
(7, 1, 'Test Post', '', '2024-02-24 10:49:19');

-- --------------------------------------------------------

--
-- Struttura della tabella `postscomments`
--

CREATE TABLE `postscomments` (
  `id` int(12) NOT NULL,
  `post_id` int(10) NOT NULL,
  `comment` text NOT NULL,
  `datecreated` datetime NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `user_id` int(12) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `postscomments`
--

INSERT INTO `postscomments` (`id`, `post_id`, `comment`, `datecreated`, `email`, `user_id`) VALUES
(1, 1, 'my first comment', '2024-02-21 15:55:16', 'test@test.it', 0),
(2, 2, 'my second comment', '2024-02-21 15:55:16', 'test2@test.it', 0),
(5, 1, 'my third comment', '2024-02-21 15:57:27', 'test@test.it', 0),
(6, 1, 'Comment from form', '2024-02-21 17:33:40', 'alessiomirra@gmail.com', 0),
(7, 3, 'First!', '2024-02-21 17:34:01', 'alessiomirra@gmail.com', 0),
(8, 4, 'Redirect Test', '2024-02-21 17:35:02', 'alessiomirra@gmail.com', 0),
(22, 7, 'Comment da utente loggato\r\n', '2024-02-24 15:04:00', NULL, 1),
(23, 7, 'Commento da utente non loggato', '2024-02-24 15:11:20', 'alessiomirra97@gmail.com', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(12) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `fiscalcode` char(16) NOT NULL,
  `age` smallint(3) UNSIGNED NOT NULL,
  `avatar` varchar(64) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `roletype` enum('admin','editor','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `fiscalcode`, `age`, `avatar`, `password`, `roletype`) VALUES
(1, 'alessio@gmail.com', 'alessio@gmail.com', '', 0, NULL, '$2y$10$EsE4C7b28H4evm0AjcxRtOne.H6xEswckkzZOXmUfd5AXs2FzLHai', 'user');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_title` (`title`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indici per le tabelle `postscomments`
--
ALTER TABLE `postscomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_post_id` (`post_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_fiscalcode` (`fiscalcode`),
  ADD KEY `i_email` (`email`),
  ADD KEY `i_username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `postscomments`
--
ALTER TABLE `postscomments`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `postscomments`
--
ALTER TABLE `postscomments`
  ADD CONSTRAINT `fk_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
