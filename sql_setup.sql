CREATE TABLE equipos (
	ID INT PRIMARY KEY AUTO_INCREMENT,
	nombre NVARCHAR(30) NOT NULL,
	color NVARCHAR(30) NOT NULL
);

INSERT INTO equipos(nombre,color) VALUES 
	("Valor","Rojo"),
	("Instinct","Amarillo"),
	("Mystic","Azul");
