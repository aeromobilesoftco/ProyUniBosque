<?php
    include_once './MasterPage/Header.php';
    
    include_once '../Controlador/MdlComand.php';
    $MdlCom= new MdlComand();

    include_once '../Controlador/MdlVehi.php';
    $MdlVehicu=new MdlVehi();
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
                <td>
                    SOAT:
                </td>
                <td>
                    <select name="CmbSoat" id="CmbSoat">
                      <option>Si</option>
                      <option>No</option>
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
                <td>
                    Revision Tecnico Mecanica:
                </td>
                <td>
                    <select name="CmbTecnoMec" id="CmbTecnoMec">
                      <option>Si</option>
                      <option>No</option>
                    </select>                    
                </td>
            </tr>
            <tr>
                <td>
                    Capacidad de carga:
                </td>
                <td>
                    <input id="txtcapcarga" name="txtcapcarga" type="number" maxlength="4" min="100" max="1000" required>
                </td>
                <td>
                    Tarjeta Operacion:
                </td>
                <td>
                    <select name="CmbTarOpe" id="CmbTarOpe">
                      <option>Si</option>
                      <option>No</option>
                    </select>                    
                </td>
            </tr>
            <tr>
                <td>
                    Placa:
                </td>
                <td>
                    <input id="txtplaca" name="txtplaca" maxlength="7" type="text"  required>
                </td>
                <td>
                    Manifiesto de carga:
                </td>
                <td>
                    <select name="CmbMancar" id="CmbMancar">
                      <option>Si</option>
                      <option>No</option>
                    </select>                    
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                    
                </td>
                <td>
                    Seguro:
                </td>
                <td>
                    <select name="CmbSegu" id="CmbSegu">
                      <option>Si</option>
                      <option>No</option>
                    </select>                    
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
        
        // Documentacion
        $CmbSoat=$_POST['CmbSoat'];
        $CmbTecnoMec=$_POST['CmbTecnoMec'];
        $CmbTarOpe=$_POST['CmbTarOpe'];
        $CmbMancar=$_POST['CmbMancar'];
        $CmbSegu=$_POST['CmbSegu'];
        
        if (isset($_POST['BtnGuardar']))
        {
            $MdlVehicu->GuardaVehi($CmbTipVehi, $txtmarca, $txtcapcarga, $txtplaca,$CmbSoat,$CmbTecnoMec,$CmbTarOpe,$CmbMancar,$CmbSegu);
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

