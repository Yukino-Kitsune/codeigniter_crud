-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 192.168.192.42:3306
-- Время создания: Июл 03 2023 г., 18:46
-- Версия сервера: 8.0.32
-- Версия PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crud_db`
--

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`) VALUES
(1, 'МОСб-191'),
(2, 'МОСб-192');

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `name`, `surname`, `group_id`) VALUES
(1, 'Анатолий', 'Петров', 2),
(2, 'Дмитрий', 'Владимиров', 1),
(3, 'Андрей', 'Ковтунов', 2),
(4, 'lul1', 'lul2', 2),
(6, '1234', '123', 2),
(7, 'god', 'Rare', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
