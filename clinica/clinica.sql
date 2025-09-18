-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2025 a las 02:09:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `apellido`, `dni`, `telefono`, `email`, `direccion`) VALUES
(1, 'Juan', 'Pérez', '24141446', '029-157463827', 'juan.pérez@gmail.com', 'Calle Belgrano 683, Tucumán'),
(2, 'María', 'Gómez', '40768966', '019-152954569', 'maría.gómez@gmail.com', 'Calle 9 de Julio 889, Corrientes'),
(3, 'Carlos', 'Rodríguez', '27123044', '027-153031925', 'carlos.rodríguez@gmail.com', 'Calle Rivadavia 954, Mendoza'),
(4, 'Laura', 'Fernández', '35591752', '027-153054271', 'laura.fernández@gmail.com', 'Calle Rivadavia 237, Río Negro'),
(5, 'Martín', 'Sánchez', '23303727', '026-158623182', 'martín.sánchez@gmail.com', 'Calle Mitre 967, Corrientes'),
(6, 'Sofía', 'López', '35291546', '010-155870494', 'sofía.lópez@gmail.com', 'Calle 9 de Julio 369, Río Negro'),
(7, 'Diego', 'Ramírez', '27937329', '017-154272330', 'diego.ramirez@gmail.com', 'Calle Mitre 322, Neuquén'),
(8, 'Valentina', 'Torres', '40163696', '024-153509493', 'valentina.torres@gmail.com', 'Calle Mitre 439, Santa Cruz'),
(9, 'Lucas', 'Díaz', '21496574', '027-159482225', 'lucas.díaz@gmail.com', 'Calle Belgrano 955, Tucumán'),
(10, 'Camila', 'Herrera', '36129191', '010-152167921', 'camila.herrera@gmail.com', 'Calle San Martín 915, La Pampa'),
(11, 'Federico', 'Castro', '21617407', '010-157689224', 'federico.castro@gmail.com', 'Calle Belgrano 329, Santa Cruz'),
(12, 'Julieta', 'Rojas', '42210150', '035-156315698', 'julieta.rojas@gmail.com', 'Calle 9 de Julio 730, Chaco'),
(13, 'Tomás', 'Mendoza', '42590930', '027-153805289', 'tomás.mendoza@gmail.com', 'Calle San Martín 118, Buenos Aires'),
(14, 'Agustina', 'Blanco', '44540817', '024-156463139', 'agustina.blanco@gmail.com', 'Calle 9 de Julio 313, Córdoba'),
(15, 'Nicolás', 'Vargas', '39335466', '036-154540595', 'nicolás.vargas@gmail.com', 'Calle 9 de Julio 492, Córdoba'),
(16, 'Antonella', 'Rossi', '26956971', '013-151383619', 'antonella.rossi@gmail.com', 'Calle Córdoba 306, Entre Ríos'),
(17, 'Bruno', 'Luna', '21103593', '023-156431208', 'bruno.luna@gmail.com', 'Calle Rivadavia 742, Salta'),
(18, 'Sabrina', 'Cabrera', '38528931', '020-158697400', 'sabrina.cabrera@gmail.com', 'Calle Belgrano 892, La Pampa'),
(19, 'Facundo', 'Ortega', '43447597', '024-156455162', 'facundo.ortega@gmail.com', 'Calle 9 de Julio 772, Mendoza'),
(20, 'Lucía', 'Paz', '25029926', '016-154469275', 'lucía.paz@gmail.com', 'Calle San Martín 760, Chaco'),
(21, 'Santiago', 'Suárez', '22899748', '026-153430674', 'santiago.suárez@gmail.com', 'Calle 9 de Julio 469, San Luis'),
(22, 'Martina', 'Giménez', '23269984', '034-155904451', 'martina.giménez@gmail.com', 'Calle Rivadavia 902, Tucumán'),
(23, 'Bruno', 'Vega', '43355329', '025-152813748', 'bruno.vega@gmail.com', 'Calle 9 de Julio 567, Chaco'),
(24, 'Valeria', 'Figueroa', '30720982', '017-156971592', 'valeria.figueroa@gmail.com', 'Calle 9 de Julio 620, Santa Fe'),
(25, 'Emiliano', 'Núñez', '44685091', '032-155315907', 'emiliano.núñez@gmail.com', 'Calle Córdoba 819, Córdoba'),
(26, 'Isabella', 'Jiménez', '27705916', '021-157294733', 'isabella.jiménez@gmail.com', 'Calle Mitre 448, Corrientes'),
(27, 'Matías', 'Molina', '39216820', '024-153136507', 'matías.molina@gmail.com', 'Calle Belgrano 645, Mendoza'),
(28, 'Florencia', 'Suarez', '37459901', '018-150965927', 'florencia.suarez@gmail.com', 'Calle Rivadavia 901, Chaco'),
(29, 'Joaquín', 'López', '29764253', '016-150066817', 'joaquín.lópez@gmail.com', 'Calle San Martín 227, Corrientes'),
(30, 'Milagros', 'Fernández', '42972216', '023-159036519', 'milagros.fernández@gmail.com', 'Calle Belgrano 151, La Pampa'),
(31, 'Agustín', 'Rojas', '26482199', '013-157294600', 'agustín.rojas@gmail.com', 'Calle Belgrano 348, Santa Cruz'),
(32, 'Carolina', 'Giménez', '34679617', '025-158113808', 'carolina.giménez@gmail.com', 'Calle Rivadavia 320, Córdoba'),
(33, 'Leandro', 'Torres', '25498340', '027-159333552', 'leandro.torres@gmail.com', 'Calle Mitre 542, Buenos Aires'),
(34, 'Gabriel', 'Herrera', '37439164', '016-154315280', 'gabriel.herrera@gmail.com', 'Calle Rivadavia 963, Jujuy'),
(35, 'Juliana', 'Vega', '22780820', '022-156913594', 'juliana.vega@gmail.com', 'Calle San Martín 887, Mendoza'),
(36, 'Maximiliano', 'Cabrera', '24654206', '012-157588317', 'maximiliano.cabrera@gmail.com', 'Calle Mitre 248, Río Negro'),
(37, 'Camila', 'Luna', '23486311', '030-158323769', 'camila.luna@gmail.com', 'Calle Rivadavia 495, Salta'),
(38, 'Lucas', 'Díaz', '22772766', '028-150194048', 'luca.díaz@gmail.com', 'Calle Mitre 365, Santa Cruz'),
(39, 'Natalia', 'Fernández', '30874566', '018-154418986', 'natalia.fernández@gmail.com', 'Calle Mitre 582, Córdoba'),
(40, 'Martín', 'Vega', '41784173', '031-157322968', 'martín.vega@gmail.com', 'Calle Belgrano 332, Mendoza'),
(41, 'Agustina', 'Figueroa', '33800331', '016-157795882', 'agustina.figueroa@gmail.com', 'Calle 9 de Julio 466, Santa Fe'),
(42, 'Diego', 'Suárez', '29081313', '029-155222645', 'diego.suárez@gmail.com', 'Calle San Martín 129, Santa Fe'),
(43, 'Sofía', 'Jiménez', '34161371', '027-154781596', 'sofía.jiménez@gmail.com', 'Calle 9 de Julio 108, Santa Cruz'),
(44, 'Emiliano', 'Molina', '40465094', '017-153827031', 'emiliano.molina@gmail.com', 'Calle San Martín 541, Entre Ríos'),
(45, 'Isabella', 'Suarez', '28288604', '021-155344846', 'isabella.suarez@gmail.com', 'Calle San Martín 846, Chaco'),
(46, 'Matías', 'López', '29316642', '021-153401588', 'matías.lópez@gmail.com', 'Calle San Martín 203, Tucumán'),
(47, 'Florencia', 'Rojas', '21841157', '037-155119298', 'florencia.rojas@gmail.com', 'Calle Córdoba 117, La Pampa'),
(48, 'Mateo', 'Torres', '20992440', '014-158554767', 'mateo.torres@gmail.com', 'Calle 9 de Julio 238, Santa Fe'),
(49, 'Luciana', 'Paz', '39108215', '018-152028807', 'luciana.paz@gmail.com', 'Calle 9 de Julio 355, Córdoba'),
(50, 'Tomás', 'Luna', '29856485', '037-157054322', 'tomás.luna@gmail.com', 'Calle Mitre 452, La Pampa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'admin', '1234'),
(2, 'walter', '$2y$10$JE6n7LaMW5rhzgZh.RTKe.kqACLL5Mo6j/Ja0j6Ow4kt.0PsMr6Ty'),
(3, 'claudio', '$2y$10$4Tke.1j9Z17Fa2i/UrnDReXJKsoHsNDuukxZxqNzXUv48aOnisQye');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
