<?php 
 include("../../config/conexion.php");
 include("../../config/conexion1.php");

if (!isset($_SESSION["idusuarios"])) {
  header("Location: http://localhost/SistemaAtencion/Acceso/");
}
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$iduser=$_SESSION["idusuarios"];
$foto=$_SESSION["foto"];
$dni=$_SESSION["dni"];
$idrol=$_SESSION["idroles"];

$consulta="SELECT rol FROM roles WHERE idroles='$idrol'";
$nrol= $conexion->prepare($consulta);
$nrol->execute();
$norol = $nrol->fetch(PDO::FETCH_ASSOC);

$consulta="SELECT concat(nombres,' ',ap_paterno,' ',ap_materno) Personal FROM persona WHERE dni='$dni'";
$n= $conexion->prepare($consulta);
$n->execute();
$dats = $n->fetch(PDO::FETCH_ASSOC);

date_default_timezone_set('America/Lima');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Hospital</title>

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/SistemaAtencion/public/assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="/SistemaAtencion/public/assets/dist/css/adminlte.min.css">
  <link rel="icon shortcut" href="/SistemaAtencion/public/assets/img/logo.png">
  <link rel="stylesheet" href="/SistemaAtencion/public/assets/fonts/ionicons.css">
  <link rel="stylesheet" href="/SistemaAtencion/public/assets/fonts/feather.css">
  <link rel="stylesheet"  href="/SistemaAtencion/public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- <link rel="stylesheet"  href="/SistemaAtencion/public/assets/plugins/jquery-ui/jquery-ui.min.css"> -->
  <link rel="stylesheet"  href="/SistemaAtencion/public/assets/plugins/datepicker/css/bootstrap-datepicker3.min.css">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
  <style>
  .modal-header-primary {
      color:#fff;
      padding:9px 15px;
      border-bottom:1px solid #eee;
      background-color: #055FB5;
      -webkit-border-top-left-radius: 4px;
      -webkit-border-top-right-radius: 4px;
      -moz-border-radius-topleft: 4px;
      -moz-border-radius-topright: 4px;
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
  }
  .nm{
   background-color: #BCBDBC;
   width: 80px;
   text-align:center;
 }
 .nm1{
   background-color: #BCBDBC;
   width: 180px;
   text-align:center;
 }
 .tableatencion tr th{
   height:20px;
 }

 .desc{
   font-weight:500;
 }

  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <!-- MODAL CONFIRMACION CERRAR SESION -->
  <div class="modal fade" id="mimodal" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmación:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Seguro que quiere cerrar la Sesión Actual?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal">No. Continuar </button>
          <button style="height:40px;width:120px" type="button" class="btn btn-primary" onclick="salir()">Sí. Salir</button>
        </div>
      </div>
    </div>
  </div>


    <!-- MODAL EDICIÓN DE USUARIO-->
    <div class="modal fade" id="modalUsu">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" id="modal-header">
              <h4 style="font-weight:600" class="modal-title" id="modal-title">DATOS DEL  PERFIL DEL USUARIO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="formperfil">
                      <input type="hidden" class="form-control" name="idusup" id="idusup">
                      <input type="hidden" class="form-control" name="idperp" id="idperp">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputName">DNI</label>
                              <input type="text" class="form-control" name="idnip" id="idnip" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputName">Nombres</label>
                              <input type="text" class="form-control" name="inombrep" id="inombrep">
                          </div>
                        </div>
                      </div>

                      <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputName">Apellido Paterno</label>
                                <input type="text" class="form-control" name="iappatp" id="iappatp">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputName">Apellido Materno</label>
                              <input type="text" class="form-control" name="iapmatp" id="iapmatp">
                          </div>
                        </div>
                      </div>                                        

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputEmail">Celular</label>
                              <input type="text" class="form-control"  name="icelp" id="icelp">
                          </div>
                        </div>
                        
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputEmail">Dirección</label>
                              <input type="text" class="form-control"  name="idirp" id="idirp">
                          </div>
                        </div>                      
                      </div>
                      
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputMessage">Email</label>
                              <input type="email" class="form-control1"  name="iemailp" id="iemailp">
                          </div>
                        </div>
                        
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputEmail">Nombre Usuario</label>
                              <input type="text" class="form-control1"  name="inomusup"  id="inomusup">
                          </div>
                        </div>
                      </div>
                   
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button style="height: 40px;width: 180px;" type="button" class="btn btn-primary" id="Actualizar">Actualizar Datos</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>

  <!-- MODAL FOTO-->
  <div class="modal fade" id="modalfotop"  >
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-weight:600" class="modal-title">ACTUALIZAR FOTO DE PERFIL:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="FormFotop">
        <div style="text-align:center;" class="modal-body">
          <h1 style="font-family:arial;font-size:20px;font-weight:600">Foto de perfil Actual</h1>  
            <img style="widht: 150px; height:150px;" src="/SistemaAtencion/<?php echo $foto?>" id="Fotope" name="Fotope">
          <br><br>
          <div class="form-group">
              <label>Elegir Foto (jpg)</label><span style="color: red;font-weight: 600;"> (*)</span>
              <div class="file">
                  <input type="hidden" id="opcion" name="opcion" value='13'>
                  <input type="hidden" id="iddni2" name="iddni2" value="<?php echo $dni;?>">
                  <input type="hidden" id="idusua2" name="idusua2" value="<?php echo $iduser;?>">
                  <input type="file" id="idfilep" name="idfilep" required accept=".jpg">
              </div>
    
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar </button>
          <button style="height:40px;width:120px" type="submit" class="btn btn-primary" id="CambiarP">Cambiar</button>
        </div>
        </form>
      </div>
    </div>
</div>

<!-- MODAL CAMBIO DE CONTRASEÑA-->
<div class="modal fade" id="modaleditpswG">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-weight:600" class="modal-title">CAMBIO DE CONTRASEÑA:</h4>
          &nbsp;<b id="idc" style="color:#8C0505;font-size: 1.4rem;"></b> 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">  
          <form id="formC">
            <div class="form-group">
                <label>Contraseña Actual</label>
                <input type="password" class="form-control1" name="ipsw" id="ipsw"/>
            </div><div class="form-group">
                <label>Contraseña Nueva</label>
                <input type="password" class="form-control1" name="ipasss1" id="ipasss1"/>
            </div><div class="form-group">
                <label>Confirmar nueva contraseña</label>
                <input type="password" class="form-control1" name="ipassco1" id="ipassco1"/>
                <b id="error3"></b>
            </div> 
          </form> 
        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal" id="SalirC">Cancelar </button>
          <button style="height:40px;width:120px" type="button" class="btn btn-primary" id="BtnContraG">Actualizar</button>
        </div>
      </div>
    </div>
</div>

  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-cyan">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        </li>&nbsp;&nbsp;&nbsp;
        <li class="nav-item">
        <h3 style="margin:8px 0;font-size:20px;font-weight:600">USUARIO: <?php echo $dats['Personal'];?></h3>
          <input id="idrolactual" name="idrolactual" type="hidden" value="<?php echo $idrol;?>">
          <input id="idinstitu" name="idinstitu" type="hidden" value="">
          <input id="iduser" name="iduser" type="hidden" value="<?php echo $iduser;?>">
          <input id="dniuser" name="dniuser" type="hidden" value="<?php echo $dni;?>">
          
        </li>
        <li class="nav-item">
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

        </li>
        <li class="nav-item">
        <h3 style="margin:8px 0;font-size:20px;font-weight:600">ROL: <?php echo $norol['rol'];?></h3>

        </li>
        <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"><span
              style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;font-weight: 500;">
              Buscar</span></i>
        </a> -->
      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">

          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Buscar..."
                  aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->
      <div class="demo-navbar-user nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                <img src="/SistemaAtencion/<?php echo $foto?>" alt class="d-block ui-w-30 rounded-circle">
                <span class="px-1 mr-lg-2 ml-2 ml-lg-0">
                  <?php echo utf8_decode($_SESSION['nombre']);?>
                </span>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
                      <a  class="dropdown-item" id="Fot" data-toggle="modal">
                  <i class="feather icon-user text-muted"></i> &nbsp; Cambiar Foto</a>
              <a class="dropdown-item" id="Conf" data-toggle="modal">
                  <i class="feather icon-settings text-muted"></i> &nbsp; Datos del Perfil</a>
                  <a class="dropdown-item" id="contra" data-toggle="modal">
                  <i class="feather icon-settings text-muted"></i> &nbsp; Cambiar Contraseña</a>
              <div class="dropdown-divider"></div>
            <a class="dropdown-item" data-toggle="modal" href="#mimodal">
                <i class="feather icon-power text-danger"></i> &nbsp; Salir</a>
        </div>
      
    </div>
      </ul>
    </nav>
    <!-- /.navbar -->


    

  

   
