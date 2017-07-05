-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 05 2017 г., 12:30
-- Версия сервера: 5.6.34
-- Версия PHP: 7.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tabel-tst`
--

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE `employee` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `employee`
--

INSERT INTO `employee` (`id`, `login`, `password`, `f_name`, `l_name`, `s_name`, `supervisor`) VALUES
(7, 'test1', '1', 'f_name', 'l_name', 's_name', 'admin'),
(8, 'test12', '1', 'f_name1', 'l_name2', 's_name', 'admin'),
(9, 'test2', NULL, 'Тест', 'Тестов', 'Тестович', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `main`
--

CREATE TABLE `main` (
  `id_employee` int(6) NOT NULL,
  `my_date` date NOT NULL,
  `hours` tinyint(2) NOT NULL,
  `date_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-рабочий, 1-выходной, 2-праздничный с выходом, 3-больничный, 4-отпуск, 5-отпуск без сожержания',
  `supervisor` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `main`
--

INSERT INTO `main` (`id_employee`, `my_date`, `hours`, `date_type`, `supervisor`) VALUES
(7, '2017-07-02', 0, 1, ''),
(8, '2017-07-02', 0, 1, ''),
(9, '2017-07-02', 0, 1, ''),
(7, '2017-07-02', 0, 1, ''),
(8, '2017-07-02', 0, 1, ''),
(9, '2017-07-02', 0, 1, ''),
(7, '2017-07-02', 0, 1, ''),
(8, '2017-07-02', 0, 1, ''),
(9, '2017-07-02', 0, 1, ''),
(7, '2017-07-02', 0, 1, ''),
(8, '2017-07-02', 0, 1, ''),
(9, '2017-07-02', 0, 1, ''),
(7, '2017-07-02', 0, 1, ''),
(8, '2017-07-02', 0, 1, ''),
(9, '2017-07-02', 0, 1, ''),
(7, '2017-07-01', 2, 1, ''),
(8, '2017-07-01', 2, 1, ''),
(9, '2017-07-01', 2, 1, ''),
(7, '2017-07-03', 4, 0, ''),
(8, '2017-07-03', 4, 0, ''),
(9, '2017-07-03', 4, 0, ''),
(7, '2017-06-29', 4, 0, ''),
(8, '2017-06-29', 4, 0, ''),
(9, '2017-06-29', 4, 0, ''),
(7, '2017-07-05', 5, 0, ''),
(8, '2017-07-05', 5, 0, ''),
(9, '2017-07-05', 5, 0, ''),
(7, '2017-07-06', 2, 0, ''),
(8, '2017-07-06', 2, 0, ''),
(9, '2017-07-06', 2, 0, ''),
(7, '2017-06-28', 5, 0, 'admin'),
(8, '2017-06-28', 5, 0, 'admin'),
(9, '2017-06-28', 5, 0, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `login` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `f_name_user` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `l_name_user` varchar(30) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `f_name_user`, `l_name_user`) VALUES
(1, 'admin', '123', 'Админ', 'Админович'),
(2, 'romdv', ',jhjlf', 'Романьков', 'Даниил'),
(3, 'kadke', 'rfhbyf', 'Кадемалиева', 'Карина');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
