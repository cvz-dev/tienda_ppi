-- Datos de ejemplo de la tienda rebuild.
-- Ejecutar una sola vez, después de ddl.sql y con las tablas vacías.

SET NAMES utf8mb4;

USE tienda_ppi;

-- --------------------------------------------------------
-- Productos
-- --------------------------------------------------------

INSERT INTO productos (nombre, descripcion, foto, precio, cantidad_almacen, fabricante, origen) VALUES

-- Laptops
('Laptop rebuild. 13 Ryzen 5', 'Laptop de 13.5 pulgadas con procesador Ryzen 5, 16 GB de RAM y SSD de 512 GB. Pantalla, teclado, batería y puertos se cambian con un solo desarmador.', 'img/productos/laptop.svg', 21999.00, 12, 'rebuild.', 'Taiwán'),
('Laptop rebuild. 13 Ryzen 7', 'Misma base de la 13 con procesador Ryzen 7, 32 GB de RAM y SSD de 1 TB. Pensada para programación y edición ligera.', 'img/productos/laptop.svg', 27999.00, 8, 'rebuild.', 'Taiwán'),
('Laptop rebuild. 16', 'Laptop de 16 pulgadas con pantalla de 165 Hz, teclado completo con teclado numérico intercambiable y seis ranuras de puertos.', 'img/productos/laptop.svg', 34999.00, 6, 'rebuild.', 'Taiwán'),
('Laptop rebuild. 16 con módulo gráfico', 'La versión de 16 pulgadas con módulo de tarjeta gráfica dedicada en la parte trasera. El módulo se puede retirar para ganar autonomía.', 'img/productos/laptop.svg', 44999.00, 4, 'rebuild.', 'Taiwán'),
('Kit DIY Laptop 13', 'La laptop 13 sin ensamblar, sin RAM, sin SSD y sin sistema operativo. Tú eliges y montas cada componente.', 'img/productos/laptop.svg', 16999.00, 10, 'rebuild.', 'Taiwán'),
('Laptop rebuild. Edu 12', 'Laptop de 12 pulgadas resistente a golpes, pensada para escuelas. Batería y teclado reemplazables en minutos.', 'img/productos/laptop.svg', 9499.00, 20, 'rebuild.', 'México'),
('Laptop reacondicionada rebuild. 13', 'Equipo de generación anterior revisado y con batería nueva. Incluye garantía de un año.', 'img/productos/laptop.svg', 12999.00, 0, 'rebuild.', 'México'),
('Laptop Modula Pro 14', 'Laptop de 14 pulgadas con chasis de aluminio reciclado y memoria en ranuras estándar.', 'img/productos/laptop.svg', 24499.00, 7, 'Modula', 'Alemania'),

-- PCs
('PC rebuild. Mini', 'Computadora de escritorio compacta Mini-ITX con Ryzen 5, 16 GB de RAM y SSD de 1 TB. Todos los componentes son estándar.', 'img/productos/pc.svg', 18999.00, 9, 'rebuild.', 'México'),
('PC rebuild. Torre', 'Torre ATX con Ryzen 7, 32 GB de RAM, SSD de 2 TB y espacio para cuatro unidades más.', 'img/productos/pc.svg', 31999.00, 5, 'rebuild.', 'México'),
('PC rebuild. Creator', 'Torre para edición de video y 3D con tarjeta gráfica de 16 GB y fuente de 850 W.', 'img/productos/pc.svg', 52999.00, 3, 'rebuild.', 'México'),
('Kit DIY PC Mini', 'Gabinete Mini-ITX, tarjeta madre y fuente. Agrega procesador, memoria y almacenamiento a tu gusto.', 'img/productos/pc.svg', 7999.00, 14, 'rebuild.', 'México'),
('Gabinete modular ATX', 'Gabinete con paneles frontales intercambiables y bahías sin herramientas.', 'img/productos/pc.svg', 2899.00, 18, 'Torque Components', 'Taiwán'),
('Gabinete modular Mini-ITX', 'Gabinete compacto de 10 litros con soporte para tarjeta gráfica de dos ranuras.', 'img/productos/pc.svg', 2499.00, 15, 'Torque Components', 'Taiwán'),
('Fuente modular 750 W', 'Fuente de poder con cables desmontables y certificación 80 Plus Gold.', 'img/productos/pc.svg', 2199.00, 22, 'Volta Power', 'China'),
('Tarjeta madre ATX B650', 'Tarjeta madre para procesadores Ryzen con cuatro ranuras DDR5 y tres ranuras M.2.', 'img/productos/pc.svg', 3999.00, 11, 'Torque Components', 'Taiwán'),

-- Teléfonos
('Teléfono rebuild. 6', 'Teléfono de 6.1 pulgadas con batería, pantalla, cámara y puerto USB-C reemplazables por el usuario.', 'img/productos/telefono.svg', 11999.00, 16, 'rebuild.', 'Corea del Sur'),
('Teléfono rebuild. 6 Pro', 'Pantalla de 6.7 pulgadas a 120 Hz y módulo de cámara con sensor de 50 MP.', 'img/productos/telefono.svg', 16999.00, 9, 'rebuild.', 'Corea del Sur'),
('Teléfono rebuild. Lite', 'Teléfono de entrada con cinco años de actualizaciones y batería que se cambia sin herramientas.', 'img/productos/telefono.svg', 6499.00, 25, 'rebuild.', 'China'),
('Kit DIY Teléfono rebuild. 6', 'El teléfono 6 en piezas, con guía paso a paso para armarlo.', 'img/productos/telefono.svg', 10499.00, 6, 'rebuild.', 'Corea del Sur'),
('Teléfono reacondicionado rebuild. 5', 'Modelo anterior revisado, con batería y pantalla nuevas.', 'img/productos/telefono.svg', 5499.00, 0, 'rebuild.', 'México'),
('Teléfono Modula One', 'Teléfono de 6.3 pulgadas con carcasa de bioplástico y módulos traseros intercambiables.', 'img/productos/telefono.svg', 9999.00, 10, 'Modula', 'Alemania'),

-- Módulos y repuestos
('Módulo de puerto USB-C', 'Módulo para las ranuras de expansión de las laptops rebuild. Agrega un puerto USB-C con carga.', 'img/productos/modulo.svg', 349.00, 60, 'rebuild.', 'Taiwán'),
('Módulo de puerto HDMI', 'Módulo de expansión con salida HDMI 2.1 para monitores externos.', 'img/productos/modulo.svg', 449.00, 45, 'rebuild.', 'Taiwán'),
('Módulo de almacenamiento 1 TB', 'Módulo de expansión con 1 TB de almacenamiento extra que se conecta en cualquier ranura.', 'img/productos/modulo.svg', 2499.00, 20, 'rebuild.', 'Taiwán'),
('Batería para Laptop 13', 'Batería de repuesto de 61 Wh para la Laptop rebuild. 13.', 'img/productos/modulo.svg', 1899.00, 30, 'Volta Power', 'China'),
('Teclado en español para Laptop 13', 'Teclado de repuesto con distribución latinoamericana y retroiluminación.', 'img/productos/modulo.svg', 1299.00, 25, 'rebuild.', 'Taiwán'),
('Bisel de color para Laptop 13', 'Marco de pantalla en musgo, latón o carbón. Se coloca con imanes.', 'img/productos/modulo.svg', 599.00, 40, 'rebuild.', 'México'),
('Pantalla de repuesto 13.5 pulgadas', 'Pantalla de 2256 x 1504 para la Laptop rebuild. 13.', 'img/productos/modulo.svg', 3499.00, 12, 'rebuild.', 'Corea del Sur'),
('Batería para Teléfono rebuild. 6', 'Batería de repuesto de 4500 mAh que se cambia sin herramientas.', 'img/productos/modulo.svg', 699.00, 35, 'Volta Power', 'China'),
('Módulo de cámara para Teléfono rebuild. 6', 'Módulo de cámara trasera de 50 MP compatible con el 6 y el 6 Pro.', 'img/productos/modulo.svg', 2299.00, 14, 'rebuild.', 'Japón'),
('Memoria RAM DDR5 16 GB', 'Módulo SO-DIMM de 5600 MHz para laptops y PC Mini.', 'img/productos/modulo.svg', 1199.00, 50, 'Núcleo Labs', 'Corea del Sur'),
('SSD NVMe 1 TB', 'Unidad M.2 2280 PCIe 4.0 para laptops y PCs.', 'img/productos/modulo.svg', 1599.00, 40, 'Núcleo Labs', 'Corea del Sur'),
('Kit de herramientas rebuild.', 'Desarmador con puntas intercambiables, espátula y pulsera antiestática.', 'img/productos/modulo.svg', 399.00, 70, 'rebuild.', 'México');
