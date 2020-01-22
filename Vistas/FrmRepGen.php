<?php
    include_once './MasterPage/Header.php';
    
    include_once '../Modelo/MdlComand.php';
    $MdlCom= new MdlComand();

    include_once '../Modelo/MdlRepGen.php';
    $MdlRepge= new MdlRepGen();
    
?>

    <div id="content-wrapper">
        <h1>
            Reporte general
        </h1>
        
        <!--
            Creo tab para mostrar el menu
        -->

<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Reporte detallado</a></li>
    <li><a href="#tabs-2">Documentos Vehiculos</a></li>
  </ul>
  <div id="tabs-1">
      <p>
      <form action="FrmRepGen.php" method="post">
          <table>
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
                      Seleccionar Ruta:
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
          </table>
        <INPUT TYPE="submit" NAME="BtnGuardar" VALUE="Imprimir">
        <?php
            
        error_reporting(E_ALL ^ E_NOTICE);

        $CmbSelVeh=$_POST['CmbSelVeh'];
        $CmbSelRut=$_POST['CmbSelRut'];
        
        if (isset($_POST['BtnGuardar']))
        {
            $MdlRepge->ImpRepGen($CmbSelVeh, $CmbSelRut);
        }
        
        ?>
        
      </form>
      </p>
  </div>

    <!-- Documentos Vehiculos-->
    <div id="tabs-2">
      <p>
      <form action="FrmRepGen.php" method="post">
        <table>
              <tr>
                  <td>
                      Seleccione Vehiculo:
                  </td>
                  <td>
                    <select name="CmbSelVeh1" id="CmbSelVeh1">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer los tipo s de documento
                        $MdlCom->cargacombo("9", null);
                        ?>
                    </select>                       
                  </td>
              </tr>
        </table>
        <INPUT TYPE="submit" NAME="BtnGuardarVehi" VALUE="Imprimir">
        <?php
            
        error_reporting(E_ALL ^ E_NOTICE);

        $CmbSelVeh=$_POST['CmbSelVeh1'];
        
        if (isset($_POST['BtnGuardarVehi']))
        {
            $MdlRepge->ImpRepGenVehi($CmbSelVeh);
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