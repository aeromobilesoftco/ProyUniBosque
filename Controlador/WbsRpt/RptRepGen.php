<?php
class RptRepGen{

    public $ConexaRptRepGen;
    public function ImpDataVehi($comandoSQl)
    {

        // Conecto mi database
        include_once '../Controlador/CtrlDataBas.php';
        $ctrlcom= new CtrlDataBas();
        
        $ctrlcom->conectar();
        
        
        $ConexaRptRepGen= new mysqli ($ctrlcom->servidor,$ctrlcom->usuario,$ctrlcom->password,$ctrlcom->basedatos);

        if($this->resultado = mysqli_query($ctrlcom->LineaCon,$comandoSQl,MYSQLI_USE_RESULT))
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
}
?>