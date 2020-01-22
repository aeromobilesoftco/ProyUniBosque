<?php
    include_once './MasterPage/Header.php';
    
    include_once '../Modelo/MdlComand.php';
    $MdlCom= new MdlComand();

    include_once '../Modelo/MdlRuta.php';
    $MdlRut= new MdlComand();    
    
?>

    <div id="content-wrapper">
        <h1>
            Creacion de ruta
        </h1>
        
        <!--
            Creo tab para mostrar el menu
        -->

<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Nueva Ruta</a></li>
  </ul>
  <div id="tabs-1">
      <p>
      <form action="FrmRuta.php" method="post">
        <table>
            <tr>
                <td>
                    Nombre de la ruta
                </td>
                <td>
                    <input type="text" id="Txtnomru" name="Txtnomru" required="Debe digitar un nombre de ruta">
                </td>
            </tr>
            <tr>
                <td>
                    Distacia ruta:
                </td>
                <td>
                    <input type="Number" id="TxtDisru" name="TxtDisru" required="Debe escribir una cantidad numerica">
                </td>
            </tr>
            <tr>
                <td>
                    Activa:
                </td>
                <td>
                    <select name="CmbSelOP" id="CmbSelOP">
                      <option>Si</option>
                      <option>No</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Estado de la ruta:
                </td>
                <td>
                    <select name="CmbEdoVia" id="CmbEdoVia">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer el estado de la via
                        $MdlCom->cargacombo("1", null);
                        ?>
                    </select>
                </td>
            </tr> 
        </table>
        
        <INPUT TYPE="submit" NAME="BtnGuardar" VALUE="Guardar">
        <?php
            
        error_reporting(E_ALL ^ E_NOTICE);

        $Txtnomru=$_POST['Txtnomru'];
        $TxtDisru=$_POST['TxtDisru'];
        $CmbSelOP=$_POST['CmbSelOP'];
        $CmbEdoVia=$_POST['CmbEdoVia'];
        
        if (isset($_POST['BtnGuardar']))
        {
            $MdlRut->guardaruta($Txtnomru, $TxtDisru, $CmbSelOP, $CmbEdoVia);
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

