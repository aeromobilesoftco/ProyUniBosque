
CREATE  PROCEDURE `PA_INS_VEHI`(IN `TipoVehi` INT, IN `Marca` VARCHAR(1000), IN `capacarga` DOUBLE, IN `placa1` VARCHAR(7), IN `soat` VARCHAR(2), IN `Tecnomec` VARCHAR(2), IN `tarop` VARCHAR(2), IN `Mancar` VARCHAR(2), IN `segu` VARCHAR(2))
BEGIN 

-- Registro los datos en la tabla de vehiculos

INSERT INTO vehiculos (idTipoVehi,Marca,CapacidadCarga,Placa)
VALUES (TipoVehi,Marca,capacarga,placa1);

-- Una vez guardado, consulto el id con el que quedo el vehiculo

SELECT 
	IdVehiculos 
INTO 
	@CodeVehi
FROM 
	vehiculos
WHERE 
	Placa=placa1;

-- Inserto la documentacion del vehiculo
INSERT INTO docuvehiculo (IdVehiculos,SOAT,TecnicoMecanica,TarjetaOperacion,ManifestoCarga,Seguro)
VALUES (@CodeVehi,soat,Tecnomec,tarop,Mancar,segu);

-- Envio respuesta
SELECT 'Afirmativo' AS valerror;

END