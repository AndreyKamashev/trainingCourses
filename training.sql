-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 09 2024 г., 15:26
-- Версия сервера: 5.6.47
-- Версия PHP: 7.2.29

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
(1, 'OES229', 1),
(2, 'OES116', 1),
(3, 'OES111', 1),
(7, 'OES119', 2),
(8, 'OES122', 2),
(9, '10', 3),
(10, 'OES250', 1),
(11, 'DEMO10', 4);

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
(1, 3, 1),
(2, 2, 1),
(3, 1, 1),
(9, 2, 3),
(10, 1, 3),
(11, 9, 4),
(12, 10, 5),
(13, 11, 6);

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
(1, 'Архитектура базы данных'),
(2, 'Веб программирование'),
(3, 'Построение сетей'),
(5, 'Администрирование системы'),
(6, 'Программный инженер'),
(7, 'Демонстрационный курс');

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
(1, '12345678', 'Иван Михайловs', 'jeremy@mail.com', 1),
(3, '01234567', 'Иван Петров', 'conrad@mail.com', 5),
(4, '24000011', 'Дмитрий Песков', 'danny@mail.com', 6),
(5, '88888888', 'Томас Петров', 'thomas@mail.com', 1),
(6, '77777777', 'Иван Демидов', 'demolecturer@mail.com', 7);

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
(7, 6, 7, 'Тест7', 4, 15, 'Random', '2021-12-21 10:21:04', '2021-12-22 10:30:15', 'TZMEQ');

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
(3, 'Тест Тестов', '1111111111', 'teststudent@mail.com', '', 11);

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
(1, 1, 1, 1, '', '', '<p>За что отвечает оператор SELECT?</p>\r\n', '<p>Добавление в БД</p>', '<p>Выбор строки из БД</p>', '<p>Обновление БД</p>', '<p>Удаление из БД</p>', '<p>Очистка БД</p>', '', '', '', '', '', 'B', 1550225760, 1550225760),
(2, 1, 1, 1, '', '', '<p>Системами управления базами данных (СУБД) называют?</p>', '<p>Комплекс программных и языковых средств, необходимых для создания, администрирования и использования баз данных</p>', '<p>Совокупность программных средств для управления данными, хранящимися в удаленном сервере</p>', '<p>Программное средство для управления целостности объектов баз данных</p>', '<p>Комплекс программных и языковых средств, позволяющих манипулировать данными, хранящимися в клиентском приложении</p>', '<p>Комплекс программных и языковых средств, позволяющих выбирать данные</p>', '', '', '', '', '', 'A', 1550225952, 1550225952),
(3, 1, 1, 1, 'd166959dabe9a81e4567dc44021ea503.jpg', 'image/jpeg', '<p>Взаимодействие пользователя с СУБД происходит через?</p>', '<p>Базу данных.</p>', '<p>Удаленное клиентское приложение.</p>', '<p>Веб-сервер.</p>', '<p>Прикладную программу.</p>', '<p>Локальное клиентское приложение.</p>', '', '', '', '', '', 'D', 1550226174, 1550226174),
(5, 3, 5, 1, '', '', '<p>Вопрос</p>', '<p>NULL</p>', '<p>NaN</p>', '<p>0</p>', '<p>1</p>', '<p>-1</p>', '', '', '', '', '', 'C', 1550289702, 1550289724),
(6, 3, 5, 1, '98a79c067fefca323c56ed0f8d1cac5f.png', 'image/png', '<p>Nomor berapakah ini?</p>', '<p>Sembilan</p>', '<p>Sepuluh</p>', '<p>Satu</p>', '<p>Tujuh</p>', '<p>Tiga</p>', '', '', '', '', '', 'D', 1550289774, 1550289774),
(7, 4, 6, 5, '', '', '<p>Is this a demo test?</p>', '<p>Ye</p>', '<p>Yes</p>', '<p>No</p>', '<p>None</p>', '<p>All</p>', '', '', '', '', '', 'B', 1639498101, 1639498101),
(8, 4, 6, 5, '', '', '<p>Is this a sample question?</p>', '<p>No</p>', '<p>Yes</p>', '<p>None</p>', '<p>All</p>', '<p>Skip</p>', '', '', '', '', '', 'A', 1639502142, 1639502142),
(9, 4, 6, 5, '', '', '<p><span xss=removed>What is the first step in the software development lifecycle?</span><br></p>', 'System Design', '<p>C<span xss=removed>oding</span></p>', '<p>System Testing</p>', '<p><span xss=removed>Preliminary Investigation and Analysis</span><br></p>', '<p>None</p>', '', '', '', '', '', 'D', 1639555791, 1639555791),
(10, 4, 6, 5, '', '', '<p><span xss=removed>What does the study of an existing system refer to?</span><br></p>', '<p>Details of DFD</p>', '<p>Feasibility Study</p>', '<p>System Analysis</p>', '<p>System Planning</p>', '<p>All</p>', '', '', '', '', '', 'C', 1639555845, 1639555845),
(11, 4, 6, 5, '', '', '<p><span xss=removed>Model selection is based on __________.</span><br></p>', '<p>Requirements</p>', '<p>Development teams and users</p>', '<p>Project type and risk</p>', '<p>All of the above</p>', '<p>None</p>', '', '', '', '', '', 'D', 1639555920, 1639555920),
(12, 5, 1, 5, '', '', '<p><span xss=removed>Which of the following is generally used for performing tasks like creating the structure of the relations, deleting relation?</span><br></p>', '<p xss=removed>DML(Data Manipulation Language)</p>', '<p>Query</p>', '<p>Relational Schema</p>', '<p>DDL(Data Definition Language)</p>', '<p>None</p>', '', '', '', '', '', 'D', 1639847266, 1639847266),
(13, 5, 1, 5, '', '', '<p><span xss=removed>Which one of the following given statements possibly contains the error?</span><br></p>', '<p><span xss=removed>select * from emp where empid = 10003;</span><br></p>', '<p><span xss=removed>select empid from emp where empid = 10006;</span><br></p>', '<p><span xss=removed>select empid from emp;</span><br></p>', '<p><span xss=removed>select empid where empid = 1009 and Lastname = \'GELLER\';</span><br></p>', '<p>select * from emp WHERE empname = \"NONE\";</p>', '', '', '', '', '', 'D', 1639847413, 1639847413),
(14, 5, 1, 5, '', '', '<p><span xss=removed>What do you mean by one to many relationships?</span><br></p>', '<p><span xss=removed>One class may have many teachers</span><br></p>', '<p><span xss=removed>One teacher can have many classes</span><br></p>', '<p><span xss=removed>Many classes may have many teachers</span><br></p>', '<p><span xss=removed>Many teachers may have many classes</span><br></p>', '<p>All of above</p>', '', '', '', '', '', 'B', 1639847466, 1639847466),
(15, 5, 1, 5, '', '', '<p><span xss=removed>The term \"FAT\" is stands for?</span><br></p>', '<p><span xss=removed>File Allocation Tree</span><br></p>', '<p xss=removed>File Allocation Table</p>', '<p>File Allocation Graph</p>', '<p>All of above</p>', '<p>None of above</p>', '', '', '', '', '', 'B', 1639847554, 1639847554),
(16, 5, 1, 5, '', '', '<p><span xss=removed>Which of the following can be considered as the maximum size that is supported by FAT?</span><br></p>', '<p>8 GB</p>', '<p>4 GB</p>', '<p>512 GB</p>', '<p>4 TB</p>', '<p>None of above</p>', '', '', '', '', '', 'B', 1639847621, 1639847621),
(17, 6, 7, 5, '', '', '<p>Demo Ques?</p>', '<p>Choose Here</p>', '<p>Choose Here 2</p>', '<p>Choose Here 3</p>', '<p>Choose Here 4</p>', '<p>None</p>', '', '', '', '', '', 'A', 1640061233, 1640061233),
(18, 6, 7, 5, '', '', '<p>Demo Ques 2?</p>', '<p>Sample</p>', '<p>Sample 2</p>', '<p>Sample 3</p>', '<p>Sample 4</p>', '<p>All of Above</p>', '', '', '', '', '', 'C', 1640061280, 1640061280),
(19, 6, 7, 5, '', '', '<p>Sample Ques 3?</p>', '<p>Demo 1</p>', '<p>Demo 2</p>', '<p>Demo 3</p>', '<p>Demo 4</p>', '<p>All of Above</p>', '', '', '', '', '', 'D', 1640061313, 1640061313),
(20, 6, 7, 5, '', '', '<p>Ques 4? Ques 4?</p>', 'Sample Ans 1', '<p>Sample Ans 2</p>', '<p>Sample Ans 3</p>', '<p>Sample Ans 4</p>', '<p>Sample Ans 5</p>', '', '', '', '', '', 'E', 1640061360, 1640061360);

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
(1, 'Информационные системы'),
(2, 'Техническая информация'),
(3, 'Программирование'),
(4, 'Демонстрационная');

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
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(6, 5, 2),
(7, 6, 3),
(8, 7, 4);

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
(1, '127.0.0.1', 'Администратор', '$2y$12$JjM5xBghu01DOMBL4./8M.V54I2CIuLNqQ1dHTRPbnHCprQRa3FKq', 'admin@mail.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1712499268, 1, 'Иван', 'Иванов', 'ADMIN', '0'),
(3, '::1', '12183018', '$2y$10$TLtlU8WsPUBQgLWcL5n8SO9YoTd1jDktGIkIvm9Fk2ROI0yJQ.TlC', 'steeve@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1550225511, 1712663449, 1, 'Владимир', 'Сухой', NULL, NULL),
(4, '::1', '12345678', '$2y$10$9CxUKgrB/0tlgOEIec1Fl.RMrLLcpJPGyFqqRh2gec.crgeVBWvym', 'jeremy@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1550226286, 1712663334, 1, 'Иван ', 'Михайлов', NULL, NULL),
(8, '::1', '01234567', '$2y$10$5pAJAyB3XvrGEkvGak2QI.1pWqwK/S76r3Pf4ltQSGQzLMpw53Tvy', 'conrad@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1550289356, 1711968162, 1, 'Джон', 'Смитт', NULL, NULL),
(9, '::1', '01112004', '$2y$10$bjU.7aM7ZiVTqLh/SPwSeO0iMmDtX.HDlc22DUAiNjlVqbAtTGvA2', 'demostd@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1639498020, 1712499602, 1, 'Demo', 'Student', NULL, NULL),
(10, '::1', '24000011', '$2y$10$OcwaL9G18Z62JLSgAWBBW.wP1DS0m0eNa8yHGKf5P4xhu97VJJBzO', 'danny@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1639498362, 1639845648, 1, 'Денни', 'Тест', NULL, NULL),
(11, '::1', '88888888', '$2y$10$Hzz3dl6vSQnrve6ZglW/1OFqX0FlUn0MtvnkRBQ0B9EaoKvNJGRsi', 'thomas@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1639670971, 1711968306, 1, 'Томас', 'Томас', NULL, NULL),
(12, '::1', '77777777', '$2y$10$OdDzP0IF2JwOLoOsBgFj3.GN.viBu2wmF5hQCk0PGbdxmeYgBsrtS', 'demolecturer@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1640061049, 1640158156, 1, 'Demo', 'Lecturer', NULL, NULL),
(13, '::1', '1111111111', '$2y$10$gRsfuWMe6ina/FSQL76OLetEat9r6qIHkqLa5W4kVhuzH9963hNk2', 'teststudent@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1640061112, 1711968416, 1, 'Test', 'Student', NULL, NULL);

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
(6, 4, 2),
(10, 8, 2),
(11, 9, 3),
(12, 10, 2),
(13, 11, 2),
(14, 12, 2),
(15, 13, 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id_lecturer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `m_ujian`
--
ALTER TABLE `m_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id_questions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id_students` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id_themes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `themes_courses`
--
ALTER TABLE `themes_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
