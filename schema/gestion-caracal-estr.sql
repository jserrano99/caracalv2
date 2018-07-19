-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-10-2017 a las 15:52:28
-- Versión del servidor: 5.7.19-0ubuntu0.16.04.1
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion-caracal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos`
--

CREATE TABLE `activos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin NOT NULL,
  `inventario` int(11) DEFAULT NULL,
  `fcadquision` date DEFAULT NULL,
  `importe-compra` double DEFAULT NULL,
  `importe-amortizado` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apuntes`
--

CREATE TABLE `apuntes` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `cuenta_debe_id` int(11) DEFAULT NULL,
  `importe_debe` double DEFAULT NULL,
  `cuenta_haber_id` int(11) DEFAULT NULL,
  `importe_haber` double DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` mediumtext COLLATE utf8_bin,
  `asiento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arqueros`
--

CREATE TABLE `arqueros` (
  `id` int(11) NOT NULL,
  `licencia` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `club_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `persona_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asientos`
--

CREATE TABLE `asientos` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `ejercicio_id` int(11) NOT NULL,
  `proyecto_id` int(11) DEFAULT NULL,
  `observaciones` mediumtext COLLATE utf8_bin,
  `importe_debe` double DEFAULT NULL,
  `importe_haber` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asiento_factura`
--

CREATE TABLE `asiento_factura` (
  `id` int(11) NOT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `serie` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `observaciones` text,
  `importe_base` double DEFAULT NULL,
  `cuota_iva` double DEFAULT NULL,
  `importe_factura` double DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `cuenta_pago_id` int(11) DEFAULT NULL,
  `cuenta_gastos_id` int(11) DEFAULT NULL,
  `proyecto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `codigo` varchar(2) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin NOT NULL,
  `edad_desde` int(2) NOT NULL,
  `edad_hasta` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificaciones`
--

CREATE TABLE `clasificaciones` (
  `id` int(11) NOT NULL,
  `competicion_id` int(11) NOT NULL,
  `participante_id` int(11) NOT NULL,
  `modalidad_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `total_puntos` int(11) DEFAULT NULL,
  `total_onces` int(11) DEFAULT NULL,
  `total_dieces` int(11) DEFAULT NULL,
  `menor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificaciones_rondas`
--

CREATE TABLE `clasificaciones_rondas` (
  `id` int(11) NOT NULL,
  `clasificacion_id` int(11) NOT NULL,
  `puntos` int(11) DEFAULT NULL,
  `onces` int(11) DEFAULT NULL,
  `dieces` int(11) DEFAULT NULL,
  `ronda_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `club`
--

CREATE TABLE `club` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `federacion_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competiciones`
--

CREATE TABLE `competiciones` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin NOT NULL,
  `modo_id` int(11) DEFAULT NULL,
  `tipo_competicion_id` int(11) DEFAULT NULL,
  `descontar` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competiciones_imagenes`
--

CREATE TABLE `competiciones_imagenes` (
  `id` int(11) NOT NULL,
  `competicion_id` int(11) NOT NULL,
  `imagen` mediumblob NOT NULL,
  `tipo` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_mayor`
--

CREATE TABLE `cuentas_mayor` (
  `id` int(11) NOT NULL,
  `codigo` varchar(9) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `grupo_cuentas_id` int(11) DEFAULT NULL,
  `tipo_cuenta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_resultados`
--

CREATE TABLE `cuenta_resultados` (
  `Id` int(11) NOT NULL,
  `Nivel1` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Nivel2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nivel3` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `cuenta_mayor_id` int(11) DEFAULT NULL,
  `multiplicador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisiones`
--

CREATE TABLE `divisiones` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fcini` date DEFAULT NULL,
  `fcfin` date DEFAULT NULL,
  `estado_ejercicio_id` int(11) DEFAULT NULL,
  `asiento_apertura_id` int(11) DEFAULT NULL,
  `asiento_regularizacion_id` int(11) DEFAULT NULL,
  `asiento_cierre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio_actual`
--

CREATE TABLE `ejercicio_actual` (
  `id` int(11) NOT NULL,
  `ejercicio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_ejercicio`
--

CREATE TABLE `estados_ejercicio` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_usuario`
--

CREATE TABLE `estados_usuario` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estr_balance`
--

CREATE TABLE `estr_balance` (
  `id` int(11) NOT NULL,
  `nivel0` int(11) DEFAULT NULL,
  `nivel1` int(11) DEFAULT NULL,
  `nivel2` int(11) DEFAULT NULL,
  `nivel3` int(11) DEFAULT NULL,
  `nivel4` int(11) DEFAULT NULL,
  `cuenta_mayor_id` int(11) DEFAULT NULL,
  `multiplicador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estr_cuenta_resultados`
--

CREATE TABLE `estr_cuenta_resultados` (
  `Id` int(11) NOT NULL,
  `Nivel1` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Nivel2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nivel3` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `cuenta_mayor_id` int(11) DEFAULT NULL,
  `multiplicador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `tipo_evento` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `numero` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `serie` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `importe` double DEFAULT NULL,
  `base_iva` double DEFAULT NULL,
  `cuota_iva` double DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `fichero` mediumblob,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `asiento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `federaciones`
--

CREATE TABLE `federaciones` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_cuentas`
--

CREATE TABLE `grupo_cuentas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `imagen` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `id` int(11) NOT NULL,
  `provincia_id` int(2) NOT NULL,
  `cd` int(3) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros_patrulla`
--

CREATE TABLE `miembros_patrulla` (
  `id` int(11) NOT NULL,
  `patrulla_id` int(11) NOT NULL,
  `parti_ronda_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidades`
--

CREATE TABLE `modalidades` (
  `id` int(11) NOT NULL,
  `cd` varchar(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modos`
--

CREATE TABLE `modos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modo_estructura`
--

CREATE TABLE `modo_estructura` (
  `id` int(11) NOT NULL,
  `modo_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `modalidad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_balance`
--

CREATE TABLE `niveles_balance` (
  `id` int(11) NOT NULL,
  `nivel_balance` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `origen_ingresos`
--

CREATE TABLE `origen_ingresos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin NOT NULL,
  `cuenta_mayor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes`
--

CREATE TABLE `participantes` (
  `id` int(11) NOT NULL,
  `competicion_id` int(11) NOT NULL,
  `modalidad_id` int(11) DEFAULT NULL,
  `dorsal` int(11) NOT NULL,
  `arquero_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabla de participantes';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes_rondas`
--

CREATE TABLE `participantes_rondas` (
  `id` int(11) NOT NULL,
  `ronda_id` int(11) NOT NULL,
  `participante_id` int(11) NOT NULL,
  `inscrito` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `pagado` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `onces` int(11) DEFAULT NULL,
  `dieces` int(11) DEFAULT NULL,
  `presentado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrullas`
--

CREATE TABLE `patrullas` (
  `id` int(11) NOT NULL,
  `ronda_id` int(11) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nif` varchar(9) COLLATE utf8_bin NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `apellido1` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `apellido2` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fcnac` date NOT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `domicilio` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `cdpostal` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `localidad_id` int(3) DEFAULT NULL,
  `provincia_id` int(2) DEFAULT NULL,
  `movil` varchar(9) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `cuenta_mayor_id` int(11) DEFAULT NULL,
  `NIF` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(2) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas`
--

CREATE TABLE `rondas` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `num` int(2) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `competicion_id` int(11) NOT NULL,
  `activa` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabla de rondas o jornadas ';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id` int(11) NOT NULL,
  `nmsocio` int(11) NOT NULL,
  `licencia_monitor` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `numero_licencia` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `fcalta` date DEFAULT NULL,
  `fcbaja` date DEFAULT NULL,
  `observaciones` mediumtext COLLATE utf8_bin,
  `estado_id` int(11) DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios_foto`
--

CREATE TABLE `socios_foto` (
  `id` int(11) NOT NULL,
  `socio_id` int(11) NOT NULL,
  `foto` mediumblob NOT NULL,
  `tipo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_asiento`
--

CREATE TABLE `tipos_asiento` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_competicion`
--

CREATE TABLE `tipos_competicion` (
  `id` int(3) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_cuenta`
--

CREATE TABLE `tipos_cuenta` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_iva`
--

CREATE TABLE `tipos_iva` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `tipo` double DEFAULT NULL,
  `porcentaje` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `login` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `perfil` varchar(25) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabla de Usuarios ';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_conexiones`
--

CREATE TABLE `usuarios_conexiones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fcconexion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `dsconexion` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apuntes`
--
ALTER TABLE `apuntes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_asiento` (`asiento_id`) USING BTREE,
  ADD KEY `idx_cuenta_debe` (`cuenta_debe_id`) USING BTREE,
  ADD KEY `idx_cuenta_haber` (`cuenta_haber_id`) USING BTREE;

--
-- Indices de la tabla `arqueros`
--
ALTER TABLE `arqueros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_club` (`club_id`) USING BTREE,
  ADD KEY `idx_persona` (`persona_id`) USING BTREE,
  ADD KEY `idx_categoria` (`categoria_id`) USING BTREE;

--
-- Indices de la tabla `asientos`
--
ALTER TABLE `asientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asiento_factura`
--
ALTER TABLE `asiento_factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_proveedor` (`proveedor_id`) USING BTREE,
  ADD KEY `idx_cuenta_gastos` (`cuenta_gastos_id`) USING BTREE,
  ADD KEY `idx_cuenta_pago` (`cuenta_pago_id`) USING BTREE,
  ADD KEY `idx_proyecto` (`proyecto_id`) USING BTREE;

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clasificaciones`
--
ALTER TABLE `clasificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_competicion` (`competicion_id`) USING BTREE,
  ADD KEY `idx_participante` (`participante_id`) USING BTREE,
  ADD KEY `idx_modalidad` (`modalidad_id`) USING BTREE,
  ADD KEY `idx_categoria` (`categoria_id`) USING BTREE;

--
-- Indices de la tabla `clasificaciones_rondas`
--
ALTER TABLE `clasificaciones_rondas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_clasificacion` (`clasificacion_id`) USING BTREE,
  ADD KEY `idx_ronda` (`ronda_id`) USING BTREE;

--
-- Indices de la tabla `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_federacion` (`federacion_id`) USING BTREE;

--
-- Indices de la tabla `competiciones`
--
ALTER TABLE `competiciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_tipo_competicion` (`tipo_competicion_id`) USING BTREE,
  ADD KEY `idx_modo` (`modo_id`) USING BTREE;

--
-- Indices de la tabla `competiciones_imagenes`
--
ALTER TABLE `competiciones_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_competicion` (`competicion_id`) USING BTREE;

--
-- Indices de la tabla `cuentas_mayor`
--
ALTER TABLE `cuentas_mayor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo_cuentas_id` (`grupo_cuentas_id`),
  ADD KEY `tipo_cuenta_id` (`tipo_cuenta_id`);

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_asiento_apertura` (`asiento_apertura_id`) USING BTREE,
  ADD KEY `idx_asiento_cierre` (`asiento_cierre_id`) USING BTREE,
  ADD KEY `idx_asiento_regularizacion` (`asiento_regularizacion_id`) USING BTREE,
  ADD KEY `idx_estado_ejercicio` (`estado_ejercicio_id`) USING BTREE;

--
-- Indices de la tabla `ejercicio_actual`
--
ALTER TABLE `ejercicio_actual`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ejercicio_id` (`ejercicio_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_ejercicio`
--
ALTER TABLE `estados_ejercicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_usuario`
--
ALTER TABLE `estados_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estr_balance`
--
ALTER TABLE `estr_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_nivel_0` (`nivel0`) USING BTREE,
  ADD KEY `idx_nivel_1` (`nivel1`) USING BTREE,
  ADD KEY `idx_cuenta_mayor` (`cuenta_mayor_id`) USING BTREE,
  ADD KEY `idx_nivel_4` (`nivel4`) USING BTREE,
  ADD KEY `idx_nivel_3` (`nivel3`) USING BTREE,
  ADD KEY `idx_nivel_2` (`nivel2`) USING BTREE;

--
-- Indices de la tabla `federaciones`
--
ALTER TABLE `federaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo_cuentas`
--
ALTER TABLE `grupo_cuentas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_provincia` (`provincia_id`) USING BTREE;

--
-- Indices de la tabla `miembros_patrulla`
--
ALTER TABLE `miembros_patrulla`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_patrulla` (`patrulla_id`) USING BTREE,
  ADD KEY `idx_parti_ronda` (`parti_ronda_id`) USING BTREE;

--
-- Indices de la tabla `modalidades`
--
ALTER TABLE `modalidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modos`
--
ALTER TABLE `modos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modo_estructura`
--
ALTER TABLE `modo_estructura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `division_id` (`division_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `modalidad_id` (`modalidad_id`),
  ADD KEY `idx_modo` (`modo_id`) USING BTREE;

--
-- Indices de la tabla `niveles_balance`
--
ALTER TABLE `niveles_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_competicion` (`competicion_id`) USING BTREE,
  ADD KEY `idx_modalidad` (`modalidad_id`) USING BTREE,
  ADD KEY `idx_arquero` (`arquero_id`) USING BTREE;

--
-- Indices de la tabla `participantes_rondas`
--
ALTER TABLE `participantes_rondas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ronda` (`ronda_id`) USING BTREE,
  ADD KEY `idx_participante` (`participante_id`) USING BTREE;

--
-- Indices de la tabla `patrullas`
--
ALTER TABLE `patrullas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ronda` (`ronda_id`) USING BTREE;

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_localidad` (`localidad_id`) USING BTREE,
  ADD KEY `idx_provincia` (`provincia_id`) USING BTREE;

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cuenta_mayor` (`cuenta_mayor_id`) USING BTREE;

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rondas`
--
ALTER TABLE `rondas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_competicion` (`competicion_id`) USING BTREE;

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_id` (`estado_id`),
  ADD KEY `persona_id` (`persona_id`);

--
-- Indices de la tabla `socios_foto`
--
ALTER TABLE `socios_foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_socio` (`socio_id`) USING BTREE;

--
-- Indices de la tabla `tipos_asiento`
--
ALTER TABLE `tipos_asiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_competicion`
--
ALTER TABLE `tipos_competicion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_cuenta`
--
ALTER TABLE `tipos_cuenta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_iva`
--
ALTER TABLE `tipos_iva`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indices de la tabla `usuarios_conexiones`
--
ALTER TABLE `usuarios_conexiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_usuario` (`usuario_id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apuntes`
--
ALTER TABLE `apuntes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2083;
--
-- AUTO_INCREMENT de la tabla `arqueros`
--
ALTER TABLE `arqueros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=819;
--
-- AUTO_INCREMENT de la tabla `asientos`
--
ALTER TABLE `asientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=788;
--
-- AUTO_INCREMENT de la tabla `asiento_factura`
--
ALTER TABLE `asiento_factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `clasificaciones`
--
ALTER TABLE `clasificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=678;
--
-- AUTO_INCREMENT de la tabla `clasificaciones_rondas`
--
ALTER TABLE `clasificaciones_rondas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1293;
--
-- AUTO_INCREMENT de la tabla `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT de la tabla `competiciones`
--
ALTER TABLE `competiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `competiciones_imagenes`
--
ALTER TABLE `competiciones_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `cuentas_mayor`
--
ALTER TABLE `cuentas_mayor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `estados_ejercicio`
--
ALTER TABLE `estados_ejercicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estados_usuario`
--
ALTER TABLE `estados_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `estr_balance`
--
ALTER TABLE `estr_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `federaciones`
--
ALTER TABLE `federaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `grupo_cuentas`
--
ALTER TABLE `grupo_cuentas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7453;
--
-- AUTO_INCREMENT de la tabla `miembros_patrulla`
--
ALTER TABLE `miembros_patrulla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;
--
-- AUTO_INCREMENT de la tabla `modalidades`
--
ALTER TABLE `modalidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `modos`
--
ALTER TABLE `modos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;
--
-- AUTO_INCREMENT de la tabla `participantes_rondas`
--
ALTER TABLE `participantes_rondas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=407;
--
-- AUTO_INCREMENT de la tabla `patrullas`
--
ALTER TABLE `patrullas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=492;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `rondas`
--
ALTER TABLE `rondas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;
--
-- AUTO_INCREMENT de la tabla `tipos_asiento`
--
ALTER TABLE `tipos_asiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tipos_competicion`
--
ALTER TABLE `tipos_competicion`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipos_cuenta`
--
ALTER TABLE `tipos_cuenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipos_iva`
--
ALTER TABLE `tipos_iva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuarios_conexiones`
--
ALTER TABLE `usuarios_conexiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apuntes`
--
ALTER TABLE `apuntes`
  ADD CONSTRAINT `apuntes_ibfk_1` FOREIGN KEY (`asiento_id`) REFERENCES `asientos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `apuntes_ibfk_2` FOREIGN KEY (`cuenta_debe_id`) REFERENCES `cuentas_mayor` (`id`) ON UPDATE SET NULL,
  ADD CONSTRAINT `apuntes_ibfk_3` FOREIGN KEY (`cuenta_haber_id`) REFERENCES `cuentas_mayor` (`id`) ON UPDATE SET NULL;

--
-- Filtros para la tabla `clasificaciones`
--
ALTER TABLE `clasificaciones`
  ADD CONSTRAINT `clasificaciones_ibfk_1` FOREIGN KEY (`competicion_id`) REFERENCES `competiciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clasificaciones_ibfk_2` FOREIGN KEY (`participante_id`) REFERENCES `participantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clasificaciones_ibfk_3` FOREIGN KEY (`modalidad_id`) REFERENCES `modalidades` (`id`),
  ADD CONSTRAINT `clasificaciones_ibfk_4` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `clasificaciones_rondas`
--
ALTER TABLE `clasificaciones_rondas`
  ADD CONSTRAINT `clasificaciones_rondas_ibfk_1` FOREIGN KEY (`clasificacion_id`) REFERENCES `clasificaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clasificaciones_rondas_ibfk_2` FOREIGN KEY (`ronda_id`) REFERENCES `rondas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_ibfk_1` FOREIGN KEY (`federacion_id`) REFERENCES `federaciones` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `competiciones`
--
ALTER TABLE `competiciones`
  ADD CONSTRAINT `competiciones_ibfk_1` FOREIGN KEY (`modo_id`) REFERENCES `modos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `competiciones_ibfk_2` FOREIGN KEY (`tipo_competicion_id`) REFERENCES `tipos_competicion` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `competiciones_imagenes`
--
ALTER TABLE `competiciones_imagenes`
  ADD CONSTRAINT `competiciones_imagenes_ibfk_1` FOREIGN KEY (`competicion_id`) REFERENCES `competiciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas_mayor`
--
ALTER TABLE `cuentas_mayor`
  ADD CONSTRAINT `cuentas_mayor_ibfk_1` FOREIGN KEY (`grupo_cuentas_id`) REFERENCES `grupo_cuentas` (`id`),
  ADD CONSTRAINT `cuentas_mayor_ibfk_2` FOREIGN KEY (`tipo_cuenta_id`) REFERENCES `tipos_cuenta` (`id`);

--
-- Filtros para la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD CONSTRAINT `ejercicios_ibfk_1` FOREIGN KEY (`asiento_apertura_id`) REFERENCES `asientos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `ejercicios_ibfk_2` FOREIGN KEY (`asiento_regularizacion_id`) REFERENCES `asientos` (`id`),
  ADD CONSTRAINT `ejercicios_ibfk_3` FOREIGN KEY (`asiento_cierre_id`) REFERENCES `asientos` (`id`),
  ADD CONSTRAINT `ejercicios_ibfk_4` FOREIGN KEY (`estado_ejercicio_id`) REFERENCES `estados_ejercicio` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `ejercicio_actual`
--
ALTER TABLE `ejercicio_actual`
  ADD CONSTRAINT `ejercicio_actual_ibfk_1` FOREIGN KEY (`ejercicio_id`) REFERENCES `ejercicios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `estr_balance`
--
ALTER TABLE `estr_balance`
  ADD CONSTRAINT `estr_balance_ibfk_1` FOREIGN KEY (`nivel0`) REFERENCES `niveles_balance` (`id`),
  ADD CONSTRAINT `estr_balance_ibfk_2` FOREIGN KEY (`nivel1`) REFERENCES `niveles_balance` (`id`),
  ADD CONSTRAINT `estr_balance_ibfk_3` FOREIGN KEY (`nivel3`) REFERENCES `niveles_balance` (`id`),
  ADD CONSTRAINT `estr_balance_ibfk_4` FOREIGN KEY (`nivel4`) REFERENCES `niveles_balance` (`id`),
  ADD CONSTRAINT `estr_balance_ibfk_5` FOREIGN KEY (`cuenta_mayor_id`) REFERENCES `cuentas_mayor` (`id`);

--
-- Filtros para la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD CONSTRAINT `localidades_ibfk_1` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `miembros_patrulla`
--
ALTER TABLE `miembros_patrulla`
  ADD CONSTRAINT `miembros_patrulla_ibfk_2` FOREIGN KEY (`parti_ronda_id`) REFERENCES `participantes_rondas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `miembros_patrulla_ibfk_3` FOREIGN KEY (`patrulla_id`) REFERENCES `patrullas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `participantes`
--
ALTER TABLE `participantes`
  ADD CONSTRAINT `participantes_ibfk_1` FOREIGN KEY (`competicion_id`) REFERENCES `competiciones` (`id`),
  ADD CONSTRAINT `participantes_ibfk_2` FOREIGN KEY (`modalidad_id`) REFERENCES `modalidades` (`id`);

--
-- Filtros para la tabla `participantes_rondas`
--
ALTER TABLE `participantes_rondas`
  ADD CONSTRAINT `participantes_rondas_ibfk_2` FOREIGN KEY (`ronda_id`) REFERENCES `rondas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participantes_rondas_ibfk_3` FOREIGN KEY (`participante_id`) REFERENCES `participantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `patrullas`
--
ALTER TABLE `patrullas`
  ADD CONSTRAINT `patrullas_ibfk_1` FOREIGN KEY (`ronda_id`) REFERENCES `rondas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`),
  ADD CONSTRAINT `personas_ibfk_2` FOREIGN KEY (`localidad_id`) REFERENCES `localidades` (`id`);

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `xx` FOREIGN KEY (`cuenta_mayor_id`) REFERENCES `cuentas_mayor` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `socios_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `socios_ibfk_2` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `socios_foto`
--
ALTER TABLE `socios_foto`
  ADD CONSTRAINT `socios_foto_ibfk_1` FOREIGN KEY (`socio_id`) REFERENCES `socios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_conexiones`
--
ALTER TABLE `usuarios_conexiones`
  ADD CONSTRAINT `usuarios_conexiones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
