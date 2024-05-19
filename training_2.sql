-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 19 2024 г., 20:15
-- Версия сервера: 5.6.51
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `training`
--

-- --------------------------------------------------------

--
-- Структура таблицы `classes`
--

CREATE TABLE `classes` (
  `id_classes` int(11) NOT NULL,
  `name_classes` varchar(30) NOT NULL,
  `themes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `classes`
--

INSERT INTO `classes` (`id_classes`, `name_classes`, `themes_id`) VALUES
(1, 'АА-19-04', 1),
(2, 'АСМ-21-05', 1),
(3, 'АСМ-21-04', 1),
(7, 'АС-20-04', 2),
(8, 'АА-20-05', 2),
(9, 'АСМ-22-04', 10),
(10, 'АА-19-05', 1),
(11, 'АСМ-22-05', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `classes_lecturer`
--

CREATE TABLE `classes_lecturer` (
  `id` int(11) NOT NULL,
  `classes_id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `classes_lecturer`
--

INSERT INTO `classes_lecturer` (`id`, `classes_id`, `lecturer_id`) VALUES
(15, 9, 7),
(16, 11, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE `courses` (
  `id_courses` int(11) NOT NULL,
  `name_courses` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id_courses`, `name_courses`) VALUES
(1, 'Понимание профессии системного аналитика'),
(2, 'Разработка требований'),
(3, 'Использование agile - методологии'),
(5, 'SQL для аналитиков'),
(6, 'Форматы хранения и передачи данных'),
(7, 'Жизненный цикл ПО');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'Lecturer', 'Преподаватели'),
(3, 'Student', 'Студенты');

-- --------------------------------------------------------

--
-- Структура таблицы `h_ujian`
--

CREATE TABLE `h_ujian` (
  `id` int(11) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `students_id` int(11) NOT NULL,
  `list_soal` longtext NOT NULL,
  `list_jawaban` longtext NOT NULL,
  `jml_benar` int(11) NOT NULL,
  `nilai` decimal(10,2) NOT NULL,
  `nilai_bobot` decimal(10,2) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `h_ujian`
--

INSERT INTO `h_ujian` (`id`, `ujian_id`, `students_id`, `list_soal`, `list_jawaban`, `jml_benar`, `nilai`, `nilai_bobot`, `tgl_mulai`, `tgl_selesai`, `status`) VALUES
(1, 1, 1, '1,2,3', '1:B:N,2:A:N,3:D:N', 3, '100.00', '100.00', '2019-02-16 08:35:05', '2019-02-16 08:36:05', 'N'),
(2, 2, 1, '3,2,1', '3:D:N,2:C:N,1:D:N', 1, '33.00', '100.00', '2019-02-16 10:11:14', '2019-02-16 10:12:14', 'N'),
(3, 3, 1, '5,6', '5:C:N,6:D:N', 2, '100.00', '100.00', '2019-02-16 11:06:25', '2019-02-16 11:07:25', 'N'),
(4, 5, 2, '9,8,10,7,11', '9:D:N,8:B:N,10:C:N,7:B:N,11:D:N', 4, '80.00', '500.00', '2021-12-15 15:21:23', '2021-12-16 00:36:23', 'N'),
(5, 7, 3, '20,17,18,19', '20:E:N,17:C:N,18:C:N,19:D:N', 3, '75.00', '500.00', '2021-12-21 11:41:07', '2021-12-21 11:56:07', 'N');

-- --------------------------------------------------------

--
-- Структура таблицы `lecturer`
--

CREATE TABLE `lecturer` (
  `id_lecturer` int(11) NOT NULL,
  `nip` char(12) NOT NULL,
  `name_lecturer` varchar(50) NOT NULL,
  `email` varchar(254) NOT NULL,
  `courses_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lecturer`
--

INSERT INTO `lecturer` (`id_lecturer`, `nip`, `name_lecturer`, `email`, `courses_id`) VALUES
(1, '12345678', 'Иван Михайлов', 'mihailov@bk.ru', 2),
(3, '01234567', 'Иван Петров', 'petrov@mail.com', 1),
(4, '24000011', 'Дмитрий Песков', 'peskov@mail.com', 6),
(5, '88888888', 'Томас Петров', 'thomas@mail.com', 2),
(6, '77777777', 'Иван Демидов', 'demidov@mail.com', 1),
(7, '10000007', 'Камашев Андрей', 'kamashev.andrej@bk.ru', 5);

--
-- Триггеры `lecturer`
--
DELIMITER $$
CREATE TRIGGER `edit_user_lecturer` BEFORE UPDATE ON `lecturer` FOR EACH ROW UPDATE `users` SET `email` = NEW.email, `username` = NEW.nip WHERE `users`.`username` = OLD.nip
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_user_lecturer` BEFORE DELETE ON `lecturer` FOR EACH ROW DELETE FROM `users` WHERE `users`.`username` = OLD.nip
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `m_ujian`
--

CREATE TABLE `m_ujian` (
  `id_ujian` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `courses_id` int(11) NOT NULL,
  `name_ujian` varchar(200) NOT NULL,
  `jumlah_soal` int(11) NOT NULL,
  `waktu` int(11) NOT NULL,
  `jenis` enum('Random','Sort') NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `terlambat` datetime NOT NULL,
  `token` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `m_ujian`
--

INSERT INTO `m_ujian` (`id_ujian`, `lecturer_id`, `courses_id`, `name_ujian`, `jumlah_soal`, `waktu`, `jenis`, `tgl_mulai`, `terlambat`, `token`) VALUES
(1, 1, 1, 'Тест1', 3, 1, 'Random', '2019-02-15 17:25:40', '2019-02-20 17:25:44', 'DPEHL'),
(2, 1, 1, 'Тест2', 3, 1, 'Random', '2019-02-16 10:05:08', '2019-02-17 10:05:10', 'GOEMB'),
(3, 3, 5, 'Тест3', 2, 1, 'Random', '2019-02-16 07:00:00', '2019-02-28 14:00:00', 'GETQB'),
(4, 4, 6, 'Тест4', 3, 3, 'Sort', '2021-12-15 11:22:15', '2021-12-15 11:22:18', 'LZXHW'),
(5, 4, 6, 'Тест5', 5, 555, 'Random', '2021-12-14 13:25:51', '2021-12-15 20:07:53', 'ESEHT'),
(6, 5, 1, 'Тест6', 4, 9, 'Sort', '2021-12-20 16:59:10', '2021-12-20 17:08:10', 'BTIMQ'),
(7, 6, 7, 'Тест7', 4, 15, 'Random', '2021-12-21 10:21:04', '2021-12-22 10:30:15', 'TZMEQ'),
(8, 7, 5, 'TEST1', 3, 10, 'Random', '2024-05-19 20:10:48', '2024-06-21 20:10:53', 'TZAFI');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id_questions` int(11) NOT NULL,
  `name_questions` varchar(5000) NOT NULL,
  `name_answers` varchar(5000) NOT NULL,
  `score` decimal(10,2) NOT NULL COMMENT 'оценка',
  `date_questions` date DEFAULT NULL,
  `date_answers` date DEFAULT NULL,
  `lecturer_id` int(11) NOT NULL,
  `students_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id_questions`, `name_questions`, `name_answers`, `score`, `date_questions`, `date_answers`, `lecturer_id`, `students_id`) VALUES
(1, 'Что такое железо?', '<ol><li style=\"text-align: justify;\"><font color=\"#000000\" style=\"background-color: rgb(206, 198, 206);\">ЖЕЛЕ́ЗО, -а, ср. 1. Химический элемент, тяжелый ковкий металл серебристого цвета, образующий в соединении с углеродом сталь и чугун. 2. Обиходное название малоуглеродистых сталей. Изделия из железа. || собир. Изделия из этого металла. Листовое железо. Кровельное железо. 3. Разг. Лекарство, содержащее железистые 1 вещества. Прописать железо. 4. мн. ч. (желе́зы, - ле́з). Устар. Цепи, оковы.2222</font></li></ol>', '15.00', '2024-04-07', '2024-04-09', 1, 1),
(2, 'Что такое кремний?', '<ol><li style=\"text-align: justify; line-height: 1.6;\"><b>впагпфцкафцрмлфшуоамлд</b></li></ol>', '3.00', NULL, '2024-04-09', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id_students` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nim` char(20) NOT NULL,
  `email` varchar(254) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `classes_id` int(11) NOT NULL COMMENT 'classes&themes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id_students`, `name`, `nim`, `email`, `jenis_kelamin`, `classes_id`) VALUES
(1, 'Владимир Сухой', '12183018', 'liamoore@mail.com', '', 1),
(2, 'Николай Сидоров', '01112004', 'demostd@mail.com', '', 9),
(3, 'Тест Тестов', '1111111111', 'teststudent@mail.com', '', 11),
(4, 'Болгар Илья', '10000004', 'bolgar@bk.ru', '', 9),
(5, 'Мельников Алексей', '10000005', 'melnikov@bk.ru', '', 9),
(6, 'Кузнецова Дарья', '10000006', 'kuznetsova@bk.ru', '', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `tb_soal`
--

CREATE TABLE `tb_soal` (
  `id_soal` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `courses_id` int(11) NOT NULL,
  `bobot` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tipe_file` varchar(50) NOT NULL,
  `soal` longtext NOT NULL,
  `opsi_a` longtext NOT NULL,
  `opsi_b` longtext NOT NULL,
  `opsi_c` longtext NOT NULL,
  `opsi_d` longtext NOT NULL,
  `opsi_e` longtext NOT NULL,
  `file_a` varchar(255) NOT NULL,
  `file_b` varchar(255) NOT NULL,
  `file_c` varchar(255) NOT NULL,
  `file_d` varchar(255) NOT NULL,
  `file_e` varchar(255) NOT NULL,
  `jawaban` varchar(5) NOT NULL,
  `created_on` int(11) NOT NULL,
  `updated_on` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tb_soal`
--

INSERT INTO `tb_soal` (`id_soal`, `lecturer_id`, `courses_id`, `bobot`, `file`, `tipe_file`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `file_a`, `file_b`, `file_c`, `file_d`, `file_e`, `jawaban`, `created_on`, `updated_on`) VALUES
(21, 7, 5, 1, '', '', '<p>Что такое реляционная база данных?</p>', '<p>БД, основанная на иерархической модели</p>', '<p>БД, использующая связи между таблицами</p>', '<p>БД, где данные хранятся в виде деревьев</p>', '<p>БД, использующая графы для представления данных</p>', '<p>БД, где данные хранятся в виде json</p>', '', '', '', '', '', 'B', 1716137677, 1716137677),
(22, 7, 5, 1, '', '', '<p><span xss=removed>Что такое SQL?</span><br></p>', '<p><span xss=removed>Язык программирования для создания веб-приложений</span><br></p>', '<p><span xss=removed>Язык запросов для работы с реляционными базами данных</span><br></p>', '<p><span xss=removed>Язык разметки для создания веб-страниц</span><br></p>', '<p><span xss=removed>Язык программирования для разработки мобильных приложений</span><br></p>', '<p><span xss=removed>Язык программирования для работы с большими данными</span><br></p>', '', '', '', '', '', 'B', 1716138435, 1716138435),
(23, 7, 5, 1, '', '', '<p><span xss=removed>Что такое индекс в базе данных?</span><br></p>', '<p><span xss=removed>Структура данных, упорядочивающая записи в таблице</span><br></p>', '<p><span xss=removed>Таблица, содержащая только уникальные значения</span><br></p>', '<p><span xss=removed>Специальная таблица для хранения метаданных</span><br></p>', '<p><span xss=removed>Метод шифрования данных в базе</span><br></p>', '<p><span xss=removed>Набор правил и ограничений для таблицы</span><br></p>', '', '', '', '', '', 'A', 1716138547, 1716138547),
(24, 7, 5, 1, '', '', '<p><span xss=removed>Что такое нормализация в контексте баз данных?</span><br></p>', '<p><span xss=removed>Процесс оптимизации запросов к базе данных</span><br></p>', '<p><span xss=removed>Процесс создания резервных копий базы данных</span><br></p>', '<p><span xss=removed>Процесс уменьшения дублирования данных и обеспечения целостности</span><br></p>', '<p><span xss=removed>Процесс шифрования данных в базе</span><br></p>', '<p><span xss=removed>Процесс добавления новых полей в таблицу</span><br></p>', '', '', '', '', '', 'C', 1716138631, 1716138631);

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE `themes` (
  `id_themes` int(11) NOT NULL,
  `name_themes` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id_themes`, `name_themes`) VALUES
(1, 'XML'),
(2, 'Методы сбора требований'),
(3, 'Kanban'),
(4, 'JSON'),
(5, 'Задачи и обязанности системног'),
(6, 'Этапы разработки ПО'),
(7, 'ER-диаграмммы'),
(8, 'AgiLE'),
(9, 'SCRUM'),
(10, 'Основы SQL'),
(11, 'Функции агрегирования'),
(12, 'Соединения таблиц');

-- --------------------------------------------------------

--
-- Структура таблицы `themes_courses`
--

CREATE TABLE `themes_courses` (
  `id` int(11) NOT NULL,
  `courses_id` int(11) NOT NULL,
  `themes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `themes_courses`
--

INSERT INTO `themes_courses` (`id`, `courses_id`, `themes_id`) VALUES
(9, 5, 10),
(10, 5, 11),
(11, 5, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) DEFAULT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'Администратор', '$2y$12$JjM5xBghu01DOMBL4./8M.V54I2CIuLNqQ1dHTRPbnHCprQRa3FKq', 'admin@mail.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1716138780, 1, 'Иван', 'Иванов', 'ADMIN', '0'),
(3, '::1', '12183018', '$2y$10$TLtlU8WsPUBQgLWcL5n8SO9YoTd1jDktGIkIvm9Fk2ROI0yJQ.TlC', 'steeve@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1550225511, 1712663449, 1, 'Владимир', 'Сухой', NULL, NULL),
(9, '::1', '01112004', '$2y$10$bjU.7aM7ZiVTqLh/SPwSeO0iMmDtX.HDlc22DUAiNjlVqbAtTGvA2', 'demostd@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1639498020, 1712499602, 1, 'Demo', 'Student', NULL, NULL),
(12, '::1', '77777777', '$2y$10$OdDzP0IF2JwOLoOsBgFj3.GN.viBu2wmF5hQCk0PGbdxmeYgBsrtS', 'demidov@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1640061049, 1640158156, 1, 'Demo', 'Lecturer', NULL, NULL),
(13, '::1', '1111111111', '$2y$10$gRsfuWMe6ina/FSQL76OLetEat9r6qIHkqLa5W4kVhuzH9963hNk2', 'teststudent@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1640061112, 1711968416, 1, 'Test', 'Student', NULL, NULL),
(14, '127.0.0.1', '10000007', '$2y$10$S1Si0sEeSG3BEU9/qAgIa.S1DHD/5xmho5urNa6LmRgZkGPqJ7Bwi', 'kamashev.andrej@bk.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1716137039, 1716138006, 1, 'Камашев', 'Андрей', NULL, NULL),
(15, '127.0.0.1', '10000004', '$2y$10$yYBYPJ4JG9qO02VY3f2myOBCtG6k8vc78xfoa5w7gNYk5RXjN0C76', 'bolgar@bk.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1716137306, NULL, 1, 'Болгар', 'Илья', NULL, NULL),
(16, '127.0.0.1', '10000005', '$2y$10$sTks2WsMCy1t.KP8/ZtnnusdCKatGgNtyQgZ0YDzPzgDC9u7/O8qK', 'melnikov@bk.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1716137347, NULL, 1, 'Мельников', 'Алексей', NULL, NULL),
(17, '127.0.0.1', '10000006', '$2y$10$YxrfyTyHoKuT8aJ4hwAwLeu54ytwVju4vN4EsqpZOoWHCHZjafkg.', 'kuznetsova@bk.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1716137351, NULL, 1, 'Кузнецова', 'Дарья', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(3, 1, 1),
(5, 3, 3),
(11, 9, 3),
(14, 12, 2),
(15, 13, 3),
(16, 14, 2),
(17, 15, 3),
(18, 16, 3),
(19, 17, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id_classes`),
  ADD KEY `themes_id` (`themes_id`);

--
-- Индексы таблицы `classes_lecturer`
--
ALTER TABLE `classes_lecturer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classes_id` (`classes_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_courses`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `h_ujian`
--
ALTER TABLE `h_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ujian_id` (`ujian_id`),
  ADD KEY `students_id` (`students_id`);

--
-- Индексы таблицы `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`id_lecturer`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `courses_id` (`courses_id`);

--
-- Индексы таблицы `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `m_ujian`
--
ALTER TABLE `m_ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `courses_id` (`courses_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_questions`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_students`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `classes_id` (`classes_id`);

--
-- Индексы таблицы `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `courses_id` (`courses_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id_themes`);

--
-- Индексы таблицы `themes_courses`
--
ALTER TABLE `themes_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `themes_id` (`themes_id`),
  ADD KEY `courses_id` (`courses_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`),
  ADD UNIQUE KEY `uc_email` (`email`) USING BTREE;

--
-- Индексы таблицы `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `classes`
--
ALTER TABLE `classes`
  MODIFY `id_classes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `classes_lecturer`
--
ALTER TABLE `classes_lecturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id_courses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `h_ujian`
--
ALTER TABLE `h_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `id_lecturer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `m_ujian`
--
ALTER TABLE `m_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id_questions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id_students` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id_themes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `themes_courses`
--
ALTER TABLE `themes_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `classes_lecturer`
--
ALTER TABLE `classes_lecturer`
  ADD CONSTRAINT `classes_lecturer_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturer` (`id_lecturer`),
  ADD CONSTRAINT `classes_lecturer_ibfk_2` FOREIGN KEY (`classes_id`) REFERENCES `classes` (`id_classes`);

--
-- Ограничения внешнего ключа таблицы `h_ujian`
--
ALTER TABLE `h_ujian`
  ADD CONSTRAINT `h_ujian_ibfk_1` FOREIGN KEY (`ujian_id`) REFERENCES `m_ujian` (`id_ujian`),
  ADD CONSTRAINT `h_ujian_ibfk_2` FOREIGN KEY (`students_id`) REFERENCES `students` (`id_students`);

--
-- Ограничения внешнего ключа таблицы `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `lecturer_ibfk_1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id_courses`);

--
-- Ограничения внешнего ключа таблицы `m_ujian`
--
ALTER TABLE `m_ujian`
  ADD CONSTRAINT `m_ujian_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturer` (`id_lecturer`),
  ADD CONSTRAINT `m_ujian_ibfk_2` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id_courses`);

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`classes_id`) REFERENCES `classes` (`id_classes`);

--
-- Ограничения внешнего ключа таблицы `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD CONSTRAINT `tb_soal_ibfk_1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id_courses`),
  ADD CONSTRAINT `tb_soal_ibfk_2` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturer` (`id_lecturer`);

--
-- Ограничения внешнего ключа таблицы `themes_courses`
--
ALTER TABLE `themes_courses`
  ADD CONSTRAINT `themes_courses_ibfk_1` FOREIGN KEY (`themes_id`) REFERENCES `themes` (`id_themes`),
  ADD CONSTRAINT `themes_courses_ibfk_2` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id_courses`);

--
-- Ограничения внешнего ключа таблицы `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
