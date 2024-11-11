-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2024 a las 05:27:17
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
(101, 7, 'profile', 'INSERT', 7, '2024-10-27 19:15:42', NULL, 'first_name: Nanami, last_name: Kento, email: jmrm19725@gmail.com, profile_type: Turista'),
(102, 8, 'profile', 'INSERT', 8, '2024-10-27 19:16:45', NULL, 'first_name: Nanami, last_name: Kento, email: jmrm19726@gmail.com, profile_type: Empresa'),
(103, 6, 'profile', 'UPDATE', 6, '2024-11-04 02:25:30', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(104, 6, 'profile', 'UPDATE', 6, '2024-11-04 02:27:13', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa', 'first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa'),
(105, 6, 'inns', 'UPDATE', 1, '2024-11-07 20:39:08', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1', 'name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1'),
(106, 2, 'inns', 'UPDATE', 2, '2024-11-07 21:02:26', 'name: Posada La Montaña, status: 0, email: info@posadamontana.com, phone: +58 412 3456789, state_id: 1', 'name: Posada La Montaña, status: 0, email: info@posadamontana.com, phone: +58 412 3456789, state_id: 1');

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
(6, 1, 'Miguel', '1202', '0191');

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
(1, 'Posada Colonia Tovar', 'Comodidad garantizada', 'https://elviajerofeliz.com/wp-content/uploads/2015/11/colonia-tovar.jpg', 1, 'jmrm19722@gmail.com', '04243363970', 1, 7, 7, 1, 6, 1, 'Alta'),
(2, 'Posada La Montaña', 'Una posada acogedora en las montañas', 'https://bariloche.org/directorio/photos/61/file/36/Posada%20de%20Monta%C3%B1a?size=large', 0, 'info@posadamontana.com', '+58 412 3456789', 1, 1, 1, 1, 2, 0, 'Baja'),
(3, 'Posada El Sol', 'Disfruta del sol y la playa en nuestra posada', 'https://wcm.transat.com/getmedia/e8c1e3f7-f135-4d17-9753-08cac53fd513/Posada-Real-Puerto-Escondido-Aerial-001?width=1400', 0, 'contacto@posadaelsol.com', '+58 416 9876543', 1, 1, 1, 2, 2, 0, 'Media'),
(4, 'Posada Familiar', 'Un lugar ideal para disfrutar en familia', 'https://i.pinimg.com/originals/63/a3/52/63a3528f9d939451d1da5e36b946a381.jpg', 0, 'reservas@posadafamiliar.com', '+58 414 1234567', 1, 1, 1, 3, 2, 0, 'Media'),
(5, 'Posada El Descanso', 'Para aquellos que buscan un descanso merecido', 'https://hotelesdemargarita.com/img/posadalamar-08.jpg', 1, 'descanso@posadaeldescanso.com', '+58 426 2345678', 1, 1, 1, 2, NULL, 0, 'Media'),
(6, 'Posada Vista al Lago', 'Con hermosas vistas al lago', 'https://th.bing.com/th/id/OIP.9Ff-KWJollAV99_0g289SgHaFj?w=1024&h=768&rs=1&pid=ImgDetMain', 1, 'vista@posadavistaallago.com', '+58 412 8765432', 1, 1, 1, 3, NULL, 0, 'Media');

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
(1, 6, 'basic', '2024-10-20', '2024-11-20', 150.00, 'completed');

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
(7, 1, 'Tovar', 'https://upload.wikimedia.org/wikipedia/commons/9/92/Bandera_del_Municipio_Tovar.svg', 1);

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
(7, 7, 'Colonia Tovar', 1);

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
  `youtube_url` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `membership_type` enum('basic','silver','gold','none') DEFAULT 'none',
  `membership_start_date` date DEFAULT NULL,
  `membership_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profile`
--

INSERT INTO `profile` (`id`, `first_name`, `last_name`, `email`, `last_access`, `registration_date`, `profile_type`, `password`, `block`, `profile_image_url`, `banner_image_url`, `youtube_url`, `facebook_url`, `twitter_url`, `instagram_url`, `membership_type`, `membership_start_date`, `membership_end_date`) VALUES
(1, 'Carlos', 'Escobar', 'carlos@gmail.com', '2024-08-24 18:21:52', '2024-07-14 13:12:11', 'Empresa', '$2y$10$uB0TXSx2fDX1n3wLIZy7N.DO2apo5tEsPP7UNOhgNAzz9kAr6xy0C', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'none', NULL, NULL),
(2, 'Nanami', 'Kento', 'jmrm19722@gmail.com', '2024-09-23 14:09:00', '2024-08-18 19:04:40', 'Empresa', '$2y$10$AOp2eo9OT17LrkTIqrUbleohQvx2yA0NRNH1BuSW/D4Lp7ryGovTS', 0, 'https://th.bing.com/th/id/OIP.tabNCQDLxYc7x1HqxiUJKQHaHa?rs=1&pid=ImgDetMain', 'https://verdanttraveler.com/wp-content/uploads/2023/12/island-lake-state-recreation-area-1024x585.jpg', 'https://www.youtube.com/', 'https://www.facebook.com/', '', '', 'none', NULL, NULL),
(4, 'Nanami', 'Kento', 'jmrm19711@gmail.com', '2024-09-21 16:02:49', '2024-09-21 16:02:49', 'Empresa', '$2y$10$i32O6OJyuEu.0IjWi.yybegMuH4GfSL9RBcQn8JhEe8Ok4WYLPOLG', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'none', NULL, NULL),
(5, 'Daniela', 'Morgado', 'dani@gmail.com', '2024-09-23 14:08:00', '2024-09-23 05:42:55', 'Empresa', '$2y$10$e0oZR3qgLa44fjjyIgpEGOpHirslt3ahES006vhg6CqqGbPFOOT8.', 0, 'https://th.bing.com/th/id/R.93361146c64f106b65a55a37d5bc5e02?rik=%2fIP5Ld43L78gOQ&pid=ImgRaw&r=0', 'https://www.pincamp.de/magazin/wp-content/uploads/sites/1/resized/2022/07/AdobeStock_71054640-min-min-1029x350-c-default.png', '', '', '', '', 'none', NULL, NULL),
(6, 'Nanami', 'Kento', 'jmrm19723@gmail.com', '2024-11-04 02:27:13', '2024-10-05 01:44:56', 'Empresa', '$2y$10$gZ.d87oTQNsDlf8DnWQ9VO.kGKsyq.o0IfbJ/wG0sxPBNvaglEZAS', 0, 'https://www.looper.com/img/gallery/kento-nanamis-powers-from-jujutsu-kaisen-explained/l-intro-1632713276.jpg', 'https://mariginabruno.wordpress.com/wp-content/uploads/2012/01/shutterstock_49390492.jpg', '', '', '', '', 'basic', '2024-10-20', '2024-11-20'),
(7, 'Nanami', 'Kento', 'jmrm19725@gmail.com', '2024-10-27 19:15:42', '2024-10-27 19:15:42', 'Turista', '$2y$10$.sJoSpKt9aw8K3wx7bfMNOoG9lJVp0jwMpI96b5ftFH5txWOS67Mu', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'none', NULL, NULL),
(8, 'Nanami', 'Kento', 'jmrm19726@gmail.com', '2024-10-27 19:16:45', '2024-10-27 19:16:45', 'Empresa', '$2y$10$pX8kVv.4v7uPm8RkueFKZeoc2CI/ctao9MSw4xtFRzEaQQmsZcgyu', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'none', NULL, NULL);

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
  `monto_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `inn_id`, `start_date`, `end_date`, `payment_method_id`, `receipt_path`, `codigo_referencia`, `status`, `user_id`, `monto_total`) VALUES
(31, 2, '2024-09-12', '2024-09-13', 1, 'uploads/66e1a341a26dc-OIP98.jpg', '1234', 'Confirmado', 2, 500),
(32, 3, '2024-10-10', '2024-10-09', 3, '', '1234', 'Confirmado', 5, NULL),
(33, 1, '2024-09-23', '2024-09-24', 3, '', '1234', 'Confirmado', 5, NULL),
(34, 11, '2024-10-25', '2024-09-23', 1, 'uploads/66f198192366c-Perfil.png', '1234', 'En Espera', 5, NULL);

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
(1, '101', 'Single', 'High', 'https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg', 'Una habitación individual con calidad alta', 100.00, 2, 1, 0, 0, NULL, NULL, NULL, NULL),
(2, '102', 'Doble', 'Alta', 'https://synergy.booking-channel.com/api/hotels/658/medias/90', 'Habitación doble con vista al jardín', 120.00, 2, 1, 0, 0, NULL, NULL, NULL, NULL),
(3, '101', 'Suite', 'Premium', 'https://th.bing.com/th/id/R.cb6ace52900dfb55d10c345b6a7855e4?rik=UHIYinqfPKm4lA&riu=http%3a%2f%2fwww.posadaelsolar.es%2fwp-content%2fuploads%2f2013%2f08%2ffotos-posada-118.jpg&ehk=s5PlXIr4unIHMGw%2bciawMBuQ9%2b4zdv2bU7HRJf26Sbo%3d&risl=&pid=ImgRaw&r=0', 'Suite de lujo con vista al mar', 250.00, 2, 2, 0, 0, NULL, NULL, NULL, NULL),
(4, '102', 'Doble', 'Estándar', 'https://posadalunada.com/wp-content/uploads/cache/images/remote/posadalunada-com/Habitaci%C3%B3n-especial-terraza-Posada-Lunada-1811957839.jpg', 'Habitación doble con balcón', 80.00, 2, 3, 0, 0, NULL, NULL, NULL, NULL),
(5, '101', 'Suite', 'Superior', 'https://sonnigetoskana.ch/image/dirsep--propertiesdirsep--rawdirsep--3adirsep--3af2012ad62786707cf8f2d30b47ade83cc16d9d4433dotsep--jpg/800/600/0/0/0/0.jpg', 'Suite ejecutiva con jacuzzi', 300.00, 2, 4, 0, 0, NULL, NULL, NULL, NULL),
(6, '101', 'Suite', 'Premium', 'https://www.casaviduedo.com/wp-content/uploads/2016/05/DSC_0115.jpg', 'Suite presidencial con terraza privada', 500.00, 2, 5, 0, 0, NULL, NULL, NULL, NULL),
(7, '101', 'Suite', 'Deluxe', 'https://espagnefascinante.fr/images/showid/6751294', 'Suite con vista panorámica', 400.00, 2, 6, 0, 0, NULL, NULL, NULL, NULL),
(11, '103', 'Single', 'Alta', 'https://amenitiz.com/wp-content/uploads/2022/10/rrcibe846jo71ryoxahw.jpg', 'Una habitación individual con calidad alta', 120.00, 1, 1, 0, 0, 'https://i.pinimg.com/originals/91/c2/f5/91c2f50f025f9730493ee9f310e295ba.jpg', '', '', '');

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
  `invoice` varchar(255) DEFAULT NULL,
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

INSERT INTO `vehicles` (`id`, `inn_id`, `type`, `brand`, `description`, `price`, `capacity`, `year`, `model`, `registration_plate`, `image_url`, `invoice`, `created_at`, `updated_at`, `status`, `block`, `image_url2`, `image_url3`, `image_url4`, `image_url5`) VALUES
(1, 1, 'Carro', 'Toyota', 'Corolla', 100.00, 5, 2000, 'Corolla AE85', '1234', 'https://www.motorbiscuit.com/wp-content/uploads/2019/06/2020_Corolla_SE_6MT_BlueCrushMetallic_005_B8A068D7A9EB56FCD3624D03B54536BA09EAAD3C.jpg', 'asas', '2024-07-12 20:45:56', '2024-10-11 20:14:11', 0, 0, NULL, NULL, NULL, NULL),
(2, 1, 'Accord', 'Honda', 'Honda Accord', 28000.00, 5, 2023, 'Accord', 'DEF456', 'https://4.bp.blogspot.com/-2SuYEVuk0rE/WC03Ez5GAFI/AAAAAAAAGeY/4RSMr4doHXAJo7aWif_8ZerTz_qGCmGpACLcB/s1600/2017_Honda_Accord_Hybrid___3.jpg', 'invoice_honda.pdf', '2024-07-14 18:36:27', '2024-11-04 02:17:31', 0, 0, 'https://media.autoexpress.co.uk/image/private/s--V-bYmpPk--/v1562244725/autoexpress/2017/07/10_2018_honda_accord_touring.jpg', '', '', ''),
(3, 2, 'Lancha', 'Sea Ray', 'Lancha para excursiones', 60000.00, 8, 2022, 'Modelo A', 'XYZ789', 'https://www.lugaresturisticosdeveracruz.com/wp-content/uploads/2021/07/Lancha-Sea-Ray-26-b-980x600-1.jpg', 'invoice_lancha.pdf', '2024-07-14 18:36:27', '2024-08-27 03:22:09', 0, 0, NULL, NULL, NULL, NULL),
(4, 3, 'Auto', 'Chevrolet', 'Chevrolet Spark', 18000.00, 4, 2021, 'Spark', 'GHI789', 'https://upload.wikimedia.org/wikipedia/commons/d/de/Chevrolet_Spark_LT%2B_1.2_(Facelift)_%E2%80%93_Frontansicht%2C_4._Januar_2014%2C_D%C3%BCsseldorf.jpg', 'invoice_chevrolet.pdf', '2024-07-14 18:48:22', '2024-07-14 18:48:22', 0, 0, NULL, NULL, NULL, NULL),
(5, 5, 'Lancha', 'Bayliner', 'Lancha deportiva', 75000.00, 6, 2023, 'Modelo B', 'OPQ456', 'https://www.pronautica.cl/wp-content/uploads/2016/08/170BR.jpg', 'invoice_bayliner.pdf', '2024-07-14 18:48:22', '2024-07-14 18:48:22', 0, 0, NULL, NULL, NULL, NULL),
(6, 6, 'Auto', 'Toyota', 'Toyota Camry', 32000.00, 5, 2022, 'Camry', 'RST789', 'https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0', 'invoice_toyota.pdf', '2024-07-14 18:48:22', '2024-07-14 18:48:22', 0, 0, NULL, NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `membership_purchases`
--
ALTER TABLE `membership_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `parishes`
--
ALTER TABLE `parishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `paypal_transfer_info`
--
ALTER TABLE `paypal_transfer_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- Filtros para la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
