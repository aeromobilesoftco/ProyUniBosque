<?php


class MdlRuta {
    //put your code here
    public function guardaruta($Txtnomru,$TxtDisru,$CmbSelOP,$CmbEdoVia)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        //include_once '../Controlador/CtrlDataBas.php';
        //$ctrlcom= new CtrlDataBas();
        
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlConex.php';
        $ctrlcom= new CtrlConex();
        
        $paramenvia="'$Txtnomru',".$TxtDisru.",1,cast(LEFT('".$CmbEdoVia."',1)as char)";
        
        // realizo la insercion del elemento
        $ctrlcom->insercion("RUTA", "NomRuta,Distancia,Activa,IDEdoRutaVia", $paramenvia);
        

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

?>