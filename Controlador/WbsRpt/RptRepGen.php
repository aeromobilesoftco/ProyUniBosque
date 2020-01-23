<?php
class RptRepGen{

    public $ConexaRptRepGen;
    public function ImpDataVehi($comandoSQl)
    {
        // Conecto mi database
        //include_once '../Controlador/CtrlDataBas.php';
        //$ctrlcom= new CtrlDataBas();
        
        // llamo a la conexion realizada en sgl_conex
        require_once '../Controlador/Sgl_conex.php';
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
        .'<th>Vehiculo Asignado</th>'
        .'<th>Conductor</th>'
        .'<th>Elemento cargado</th>'
        .'<th>Ruta</th>'
        .'<th>Cantidad cargada</th>'
        .'<th>Costo de Envio</th>'
        .'</tr>';
        while ($row = $stmt->fetch())
        {
                echo '<tr>'
                . '<td>'
                . $row['VehiculoAsig']
                . '</td>'
                . '<td>'
                . $row['conductorasig']
                . '</td>'
                . '<td>'
                . $row['Elemtrans']
                . '</td>'
                . '<td>'
                . $row['ruta']
                . '</td>'
                . '<td>'
                . $row['CantCarga']
                . '</td>'
                . '<td type="number">'
                . $row['valcarga']
                . '</td>'
                . '</tr>';
        }          
        echo '</table>';
        
    }
}
?>