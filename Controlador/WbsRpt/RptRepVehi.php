<?php
class RptRepVehi{

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
}
?>