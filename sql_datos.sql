use system32laravel;
SET FOREIGN_KEY_CHECKS = 0;
INSERT INTO usuarios (id, nombre, apellido, email, password, nacimiento, rol_fk) 
VALUES
        (5, 'Juan',    'Perez',    'jperez@system32.com',  'jperez123', '2024-02-01', 1),
        (6, 'Maria',   'Lopez',    'mlopez@system32.com',  'mlopez123', '2024-03-01', 1),
        (7, 'Carlos',  'Gomez',     'cgomez@system32.com',  'cgomez123', '2024-04-01', 1),
        (8, 'Ana', '   Martinez',  'amartinez@system32.com', 'amartinez123', '2024-05-01', 1);
-- Insertar datos en la tabla MARCA
INSERT INTO marcas (nombre, descripcion) VALUES
('Dell', 'Computadoras y accesorios'),
('HP', 'Equipos de computación y periféricos'),
('Intel', 'Procesadores y componentes'),
('Logitech', 'Periféricos y accesorios de computadora'),
('Microsoft', 'Software y hardware de computación');

INSERT INTO productos (nombre, precio, descripcion, stock, marca_fk) VALUES
('Laptop Dell Inspiron 15', 1200, 'Laptop de 15 pulgadas con Intel i7 y 16GB RAM', 10, 1),
('Laptop HP Pavilion', 900, 'Laptop de 14 pulgadas con AMD Ryzen y 8GB RAM', 15, 2),
('Procesador Intel Core i9', 500, 'Procesador de alto rendimiento para gamers y profesionales', 20, 3),
('Ratón Logitech MX Master', 100, 'Ratón inalámbrico avanzado con múltiples funcionalidades', 30, 4),
('Licencia Microsoft Office 365', 80, 'Licencia anual para el paquete de productividad Office 365', 50, 5);

-- Insertar datos en la tabla COMPRA
INSERT INTO compras (usuario_fk, precio_total, tipo_pago, estado_pago) VALUES
(5,2500.50, 1,1),
(6,1500.75, 2,1),
(7,3200.00, 3,2),
(5,4700.20, 4,2),
(8,2100.80, 1,1);

-- Insertar datos en la tabla VENTA
INSERT INTO pedidos (cantidad, compra_fk, producto_fk) VALUES
(5, 1, 1),
(1, 1, 2),
(2, 1, 3),
(1, 1, 4),
(2, 1, 5),
(5, 2, 1),
(1, 2, 2),
(2, 3, 3),
(1, 3, 4),
(2, 4, 5),
(1, 4, 4),
(2, 4, 5),
(5, 5, 1),
(1, 5, 2),
(2, 5, 3),
(1, 5, 4),
(2, 5, 5);
