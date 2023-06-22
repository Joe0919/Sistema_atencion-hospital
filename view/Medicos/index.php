<?php 
require_once "../Header.php";
$consulta = "SELECT * FROM roles";			
$resultado1 = $conexion->prepare($consulta);
$resultado1->execute(); 

$consulta = "select p.idpersona ID,  concat('DNI : ',p.dni,' : ',ap_paterno,' ', ap_materno,' ',nombres) Datos
from (usuarios u inner join persona p on u.dni=p.dni) left join medico e on p.idpersona = e.idpersona
where e.idpersona is null and idroles=3";			
$nmedicos = $conexion->prepare($consulta);
$nmedicos->execute();

?>
<!--==============================INICIO DE VENTANAS MODAL============================== -->
<!-- MODAL GESTION DE MÉDICOS-->
<div class="modal fade" id="modalMedicos"  >
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-weight:600" class="modal-title">GESTIÓN DE MÉDICOS:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">  
          <form id="FormMedico">
            <div id="usuar" class="row">
              <div class="col-sm-12">
                <div class="form-group">
                    <label>Usuarios Registrados Pendientes: (*)</label>
                    <select style="font-weight:600;font-size:19px" class="form-control" name="UsuM" id="UsuM">
                      <?php while($datos = $nmedicos->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $datos['ID']  ?>"> <?php echo $datos['Datos'] ?></optiomn>
                        <?php } ?>
                    </select>
                  </div>
              </div>
            </div>
            <div style="border: 1px solid black;padding:10px;" id="Informacion">
              <p style="margin:0;color:red;font-weight:600;text-align:center;font-style: italic; font-weight:600">Información del Usuario:</p>
              <input type="hidden" class="form-control" id="idper" name="idper">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>DNI</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="dniU" disabled name="dniU">
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>NOMBRES</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="nomU" disabled name="nomU">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>APELLIDO PATERNO</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="apU" disabled name="apU">
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>APELLIDO MATERNO</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="amU" disabled name="amU">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>CELULAR</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="celU" disabled name="celU">
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>DIRECCIÓN</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="dirU" disabled name="dirU">
                    </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>CÓDIGO (*)</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="codU" name="codU" onkeypress='return validaNumericos(event)'>
                    </div>
                </div>
                <div class="col-sm-6">

                </div>
              </div>
          </form> 
        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal" id="SalirM">Cancelar </button>
          <button style="height: 40px;width: 120px;" type="button" class="btn btn-primary" id="EditMedico">Editar</button>
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-primary" id="SaveMedico">Guardar</button>
        </div>
      </div>
    </div>
</div>

<!--==============================FIN DE VENTANAS MODAL============================== -->
    <!-- Main Sidebar Container -->
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
         <li class="nav-item">
           <a href="../../view/Usuarios/" class="nav-link">
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
         <li class="nav-item menu-open">
           <a href="#" class="nav-link active">
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
               <a href="#" class="nav-link active">
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

          <ol style="width: 160px"; class="breadcrumb float-sm-right">
            <li style="font-weight:600"><i class="nav-icon fas fa-user-graduate"></i>&nbsp;Personal / Médicos</li>
          </ol>
        </div>
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
                  <h3 class="card-title" style="font-weight:600; color:#084B8A">Médicos Registrados</h3>
                  <a style="float:right;width:220px;height:30px" class="btn btn-flat bg-success" data-toggle="modal" id="NuevoMedico">
                    <i class="nav-icon fas fa-plus"></i>&nbsp;&nbsp;Nuevo Registro </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  
                <table id="tablaMedicos" class="table table-hover" style="width:100%" >
                <thead style="background: #2874A6;color:white;"">
                      <tr style="text-align: center;">
                        <th >ID</th>
                        <th>DNI</th>  
                        <th>Colegiatura</th>  
                        <th>Apellidos y Nombres</th> 
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center;">                           
                        
                 
                    
                    </tbody>
                    <tfoot style="background: #2874A6;color:white;">
                    <tr style="text-align: center;">
                    <th >ID</th>
                        <th>DNI</th>  
                        <th>Colegiatura</th>  
                        <th>Apellidos y Nombres</th> 
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

    <footer class="main-footer">

      <strong>Copyright &copy; 2022 <a href="http://localhost/SistemaAtencion/"> Hospital Antonio Caldas Domínguez</a>.</strong>
      Todos los derechos reservados.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
 
  
  <script src="/SistemaAtencion/public/assets/plugins/jquery/jquery.min.js"></script>
  <script src="/SistemaAtencion/public/assets/plugins/bootstrap/js/bootstrap.js"></script>
  <script src="/SistemaAtencion/public/assets/dist/js/adminlte.js"></script>
  <script src="/SistemaAtencion/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="/SistemaAtencion/public/assets/js/main.js"></script> 
<!-- DataTables  & Plugins -->
  <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> 
  <script src="/SistemaAtencion/public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/SistemaAtencion/public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/SistemaAtencion/public/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- FUNCIONALIDADES CON AJAX -->
  
</body>

</html>