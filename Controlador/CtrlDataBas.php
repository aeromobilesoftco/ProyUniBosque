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
        $this->usuario="root";
        $this->password="";
        $this->basedatos="TESTUNIBOSQUE";
        
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
    	$datosu =array();
        $this->conectar();
        $this->ComandoSQL="select VehiculoAsig,conductorasig,Elemtrans,ruta,CantCarga,valcarga from V_REPGEN WHERE VehiculoAsig = '".$CmbSelVeh. "' and ruta='".$CmbSelRut."'";
        if($this->resultado = mysqli_query($this->LineaCon,$this->ComandoSQL,MYSQLI_USE_RESULT))
        {   
echo '<table border="1">'
      .'<tr>'
      .'<th>Vehiculo Asignado</th>'
      .'<th>Conductor</th>'
      .'<th>Elemento cargado</th>'
      .'<th>Ruta</th>'
      .'<th>Cantidad cargada</th>'
      .'<th>Costo de Envio</th>'
      .'</tr>';

            while($this->Zelda=$this->resultado->fetch_array(MYSQLI_ASSOC))
            {
                echo '<tr>'
                . '<td>'
                . $this->Zelda['VehiculoAsig']
                . '</td>'
                . '<td>'
                . $this->Zelda['conductorasig']
                . '</td>'
                . '<td>'
                . $this->Zelda['Elemtrans']
                . '</td>'
                . '<td>'
                . $this->Zelda['ruta']
                . '</td>'
                . '<td>'
                . $this->Zelda['CantCarga']
                . '</td>'
                . '<td type="number">'
                . $this->Zelda['valcarga']
                . '</td>'
                . '</tr>';
            }    
            echo '</table>';
	        return true;	
        }
        else
        {       
                $this->notifError='Negativo';
	        return false;	
        }
        $this->LineaCon->close(); 
         
    }

    public function ImpRepGenVehi($CmbSelVeh)
    {
    	$datosu =array();
        $this->conectar();
        $this->ComandoSQL="select Vehiculo,placa,ManifestoCarga,Seguro,SOAT,TarjetaOperacion,TecnicoMecanica from V_REPVEHI WHERE Vehiculo = '".$CmbSelVeh. "'";
        if($this->resultado = mysqli_query($this->LineaCon,$this->ComandoSQL,MYSQLI_USE_RESULT))
        {   
echo '<table border="1">'
      .'<tr>'
      .'<th>Vehiculo</th>'
      .'<th>placa</th>'
      .'<th>Manifesto de Carga</th>'
      .'<th>Seguro</th>'
      .'<th>SOAT</th>'
      .'<th>Tarjeta Operacion</th>'
      .'<th>Tecnico Mecanica</th>'
      .'</tr>';

            while($this->Zelda=$this->resultado->fetch_array(MYSQLI_ASSOC))
            {
                echo '<tr>'
                . '<td>'
                . $this->Zelda['Vehiculo']
                . '</td>'
                . '<td>'
                . $this->Zelda['placa']
                . '</td>'
                . '<td>'
                . $this->Zelda['ManifestoCarga']
                . '</td>'
                . '<td>'
                . $this->Zelda['Seguro']
                . '</td>'
                . '<td>'
                . $this->Zelda['SOAT']
                . '</td>'
                . '<td>'
                . $this->Zelda['TarjetaOperacion']
                . '</td>'
                . '<td>'
                . $this->Zelda['TecnicoMecanica']
                . '</td>'
                . '</tr>';
            }    
            echo '</table>';
	        return true;	
        }
        else
        {       
                $this->notifError='Negativo';
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