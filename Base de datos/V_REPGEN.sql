CREATE VIEW V_REPGEN
AS 
SELECT
	concat(replace(right(concat('0000',CAST(a.IdVehiculos AS CHAR)),2),'0',trim(' ')),' - ',a.Marca,' - ',a.placa) AS VehiculoAsig
	, concat(replace(right(concat('0000',CAST(c.idconductor AS CHAR)),2),'0',trim(' ')),' - ',c.NomConducto,' ',c.ApeConducto) AS conductorasig
	, concat(replace(right(concat('0000',CAST(f.idElemento AS CHAR)),2),'0',trim(' ')),' - ',f.NomElemen) AS Elemtrans
	, concat(replace(right(concat('0000',CAST(d.idruta AS CHAR)),2),'0',trim(' ')),' - ',d.NomRuta) AS ruta
	, e.CantCarga
	, floor(f.Costo/d.Distancia*800000) AS valcarga
FROM 
	Vehiculos AS a
INNER JOIN 
	RutaAuto AS b
ON 
	a.IdVehiculos=b.IdVehiculos
INNER JOIN
	conductor AS c
ON 
	c.idconductor=b.idconductor
INNER JOIN 
	RUTA AS d
ON 
	d.idruta=b.idruta
INNER JOIN 
	histCarga AS e
ON 
	e.idRutaAuto=b.idRutaAuto
INNER JOIN
	Elementos AS f
ON 
	f.idElemento=e.idElemento