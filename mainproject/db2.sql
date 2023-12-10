-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 10 2023 г., 16:22
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
-- База данных: `db2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Бургеры'),
(2, 'Мини-бургеры'),
(3, 'Блюда из курицы'),
(4, 'Закуски'),
(6, 'Соусы'),
(7, 'Напитки');

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `item_id` int(6) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(255) NOT NULL,
  `category` int(255) NOT NULL,
  `sale` tinyint(1) NOT NULL,
  `img` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`item_id`, `title`, `description`, `price`, `category`, `sale`, `img`) VALUES
(1, 'ДРУГ ЛЕСНИКА', 'Бургер с сочной котлетой из мраморной говядины, сыром Чеддер, криспи луком, спелыми помидорами, маринованными опятами, листьями салата латук с соусом ранч с приятным чесночным вкусом', 600, 1, 1, 'images/products/1.png'),
(2, 'DORKY PORKY', 'Бургер с котлетой из мрaморной говядины, жаренным беконом, томатами, листьями салата, маринованным огурцом и фирменным коктейльным соусом', 560, 1, 1, 'images/products/2.png'),
(3, 'БЛЮ ЧИЗ БУРГЕР', 'Бургер с котлетой из мраморной говядины, сыром дор блю,томатами, маринованным огурцом, листьями салата и фирменным коктейльным соусом', 560, 1, 1, '/images/products/3.png'),
(4, 'БРЯНСКИЙ ПАРЕНЬ', 'Бургер с котлетой из мраморной говядины, томатами, грибным рагу, жаренным беконом, маринованным огурцом, листьями салата и коктейльным соусом', 590, 1, 0, '/images/products/4.png'),
(5, 'ДОЧЬ МЯСНИКА', 'Вегетарианский бургер с фалафелем и сальсой из спелых томатов, рубленного лука и кинзы, с листьями салата, соусами тахина из кунжута и луковый кранч', 420, 1, 0, '/images/products/5.png'),
(6, 'ГОРЯЧАЯ ЦЫПА', 'Острый бургер с куриным стейком в хрустящей панировке, салатом Коул-слоу, спелыми помидорами, листьями салата и смесью соусов хойсин и сладкий чили. Подается с хрустящим маринованным огурцом', 500, 1, 0, '/images/products/6.png'),
(7, 'DOUBLE ЧИЗБУРГЕР', 'Чизбургер с двойной котлетой из мрaморной говядины, двойной порцией сыра чеддер, томатами, маринованным огурцом, листьями салата и фирменным коктейльным соусом', 790, 1, 0, '/images/products/7.png'),
(8, 'КОРПОРАТИВ', 'Бургер с сочной котлетой из мраморной говядины, жаренным говяжьим беконом, сыром Чеддер, спелыми помидорами, маринованным огурцом, нежными листьями салата латук, бурбоном, копченным соусом барбекю и сырным соусом на пышной пшеничной булке', 690, 1, 0, '/images/products/8.png'),
(9, 'ТЕТЯ ИЗ БАРСЕЛОНЫ', 'Бургер с сочной котлетой из мрaморной говядины, жареным яйцом, томатами, маринованным огурцом, листьями салата и соусом из запеченного сладкого перца', 590, 1, 0, '/images/products/9.png'),
(10, 'ПАПА МЯСНИКА', 'Бургер с двойной котлетой из мраморной говядины, сыром чеддер, томатами, маринованным огурцом, листьями салата и копченным соусом бaрбекю', 790, 1, 0, '/images/products/10.png'),
(11, 'ГАМБУРГЕР ДЖУНИОР', 'Классический мини-гамбургер с сочной котлетой из мраморной говядины, спелыми помидорами, маринованным огурцом, нежными хрустящими листьями салата латук и фирменным коктейльным соусом', 350, 2, 0, '/images/products/mini1.png'),
(12, 'ЧИЗБУРГЕР ДЖУНИОР', 'Классический мини-чизбургер с сочной котлетой из мраморной говядины, сыром чеддер, спелыми помидорами, маринованным огурцом, нежными хрустящими листьями салата латук, коктейльным и сырным соусами', 420, 2, 0, '/images/products/mini2.png'),
(13, 'КРЫЛЬЯ КУРИНЫЕ 5 ШТ', 'Куриные крылья в хрустящей панировке со специями, подаются с острым соусом и рубленной кинзой', 395, 3, 0, '/images/products/kur1.png'),
(14, 'КРЫЛЬЯ КУРИНЫЕ 10 ШТ', 'Куриные крылья в хрустящей панировке со специями, подаются с острым соусом и рубленной кинзой', 695, 3, 0, '/images/products/kur2.png'),
(15, 'КУРИНАЯ ГРУДКА С ОСТРЫМ МАЙОНЕЗОМ', 'Кусочки нежного куриного филе в хрустящей панировке на листьях салата латук, подаются с острым майонезом', 390, 3, 0, '/images/products/kur3.png'),
(16, 'НАГГЕТСЫ КУРИНЫЕ 9 ШТ', 'Нагеттсы из сочной куриной грудки в хрустящей панировке со специями. Рекомендуем дополнить фирменными соусами', 280, 3, 0, '/images/products/kur4.png'),
(17, 'ЧИЗБОЛЛЫ 6 ШТ', 'Шарики из сыра моцарелла, обжаренные во фритюре. Рекомендуем дополнить фирменными соусами', 410, 4, 0, '/images/products/zak1.png'),
(18, 'КАРТОФЕЛЬ ФРИ 160г', 'Хрустящий картофель фри. Рекомендуем дополнить фирменными соусами', 280, 4, 0, '/images/products/zak2.png'),
(19, 'КАРТОФЕЛЬ КРЕОЛА 200г', 'Ломтики свежего картофеля, обжаренные во фритюре со специями.\r\nРекомендуем дополнить фирменными соусами.', 280, 4, 0, '/images/products/zak3.png'),
(25, 'СОУС БРУСНИЧНЫЙ', 'Соус с нежным кисло-сладким вкусом, приготовленный из спелых ягод брусники. Идеально сочетается со всеми видами мяса и птицей', 80, 6, 0, '/images/products/sous3.png'),
(26, 'ГОРЧИЦА', 'Классическая горчица Хайнц. Вкус умеренно острый', 80, 6, 0, '/images/products/sous2.png'),
(27, 'КЕТЧУП', 'Классический томатный кетчуп Хайнц', 80, 6, 0, '/images/products/sous3.png'),
(30, 'РИЧ КОЛА', 'Газированный безалкогольный напиток. Рекомендуем употреблять охлажденным', 180, 7, 0, '/images/products/nap1.png'),
(31, 'РИЧ КОЛА БЕЗ САХАРА', 'Газированный безалкогольный напиток. Рекомендуем употреблять охлажденным', 180, 7, 0, '/images/products/nap2.png'),
(32, 'РИЧ МАНДАРИН', 'Газированный безалкогольный напиток. Рекомендуем употреблять охлажденным', 180, 7, 0, '/images/products/nap3.png');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_creation_date` datetime DEFAULT NULL,
  `order_arrival_date` datetime DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `addres` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_creation_date`, `order_arrival_date`, `price`, `addres`) VALUES
(14, 1, '2023-12-07 16:17:38', '2023-12-07 17:17:38', 2320, '123'),
(15, 1, '2023-12-07 16:22:42', '2023-12-07 17:22:42', 1800, '222'),
(16, 1, '2023-12-07 16:29:49', '2023-12-07 17:29:49', 1720, '123'),
(17, 1, '2023-12-07 23:08:57', '2023-12-08 00:08:57', 10370, 'sakdmaskd'),
(18, 1, '2023-12-08 01:16:01', '2023-12-08 02:16:01', 2080, '2313');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `order_id`, `item_id`, `amount`) VALUES
(11, 14, 1, 2),
(12, 14, 3, 1),
(13, 14, 2, 1),
(14, 15, 1, 3),
(15, 16, 1, 1),
(16, 16, 2, 1),
(17, 16, 3, 1),
(18, 17, 1, 5),
(19, 17, 2, 5),
(20, 17, 3, 2),
(21, 17, 8, 5),
(22, 18, 1, 1),
(23, 18, 2, 1),
(24, 18, 3, 1),
(25, 18, 25, 1),
(26, 18, 18, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(6) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `first_name`, `last_name`, `email`, `is_admin`) VALUES
(1, 'malaka', 'malaka', 'Даниил', 'Азбукин', 'azbukin2003@gmail.com', 1),
(2, 'test_user1', 'test', 'test', 'test1', 'azbukin2002@gmail.com', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
