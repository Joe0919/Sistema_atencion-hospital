<?php 
require_once "../Header.php";

$consulta = "SELECT idmedicina, concat(denom,' (',tipo,')') descr FROM medicina m, tipo t where m.idtipo=t.idtipo;";			
$medic = $conexion->prepare($consulta);
$medic->execute();

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a class="brand-link navbar-lightblue">
    <img src="/SistemaAtencion/files/images/1/logo.png" alt="Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
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
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
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

          <ol style="width: 100px"class="breadcrumb float-sm-right">
            <li style="font-weight:600"><i class="nav-icon fas fa-band-aid"></i>&nbsp;Atención</li>
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

          <div class="card card-danger card-outline" id="tablacitass">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-4">
                  <h3 class="card-title" style="font-weight:600; color:#084B8A">Listado de Citas Programadas</h3>
                </div>
                <div class="col-sm-4">
                  <label>Listar por: </label>
                  <select
                    style="width:300px;height:35px;font-weight:600;text-align:center;font-size:18px;color:#DE0001;"
                    name="cbovista" id="cbovista">
                    <option value="PENDIENTE">TODOS</option>
                    <option value="ACEPTADO">PENDIENTES</option>
                    <option value="RECHAZADO">ATENDIDOS</option>
                  </select>
                </div>
                <div class="col-sm-4">

                  <div class="input-group date dateC">
                    <label style="margin: 4px 0;">Por Fecha: </label>&nbsp;
                    <input style="width:100px;height:35px;text-align:center;font-weight:600;font-size:20px" step="1"
                      value="<?php echo date(" d/m/Y");?>"type="text" id="datepickerCita" class="form-control"
                    data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="tablaCitasProgramadas" class="table table-hover" style="width:100%">
                <thead style="background: #2874A6;color:white;">
                  <tr style="text-align: center;">
                    <th>ID</th>
                    <th>Registro</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>DNI</th>
                    <th>Paciente</th>
                    <th>Especia.</th>
                    <th>Estado</th>
                    <th>H.C.</th>
                  </tr>
                </thead>
                <tbody style="text-align: center;">


                </tbody>
                <tfoot style="background: #2874A6;color:white;">
                  <tr style="text-align: center;">
                    <th>ID</th>
                    <th>Registro</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>DNI</th>
                    <th>Paciente</th>
                    <th>Especia.</th>
                    <th>Estado</th>
                    <th>H.C.</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <div class="card card-green" id="HC">
        <div class="card-header">
          <h4 class="card-title">HISTORIAL CLÍNICO N° <b id="NHC"></b></h4>
          <button style="height: 40px;width: 150px; float:right" type="button" class="btn btn-danger" id="cerrarhc">
          <i class="nav-icon fas fa-angle-left"></i>&nbsp;&nbsp;Cerrar</button>
        </div>
        <div class="card-body">
          <div class="row">
            <div style="text-align:center" class="col-sm-12">
              <h4 class="card-title">DATOS DEL PACIENTE </h4>
            </div>
          </div>
          <div class="row invoice-info">
            <div class="col-sm-1 invoice-col">
            </div>
            <div class="col-sm-5 invoice-col">

              <br>
              <b>DNI: </b><span id="dnipac"></span><br>
              <b>APELLIDOS: </b><span id="apepac"></span><br>
              <b>NOMBRES: </b><span id="nompac"></span>
            </div>
            <!-- /.col -->
            <div class="col-sm-5 invoice-col">

              <br>
              <b>EDAD: </b><span id="edadpac"></span><br>
              <b>SEXO: </b><span id="sexopac"></span><br>
              <b>GRUPO SANGUÍNEO: </b><span id="rhpac"></span>
            </div>
            <div class="col-sm-1 invoice-col">
            </div>
            <!-- /.col -->
          </div>
          <br>

          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li align="center" class="nav-item"><a style="width:250px;font-weight:600" class="nav-link active" href="#activity" data-toggle="tab">Listado de Atenciones</a></li>
                <li align="center" class="nav-item"><a style="width:250px;font-weight:600" class="nav-link" href="#timeline" data-toggle="tab">Citas</a></li>
                <!-- <li align="center" class="nav-item"><a style="width:150px;font-weight:600" class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="activity">

                <h4 class="card-title">Historial de Atenciones</h4><br><br>
                  <table id="tablaHC" class="table table-hover" style="width:100%">
                    <thead style="background: #2874A6;color:white;">
                      <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Motivo</th>
                        <th>T. Enfermedad</th>
                        <th>Diagnóstico</th>
                        <th>Tratamiento</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center;">


                    </tbody>
                    <tfoot style="background: #2874A6;color:white;">
                      <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Motivo</th>
                        <th>T. Enfermedad</th>
                        <th>Diagnóstico</th>
                        <th>Tratamiento</th>
                        <th>Acción</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>

                <div class="tab-pane" id="timeline">
                <h4 class="card-title">Historial de Citas</h4><br><br>
                <table id="tablaCit" class="table table-hover" style="width:100%">
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
                      </tr>
                    </tfoot>
              </table>
                </div>


                <div class="tab-pane" id="settings">

                </div>

              </div>

            </div>
          </div>


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="card card-info card-outline" id="cardate">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-4">
                  <h3 class="card-title" style="font-weight:600;">PLANTILLA DE ATENCIÓN AL PACIENTE</h3>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <h4 class="card-title" style="color:red">Datos del Paciente:</h4><br><br>
            <input type="hidden" class="form-control" name="idate" id="idate" value="0">
            <input type="hidden" class="form-control" name="idaci" id="idaci" value="0">
              <form id="Formatencion">
                <table class="tableatencion" border="1 solid">
                  <tr style="height:40px">
                    <th class="nm" colspan="2">Paciente</th>
                    <th colspan="2">&nbsp;<span class="desc" id="apac"></span>&nbsp;</th>
                    <th class="nm">Edad</th>
                    <th style="width:400px">&nbsp;<span class="desc" id="aedad"></span>&nbsp;</th>
                  </tr>
                  <tr style="height:40px">
                    <th class="nm">DNI</th>
                    <th  style="width:150px">&nbsp;<span class="desc" id="adni"></span>&nbsp;</th>
                    <th class="nm">Servicio</th>
                    <th style="width:400px">&nbsp;<span class="desc" id="aser"></span>&nbsp;</th>
                    <th class="nm">Médico</th>
                    <th  style="width:400px">&nbsp;<span class="desc" id="amed"></span>&nbsp;</th>
                  </tr>
                </table>
                <br>
                <table class="tableatencion1" border="1 solid">  
                  <tr style="height:40px">
                    <th class="nm1">Peso (kg)</th>
                    <th><input type="text" class="form-control" id="apeso"></th>
                    <th class="nm1">Talla (m)</th>
                    <th><input type="text" class="form-control" id="atalla"></th>
                    <th class="nm1">IMC</th>
                    <th><input type="text" class="form-control" id="aimc"></th>
                    <th class="nm1">Temperatura (C°)</th>
                    <th><input type="text" class="form-control" id="atemperatura"></th>
                  </tr>
                  <tr style="height:40px">
                    <th class="nm1">Presión Arterial (mm Hg)</th>
                    <th><input type="text" class="form-control" id="apres"></th>
                    <th class="nm1">Frecuencia Cardiaca</th>
                    <th><input type="text" class="form-control" id="afrec"></th>
                    <th class="nm1">Saturación O2 (%)</th>
                    <th><input type="text" class="form-control" id="asatur"></th>
                    <th class="nm1">G. Sang.</th>
                    <th><input type="text" class="form-control" id="agsan" readonly></th>
                  </tr>
                </table>
                <br>
                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label>Motivo de Consulta</label><span style="color: red;font-weight: 600;"> (*)</span>
                      <textarea class="form-control" id="amotivo" placeholder="Ingrese Motivo de consulta"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Tiempo de Enfermedad en días</label><span style="color: red;font-weight: 600;"> (*)</span>
                      <input style="font-weight:600;font-size:18px" type="number" class="form-control" id="atiempo">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Diagnóstico</label><span style="color: red;font-weight: 600;"> (*)</span>
                      <select class='form-control rec' class="form-control" id="adx">
                        <option>Absceso</option> 
                        <option>Absceso/Flemón Dental</option> 
                        <option>Absceso/Flemón retrofaríngeo</option>
                        <option>Abuso/Maltrato</option>
                        <option>Adenopatía</option>
                        <option>Ahogamiento</option>
                        <option>Alergia inespecífica</option>
                        <option>Anafilaxia</option>
                        <option>Anemia</option>
                        <option>Ansiedad</option>
                        <option>Apendicitis</option>
                        <option>Artralgias</option>
                        <option>Artritis séptica</option>
                        <option>Asma/Sibilancias/Broncoespasmo</option>
                        <option>Atragantamiento/Aspiración cuerpo extraño</option>
                        <option>Bronquitis</option>
                        <option>Bronquiolitis</option>
                        <option>Cefalea</option>
                        <option>Cefalea postpunción</option>
                        <option>Celulitis</option>
                        <option>Colelitiasis</option>
                        <option>Contusión/Hematoma:</option>
                        <option>Crisis de agresividad</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tratamiento</label><span style="color: red;font-weight: 600;"> (*)</span>
                      <select class='form-control rec' class="form-control" id="atrata">
                        <option>FARMACOTERAPIA</option> 
                        <option>DIETOTERAPIA</option>
                        <option>FISIOTERAPIA</option>
                        <option>LOGOPEDIA</option>
                        <option>PROTESIS</option>
                        <option>PSICOTERAPIA</option>
                        <option>REHABILITACIÓN</option>
                        <option>REPOSO DOMICILIARIO</option>
                        <option>SUEROTERAPIA</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-sm-4">
                          <div class="form-group">
                              <label>Próxima Cita: </label>

                              <div class="input-group date dateC">
                                <input style="width:320px;height:calc(2.25rem + 2px);text-align:center;font-weight:600;font-size:20px" step="1"  
                                value="" type="text" id="proxcita" class="form-control" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                              </div>  
                              
                          </div> 
                        </div>
                  <div class="col-sm-4">
                    
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                    <label>Referencia</label>
                        <input style="font-weight:600;font-size:18px" type="text" class="form-control" id="refere">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer" align="right">
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal" id="CancelarAte"><i class="nav-icon fas fa-arrow-left"></i>&nbsp;&nbsp;Cancelar</button>
              <button style="height: 40px;width: 200px;" type="button" class="btn btn-primary" data-dismiss="modal" id="SaveSin"><i class="nav-icon fas fa-save"></i>&nbsp;&nbsp;Guardar Sin Receta</button>
              <button style="height: 40px;width: 220px;" type="button" class="btn btn-success" id="SaveCon"><i class="nav-icon fas fa-arrow-right"></i>&nbsp;&nbsp;Guardar y Generar Receta</button>.
            </div>
          </div>
          <div class="card card-success" id="arec">
            <div class="card-header">
              <h4 class="card-title">RECETA N° <b id="nroreceta"></b></h4>
              <button style="height: 40px;width: 150px; float:right" type="button" class="btn btn-danger" id="Finalizar">
              <i class="nav-icon fas fa-angle-left"></i>&nbsp;&nbsp;Finalizar</button>
            </div>
            <div class="card-body">
            <input type="hidden" class="form-control" id="idreceta" value="0">
            <input type="hidden" class="form-control" id="iddetalle" value="0">
              <div class="row">
                <div class="col-sm-8">
                  <label>Medicamento</label><span style="color: red;font-weight: 600;"> (*)</span>
                      <select class='form-control rec' class="form-control" id="rmed">
                        <?php while($datos = $medic->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value='<?php echo $datos['idmedicina'] ?>'>
                          <?php echo $datos['descr'] ?>
                        </option>
                        <?php } ?>
                      <select>
                </div>
                <div class="col-sm-4">
                  <label>Días</label><span style="color: red;font-weight: 600;"> (*)</span>
                  <input style="font-weight:600;font-size:18px" type="number" class="form-control" id="rdia">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-4">
                  <label>Cantidad</label><span style="color: red;font-weight: 600;"> (*)</span>
                  <input style="font-weight:600;font-size:18px" type="number" class="form-control" id="rcant">
                </div>
                <div class="col-sm-8">
                  <label>Indicación</label><span style="color: red;font-weight: 600;"> (*)</span>
                  <textarea class="form-control" id="rindi" placeholder="Ingrese Motivo de consulta"></textarea>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-4">                
                 </div>
                 <div class="col-sm-5">                
                 </div>
                 <div class="col-sm-3" style="text-align: end">
                   
                 <button style="height: 40px;width: 100px;" type="button" class="btn btn-primary" data-dismiss="modal" id="EditRES"><i class="nav-icon fas fa-save"></i>&nbsp;&nbsp;Editar</button>
                 <button style="height: 40px;width: 100px;" type="button" class="btn btn-success" data-dismiss="modal" id="SaveDES"><i class="nav-icon fas fa-save"></i>&nbsp;&nbsp;Agregar</button>
                   
                 </div>
              </div>
              
              <h4 class="card-title">Relación de Medidamentos en Receta</h4><br><br>
              <table id="tablarecdes" class="table table-hover" style="width:100%">
                <thead style="background: #2874A6;color:white;">
                  <tr style="text-align: center;">
                    <th>ID</th>
                    <th>Denominación</th>
                    <th>Tipo</th>
                    <th>Días</th>
                    <th>Cantidad</th>
                    <th>Indicación</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody style="text-align: center;">                                 
                 
                    
                 </tbody>
              </table>
            </div>
          </div> 
    </div>


 
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require_once ("../Footer.php")?>

