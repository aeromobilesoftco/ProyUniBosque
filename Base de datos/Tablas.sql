CREATE DATABASE testunibosque;
USE testunibosque;

-- Elementos base ruta
CREATE TABLE RUTA
(
	idruta INT NOT NULL auto_increment
	, NomRuta VARCHAR(1000)
	, Distancia DOUBLE 
	, Activa INT 
	, IDEdoRutaVia INT 
	, PRIMARY KEY (idruta)
);

CREATE TABLE EdoRutaVia
(
	IDEdoRutaVia INT NOT NULL auto_increment
	, NomEdoRuta VARCHAR(50)
	, PRIMARY KEY (IDEdoRutaVia)
);

-- base ruta

--  Elementos Vehiculos
CREATE TABLE Vehiculos
(
	IdVehiculos INT NOT NULL AUTO_INCREMENT 
	, idTipoVehi INT
	, Marca VARCHAR(1000)
	, CapacidadCarga DOUBLE 
	, Placa VARCHAR(7)
	, PRIMARY KEY(IdVehiculos)
);

CREATE TABLE DocuVehiculo
(
	idDocuVehiculo INT NOT NULL AUTO_INCREMENT
	, IdVehiculos INT
	, SOAT VARCHAR(2)
	, TecnicoMecanica VARCHAR(2)
	, TarjetaOperacion VARCHAR(2)
	, ManifestoCarga VARCHAR(2)
	, Seguro VARCHAR(2)
	, PRIMARY KEY (idDocuVehiculo) 
);
-- Vehiculos

-- Conductor
CREATE TABLE conductor
(
	idconductor INT NOT NULL AUTO_INCREMENT 
	, NomConducto VARCHAR(500)
	, ApeConducto VARCHAR(500)
	, TipoId INT 
	, NumId VARCHAR(20)
	, TipoLic INT 
	, NumeroLic VARCHAR(20)
	, Telefono VARCHAR(10)
	, PRIMARY KEY(idconductor)
);

-- Conductor

-- Elementos

CREATE TABLE Elementos
(
	idElemento INT NOT NULL AUTO_INCREMENT
	, NomElemen VARCHAR(500)
	, Costo DOUBLE 
	, TipoPeso VARCHAR (20)
	, PRIMARY KEY (idElemento)
);

-- Elementos

-- Tabla de hechos para indicar el historial  de los elementos
CREATE TABLE RutaAuto
(
	idRutaAuto INT NOT NULL AUTO_INCREMENT 
	, idruta INT 
	, IdVehiculos INT 
	, FechaRuta DATETIME 
	, idconductor INT 
	, PRIMARY KEY (idRutaAuto)
);

CREATE TABLE histCarga
(
	idIDEdoRutaVia INT NOT NULL AUTO_INCREMENT 
	, idRutaAuto INT 
	, idElemento INT 
	, CantCarga INT 
	, PRIMARY KEY(idIDEdoRutaVia)
);

-- tablas de parametrizacion
CREATE TABLE TipoId
(
	idTipoId INT NOT NULL auto_increment
	, NomTipoId VARCHAR(100)
	, PRIMARY KEY (idTipoId)
);

CREATE TABLE TipoLic
(
	idTipoLic INT NOT NULL auto_increment
	, NomTipoLic VARCHAR(100)
	, PRIMARY KEY (idTipoLic)
);

-- Tipo de Vehiculos
CREATE TABLE TipoVehi
(
	idTipoVehi INT NOT NULL auto_increment
	, NomTipoVehi VARCHAR(500)
	, PRIMARY KEY (idTipoVehi)
);

-- valores de parametrizacion tabla NomTipoId
INSERT INTO tipoid (NomTipoId)
VALUES ('Cedula de ciudadania');

INSERT INTO tipoid (NomTipoId)
VALUES ('Cedula de extranjeria');

INSERT INTO tipoid (NomTipoId)
VALUES ('NIT');

-- valores de parametrizacion NomTipoLic
INSERT INTO tipolic (NomTipoLic)
VALUES ('2da Categoria');

INSERT INTO tipolic (NomTipoLic)
VALUES ('3ra Categoria');

INSERT INTO tipolic (NomTipoLic)
VALUES ('1ra Categoria');

-- Valores de parametrizacion 
INSERT INTO tipovehi (NomTipoVehi)
VALUES ('Tractomula');

INSERT INTO tipovehi (NomTipoVehi)
VALUES ('Furgon');

INSERT INTO tipovehi (NomTipoVehi)
VALUES ('Camioneta');

-- estado via

INSERT INTO edorutavia (NomEdoRuta)
VALUES ('Inhabilitada');

INSERT INTO edorutavia (NomEdoRuta)
VALUES ('Habilitada');




