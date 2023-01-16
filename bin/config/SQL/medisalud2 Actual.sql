
--  BASE DE DATOS PARA EL SISTEMA DE LA FARMACIA MEDISALUD C.A

DROP DATABASE IF EXISTS medisalud;

CREATE DATABASE  medisalud CHARACTER SET utf8mb4;
USE medisalud;

-- TABLA PARA NIVEL DE USUARIO 
CREATE TABLE `nivel`(
    `cod_nivel` int AUTO_INCREMENT PRIMARY KEY,
    `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA CLIENTES 
CREATE TABLE `cliente`(
    `cedula` varchar(15) COLLATE utf8_spanish2_ci PRIMARY KEY,
    `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `apellido` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `direccion` varchar(180) COLLATE utf8_spanish2_ci NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LABORATORIOS 
CREATE TABLE `laboratorio`(
    `cod_lab` int AUTO_INCREMENT PRIMARY KEY,
    `rif` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `direccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
    `razon_social` varchar(200) COLLATE utf8_spanish2_ci,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA DROGUERÍAS 
CREATE TABLE `drogueria`(
    `cod_drogue` int AUTO_INCREMENT PRIMARY KEY,
    `rif` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `direccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
    `razon_social` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA PRODUCTOS 
CREATE TABLE `producto`(
    `cod_producto` int AUTO_INCREMENT PRIMARY KEY,
    `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `descripcion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
    `composicion` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
    `contraindicaciones` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
    `ubicacion` varchar(50)COLLATE utf8_spanish2_ci NOT NULL,
    `posologia` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
    `stock` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
    `p_costo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
    `venta` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
    `vencimiento` date NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA USUARIOS 
CREATE TABLE `usuario`(
    `cedula` int PRIMARY KEY,
    `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `apellido` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `correo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
    `password` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
    `nivel` int NOT NULL,
    `status` int NOT NULL,
    FOREIGN KEY (`nivel`) REFERENCES `nivel`(`cod_nivel`) ON DELETE CASCADE ON UPDATE CASCADE 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA EL CONTACTO DE LOS CLIENTES 
CREATE TABLE `contacto_cliente`(
    `id_contacto` int AUTO_INCREMENT PRIMARY KEY,
    `celular` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `correo` varchar(60) COLLATE utf8_spanish2_ci,
    `cedula` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
    FOREIGN KEY (`cedula`) REFERENCES `cliente`(`cedula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci; 

-- TABLA PARA EL CONTACTO DE LOS LABORATORIOS */
CREATE TABLE `contacto_lab`(
    `id_contacto_lab` int AUTO_INCREMENT PRIMARY KEY,
    `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `contacto` varchar(20) COLLATE utf8_spanish2_ci ,
    `cod_lab` int NOT NULL,
    FOREIGN KEY (`cod_lab`) REFERENCES `laboratorio`(`cod_lab`) ON DELETE CASCADE ON UPDATE CASCADE  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA EL CONTACTO DE LAS DROGUERÍAS 
CREATE TABLE `contacto_drogue`(
    `id_contacto_drogue` int AUTO_INCREMENT PRIMARY KEY,
    `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `contacto` varchar(200) COLLATE utf8_spanish2_ci ,
    `cod_drogue` int NOT NULL,
    FOREIGN KEY (`cod_drogue`) REFERENCES `drogueria`(`cod_drogue`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LA PRESENTACIÓN DE LOS PRODUCTOS 
CREATE TABLE `presentacion`(
    `cod_pres` int AUTO_INCREMENT PRIMARY KEY,
    `cantidad` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
    `medida` int NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LOS TIPOS DE PRODUCTOS 
CREATE TABLE `tipo`(
    `cod_tipo` int AUTO_INCREMENT PRIMARY KEY,
    `des_tipo` varchar(40) COLLATE utf8_spanish2_ci,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LAS CLASES DE PRODUCTOS 
CREATE TABLE `clase_prod`(
    `cod_clase` int AUTO_INCREMENT PRIMARY KEY,
    `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
    `status` int NOT NULL,
    `cod_tipo` int NOT NULL,
    FOREIGN KEY (`cod_tipo`) REFERENCES `tipo`(`cod_tipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA DE LA RELACIÓN PRODUCTO - LABORATORIO 
CREATE TABLE `laboratorio_producto`(
    `cod_producto` int NOT NULL,
    `cod_lab` int NOT NULL,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_lab`) REFERENCES `laboratorio`(`cod_lab`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LA RELACIÓN PRODUCTO - DROGUERÍA 
CREATE TABLE `drogueria_producto`(
    `cod_drogue` int NOT NULL,
    `cod_producto` int NOT NULL,
    FOREIGN KEY (`cod_drogue`) REFERENCES `drogueria`(`cod_drogue`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LA RELACIÓN PRODUCTO - PRESENTACION 
CREATE TABLE `presentacion_producto`(
    `cod_pres` int NOT NULL,
    `cod_producto` int NOT NULL,
    FOREIGN KEY (`cod_pres`) REFERENCES `presentacion`(`cod_pres`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LA RELACIÓN PRODUCTO - TIPO 
CREATE TABLE `tipo_producto`(
    `cod_tipo` int NOT NULL,
    `cod_producto` int NOT NULL,
    FOREIGN KEY (`cod_tipo`) REFERENCES `tipo`(`cod_tipo`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LAS VENTAS 
CREATE TABLE `venta`(
    `num_fact` int AUTO_INCREMENT PRIMARY KEY,
    `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `monto` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `cedula_cliente` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
    `status` int NOT NULL,
    FOREIGN KEY (`cedula_cliente`) REFERENCES `cliente`(`cedula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LOS PAGOS 
CREATE TABLE `pago`(
    `num_pago` int AUTO_INCREMENT PRIMARY KEY,
    `monto` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `status` int NOT NULL,
    `num_fact` INT NOT NULL,
    FOREIGN KEY (`num_fact`) REFERENCES `venta`(`num_fact`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LOS TIPOS PAGOS 
CREATE TABLE `tipo_pago`(
    `cod_tipo_pago` int AUTO_INCREMENT PRIMARY KEY,
    `num_pago` int NOT NULL,
    `des_tipo_pago` varchar(40) COLLATE utf8_spanish2_ci,
    `status` int NOT NULL,
    FOREIGN KEY (`num_pago`) REFERENCES `pago`(`num_pago`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LA MONEDA 
CREATE TABLE `moneda`(
    `id_moneda` int AUTO_INCREMENT PRIMARY KEY,
    `cambio` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
    `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LA RELACIÓN VENTA - PRODUCTO 
CREATE TABLE `venta_producto`(
    `num_fact` int NOT NULL,
    `cod_producto` int NOT NULL,
    `cantidad` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
    `precio_actual` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
    FOREIGN KEY (`num_fact`) REFERENCES `venta`(`num_fact`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LAS FACTURAS DE ENTREGA 
CREATE TABLE `factura_entrega`(
    `num_factura_entrega` int AUTO_INCREMENT PRIMARY KEY,
    `fecha` date NOT NULL,
    `monto_total` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
    `status` int NOT NULL,
    `cod_drogue` int NOT NULL,
    FOREIGN KEY (`cod_drogue`) REFERENCES `drogueria`(`cod_drogue`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LAS FACTURAS DE PRODUCTO 
CREATE TABLE `factura_producto`(
    `num_factura_entrega` int NOT NULL,
    `cod_producto` int NOT NULL,
    `cantidad` int(12) NOT NULL,
    `precio_compra` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
    FOREIGN KEY (`num_factura_entrega`) REFERENCES `factura_entrega`(`num_factura_entrega`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- INSERTA LOS NIVELES DE USUARIO 
INSERT INTO nivel(nombre, status) VALUES ('Administrador', '1'), ('Gerente', '1'), ('Empleado', '1');

-- INSERTA LOS PRODUCTOS

-- INSERTA LOS CLIENTES
INSERT INTO `cliente`(`cedula`, `nombre`, `apellido`, `direccion`, `status`) VALUES 
('30233547','Enmanuel','Torres','Tierra Negra',1),
('29727935','Michelle','Torres','Tierra Negra',1),
('28956745','Victor','Aparicio','Chivacoa',1);
-- INSERTA LOS LABORATORIOS
INSERT INTO `laboratorio`(`rif`, `direccion`, `razon_social`, `status`) VALUES 
(1234567,'Av. Venezuela','MedicalCare',1),
(7788564,'Pueblo Nuevo','Bayer',1),
(2394739,'Pueblo Nuevo','Geven',1);
-- INSERTA LAS DROGUERIAS
INSERT INTO `drogueria`(`rif`, `direccion`, `razon_social`, `status`) VALUES 
(12345678,'Av.Venezuela','DroNena',1),
(34534565,'Pueblo Nuevo','DroAra',1),
(12232432,'Centro','DroAra',1);
-- INSERTA LAS PRECENTACIONES
INSERT INTO `presentacion`(`cantidad`, `medida`, `status`) VALUES 
(3,'500mg',1),
(5,'800mg',1),
(2,'10mg',1);
-- INSERTA LAS TIPO
INSERT INTO `tipo`(`des_tipo`, `status`) VALUES 
('Adulto',1),
('Pediátrico',1);