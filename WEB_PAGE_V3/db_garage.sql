-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2022 a las 09:00:00
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
CREATE TABLE `bookings` (
  `Booking_Id` int(11) NOT NULL,
  `User_Id` varchar(9) NOT NULL,
  `Cabin_Id` int(5) NOT NULL,
  `Date` date NOT NULL,
  `Hour` time NOT NULL,
  `Vehicle_Type` varchar(30) NOT NULL,
  `Employee_Help` varchar(5) NOT NULL DEFAULT 'no',
  `Employee_Id` varchar(9) DEFAULT NULL,
  `Use_Hours` int(2) NOT NULL DEFAULT 1,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bookings`
--

INSERT INTO `bookings` (`Booking_Id`, `User_Id`, `Cabin_Id`, `Date`, `Hour`, `Vehicle_Type`, `Employee_Help`, `Employee_Id`, `Use_Hours`, `Price`) VALUES
(99, '22222222L', 7, '2022-04-07', '16:00:00', 'Big vehicles', 'yes', '44444444F', 1, 40),
(108, '11111111A', 7, '2022-03-30', '10:00:00', 'Big vehicles', 'yes', '44444444F', 2, 600),
(111, '11111111A', 3, '2022-03-16', '10:00:00', 'Cars', 'no', '44444444F', 1, 1000),
(114, '22222222L', 5, '2022-04-26', '12:00:00', 'Motorbikes', 'yes', '44444444F', 1, 20),
(147, '22222222L', 5, '2022-04-14', '12:00:00', 'Motorbikes', 'yes', '44444444F', 2, 40),
(149, '22222222L', 7, '2022-05-08', '16:00:00', 'Big vehicles', 'no', NULL, 5, 200),
(150, '22222222L', 6, '2022-04-29', '12:00:00', 'Motorbikes', 'yes', '44444444F', 3, 60),
(151, '22222222L', 1, '2022-04-30', '11:00:00', 'Cars', 'yes', '44444444F', 1, 30),
(153, '22222222L', 2, '2022-05-04', '09:00:00', 'Cars', 'yes', '44444444F', 2, 60),
(157, '22222222L', 5, '2022-05-03', '12:00:00', 'Motorbikes', 'yes', '11111111A', 2, 40);

--
-- Disparadores `bookings`
--
DROP TRIGGER IF EXISTS `delete_booking_cabin_0`;
DELIMITER $$
CREATE TRIGGER `delete_booking_cabin_0` AFTER INSERT ON `bookings` FOR EACH ROW UPDATE cabins
SET cabins.Disponibility = 0
WHERE cabins.Cabin_Id = NEW.Cabin_Id
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `delete_booking_cabin_1`;
DELIMITER $$
CREATE TRIGGER `delete_booking_cabin_1` AFTER DELETE ON `bookings` FOR EACH ROW UPDATE cabins
SET cabins.Disponibility = 1
WHERE cabins.Cabin_Id = OLD.Cabin_Id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cabins`
--

DROP TABLE IF EXISTS `cabins`;
CREATE TABLE `cabins` (
  `Cabin_Id` int(11) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Disponibility` tinyint(1) NOT NULL,
  `Helper` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cabins`
--

INSERT INTO `cabins` (`Cabin_Id`, `Type`, `Disponibility`, `Helper`) VALUES
(1, 'Cars', 1, '11111111A'),
(2, 'Cars', 1, '22222222B'),
(3, 'Cars', 1, '33333333C'),
(4, 'Cars', 1, '55555555E'),
(5, 'Motorbikes', 0, '11111111A'),
(6, 'Motorbikes', 0, '22222222B'),
(7, 'Big vehicles', 0, '33333333C'),
(8, 'Big vehicles', 1, '55555555E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `Employee_Id` varchar(9) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `TLF` int(9) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`Employee_Id`, `Name`, `Surname`, `TLF`, `Address`, `Email`, `Password`) VALUES
('11111111A', 'Markel', 'Lomana', 123456789, '', 'lomana@gmail.com', '12345678'),
('22222222B', 'Raul', 'Parra', 123456789, '', 'raul@gmail.com', '12345678'),
('33333333C', 'Mikel', 'Perez', 123456789, '', 'perez@gmail.com', '12345678'),
('44444444F', 'Empleado', 'Garage', 123456789, '', 'empleado@uni.eus', '12345678'),
('55555555E', 'Ander', 'Garcia', 123456789, '', 'garcia@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `Product_Id` int(4) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Price` float NOT NULL,
  `Stock` int(11) NOT NULL,
  `Product_picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`Product_Id`, `Name`, `Price`, `Stock`, `Product_picture`) VALUES
(1, 'Oil', 10.5, 200, '../Images/Products/oil.jpg'),
(2, 'Chains', 55.9, 100, '../Images/Products/cadenas.jpg'),
(3, 'Air Filter', 15.2, 120, '../Images/Products/filtro.jpg'),
(4, 'Car mats', 14.75, 100, '../Images/Products/alfombrillas.jpg'),
(5, 'Brake pads', 20.5, 250, '../Images/Products/pastillas.jpg'),
(6, 'Spark Plug', 15.75, 150, '../Images/Products/bujia.jpg'),
(7, 'Shock-absorber', 85.9, 175, '../Images/Products/amortiguador.jpg'),
(8, 'Fuse kit', 14.5, 250, '../Images/Products/fusibles.jpg'),
(9, 'Tyres', 60.35, 500, '../Images/Products/neumatico.jpeg'),
(10, 'Led Lights', 14.35, 200, '../Images/Products/led.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `Purchase_Id` int(11) NOT NULL,
  `User_Id` varchar(9) NOT NULL,
  `Product_Id` int(4) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Total_Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `purchase`
--

INSERT INTO `purchase` (`Purchase_Id`, `User_Id`, `Product_Id`, `Quantity`, `Date`, `Total_Price`) VALUES
(35, '11111111A', 1, 3, '2022-03-30', 0);

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
CREATE TABLE `users` (
  `User_Id` varchar(9) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(30) NOT NULL,
  `TLF` int(9) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Profile_Img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`User_Id`, `Name`, `Surname`, `TLF`, `Email`, `Password`, `Profile_Img`) VALUES
('11111111A', 'Usuario', 'Berria', 943200000, 'u.berria@gmail.com', 'Pasahitza', ''),
('11111111N', 'Unai', 'Perez', 0, 'unai@gmail.com', '12345678', ''),
('22222222A', 'Markel', 'Lomana', 0, 'parra@gmail.com', '123456', ''),
('22222222L', 'Cliente', 'Bezeroa', 987654321, 'cliente@uni.eus', '12345678', ''),
('99999999A', 'Iker', 'Fernandez', 0, 'iker.fer@gmail', '123456', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles` (
  `Type` varchar(30) NOT NULL,
  `Price_Hour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vehicles`
--

INSERT INTO `vehicles` (`Type`, `Price_Hour`) VALUES
('Big vehicles', 40),
('Cars', 30),
('Motorbikes', 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`Booking_Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Garage_Id` (`Cabin_Id`),
  ADD KEY `Vehicle_Type` (`Vehicle_Type`),
  ADD KEY `Employee_Id` (`Employee_Id`);

--
-- Indices de la tabla `cabins`
--
ALTER TABLE `cabins`
  ADD PRIMARY KEY (`Cabin_Id`),
  ADD KEY `Type` (`Type`),
  ADD KEY `Helper` (`Helper`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`Employee_Id`),
  ADD KEY `Email` (`Email`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_Id`);

--
-- Indices de la tabla `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`Purchase_Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Product_Id` (`Product_Id`),
  ADD KEY `Product_Id_2` (`Product_Id`),
  ADD KEY `Product_Id_3` (`Product_Id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`),
  ADD KEY `Email` (`Email`);

--
-- Indices de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`Type`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bookings`
--
ALTER TABLE `bookings`
  MODIFY `Booking_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `Product_Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `purchase`
--
ALTER TABLE `purchase`
  MODIFY `Purchase_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
