<?php
class RptRepVehi{

    public $ConexaRptRepGen;
    public function ImpDataVehi($comandoSQl)
    {
        // Conecto mi database
        //include_once '../Controlador/CtrlDataBas.php';
        //$ctrlcom= new CtrlDataBas();
        
        // llamo a la conexion realizada en sgl_conex
        require_once '../Modelo/Sgl_conex.php';
        $dbcon1= Sgl_conex::Getinstance();
        $dbconexe1=$dbcon1->abreconex(); 
        
        $stmt = $dbconexe1->prepare($comandoSQl);
        // Especificamos el fetch mode antes de llamar a fetch()
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos
        $stmt->execute();
        // Mostramos los resultados

        echo '<table id="datatable" border="1" class="table table-bordered dataTable">'
      .'<tr>'
      .'<th>Vehiculo</th>'
      .'<th>placa</th>'
      .'<th>Manifesto de Carga</th>'
      .'<th>Seguro</th>'
      .'<th>SOAT</th>'
      .'<th>Tarjeta Operacion</th>'
      .'<th>Tecnico Mecanica</th>'
      .'</tr>';
        
        while ($row = $stmt->fetch())
        {
                echo '<tr>'
                . '<td>'
                . $row['Vehiculo']
                . '</td>'
                . '<td>'
                . $row['placa']
                . '</td>'
                . '<td>'
                . $row['ManifestoCarga']
                . '</td>'
                . '<td>'
                . $row['Seguro']
                . '</td>'
                . '<td>'
                . $row['SOAT']
                . '</td>'
                . '<td>'
                . $row['TarjetaOperacion']
                . '</td>'
                . '<td>'
                . $row['TecnicoMecanica']
                . '</td>'
                . '</tr>';
        }          
        echo '</table>';
        
    }
}
?>