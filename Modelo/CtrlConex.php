<?php
        
class CtrlConex {
    
public $LineaCon;
public $resultado;
public $ComandoSQL;
public $Zelda;
public $notifError;
public $rescount;

        
    public function CargaCombos($nomtab,$filtro,$condi,$paramcondi)
    {

        // llamo a la conexion realizada en sgl_conex
        require_once 'Sgl_conex.php';
        $dbcon1= Sgl_conex::Getinstance();
        $dbconexe1=$dbcon1->abreconex(); 
        
        //$nomtab= nombre de la tabla
        //$filtro= indica el campo que va a mostrar el combo
        //$condi= indica la condicion en caso de haberla
        
        if($condi=='1')
        {
            // Verifico si tiene filtro o no. en caso de tenerlo agrego el where a la consulta de lo contrario se trae todo
           
                $stmt = $dbconexe1->prepare("SELECT ".$filtro." as paramres FROM ".$nomtab." WHERE ".$paramcondi);
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt->execute();
                // Mostramos los resultados
                while ($row = $stmt->fetch()){
                    echo "<option>".$row["paramres"]."</option>";
                }                
        }
        else
        {
            // verifico si la conexion esta disponible
            if(!is_null($dbconexe1))
            {

                $stmt = $dbconexe1->prepare("SELECT ".$filtro." as paramres FROM ".$nomtab);
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt->execute();
                // Mostramos los resultados
                while ($row = $stmt->fetch()){
                    echo "<option>".$row["paramres"]."</option>";
                }                
            }
            else
            {
                $dbcon1->cierrcon();
                $this->notifError='Negativo';
                return false;
            }
        }
        
    }

    public function SelCounter($NomCounter)
    {
        // llamo a la conexion realizada en sgl_conex
        require_once 'Sgl_conex.php';
        $dbcon1= Sgl_conex::Getinstance();
        $dbconexe1=$dbcon1->abreconex(); 
        
        // verifico si la conexion esta disponible
        if(!is_null($dbconexe1))
        {
            $stmt = $dbconexe1->query('SELECT * FROM '.$NomCounter);
            $row_count = $stmt->rowCount();
            $this->rescount=$row_count;
        }
        else
        {
            $dbcon1->cierrcon();
            $this->notifError='Negativo';
	    return false;
        }
         
    }

    public function insercion($nomtabla,$tabvalues,$regit)
    {
        
        // llamo a la conexion realizada en sgl_conex
        require_once 'Sgl_conex.php';
        $dbcon1= Sgl_conex::Getinstance();
        $dbconexe1=$dbcon1->abreconex(); 
        
        // verifico si la conexion esta disponible
        if(!is_null($dbconexe1))
        {
            $stmt = $dbconexe1->prepare("insert into ".$nomtabla." (".$tabvalues.") values (".$regit.")");
            $stmt->execute();
            $this->notifError="Afirmativo";
        }
        else
        {
            $dbcon1->cierrcon();
            $this->notifError='Negativo';
	    return false;
        }        
        
    }

    public function CallPA($NomPa,$ParamsPA)
    {
        // llamo a la conexion realizada en sgl_conex
        require_once 'Sgl_conex.php';
        $dbcon1= Sgl_conex::Getinstance();
        $dbconexe1=$dbcon1->abreconex(); 
        
        // verifico si la conexion esta disponible
        if(!is_null($dbconexe1))
        {
            $stmt = $dbconexe1->prepare("CALL $NomPa (".$ParamsPA.")");
            $stmt->execute();
                while ($row = $stmt->fetch()){
                    
                    if(!is_null($row["valerror"]))
                    {
                        $this->notifError=$row["valerror"];
                    }
                    else
                    {
                       $this->notifError="Afirmativo"; 
                    }
                    
                }
        }
        else
        {
            $dbcon1->cierrcon();
            $this->notifError='Negativo';
	    return false;
        }          
    }

    public function ImpRepGen($CmbSelVeh,$CmbSelRut)
    {
        // llamo a la conexion realizada en sgl_conex
        require_once 'Sgl_conex.php';
        $dbcon1= Sgl_conex::Getinstance();
        $dbconexe1=$dbcon1->abreconex(); 
        
        // direccion de los reportes
	include '../Controlador/WbsRpt/RptRepGen.php';
	$ClsRepDeu=new RptRepGen();
        
            // verifico si la conexion esta disponible
            if(!is_null($dbconexe1))
            {

                //$stmt = $dbconexe1->prepare(
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
                
                
                // Almaceno la consulta
                $stmt = $dbconexe1->prepare($this->ComandoSQL);
                
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt->execute();
                
                // Mostramos los resultados
                
                // Verifico si la consulta devuelve resultados
                if($stmt->rowCount()>=1)
                {
                    $ClsRepDeu->ImpDataVehi($this->ComandoSQL);
                }
                else
                {
                    $this->notifError='Negativo';                    
                }
                return false;                            
            }
            else
            {
                $dbcon1->cierrcon();
                $this->notifError='Negativo';
                return false;
            }        
    }

        public function ImpRepGenVehi($CmbSelVeh)
        {
        // llamo a la conexion realizada en sgl_conex
        require_once 'Sgl_conex.php';
        $dbcon1= Sgl_conex::Getinstance();
        $dbconexe1=$dbcon1->abreconex(); 
        
        // direccion de los reportes
	include '../Controlador/WbsRpt/RptRepVehi.php';
	$ClsRepDeu=new RptRepVehi();
        
            // verifico si la conexion esta disponible
            if(!is_null($dbconexe1))
            {

                //$stmt = $dbconexe1->prepare(
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
                
                
                // Almaceno la consulta
                $stmt = $dbconexe1->prepare($this->ComandoSQL);
                
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt->execute();
                
                // Mostramos los resultados
                
                // Verifico si la consulta devuelve resultados
                if($stmt->rowCount()>=1)
                {
                    $ClsRepDeu->ImpDataVehi($this->ComandoSQL);
                }
                else
                {
                    $this->notifError='Negativo';                    
                }
                return false;                            
            }
            else
            {
                $dbcon1->cierrcon();
                $this->notifError='Negativo';
                return false;
            }             
        }
    
}

?>
