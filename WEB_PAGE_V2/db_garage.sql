-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2022 a las 12:17:12
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bookings`
--

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
(98, '22222222L', 4, '2022-03-16', '10:00:00', 'Cars', 'no', '44444444F', 1, 243),
(99, '22222222L', 7, '2022-04-07', '16:00:00', 'Big vehicles', 'yes', '44444444F', 1, 40),
(100, '22222222L', 8, '2022-04-07', '16:00:00', 'Big vehicles', 'yes', '44444444F', 1, 40),
(106, '22222222L', 4, '2022-04-14', '11:00:00', 'Cars', 'yes', '44444444F', 1, 30),
(107, '22222222L', 1, '2022-04-21', '15:00:00', 'Cars', 'yes', '44444444F', 1, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cabins`
--

CREATE TABLE `cabins` (
  `Cabin_Id` int(11) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Disponibility` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cabins`
--

INSERT INTO `cabins` (`Cabin_Id`, `Type`, `Disponibility`) VALUES
(1, 'Cars', 1),
(2, 'Cars', 1),
(3, 'Cars', 1),
(4, 'Cars', 1),
(5, 'Motorbikes', 1),
(6, 'Motorbikes', 1),
(7, 'Big vehicles', 1),
(8, 'Big vehicles', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

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
('44444444F', 'Empleado', 'Garage', 123456789, '', 'empleado@uni.eus', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `Product_Id` int(4) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`Product_Id`, `Name`, `Price`, `Stock`) VALUES
(1, 'Tyres', 10.9, 400),
(2, 'Oil', 60.35, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase`
--

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
(26, '22222222L', 1, 10, '2022-04-07', 109),
(27, '22222222L', 2, 2, '2022-04-07', 120.7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

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
('22222222L', 'Cliente', 'Bezeroa', 987654321, 'cliente@uni.eus', '12345678', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicles`
--

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
  ADD KEY `Type` (`Type`);

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
  MODIFY `Booking_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `Product_Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `purchase`
--
ALTER TABLE `purchase`
  MODIFY `Purchase_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  ADD CONSTRAINT `cabins_ibfk_1` FOREIGN KEY (`Type`) REFERENCES `vehicles` (`Type`) ON DELETE CASCADE ON UPDATE CASCADE;

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
