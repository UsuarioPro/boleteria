-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2025 a las 20:43:57
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_ticket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artista`
--

CREATE TABLE `artista` (
  `art_id` int(11) NOT NULL,
  `art_nombre` varchar(50) NOT NULL,
  `art_descripcion` varchar(250) NOT NULL,
  `art_imagen_logo` varchar(200) NOT NULL,
  `art_imagen_portada` varchar(200) NOT NULL,
  `art_genero` varchar(50) NOT NULL,
  `art_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `artista`
--

INSERT INTO `artista` (`art_id`, `art_nombre`, `art_descripcion`, `art_imagen_logo`, `art_imagen_portada`, `art_genero`, `art_estado`) VALUES
(1, 'EXPLOSION', 'Explosión de Iquitos es una reconocida agrupación musical peruana originaria de Iquitos, en la región amazónica de Loreto. Fundada en enero de 1998 por el empresario Raúl Flores Chávez, la banda se ha consolidado como una de las principales exponente', '1.png', '1.jpg', 'Musica', 1),
(2, 'KALIENTE', 'Kaliente de Iquitos es una destacada agrupación peruana de cumbia amazónica, fundada en 2001 en la ciudad de Iquitos, Loreto, por el mánager Rubén Sara. Inicialmente, el grupo se dedicaba a interpretar covers de canciones populares, ganando reconocim', '1.png', '1.jpg', 'Musica', 1),
(3, 'SACUMER', 'Sacumer de Iquitos es una agrupación musical de cumbia amazónica originaria de la ciudad de Iquitos, Perú. Reconocida por su estilo alegre y auténtico, esta orquesta ha ganado popularidad especialmente en la región amazónica gracias a su capacidad de', '1.PNG', '1.JPG', 'Musica', 1),
(4, 'Los Wembler’s', ' Pioneros de la cumbia amazónica desde 1968, conocidos por temas como \"La danza del petrolero\" y \"Sonido amazónico\". Han sido reconocidos como Personalidad Meritoria de la Cultura por el Ministerio de Cultura del Perú.', '1.PNG', '1.JPG', 'Musica', 1),
(5, 'La Fiebre de Iquitos', 'Agrupación que fusiona cumbia con otros ritmos tropicales. Ganaron popularidad con el tema \"El Chiquitingo\", destacándose por su energía en el escenario y conexión con el público local.', '1.PNG', '1.JPG', 'Musica', 1),
(6, 'Colónida Teatro', 'Fundado en 2005, este grupo teatral se inspira en la revista cultural \"Colónida\". Han participado en diversos festivales y colaborado con instituciones educativas para promover el arte escénico en la región.', '1.PNG', '1.JPG', 'TEATRO', 1),
(7, 'Teatro Memorias ', 'Colectivo teatral que aborda temáticas sociales y culturales de la Amazonía. Han representado a Iquitos en eventos internacionales, destacándose por su enfoque en historias contadas desde la perspectiva femenina.', '1.PNG', '1.JPG', 'TEATRO', 1),
(8, 'Club Sport Loreto', 'Fundado en 1908, es uno de los clubes de fútbol más antiguos de Iquitos. Participa en la Copa Perú y ha sido parte fundamental en el desarrollo del deporte en la región.', '1.PNG', '1.JPG', 'DEPORTE', 1),
(9, 'Club Sport Chacarita Versalles', ' Establecido en 1946, este club ha tenido presencia en la Primera División del Perú y actualmente compite en la liga distrital de Iquitos. Es conocido por su pasión y arraigo en la comunidad local.', '1.PNG', '1.JPG', 'DEPORTE', 1),
(10, 'Colegio Rosa Agustina Donayre de Morey ', 'Institución educativa que ha destacado en competencias deportivas escolares, llegando a representar a Iquitos en torneos nacionales e internacionales, incluyendo encuentros con equipos de renombre.', '1.PNG', '1.JPG', 'DEPORTE', 1),
(11, 'Huambrillos Urbanos Crew', 'Colectivo de hip hop formado por jóvenes de Iquitos. Su música y arte reflejan la realidad amazónica, combinando ritmos urbanos con mensajes sociales y culturales.', '1.PNG', '1.JPG', 'ENTRETENIMIENTO', 1),
(12, 'Pukuna 8990', 'Crew de grafiteros que transforma espacios urbanos de Iquitos con arte mural. Han sido reconocidos por su contribución al embellecimiento de la ciudad y su participación en festivales culturales.', '1.PNG', '1.JPG', 'ENTRETENIMIENTO', 1),
(13, 'Festival \"Estamos en la Calle\"', 'Evento cultural que reúne a diversos artistas locales en disciplinas como música, teatro, danza y arte urbano. Es una plataforma importante para la promoción del talento iquiteño y la expresión artística comunitaria.', '1.PNG', '1.JPG', 'ENTRETENIMIENTO', 1),
(14, 'Hablando Huevadas', 'Hablando Huevadas es un exitoso show de comedia peruano, creado y conducido por los comediantes Ricardo Mendoza y Jorge Luna. Aunque no es originario de Iquitos, es ampliamente conocido en todo el país y ha realizado presentaciones en muchas ciudades', '1.PNG', '1.JPG', 'ENTRETENIMIENTO', 1),
(15, 'Club de Teatro de Lima', 'Fundado en 1953, es la escuela de teatro particular más antigua de Lima. Ha formado a numerosos actores peruanos reconocidos y ofrece cursos de actuación para todas las edades.', '1.PNG', '1.JPG', 'TEATRO', 0),
(16, 'Teatro La Plaza', 'Ubicado en el centro comercial Larcomar, es conocido por sus producciones contemporáneas y de alta calidad, abarcando desde obras clásicas hasta montajes innovadores.', '1.PNG', '1,JPG', 'TEATRO', 1),
(17, 'Club Universitario de Deportes', 'Fundado en 1924, es uno de los clubes de fútbol más exitosos del Perú, con múltiples campeonatos nacionales. Su estadio principal es el Estadio Monumental en Ate.', '1.PNG', '1.JPG', 'DEPORTE', 1),
(18, 'Club Alianza Lima', 'Establecido en 1901, es uno de los clubes más antiguos y populares del país. Ha obtenido numerosos títulos y su estadio es el Alejandro Villanueva, conocido como Matute, en La Victoria.', '1.PNG', '1.JPG', 'DEPORTE', 1),
(19, 'Club Sporting Cristal', 'Fundado en 1955, es conocido por su enfoque en el desarrollo de jóvenes talentos y ha logrado varios campeonatos nacionales. Su estadio es el Alberto Gallardo en el Rímac.', '1.PNG', '1.JPG', 'DEPORTE', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artista_concierto`
--

CREATE TABLE `artista_concierto` (
  `art_con_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `art_con_horario_presentacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `artista_concierto`
--

INSERT INTO `artista_concierto` (`art_con_id`, `con_id`, `art_id`, `art_con_horario_presentacion`) VALUES
(1, 1, 1, '2025-06-15 20:30:00'),
(2, 1, 2, '2025-06-15 21:30:00'),
(3, 2, 3, '2025-07-05 21:00:00'),
(4, 2, 4, '2025-07-05 22:00:00'),
(5, 3, 6, '2025-05-20 19:30:00'),
(6, 4, 8, '2025-06-30 17:00:00'),
(7, 4, 9, '2025-06-30 18:15:00'),
(8, 5, 7, '2025-05-10 18:00:00'),
(9, 6, 14, '2025-08-12 20:30:00'),
(10, 6, 11, '2025-08-12 21:45:00'),
(11, 7, 18, '2025-08-17 21:32:31'),
(12, 7, 17, '2025-08-17 21:11:31'),
(13, 7, 18, '2025-08-17 21:46:31'),
(14, 8, 19, '2025-09-30 09:00:00'),
(15, 8, 18, '2025-09-30 08:35:00'),
(16, 8, 17, '2025-09-30 08:50:00'),
(17, 9, 12, '2025-09-11 17:45:00'),
(18, 9, 14, '2025-09-11 18:00:00'),
(19, 9, 11, '2025-09-11 18:20:00'),
(20, 10, 9, '2025-08-25 20:15:00'),
(21, 10, 16, '2025-08-25 20:50:00'),
(22, 10, 10, '2025-08-25 21:05:00'),
(23, 11, 13, '2025-07-19 16:15:00'),
(24, 11, 15, '2025-07-19 16:30:00'),
(25, 11, 18, '2025-07-19 16:40:00'),
(26, 12, 7, '2025-09-17 21:05:00'),
(27, 12, 10, '2025-09-17 21:30:00'),
(28, 12, 6, '2025-09-17 21:45:00'),
(29, 13, 16, '2025-10-05 12:05:00'),
(30, 13, 18, '2025-10-05 12:15:00'),
(31, 13, 12, '2025-10-05 12:25:00'),
(32, 14, 13, '2025-07-29 18:30:00'),
(33, 14, 8, '2025-07-29 18:45:00'),
(34, 14, 17, '2025-07-29 19:00:00'),
(35, 15, 19, '2025-08-02 22:05:00'),
(36, 15, 10, '2025-08-02 22:15:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners_ecommerce`
--

CREATE TABLE `banners_ecommerce` (
  `ban_id` int(11) NOT NULL,
  `ban_nombre` varchar(250) NOT NULL,
  `ban_tipo` tinyint(4) NOT NULL,
  `ban_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `usu_id` int(11) NOT NULL,
  `suc_id` int(11) NOT NULL,
  `bit_fecha` datetime NOT NULL,
  `bit_accion` varchar(250) NOT NULL,
  `bit_ip` varchar(20) NOT NULL,
  `bit_tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`usu_id`, `suc_id`, `bit_fecha`, `bit_accion`, `bit_ip`, `bit_tipo`) VALUES
(1, 0, '2025-03-25 16:04:08', 'Acceso a Rol / mostrar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:09', 'Acceso a Rol / crear_arbol_navbar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:09', 'Acceso a Rol / crear_arbol_navbar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:09', 'Acceso a Rol / listar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:11', 'Acceso a Usuario / mostrar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:12', 'Acceso a Usuario / seleccionar_rol', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:12', 'Acceso a Usuario / listar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:38', 'Inicio Sesion demo', '::1', 'Inicio Sesion'),
(1, 0, '2025-03-25 16:04:38', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:44', 'Acceso a FileManager / mostrar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:44', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:44', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:44', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:48', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:04:51', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:18', 'Acceso a FileManager / mostrar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:19', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:19', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:19', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:23', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:26', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:29', 'Acceso a FileManager / eliminar_archivos', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:29', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:29', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:29', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:34', 'Acceso a Usuario / mostrar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:34', 'Acceso a Usuario / seleccionar_rol', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:35', 'Acceso a Usuario / listar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:37', 'Acceso a FileManager / mostrar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:37', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:37', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:37', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:53', 'Acceso a FileManager / guardar_editar_carpeta', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:53', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:53', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:53', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:58', 'Acceso a FileManager / eliminar_archivos', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:58', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:58', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:05:58', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:05', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:09', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:17', 'Acceso a FileManager / mostrar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:17', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:17', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:17', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:19', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:28', 'Acceso a FileManager / eliminar_archivos', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:28', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:28', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:28', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:31', 'Acceso a FileManager / eliminar_archivos', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:31', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:31', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:31', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:34', 'Acceso a FileManager / eliminar_archivos', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:34', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:34', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:34', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:06:47', 'LogOut Usuario demo', '::1', 'Cierre de Sesion'),
(1, 0, '2025-03-25 16:06:50', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-03-25 16:06:50', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:07:23', 'Acceso a FileManager / mostrar', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:07:24', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:07:24', 'Acceso a FileManager / crear_arbol_carpetas', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:07:24', 'Acceso a FileManager / listar_file_manager', '::1', 'Acceso Vista'),
(1, 0, '2025-03-25 16:07:34', 'LogOut Usuario admin', '::1', 'Cierre de Sesion'),
(0, 0, '2025-04-15 14:41:24', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:41:30', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:41:33', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:41:37', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:41:39', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:42:19', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:43:30', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:43:51', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:44:01', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:44:03', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:44:06', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:44:52', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:44:56', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:45:38', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:46:58', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:47:03', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:48:31', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:48:33', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:48:36', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:48:45', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:48:47', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:49:06', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:49:08', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:49:11', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:49:14', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:49:22', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:49:25', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:49:34', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:49:54', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:50:08', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:51:24', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:51:30', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 14:52:19', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 15:24:01', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 15:24:12', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 15:26:13', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 15:26:20', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 15:26:32', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 15:26:34', 'Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ', '::1', 'Prohibido'),
(0, 0, '2025-04-15 15:37:45', 'Inicio de Sesión Fallido, error en Contraseña a Usuario: admin', '::1', 'Prohibido'),
(1, 0, '2025-04-15 15:37:47', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 15:37:47', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:48:01', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:48:36', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:48:36', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:49:05', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:49:16', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:49:18', 'LogOut Usuario admin', '::1', 'Cierre de Sesion'),
(1, 0, '2025-04-15 15:49:25', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 15:49:25', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:49:36', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:50:04', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:50:11', 'Se Produjo Un Error en los Controladores del Sistema', '::1', 'Falla Sistema'),
(1, 0, '2025-04-15 15:50:22', 'Se Produjo Un Error en los Controladores del Sistema', '::1', 'Falla Sistema'),
(1, 0, '2025-04-15 15:50:27', 'Se Produjo Un Error en los Controladores del Sistema', '::1', 'Falla Sistema'),
(1, 0, '2025-04-15 15:51:01', 'Se Produjo Un Error en los Controladores del Sistema', '::1', 'Falla Sistema'),
(1, 0, '2025-04-15 15:51:02', 'Se Produjo Un Error en los Controladores del Sistema', '::1', 'Falla Sistema'),
(1, 0, '2025-04-15 15:51:12', 'Se Produjo Un Error en los Controladores del Sistema', '::1', 'Falla Sistema'),
(1, 0, '2025-04-15 15:51:15', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:51:19', 'LogOut Usuario admin', '::1', 'Cierre de Sesion'),
(1, 0, '2025-04-15 15:52:17', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 15:52:17', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:52:32', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:52:38', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:52:41', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:52:41', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:52:47', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:52:47', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:52:53', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:52:53', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:53:07', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:53:07', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:53:11', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:53:11', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:53:11', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:53:11', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:53:25', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:53:25', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:55:39', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:56:18', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:56:19', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:56:40', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:56:40', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:57:39', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:57:39', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:58:29', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:58:29', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:58:40', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 15:58:40', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:00:56', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:00:56', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:01:08', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:01:08', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:01:34', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:01:35', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:01:46', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:01:46', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:01:59', 'LogOut Usuario admin', '::1', 'Cierre de Sesion'),
(1, 0, '2025-04-15 16:02:10', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 16:02:10', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:02:42', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:02:45', 'LogOut Usuario admin', '::1', 'Cierre de Sesion'),
(1, 0, '2025-04-15 16:02:50', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 16:02:50', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:02:55', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:02:55', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:02:56', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:02:59', 'LogOut Usuario admin', '::1', 'Cierre de Sesion'),
(1, 0, '2025-04-15 16:03:04', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 16:03:04', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:03:15', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:03:17', 'LogOut Usuario admin', '::1', 'Cierre de Sesion'),
(1, 0, '2025-04-15 16:03:22', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 16:03:22', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:03:25', 'LogOut Usuario admin', '::1', 'Cierre de Sesion'),
(0, 0, '2025-04-15 16:03:44', 'Inicio de Sesión Fallido, error en Contraseña a Usuario: admin', '::1', 'Prohibido'),
(1, 0, '2025-04-15 16:03:46', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 16:03:46', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:03:49', 'LogOut Usuario admin', '::1', 'Cierre de Sesion'),
(1, 0, '2025-04-15 16:05:40', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 16:05:44', 'Acceso a Admin / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:05:44', 'Acceso a Admin / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:05:44', 'Acceso a Admin / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:05:44', 'Acceso a Admin / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:05:44', 'Acceso a Admin / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:05:47', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 16:05:47', 'Acceso a Admin / loguearse', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:05:51', 'Acceso a Admin / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:05:52', 'Acceso a Admin / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:05:52', 'Acceso a Admin / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:05:52', 'Acceso a Admin / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:05:52', 'Acceso a Admin / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:05:53', 'Acceso a Admin / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:06:09', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 16:06:24', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 16:06:47', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(0, 0, '2025-04-15 16:07:38', 'Inicio de Sesión Fallido, error en Contraseña a Usuario: admin', '::1', 'Prohibido'),
(1, 0, '2025-04-15 16:07:42', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 16:07:42', 'Acceso a Admin / dashboard', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:07:46', 'LogOut Usuario admin', '::1', 'Cierre de Sesion'),
(1, 0, '2025-04-15 16:08:16', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 16:08:16', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:08:16', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:08:20', 'LogOut Usuario admin', '::1', 'Cierre de Sesion'),
(1, 0, '2025-04-15 16:09:02', 'Inicio Sesion admin', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-15 16:09:02', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:09:03', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-15 16:09:13', 'LogOut Usuario admin', '::1', 'Cierre de Sesion'),
(1, 0, '2025-04-16 13:37:43', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:37:43', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:37:48', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:37:48', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:38:59', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:39:00', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:39:17', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:39:17', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:39:39', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:39:39', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:39:58', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:39:58', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:40:15', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:40:15', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:40:18', 'LogOut Usuario demo', '::1', 'Cierre de Sesion'),
(1, 0, '2025-04-16 13:40:25', 'Inicio Sesion demo', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-16 13:40:25', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:40:25', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 13:40:28', 'LogOut Usuario demo', '::1', 'Cierre de Sesion'),
(1, 0, '2025-04-16 14:10:38', 'Acceso a Tienda / bienvenida', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:10:42', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:10:42', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:13:31', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:13:32', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:13:59', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:13:59', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:14:00', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:14:00', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:14:00', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:14:00', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:14:18', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:14:22', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:14:35', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:16:10', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:17:07', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:18:11', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 14:19:43', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:01:16', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:02:35', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:02:49', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:03:40', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:03:45', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:04:51', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:04:53', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:05:23', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:05:23', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:05:57', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:05:59', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:06:00', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:06:16', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:06:17', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:08:00', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:08:01', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:08:02', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:08:09', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:08:18', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:08:23', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:08:23', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:08:42', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:08:48', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:10:03', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:10:14', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:10:23', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:10:23', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:10:27', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:10:39', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:10:54', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:11:43', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:11:54', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:12:53', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:12:55', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:46:38', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:47:25', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:47:32', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:48:42', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 15:48:51', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:08:51', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:09:08', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:09:29', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:09:35', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:09:46', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:09:54', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:11:10', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:11:30', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:11:32', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:11:34', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:11:35', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:11:44', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:11:46', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:11:48', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:11:50', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:11:51', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:11:53', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:11:54', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:15:38', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:15:48', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:16:01', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:16:02', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:16:04', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:16:06', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:16:51', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:16:57', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:16:58', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:16:59', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:17:00', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:17:06', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:17:08', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:17:08', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:17:10', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:17:11', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:18:16', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:20:53', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:21:10', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:22:16', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:22:37', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:23:56', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:23:56', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:24:37', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:25:00', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:25:18', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:25:30', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:26:01', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:26:12', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:26:12', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:26:24', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:26:25', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:26:45', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:26:47', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:26:47', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:26:47', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:26:48', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:26:49', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:27:02', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:27:55', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:27:55', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:27:56', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:28:16', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:28:26', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:28:32', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:29:23', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:29:24', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:29:25', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:29:31', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:29:31', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:29:41', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:29:41', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:29:42', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:29:42', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:29:44', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:34:34', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:34:38', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:34:38', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:34:57', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:34:58', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:35:00', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:35:05', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:35:06', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:38:09', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:38:14', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:38:14', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:38:17', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:38:17', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:39:17', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:39:17', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:39:19', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:39:19', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:39:20', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:39:20', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:39:27', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:39:32', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:39:33', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:41:22', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:41:22', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:41:22', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:41:22', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:42:36', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:42:36', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:42:40', 'Se Produjo Un Error en los Controladores del Sistema', '::1', 'Falla Sistema'),
(1, 0, '2025-04-16 16:45:52', 'Se Produjo Un Error en los Controladores del Sistema', '::1', 'Falla Sistema'),
(1, 0, '2025-04-16 16:45:56', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:45:57', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:49:22', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:49:22', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:49:33', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:50:24', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:51:06', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:51:30', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:51:51', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:52:41', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:54:18', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:54:18', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:54:31', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:54:34', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:54:41', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:54:49', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:54:55', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:54:55', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(0, 0, '2025-04-16 16:56:07', 'Inicio de Sesión Fallido, error en Contraseña a Usuario: demo', '::1', 'Prohibido'),
(1, 0, '2025-04-16 16:56:10', 'Inicio Sesion demo', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-16 16:56:10', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:56:10', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:56:13', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:56:53', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:56:53', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:57:16', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:58:18', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 16:58:25', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:00:34', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:02:12', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:02:14', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:02:15', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:02:15', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:02:15', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:02:34', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:13:56', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:16:42', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:16:43', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:22:01', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:22:29', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:23:02', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-16 17:23:10', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:01:49', 'Inicio Sesion demo', '::1', 'Inicio Sesion'),
(1, 0, '2025-04-19 10:01:49', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:01:49', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:01:52', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:05:37', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:08:55', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:09:07', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:43:01', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:43:17', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:43:47', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:43:54', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:43:57', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:44:05', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:44:39', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:44:39', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:45:57', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:46:48', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:46:48', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:50:28', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:51:23', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:51:23', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:53:47', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:54:24', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:55:03', 'Acceso a Tienda / editar_usuario', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:55:32', 'Acceso a Tienda / editar_usuario', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:55:47', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:55:50', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:55:59', 'Acceso a Tienda / editar_usuario', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:56:24', 'Acceso a Tienda / editar_usuario', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:56:45', 'Acceso a Tienda / editar_usuario', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:56:47', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:56:49', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:58:12', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:58:33', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:58:39', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 10:58:48', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 11:02:27', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 11:02:32', 'Se Produjo Un Error en los Controladores del Sistema', '::1', 'Falla Sistema'),
(1, 0, '2025-04-19 11:02:35', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:44:00', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:44:45', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:44:46', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:44:49', 'Acceso a Tienda / editar_usuario', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:44:54', 'Acceso a Tienda / editar_usuario', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:44:59', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:45:02', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:45:04', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:45:05', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:45:05', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:45:05', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:45:05', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:45:05', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:45:06', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:45:07', 'Acceso a Tienda / editar_usuario', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:47:48', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:47:49', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:47:49', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:47:49', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:47:52', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:48:07', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:48:37', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:48:38', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:48:48', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:48:49', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:48:49', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:48:50', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:52:10', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:52:26', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:58:21', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:58:25', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:58:27', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:58:28', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:58:29', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:58:45', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:58:46', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:58:46', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:58:50', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:58:50', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:59:00', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:59:02', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:59:06', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:59:09', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:59:13', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:59:53', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:59:54', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:59:57', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 13:59:59', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:00:03', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:00:10', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:00:37', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:00:50', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:01:23', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:01:31', 'Acceso a Tienda / guardar_cambiar_contrasena', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:01:48', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:01:54', 'Acceso a Tienda / guardar_cambiar_contrasena', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:02:11', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:02:14', 'Acceso a Tienda / guardar_cambiar_contrasena', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:02:18', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:02:54', 'Acceso a Tienda / editar_pass', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:02:59', 'Acceso a Tienda / guardar_cambiar_contrasena', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:03:05', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:03:08', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:03:09', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:03:13', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:03:13', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:03:17', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:03:19', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:03:20', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:04:07', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:04:08', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:04:08', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:04:09', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:04:10', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:04:17', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:04:17', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:11:15', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:11:15', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:11:15', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:11:54', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:09', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:09', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:09', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:10', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:10', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:10', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:10', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:10', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:12', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:12', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:12', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:12', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:12', 'Acceso a Tienda / home', '::1', 'Acceso Vista');
INSERT INTO `bitacora` (`usu_id`, `suc_id`, `bit_fecha`, `bit_accion`, `bit_ip`, `bit_tipo`) VALUES
(1, 0, '2025-04-19 14:12:12', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:12', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:13', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:47', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:47', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:12:50', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:15:24', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:17:18', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:17:18', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:17:30', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:17:31', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:17:33', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:19:11', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:19:17', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:19:17', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:19:21', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:19:23', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:19:23', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:19:29', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:19:29', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:19:29', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:22:39', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:22:40', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:22:43', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:23:07', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:23:26', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:23:33', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:23:33', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:23:51', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:23:51', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:33', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:33', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:35', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:35', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:37', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:37', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:38', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:38', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:38', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:38', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:38', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:39', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:41', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:41', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:49', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:50', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:52', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:52', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:54', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:54', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:57', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:26:57', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:09', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:10', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:11', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:11', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:13', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:13', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:19', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:19', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:21', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:21', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:31', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:32', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:38', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:38', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:39', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:40', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:46', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:46', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:57', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:27:58', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:28:17', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:28:17', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:28:24', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:28:24', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:30:33', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:30:33', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:30:43', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:33:33', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:33:53', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:33:53', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:33:54', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:33:59', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:34:16', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:34:43', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:34:52', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:35:08', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:35:10', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:35:14', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:35:14', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:35:33', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:35:36', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:35:37', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:35:40', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:35:42', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:35:42', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:35:45', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:36:18', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:36:22', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:36:35', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:36:36', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:36:42', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:36:42', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:37:02', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:37:02', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:37:03', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:37:04', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:37:12', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:37:12', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:37:57', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:38:02', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:38:14', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:38:15', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:38:15', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:38:15', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:38:16', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:38:31', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:38:31', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:39:48', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:39:49', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:39:49', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:39:49', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:39:49', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:03', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:03', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:08', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:16', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:17', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:18', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:21', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:23', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:23', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:25', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:32', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:34', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:36', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:36', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:38', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:49', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:55', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:55', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:55', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:57', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:57', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:58', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:40:59', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:00', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:00', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:00', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:00', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:00', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:00', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:01', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:02', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:03', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:09', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:11', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:23', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:41:25', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:42:27', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:42:27', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:42:29', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:42:29', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:42:31', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:42:42', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:42:52', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:42:54', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:42:54', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:42:56', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:45:37', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:45:37', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:45:42', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:48:22', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:48:30', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:48:32', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:48:32', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:48:45', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:50:19', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:51:46', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:52:11', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:52:14', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:52:18', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:52:20', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:52:20', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:52:21', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:52:29', 'Acceso a Tienda / conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:56:59', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:57:55', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:57:57', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 14:58:00', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:00:33', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:00:35', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:00:42', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:01:05', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:01:14', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:01:26', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:01:30', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:01:40', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:01:59', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:02:23', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:04:58', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:05:24', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:05:30', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:05:32', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:05:39', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:11:01', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:11:47', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:12:28', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:12:44', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:13:00', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:13:10', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:13:17', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:13:41', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:14:00', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:15:13', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:15:18', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:15:27', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:15:30', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:23:17', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:23:52', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:24:54', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:25:27', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:25:30', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:25:44', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:26:02', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:26:02', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:26:02', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:26:10', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:26:10', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:26:10', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:26:12', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:26:12', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:26:35', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:26:35', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:26:51', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:27:35', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:28:00', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:28:21', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:28:38', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:29:07', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:29:43', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:29:46', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:30:52', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:31:13', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:31:19', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:31:33', 'Acceso a Tienda / editar_perfil', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:31:35', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:31:36', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:31:51', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:33:55', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:34:22', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:34:26', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:34:31', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:34:34', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:34:37', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:35:01', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:35:15', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:38:06', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:38:23', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:39:06', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:39:10', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:39:12', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:39:12', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:39:15', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:39:17', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:39:41', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:40:16', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:40:30', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:40:34', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:40:36', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:40:37', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:40:51', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:40:55', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:41:32', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:41:44', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:42:13', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:42:14', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:42:15', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:42:16', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:42:17', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:42:34', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:42:42', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:42:45', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:42:46', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:42:50', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:43:42', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:43:45', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:43:51', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:43:51', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:43:51', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:43:54', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:44:00', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:44:04', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:44:05', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:44:07', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:45:35', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:45:57', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:48:00', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:48:10', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:48:10', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:48:18', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:49:01', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:49:09', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:49:15', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:49:48', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:52:02', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:52:08', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:52:51', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:53:22', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:53:32', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:53:33', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:53:43', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:53:54', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 15:57:26', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:23:52', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:25:09', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:27:02', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:27:05', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:27:27', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:27:29', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:27:56', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:28:11', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:28:29', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:28:30', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:28:32', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:28:33', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:28:34', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:28:36', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:28:39', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:28:46', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:29:05', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:29:05', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:29:20', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:29:21', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:29:27', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:29:27', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:29:28', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:29:28', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:29:46', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:29:47', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:30:56', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:12', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:16', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:26', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:38', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:41', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:50', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:50', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:50', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:51', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:51', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:51', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:51', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:51', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:51', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:35:52', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:36:02', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:36:51', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:37:00', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:37:29', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:38:45', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:40:04', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:40:24', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:40:35', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:41:05', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:41:15', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:41:55', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:42:01', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:42:10', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:42:20', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:57:20', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:57:32', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:57:49', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:57:55', 'Acceso a Tienda / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:57:57', 'Acceso a Tienda / login', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:57:58', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:57:59', 'Acceso a Tienda / home', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:57:59', 'Acceso a Tienda / mostrar_conciertos', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:58:04', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:58:37', 'Acceso a Tienda / cart_full', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:58:39', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:58:50', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:58:53', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:58:58', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:59:07', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:59:12', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 16:59:41', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:00:02', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:00:50', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:01:06', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:01:55', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:02:05', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:02:13', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:02:47', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:03:09', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:03:09', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:03:09', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:03:09', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:03:10', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:03:33', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:04:08', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:04:22', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:04:44', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:04:48', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:07:05', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:07:09', 'Acceso a Tienda / guardar_editar_comprar_entradas', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:07:39', 'Acceso a Tienda / guardar_editar_comprar_entradas', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:08:24', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:08:29', 'Acceso a Tienda / guardar_editar_comprar_entradas', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:09:13', 'Acceso a Tienda / guardar_editar_comprar_entradas', '::1', 'Acceso Vista'),
(1, 0, '2025-04-19 17:09:26', 'Acceso a Tienda / proceder_pago', '::1', 'Acceso Vista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleto`
--

CREATE TABLE `boleto` (
  `bol_id` int(11) NOT NULL,
  `det_ven_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `zon_id` int(11) NOT NULL,
  `codigo_unico` varchar(100) NOT NULL,
  `estado` enum('valido','usado','anulado') DEFAULT 'valido',
  `creado_el` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_nombre` varchar(50) NOT NULL,
  `cat_icono` varchar(150) NOT NULL,
  `cat_descripcion` varchar(250) NOT NULL,
  `cat_imagen` varchar(200) NOT NULL,
  `cat_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`cat_id`, `cat_nombre`, `cat_icono`, `cat_descripcion`, `cat_imagen`, `cat_estado`) VALUES
(1, 'CONCIERTOS', 'fas fa-music ', '1', '1', 1),
(2, 'DESPORTES', 'fas fa-football-ball', '1', '1', 1),
(3, 'TEATRO', 'fas fa-ticket-alt', '1', '1', 1),
(4, 'AVENTURA', 'fas fa-ellipsis-h', '1', '1', 1),
(5, 'ENTRETENIEMTO', 'fas fa-film', '1', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concierto`
--

CREATE TABLE `concierto` (
  `con_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `con_nombre` varchar(150) NOT NULL,
  `con_subtitulo` varchar(100) NOT NULL,
  `con_imagen` varchar(150) NOT NULL,
  `con_portada` varchar(150) NOT NULL,
  `con_descripcion` varchar(500) NOT NULL,
  `con_fecha` date DEFAULT NULL,
  `con_hora` time DEFAULT NULL,
  `con_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `concierto`
--

INSERT INTO `concierto` (`con_id`, `loc_id`, `cat_id`, `con_nombre`, `con_subtitulo`, `con_imagen`, `con_portada`, `con_descripcion`, `con_fecha`, `con_hora`, `con_estado`) VALUES
(1, 1, 1, 'CumbiaFest Lima 2025', '', '', '', 'Festival de cumbia con bandas emblemáticas del Perú', '2025-06-15', '20:00:00', 0),
(2, 7, 1, 'Noche Tropical Iquitos - Full Dance & Perreo Chacalonero', '', '', '', 'Evento musical tropical en el corazón de la selva', '2025-07-05', '21:00:00', 0),
(3, 4, 3, 'Obra: El Viaje Inesperado', '', '', '', 'Representación teatral de una historia amazónica', '2025-05-20', '19:30:00', 0),
(4, 10, 2, 'Final Copa Regional', '', '', '', 'Encuentro deportivo de clubes loretanos', '2025-06-30', '17:00:00', 0),
(5, 6, 3, 'Teatro Lima Noche', ' ¡Asegúrate de no faltar a este gran evento!', '8.jpg', '1.jpg', 'Obra teatral de humor y reflexión social', '2025-05-10', '18:00:00', 0),
(6, 3, 5, 'Humor Bajo las Estrellas', '', '', '', 'Noche de stand-up comedy con talentos nacionales', '2025-08-12', '20:30:00', 0),
(7, 6, 2, 'Esse Fest 1990', '', '', '', 'Perspiciatis illum aut aperiam excepturi necessitatibus quasi.', '2025-08-17', '19:54:31', 0),
(8, 9, 2, 'Quod Fest 1974', '', '', '', 'Voluptas minus natus perferendis aliquam minus harum.', '2025-09-30', '08:26:01', 0),
(9, 4, 4, 'Voluptates Fest 2020', '', '', '', 'Inventore recusandae quos magni libero debitis dicta voluptates optio quod fugit.', '2025-09-11', '17:02:18', 0),
(10, 8, 5, 'Solstice Fest 2024', '', '', '', 'Necessitatibus omnis eos veniam vel tempora eos.', '2025-08-25', '20:15:50', 0),
(11, 3, 1, 'Nova Música Fest 2022', '', '', '', 'Enim fuga error qui eum consequatur minima repellendus.', '2025-08-02', '19:24:35', 0),
(12, 7, 3, 'Teatro Vibe 2023', '', '', '', 'Repudiandae adipisci id aspernatur tempore sed blanditiis veniam.', '2025-09-17', '21:05:14', 0),
(13, 4, 2, 'Deporte Master 2025', '', '', '', 'Consequatur voluptate molestiae et possimus reiciendis.', '2025-10-05', '12:00:25', 0),
(14, 2, 5, 'Summer Party 2026', '', '', '', 'Quae fuga nobis eveniet dolorem ipsum tempora.', '2025-07-19', '16:12:09', 0),
(15, 10, 1, 'Rock Fest 2024', '', '', '', 'Voluptatibus esse voluptates dolores.', '2025-09-01', '22:34:45', 0),
(16, 5, 3, 'Teatro y Arte 2025', '', '', '', 'Sunt excepturi iusto deleniti neque quisquam.', '2025-08-22', '18:40:10', 0),
(17, 6, 4, 'Adventure Now 2025', '', '', '', 'Voluptas eveniet qui eaque doloremque.', '2025-10-01', '20:01:05', 0),
(18, 3, 1, 'Tropical Fiesta 2025', '', '', '', 'Autem numquam libero molestias cum error.', '2025-09-18', '14:55:09', 0),
(19, 8, 2, 'Deporte Mania 2025', '', '', '', 'Autem facilis expedita omnis corrupti animi quos.', '2025-07-29', '18:40:30', 0),
(20, 7, 5, 'Cultura & Fiesta 2025', '', '', '', 'Ducimus excepturi inventore commodi atque odio.', '2025-08-05', '10:22:45', 0),
(21, 4, 3, 'Teatro Exuberante 2026', '', '', '', 'Sunt fuga voluptas dolor nihil eveniet veniam dolorem.', '2025-09-25', '23:14:51', 0),
(22, 10, 1, 'Rock Heroes 2025', '', '', '', 'Distinctio quod officia debitis rerum laborum eos.', '2025-10-12', '17:43:25', 0),
(23, 5, 2, 'Fútbol Glory 2025', '', '', '', 'Alias ut maiores possimus consequatur ut laboriosam.', '2025-07-10', '15:33:21', 0),
(24, 9, 4, 'Aventura Invencible 2025', '', '', '', 'Deleniti iure quia velit ad unde at quas.', '2025-08-13', '11:02:58', 0),
(25, 6, 3, 'Teatro Clásico 2026', '', '', '', 'Quos adipisci voluptas sequi et optio.', '2025-07-26', '18:56:10', 0),
(26, 2, 5, 'Fiesta Flash 2025', '', '', '', 'Tempora magni quas reprehenderit quidem qui deserunt.', '2025-09-03', '21:10:12', 0),
(27, 7, 4, 'Aventura de Invierno 2025', '', '', '', 'Alias veniam delectus ab ipsa.', '2025-08-19', '13:50:18', 0),
(28, 4, 2, 'Deporte Grand Finale 2025', '', '', '', 'Quo vel doloribus libero.', '2025-07-21', '17:44:25', 0),
(29, 10, 3, 'Teatro Vivo 2025', '', '', '', 'Deleniti voluptatibus dolorum voluptatem voluptates.', '2025-08-04', '20:25:50', 0),
(30, 5, 1, 'Fiesta Tropical 2026', '', '', '', 'Molestiae quod sint perferendis veniam fugit nobis.', '2025-09-15', '22:16:30', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_permisos_rol`
--

CREATE TABLE `detalle_permisos_rol` (
  `det_per_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_permisos_rol`
--

INSERT INTO `detalle_permisos_rol` (`det_per_id`, `rol_id`, `per_id`) VALUES
(12, 2, 7),
(13, 2, 8),
(14, 2, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `det_ven_id` int(11) NOT NULL,
  `ven_id` int(11) NOT NULL,
  `zon_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folders_and_files`
--

CREATE TABLE `folders_and_files` (
  `fol_id` int(30) NOT NULL,
  `fol_tipo` tinyint(4) NOT NULL COMMENT '0 si es una carpeta 1 si es un archivo',
  `fol_fld` varchar(50) NOT NULL,
  `fol_url` varchar(5000) NOT NULL,
  `fol_nombre` varchar(250) NOT NULL,
  `fol_extension` char(10) NOT NULL,
  `fol_id_user` int(50) NOT NULL,
  `fol_cid` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `local`
--

CREATE TABLE `local` (
  `loc_id` int(11) NOT NULL,
  `loc_nombre` varchar(150) NOT NULL,
  `loc_direccion` varchar(250) NOT NULL,
  `loc_imagen_logo` varchar(200) NOT NULL,
  `loc_ciudad` varchar(100) NOT NULL,
  `loc_escenario_img` varchar(200) NOT NULL,
  `loc_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `local`
--

INSERT INTO `local` (`loc_id`, `loc_nombre`, `loc_direccion`, `loc_imagen_logo`, `loc_ciudad`, `loc_escenario_img`, `loc_estado`) VALUES
(1, 'Estadio Nacional del Perú', 'Cercado de Lima', '4.jpg', 'LIMA', '1.png', 1),
(2, 'Estadio Monumental \"U\"', ' Ate', '4.jpg', 'LIMA', '1.png', 1),
(3, 'Costa 21', 'Costa Verde, Magdalena del Mar', '4.jpg', 'LIMA', '1.png', 1),
(4, 'Gran Teatro Nacional', ' San Borja', '4.jpg', 'LIMA', '1.png', 1),
(5, 'Teatro Municipal de Lima', 'Centro Histórico de Lima', '4.jpg', 'LIMA', '1.png', 1),
(6, 'Teatro La Plaza', 'Av. 28 de Julio frente a la plaza grau de punchana', '4.jpg', 'LIMA', '1.png', 1),
(7, 'Centro de Convenciones del Pardo', 'Av. Mariscal Cáceres 1042, P.J. Santa Rosa, Iquitos 16004', '4.jpg', 'IQUITOS', '1.png', 1),
(8, ' Complejo CNI', 'Avenida Mariscal Cáceres 1149, Iquitos 16001', '4.jpg', 'IQUITOS', '1.png', 1),
(9, ' Auditorio del Colegio San Agustín', 'Avenida Grau 788, Iquitos', '4.jpg', 'IQUITOS', '1.png', 1),
(10, 'Estadio Max Augustín', 'Almirante Martín Guise 257, Iquitos 16002 ', '4.jpg', 'IQUITOS', '1.png', 1),
(11, 'Coliseo Cerrado Juan Pinasco', 'Jirón Putumayo 726', '4.jpg', 'IQUTOS', '1.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `mod_id` int(11) NOT NULL,
  `mod_nombre` varchar(50) NOT NULL,
  `mod_icono` varchar(50) NOT NULL,
  `mod_multiple` tinyint(1) NOT NULL COMMENT 'si tiene o no opciones',
  `mod_orden` int(11) NOT NULL,
  `mod_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`mod_id`, `mod_nombre`, `mod_icono`, `mod_multiple`, `mod_orden`, `mod_estado`) VALUES
(1, 'Error', '', 0, 0, 0),
(2, 'Escritorio', 'fas fa-tachometer-alt', 0, 1, 1),
(3, 'Tienda', 'fas fa-tachometer-alt', 0, 2, 1),
(4, 'Acceso', 'fas fa-lock', 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `opc_id` int(11) NOT NULL,
  `mod_id` int(11) NOT NULL,
  `opc_nombre` varchar(100) NOT NULL,
  `opc_nombre_abrev` varchar(60) NOT NULL,
  `opc_funcion` varchar(50) NOT NULL,
  `opc_orden` int(11) NOT NULL,
  `opc_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`opc_id`, `mod_id`, `opc_nombre`, `opc_nombre_abrev`, `opc_funcion`, `opc_orden`, `opc_estado`) VALUES
(1, 1, 'Error', '', '', 0, 1),
(2, 2, 'DASHBOARD', 'DASHBOARD', 'dashboard', 0, 1),
(7, 3, 'Tienda', 'Tienda', 'home', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `per_id` int(11) NOT NULL,
  `opc_id` int(11) NOT NULL,
  `per_controlador` varchar(150) NOT NULL,
  `per_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`per_id`, `opc_id`, `per_controlador`, `per_estado`) VALUES
(7, 1, 'Error\r\n', 1),
(8, 2, 'Admin', 1),
(9, 7, 'Tienda', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(25) NOT NULL,
  `rol_descripcion` varchar(150) DEFAULT NULL,
  `rol_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`, `rol_descripcion`, `rol_estado`) VALUES
(1, 'SUPER ADMIN', 'TIENE ACCESO TOTAL AL SISTEMA\n\n', 1),
(2, 'GESTIONAR ARCHIVOS', 'PARA DAR ACCESO SOLO A PARTE DE GESTION DE ARCHIVOS SIN PERMITIR MODIFICAR EL RESTO DEL SISTEMA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `share_folders_and_files`
--

CREATE TABLE `share_folders_and_files` (
  `sha_id` int(11) NOT NULL,
  `fol_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `sha_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `usu_nombre_completo` varchar(5000) NOT NULL,
  `usu_tipo_doc` varchar(20) NOT NULL,
  `usu_numero_doc` varchar(8) NOT NULL,
  `usu_direccion` varchar(5000) NOT NULL,
  `usu_telefono` varchar(9) NOT NULL,
  `usu_correo` varchar(500) NOT NULL,
  `usu_login` varchar(250) NOT NULL,
  `usu_clave` varchar(250) NOT NULL,
  `usu_fecha_creacion` datetime NOT NULL,
  `usu_ultimo_login` datetime NOT NULL,
  `usu_imagen` varchar(50) NOT NULL,
  `usu_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `rol_id`, `usu_nombre_completo`, `usu_tipo_doc`, `usu_numero_doc`, `usu_direccion`, `usu_telefono`, `usu_correo`, `usu_login`, `usu_clave`, `usu_fecha_creacion`, `usu_ultimo_login`, `usu_imagen`, `usu_estado`) VALUES
(1, 2, 'ANGEL ANDRES DEL AGUILA MOLANO', 'DNI', '71960850', 'CALLE ALEMANIA MZ A LT 25', '964372665', 'usuarioproacces@gmail.com', 'admin', '$2y$10$nQ1rZdzRcUrmvo2/9dDDhedgdAoBUjwiQ7EmrpuAOdOxYD4htbRZe', '0000-00-00 00:00:00', '2025-04-15 16:09:02', '', 1),
(24, 2, 'ARNALDO DEL AGUILA GONZALES', 'DNI', '05291093', 'CALLE ALEMANIA MZ A LT 25', '964372665', 'demo@gmail.com', 'demo', '$2y$10$l2LU5SdoQVVKHxFPcYlIKedOvtZHQ1hW09ZMd6hGmH4ImAvrXnfEi', '2025-04-16 14:10:37', '2025-04-19 10:01:49', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `ven_id` int(11) NOT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `tipo_pago` varchar(150) NOT NULL,
  `ven_fecha` datetime NOT NULL,
  `ven_total` decimal(10,2) NOT NULL,
  `ven_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona_concierto`
--

CREATE TABLE `zona_concierto` (
  `zon_id` int(11) NOT NULL,
  `con_id` int(11) DEFAULT NULL,
  `zon_nombre` varchar(100) DEFAULT NULL,
  `zon_precio` decimal(10,2) DEFAULT NULL,
  `zon_detalle` varchar(255) DEFAULT NULL,
  `zon_stock` int(11) DEFAULT NULL,
  `zon_estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `zona_concierto`
--

INSERT INTO `zona_concierto` (`zon_id`, `con_id`, `zon_nombre`, `zon_precio`, `zon_detalle`, `zon_stock`, `zon_estado`) VALUES
(1, 5, 'General', '30.00', '1 x persona', 300, 1),
(2, 5, 'VIP', '60.00', 'Incluye bebida + silla numerada', 100, 1),
(3, 5, 'Zona Parejas', '50.00', '2 x 1 solo hasta 9 PM', 80, 1),
(4, 5, 'Entrada Simple', '25.00', 'Acceso general', 200, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artista`
--
ALTER TABLE `artista`
  ADD PRIMARY KEY (`art_id`);

--
-- Indices de la tabla `artista_concierto`
--
ALTER TABLE `artista_concierto`
  ADD PRIMARY KEY (`art_con_id`),
  ADD KEY `art_id` (`art_id`),
  ADD KEY `com_id` (`con_id`);

--
-- Indices de la tabla `banners_ecommerce`
--
ALTER TABLE `banners_ecommerce`
  ADD PRIMARY KEY (`ban_id`);

--
-- Indices de la tabla `boleto`
--
ALTER TABLE `boleto`
  ADD PRIMARY KEY (`bol_id`),
  ADD UNIQUE KEY `codigo_unico` (`codigo_unico`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `concierto`
--
ALTER TABLE `concierto`
  ADD PRIMARY KEY (`con_id`),
  ADD KEY `loc_id` (`loc_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indices de la tabla `detalle_permisos_rol`
--
ALTER TABLE `detalle_permisos_rol`
  ADD PRIMARY KEY (`det_per_id`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `per_id` (`per_id`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`det_ven_id`);

--
-- Indices de la tabla `folders_and_files`
--
ALTER TABLE `folders_and_files`
  ADD PRIMARY KEY (`fol_id`);

--
-- Indices de la tabla `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`mod_id`);

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`opc_id`),
  ADD KEY `mod_id` (`mod_id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`per_id`),
  ADD KEY `opc_id` (`opc_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `share_folders_and_files`
--
ALTER TABLE `share_folders_and_files`
  ADD PRIMARY KEY (`sha_id`),
  ADD KEY `usu_id` (`usu_id`),
  ADD KEY `fol_id` (`fol_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD UNIQUE KEY `usu_login` (`usu_login`),
  ADD UNIQUE KEY `usu_numero_doc` (`usu_numero_doc`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`ven_id`);

--
-- Indices de la tabla `zona_concierto`
--
ALTER TABLE `zona_concierto`
  ADD PRIMARY KEY (`zon_id`),
  ADD KEY `con_id` (`con_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artista`
--
ALTER TABLE `artista`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `artista_concierto`
--
ALTER TABLE `artista_concierto`
  MODIFY `art_con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `banners_ecommerce`
--
ALTER TABLE `banners_ecommerce`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `boleto`
--
ALTER TABLE `boleto`
  MODIFY `bol_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `concierto`
--
ALTER TABLE `concierto`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `detalle_permisos_rol`
--
ALTER TABLE `detalle_permisos_rol`
  MODIFY `det_per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `det_ven_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `folders_and_files`
--
ALTER TABLE `folders_and_files`
  MODIFY `fol_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `local`
--
ALTER TABLE `local`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `opc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `share_folders_and_files`
--
ALTER TABLE `share_folders_and_files`
  MODIFY `sha_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `ven_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `zona_concierto`
--
ALTER TABLE `zona_concierto`
  MODIFY `zon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `artista_concierto`
--
ALTER TABLE `artista_concierto`
  ADD CONSTRAINT `artista_concierto_ibfk_1` FOREIGN KEY (`art_id`) REFERENCES `artista` (`art_id`),
  ADD CONSTRAINT `artista_concierto_ibfk_4` FOREIGN KEY (`con_id`) REFERENCES `concierto` (`con_id`);

--
-- Filtros para la tabla `concierto`
--
ALTER TABLE `concierto`
  ADD CONSTRAINT `concierto_ibfk_1` FOREIGN KEY (`loc_id`) REFERENCES `local` (`loc_id`),
  ADD CONSTRAINT `concierto_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `categoria` (`cat_id`);

--
-- Filtros para la tabla `detalle_permisos_rol`
--
ALTER TABLE `detalle_permisos_rol`
  ADD CONSTRAINT `detalle_permisos_rol_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`),
  ADD CONSTRAINT `detalle_permisos_rol_ibfk_2` FOREIGN KEY (`per_id`) REFERENCES `permisos` (`per_id`);

--
-- Filtros para la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD CONSTRAINT `opciones_ibfk_1` FOREIGN KEY (`mod_id`) REFERENCES `modulos` (`mod_id`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`opc_id`) REFERENCES `opciones` (`opc_id`);

--
-- Filtros para la tabla `share_folders_and_files`
--
ALTER TABLE `share_folders_and_files`
  ADD CONSTRAINT `share_folders_and_files_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`),
  ADD CONSTRAINT `share_folders_and_files_ibfk_2` FOREIGN KEY (`fol_id`) REFERENCES `folders_and_files` (`fol_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`);

--
-- Filtros para la tabla `zona_concierto`
--
ALTER TABLE `zona_concierto`
  ADD CONSTRAINT `zona_concierto_ibfk_1` FOREIGN KEY (`con_id`) REFERENCES `concierto` (`con_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
