<?php
    include_once './MasterPage/Header.php';
    
    include_once '../Modelo/MdlComand.php';
    
    $MdlCom= new MdlComand();
?>

    <div id="content-wrapper">
        <h1>
            Vehiculos
        </h1>
        
        <!--
            Creo tab para mostrar el menu
        -->

<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Nuevo Vehiculo</a></li>
  </ul>
  <div id="tabs-1">
      <p>
      <form action="FrmVehi.php" method="post">
        <table>
            <tr>
                <td>
                    Tipo de Vehiculo
                </td>
                <td>
                    <select name="CmbTipVehi" id="CmbTipVehi">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer los tipo s de documento
                        $MdlCom->cargacombo("4", null);
                        ?>
                    </select>                     
                </td>
            </tr>
            <tr>
                <td>
                    Marca:                    
                </td>
                <td>
                    <input id="txtmarca" name="txtmarca" type="text" maxlength="100" required="">
                </td>
            </tr>
            <tr>
                <td>
                    Capacidad de carga:
                </td>
                <td>
                    <input id="txtcapcarga" name="txtcapcarga" type="number" maxlength="4" min="100" max="1000" required>
                </td>
            </tr>
            <tr>
                <td>
                    Placa:
                </td>
                <td>
                    <input id="txtplaca" name="txtplaca" maxlength="7" type="text"  required>
                </td>
            </tr>
        </table>
        
        <INPUT TYPE="submit" NAME="BtnGuardar" VALUE="Guardar">
        <?php
            
        error_reporting(E_ALL ^ E_NOTICE);

        $CmbTipVehi=$_POST['CmbTipVehi'];
        $txtmarca=$_POST['txtmarca'];
        $txtcapcarga=$_POST['txtcapcarga'];
        $txtplaca=$_POST['txtplaca'];
        
        if (isset($_POST['BtnGuardar']))
        {
            $MdlCom->GuardaVehi($CmbTipVehi, $txtmarca, $txtcapcarga, $txtplaca);
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

