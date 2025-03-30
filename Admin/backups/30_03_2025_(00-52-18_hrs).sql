SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS VenBooking;

USE VenBooking;

DROP TABLE IF EXISTS audit_log;

CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `action` varchar(50) NOT NULL,
  `affected_id` int(11) NOT NULL,
  `action_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `old_data` text DEFAULT NULL,
  `new_data` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `audit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=269 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO audit_log VALUES("56","6","profile","INSERT","6","2024-10-04 21:44:56","","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("58","6","inns","UPDATE","1","2024-10-11 11:45:32","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("59","6","inns","UPDATE","1","2024-10-11 11:45:35","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("60","6","inns","UPDATE","1","2024-10-11 11:45:49","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("61","6","inns","UPDATE","1","2024-10-11 11:45:52","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("62","6","inns","UPDATE","1","2024-10-11 11:49:48","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("63","6","inns","UPDATE","1","2024-10-11 11:49:51","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("64","6","inns","UPDATE","1","2024-10-11 11:50:07","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("65","6","inns","UPDATE","1","2024-10-11 11:58:49","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("66","6","inns","UPDATE","1","2024-10-11 11:58:55","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("67","6","inns","UPDATE","1","2024-10-11 11:58:56","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("68","6","inns","INSERT","12","2024-10-11 12:01:19","","name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1");
INSERT INTO audit_log VALUES("69","6","inns","UPDATE","1","2024-10-11 12:32:04","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("70","6","inns","UPDATE","1","2024-10-11 12:32:05","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("71","6","inns","UPDATE","1","2024-10-11 12:32:06","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("72","6","inns","UPDATE","1","2024-10-11 12:32:08","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("73","6","inns","UPDATE","1","2024-10-11 12:32:10","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("74","6","inns","UPDATE","1","2024-10-11 12:32:12","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("75","6","inns","UPDATE","12","2024-10-11 12:35:27","name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1");
INSERT INTO audit_log VALUES("76","6","inns","UPDATE","12","2024-10-11 12:35:28","name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1");
INSERT INTO audit_log VALUES("77","6","inns","UPDATE","12","2024-10-11 13:27:07","name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1");
INSERT INTO audit_log VALUES("78","6","inns","UPDATE","12","2024-10-11 13:27:09","name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1");
INSERT INTO audit_log VALUES("79","6","inns","UPDATE","12","2024-10-11 13:27:22","name: Example, status: 1, email: eloy@gmail.com, phone: 1234, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 123, state_id: 1");
INSERT INTO audit_log VALUES("80","6","inns","UPDATE","12","2024-10-11 13:27:33","name: Example, status: 1, email: eloy@gmail.com, phone: 123, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1");
INSERT INTO audit_log VALUES("81","6","inns","UPDATE","12","2024-10-11 13:27:56","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1");
INSERT INTO audit_log VALUES("82","6","inns","UPDATE","12","2024-10-11 13:27:58","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1");
INSERT INTO audit_log VALUES("83","6","inns","UPDATE","12","2024-10-11 13:27:59","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1");
INSERT INTO audit_log VALUES("84","6","inns","UPDATE","12","2024-10-11 13:28:00","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1");
INSERT INTO audit_log VALUES("86","6","inns","UPDATE","1","2024-10-11 18:33:55","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("87","6","inns","UPDATE","1","2024-10-11 18:33:56","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("88","6","inns","UPDATE","12","2024-10-11 18:49:20","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1");
INSERT INTO audit_log VALUES("89","6","inns","UPDATE","12","2024-10-11 18:49:21","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1");
INSERT INTO audit_log VALUES("90","6","inns","UPDATE","12","2024-10-11 18:49:26","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1");
INSERT INTO audit_log VALUES("91","6","inns","UPDATE","12","2024-10-11 18:49:32","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1");
INSERT INTO audit_log VALUES("92","6","inns","UPDATE","1","2024-10-12 17:40:12","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("93","6","inns","UPDATE","12","2024-10-12 17:40:14","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 0424, state_id: 1");
INSERT INTO audit_log VALUES("94","6","inns","UPDATE","1","2024-10-12 17:45:16","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("96","6","inns","UPDATE","1","2024-10-12 17:49:52","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("97","6","profile","UPDATE","6","2024-10-19 19:51:30","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("98","6","profile","UPDATE","6","2024-10-19 20:54:24","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("99","6","profile","UPDATE","6","2024-10-19 20:56:47","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("100","6","profile","UPDATE","6","2024-10-19 21:01:44","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("103","6","profile","UPDATE","6","2024-11-03 22:25:30","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("104","6","profile","UPDATE","6","2024-11-03 22:27:13","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("105","6","inns","UPDATE","1","2024-11-07 16:39:08","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("107","6","reservations","INSERT","35","2024-11-15 20:09:05","","");
INSERT INTO audit_log VALUES("108","6","reservations","INSERT","36","2024-11-15 20:21:13","","");
INSERT INTO audit_log VALUES("109","6","reservations","INSERT","37","2024-11-15 20:59:05","","inn_id: 2, start_date: 2024-11-29, end_date: 2024-11-30, payment_method_id: 1, monto_total: 500, status: En Espera");
INSERT INTO audit_log VALUES("110","6","reservations","INSERT","38","2024-11-15 21:02:30","","inn_id: 2, start_date: 2024-11-29, end_date: 2024-11-30, payment_method_id: 1, monto_total: 500, status: En Espera");
INSERT INTO audit_log VALUES("111","6","reservations","INSERT","39","2024-11-15 21:02:44","","inn_id: 2, start_date: 2024-11-16, end_date: 2024-11-17, payment_method_id: 1, monto_total: 500, status: En Espera");
INSERT INTO audit_log VALUES("112","6","reservations","INSERT","40","2024-11-15 21:07:04","","inn_id: 2, start_date: 2024-11-21, end_date: 2024-11-22, payment_method_id: 1, monto_total: 500, status: En Espera");
INSERT INTO audit_log VALUES("113","6","reservations","INSERT","41","2024-11-15 21:52:58","","");
INSERT INTO audit_log VALUES("114","6","reservations","INSERT","42","2024-11-16 07:38:16","","inn_id: 2, start_date: 2025-02-02, end_date: 2025-02-04, payment_method_id: 1, monto_total: 750, status: En Espera");
INSERT INTO audit_log VALUES("115","6","reservations","INSERT","43","2024-11-16 07:43:48","","inn_id: 2, start_date: 2025-02-19, end_date: 2025-02-21, payment_method_id: 1, monto_total: 750, status: En Espera");
INSERT INTO audit_log VALUES("122","6","profile","UPDATE","6","2024-11-23 06:23:52","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("123","6","profile","UPDATE","6","2024-11-23 21:29:29","first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("124","6","profile","UPDATE","6","2024-11-23 21:31:35","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("125","6","profile","UPDATE","6","2024-11-23 21:52:07","first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("126","6","profile","UPDATE","6","2024-11-23 21:53:21","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("127","6","profile","UPDATE","6","2024-11-23 21:53:33","first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("128","13","profile","INSERT","13","2024-11-28 22:07:45","","first_name: Juan Francisco, last_name: Rodriguez, email: gramolca@gmail.com, profile_type: Turista");
INSERT INTO audit_log VALUES("129","6","profile","UPDATE","6","2024-11-28 22:35:41","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("131","6","inns","UPDATE","1","2024-11-28 22:37:17","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("134","6","inns","UPDATE","3","2024-11-29 20:24:08","name: Posada El Sol, status: 0, email: contacto@posadaelsol.com, phone: +58 416 9876543, state_id: 1","name: Posada El Sol, status: 0, email: contacto@posadaelsol.com, phone: +58 416 9876543, state_id: 1");
INSERT INTO audit_log VALUES("135","6","inns","UPDATE","1","2024-11-29 20:24:36","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tova, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("136","6","inns","UPDATE","1","2024-11-29 20:24:55","name: Posada Colonia Tova, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("137","6","inns","UPDATE","1","2024-11-29 20:25:01","name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("138","6","inns","INSERT","13","2024-11-29 20:32:27","","name: Example, status: 1, email: gramolca@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("139","6","inns","UPDATE","1","2024-11-29 20:37:41","name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("140","6","inns","UPDATE","1","2024-11-29 20:37:45","name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("141","6","inns","UPDATE","1","2024-11-29 20:38:03","name: Posada , status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("142","6","inns","UPDATE","1","2024-11-29 20:38:08","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("143","6","inns","UPDATE","1","2024-11-29 20:39:26","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("144","6","inns","UPDATE","1","2024-11-29 20:39:51","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("145","6","inns","INSERT","14","2024-11-29 21:11:55","","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("146","6","inns","UPDATE","14","2024-11-29 21:15:50","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("147","6","inns","UPDATE","14","2024-11-29 21:16:23","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("148","6","inns","UPDATE","14","2024-11-29 21:21:53","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("149","6","inns","UPDATE","4","2024-11-29 21:27:37","name: Posada Familiar, status: 0, email: reservas@posadafamiliar.com, phone: +58 414 1234567, state_id: 1","name: Posada Familiar, status: 0, email: reservas@posadafamiliar.com, phone: +58 414 1234567, state_id: 1");
INSERT INTO audit_log VALUES("150","6","inns","UPDATE","14","2024-11-29 21:27:50","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("151","6","inns","UPDATE","14","2024-11-29 21:29:43","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("152","6","inns","UPDATE","14","2024-11-29 21:29:53","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("153","6","inns","UPDATE","14","2024-11-29 21:35:12","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("154","6","inns","UPDATE","14","2024-11-29 21:35:35","name: Example, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1","name: Examples, status: 1, email: eloy@gmail.com, phone: 04243363970, state_id: 1");
INSERT INTO audit_log VALUES("194","6","inns","UPDATE","15","2024-11-30 14:30:25","name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 1","name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 2");
INSERT INTO audit_log VALUES("195","6","inns","UPDATE","15","2024-11-30 14:31:57","name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 2","name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 2");
INSERT INTO audit_log VALUES("196","6","inns","UPDATE","15","2024-11-30 14:34:41","name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 2","name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 2");
INSERT INTO audit_log VALUES("197","6","inns","UPDATE","18","2024-11-30 14:35:25","name: Amanecer Andino, status: 0, email: amanecerandino@example.com, phone: 04120000004, state_id: 1","name: Amanecer Andino, status: 0, email: amanecerandino@example.com, phone: 04120000004, state_id: 3");
INSERT INTO audit_log VALUES("198","6","inns","UPDATE","17","2024-11-30 14:36:39","name: Ciudad Moderna, status: 0, email: ciudadmoderna@example.com, phone: 04120000003, state_id: 1","name: Ciudad Moderna, status: 0, email: ciudadmoderna@example.com, phone: 04120000003, state_id: 4");
INSERT INTO audit_log VALUES("199","6","inns","UPDATE","20","2024-11-30 14:37:28","name: Urbana Suites, status: 0, email: urbanasuites@example.com, phone: 04120000006, state_id: 1","name: Urbana Suites, status: 0, email: urbanasuites@example.com, phone: 04120000006, state_id: 5");
INSERT INTO audit_log VALUES("200","6","inns","UPDATE","20","2024-11-30 14:38:43","name: Urbana Suites, status: 0, email: urbanasuites@example.com, phone: 04120000006, state_id: 5","name: Urbana Suites, status: 0, email: urbanasuites@example.com, phone: 04120000006, state_id: 5");
INSERT INTO audit_log VALUES("201","6","inns","UPDATE","16","2024-11-30 14:39:46","name: Playa Azul, status: 0, email: playazul@example.com, phone: 04120000002, state_id: 1","name: Playa Azul, status: 0, email: playazul@example.com, phone: 04120000002, state_id: 10");
INSERT INTO audit_log VALUES("202","6","inns","UPDATE","19","2024-11-30 14:41:00","name: Sol Caribeño, status: 0, email: solcaribeno@example.com, phone: 04120000005, state_id: 1","name: Sol Caribeño, status: 0, email: solcaribeno@example.com, phone: 04120000005, state_id: 8");
INSERT INTO audit_log VALUES("203","6","inns","UPDATE","22","2024-11-30 14:43:15","name: Arena Dorada, status: 0, email: arenadorada@example.com, phone: 04120000008, state_id: 1","name: Arena Dorada, status: 0, email: arenadorada@example.com, phone: 04120000008, state_id: 14");
INSERT INTO audit_log VALUES("204","6","inns","UPDATE","26","2024-11-30 14:45:23","name: Skyline Hotel, status: 0, email: skylinehotel@example.com, phone: 04120000012, state_id: 1","name: Skyline Hotel, status: 0, email: skylinehotel@example.com, phone: 04120000012, state_id: 7");
INSERT INTO audit_log VALUES("205","6","inns","UPDATE","30","2024-11-30 14:46:09","name: Valle Dorado, status: 0, email: valledorado@example.com, phone: 04120000016, state_id: 1","name: Valle Dorado, status: 0, email: valledorado@example.com, phone: 04120000016, state_id: 18");
INSERT INTO audit_log VALUES("206","6","inns","UPDATE","29","2024-11-30 14:46:57","name: Urbano Chic, status: 0, email: urbanochic@example.com, phone: 04120000015, state_id: 1","name: Urbano Chic, status: 0, email: urbanochic@example.com, phone: 04120000015, state_id: 22");
INSERT INTO audit_log VALUES("207","6","inns","UPDATE","24","2024-11-30 14:48:03","name: Montaña Verde, status: 0, email: montanaverde@example.com, phone: 04120000010, state_id: 1","name: Montaña Verde, status: 0, email: montanaverde@example.com, phone: 04120000010, state_id: 23");
INSERT INTO audit_log VALUES("208","6","inns","UPDATE","21","2024-11-30 14:49:26","name: Refugio Nevado, status: 0, email: refugionevado@example.com, phone: 04120000007, state_id: 1","name: Refugio Nevado, status: 0, email: refugionevado@example.com, phone: 04120000007, state_id: 13");
INSERT INTO audit_log VALUES("209","6","inns","UPDATE","27","2024-11-30 14:51:06","name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 1","name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 21");
INSERT INTO audit_log VALUES("210","6","inns","UPDATE","27","2024-11-30 14:51:20","name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 21","name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 21");
INSERT INTO audit_log VALUES("211","6","inns","UPDATE","27","2024-11-30 14:51:38","name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 21","name: Cumbre Eterna, status: 0, email: cumbreeterna@example.com, phone: 04120000013, state_id: 21");
INSERT INTO audit_log VALUES("212","6","inns","UPDATE","23","2024-11-30 14:55:54","name: Metropolitan Inn, status: 0, email: metropolitaninn@example.com, phone: 04120000009, state_id: 1","name: Metropolitan Inn, status: 0, email: metropolitaninn@example.com, phone: 04120000009, state_id: 17");
INSERT INTO audit_log VALUES("213","6","inns","UPDATE","32","2024-11-30 14:57:19","name: Central Inn, status: 0, email: centralinn@example.com, phone: 04120000018, state_id: 1","name: Central Inn, status: 0, email: centralinn@example.com, phone: 04120000018, state_id: 17");
INSERT INTO audit_log VALUES("214","6","inns","UPDATE","33","2024-11-30 14:58:10","name: Rocío de Montaña, status: 0, email: rociodemontana@example.com, phone: 04120000019, state_id: 1","name: Rocío de Montaña, status: 0, email: rociodemontana@example.com, phone: 04120000019, state_id: 9");
INSERT INTO audit_log VALUES("215","6","inns","UPDATE","28","2024-11-30 14:59:01","name: Playa Cristal, status: 0, email: playacristal@example.com, phone: 04120000014, state_id: 1","name: Playa Cristal, status: 0, email: playacristal@example.com, phone: 04120000014, state_id: 5");
INSERT INTO audit_log VALUES("216","6","inns","UPDATE","25","2024-11-30 14:59:37","name: Costa Brava, status: 0, email: costabrava@example.com, phone: 04120000011, state_id: 1","name: Costa Brava, status: 0, email: costabrava@example.com, phone: 04120000011, state_id: 6");
INSERT INTO audit_log VALUES("217","6","inns","UPDATE","31","2024-11-30 15:00:58","name: Mar Azul, status: 0, email: marazul@example.com, phone: 04120000017, state_id: 1","name: Mar Azul, status: 0, email: marazul@example.com, phone: 04120000017, state_id: 16");
INSERT INTO audit_log VALUES("218","6","profile","UPDATE","6","2024-12-06 20:41:43","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("219","6","profile","UPDATE","6","2024-12-06 20:41:49","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("220","13","reservations","INSERT","60","2024-12-06 22:05:29","","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: En Espera");
INSERT INTO audit_log VALUES("221","6","profile","UPDATE","6","2024-12-06 22:16:44","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("222","6","profile","UPDATE","6","2024-12-06 22:17:31","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("223","6","profile","UPDATE","6","2025-01-04 17:31:33","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("224","6","profile","UPDATE","6","2025-01-04 17:32:23","first_name: Nanamis, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("225","6","inns","UPDATE","1","2025-01-12 17:29:33","name: Posada Colonia Tovar, status: 1, email: jmrm19722@gmail.com, phone: 04243363970, state_id: 1","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1");
INSERT INTO audit_log VALUES("226","6","inns","UPDATE","1","2025-01-12 17:30:15","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1");
INSERT INTO audit_log VALUES("227","6","inns","UPDATE","2","2025-01-12 17:31:30","name: Posada La Montaña, status: 0, email: info@posadamontana.com, phone: +58 412 3456789, state_id: 1","name: Posada Montaña Encantada, status: 0, email: montanaencantada@posadasvenezuela.com, phone: +58 412 3456789, state_id: 1");
INSERT INTO audit_log VALUES("228","6","inns","UPDATE","3","2025-01-12 17:32:44","name: Posada El Sol, status: 0, email: contacto@posadaelsol.com, phone: +58 416 9876543, state_id: 1","name: Posada Sol Dorado, status: 0, email: soldorado@posadasvenezuela.com, phone: +58 416 9876543, state_id: 1");
INSERT INTO audit_log VALUES("229","6","inns","UPDATE","15","2025-01-12 18:15:52","name: Montaña Serena, status: 0, email: montanaserena@example.com, phone: 04120000001, state_id: 2","name: Posada Cielo Azul Descripción, status: 0, email: cieloazul@posadasvenezuela.com, phone: 04120000001, state_id: 2");
INSERT INTO audit_log VALUES("230","6","inns","UPDATE","20","2025-01-12 18:16:40","name: Urbana Suites, status: 0, email: urbanasuites@example.com, phone: 04120000006, state_id: 5","name: Posada Jardín Secreto, status: 0, email: jardinsecreto@posadasvenezuela.com, phone: 04120000006, state_id: 5");
INSERT INTO audit_log VALUES("231","6","inns","UPDATE","15","2025-01-12 18:17:17","name: Posada Cielo Azul Descripción, status: 0, email: cieloazul@posadasvenezuela.com, phone: 04120000001, state_id: 2","name: Posada Cielo Azul, status: 0, email: cieloazul@posadasvenezuela.com, phone: 04120000001, state_id: 2");
INSERT INTO audit_log VALUES("232","6","inns","UPDATE","18","2025-01-12 18:17:38","name: Amanecer Andino, status: 0, email: amanecerandino@example.com, phone: 04120000004, state_id: 3","name: Amanecer Andino, status: 0, email: amanecerandino@example.com, phone: 04120000004, state_id: 3");
INSERT INTO audit_log VALUES("233","6","inns","UPDATE","1","2025-01-12 18:19:19","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1");
INSERT INTO audit_log VALUES("234","6","inns","UPDATE","1","2025-01-12 18:20:31","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1");
INSERT INTO audit_log VALUES("235","6","inns","UPDATE","1","2025-01-12 18:23:23","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1");
INSERT INTO audit_log VALUES("236","6","inns","UPDATE","2","2025-01-12 18:23:43","name: Posada Montaña Encantada, status: 0, email: montanaencantada@posadasvenezuela.com, phone: +58 412 3456789, state_id: 1","name: Posada Montaña Encantada, status: 0, email: montanaencantada@posadasvenezuela.com, phone: +58 412 3456789, state_id: 1");
INSERT INTO audit_log VALUES("237","6","inns","UPDATE","2","2025-01-12 18:26:20","name: Posada Montaña Encantada, status: 0, email: montanaencantada@posadasvenezuela.com, phone: +58 412 3456789, state_id: 1","name: Posada Montaña Encantada, status: 0, email: montanaencantada@posadasvenezuela.com, phone: +58 412 3456789, state_id: 1");
INSERT INTO audit_log VALUES("238","6","inns","UPDATE","2","2025-01-12 18:26:39","name: Posada Montaña Encantada, status: 0, email: montanaencantada@posadasvenezuela.com, phone: +58 412 3456789, state_id: 1","name: Posada Montaña Encantada, status: 0, email: montanaencantada@posadasvenezuela.com, phone: +58 412 3456789, state_id: 1");
INSERT INTO audit_log VALUES("239","6","inns","UPDATE","3","2025-01-12 18:27:12","name: Posada Sol Dorado, status: 0, email: soldorado@posadasvenezuela.com, phone: +58 416 9876543, state_id: 1","name: Posada Sol Dorado, status: 0, email: soldorado@posadasvenezuela.com, phone: +58 416 9876543, state_id: 14");
INSERT INTO audit_log VALUES("240","6","inns","UPDATE","20","2025-01-12 18:29:11","name: Posada Jardín Secreto, status: 0, email: jardinsecreto@posadasvenezuela.com, phone: 04120000006, state_id: 5","name: Posada Jardín Secreto, status: 0, email: jardinsecreto@posadasvenezuela.com, phone: 04120000006, state_id: 7");
INSERT INTO audit_log VALUES("241","6","inns","UPDATE","4","2025-01-12 19:25:59","name: Posada Familiar, status: 0, email: reservas@posadafamiliar.com, phone: +58 414 1234567, state_id: 1","name: Posada Vistas del Pico, status: 0, email: reservas@posadafamiliar.com, phone: +58 414 1234567, state_id: 13");
INSERT INTO audit_log VALUES("242","6","inns","UPDATE","4","2025-01-12 19:27:33","name: Posada Vistas del Pico, status: 0, email: reservas@posadafamiliar.com, phone: +58 414 1234567, state_id: 13","name: Posada Vistas del Pico, status: 0, email: reservas@posadafamiliar.com, phone: +58 414 1234567, state_id: 13");
INSERT INTO audit_log VALUES("243","6","inns","UPDATE","16","2025-01-12 19:29:52","name: Playa Azul, status: 0, email: playazul@example.com, phone: 04120000002, state_id: 10","name: Posada Brisa Marina, status: 0, email: brisamarina@posadasvenezuela.com, phone: 04120000002, state_id: 10");
INSERT INTO audit_log VALUES("244","6","profile","UPDATE","6","2025-01-12 20:00:37","first_name: Nanami, last_name: Kento, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Arley, last_name: Dos Santos, email: jmrm19723@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("245","6","profile","UPDATE","6","2025-01-12 20:00:58","first_name: Arley, last_name: Dos Santos, email: jmrm19723@gmail.com, profile_type: Empresa","first_name: Arley, last_name: Dos Santos, email: arley@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("246","13","profile","UPDATE","13","2025-01-12 20:02:36","first_name: Juan Francisco, last_name: Rodriguez, email: gramolca@gmail.com, profile_type: Turista","first_name: Carlos, last_name: Escobar, email: carlosescobar@gmail.com, profile_type: Turista");
INSERT INTO audit_log VALUES("247","14","profile","INSERT","14","2025-01-12 20:11:03","","first_name: Daniela, last_name: Morgado, email: daniela@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("248","14","profile","UPDATE","14","2025-01-12 20:12:34","first_name: Daniela, last_name: Morgado, email: daniela@gmail.com, profile_type: Empresa","first_name: Daniela, last_name: Morgado, email: daniela@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("249","6","inns","UPDATE","20","2025-01-12 20:13:02","name: Posada Jardín Secreto, status: 0, email: jardinsecreto@posadasvenezuela.com, phone: 04120000006, state_id: 7","name: Posada Jardín Secreto, status: 0, email: jardinsecreto@posadasvenezuela.com, phone: 04120000006, state_id: 7");
INSERT INTO audit_log VALUES("250","6","inns","UPDATE","18","2025-01-12 20:13:19","name: Amanecer Andino, status: 0, email: amanecerandino@example.com, phone: 04120000004, state_id: 3","name: Amanecer Andino, status: 0, email: amanecerandino@example.com, phone: 04120000004, state_id: 3");
INSERT INTO audit_log VALUES("251","6","inns","UPDATE","15","2025-01-12 20:13:29","name: Posada Cielo Azul, status: 0, email: cieloazul@posadasvenezuela.com, phone: 04120000001, state_id: 2","name: Posada Cielo Azul, status: 0, email: cieloazul@posadasvenezuela.com, phone: 04120000001, state_id: 2");
INSERT INTO audit_log VALUES("252","6","profile","UPDATE","6","2025-01-12 22:28:16","first_name: Arley, last_name: Dos Santos, email: arley@gmail.com, profile_type: Empresa","first_name: Arleys, last_name: Dos Santos, email: arley@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("253","6","profile","UPDATE","6","2025-01-12 22:28:20","first_name: Arleys, last_name: Dos Santos, email: arley@gmail.com, profile_type: Empresa","first_name: Arley, last_name: Dos Santos, email: arley@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("254","13","reservations","UPDATE","60","2025-01-12 22:35:43","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: En Espera","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Confirmado");
INSERT INTO audit_log VALUES("255","6","inns","UPDATE","1","2025-01-12 23:15:05","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1");
INSERT INTO audit_log VALUES("256","6","inns","UPDATE","1","2025-01-12 23:15:08","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1","name: Posada El Paraíso Tropical, status: 1, email: paradisotropical@posadasvenezuela.com, phone: 04243264971, state_id: 1");
INSERT INTO audit_log VALUES("257","13","reservations","UPDATE","60","2025-03-28 19:18:33","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Confirmado","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Confirmado");
INSERT INTO audit_log VALUES("258","13","reservations","UPDATE","60","2025-03-28 19:18:40","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Confirmado","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Confirmado");
INSERT INTO audit_log VALUES("259","13","reservations","UPDATE","60","2025-03-28 19:19:29","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Confirmado","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Confirmado");
INSERT INTO audit_log VALUES("260","13","reservations","UPDATE","60","2025-03-28 19:20:01","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Confirmado","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Confirmado");
INSERT INTO audit_log VALUES("261","13","reservations","UPDATE","60","2025-03-28 19:20:04","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Confirmado","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Cancelado");
INSERT INTO audit_log VALUES("262","13","reservations","UPDATE","60","2025-03-28 19:20:07","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Cancelado","inn_id: 1, start_date: 2024-12-07, end_date: 2024-12-08, payment_method_id: 1, monto_total: 0.00, status: Confirmado");
INSERT INTO audit_log VALUES("264","6","profile","UPDATE","6","2025-03-28 20:55:11","first_name: Arley, last_name: Dos Santos, email: arley@gmail.com, profile_type: Empresa","first_name: Arley, last_name: Dos Santos, email: arley@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("265","6","profile","UPDATE","6","2025-03-28 21:02:15","first_name: Arley, last_name: Dos Santos, email: arley@gmail.com, profile_type: Empresa","first_name: Arley, last_name: Dos Santos, email: arley@gmail.com, profile_type: Empresa");
INSERT INTO audit_log VALUES("266","13","reservations","INSERT","61","2025-03-29 18:15:43","","inn_id: 17, start_date: 2025-03-29, end_date: 2025-03-30, payment_method_id: 1, monto_total: 0.00, status: En Espera");
INSERT INTO audit_log VALUES("267","13","reservations","INSERT","62","2025-03-29 18:16:38","","inn_id: 16, start_date: 2025-03-29, end_date: 2025-04-04, payment_method_id: 2, monto_total: 0.00, status: En Espera");
INSERT INTO audit_log VALUES("268","13","reservations","INSERT","63","2025-03-29 18:17:58","","inn_id: 4, start_date: 2025-04-16, end_date: 2025-05-22, payment_method_id: 1, monto_total: 0.00, status: En Espera");



DROP TABLE IF EXISTS bank_transfer_info;

CREATE TABLE `bank_transfer_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inn_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `account_number` varchar(20) NOT NULL,
  `bank_code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inn_id` (`inn_id`),
  CONSTRAINT `bank_transfer_info_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO bank_transfer_info VALUES("6","1","Arley Dos Santos","6276093817733776","0102");
INSERT INTO bank_transfer_info VALUES("7","2","Arley Dos Santos","6276093817733776","0102");
INSERT INTO bank_transfer_info VALUES("8","3","Arley Dos Santos","6276093817733776","0102");
INSERT INTO bank_transfer_info VALUES("9","4","Arley Dos Santos","6276093817733776","0102");
INSERT INTO bank_transfer_info VALUES("10","16","Arley Dos Santos","6276093817733776","0102");
INSERT INTO bank_transfer_info VALUES("11","17","Arley Dos Santos","6276093817733776","0102");



DROP TABLE IF EXISTS binance_transfer_info;

CREATE TABLE `binance_transfer_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inn_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inn_id` (`inn_id`),
  CONSTRAINT `binance_transfer_info_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO binance_transfer_info VALUES("2","1","arleyds19@gmail.com");
INSERT INTO binance_transfer_info VALUES("3","2","arleyds19@gmail.com");
INSERT INTO binance_transfer_info VALUES("4","3","arleyds19@gmail.com");
INSERT INTO binance_transfer_info VALUES("5","4","arleyds19@gmail.com");
INSERT INTO binance_transfer_info VALUES("6","16","arleyds19@gmail.com");
INSERT INTO binance_transfer_info VALUES("7","17","arleyds19@gmail.com");



DROP TABLE IF EXISTS categories;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO categories VALUES("1","Montaña");
INSERT INTO categories VALUES("2","Playa");
INSERT INTO categories VALUES("3","Ciudad");



DROP TABLE IF EXISTS destinations;

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`),
  CONSTRAINT `destinations_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO destinations VALUES("1","Salto Ángel","images/angel-falls.jpg","El Salto Ángel es la cascada ininterrumpida más alta del mundo, ubicada en el Parque Nacional Canaima, un sitio del Patrimonio Mundial de la UNESCO.","Parque Nacional Canaima, Bolívar","1","1");
INSERT INTO destinations VALUES("2","Isla Margarita","images/margarita-island.jpg","La Isla Margarita es conocida por sus hermosas playas, vibrante vida nocturna y oportunidades de compras libres de impuestos.","Nueva Esparta","2","1");
INSERT INTO destinations VALUES("3","Archipiélago Los Roques","images/los-roques.jpg","Los Roques es un paraíso para los amantes del snorkel y el buceo, ofreciendo aguas cristalinas y una abundante vida marina.","Los Roques","3","1");
INSERT INTO destinations VALUES("4","Mérida","images/merida.jpg","Mérida es hogar de los famosos Andes, ofreciendo una gama de actividades al aire libre como senderismo, escalada y parapente.","Mérida","4","1");
INSERT INTO destinations VALUES("5","Choroní","images/choroni.jpg","Choroní es un pintoresco pueblo con arquitectura colonial, impresionantes playas y una puerta de entrada al Parque Nacional Henri Pittier.","Aragua","5","1");
INSERT INTO destinations VALUES("6","Parque Nacional Henri Pittier","images/henri-pittier.jpg","El Parque Nacional Henri Pittier es el parque nacional más antiguo de Venezuela, conocido por su biodiversidad y hermosos paisajes.","Aragua","5","1");



DROP TABLE IF EXISTS inns;

CREATE TABLE `inns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `quality` enum('Alta','Media','Baja') NOT NULL DEFAULT 'Media',
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`),
  KEY `municipality_id` (`municipality_id`),
  KEY `parish_id` (`parish_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `inns_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`),
  CONSTRAINT `inns_ibfk_2` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`id`),
  CONSTRAINT `inns_ibfk_3` FOREIGN KEY (`parish_id`) REFERENCES `parishes` (`id`),
  CONSTRAINT `inns_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO inns VALUES("1","Posada El Paraíso Tropical","Rodeada de palmeras y a pocos metros de la playa, un verdadero oasis para descansar","https://turismosucre.com.ve/images/alojamiento/2020/posadaplayacolorada_800x600b.jpg","1","paradisotropical@posadasvenezuela.com","04243264971","1","6","6","2","6","0","Alta");
INSERT INTO inns VALUES("2","Posada Montaña Encantada","Refugio perfecto en la montaña para los amantes de la naturaleza y la tranquilidad.","https://th.bing.com/th/id/OIP.IKfr97zhbqcHg36yQETB8gHaFj?w=560&h=420&rs=1&pid=ImgDetMain","0","montanaencantada@posadasvenezuela.com","+58 412 3456789","1","7","7","1","6","0","Baja");
INSERT INTO inns VALUES("3","Posada Sol Dorado","Disfruta del cálido sol venezolano en un lugar lleno de encanto y comodidad.","https://wcm.transat.com/getmedia/e8c1e3f7-f135-4d17-9753-08cac53fd513/Posada-Real-Puerto-Escondido-Aerial-001?width=1400","0","soldorado@posadasvenezuela.com","+58 416 9876543","14","144","144","2","6","0","Media");
INSERT INTO inns VALUES("4","Posada Vistas del Pico","Habitaciones con impresionantes vistas a las cumbres andinas, perfectas para los aventureros.","https://i.pinimg.com/originals/63/a3/52/63a3528f9d939451d1da5e36b946a381.jpg","0","reservas@posadafamiliar.com","+58 414 1234567","13","131","131","3","6","0","Alta");
INSERT INTO inns VALUES("15","Posada Cielo Azul","Miradores espectaculares y habitaciones con vistas al infinito cielo azul","https://img.freepik.com/foto-gratis/casa-madera-fotorrealista-estructura-madera_23-2151302622.jpg","0","cieloazul@posadasvenezuela.com","04120000001","2","8","8","1","14","0","Alta");
INSERT INTO inns VALUES("16","Posada Brisa Marina","Sumérgete en la tranquilidad del mar y despierta con la brisa salada en tu piel.","https://i.pinimg.com/564x/37/64/50/376450d02718c098839aa5360239a6a7.jpg","0","brisamarina@posadasvenezuela.com","04120000002","10","98","98","2","6","0","Media");
INSERT INTO inns VALUES("17","Ciudad Moderna","Céntrica y cómoda en la ciudad.","https://i.pinimg.com/736x/03/8f/83/038f83747d955777fabfe4fb1e75222b.jpg","0","ciudadmoderna@example.com","04120000003","4","36","36","3","6","0","Media");
INSERT INTO inns VALUES("18","Amanecer Andino","Vive la tradición andina en un ambiente acogedor y culturalmente enriquecedor.","https://images.homify.com/c_fill,f_auto,h_500,q_auto,w_1280/v1564007379/p/photo/image/3139647/20.jpg","0","amanecerandino@example.com","04120000004","3","15","15","1","14","0","Media");
INSERT INTO inns VALUES("20","Posada Jardín Secreto","Un rincón escondido lleno de flores y paz para desconectarse del mundo.","https://i.ytimg.com/vi/_qTDdx2HBUA/maxresdefault.jpg","0","jardinsecreto@posadasvenezuela.com","04120000006","7","77","77","3","14","0","Media");



DROP TABLE IF EXISTS membership_purchases;

CREATE TABLE `membership_purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `membership_type` enum('basic','silver','gold') NOT NULL,
  `purchase_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `membership_purchases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO membership_purchases VALUES("1","6","basic","2024-10-20","2024-11-20","150.00","completed");
INSERT INTO membership_purchases VALUES("5","6","gold","2024-11-29","2024-12-29","100.00","completed");



DROP TABLE IF EXISTS messages;

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int(11) NOT NULL,
  `outgoing_msg_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`msg_id`),
  KEY `incoming_msg_id` (`incoming_msg_id`),
  KEY `outgoing_msg_id` (`outgoing_msg_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`incoming_msg_id`) REFERENCES `profile` (`id`),
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`outgoing_msg_id`) REFERENCES `profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO messages VALUES("2","13","6","Prueba","2025-03-22 23:32:26");
INSERT INTO messages VALUES("3","14","6","Prueba","2025-03-22 23:34:48");
INSERT INTO messages VALUES("4","6","14","Prueba","2025-03-22 23:46:58");



DROP TABLE IF EXISTS mobile_payment_info;

CREATE TABLE `mobile_payment_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inn_id` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `bank_code` varchar(10) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inn_id` (`inn_id`),
  CONSTRAINT `mobile_payment_info_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO mobile_payment_info VALUES("1","2","30578057","0102","04124407966");
INSERT INTO mobile_payment_info VALUES("6","1","30578057","0102","04124407966");
INSERT INTO mobile_payment_info VALUES("7","3","30578057","0102","04124407966");
INSERT INTO mobile_payment_info VALUES("8","4","30578057","0102","04124407966");
INSERT INTO mobile_payment_info VALUES("9","16","30578057","0102","04124407966");
INSERT INTO mobile_payment_info VALUES("10","17","30578057","0102","04124407966");



DROP TABLE IF EXISTS municipalities;

CREATE TABLE `municipalities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `flag_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`),
  CONSTRAINT `municipalities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO municipalities VALUES("1","1","José Félix Ribas","https://upload.wikimedia.org/wikipedia/commons/a/af/Bandera_Jose_Felix_Ribas_Aragua.PNG","1");
INSERT INTO municipalities VALUES("2","1","Francisco Linares Alcántara","https://upload.wikimedia.org/wikipedia/commons/6/6d/Bandera_Municipio_Francisco_Linares_Alc%C3%A1ntara.jpg","1");
INSERT INTO municipalities VALUES("3","1","Girardot","https://estadoaragua.org/wp-content/uploads/2021/06/Bandera-Girardot.jpg","1");
INSERT INTO municipalities VALUES("4","1","José Ángel Lamas","https://upload.wikimedia.org/wikipedia/commons/2/28/Bandera_Jose_Angel_Lamas.PNG","1");
INSERT INTO municipalities VALUES("5","1","Mario Briceño Iragorry","https://upload.wikimedia.org/wikipedia/commons/8/8e/Bandera_Mario_Brice%C3%B1o_Iragorri_Aragua.PNG","1");
INSERT INTO municipalities VALUES("6","1","Ocumare de La Costa de Oro","https://estadoaragua.org/wp-content/uploads/2021/11/EscudoDelMunicipioOcumareDeLaCosta.jpg","1");
INSERT INTO municipalities VALUES("7","1","Tovar","https://upload.wikimedia.org/wikipedia/commons/9/92/Bandera_del_Municipio_Tovar.svg","1");
INSERT INTO municipalities VALUES("8","2","Alto Orinoco","","0");
INSERT INTO municipalities VALUES("9","2","Atabapo","","0");
INSERT INTO municipalities VALUES("10","2","Atures","","0");
INSERT INTO municipalities VALUES("11","2","Autana","","0");
INSERT INTO municipalities VALUES("12","2","Manapiare","","0");
INSERT INTO municipalities VALUES("13","2","Maroa","","0");
INSERT INTO municipalities VALUES("14","2","Río Negro","","0");
INSERT INTO municipalities VALUES("15","3","Anaco","","0");
INSERT INTO municipalities VALUES("16","3","Aragua","","0");
INSERT INTO municipalities VALUES("17","3","Bolívar","","0");
INSERT INTO municipalities VALUES("18","3","Bruzual","","0");
INSERT INTO municipalities VALUES("19","3","Cajigal","","0");
INSERT INTO municipalities VALUES("20","3","Carvajal","","0");
INSERT INTO municipalities VALUES("21","3","Diego Bautista Urbaneja","","0");
INSERT INTO municipalities VALUES("22","3","Freites","","0");
INSERT INTO municipalities VALUES("23","3","Guanipa","","0");
INSERT INTO municipalities VALUES("24","3","Guanta","","0");
INSERT INTO municipalities VALUES("25","3","Independencia","","0");
INSERT INTO municipalities VALUES("26","3","Libertad","","0");
INSERT INTO municipalities VALUES("27","3","McGregor","","0");
INSERT INTO municipalities VALUES("28","3","Miranda","","0");
INSERT INTO municipalities VALUES("29","3","Monagas","","0");
INSERT INTO municipalities VALUES("30","3","Peñalver","","0");
INSERT INTO municipalities VALUES("31","3","Píritu","","0");
INSERT INTO municipalities VALUES("32","3","San Juan de Capistrano","","0");
INSERT INTO municipalities VALUES("33","3","Santa Ana","","0");
INSERT INTO municipalities VALUES("34","3","Simón Rodríguez","","0");
INSERT INTO municipalities VALUES("35","3","Sotillo","","0");
INSERT INTO municipalities VALUES("36","4","Achaguas","","0");
INSERT INTO municipalities VALUES("37","4","Biruaca","","0");
INSERT INTO municipalities VALUES("38","4","Muñoz","","0");
INSERT INTO municipalities VALUES("39","4","Páez","","0");
INSERT INTO municipalities VALUES("40","4","Pedro Camejo","","0");
INSERT INTO municipalities VALUES("41","4","Rómulo Gallegos","","0");
INSERT INTO municipalities VALUES("42","4","San Fernando","","0");
INSERT INTO municipalities VALUES("43","5","Alberto Arvelo Torrealba","","0");
INSERT INTO municipalities VALUES("44","5","Andrés Eloy Blanco","","0");
INSERT INTO municipalities VALUES("45","5","Antonio José de Sucre","","0");
INSERT INTO municipalities VALUES("46","5","Arismendi","","0");
INSERT INTO municipalities VALUES("47","5","Barinas","","0");
INSERT INTO municipalities VALUES("48","5","Bolívar","","0");
INSERT INTO municipalities VALUES("49","5","Cruz Paredes","","0");
INSERT INTO municipalities VALUES("50","5","Ezequiel Zamora","","0");
INSERT INTO municipalities VALUES("51","5","Obispos","","0");
INSERT INTO municipalities VALUES("52","5","Pedraza","","0");
INSERT INTO municipalities VALUES("53","5","Rojas","","0");
INSERT INTO municipalities VALUES("54","5","Sosa","","0");
INSERT INTO municipalities VALUES("55","6","Angostura del Orinoco","","0");
INSERT INTO municipalities VALUES("56","6","Caroní","","0");
INSERT INTO municipalities VALUES("57","6","Cedeño","","0");
INSERT INTO municipalities VALUES("58","6","El Callao","","0");
INSERT INTO municipalities VALUES("59","6","Gran Sabana","","0");
INSERT INTO municipalities VALUES("60","6","Heres","","0");
INSERT INTO municipalities VALUES("61","6","Piar","","0");
INSERT INTO municipalities VALUES("62","6","Roscio","","0");
INSERT INTO municipalities VALUES("63","6","Sifontes","","0");
INSERT INTO municipalities VALUES("64","6","Sucre","","0");
INSERT INTO municipalities VALUES("65","6","Padre Pedro Chien","","0");
INSERT INTO municipalities VALUES("66","7","Bejuma","","0");
INSERT INTO municipalities VALUES("67","7","Carlos Arvelo","","0");
INSERT INTO municipalities VALUES("68","7","Diego Ibarra","","0");
INSERT INTO municipalities VALUES("69","7","Guacara","","0");
INSERT INTO municipalities VALUES("70","7","Juan José Mora","","0");
INSERT INTO municipalities VALUES("71","7","Libertador","","0");
INSERT INTO municipalities VALUES("72","7","Los Guayos","","0");
INSERT INTO municipalities VALUES("73","7","Miranda","","0");
INSERT INTO municipalities VALUES("74","7","Montalbán","","0");
INSERT INTO municipalities VALUES("75","7","Naguanagua","","0");
INSERT INTO municipalities VALUES("76","7","Puerto Cabello","","0");
INSERT INTO municipalities VALUES("77","7","San Diego","","0");
INSERT INTO municipalities VALUES("78","7","San Joaquín","","0");
INSERT INTO municipalities VALUES("79","7","Valencia","","0");
INSERT INTO municipalities VALUES("80","8","Anzoátegui","","0");
INSERT INTO municipalities VALUES("81","8","Tinaquillo","","0");
INSERT INTO municipalities VALUES("82","8","Girardot","","0");
INSERT INTO municipalities VALUES("83","8","Lima Blanco","","0");
INSERT INTO municipalities VALUES("84","8","Pao de San Juan Bautista","","0");
INSERT INTO municipalities VALUES("85","8","Ricaurte","","0");
INSERT INTO municipalities VALUES("86","8","Rómulo Gallegos","","0");
INSERT INTO municipalities VALUES("87","8","San Carlos","","0");
INSERT INTO municipalities VALUES("88","9","Antonio Díaz","","0");
INSERT INTO municipalities VALUES("89","9","Casacoima","","0");
INSERT INTO municipalities VALUES("90","9","Pedernales","","0");
INSERT INTO municipalities VALUES("91","9","Tucupita","","0");
INSERT INTO municipalities VALUES("92","10","Acosta","","0");
INSERT INTO municipalities VALUES("93","10","Bolívar","","0");
INSERT INTO municipalities VALUES("94","10","Cacique Manaure","","0");
INSERT INTO municipalities VALUES("95","10","Carirubana","","0");
INSERT INTO municipalities VALUES("96","10","Colina","","0");
INSERT INTO municipalities VALUES("97","10","Democracia","","0");
INSERT INTO municipalities VALUES("98","10","Coro","","0");
INSERT INTO municipalities VALUES("99","10","Federación","","0");
INSERT INTO municipalities VALUES("100","10","Jacura","","0");
INSERT INTO municipalities VALUES("101","10","Los Taques","","0");
INSERT INTO municipalities VALUES("102","10","Miranda","","0");
INSERT INTO municipalities VALUES("103","10","Monseñor Iturriza","","0");
INSERT INTO municipalities VALUES("104","10","Palmasola","","0");
INSERT INTO municipalities VALUES("105","10","San Francisco","","0");
INSERT INTO municipalities VALUES("106","10","Sucre","","0");
INSERT INTO municipalities VALUES("107","11","Altagracia de Orituco","","0");
INSERT INTO municipalities VALUES("108","11","Las Mercedes","","0");
INSERT INTO municipalities VALUES("109","11","José Tadeo Monagas","","0");
INSERT INTO municipalities VALUES("110","11","Ortíz","","0");
INSERT INTO municipalities VALUES("111","11","San Jerónimo de Guayabal","","0");
INSERT INTO municipalities VALUES("112","11","San Sebastián","","0");
INSERT INTO municipalities VALUES("113","11","Tucupido","","0");
INSERT INTO municipalities VALUES("114","11","Zaraza","","0");
INSERT INTO municipalities VALUES("115","12","Andrés Eloy Blanco","","0");
INSERT INTO municipalities VALUES("116","12","Iribarren","","0");
INSERT INTO municipalities VALUES("117","12","Jiménez","","0");
INSERT INTO municipalities VALUES("118","12","Morán","","0");
INSERT INTO municipalities VALUES("119","12","Palavecino","","0");
INSERT INTO municipalities VALUES("120","12","Rivas Dávila","","0");
INSERT INTO municipalities VALUES("121","12","Simón Planas","","0");
INSERT INTO municipalities VALUES("122","12","Torres","","0");
INSERT INTO municipalities VALUES("123","12","Urdaneta","","0");
INSERT INTO municipalities VALUES("124","13","Alberto Adriani","","0");
INSERT INTO municipalities VALUES("125","13","Antonio Pinto Salinas","","0");
INSERT INTO municipalities VALUES("126","13","Campo Elías Delgado","","0");
INSERT INTO municipalities VALUES("127","13","Guaraque","","0");
INSERT INTO municipalities VALUES("128","13","José Ramón Yépez","","0");
INSERT INTO municipalities VALUES("129","13","La Azulita","","0");
INSERT INTO municipalities VALUES("130","13","Libertador","","0");
INSERT INTO municipalities VALUES("131","13","Mérida","","0");
INSERT INTO municipalities VALUES("132","13","Rangel","","0");
INSERT INTO municipalities VALUES("133","13","Santos Marquina","","0");
INSERT INTO municipalities VALUES("134","13","Tovar","","0");
INSERT INTO municipalities VALUES("135","13","Zea","","0");
INSERT INTO municipalities VALUES("136","14","Acevedo","","0");
INSERT INTO municipalities VALUES("137","14","Baruta","","0");
INSERT INTO municipalities VALUES("138","14","Bermúdez","","0");
INSERT INTO municipalities VALUES("139","14","Carrizal","","0");
INSERT INTO municipalities VALUES("140","14","Chacao","","0");
INSERT INTO municipalities VALUES("141","14","Cristóbal Rojas","","0");
INSERT INTO municipalities VALUES("142","14","El Hatillo","","0");
INSERT INTO municipalities VALUES("143","14","Guaicaipuro","","0");
INSERT INTO municipalities VALUES("144","14","Vargas","","0");
INSERT INTO municipalities VALUES("145","14","Miranda","","0");
INSERT INTO municipalities VALUES("146","14","Plaza","","0");
INSERT INTO municipalities VALUES("147","14","Simón Bolívar","","0");
INSERT INTO municipalities VALUES("148","14","Sucre","","0");
INSERT INTO municipalities VALUES("149","15","Acosta","","0");
INSERT INTO municipalities VALUES("150","15","Aguasay","","0");
INSERT INTO municipalities VALUES("151","15","Ezequiel Zamora","","0");
INSERT INTO municipalities VALUES("152","15","Libertador","","0");
INSERT INTO municipalities VALUES("153","15","Maturín","","0");
INSERT INTO municipalities VALUES("154","15","Piar","","0");
INSERT INTO municipalities VALUES("155","15","Platanal","","0");
INSERT INTO municipalities VALUES("156","15","Punceres","","0");
INSERT INTO municipalities VALUES("157","15","Sotillo","","0");
INSERT INTO municipalities VALUES("158","15","Uracoa","","0");
INSERT INTO municipalities VALUES("159","16","Antolín del Campo","","0");
INSERT INTO municipalities VALUES("160","16","Arismendi","","0");
INSERT INTO municipalities VALUES("161","16","Benítez","","0");
INSERT INTO municipalities VALUES("162","16","Díaz","","0");
INSERT INTO municipalities VALUES("163","16","García","","0");
INSERT INTO municipalities VALUES("164","16","Gómez","","0");
INSERT INTO municipalities VALUES("165","16","Maneiro","","0");
INSERT INTO municipalities VALUES("166","16","Marcano","","0");
INSERT INTO municipalities VALUES("167","16","Mariño","","0");
INSERT INTO municipalities VALUES("168","16","Tubores","","0");
INSERT INTO municipalities VALUES("169","16","Villalba","","0");
INSERT INTO municipalities VALUES("170","17","Agua Blanca","","0");
INSERT INTO municipalities VALUES("171","17","Antonio José de Sucre","","0");
INSERT INTO municipalities VALUES("172","17","Araure","","0");
INSERT INTO municipalities VALUES("173","17","Esteller","","0");
INSERT INTO municipalities VALUES("174","17","Guanare","","0");
INSERT INTO municipalities VALUES("175","17","Guanarito","","0");
INSERT INTO municipalities VALUES("176","17","Ospino","","0");
INSERT INTO municipalities VALUES("177","17","Páez","","0");
INSERT INTO municipalities VALUES("178","17","Papelón","","0");
INSERT INTO municipalities VALUES("179","17","San Genaro de Boconoito","","0");
INSERT INTO municipalities VALUES("180","17","San Rafael de Onoto","","0");
INSERT INTO municipalities VALUES("181","17","Turén","","0");
INSERT INTO municipalities VALUES("182","18","Andrés Eloy Blanco","","0");
INSERT INTO municipalities VALUES("183","18","Arismendi","","0");
INSERT INTO municipalities VALUES("184","18","Benítez","","0");
INSERT INTO municipalities VALUES("185","18","Bermúdez","","0");
INSERT INTO municipalities VALUES("186","18","Cajigal","","0");
INSERT INTO municipalities VALUES("187","18","Cumana","","0");
INSERT INTO municipalities VALUES("188","18","Mariño","","0");
INSERT INTO municipalities VALUES("189","18","Mejía","","0");
INSERT INTO municipalities VALUES("190","18","Montes","","0");
INSERT INTO municipalities VALUES("191","18","Ribero","","0");
INSERT INTO municipalities VALUES("192","18","Sucre","","0");
INSERT INTO municipalities VALUES("193","19","Andrés Bello","","0");
INSERT INTO municipalities VALUES("194","19","Antonio Rómulo Costa","","0");
INSERT INTO municipalities VALUES("195","19","Cárdenas","","0");
INSERT INTO municipalities VALUES("196","19","Comité de la región andina","","0");
INSERT INTO municipalities VALUES("197","19","Escuque","","0");
INSERT INTO municipalities VALUES("198","19","José María Vargas","","0");
INSERT INTO municipalities VALUES("199","19","Junín","","0");
INSERT INTO municipalities VALUES("200","19","Libertad","","0");
INSERT INTO municipalities VALUES("201","19","Mérida","","0");
INSERT INTO municipalities VALUES("202","19","Táriba","","0");
INSERT INTO municipalities VALUES("203","20","Andrés Bello","","0");
INSERT INTO municipalities VALUES("204","20","Bolívar","","0");
INSERT INTO municipalities VALUES("205","20","Escuque","","0");
INSERT INTO municipalities VALUES("206","20","Juan Rodríguez","","0");
INSERT INTO municipalities VALUES("207","20","Miranda","","0");
INSERT INTO municipalities VALUES("208","20","Pampán","","0");
INSERT INTO municipalities VALUES("209","20","San Rafael","","0");
INSERT INTO municipalities VALUES("210","20","Valera","","0");
INSERT INTO municipalities VALUES("211","21","Caraballeda","","0");
INSERT INTO municipalities VALUES("212","21","Carlos Soublette","","0");
INSERT INTO municipalities VALUES("213","21","La Guaira","","0");
INSERT INTO municipalities VALUES("214","21","Vargas","","0");
INSERT INTO municipalities VALUES("215","22","Arístides Bastidas","","0");
INSERT INTO municipalities VALUES("216","22","Bruzual","","0");
INSERT INTO municipalities VALUES("217","22","Cocorote","","0");
INSERT INTO municipalities VALUES("218","22","Independencia","","0");
INSERT INTO municipalities VALUES("219","22","José Antonio Páez","","0");
INSERT INTO municipalities VALUES("220","22","La Trinidad","","0");
INSERT INTO municipalities VALUES("221","22","Nirgua","","0");
INSERT INTO municipalities VALUES("222","22","San Felipe","","0");
INSERT INTO municipalities VALUES("223","22","Urachiche","","0");
INSERT INTO municipalities VALUES("224","23","Almirante Padilla","","0");
INSERT INTO municipalities VALUES("225","23","Colón","","0");
INSERT INTO municipalities VALUES("226","23","Francisco Javier Pulgar","","0");
INSERT INTO municipalities VALUES("227","23","Jesús Enrique Lossada","","0");
INSERT INTO municipalities VALUES("228","23","La Cañada de Urdaneta","","0");
INSERT INTO municipalities VALUES("229","23","Maracaibo","","0");
INSERT INTO municipalities VALUES("230","23","Machiques de Perijá","","0");
INSERT INTO municipalities VALUES("231","23","Miranda","","0");
INSERT INTO municipalities VALUES("232","23","San Francisco","","0");
INSERT INTO municipalities VALUES("233","23","Santa Rita","","0");
INSERT INTO municipalities VALUES("234","23","Sucre","","0");
INSERT INTO municipalities VALUES("235","23","Valmore Rodríguez","","0");



DROP TABLE IF EXISTS parishes;

CREATE TABLE `parishes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `municipality_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `municipality_id` (`municipality_id`),
  CONSTRAINT `parishes_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO parishes VALUES("1","1","Castor Nieves Ríos","1");
INSERT INTO parishes VALUES("2","2","Santa Rita","1");
INSERT INTO parishes VALUES("3","3","José Casanova Godoy","1");
INSERT INTO parishes VALUES("4","4","Santa Cruz","1");
INSERT INTO parishes VALUES("5","5","Central Tacarigua","1");
INSERT INTO parishes VALUES("6","6","Ocumare de La Costa","1");
INSERT INTO parishes VALUES("7","7","Colonia Tovar","1");
INSERT INTO parishes VALUES("8","8","Alto Orinoco","0");
INSERT INTO parishes VALUES("9","9","Atabapo","0");
INSERT INTO parishes VALUES("10","10","Atures","0");
INSERT INTO parishes VALUES("11","11","Autana","0");
INSERT INTO parishes VALUES("12","12","Manapiare","0");
INSERT INTO parishes VALUES("13","13","Maroa","0");
INSERT INTO parishes VALUES("14","14","Río Negro","0");
INSERT INTO parishes VALUES("15","15","Anaco","0");
INSERT INTO parishes VALUES("16","16","Aragua","0");
INSERT INTO parishes VALUES("17","17","Bolívar","0");
INSERT INTO parishes VALUES("18","18","Bruzual","0");
INSERT INTO parishes VALUES("19","19","Cajigal","0");
INSERT INTO parishes VALUES("20","20","Carvajal","0");
INSERT INTO parishes VALUES("21","21","Diego Bautista Urbaneja","0");
INSERT INTO parishes VALUES("22","22","Freites","0");
INSERT INTO parishes VALUES("23","23","Guanipa","0");
INSERT INTO parishes VALUES("24","24","Guanta","0");
INSERT INTO parishes VALUES("25","25","Independencia","0");
INSERT INTO parishes VALUES("26","26","Libertad","0");
INSERT INTO parishes VALUES("27","27","McGregor","0");
INSERT INTO parishes VALUES("28","28","Miranda","0");
INSERT INTO parishes VALUES("29","29","Monagas","0");
INSERT INTO parishes VALUES("30","30","Peñalver","0");
INSERT INTO parishes VALUES("31","31","Píritu","0");
INSERT INTO parishes VALUES("32","32","San Juan de Capistrano","0");
INSERT INTO parishes VALUES("33","33","Santa Ana","0");
INSERT INTO parishes VALUES("34","34","Simón Rodríguez","0");
INSERT INTO parishes VALUES("35","35","Sotillo","0");
INSERT INTO parishes VALUES("36","36","Achaguas","0");
INSERT INTO parishes VALUES("37","37","Biruaca","0");
INSERT INTO parishes VALUES("38","38","Muñoz","0");
INSERT INTO parishes VALUES("39","39","Páez","0");
INSERT INTO parishes VALUES("40","40","Pedro Camejo","0");
INSERT INTO parishes VALUES("41","41","Rómulo Gallegos","0");
INSERT INTO parishes VALUES("42","42","San Fernando","0");
INSERT INTO parishes VALUES("43","43","Alberto Arvelo Torrealba","0");
INSERT INTO parishes VALUES("44","44","Andrés Eloy Blanco","0");
INSERT INTO parishes VALUES("45","45","Antonio José de Sucre","0");
INSERT INTO parishes VALUES("46","46","Arismendi","0");
INSERT INTO parishes VALUES("47","47","Barinas","0");
INSERT INTO parishes VALUES("48","48","Bolívar","0");
INSERT INTO parishes VALUES("49","49","Cruz Paredes","0");
INSERT INTO parishes VALUES("50","50","Ezequiel Zamora","0");
INSERT INTO parishes VALUES("51","51","Obispos","0");
INSERT INTO parishes VALUES("52","52","Pedraza","0");
INSERT INTO parishes VALUES("53","53","Rojas","0");
INSERT INTO parishes VALUES("54","54","Sosa","0");
INSERT INTO parishes VALUES("55","55","Angostura del Orinoco","0");
INSERT INTO parishes VALUES("56","56","Caroní","0");
INSERT INTO parishes VALUES("57","57","Cedeño","0");
INSERT INTO parishes VALUES("58","58","El Callao","0");
INSERT INTO parishes VALUES("59","59","Gran Sabana","0");
INSERT INTO parishes VALUES("60","60","Heres","0");
INSERT INTO parishes VALUES("61","61","Piar","0");
INSERT INTO parishes VALUES("62","62","Roscio","0");
INSERT INTO parishes VALUES("63","63","Sifontes","0");
INSERT INTO parishes VALUES("64","64","Sucre","0");
INSERT INTO parishes VALUES("65","65","Padre Pedro Chien","0");
INSERT INTO parishes VALUES("66","66","Bejuma","0");
INSERT INTO parishes VALUES("67","67","Carlos Arvelo","0");
INSERT INTO parishes VALUES("68","68","Diego Ibarra","0");
INSERT INTO parishes VALUES("69","69","Guacara","0");
INSERT INTO parishes VALUES("70","70","Juan José Mora","0");
INSERT INTO parishes VALUES("71","71","Libertador","0");
INSERT INTO parishes VALUES("72","72","Los Guayos","0");
INSERT INTO parishes VALUES("73","73","Miranda","0");
INSERT INTO parishes VALUES("74","74","Montalbán","0");
INSERT INTO parishes VALUES("75","75","Naguanagua","0");
INSERT INTO parishes VALUES("76","76","Puerto Cabello","0");
INSERT INTO parishes VALUES("77","77","San Diego","0");
INSERT INTO parishes VALUES("78","78","San Joaquín","0");
INSERT INTO parishes VALUES("79","79","Valencia","0");
INSERT INTO parishes VALUES("80","80","Anzoátegui","0");
INSERT INTO parishes VALUES("81","81","Tinaquillo","0");
INSERT INTO parishes VALUES("82","82","Girardot","0");
INSERT INTO parishes VALUES("83","83","Lima Blanco","0");
INSERT INTO parishes VALUES("84","84","Pao de San Juan Bautista","0");
INSERT INTO parishes VALUES("85","85","Ricaurte","0");
INSERT INTO parishes VALUES("86","86","Rómulo Gallegos","0");
INSERT INTO parishes VALUES("87","87","San Carlos","0");
INSERT INTO parishes VALUES("88","88","Antonio Díaz","0");
INSERT INTO parishes VALUES("89","89","Casacoima","0");
INSERT INTO parishes VALUES("90","90","Pedernales","0");
INSERT INTO parishes VALUES("91","91","Tucupita","0");
INSERT INTO parishes VALUES("92","92","Acosta","0");
INSERT INTO parishes VALUES("93","93","Bolívar","0");
INSERT INTO parishes VALUES("94","94","Cacique Manaure","0");
INSERT INTO parishes VALUES("95","95","Carirubana","0");
INSERT INTO parishes VALUES("96","96","Colina","0");
INSERT INTO parishes VALUES("97","97","Democracia","0");
INSERT INTO parishes VALUES("98","98","Falcón","0");
INSERT INTO parishes VALUES("99","99","Federación","0");
INSERT INTO parishes VALUES("100","100","Jacura","0");
INSERT INTO parishes VALUES("101","101","Los Taques","0");
INSERT INTO parishes VALUES("102","102","Miranda","0");
INSERT INTO parishes VALUES("103","103","Monseñor Iturriza","0");
INSERT INTO parishes VALUES("104","104","Palmasola","0");
INSERT INTO parishes VALUES("105","105","San Francisco","0");
INSERT INTO parishes VALUES("106","106","Sucre","0");
INSERT INTO parishes VALUES("107","107","Altagracia de Orituco","0");
INSERT INTO parishes VALUES("108","108","Las Mercedes","0");
INSERT INTO parishes VALUES("109","109","José Tadeo Monagas","0");
INSERT INTO parishes VALUES("110","110","Ortíz","0");
INSERT INTO parishes VALUES("111","111","San Jerónimo de Guaya","0");
INSERT INTO parishes VALUES("112","112","San Sebastián","0");
INSERT INTO parishes VALUES("113","113","Tucupido","0");
INSERT INTO parishes VALUES("114","114","Zaraza","0");
INSERT INTO parishes VALUES("115","115","Andrés Eloy Blanco","0");
INSERT INTO parishes VALUES("116","116","Iribarren","0");
INSERT INTO parishes VALUES("117","117","Jiménez","0");
INSERT INTO parishes VALUES("118","118","Morán","0");
INSERT INTO parishes VALUES("119","119","Palavecino","0");
INSERT INTO parishes VALUES("120","120","Rivas Dávila","0");
INSERT INTO parishes VALUES("121","121","Simón Planas","0");
INSERT INTO parishes VALUES("122","122","Torres","0");
INSERT INTO parishes VALUES("123","123","Urdaneta","0");
INSERT INTO parishes VALUES("124","124","Alberto Adriani","0");
INSERT INTO parishes VALUES("125","125","Antonio Pinto Salinas","0");
INSERT INTO parishes VALUES("126","126","Campo Elías Delgado","0");
INSERT INTO parishes VALUES("127","127","Guaraque","0");
INSERT INTO parishes VALUES("128","128","José Ramón Yépez","0");
INSERT INTO parishes VALUES("129","129","La Azulita","0");
INSERT INTO parishes VALUES("130","130","Libertador","0");
INSERT INTO parishes VALUES("131","131","Miranda","0");
INSERT INTO parishes VALUES("132","132","Rangel","0");
INSERT INTO parishes VALUES("133","133","Santos Marquina","0");
INSERT INTO parishes VALUES("134","134","Tovar","0");
INSERT INTO parishes VALUES("135","135","Zea","0");
INSERT INTO parishes VALUES("136","136","Acevedo","0");
INSERT INTO parishes VALUES("137","137","Baruta","0");
INSERT INTO parishes VALUES("138","138","Bermúdez","0");
INSERT INTO parishes VALUES("139","139","Carrizal","0");
INSERT INTO parishes VALUES("140","140","Chacao","0");
INSERT INTO parishes VALUES("141","141","Cristóbal Rojas","0");
INSERT INTO parishes VALUES("142","142","El Hatillo","0");
INSERT INTO parishes VALUES("143","143","Guaicaipuro","0");
INSERT INTO parishes VALUES("144","144","Los Salias","0");
INSERT INTO parishes VALUES("145","145","Miranda","0");
INSERT INTO parishes VALUES("146","146","Plaza","0");
INSERT INTO parishes VALUES("147","147","Simón Bolívar","0");
INSERT INTO parishes VALUES("148","148","Sucre","0");
INSERT INTO parishes VALUES("149","149","Acosta","0");
INSERT INTO parishes VALUES("150","150","Aguasay","0");
INSERT INTO parishes VALUES("151","151","Ezequiel Zamora","0");
INSERT INTO parishes VALUES("152","152","Libertador","0");
INSERT INTO parishes VALUES("153","153","Maturín","0");
INSERT INTO parishes VALUES("154","154","Piar","0");
INSERT INTO parishes VALUES("155","155","Platanal","0");
INSERT INTO parishes VALUES("156","156","Punceres","0");
INSERT INTO parishes VALUES("157","157","Sotillo","0");
INSERT INTO parishes VALUES("158","158","Uracoa","0");
INSERT INTO parishes VALUES("159","159","Antolín del Campo","0");
INSERT INTO parishes VALUES("160","160","Arismendi","0");
INSERT INTO parishes VALUES("161","161","Benítez","0");
INSERT INTO parishes VALUES("162","162","Díaz","0");
INSERT INTO parishes VALUES("163","163","García","0");
INSERT INTO parishes VALUES("164","164","Gómez","0");
INSERT INTO parishes VALUES("165","165","Maneiro","0");
INSERT INTO parishes VALUES("166","166","Marcano","0");
INSERT INTO parishes VALUES("167","167","Mariño","0");
INSERT INTO parishes VALUES("168","168","Tubores","0");
INSERT INTO parishes VALUES("169","169","Villalba","0");
INSERT INTO parishes VALUES("170","170","Agua Blanca","0");
INSERT INTO parishes VALUES("171","171","Antonio José de Sucre","0");
INSERT INTO parishes VALUES("172","172","Araure","0");
INSERT INTO parishes VALUES("173","173","Esteller","0");
INSERT INTO parishes VALUES("174","174","Guanare","0");
INSERT INTO parishes VALUES("175","175","Guanarito","0");
INSERT INTO parishes VALUES("176","176","Ospino","0");
INSERT INTO parishes VALUES("177","177","Páez","0");
INSERT INTO parishes VALUES("178","178","Papelón","0");
INSERT INTO parishes VALUES("179","179","San Genaro de Boconoito","0");
INSERT INTO parishes VALUES("180","180","San Rafael de Onoto","0");
INSERT INTO parishes VALUES("181","181","Turén","0");
INSERT INTO parishes VALUES("182","182","Andrés Eloy Blanco","0");
INSERT INTO parishes VALUES("183","183","Arismendi","0");
INSERT INTO parishes VALUES("184","184","Benítez","0");
INSERT INTO parishes VALUES("185","185","Bermúdez","0");
INSERT INTO parishes VALUES("186","186","Cajigal","0");
INSERT INTO parishes VALUES("187","187","Cumaná","0");
INSERT INTO parishes VALUES("188","188","Mariño","0");
INSERT INTO parishes VALUES("189","189","Mejía","0");
INSERT INTO parishes VALUES("190","190","Montes","0");
INSERT INTO parishes VALUES("191","191","Ribero","0");
INSERT INTO parishes VALUES("192","192","Sucre","0");
INSERT INTO parishes VALUES("193","193","Andrés Bello","0");
INSERT INTO parishes VALUES("194","194","Antonio Rómulo Costa","0");
INSERT INTO parishes VALUES("195","195","Cárdenas","0");
INSERT INTO parishes VALUES("196","196","Comité de la región andina","0");
INSERT INTO parishes VALUES("197","197","Escuque","0");
INSERT INTO parishes VALUES("198","198","José María Vargas","0");
INSERT INTO parishes VALUES("199","199","Junín","0");
INSERT INTO parishes VALUES("200","200","Libertad","0");
INSERT INTO parishes VALUES("201","201","Mérida","0");
INSERT INTO parishes VALUES("202","202","Táriba","0");
INSERT INTO parishes VALUES("203","203","Andrés Bello","0");
INSERT INTO parishes VALUES("204","204","Bolívar","0");
INSERT INTO parishes VALUES("205","205","Escuque","0");
INSERT INTO parishes VALUES("206","206","Juan Rodríguez","0");
INSERT INTO parishes VALUES("207","207","Miranda","0");
INSERT INTO parishes VALUES("208","208","Pampán","0");
INSERT INTO parishes VALUES("209","209","San Rafael","0");
INSERT INTO parishes VALUES("210","210","Valera","0");
INSERT INTO parishes VALUES("211","211","Caraballeda","0");
INSERT INTO parishes VALUES("212","212","Carlos Soublette","0");
INSERT INTO parishes VALUES("213","213","La Guaira","0");
INSERT INTO parishes VALUES("214","214","Vargas","0");
INSERT INTO parishes VALUES("215","215","Arístides Bastidas","0");
INSERT INTO parishes VALUES("216","216","Bruzual","0");
INSERT INTO parishes VALUES("217","217","Cocorote","0");
INSERT INTO parishes VALUES("218","218","Independencia","0");
INSERT INTO parishes VALUES("219","219","José Antonio Páez","0");
INSERT INTO parishes VALUES("220","220","La Trinidad","0");
INSERT INTO parishes VALUES("221","221","Nirgua","0");
INSERT INTO parishes VALUES("222","222","San Felipe","0");
INSERT INTO parishes VALUES("223","223","Urachiche","0");
INSERT INTO parishes VALUES("224","224","Almirante Padilla","0");
INSERT INTO parishes VALUES("225","225","Colón","0");
INSERT INTO parishes VALUES("226","226","Francisco Javier Pulgar","0");
INSERT INTO parishes VALUES("227","227","Jesús Enrique Lossada","0");
INSERT INTO parishes VALUES("228","228","La Cañada de Urdaneta","0");
INSERT INTO parishes VALUES("229","229","Maracaibo","0");
INSERT INTO parishes VALUES("230","230","Machiques de Perijá","0");
INSERT INTO parishes VALUES("231","231","Miranda","0");
INSERT INTO parishes VALUES("232","232","San Francisco","0");
INSERT INTO parishes VALUES("233","233","Santa Rita","0");
INSERT INTO parishes VALUES("234","234","Sucre","0");
INSERT INTO parishes VALUES("235","235","Valmore Rodríguez","0");



DROP TABLE IF EXISTS paypal_transfer_info;

CREATE TABLE `paypal_transfer_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inn_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inn_id` (`inn_id`),
  CONSTRAINT `paypal_transfer_info_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO paypal_transfer_info VALUES("1","1","arleyds19@gmail.com");
INSERT INTO paypal_transfer_info VALUES("3","2","arleyds19@gmail.com");
INSERT INTO paypal_transfer_info VALUES("4","3","arleyds19@gmail.com");
INSERT INTO paypal_transfer_info VALUES("5","4","arleyds19@gmail.com");
INSERT INTO paypal_transfer_info VALUES("6","16","arleyds19@gmail.com");
INSERT INTO paypal_transfer_info VALUES("7","17","arleyds19@gmail.com");



DROP TABLE IF EXISTS profile;

CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `membership_end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO profile VALUES("6","Arley","Dos Santos","arley@gmail.com","2025-03-28 21:02:15","2024-10-04 21:44:56","Empresa","$2y$10$aSk0z9BW1hnNDFSxElIdh.6ffVl5Yu2CvNzsZwL1lhFy0jffZ873W","0","https://th.bing.com/th/id/R.ec0c37d2af748768cac403347e25cc0d?rik=CyuK20zFNYt%2fYw&pid=ImgRaw&r=0","https://mariginabruno.wordpress.com/wp-content/uploads/2012/01/shutterstock_49390492.jpg","gold","2024-11-29","2024-12-29");
INSERT INTO profile VALUES("13","Carlos","Escobar","carlosescobar@gmail.com","2025-01-12 20:02:36","2024-11-28 22:07:45","Turista","$2y$10$n29WP0qaMfEoSZKxQwqnceytoKFBjVlohk8EnqDSyiBeTZPM/0Aiq","0","https://cdn.pixabay.com/photo/2017/02/23/13/05/profile-2092113_640.png","","none","0000-00-00","0000-00-00");
INSERT INTO profile VALUES("14","Daniela","Morgado","daniela@gmail.com","2025-01-12 20:12:34","2025-01-12 20:11:03","Empresa","$2y$10$MyjwxHTU0W82Dly.ikxuv.FwyqtfaQ276rkbmpGCf4SfiWXeGeEuq","0","https://static.vecteezy.com/system/resources/previews/009/400/444/non_2x/woman-face-clipart-design-illustration-free-png.png","","none","0000-00-00","0000-00-00");



DROP TABLE IF EXISTS reservations;

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inn_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `receipt_path` varchar(255) DEFAULT NULL,
  `codigo_referencia` varchar(255) DEFAULT NULL,
  `status` enum('En Espera','Confirmado','Cancelado') DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) NOT NULL,
  `monto_total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO reservations VALUES("60","1","2024-12-07","2024-12-08","1","uploads/6753ad69076b2-Caso de Uso.jpg","123213","Confirmado","13","1","0.00");
INSERT INTO reservations VALUES("61","17","2025-03-29","2025-03-30","1","uploads/67e8710f3cbc7-Case.jpg","195566999887","Confirmado","13","15","0.00");
INSERT INTO reservations VALUES("62","16","2025-03-29","2025-04-04","2","uploads/67e8714630475-Case.jpg","231313","Confirmado","13","14","0.00");
INSERT INTO reservations VALUES("63","4","2025-04-16","2025-05-22","1","uploads/67e8719679e71-Case.jpg","1212121","Confirmado","13","5","0.00");



DROP TABLE IF EXISTS reviews;

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `reservation_id` (`reservation_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO reviews VALUES("4","60","4","2025-03-23 10:18:49");



DROP TABLE IF EXISTS rooms;

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `image_url5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inn_id` (`inn_id`),
  CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO rooms VALUES("1","Palma Real - 101","Pareja","Alta","https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg","Sumérgete en el encanto tropical con vistas a palmeras majestuosas. Incluye baño con desayuno, almuerzo y cena disponibles a la carta                                           ","100.00","2","1","0","0","","","","");
INSERT INTO rooms VALUES("3","Horizonte Azul - 02","Solo","Premium","https://th.bing.com/th/id/R.cb6ace52900dfb55d10c345b6a7855e4?rik=UHIYinqfPKm4lA&riu=http%3a%2f%2fwww.posadaelsolar.es%2fwp-content%2fuploads%2f2013%2f08%2ffotos-posada-118.jpg&ehk=s5PlXIr4unIHMGw%2bciawMBuQ9%2b4zdv2bU7HRJf26Sbo%3d&risl=&pid=ImgRaw&r=0","Disfruta del cielo despejado y el mar infinito desde tu ventana. Incluye baño y servicio de habitaciones 24/7","120.00","2","2","0","0","","","","");
INSERT INTO rooms VALUES("4","Reflejo de Luna - 103","Pareja","Estándar","https://synergy.booking-channel.com/api/hotels/658/medias/90","Un espacio romántico iluminado por la suave luz de la luna. Incluye baño y cena romántica.","80.00","2","3","0","0","","","","");
INSERT INTO rooms VALUES("5","Sol de Mañana - 101","Pareja","Superior","https://sonnigetoskana.ch/image/dirsep--propertiesdirsep--rawdirsep--3adirsep--3af2012ad62786707cf8f2d30b47ade83cc16d9d4433dotsep--jpg/800/600/0/0/0/0.jpg","espierta con los primeros rayos del sol iluminando tu habitación. Incluye baño.","90.00","2","4","0","0","","","","");
INSERT INTO rooms VALUES("11","Refugio Tranquilo - 103","Pareja","Media","https://th.bing.com/th/id/OIP.AZ7JSk79I-Z2VNZi15lb8wHaE8?w=1024&h=683&rs=1&pid=ImgDetMain","Un lugar sereno para desconectar y disfrutar de la tranquilidad. Incluye baño.                                                                                                                                                                                                                           ","120.00","1","20","0","0","","","","");
INSERT INTO rooms VALUES("13","Jardín de Flores - 3","Solo","Baja","https://www.homenayoo.com/wp-content/uploads/2014/09/2216.jpg","Un refugio colorido y perfumado por flores vibrantes. Desayuno y almuerzo incluidos, cena disponible en el jardín","50.00","1","15","0","0","","","","");
INSERT INTO rooms VALUES("14","Serenidad del Mar - 6","Pareja","Media","https://th.bing.com/th/id/R.cdf71dbe36cc10078c39a671b45d18c9?rik=W9gjQeDDGtUNzg&pid=ImgRaw&r=0","Habitación acogedora con vistas y sonidos relajantes del océano. Incluye baño.","75.00","2","16","0","0","","","","");
INSERT INTO rooms VALUES("15","Estrella de la Noche - 7","Familia","Alta","https://th.bing.com/th/id/OIP.3r6tmFYqMGnVhLEbRbelbwHaE8?rs=1&pid=ImgDetMain","Contempla las estrellas desde la comodidad de tu habitación. Desayuno incluido                                        ","900.00","4","17","0","0","","","","");
INSERT INTO rooms VALUES("16","Bruma del Amanecer - 101","Pareja","Baja","https://th.bing.com/th/id/OIP.d9HTU6cMgkn6rPXIIWNCFwHaE1?w=1440&h=940&rs=1&pid=ImgDetMain","Despierta con la suave bruma de la mañana y vistas espectaculares. Incluye baño.","650.00","6","18","0","0","","","","");



DROP TABLE IF EXISTS states;

CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `flag_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO states VALUES("1","Aragua","https://www.venciclopedia.org/images/3/30/Bandera_aragua.jpg","1");
INSERT INTO states VALUES("2","Amazonas","https://www.venciclopedia.org/images/2/23/Bandera_amazonas.jpg","1");
INSERT INTO states VALUES("3","Anzoátegui","https://www.venciclopedia.org/images/2/2f/Bandera_anzoategui.gif","1");
INSERT INTO states VALUES("4","Apure","https://www.venciclopedia.org/images/4/47/Bandera_apure.jpg","1");
INSERT INTO states VALUES("5","Barinas","https://www.venciclopedia.org/images/b/b2/Bandera_barinas.gif","1");
INSERT INTO states VALUES("6","Bolívar","https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Flag_of_Bol%C3%ADvar_State.svg/1024px-Flag_of_Bol%C3%ADvar_State.svg.png","1");
INSERT INTO states VALUES("7","Carabobo","https://www.venciclopedia.org/images/8/8f/Bandera_carabobo.gif","1");
INSERT INTO states VALUES("8","Cojedes","https://www.venciclopedia.org/images/9/9a/Bandera_cojedes.gif","1");
INSERT INTO states VALUES("9","Delta Amacuro","https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/Flag_of_Delta_Amacuro_State.svg/1024px-Flag_of_Delta_Amacuro_State.svg.png","1");
INSERT INTO states VALUES("10","Falcón","https://www.venciclopedia.org/images/4/49/Bandera_falcon.gif","1");
INSERT INTO states VALUES("11","Guárico","https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Flag_of_Guárico_%28Venezuela%29.svg/512px-Flag_of_Guárico_%28Venezuela%29.svg.png","1");
INSERT INTO states VALUES("12","Lara","https://www.venciclopedia.org/images/b/bd/Bandera_lara.jpg","1");
INSERT INTO states VALUES("13","Mérida","https://www.venciclopedia.org/images/a/ac/Bandera_merida.gif","1");
INSERT INTO states VALUES("14","Miranda","https://www.venciclopedia.org/images/c/cf/Bandera_miranda.jpg","1");
INSERT INTO states VALUES("15","Monagas","https://upload.wikimedia.org/wikipedia/commons/thumb/3/31/Flag_of_Monagas_State.svg/800px-Flag_of_Monagas_State.svg.png","1");
INSERT INTO states VALUES("16","Nueva Esparta","https://www.venciclopedia.org/images/0/02/Bandera_nueva.gif","1");
INSERT INTO states VALUES("17","Portuguesa","https://upload.wikimedia.org/wikipedia/commons/thumb/8/81/Flag_of_Portuguesa.svg/1024px-Flag_of_Portuguesa.svg.png","1");
INSERT INTO states VALUES("18","Sucre","https://www.venciclopedia.org/images/3/3b/Bandera_sucre.gif","1");
INSERT INTO states VALUES("19","Táchira","https://www.venciclopedia.org/images/thumb/a/aa/Bandera_tachira.jpg/800px-Bandera_tachira.jpg","1");
INSERT INTO states VALUES("20","Trujillo","https://upload.wikimedia.org/wikipedia/commons/thumb/b/b0/Flag_of_Trujillo_State.svg/1024px-Flag_of_Trujillo_State.svg.png","1");
INSERT INTO states VALUES("21","La Guaira","https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Flag_of_Vargas_State.svg/1024px-Flag_of_Vargas_State.svg.png","1");
INSERT INTO states VALUES("22","Yaracuy","https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Flag_of_Yaracuy_State.svg/1024px-Flag_of_Yaracuy_State.svg.png","1");
INSERT INTO states VALUES("23","Zulia","https://www.venciclopedia.org/images/8/86/Bandera_zulia.gif","1");



DROP TABLE IF EXISTS tour_packages;

CREATE TABLE `tour_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inn_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint(4) DEFAULT 0,
  `block` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `inn_id` (`inn_id`),
  CONSTRAINT `tour_packages_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tour_packages VALUES("1","1","Paquete Aventura","Disfruta de aventuras emocionantes","https://static8.depositphotos.com/1301180/801/v/950/depositphotos_8013806-stock-illustration-vip-icon.jpg","7","250.00","0","0");



DROP TABLE IF EXISTS user_favorite_inns;

CREATE TABLE `user_favorite_inns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `inn_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `inn_id` (`inn_id`),
  CONSTRAINT `user_favorite_inns_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `profile` (`id`),
  CONSTRAINT `user_favorite_inns_ibfk_2` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO user_favorite_inns VALUES("4","6","3","2024-11-16 21:00:29");
INSERT INTO user_favorite_inns VALUES("5","6","2","2024-11-16 23:45:22");
INSERT INTO user_favorite_inns VALUES("6","13","2","2025-01-11 23:35:58");
INSERT INTO user_favorite_inns VALUES("7","13","17","2025-03-29 18:19:02");
INSERT INTO user_favorite_inns VALUES("8","13","16","2025-03-29 18:20:01");
INSERT INTO user_favorite_inns VALUES("9","13","20","2025-03-29 18:20:09");



DROP TABLE IF EXISTS vehicles;

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `image_url5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inn_id` (`inn_id`),
  CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO vehicles VALUES("1","1","Carro","Toyota","Corolla","100.00","5","2000","Corolla AE85","1234","https://www.motorbiscuit.com/wp-content/uploads/2019/06/2020_Corolla_SE_6MT_BlueCrushMetallic_005_B8A068D7A9EB56FCD3624D03B54536BA09EAAD3C.jpg","2024-07-12 16:45:56","2024-10-11 16:14:11","0","0","","","","");
INSERT INTO vehicles VALUES("2","1","","Honda","Honda Accord","100.00","5","2023","Accord","DEF456","https://4.bp.blogspot.com/-2SuYEVuk0rE/WC03Ez5GAFI/AAAAAAAAGeY/4RSMr4doHXAJo7aWif_8ZerTz_qGCmGpACLcB/s1600/2017_Honda_Accord_Hybrid___3.jpg","2024-07-14 14:36:27","2024-11-30 16:05:35","0","0","https://media.autoexpress.co.uk/image/private/s--V-bYmpPk--/v1562244725/autoexpress/2017/07/10_2018_honda_accord_touring.jpg","","","");
INSERT INTO vehicles VALUES("3","2","Lancha","Sea Ray","Lancha para excursiones","60000.00","8","2022","Modelo A","XYZ789","https://www.lugaresturisticosdeveracruz.com/wp-content/uploads/2021/07/Lancha-Sea-Ray-26-b-980x600-1.jpg","2024-07-14 14:36:27","2024-08-26 23:22:09","0","0","","","","");
INSERT INTO vehicles VALUES("4","3","Auto","Chevrolet","Chevrolet Spark","18000.00","4","2021","Spark","GHI789","https://upload.wikimedia.org/wikipedia/commons/d/de/Chevrolet_Spark_LT%2B_1.2_(Facelift)_%E2%80%93_Frontansicht%2C_4._Januar_2014%2C_D%C3%BCsseldorf.jpg","2024-07-14 14:48:22","2024-07-14 14:48:22","0","0","","","","");
INSERT INTO vehicles VALUES("14","15","Auto","Toyota","Toyota Camry","34.00","5","2022","Camry","RST789","https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0","2024-11-30 15:18:55","2024-11-30 15:22:17","0","0","","","","");
INSERT INTO vehicles VALUES("15","16","Auto","Toyota","Toyota Camry","34.00","5","2022","Camry","RST789","https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0","2024-11-30 15:18:55","2024-11-30 15:22:17","0","0","","","","");
INSERT INTO vehicles VALUES("16","17","","Toyota","Toyota Camry","34.00","5","2022","Camry","RST789","https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0","2024-11-30 15:18:55","2024-11-30 15:44:04","0","0","","","","");
INSERT INTO vehicles VALUES("17","18","Auto","Toyota","Toyota Camry","34.00","5","2022","Camry","RST789","https://th.bing.com/th/id/R.cf529c43cad236f69d10b40de77871f8?rik=WC5Be4AnRYnN3A&pid=ImgRaw&r=0","2024-11-30 15:18:55","2024-11-30 15:22:17","0","0","","","","");



DROP TABLE IF EXISTS zelle_transfer_info;

CREATE TABLE `zelle_transfer_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inn_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inn_id` (`inn_id`),
  CONSTRAINT `zelle_transfer_info_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO zelle_transfer_info VALUES("1","2","arleyds19@gmail.com");
INSERT INTO zelle_transfer_info VALUES("2","1","arleyds19@gmail.com");
INSERT INTO zelle_transfer_info VALUES("3","3","arleyds19@gmail.com");
INSERT INTO zelle_transfer_info VALUES("4","4","arleyds19@gmail.com");
INSERT INTO zelle_transfer_info VALUES("5","16","arleyds19@gmail.com");
INSERT INTO zelle_transfer_info VALUES("6","17","arleyds19@gmail.com");



DROP TABLE IF EXISTS zinli_transfer_info;

CREATE TABLE `zinli_transfer_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inn_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `inn_id` (`inn_id`),
  CONSTRAINT `zinli_transfer_info_ibfk_1` FOREIGN KEY (`inn_id`) REFERENCES `inns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO zinli_transfer_info VALUES("1","1","arleyds19@gmail.com","2025-01-12 22:35:22");
INSERT INTO zinli_transfer_info VALUES("2","2","arleyds19@gmail.com","2025-03-28 19:40:04");
INSERT INTO zinli_transfer_info VALUES("3","3","arleyds19@gmail.com","2025-03-28 19:40:09");
INSERT INTO zinli_transfer_info VALUES("4","4","arleyds19@gmail.com","2025-03-28 19:40:13");
INSERT INTO zinli_transfer_info VALUES("5","16","arleyds19@gmail.com","2025-03-28 19:40:18");
INSERT INTO zinli_transfer_info VALUES("6","17","arleyds19@gmail.com","2025-03-28 19:40:23");



SET FOREIGN_KEY_CHECKS=1;