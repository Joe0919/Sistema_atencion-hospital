<?php 
require_once "../Header.php";

$consulta = "select distinct especialidad
from cita c, horario_especialidad h, espec_medico ep, especialidad ad, estado e
where c.idhorario_especialidad=h.idhorario_especialidad and ep.idespec_medico=h.idespec_medico
 and ep.idespecialidad=ad.idespecialidad
 and fecha=curdate();";			
$espec1 = $conexion->prepare($consulta);
$espec1->execute();
?>

          <!-- MODAL EDICIÓN DE CITAS-->
          <div class="modal fade" id="modaltriaje">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header" id="modal-header">
              <h4 style="font-weight:600" class="modal-title" id="modal-title">INGRESO DE DATOS DEL PACIENTE</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="formcita">
                      <input type="hidden" class="form-control" id="idcita1" value="0">
                      <!-- <input type="hidden" class="form-control" name="idpaciente" id="idpaciente"> -->                      
                      
                        <div class="row">
                          <div class="col-sm-5">
                            <div class="form-group">
                                <label>Paciente:</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="paT" readonly="">
                              </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                                <label>DNI:</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="dniT" readonly="">
                              </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <label>Edad:</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="EdadT" readonly="">
                              </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                                <label>G. Sanguineo:</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="gT" readonly="">
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Especialidad</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="esT" readonly="">
                              </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Médico Asignado</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="MedT" readonly="">
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                                <label>Peso (kg.): </label><span style="color: red;font-weight: 600;"> (*)</span>
                                <input style="font-size:18px;text-align:center" type="number" class="form-control" id="pesoT" placeholder="Ingrese peso..">
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <label>Talla (m.): </label><span style="color: red;font-weight: 600;"> (*)</span>
                                <input style="font-size:18px;text-align:center" type="number" class="form-control" id="tallaT" placeholder="Ingrese talla..">
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <label>IMC: </label><span style="color: red;font-weight: 600;"> (*)</span>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="imcT" readonly>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <label>Temperatura (C°): </label><span style="color: red;font-weight: 600;"> (*)</span>
                                <input style="font-size:18px;text-align:center" type="number" class="form-control" id="tempT" placeholder="Ingrese Temperatura..">
                            </div>
                          </div>
                        </div>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label>Presión Arterial (mm Hg):</label><span style="color: red;font-weight: 600;"> (*)</span>
                              <input  style="font-size:18px;text-align:center" type="text" class="form-control" id="presionT" placeholder="Ingrese presión arterial..">
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Frecuencia Cardiaca</label><span style="color: red;font-weight: 600;"> (*)</span>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="frecT" placeholder="Ingrese frecuencia..">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Saturación O2 (%):</label><span style="color: red;font-weight: 600;"> (*)</span>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="o2T" placeholder="Ingrese saturación..">
                            </div>
                        </div>
                      </div>                                                                              
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <!-- <button style="height: 40px;width: 180px;" type="button" class="btn btn-primary" id="EditCita">Editar</button> -->
              <button style="height: 40px;width: 180px;" type="button" class="btn btn-primary" id="SaveTriaje">Guardar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
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
            <li style="font-weight:600"><i class="nav-icon fas fa-temperature-high"></i>&nbsp;Triaje</li>
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
                  <div class="row">
                    <div class="col-sm-5">
                      <h3 class="card-title" style="font-weight:600; color:#084B8A">Listado de Citas Programadas</h3>
                    </div>
                    <div class="col-sm-4">
                      <label>Especialidad</label>
                        <select style="width:250px;height:35px;font-weight:600;text-align:center;font-size:18px;color:#094B8B;" name="cbovista" id="cboes">                      
                                <option value="">------------ Todos ------------</option> 
                              <?php while($datos = $espec1->fetch(PDO::FETCH_ASSOC)) { ?>
                                  <option value="<?php echo $datos['especialidad'];?>"><?php echo $datos['especialidad'];?></option>
                                <?php } ?>
                             </select>
                    </div>
                    <div class="col-sm-3">
                        <label>Turno: </label>
                        <select style="width:150px;height:35px;font-weight:600;text-align:center;font-size:18px;color:#094B8B;" name="cbovista" id="cbotur">                      
                            <option value="Mañana">MAÑANA</option>
                            <option value="Tarde">TARDE</option>
                        </select>
                        <button style="margin:0; height: 35px;width: 40px;" type="button" class="btn btn-success" id="filtrar" title="Filtrar"><i class="nav-icon fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  
                <table id="TablaTriaje" class="table table-hover" style="width:100%" >
                <thead style="background: #2874A6;color:white;">
                      <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Registrado</th>
                        <th>Fecha</th>  
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Especia.</th>
                        <th>Estado</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center;">                                 
                 
                    
                    </tbody>
                    <tfoot style="background: #2874A6;color:white;">
                    <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Registrado</th>
                        <th>Fecha</th>  
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Especia.</th>
                        <th>Estado</th>
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