-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 15 2023 г., 17:39
-- Версия сервера: 10.4.24-MariaDB
-- Версия PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gallery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `name`) VALUES
(1, 'пейзаж'),
(2, 'портрет'),
(3, 'животные'),
(4, 'натюрморт');

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `id_photo` int(11) NOT NULL,
  `name_photo` varchar(255) DEFAULT NULL,
  `category_id` int(50) NOT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `download_count` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`id_photo`, `name_photo`, `category_id`, `img_path`, `date_added`, `download_count`, `author_id`) VALUES
(15, 'Дыня и Виноград', 4, './img/92381_ciemne_winogrona_melon_gliniane_naczynia.jpg', '2023-07-06 19:52:23', 4, 15),
(16, 'Закат', 1, './img/75ca72d27550975ef17ce3c456549a54.jpeg', '2023-07-06 19:53:12', 3, 15),
(17, 'Черно-белый фильтр', 2, './img/face-white-black-women-monochrome-model-portrait-long-hair-looking-at-viewer-photography-hair-Person-skin-head-girl-beauty-smile-eye-woman-lady-darkness-black-and-white-monochrome-photography-portrait-photogr.jpg', '2023-07-06 19:54:47', 2, 3),
(18, 'Зайчик', 3, './img/226764f441ab68fed1cc52d8e12be6c6.jpeg', '2023-07-06 19:55:02', 2, 3),
(19, 'Виноград гранат лимон', 4, './img/1152767.jpg', '2023-07-06 19:56:08', 0, 2),
(20, 'Без фильтров', 2, './img/lods-franck-claire-devushka-shatenka-krasotka-pricheska-maki.jpg', '2023-07-06 19:56:25', 0, 2),
(21, 'Красота природы', 1, './img/216912_gory_jezioro_drzewa_odbicie_przebijajace_swiatlo.jpg', '2023-07-06 19:57:50', 0, 10),
(22, 'Кошечка', 3, './img/RD2-n_M281k.jpg', '2023-07-06 19:58:05', 1, 10),
(23, 'Белый тигр', 3, './img/996ad4e6995214bc4f3bf9135d79c853.jpeg', '2023-07-06 19:59:28', 0, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`) VALUES
(1, 'Ann', 'ansha1234'),
(2, 'Яков', 'password1'),
(3, 'Алена', '123456'),
(10, 'Алиса', 'алиса81'),
(15, 'Олеся', 'олеся1234'),
(19, 'Оксана', '1234');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `fk_author` (`author_id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id_category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
