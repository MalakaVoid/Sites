-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 03 2024 г., 14:57
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `city`
--

-- --------------------------------------------------------

--
-- Структура таблицы `disctrict`
--

CREATE TABLE `disctrict` (
  `district_id` int(255) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `disctrict`
--

INSERT INTO `disctrict` (`district_id`, `name`) VALUES
(1, 'ЗАО'),
(2, 'ЦАО'),
(3, 'ВАО'),
(4, 'ЮАО');

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE `region` (
  `region_id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `region`
--

INSERT INTO `region` (`region_id`, `name`, `district_id`) VALUES
(1, 'Кунцевский', 1),
(2, 'Крылатский', 1),
(3, 'Арбатский', 2),
(4, 'Киевский', 2),
(5, 'Преображенский', 3),
(6, 'Сокольнический', 3),
(7, 'Юго-западный', 4),
(8, 'Комунаркский', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `street`
--

CREATE TABLE `street` (
  `street_id` int(255) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `street`
--

INSERT INTO `street` (`street_id`, `name`, `region_id`) VALUES
(1, 'Кунцевская', 1),
(2, 'Кунцевская 2', 1),
(3, 'Крылатский', 2),
(4, 'Крылатский 2', 2),
(5, 'Арбатский', 3),
(6, 'Арбатский 2', 3),
(7, 'Киевский', 4),
(8, 'Киевский 2', 4),
(9, 'Преображенский', 5),
(10, 'Преображенский 2', 5),
(11, 'Сокольнический', 6),
(12, 'Сокольническая 2', 6),
(13, 'Юго западная', 7),
(14, 'Юго западная 2', 7),
(15, 'Комунарская', 8),
(16, 'Комунарская 2', 8);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `disctrict`
--
ALTER TABLE `disctrict`
  ADD PRIMARY KEY (`district_id`);

--
-- Индексы таблицы `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`region_id`);

--
-- Индексы таблицы `street`
--
ALTER TABLE `street`
  ADD PRIMARY KEY (`street_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `disctrict`
--
ALTER TABLE `disctrict`
  MODIFY `district_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `region`
--
ALTER TABLE `region`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `street`
--
ALTER TABLE `street`
  MODIFY `street_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
