<?php


class MdlConduct {
    //put your code here
    public function GuardaCondu($CmbTipoId,$txtnumdoc,$txtnomcon,$txtapecon,$CmbTipoLic,$txtnumlic,$TxtTel)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlDataBas.php';
        $ctrlcom= new CtrlDataBas();
        
        $paramenvia="'$txtnomcon','$txtapecon',cast(LEFT('".$CmbTipoId."',1)as char),'$txtnumdoc',cast(LEFT('".$CmbTipoLic."',1)as char),'$txtnumlic','$TxtTel'";
        
        // realizo la insercion del elemento
        $ctrlcom->insercion("conductor", "NomConducto,ApeConducto,TipoId,NumId,TipoLic,NumeroLic,Telefono", $paramenvia);
        

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