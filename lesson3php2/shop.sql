-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 10 2020 г., 14:08
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `goods_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Имя товара.',
  `goods_price` int(11) NOT NULL COMMENT 'Цена товара.',
  `goods_description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Описание товара.',
  `goods_img` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `goods_name`, `goods_price`, `goods_description`, `goods_img`) VALUES
(1, 'Наушники', 3990, 'Супер-пупер наушники.', ''),
(2, 'Клавиатура', 6990, 'Супер-пупер клавиатура.', ''),
(3, 'Мышка', 2990, 'Супер-пупер мышка.', '');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goods_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_login`, `goods_name`) VALUES
(42, 'user1', 'Наушники'),
(43, 'user1', 'Клавиатура'),
(44, 'user1', 'Мышка'),
(45, 'user2', 'Наушники');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_login` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_admin` int(1) NOT NULL DEFAULT 0,
  `user_address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_login`, `user_password`, `user_admin`, `user_address`) VALUES
(18, 'admin', '$2y$10$RE9akemm3MusFALaMc8eIO064yl5a7rWzsWkFIlflCqtAUeA0SRKu', 1, 'World'),
(19, 'user1', '$2y$10$4MIJ6akk94NSTf7fI0p2geBYaPQTVfdbftGJTCuVQgTYzavakPPnW', 0, 'Москва'),
(20, 'user2', '$2y$10$YlLju/CiwgQAGAFRDl/tLOJoV7az/z7ptgzKOQCeimlh.xU5mFM8a', 0, 'Берлин'),
(21, 'user3', '123', 0, 'Лондон');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
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
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
