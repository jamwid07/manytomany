-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 07 2018 г., 15:02
-- Версия сервера: 5.7.20
-- Версия PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Category`
--

INSERT INTO `Category` (`id`, `name`) VALUES
(1, 'Category1'),
(2, 'Category2'),
(3, 'Category3'),
(4, 'Category4'),
(5, 'Category5');

-- --------------------------------------------------------

--
-- Структура таблицы `relation`
--

CREATE TABLE `relation` (
  `review_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `relation`
--

INSERT INTO `relation` (`review_id`, `category_id`) VALUES
(1, 1),
(1, 3),
(1, 5),
(2, 2),
(2, 4),
(14, 4),
(14, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `Review`
--

CREATE TABLE `Review` (
  `id` int(11) NOT NULL,
  `FIO` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Review`
--

INSERT INTO `Review` (`id`, `FIO`, `email`, `text`) VALUES
(1, 'Namazov Jamshid', 'jamwid07@mail.ru', 'Lorem ipsum sit amen. Lorem ipsum sit amen? Lorem ipsum sit amen!'),
(2, 'Семен Семеныч', 'semen@not.mail', 'Это пример для отзыва, он может быть длинным или коротким'),
(14, 'Пал Палыч', 'palich@mail.net', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut beatae consectetur earum magnam provident repellendus soluta tempora! Aperiam consequuntur cumque minima mollitia similique! Labore laudantium, quidem quod ratione rerum vel');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `relation`
--
ALTER TABLE `relation`
  ADD KEY `relation_fk0` (`review_id`),
  ADD KEY `relation_fk1` (`category_id`);

--
-- Индексы таблицы `Review`
--
ALTER TABLE `Review`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Review`
--
ALTER TABLE `Review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `relation`
--
ALTER TABLE `relation`
  ADD CONSTRAINT `relation_fk0` FOREIGN KEY (`review_id`) REFERENCES `Review` (`id`),
  ADD CONSTRAINT `relation_fk1` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
