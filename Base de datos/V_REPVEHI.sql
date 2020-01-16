CREATE VIEW V_REPVEHI
AS 
SELECT
	concat(replace(right(concat('0000',CAST(a.IdVehiculos AS CHAR)),2),'0',trim(' ')),' - ',a.Marca) AS Vehiculo
	, a.placa
	, b.ManifestoCarga
	, b.Seguro
	, b.SOAT
	, b.TarjetaOperacion
	, b.TecnicoMecanica
FROM 
	vehiculos AS a
INNER JOIN 
	docuvehiculo AS b
ON
	a.IdVehiculos=b.IdVehiculos