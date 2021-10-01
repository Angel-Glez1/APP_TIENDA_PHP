CREATE DATABASE tienda_master;
USE tienda_master;

-- Tabla Usuarios
CREATE TABLE usuarios(
    id         INT AUTO_INCREMENT NOT NULL,
    nombre     VARCHAR(200) NOT NULL,
    apellidos  VARCHAR(200) NOT NULL,
    email      VARCHAR(200) NOT NULL,
    password   VARCHAR(200) NOT NULL,
    rol        VARCHAR(200),
    imagen     VARCHAR(200),

    CONSTRAINT pk_usuario PRIMARY KEY (id),
    CONSTRAINT uk_emel UNIQUE (email)
)ENGINE=InnoDb;
INSERT INTO usuarios VALUES(NULL,'angel', 'alcaraz', 'admi@admi.com','12345','admi',null);



--Tabla Categorias    
CREATE TABLE categorias(
    id         INT AUTO_INCREMENT NOT NULL,
    nombre     VARCHAR(200) NOT NULL,
   
    CONSTRAINT pk_categoria PRIMARY KEY (id)

)ENGINE=InnoDb;

INSERT INTO categorias VALUES (NULL,'Manga corta');
INSERT INTO categorias VALUES (NULL,'Tirantes');
INSERT INTO categorias VALUES (NULL,'Manga Larga');
INSERT INTO categorias VALUES (NULL,'Sudaderas');


-- Table the Productos
CREATE TABLE productos(
    id              INT AUTO_INCREMENT NOT NULL,
    categoria_id    INT NOT NULL,
    nombre          VARCHAR(200) NOT NULL,
    descripcion     text,
    precio          FLOAT(100,2) NOT NULL,
    stock           INT(255) NOT NULL,
    oferta          VARCHAR (2),
    fecha           date not null,
    imagen          VARCHAR(200), 

    CONSTRAINT pk_producto PRIMARY KEY (id),
    CONSTRAINT pf_cateforia FOREIGN KEY (categoria_id) REFERENCES categorias(id) 
)ENGINE=InnoDb;


CREATE TABLE pedidos(
    id              INT AUTO_INCREMENT NOT NULL,
    usuario_id      INT NOT NULL,
    provincia       VARCHAR(200) NOT NULL,   
    localidad       VARCHAR(200) NOT NULL,
    direccion       VARCHAR(200) NOT NULL,
    coste           FLOAT(100,2) NOT NULL,
    estado          VARCHAR(200) NOT NULL,
    fecha           date,
    hora            time,

    CONSTRAINT pk_pedidos PRIMARY KEY (id),
    CONSTRAINT pf_pedidos FOREIGN KEY (usuario_id) REFERENCES usuarios(id) 
)ENGINE=InnoDb;

CREATE TABLE lineapedidos(

    id              INT AUTO_INCREMENT NOT NULL,
    pedido_id       INT NOT NULL,
    producto_id     INT NOT NULL,

    CONSTRAINT pk_linea_pedidos PRIMARY KEY (id),
    CONSTRAINT pf_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    CONSTRAINT pf_producto FOREIGN KEY (producto_id) REFERENCES productos(id) 
)ENGINE=InnoDb;

