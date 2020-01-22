<?php

class MdlElements {
    //put your code here

    public function GuardaElemento($TxtEleme,$txtcoste,$CmbTipopeso)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlDataBas.php';
        $ctrlcom= new CtrlDataBas();
        
        $paramenvia="'$TxtEleme',$txtcoste,'$CmbTipopeso'";
        // realizo la insercion del elemento
        $ctrlcom->insercion("Elementos", "NomElemen,Costo,TipoPeso", $paramenvia);
        

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
