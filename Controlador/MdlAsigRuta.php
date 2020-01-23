<?php


class MdlAsigRuta {

    public function GuardaAsigRuta($CmbTipoId,$txtnumdoc,$txtnomcon,$txtapecon,$CmbTipoLic)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        //include_once '../Controlador/CtrlDataBas.php';
        //$ctrlcom= new CtrlDataBas();
        
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Modelo/CtrlConex.php';
        $ctrlcom= new CtrlConex();
        
        $paramenvia="'$CmbTipoId','$txtnumdoc','$txtnomcon','$txtapecon','$CmbTipoLic'";
        // realizo la insercion del elemento
        $ctrlcom->CallPA("PA_INS_ASIGRUT", $paramenvia);
        

        if($ctrlcom->notifError=="Afirmativo")
        {
            echo '<div id="dialog" title="Atencion">';
            echo '<p>'
            . 'El registro fue guardado satisfactoriamente.'
            . '</p>';
            echo '</div>';
        }
        else
        {
            echo '<div id="dialog" title="Atencion">';
            echo '<p>'
            . 'Ha ocurrido un error-> '.$ctrlcom->notifError
            . '</p>';
            echo '</div>';
        }        
    }
    
}
