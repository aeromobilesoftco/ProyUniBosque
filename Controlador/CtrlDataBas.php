<?php

class CtrlDataBas 
{
public $servidor;
public $usuario;
public $password;
public $basedatos;
public $LineaCon;
public $resultado;
public $ComandoSQL;
public $Zelda;
public $notifError;
public $rescount;

    public function conectar()
    { 

        $this->servidor="localhost";
        $this->usuario="aeromobi_leon";
        $this->password="nanobreaker/123";
        $this->basedatos="aeromobi_testunibosque";
        
        $this->LineaCon= new mysqli($this->servidor, $this->usuario,$this->password,$this->basedatos);
        
        if ($this->LineaCon)
        {
            //echo 'Si hay conexion. ';
        }
        else 
        {
            echo 'esta bien ' .$this->LineaCon->connect_error;
        }
    }
    
    public function CargaCombos($nomtab,$filtro,$condi,$paramcondi)
    {
        $datocombo=array();
        
        // Funcion e parametros
        
        //$nomtab= nombre de la tabla
        //$filtro= indica el campo que va a mostrar el combo
        //$condi= indica la condicion en caso de haberla
        
        if($condi=='1')
        {
            echo "1";
            // Verifico si tiene filtro o no. en caso de tenerlo agrego el where a la consulta de lo contrario se trae todo
            $this->conectar();
            $this->ComandoSQL="SELECT ".$filtro." FROM ".$nomtab." WHERE ".$paramcondi;
            if($this->resultado = mysqli_query($this->LineaCon,$this->ComandoSQL,MYSQLI_USE_RESULT))
            {

                while($this->Zelda=$this->resultado->fetch_array(MYSQLI_ASSOC))
                {

                    //$datocombo[] = array($filtro => $this->Zelda[$filtro]);
                    echo "<option>".$this->Zelda[$filtro]."</option>";
                }            
            }
            else 
            {
                echo 'error '.  $this->LineaCon->error;
            }


            $this->LineaCon->close();             
        }
        else
        {
            // Verifico si tiene filtro o no. en caso de tenerlo agrego el where a la consulta de lo contrario se trae todo
            $this->conectar();
            $this->ComandoSQL="SELECT ".$filtro." as paramres FROM ".$nomtab;
            if($this->resultado = mysqli_query($this->LineaCon,$this->ComandoSQL,MYSQLI_USE_RESULT))
            {

                while($this->Zelda=$this->resultado->fetch_array(MYSQLI_ASSOC))
                {

                    //$datocombo[] = array($filtro => $this->Zelda[$filtro]);
                    echo "<option>".$this->Zelda['paramres']."</option>";
                }     
                
            }
            else 
            {
                echo 'error '.  $this->LineaCon->error;
            }


            $this->LineaCon->close();              
        }
        
    }
    
    public function insercion($nomtabla,$tabvalues,$regit)
    {
        $this->conectar();
        $this->ComandoSQL="insert into ".$nomtabla." (".$tabvalues.") values (".$regit.")";
        if($this->resultado = mysqli_query($this->LineaCon,$this->ComandoSQL,MYSQLI_USE_RESULT))
        { 
            $this->notifError="Afirmativo";
	    return true;		
        }
        else
        {                
	    $this->notifError='error '.  $this->LineaCon->error;
            return false;	
        }
        $this->LineaCon->close();        
    }
    
    public function CallPA($NomPa,$ParamsPA)
    {
        $this->conectar();
        $this->ComandoSQL="CALL $NomPa (".$ParamsPA.")";

        if($this->resultado = mysqli_query($this->LineaCon,$this->ComandoSQL,MYSQLI_USE_RESULT))
        { 
            
                while($this->Zelda=$this->resultado->fetch_array(MYSQLI_ASSOC))
                {
                    
                    if($this->notifError=null || $this->notifError='')
                    {
                        $this->notifError="Afirmativo";
                    }
                    else
                    {
                        $this->notifError=$this->Zelda['valerror'];
                    }
                }  
                
	    return true;		
        }
        else
        {                
	    $this->notifError='error '.  $this->LineaCon->error;
            return false;	
        }
        $this->LineaCon->close();           
    }

    
    public function ImpRepGen($CmbSelVeh,$CmbSelRut)
    {

	include 'WbsRpt/RptRepGen.php';
	$ClsRepDeu=new RptRepGen();	
        
        $this->conectar();
        $this->ComandoSQL="SELECT
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
and 
        concat(replace(right(concat('0000',CAST(a.IdVehiculos AS CHAR)),2),'0',trim(' ')),' - ',a.Marca,' - ',a.placa)='$CmbSelVeh'
and 
    concat(replace(right(concat('0000',CAST(d.idruta AS CHAR)),2),'0',trim(' ')),' - ',d.NomRuta)='$CmbSelRut'";
        if($this->resultado = mysqli_query($this->LineaCon,$this->ComandoSQL,MYSQLI_USE_RESULT))
        {   
           // Genero reporte
            $ClsRepDeu->ImpDataVehi($this->ComandoSQL);

            $this->notifError='Afirmativo';
	    return true;
                
        }
        else
        {       
            echo 'error '.  $this->LineaCon->error;
	        return false;	
        }
        $this->LineaCon->close(); 
         
    }

    public function ImpRepGenVehi($CmbSelVeh)
    {

	include 'WbsRpt/RptRepVehi.php';
	$ClsRepDeuVehi=new RptRepVehi();	
	
        $this->conectar();
        $this->ComandoSQL="SELECT
	concat(replace(right(concat('0000',CAST(a.IdVehiculos AS CHAR)),2),'0',trim(' ')),' - ',a.Marca) AS Vehiculo
	, a.placa
	, b.ManifestoCarga
	, b.Seguro
	, b.SOAT
	, b.TarjetaOperacion
	, b.TecnicoMecanica
FROM 
	Vehiculos AS a
INNER JOIN 
	DocuVehiculo AS b
ON
	a.IdVehiculos=b.IdVehiculos
where 
concat(replace(right(concat('0000',CAST(a.IdVehiculos AS CHAR)),2),'0',trim(' ')),' - ',a.Marca)='$CmbSelVeh'";


        if($this->resultado = mysqli_query($this->LineaCon,$this->ComandoSQL,MYSQLI_USE_RESULT))
        {   
           // Genero reporte
            $ClsRepDeuVehi->ImpDataVehi($this->ComandoSQL);

            $this->notifError='Afirmativo';
	    return true;
                
        }
        else
        {       
            echo 'error '.  $this->LineaCon->error;
	        return false;	
        }
        $this->LineaCon->close(); 
         
         
    }
    
    public function SelCounter($NomCounter)
    {
    	$datosu =array();
        $this->conectar();
        $this->ComandoSQL="SELECT COUNT(*) as valcon FROM ".$NomCounter;
        if($this->resultado = mysqli_query($this->LineaCon,$this->ComandoSQL,MYSQLI_USE_RESULT))
        {   

            while($this->Zelda=$this->resultado->fetch_array(MYSQLI_ASSOC))
            {
                $this->rescount=$this->Zelda['valcon'];
            }   
            $this->notifError='Afirmativo';
	        return true;	
        }
        else
        {       
                $this->notifError='Negativo';
	        return false;	
        }
        $this->LineaCon->close(); 
         
    }    
}

?>