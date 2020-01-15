<?php
    include_once './MasterPage/Header.php';
    
    include_once '../Modelo/MdlComand.php';
    
    $MdlCom= new MdlComand();
?>

    <div id="content-wrapper">
        <h1>
            Creacion de Conductor
        </h1>
        
        <!--
            Creo tab para mostrar el menu
        -->

<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Nueva Conductor</a></li>
  </ul>
  <div id="tabs-1">
      <p>
      <form action="FrmConduct.php" method="post">
          <table>
              <tr>
                  <td>
                      Docuemento:
                  </td>
                  <td>
                    <select name="CmbTipoId" id="CmbTipoId">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer los tipo s de documento
                        $MdlCom->cargacombo("2", null);
                        ?>
                    </select>                      
                  </td>
              </tr>
              <tr>
                  <td>
                      Numero de documento:
                  </td>
                  <td>
                      <input id="txtnumdoc" name="txtnumdoc" type="text" required minlength="1" maxlength="10">
                  </td>
              </tr>
              <tr>
                  <td>
                      Nombre:
                  </td>
                  <td>
                      <input id="txtnomcon" name="txtnomcon" type="text" required maxlength="500">
                  </td>
              </tr>
              <tr>
                  <td>
                      Apellidos:
                  </td>
                  <td>
                      <input id="txtapecon" name="txtapecon" type="text" required maxlength="500">
                  </td>
              </tr>
              <tr>
                  <td>
                      Tipo Licencia:
                  </td>
                  <td>
                    <select name="CmbTipoLic" id="CmbTipoLic">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer los tipo s de documento
                        $MdlCom->cargacombo("3", null);
                        ?>
                    </select> 
                  </td>
              </tr>
              <tr>
                  <td>
                      Numero de licencia:
                  </td>
                  <td>
                    <input id="txtnumlic" name="txtnumlic" type="number" required minlength="1" maxlength="10">
                  </td>
              </tr>
              <tr>
                  <td>
                      Telefono:
                  </td>
                  <td>
                    <input id="TxtTel" name="TxtTel" type="tel" required maxlength="10">
                  </td>
              </tr>
          </table>
        <INPUT TYPE="submit" NAME="BtnGuardar" VALUE="Guardar">
        <?php
            
        error_reporting(E_ALL ^ E_NOTICE);

        $CmbTipoId=$_POST['CmbTipoId'];
        $txtnumdoc=$_POST['txtnumdoc'];
        $txtnomcon=$_POST['txtnomcon'];
        $txtapecon=$_POST['txtapecon'];
        $CmbTipoLic=$_POST['CmbTipoLic'];
        $txtnumlic=$_POST['txtnumlic'];
        $TxtTel=$_POST['TxtTel'];
        
        if (isset($_POST['BtnGuardar']))
        {
            $MdlCom->GuardaCondu($CmbTipoId, $txtnumdoc, $txtnomcon, $txtapecon, $CmbTipoLic, $txtnumlic, $TxtTel);
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