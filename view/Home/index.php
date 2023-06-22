
<?php
require_once "../Header.php";
$consulta = "SELECT count(*) total FROM usuarios";			
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 
$data=$resultado->fetch(PDO::FETCH_ASSOC); 

$consulta = "SELECT count(*) total FROM paciente";			
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 
$data1=$resultado->fetch(PDO::FETCH_ASSOC); 

$consulta = "SELECT count(*) total FROM medico";			
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 
$data2=$resultado->fetch(PDO::FETCH_ASSOC); 

$consulta = "SELECT count(*) total FROM pers_adm";			
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 
$data3=$resultado->fetch(PDO::FETCH_ASSOC); 

$consulta = "SELECT count(*) total FROM cita";			
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 
$data4=$resultado->fetch(PDO::FETCH_ASSOC); 

$consulta = "SELECT count(*) total FROM medicina";			
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 
$data5=$resultado->fetch(PDO::FETCH_ASSOC); 
?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a class="brand-link navbar-lightblue">
        <img src="/SistemaAtencion/files/images/1/logo.png" alt="Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text" style="font-weight:600;font-size:1.4rem;">HACDP</span>
      </a>
    
    <div class="sidebar">
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item menu-open">
           <a href="#" class="nav-link active">
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
<!-- ACORDEÓN DEL PANEL DE ADMINISTRACIÓNL-->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-11">
          <h1 style="text-align:center;color:black;font-weight:600">BIENVENIDO AL SISTEMA DE SERVICIO DE CONSULTA EXTERNA</h1>
        </div>
        <div class="col-sm-1">

          <ol class="breadcrumb float-sm-right">
            <li style="font-weight:600"><i class="nav-icon fas fa-home"></i>&nbsp;Inicio</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
<style>
.enlace{
  color:white;
}
.enlace:hover{
  color:yellow;text-decoration: underline;
}

</style>
<!-- INICIO DEL CONTENIDO PRINCIPAL-->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <section class="col-lg-12 connectedSortable">
        <?php if($idrol == 1){?>
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 style="font-size: 1.2rem;font-weight: 500;">
                <i class="ion ion-md-folder-open mr-1"></i>Resumen de Datos:</h3>
              <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-danger">
                    <span class="info-box-icon bg-danger"><img src="/SistemaAtencion/public/assets/img/grupo.png"></i></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">USUARIOS</span>
                      <span style="font-weight:500;font-size:15px;font-style:italic" class="progress-description">Total Registrados</span>
                      <span style="font-weight:600;font-size:30px;" ><?php echo $data['total']?></span>
                      <a href="#" class="enlace">Administrar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-primary">
                    <span class="info-box-icon bg-primary"><img src="/SistemaAtencion/public/assets/img/paciente.png"></i></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">PACIENTES</span>
                      <span style="font-weight:500;font-size:15px;font-style:italic" class="progress-description">Total Registrados</span>
                      <span style="font-weight:600;font-size:28px;" ><?php echo $data1['total']?></span>
                      <a href="#" class="enlace">Administrar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-success">
                    <span class="info-box-icon bg-success"><img src="/SistemaAtencion/public/assets/img/doctor.png"></i></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">MÉDICOS</span>
                      <span style="font-weight:500;font-size:15px;font-style:italic" class="progress-description">Total Registrados</span>
                      <span style="font-weight:600;font-size:28px;" ><?php echo $data2['total']?></span>
                      <a href="#" class="enlace">Administrar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-cyan">
                    <span class="info-box-icon bg-cyan"><img src="/SistemaAtencion/public/assets/img/programador.png"></i></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">PERSONAL</span>
                      <span style="font-weight:500;font-size:15px;font-style:italic" class="progress-description">Total Registrados</span>
                      <span style="font-weight:600;font-size:28px;" ><?php echo $data3['total']?></span>
                      <a href="#" class="enlace">Administrar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-indigo">
                    <span class="info-box-icon bg-indigo"><img src="/SistemaAtencion/public/assets/img/cita-medica.png"></i></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;" class="info-box-text">CITAS</span>
                      <span style="font-weight:500;font-size:15px;font-style:italic" class="progress-description">Total Registrados</span>
                      <span style="font-weight:600;font-size:28px;" ><?php echo $data4['total']?></span>
                      <a href="#" class="enlace">Administrar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-dark">
                    <span class="info-box-icon bg-dark"><img src="/SistemaAtencion/public/assets/img/medicamentos.png"></i></span>
                    <div class="info-box-content">
                      <span style="font-weight:600;font-size:20px;color:white;" class="info-box-text">MEDICAMENTOS</span>
                      <span style="font-weight:500;font-size:15px;font-style:italic;color:white;" class="progress-description">Total Registrados</span>
                      <span style="font-weight:600;font-size:28px;color:white;" ><?php echo $data5['total']?></span>
                      <a href="#" class="enlace">Administrar <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php }?>

          <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-bullhorn"></i>
                  INFORMACIÓN DEL SISTEMA
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="callout callout-danger">
                  <h5><b>SISTEMA DE ATENCIÓN DE CONSULTA EXTERNA!</b></h5>

                  <p>Este sistema es una iniciativa para poder brindar una atención optima y adecuada a los pacientes del <b>HOPITAL ANTONIO CALDAS DOMINGUES - POMABAMBA</b>
                      en la cual se puede realizar el Registro de citas Médicas para el servicio en nuestros distintas expecialidades, así también poder realizar la atención de los pacientes y tener registro de su Historia Clínica.
                  </p>
                </div>
                
              </div>
              <!-- /.card-body -->
            </div>

            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-calendar"></i>
                  INFORMACIÓN DEL MES
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="card bg-success">
              <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendario
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"><div class="bootstrap-datetimepicker-widget usetwentyfour"><ul class="list-unstyled"><li class="show"><div class="datepicker"><div class="datepicker-days" style=""><table class="table table-sm"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">May 2022</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="05/01/2022" class="day weekend">1</td><td data-action="selectDay" data-day="05/02/2022" class="day">2</td><td data-action="selectDay" data-day="05/03/2022" class="day">3</td><td data-action="selectDay" data-day="05/04/2022" class="day">4</td><td data-action="selectDay" data-day="05/05/2022" class="day">5</td><td data-action="selectDay" data-day="05/06/2022" class="day">6</td><td data-action="selectDay" data-day="05/07/2022" class="day weekend">7</td></tr><tr><td data-action="selectDay" data-day="05/08/2022" class="day weekend">8</td><td data-action="selectDay" data-day="05/09/2022" class="day">9</td><td data-action="selectDay" data-day="05/10/2022" class="day">10</td><td data-action="selectDay" data-day="05/11/2022" class="day">11</td><td data-action="selectDay" data-day="05/12/2022" class="day">12</td><td data-action="selectDay" data-day="05/13/2022" class="day">13</td><td data-action="selectDay" data-day="05/14/2022" class="day weekend">14</td></tr><tr><td data-action="selectDay" data-day="05/15/2022" class="day weekend">15</td><td data-action="selectDay" data-day="05/16/2022" class="day">16</td><td data-action="selectDay" data-day="05/17/2022" class="day">17</td><td data-action="selectDay" data-day="05/18/2022" class="day">18</td><td data-action="selectDay" data-day="05/19/2022" class="day">19</td><td data-action="selectDay" data-day="05/20/2022" class="day active today">20</td><td data-action="selectDay" data-day="05/21/2022" class="day weekend">21</td></tr><tr><td data-action="selectDay" data-day="05/22/2022" class="day weekend">22</td><td data-action="selectDay" data-day="05/23/2022" class="day">23</td><td data-action="selectDay" data-day="05/24/2022" class="day">24</td><td data-action="selectDay" data-day="05/25/2022" class="day">25</td><td data-action="selectDay" data-day="05/26/2022" class="day">26</td><td data-action="selectDay" data-day="05/27/2022" class="day">27</td><td data-action="selectDay" data-day="05/28/2022" class="day weekend">28</td></tr><tr><td data-action="selectDay" data-day="05/29/2022" class="day weekend">29</td><td data-action="selectDay" data-day="05/30/2022" class="day">30</td><td data-action="selectDay" data-day="05/31/2022" class="day">31</td><td data-action="selectDay" data-day="06/01/2022" class="day new">1</td><td data-action="selectDay" data-day="06/02/2022" class="day new">2</td><td data-action="selectDay" data-day="06/03/2022" class="day new">3</td><td data-action="selectDay" data-day="06/04/2022" class="day new weekend">4</td></tr><tr><td data-action="selectDay" data-day="06/05/2022" class="day new weekend">5</td><td data-action="selectDay" data-day="06/06/2022" class="day new">6</td><td data-action="selectDay" data-day="06/07/2022" class="day new">7</td><td data-action="selectDay" data-day="06/08/2022" class="day new">8</td><td data-action="selectDay" data-day="06/09/2022" class="day new">9</td><td data-action="selectDay" data-day="06/10/2022" class="day new">10</td><td data-action="selectDay" data-day="06/11/2022" class="day new weekend">11</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2022</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span data-action="selectMonth" class="month">Feb</span><span data-action="selectMonth" class="month">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month active">May</span><span data-action="selectMonth" class="month">Jun</span><span data-action="selectMonth" class="month">Jul</span><span data-action="selectMonth" class="month">Aug</span><span data-action="selectMonth" class="month">Sep</span><span data-action="selectMonth" class="month">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year">2020</span><span data-action="selectYear" class="year">2021</span><span data-action="selectYear" class="year active">2022</span><span data-action="selectYear" class="year">2023</span><span data-action="selectYear" class="year">2024</span><span data-action="selectYear" class="year">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade" data-selection="2016">2010</span><span data-action="selectDecade" class="decade active" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul></div></div>
              </div>
              <!-- /.card-body -->
            </div>
                
              </div>
              <!-- /.card-body -->
            </div>





        </section>
      </div>
    </div>
  </section>
</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->
<?php require_once ("../Footer.php")?>