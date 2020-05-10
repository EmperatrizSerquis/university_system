-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2020 a las 00:25:55
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `university_system`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `associated_courses_and_lecturers`
--

CREATE TABLE `associated_courses_and_lecturers` (
  `id` int(11) NOT NULL,
  `courses_id` int(11) DEFAULT NULL,
  `lecturers_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `associated_courses_and_lecturers`
--

INSERT INTO `associated_courses_and_lecturers` (`id`, `courses_id`, `lecturers_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 1),
(5, 5, 4),
(6, 6, 1),
(7, 8, 3),
(9, 10, 1),
(10, 13, 2),
(11, 12, 3),
(12, 11, 2),
(13, 14, 4),
(14, 15, 3),
(15, 16, 4),
(16, 17, 1),
(17, 18, 1),
(18, 20, 2),
(19, 21, 3),
(20, 22, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `associated_courses_and_students`
--

CREATE TABLE `associated_courses_and_students` (
  `id` int(11) NOT NULL,
  `courses_id` int(11) DEFAULT NULL,
  `students_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `associated_students_and_lecturers`
--

CREATE TABLE `associated_students_and_lecturers` (
  `id` int(11) NOT NULL,
  `students_id` int(11) DEFAULT NULL,
  `lecturers_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `associated_students_and_lecturers`
--

INSERT INTO `associated_students_and_lecturers` (`id`, `students_id`, `lecturers_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text,
  `date_created` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `target_table` varchar(125) DEFAULT NULL,
  `update_id` int(11) DEFAULT NULL,
  `code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `url_string` varchar(255) DEFAULT NULL,
  `course_title` varchar(255) DEFAULT NULL,
  `course_description` text,
  `start_date` date DEFAULT NULL,
  `finish_date` date DEFAULT NULL,
  `started_time` time DEFAULT NULL,
  `finished_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id`, `url_string`, `course_title`, `course_description`, `start_date`, `finish_date`, `started_time`, `finished_time`) VALUES
(1, 'learn-laravel', 'Learn Laravel', 'Este es un curso de Laravel', '2020-04-22', '2020-05-30', '03:00:00', '05:05:00'),
(2, 'learn-codeigniter', 'Learn Codeigniter', 'DC Codeigniter Shopping Cart', '2020-05-13', '2020-06-24', '11:00:00', '15:00:00'),
(3, 'course-1', 'Course 1', 'Course 1', '2020-05-13', '2020-05-29', '03:00:00', '03:05:00'),
(4, 'course-2', 'Course 2', 'Course 2', '2020-04-15', '2020-04-24', '03:00:00', '03:05:00'),
(5, 'course-3', 'Course 3', 'Course 3', '2020-05-29', '2020-05-29', '00:00:00', '00:00:00'),
(6, 'course-4', 'Course 4', 'Course 4', '2020-05-31', '2020-05-31', '00:00:00', '00:00:00'),
(7, 'course-5', 'Course 5', 'Course 5', '2020-05-30', '2020-05-30', '00:00:00', '00:00:00'),
(8, 'course-6', 'Course 6', 'Course 6', '2020-05-01', '2020-05-15', '00:00:00', '00:00:00'),
(9, 'course-7', 'Course 7', 'Course 7', '2020-05-29', '2020-05-30', '00:00:00', '00:00:00'),
(10, 'course-8', 'Course 8', 'Course 8', '2020-04-30', '2020-04-30', '00:00:00', '00:00:00'),
(11, 'course-9', 'Course 9', 'Course 8', '2020-04-24', '2020-04-24', '00:00:00', '00:00:00'),
(12, 'course-10', 'Course 10', 'Course 10', '2020-04-25', '2020-04-25', '00:00:00', '00:00:00'),
(13, 'course-11', 'Course 11', 'Course 11', '2020-05-02', '2020-05-02', '00:00:00', '00:00:00'),
(14, 'course-12', 'Course 12', 'Course 12', '2020-05-15', '2020-05-30', '00:00:00', '00:00:00'),
(15, 'course-13', 'Course 13', 'Course 13', '2020-05-09', '2020-05-09', '00:00:00', '00:00:00'),
(16, 'course-14', 'Course 14', 'Course 14', '2020-05-01', '2020-05-01', '00:00:00', '00:00:00'),
(17, 'course-15', 'Course 15', 'Course 15', '2020-05-29', '2020-05-29', '00:00:00', '00:00:00'),
(18, 'course-16', 'Course 16', 'Course 16', '2020-05-30', '2020-05-30', '00:00:00', '00:00:00'),
(19, 'course-17', 'Course 17', 'Course 17', '2020-05-29', '2020-05-29', '00:00:00', '00:00:00'),
(20, 'course-18', 'Course 18', 'Course 18', '2020-05-08', '2020-05-08', '00:00:00', '00:00:00'),
(21, 'course-19', 'Course 19', 'Course 19', '2020-04-30', '2020-04-30', '00:00:00', '00:00:00'),
(22, 'course-20', 'Course 20', 'Course 20', '2020-05-16', '2020-05-16', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `url_string` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lecturers`
--

INSERT INTO `lecturers` (`id`, `url_string`, `first_name`, `last_name`, `email_address`) VALUES
(1, 'pepe', 'Pepe', 'Pedro', 'pp@mail.com'),
(2, 'larry', 'Larry', 'Lerry', 'll@mail.com'),
(3, 'david', 'David', 'Connelly', 'dc@mail.com'),
(4, 'john', 'John', 'Connell', 'll@mail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `url_string` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`id`, `url_string`, `first_name`, `last_name`, `email_address`, `picture`) VALUES
(1, 'rambo', 'John', 'Rambo', 'rb@mail.com', ''),
(2, 'connelly', 'David', 'Connelly', 'dc@mail.com', 'profile3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_administrators`
--

CREATE TABLE `trongate_administrators` (
  `id` int(11) NOT NULL,
  `username` varchar(65) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `trongate_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trongate_administrators`
--

INSERT INTO `trongate_administrators` (`id`, `username`, `password`, `trongate_user_id`) VALUES
(1, 'admin', '$2y$11$SoHZDvbfLSRHAi3WiKIBiu.tAoi/GCBBO4HRxVX1I3qQkq3wCWfXi', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_tokens`
--

CREATE TABLE `trongate_tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(125) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `expiry_date` int(11) DEFAULT NULL,
  `code` varchar(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trongate_tokens`
--

INSERT INTO `trongate_tokens` (`id`, `token`, `user_id`, `expiry_date`, `code`) VALUES
(2, 'Ag_eGFfP3cDBp-dsj36E2F2VdjKx9uwg', 1, 1589231257, '0'),
(3, 'CEFgjlDLPKNAm7ixc16YLcyQIfLTJRJW', 1, 1589163181, 'aaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_users`
--

CREATE TABLE `trongate_users` (
  `id` int(11) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `user_level_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trongate_users`
--

INSERT INTO `trongate_users` (`id`, `code`, `user_level_id`) VALUES
(1, 'B1uq69StF6P7blgvT2YHGRnNdBFR4rhG', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_user_levels`
--

CREATE TABLE `trongate_user_levels` (
  `id` int(11) NOT NULL,
  `level_title` varchar(125) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trongate_user_levels`
--

INSERT INTO `trongate_user_levels` (`id`, `level_title`) VALUES
(1, 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `associated_courses_and_lecturers`
--
ALTER TABLE `associated_courses_and_lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `associated_courses_and_students`
--
ALTER TABLE `associated_courses_and_students`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `associated_students_and_lecturers`
--
ALTER TABLE `associated_students_and_lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_administrators`
--
ALTER TABLE `trongate_administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_tokens`
--
ALTER TABLE `trongate_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_users`
--
ALTER TABLE `trongate_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_user_levels`
--
ALTER TABLE `trongate_user_levels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `associated_courses_and_lecturers`
--
ALTER TABLE `associated_courses_and_lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `associated_courses_and_students`
--
ALTER TABLE `associated_courses_and_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `associated_students_and_lecturers`
--
ALTER TABLE `associated_students_and_lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trongate_administrators`
--
ALTER TABLE `trongate_administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `trongate_tokens`
--
ALTER TABLE `trongate_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `trongate_users`
--
ALTER TABLE `trongate_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `trongate_user_levels`
--
ALTER TABLE `trongate_user_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
