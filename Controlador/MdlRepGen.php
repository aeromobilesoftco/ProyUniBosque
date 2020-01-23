<?php

class MdlRepGen {
    //put your code here
    public function ImpRepGen($CmbSelVeh,$CmbSelRut)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        //include_once '../Controlador/CtrlDataBas.php';
        //$ctrlcom= new CtrlDataBas();
        
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Modelo/CtrlConex.php';
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
            $this->resva=$ctrlcom->notifError;
            
        }        
    }

    public function ImpRepGenVehi($CmbSelVeh)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        //include_once '../Controlador/CtrlDataBas.php';
        //$ctrlcom= new CtrlDataBas();
        
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Modelo/CtrlConex.php';
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
            //$this->resva=$ctrlcom->notifError;
            
        }        
    }
}
?>