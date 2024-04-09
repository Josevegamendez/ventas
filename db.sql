-- Tabla Cliente

CREATE TABLE Cliente (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  identificacion VARCHAR(20) NOT NULL,
  apellidos VARCHAR(255) NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  correo VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

-- Tabla Productos

CREATE TABLE Productos (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT NOT NULL,
  precio DECIMAL(10,2) NOT NULL,
  impuestos DECIMAL(10,2) NOT NULL,
  unidades INT NOT NULL,
  PRIMARY KEY (id)
);

-- Tabla Pedidos

CREATE TABLE Pedidos (
  id INT NOT NULL AUTO_INCREMENT,
  fecha_pedido DATETIME NOT NULL,
  direccion VARCHAR(255) NOT NULL,
  codigo_postal VARCHAR(10) NOT NULL,
  estado VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

-- Tabla DetallesPedido

CREATE TABLE DetallesPedido (
  id INT NOT NULL AUTO_INCREMENT,
  cliente_id INT NOT NULL,
  producto_id INT NOT NULL,
  pedido_id INT NOT NULL,
  cantidad INT NOT NULL,
  nota TEXT,
  PRIMARY KEY (id),
  FOREIGN KEY (cliente_id) REFERENCES Cliente(id),
  FOREIGN KEY (producto_id) REFERENCES Productos(id),
  FOREIGN KEY (pedido_id) REFERENCES Pedidos(id)
);
