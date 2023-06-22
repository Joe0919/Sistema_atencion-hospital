<?php 
require_once "../Header.php";
?>
      <!-- MODAL GESTIÓN DE PACIENTES-->
      <div class="modal fade" id="modalpaciente">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header" id="modal-header">
              <h4 style="font-weight:600" class="modal-title" id="modal-title">GESTIÓN DE DATOS DEL PACIENTE</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="formpaciente">
                      <input type="hidden" class="form-control" name="idpersonaP" id="idpersonaP" value="0">
                      <input type="hidden" class="form-control" name="idpaciente" id="idpaciente">
                      <div class="row" id="hcpa">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>N° Historia Clínica:</label><span style="color: red;font-weight: 600;"> (*)</span>
                              <input type="text" class="form-control" name="nhc" id="nhc" readonly>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>Establecimiento de Salud:</label><span style="color: red;font-weight: 600;"> (*)</span>
                              <input type="text" class="form-control" name="autog" id="autog" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>DNI</label><span style="color: red;font-weight: 600;"> (*)</span>
                              <input type="text" class="form-control" name="dnip" id="dnip" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>Nombres</label><span style="color: red;font-weight: 600;"> (*)</span>
                              <input type="text" class="form-control" name="nomp" id="nomp">
                          </div>
                        </div>
                      </div>

                      <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Apellido Paterno</label><span style="color: red;font-weight: 600;"> (*)</span>
                                <input type="text" class="form-control" name="app" id="app">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>Apellido Materno</label><span style="color: red;font-weight: 600;"> (*)</span>
                              <input type="text" class="form-control" name="amp" id="amp">
                          </div>
                        </div>
                      </div>                                        

                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label>Celular</label><span style="color: red;font-weight: 600;"> (*)</span>
                              <input type="text" class="form-control"  name="celp" id="celp" onkeypress='return validaNumericos(event)' maxlength="9">
                          </div>
                        </div>
                        
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label>Dirección</label><span style="color: red;font-weight: 600;"> (*)</span>
                              <input type="text" class="form-control"  name="dirp" id="dirp">
                          </div>
                        </div>    
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label>Sexo: </label><span style="color: red;font-weight: 600;"> (*)</span>
                              <select style="width: 100%;height: 40px;font-weight:600;text-align:center;font-size:18px;" name="isp" id="isp">                      
                                <option value="Masculino">MASCULINO</option>
                                <option value="Femenino">FEMENINO</option>
                                <option value="Otro">OTRO</option>
                              </select>
                          </div>
                        </div>                  
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>Fecha de Nacimiento: </label><span style="color: red;font-weight: 600;"> (*)</span>

                              <div class="input-group date datehg1">
                                <input style="width:320px;height:calc(2.25rem + 2px);text-align:center;font-weight:600;font-size:20px" step="1"  value="<?php echo date(" d/m/Y ");?>"  type="text" id="datepicker1">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                              </div>  
                             
                          </div> 
                        </div>                          
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>Lugar de Nacimiento: </label><span style="color: red;font-weight: 600;"> (*)</span>
                              <input type="text" class="form-control"  name="lnacp"  id="lnacp">
                          </div>
                        </div>
                      </div>                                         
                      <div class="row">                        
                          <div class="col-sm-5">
                            <div class="form-group">
                                <label>Edad: </label><span style="color: red;font-weight: 600;"> (*)</span>
                                <input type="text" class="form-control"  name="edadp"  id="edadp" readonly>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <label>Grupo Sanguineo: </label><span style="color: red;font-weight: 600;"> (*)</span>
                                <select style="width: 100%;height: 40px;font-weight:600;text-align:center;font-size:18px;" name="gsanp" id="gsanp">                      
                                  <option value="A">A</option>
                                  <option value="B">B</option>
                                  <option value="AB">AB</option>
                                  <option value="O">O</option>
                                </select>  
                            </div>
                          </div>
                          
                          <div class="col-sm-4">
                            <div class="form-group">
                                <label>Factor Rh: </label><span style="color: red;font-weight: 600;"> (*)</span>
                                <select style="width: 100%;height: 40px;font-weight:600;text-align:center;font-size:18px;" name="rhp" id="rhp">                      
                                  <option value="Positivo">POSITIVO</option>
                                  <option value="Negativo">NEGATIVO</option>
                                </select> 
                            </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Alergia Médica: </label><span style="color: silver;font-weight: 600;">(Opcional)</span>
                            <textarea class="form-control" id="ialergia" name="ialergia" placeholder="Ingrese la alergia médica si el paciente lo presenta..."></textarea>
                          </div>
                        </div>   
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button style="height: 40px;width: 180px;" type="button" class="btn btn-primary" id="EditPa">Editar</button>
              <button style="height: 40px;width: 180px;" type="button" class="btn btn-primary" id="SavePa">Guardar</button>
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
         <li class="nav-item menu-open">
           <a href="#" class="nav-link active">
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

          <ol style="width: 120px"; class="breadcrumb float-sm-right">
            <li style="font-weight:600"><i class="nav-icon fas fa-user-friends"></i>&nbsp;Pacientes</li>
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
                  <h3 class="card-title" style="font-weight:600; color:#084B8A">Listado de Pacientes Registrados</h3>
                  <a style="float:right;width:220px;height:30px" class="btn btn-flat bg-success" data-toggle="modal" id="NuevoPa">
                    <i class="nav-icon fas fa-plus"></i>&nbsp;&nbsp;Nuevo Registro </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  
                <table id="tablaPacientes" class="table table-hover" style="width:100%" >
                <thead style="background: #2874A6;color:white;">
                      <tr style="text-align: center;">
                        <th >ID</th>
                        <th>DNI</th> 
                        <th>Paciente</th>  
                        <th>Alergia</th>
                        <th>Nro. Hist. Clínica</th>
                        <th>Estab.Salud</th> 
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center;">                              
                 
                    
                    </tbody>
                    <tfoot style="background: #2874A6;color:white;">
                    <tr style="text-align: center;">
                        <th >ID</th>
                        <th>DNI</th> 
                        <th>Paciente</th>  
                        <th>Alergia</th>
                        <th>Nro. Hist. Clínica</th>
                        <th>Estab.Salud</th> 
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