use system32laravel
INSERT INTO usuarios (nombre, apellido, usuario, email, password, nacimiento, fk_rol) VALUES
('Administrador', '',  'admin@system32.com', 'admin123', '2024-01-01', 0),
('Juan', 'Perez', 'jperez@system32.com', 'jperez123', '2024-02-01', 1),
('Maria', 'Lopez',  'mlopez@system32.com', 'mlopez123', '2024-03-01', 1),
('Carlos', 'Gomez'  'cgomez@system32.com', 'cgomez123', '2024-04-01', 1),
('Ana', 'Martinez',  'amartinez@system32.com', 'amartinez123', '2024-05-01', 1);
-- Insertar datos en la tabla MARCA
INSERT INTO MARCA (nombre, descripcion) VALUES
('Dell', 'Computadoras y accesorios'),
('HP', 'Equipos de computación y periféricos'),
('Intel', 'Procesadores y componentes'),
('Logitech', 'Periféricos y accesorios de computadora'),
('Microsoft', 'Software y hardware de computación');

-- Insertar datos en la tabla COMPRA
INSERT INTO COMPRA (fecha_compra, total_compra, FK_provedorID) VALUES
('2024-01-15', 2500.50, 1),
('2024-02-20', 1500.75, 2),
('2024-03-25', 3200.00, 3),
('2024-04-30', 4700.20, 4),
('2024-05-05', 2100.80, 5);

-- Insertar datos en la tabla VENTA
INSERT INTO VENTA (fecha_venta, total_venta, FK_clienteID) VALUES
('2024-01-10', 1200.50, 1),
('2024-02-15', 1800.75, 2),
('2024-03-20', 1500.00, 3),
('2024-04-25', 2300.20, 4),
('2024-05-01', 2900.80, 5);

-- Insertar datos en la tabla GRUPO
INSERT INTO GRUPO (nombre, caracteristicas) VALUES
('Portátiles', 'Laptops y ultrabooks de diversas marcas y modelos'),
('Escritorio', 'Computadoras de escritorio y accesorios'),
('Componentes', 'Componentes de PC como RAM, CPU, GPU, etc.'),
('Periféricos', 'Periféricos como teclados, ratones, monitores, etc.'),
('Software', 'Software y licencias para diferentes aplicaciones');


-- Insertar datos en la tabla MODELO
INSERT INTO MODELO (nombre, caracteristica) VALUES
('Inspiron 15', 'Laptop Dell con procesador Intel i7 y 16GB de RAM'),
('Pavilion', 'Laptop HP con procesador AMD Ryzen y 8GB de RAM'),
('Core i9', 'Procesador Intel Core i9 de décima generación'),
('MX Master', 'Ratón inalámbrico avanzado de Logitech'),
('Office 365', 'Licencia de software de productividad de Microsoft');

INSERT INTO PRODUCTO (nombre, precio_venta, descripcion, cantidad, FK_grupoID, FK_marcaID, FK_modeloID) VALUES
('Laptop Dell Inspiron 15', 1200, 'Laptop de 15 pulgadas con Intel i7 y 16GB RAM', '10', 1, 1, 1),
('Laptop HP Pavilion', 900, 'Laptop de 14 pulgadas con AMD Ryzen y 8GB RAM', '15', 1, 2, 2),
('Procesador Intel Core i9', 500, 'Procesador de alto rendimiento para gamers y profesionales', '20', 3, 3, 3),
('Ratón Logitech MX Master', 100, 'Ratón inalámbrico avanzado con múltiples funcionalidades', '30', 4, 4, 4),
('Licencia Microsoft Office 365', 80, 'Licencia anual para el paquete de productividad Office 365', '50', 5, 5, 5);

-- Insertar datos en la tabla EMPLEADO
INSERT INTO EMPLEADO (nombre, apellido, sexo, cargo, telefono, fecha_contratacion) VALUES
('Jose', 'Ramirez', 'M', 'Vendedor', '555-6666', '2024-01-01'),
('Elena', 'Torres', 'F', 'Cajera', '555-7777', '2024-02-01'),
('Miguel', 'Castillo', 'M', 'Gerente', '555-8888', '2024-03-01'),
('Laura', 'Ortega', 'F', 'Asistente', '555-9999', '2024-04-01'),
('Diego', 'Mendoza', 'M', 'Supervisor', '555-0000', '2024-05-01');

-- Insertar datos en la tabla DETALLE_VENTA
INSERT INTO DETALLE_VENTA (cantidad, precio_unidad, sub_total, total, FK_empleadoID, FK_productoID, FK_ventaID) VALUES
('1', 120.00, 120.00, 1200.00, 1, 1, 1),
('2', 900.00, 180.00, 1800.00, 2, 2, 2),
('1', 500.00, 500.00, 500.00, 3, 3, 3),
('3', 100.00, 300.00, 300.00, 4, 4, 4),
('4', 80.00, 320.00, 320.00, 5, 5, 5);

-- Insertar datos en la tabla DETALLE_COMPRA
INSERT INTO DETALLE_COMPRA (cantidad, precio_unidad, sub_total, total, FK_compraID, FK_productoID) VALUES
('10', 120.00, '12000.00', 12000.00, 1, 1),
('15', 900.00, '13500.00', 13500.00, 2, 2),
('20', 500.00, '10000.00', 10000.00, 3, 3),
('30', 100.00, '3000.00', 3000.00, 4, 4),
('50', 80.00, '4000.00', 4000.00, 5, 5);
-- Insertar datos en la tabla USUARIOS
