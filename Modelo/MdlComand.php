<?php
class MdlComand 
{
    public $resva;
    
    public function cargacombo($opt,$parampost)
    {
        
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlDataBas.php';
        
        $ctrlcom= new CtrlDataBas();
        
        
        // Opcion  1 Carga sucursal
        
        if($opt=='1')
        {
            $ctrlcom->CargaCombos("edorutavia", "concat(replace(right(concat('0000',CAST(IDEdoRutaVia AS CHAR)),2),'0',trim(' ')),' - ',NomEdoRuta)", null, null);
        }
        
        // Tipo de documentos
        if($opt=='2')
        {
            $ctrlcom->CargaCombos("tipoid", "concat(replace(right(concat('0000',CAST(idTipoId AS CHAR)),2),'0',trim(' ')),' - ',NomTipoId)", null, null);
        }

        // Tipo de licencias
        if($opt=='3')
        {
            $ctrlcom->CargaCombos("tipolic", "concat(replace(right(concat('0000',CAST(idTipoLic AS CHAR)),2),'0',trim(' ')),' - ',NomTipoLic)", null, null);
        }

        // Tipo de Vehiculos
        if($opt=='4')
        {
            $ctrlcom->CargaCombos("TipoVehi", "concat(replace(right(concat('0000',CAST(idTipoVehi AS CHAR)),2),'0',trim(' ')),' - ',NomTipoVehi) ", null, null);
        }

        // Rutas
        if($opt=='5')
        {
            $ctrlcom->CargaCombos("ruta", "concat(replace(right(concat('0000',CAST(idruta AS CHAR)),2),'0',trim(' ')),' - ',NomRuta)", 1, "Activa=1");
        }

        // Vehiculos
        if($opt=='6')
        {
            $ctrlcom->CargaCombos("vehiculos", "concat(replace(right(concat('0000',CAST(IdVehiculos AS CHAR)),2),'0',trim(' ')),' - ',Marca,' - ',placa)", null, null);
        }

        // Conductor
        if($opt=='7')
        {
            $ctrlcom->CargaCombos("conductor", "concat(replace(right(concat('0000',CAST(idconductor AS CHAR)),2),'0',trim(' ')),' - ',NomConducto,' ',ApeConducto)", null, null);
        }

        // Elementos
        if($opt=='8')
        {
            $ctrlcom->CargaCombos("elementos", "concat(replace(right(concat('0000',CAST(idElemento AS CHAR)),2),'0',trim(' ')),' - ',NomElemen)", null, null);
        }  
        // Vehiculos sin placa
        if($opt=='9')
        {
            $ctrlcom->CargaCombos("vehiculos", "concat(replace(right(concat('0000',CAST(IdVehiculos AS CHAR)),2),'0',trim(' ')),' - ',Marca)", null, null);
        }
        
        // Contador vehiculos
        if($opt=='10')
        {
            $ctrlcom->SelCounter($parampost);
            $this->resva=$ctrlcom->rescount;
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

    public function GuardaVehi($CmbTipVehi,$txtmarca,$txtcapcarga,$txtplaca,$CmbSoat,$CmbTecnoMec,$CmbTarOpe,$CmbMancar,$CmbSegu)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlDataBas.php';
        $ctrlcom= new CtrlDataBas();
        
        $paramenvia="cast(LEFT('".$CmbTipVehi."',1)as int),'$txtmarca',$txtcapcarga,'$txtplaca','$CmbSoat','$CmbTecnoMec','$CmbTarOpe','$CmbMancar','$CmbSegu'";
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
    
    public function GuardaAsigRuta($CmbTipoId,$txtnumdoc,$txtnomcon,$txtapecon,$CmbTipoLic)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlDataBas.php';
        $ctrlcom= new CtrlDataBas();
        
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

    public function ImpRepGen($CmbSelVeh,$CmbSelRut)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlDataBas.php';
        $ctrlcom= new CtrlDataBas();
        
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
            //$this->resva=$ctrlcom->notifError;
            
        }        
    }

        public function ImpRepGenVehi($CmbSelVeh)
    {
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Controlador/CtrlDataBas.php';
        $ctrlcom= new CtrlDataBas();
        
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