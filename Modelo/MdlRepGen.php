<?php

class MdlRepGen {
    //put your code here
    public function ImpRepGen($CmbSelVeh,$CmbSelRut)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        //include_once '../Controlador/CtrlDataBas.php';
        //$ctrlcom= new CtrlDataBas();
        
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlConex.php';
        $ctrlcom= new CtrlConex();
        
        // realizo la insercion del elemento
        $ctrlcom->ImpRepGen($CmbSelVeh, $CmbSelRut);

        if($ctrlcom->notifError=="Negativo")
        {
            echo '<div id="dialog" title="Atencion">';
            echo '<p>'
            . 'No hay registros para mostrar.'
            . '</p>';
            echo '</div>';
        }
        else
        {
            echo '<div id="dialog" title="Atencion">';
            echo '<p>'
            . 'El reporte se ha impreso en la pestaña de reporte detallado.'
            . '</p>';
            echo '</div>';
            
        }        
    }

    public function ImpRepGenVehi($CmbSelVeh)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        //include_once '../Controlador/CtrlDataBas.php';
        //$ctrlcom= new CtrlDataBas();
        
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlConex.php';
        $ctrlcom= new CtrlConex();
        
        // realizo la insercion del elemento
        $ctrlcom->ImpRepGenVehi($CmbSelVeh);

        if($ctrlcom->notifError=="Negativo")
        {
            echo '<div id="dialog" title="Atencion">';
            echo '<p>'
            . 'No hay registros para mostrar.'
            . '</p>';
            echo '</div>';
        }
        else
        {
            echo '<div id="dialog" title="Atencion">';
            echo '<p>'
            . 'El reporte se ha impreso en la pestaña de reporte de vehiculos.'
            . '</p>';
            echo '</div>';
            
        }        
    }
}
?>