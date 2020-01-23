<?php


class MdlVehi {

    public function GuardaVehi($CmbTipVehi,$txtmarca,$txtcapcarga,$txtplaca,$CmbSoat,$CmbTecnoMec,$CmbTarOpe,$CmbMancar,$CmbSegu)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        //include_once '../Controlador/CtrlDataBas.php';
        //$ctrlcom= new CtrlDataBas();
        
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Modelo/CtrlConex.php';
        $ctrlcom= new CtrlConex();
        
        $paramenvia="cast(LEFT('".$CmbTipVehi."',1)as char),'$txtmarca',$txtcapcarga,'$txtplaca','$CmbSoat','$CmbTecnoMec','$CmbTarOpe','$CmbMancar','$CmbSegu'";
        // realizo la insercion del elemento
        $ctrlcom->CallPA("PA_INS_VEHI", $paramenvia);
        

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
            . 'Atencion-> '.$ctrlcom->notifError
            . '</p>';
            echo '</div>';
        }
    }
    
}

?>