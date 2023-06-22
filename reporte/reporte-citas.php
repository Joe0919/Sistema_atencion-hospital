<?php 
ob_start();
include_once '../config/conexion1.php';
// if (!isset($_SESSION["idusuarios"])) {
//   header("Location: http://localhost/SistemaAtencion/Acceso/");
// }
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Lima');

$idcita = (isset($_REQUEST['e'])) ? $_REQUEST['e'] : '';



$consulta = "select idcita ID, date_format(fech_cita, '%d/%m/%Y') Fecha, time_format(hora_cita,'%h:%i %p') Hora, concat(ps.nombres,' ',ps.ap_paterno,' ',ps.ap_materno) Medico,nomcons,
concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Paciente,pe.dni dni1, num_hc, especialidad,concat(pa.nombres,' ',pa.ap_paterno,' ',pa.ap_materno) terminalista,
 date_format(fech_registro, '%d/%m/%Y') fregi,time_format(fech_registro,'%h:%i %p') hregi
from cita c, paciente p, persona pe, medico m, persona ps, horario_especialidad h, consultorio co, estado e, espec_medico ep, especialidad ad, horario o,
hist_clinica hc, pers_adm adm, persona pa
where c.idpaciente=p.idpaciente and pe.idpersona=p.idpersona and m.idpersona=ps.idpersona and adm.idpers_adm=c.idpers_adm and pa.idpersona=adm.idpersona
and c.idhorario_especialidad=h.idhorario_especialidad and h.idconsultorio=co.idconsultorio and c.idestado=e.idestado and ep.idespec_medico=h.idespec_medico
 and ep.idmedico=m.idmedico and ep.idespecialidad=ad.idespecialidad and h.idhorario=o.idhorario and hc.idhist_clinica=p.idhist_clinica and idcita='$idcita'";			
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 
$data=$resultado->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
        <head>
            <title> Ticket de Cita </title>
            
            <style>
                body{
                    font-family: "arial";
                }
                h1 {
                    font-size: 1.6rem;
                    padding: 12px;
                    color: white;
                    margin: 0;
                }
        
                h2 {
                    font-size: 1.4rem;
                    margin: 0;
                    color: #F4FA58;
                }
                #titu{
                    background-color: #096B87;
                    text-align: center;
                    height: 105px;
                }
                #table{
                    /* margin: 0 auto; */
                    width: 60%;
                }
            </style>
        </head>
  <body>
                  <div id="table" >
                    <table width="80%" border="1" align="left" bordercolor="#BDBCBC" cellspacing="0" cellpadding="5" id="tableDoc">
                        <tr>
                          <th style="padding: 20px;text-align:center;color:rgb(2, 0, 116);font-size: 1.4rem;height: 50px;">
                            <b style="font-weight: 800;">HOSPITAL ACD - POMABAMBA</b><br>
                            <b style="font-size: 15px;color: black;">021601A101 (RENAES:0000001765-HACDP)</b><br>
                            <b style="font-weight: 800;">SISTEMA DE CITAS Y ATENCIÓN</b><br> 
                            Receta Médica Nro: <span><?php echo $data['ID'];?></span>                         
                          </th>
                        </tr>
                        <tr style="text-align:left;font-size:16px">
                          <th style="width: 40%;padding: 15px;">
                            <b>Fecha de Cita: </b><span><?php echo $data['Fecha'];?></span><br>
                            <b>Hora de Cita: </b><span><?php echo $data['Hora'];?></span><br>
                            <b>Médico: </b><span></span><?php echo $data['Medico'];?><br>
                            <b>Consultorio: </b><span><?php echo $data['nomcons'];?></span><br>
                            <b>Orden / Total: </b><span></span><br>                            
                          </th>
                        </tr>
                        <tr style="text-align:left;font-size:16px">
                            <th style="width: 40%;padding: 15px;">
                                <b>Paciente: </b><span><?php echo $data['Paciente'];?></span><br>
                                <b>DNI: </b><?php echo $data['dni1'];?><span></span><br>
                                <b>Historia Clínica: </b><?php echo $data['num_hc'];?><span></span><br>
                                <b>Servicio: </b><span><?php echo $data['especialidad'];?></span><br>                        
                            </th> 
                        </tr>
                        <tr style="text-align:left;font-size:16px">
                          <th style="width: 40%;padding: 15px;">
                            <b>Recepcionista: </b><span><?php echo $data['terminalista'];?></span><br>
                            <b>Fecha Registro: </b><span><?php echo $data['fregi'];?></span><br>
                            <b>Hora Registro: </b><span><?php echo $data['hregi'];?></span><br>       
                        </th>
                        </tr>
                        <tr style="text-align:center;font-size:17px;font-weight: 500;padding: 15px;">
                          <th>El paciente debe estar 20 min antes de la atención</th>
                        </tr>
                        <tr style="text-align:center;font-size:17 px;padding: 15px;">
                            <th>TU SALUD EN TUS MANOS, LAVATE LAS MANOS</th>
                          </tr>
                      </table>
                </div>
  </body>
</html>

<?php 
$html = ob_get_clean();
// echo $html;

require_once '../vendor/autoload.php';
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options); 

$dompdf->set_option('defaultFont', 'arial');

$dompdf->loadHtml($html); // (Optional) Setup the paper size and orientation
$dompdf->setPaper("A3", "portrait"); //Render the HTML as PDF
$dompdf->render(); // Output the generated PDF to Browser
$dompdf->stream('Reporte.pdf',array('Attachment'=>false)); exit; 
?>
