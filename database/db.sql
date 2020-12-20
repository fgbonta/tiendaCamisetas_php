CREATE DATABASE IF NOT EXISTS master_php;
USE master_php;

CREATE TABLE IF NOT EXISTS usuarios(
	id 			int(255) auto_increment not null,
	nombre		varchar(100) not null,
	apellidos	varchar(100) not null,
	email		varchar(100) not null,
	password	varchar(100) not null,
	rol			varchar(100) not null,
	imagen		varchar(100),
	CONSTRAINT pk_usuarios PRIMARY KEY(id),
	CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS categorias(
	id 			int(255) auto_increment not null,
	nombre		varchar(100) not null,	
	CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS productos(
	id 				int(255) auto_increment not null,
	categoria_id	int(255) not null,
	nombre			varchar(100) not null,
	descripcion		varchar(100) not null,
	precio			float(100,2) not null,
	stock			int(255) not null,
	oferta			varchar(2) not null,
	fecha			date not null,
	imagen			varchar(100) not null,
	CONSTRAINT pk_productos PRIMARY KEY(id),
	CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS pedidos(
	id 				int(255) auto_increment not null,
	usuario_id		int(255) not null,
	provincia		varchar(100) not null,
	localidad		varchar(100) not null,
	direccion		varchar(100) not null,
	coste			float(200,2) not null,
	estado			varchar(100) not null,
	fecha			date not null,
	hora			time not null,
	CONSTRAINT pk_pedidos PRIMARY KEY(id),
	CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS lineas_pedidos(
	id 				int(255) auto_increment not null,
	pedido_id		int(255) not null,
	producto_id		int(255) not null,
	unidades		int(255) not null,	
	CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
	CONSTRAINT fk_lineaPedido_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
	CONSTRAINT fk_lineaPedido_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=InnoDb;

INSERT INTO usuarios VALUES(null,'admin','admin','admin@admin.com','123456','admin',null);
INSERT INTO categorias VALUES(null,'manga corta');
INSERT INTO categorias VALUES(null,'sudaderas');
INSERT INTO categorias VALUES(null,'manga larga');