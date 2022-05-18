-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-05-2022 a las 12:09:07
-- Versión del servidor: 8.0.29-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_garage`
--
DROP DATABASE IF EXISTS `db_garage`;
CREATE DATABASE IF NOT EXISTS `db_garage` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_garage`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `Booking_Id` int NOT NULL AUTO_INCREMENT,
  `User_Id` varchar(9) NOT NULL,
  `Cabin_Id` int NOT NULL,
  `Date` date NOT NULL,
  `Hour` time NOT NULL,
  `Vehicle_Type` varchar(30) NOT NULL,
  `Employee_Help` varchar(5) NOT NULL DEFAULT 'no',
  `Employee_Id` varchar(9) DEFAULT NULL,
  `Price` int NOT NULL,
  PRIMARY KEY (`Booking_Id`),
  KEY `User_Id` (`User_Id`),
  KEY `Garage_Id` (`Cabin_Id`),
  KEY `Vehicle_Type` (`Vehicle_Type`),
  KEY `Employee_Id` (`Employee_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bookings`
--

INSERT INTO `bookings` (`Booking_Id`, `User_Id`, `Cabin_Id`, `Date`, `Hour`, `Vehicle_Type`, `Employee_Help`, `Employee_Id`, `Price`) VALUES
(179, '11111111A', 1, '2022-05-16', '11:00:00', 'Cars', 'yes', '11111111B', 55),
(180, '11111111A', 2, '2022-06-18', '12:00:00', 'Motorbikes', 'no', NULL, 20),
(181, '22222222A', 3, '2022-07-21', '14:00:00', 'Big vehicles', 'yes', '33333333B', 65),
(182, '22222222A', 1, '2022-08-20', '09:00:00', 'Cars', 'no', NULL, 30),
(183, '33333333A', 2, '2022-09-01', '09:00:00', 'Motorbikes', 'yes', '22222222B', 45),
(184, '33333333A', 3, '2022-10-27', '09:00:00', 'Big vehicles', 'no', NULL, 40),
(185, '44444444A', 2, '2022-11-11', '09:00:00', 'Motorbikes', 'yes', '22222222B', 45),
(186, '44444444A', 1, '2022-12-30', '09:00:00', 'Cars', 'no', NULL, 30),
(187, '11111111A', 1, '2022-01-19', '10:00:00', 'Cars', 'no', NULL, 30),
(188, '33333333A', 2, '2022-02-18', '11:00:00', 'Motorbikes', 'yes', '22222222B', 45),
(189, '22222222A', 3, '2022-03-09', '11:00:00', 'Big vehicles', 'no', NULL, 40),
(190, '33333333A', 1, '2022-04-15', '11:00:00', 'Cars', 'yes', '11111111B', 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cabins`
--

DROP TABLE IF EXISTS `cabins`;
CREATE TABLE IF NOT EXISTS `cabins` (
  `Cabin_Id` int NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Helper` varchar(9) NOT NULL,
  PRIMARY KEY (`Cabin_Id`),
  KEY `Type` (`Type`),
  KEY `Helper` (`Helper`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cabins`
--

INSERT INTO `cabins` (`Cabin_Id`, `Type`, `Helper`) VALUES
(1, 'Cars', '11111111B'),
(2, 'Motorbikes', '22222222B'),
(3, 'Big vehicles', '33333333B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `Employee_Id` varchar(9) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `TLF` int NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL,
  PRIMARY KEY (`Employee_Id`),
  KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`Employee_Id`, `Name`, `Surname`, `TLF`, `Address`, `Email`, `Password`) VALUES
('11111111B', 'Markel', 'Lomana', 123456789, '', 'lomana@gmail.com', '12345678'),
('22222222B', 'Raul', 'Parra', 123456789, '', 'parra@gmail.com', '12345678'),
('33333333B', 'Mikel', 'Perez', 123456789, '', 'perez@gmail.com', '12345678'),
('44444444B', 'Fermin', 'Lopez', 123456789, '', 'empleado@uni.eus', '12345678'),
('55555555B', 'Ander', 'Garcia', 123456789, '', 'ander@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `Product_Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Price` float NOT NULL,
  `Stock` int NOT NULL,
  `Product_picture` varchar(150) NOT NULL,
  PRIMARY KEY (`Product_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`Product_Id`, `Name`, `Price`, `Stock`, `Product_picture`) VALUES
(1, 'Oil', 10.5, 190, '../Images/Products/oil.jpg'),
(2, 'Chains', 55.9, 83, '../Images/Products/cadenas.jpg'),
(3, 'Air Filter', 15.2, 117, '../Images/Products/filtro.jpg'),
(4, 'Car mats', 14.75, 96, '../Images/Products/alfombrillas.jpg'),
(5, 'Brake pads', 20.5, 237, '../Images/Products/pastillas.jpg'),
(6, 'Spark Plug', 15.75, 94, '../Images/Products/bujia.jpg'),
(7, 'Shock-absorber', 85.9, 164, '../Images/Products/amortiguador.jpg'),
(8, 'Fuse kit', 14.5, 237, '../Images/Products/fusibles.jpg'),
(9, 'Tyres', 60.35, 499, '../Images/Products/neumatico.jpeg'),
(10, 'Led Lights', 14.35, 194, '../Images/Products/led.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
  `Purchase_Id` int NOT NULL AUTO_INCREMENT,
  `User_Id` varchar(9) NOT NULL,
  `Product_Id` int NOT NULL,
  `Quantity` int NOT NULL,
  `Date` date NOT NULL,
  `Total_Price` float NOT NULL,
  PRIMARY KEY (`Purchase_Id`),
  KEY `User_Id` (`User_Id`),
  KEY `Product_Id` (`Product_Id`),
  KEY `Product_Id_2` (`Product_Id`),
  KEY `Product_Id_3` (`Product_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `purchase`
--

INSERT INTO `purchase` (`Purchase_Id`, `User_Id`, `Product_Id`, `Quantity`, `Date`, `Total_Price`) VALUES
(3, '22222222A', 2, 4, '2022-02-11', 30),
(9, '22222222A', 7, 8, '2022-08-19', 120),
(11, '22222222A', 5, 4, '2022-10-13', 60),
(13, '22222222A', 1, 6, '2022-12-26', 36.75),
(41, '11111111A', 6, 42, '2022-05-16', 661.5),
(42, '11111111A', 3, 1, '2022-05-16', 15.2),
(43, '22222222A', 8, 3, '2022-05-16', 43.5),
(44, '33333333A', 3, 2, '2022-01-13', 30.4),
(45, '22222222A', 8, 1, '2022-03-24', 14.5),
(47, '44444444A', 5, 4, '2022-06-15', 82),
(49, '11111111A', 2, 1, '2022-09-16', 55.9),
(50, '33333333A', 1, 2, '2022-11-06', 21),
(51, '11111111A', 6, 5, '2022-05-17', 78.75),
(53, '22222222A', 2, 4, '2022-04-12', 30),
(54, '22222222A', 7, 2, '2022-04-10', 30),
(55, '33333333A', 1, 2, '2022-07-16', 21),
(56, '11111111A', 2, 1, '2022-07-27', 55.9);

--
-- Disparadores `purchase`
--
DROP TRIGGER IF EXISTS `añadir_stock`;
DELIMITER $$
CREATE TRIGGER `añadir_stock` AFTER DELETE ON `purchase` FOR EACH ROW UPDATE products
SET products.Stock = (products.Stock + OLD.Quantity)
WHERE products.Product_Id = OLD.Product_Id
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `restar_stock`;
DELIMITER $$
CREATE TRIGGER `restar_stock` AFTER INSERT ON `purchase` FOR EACH ROW UPDATE products
SET products.Stock = (products.Stock - NEW.Quantity)
WHERE products.Product_Id = NEW.Product_Id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `User_Id` varchar(9) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(30) NOT NULL,
  `TLF` int NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Profile_Img` varchar(100) NOT NULL,
  PRIMARY KEY (`User_Id`),
  KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`User_Id`, `Name`, `Surname`, `TLF`, `Email`, `Password`, `Profile_Img`) VALUES
('11111111A', 'Mikel', 'Nieve', 666666666, 'nieve@gmail.com', '12345678', '../Images/Clients/photo-1566275529824-cca6d008f3da.jpg'),
('22222222A', 'Dani', 'García', 0, 'garcia@gmail.com', '12345678', ''),
('33333333A', 'Dan', 'Carter', 777777777, 'carter@gmail.com', '12345678', ''),
('44444444A', 'Evaristo', 'Páramos', 666667777, 'paramos@gmail.com', '12345678', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `Type` varchar(30) NOT NULL,
  `Price_Hour` int NOT NULL,
  PRIMARY KEY (`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehicles`
--

INSERT INTO `vehicles` (`Type`, `Price_Hour`) VALUES
('Big vehicles', 40),
('Cars', 30),
('Motorbikes', 20);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`Cabin_Id`) REFERENCES `cabins` (`Cabin_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_4` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`Employee_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_5` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cabins`
--
ALTER TABLE `cabins`
  ADD CONSTRAINT `cabins_ibfk_1` FOREIGN KEY (`Type`) REFERENCES `vehicles` (`Type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cabins_ibfk_2` FOREIGN KEY (`Helper`) REFERENCES `employees` (`Employee_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_ibfk_3` FOREIGN KEY (`Product_Id`) REFERENCES `products` (`Product_Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
