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
                
                echo "SELECT ".$filtro." FROM ".$nomtab;
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
    
}

?>