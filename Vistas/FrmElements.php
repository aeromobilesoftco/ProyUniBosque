<?php
    include_once './MasterPage/Header.php';
    
    include_once '../Controlador/MdlComand.php';
    $MdlCom= new MdlComand();

    include_once '../Controlador/MdlElements.php';
    $MdlElemi= new MdlElements();
    
?>

    <div id="content-wrapper">
        <h1>
            Elementos de carga
        </h1>
        
        <!--
            Creo tab para mostrar el menu
        -->

<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Nuevo elemento</a></li>
  </ul>
  <div id="tabs-1">
      <p>
      <form action="FrmElements.php" method="post">
        <table>
            <tr>
                <td>
                    Elemento:
                </td>
                <td>
                    <input id="TxtEleme" name="TxtEleme" type="text" maxlength="100" required="">
                </td>
            </tr>
            <tr>
                <td>
                    Costo (en pesos):
                </td>
                <td>
                    <input id="txtcoste" name="txtcoste" type="number" maxlength="4" min="1" max="99999999" required>
                </td>
            </tr>
            <tr>
                <td>
                    Tipo de peso:
                </td>
                <td>
                    <select name="CmbTipopeso" id="CmbTipopeso">
                        <option>Metro (M)</option>
                        <option>Kilo (KG)</option>
                        <option>Tonelada (TN)</option>
                    </select> 
                </td>                
            </tr>
        </table>
        
        <INPUT TYPE="submit" NAME="BtnGuardar" VALUE="Guardar">
        <?php
            
        error_reporting(E_ALL ^ E_NOTICE);

        $TxtEleme=$_POST['TxtEleme'];
        $txtcoste=$_POST['txtcoste'];
        $CmbTipopeso=$_POST['CmbTipopeso'];
        
        if (isset($_POST['BtnGuardar']))
        {
            $MdlElemi->GuardaElemento($TxtEleme, $txtcoste, $CmbTipopeso);
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

