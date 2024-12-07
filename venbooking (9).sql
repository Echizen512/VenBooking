-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2024 a las 03:41:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `venbooking`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_log`
--

CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `action` varchar(50) NOT NULL,
  `affected_id` int(11) NOT NULL,
  `action_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `old_data` text DEFAULT NULL,
  `new_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `audit_log`
--

INSERT INTO `audit_log` (`id`, `user_id`, `table_name`, `action`, `affected_id`, `action_timestamp`, `old_data`, `new_data`) VALUES
(1, 2, 'reservations', 'INSERT', 11, '2024-09-11 12:30:55', NULL, NULL),
(2, 2, 'reservations', 'INSERT', 12, '2024-09-11 12:39:47', NULL, NULL),
(3, 2, 'reservations', 'INSERT', 31, '2024-09-11 14:03:45', NULL, 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: En Espera'),
(4, 2, 'reservations', 'UPDATE', 31, '2024-09-11 21:25:08', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: En Espera', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado'),
(5, 2, 'reservations', 'UPDATE', 31, '2024-09-11 21:25:32', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado'),
(6, 2, 'reservations', 'UPDATE', 31, '2024-09-11 21:26:00', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado'),
(7, 2, 'reservations', 'UPDATE', 31, '2024-09-11 21:26:03', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Cancelado'),
(8, 2, 'reservations', 'UPDATE', 31, '2024-09-11 21:26:04', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Cancelado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado'),
(9, 2, 'reservations', 'UPDATE', 31, '2024-09-11 21:29:32', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado'),
(10, 2, 'reservations', 'UPDATE', 31, '2024-09-11 21:29:33', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Cancelado'),
(11, 2, 'reservations', 'UPDATE', 31, '2024-09-11 21:29:34', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Cancelado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado'),
(12, 2, 'reservations', 'UPDATE', 31, '2024-09-12 14:01:36', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Cancelado'),
(13, 2, 'reservations', 'UPDATE', 31, '2024-09-12 14:01:38', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Cancelado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado'),
(15, 2, 'profile', 'UPDATE', 2, '2024-09-21 12:53:44', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa'),
(16, 2, 'profile', 'UPDATE', 2, '2024-09-21 12:54:13', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa'),
(17, 2, 'profile', 'UPDATE', 2, '2024-09-21 12:55:03', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa'),
(18, 2, 'profile', 'UPDATE', 2, '2024-09-21 12:55:13', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa'),
(19, 2, 'profile', 'UPDATE', 2, '2024-09-21 12:55:54', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa'),
(20, 4, 'profile', 'INSERT', 4, '2024-09-21 16:02:49', NULL, 'first_name: Nanami, last_name: Kento, email: jmrm19711@gmail.com, profile_type: Empresa'),
(21, 2, 'profile', 'UPDATE', 2, '2024-09-23 04:23:24', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa'),
(22, 2, 'profile', 'UPDATE', 2, '2024-09-23 04:24:49', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa'),
(23, 2, 'inns', 'UPDATE', 1, '2024-09-23 04:25:28', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(24, 2, 'inns', 'UPDATE', 1, '2024-09-23 04:25:42', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(25, 2, 'inns', 'UPDATE', 1, '2024-09-23 04:26:40', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(26, 2, 'inns', 'UPDATE', 1, '2024-09-23 04:26:44', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(27, 2, 'inns', 'UPDATE', 3, '2024-09-23 04:27:11', 'name: Posada El Sol, status: 0, email: contacto@posadaelsol.com, phone: +58 416 9876543, state_id: 1', 'name: Posada El Sol, status: 0, email: contacto@posadaelsol.com, phone: +58 416 9876543, state_id: 1'),
(28, 2, 'inns', 'UPDATE', 3, '2024-09-23 04:47:56', 'name: Posada El Sol, status: 0, email: contacto@posadaelsol.com, phone: +58 416 9876543, state_id: 1', 'name: Posada El Sol, status: 0, email: contacto@posadaelsol.com, phone: +58 416 9876543, state_id: 1'),
(29, 2, 'inns', 'UPDATE', 1, '2024-09-23 04:48:25', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(30, 5, 'profile', 'INSERT', 5, '2024-09-23 05:42:55', NULL, 'first_name: Daniela, last_name: Traga Semen, email: dani@gmail.com, profile_type: Empresa'),
(31, 5, 'reservations', 'INSERT', 32, '2024-09-23 05:45:07', NULL, NULL),
(32, 5, 'profile', 'UPDATE', 5, '2024-09-23 05:46:37', 'first_name: Daniela, last_name: Traga Semen, email: dani@gmail.com, profile_type: Empresa', 'first_name: Daniela, last_name: Traga Semen, email: dani@gmail.com, profile_type: Empresa'),
(33, 5, 'profile', 'UPDATE', 5, '2024-09-23 05:47:02', 'first_name: Daniela, last_name: Traga Semen, email: dani@gmail.com, profile_type: Empresa', 'first_name: Daniela, last_name: Traga Semen, email: dani@gmail.com, profile_type: Empresa'),
(34, 5, 'reservations', 'UPDATE', 32, '2024-09-23 05:55:40', NULL, NULL),
(35, 2, 'reservations', 'UPDATE', 31, '2024-09-23 06:32:47', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Cancelado'),
(36, 2, 'reservations', 'UPDATE', 31, '2024-09-23 06:32:50', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Cancelado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado'),
(37, 2, 'reservations', 'UPDATE', 31, '2024-09-23 06:32:54', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Cancelado'),
(38, 2, 'inns', 'INSERT', 8, '2024-09-23 13:17:15', NULL, 'name: Holaaaa, status: 1, email: a@gmail.com, phone: 04124407966, state_id: 1'),
(39, 2, 'inns', 'INSERT', 9, '2024-09-23 13:22:52', NULL, 'name: Holaaaa, status: 1, email: a@gmail.com, phone: 04124407966, state_id: 1'),
(40, 2, 'inns', 'INSERT', 10, '2024-09-23 13:23:49', NULL, 'name: Holaaaasss, status: 1, email: a@gmail.com, phone: 04124407966, state_id: 1'),
(41, 2, 'reservations', 'UPDATE', 31, '2024-09-23 13:31:07', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Cancelado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado'),
(42, 5, 'reservations', 'UPDATE', 32, '2024-09-23 13:33:43', NULL, NULL),
(43, 5, 'reservations', 'UPDATE', 32, '2024-09-23 13:33:44', NULL, NULL),
(44, 5, 'reservations', 'INSERT', 33, '2024-09-23 13:35:22', NULL, NULL),
(45, 2, 'reservations', 'UPDATE', 31, '2024-09-23 13:36:50', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado'),
(46, 2, 'reservations', 'UPDATE', 31, '2024-09-23 13:36:52', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado', 'inn_id: 2, start_date: 2024-09-12, end_date: 2024-09-13, payment_method_id: 1, monto_total: 500, status: Confirmado'),
(47, 5, 'profile', 'UPDATE', 5, '2024-09-23 14:08:00', 'first_name: Daniela, last_name: Traga Semen, email: dani@gmail.com, profile_type: Empresa', 'first_name: Daniela, last_name: Morgado, email: dani@gmail.com, profile_type: Empresa'),
(48, 2, 'profile', 'UPDATE', 2, '2024-09-23 14:09:00', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa'),
(49, 2, 'inns', 'UPDATE', 1, '2024-09-23 14:21:27', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(50, 2, 'inns', 'UPDATE', 10, '2024-09-23 14:21:34', 'name: Holaaaasss, status: 1, email: a@gmail.com, phone: 04124407966, state_id: 1', 'name: Holaaaasss, status: 1, email: a@gmail.com, phone: 04124407966, state_id: 1'),
(51, 2, 'inns', 'UPDATE', 8, '2024-09-23 14:21:38', 'name: Holaaaa, status: 1, email: a@gmail.com, phone: 04124407966, state_id: 1', 'name: Holaaaa, status: 1, email: a@gmail.com, phone: 04124407966, state_id: 1'),
(52, 2, 'inns', 'UPDATE', 8, '2024-09-23 14:21:42', 'name: Holaaaa, status: 1, email: a@gmail.com, phone: 04124407966, state_id: 1', 'name: Holaaaa, status: 1, email: a@gmail.com, phone: 04124407966, state_id: 1'),
(53, 2, 'inns', 'UPDATE', 8, '2024-09-23 14:22:21', 'name: Holaaaa, status: 1, email: a@gmail.com, phone: 04124407966, state_id: 1', 'name: Holaaaa, status: 1, email: a@gmail.com, phone: 04124407966, state_id: 1'),
(54, 5, 'inns', 'INSERT', 11, '2024-09-23 16:23:45', NULL, 'name: Laboratorio, status: 1, email: carlescobar47@gmail.com, phone: 04167222232, state_id: 1'),
(55, 5, 'reservations', 'INSERT', 34, '2024-09-23 16:32:25', NULL, NULL),
(56, 6, 'profile', 'INSERT', 6, '2024-10-05 01:44:56', NULL, 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(57, 2, 'inns', 'UPDATE', 1, '2024-10-05 01:47:57', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(58, 6, 'inns', 'UPDATE', 1, '2024-10-11 15:45:32', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(59, 6, 'inns', 'UPDATE', 1, '2024-10-11 15:45:35', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(60, 6, 'inns', 'UPDATE', 1, '2024-10-11 15:45:49', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(61, 6, 'inns', 'UPDATE', 1, '2024-10-11 15:45:52', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(62, 6, 'inns', 'UPDATE', 1, '2024-10-11 15:49:48', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(63, 6, 'inns', 'UPDATE', 1, '2024-10-11 15:49:51', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(64, 6, 'inns', 'UPDATE', 1, '2024-10-11 15:50:07', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(65, 6, 'inns', 'UPDATE', 1, '2024-10-11 15:58:49', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(66, 6, 'inns', 'UPDATE', 1, '2024-10-11 15:58:55', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(67, 6, 'inns', 'UPDATE', 1, '2024-10-11 15:58:56', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(68, 6, 'inns', 'INSERT', 12, '2024-10-11 16:01:19', NULL, 'name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1'),
(69, 6, 'inns', 'UPDATE', 1, '2024-10-11 16:32:04', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(70, 6, 'inns', 'UPDATE', 1, '2024-10-11 16:32:05', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(71, 6, 'inns', 'UPDATE', 1, '2024-10-11 16:32:06', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(72, 6, 'inns', 'UPDATE', 1, '2024-10-11 16:32:08', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(73, 6, 'inns', 'UPDATE', 1, '2024-10-11 16:32:10', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(74, 6, 'inns', 'UPDATE', 1, '2024-10-11 16:32:12', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(75, 6, 'inns', 'UPDATE', 12, '2024-10-11 16:35:27', 'name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1'),
(76, 6, 'inns', 'UPDATE', 12, '2024-10-11 16:35:28', 'name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1'),
(77, 6, 'inns', 'UPDATE', 12, '2024-10-11 17:27:07', 'name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1'),
(78, 6, 'inns', 'UPDATE', 12, '2024-10-11 17:27:09', 'name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1'),
(79, 6, 'inns', 'UPDATE', 12, '2024-10-11 17:27:22', 'name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 123, state_id: 1'),
(80, 6, 'inns', 'UPDATE', 12, '2024-10-11 17:27:33', 'name: Example, status: 1, email: eloy@gmail.com, phone: 123, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1'),
(81, 6, 'inns', 'UPDATE', 12, '2024-10-11 17:27:56', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1'),
(82, 6, 'inns', 'UPDATE', 12, '2024-10-11 17:27:58', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1'),
(83, 6, 'inns', 'UPDATE', 12, '2024-10-11 17:27:59', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1'),
(84, 6, 'inns', 'UPDATE', 12, '2024-10-11 17:28:00', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1'),
(85, 5, 'reservations', 'UPDATE', 33, '2024-10-11 22:22:40', NULL, NULL),
(86, 6, 'inns', 'UPDATE', 1, '2024-10-11 22:33:55', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(87, 6, 'inns', 'UPDATE', 1, '2024-10-11 22:33:56', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(88, 6, 'inns', 'UPDATE', 12, '2024-10-11 22:49:20', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1'),
(89, 6, 'inns', 'UPDATE', 12, '2024-10-11 22:49:21', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1'),
(90, 6, 'inns', 'UPDATE', 12, '2024-10-11 22:49:26', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1'),
(91, 6, 'inns', 'UPDATE', 12, '2024-10-11 22:49:32', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1'),
(92, 6, 'inns', 'UPDATE', 1, '2024-10-12 21:40:12', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(93, 6, 'inns', 'UPDATE', 12, '2024-10-12 21:40:14', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1'),
(94, 6, 'inns', 'UPDATE', 1, '2024-10-12 21:45:16', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(95, 5, 'reservations', 'UPDATE', 33, '2024-10-12 21:48:00', NULL, NULL),
(96, 6, 'inns', 'UPDATE', 1, '2024-10-12 21:49:52', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(97, 6, 'profile', 'UPDATE', 6, '2024-10-19 23:51:30', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(98, 6, 'profile', 'UPDATE', 6, '2024-10-20 00:54:24', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(99, 6, 'profile', 'UPDATE', 6, '2024-10-20 00:56:47', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(100, 6, 'profile', 'UPDATE', 6, '2024-10-20 01:01:44', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(103, 6, 'profile', 'UPDATE', 6, '2024-11-04 02:25:30', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(104, 6, 'profile', 'UPDATE', 6, '2024-11-04 02:27:13', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(105, 6, 'inns', 'UPDATE', 1, '2024-11-07 20:39:08', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(106, 2, 'inns', 'UPDATE', 2, '2024-11-07 21:02:26', 'name: Posada La Montaña, status: 0, email: info@posadamontana.com, phone: +58 412 3456789, state_id: 1', 'name: Posada La Montaña, status: 0, email: info@posadamontana.com, phone: +58 412 3456789, state_id: 1'),
(107, 6, 'reservations', 'INSERT', 35, '2024-11-16 00:09:05', NULL, NULL),
(108, 6, 'reservations', 'INSERT', 36, '2024-11-16 00:21:13', NULL, NULL),
(109, 6, 'reservations', 'INSERT', 37, '2024-11-16 00:59:05', NULL, 'inn_id: 2, start_date: 2024-11-29, end_date: 2024-11-30, payment_method_id: 1, monto_total: 500, status: En Espera'),
(110, 6, 'reservations', 'INSERT', 38, '2024-11-16 01:02:30', NULL, 'inn_id: 2, start_date: 2024-11-29, end_date: 2024-11-30, payment_method_id: 1, monto_total: 500, status: En Espera'),
(111, 6, 'reservations', 'INSERT', 39, '2024-11-16 01:02:44', NULL, 'inn_id: 2, start_date: 2024-11-16, end_date: 2024-11-17, payment_method_id: 1, monto_total: 500, status: En Espera'),
(112, 6, 'reservations', 'INSERT', 40, '2024-11-16 01:07:04', NULL, 'inn_id: 2, start_date: 2024-11-21, end_date: 2024-11-22, payment_method_id: 1, monto_total: 500, status: En Espera'),
(113, 6, 'reservations', 'INSERT', 41, '2024-11-16 01:52:58', NULL, NULL),
(114, 6, 'reservations', 'INSERT', 42, '2024-11-16 11:38:16', NULL, 'inn_id: 2, start_date: 2025-02-02, end_date: 2025-02-04, payment_method_id: 1, monto_total: 750, status: En Espera'),
(115, 6, 'reservations', 'INSERT', 43, '2024-11-16 11:43:48', NULL, 'inn_id: 2, start_date: 2025-02-19, end_date: 2025-02-21, payment_method_id: 1, monto_total: 750, status: En Espera'),
(120, 4, 'profile', 'UPDATE', 4, '2024-11-18 02:52:24', 'first_name: Nanami, last_name: Kento, email: jmrm19711@gmail.com, profile_type: Empresa', 'first_name: Itadori, last_name: Yuji, email: jmrm19711@gmail.com, profile_type: Empresa'),
(121, 2, 'profile', 'UPDATE', 2, '2024-11-18 02:52:59', 'first_name: Nanami, last_name: Kento, email: jmrm19722@gmail.com, profile_type: Empresa', 'first_name: Arley, last_name: Dos Santos, email: jmrm19722@gmail.com, profile_type: Empresa'),
(122, 6, 'profile', 'UPDATE', 6, '2024-11-23 10:23:52', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(123, 6, 'profile', 'UPDATE', 6, '2024-11-24 01:29:29', 'first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(124, 6, 'profile', 'UPDATE', 6, '2024-11-24 01:31:35', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(125, 6, 'profile', 'UPDATE', 6, '2024-11-24 01:52:07', 'first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(126, 6, 'profile', 'UPDATE', 6, '2024-11-24 01:53:21', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(127, 6, 'profile', 'UPDATE', 6, '2024-11-24 01:53:33', 'first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(128, 13, 'profile', 'INSERT', 13, '2024-11-29 02:07:45', NULL, 'first_name: Juan Francisco, last_name: Rodriguez, email: gramolca@gmail.com, profile_type: Turista'),
(129, 6, 'profile', 'UPDATE', 6, '2024-11-29 02:35:41', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(130, 2, 'inns', 'UPDATE', 2, '2024-11-29 02:37:06', 'name: Posada La Montaña, status: 0, email: info@posadamontana.com, phone: +58 412 3456789, state_id: 1', 'name: Posada La Montaña, status: 0, email: info@posadamontana.com, phone: +58 412 3456789, state_id: 1'),
(131, 6, 'inns', 'UPDATE', 1, '2024-11-29 02:37:17', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(132, 2, 'inns', 'UPDATE', 3, '2024-11-29 02:37:30', 'name: Posada El Sol, status: 0, email: contacto@posadaelsol.com, phone: +58 416 9876543, state_id: 1', 'name: Posada El Sol, status: 0, email: contacto@posadaelsol.com, phone: +58 416 9876543, state_id: 1'),
(133, 2, 'inns', 'UPDATE', 4, '2024-11-29 02:42:33', 'name: Posada Familiar, status: 0, email: reservas@posadafamiliar.com, phone: +58 414 1234567, state_id: 1', 'name: Posada Familiar, status: 0, email: reservas@posadafamiliar.com, phone: +58 414 1234567, state_id: 1'),
(134, 6, 'inns', 'UPDATE', 3, '2024-11-30 00:24:08', 'name: Posada El Sol, status: 0, email: contacto@posadaelsol.com, phone: +58 416 9876543, state_id: 1', 'name: Posada El Sol, status: 0, email: contacto@posadaelsol.com, phone: +58 416 9876543, state_id: 1'),
(135, 6, 'inns', 'UPDATE', 1, '2024-11-30 00:24:36', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tova, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(136, 6, 'inns', 'UPDATE', 1, '2024-11-30 00:24:55', 'name: Posada Colonia Tova, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(137, 6, 'inns', 'UPDATE', 1, '2024-11-30 00:25:01', 'name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(138, 6, 'inns', 'INSERT', 13, '2024-11-30 00:32:27', NULL, 'name: Example, status: 1, email: gramolca@gmail.com, phone: 04243363970, state_id: 1'),
(139, 6, 'inns', 'UPDATE', 1, '2024-11-30 00:37:41', 'name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(140, 6, 'inns', 'UPDATE', 1, '2024-11-30 00:37:45', 'name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(141, 6, 'inns', 'UPDATE', 1, '2024-11-30 00:38:03', 'name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(142, 6, 'inns', 'UPDATE', 1, '2024-11-30 00:38:08', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(143, 6, 'inns', 'UPDATE', 1, '2024-11-30 00:39:26', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(144, 6, 'inns', 'UPDATE', 1, '2024-11-30 00:39:51', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(145, 6, 'inns', 'INSERT', 14, '2024-11-30 01:11:55', NULL, 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1'),
(146, 6, 'inns', 'UPDATE', 14, '2024-11-30 01:15:50', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1'),
(147, 6, 'inns', 'UPDATE', 14, '2024-11-30 01:16:23', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1'),
(148, 6, 'inns', 'UPDATE', 14, '2024-11-30 01:21:53', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1'),
(149, 6, 'inns', 'UPDATE', 4, '2024-11-30 01:27:37', 'name: Posada Familiar, status: 0, email: reservas@posadafamiliar.com, phone: +58 414 1234567, state_id: 1', 'name: Posada Familiar, status: 0, email: reservas@posadafamiliar.com, phone: +58 414 1234567, state_id: 1'),
(150, 6, 'inns', 'UPDATE', 14, '2024-11-30 01:27:50', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1'),
(151, 6, 'inns', 'UPDATE', 14, '2024-11-30 01:29:43', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1'),
(152, 6, 'inns', 'UPDATE', 14, '2024-11-30 01:29:53', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1'),
(153, 6, 'inns', 'UPDATE', 14, '2024-11-30 01:35:12', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1'),
(154, 6, 'inns', 'UPDATE', 14, '2024-11-30 01:35:35', 'name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1', 'name: Examples, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1'),
(155, 1, 'inns', 'INSERT', 15, '2024-11-30 15:36:45', NULL, 'name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 1'),
(156, 1, 'inns', 'INSERT', 16, '2024-11-30 15:36:45', NULL, 'name: Playa Azul, status: 0, email: playazul@example.com, phone: 04120000002, state_id: 1'),
(157, 1, 'inns', 'INSERT', 17, '2024-11-30 15:36:45', NULL, 'name: Ciudad Moderna, status: 0, email: ciudadmoderna@example.com, phone: 04120000003, state_id: 1'),
(158, 1, 'inns', 'INSERT', 18, '2024-11-30 15:36:45', NULL, 'name: Amanecer Andino, status: 0, email: amanecerandino@example.com, phone: 04120000004, state_id: 1'),
(159, 1, 'inns', 'INSERT', 19, '2024-11-30 15:36:45', NULL, 'name: Sol Caribeño, status: 0, email: solcaribeno@example.com, phone: 04120000005, state_id: 1'),
(160, 1, 'inns', 'INSERT', 20, '2024-11-30 15:36:45', NULL, 'name: Urbana Suites, status: 0, email: urbanasuites@example.com, phone: 04120000006, state_id: 1'),
(161, 1, 'inns', 'INSERT', 21, '2024-11-30 15:36:45', NULL, 'name: Refugio Nevado, status: 0, email: refugionevado@example.com, phone: 04120000007, state_id: 1'),
(162, 1, 'inns', 'INSERT', 22, '2024-11-30 15:36:45', NULL, 'name: Arena Dorada, status: 0, email: arenadorada@example.com, phone: 04120000008, state_id: 1'),
(163, 1, 'inns', 'INSERT', 23, '2024-11-30 15:36:45', NULL, 'name: Metropolitan Inn, status: 0, email: metropolitaninn@example.com, phone: 04120000009, state_id: 1'),
(164, 1, 'inns', 'INSERT', 24, '2024-11-30 15:36:45', NULL, 'name: Montaña Verde, status: 0, email: montanaverde@example.com, phone: 04120000010, state_id: 1'),
(165, 1, 'inns', 'INSERT', 25, '2024-11-30 15:36:45', NULL, 'name: Costa Brava, status: 0, email: costabrava@example.com, phone: 04120000011, state_id: 1'),
(166, 1, 'inns', 'INSERT', 26, '2024-11-30 15:36:45', NULL, 'name: Skyline Hotel, status: 0, email: skylinehotel@example.com, phone: 04120000012, state_id: 1'),
(167, 1, 'inns', 'INSERT', 27, '2024-11-30 15:36:45', NULL, 'name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 1'),
(168, 1, 'inns', 'INSERT', 28, '2024-11-30 15:36:45', NULL, 'name: Playa Cristal, status: 0, email: playacristal@example.com, phone: 04120000014, state_id: 1'),
(169, 1, 'inns', 'INSERT', 29, '2024-11-30 15:36:45', NULL, 'name: Urbano Chic, status: 0, email: urbanochic@example.com, phone: 04120000015, state_id: 1'),
(170, 1, 'inns', 'INSERT', 30, '2024-11-30 15:36:45', NULL, 'name: Valle Dorado, status: 0, email: valledorado@example.com, phone: 04120000016, state_id: 1'),
(171, 1, 'inns', 'INSERT', 31, '2024-11-30 15:36:45', NULL, 'name: Mar Azul, status: 0, email: marazul@example.com, phone: 04120000017, state_id: 1'),
(172, 1, 'inns', 'INSERT', 32, '2024-11-30 15:36:45', NULL, 'name: Central Inn, status: 0, email: centralinn@example.com, phone: 04120000018, state_id: 1'),
(173, 1, 'inns', 'INSERT', 33, '2024-11-30 15:36:45', NULL, 'name: Rocío de Montaña, status: 0, email: rociodemontana@example.com, phone: 04120000019, state_id: 1'),
(174, 1, 'inns', 'INSERT', 34, '2024-11-30 15:36:45', NULL, 'name: Bahía Escondida, status: 0, email: bahiaescondida@example.com, phone: 04120000020, state_id: 1'),
(175, 1, 'inns', 'UPDATE', 15, '2024-11-30 15:38:49', 'name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 1', 'name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 1'),
(176, 1, 'inns', 'UPDATE', 16, '2024-11-30 15:38:49', 'name: Playa Azul, status: 0, email: playazul@example.com, phone: 04120000002, state_id: 1', 'name: Playa Azul, status: 0, email: playazul@example.com, phone: 04120000002, state_id: 1'),
(177, 1, 'inns', 'UPDATE', 17, '2024-11-30 15:38:49', 'name: Ciudad Moderna, status: 0, email: ciudadmoderna@example.com, phone: 04120000003, state_id: 1', 'name: Ciudad Moderna, status: 0, email: ciudadmoderna@example.com, phone: 04120000003, state_id: 1'),
(178, 1, 'inns', 'UPDATE', 18, '2024-11-30 15:38:49', 'name: Amanecer Andino, status: 0, email: amanecerandino@example.com, phone: 04120000004, state_id: 1', 'name: Amanecer Andino, status: 0, email: amanecerandino@example.com, phone: 04120000004, state_id: 1'),
(179, 1, 'inns', 'UPDATE', 19, '2024-11-30 15:38:49', 'name: Sol Caribeño, status: 0, email: solcaribeno@example.com, phone: 04120000005, state_id: 1', 'name: Sol Caribeño, status: 0, email: solcaribeno@example.com, phone: 04120000005, state_id: 1'),
(180, 1, 'inns', 'UPDATE', 20, '2024-11-30 15:38:49', 'name: Urbana Suites, status: 0, email: urbanasuites@example.com, phone: 04120000006, state_id: 1', 'name: Urbana Suites, status: 0, email: urbanasuites@example.com, phone: 04120000006, state_id: 1'),
(181, 1, 'inns', 'UPDATE', 21, '2024-11-30 15:38:49', 'name: Refugio Nevado, status: 0, email: refugionevado@example.com, phone: 04120000007, state_id: 1', 'name: Refugio Nevado, status: 0, email: refugionevado@example.com, phone: 04120000007, state_id: 1'),
(182, 1, 'inns', 'UPDATE', 22, '2024-11-30 15:38:49', 'name: Arena Dorada, status: 0, email: arenadorada@example.com, phone: 04120000008, state_id: 1', 'name: Arena Dorada, status: 0, email: arenadorada@example.com, phone: 04120000008, state_id: 1'),
(183, 1, 'inns', 'UPDATE', 23, '2024-11-30 15:38:49', 'name: Metropolitan Inn, status: 0, email: metropolitaninn@example.com, phone: 04120000009, state_id: 1', 'name: Metropolitan Inn, status: 0, email: metropolitaninn@example.com, phone: 04120000009, state_id: 1'),
(184, 1, 'inns', 'UPDATE', 24, '2024-11-30 15:40:06', 'name: Montaña Verde, status: 0, email: montanaverde@example.com, phone: 04120000010, state_id: 1', 'name: Montaña Verde, status: 0, email: montanaverde@example.com, phone: 04120000010, state_id: 1'),
(185, 1, 'inns', 'UPDATE', 25, '2024-11-30 15:40:06', 'name: Costa Brava, status: 0, email: costabrava@example.com, phone: 04120000011, state_id: 1', 'name: Costa Brava, status: 0, email: costabrava@example.com, phone: 04120000011, state_id: 1'),
(186, 1, 'inns', 'UPDATE', 26, '2024-11-30 15:40:06', 'name: Skyline Hotel, status: 0, email: skylinehotel@example.com, phone: 04120000012, state_id: 1', 'name: Skyline Hotel, status: 0, email: skylinehotel@example.com, phone: 04120000012, state_id: 1'),
(187, 1, 'inns', 'UPDATE', 27, '2024-11-30 15:40:06', 'name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 1', 'name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 1'),
(188, 1, 'inns', 'UPDATE', 28, '2024-11-30 15:40:06', 'name: Playa Cristal, status: 0, email: playacristal@example.com, phone: 04120000014, state_id: 1', 'name: Playa Cristal, status: 0, email: playacristal@example.com, phone: 04120000014, state_id: 1'),
(189, 1, 'inns', 'UPDATE', 29, '2024-11-30 15:40:06', 'name: Urbano Chic, status: 0, email: urbanochic@example.com, phone: 04120000015, state_id: 1', 'name: Urbano Chic, status: 0, email: urbanochic@example.com, phone: 04120000015, state_id: 1'),
(190, 1, 'inns', 'UPDATE', 30, '2024-11-30 15:40:06', 'name: Valle Dorado, status: 0, email: valledorado@example.com, phone: 04120000016, state_id: 1', 'name: Valle Dorado, status: 0, email: valledorado@example.com, phone: 04120000016, state_id: 1'),
(191, 1, 'inns', 'UPDATE', 31, '2024-11-30 15:40:06', 'name: Mar Azul, status: 0, email: marazul@example.com, phone: 04120000017, state_id: 1', 'name: Mar Azul, status: 0, email: marazul@example.com, phone: 04120000017, state_id: 1'),
(192, 1, 'inns', 'UPDATE', 32, '2024-11-30 15:40:06', 'name: Central Inn, status: 0, email: centralinn@example.com, phone: 04120000018, state_id: 1', 'name: Central Inn, status: 0, email: centralinn@example.com, phone: 04120000018, state_id: 1'),
(193, 1, 'inns', 'UPDATE', 33, '2024-11-30 15:40:06', 'name: Rocío de Montaña, status: 0, email: rociodemontana@example.com, phone: 04120000019, state_id: 1', 'name: Rocío de Montaña, status: 0, email: rociodemontana@example.com, phone: 04120000019, state_id: 1'),
(194, 6, 'inns', 'UPDATE', 15, '2024-11-30 18:30:25', 'name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 1', 'name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 2'),
(195, 6, 'inns', 'UPDATE', 15, '2024-11-30 18:31:57', 'name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 2', 'name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 2'),
(196, 6, 'inns', 'UPDATE', 15, '2024-11-30 18:34:41', 'name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 2', 'name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 2'),
(197, 6, 'inns', 'UPDATE', 18, '2024-11-30 18:35:25', 'name: Amanecer Andino, status: 0, email: amanecerandino@example.com, phone: 04120000004, state_id: 1', 'name: Amanecer Andino, status: 0, email: amanecerandino@example.com, phone: 04120000004, state_id: 3'),
(198, 6, 'inns', 'UPDATE', 17, '2024-11-30 18:36:39', 'name: Ciudad Moderna, status: 0, email: ciudadmoderna@example.com, phone: 04120000003, state_id: 1', 'name: Ciudad Moderna, status: 0, email: ciudadmoderna@example.com, phone: 04120000003, state_id: 4'),
(199, 6, 'inns', 'UPDATE', 20, '2024-11-30 18:37:28', 'name: Urbana Suites, status: 0, email: urbanasuites@example.com, phone: 04120000006, state_id: 1', 'name: Urbana Suites, status: 0, email: urbanasuites@example.com, phone: 04120000006, state_id: 5'),
(200, 6, 'inns', 'UPDATE', 20, '2024-11-30 18:38:43', 'name: Urbana Suites, status: 0, email: urbanasuites@example.com, phone: 04120000006, state_id: 5', 'name: Urbana Suites, status: 0, email: urbanasuites@example.com, phone: 04120000006, state_id: 5'),
(201, 6, 'inns', 'UPDATE', 16, '2024-11-30 18:39:46', 'name: Playa Azul, status: 0, email: playazul@example.com, phone: 04120000002, state_id: 1', 'name: Playa Azul, status: 0, email: playazul@example.com, phone: 04120000002, state_id: 10'),
(202, 6, 'inns', 'UPDATE', 19, '2024-11-30 18:41:00', 'name: Sol Caribeño, status: 0, email: solcaribeno@example.com, phone: 04120000005, state_id: 1', 'name: Sol Caribeño, status: 0, email: solcaribeno@example.com, phone: 04120000005, state_id: 8'),
(203, 6, 'inns', 'UPDATE', 22, '2024-11-30 18:43:15', 'name: Arena Dorada, status: 0, email: arenadorada@example.com, phone: 04120000008, state_id: 1', 'name: Arena Dorada, status: 0, email: arenadorada@example.com, phone: 04120000008, state_id: 14'),
(204, 6, 'inns', 'UPDATE', 26, '2024-11-30 18:45:23', 'name: Skyline Hotel, status: 0, email: skylinehotel@example.com, phone: 04120000012, state_id: 1', 'name: Skyline Hotel, status: 0, email: skylinehotel@example.com, phone: 04120000012, state_id: 7'),
(205, 6, 'inns', 'UPDATE', 30, '2024-11-30 18:46:09', 'name: Valle Dorado, status: 0, email: valledorado@example.com, phone: 04120000016, state_id: 1', 'name: Valle Dorado, status: 0, email: valledorado@example.com, phone: 04120000016, state_id: 18'),
(206, 6, 'inns', 'UPDATE', 29, '2024-11-30 18:46:57', 'name: Urbano Chic, status: 0, email: urbanochic@example.com, phone: 04120000015, state_id: 1', 'name: Urbano Chic, status: 0, email: urbanochic@example.com, phone: 04120000015, state_id: 22'),
(207, 6, 'inns', 'UPDATE', 24, '2024-11-30 18:48:03', 'name: Montaña Verde, status: 0, email: montanaverde@example.com, phone: 04120000010, state_id: 1', 'name: Montaña Verde, status: 0, email: montanaverde@example.com, phone: 04120000010, state_id: 23'),
(208, 6, 'inns', 'UPDATE', 21, '2024-11-30 18:49:26', 'name: Refugio Nevado, status: 0, email: refugionevado@example.com, phone: 04120000007, state_id: 1', 'name: Refugio Nevado, status: 0, email: refugionevado@example.com, phone: 04120000007, state_id: 13'),
(209, 6, 'inns', 'UPDATE', 27, '2024-11-30 18:51:06', 'name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 1', 'name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 21'),
(210, 6, 'inns', 'UPDATE', 27, '2024-11-30 18:51:20', 'name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 21', 'name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 21'),
(211, 6, 'inns', 'UPDATE', 27, '2024-11-30 18:51:38', 'name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 21', 'name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 21'),
(212, 6, 'inns', 'UPDATE', 23, '2024-11-30 18:55:54', 'name: Metropolitan Inn, status: 0, email: metropolitaninn@example.com, phone: 04120000009, state_id: 1', 'name: Metropolitan Inn, status: 0, email: metropolitaninn@example.com, phone: 04120000009, state_id: 17'),
(213, 6, 'inns', 'UPDATE', 32, '2024-11-30 18:57:19', 'name: Central Inn, status: 0, email: centralinn@example.com, phone: 04120000018, state_id: 1', 'name: Central Inn, status: 0, email: centralinn@example.com, phone: 04120000018, state_id: 17'),
(214, 6, 'inns', 'UPDATE', 33, '2024-11-30 18:58:10', 'name: Rocío de Montaña, status: 0, email: rociodemontana@example.com, phone: 04120000019, state_id: 1', 'name: Rocío de Montaña, status: 0, email: rociodemontana@example.com, phone: 04120000019, state_id: 9'),
(215, 6, 'inns', 'UPDATE', 28, '2024-11-30 18:59:01', 'name: Playa Cristal, status: 0, email: playacristal@example.com, phone: 04120000014, state_id: 1', 'name: Playa Cristal, status: 0, email: playacristal@example.com, phone: 04120000014, state_id: 5'),
(216, 6, 'inns', 'UPDATE', 25, '2024-11-30 18:59:37', 'name: Costa Brava, status: 0, email: costabrava@example.com, phone: 04120000011, state_id: 1', 'name: Costa Brava, status: 0, email: costabrava@example.com, phone: 04120000011, state_id: 6'),
(217, 6, 'inns', 'UPDATE', 31, '2024-11-30 19:00:58', 'name: Mar Azul, status: 0, email: marazul@example.com, phone: 04120000017, state_id: 1', 'name: Mar Azul, status: 0, email: marazul@example.com, phone: 04120000017, state_id: 16'),
(218, 6, 'profile', 'UPDATE', 6, '2024-12-07 00:41:43', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(219, 6, 'profile', 'UPDATE', 6, '2024-12-07 00:41:49', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(220, 13, 'reservations', 'INSERT', 60, '2024-12-07 02:05:29', NULL, 'inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: En Espera'),
(221, 6, 'profile', 'UPDATE', 6, '2024-12-07 02:16:44', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(222, 6, 'profile', 'UPDATE', 6, '2024-12-07 02:17:31', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bank_transfer_info`
--

CREATE TABLE `bank_transfer_info` (
  `id` int(11) NOT NULL,
  `inn_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `account_number` varchar(20) NOT NULL,
  `bank_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bank_transfer_info`
--

INSERT INTO `bank_transfer_info` (`id`, `inn_id`, `full_name`, `account_number`, `bank_code`) VALUES
(6, 1, 'Arley', '1202', '0191');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `binance_transfer_info`
--

CREATE TABLE `binance_transfer_info` (
  `id` int(11) NOT NULL,
  `inn_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `binance_transfer_info`
--

INSERT INTO `binance_transfer_info` (`id`, `inn_id`, `email`) VALUES
(1, 1, 'jmrm19722@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Montaña'),
(2, 'Playa'),
(3, 'Ciudad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `destinations`
--

INSERT INTO `destinations` (`id`, `name`, `image_url`, `description`, `location`, `state_id`, `status`) VALUES
(1, 'Salto Ángel', 'images/angel-falls.jpg', 'El Salto Ángel es la cascada ininterrumpida más alta del mundo, ubicada en el Parque Nacional Canaima, un sitio del Patrimonio Mundial de la UNESCO.', 'Parque Nacional Canaima, Bolívar', 1, 1),
(2, 'Isla Margarita', 'images/margarita-island.jpg', 'La Isla Margarita es conocida por sus hermosas playas, vibrante vida nocturna y oportunidades de compras libres de impuestos.', 'Nueva Esparta', 2, 1),
(3, 'Archipiélago Los Roques', 'images/los-roques.jpg', 'Los Roques es un paraíso para los amantes del snorkel y el buceo, ofreciendo aguas cristalinas y una abundante vida marina.', 'Los Roques', 3, 1),
(4, 'Mérida', 'images/merida.jpg', 'Mérida es hogar de los famosos Andes, ofreciendo una gama de actividades al aire libre como senderismo, escalada y parapente.', 'Mérida', 4, 1),
(5, 'Choroní', 'images/choroni.jpg', 'Choroní es un pintoresco pueblo con arquitectura colonial, impresionantes playas y una puerta de entrada al Parque Nacional Henri Pittier.', 'Aragua', 5, 1),
(6, 'Parque Nacional Henri Pittier', 'images/henri-pittier.jpg', 'El Parque Nacional Henri Pittier es el parque nacional más antiguo de Venezuela, conocido por su biodiversidad y hermosos paisajes.', 'Aragua', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inns`
--

CREATE TABLE `inns` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `state_id` int(11) NOT NULL,
  `municipality_id` int(11) NOT NULL,
  `parish_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `block` tinyint(1) DEFAULT 0,
  `quality` enum('Alta','Media','Baja') NOT NULL DEFAULT 'Media'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inns`
--

INSERT INTO `inns` (`id`, `name`, `description`, `image_url`, `status`, `email`, `phone`, `state_id`, `municipality_id`, `parish_id`, `category_id`, `user_id`, `block`, `quality`) VALUES
(1, 'Posada Colonia Tovar', 'Comodidad garantizada', 'https://elviajerofeliz.com/wp-content/uploads/2015/11/colonia-tovar.jpg', 1, 'jmrm19722@gmail.com', '04243363970', 1, 7, 7, 1, 6, 0, 'Alta'),
(2, 'Posada La Montaña', 'Una posada acogedora en las montañas', 'https://bariloche.org/directorio/photos/61/file/36/Posada%20de%20Monta%C3%B1a?size=large', 0, 'info@posadamontana.com', '+58 412 3456789', 1, 1, 1, 1, 6, 0, 'Baja'),
(3, 'Posada El Sol', 'Disfruta del sol y la playa en nuestra posada', 'https://wcm.transat.com/getmedia/e8c1e3f7-f135-4d17-9753-08cac53fd513/Posada-Real-Puerto-Escondido-Aerial-001?width=1400', 0, 'contacto@posadaelsol.com', '+58 416 9876543', 1, 2, 2, 2, 6, 0, 'Media'),
(4, 'Posada Familiar', 'Un lugar ideal para disfrutar en familia', 'https://i.pinimg.com/originals/63/a3/52/63a3528f9d939451d1da5e36b946a381.jpg', 0, 'reservas@posadafamiliar.com', '+58 414 1234567', 1, 1, 1, 3, 6, 0, 'Alta'),
(5, 'Posada El Descanso', 'Para aquellos que buscan un descanso merecido', 'https://hotelesdemargarita.com/img/posadalamar-08.jpg', 1, 'descanso@posadaeldescanso.com', '+58 426 2345678', 1, 1, 1, 2, NULL, 0, 'Media'),
(6, 'Posada Vista al Lago', 'Con hermosas vistas al lago', 'https://th.bing.com/th/id/OIP.9Ff-KWJollAV99_0g289SgHaFj?w=1024&h=768&rs=1&pid=ImgDetMain', 1, 'vista@posadavistaallago.com', '+58 412 8765432', 1, 1, 1, 3, NULL, 0, 'Media'),
(15, 'Montaña Serena', 'Una posada tranquila en las montañas.', 'https://img.freepik.com/foto-gratis/casa-madera-fotorrealista-estructura-madera_23-2151302622.jpg', 0, 'montanaserena@example.com', '04120000001', 2, 8, 8, 1, 6, 0, 'Alta'),
(16, 'Playa Azul', 'Descanso perfecto frente al mar.', 'https://i.pinimg.com/564x/37/64/50/376450d02718c098839aa5360239a6a7.jpg', 0, 'playazul@example.com', '04120000002', 10, 100, 100, 2, 6, 0, 'Media'),
(17, 'Ciudad Moderna', 'Céntrica y cómoda en la ciudad.', 'https://i.pinimg.com/736x/03/8f/83/038f83747d955777fabfe4fb1e75222b.jpg', 0, 'ciudadmoderna@example.com', '04120000003', 4, 36, 36, 3, 6, 0, 'Media'),
(18, 'Amanecer Andino', 'Amaneceres espectaculares en la montaña.', 'https://images.homify.com/c_fill,f_auto,h_500,q_auto,w_1280/v1564007379/p/photo/image/3139647/20.jpg', 0, 'amanecerandino@example.com', '04120000004', 3, 15, 15, 1, 6, 0, 'Media'),
(19, 'Sol Caribeño', 'Sol y mar para una experiencia única.', 'https://i.pinimg.com/originals/dc/0c/fd/dc0cfd9ade1aa17c1af3651be0a80fa7.jpg', 0, 'solcaribeno@example.com', '04120000005', 8, 81, 81, 2, 6, 0, 'Alta'),
(20, 'Urbana Suites', 'Lujo y confort en el corazón de la ciudad.', 'https://i.ytimg.com/vi/_qTDdx2HBUA/maxresdefault.jpg', 0, 'urbanasuites@example.com', '04120000006', 5, 47, 47, 3, 6, 0, 'Media'),
(21, 'Refugio Nevado', 'Paisajes nevados para una experiencia inolvidable.', 'https://media.admagazine.com/photos/618a5e87b67f79aa891ed6f8/master/w_1600%2Cc_limit/91981.jpg', 0, 'refugionevado@example.com', '04120000007', 13, 124, 124, 1, 6, 0, 'Alta'),
(22, 'Arena Dorada', 'Relájate en playas de arena dorada.', 'https://hips.hearstapps.com/elle-es/assets/15/37/original/original-es-casas-de-playa-de-eeuu-3-hermosa-beach-california-6853908-1-esl-es-3-hermosa-beach-california-jpg.jpg', 0, 'arenadorada@example.com', '04120000008', 14, 146, 146, 2, 6, 0, 'Media'),
(23, 'Metropolitan Inn', 'La opción moderna para el viajero urbano.', 'https://yucatantoday.com/hubfs/Imported_Blog_Media/palacio-canton-destacada-casas-iconicas-de-merida-1.jpg', 0, 'metropolitaninn@example.com', '04120000009', 17, 179, 179, 3, 6, 0, 'Media'),
(24, 'Montaña Verde', 'Un paraíso entre montañas.', 'https://estag.fimagenes.com/imagenesred/2587613_1.jpg?1', 0, 'montanaverde@example.com', '04120000010', 23, 229, 229, 1, 6, 0, 'Alta'),
(25, 'Costa Brava', 'Escápate al sol en la playa.', 'https://lideresmexicanos.com/wp-content/uploads/2022/08/CasaenPlaya-00.jpg', 0, 'costabrava@example.com', '04120000011', 6, 62, 62, 2, 6, 0, 'Baja'),
(26, 'Skyline Hotel', 'Vistas panorámicas en la ciudad.', 'https://estag.fimagenes.com/imagenesred/2585854_0.jpg', 0, 'skylinehotel@example.com', '04120000012', 7, 75, 75, 3, 6, 0, 'Media'),
(27, 'Cumbre Eterna', 'Explora las alturas.', 'https://cdn2.hubspot.net/hubfs/2387063/casa-bonita-merida-1.jpg', 0, 'cumbreeterna@example.com', '04120000013', 21, 211, 211, 1, 6, 0, 'Media'),
(28, 'Playa Cristal', 'Aguas cristalinas en un entorno paradisíaco.', 'https://media.admagazine.com/photos/653c7a12daa2255f3e1d1298/16:9/w_2560%2Cc_limit/casa-cabo-san-lucas-1.jpg', 0, 'playacristal@example.com', '04120000014', 5, 53, 53, 2, 6, 0, 'Baja'),
(29, 'Urbano Chic', 'El lugar perfecto para estancias urbanas.', 'https://hips.hearstapps.com/hmg-prod/images/amoroso-residence-photos-16-1621084958.jpg', 0, 'urbanochic@example.com', '04120000015', 22, 222, 222, 3, 6, 0, 'Media'),
(30, 'Valle Dorado', 'Descansa en la calma del valle.', 'https://www.generosliterarios.net/wp-content/uploads/casas-atractivas.jpg', 0, 'valledorado@example.com', '04120000016', 18, 192, 192, 1, 6, 0, 'Media'),
(31, 'Mar Azul', 'Sumérgete en la serenidad del océano.', 'https://media.admagazine.com/photos/653c7a12daa2255f3e1d1298/16:9/w_2560%2Cc_limit/casa-cabo-san-lucas-1.jpg', 0, 'marazul@example.com', '04120000017', 16, 169, 169, 2, 6, 0, 'Baja'),
(32, 'Central Inn', 'En el corazón de la ciudad.', 'https://images.squarespace-cdn.com/content/v1/5f3a7947e8f50270c65d0e79/1598347439520-3XMSS1JU2ST0ZJQF2TEP/casa-merida-yucatan-fachada-interior-carbonell-arquitectos.jpg', 0, 'centralinn@example.com', '04120000018', 17, 178, 178, 3, 6, 0, 'Media'),
(33, 'Rocío de Montaña', 'Conéctate con la naturaleza.', 'https://pics.nuroa.com/casa_en_venta_en_temozon_norte_merida_yucatan_1830001727793986864.jpg', 0, 'rociodemontana@example.com', '04120000019', 9, 88, 88, 1, 6, 0, 'Alta'),
(34, 'Bahía Escondida', 'Un tesoro en la playa.', 'https://example.com/image20.jpg', 0, 'bahiaescondida@example.com', '04120000020', 1, 1, 1, 2, 1, 0, 'Alta');

--
-- Disparadores `inns`
--
DELIMITER $$
CREATE TRIGGER `trg_inns_insert` AFTER INSERT ON `inns` FOR EACH ROW BEGIN
    INSERT INTO audit_log (user_id, table_name, action, affected_id, new_data)
    VALUES (NEW.user_id, 'inns', 'INSERT', NEW.id, CONCAT('name: ', NEW.name, ', status: ', NEW.status, ', email: ', NEW.email, ', phone: ', NEW.phone, ', state_id: ', NEW.state_id));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_inns_update` AFTER UPDATE ON `inns` FOR EACH ROW BEGIN
    INSERT INTO audit_log (user_id, table_name, action, affected_id, old_data, new_data)
    VALUES (OLD.user_id, 'inns', 'UPDATE', OLD.id, CONCAT('name: ', OLD.name, ', status: ', OLD.status, ', email: ', OLD.email, ', phone: ', OLD.phone, ', state_id: ', OLD.state_id),
            CONCAT('name: ', NEW.name, ', status: ', NEW.status, ', email: ', NEW.email, ', phone: ', NEW.phone, ', state_id: ', NEW.state_id));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membership_purchases`
--

CREATE TABLE `membership_purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `membership_type` enum('basic','silver','gold') NOT NULL,
  `purchase_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `membership_purchases`
--

INSERT INTO `membership_purchases` (`id`, `user_id`, `membership_type`, `purchase_date`, `expiration_date`, `amount`, `payment_status`) VALUES
(1, 6, 'basic', '2024-10-20', '2024-11-20', 150.00, 'completed'),
(5, 6, 'gold', '2024-11-29', '2024-12-29', 100.00, 'completed');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(11) NOT NULL,
  `outgoing_msg_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `created_at`) VALUES
(1, 1, 2, 'Prueba', '2024-09-06 22:17:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mobile_payment_info`
--

CREATE TABLE `mobile_payment_info` (
  `id` int(11) NOT NULL,
  `inn_id` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `bank_code` varchar(10) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mobile_payment_info`
--

INSERT INTO `mobile_payment_info` (`id`, `inn_id`, `cedula`, `bank_code`, `phone_number`) VALUES
(1, 2, '30091390', '0191', '04243363970'),
(6, 1, '30091390', '0191', '04243363970');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipalities`
--

CREATE TABLE `municipalities` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `flag_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `municipalities`
--

INSERT INTO `municipalities` (`id`, `state_id`, `name`, `flag_url`, `status`) VALUES
(1, 1, 'José Félix Ribas', 'https://upload.wikimedia.org/wikipedia/commons/a/af/Bandera_Jose_Felix_Ribas_Aragua.PNG', 1),
(2, 1, 'Francisco Linares Alcántara', 'https://upload.wikimedia.org/wikipedia/commons/6/6d/Bandera_Municipio_Francisco_Linares_Alc%C3%A1ntara.jpg', 1),
(3, 1, 'Girardot', 'https://estadoaragua.org/wp-content/uploads/2021/06/Bandera-Girardot.jpg', 1),
(4, 1, 'José Ángel Lamas', 'https://upload.wikimedia.org/wikipedia/commons/2/28/Bandera_Jose_Angel_Lamas.PNG', 1),
(5, 1, 'Mario Briceño Iragorry', 'https://upload.wikimedia.org/wikipedia/commons/8/8e/Bandera_Mario_Brice%C3%B1o_Iragorri_Aragua.PNG', 1),
(6, 1, 'Ocumare de La Costa de Oro', 'https://estadoaragua.org/wp-content/uploads/2021/11/EscudoDelMunicipioOcumareDeLaCosta.jpg', 1),
(7, 1, 'Tovar', 'https://upload.wikimedia.org/wikipedia/commons/9/92/Bandera_del_Municipio_Tovar.svg', 1),
(8, 2, 'Alto Orinoco', NULL, 0),
(9, 2, 'Atabapo', NULL, 0),
(10, 2, 'Atures', NULL, 0),
(11, 2, 'Autana', NULL, 0),
(12, 2, 'Manapiare', NULL, 0),
(13, 2, 'Maroa', NULL, 0),
(14, 2, 'Río Negro', NULL, 0),
(15, 3, 'Anaco', NULL, 0),
(16, 3, 'Aragua', NULL, 0),
(17, 3, 'Bolívar', NULL, 0),
(18, 3, 'Bruzual', NULL, 0),
(19, 3, 'Cajigal', NULL, 0),
(20, 3, 'Carvajal', NULL, 0),
(21, 3, 'Diego Bautista Urbaneja', NULL, 0),
(22, 3, 'Freites', NULL, 0),
(23, 3, 'Guanipa', NULL, 0),
(24, 3, 'Guanta', NULL, 0),
(25, 3, 'Independencia', NULL, 0),
(26, 3, 'Libertad', NULL, 0),
(27, 3, 'McGregor', NULL, 0),
(28, 3, 'Miranda', NULL, 0),
(29, 3, 'Monagas', NULL, 0),
(30, 3, 'Peñalver', NULL, 0),
(31, 3, 'Píritu', NULL, 0),
(32, 3, 'San Juan de Capistrano', NULL, 0),
(33, 3, 'Santa Ana', NULL, 0),
(34, 3, 'Simón Rodríguez', NULL, 0),
(35, 3, 'Sotillo', NULL, 0),
(36, 4, 'Achaguas', NULL, 0),
(37, 4, 'Biruaca', NULL, 0),
(38, 4, 'Muñoz', NULL, 0),
(39, 4, 'Páez', NULL, 0),
(40, 4, 'Pedro Camejo', NULL, 0),
(41, 4, 'Rómulo Gallegos', NULL, 0),
(42, 4, 'San Fernando', NULL, 0),
(43, 5, 'Alberto Arvelo Torrealba', NULL, 0),
(44, 5, 'Andrés Eloy Blanco', NULL, 0),
(45, 5, 'Antonio José de Sucre', NULL, 0),
(46, 5, 'Arismendi', NULL, 0),
(47, 5, 'Barinas', NULL, 0),
(48, 5, 'Bolívar', NULL, 0),
(49, 5, 'Cruz Paredes', NULL, 0),
(50, 5, 'Ezequiel Zamora', NULL, 0),
(51, 5, 'Obispos', NULL, 0),
(52, 5, 'Pedraza', NULL, 0),
(53, 5, 'Rojas', NULL, 0),
(54, 5, 'Sosa', NULL, 0),
(55, 6, 'Angostura del Orinoco', NULL, 0),
(56, 6, 'Caroní', NULL, 0),
(57, 6, 'Cedeño', NULL, 0),
(58, 6, 'El Callao', NULL, 0),
(59, 6, 'Gran Sabana', NULL, 0),
(60, 6, 'Heres', NULL, 0),
(61, 6, 'Piar', NULL, 0),
(62, 6, 'Roscio', NULL, 0),
(63, 6, 'Sifontes', NULL, 0),
(64, 6, 'Sucre', NULL, 0),
(65, 6, 'Padre Pedro Chien', NULL, 0),
(66, 7, 'Bejuma', NULL, 0),
(67, 7, 'Carlos Arvelo', NULL, 0),
(68, 7, 'Diego Ibarra', NULL, 0),
(69, 7, 'Guacara', NULL, 0),
(70, 7, 'Juan José Mora', NULL, 0),
(71, 7, 'Libertador', NULL, 0),
(72, 7, 'Los Guayos', NULL, 0),
(73, 7, 'Miranda', NULL, 0),
(74, 7, 'Montalbán', NULL, 0),
(75, 7, 'Naguanagua', NULL, 0),
(76, 7, 'Puerto Cabello', NULL, 0),
(77, 7, 'San Diego', NULL, 0),
(78, 7, 'San Joaquín', NULL, 0),
(79, 7, 'Valencia', NULL, 0),
(80, 8, 'Anzoátegui', NULL, 0),
(81, 8, 'Tinaquillo', NULL, 0),
(82, 8, 'Girardot', NULL, 0),
(83, 8, 'Lima Blanco', NULL, 0),
(84, 8, 'Pao de San Juan Bautista', NULL, 0),
(85, 8, 'Ricaurte', NULL, 0),
(86, 8, 'Rómulo Gallegos', NULL, 0),
(87, 8, 'San Carlos', NULL, 0),
(88, 9, 'Antonio Díaz', NULL, 0),
(89, 9, 'Casacoima', NULL, 0),
(90, 9, 'Pedernales', NULL, 0),
(91, 9, 'Tucupita', NULL, 0),
(92, 10, 'Acosta', NULL, 0),
(93, 10, 'Bolívar', NULL, 0),
(94, 10, 'Cacique Manaure', NULL, 0),
(95, 10, 'Carirubana', NULL, 0),
(96, 10, 'Colina', NULL, 0),
(97, 10, 'Democracia', NULL, 0),
(98, 10, 'Falcón', NULL, 0),
(99, 10, 'Federación', NULL, 0),
(100, 10, 'Jacura', NULL, 0),
(101, 10, 'Los Taques', NULL, 0),
(102, 10, 'Miranda', NULL, 0),
(103, 10, 'Monseñor Iturriza', NULL, 0),
(104, 10, 'Palmasola', NULL, 0),
(105, 10, 'San Francisco', NULL, 0),
(106, 10, 'Sucre', NULL, 0),
(107, 11, 'Altagracia de Orituco', NULL, 0),
(108, 11, 'Las Mercedes', NULL, 0),
(109, 11, 'José Tadeo Monagas', NULL, 0),
(110, 11, 'Ortíz', NULL, 0),
(111, 11, 'San Jerónimo de Guayabal', NULL, 0),
(112, 11, 'San Sebastián', NULL, 0),
(113, 11, 'Tucupido', NULL, 0),
(114, 11, 'Zaraza', NULL, 0),
(115, 12, 'Andrés Eloy Blanco', NULL, 0),
(116, 12, 'Iribarren', NULL, 0),
(117, 12, 'Jiménez', NULL, 0),
(118, 12, 'Morán', NULL, 0),
(119, 12, 'Palavecino', NULL, 0),
(120, 12, 'Rivas Dávila', NULL, 0),
(121, 12, 'Simón Planas', NULL, 0),
(122, 12, 'Torres', NULL, 0),
(123, 12, 'Urdaneta', NULL, 0),
(124, 13, 'Alberto Adriani', NULL, 0),
(125, 13, 'Antonio Pinto Salinas', NULL, 0),
(126, 13, 'Campo Elías Delgado', NULL, 0),
(127, 13, 'Guaraque', NULL, 0),
(128, 13, 'José Ramón Yépez', NULL, 0),
(129, 13, 'La Azulita', NULL, 0),
(130, 13, 'Libertador', NULL, 0),
(131, 13, 'Miranda', NULL, 0),
(132, 13, 'Rangel', NULL, 0),
(133, 13, 'Santos Marquina', NULL, 0),
(134, 13, 'Tovar', NULL, 0),
(135, 13, 'Zea', NULL, 0),
(136, 14, 'Acevedo', NULL, 0),
(137, 14, 'Baruta', NULL, 0),
(138, 14, 'Bermúdez', NULL, 0),
(139, 14, 'Carrizal', NULL, 0),
(140, 14, 'Chacao', NULL, 0),
(141, 14, 'Cristóbal Rojas', NULL, 0),
(142, 14, 'El Hatillo', NULL, 0),
(143, 14, 'Guaicaipuro', NULL, 0),
(144, 14, 'Los Salias', NULL, 0),
(145, 14, 'Miranda', NULL, 0),
(146, 14, 'Plaza', NULL, 0),
(147, 14, 'Simón Bolívar', NULL, 0),
(148, 14, 'Sucre', NULL, 0),
(149, 15, 'Acosta', NULL, 0),
(150, 15, 'Aguasay', NULL, 0),
(151, 15, 'Ezequiel Zamora', NULL, 0),
(152, 15, 'Libertador', NULL, 0),
(153, 15, 'Maturín', NULL, 0),
(154, 15, 'Piar', NULL, 0),
(155, 15, 'Platanal', NULL, 0),
(156, 15, 'Punceres', NULL, 0),
(157, 15, 'Sotillo', NULL, 0),
(158, 15, 'Uracoa', NULL, 0),
(159, 16, 'Antolín del Campo', NULL, 0),
(160, 16, 'Arismendi', NULL, 0),
(161, 16, 'Benítez', NULL, 0),
(162, 16, 'Díaz', NULL, 0),
(163, 16, 'García', NULL, 0),
(164, 16, 'Gómez', NULL, 0),
(165, 16, 'Maneiro', NULL, 0),
(166, 16, 'Marcano', NULL, 0),
(167, 16, 'Mariño', NULL, 0),
(168, 16, 'Tubores', NULL, 0),
(169, 16, 'Villalba', NULL, 0),
(170, 17, 'Agua Blanca', NULL, 0),
(171, 17, 'Antonio José de Sucre', NULL, 0),
(172, 17, 'Araure', NULL, 0),
(173, 17, 'Esteller', NULL, 0),
(174, 17, 'Guanare', NULL, 0),
(175, 17, 'Guanarito', NULL, 0),
(176, 17, 'Ospino', NULL, 0),
(177, 17, 'Páez', NULL, 0),
(178, 17, 'Papelón', NULL, 0),
(179, 17, 'San Genaro de Boconoito', NULL, 0),
(180, 17, 'San Rafael de Onoto', NULL, 0),
(181, 17, 'Turén', NULL, 0),
(182, 18, 'Andrés Eloy Blanco', NULL, 0),
(183, 18, 'Arismendi', NULL, 0),
(184, 18, 'Benítez', NULL, 0),
(185, 18, 'Bermúdez', NULL, 0),
(186, 18, 'Cajigal', NULL, 0),
(187, 18, 'Cumana', NULL, 0),
(188, 18, 'Mariño', NULL, 0),
(189, 18, 'Mejía', NULL, 0),
(190, 18, 'Montes', NULL, 0),
(191, 18, 'Ribero', NULL, 0),
(192, 18, 'Sucre', NULL, 0),
(193, 19, 'Andrés Bello', NULL, 0),
(194, 19, 'Antonio Rómulo Costa', NULL, 0),
(195, 19, 'Cárdenas', NULL, 0),
(196, 19, 'Comité de la región andina', NULL, 0),
(197, 19, 'Escuque', NULL, 0),
(198, 19, 'José María Vargas', NULL, 0),
(199, 19, 'Junín', NULL, 0),
(200, 19, 'Libertad', NULL, 0),
(201, 19, 'Mérida', NULL, 0),
(202, 19, 'Táriba', NULL, 0),
(203, 20, 'Andrés Bello', NULL, 0),
(204, 20, 'Bolívar', NULL, 0),
(205, 20, 'Escuque', NULL, 0),
(206, 20, 'Juan Rodríguez', NULL, 0),
(207, 20, 'Miranda', NULL, 0),
(208, 20, 'Pampán', NULL, 0),
(209, 20, 'San Rafael', NULL, 0),
(210, 20, 'Valera', NULL, 0),
(211, 21, 'Caraballeda', NULL, 0),
(212, 21, 'Carlos Soublette', NULL, 0),
(213, 21, 'La Guaira', NULL, 0),
(214, 21, 'Vargas', NULL, 0),
(215, 22, 'Arístides Bastidas', NULL, 0),
(216, 22, 'Bruzual', NULL, 0),
(217, 22, 'Cocorote', NULL, 0),
(218, 22, 'Independencia', NULL, 0),
(219, 22, 'José Antonio Páez', NULL, 0),
(220, 22, 'La Trinidad', NULL, 0),
(221, 22, 'Nirgua', NULL, 0),
(222, 22, 'San Felipe', NULL, 0),
(223, 22, 'Urachiche', NULL, 0),
(224, 23, 'Almirante Padilla', NULL, 0),
(225, 23, 'Colón', NULL, 0),
(226, 23, 'Francisco Javier Pulgar', NULL, 0),
(227, 23, 'Jesús Enrique Lossada', NULL, 0),
(228, 23, 'La Cañada de Urdaneta', NULL, 0),
(229, 23, 'Maracaibo', NULL, 0),
(230, 23, 'Machiques de Perijá', NULL, 0),
(231, 23, 'Miranda', NULL, 0),
(232, 23, 'San Francisco', NULL, 0),
(233, 23, 'Santa Rita', NULL, 0),
(234, 23, 'Sucre', NULL, 0),
(235, 23, 'Valmore Rodríguez', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parishes`
--

CREATE TABLE `parishes` (
  `id` int(11) NOT NULL,
  `municipality_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parishes`
--

INSERT INTO `parishes` (`id`, `municipality_id`, `name`, `status`) VALUES
(1, 1, 'Castor Nieves Ríos', 1),
(2, 2, 'Santa Rita', 1),
(3, 3, 'José Casanova Godoy', 1),
(4, 4, 'Santa Cruz', 1),
(5, 5, 'Central Tacarigua', 1),
(6, 6, 'Ocumare de La Costa', 1),
(7, 7, 'Colonia Tovar', 1),
(8, 8, 'Alto Orinoco', 0),
(9, 9, 'Atabapo', 0),
(10, 10, 'Atures', 0),
(11, 11, 'Autana', 0),
(12, 12, 'Manapiare', 0),
(13, 13, 'Maroa', 0),
(14, 14, 'Río Negro', 0),
(15, 15, 'Anaco', 0),
(16, 16, 'Aragua', 0),
(17, 17, 'Bolívar', 0),
(18, 18, 'Bruzual', 0),
(19, 19, 'Cajigal', 0),
(20, 20, 'Carvajal', 0),
(21, 21, 'Diego Bautista Urbaneja', 0),
(22, 22, 'Freites', 0),
(23, 23, 'Guanipa', 0),
(24, 24, 'Guanta', 0),
(25, 25, 'Independencia', 0),
(26, 26, 'Libertad', 0),
(27, 27, 'McGregor', 0),
(28, 28, 'Miranda', 0),
(29, 29, 'Monagas', 0),
(30, 30, 'Peñalver', 0),
(31, 31, 'Píritu', 0),
(32, 32, 'San Juan de Capistrano', 0),
(33, 33, 'Santa Ana', 0),
(34, 34, 'Simón Rodríguez', 0),
(35, 35, 'Sotillo', 0),
(36, 36, 'Achaguas', 0),
(37, 37, 'Biruaca', 0),
(38, 38, 'Muñoz', 0),
(39, 39, 'Páez', 0),
(40, 40, 'Pedro Camejo', 0),
(41, 41, 'Rómulo Gallegos', 0),
(42, 42, 'San Fernando', 0),
(43, 43, 'Alberto Arvelo Torrealba', 0),
(44, 44, 'Andrés Eloy Blanco', 0),
(45, 45, 'Antonio José de Sucre', 0),
(46, 46, 'Arismendi', 0),
(47, 47, 'Barinas', 0),
(48, 48, 'Bolívar', 0),
(49, 49, 'Cruz Paredes', 0),
(50, 50, 'Ezequiel Zamora', 0),
(51, 51, 'Obispos', 0),
(52, 52, 'Pedraza', 0),
(53, 53, 'Rojas', 0),
(54, 54, 'Sosa', 0),
(55, 55, 'Angostura del Orinoco', 0),
(56, 56, 'Caroní', 0),
(57, 57, 'Cedeño', 0),
(58, 58, 'El Callao', 0),
(59, 59, 'Gran Sabana', 0),
(60, 60, 'Heres', 0),
(61, 61, 'Piar', 0),
(62, 62, 'Roscio', 0),
(63, 63, 'Sifontes', 0),
(64, 64, 'Sucre', 0),
(65, 65, 'Padre Pedro Chien', 0),
(66, 66, 'Bejuma', 0),
(67, 67, 'Carlos Arvelo', 0),
(68, 68, 'Diego Ibarra', 0),
(69, 69, 'Guacara', 0),
(70, 70, 'Juan José Mora', 0),
(71, 71, 'Libertador', 0),
(72, 72, 'Los Guayos', 0),
(73, 73, 'Miranda', 0),
(74, 74, 'Montalbán', 0),
(75, 75, 'Naguanagua', 0),
(76, 76, 'Puerto Cabello', 0),
(77, 77, 'San Diego', 0),
(78, 78, 'San Joaquín', 0),
(79, 79, 'Valencia', 0),
(80, 80, 'Anzoátegui', 0),
(81, 81, 'Tinaquillo', 0),
(82, 82, 'Girardot', 0),
(83, 83, 'Lima Blanco', 0),
(84, 84, 'Pao de San Juan Bautista', 0),
(85, 85, 'Ricaurte', 0),
(86, 86, 'Rómulo Gallegos', 0),
(87, 87, 'San Carlos', 0),
(88, 88, 'Antonio Díaz', 0),
(89, 89, 'Casacoima', 0),
(90, 90, 'Pedernales', 0),
(91, 91, 'Tucupita', 0),
(92, 92, 'Acosta', 0),
(93, 93, 'Bolívar', 0),
(94, 94, 'Cacique Manaure', 0),
(95, 95, 'Carirubana', 0),
(96, 96, 'Colina', 0),
(97, 97, 'Democracia', 0),
(98, 98, 'Falcón', 0),
(99, 99, 'Federación', 0),
(100, 100, 'Jacura', 0),
(101, 101, 'Los Taques', 0),
(102, 102, 'Miranda', 0),
(103, 103, 'Monseñor Iturriza', 0),
(104, 104, 'Palmasola', 0),
(105, 105, 'San Francisco', 0),
(106, 106, 'Sucre', 0),
(107, 107, 'Altagracia de Orituco', 0),
(108, 108, 'Las Mercedes', 0),
(109, 109, 'José Tadeo Monagas', 0),
(110, 110, 'Ortíz', 0),
(111, 111, 'San Jerónimo de Guaya', 0),
(112, 112, 'San Sebastián', 0),
(113, 113, 'Tucupido', 0),
(114, 114, 'Zaraza', 0),
(115, 115, 'Andrés Eloy Blanco', 0),
(116, 116, 'Iribarren', 0),
(117, 117, 'Jiménez', 0),
(118, 118, 'Morán', 0),
(119, 119, 'Palavecino', 0),
(120, 120, 'Rivas Dávila', 0),
(121, 121, 'Simón Planas', 0),
(122, 122, 'Torres', 0),
(123, 123, 'Urdaneta', 0),
(124, 124, 'Alberto Adriani', 0),
(125, 125, 'Antonio Pinto Salinas', 0),
(126, 126, 'Campo Elías Delgado', 0),
(127, 127, 'Guaraque', 0),
(128, 128, 'José Ramón Yépez', 0),
(129, 129, 'La Azulita', 0),
(130, 130, 'Libertador', 0),
(131, 131, 'Miranda', 0),
(132, 132, 'Rangel', 0),
(133, 133, 'Santos Marquina', 0),
(134, 134, 'Tovar', 0),
(135, 135, 'Zea', 0),
(136, 136, 'Acevedo', 0),
(137, 137, 'Baruta', 0),
(138, 138, 'Bermúdez', 0),
(139, 139, 'Carrizal', 0),
(140, 140, 'Chacao', 0),
(141, 141, 'Cristóbal Rojas', 0),
(142, 142, 'El Hatillo', 0),
(143, 143, 'Guaicaipuro', 0),
(144, 144, 'Los Salias', 0),
(145, 145, 'Miranda', 0),
(146, 146, 'Plaza', 0),
(147, 147, 'Simón Bolívar', 0),
(148, 148, 'Sucre', 0),
(149, 149, 'Acosta', 0),
(150, 150, 'Aguasay', 0),
(151, 151, 'Ezequiel Zamora', 0),
(152, 152, 'Libertador', 0),
(153, 153, 'Maturín', 0),
(154, 154, 'Piar', 0),
(155, 155, 'Platanal', 0),
(156, 156, 'Punceres', 0),
(157, 157, 'Sotillo', 0),
(158, 158, 'Uracoa', 0),
(159, 159, 'Antolín del Campo', 0),
(160, 160, 'Arismendi', 0),
(161, 161, 'Benítez', 0),
(162, 162, 'Díaz', 0),
(163, 163, 'García', 0),
(164, 164, 'Gómez', 0),
(165, 165, 'Maneiro', 0),
(166, 166, 'Marcano', 0),
(167, 167, 'Mariño', 0),
(168, 168, 'Tubores', 0),
(169, 169, 'Villalba', 0),
(170, 170, 'Agua Blanca', 0),
(171, 171, 'Antonio José de Sucre', 0),
(172, 172, 'Araure', 0),
(173, 173, 'Esteller', 0),
(174, 174, 'Guanare', 0),
(175, 175, 'Guanarito', 0),
(176, 176, 'Ospino', 0),
(177, 177, 'Páez', 0),
(178, 178, 'Papelón', 0),
(179, 179, 'San Genaro de Boconoito', 0),
(180, 180, 'San Rafael de Onoto', 0),
(181, 181, 'Turén', 0),
(182, 182, 'Andrés Eloy Blanco', 0),
(183, 183, 'Arismendi', 0),
(184, 184, 'Benítez', 0),
(185, 185, 'Bermúdez', 0),
(186, 186, 'Cajigal', 0),
(187, 187, 'Cumaná', 0),
(188, 188, 'Mariño', 0),
(189, 189, 'Mejía', 0),
(190, 190, 'Montes', 0),
(191, 191, 'Ribero', 0),
(192, 192, 'Sucre', 0),
(193, 193, 'Andrés Bello', 0),
(194, 194, 'Antonio Rómulo Costa', 0),
(195, 195, 'Cárdenas', 0),
(196, 196, 'Comité de la región andina', 0),
(197, 197, 'Escuque', 0),
(198, 198, 'José María Vargas', 0),
(199, 199, 'Junín', 0),
(200, 200, 'Libertad', 0),
(201, 201, 'Mérida', 0),
(202, 202, 'Táriba', 0),
(203, 203, 'Andrés Bello', 0),
(204, 204, 'Bolívar', 0),
(205, 205, 'Escuque', 0),
(206, 206, 'Juan Rodríguez', 0),
(207, 207, 'Miranda', 0),
(208, 208, 'Pampán', 0),
(209, 209, 'San Rafael', 0),
(210, 210, 'Valera', 0),
(211, 211, 'Caraballeda', 0),
(212, 212, 'Carlos Soublette', 0),
(213, 213, 'La Guaira', 0),
(214, 214, 'Vargas', 0),
(215, 215, 'Arístides Bastidas', 0),
(216, 216, 'Bruzual', 0),
(217, 217, 'Cocorote', 0),
(218, 218, 'Independencia', 0),
(219, 219, 'José Antonio Páez', 0),
(220, 220, 'La Trinidad', 0),
(221, 221, 'Nirgua', 0),
(222, 222, 'San Felipe', 0),
(223, 223, 'Urachiche', 0),
(224, 224, 'Almirante Padilla', 0),
(225, 225, 'Colón', 0),
(226, 226, 'Francisco Javier Pulgar', 0),
(227, 227, 'Jesús Enrique Lossada', 0),
(228, 228, 'La Cañada de Urdaneta', 0),
(229, 229, 'Maracaibo', 0),
(230, 230, 'Machiques de Perijá', 0),
(231, 231, 'Miranda', 0),
(232, 232, 'San Francisco', 0),
(233, 233, 'Santa Rita', 0),
(234, 234, 'Sucre', 0),
(235, 235, 'Valmore Rodríguez', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paypal_transfer_info`
--

CREATE TABLE `paypal_transfer_info` (
  `id` int(11) NOT NULL,
  `inn_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paypal_transfer_info`
--

INSERT INTO `paypal_transfer_info` (`id`, `inn_id`, `email`) VALUES
(1, 1, 'jmrm19722@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `last_access` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_type` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `block` tinyint(1) DEFAULT 0,
  `profile_image_url` varchar(255) DEFAULT NULL,
  `banner_image_url` varchar(255) DEFAULT NULL,
  `membership_type` enum('basic','silver','gold','none') DEFAULT 'none',
  `membership_start_date` date DEFAULT NULL,
  `membership_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profile`
--

INSERT INTO `profile` (`id`, `first_name`, `last_name`, `email`, `last_access`, `registration_date`, `profile_type`, `password`, `block`, `profile_image_url`, `banner_image_url`, `membership_type`, `membership_start_date`, `membership_end_date`) VALUES
(1, 'Carlos', 'Escobar', 'carlos@gmail.com', '2024-08-24 18:21:52', '2024-07-14 13:12:11', 'Empresa', '$2y$10$uB0TXSx2fDX1n3wLIZy7N.DO2apo5tEsPP7UNOhgNAzz9kAr6xy0C', 0, NULL, NULL, 'none', NULL, NULL),
(2, 'Arley', 'Dos Santos', 'jmrm19722@gmail.com', '2024-11-18 02:52:59', '2024-08-18 19:04:40', 'Empresa', '$2y$10$AOp2eo9OT17LrkTIqrUbleohQvx2yA0NRNH1BuSW/D4Lp7ryGovTS', 0, 'https://th.bing.com/th/id/OIP.tabNCQDLxYc7x1HqxiUJKQHaHa?rs=1&pid=ImgDetMain', 'https://verdanttraveler.com/wp-content/uploads/2023/12/island-lake-state-recreation-area-1024x585.jpg', 'none', NULL, NULL),
(4, 'Itadori', 'Yuji', 'jmrm19711@gmail.com', '2024-11-18 02:52:24', '2024-09-21 16:02:49', 'Empresa', '$2y$10$i32O6OJyuEu.0IjWi.yybegMuH4GfSL9RBcQn8JhEe8Ok4WYLPOLG', 0, 'https://pm1.narvii.com/7926/0cbc99c9487af031a844b2112a226af7da79f510r1-1078-1080v2_uhq.jpg', NULL, 'none', NULL, NULL),
(5, 'Daniela', 'Morgado', 'dani@gmail.com', '2024-09-23 14:08:00', '2024-09-23 05:42:55', 'Empresa', '$2y$10$e0oZR3qgLa44fjjyIgpEGOpHirslt3ahES006vhg6CqqGbPFOOT8.', 0, 'https://th.bing.com/th/id/R.93361146c64f106b65a55a37d5bc5e02?rik=%2fIP5Ld43L78gOQ&pid=ImgRaw&r=0', 'https://www.pincamp.de/magazin/wp-content/uploads/sites/1/resized/2022/07/AdobeStock_71054640-min-min-1029x350-c-default.png', 'none', NULL, NULL),
(6, 'Nanami', 'Kento', 'jmrm19723@gmail.com', '2024-12-07 02:17:31', '2024-10-05 01:44:56', 'Empresa', '$2y$10$gZ.d87oTQNsDlf8DnWQ9VO.kGKsyq.o0IfbJ/wG0sxPBNvaglEZAS', 0, 'https://www.looper.com/img/gallery/kento-nanamis-powers-from-jujutsu-kaisen-explained/l-intro-1632713276.jpg', 'https://mariginabruno.wordpress.com/wp-content/uploads/2012/01/shutterstock_49390492.jpg', 'gold', '2024-11-29', '2024-12-29'),
(13, 'Juan Francisco', 'Rodriguez', 'gramolca@gmail.com', '2024-11-29 02:07:45', '2024-11-29 02:07:45', 'Turista', '$2y$10$n29WP0qaMfEoSZKxQwqnceytoKFBjVlohk8EnqDSyiBeTZPM/0Aiq', 0, NULL, NULL, 'none', NULL, NULL);

--
-- Disparadores `profile`
--
DELIMITER $$
CREATE TRIGGER `trg_profile_insert` AFTER INSERT ON `profile` FOR EACH ROW BEGIN
    INSERT INTO audit_log (user_id, table_name, action, affected_id, new_data)
    VALUES (NEW.id, 'profile', 'INSERT', NEW.id, CONCAT('first_name: ', NEW.first_name, ', last_name: ', NEW.last_name, ', email: ', NEW.email, ', profile_type: ', NEW.profile_type));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_profile_update` AFTER UPDATE ON `profile` FOR EACH ROW BEGIN
    INSERT INTO audit_log (user_id, table_name, action, affected_id, old_data, new_data)
    VALUES (OLD.id, 'profile', 'UPDATE', OLD.id, CONCAT('first_name: ', OLD.first_name, ', last_name: ', OLD.last_name, ', email: ', OLD.email, ', profile_type: ', OLD.profile_type),
            CONCAT('first_name: ', NEW.first_name, ', last_name: ', NEW.last_name, ', email: ', NEW.email, ', profile_type: ', NEW.profile_type));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `inn_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `receipt_path` varchar(255) DEFAULT NULL,
  `codigo_referencia` varchar(255) DEFAULT NULL,
  `status` enum('En Espera','Confirmado','Cancelado') DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) NOT NULL,
  `monto_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `inn_id`, `start_date`, `end_date`, `payment_method_id`, `receipt_path`, `codigo_referencia`, `status`, `user_id`, `room_id`, `monto_total`) VALUES
(60, 1, '2024-12-07', '2024-12-08', 1, 'uploads/6753ad69076b2-Caso de Uso.jpg', '123213', 'En Espera', 13, 1, 0.00);

--
-- Disparadores `reservations`
--
DELIMITER $$
CREATE TRIGGER `trg_reservations_insert` AFTER INSERT ON `reservations` FOR EACH ROW BEGIN
    INSERT INTO audit_log (user_id, table_name, action, affected_id, new_data)
    VALUES (NEW.user_id, 'reservations', 'INSERT', NEW.id, CONCAT('inn_id: ', NEW.inn_id, ', start_date: ', NEW.start_date, ', end_date: ', NEW.end_date, ', payment_method_id: ', NEW.payment_method_id, ', monto_total: ', NEW.monto_total, ', status: ', NEW.status));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_reservations_update` AFTER UPDATE ON `reservations` FOR EACH ROW BEGIN
    INSERT INTO audit_log (user_id, table_name, action, affected_id, old_data, new_data)
    VALUES (OLD.user_id, 'reservations', 'UPDATE', OLD.id, CONCAT('inn_id: ', OLD.inn_id, ', start_date: ', OLD.start_date, ', end_date: ', OLD.end_date, ', payment_method_id: ', OLD.payment_method_id, ', monto_total: ', OLD.monto_total, ', status: ', OLD.status),
            CONCAT('inn_id: ', NEW.inn_id, ', start_date: ', NEW.start_date, ', end_date: ', NEW.end_date, ', payment_method_id: ', NEW.payment_method_id, ', monto_total: ', NEW.monto_total, ', status: ', NEW.status));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` varchar(50) NOT NULL,
  `type` varchar(100) NOT NULL,
  `quality` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `capacity` int(11) NOT NULL,
  `inn_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `block` tinyint(1) NOT NULL DEFAULT 0,
  `image_url2` varchar(255) DEFAULT NULL,
  `image_url3` varchar(255) DEFAULT NULL,
  `image_url4` varchar(255) DEFAULT NULL,
  `image_url5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `type`, `quality`, `image_url`, `description`, `price`, `capacity`, `inn_id`, `status`, `block`, `image_url2`, `image_url3`, `image_url4`, `image_url5`) VALUES
(1, '101', 'Solo', 'Alta', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Una habitación individual con calidad alta                                            ', 100.00, 2, 1, 0, 0, '', '', '', ''),
(2, '102', 'Pareja', 'Media', 'https://synergy.booking-channel.com/api/hotels/658/medias/90', 'Habitación doble con vista al jardín                                            ', 120.00, 2, 1, 0, 0, '', '', '', ''),
(3, '101', 'Suite', 'Premium', 'https://th.bing.com/th/id/R.cb6ace52900dfb55d10c345b6a7855e4?rik=UHIYinqfPKm4lA&riu=http%3a%2f%2fwww.posadaelsolar.es%2fwp-content%2fuploads%2f2013%2f08%2ffotos-posada-118.jpg&ehk=s5PlXIr4unIHMGw%2bciawMBuQ9%2b4zdv2bU7HRJf26Sbo%3d&risl=&pid=ImgRaw&r=0', 'Suite de lujo con vista al mar', 250.00, 2, 2, 0, 0, NULL, NULL, NULL, NULL),
(4, '102', 'Doble', 'Estándar', 'https://posadalunada.com/wp-content/uploads/cache/images/remote/posadalunada-com/Habitaci%C3%B3n-especial-terraza-Posada-Lunada-1811957839.jpg', 'Habitación doble con balcón', 80.00, 2, 3, 0, 0, NULL, NULL, NULL, NULL),
(5, '101', 'Suite', 'Superior', 'https://sonnigetoskana.ch/image/dirsep--propertiesdirsep--rawdirsep--3adirsep--3af2012ad62786707cf8f2d30b47ade83cc16d9d4433dotsep--jpg/800/600/0/0/0/0.jpg', 'Suite ejecutiva con jacuzzi', 300.00, 2, 4, 0, 0, NULL, NULL, NULL, NULL),
(6, '101', 'Suite', 'Premium', 'https://www.casaviduedo.com/wp-content/uploads/2016/05/DSC_0115.jpg', 'Suite presidencial con terraza privada', 500.00, 2, 5, 0, 0, NULL, NULL, NULL, NULL),
(7, '101', 'Suite', 'Deluxe', 'https://espagnefascinante.fr/images/showid/6751294', 'Suite con vista panorámica', 400.00, 2, 6, 0, 0, NULL, NULL, NULL, NULL),
(11, '103', 'Solo', 'Media', 'https://amenitiz.com/wp-content/uploads/2022/10/rrcibe846jo71ryoxahw.jpg', '                                                                                                                                                                                                Una habitación individual con calidad alta                                                                                                                                                                                                                            ', 120.00, 1, 1, 0, 0, 'https://i.pinimg.com/originals/91/c2/f5/91c2f50f025f9730493ee9f310e295ba.jpg', '', '', ''),
(13, '1', 'Solo', 'Baja', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación sencilla para una persona', 500.00, 1, 15, 0, 0, NULL, NULL, NULL, NULL),
(14, '2', 'Pareja', 'Media', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación para dos personas', 750.00, 2, 16, 0, 0, NULL, NULL, NULL, NULL),
(15, '1', 'Familia', 'Alta', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', '                                                Habitación familiar para 4 personas                                            ', 900.00, 4, 17, 0, 0, '', '', '', ''),
(16, '4', 'Grupal', 'Baja', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación para grupos de hasta 6 personas', 650.00, 6, 18, 0, 0, NULL, NULL, NULL, NULL),
(17, '2', 'Solo', 'Alta', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', '                                                                                                                                                Habitación de lujo para una persona                                                                                                                                    ', 950.00, 1, 19, 0, 0, '', '', '', ''),
(18, '1', 'Pareja', 'Media', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', '                                                Habitación para dos personas con comodidades                                            ', 800.00, 2, 20, 0, 0, '', '', '', ''),
(19, '7', 'Familia', 'Baja', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación para familias de hasta 5 personas', 700.00, 5, 21, 0, 0, NULL, NULL, NULL, NULL),
(20, '8', 'Grupal', 'Alta', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación para grupos de hasta 8 personas', 950.00, 8, 22, 0, 0, NULL, NULL, NULL, NULL),
(21, '9', 'Solo', 'Media', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación estándar para una persona', 600.00, 1, 23, 0, 0, NULL, NULL, NULL, NULL),
(22, '10', 'Pareja', 'Baja', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación económica para dos personas', 550.00, 2, 24, 0, 0, NULL, NULL, NULL, NULL),
(23, '11', 'Familia', 'Media', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación para familias de hasta 6 personas', 750.00, 6, 25, 0, 0, NULL, NULL, NULL, NULL),
(24, '12', 'Grupal', 'Baja', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación para grupos de hasta 7 personas', 700.00, 7, 26, 0, 0, NULL, NULL, NULL, NULL),
(25, '13', 'Solo', 'Alta', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación individual de lujo', 950.00, 1, 27, 0, 0, NULL, NULL, NULL, NULL),
(26, '14', 'Pareja', 'Media', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación cómoda para dos personas', 800.00, 2, 28, 0, 0, NULL, NULL, NULL, NULL),
(27, '15', 'Familia', 'Baja', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación para hasta 5 personas', 650.00, 5, 29, 0, 0, NULL, NULL, NULL, NULL),
(28, '16', 'Solo', 'Baja', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación económica para una persona', 500.00, 1, 30, 0, 0, NULL, NULL, NULL, NULL),
(29, '17', 'Pareja', 'Alta', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación de lujo para dos personas', 900.00, 2, 31, 0, 0, NULL, NULL, NULL, NULL),
(30, '18', 'Familia', 'Media', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación familiar para hasta 4 personas', 800.00, 4, 32, 0, 0, NULL, NULL, NULL, NULL),
(31, '19', 'Grupal', 'Alta', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación para grupos de hasta 6 personas', 850.00, 6, 33, 0, 0, NULL, NULL, NULL, NULL),
(32, '20', 'Solo', 'Alta', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Habitación individual de lujo con vistas', 950.00, 1, 34, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `flag_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id`, `name`, `flag_url`, `status`) VALUES
(1, 'Aragua', 'https://www.venciclopedia.org/images/3/30/Bandera_aragua.jpg', 1),
(2, 'Amazonas', 'https://www.venciclopedia.org/images/2/23/Bandera_amazonas.jpg', 1),
(3, 'Anzoátegui', 'https://www.venciclopedia.org/images/2/2f/Bandera_anzoategui.gif', 1),
(4, 'Apure', 'https://www.venciclopedia.org/images/4/47/Bandera_apure.jpg', 1),
(5, 'Barinas', 'https://www.venciclopedia.org/images/b/b2/Bandera_barinas.gif', 1),
(6, 'Bolívar', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Flag_of_Bol%C3%ADvar_State.svg/1024px-Flag_of_Bol%C3%ADvar_State.svg.png', 1),
(7, 'Carabobo', 'https://www.venciclopedia.org/images/8/8f/Bandera_carabobo.gif', 1),
(8, 'Cojedes', 'https://www.venciclopedia.org/images/9/9a/Bandera_cojedes.gif', 1),
(9, 'Delta Amacuro', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/Flag_of_Delta_Amacuro_State.svg/1024px-Flag_of_Delta_Amacuro_State.svg.png', 1),
(10, 'Falcón', 'https://www.venciclopedia.org/images/4/49/Bandera_falcon.gif', 1),
(11, 'Guárico', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Flag_of_Guárico_%28Venezuela%29.svg/512px-Flag_of_Guárico_%28Venezuela%29.svg.png', 1),
(12, 'Lara', 'https://www.venciclopedia.org/images/b/bd/Bandera_lara.jpg', 1),
(13, 'Mérida', 'https://www.venciclopedia.org/images/a/ac/Bandera_merida.gif', 1),
(14, 'Miranda', 'https://www.venciclopedia.org/images/c/cf/Bandera_miranda.jpg', 1),
(15, 'Monagas', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/31/Flag_of_Monagas_State.svg/800px-Flag_of_Monagas_State.svg.png', 1),
(16, 'Nueva Esparta', 'https://www.venciclopedia.org/images/0/02/Bandera_nueva.gif', 1),
(17, 'Portuguesa', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/81/Flag_of_Portuguesa.svg/1024px-Flag_of_Portuguesa.svg.png', 1),
(18, 'Sucre', 'https://www.venciclopedia.org/images/3/3b/Bandera_sucre.gif', 1),
(19, 'Táchira', 'https://www.venciclopedia.org/images/thumb/a/aa/Bandera_tachira.jpg/800px-Bandera_tachira.jpg', 1),
(20, 'Trujillo', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b0/Flag_of_Trujillo_State.svg/1024px-Flag_of_Trujillo_State.svg.png', 1),
(21, 'La Guaira', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Flag_of_Vargas_State.svg/1024px-Flag_of_Vargas_State.svg.png', 1),
(22, 'Yaracuy', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Flag_of_Yaracuy_State.svg/1024px-Flag_of_Yaracuy_State.svg.png', 1),
(23, 'Zulia', 'https://www.venciclopedia.org/images/8/86/Bandera_zulia.gif', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tour_packages`
--

CREATE TABLE `tour_packages` (
  `id` int(11) NOT NULL,
  `inn_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint(4) DEFAULT 0,
  `block` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tour_packages`
--

INSERT INTO `tour_packages` (`id`, `inn_id`, `name`, `description`, `image_url`, `duration`, `price`, `status`, `block`) VALUES
(1, 1, 'Paquete Aventura', 'Disfruta de aventuras emocionantes', 'https://static8.depositphotos.com/1301180/801/v/950/depositphotos_8013806-stock-illustration-vip-icon.jpg', 7, 250.00, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_favorite_inns`
--

CREATE TABLE `user_favorite_inns` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `inn_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_favorite_inns`
--

INSERT INTO `user_favorite_inns` (`id`, `user_id`, `inn_id`, `created_at`) VALUES
(4, 6, 3, '2024-11-17 01:00:29'),
(5, 6, 2, '2024-11-17 03:45:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `inn_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `registration_plate` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) DEFAULT 0,
  `block` tinyint(1) DEFAULT 0,
  `image_url2` varchar(255) DEFAULT NULL,
  `image_url3` varchar(255) DEFAULT NULL,
  `image_url4` varchar(255) DEFAULT NULL,
  `image_url5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehicles`
--

INSERT INTO `vehicles` (`id`, `inn_id`, `type`, `brand`, `description`, `price`, `capacity`, `year`, `model`, `registration_plate`, `image_url`, `created_at`, `updated_at`, `status`, `block`, `image_url2`, `image_url3`, `image_url4`, `image_url5`) VALUES
(1, 1, 'Carro', 'Toyota', 'Corolla', 100.00, 5, 2000, 'Corolla AE85', '1234', 'https://www.motorbiscuit.com/wp-content/uploads/2019/06/2020_Corolla_SE_6MT_BlueCrushMetallic_005_B8A068D7A9EB56FCD3624D03B54536BA09EAAD3C.jpg', '2024-07-12 20:45:56', '2024-10-11 20:14:11', 0, 0, NULL, NULL, NULL, NULL),
(2, 1, NULL, 'Honda', 'Honda Accord', 100.00, 5, 2023, 'Accord', 'DEF456', 'https://4.bp.blogspot.com/-2SuYEVuk0rE/WC03Ez5GAFI/AAAAAAAAGeY/4RSMr4doHXAJo7aWif_8ZerTz_qGCmGpACLcB/s1600/2017_Honda_Accord_Hybrid___3.jpg', '2024-07-14 18:36:27', '2024-11-30 20:05:35', 0, 0, 'https://media.autoexpress.co.uk/image/private/s--V-bYmpPk--/v1562244725/autoexpress/2017/07/10_2018_honda_accord_touring.jpg', '', '', ''),
(3, 2, 'Lancha', 'Sea Ray', 'Lancha para excursiones', 60000.00, 8, 2022, 'Modelo A', 'XYZ789', 'https://www.lugaresturisticosdeveracruz.com/wp-content/uploads/2021/07/Lancha-Sea-Ray-26-b-980x600-1.jpg', '2024-07-14 18:36:27', '2024-08-27 03:22:09', 0, 0, NULL, NULL, NULL, NULL),
(4, 3, 'Auto', 'Chevrolet', 'Chevrolet Spark', 18000.00, 4, 2021, 'Spark', 'GHI789', 'https://upload.wikimedia.org/wikipedia/commons/d/de/Chevrolet_Spark_LT%2B_1.2_(Facelift)_%E2%80%93_Frontansicht%2C_4._Januar_2014%2C_D%C3%BCsseldorf.jpg', '2024-07-14 18:48:22', '2024-07-14 18:48:22', 0, 0, NULL, NULL, NULL, NULL),
(5, 5, 'Lancha', 'Bayliner', 'Lancha deportiva', 75000.00, 6, 2023, 'Modelo B', 'OPQ456', 'https://www.pronautica.cl/wp-content/uploads/2016/08/170BR.jpg', '2024-07-14 18:48:22', '2024-07-14 18:48:22', 0, 0, NULL, NULL, NULL, NULL),
(6, 6, 'Auto', 'Toyota', 'Toyota Camry', 32000.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-07-14 18:48:22', '2024-07-14 18:48:22', 0, 0, NULL, NULL, NULL, NULL),
(14, 15, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:22:17', 0, 0, NULL, NULL, NULL, NULL),
(15, 16, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:22:17', 0, 0, NULL, NULL, NULL, NULL),
(16, 17, NULL, 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:44:04', 0, 0, '', '', '', ''),
(17, 18, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:22:17', 0, 0, NULL, NULL, NULL, NULL),
(18, 19, NULL, 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:57:34', 0, 0, '', '', '', ''),
(19, 20, NULL, 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:51:33', 0, 0, '', '', '', ''),
(20, 21, 'Auto', 'Toyota', '', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:37:29', 0, 0, NULL, NULL, NULL, NULL),
(21, 22, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:36:25', 0, 0, NULL, NULL, NULL, NULL),
(22, 23, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:36:25', 0, 0, NULL, NULL, NULL, NULL),
(23, 24, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:36:25', 0, 0, NULL, NULL, NULL, NULL),
(24, 25, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:36:25', 0, 0, NULL, NULL, NULL, NULL),
(25, 26, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:36:25', 0, 0, NULL, NULL, NULL, NULL),
(26, 27, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:36:25', 0, 0, NULL, NULL, NULL, NULL),
(27, 28, 'Auto', 'Toyota', 'Toyota Camry', 0.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b4...', '2024-11-30 19:18:55', '2024-11-30 19:36:25', 0, 0, NULL, NULL, NULL, NULL),
(28, 29, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:55', '2024-11-30 19:37:18', 0, 0, NULL, NULL, NULL, NULL),
(29, 30, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b4...', '2024-11-30 19:18:55', '2024-11-30 19:18:55', 0, 0, NULL, NULL, NULL, NULL),
(30, 31, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b4...', '2024-11-30 19:18:55', '2024-11-30 19:18:55', 0, 0, NULL, NULL, NULL, NULL),
(31, 32, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b4...', '2024-11-30 19:18:55', '2024-11-30 19:18:55', 0, 0, NULL, NULL, NULL, NULL),
(32, 33, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b4...', '2024-11-30 19:18:56', '2024-11-30 19:18:56', 0, 0, NULL, NULL, NULL, NULL),
(33, 34, 'Auto', 'Toyota', 'Toyota Camry', 34.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', '2024-11-30 19:18:56', '2024-11-30 19:22:55', 0, 0, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `bank_transfer_info`
--
ALTER TABLE `bank_transfer_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inn_id` (`inn_id`);

--
-- Indices de la tabla `binance_transfer_info`
--
ALTER TABLE `binance_transfer_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inn_id` (`inn_id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indices de la tabla `inns`
--
ALTER TABLE `inns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `municipality_id` (`municipality_id`),
  ADD KEY `parish_id` (`parish_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `membership_purchases`
--
ALTER TABLE `membership_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `incoming_msg_id` (`incoming_msg_id`),
  ADD KEY `outgoing_msg_id` (`outgoing_msg_id`);

--
-- Indices de la tabla `mobile_payment_info`
--
ALTER TABLE `mobile_payment_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inn_id` (`inn_id`);

--
-- Indices de la tabla `municipalities`
--
ALTER TABLE `municipalities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indices de la tabla `parishes`
--
ALTER TABLE `parishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipality_id` (`municipality_id`);

--
-- Indices de la tabla `paypal_transfer_info`
--
ALTER TABLE `paypal_transfer_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inn_id` (`inn_id`);

--
-- Indices de la tabla `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inn_id` (`inn_id`);

--
-- Indices de la tabla `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inn_id` (`inn_id`);

--
-- Indices de la tabla `user_favorite_inns`
--
ALTER TABLE `user_favorite_inns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `inn_id` (`inn_id`);

--
-- Indices de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inn_id` (`inn_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT de la tabla `bank_transfer_info`
--
ALTER TABLE `bank_transfer_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `binance_transfer_info`
--
ALTER TABLE `binance_transfer_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `inns`
--
ALTER TABLE `inns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `membership_purchases`
--
ALTER TABLE `membership_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mobile_payment_info`
--
ALTER TABLE `mobile_payment_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `municipalities`
--
ALTER TABLE `municipalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT de la tabla `parishes`
--
ALTER TABLE `parishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT de la tabla `paypal_transfer_info`
--
ALTER TABLE `paypal_transfer_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tour_packages`
--
ALTER TABLE `tour_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `user_favorite_inns`
--
ALTER TABLE `user_favorite_inns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `audit_log`
--
ALTER TABLE `audit_log`
  ADD CONSTRAINT `audit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `bank_transfer_info`
--
ALTER TABLE `bank_transfer_info`
  ADD CONSTRAINT `bank_transfer_info_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`);

--
-- Filtros para la tabla `binance_transfer_info`
--
ALTER TABLE `binance_transfer_info`
  ADD CONSTRAINT `binance_transfer_info_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Filtros para la tabla `inns`
--
ALTER TABLE `inns`
  ADD CONSTRAINT `inns_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`),
  ADD CONSTRAINT `inns_ibfk_2` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`id`),
  ADD CONSTRAINT `inns_ibfk_3` FOREIGN KEY (`parish_id`) REFERENCES `parishes` (`id`),
  ADD CONSTRAINT `inns_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `membership_purchases`
--
ALTER TABLE `membership_purchases`
  ADD CONSTRAINT `membership_purchases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `profile` (`id`);

--
-- Filtros para la tabla `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`incoming_msg_id`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`outgoing_msg_id`) REFERENCES `profile` (`id`);

--
-- Filtros para la tabla `mobile_payment_info`
--
ALTER TABLE `mobile_payment_info`
  ADD CONSTRAINT `mobile_payment_info_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`);

--
-- Filtros para la tabla `municipalities`
--
ALTER TABLE `municipalities`
  ADD CONSTRAINT `municipalities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Filtros para la tabla `parishes`
--
ALTER TABLE `parishes`
  ADD CONSTRAINT `parishes_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`id`);

--
-- Filtros para la tabla `paypal_transfer_info`
--
ALTER TABLE `paypal_transfer_info`
  ADD CONSTRAINT `paypal_transfer_info_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`);

--
-- Filtros para la tabla `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD CONSTRAINT `tour_packages_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`);

--
-- Filtros para la tabla `user_favorite_inns`
--
ALTER TABLE `user_favorite_inns`
  ADD CONSTRAINT `user_favorite_inns_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `user_favorite_inns_ibfk_2` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`);

--
-- Filtros para la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
