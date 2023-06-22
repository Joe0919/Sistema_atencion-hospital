<?php 
require_once "../Header.php";

$consulta = "select p.idpersona ID,  concat('CÓDIGO : ',codigo,' : ',ap_paterno,' ', ap_materno,' ',nombres) Datos
from medico m, persona p where m.idpersona=p.idpersona;";			
$medicos = $conexion->prepare($consulta);
$medicos->execute();

$consulta = "SELECT * FROM especialidad e";			
$espec = $conexion->prepare($consulta);
$espec->execute();
?>
<!-- MODAL GESTION DE MÉDICOS-->
<div class="modal fade" id="modalAsignación"  >
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-weight:600" class="modal-title">ASIGNACIÓN DE MÉDICOS/ESPECIALIDAD:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">  
          <form id="FormAsignar">
            <div id="usuar" class="row">
              <div class="col-sm-12">
                <div class="form-group">
                    <label>Médicos Registrados: (*)</label>
                    <select style="font-weight:600;font-size:19px" class="form-control" name="UsuAs" id="UsuAs">
                      <?php while($datos = $medicos->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $datos['ID']  ?>"> <?php echo $datos['Datos'] ?></optiomn>
                        <?php } ?>
                    </select>
                  </div>
              </div>
            </div>
            <div style="border: 1px solid black;padding:10px;" id="Informacion">
              <p style="margin:0;color:red;font-weight:600;text-align:center;font-style: italic; font-weight:600">Información Adicional del Médico:</p>
              <input type="hidden" class="form-control" id="idper" name="idper">
              <input type="hidden" class="form-control" id="idmedico" name="idmedico">
              <input type="hidden" class="form-control" id="idespecmedic" name="idespecmedic">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>DNI</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="dniAs" disabled name="dniAs">
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>NOMBRES</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="nomAs" disabled name="nomAs">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>APELLIDO PATERNO</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="apAs" disabled name="apAs">
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>APELLIDO MATERNO</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="amAs" disabled name="amAs">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>CELULAR</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="celAs" disabled name="celAs">
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>DIRECCIÓN</label>
                      <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="dirAs" disabled name="dirAs">
                    </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                  <h3 style="margin: 32px 0 0;float: right;">ASIGNAR EN: </h3>
                </div>
                <div class="col-sm-6">
                  <label>Especialidades Registrados: (*)</label>
                    <select style="font-weight:600;font-size:19px" class="form-control" name="EspAs" id="EspAs">
                      <?php while($datos = $espec->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $datos['idespecialidad']  ?>"> <?php echo $datos['especialidad'] ?></optiomn>
                        <?php } ?>
                      </select>
                </div>
              </div>
          </form> 
        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal" id="SalirAs">Cancelar </button>
          <button style="height: 40px;width: 120px;" type="button" class="btn btn-primary" id="EditAs">Editar</button>
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-primary" id="SaveAs">Guardar</button>
        </div>
      </div>
    </div>
</div>
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
               <a href="../../view/Medicos/" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Médicos</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="#" class="nav-link active">
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


        <ol style="width: 190px"; class="breadcrumb float-sm-right">
            <li style="font-weight:600"><i class="nav-icon fas fa-file-import"></i>&nbsp;Personal / Asignación</li>
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
                  <h3 class="card-title" style="font-weight:600; color:#084B8A">Asignación de Médicos a Especialidad</h3>
                  <a style="float:right;width:220px;height:30px" class="btn btn-flat bg-success" data-toggle="modal" id="NuevoAs">
                    <i class="nav-icon fas fa-plus"></i>&nbsp;&nbsp;Nuevo Registro </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  
                <table id="tablaAsignacion" class="table table-hover" style="width:100%" >
                <thead style="background: #2874A6;color:white;">
                      <tr style="text-align: center;">
                        <th >ID</th>
                        <th>Código</th>
                        <th>Médico</th>
                        <th>Especialidad</th>  
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center;">                                          
                    
                   
                    <tfoot style="background: #2874A6;color:white;">
                    <tr style="text-align: center;">
                      <th >ID</th>
                        <th>Código</th>
                        <th>Médico</th>
                        <th>Especialidad</th>  
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