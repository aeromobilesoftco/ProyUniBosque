<?php
    include_once './MasterPage/Header.php';
    
    include_once '../Controlador/MdlComand.php';
    $MdlCom= new MdlComand();
    
    include_once '../Controlador/MdlAsigRuta.php';
    $MdlAsiru= new MdlAsigRuta();    
?>

    <div id="content-wrapper">
        <h1>
            Creacion de rutas personalizado
        </h1>
        
        <!--
            Creo tab para mostrar el menu
        -->

<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Asignar ruta</a></li>
  </ul>
  <div id="tabs-1">
      <p>
      <form action="FrmAsigRuta.php" method="post">
          <table>
              <tr>
                  <td>
                      Seleccione Ruta:
                  </td>
                  <td>
                    <select name="CmbSelRut" id="CmbSelRut">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer los tipo s de documento
                        $MdlCom->cargacombo("5", null);
                        ?>
                    </select>                       
                  </td>
              </tr>
              <tr>
                  <td>
                      Seleccione Vehiculo:
                  </td>
                  <td>
                    <select name="CmbSelVeh" id="CmbSelVeh">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer los tipo s de documento
                        $MdlCom->cargacombo("6", null);
                        ?>
                    </select>                       
                  </td>
              </tr>
              <tr>
                  <td>
                      Seleccione Conductor:
                  </td>
                  <td>
                    <select name="CmbSelCond" id="CmbSelCond">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer los tipo s de documento
                        $MdlCom->cargacombo("7", null);
                        ?>
                    </select>                       
                  </td>
              </tr>
              <tr>
                  <td>
                      Seleccione Tipo de carga:
                  </td>
                  <td>
                    <select name="CmbTipCar" id="CmbTipCar">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer los tipo s de documento
                        $MdlCom->cargacombo("8", null);
                        ?>
                    </select>                       
                  </td>
              </tr>
              <tr>
                  <td>
                      Cantidad cargada:
                  </td>
                  <td>
                    <input id="TxtCantCar" name="txtcoste" type="number" maxlength="4" min="1" max="1000" required>                     
                  </td>
              </tr>
          </table>
        <INPUT TYPE="submit" NAME="BtnGuardar" VALUE="Guardar">
        <?php
            
        error_reporting(E_ALL ^ E_NOTICE);

        $CmbTipoId=$_POST['CmbSelRut'];
        $txtnumdoc=$_POST['CmbSelVeh'];
        $txtnomcon=$_POST['CmbSelCond'];
        $txtapecon=$_POST['CmbTipCar'];
        $CmbTipoLic=$_POST['txtcoste'];
        
        if (isset($_POST['BtnGuardar']))
        {
            $MdlAsiru->GuardaAsigRuta($CmbTipoId,$txtnumdoc,$txtnomcon,$txtapecon,$CmbTipoLic);
        }
        
        ?>
      </form>
      </p>
  </div>

</div>
        
    </div>

<?php
    include_once './MasterPage/Footer.php';
?>