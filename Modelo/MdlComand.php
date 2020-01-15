<?php
class MdlComand 
{
    public function cargacombo($opt,$parampost)
    {
        
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlDataBas.php';
        
        $ctrlcom= new CtrlDataBas();
        
        
        // Opcion  1 Carga sucursal
        
        if($opt=='1')
        {
            $ctrlcom->CargaCombos("edorutavia", "concat(CAST(IDEdoRutaVia AS char),' - ',NomEdoRuta)", null, null);
        }
    }
    
    public function guardaruta($Txtnomru,$TxtDisru,$CmbSelOP,$CmbEdoVia)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlDataBas.php';
        $ctrlcom= new CtrlDataBas();
        
        $paramenvia="'$Txtnomru',".$TxtDisru.",1,cast(LEFT('".$CmbEdoVia."',1)as int)";
        
        // realizo la insercion del elemento
        $ctrlcom->insercion("ruta", "NomRuta,Distancia,Activa,IDEdoRutaVia", $paramenvia);
        

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