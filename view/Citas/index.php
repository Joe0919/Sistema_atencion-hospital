<?php 
require_once "../Header.php";

$consulta = "SELECT * FROM especialidad e";			
$espec = $conexion->prepare($consulta);
$espec->execute();
?>

      <!-- MODAL INGRESO DE CITAS-->
      <div class="modal fade" id="modalcita">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header" id="modal-header">
              <h4 style="font-weight:600" class="modal-title" id="modal-title">GESTIÓN DE CITAS POR ESPECIALIDAD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="formcita">
                      <input type="hidden" class="form-control" name="idcita" id="idcita" value="0">
                      <!-- <input type="hidden" class="form-control" name="idpaciente" id="idpaciente"> -->
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>Fecha de Cita: </label><span style="color: red;font-weight: 600;"> (*)</span>

                              <div class="input-group date dateC">
                                <input style="width:320px;height:calc(2.25rem + 2px);text-align:center;font-weight:600;font-size:20px" step="1"  
                                value="<?php echo date("d/m/Y");?>"type="text" id="datepickerCita" class="form-control" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                              </div>  
                              
                          </div> 
                        </div>                          
                        <div class="col-sm-6">
                          <label>Especialidad: </label><span style="color: red;font-weight: 600;"> (*)</span>
                            <select style="font-size:19px;text-align:center" class="form-control" name="EspC" id="EspC">
                                <option value="0" selected="selected">------ Elige la especialidad ------</option> 
                              <?php while($datos = $espec->fetch(PDO::FETCH_ASSOC)) { ?>
                                  <option value="<?php echo $datos['idespecialidad']  ?>"> <?php echo $datos['especialidad'] ?></option>
                                <?php } ?>
                              </select>
                        </div>
                      </div>  
                      <div id="NoFound" text-align="center">
                        <h3><b id="AvisoCita"></b></h3> 
                      </div>
                      
                      <div style="border: 1px solid black;padding:10px;" id="Found">
                        <p style="margin:0;color:red;font-weight:600;text-align:center;font-style: italic; font-weight:600">Información de la Programación:</p>
                        <input type="hidden" class="form-control" id="idper" name="idper">
                        <div id="usuar" class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                                <label>Programaciones Encontradas: </label><span style="color: red;font-weight: 600;"> (*)</span>
                                <select style="font-size:19px;text-align:center" class="form-control" name="progCi" id="progCi">
                                  
                                </select>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                            <input type="hidden" class="form-control" name="idhorario" id="idhorario" value="0">
                              <label>Fecha: </label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                  <input style="width:310px;height:calc(2.25rem + 2px);text-align:center;font-size:20px" class="form-control" readonly="" type="text" id="fechaCi">
                                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Cupos</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="cupoCi" readonly="" name="cupoCi">
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Especialidad</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="EsCita" readonly="" name="EsCita">
                              </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Medico Asignado</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="MedCita" readonly="" name="MedCita">
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Consultorio</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="consCita" readonly="" name="consCita">
                              </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Turno</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="turCita" readonly="" name="turCita">
                              </div>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>DNI Paciente:</label><span style="color: red;font-weight: 600;"> (*)</span>
                              <input type="text" class="form-control" name="dniCi" id="dniCi" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>Hora Cita</label><span style="color: red;font-weight: 600;"> (*)</span>
                              <input type="text" class="form-control" name="horC" id="horC">
                              <input type="hidden" class="form-control" name="horCF" id="horCF" value="0">
                          </div>
                        </div>
                      </div>

                      <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Paciente</label><span style="color: red;font-weight: 600;"> (*)</span>
                                <input type="text" class="form-control" name="app" id="app" readonly="">
                                <input type="hidden" class="form-control" name="idpac" id="idpac" value="0">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>Email:</label><span style="color: silver;font-weight: 600;"> (Opcional)</span>
                              <input type="text" class="form-control1" name="mailPa" id="mailPa">
                              <b id="AvisoP"></b>
                          </div>
                        </div>
                      </div>                                                                                
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <!-- <button style="height: 40px;width: 180px;" type="button" class="btn btn-primary" id="EditCita">Editar</button> -->
              <button style="height: 40px;width: 180px;" type="button" class="btn btn-primary" id="SaveCita">Guardar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- MODAL EDICIÓN DE CITAS-->
      <div class="modal fade" id="modalcitaed">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header" id="modal-header">
              <h4 style="font-weight:600" class="modal-title" id="modal-title">INFORMACIÓN DE LA CITA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="formcita">
                      <input type="hidden" class="form-control" name="idcita" id="idcita" value="0">
                      <!-- <input type="hidden" class="form-control" name="idpaciente" id="idpaciente"> -->                      
                      <p style="font-style: italic; font-weight:500">*Si desea realizar algún tipo de cambio debe de crearse una nueva cita y eliminar la presente.</p>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                            <input type="hidden" class="form-control" name="idcitaed" id="idcitaed">
                              <label>Fecha: </label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                  <input style="width:310px;height:calc(2.25rem + 2px);text-align:center;font-size:18px" class="form-control" readonly="" type="text" id="fechaCi1">
                                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Hora Cita:</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="horC1" readonly="" name="horC1">
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Especialidad</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="EsCita1" readonly="" name="EsCita1">
                              </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Medico Asignado</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="MedCita1" readonly="" name="MedCita1">
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Consultorio</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="consCita1" readonly="" name="consCita1">
                              </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Turno</label>
                                <input style="font-size:18px;text-align:center" type="text" class="form-control" id="turCita1" readonly="" name="turCita1">
                              </div>
                          </div>
                        </div>
                      
                      <br>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>DNI Paciente:</label><span style="color: red;font-weight: 600;"> (*)</span>
                              <input  style="font-size:18px;text-align:center" readonly type="text" class="form-control" name="dniCi1" id="dniCi1" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8">
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Paciente</label><span style="color: red;font-weight: 600;"> (*)</span>
                                <input   style="font-size:18px;text-align:center" readonly type="text" class="form-control" name="app1" id="app1" readonly="">
                            </div>
                        </div>
                      </div>                                                                              
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <!-- <button style="height: 40px;width: 180px;" type="button" class="btn btn-primary" id="EditCita">Editar</button> -->
              <button style="height: 40px;width: 180px;" type="button" class="btn btn-primary" id="SaveCita">Guardar</button>
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
         <li class="nav-item menu-open">
           <a href="#" class="nav-link active">
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
            <li style="font-weight:600"><i class="nav-icon fas fa-file-medical"></i>&nbsp;Citas</li>
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
                  <h3 class="card-title" style="font-weight:600; color:#084B8A">Listado de Citas Registradas</h3>
                  <a style="float:right;width:220px;height:30px" class="btn btn-flat bg-success" data-toggle="modal" id="NuevoCita">
                    <i class="nav-icon fas fa-plus"></i>&nbsp;&nbsp;Nuevo Registro </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  
                <table id="tablaCitas" class="table table-hover" style="width:100%" >
                <thead style="background: #2874A6;color:white;">
                      <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Fecha</th>  
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Especia.</th>
                        <th>Consultorio</th>
                        <th>Estado</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center;">                                 
                 
                    
                    </tbody>
                    <tfoot style="background: #2874A6;color:white;">
                    <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Fecha</th>  
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Especia.</th>
                        <th >Consultorio</th>
                        <th >Estado</th>
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