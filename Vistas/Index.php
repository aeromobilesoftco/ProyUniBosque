<?php
    include_once './MasterPage/Header.php';
    include_once '../Modelo/MdlComand.php';
    
    $MdlCom= new MdlComand();
?>

    <div id="content-wrapper">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Menu Principal</a>
          </li>
          <li class="breadcrumb-item active">Inicio</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer el estado de la via
                        $MdlCom->cargacombo("10", "vehiculos");
                        echo 'Tienes '.$MdlCom->resva.' Vehiculos';
                        ?>
                </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="../Vistas/FrmVehi.php">
                <span class="float-left">Ir a Vehiculos</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer el estado de la via
                        $MdlCom->cargacombo("10", "ruta");
                        echo 'Tienes '.$MdlCom->resva.' Rutas';
                        ?>
                </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="../Vistas/FrmRuta.php">
                <span class="float-left">Ir a rutas</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer el estado de la via
                        $MdlCom->cargacombo("10", "elementos");
                        echo 'Tienes '.$MdlCom->resva.' Tipos de carga';
                        ?>
                </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="../Vistas/FrmElements.php">
                <span class="float-left">Ir a tipos de carga</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">
                        <?php
                            // Llamo a la funcion del modelo carga combo para traer el estado de la via
                        $MdlCom->cargacombo("10", "conductor");
                        echo 'Tienes '.$MdlCom->resva.' conductores';
                        ?>
                </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Ir Conductores</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        
    </div>

<?php
    include_once './MasterPage/Footer.php';
?>

