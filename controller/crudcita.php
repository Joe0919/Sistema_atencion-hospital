<?php
include_once '../config/conexion1.php';
require_once("../public/assets/plugins/PHPMailer/clsMail.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$mailSend = new clsMail();
date_default_timezone_set('America/Lima');

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idhora = (isset($_POST['sel'])) ? $_POST['sel'] : '';

$fecha = (isset($_POST['fechN'])) ? $_POST['fechN'] : '';

$hora = (isset($_POST['hora'])) ? $_POST['hora'] : '';
$idpac = (isset($_POST['idpac'])) ? $_POST['idpac'] : '';
$dnipersonal = (isset($_POST['dnipersonal'])) ? $_POST['dnipersonal'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';

$dnipaciente = (isset($_POST['dnipaciente'])) ? $_POST['dnipaciente'] : '';
$idcita = (isset($_POST['idcita'])) ? $_POST['idcita'] : '';
switch($opcion){
    case 1:
        $consulta = "SELECT cupos FROM horario_especialidad h where idhorario_especialidad='$idhora';";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['cupos'] == 0) {
            $data=1;
        }else{
            $consulta = "SELECT count(*) total FROM cita c where idpaciente='$idpac' and idhorario_especialidad='$idhora';";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();   
            $data=$resultado->fetch(PDO::FETCH_ASSOC);
            if ($data['total'] == 0) {

                $consulta = "SELECT count(*) total FROM pers_adm where idpersona=(SELECT idpersona from persona where dni='$dnipersonal')";		
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();   
                $data=$resultado->fetch(PDO::FETCH_ASSOC);

                if ($data['total'] == 0) {
                    $data=3;
                }else{
                    $consulta = "INSERT into cita values (null,'$fecha','$hora','$idpac','$idhora',1,
                    (SELECT idpers_adm FROM pers_adm where idpersona=(SELECT idpersona from persona where dni='$dnipersonal')),sysdate())";			
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(); 

                    $idc = $conexion->lastInsertId();


                    $consulta = "UPDATE horario_especialidad set cupos=cupos-1 where idhorario_especialidad='$idhora'";			
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(); 



                    if ($email == '') {
                        # code...
                    }else{
                        $consulta = "select idcita ID, date_format(fech_cita, '%d/%m/%Y') Fecha, time_format(hora_cita,'%h:%i %p') Hora, concat(ps.nombres,' ',ps.ap_paterno,' ',ps.ap_materno) Medico,nomcons,
                        concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Paciente,pe.dni dni1, num_hc, especialidad,concat(pa.nombres,' ',pa.ap_paterno,' ',pa.ap_materno) terminalista,
                         date_format(fech_registro, '%d/%m/%Y') fregi,time_format(fech_registro,'%h:%i %p') hregi
                        from cita c, paciente p, persona pe, medico m, persona ps, horario_especialidad h, consultorio co, estado e, espec_medico ep, especialidad ad, horario o,
                        hist_clinica hc, pers_adm adm, persona pa
                        where c.idpaciente=p.idpaciente and pe.idpersona=p.idpersona and m.idpersona=ps.idpersona and adm.idpers_adm=c.idpers_adm and pa.idpersona=adm.idpersona
                        and c.idhorario_especialidad=h.idhorario_especialidad and h.idconsultorio=co.idconsultorio and c.idestado=e.idestado and ep.idespec_medico=h.idespec_medico
                         and ep.idmedico=m.idmedico and ep.idespecialidad=ad.idespecialidad and h.idhorario=o.idhorario and hc.idhist_clinica=p.idhist_clinica and idcita='$idc'";			
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(); 
                        $data=$resultado->fetch(PDO::FETCH_ASSOC);
    
                        $bodyHTML = '<html>
                        <head>
                            <title> Mensaje HTML </title>
                            
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
                                    margin: 0 auto;
                                    width: 60%;
                                }
                            </style>
                        </head>
                        
                        <body>
                            <div id="titu">
                                <h1>HOSPITAL ANTONIO CALDAS DOMÍNGUEZ - POMABAMBA</h1>
                                <h2>SISTEMA DE ATENCIÓN DE CONSULTA EXTERNA</h2>
                            </div>
                            
                                <p>Estimado(a): <b>'.$data['Paciente'].'</b></p><hr>
                                <p>Se le envía este email por parte del <b>Hospital Antonio Caldas Domínguez - Pomabamba.</b>
                                    <br>Para informarle que se realizó satisfactoriamente el registro de su cita:
                                </p>
                                
                                <div id="table" align="center">
                                    <table width="60%" border="1"  bordercolor="#BDBCBC" cellspacing="0" cellpadding="5" id="tableDoc">
                                        <tr>
                                          <th colspan="2" style="padding: 20px;text-align:center;color:rgb(2, 0, 116);font-size: 1.5rem;height: 50px;padding: 0;">
                                            <b style="font-weight: 800;">HOSPITAL ACD - POMABAMBA</b><br>
                                            <b style="font-size: 20px;color: black;">021601A101 (RENAES:0000001765-HACDP)</b><br>
                                            <b style="font-weight: 800;">SISTEMA DE CITAS Y ATENCIÓN</b><br> 
                                            Ticket Cita Nro: <span>'.$data['ID'].'</span>                             
                                          </th>
                                        </tr>
                                        <tr style="text-align:left;font-size:20px">
                                          <th style="width: 40%;padding: 15px;">
                                            <b>Fecha de Cita: </b><span>'.$data['Fecha'].'</span><br>
                                            <b>Hora de Cita: </b><span>'.$data['Hora'].'</span><br>
                                            <b>Médico: </b><span>'.$data['Medico'].'</span><br>
                                            <b>Consultorio: </b><span>'.$data['nomcons'].'</span><br>
                           
                                          </th>
                                        </tr>
                                        <tr style="text-align:left;font-size:20px">
                                            <th style="width: 40%;padding: 15px;">
                                                <b>Paciente: </b><span>'.$data['Paciente'].'</span><br>
                                                <b>Paciente: </b><span>'.$data['dni1'].'</span><br>
                                                <b>Historia Clínica: </b><span>'.$data['num_hc'].'</span><br>
                                                <b>Servicio: </b><span>'.$data['especialidad'].'</span><br>                        
                                            </th> 
                                        </tr>
                                        <tr style="text-align:left;font-size:20px">
                                          <th style="width: 40%;padding: 15px;">
                                            <b>Recepcionista: </b><span>'.$data['terminalista'].'</span><br>
                                            <b>Fecha Registro: </b><span>'.$data['fregi'].'</span><br>
                                            <b>Hora Registro: </b><span>'.$data['hregi'].'</span><br>       
                                        </th>
                                        </tr>
                                        <tr style="text-align:center;font-size:18px;font-weight: 500;padding: 15px;">
                                          <th>El paciente debe estar 20 min antes de la atención</th>
                                        </tr>
                                        <tr style="text-align:center;font-size:18px;padding: 15px;">
                                            <th>TU SALUD EN TUS MANOS, LAVATE LAS MANOS</th>
                                          </tr>
                                      </table>
                                </div>
                                
                                    <br>Saludos cordiales
                                    <br><b>HOSPITAL ANTONIO CALDAS DOMÍNGUEZ - POMABAMBA</b>
                                </p>
                        
                                <p style="color: #094A8A;">_______________________________<br>
                                <b>OFICINA DE SISTEMAS Y TELECOMUNICACIONES - HACDP</b> <br>
                                <b>Contáctos:</b> 043-4510028<br>
                                <b>Dirección:</b> Carretera Norte KM 1 S/N - Huajtchacra<br>
                                </p>
                        </body>
                        </html>';
                        $enviado =  $mailSend->metEnviar("SISTEMA DE CITAS Y ATENCIÓN - HACDP","Usuario","$email","CITA REGISTRADA", $bodyHTML);
                    }

                }
            }else{
                $data=2; 
            }
        }  
        break;    
    case 2:        
        
        break;
    case 3:
        $consulta = "SELECT count(*) total FROM atencion where idcita='$idcita'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $consulta = "DELETE FROM cita WHERE idcita='$idcita'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();    
        }else{
            $data=1; 
        }
                             
        break;
    case 4:    
        $consulta = "select idcita ID, date_format(fech_cita, '%d/%m/%Y') Fecha, time_format(hora_cita,'%h:%i %p ') Hora, concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Paciente,
        concat(ps.nombres,' ',ps.ap_paterno,' ',ps.ap_materno) Médico, especialidad, co.nomcons Consultorio, estado
        from cita c, paciente p, persona pe, medico m, persona ps, horario_especialidad h, consultorio co, estado e, espec_medico ep, especialidad ad
        where c.idpaciente=p.idpaciente and pe.idpersona=p.idpersona and m.idpersona=ps.idpersona
        and c.idhorario_especialidad=h.idhorario_especialidad and h.idconsultorio=co.idconsultorio and c.idestado=e.idestado and ep.idespec_medico=h.idespec_medico
         and ep.idmedico=m.idmedico and ep.idespecialidad=ad.idespecialidad;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        $consulta = "select idhorario_especialidad ID, date_format(fecha, '%d/%m/%Y') fecha, cupos, especialidad, concat('Dr. ',pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Datos, nomcons, turno
        from horario_especialidad h, horario ho, consultorio c, espec_medico es, especialidad ep, medico m, persona pe
        where h.idhorario=ho.idhorario and h.idconsultorio=c.idconsultorio and h.idespec_medico=es.idespec_medico and ep.idespecialidad=es.idespecialidad
        and m.idpersona=pe.idpersona and es.idmedico=m.idmedico and idhorario_especialidad='$idhora';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 6:
        $consulta = "SELECT hora_cita FROM cita c where fech_cita='$fecha' and idhorario_especialidad='$idhora';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();     
        $filas = $resultado->rowCount();
        
        if ($filas <= 0) {
            
            $consulta = "select hora_ini ini, time_format(hora_ini,'%h:%i %p') inicio
            from horario_especialidad h, horario ho, consultorio c, espec_medico es, especialidad ep, medico m, persona pe
            where h.idhorario=ho.idhorario and h.idconsultorio=c.idconsultorio and h.idespec_medico=es.idespec_medico and ep.idespecialidad=es.idespecialidad
            and m.idpersona=pe.idpersona and es.idmedico=m.idmedico and idhorario_especialidad='$idhora';";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();        
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        } else {
            $consulta = "SELECT ADDTIME(hora_cita, '00:20:00') ini ,time_format(ADDTIME(hora_cita, '00:20:00'),'%h:%i %p') inicio
            FROM cita c where fech_cita='$fecha' and idhorario_especialidad='$idhora' ORDER BY idcita DESC LIMIT 1;";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();        
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        }

        break;
    
    case 7:
        $consulta = "select idcita ID, date_format(fech_cita, '%d/%m/%Y') Fecha, time_format(hora_cita,'%h:%i %p') Hora, pe.dni dni1,concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Paciente,
        concat(ps.nombres,' ',ps.ap_paterno,' ',ps.ap_materno) Medico, nomcons, turno, especialidad
        from cita c, paciente p, persona pe, medico m, persona ps, horario_especialidad h, consultorio co, estado e, espec_medico ep, especialidad ad, horario o
        where c.idpaciente=p.idpaciente and pe.idpersona=p.idpersona and m.idpersona=ps.idpersona
        and c.idhorario_especialidad=h.idhorario_especialidad and h.idconsultorio=co.idconsultorio and c.idestado=e.idestado and ep.idespec_medico=h.idespec_medico
         and ep.idmedico=m.idmedico and ep.idespecialidad=ad.idespecialidad and h.idhorario=o.idhorario and idcita='$idcita'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 8:
        $consulta = "select idcita ID, date_format(fech_cita, '%d/%m/%Y') Fecha, time_format(hora_cita,'%h:%i %p ') Hora, concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Paciente,
        concat(ps.nombres,' ',ps.ap_paterno,' ',ps.ap_materno) Médico, especialidad, co.nomcons Consultorio, estado
        from cita c, paciente p, persona pe, medico m, persona ps, horario_especialidad h, consultorio co, estado e, espec_medico ep, especialidad ad
        where c.idpaciente=p.idpaciente and pe.idpersona=p.idpersona and m.idpersona=ps.idpersona
        and c.idhorario_especialidad=h.idhorario_especialidad and h.idconsultorio=co.idconsultorio and c.idestado=e.idestado and ep.idespec_medico=h.idespec_medico
         and ep.idmedico=m.idmedico and ep.idespecialidad=ad.idespecialidad and pe.dni='$dnipaciente'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;    
}


print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;