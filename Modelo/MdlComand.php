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
        
        // Tipo de documentos
        if($opt=='2')
        {
            $ctrlcom->CargaCombos("tipoid", "concat(CAST(idTipoId AS CHAR), ' - ',NomTipoId)", null, null);
        }

        // Tipo de licencias
        if($opt=='3')
        {
            $ctrlcom->CargaCombos("tipolic", "concat(CAST(idTipoLic AS CHAR), ' - ',NomTipoLic)", null, null);
        }

        // Tipo de Vehiculos
        if($opt=='4')
        {
            $ctrlcom->CargaCombos("TipoVehi", "concat(CAST(idTipoVehi AS CHAR),' - ',NomTipoVehi)", null, null);
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

    public function GuardaCondu($CmbTipoId,$txtnumdoc,$txtnomcon,$txtapecon,$CmbTipoLic,$txtnumlic,$TxtTel)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlDataBas.php';
        $ctrlcom= new CtrlDataBas();
        
        $paramenvia="'$txtnomcon','$txtapecon',cast(LEFT('".$CmbTipoId."',1)as int),'$txtnumdoc',cast(LEFT('".$CmbTipoLic."',1)as int),'$txtnumlic','$TxtTel'";
        
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

    public function GuardaVehi($CmbTipVehi,$txtmarca,$txtcapcarga,$txtplaca)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlDataBas.php';
        $ctrlcom= new CtrlDataBas();
        
        $paramenvia="cast(LEFT('".$CmbTipVehi."',1)as int),'$txtmarca',$txtcapcarga,'$txtplaca'";
        // realizo la insercion del elemento
        $ctrlcom->insercion("vehiculos", "idTipoVehi,Marca,CapacidadCarga,Placa", $paramenvia);
        

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
    public function GuardaElemento($TxtEleme,$txtcoste,$CmbTipopeso)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlDataBas.php';
        $ctrlcom= new CtrlDataBas();
        
        $paramenvia="'$TxtEleme',$txtcoste,'$CmbTipopeso'";
        // realizo la insercion del elemento
        $ctrlcom->insercion("elementos", "NomElemen,Costo,TipoPeso", $paramenvia);
        

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