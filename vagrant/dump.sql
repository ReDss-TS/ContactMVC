-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Жов 30 2017 р., 21:37
-- Версія сервера: 5.7.18
-- Версія PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `contact_record`
--

-- --------------------------------------------------------

--
-- Структура таблиці `contact_address`
--

CREATE TABLE `contact_address` (
  `id` int(11) NOT NULL,
  `contactId` int(11) NOT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `contact_address`
--

INSERT INTO `contact_address` (`id`, `contactId`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `birthday`) VALUES
(3, 3, '<div>', '3/3', '56757', 'Lviv', '79000', 'Ukraine', '12.12.20127'),
(4, 4, 'Valova 7', '12', 'Kyiv', 'Kyiv', '16000', 'Ukraine', '01.01.2000'),
(5, 5, 'Zelena str.', '4/5', 'Ternopil', 'Ternopil', '46000', 'Ukraine', '07.04.1995'),
(6, 6, 'Green St. 2', '44', 'Ternopil', 'Ternopil', '46000', 'Ukraine', '01.01.2005'),
(8, 8, 'qwerty', 'qwrqwr', 'qwrqwr', 'qrqwr', '46000', 'Ukraine', '17.15.1990'),
(11, 11, '235235', '235235', '235235', '235235', '235235', '235235', '01.01.2000'),
(12, 12, 'Heroiv UPA', '3/3', 'Lviv', 'Lviv', '46000', 'Ukraine', '01.01.2000'),
(13, 13, 'Heroiv', '4/5', 'Zolochiv', 'Lviv', '80700', 'Ukraine', '01.01.2000'),
(14, 14, 'Green St. 2', '3', 'Ternopil', 'Ternopil', '46000', 'Ukraine', '17.12.1990'),
(15, 15, 'Green St. 2', '4', 'Ternopil', 'Ternopil', '46000', 'Ukraine', '07.04.1995'),
(16, 16, 'Green', '2\"//**', 'Ternop\'il', 'Ternop\'il', '46000', 'Ukraine', '01.01.2005'),
(17, 17, 'gjhg', 'hjgj', 'ghj', 'gjhg', '12345', 'tyutyu', '22.05.1987'),
(18, 18, 'Green', 'jkhjkhjk', 'Ternopil', 'Ternopil', '46000', 'qwertyui', '22.06.1987'),
(22, 22, 'Green', '5', 'Ternopil', 'Ternopil', '46000', 'Ukraine', '07.04.1995'),
(23, 23, 'Green St. 2', '2/5', 'Ternopil', 'Ternopil', '46000', 'Ukraine', '18.05.1995'),
(26, 26, 'pioo', '4', 'piuu', 'poiu', '78545', 'Ukraine', '17.08.1990'),
(27, 27, 'Green St. 2', '2', 'Ternopil', 'Ternopil', '46000', 'Ukraine', '17.12.1990'),
(28, 28, 'ss', 'ss', 'ss', 'ss', '12345', 'ss', '22.06.1987'),
(29, 29, 'Green St. 2', ' dsfd', 'kjhjkh', 'hjkh', '12345', 'ss', '01.01.2000'),
(30, 30, 'Green St. 2', '7', 'Ternopil', 'Ternopil', '46000', 'Ukraine', '01.01.2001'),
(31, 31, 'Green St. 2', '4', 'Ternopil', 'Ternopil', '46000', 'Ukraine', '17.12.1990'),
(32, 32, 'Green St. 2', '5', 'Ternopil', 'Ternopil', '46000', 'Ukraine', '07.04.1995'),
(59, 71, '000', '000', '0000', '0000', '78458', '0000', '01.01.2001'),
(62, 74, '987', '987', '97', '98', '79000', '798', '04.05.2015'),
(63, 75, 'jgjh', 'hihh', 'iuyiuy', 'yiy', '55555', 'Ukraine', '01.01.2000'),
(64, 76, '87897', '98798', '77987', '987987', '55555', 'kjhk', '01.01.2000'),
(65, 77, 'ghjgh', 'jhg', 'jhg', 'hjg', '77777', 'jhgjhg', '01.01.2000'),
(66, 78, '678', '6', '786', '86', '78654', '786', '03.04.2012'),
(67, 79, '987', '987', '987', '89743', '98744', '97', '07.04.1995');

-- --------------------------------------------------------

--
-- Структура таблиці `contact_list`
--

CREATE TABLE `contact_list` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `favoritePhone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `contact_list`
--

INSERT INTO `contact_list` (`id`, `userId`, `firstName`, `lastName`, `email`, `favoritePhone`) VALUES
(3, 1, '<div>Nazar<script>', 'Nazarenko', 'nazar.nazarenko@gmail.com', 2),
(4, 1, 'Petro', 'Petrenko', 'Petro.Petrenko@gmail.com', 1),
(5, 1, 'Bogdan', 'Bogdanovych', 'Bogdan.Bogdanovych@gmail.com', 1),
(6, 1, 'Stanislav', 'Olegovych', 'Stanislav.Olegovych@gmail.com', 2),
(8, 1, 'Oleg', 'Olegovych', 'oleg.olegovych@gmail.com', 3),
(11, 1, '23523', '23555', '235235@GMAIL.COM', 3),
(12, 2, 'Pavlo', 'Pavlovych', 'pavlo.pavlovych22@gmail.com', 2),
(13, 1, 'name', 'surname', 'name@gmail.com', 3),
(14, 1, 'kolya', 'kolya', 'kolya@gmail.com', 2),
(15, 1, 'First Name', 'Last Name', 'Email@email.com', 3),
(16, 1, 'Nam\'e', 'Las\'t Nam\"e', 'myEmail@gmail.com', 1),
(17, 1, 'kjhj', 'hkjhkj', 'jkhkjh@sdf.sdf', 1),
(18, 5, 'hjkh', 'hkjhkj', 'hjkhk@hjkh.kj', 2),
(22, 1, 'Stanislav', 'Tarasenko', 'taraser123@gmail.com', 3),
(23, 1, 'qwerty', 'qwerty', 'qwerty@gmail.com', 1),
(26, 1, 'poiu', 'poiu', 'poii@gmail.com', 1),
(27, 1, 'qwqwer', 'qwr2', 'qwr@gmail.com', 1),
(28, 1, 'roman', 'roman', 'roman@sdd.sad', 1),
(29, 1, 'romio', 'romio', 'romio@dfdfd.df', 3),
(30, 1, 'qqq', 'qqq', 'qqq@gmj.fjj', 1),
(31, 1, 'ggfxf', 'ggfxf', 'ggfxf@gmail.com', 3),
(32, 1, 'Stanislav', 'Olegovych', 'taraser123@gmail.com', 3),
(71, 1, '0001', '0001', 'ttff@gmail.com', 2),
(74, 1, '987987', '987', 'tttsttt@gmail.com', 2),
(75, 1, '897', '987', '987@gmail.com', 3),
(76, 1, '7987', '89', '7987@gmail.com', 3),
(77, 1, '7678', '6876', '8768@gmail.com', 1),
(78, 1, '87687', '76', '876@gnail.com', 2),
(79, 1, '7', '8978', '978@gmail.com', 2);

-- --------------------------------------------------------

--
-- Структура таблиці `contact_phones`
--

CREATE TABLE `contact_phones` (
  `id` int(11) NOT NULL,
  `contactId` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `phoneType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `contact_phones`
--

INSERT INTO `contact_phones` (`id`, `contactId`, `phone`, `phoneType`) VALUES
(10, 3, '123-1234-1234', 1),
(11, 3, '123-1234-1234', 2),
(12, 3, '123-1234-1234', 3),
(13, 4, '0000', 1),
(14, 4, '9999', 2),
(15, 4, '8888', 3),
(16, 5, '4444', 1),
(17, 5, '5555', 2),
(18, 5, '6666', 3),
(19, 6, '123123', 1),
(20, 6, '321321', 2),
(21, 6, '231231', 3),
(25, 8, '654321', 1),
(26, 8, '543122', 2),
(27, 8, '521423', 3),
(33, 11, '111-1111-1111', 3),
(38, 12, '212121', 2),
(39, 12, '333433', 3),
(40, 12, '343434', 1),
(41, 13, '363-4664-5665', 1),
(42, 13, '363-4664-5665', 2),
(43, 13, '363-4664-5665', 3),
(47, 14, '111-1111-1111', 1),
(48, 14, '222-2222-2222', 2),
(49, 14, '333-3333-3333', 3),
(53, 15, '111-1111-1111', 1),
(54, 15, '222-2222-2222', 2),
(55, 15, '333-3333-3333', 3),
(56, 16, '111-1111-1111', 1),
(57, 16, '222-2222-2222', 2),
(58, 16, '333-3333-3333', 3),
(71, 17, '786-1234-1234', 1),
(72, 17, '786-1234-1234', 2),
(73, 17, '786-1234-1234', 3),
(74, 18, '123-1234-1234', 1),
(75, 18, '123-1234-1234', 2),
(76, 18, '123-1234-1234', 3),
(86, 22, '777-7777-7777', 1),
(87, 22, '777-7777-7777', 2),
(88, 22, '555-5555-5555', 3),
(92, 23, '111-1111-1111', 1),
(93, 23, '222-2222-2222', 2),
(94, 23, '333-3333-3333', 3),
(101, 26, '333-3333-3333', 1),
(102, 26, '333-3333-3333', 2),
(103, 26, '333-3333-3333', 3),
(113, 11, '111-1111-1111', 1),
(114, 11, '111-1111-1111', 2),
(131, 27, '111-1111-1111', 1),
(132, 27, '222-2222-2222', 2),
(133, 27, '333-3333-3333', 3),
(137, 28, '111-1111-1111', 1),
(138, 28, '123-1234-1235', 2),
(139, 28, '123-1234-1234', 3),
(140, 29, '111-1111-1111', 1),
(141, 29, '123-1234-1236', 2),
(142, 29, '123-1234-1234', 3),
(149, 30, '111-1111-1111', 1),
(150, 30, '222-2222-2222', 2),
(151, 30, '333-3333-3333', 3),
(152, 31, '111-1111-1111', 1),
(153, 31, '123-1234-1234', 2),
(154, 31, '222-2222-2277', 3),
(155, 32, '111-1111-1111', 1),
(156, 32, '222-2222-2222', 2),
(157, 32, '333-3333-3378', 3),
(203, 71, '111-1111-1111', 1),
(204, 71, '444-4444-4444', 2),
(205, 71, '333-3333-3333', 3),
(233, 74, '111-1111-1111', 1),
(234, 74, '222-2222-2222', 2),
(235, 74, '333-3333-3333', 3),
(236, 75, '111-1111-1111', 1),
(237, 75, '222-2222-2222', 2),
(238, 75, '333-3333-3333', 3),
(239, 76, '111-1111-1111', 1),
(240, 76, '222-2222-2222', 2),
(241, 76, '333-3333-3333', 3),
(242, 77, '111-1111-1111', 1),
(243, 77, '222-2222-2222', 2),
(244, 77, '333-3333-3333', 3),
(245, 78, '111-1111-1111', 1),
(246, 78, '222-2222-2222', 2),
(247, 78, '333-3333-3333', 3),
(248, 79, '111-1111-1111', 1),
(249, 79, '222-2222-2222', 2),
(250, 79, '333-3333-3333', 3);

-- --------------------------------------------------------

--
-- Структура таблиці `phone_types`
--

CREATE TABLE `phone_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `phone_types`
--

INSERT INTO `phone_types` (`id`, `type`) VALUES
(1, 'Home phone'),
(2, 'Work phone'),
(3, 'Cell phone');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `login`, `pass`) VALUES
(1, 'taras', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'qwerty', 'd8578edf8458ce06fbc5bb76a58c5ca4'),
(3, 'user1', '24c9e15e52afc47c225b757e7bee1f9d'),
(4, 'useruser', '5cc32e366c87c4cb49e4309b75f57d64'),
(5, 'romio', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `contact_address`
--
ALTER TABLE `contact_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contactId` (`contactId`);

--
-- Індекси таблиці `contact_list`
--
ALTER TABLE `contact_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId_contactId` (`userId`,`id`);

--
-- Індекси таблиці `contact_phones`
--
ALTER TABLE `contact_phones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contactId_phoneType` (`contactId`,`phoneType`) USING BTREE,
  ADD KEY `phoneType` (`phoneType`);

--
-- Індекси таблиці `phone_types`
--
ALTER TABLE `phone_types`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `contact_address`
--
ALTER TABLE `contact_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT для таблиці `contact_list`
--
ALTER TABLE `contact_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT для таблиці `contact_phones`
--
ALTER TABLE `contact_phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;
--
-- AUTO_INCREMENT для таблиці `phone_types`
--
ALTER TABLE `phone_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `contact_address`
--
ALTER TABLE `contact_address`
  ADD CONSTRAINT `contact_address_ibfk_1` FOREIGN KEY (`contactId`) REFERENCES `contact_list` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `contact_list`
--
ALTER TABLE `contact_list`
  ADD CONSTRAINT `contact_list_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `contact_phones`
--
ALTER TABLE `contact_phones`
  ADD CONSTRAINT `contact_phones_ibfk_1` FOREIGN KEY (`phoneType`) REFERENCES `phone_types` (`id`),
  ADD CONSTRAINT `contact_phones_ibfk_2` FOREIGN KEY (`contactId`) REFERENCES `contact_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
