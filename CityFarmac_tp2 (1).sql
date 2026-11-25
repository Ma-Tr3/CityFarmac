-- CityFarmac - Instancia 2 - MySQL/MariaDB - UTF8MB4
-- IMPORTANTE: importar en una base nueva; no elimina bases existentes.
CREATE DATABASE IF NOT EXISTS cityfarmac CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cityfarmac;

CREATE TABLE categorias (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(120) NOT NULL,
 categoria_padre_id INT UNSIGNED NULL,
 activo TINYINT(1) NOT NULL DEFAULT 1,
 -- Permite nombre repetido entre distintos padres, pero no dentro del mismo.
 padre_unicidad INT UNSIGNED GENERATED ALWAYS AS (COALESCE(categoria_padre_id,0)) STORED,
 CONSTRAINT uq_categoria_nombre_padre UNIQUE(nombre,padre_unicidad),
 CONSTRAINT fk_categoria_padre FOREIGN KEY(categoria_padre_id) REFERENCES categorias(id) ON DELETE RESTRICT ON UPDATE CASCADE,
 CONSTRAINT chk_categoria_no_autopadre CHECK(categoria_padre_id IS NULL OR categoria_padre_id <> id)
) ENGINE=InnoDB;
CREATE TABLE marcas (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(120) NOT NULL UNIQUE,
 activo TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;
CREATE TABLE productos (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(180) NOT NULL,
 descripcion TEXT NOT NULL,
 modelo VARCHAR(120) NOT NULL,
 precio DECIMAL(12,2) NOT NULL,
 imagen VARCHAR(255) NULL,
 destacado TINYINT(1) NOT NULL DEFAULT 0,
 activo TINYINT(1) NOT NULL DEFAULT 1,
 categoria_id INT UNSIGNED NOT NULL,
 marca_id INT UNSIGNED NOT NULL,
 CONSTRAINT chk_producto_precio CHECK(precio > 0),
 CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id) ON DELETE RESTRICT ON UPDATE CASCADE,
 CONSTRAINT fk_producto_marca FOREIGN KEY(marca_id) REFERENCES marcas(id) ON DELETE RESTRICT ON UPDATE CASCADE,
 INDEX idx_producto_visibilidad (activo,destacado,categoria_id,marca_id)
) ENGINE=InnoDB;
CREATE TABLE comentarios (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 producto_id INT UNSIGNED NOT NULL,
 email VARCHAR(254) NOT NULL,
 comentario TEXT NOT NULL,
 ranking TINYINT UNSIGNED NOT NULL,
 ip VARCHAR(45) NOT NULL,
 aprobado TINYINT(1) NOT NULL DEFAULT 0,
 fecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT chk_comentario_ranking CHECK(ranking BETWEEN 1 AND 5),
 CONSTRAINT fk_comentario_producto FOREIGN KEY(producto_id) REFERENCES productos(id) ON DELETE RESTRICT ON UPDATE CASCADE,
 INDEX idx_comentarios_producto_aprobado (producto_id,aprobado)
) ENGINE=InnoDB;


-- DATOS DE PRUEBA
USE cityfarmac;
-- Datos de prueba alineados con las marcas y productos del template original.
INSERT INTO categorias(id,nombre,categoria_padre_id,activo) VALUES (1,'Dermocosmética',NULL,1);
INSERT INTO categorias(id,nombre,categoria_padre_id,activo) VALUES (2,'Cuidado personal',NULL,1);
INSERT INTO categorias(id,nombre,categoria_padre_id,activo) VALUES (3,'Perfumería',NULL,1);
INSERT INTO categorias(id,nombre,categoria_padre_id,activo) VALUES (11,'Protección solar',1,1);
INSERT INTO categorias(id,nombre,categoria_padre_id,activo) VALUES (12,'Cuidado facial',1,1);
INSERT INTO categorias(id,nombre,categoria_padre_id,activo) VALUES (21,'Cabello',2,1);
INSERT INTO categorias(id,nombre,categoria_padre_id,activo) VALUES (22,'Cuerpo',2,1);
INSERT INTO categorias(id,nombre,categoria_padre_id,activo) VALUES (31,'Fragancias',3,1);
INSERT INTO categorias(id,nombre,categoria_padre_id,activo) VALUES (32,'Maquillaje',3,1);
INSERT INTO marcas(id,nombre,activo) VALUES (1,'Dermacare',1);
INSERT INTO marcas(id,nombre,activo) VALUES (2,'Hydra Lab',1);
INSERT INTO marcas(id,nombre,activo) VALUES (3,'Botánica',1);
INSERT INTO marcas(id,nombre,activo) VALUES (4,'Aura',1);
INSERT INTO marcas(id,nombre,activo) VALUES (5,'NaturaPlus',1);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (1,'Protector solar FPS 50','Producto de ejemplo CityFarmac: Protector solar FPS 50.','Presentación estándar',18900.00,'assets/img/products/solar.svg',1,1,11,1);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (2,'Crema hidratante facial','Producto de ejemplo CityFarmac: Crema hidratante facial.','Presentación estándar',12400.00,'assets/img/products/crema.svg',1,1,12,2);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (3,'Gel de limpieza suave','Producto de ejemplo CityFarmac: Gel de limpieza suave.','Presentación estándar',9800.00,'assets/img/products/gel.svg',1,1,12,1);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (4,'Shampoo reparación','Producto de ejemplo CityFarmac: Shampoo reparación.','Presentación estándar',7600.00,'assets/img/products/shampoo.svg',1,1,21,3);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (5,'Perfume floral 50 ml','Producto de ejemplo CityFarmac: Perfume floral 50 ml.','Presentación estándar',32500.00,'assets/img/products/perfume.svg',1,1,31,4);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (6,'Loción corporal','Producto de ejemplo CityFarmac: Loción corporal.','Presentación estándar',11200.00,'assets/img/products/locion.svg',1,1,22,2);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (7,'Acondicionador nutritivo','Producto de ejemplo CityFarmac: Acondicionador nutritivo.','Presentación estándar',8100.00,'assets/img/products/shampoo.svg',0,0,21,3);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (8,'Protector solar FPS 30','Producto de ejemplo CityFarmac: Protector solar FPS 30.','Presentación estándar',15900.00,'assets/img/products/solar.svg',0,1,11,1);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (9,'Sérum facial hidratante','Producto de ejemplo CityFarmac: Sérum facial hidratante.','Presentación estándar',17800.00,'assets/img/products/crema.svg',1,1,12,2);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (10,'Agua micelar','Producto de ejemplo CityFarmac: Agua micelar.','Presentación estándar',9300.00,'assets/img/products/gel.svg',0,1,12,1);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (11,'Shampoo cabello graso','Producto de ejemplo CityFarmac: Shampoo cabello graso.','Presentación estándar',8900.00,'assets/img/products/shampoo.svg',0,1,21,5);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (12,'Mascarilla capilar','Producto de ejemplo CityFarmac: Mascarilla capilar.','Presentación estándar',10900.00,'assets/img/products/crema.svg',0,1,21,3);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (13,'Gel de ducha suave','Producto de ejemplo CityFarmac: Gel de ducha suave.','Presentación estándar',6500.00,'assets/img/products/gel.svg',0,1,22,5);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (14,'Crema corporal nutritiva','Producto de ejemplo CityFarmac: Crema corporal nutritiva.','Presentación estándar',13200.00,'assets/img/products/locion.svg',0,1,22,2);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (15,'Perfume cítrico 100 ml','Producto de ejemplo CityFarmac: Perfume cítrico 100 ml.','Presentación estándar',38900.00,'assets/img/products/perfume.svg',1,1,31,4);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (16,'Colonia fresca','Producto de ejemplo CityFarmac: Colonia fresca.','Presentación estándar',20500.00,'assets/img/products/perfume.svg',0,0,31,5);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (17,'Base de maquillaje','Producto de ejemplo CityFarmac: Base de maquillaje.','Presentación estándar',19900.00,'assets/img/products/crema.svg',0,1,32,4);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (18,'Labial hidratante','Producto de ejemplo CityFarmac: Labial hidratante.','Presentación estándar',7900.00,'assets/img/products/crema.svg',0,1,32,5);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (19,'Protector solar infantil','Producto de ejemplo CityFarmac: Protector solar infantil.','Presentación estándar',21700.00,'assets/img/products/solar.svg',0,1,11,1);
INSERT INTO productos(id,nombre,descripcion,modelo,precio,imagen,destacado,activo,categoria_id,marca_id) VALUES (20,'Exfoliante facial','Producto de ejemplo CityFarmac: Exfoliante facial.','Presentación estándar',11500.00,'assets/img/products/gel.svg',0,0,12,2);
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (1,'cliente1@ejemplo.com','Muy buena textura y calidad.',5,'192.0.2.1',1,'2026-10-01 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (2,'cliente2@ejemplo.com','Cumple con lo esperado.',4,'192.0.2.2',1,'2026-10-02 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (3,'cliente3@ejemplo.com','Me gustó el resultado.',3,'192.0.2.3',0,'2026-10-03 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (4,'cliente4@ejemplo.com','Lo volvería a comprar.',5,'192.0.2.4',1,'2026-10-04 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (5,'cliente5@ejemplo.com','Buena relación precio y calidad.',4,'192.0.2.5',1,'2026-10-05 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (6,'cliente6@ejemplo.com','La presentación es práctica.',2,'192.0.2.6',0,'2026-10-06 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (7,'cliente7@ejemplo.com','Excelente para uso diario.',5,'192.0.2.7',1,'2026-10-07 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (8,'cliente8@ejemplo.com','El aroma es agradable.',4,'192.0.2.8',1,'2026-10-08 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (9,'cliente9@ejemplo.com','La experiencia fue positiva.',3,'192.0.2.9',0,'2026-10-09 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (10,'cliente10@ejemplo.com','Me pareció un producto correcto.',5,'192.0.2.10',1,'2026-10-10 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (11,'cliente11@ejemplo.com','Muy buena textura y calidad.',4,'192.0.2.11',1,'2026-10-11 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (12,'cliente12@ejemplo.com','Cumple con lo esperado.',2,'192.0.2.12',0,'2026-10-12 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (13,'cliente13@ejemplo.com','Me gustó el resultado.',5,'192.0.2.13',1,'2026-10-13 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (14,'cliente14@ejemplo.com','Lo volvería a comprar.',4,'192.0.2.14',1,'2026-10-14 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (15,'cliente15@ejemplo.com','Buena relación precio y calidad.',3,'192.0.2.15',0,'2026-10-15 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (16,'cliente16@ejemplo.com','La presentación es práctica.',5,'192.0.2.16',1,'2026-10-16 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (17,'cliente17@ejemplo.com','Excelente para uso diario.',4,'192.0.2.17',1,'2026-10-17 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (18,'cliente18@ejemplo.com','El aroma es agradable.',2,'192.0.2.18',0,'2026-10-18 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (19,'cliente19@ejemplo.com','La experiencia fue positiva.',5,'192.0.2.19',1,'2026-10-19 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (20,'cliente20@ejemplo.com','Me pareció un producto correcto.',4,'192.0.2.20',1,'2026-10-20 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (1,'cliente21@ejemplo.com','Muy buena textura y calidad.',3,'192.0.2.21',0,'2026-10-21 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (2,'cliente22@ejemplo.com','Cumple con lo esperado.',5,'192.0.2.22',1,'2026-10-22 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (3,'cliente23@ejemplo.com','Me gustó el resultado.',4,'192.0.2.23',1,'2026-10-23 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (4,'cliente24@ejemplo.com','Lo volvería a comprar.',2,'192.0.2.24',0,'2026-10-24 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (5,'cliente25@ejemplo.com','Buena relación precio y calidad.',5,'192.0.2.25',1,'2026-10-25 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (6,'cliente26@ejemplo.com','La presentación es práctica.',4,'192.0.2.26',1,'2026-10-26 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (7,'cliente27@ejemplo.com','Excelente para uso diario.',3,'192.0.2.27',0,'2026-10-27 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (8,'cliente28@ejemplo.com','El aroma es agradable.',5,'192.0.2.28',1,'2026-10-28 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (9,'cliente29@ejemplo.com','La experiencia fue positiva.',4,'192.0.2.29',1,'2026-10-01 12:00:00');
INSERT INTO comentarios(producto_id,email,comentario,ranking,ip,aprobado,fecha_creacion) VALUES (10,'cliente30@ejemplo.com','Me pareció un producto correcto.',2,'192.0.2.30',0,'2026-10-02 12:00:00');
