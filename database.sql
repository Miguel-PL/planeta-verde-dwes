-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql108.infinityfree.com
-- Tiempo de generación: 02-04-2026 a las 12:00:33
-- Versión del servidor: 11.4.10-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `if0_40705610_planeta_verde`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`, `activo`) VALUES
(2, 'Alimentación', 'Productos de alimentación ecológicos donde la calidad de los ingredientes y la fuente de origen siempre son naturales como la propia vida.', 1),
(3, 'Cosmética', 'Resalta tu luz natural sin químicos añadidos: fórmulas bio y veganas para un cuidado personal consciente y respetuoso.', 1),
(4, 'Limpieza', 'Hogar impecable y planeta sano: soluciones de limpieza biodegradables, libres de tóxicos y seguras para toda tu familia.', 1),
(5, 'Suplementación', 'Nutre tu cuerpo con el poder de la naturaleza: suplementos 100% orgánicos, libres de químicos y diseñados para tu bienestar diario.', 1),
(6, 'Bebé', 'Lo mejor para su futuro comienza hoy: higiene y accesorios ecológicos libres de tóxicos para un crecimiento sano y natural.', 1),
(7, 'Mascotas', 'Lo mejor para tus compañeros animales respetando al planeta.', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 26, 8, '6.90'),
(2, 1, 34, 2, '3.50'),
(3, 1, 31, 2, '2.40'),
(4, 1, 27, 1, '3.20'),
(5, 1, 36, 5, '16.30'),
(6, 2, 26, 1, '6.95'),
(7, 2, 37, 1, '19.69'),
(8, 2, 25, 1, '2.50'),
(9, 3, 28, 1, '2.10'),
(10, 3, 36, 1, '16.30'),
(11, 4, 27, 1, '3.20'),
(12, 4, 31, 1, '3.10'),
(13, 5, 26, 1, '6.90'),
(14, 6, 37, 1, '19.69'),
(15, 7, 38, 1, '11.95'),
(16, 7, 34, 1, '3.50'),
(17, 8, 26, 1, '6.90'),
(18, 9, 26, 1, '6.90'),
(19, 10, 48, 1, '2.61'),
(20, 10, 46, 1, '4.05'),
(21, 11, 54, 1, '10.85'),
(22, 11, 39, 1, '3.50'),
(23, 11, 45, 1, '2.60'),
(24, 11, 44, 1, '9.95'),
(25, 11, 34, 1, '3.50'),
(26, 11, 52, 1, '18.84'),
(27, 12, 41, 1, '3.40'),
(28, 12, 51, 1, '6.95'),
(29, 12, 50, 1, '4.29'),
(30, 13, 47, 1, '17.12'),
(31, 13, 32, 1, '1.60'),
(32, 13, 52, 1, '18.84'),
(33, 13, 53, 1, '26.22'),
(34, 13, 25, 1, '2.50'),
(35, 14, 46, 1, '4.05'),
(36, 14, 37, 1, '19.69'),
(37, 14, 34, 1, '3.50'),
(38, 14, 27, 1, '3.20'),
(39, 14, 53, 1, '26.22'),
(40, 14, 25, 1, '2.50'),
(41, 14, 35, 1, '17.00'),
(42, 14, 36, 1, '16.30'),
(43, 14, 44, 1, '9.95'),
(44, 15, 26, 1, '6.90'),
(45, 15, 48, 1, '2.61'),
(46, 15, 46, 3, '4.05'),
(47, 15, 54, 3, '10.85'),
(48, 15, 39, 2, '3.50'),
(49, 15, 38, 2, '11.95'),
(50, 15, 41, 4, '3.40'),
(51, 15, 49, 3, '4.96'),
(52, 15, 51, 3, '6.95'),
(53, 15, 44, 2, '9.95');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','enviado','entregado') NOT NULL DEFAULT 'pendiente',
  `total` decimal(10,2) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `created_at`, `estado`, `total`, `activo`) VALUES
(1, NULL, '2026-01-22 10:00:21', 'entregado', '151.70', 1),
(2, 4, '2026-01-22 13:52:49', 'enviado', '29.14', 1),
(3, 7, '2026-01-22 15:37:27', 'enviado', '18.40', 1),
(4, 8, '2026-01-22 18:19:50', 'pendiente', '6.30', 1),
(5, 8, '2026-01-22 18:41:46', 'pendiente', '6.90', 1),
(6, 8, '2026-01-22 18:49:47', 'enviado', '19.69', 1),
(7, 8, '2026-01-23 06:17:00', 'entregado', '15.45', 1),
(8, NULL, '2026-04-02 10:29:29', 'enviado', '6.90', 1),
(9, 2, '2026-04-02 10:35:31', 'pendiente', '6.90', 1),
(10, 2, '2026-04-02 15:07:49', 'enviado', '6.66', 1),
(11, 7, '2026-04-02 15:09:18', 'entregado', '49.24', 1),
(12, 3, '2026-04-02 15:11:04', 'enviado', '14.64', 1),
(13, 5, '2026-04-02 15:14:37', 'pendiente', '66.28', 1),
(14, 6, '2026-04-02 15:16:04', 'entregado', '102.41', 1),
(15, 8, '2026-04-02 15:18:24', 'enviado', '154.34', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio`, `imagen`, `id_categoria`, `activo`) VALUES
(25, 'Manzanas ecológicas', 'Manzanas frescas de cultivo ecológico, recolectadas en temporada.', '2.50', 'manzanas_ok.jpg', 2, 1),
(26, 'Aceite de oliva virgen extra bio', 'Aceite de oliva ecológico de primera presión en frío.', '6.90', 'aceite_ok.jpg', 2, 1),
(27, 'Huevos camperos', 'Huevos ecológicos de gallinas criadas en libertad.', '3.20', 'huevos_camperos.jpg', 2, 1),
(28, 'Naranjas ecológicas', 'Naranjas dulces y jugosas cultivadas sin pesticidas.', '2.10', 'naranajas_ecológicas.jpg', 2, 1),
(29, 'Miel natural artesanal', 'Miel pura recolectada de colmenas locales.', '5.50', 'miel_artesanal.jpg', 2, 1),
(30, 'Tomates ecológicos', 'Tomates frescos de huerta ecológica.', '2.80', 'tomates.jpg', 2, 0),
(31, 'Vinagre de manzana ECO crudo sin filtrar', 'El vinagre de manzana ecológico es un producto natural obtenido mediante la fermentación de sidra de manzanas ecológicas.', '3.10', 'Vinagre_ok.jpg', 2, 1),
(32, 'Leche ecológica', 'Leche ecológica procedente de ganaderías sostenibles.', '1.60', 'leche_ecológica.jpg', 2, 1),
(33, 'Pasta de Dientes Extra Fresca Equinácea & Menta BIO', 'Cuidado completo para dientes y encías. Apto para dientes sensibles.', '4.95', 'pasta_dientes_menta.jpg', 3, 1),
(34, 'Estropajo de luffa con asa ergonómico Azal 12 x 7 cm', 'Estropajo vegetal de luffa ecológica para la cocina o el hogar. Ideal para sustituir al estropajo sintético en tu hogar.', '3.50', 'estropajo_luffa.jpg', 4, 1),
(35, 'Nutralie Magnesio con Bisglicinato y Citrato 120 cápsulas', 'Contiene una alta biodisponibilidad, permitiendo que nuestro organismo aproveche la máxima cantidad posible de magnesio y que, por tanto, alcance su punto máximo de acción.', '17.00', 'citrato_magnesio.jpg', 5, 1),
(36, 'Toallitas de bebé WaterWipes BIO 240 Uds', 'Toallitas de bebé WaterWipes BIO 4x60UDS para Bebés, la mejor alternativa al algodón y al agua.', '16.30', 'toallitas_waterwipes.jpg', 6, 1),
(37, 'Café', 'Café en grano Eco 100% Arábica Planeta Huerto 1 Kg', '19.69', 'Café_ok.jpg', 2, 1),
(38, 'Eco pastillas 6 en 1 Lavavajillas Natulim 30 uds', 'Las Eco Pastillas 6 en 1 Lavavajillas Natulim están diseñadas para ofrecer una limpieza eficaz y ecológica en lavavajillas automáticos.', '11.95', 'eco_pastillas_lava.jpg', 4, 1),
(39, 'Bolsas basura amarilla 30 litros 100% recicladas Relevo 15 Uds', 'Color amarillo, ideal para separar y reciclar.\r\nAunque están hechas de plástico reciclado tienen un 20% más de resistencia que las bolsas normales para la basura.\r\nSe puede utilizar para el reciclaje de envases además son antigoteo y tienen cierra fácil,', '3.50', 'bolsa_basura_amarilla.jpg', 4, 1),
(40, 'Limpiador de Frutas y Hortalizas Ecodoo 750 ml', 'Limpiador especialmente formulado para eliminar la suciedad, restos de pesticidas y bacterias de frutas y verduras. Su fórmula biodegradable a base de ingredientes naturales garantiza una limpieza eficaz sin dejar residuos tóxicos.', '7.95', 'limpiador_hortalizas.jpg', 4, 1),
(41, 'Hogar multiusos lavanda Frosch 1000 ml', 'El limpiador multiusos Frosch lavanda es ideal para la limpieza diaria del hogar. Su fórmula con extractos de lavanda limpia en profundidad sin dejar residuos, eliminando grasa, suciedad general y malos olores. Aporta un ambiente fresco y agradable gracia', '3.40', 'hogas_multiusos.jpg', 4, 1),
(42, 'Pastillas lavavajillas bicarbonato Frosch 50 uds', 'Las pastillas lavavajillas Frosch con bicarbonato de sodio están diseñadas para ofrecer una limpieza eficaz y ecológica en lavavajillas automáticos. Su fórmula Todo en 1 combina detergente, abrillantador y función antical, garantizando una vajilla limpia', '14.50', 'pastillas_frosch.jpg', 4, 1),
(43, 'Tarrito BIO ternera y verduras +6 meses Smileat 230g', 'Delicioso tarrito de ternera con verduras. La carne ha sido criada con el mayor mimo posible y alimentada de manera ecológica y natural.', '2.50', 'tarrito_bio.jpg', 6, 1),
(44, 'Weleda Champú y Gel de ducha bebé de caléndula 200 ml', 'Con una textura cremosa, es un champú y gel de ducha suave para cuidar la piel y lavar el pelo de los más pequeños desde sus primeros baños. Un producto muy seguro con ingredientes naturales que no pica en los ojos y deja la piel suave y el cabello muy fá', '9.95', 'weleda_champu.jpg', 6, 1),
(45, 'Galletas Infantiles de Avena y Frutas Bio Sol Natural 90 g', 'Galletas Infantiles de Avena y Frutas Bio en forma de Dinosaurio\r\n- Endulzadas con frutas ( zumo de naranja, zumo de limón y dátil)\r\n- Veganas.', '2.60', 'galletas_infantiles.jpg', 6, 1),
(46, 'Baby limpia biberones y tetinas Frosch 500 ml', 'El Limpiador Biberones y Tetinas de FROSCH Baby es un limpiador seguro para el bebé que elimina eficazmente restos de leche y comida en utensilios para bebés. Limpieza eficaz (con enzimas naturales) y con cuidado de biberones, tetinas y otros utensilios p', '4.05', 'limpia_biberones.jpg', 6, 1),
(47, 'Pañales T3 (4-9kg) Pingo 44 Uds', 'Talla 3 Pañales Pingo, recomendada para niños entre 4 y 9 kg de peso.\r\nPañal ecológico con 3 certificaciones “FSC”, “NaturemadeStar” y “MyClimate”.', '17.12', 'pañales_pingo.jpg', 6, 1),
(48, 'Arcilla blanca Soria natural 250 g', 'La Arcilla Blanca de Soria Natural es un producto de origen 100% natural, compuesto fundamentalmente por caolín. De textura fina, gran pureza y excelentes características físico-químicas, es apta tanto para uso externo como interno. Ideal para tratamiento', '2.61', 'arcilla_blanca.jpg', 3, 1),
(49, 'Jabón Eco para Afeitado y Barba, 120g Essabó', 'Jabón sólido especialmente formulado para un afeitado clásico natural y para el cuidado de la barba y la piel. Produce una espuma cremosa que facilita el afeitado y protege la piel, incluso las más sensibles, evitando irritaciones. También es ideal para l', '4.96', 'jabon_barba.jpg', 3, 1),
(50, 'Desodorante roll-on 24h hombre lúpulo BIO Cosnature 50 ml', 'Desodorante roll-on para hombre que ofrece una sensación de frescor y protección durante 24 horas con un aroma deportivo. Fórmula suave que no deja manchas blancas en la ropa y sin sales de aluminio. Testado dermatológicamente para un cuidado seguro de la', '4.29', 'desodorante.jpg', 3, 1),
(51, 'Manteca de karité Arganour 150 ml', 'La manteca de karité BIO cuenta con infinidad de propiedades demostradas para el cuidado de la piel. ¿Sabías que procede de las sabanas de África? Las reinas africanas y faraónicas egipcias utilizaban este cosmético de origen 100% natural para el cuidado', '6.95', 'manteca_karite.jpg', 3, 1),
(52, 'Proteína vegana Vainilla, 350g. Natruly', '¡Natural en todos los sentidos! Nuestra proteína vegana de fresa y frambuesa es naturalmente rica en proteína de origen vegetal (90%), combinamos las de fácil digestión como son la proteína de guisante, arroz y cáñamo, con el delicioso dulzor de la remola', '18.84', 'proteina_vegana.jpg', 5, 1),
(53, 'Levadura de Arroz Rojo de Monacolina Aldous Bio 400 comprimidos', 'Levadura de Arroz Rojo con Coenzima Q10 | 400 comprimidos | 2,99 mg de Monacolina pura | Función Normal del Corazón | Controla el colesterol | Libre de Citrinina | Más de 1 Año | Red Yeast Rice', '26.22', 'levadura_arroz.jpg', 5, 1),
(54, 'Batido saciante Chocolate Sotya, 700 g', '700 gr. de batido saciante a base de leche, con todas las vitaminas y minerales en las cantidades recomendadas por la CDR, y la cantidad de proteínas, hidratos de carbono y fibra necesarios para una comida equilibrada, saludable e hipocalórica.', '10.85', 'batido_saciante.jpg', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('cliente','empleado','admin') NOT NULL DEFAULT 'cliente',
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `dni`, `email`, `password`, `rol`, `activo`, `created_at`) VALUES
(2, 'Administrador', '13581321A', 'admin@planetaverde.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 1, '2026-01-22 08:51:06'),
(3, 'Empleado Demo', '11111111A', 'empleado@planetaverde.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'empleado', 1, '2026-01-22 13:50:14'),
(4, 'Cliente Uno', '22222222B', 'cliente1@planetaverde.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cliente', 0, '2026-01-22 13:50:14'),
(5, 'Cliente Dos', '33333333C', 'cliente2@planetaverde.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cliente', 1, '2026-01-22 13:50:14'),
(6, 'Cliente Tres', '44444444D', 'cliente3@planetaverde.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cliente', 0, '2026-01-22 13:50:14'),
(7, 'Miguel Pérez López', '22591328S', 'miguel@ejemplo.com', '$2y$10$uuef8Zf1XZKGwePJK1wAmuD8RmC0dPOcHVKA1YVzoaDJuqBGmUXzu', 'cliente', 1, '2026-01-22 15:36:24'),
(8, 'María Martínez Bautista', '48471111Y', 'maria@ejemplo.com', '$2y$10$uuef8Zf1XZKGwePJK1wAmuD8RmC0dPOcHVKA1YVzoaDJuqBGmUXzu', 'cliente', 1, '2026-01-22 18:14:18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
