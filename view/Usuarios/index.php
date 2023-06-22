<?php
require_once "../Header.php";

$consulta = "SELECT * FROM roles";			
$resultado1 = $conexion->prepare($consulta);
$resultado1->execute(); 

$consulta = "SELECT * FROM roles";			
$resultado2 = $conexion->prepare($consulta);
$resultado2->execute();

?>

  <!-- MODAL INGRESO DE USUARIO-->
  <div class="modal fade" id="modalusuario">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" id="modal-header">
              <h4 style="font-weight:600" class="modal-title" id="modal-title">GESTIÓN DE USUARIOS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
              </button>
            </div>
            <div class="modal-body">
            <form id="formnew">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName">DNI</label>
                            <input type="text" class="form-control" name="idni" id="idni" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8">
                            <b id="Aviso"></b>
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName">Nombres</label>
                            <input type="text" class="form-control" name="inombre" id="inombre">
                        </div>
                      </div>
                    </div>

                     <div class="row">
                       <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputName">Apellido Paterno</label>
                              <input type="text" class="form-control" name="iappat" id="iappat">
                          </div>
                       </div>
                       
                       <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName">Apellido Materno</label>
                            <input type="text" class="form-control" name="iapmat" id="iapmat">
                        </div>
                      </div>
                     </div>                                        

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail">Celular</label>
                            <input type="text" class="form-control"  name="icel" id="icel" maxlength="9" minlength="9">
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail">Dirección</label>
                            <input type="text" class="form-control"  name="idir" id="idir">
                        </div>
                      </div>                      
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputMessage">Email</label>
                            <input type="email" class="form-control1"  name="iemail" id="iemail">
                            <b id="AvisoE"></b>
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail">Nombre Usuario</label>
                            <input type="text" class="form-control1"  name="inomusu"  id="inomusu">
                            <b id="error1"></b>
                        </div>
                      </div>
                    </div>

                    <div  class="row">
                      <div class="col-sm-4">
                          <div class="form-group">
                            <label>Rol</label> &nbsp;
                            <a style="width:20px;height:30px" class="btn btn-flat bg-success">...</a>
                            <select class="form-control" name="tipo" id="tipo">
                                 <?php while($datos=$resultado1->fetch(PDO::FETCH_ASSOC)) {?>
                                    <option value="<?php echo $datos['idroles']  ?>"> <?php echo $datos['rol'] ?></option>
                                <?php }?>
                            </select> 
                            
                          </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" class="form-control"  name="ipasss" id="ipasss"/>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                            <label for="inputEmail">Confirmar Contraseña</label>
                            <input type="password" class="form-control"  name="ipassco" id="ipassco"/>
                            <p id="error2"></p>
                        </div>
                      </div>
                    </div>
            </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarcampos()">Cancelar</button>
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-primary" id="guardar">Registrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a class="brand-link navbar-lightblue">
        <img src="/SistemaAtencion/files/images/1/logo.png" alt="Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text" style="font-weight:600;font-size:1.4rem;">HACDP</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
      <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item">
           <a href="../../view/Home/" class="nav-link">
             <i class="nav-icon fas fa-home"></i>
             <p>
               Inicio
             </p>
           </a>
         </li>
         <?php if($idrol == 1){?>
         <li class="nav-item menu-open">
           <a href="#" class="nav-link active">
             <i class="nav-icon fas fa-user"></i>
             <p>
               Usuarios
             </p>
           </a>
         </li>
         <?php }
          if($idrol == 1){?>
         <li class="nav-item">
           <a href="../../view/Especialidades/" class="nav-link">
             <i class="nav-icon fas fa-hospital-symbol"></i>
             <p>
               Especialidades
             </p>
           </a>
         </li>
         <?php }
          if($idrol == 1){?>
         <li class="nav-item">
           <a href="../../view/Consultorios/" class="nav-link">
             <i class="nav-icon fas fa-door-closed"></i>
             <p>
               Consultorios
             </p>
           </a>
         </li>
         <?php }
          if($idrol == 1 || $idrol == 2){?>
         <li class="nav-item">
           <a href="../../view/Citas/" class="nav-link">
             <i class="nav-icon fas fa-file-medical"></i>
             <p>
               Citas
             </p>
           </a>
         </li>
         <?php }
          if($idrol == 1 || $idrol == 3 || $idrol == 4){?>
        <li class="nav-item">
          <a href="../../view/Triaje/" class="nav-link">
            <i class="nav-icon fas fa-temperature-high"></i>
            <p>
              Triaje
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../../view/Atencion/" class="nav-link">
            <i class="nav-icon fas fa-band-aid"></i>
            <p>
              Atención
            </p>
          </a>
        </li>
         <?php }
          if($idrol == 1 || $idrol == 2){?>
         <li class="nav-item">
           <a href="../../view/Pacientes/" class="nav-link">
             <i class="nav-icon fas fa-user-friends"></i>
             <p>
               Pacientes
             </p>
           </a>
         </li>
         <?php }
          if($idrol == 1 || $idrol == 2){?>
         <li class="nav-item">
           <a href="../../view/Horarios/" class="nav-link">
             <i class="nav-icon fas fa-calendar-week"></i>
             <p>
               Horarios
             </p>
           </a>
         </li>
         <?php }
          if($idrol == 1){?>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-hospital-user"></i>
             <p>
               Empleados
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
           <li class="nav-item">
               <a href="../../view/Personal/" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Personal Adm</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="../../view/Medicos/" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Médicos</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="../../view/Asignacion/" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Asignación</p>
               </a>
             </li>
           </ul>
         </li>
         <?php }
          if($idrol == 1 || $idrol == 5){?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hospital"></i>
              <p>
                Farmacia
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="../../view/Recetas/" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recetas</p>
                    </a>
                </li>
                <li class="nav-item">
                <a href="../../view/Medicamentos/" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Medicamentos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../view/TiposMed/" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tipos Medicamento</p>
                </a>
              </li>
            </ul>
          </li>
         <?php }?>
       </ul>
     </nav>
      </div>
    </aside>

    <!-- INICIO DEL CONTENIDO -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-11">
        <h1 style="text-align:center;color:black;font-weight:600">SISTEMA DE SERVICIO DE CONSULTA EXTERNA</h1>
        </div>
        <div class="col-sm-1">

          <ol class="breadcrumb float-sm-right">
            <li style="font-weight:600"><i class="nav-icon fas fa-user"></i>&nbsp;Usuarios</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

    <!-- MODAL EDICIÓN DE USUARIO-->
    <div class="modal fade" id="modalEdusuario">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" id="modal-header">
              <h4 style="font-weight:600" class="modal-title" id="modal-title">EDICIÓN DE USUARIOS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
              </button>
            </div>
            <div class="modal-body">
            <form id="formEdit">
                    <input type="hidden" class="form-control" name="idusuario" id="idusuario">
                    <input type="hidden" class="form-control" name="idpersona" id="idpersona">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName">DNI</label>
                            <input type="text" class="form-control" name="idni" id="idni1" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8">
                            <b id="Aviso"></b>
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName">Nombres</label>
                            <input type="text" class="form-control" name="inombre" id="inombre1">
                        </div>
                      </div>
                    </div>

                     <div class="row">
                       <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputName">Apellido Paterno</label>
                              <input type="text" class="form-control" name="iappat" id="iappat1">
                          </div>
                       </div>
                       
                       <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName">Apellido Materno</label>
                            <input type="text" class="form-control" name="iapmat" id="iapmat1">
                        </div>
                      </div>
                     </div>                                        

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail">Celular</label>
                            <input type="text" class="form-control"  name="icel" id="icel1" maxlength="9" minlength="9">
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail">Dirección</label>
                            <input type="text" class="form-control"  name="idir" id="idir1">
                        </div>
                      </div>                      
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputMessage">Email</label>
                            <input type="email" class="form-control1"  name="iemail" id="iemail1">
                            <b id="AvisoE"></b>
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail">Nombre Usuario</label>
                            <input type="text" class="form-control1"  name="inomusu"  id="inomusu1">
                            <b id="error1"></b>
                        </div>
                      </div>
                    </div>

                    <div  class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Rol</label> &nbsp;
                            <a style="width:20px;height:30px" class="btn btn-flat bg-success">...</a>
                            <select class="form-control" name="tipo" id="tipo1">
                            <?php while($datos=$resultado2->fetch(PDO::FETCH_ASSOC)) {?>
                                    <option value="<?php echo $datos['idroles']  ?>"> <?php echo $datos['rol'] ?></option>
                                <?php }?>
                            </select> 
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Estado</label> &nbsp;
                            <select class="form-control" name="estado1" id="estado1">
                                    <option value="ACTIVO">Activo</option>
                                    <option value="DESACTIVADO">Desactivado</option>
                            </select> 
                          </div>
                      </div>
                    </div>
            </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarcampos()">Cancelar</button>
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-primary" id="Editar">Editar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>

<!-- MODAL CAMBIO DE CONTRASEÑA-->
<div class="modal fade" id="modaleditpsw"  >
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
          <button style="height:40px;width:120px" type="button" class="btn btn-primary" id="BtnContra">Actualizar</button>
        </div>
      </div>
    </div>
</div>

  <!-- MODAL FOTO-->
  <div class="modal fade" id="modalfoto"  >
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-weight:600" class="modal-title">ACTUALIZAR FOTO DE PERFIL:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="FormFoto">
        <div style="text-align:center;" class="modal-body">
          <h1 style="font-family:arial;font-size:20px;font-weight:600">Foto de perfil Actual</h1>  
          <img style="widht: 150px; height:150px;" id="FotoP" name="FotoP">
          <br><br>
          <div class="form-group">
              <label>Elegir Foto (jpg)</label><span style="color: red;font-weight: 600;"> (*)</span>
              <div class="file">
                  <input type="hidden" id="opcion" name="opcion" value='10'>
                  <input type="hidden" id="iddni1" name="iddni1">
                  <input type="hidden" id="idusua" name="idusua">
                  <input type="file" id="idfile1" name="idfile1" required accept=".jpg">
              </div>
    
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar </button>
          <button style="height:40px;width:120px" type="submit" class="btn btn-primary" id="CambiarF">Cambiar</button>
        </div>
        </form>
      </div>
    </div>
</div>


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card card-danger card-outline">
                <div class="card-header">
                  <h3 class="card-title" style="font-weight:600; color:#084B8A">Listado de Usuarios Registrados</h3>
                  <a style="float:right;width:220px;height:30px" class="btn btn-flat bg-success" data-toggle="modal" id="Nuevo">
                    <i class="nav-icon fas fa-plus"></i>&nbsp;&nbsp;Nuevo Registro </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <a style="float:right;width:220px;height:30px;" Target="_blank" class="btn btn-flat bg-gray-dark" href="../../reporte/reporte-usuario.php" id="ReportUsu">
                    <i class="nav-iconfas fas fa-file-pdf"></i>&nbsp;&nbsp;Generar Reporte </a>
                <table id="tablaUsuarios" class="table table-hover" style="width:100%" >
                <thead style="background: #2874A6;color:white;">
                      <tr style="text-align: center;">
                        <th >ID</th>
                        <th>Usuario</th>  
                        <th>DNI</th>
                        <th>ROL</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th >Foto</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center;">                                 
                 
                    
                    </tbody>
                    <tfoot style="background: #2874A6;color:white;">
                    <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>DNI</th>
                        <th>ROL</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th style="width: 10px;">Foto</th>
                        <th>Acción</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
 
    </div>  
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require_once ("../Footer.php")?>