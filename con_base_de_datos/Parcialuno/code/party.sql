CREATE DATABASE IF NOT EXISTS party;
USE party;

-- Creacion de la tabla de los invitados a la fiesta
CREATE TABLE `invitados` (
  `id` int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `nombre` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `asistencia` varchar(3) NOT NULL
);

-- Insertar Datos genericos
INSERT INTO `invitados` (`id`, `nombre`, `edad`, `asistencia`) VALUES
(51, 'Figaro', 2, 'si'),
(71, 'Bella', 5, 'no'),
(72, 'Mishi', 17, 'si');
