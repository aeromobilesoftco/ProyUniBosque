<?php
class MdlComand 
{
    public $resva;
    
    public function cargacombo($opt,$parampost)
    {
        
        // Esta funcion estara encargada de cargar los combos de manera dinamica
        include_once '../Modelo/CtrlConex.php';
        $ctrlcom= new CtrlConex();
        
        switch ($opt)
        {
            // Opcion  1 Carga sucursal
            case 1:
            $ctrlcom->CargaCombos("EdoRutaVia", "concat(replace(right(concat('0000',CAST(IDEdoRutaVia AS CHAR)),2),'0',trim(' ')),' - ',NomEdoRuta)", null, null);
            break;
            
            // Tipo de documentos
            case 2:
            $ctrlcom->CargaCombos("TipoId", "concat(replace(right(concat('0000',CAST(idTipoId AS CHAR)),2),'0',trim(' ')),' - ',NomTipoId)", null, null);
            break;   
        
            // Tipo de licencias
            case 3:
            $ctrlcom->CargaCombos("TipoLic", "concat(replace(right(concat('0000',CAST(idTipoLic AS CHAR)),2),'0',trim(' ')),' - ',NomTipoLic)", null, null);
            break;    

            // Tipo de licencias
            case 4:
            $ctrlcom->CargaCombos("TipoVehi", "concat(replace(right(concat('0000',CAST(idTipoVehi AS CHAR)),2),'0',trim(' ')),' - ',NomTipoVehi) ", null, null);
            break; 

            // Rutas
            case 5:
            $ctrlcom->CargaCombos("RUTA", "concat(replace(right(concat('0000',CAST(idruta AS CHAR)),2),'0',trim(' ')),' - ',NomRuta)", 1, "Activa=1");
            break; 

            // Vehiculos
            case 6:
            $ctrlcom->CargaCombos("Vehiculos", "concat(replace(right(concat('0000',CAST(IdVehiculos AS CHAR)),2),'0',trim(' ')),' - ',Marca,' - ',placa)",null, null);
            break; 

            // Conductor
            case 7:
            $ctrlcom->CargaCombos("conductor", "concat(replace(right(concat('0000',CAST(idconductor AS CHAR)),2),'0',trim(' ')),' - ',NomConducto,' ',ApeConducto)",null, null);
            break; 

            // Elementos
            case 8:
            $ctrlcom->CargaCombos("Elementos", "concat(replace(right(concat('0000',CAST(idElemento AS CHAR)),2),'0',trim(' ')),' - ',NomElemen)", null, null);
            break; 

            // Vehiculos sin placa
            case 9:
            $ctrlcom->CargaCombos("Vehiculos", "concat(replace(right(concat('0000',CAST(IdVehiculos AS CHAR)),2),'0',trim(' ')),' - ',Marca)", null, null);
            break; 

            // Contador vehiculos
            case 10:
            $ctrlcom->SelCounter($parampost);
            $this->resva=$ctrlcom->rescount;
            break; 
        
        }
    }
    
}
?>