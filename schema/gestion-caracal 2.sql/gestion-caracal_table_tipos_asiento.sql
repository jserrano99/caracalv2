
--
-- Volcado de datos para la tabla `tipos_asiento`
--

INSERT INTO `tipos_asiento` (`id`, `descripcion`, `url`) VALUES
(1, 'Asiento Generico', 'mntoAsientos.php?idAsiento=0'),
(2, 'Asiento de Compra con Factura', 'asientoFactura.php'),
(3, 'Asiento de Traspaso Efectivo a Caja Presidente', 'traspasoCaja.php?idCaja=1'),
(4, 'Asiento de Traspaso Efectivo a Caja Secretario', 'traspasoCaja.php?idCaja=2'),
(5, 'Asiento Generico de Ingresos', 'asientoIngreso.php'),
(6, 'Asiento Generico de Gastos', 'asientoGastos.php'),
(7, 'Asiento Gastos Sin Proveedor', 'asientoGastosSinProveedor.php');
