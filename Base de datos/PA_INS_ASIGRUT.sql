CREATE PROCEDURE PA_INS_ASIGRUT(IN selrut VARCHAR(100),IN selveh VARCHAR(100),IN selcond VARCHAR(100),IN selcarga VARCHAR(100), IN cantcarga DOUBLE)
BEGIN 

-- Verifico los ID de los elementos para cargar en la tabla ruta auto
SELECT
    idruta
INTO 
	@neuruta
FROM 
	RUTA
WHERE 
	concat(replace(right(concat('0000',CAST(idruta AS CHAR)),2),'0',trim(' ')),' - ',NomRuta)=selrut;

SELECT
	IdVehiculos
INTO 
	@neutipoveh
FROM 
	Vehiculos
WHERE 
	 concat(replace(right(concat('0000',CAST(IdVehiculos AS CHAR)),2),'0',trim(' ')),' - ',Marca,' - ',placa)=selveh;

SELECT
	idconductor
INTO 
	@neuconductor
FROM 
	conductor
WHERE
	concat(replace(right(concat('0000',CAST(idconductor AS CHAR)),2),'0',trim(' ')),' - ',NomConducto,' ',ApeConducto)=selcond;
	
SELECT
	idElemento
INTO 
	@neuelem
FROM 
	Elementos
WHERE 
	concat(replace(right(concat('0000',CAST(idElemento AS CHAR)),2),'0',trim(' ')),' - ',NomElemen)=selcarga;

-- Verifico si la documentacion esta al dia
SELECT
	ifnull(MAX(idDocuVehiculo),0)
INTO 
	@codvehicu
FROM
	DocuVehiculo
WHERE 
	ManifestoCarga='Si'
AND 
	SOAT='Si'
AND 
	TecnicoMecanica='Si'
AND 
	Seguro='Si'
AND 
	TarjetaOperacion='Si'
AND 
	IdVehiculos=@neutipoveh;
	

IF(@codvehicu=0 OR @codvehicu IS NULL) THEN 
 	
 	SELECT 'Este vehiculo no puede movilizarse ya que su documentacion no esta completa' AS valerror;
 	
ELSE
	
	-- Busco si el vehiculo ya tiene ruta asiganda para el dia actual
	-- En caso de que si la tenga. no ingreso el registro en ruta auto pero si en histcarga para registrar el elemento que carga
	 
	SELECT 
		ifnull(MAX(idRutaAuto),0)
	INTO 
		@neurutaauto
	FROM 
		RutaAuto
	WHERE
		idruta=@neuruta
	AND 
		idconductor=@neuconductor
	AND
		IdVehiculos=@neutipoveh;
	
	-- Realizo la validacion dependiendo del resultado
	IF(@neurutaauto IS NULL OR @neurutaauto=0)   THEN 
	
		-- Inserto el registro dentro de la tabla
		INSERT INTO RutaAuto (idruta,IdVehiculos,FechaRuta,idconductor)
		VALUES (@neuruta,@neutipoveh,now(),@neuconductor);
		
		-- Consulto cual fue el id generado para
		SELECT 
			ifnull(MAX(idRutaAuto),0)
		INTO 
			@neurutaauto1
		FROM 
			RutaAuto
		WHERE
			idruta=@neuruta
		AND 
			idconductor=@neuconductor
		AND
			IdVehiculos=@neutipoveh;
		
		-- hago el registro en histcarga
		INSERT INTO histCarga (idRutaAuto,idElemento,CantCarga)
		VALUES(@neurutaauto1,@neuelem,cantcarga);
		
		SELECT 'Este vehiculo ya tiene ruta asignada pero se le cargo elementos para transportar' AS valerror;
		
	ELSE
		-- En caso de que ya tenga algo solo ingreso el elemento	 
		INSERT INTO histCarga (idRutaAuto,idElemento,CantCarga)
		VALUES(@neurutaauto,@neuelem,cantcarga); 
			
	END IF; 
END IF;

END